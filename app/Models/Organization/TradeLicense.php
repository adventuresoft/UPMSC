<?php

namespace App\Models\Organization;

use App\Models\Tax\TaxYear;
use App\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;


class TradeLicense extends Model
{
    use HasFactory, Multitenantable;

    protected $fillable = [
        'system_id', 'invoice_no', 'payment_status', 'payment_type',
        'payment_details', 'transaction_id', 'payment_note', 'paid_at',
        'institute_id', 'tax_year_id', 'organization_id', 'fees', 'status', 'total_amount',
    ];


    public function taxYear()
    {
        return $this->belongsTo(TaxYear::class, 'tax_year_id', 'id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }


    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->system_id = IdGenerator::generate(['table' => 'trade_licenses', 'field' => 'system_id', 'length' => 13, 'prefix' => 'TR' . date("Ymd") ]);
        });
    }

}
