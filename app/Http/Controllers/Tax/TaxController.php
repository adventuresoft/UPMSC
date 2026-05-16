<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use App\Models\BasicSettings\Village;
use App\Models\Institute;
use App\Models\Tax\Tax;
use App\Models\Tax\TaxYear;
use App\Models\Union;
use App\Models\UnionWard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['taxes'] = Tax::with(['user.people', 'user.familyInfo'])
            ->applyMultitenancy()
            ->get();
        return view('backend.pages.tax.index', $data);
    }

    public function taxReceipt($id)
    {
        $data['tax'] = Tax::with(array('user'=>function($q1){
            $q1->with('people', 'familyInfo');
        }))->find($id);
        return view('backend.pages.tax.receipt', $data);
    }

    public function taxReceived()
    {
        $data['taxes'] = Tax::with(['user.people', 'user.familyInfo'])
            ->applyMultitenancy()
            ->get();
        return view('backend.pages.tax.received', $data);
    }

    public function taxConfirmed($id)
    {
        $data['tax'] = Tax::with(array('user'=>function($q1){
            $q1->with('people', 'familyInfo');
        }))->find($id);
        return view('backend.pages.tax.confirm_received', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $institute = Institute::find(Auth::user()->institute_id);
        $data['tax_years'] = TaxYear::latest()->get();
        $data['union_wards'] = UnionWard::get();
        
        if ($institute) {
            $data['villages'] = Village::where('union_id', $institute->union_id)->get();
        } else {
            $data['villages'] = Village::latest()->get();
        }
        return view('backend.pages.tax.create', $data);
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
            'user_system_id' => 'required',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $result = DB::transaction(function () use ($request) {

            $tax = new Tax();
            $tax->institute_id = Auth::user()->institute_id;
            $tax->tax_year_id = $request->tax_year_id ?: null;
            $tax->village_id = $request->village_id ?: null;
            $tax->ward_id = $request->ward_id ?: null;
            $tax->area_id = is_numeric($request->area_id) ? $request->area_id : null;
            $tax->house_id = $request->house_id ?: null;
            $tax->user_id = $request->user_id ?: null;
            $tax->user_system_id = $request->user_system_id;

            $tax->previous_residence_tax = $request->previous_residence_tax;
            $tax->previous_income_tax = $request->previous_income_tax;
            $tax->previous_entertainment_institute_tax = $request->previous_entertainment_institute_tax;
            $tax->previous_license_tax = $request->previous_license_tax;
            $tax->previous_bazar_tax = $request->previous_bazar_tax;
            $tax->previous_land_tax = $request->previous_land_tax;
            $tax->previous_auction_tax = $request->previous_auction_tax;
            $tax->previous_fine = $request->previous_fine;
            $tax->previous_others = $request->previous_others;
            $tax->previous_extra = $request->previous_extra;

            $tax->residence_tax = $request->residence_tax;
            $tax->income_tax = $request->income_tax;
            $tax->entertainment_institute_tax = $request->entertainment_institute_tax;
            $tax->license_tax = $request->license_tax;
            $tax->bazar_tax = $request->bazar_tax;
            $tax->land_tax = $request->land_tax;
            $tax->auction_tax = $request->auction_tax;
            $tax->fine = $request->fine;
            $tax->others = $request->others;
            $tax->extra = $request->extra;

            try {
                $tax->save();
                $data['status'] = true;
                $data['message'] = "Tax generated successfully!";
                $data['result'] = $tax;
                $data['code'] = 200;
                // $data['redirect_url'] = route('age.index');
                $data['redirect_url'] = route('tax.show', $tax->id);
                return $data;
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['message'] = "Something went wrong! Please try again...";
                $data['errors'] = $th;
                $data['code'] = 500;
                return $data;
            }
        });

        return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
    }

    public function taxStatus(Request $request)
    {
        $tax = Tax::find($request->id);
        if($tax){
            try {
                $tax->status = $request->status;
                $tax->save();
                $data['status'] = true;
                $data['message'] = "Tax status updated successfully!";
                return response()->json($data, 200);
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['message'] = "Something went wrong! Please try again...";
                $data['errors'] =  $th;
                return response()->json($data, 500);
            }
        }else {
            $data['status'] = false;
            $data['message'] = "Nothing found to update";
            return response()->json($data, 404);
        }
    }

    public function storeManualPayment(Request $request, $id)
    {
        $request->validate([
            'payment_details' => 'required|string|max:255',
            'transaction_id' => 'required|string|max:255',
            'note' => 'nullable|string|max:1000',
        ]);

        $tax = Tax::findOrFail($id);

        try {
            $tax->payment_details = $request->payment_details;
            $tax->transaction_id = $request->transaction_id;
            $tax->note = $request->note;
            $tax->status = 1; // Mark as paid
            $tax->save();

            return redirect()->back()->with('success', 'Manual payment saved successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['tax'] = Tax::with(['user.people', 'user.familyInfo'])
            ->applyMultitenancy()
            ->findOrFail($id);
        return view('backend.pages.tax.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.pages.tax.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
