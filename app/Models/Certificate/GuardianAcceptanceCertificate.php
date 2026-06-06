<?php

namespace App\Models\Certificate;

use App\Models\User;
use App\Traits\SystemIdGenerator;
use App\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuardianAcceptanceCertificate extends Model
{
    use HasFactory, SystemIdGenerator, Multitenantable;

    public $table = 'guardian_acceptance_certificates';
    protected $fillable = [
        'system_id',
        'user_id',
        'guardian_id',
        'guardian_relation',
        'fees',
        'quantity',
        'total_amount',
        'created_by',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function guardian()
    {
        return $this->belongsTo(User::class, 'guardian_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->system_id = self::generateSystemId('guardian_acceptance_certificates');
        });
    }
}
