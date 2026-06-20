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
            'hajir_date' => 'required|date',
            'hajir_time' => 'required',
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
        $villageCourt->hajir_date = $request->hajir_date;
        $villageCourt->hajir_time = $request->hajir_time;
        $villageCourt->created_by = Auth::id();
        $villageCourt->status = 'pending';
        
        $villageCourt->case_no = IdGenerator::generate(['table' => 'village_courts', 'field' => 'case_no', 'length' => 10, 'prefix' => 'VC-' . date("Y")]);

        $villageCourt->save();

        return redirect()->route('village-court.show', $villageCourt->id)->with('success', 'Notice created successfully.');
    }

    public function show($id)
    {
        $data['case'] = VillageCourt::with([
            'badi.familyInfo', 'badi.user.addressInfo.permanentVillage', 'badi.user.addressInfo.permanentUnion', 'badi.user.addressInfo.permanentThana', 'badi.user.addressInfo.permanentDistrict',
        ])->findOrFail($id);
        
        return view('backend.pages.village_court.show', $data);
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
            'hajir_date' => 'required|date',
            'hajir_time' => 'required',
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
        $villageCourt->hajir_date = $request->hajir_date;
        $villageCourt->hajir_time = $request->hajir_time;
        $villageCourt->updated_by = Auth::id();
        $villageCourt->save();

        return redirect()->route('village-court.index')->with('success', 'Notice updated successfully.');
    }

    public function destroy($id)
    {
        $villageCourt = VillageCourt::findOrFail($id);
        $villageCourt->delete();
        return redirect()->route('village-court.index')->with('success', 'Notice deleted successfully.');
    }
}
