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
use App\Models\Pourashava;
use App\Models\Union;
use App\Models\CityCorporation;
use App\Models\Upazilla;
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
        if ($this->area === 'All') {
            return 'All System Areas';
        }

        if (!$this->institute_id && !in_array($this->role_id, [2, 3])) return 'System Admin';

        // Priority 1: Use the manual 'area' text or structured area info
        if ($this->area) {
            if (str_contains($this->area, 'Upazilla:')) {
                $upazillaId = str_replace('Upazilla:', '', $this->area);
                $upazilla = Upazilla::find($upazillaId);
                return $upazilla ? $upazilla->name : "Upazilla ID: " . $upazillaId;
            }
            if (str_contains($this->area, 'District:')) {
                $districtId = str_replace('District:', '', $this->area);
                $district = District::find($districtId);
                return $district ? $district->name : "District ID: " . $districtId;
            }
            if (str_contains($this->area, 'Union:')) {
                $id = trim(str_replace('Union:', '', $this->area));
                $union = Union::find($id);
                return $union ? $union->name : "Union ID: " . $id;
            }
            if (str_contains($this->area, 'Pourashava:')) {
                $id = trim(str_replace('Pourashava:', '', $this->area));
                $p = Pourashava::find($id);
                return $p ? $p->name : "Pourashava ID: " . $id;
            }
            if (str_contains($this->area, 'City Corp:')) {
                $id = trim(str_replace('City Corp:', '', $this->area));
                $c = CityCorporation::find($id);
                return $c ? $c->name : "City Corp ID: " . $id;
            }
            return $this->area;
        }
        
        $institute = $this->institute;
        if (!$institute) return in_array($this->role_id, [2, 3]) ? 'Administrative Area' : 'Institutional Admin';

        // Priority 2: Try to fetch names from relationships if manual area is empty
        if ($institute->union_id && $institute->union) {
            return $institute->union->name;
        }
        if ($institute->pourashava_id && $institute->pourashava) {
            return $institute->pourashava->name;
        }
        if ($institute->city_corporation_id && $institute->cityCorporation) {
            return $institute->cityCorporation->name;
        }

        return 'Institutional Admin';
    }

    public function scopeApplyMultitenancy($query)
    {
        $user = auth()->user();
        if (!$user) return $query;

        // Superadmins or users with "All" area assigned see everything
        if (is_superadmin() || $user->area === 'All') return $query;

        // Union Admin should only see applicants whose permanent union matches their assigned union
        if ($user->role_id == 6 && $user->area) {
            $locationId = $this->resolveAreaLocationId($user->area);
            if ($locationId) {
                return $query->whereHas('addressInfo', function($asq) use ($locationId) {
                    $asq->where('permanent_union_id', $locationId);
                });
            }
        }

        // If user has an institute_id, filter by that or geographical area
        if ($user->institute_id) {
            $institute = $user->institute;
            $locationId = $institute->union_id ?? ($institute->pourashava_id ?? $institute->city_corporation_id);

            if (!$locationId && $user->area) {
                $locationId = $this->resolveAreaLocationId($user->area);
            }

            return $query->where(function($q) use ($institute, $locationId, $user) {
                $q->where(function($q1) use ($institute, $locationId, $user) {
                    // 1. Users explicitly assigned to this institute (both staff and citizens)
                    $q1->where('institute_id', $institute->id);

                    // 2. Citizens without an institute_id, but whose address falls in this area
                    if ($locationId) {
                        $q1->orWhere(function($sq) use ($locationId) {
                            $sq->whereNull('institute_id')
                               ->where(function($rsq) {
                                   $rsq->whereNull('role_id')->orWhereIn('role_id', [5]);
                               })
                               ->whereHas('addressInfo', function($asq) use ($locationId) {
                                   $asq->where(function($q_addr) use ($locationId) {
                                       $q_addr->where('permanent_union_id', $locationId)
                                              ->orWhere('present_union_id', $locationId);
                                   });
                               });
                        });
                    }

                    // 3. Creator bypass - always allow creators to see their own created users
                    $q1->orWhere('created_by', $user->id);
                });

                // STRICT CHECK: Citizens MUST belong to this union/area
                // Exception: citizens directly assigned to this institute always pass (e.g., via Nagorik Abedon)
                if ($locationId) {
                    $q->where(function($q2) use ($locationId, $institute) {
                        $q2->where('role_id', '!=', 5)
                           ->orWhereNull('role_id')
                           ->orWhere(function($q3) use ($locationId) {
                               $q3->where('role_id', 5)
                                  ->whereHas('addressInfo', function($asq) use ($locationId) {
                                      $asq->where(function($q_addr) use ($locationId) {
                                          $q_addr->where('permanent_union_id', $locationId)
                                                 ->orWhere('present_union_id', $locationId);
                                      });
                                  });
                           })
                           ->orWhere(function($q3) {
                               $q3->where('role_id', 5)
                                  ->doesntHave('addressInfo');
                           })
                           ->orWhere(function($q3) use ($institute) {
                               // Citizens directly assigned to this institute via Nagorik Abedon
                               $q3->where('role_id', 5)
                                  ->where('institute_id', $institute->id);
                           });
                    });
                }
            });
        }

        // Handle high-level admins (ENO/DC) or local/public reps (Councilor/Chairman) who filter by area
        if ($user->area) {
            $column = null;
            $locationIds = [];

            if (str_contains($user->area, 'Union:')) {
                $column = 'permanent_union_id';
                $locationIds = [str_replace('Union:', '', $user->area)];
            } elseif (str_contains($user->area, 'Pourashava:')) {
                $column = 'permanent_union_id'; // assuming pourashava uses the same column
                $locationIds = [str_replace('Pourashava:', '', $user->area)];
            } elseif (str_contains($user->area, 'City Corp:')) {
                $column = 'permanent_union_id'; // assuming city corp uses the same column
                $locationIds = [str_replace('City Corp:', '', $user->area)];
            } elseif (str_contains($user->area, 'Upazilla:')) {
                $upazillaId = str_replace('Upazilla:', '', $user->area);
                $column = 'permanent_thana_id';
                $locationIds = [$upazillaId];
            } elseif (str_contains($user->area, 'District:')) {
                $districtId = str_replace('District:', '', $user->area);
                $column = 'permanent_district_id';
                $locationIds = [$districtId];
            }

            if ($column && !empty($locationIds)) {
                $presentColumn = str_replace('permanent_', 'present_', $column);
                return $query->where(function($q) use ($column, $presentColumn, $locationIds, $user) {
                    
                    $q->where(function($q1) use ($column, $locationIds, $user) {
                        // 1. Users whose institute matches the area
                        $q1->whereHas('institute', function($instSq) use ($column, $locationIds) {
                            if ($column === 'permanent_union_id') {
                                $instSq->whereIn('union_id', $locationIds)
                                       ->orWhereIn('pourashava_id', $locationIds)
                                       ->orWhereIn('city_corporation_id', $locationIds);
                            } elseif ($column === 'permanent_thana_id') {
                                $instSq->whereHas('union', function($uSq) use ($locationIds) {
                                    $uSq->whereIn('thana_id', $locationIds);
                                });
                            } elseif ($column === 'permanent_district_id') {
                                $instSq->whereHas('union.upazilla', function($uSq) use ($locationIds) {
                                    $uSq->whereIn('district_id', $locationIds);
                                });
                            }
                        });

                        // 2. Citizens with NO institute, but whose address matches the area
                        $q1->orWhere(function($sq) use ($column, $locationIds) {
                            $sq->whereNull('institute_id')
                               ->where(function($rsq) {
                                   $rsq->whereNull('role_id')->orWhereIn('role_id', [5]);
                               })
                               ->whereHas('addressInfo', function($asq) use ($column, $presentColumn, $locationIds) {
                                   $asq->where(function($q_addr) use ($column, $presentColumn, $locationIds) {
                                       $q_addr->whereIn($column, $locationIds)
                                              ->orWhereIn($presentColumn, $locationIds);
                                   });
                               });
                        });

                        // 3. Creator bypass
                        $q1->orWhere('created_by', $user->id);
                    });

                    // STRICT CHECK: Citizens MUST belong to this area
                    $q->where(function($q2) use ($column, $locationIds) {
                        $q2->where('role_id', '!=', 5)
                           ->orWhereNull('role_id')
                           ->orWhere(function($q3) use ($column, $locationIds) {
                               $q3->where('role_id', 5)
                                  ->whereHas('addressInfo', function($asq) use ($column, $presentColumn, $locationIds) {
                                      $asq->where(function($q_addr) use ($column, $presentColumn, $locationIds) {
                                          $q_addr->whereIn($column, $locationIds)
                                                 ->orWhereIn($presentColumn, $locationIds);
                                      });
                                  });
                           })
                           ->orWhere(function($q3) {
                               $q3->where('role_id', 5)
                                  ->doesntHave('addressInfo');
                           });
                    });
                });
            }
        }

        // If no filtering criteria found, restrict to themselves and users they created
        return $query->where(function($q) use ($user) {
            $q->where('id', $user->id)->orWhere('created_by', $user->id);
        });
    }

    private function resolveAreaLocationId(string $area)
    {
        $area = trim(preg_replace('/\s*:\s*/', ':', $area));

        if (stripos($area, 'Union:') !== false) {
            return trim(str_ireplace('Union:', '', $area));
        }
        if (stripos($area, 'Pourashava:') !== false) {
            return trim(str_ireplace('Pourashava:', '', $area));
        }
        if (stripos($area, 'City Corp:') !== false) {
            return trim(str_ireplace('City Corp:', '', $area));
        }
        if (stripos($area, 'Upazilla:') !== false) {
            return trim(str_ireplace('Upazilla:', '', $area));
        }
        if (stripos($area, 'District:') !== false) {
            return trim(str_ireplace('District:', '', $area));
        }

        if (is_numeric($area)) {
            return trim($area);
        }

        $union = Union::where('name', $area)->orWhere('name', 'like', "%{$area}%")->first();
        if ($union) {
            return $union->id;
        }

        $pourashava = Pourashava::where('name', $area)->orWhere('name', 'like', "%{$area}%")->first();
        if ($pourashava) {
            return $pourashava->id;
        }

        $cityCorp = CityCorporation::where('name', $area)->orWhere('name', 'like', "%{$area}%")->first();
        if ($cityCorp) {
            return $cityCorp->id;
        }

        return null;
    }
}
