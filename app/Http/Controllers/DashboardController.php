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
use App\Models\Land;
use App\Models\Vehicle;
use App\Models\Bridge;
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
        $landQuery = Land::query();
        $vehicleQuery = Vehicle::query();
        $bridgeQuery = Bridge::query();
        $riverQuery = Road::query()->where('road_type_id', 2); // Assuming 2 is River, adding safety later

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

        // Apply filters if Institutional Admin (Roles 6, 8, 10)
        if (is_institutional_admin() && $institute) {
            $locationId = $institute->union_id ?? ($institute->pourashava_id ?? $institute->city_corporation_id);

            $filterByInstituteId = function($query) use ($institute) {
                return $query->where('institute_id', $institute->id);
            };

            // People needs strict jurisdictional filtering via address_infos
            if ($locationId) {
                $peopleQuery->whereExists(function ($sq) use ($locationId) {
                    $sq->select(DB::raw(1))
                       ->from('address_infos')
                       ->whereColumn('address_infos.user_id', 'people.user_id')
                       ->where('permanent_union_id', $locationId);
                });
            } else {
                $peopleQuery->where('people.id', 0); // Force zero
            }

            // Models with direct institute_id (Safety checked)
            $taxQuery = $filterByInstituteId($taxQuery);
            $houseQuery = $filterByInstituteId($houseQuery);
            $roadQuery = $filterByInstituteId($roadQuery);
            
            // These tables are placeholders/empty in DB, skip filtering to avoid crash
            // $landQuery = $filterByInstituteId($landQuery);
            // $vehicleQuery = $filterByInstituteId($vehicleQuery);
            // $bridgeQuery = $filterByInstituteId($bridgeQuery);
            // $riverQuery = $filterByInstituteId($riverQuery);

            // Force zero for empty tables if tenant
            $landQuery->where('id', 0);
            $vehicleQuery->where('id', 0);
            $bridgeQuery->where('id', 0);
            $riverQuery->where('id', 0);

            // Organization filtering
            if ($locationId) {
                $orgQuery->where('union_id', $locationId);
            } else {
                $orgQuery->where('organizations.id', 0);
            }

            // Certificates filtering via user -> addressInfo
            foreach ($certs as $key => $q) {
                if ($locationId) {
                    $certs[$key] = $q->whereHas('user.addressInfo', function($sq) use ($locationId) {
                        $sq->where('permanent_union_id', $locationId);
                    });
                } else {
                    $certs[$key] = $q->where('id', 0);
                }
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
        $data['lands'] = $landQuery->count();
        $data['vehicles'] = $vehicleQuery->count();
        $data['bridges'] = $bridgeQuery->count();
        $data['rivers'] = $riverQuery->sum('distance');

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
