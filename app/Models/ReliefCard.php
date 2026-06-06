<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Multitenantable;

class ReliefCard extends Model
{
    use HasFactory, SoftDeletes, Multitenantable;

    public static $snakeAttributes = false;
    
    public $table = 'relief_cards';

    protected $fillable = [
        'system_id',
        'user_id',
        'relief_type',
        'monthly_income',
        'family_members',
        'reason',
        'status',
        'created_by',
        'approved_by',
        'approved_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(People::class, 'created_by', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $date = now()->format('ymd');
            $count = self::whereDate('created_at', now()->toDateString())->count() + 1;
            $serial = str_pad($count, 3, '0', STR_PAD_LEFT);
            $model->system_id = 'RC' . $date . $serial;
        });
    }
}
