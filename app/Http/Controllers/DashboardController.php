<?php

namespace App\Http\Controllers;

use App\Models\Certificate\AgeCertificate;
use App\Models\Certificate\CharacterCertificate;
use App\Models\Certificate\ChildlessCertificate;
use App\Models\Certificate\CitizenCertificate;
use App\Models\Certificate\DisabilityCertificate;
use App\Models\Certificate\FinancialInstabilityCertificate;
use App\Models\Certificate\GuardianCertificate;
use App\Models\Certificate\LandlessCertificate;
use App\Models\Certificate\MarriedCertificate;
use App\Models\Certificate\NameCertificate;
use App\Models\Certificate\NidCorrectionCertificate;
use App\Models\Certificate\OrphanCertificate;
use App\Models\Certificate\PermanentCitizenCertificate;
use App\Models\Certificate\RemarriedCertificate;
use App\Models\Certificate\ResidentialCertificate;
use App\Models\Certificate\UnmarriedCertificate;
use App\Models\Certificate\VoterAreaCertificate;
use App\Models\Certificate\VoterListCertificate;
use App\Models\Certificate\YearlyIncomeCertificate;
use App\Models\House;
use App\Models\Organization\Organization;
use App\Models\Road;
use App\Models\Tax\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $institute = $user->institute;

        // Base queries
        $peopleQuery = DB::table('people');
        $taxQuery = Tax::query();
        $orgQuery = Organization::query();
        $houseQuery = House::query();
        $roadQuery = Road::query();

        // Certificate Queries
        $certs = [
            'age' => AgeCertificate::query(),
            'character' => CharacterCertificate::query(),
            'childless' => ChildlessCertificate::query(),
            'citizen' => CitizenCertificate::query(),
            'disability' => DisabilityCertificate::query(),
            'financial' => FinancialInstabilityCertificate::query(),
            'guardian' => GuardianCertificate::query(),
            'landless' => LandlessCertificate::query(),
            'married' => MarriedCertificate::query(),
            'name' => NameCertificate::query(),
            'nid' => NidCorrectionCertificate::query(),
            'orphan' => OrphanCertificate::query(),
            'permanent' => PermanentCitizenCertificate::query(),
            'remarried' => RemarriedCertificate::query(),
            'residential' => ResidentialCertificate::query(),
            'unmarried' => UnmarriedCertificate::query(),
            'voter_area' => VoterAreaCertificate::query(),
            'voter_list' => VoterListCertificate::query(),
            'yearly' => YearlyIncomeCertificate::query(),
        ];

        // Apply filters if Institutional Admin
        if ($user->role_id == 6 && $institute) {
            $filterByInstituteId = function($query) use ($institute) {
                return $query->where('institute_id', $institute->id);
            };

            $filterByLocation = function($query) use ($institute) {
                return $query->where(function($q) use ($institute) {
                    $q->whereHas('user', function($uq) use ($institute) {
                        $uq->where('institute_id', $institute->id);
                    });
                    
                    if ($institute->union_id) {
                        $q->orWhereHas('user.addressInfo', function($sq) use ($institute) {
                            $sq->where('permanent_union_id', $institute->union_id);
                        });
                    }
                });
            };

            // People needs special handling since it uses DB::table
            $peopleQuery->where(function($q) use ($institute) {
                $q->whereExists(function ($sq) use ($institute) {
                    $sq->select(DB::raw(1))
                       ->from('users')
                       ->whereColumn('users.id', 'people.user_id')
                       ->where('users.institute_id', $institute->id);
                });
                
                if ($institute->union_id) {
                    $q->orWhereExists(function ($sq) use ($institute) {
                        $sq->select(DB::raw(1))
                           ->from('address_infos')
                           ->whereColumn('address_infos.user_id', 'people.user_id')
                           ->where('permanent_union_id', $institute->union_id);
                    });
                }
            });

            // Models with direct institute_id
            $taxQuery = $filterByInstituteId($taxQuery);
            $houseQuery = $filterByInstituteId($houseQuery);
            $roadQuery = $filterByInstituteId($roadQuery);

            // Organization has union_id directly
            if ($institute->union_id) {
                $orgQuery->where('union_id', $institute->union_id);
            } else {
                $orgQuery->where('created_by', $user->id);
            }

            // Certificates use the filterByLocation (via user relationship)
            foreach ($certs as $key => $q) {
                $certs[$key] = $filterByLocation($q);
            }
        }

        $data['users'] = $peopleQuery
            ->select('gender', DB::raw('COUNT(*) as count'))
            ->groupBy('gender')
            ->get();
            
        $data['taxes'] = $taxQuery->count();
        $data['organizations'] = $orgQuery->count();
        $data['houses'] = $houseQuery->count();
        $data['roads'] = $roadQuery->sum('distance');

        $data['age_certificates'] = $certs['age']->count();
        $data['character_certificates'] = $certs['character']->count();
        $data['childless_certificates'] = $certs['childless']->count();
        $data['citizen_certificates'] = $certs['citizen']->count();
        $data['disability_certificates'] = $certs['disability']->count();
        $data['financial_instability_certificates'] = $certs['financial']->count();
        $data['guardian_certificates'] = $certs['guardian']->count();
        $data['landless_certificates'] = $certs['landless']->count();
        $data['married_certificates'] = $certs['married']->count();
        $data['name_certificates'] = $certs['name']->count();
        $data['nid_correction_certificates'] = $certs['nid']->count();
        $data['orphan_certificates'] = $certs['orphan']->count();
        $data['permanent_citizen_certificates'] = $certs['permanent']->count();
        $data['remarried_certificates'] = $certs['remarried']->count();
        $data['residential_certificates'] = $certs['residential']->count();
        $data['unmarried_certificates'] = $certs['unmarried']->count();
        $data['voter_area_certificates'] = $certs['voter_area']->count();
        $data['voter_list_certificates'] = $certs['voter_list']->count();
        $data['yearly_income_certificates'] = $certs['yearly']->count();
        
        // return response()->json($data, 200);
        return view('backend.pages.index', $data);
    }
}
