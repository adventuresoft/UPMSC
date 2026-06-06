<?php

namespace App\Models\Certificate;

use App\Models\User;
use App\Traits\SystemIdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

use App\Traits\Multitenantable;

class NidCorrectionCertificate extends Model
{
    use HasFactory, SystemIdGenerator, Multitenantable;

    public static $snakeAttributes = false;
    public $table = 'nid_correction_certificates';
    protected $fillable = [
        'system_id',
        'user_id',
        'fees',
        'quantity',
        'total_amount',
        'created_by',
        'applicant_name',
        'applicant_father_name',
        'applicant_mother_name',
        'applicant_nid',
        'applicant_dob',
        'applicant_mobile',
        'correction_type',
        'old_info',
        'new_info',
        'status',
        'purpose',
        'applicant_name_en',
        'applicant_husband_name',
        'applicant_blood_group',
        'applicant_address',
        'guardian_name',
        'guardian_nid',
        'payment_amount',
        'payment_receipt_no',
        'attachments_list',
        'correction_data',
    ];

    protected $casts = [
        'correction_data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    
     protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->system_id = self::generateSystemId('nid_correction_certificates');
        });
    }
    
    // public static function boot()
    // {
    //     parent::boot();

    //     self::creating(function ($model) {
    //         $model->system_id = IdGenerator::generate(['table' => 'nid_correction_certificates', 'field' => 'system_id', 'length' => 11, 'prefix' => date("Ymd") ]);
    //     });
    // }
}
