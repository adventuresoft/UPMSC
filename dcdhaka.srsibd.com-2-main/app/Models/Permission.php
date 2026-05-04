<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends SpatiePermission
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'guard_name'];
}
