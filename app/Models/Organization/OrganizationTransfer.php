<?php

namespace App\Models\Organization;

use App\Models\Institute;
use App\Models\Organization\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Multitenantable;

class OrganizationTransfer extends Model
{
    use HasFactory, Multitenantable;

    protected $table = 'organization_transfers';

    protected $fillable = [
        'organization_id',
        'source_institute_id',
        'to_institute_id',
        'status',
        'requested_by',
        'responded_by',
        'remarks',
        'response_comment',
        'requested_at',
        'responded_at',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'responded_at' => 'datetime',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function sourceInstitute()
    {
        return $this->belongsTo(Institute::class, 'source_institute_id');
    }

    public function toInstitute()
    {
        return $this->belongsTo(Institute::class, 'to_institute_id');
    }

    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function respondedBy()
    {
        return $this->belongsTo(User::class, 'responded_by');
    }
}
