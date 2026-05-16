<?php

namespace App\Models\Certificate;

use App\Models\User;
use App\Traits\SystemIdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

use App\Traits\Multitenantable;

class MarriedCertificate extends Model
{
    use HasFactory, SystemIdGenerator, Multitenantable;


    public static $snakeAttributes = false;
    public $table = 'married_certificates';
    protected $fillable = [
    'system_id',
    'user_id',
    'husband_id',
    'husband_system_id',
    'wife_id',
    'wife_system_id',
    'spouse_name',
    'spouse_nid',
    'marriage_date',
    'marriage_place',
    'fees',
    'quantity',
    'total_amount',
    'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function husband()
    {
        return $this->belongsTo(User::class, 'husband_id', 'id');
    }

    public function wife()
    {
        return $this->belongsTo(User::class, 'wife_id', 'id');
    }


    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->system_id = self::generateSystemId('married_certificates');
        });
    }

    // public static function boot()
    // {
    //     parent::boot();

    //     self::creating(function ($model) {
    //         $model->system_id = IdGenerator::generate(['table' => 'married_certificates', 'field' => 'system_id', 'length' => 11, 'prefix' => date("Ymd") ]);
    //     });
    // }
}
