<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * AreaMultitenancyScope
 *
 * Filters Eloquent queries based on the logged-in user's geographic area.
 * Superadmins (role 1 & 4) bypass all filtering.
 *
 * Priority cascade:
 *
 *  1. TABLE HAS DIRECT GEOGRAPHIC COLUMNS (union_id / pourashava_id / etc.)
 *     → Apply the matching geographic filter strictly.
 *     → If the user's area type does NOT match any column in this table,
 *       return EMPTY results (whereRaw('1 = 0')) to prevent cross-area leakage.
 *     → NEVER fall through to created_by for geo-keyed tables.
 *
 *  2. TABLE HAS institute_id COLUMN
 *     → Filter by user's institute_id directly.
 *
 *  3. TABLE HAS ONLY created_by (no geographic/institute columns)
 *     → Use 3-arm created_by fallback:
 *       A) Creator is a superadmin          → global/shared data, visible to all
 *       B) Creator is from the same area    → local data, area-isolated
 *       C) Creator no longer exists in DB   → orphaned legacy data, treated as global
 */
class AreaMultitenancyScope implements Scope
{
    /** Geographic column names that represent direct area ownership */
    private const GEO_COLUMNS = [
        'union_id',
        'pourashava_id',
        'city_corporation_id',
        'thana_id',
        'district_id',
    ];

    public function apply(Builder $builder, Model $model)
    {
        if (!Auth::check()) {
            return;
        }

        $user = Auth::user();

        // Superadmins or users with "All" area assigned see everything — no filter
        if (in_array($user->role_id, [1, 4]) || $user->area === 'All') {
            return;
        }

        $table = $model->getTable();

        // ── Resolve user's geographic area IDs ────────────────────────────────
        $userUnionId      = null;
        $userPourashavaId = null;
        $userCityCorpId   = null;
        $userThanaId      = null;
        $userDistrictId   = null;

        // Source 1: linked institute
        if ($user->institute_id && $user->institute) {
            $userUnionId      = $user->institute->union_id      ?: null;
            $userPourashavaId = $user->institute->pourashava_id ?: null;
            $userCityCorpId   = $user->institute->city_corporation_id ?: null;
        }

        // Source 2: explicit area string (overrides institute values)
        if ($user->area) {
            if (str_contains($user->area, 'Union:')) {
                $userUnionId      = trim(str_replace('Union:', '', $user->area));
                $userPourashavaId = null;
                $userCityCorpId   = null;
                $userThanaId      = null;
                $userDistrictId   = null;
            } elseif (str_contains($user->area, 'Pourashava:')) {
                $userPourashavaId = trim(str_replace('Pourashava:', '', $user->area));
                $userUnionId      = null;
                $userCityCorpId   = null;
            } elseif (str_contains($user->area, 'City Corp:')) {
                $userCityCorpId   = trim(str_replace('City Corp:', '', $user->area));
                $userUnionId      = null;
                $userPourashavaId = null;
            } elseif (str_contains($user->area, 'Thana:')) {
                $userThanaId      = trim(str_replace('Thana:', '', $user->area));
                $userUnionId      = null;
            } elseif (str_contains($user->area, 'District:')) {
                $userDistrictId   = trim(str_replace('District:', '', $user->area));
                $userUnionId      = null;
            }
        }

        // ── Priority 1: Table has direct geographic column(s) ─────────────────
        //
        // Check if this table has ANY of the known geo columns.
        // If it does, apply strict geo-based filtering.
        // If the user's area type does NOT match any available column,
        // return empty results — do NOT fall through to created_by.
        // This prevents cross-area leakage for geographically-keyed tables.
        //
        $tableGeoColumns = [];
        foreach (self::GEO_COLUMNS as $col) {
            if (Schema::hasColumn($table, $col)) {
                $tableGeoColumns[] = $col;
            }
        }

        if (!empty($tableGeoColumns)) {
            // Try each user area type against the table's available geo columns
            if ($userUnionId && in_array('union_id', $tableGeoColumns)) {
                $builder->where($table . '.union_id', $userUnionId);
                return;
            }
            if ($userPourashavaId && in_array('pourashava_id', $tableGeoColumns)) {
                $builder->where($table . '.pourashava_id', $userPourashavaId);
                return;
            }
            if ($userCityCorpId && in_array('city_corporation_id', $tableGeoColumns)) {
                $builder->where($table . '.city_corporation_id', $userCityCorpId);
                return;
            }
            if ($userThanaId && in_array('thana_id', $tableGeoColumns)) {
                $builder->where($table . '.thana_id', $userThanaId);
                return;
            }
            if ($userDistrictId && in_array('district_id', $tableGeoColumns)) {
                $builder->where($table . '.district_id', $userDistrictId);
                return;
            }

            // ── Cross-type geographic resolution ─────────────────────────────
            // The user's primary area type didn't match any column directly.
            // Try to resolve upward through the geographic hierarchy.
            //
            // Example: Union user viewing UnionWard (has union_id) → already handled above.
            // Example: Thana user viewing Village (has union_id + thana_id) → handled above.
            // Example: Pourashava user viewing Village (only has union_id, no pourashava_id)
            //          → No match possible → return EMPTY to prevent leakage.

            // No matching column found — return empty results to prevent cross-area leakage
            $builder->whereRaw('1 = 0');
            return;
        }

        // ── Priority 2: Table has institute_id column ─────────────────────────
        if ($user->institute_id && Schema::hasColumn($table, 'institute_id')) {
            $builder->where($table . '.institute_id', $user->institute_id);
            return;
        }

        // ── Priority 3: Fallback — created_by column ─────────────────────────
        //
        // For basic-settings tables with NO direct geographic or institute column.
        // Shows THREE groups via OR:
        //
        //  Arm A — Creator is a superadmin (role 1 or 4)
        //           System-wide reference data seeded globally.
        //
        //  Arm B — Creator belongs to the same geographic area
        //           Area-specific local entries. Isolated between areas.
        //
        //  Arm C — Creator was hard-deleted from the users table (orphaned)
        //           Cannot determine their area → treat as global legacy data.
        //
        if (Schema::hasColumn($table, 'created_by')) {

            $builder->where(function (Builder $outer) use (
                $table, $user,
                $userUnionId, $userPourashavaId, $userCityCorpId,
                $userThanaId, $userDistrictId
            ) {

                // ── Arm A: Superadmin-created global records ──────────────────
                $outer->whereIn($table . '.created_by', function ($q) {
                    $q->select('id')
                      ->from('users')
                      ->whereIn('role_id', [1, 4]);
                });

                // ── Arm B: Same-area user records ─────────────────────────────
                $outer->orWhereIn($table . '.created_by', function ($q) use (
                    $user,
                    $userUnionId, $userPourashavaId, $userCityCorpId,
                    $userThanaId, $userDistrictId
                ) {
                    $q->select('id')->from('users');

                    if ($userUnionId) {
                        $q->where(function ($sq) use ($userUnionId, $user) {
                            $sq->where('area', 'like', '%Union:' . $userUnionId . '%')
                               ->orWhereIn('institute_id', function ($sub) use ($userUnionId) {
                                   $sub->select('id')->from('institutes')
                                       ->where('union_id', $userUnionId);
                               })
                               ->orWhere('id', $user->id);
                        });

                    } elseif ($userPourashavaId) {
                        $q->where(function ($sq) use ($userPourashavaId, $user) {
                            $sq->where('area', 'like', '%Pourashava:' . $userPourashavaId . '%')
                               ->orWhereIn('institute_id', function ($sub) use ($userPourashavaId) {
                                   $sub->select('id')->from('institutes')
                                       ->where('pourashava_id', $userPourashavaId);
                               })
                               ->orWhere('id', $user->id);
                        });

                    } elseif ($userCityCorpId) {
                        $q->where(function ($sq) use ($userCityCorpId, $user) {
                            $sq->where('area', 'like', '%City Corp:' . $userCityCorpId . '%')
                               ->orWhereIn('institute_id', function ($sub) use ($userCityCorpId) {
                                   $sub->select('id')->from('institutes')
                                       ->where('city_corporation_id', $userCityCorpId);
                               })
                               ->orWhere('id', $user->id);
                        });

                    } elseif ($userThanaId) {
                        $q->where(function ($sq) use ($userThanaId, $user) {
                            $sq->where('area', 'like', '%Thana:' . $userThanaId . '%')
                               ->orWhereIn('institute_id', function ($sub) use ($userThanaId) {
                                   $sub->select('id')->from('institutes')
                                       ->whereIn('union_id', function ($uSub) use ($userThanaId) {
                                           $uSub->select('id')->from('unions')
                                               ->where('thana_id', $userThanaId);
                                       });
                               })
                               ->orWhere('id', $user->id);
                        });

                    } elseif ($userDistrictId) {
                        $q->where(function ($sq) use ($userDistrictId, $user) {
                            $sq->where('area', 'like', '%District:' . $userDistrictId . '%')
                               ->orWhereIn('institute_id', function ($sub) use ($userDistrictId) {
                                   $sub->select('id')->from('institutes')
                                       ->whereIn('union_id', function ($uSub) use ($userDistrictId) {
                                           $uSub->select('id')->from('unions')
                                               ->whereIn('thana_id', function ($tSub) use ($userDistrictId) {
                                                   $tSub->select('id')->from('thanas')
                                                       ->where('district_id', $userDistrictId);
                                               });
                                       });
                               })
                               ->orWhere('id', $user->id);
                        });

                    } else {
                        // No known area — show only the user's own records
                        $q->where('id', $user->id);
                    }
                });

                // ── Arm C: Orphaned records (creator hard-deleted) ────────────
                // created_by points to a user ID that no longer exists in users.
                // Cannot determine their area → treat as globally-shared legacy data.
                $outer->orWhere(function (Builder $arm) use ($table) {
                    $arm->whereNotNull($table . '.created_by')
                        ->whereNotExists(function ($sub) use ($table) {
                            $sub->select(DB::raw(1))
                                ->from('users')
                                ->whereRaw('users.id = ' . $table . '.created_by');
                        });
                });
            });
        }
    }
}
