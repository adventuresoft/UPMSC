<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VillageCourt;
use App\Models\People;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class VillageCourtController extends Controller
{
    public function index()
    {
        $data['cases'] = VillageCourt::with(['badi'])->applyMultitenancy()->where('status', 'pending')->latest()->get();
        $data['page_title'] = 'Case List (মামলার তালিকা)';
        $data['subMenu'] = 'VillageCourtList';
        return view('backend.pages.village_court.index', $data);
    }

    public function courtFormedList()
    {
        $data['cases'] = VillageCourt::with(['badi'])->applyMultitenancy()->where('status', 'court_formed')->latest()->get();
        $data['page_title'] = 'Adalot Gothon List (আদালত গঠন তালিকা)';
        $data['subMenu'] = 'VillageCourtAdalotGothon';
        return view('backend.pages.village_court.index', $data);
    }

    public function hearingList()
    {
        $data['cases'] = VillageCourt::with(['badi'])->applyMultitenancy()->where('status', 'hearing')->latest()->get();
        $data['page_title'] = 'Shunanir List (শুনানীর তালিকা)';
        $data['subMenu'] = 'VillageCourtShunani';
        return view('backend.pages.village_court.index', $data);
    }

    public function verdictList()
    {
        $data['cases'] = VillageCourt::with(['badi'])->applyMultitenancy()->where('status', 'decided')->latest()->get();
        $data['page_title'] = 'Ray Ghoshonar List (রায় ঘোষণার তালিকা)';
        $data['subMenu'] = 'VillageCourtRayGhoshona';
        return view('backend.pages.village_court.index', $data);
    }

    public function create()
    {
        // Select registered people from the logged-in union
        $data['people'] = People::whereNotNull('approved_id')
            ->with('user')
            ->applyMultitenancy()
            ->get();
        return view('backend.pages.village_court.create', $data);
    }

    private function createOutsiderUserAndPeople($name, $mobile, $nid, $fatherName, $roleId = 5)
    {
        $instituteId = Auth::user()->institute_id;
        
        $user = new \App\Models\User();
        $user->institute_id = $instituteId;
        $user->role_id = $roleId;
        $user->name = $name;
        $user->mobile = $mobile;
        $user->status = 1;
        $user->created_by = Auth::id();
        $user->save();

        $people = new \App\Models\People();
        $people->user_id = $user->id;
        $people->name = $name;
        $people->mobile = $mobile;
        $people->nid = $nid;
        $people->approved_id = 'OUTSIDER-' . time() . rand(10,99);
        $people->created_by = Auth::id();
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
        $minDate = date('Y-m-d', strtotime('-30 days'));
        if ($request->case_category === 'দ্বিতীয় অংশ : দেওয়ানী মামলাসমূহ') {
            if (strpos($request->case_type_details, '৩। স্থাবর সম্পত্তি বেদখল হওয়ার') !== false) {
                $minDate = date('Y-m-d', strtotime('-1 year'));
            } else {
                $minDate = date('Y-m-d', strtotime('-60 days'));
            }
        }

        $request->validate([
            'badi_is_union' => 'required',
            'badi_id' => 'required_if:badi_is_union,1',
            'badi_name' => 'required_if:badi_is_union,0',
            'bibadi_is_union' => 'required|array',
            'case_date' => 'required|date|before_or_equal:today|after_or_equal:' . $minDate,
            'case_time' => 'required',
            'case_category' => 'required|string',
            'case_type_details' => 'required|string',
            'ovijog_er_biboron' => 'nullable|string',
        ]);

        $badi_id = $request->badi_id;
        if ($request->badi_is_union == '0') {
            $outsider = $this->createOutsiderUserAndPeople(
                $request->badi_name, 
                $request->badi_mobile, 
                $request->badi_nid, 
                $request->badi_father_name,
                $request->badi_address
            );
            $badi_id = $outsider['people_id'];
        }

        $bibadi_ids = [];
        if ($request->has('bibadi_is_union')) {
            foreach ($request->bibadi_is_union as $index => $isUnion) {
                if ($isUnion == '1') {
                    if (!empty($request->bibadi_ids[$index])) {
                        $bibadi_ids[] = $request->bibadi_ids[$index];
                    }
                } else {
                    if (!empty($request->bibadi_name[$index])) {
                        $outsider = $this->createOutsiderUserAndPeople(
                            $request->bibadi_name[$index],
                            $request->bibadi_mobile[$index] ?? '',
                            $request->bibadi_nid[$index] ?? '',
                            $request->bibadi_father_name[$index] ?? '',
                            $request->bibadi_address[$index] ?? ''
                        );
                        $bibadi_ids[] = $outsider['people_id'];
                    }
                }
            }
        }

        $shakkhi_ids = [];
        if ($request->has('shakkhi_is_union')) {
            foreach ($request->shakkhi_is_union as $index => $isUnion) {
                if ($isUnion == '1') {
                    if (!empty($request->shakkhi_ids[$index])) {
                        $shakkhi_ids[] = $request->shakkhi_ids[$index];
                    }
                } else {
                    if (!empty($request->shakkhi_name[$index])) {
                        $outsider = $this->createOutsiderUserAndPeople(
                            $request->shakkhi_name[$index],
                            $request->shakkhi_mobile[$index] ?? '',
                            $request->shakkhi_nid[$index] ?? '',
                            $request->shakkhi_father_name[$index] ?? '',
                            $request->shakkhi_address[$index] ?? ''
                        );
                        $shakkhi_ids[] = $outsider['people_id'];
                    }
                }
            }
        }

        $villageCourt = new VillageCourt();
        $villageCourt->institute_id = Auth::user()->institute_id;
        $villageCourt->badi_id = $badi_id;
        $villageCourt->bibadi_ids = $bibadi_ids;
        $villageCourt->shakkhi_ids = $shakkhi_ids;
        $villageCourt->case_category = $request->case_category;
        $villageCourt->case_type_details = $request->case_type_details;
        $villageCourt->ovijog_er_biboron = $request->ovijog_er_biboron;
        $villageCourt->ghotona_sombolito = $request->ghotona_sombolito;
        $villageCourt->case_date = $request->case_date;
        $villageCourt->case_time = $request->case_time;
        $villageCourt->created_by = Auth::id();
        $villageCourt->status = 'pending';
        
        $villageCourt->case_no = IdGenerator::generate(['table' => 'village_courts', 'field' => 'case_no', 'length' => 10, 'prefix' => 'VC-' . date("Y")]);

        $villageCourt->save();

        // Log Filing History
        \App\Models\VillageCourtHistory::create([
            'village_court_id' => $villageCourt->id,
            'action' => 'filed',
            'description' => 'মামলা রুজু করা হয়েছে এবং বিরোধ নিষ্পত্তির উদ্যোগ নেওয়া হয়েছে।',
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('village-court.show', $villageCourt->id)->with('success', 'Case created successfully.');
    }

    public function show($id)
    {
        $data['case'] = VillageCourt::with([
            'badi.familyInfo', 
            'badi.user.addressInfo.permanentVillage', 
            'badi.user.addressInfo.permanentUnion', 
            'badi.user.addressInfo.permanentThana', 
            'badi.user.addressInfo.permanentDistrict',
            'panelHead',
            'badiUpMember',
            'badiCitizen',
            'bibadiUpMember',
            'bibadiCitizen',
            'histories.creator'
        ])->findOrFail($id);

        return view('backend.pages.village_court.show', $data);
    }

    public function formCourtView($id)
    {
        $data['case'] = VillageCourt::findOrFail($id);
        
        $unionId = Auth::user()->institute->union_id ?? null;

        // Fetch UP Members (Council Members designation = 2/UP Member or active ones)
        $data['up_members'] = \App\Models\CouncilMember::with('user')
            ->whereHas('council', function($q) use ($unionId) {
                $q->where('union_id', $unionId)->where('status', 1);
            })
            ->get()
            ->pluck('user')
            ->filter()
            ->unique('id');

        // Fallback to all union users if no council members set up
        if ($data['up_members']->isEmpty()) {
            $data['up_members'] = \App\Models\User::where('institute_id', Auth::user()->institute_id)
                ->whereIn('role_id', [6, 7]) // Union Admin, Union User
                ->get();
        }

        // Fetch Chairman options (designation = 1 or active users with role_id = 6)
        $data['chairmen'] = \App\Models\CouncilMember::with('user')
            ->whereHas('council', function($q) use ($unionId) {
                $q->where('union_id', $unionId)->where('status', 1);
            })
            ->where('concilor_designation_id', 1)
            ->get()
            ->pluck('user')
            ->filter();

        if ($data['chairmen']->isEmpty()) {
            $data['chairmen'] = \App\Models\User::where('institute_id', Auth::user()->institute_id)
                ->where('role_id', 6)
                ->get();
        }

        // Fetch registered people/citizens
        $data['people'] = People::whereNotNull('approved_id')
            ->with('user')
            ->applyMultitenancy()
            ->get();

        return view('backend.pages.village_court.form_court', $data);
    }

    public function formCourt(Request $request, $id)
    {
        $request->validate([
            'panel_head_id' => 'required|exists:users,id',
            'badi_up_member_is_union' => 'required',
            'badi_up_member_id' => 'required_if:badi_up_member_is_union,1',
            'badi_up_member_name' => 'required_if:badi_up_member_is_union,0',
            'badi_citizen_is_union' => 'required',
            'badi_citizen_id' => 'required_if:badi_citizen_is_union,1',
            'badi_citizen_name' => 'required_if:badi_citizen_is_union,0',
            'bibadi_up_member_is_union' => 'required',
            'bibadi_up_member_id' => 'required_if:bibadi_up_member_is_union,1',
            'bibadi_up_member_name' => 'required_if:bibadi_up_member_is_union,0',
            'bibadi_citizen_is_union' => 'required',
            'bibadi_citizen_id' => 'required_if:bibadi_citizen_is_union,1',
            'bibadi_citizen_name' => 'required_if:bibadi_citizen_is_union,0',
        ]);

        $badi_up_member_id = $request->badi_up_member_id;
        if ($request->badi_up_member_is_union == '0') {
            $outsider = $this->createOutsiderUserAndPeople(
                $request->badi_up_member_name,
                $request->badi_up_member_mobile,
                $request->badi_up_member_nid,
                null,
                $request->badi_up_member_address,
                7 // generic union user role for outside UP member
            );
            $badi_up_member_id = $outsider['user_id'];
        }

        $badi_citizen_id = $request->badi_citizen_id;
        if ($request->badi_citizen_is_union == '0') {
            $outsider = $this->createOutsiderUserAndPeople(
                $request->badi_citizen_name,
                $request->badi_citizen_mobile,
                $request->badi_citizen_nid,
                $request->badi_citizen_father_name,
                $request->badi_citizen_address
            );
            $badi_citizen_id = $outsider['people_id'];
        }

        $bibadi_up_member_id = $request->bibadi_up_member_id;
        if ($request->bibadi_up_member_is_union == '0') {
            $outsider = $this->createOutsiderUserAndPeople(
                $request->bibadi_up_member_name,
                $request->bibadi_up_member_mobile,
                $request->bibadi_up_member_nid,
                null,
                $request->bibadi_up_member_address,
                7
            );
            $bibadi_up_member_id = $outsider['user_id'];
        }

        $bibadi_citizen_id = $request->bibadi_citizen_id;
        if ($request->bibadi_citizen_is_union == '0') {
            $outsider = $this->createOutsiderUserAndPeople(
                $request->bibadi_citizen_name,
                $request->bibadi_citizen_mobile,
                $request->bibadi_citizen_nid,
                $request->bibadi_citizen_father_name,
                $request->bibadi_citizen_address
            );
            $bibadi_citizen_id = $outsider['people_id'];
        }

        $case = VillageCourt::findOrFail($id);
        $case->panel_head_id = $request->panel_head_id;
        $case->badi_up_member_id = $badi_up_member_id;
        $case->badi_citizen_id = $badi_citizen_id;
        $case->bibadi_up_member_id = $bibadi_up_member_id;
        $case->bibadi_citizen_id = $bibadi_citizen_id;
        $case->status = 'court_formed';
        $case->save();

        // Get Nominations Names for History
        $panelHead = \App\Models\User::find($request->panel_head_id)->name ?? '';
        $badiUP = \App\Models\User::find($badi_up_member_id)->name ?? '';
        $badiCit = \App\Models\People::find($badi_citizen_id)->name ?? '';
        $bibadiUP = \App\Models\User::find($bibadi_up_member_id)->name ?? '';
        $bibadiCit = \App\Models\People::find($bibadi_citizen_id)->name ?? '';

        \App\Models\VillageCourtHistory::create([
            'village_court_id' => $case->id,
            'action' => 'court_formed',
            'description' => "আদালত ও প্যানেল গঠিত হয়েছে। প্যানেল প্রধান: {$panelHead}। বাদী মনোনীত: {$badiUP} (ইউপি সদস্য), {$badiCit} (নাগরিক)। বিবাদী মনোনীত: {$bibadiUP} (ইউপি সদস্য), {$bibadiCit} (নাগরিক)।",
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('village-court.show', $case->id)->with('success', 'Court formed successfully.');
    }

    public function hearingView($id)
    {
        $data['case'] = VillageCourt::findOrFail($id);
        return view('backend.pages.village_court.hearing', $data);
    }

    public function hearing(Request $request, $id)
    {
        $request->validate([
            'hearing_notes' => 'required|string',
            'hajir_date' => 'required|date|after_or_equal:today',
            'hajir_time' => 'required',
            'sunani_date' => 'required|date|after_or_equal:today',
            'sunani_time' => 'required',
        ]);

        $case = VillageCourt::findOrFail($id);
        
        $desc = "শুনানি পরিচালনা করা হয়েছে। বিবরণ: " . $request->hearing_notes;

        if ($request->sunani_date && $request->hajir_date) {
            $case->sunani_date = $request->sunani_date;
            $case->sunani_time = $request->sunani_time;
            $case->hajir_date = $request->hajir_date;
            $case->hajir_time = $request->hajir_time;
            $case->status = 'hearing';
            $case->save();
            $desc .= "। হাজিরার তারিখ: " . date('d-m-Y', strtotime($request->hajir_date)) . " সময়: " . \Carbon\Carbon::parse($request->hajir_time)->format('h:i A') . "। শুনানির তারিখ নির্ধারণ করা হয়েছে: " . date('d-m-Y', strtotime($request->sunani_date)) . " সময়: " . \Carbon\Carbon::parse($request->sunani_time)->format('h:i A') . "।";
        } else {
            $case->status = 'hearing';
            $case->save();
        }

        \App\Models\VillageCourtHistory::create([
            'village_court_id' => $case->id,
            'action' => 'hearing_conducted',
            'description' => $desc,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('village-court.show', $case->id)->with('success', 'Hearing details saved successfully.');
    }

    public function verdictView($id)
    {
        $data['case'] = VillageCourt::findOrFail($id);
        return view('backend.pages.village_court.verdict', $data);
    }

    public function declareVerdict(Request $request, $id)
    {
        $request->validate([
            'verdict' => 'required|string',
            'verdict_date' => 'required|date',
        ]);

        $case = VillageCourt::findOrFail($id);
        $case->verdict = $request->verdict;
        $case->verdict_date = $request->verdict_date;
        $case->status = 'decided';
        $case->save();

        \App\Models\VillageCourtHistory::create([
            'village_court_id' => $case->id,
            'action' => 'verdict_declared',
            'description' => 'রায়ের অনুলিপি প্রকাশ: ' . $request->verdict . ' (তারিখ: ' . date('d-m-Y', strtotime($request->verdict_date)) . ')',
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('village-court.show', $case->id)->with('success', 'Verdict declared successfully.');
    }

    public function printNotice($id, $type, $refId = null)
    {
        $case = VillageCourt::with([
            'badi.familyInfo', 'badi.user.addressInfo.permanentVillage', 'badi.user.addressInfo.permanentUnion', 'badi.user.addressInfo.permanentThana', 'badi.user.addressInfo.permanentDistrict',
            'panelHead', 'badiUpMember', 'badiCitizen', 'bibadiUpMember', 'bibadiCitizen'
        ])->findOrFail($id);

        $data['case'] = $case;
        $data['type'] = $type;
        $data['refId'] = $refId;
        
        return view('backend.pages.village_court.print', $data);
    }

    public function edit($id)
    {
        $data['case'] = VillageCourt::findOrFail($id);
        $data['people'] = People::whereNotNull('approved_id')
            ->with('user')
            ->applyMultitenancy()
            ->get();
        return view('backend.pages.village_court.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $villageCourt = VillageCourt::findOrFail($id);
        $caseDate = $villageCourt->case_date ? $villageCourt->case_date->format('Y-m-d') : date('Y-m-d');
        $baseMinDate = date('Y-m-d', strtotime('-30 days'));
        if ($request->case_category === 'দ্বিতীয় অংশ : দেওয়ানী মামলাসমূহ') {
            if (strpos($request->case_type_details, '৩। স্থাবর সম্পত্তি বেদখল হওয়ার') !== false) {
                $baseMinDate = date('Y-m-d', strtotime('-1 year'));
            } else {
                $baseMinDate = date('Y-m-d', strtotime('-60 days'));
            }
        }
        $minDate = min($baseMinDate, $caseDate);

        $request->validate([
            'badi_id' => 'required|exists:people,id',
            'bibadi_ids' => 'required|array',
            'bibadi_ids.*' => 'exists:people,id',
            'case_date' => 'required|date|before_or_equal:today|after_or_equal:' . $minDate,
            'case_time' => 'required',
            'case_category' => 'required|string',
            'case_type_details' => 'required|string',
            'ovijog_er_biboron' => 'nullable|string',
            'shakkhi_ids' => 'nullable|array',
        ]);

        $villageCourt->badi_id = $request->badi_id;
        $villageCourt->bibadi_ids = $request->bibadi_ids;
        $villageCourt->shakkhi_ids = $request->shakkhi_ids;
        $villageCourt->case_category = $request->case_category;
        $villageCourt->case_type_details = $request->case_type_details;
        $villageCourt->ovijog_er_biboron = $request->ovijog_er_biboron;
        $villageCourt->ghotona_sombolito = $request->ghotona_sombolito;
        $villageCourt->case_date = $request->case_date;
        $villageCourt->case_time = $request->case_time;
        $villageCourt->updated_by = Auth::id();
        $villageCourt->save();

        return redirect()->route('village-court.index')->with('success', 'Case updated successfully.');
    }

    public function destroy($id)
    {
        $villageCourt = VillageCourt::findOrFail($id);
        $villageCourt->delete();
        return redirect()->route('village-court.index')->with('success', 'Case deleted successfully.');
    }
}
