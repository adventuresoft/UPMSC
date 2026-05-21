<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Multitenantable;
use App\Models\People;
use App\Support\AreaTenancy;

class Land extends Model
{
    use HasFactory, Multitenantable;

    protected $casts = [
        'records_data' => 'array',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'system_id');
    }

    public function getOwnerUserAttribute()
    {
        $id = $this->owner_id;
        if (!$id) return null;
        return User::with('people')->where('system_id', $id)
            ->orWhereHas('people', function ($q) use ($id) {
                $q->where('approved_id', $id);
            })->first();
    }

    public function scopeApplyMultitenancy($query)
    {
        if (AreaTenancy::isUnscoped()) {
            return $query;
        }

        $scopedUsers = User::query()->applyMultitenancy();

        $systemIds = (clone $scopedUsers)
            ->whereNotNull('system_id')
            ->select('system_id');

        $userIds = (clone $scopedUsers)
            ->select('id');

        $approvedIds = People::whereIn('user_id', (clone $scopedUsers)->select('id'))
            ->whereNotNull('approved_id')
            ->select('approved_id');

        return $query->where(function ($landQuery) use ($systemIds, $userIds, $approvedIds) {
            $landQuery->whereIn('owner_id', $systemIds)
                ->orWhereIn('owner_id', $approvedIds)
                ->orWhereIn('owner_id', $userIds);
        });
    }
}
