<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\VillageCourt;

class VillageCourtHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'village_court_id',
        'action',
        'description',
        'created_by',
    ];

    public function villageCourt()
    {
        return $this->belongsTo(VillageCourt::class, 'village_court_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
