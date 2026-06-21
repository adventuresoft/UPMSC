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
        $data['cases'] = VillageCourt::with(['badi'])->applyMultitenancy()->latest()->get();
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

    public function store(Request $request)
    {
        $request->validate([
            'badi_id' => 'required|exists:people,id',
            'bibadi_ids' => 'required|array',
            'bibadi_ids.*' => 'exists:people,id',
            'case_date' => 'required|date|before_or_equal:today|after_or_equal:' . date('Y-m-d', strtotime('-30 days')),
            'case_time' => 'required',
            'ovijog_er_biboron' => 'nullable|string',
            'ghotona_sombolito' => 'nullable|string',
            'shakkhi_ids' => 'nullable|array',
        ]);

        $villageCourt = new VillageCourt();
        $villageCourt->institute_id = Auth::user()->institute_id;
        $villageCourt->badi_id = $request->badi_id;
        $villageCourt->bibadi_ids = $request->bibadi_ids;
        $villageCourt->shakkhi_ids = $request->shakkhi_ids;
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
            'badi_up_member_id' => 'required|exists:users,id',
            'badi_citizen_id' => 'required|exists:people,id',
            'bibadi_up_member_id' => 'required|exists:users,id',
            'bibadi_citizen_id' => 'required|exists:people,id',
            'sunani_date' => 'required|date|after_or_equal:today',
            'sunani_time' => 'required',
        ]);

        $case = VillageCourt::findOrFail($id);
        $case->panel_head_id = $request->panel_head_id;
        $case->badi_up_member_id = $request->badi_up_member_id;
        $case->badi_citizen_id = $request->badi_citizen_id;
        $case->bibadi_up_member_id = $request->bibadi_up_member_id;
        $case->bibadi_citizen_id = $request->bibadi_citizen_id;
        $case->hajir_date = $request->sunani_date;
        $case->hajir_time = $request->sunani_time;
        $case->sunani_date = $request->sunani_date;
        $case->sunani_time = $request->sunani_time;
        $case->status = 'court_formed';
        $case->save();

        // Get Nominations Names for History
        $panelHead = \App\Models\User::find($request->panel_head_id)->name;
        $badiUP = \App\Models\User::find($request->badi_up_member_id)->name;
        $badiCit = People::find($request->badi_citizen_id)->name;
        $bibadiUP = \App\Models\User::find($request->bibadi_up_member_id)->name;
        $bibadiCit = People::find($request->bibadi_citizen_id)->name;

        \App\Models\VillageCourtHistory::create([
            'village_court_id' => $case->id,
            'action' => 'court_formed',
            'description' => "আদালত ও প্যানেল গঠিত হয়েছে। প্যানেল প্রধান: {$panelHead}। বাদী মনোনীত: {$badiUP} (ইউপি সদস্য), {$badiCit} (নাগরিক)। বিবাদী মনোনীত: {$bibadiUP} (ইউপি সদস্য), {$bibadiCit} (নাগরিক)। হাজিরার তারিখ: " . date('d-m-Y', strtotime($request->sunani_date)) . "। শুনানির তারিখ: " . date('d-m-Y', strtotime($request->sunani_date)) . "।",
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
            'reschedule' => 'nullable|boolean',
            'sunani_date' => 'required_if:reschedule,1|nullable|date|after_or_equal:today',
            'sunani_time' => 'required_if:reschedule,1|nullable',
        ]);

        $case = VillageCourt::findOrFail($id);
        
        $desc = "শুনানি পরিচালনা করা হয়েছে। বিবরণ: " . $request->hearing_notes;

        if ($request->reschedule && $request->sunani_date) {
            $case->sunani_date = $request->sunani_date;
            $case->sunani_time = $request->sunani_time;
            $case->hajir_date = $request->sunani_date;
            $case->hajir_time = $request->sunani_time;
            $case->save();
            $desc .= "। পরবর্তী শুনানির তারিখ নির্ধারণ করা হয়েছে: " . date('d-m-Y', strtotime($request->sunani_date)) . " সময়: " . \Carbon\Carbon::parse($request->sunani_time)->format('h:i A') . "।";
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
        $minDate = min(date('Y-m-d', strtotime('-30 days')), $caseDate);

        $request->validate([
            'badi_id' => 'required|exists:people,id',
            'bibadi_ids' => 'required|array',
            'bibadi_ids.*' => 'exists:people,id',
            'case_date' => 'required|date|before_or_equal:today|after_or_equal:' . $minDate,
            'case_time' => 'required',
            'ovijog_er_biboron' => 'nullable|string',
            'ghotona_sombolito' => 'nullable|string',
            'shakkhi_ids' => 'nullable|array',
        ]);

        $villageCourt->badi_id = $request->badi_id;
        $villageCourt->bibadi_ids = $request->bibadi_ids;
        $villageCourt->shakkhi_ids = $request->shakkhi_ids;
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
