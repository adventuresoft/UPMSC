<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CertificateVerifyController extends Controller
{
    
     protected $modelMap = [
        'citizen_certificates' => \App\Models\Certificate\CitizenCertificate::class,
        'character_certificates' => \App\Models\Certificate\CharacterCertificate::class,
        'successions' => \App\Models\Certificate\Succession::class,
        'death_certificates' => \App\Models\Certificate\DeathCertificate::class,
        'unmarried_certificates' => \App\Models\Certificate\UnmarriedCertificate::class,
        'married_certificates' => \App\Models\Certificate\MarriedCertificate::class,
        'remarried_certificates' => \App\Models\Certificate\RemarriedCertificate::class,
        'landless_certificates' => \App\Models\Certificate\LandlessCertificate::class,
        'name_certificates' => \App\Models\Certificate\NameCertificate::class,
        'yearly_income_certificates' => \App\Models\Certificate\YearlyIncomeCertificate::class,
        'disability_certificates' => \App\Models\Certificate\DisabilityCertificate::class,
        'voter_area_certificates' => \App\Models\Certificate\VoterAreaCertificate::class,
        'voter_list_certificates' => \App\Models\Certificate\VoterListCertificate::class,
        'nid_correction_certificates' => \App\Models\Certificate\NidCorrectionCertificate::class,
        'childless_certificates' => \App\Models\Certificate\ChildlessCertificate::class,
        'orphan_certificates' => \App\Models\Certificate\OrphanCertificate::class,
        'financial_instability_certificates' => \App\Models\Certificate\FinancialInstabilityCertificate::class,
        'age_certificates' => \App\Models\Certificate\AgeCertificate::class,
        'permanent_citizen_certificates' => \App\Models\Certificate\PermanentCitizenCertificate::class,
        'residential_certificates' => \App\Models\Certificate\ResidentialCertificate::class,
        'guardian_certificates' => \App\Models\Certificate\GuardianCertificate::class,
        'guardian_acceptance_certificates' => \App\Models\Certificate\GuardianAcceptanceCertificate::class,
        'inheritances' => \App\Models\Certificate\Inheritance::class,
        'birth_certificates' => \App\Models\Certificate\BirthCertificate::class,
    ];

    protected $viewMap = [
        'citizen_certificates' => 'citizen',
        'character_certificates' => 'character',
        'successions' => 'succession',
        'death_certificates' => 'death',
        'unmarried_certificates' => 'unmarried',
        'married_certificates' => 'married',
        'remarried_certificates' => 'remarried',
        'landless_certificates' => 'landless',
        'name_certificates' => 'name',
        'yearly_income_certificates' => 'yearly_income',
        'disability_certificates' => 'disability',
        'voter_area_certificates' => 'voter_area',
        'voter_list_certificates' => 'voter_list',
        'nid_correction_certificates' => 'nid_correction',
        'childless_certificates' => 'childless',
        'orphan_certificates' => 'orphan',
        'financial_instability_certificates' => 'financial_instability',
        'age_certificates' => 'age',
        'permanent_citizen_certificates' => 'permanent_citizen',
        'residential_certificates' => 'residential',
        'guardian_certificates' => 'guardian',
        'guardian_acceptance_certificates' => 'guardian_acceptance',
        'inheritances' => 'inheritance',
        'birth_certificates' => 'birth',
    ];
    
    public function index_backup()
    {
        return view('frontend.pages.certificate.verify');
    }
    
    private function toEnglishNumbers($string)
    {
        $bengali = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        return str_replace($bengali, $english, $string ?? '');
    }

    public function index(Request $request)
    {
        $system_id = $request->system_id;
        $data = null;
        
        if ($system_id) {

            $request->validate([
                'system_id' => 'required'
            ]);
            
            // Convert any Bengali numerals to English numerals and trim
            $english_system_id = $this->toEnglishNumbers(trim($request->system_id));
            
            // Remove accidental leading zeros
            $clean_id = ltrim($english_system_id, '0');
            
            // Extract code correctly based on format (ymd vs Ymd)
            if (strlen($clean_id) >= 13 && str_starts_with($clean_id, '20')) {
                // Ymd format (8 digits date + 2 digits code + serial)
                $code = substr($clean_id, 8, 2);
            } else {
                // ymd format (6 digits date + 2 digits code + serial)
                $code = substr($clean_id, 6, 2);
            }
            
            //  find table from certificate_types
            $type = DB::table('certificate_types')
                ->where('code', $code)
                ->first();

            if (!$type) {
                return back()->with('error', 'Invalid certificate code!');
            }

            $table = $type->table_name;

            $modelClass = $this->modelMap[$table] ?? null;
            
            if (!$modelClass) {
                return back()->with('error', 'Model not found!');
            }
            
            $data = $modelClass::with([
                'user.institute.union.thana.district',
                'user.people.profession',
                'user.people.professionCategory',
                'user.people.professionSubCategory',
                'user.people.professionType',
                'user.addressInfo.permanentVillage',
                'user.addressInfo.permanentUnion',
                'user.addressInfo.permanentThana',
                'user.addressInfo.permanentDistrict',
                'user.addressInfo.permanentPostOffice',
                'user.familyInfo',
            ])->where(function($q) use ($clean_id, $english_system_id) {
                $q->where('system_id', $english_system_id)
                  ->orWhere('system_id', $clean_id);
            })->first();

            if (!$data) {
                return back()->with('error', 'No certificate found!');
            }

            $system_id = $english_system_id;

        }

        return view('frontend.pages.certificate.verify', compact('data', 'system_id'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'system_id' => 'required'
        ]);
        
        // Convert any Bengali numerals to English numerals and trim
        $english_system_id = $this->toEnglishNumbers(trim($request->system_id));
        
        // Remove accidental leading zeros
        $clean_id = ltrim($english_system_id, '0');
        
        // Extract code correctly based on format (ymd vs Ymd)
        if (strlen($clean_id) >= 13 && str_starts_with($clean_id, '20')) {
            // Ymd format (8 digits date + 2 digits code + serial)
            $code = substr($clean_id, 8, 2);
        } else {
            // ymd format (6 digits date + 2 digits code + serial)
            $code = substr($clean_id, 6, 2);
        }
        
        //  find table from certificate_types
        $type = DB::table('certificate_types')
            ->where('code', $code)
            ->first();

        if (!$type) {
            return back()->with('error', 'Invalid certificate code!');
        }

        $table = $type->table_name;

        $modelClass = $this->modelMap[$table] ?? null;
        
        if (!$modelClass) {
            return back()->with('error', 'Model not found!');
        }
        
        $data = $modelClass::with([
            'user.institute.union.thana.district',
            'user.people',
            'user.familyInfo',
        ])->where(function($q) use ($clean_id, $english_system_id) {
            $q->where('system_id', $english_system_id)
              ->orWhere('system_id', $clean_id);
        })->first();

        if (!$data) {
            return back()->with('error', 'No certificate found!');
        }

        $system_id = $english_system_id;

        return view('frontend.pages.certificate.verify', compact('data', 'system_id'));
    }
}