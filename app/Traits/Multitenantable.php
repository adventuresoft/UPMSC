<?php

namespace App\Traits;

use App\Models\Institute;

trait Multitenantable
{
    /**
     * Apply multitenancy scope to queries.
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApplyMultitenancy($query)
    {
        $user = auth()->user();
        if (!$user || is_superadmin()) {
            return $query;
        }

        $table = $this->getTable();

        // 1. If the model has institute_id, use it for direct or Thana/District filtering
        if (\Schema::hasColumn($table, 'institute_id')) {
            if ($user->institute_id) {
                return $query->where($table . '.institute_id', $user->institute_id);
            }

            if ($user->area) {
                if (str_contains($user->area, 'Thana:')) {
                    $thanaId = str_replace('Thana:', '', $user->area);
                    return $query->whereHas('institute.union', function($q) use ($thanaId) {
                        $q->where('thana_id', $thanaId);
                    });
                }
                
                if (str_contains($user->area, 'District:')) {
                    $districtId = str_replace('District:', '', $user->area);
                    return $query->whereHas('institute.union.thana', function($q) use ($districtId) {
                        $q->where('district_id', $districtId);
                    });
                }
            }
        }

        // 2. If the model has user_id, filter based on the related User's multitenancy (Location/Institute)
        if (\Schema::hasColumn($table, 'user_id')) {
            return $query->whereHas('user', function($uq) {
                $uq->applyMultitenancy();
            });
        }

        // 3. Fallback: restrict to user's own created records if applicable
        if (\Schema::hasColumn($table, 'created_by')) {
            return $query->where($table . '.created_by', $user->id);
        }

        return $query;
    }

    /**
     * Relationship to Institute (Common across many multitenant models)
     */
    public function institute()
    {
        if (\Schema::hasColumn($this->getTable(), 'institute_id')) {
            return $this->belongsTo(\App\Models\Institute::class, 'institute_id');
        }
        return null;
    }
}
