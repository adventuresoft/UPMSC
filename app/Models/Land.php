<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Multitenantable;

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
}
