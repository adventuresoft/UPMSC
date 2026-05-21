<?php

namespace App\Http\Controllers;

use App\Models\Land;
use App\Support\AreaTenancy;
use Illuminate\Http\Request;

class LandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lands = Land::applyMultitenancy()->with(['owner.people'])->latest()->get();
        $districts = \App\Models\District::pluck('bn_name', 'id');
        $thanas = \App\Models\Thana::pluck('bn_name', 'id');
        return view('backend.pages.land.index', compact('lands', 'districts', 'thanas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = \App\Models\District::orderBy('bn_name')->get();
        return view('backend.pages.land.create', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'owner_id' => 'required',
            'records' => 'required|array',
        ]);

        if ($ownerError = $this->ownerAuthorizationError($request->owner_id)) {
            return $ownerError;
        }

        try {
            $land = new Land();
            $land->owner_id = $request->owner_id;
            $land->records_data = $request->records;
            $land->status = 'Pending';
            $land->save();

            return response()->json([
                'status' => true,
                'message' => 'Land records saved successfully!',
                'redirect_url' => route('land.index')
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Land  $land
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $land = Land::applyMultitenancy()->with('owner.people')->findOrFail($id);
        $districts = \App\Models\District::pluck('bn_name', 'id');
        $thanas = \App\Models\Thana::pluck('bn_name', 'id');
        return view('backend.pages.land.show', compact('land', 'districts', 'thanas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Land  $land
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $land = Land::applyMultitenancy()->with('owner.people')->findOrFail($id);
        $districts = \App\Models\District::orderBy('bn_name')->get();
        return view('backend.pages.land.edit', compact('land', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Land  $land
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'owner_id' => 'required',
            'records' => 'required|array',
        ]);

        if ($ownerError = $this->ownerAuthorizationError($request->owner_id)) {
            return $ownerError;
        }

        try {
            $land = Land::applyMultitenancy()->findOrFail($id);

            $land->owner_id = $request->owner_id;
            $land->records_data = $request->records;
            $land->save();

            return response()->json([
                'status' => true,
                'message' => 'Land records updated successfully!',
                'redirect_url' => route('land.index')
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Land  $land
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $land = Land::applyMultitenancy()->findOrFail($id);
        $land->delete();
        return redirect()->route('land.index')->with('success', 'Land record deleted successfully.');
    }

    private function ownerAuthorizationError($ownerId)
    {
        if (!AreaTenancy::personExists($ownerId)) {
            return response()->json([
                'status' => false,
                'message' => 'Owner not found.',
                'errors' => ['owner_id' => ['Owner not found.']],
            ], 422);
        }

        if (!AreaTenancy::personBelongsToAssignedUnion($ownerId)) {
            return response()->json([
                'status' => false,
                'message' => 'The selected land owner is not registered in your assigned union.',
                'errors' => ['owner_id' => ['The selected land owner is not registered in your assigned union.']],
            ], 403);
        }

        return null;
    }
}
