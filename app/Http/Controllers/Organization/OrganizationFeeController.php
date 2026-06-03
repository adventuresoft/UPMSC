<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\BasicSettings\OrganizationCategory;
use App\Models\BasicSettings\OrganizationSubCategory;
use App\Models\BasicSettings\Village;
use App\Models\Institute;
use App\Models\InstituteType;
use App\Models\Organization\Organization;
use App\Models\Organization\OrganizationFee;
use App\Models\Tax\TaxYear;
use App\Models\UnionWard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;
use SebastianBergmann\Type\FalseType;

class OrganizationFeeController extends Controller
{

    public function registrationFees(Request $request)
    {
        $request->validate([
            'organization_id' => 'required|integer|exists:organizations,id',
            'tax_year_id' => 'required|integer|exists:tax_years,id',
        ]);

        $organization = Organization::with(['institute'])->find($request->organization_id);

        if (!$organization) {
            return response()->json([
                'status' => false,
                'message' => "Organization not found!",
            ], 404);
        }

        $fees_category = (int) optional($organization->institute)->institute_subcategory_id;
        if (!in_array($fees_category, [1, 2, 3], true)) {
            $fees_category = 1;
        }

        $instituteTypeId = optional($organization->institute)->institute_type_id;
        $subcategoryId = $organization->organization_subcategory_id;

        $fees = OrganizationFee::query()
            ->where('tax_year_id', $request->tax_year_id)
            ->where('organization_category_id', $organization->organization_category_id)
            ->when($instituteTypeId, function ($query) use ($instituteTypeId) {
                $query->where('institute_type_id', $instituteTypeId);
            })
            ->when($subcategoryId, function ($query) use ($subcategoryId) {
                $query->where(function ($subQuery) use ($subcategoryId) {
                    $subQuery->where('organization_subcategory_id', $subcategoryId)
                        ->orWhereNull('organization_subcategory_id')
                        ->orWhere('organization_subcategory_id', 0);
                });
            }, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->whereNull('organization_subcategory_id')
                        ->orWhere('organization_subcategory_id', 0);
                });
            })
            ->get();

        // Exact subcategory rows take priority over "all subcategory" rows for same fee head.
        $fees = $fees
            ->sortBy(function ($fee) use ($subcategoryId) {
                if (!empty($subcategoryId) && (int) $fee->organization_subcategory_id === (int) $subcategoryId) {
                    return 0;
                }
                return 1;
            })
            ->unique('name')
            ->values();

        // return response()->json(['fees' => $fees]);
        $html = '';

        $total = 0;
        if(count($fees)){
            foreach ($fees as $key => $fee) {
                $feeAmount = 0;
                if ($fees_category === 1) {
                    $feeAmount = (float) $fee->category_a_fees;
                } elseif ($fees_category === 2) {
                    $feeAmount = (float) $fee->category_b_fees;
                } elseif ($fees_category === 3) {
                    $feeAmount = (float) $fee->category_c_fees;
                }

                $html .='<tr>';
                    $html .='<td>'.++$key.'</td>';
                $html .='<td>';
                    $html .='<input type="hidden" class="form-control text-left" value="'.$fee->id.'" name="id[]">';
                    $html .='<input type="text" class="form-control text-left" readonly value="'.$fee->name.'" name="name[]">';
                $html .='</td>';
                $html .='<td>';
                    $total = $total + $feeAmount;
                    $html .='<input class="form-control text-right" readonly value="'.$feeAmount.'" min="0" type="number" name="category_fees[]">';
                    $html .='<input  type="hidden"  name="fees['.$fee->name.']"   value="'.$feeAmount.'">';
                $html .='</td>';
                $html .='</tr>'; 
            }
            
            $html .='<tr>';
                $html .='<td>Total: </td>';
                $html .='<td class="text-right" colspan="2">'. currencyFormat($total) .'</td>';
            $html .='</tr>'; 



            $data['status'] = true;
            $data['message'] = "Fees Loaded successfully!";
            $data['html'] = $html;
            return response()->json($data, 200);

        } else{
            $data['status'] = false;
            $data['message'] = "Not Found!";
            return response()->json($data, 404);
        }
    }
   
    public function index()
    {
        $user = Auth::user();
        $institute = $user ? \App\Models\Institute::find($user->institute_id) : null;
        $data['fees'] = OrganizationFee::when($institute, function ($q) use ($institute) {
                $q->where('institute_type_id', $institute->institute_type_id);
            })
            ->get();
        return view('backend.pages.organization.fees.registration.index', $data);
    }

   
    public function create()
    {
        $institute = Institute::find(Auth::user()->institute_id);
        $data['union_wards'] = UnionWard::get();
        $data['institute_types'] = InstituteType::where('status', true)->latest()->get();
        $data['organization_categories'] = OrganizationCategory::where('status', true)->get();
        $data['organization_sub_categories'] = OrganizationSubCategory::where('status', true)->get();
        $data['villages'] = Village::where('union_id', $institute->union_id ?? 0 )->get();
        $data['tax_years'] = TaxYear::where('status', true)->latest()->get();
        return view('backend.pages.organization.fees.registration.create', $data);
    }

    
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'tax_year_id' => 'required',
            'institute_type_id' => 'required',
            'organization_category_id' => 'required',
            'organization_subcategory_id' => 'nullable',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $tax_year_id = $request->tax_year_id;
        $institute_type_id = $request->institute_type_id;
        $organization_category_id = $request->organization_category_id;
        $organization_subcategory_id = $request->organization_subcategory_id ?: null;

        $names = $request->name;
        $category_a_fees = $request->category_a_fees;
        $category_b_fees = $request->category_b_fees;
        $category_c_fees = $request->category_c_fees;

        DB::beginTransaction();
        try {
            if(!empty($names)){
                foreach ($names as $key => $name) {
    
                    $fees = new OrganizationFee();
                    $fees->tax_year_id = $tax_year_id;
                    $fees->institute_type_id = $institute_type_id;
                    $fees->organization_category_id = $organization_category_id;
                    $fees->organization_subcategory_id = $organization_subcategory_id;
    
                    $fees->name = $name;
                    $fees->category_a_fees = $category_a_fees[$key];
                    $fees->category_b_fees = $category_b_fees[$key];
                    $fees->category_c_fees = $category_c_fees[$key];
                    $fees->save();
                }

                DB::commit();
                $data['status'] = true;
                $data['message'] = "Saved successfully";
                return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            $data['message'] = "Failed to save";
            $data['status'] = false;
            $data['errors'] = $th;
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }

        

    }

    
    public function show($id)
    {
        return view('backend.pages.organization.fees.registration.show');
    }

 
    public function edit($id)
    {
        $data['institute_types'] = InstituteType::where('status', true)->latest()->get();
        $data['organization_categories'] = OrganizationCategory::where('status', true)->get();
        $data['organization_sub_categories'] = OrganizationSubCategory::where('status', true)->get();
        $data['tax_years'] = TaxYear::where('status', true)->latest()->get();
        $data['fee'] = OrganizationFee::where('status', true)->where('id',$id)->first();

        // return response()->json($data, 200);

        return view('backend.pages.organization.fees.registration.edit', $data);
    }

   
    public function update(Request $request, $id)
    {

        $validate = Validator::make($request->all(), [
            'tax_year_id' => 'required',
            'institute_type_id' => 'required',
            'organization_category_id' => 'required',
            'organization_subcategory_id' => 'nullable',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $fees = OrganizationFee::find($id);

        if($fees){
            $fees->tax_year_id = $request->tax_year_id;
            $fees->institute_type_id = $request->institute_type_id;
            $fees->organization_category_id = $request->organization_category_id;
            $fees->organization_subcategory_id = $request->organization_subcategory_id ?: null;
    
            $fees->name = $request->name;
            $fees->category_a_fees = $request->category_a_fees;
            $fees->category_b_fees = $request->category_b_fees;
            $fees->category_c_fees = $request->category_c_fees;
            
            try{
                $fees->save();
                $data['status'] = true;
                $data['message'] = "Organization Fee Updated Successfully";
                return response()->json($data, 200);
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['message'] = "Failed to update organization fee";
                $data['errors'] = $th->getMessage();
                return response()->json($data, 500);
            }
        }else{
            $data['status'] = false;
            $data['message'] = "Organization fee not found";
            return response()->json($data, 404);
        }

        
       
    }

    public function destroy($id)
    {
        $fee = OrganizationFee::find($id);
        if($fee){

            try {
                $fee->delete();
                $data['status'] = true;
                $data['message'] = "Organization Fee Deleted Successfully";
                return response()->json($data, 200);
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['message'] = "Failed to delete";
                $data['errors'] = $th;
                return response()->json($data, 500);
            }

        } else {
            $data['status'] = false;
            $data['message'] = "Noting found to delete";
            return response()->json($data, 404);
        }
    }
}
