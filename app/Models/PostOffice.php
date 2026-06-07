<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostOffice extends Model
{
    use HasFactory;

    public function upazilla()
    {
        return $this->belongsTo(Upazilla::class, 'thana_id');
    }
}
