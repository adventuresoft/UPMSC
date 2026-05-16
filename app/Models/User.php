<?php

namespace App\Models;

use App\Models\Certificate\BirthCertificate;
use App\Models\Certificate\CharacterCertificate;
use App\Models\Certificate\CitizenCertificate;
use App\Models\Certificate\DeathCertificate;
use App\Models\People\AddressInfo;
use App\Models\People\DisabilityInfo;
use App\Models\People\EducationalInfo;
use App\Models\People\FamilyInfo;
use App\Models\People\FinancialInfo;
use App\Models\People\FreedomFighterInfo;
use App\Models\People\HealthInfo;
use App\Models\People\ProfessionalInfo;
use App\Models\People\PropertyInfo;
use App\Models\People\JulyFighterInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public static $snakeAttributes = false;
    public $table = 'users';
    protected $fillable = [
        'system_id',
        'institute_id',
        'role_id',
        'name',
        'email',
        'mobile',
        'area',
        'password',
        'status',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->system_id = IdGenerator::generate(['table' => 'users', 'field' => 'system_id', 'length' => 11, 'prefix' => date("Ymd") ]);
        });
    }

    /**
     * Override the Illuminate can() method to grant full access to superadmins.
     */
    public function can($abilities, $arguments = []): bool
    {
        if (in_array($this->role_id, [1, 4])) {
            return true;
        }
        return parent::can($abilities, $arguments);
    }


    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id', 'id');
    }

    public function people()
    {
        return $this->hasOne(People::class, 'user_id', 'id');
    }
    public function familyInfo()
    {
        return $this->hasOne(FamilyInfo::class, 'user_id', 'id');
    }
    public function addressInfo()
    {
        return $this->hasOne(AddressInfo::class, 'user_id', 'id');
    }
    public function healthInfo()
    {
        return $this->hasOne(HealthInfo::class, 'user_id', 'id');
    }

    public function disabilityInfo()
    {
        return $this->hasOne(DisabilityInfo::class, 'user_id', 'id');
    }

    public function freedomFighterInfo()
    {
        return $this->hasOne(FreedomFighterInfo::class, 'user_id', 'id');
    }

    public function julyFighterInfo()
    {
        return $this->hasOne(JulyFighterInfo::class, 'user_id', 'id');
    }

    public function educationInfos()
    {
        return $this->hasMany(EducationalInfo::class, 'user_id', 'id');
    }

    public function professionalInfos()
    {
        return $this->hasMany(ProfessionalInfo::class, 'user_id', 'id');
    }

    public function financialInfos()
    {
        return $this->hasMany(FinancialInfo::class, 'user_id', 'id');
    }

    public function propertyInfos()
    {
        return $this->hasMany(PropertyInfo::class, 'user_id', 'id');
    }

    public function citizenCertificate()
    {
        return $this->hasMany(CitizenCertificate::class, 'user_id', 'id');
    }

    public function characterCertificate()
    {
        return $this->hasMany(CharacterCertificate::class, 'user_id', 'id');
    }

    public function deathCertificate()
    {
        return $this->hasMany(DeathCertificate::class, 'user_id', 'id');
    }

    public function birthCertificate()
    {
        return $this->hasMany(BirthCertificate::class, 'user_id', 'id');
    }

    public function getAssignedAreaAttribute()
    {
        if (!$this->institute_id && !in_array($this->role_id, [2, 3])) return 'System Admin';

        // Priority 1: Use the manual 'area' text or structured area info
        if ($this->area) {
            if (str_contains($this->area, 'Thana:')) {
                $thanaId = str_replace('Thana:', '', $this->area);
                $thana = Thana::find($thanaId);
                return $thana ? "Thana: " . $thana->name : "Thana ID: " . $thanaId;
            }
            if (str_contains($this->area, 'District:')) {
                $districtId = str_replace('District:', '', $this->area);
                $district = District::find($districtId);
                return $district ? "District: " . $district->name : "District ID: " . $districtId;
            }
            if (str_contains($this->area, 'Union:')) {
                $id = trim(str_replace('Union:', '', $this->area));
                $union = Union::find($id);
                return $union ? "Union: " . $union->name : "Union ID: " . $id;
            }
            if (str_contains($this->area, 'Pourashava:')) {
                $id = trim(str_replace('Pourashava:', '', $this->area));
                $p = Pourashava::find($id);
                return $p ? "Pourashava: " . $p->name : "Pourashava ID: " . $id;
            }
            if (str_contains($this->area, 'City Corp:')) {
                $id = trim(str_replace('City Corp:', '', $this->area));
                $c = CityCorporation::find($id);
                return $c ? "City Corp: " . $c->name : "City Corp ID: " . $id;
            }
            return $this->area;
        }
        
        $institute = $this->institute;
        if (!$institute) return in_array($this->role_id, [2, 3]) ? 'Administrative Area' : 'Institutional Admin';

        // Priority 2: Try to fetch names from relationships if manual area is empty
        if ($institute->union_id && $institute->union) {
            return "Union: " . $institute->union->name;
        }
        if ($institute->pourashava_id && $institute->pourashava) {
            return "Pourashava: " . $institute->pourashava->name;
        }
        if ($institute->city_corporation_id && $institute->cityCorporation) {
            return "City Corp: " . $institute->cityCorporation->name;
        }

        return 'Institutional Admin';
    }

    public function scopeApplyMultitenancy($query)
    {
        $user = auth()->user();
        if (!$user) return $query;
        
        // Superadmins see everything
        if (is_superadmin()) return $query;

        // If user has an institute_id, filter by that or geographical area
        if ($user->institute_id) {
            $institute = $user->institute;
            return $query->where(function($q) use ($institute) {
                // Strict institute check
                $q->where('institute_id', $institute->id);
                
                // Address-based check (Only for Citizens/People, not for Staff/Operators)
                // We check if the query is not specifically for staff roles (1-4, 6, 8, 10, etc.)
                $locationId = $institute->union_id ?? ($institute->pourashava_id ?? $institute->city_corporation_id);
                if ($locationId) {
                    $q->orWhere(function($sq) use ($locationId) {
                        $sq->whereNull('role_id') // Likely a citizen
                           ->orWhereIn('role_id', [5]) // Standard "User" role
                           ->whereHas('addressInfo', function($asq) use ($locationId) {
                                $asq->where('permanent_union_id', $locationId);
                           });
                    });
                }
            });
        }

        // Handle high-level admins (ENO/DC) who filter by Thana or District
        if ($user->area) {
            if (str_contains($user->area, 'Thana:')) {
                $thanaId = str_replace('Thana:', '', $user->area);
                return $query->where(function($q) use ($thanaId) {
                    $q->whereHas('institute.union', function($sq) use ($thanaId) {
                        $sq->where('thana_id', $thanaId);
                    })->orWhere(function($sq) use ($thanaId) {
                        $sq->where(function($rsq) {
                            $rsq->whereNull('role_id')->orWhereIn('role_id', [5]);
                        })->whereHas('addressInfo', function($asq) use ($thanaId) {
                            $asq->where('permanent_thana_id', $thanaId);
                        });
                    });
                });
            }
            
            if (str_contains($user->area, 'District:')) {
                $districtId = str_replace('District:', '', $user->area);
                return $query->where(function($q) use ($districtId) {
                    $q->whereHas('institute.union.thana', function($sq) use ($districtId) {
                        $sq->where('district_id', $districtId);
                    })->orWhere(function($sq) use ($districtId) {
                        $sq->where(function($rsq) {
                            $rsq->whereNull('role_id')->orWhereIn('role_id', [5]);
                        })->whereHas('addressInfo', function($asq) use ($districtId) {
                            $asq->where('permanent_district_id', $districtId);
                        });
                    });
                });
            }
        }

        // If no filtering criteria found, but user is not superadmin, restrict them to themselves at least
        return $query->where('id', $user->id);
    }
}
