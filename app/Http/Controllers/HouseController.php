<?php

namespace App\Http\Controllers;

use App\Models\BasicSettings\HouseCategory;
use App\Models\BasicSettings\HouseOwnerType;
use App\Models\BasicSettings\HouseType;
use App\Models\BasicSettings\Village;
use App\Models\House;
use App\Models\Institute;
use App\Models\Mouza;
use App\Models\Union;
use App\Models\UnionWard;
use App\Models\VillageArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('unionAdmin')->except( 'options', 'index', 'show');
    }

    public function getHouseByArea($areaID)
    {
        $html = '<option value="">Select House</option>';
        $houses = House::where('village_area_id', $areaID)->get();
        if(count($houses)){
            foreach ($houses as $house) {
                $html .= '<option value="'.$house->id.'">'.$house->house.'</option>';
            }
        } else {
            $html .= '<option value="">No House Found</option>';
        }
        $html .= '';
        return $html;
    }

    public function getBlocksByVillageWard($villageID, $wardID)
    {
        $html = '<option value="">Select block/section/sector</option>';
        $blocks = House::where('village_id', $villageID)
                       ->where('union_ward_id', $wardID)
                       ->whereNotNull('block_section')
                       ->where('block_section', '!=', '')
                       ->select('block_section')
                       ->distinct()
                       ->get();
                       
        if(count($blocks)){
            foreach ($blocks as $block) {
                $html .= '<option value="'.urlencode($block->block_section).'">'.$block->block_section.'</option>';
            }
        }
        return $html;
    }

    public function getHousesByBlock($villageID, $wardID, $block)
    {
        $block = urldecode($block);
        $html = '<option value="">Select House</option>';
        $houses = House::where('village_id', $villageID)
                       ->where('union_ward_id', $wardID)
                       ->where('block_section', $block)
                       ->get();
                       
        if(count($houses)){
            foreach ($houses as $house) {
                $html .= '<option value="'.$house->id.'">'.$house->house.'</option>';
            }
        } else {
            $html .= '<option value="">No House Found</option>';
        }
        return $html;
    }

    public function getOwnerByHouse($houseID)
    {
        $house = House::with(['ownership' => function($q) {
            $q->whereNotNull('owner_id')->orderBy('id', 'asc');
        }])->find($houseID);

        if ($house && $house->ownership->count() > 0) {
            return response()->json([
                'status' => true,
                'owner_id' => $house->ownership->first()->owner_id
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'No owner found with a system ID'
        ]);
    }

    public function options( Request $request, $id)
    {
        $html = '<option value="">Select '.($request->id ? ucfirst($request->id) : '').' House</option>';

        if ($request->village) {
            $houses = House::applyMultitenancy()->where('union_ward_id', $id)->where('village_id', $request->village)->get();
        } else {
            $houses = House::applyMultitenancy()->where('union_ward_id', $id)->get();
        }


        if(count($houses)){
            foreach ($houses as $house) {
                $html .= '<option value="'.$house->id.'">'.$house->house.'</option>';
            }
        }

        $html .= '';

        return $html;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['houses'] = House::with('ownership')->applyMultitenancy()->latest()->get();
        return view('backend.pages.house.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $institute = Institute::find(Auth::user()->institute_id);
        if($institute){
            $data['villages'] = Village::where('union_id', $institute->union_id)->latest()->get();
            $union = Union::find($institute->union_id);
            if($union) {
                $data['mouzas'] = Mouza::where('thana_id', $union->thana_id)->get();
            }

        }else {
            $data['villages'] = Village::latest()->get();
            $data['mouzas'] = Mouza::get();
        }
        $data['villageAreas'] = [];
        $data['union_wards'] = UnionWard::where('status', true)->orderBy('en_ward_no', 'asc')->get();
        $data['house_types'] = HouseType::where('status', true)->latest()->get();
        $data['house_owner_types'] = HouseOwnerType::where('status', true)->latest()->get();
        $data['house_categories'] = HouseCategory::where('status', true)->latest()->get();
        return view('backend.pages.house.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'house' => 'required|max:190',
            'house_bn' => 'required|max:190',
            'village_id' => 'nullable|max:190',
            'block_section' => 'nullable|max:190',
            'union_ward_id' => 'nullable|max:190',
            'number_of_rooms' => 'nullable|integer',
            'room_usage' => 'nullable|max:190',
            'room_area' => 'nullable|array',
            'room_type' => 'nullable|array',
            'price_per_sq_ft' => 'nullable|array',
            'land_quantity' => 'nullable|max:190',
            'house_price' => 'nullable|numeric',
            'land_price' => 'nullable|numeric',
            'grand_total_price' => 'nullable|numeric',
        ]);


        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        try {
            $roomDetails = [];
            if ($request->has('room_area') && is_array($request->room_area)) {
                foreach ($request->room_area as $key => $area) {
                    $roomDetails[] = [
                        'area' => $area,
                        'type' => $request->room_type[$key] ?? '',
                        'price_per_sq_ft' => $request->price_per_sq_ft[$key] ?? ''
                    ];
                }
            }
            $roomDetailsJson = json_encode($roomDetails, JSON_UNESCAPED_UNICODE);

            $payload = [
                'house' => $request->house,
                'house_bn' => $request->house_bn,
                'village_id' => $request->village_id,
                'block_section' => $request->block_section,
                'union_ward_id' => $request->union_ward_id,
                'number_of_rooms' => $request->number_of_rooms,
                'room_details' => $roomDetailsJson,
                'room_usage' => $request->room_usage,
                // Reset legacy fields
                'village_area_id' => null,
                'house_type_id' => null,
                'house_category_id' => null,
                'house_owner_type_id' => null,
                'mouza_id' => null,
                'brs_khatian' => null,
                'brs_dag' => null,
                'land_quantity' => $request->land_quantity ?: 0,
                'house_price' => $request->house_price ?: 0,
                'land_price' => $request->land_price ?: 0,
                'grand_total_price' => $request->grand_total_price ?: 0,
            ];

            if ($request->id) {
                $house = House::where('id', $request->id)->first();
                if ($house) {
                    $house->update($payload);
                }
            } else {
                $payload['institute_id'] = Auth::user()->institute_id;
                $house = House::create($payload);
            }


           
            $data['status'] = true;
            $data['message'] = "House submitted successfully!";
            $data['result'] = $house;
            $data['code'] = 200;
            $data['redirect_url'] = route('house-ownership.edit', $request->id ?? $house->id);
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Error: " . $th->getMessage();
            $data['errors'] = $th->getMessage();
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['house'] = House::applyMultitenancy()->with(['village', 'unionWard', 'ownership'])->findOrFail($id);
        if (!$data['house']) {
            return redirect()->back()->with('error', 'House not found.');
        }
        return view('backend.pages.house.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $institute = Institute::find(Auth::user()->institute_id);
        if($institute){
            $data['villages'] = Village::where('union_id', $institute->union_id)->latest()->get();
            $union = Union::find($institute->union_id);
            if($union) {
                $data['mouzas'] = Mouza::where('thana_id', $union->thana_id)->get();
            }
        }else {
            $data['villages'] = Village::latest()->get();
            $data['mouzas'] = Mouza::get();
        }
        
        $data['union_wards'] = UnionWard::where('status', true)->orderBy('en_ward_no', 'asc')->get();
        $data['house_types'] = HouseType::where('status', true)->latest()->get();
        $data['house_owner_types'] = HouseOwnerType::where('status', true)->latest()->get();
        $data['house'] = $house = House::find($id);
        if($data['house']){
            $data['house_categories'] = HouseCategory::where('id', $data['house']->house_category_id)->latest()->get();
            $data['villageAreas'] = VillageArea::where('village_id', $house->village_id)->get();
            return view('backend.pages.house.edit', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, House $house)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $house = House::find($id);
        if($house){

            try {
                $house->delete();
                $data['status'] = true;
                $data['message'] = "House Deleted Successfully";
                return response()->json($data, 200);
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['message'] = "Failed to delete";
                $data['errors'] = $th->getMessage(); \Log::error($th->getMessage());
                return response()->json($data, 500);
            }

        } else {
            $data['status'] = false;
            $data['message'] = "Noting found to delete";
            return response()->json($data, 404);
        }
    }
}
