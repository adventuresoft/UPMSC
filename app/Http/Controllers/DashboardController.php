<?php

namespace App\Http\Controllers;

use App\Models\Certificate\AgeCertificate;
use App\Models\Certificate\BirthCertificate;
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
use App\Models\People;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Citizen Count (Role 5)
        $citizenQuery = People::applyMultitenancy();
        
        $data['users'] = $citizenQuery
            ->select('gender', DB::raw('COUNT(*) as count'))
            ->groupBy('gender')
            ->get();

        $data['applicant_count'] = User::whereNotIn('role_id', [1, 2, 3, 4])
            ->whereHas('people', function ($q) {
                $q->whereNull('approved_id');
            })
            ->applyMultitenancy()
            ->count();

        $data['approved_count'] = User::whereNotIn('role_id', [1, 2, 3, 4])
            ->whereHas('people', function ($q) {
                $q->whereNotNull('approved_id');
            })
            ->applyMultitenancy()
            ->count();

        // Module Counts with Multitenancy
        $data['taxes'] = Tax::applyMultitenancy()->count();
        $data['organizations'] = Organization::applyMultitenancy()->count();
        $data['houses'] = House::applyMultitenancy()->count();
        $data['roads'] = Road::applyMultitenancy()->sum('distance');
        $data['lands'] = Land::applyMultitenancy()->count();
        $data['vehicles'] = Vehicle::applyMultitenancy()->count();
        $data['bridges'] = Bridge::applyMultitenancy()->count();
        $data['rivers'] = Road::applyMultitenancy()->where('road_type_id', 2)->sum('distance');

        // Certificate Counts
        $certMappings = [
            'age_certificates' => AgeCertificate::class,
            'character_certificates' => CharacterCertificate::class,
            'childless_certificates' => ChildlessCertificate::class,
            'citizen_certificates' => CitizenCertificate::class,
            'disability_certificates' => DisabilityCertificate::class,
            'financial_instability_certificates' => FinancialInstabilityCertificate::class,
            'guardian_certificates' => GuardianCertificate::class,
            'landless_certificates' => LandlessCertificate::class,
            'married_certificates' => MarriedCertificate::class,
            'name_certificates' => NameCertificate::class,
            'nid_correction_certificates' => NidCorrectionCertificate::class,
            'orphan_certificates' => OrphanCertificate::class,
            'permanent_citizen_certificates' => PermanentCitizenCertificate::class,
            'remarried_certificates' => RemarriedCertificate::class,
            'residential_certificates' => ResidentialCertificate::class,
            'unmarried_certificates' => UnmarriedCertificate::class,
            'voter_area_certificates' => VoterAreaCertificate::class,
            'voter_list_certificates' => VoterListCertificate::class,
            'yearly_income_certificates' => YearlyIncomeCertificate::class,
            'succession_certificates' => \App\Models\Certificate\Succession::class,
            'death_certificates' => \App\Models\Certificate\DeathCertificate::class,
            'birth_certificates' => BirthCertificate::class,
        ];

        foreach ($certMappings as $key => $modelClass) {
            $data[$key] = $modelClass::applyMultitenancy()->count();
        }
        
        return view('backend.pages.index', $data);
    }
}
