<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use App\Models\BasicSettings\Village;
use App\Models\Institute;
use App\Models\Tax\TaxYear;
use App\Models\UnionWard;
use App\Models\Division;
use App\Models\District;
use App\Models\Religion;
use App\Models\Union;
use App\Models\PostOffice;
use App\Models\Road;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeopleApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:people');
    }

    /**
     * Show certificate application form for citizen.
     */
    public function certificateCreate()
    {
        $data['divisions'] = Division::orderBy('name', 'asc')->get();
        $data['districts'] = District::where('status', true)->orderBy('name', 'asc')->get();
        $data['religions'] = Religion::where('status', true)->orderBy('name', 'asc')->get();
        $data['permanent_villages'] = Village::latest()->get();
        $data['wards'] = UnionWard::get();
        $data['roads'] = Road::latest()->get();
        $data['permanent_unions'] = Union::where('thana_id', 385)->get();
        $data['permanent_post_offices'] = PostOffice::where('thana_id', 385)->get();

        return view('people.applications.certificate', $data);
    }

    /**
     * Show trade license application form for citizen.
     */
    public function tradeLicenseCreate()
    {
        $data['tax_years'] = TaxYear::where('status', true)->latest()->get();
        return view('people.applications.trade_license', $data);
    }

    /**
     * Show vehicle application form for citizen.
     */
    public function vehicleCreate()
    {
        return view('people.applications.vehicle');
    }

    /**
     * Show holding tax application form for citizen.
     */
    public function taxCreate()
    {
        $people = Auth::guard('people')->user();
        $instituteId = $people->user->institute_id ?? 1; // Fallback or logic to find institute
        
        $data['tax_years'] = TaxYear::latest()->get();
        $data['union_wards'] = UnionWard::get();
        $data['villages'] = Village::where('union_id', $people->user->addressInfo->permanent_union_id ?? 0)->get();
        
        return view('people.applications.tax', $data);
    }
}
