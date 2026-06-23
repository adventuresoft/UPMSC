<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VillageCourt;
use App\Models\People;
use App\Models\Institute;
use App\Models\Division;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class VillageCourtPublicController extends Controller
{
    public function create()
    {
        $data['divisions'] = Division::orderBy('name', 'asc')->get();
        // Return public frontend view
        return view('frontend.pages.village_court.create', $data);
    }

    private function createOutsiderUserAndPeople($name, $mobile, $nid, $fatherName, $address, $instituteId, $roleId = 5)
    {
        $user = new \App\Models\User();
        $user->institute_id = $instituteId;
        $user->role_id = $roleId;
        $user->name = $name;
        $user->mobile = $mobile;
        $user->status = 1;
        $user->save();

        $people = new \App\Models\People();
        $people->user_id = $user->id;
        $people->name = $name;
        $people->mobile = $mobile;
        $people->nid = $nid;
        $people->approved_id = 'OUTSIDER-' . time() . rand(10,99);
        $people->save();

        if ($fatherName) {
            $familyInfo = new \App\Models\People\FamilyInfo();
            $familyInfo->user_id = $user->id;
            $familyInfo->father_name = $fatherName;
            $familyInfo->save();
        }

        return ['user_id' => $user->id, 'people_id' => $people->id];
    }

    public function store(Request $request)
    {
        $request->validate([
            'target_union_id' => 'required|exists:unions,id',
            'case_date' => 'required|date|before_or_equal:today',
            'case_time' => 'required',
            'case_category' => 'required|string',
            'case_type_details' => 'required|string',
            'badi_name' => 'required',
            'badi_mobile' => 'required',
            'bibadi_name' => 'required|array',
            'bibadi_name.0' => 'required',
        ]);

        // Find or create the institute for the selected union
        $institute = Institute::firstOrNew(['union_id' => $request->target_union_id]);
        if (!$institute->exists) {
            $institute->institute_category_id = 1;
            $institute->institute_type_id = 1;
            $institute->save();
        }
        $instituteId = $institute->id;

        // Badi is always outsider for public form
        $badi_outsider = $this->createOutsiderUserAndPeople(
            $request->badi_name, 
            $request->badi_mobile, 
            $request->badi_nid ?? '', 
            $request->badi_father_name ?? '',
            $request->badi_address ?? '',
            $instituteId
        );
        $badi_id = $badi_outsider['people_id'];

        $bibadi_ids = [];
        if ($request->has('bibadi_name')) {
            foreach ($request->bibadi_name as $index => $name) {
                if (!empty($name)) {
                    $outsider = $this->createOutsiderUserAndPeople(
                        $name,
                        $request->bibadi_mobile[$index] ?? '',
                        $request->bibadi_nid[$index] ?? '',
                        $request->bibadi_father_name[$index] ?? '',
                        $request->bibadi_address[$index] ?? '',
                        $instituteId
                    );
                    $bibadi_ids[] = $outsider['people_id'];
                }
            }
        }

        $shakkhi_ids = [];
        if ($request->has('shakkhi_name')) {
            foreach ($request->shakkhi_name as $index => $name) {
                if (!empty($name)) {
                    $outsider = $this->createOutsiderUserAndPeople(
                        $name,
                        $request->shakkhi_mobile[$index] ?? '',
                        $request->shakkhi_nid[$index] ?? '',
                        $request->shakkhi_father_name[$index] ?? '',
                        $request->shakkhi_address[$index] ?? '',
                        $instituteId
                    );
                    $shakkhi_ids[] = $outsider['people_id'];
                }
            }
        }

        $villageCourt = new VillageCourt();
        $villageCourt->institute_id = $instituteId;
        $villageCourt->badi_id = $badi_id;
        $villageCourt->bibadi_ids = $bibadi_ids;
        $villageCourt->shakkhi_ids = $shakkhi_ids;
        $villageCourt->case_category = $request->case_category;
        $villageCourt->case_type_details = $request->case_type_details;
        $villageCourt->ovijog_er_biboron = $request->ovijog_er_biboron;
        $villageCourt->ghotona_sombolito = $request->ghotona_sombolito;
        $villageCourt->case_date = $request->case_date;
        $villageCourt->case_time = $request->case_time;
        $villageCourt->status = 'pending';
        
        $villageCourt->case_no = IdGenerator::generate(['table' => 'village_courts', 'field' => 'case_no', 'length' => 10, 'prefix' => 'VC-' . date("Y")]);

        $villageCourt->save();

        // Log Filing History
        \App\Models\VillageCourtHistory::create([
            'village_court_id' => $villageCourt->id,
            'action' => 'filed',
            'description' => 'মামলা অনলাইনে রুজু করা হয়েছে এবং বিরোধ নিষ্পত্তির উদ্যোগ নেওয়া হয়েছে।',
        ]);

        return redirect()->back()->with('success', 'আপনার মামলাটি সফলভাবে দায়ের করা হয়েছে।');
    }
}
