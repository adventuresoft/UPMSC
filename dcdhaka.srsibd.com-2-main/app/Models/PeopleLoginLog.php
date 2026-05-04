<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeopleLoginLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'people_id',
        'ip_address',
        'user_agent',
        'status'
    ];

    public function people()
    {
        return $this->belongsTo(People::class);
    }
}
