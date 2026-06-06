<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\BasicSettings\OrganizationCategory;
use App\Models\BasicSettings\OrganizationSubCategory;
use App\Models\BasicSettings\Village;
use App\Models\Institute;
use App\Models\InstituteType;
use App\Models\Organization\Organization;
use App\Models\Organization\TradeLicense;
use App\Models\Tax\TaxYear;
use App\Models\UnionWard;
use Illuminate\Support\Facades\Log;
use DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\TradeLicenseManualPayment;

class TradeLicenseController extends Controller
{
    public function confirmedLicense($id)
    {
        $data['license'] = TradeLicense::find($id);
        return view('backend.pages.organization.trade_license.confirmed', $data);

    }

    public function licenseConfirmation(Request $request, $id)
    {
        $license = TradeLicense::find($id);
        if($license){
            $license->status = $request->status;


            try {
                $license->save();
                $data['status'] = true;
                $data['message'] = "Updated successfully!";
                return response()->json($data, 200);
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['message'] = "Failed to update";
                $data['errors'] = $th;
                return response()->json($data, 500);
            }


        } else{
            $data['status'] = false;
            $data['message'] = "Nothing found to update";
            return response()->json($data, 404);
        }
    }

    public function preview($id)
    {
        $data['license'] = TradeLicense::with([
            'taxYear',
            'organization.category',
            'organization.subcategory',
            'organization.village',
            'organization.Union',
            'organization.Thana',
            'organization.District',
            'organization.institute.union',
            'organization.ownership.user.people',
            'organization.ownership.user.addressInfo.permanentVillage',
            'organization.ownership.user.addressInfo.permanentUnion',
            'organization.ownership.user.addressInfo.permanentThana',
            'organization.ownership.user.addressInfo.permanentDistrict',
        ])->findOrFail($id);

        return view('backend.pages.organization.trade_license.preview', $data);
    }

    public function invoice($id)
    {
        $data['license'] = TradeLicense::with([
            'taxYear',
            'organization',
            'organization.type',
            'organization.institute.union.thana.district',
            'organization.Union.thana.district',
            'organization.Thana.district',
            'organization.District',
            'organization.officeThana.district',
            'organization.officeDistrict',
            'organization.category',
            'organization.subcategory',
            'organization.village',
            'organization.villageArea',
            'organization.ownership.user.people',
            'organization.ownership.user.addressInfo',
            'organization.ownership.user.institute.union.thana.district',
            'organization.ownership.user.addressInfo.presentUnion.thana.district',
            'organization.ownership.user.addressInfo.permanentUnion.thana.district',
            'organization.ownership.user.addressInfo.presentThana.district',
            'organization.ownership.user.addressInfo.permanentThana.district',
            'organization.ownership.user.addressInfo.presentDistrict',
            'organization.ownership.user.addressInfo.permanentDistrict',
            'organization.ownership.user.familyInfo',
        ])->findOrFail($id);
        // dd($data['license']->fees);
 $fees = json_decode($data['license']->fees?? '{}', true);
    $fees = is_array($fees) ? $fees : [];

    $totalFee = 0;
    foreach ($fees as $amount) {
        $totalFee += (float) $amount;
    }

    if ($totalFee!=0) {
        session()->put('trade_license_payment_amount', $totalFee);

    }


        return view('backend.pages.organization.trade_license.invoice', $data);
    }

    public function index()
    {
        $data['organizations'] = Organization::with([
            'type',
            'category',
            'subcategory',
            'institute.type',
            'ownership.user.people',
            'latestTradeLicense.taxYear',
        ])->where('status', 1)
          ->applyMultitenancy()
          ->latest()
          ->get();

        return view('backend.pages.organization.trade_license.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data['tax_years'] = TaxYear::where('status', true)->latest()->get();
        return view('backend.pages.organization.trade_license.create', $data);
    }

    public function getTradeLicense()
    {
        // $data['tax_years'] = TaxYear::where('status', true)->latest()->get();
        // return view('backend.pages.organization.trade_license.get_license', $data);

        $data['trade_licenses'] = TradeLicense::with([
            'taxYear',
            'organization',
            'organization.type',
            'organization.category',
            'organization.subcategory',
        ])->where('payment_status','paid')->applyMultitenancy()->latest()->get();
        return view('backend.pages.organization.trade_license.paidindex', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $trade =  new TradeLicense();
        $trade->tax_year_id = $request->tax_year_id;
        $trade->organization_id = $request->organization_id;
        $trade->fees = json_encode($request->fees);
        $trade->institute_id = Auth::user()->institute_id;

        // Calculate total amount from fees
        $totalAmount = 0;
        if ($request->fees && is_array($request->fees)) {
            foreach ($request->fees as $amt) {
                $totalAmount += (float)$amt;
            }
        }
        $trade->total_amount = $totalAmount;

        try {
            $trade->save();
            $data['status'] = true;
            $data['license'] = $trade;
            $data['redirect_url'] = route('organizationA.trade-license.invoice', $trade->id );
            $data['message'] = "Saved successfully!";
            return response()->json($data,200);

        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Failed to save!";
            $data['errors'] = $th;
            return response()->json($data,500);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization\TradeLicense  $tradeLicense
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['license'] = TradeLicense::with([
            'taxYear',
            'organization.category',
            'organization.subcategory',
            'organization.village',
            'organization.Union',
            'organization.Thana',
            'organization.District',
            'organization.institute.union',
            'organization.ownership.user.people',
            'organization.ownership.user.addressInfo.permanentVillage',
            'organization.ownership.user.addressInfo.permanentUnion',
            'organization.ownership.user.addressInfo.permanentThana',
            'organization.ownership.user.addressInfo.permanentDistrict',
        ])->findOrFail($id);

        return view('backend.pages.organization.trade_license.show', $data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization\TradeLicense  $tradeLicense
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.pages.organization.trade_license.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization\TradeLicense  $tradeLicense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TradeLicense $tradeLicense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization\TradeLicense  $tradeLicense
     * @return \Illuminate\Http\Response
     */
    public function destroy(TradeLicense $tradeLicense)
    {
        //
    }


    public function storeManualPayment(Request $request, $id)
{
    $request->validate([
        'payment_details' => 'required|string|max:255',
        'transaction_id' => 'required|string|max:255|unique:trade_license_manual_payments,transaction_id',
        'note' => 'nullable|string|max:1000',
    ]);

    $license = TradeLicense::findOrFail($id);

    DB::beginTransaction();

    try {

        // Log request start
        Log::info('Manual Payment Attempt Started', [
            'user_id' => auth()->id(),
            'license_id' => $id,
            'request_data' => $request->all(),
            'ip' => $request->ip(),
            'time' => Carbon::now()->toDateTimeString(),
        ]);

        $totalAmount = $license->total_amount;
        if ($totalAmount <= 0) {
            $fees = json_decode($license->fees ?? '{}', true);
            if (is_array($fees)) {
                foreach ($fees as $amt) {
                    $totalAmount += (float)$amt;
                }
            }
        }

        TradeLicenseManualPayment::create([
            'trade_license_id' => $license->id,
            'invoice_no' => $license->invoice_no ?? $license->system_id,
            'payment_details' => $request->payment_details,
            'transaction_id' => $request->transaction_id,
            'note' => $request->note,
            'amount' => $totalAmount,
            'created_by' => auth()->id(),
        ]);

        $license->payment_status = 'paid';
        $license->payment_type = 'manual';
        $license->payment_details = $request->payment_details;
        $license->transaction_id = $request->transaction_id;
        $license->payment_note = $request->note;
        $license->total_amount = $totalAmount; // Update license total as well
        $license->paid_at = now();
        $license->save();

        DB::commit();

        // Success log
        Log::info('Manual Payment Saved Successfully', [
            'user_id' => auth()->id(),
            'license_id' => $license->id,
            'transaction_id' => $request->transaction_id,
            'time' => Carbon::now()->toDateTimeString(),
        ]);

        return redirect()
            ->route('organizationA.trade-license.index')
            ->with('success', 'Manual payment saved successfully.');

    } catch (\Exception $e) {

        DB::rollBack();

        // Error log (FULL DETAILS)
        Log::error('Manual Payment Failed', [
            'user_id' => auth()->id(),
            'license_id' => $id,
            'transaction_id' => $request->transaction_id ?? null,
            'error_message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
            'request_data' => $request->all(),
            'ip' => $request->ip(),
            'time' => Carbon::now()->toDateTimeString(),
        ]);

        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Something went wrong. Please check logs.');
    }
}

    public function storeManualPayment_backup(Request $request, $id)
{
    $request->validate([
        'payment_details' => 'required|string|max:255',
        'transaction_id' => 'required|string|max:255|unique:trade_license_manual_payments,transaction_id',
        'note' => 'nullable|string|max:1000',
    ]);

    $license = TradeLicense::findOrFail($id);

    DB::beginTransaction();
    try {
        TradeLicenseManualPayment::create([
            'trade_license_id' => $license->id,
            'invoice_no' => $license->system_id,
            'payment_details' => $request->payment_details,
            'transaction_id' => $request->transaction_id,
            'note' => $request->note,
            'amount' => $license->total_amount ?? 0,
            'created_by' => auth()->id(),
        ]);

        $license->payment_status = 'paid';
        $license->payment_type = 'manual';
        $license->payment_details = $request->payment_details;
        $license->transaction_id = $request->transaction_id;
        $license->payment_note = $request->note;
        $license->paid_at = now();
        $license->save();

        DB::commit();

        return redirect()
            ->route('organizationA.trade-license.index')
            ->with('success', 'Manual payment saved successfully.');
    } catch (\Exception $e) {
        DB::rollBack();

        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}

public function onlinePayment($id)
{
    $license = TradeLicense::findOrFail($id);

    $totalfee=session('trade_license_payment_amount');


    // Generate unique invoice (VERY IMPORTANT to avoid duplicate error)
    $invoice = 'TL-' . $license->id . '-' . time();

    // API Request - Using IP with Host header to bypass DNS issues
    try {
        $response = Http::withHeaders([
            'Host' => 'api.paystation.com.bd'
        ])->asForm()->withoutVerifying()->timeout(10)->post('https://103.134.89.201/initiate-payment', [
            'invoice_number' => $invoice,
            'currency' => 'BDT',
            'payment_amount' => $totalfee ?? 1, // change based on your DB
            'reference' => 'Trade License Payment #' . $license->id,
            'cust_name' => $license->name ?? 'Customer',
            'cust_phone' => $license->phone ?? '01700000000',
            'cust_email' => $license->email ?? 'test@test.com',
            'cust_address' => $license->address ?? 'Dhaka',
            'callback_url' => route('organizationA.trade-license.payment.success', $license->id), // create this route

            'checkout_items' => json_encode([
                [
                    "name" => "Trade License Fee",
                    "qty" => 1,
                    "price" => $totalfee ?? 1
                ]
            ]),
            'merchantId' => "2573-1775021038",
            'password' => "'poyt32@ft4e6hgc"
        ]);
    } catch (\Exception $e) {
        return back()->withInput()->with('error', 'Payment service unreachable: ' . $e->getMessage());
    }

    $result = $response->json();

    // Handle response
    if (isset($result['status']) && $result['status'] === 'success') {
        return redirect()->away($result['payment_url']);
    }

    // Handle failure
    return back()->with('error', $result['message'] ?? 'Payment initiation failed');
}

public function paymentSuccess($id)
{


    $license = TradeLicense::findOrFail($id);



    // You can verify payment here if API supports verification

    $license->payment_status = 'paid';
    $license->save();

    return redirect()->route('licenses.index')->with('success', 'Payment completed successfully');
}
    public function publicPreview($id)
    {
        $license = TradeLicense::with([
            'taxYear',
            'organization.category',
            'organization.subcategory',
            'organization.village',
            'organization.Union',
            'organization.Thana',
            'organization.District',
            'organization.ownership.user.people',
            'organization.ownership.user.addressInfo.permanentVillage',
            'organization.ownership.user.addressInfo.permanentUnion',
            'organization.ownership.user.addressInfo.permanentThana',
            'organization.ownership.user.addressInfo.permanentDistrict',
        ])->findOrFail($id);

        return view('backend.pages.organization.trade_license.public_preview', compact('license'));
    }



}
