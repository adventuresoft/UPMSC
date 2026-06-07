<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upazilla extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    protected $table = 'thanas'; // Keep the table name the same
    protected $fillable = ['name', 'bn_name', 'url', 'status', 'district_id'];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
}
