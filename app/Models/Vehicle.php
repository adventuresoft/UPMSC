<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Multitenantable;

class Vehicle extends Model
{
    use HasFactory, Multitenantable;

    protected $fillable = [
        'registration_id',
        'institute_id',
        'union_id',
        'thana_id',
        'district_id',
        'vehicle_type',
        'vehicle_category',
        'vehicle_model',
        'make_year',
        'make_company',
        'ownership_type',
        'owner_id',
        'owner_name',
        'institutional_name',
        'trade_license',
        'institutional_address',
        'price',
        'engine_number',
        'chassis_number',
        'tyre_number',
        'hp_cc',
        'seat_capacity',
        'height',
        'width',
        'tyre_size',
        'color',
        'status',
        'approved_by',
        'approved_at',
        'payment_status',
        'payment_method',
        'transaction_id',
        'paid_at',
        'created_by',
        'updated_by',
    ];

}
