<?php

namespace App\Models\Certificate;

use App\Models\User;
use App\Traits\SystemIdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class NidCorrectionCertificate extends Model
{
    use HasFactory,SystemIdGenerator;

    public static $snakeAttributes = false;
    public $table = 'nid_correction_certificates';
    protected $fillable = [
        'system_id',
        'user_id',
        'fees',
        'quantity',
        'total_amount',
        'created_by',
        'recipient_upazila_thana',
        'recipient_upazila_thana_name',
        'recipient_district',
        'applicant_name',
        'applicant_nid',
        'applicant_dob',
        'current_voter_no',
        'current_voter_area_name',
        'current_voter_area_no',
        'current_upazila_thana',
        'current_district',
        'current_village_road',
        'current_house_holding',
        'transfer_district',
        'transfer_upazila_thana',
        'transfer_entity_type',
        'transfer_entity_name',
        'transfer_ward_no',
        'transfer_voter_area_name',
        'transfer_voter_area_no',
        'transfer_village_road',
        'transfer_house_holding',
        'transfer_phone_mobile',
        'transfer_post_office',
        'transfer_post_code',
        'staying_since',
        'transfer_reason',
        'identifier_name',
        'identifier_nid',
        'identifier_address',
        'status',
        'purpose',
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
