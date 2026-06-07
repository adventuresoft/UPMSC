<?php

namespace App\Models\Certificate;

use App\Models\User;
use App\Traits\SystemIdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Multitenantable;

class Inheritance extends Model
{
    use HasFactory, SystemIdGenerator, Multitenantable;

    public static $snakeAttributes = false;
    public $table = 'inheritances';
    protected $fillable = [
        'user_id',
        'death_certificate_id',
        'members',
        'fees',
        'quantity',
        'total_amount',
        'created_by',
        'taken_by',
        'date_of_death'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function deathPerson()
    {
        return $this->belongsTo(DeathCertificate::class, 'death_certificate_id', 'id');
    }
    
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->system_id = self::generateSystemId('inheritances');
        });
    }
}
