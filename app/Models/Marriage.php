<?php

namespace App\Models;

use App\Scopes\AreaMultitenancyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marriage extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope(new AreaMultitenancyScope());
    }

    public function groomUser()
    {
        return $this->belongsTo(User::class, 'groom_user_id');
    }

    public function brideUser()
    {
        return $this->belongsTo(User::class, 'bride_user_id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function upazila()
    {
        return $this->belongsTo(Thana::class, 'upazila_id');
    }

    public function union()
    {
        return $this->belongsTo(Union::class, 'union_id');
    }
}
