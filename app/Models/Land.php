<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Multitenantable;

class Land extends Model
{
    use HasFactory, Multitenantable;
}
