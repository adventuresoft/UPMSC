<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class People extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    public static $snakeAttributes = false;
    public $table = 'people';
    protected $fillable = [
        'user_id',
        'account_type',
        'name',
        'bn_name',
        'date_of_birth',
        'birth_place',
        'district_id',
        'country_id',
        'gender',
        'religion_id',
        'blood_group',
        'mobile',
        'email',
        'birth_certificate',
        'nid',
        'image',
        'status',
        'created_by',
        'updated_by',
        'approved_id',
        'login_id',
        'password',
        'plain_password_hint',
        'credentials_set_at',
        'credentials_set_by',
        'login_status'
    ];

    protected $hidden = [
        'password',
        'plain_password_hint',
    ];

    public function loginLogs()
    {
        return $this->hasMany(PeopleLoginLog::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function familyInfo()
    {
        return $this->hasOne(People\FamilyInfo::class, 'user_id', 'user_id');
    }
}
