<?php

namespace App\Support;

use App\Models\BasicSettings\Village;
use App\Models\House;
use App\Models\Institute;
use App\Models\Union;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AreaTenancy
{
    public static function user(?User $user = null): ?User
    {
        return $user ?: Auth::user();
    }

    public static function isUnscoped(?User $user = null): bool
    {
        $user = self::user($user);

        return !$user || in_array($user->role_id, [1, 4]) || $user->area === 'All';
    }

    public static function assignedUnionId(?User $user = null): ?int
    {
        $user = self::user($user);

        if (!$user) {
            return null;
        }

        if ($user->area && str_contains($user->area, 'Union:')) {
            $id = trim(str_replace('Union:', '', $user->area));

            return is_numeric($id) ? (int) $id : null;
        }

        if ($user->institute_id && $user->institute && $user->institute->union_id) {
            return (int) $user->institute->union_id;
        }

        return null;
    }

    public static function unionAllowed($unionId, ?User $user = null): bool
    {
        if (self::isUnscoped($user)) {
            return true;
        }

        $assignedUnionId = self::assignedUnionId($user);

        return $assignedUnionId && (int) $unionId === $assignedUnionId;
    }

    public static function villageAllowed($villageId, ?User $user = null): bool
    {
        if (self::isUnscoped($user)) {
            return true;
        }

        if (!$villageId) {
            return true;
        }

        $assignedUnionId = self::assignedUnionId($user);

        if (!$assignedUnionId) {
            return false;
        }

        return Village::whereKey($villageId)
            ->where('union_id', $assignedUnionId)
            ->exists();
    }

    public static function houseAllowed($houseId, ?User $user = null): bool
    {
        if (self::isUnscoped($user)) {
            return true;
        }

        return House::applyMultitenancy()->whereKey($houseId)->exists();
    }

    public static function personBelongsToAssignedUnion($userId, ?User $user = null): bool
    {
        if (self::isUnscoped($user)) {
            return true;
        }

        if (!$userId) {
            return true;
        }

        $assignedUnionId = self::assignedUnionId($user);

        if (!$assignedUnionId) {
            return false;
        }

        return self::personQuery($userId)
            ->where(function ($query) use ($assignedUnionId) {
                $query->whereHas('addressInfo', function ($addressQuery) use ($assignedUnionId) {
                    $addressQuery->where('permanent_union_id', $assignedUnionId)
                        ->orWhere('present_union_id', $assignedUnionId);
                })->orWhereHas('institute', function ($instituteQuery) use ($assignedUnionId) {
                    $instituteQuery->where('union_id', $assignedUnionId);
                });
            })
            ->exists();
    }

    public static function personExists($identifier): bool
    {
        if (!$identifier) {
            return false;
        }

        return self::personQuery($identifier)->exists();
    }

    private static function personQuery($identifier)
    {
        return User::where(function ($query) use ($identifier) {
            $query->where('system_id', $identifier)
                ->orWhereHas('people', function ($peopleQuery) use ($identifier) {
                    $peopleQuery->where('approved_id', $identifier);
                });

            if (ctype_digit((string) $identifier)) {
                $query->orWhere('id', (int) $identifier);
            }
        });
    }

    public static function assignedUnion(?User $user = null): ?Union
    {
        $assignedUnionId = self::assignedUnionId($user);

        return $assignedUnionId ? Union::with('thana.district')->find($assignedUnionId) : null;
    }

    public static function instituteIdForVillage($villageId, ?User $user = null): ?int
    {
        $user = self::user($user);

        if ($user && $user->institute_id) {
            return (int) $user->institute_id;
        }

        if (!$villageId) {
            return null;
        }

        $village = Village::withoutGlobalScopes()->find($villageId);

        if (!$village || !$village->union_id) {
            return null;
        }

        return Institute::where('union_id', $village->union_id)->value('id');
    }
}
