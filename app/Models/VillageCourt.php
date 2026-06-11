<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Multitenantable;
use App\Models\People;

class VillageCourt extends Model
{
    use HasFactory, Multitenantable;

    protected $fillable = [
        'case_no',
        'institute_id',
        'badi_id',
        'bibadi_ids',
        'shakkhi_ids',
        'ovijog_er_biboron',
        'ghotona_sombolito',
        'case_date',
        'case_time',
        'hajir_date',
        'hajir_time',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'bibadi_ids' => 'array',
        'shakkhi_ids' => 'array',
        'case_date' => 'date',
        'hajir_date' => 'date',
    ];

    public function badi()
    {
        return $this->belongsTo(People::class, 'badi_id', 'id');
    }

    public function bibadis()
    {
        if (is_array($this->bibadi_ids) && count($this->bibadi_ids) > 0) {
            return People::whereIn('id', $this->bibadi_ids)->get();
        }
        return collect();
    }

    public function shakkhis()
    {
        // Shakkhi IDs is a JSON array of People IDs. 
        // We can fetch them via a custom accessor or a method.
        if (is_array($this->shakkhi_ids) && count($this->shakkhi_ids) > 0) {
            return People::whereIn('id', $this->shakkhi_ids)->get();
        }
        return collect();
    }
}
