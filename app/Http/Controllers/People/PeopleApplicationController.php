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

use App\Models\Organization\OrganizationType;
use App\Models\BasicSettings\OrganizationCategory;
use App\Models\BasicSettings\OrganizationOwnershipType;

use App\Models\Organization\Organization;
use App\Models\Certificate\CitizenCertificate;
use App\Models\Certificate\CharacterCertificate;
use App\Models\Certificate\UnmarriedCertificate;
use App\Models\Certificate\LandlessCertificate;
use App\Models\Certificate\YearlyIncomeCertificate;
use App\Models\Certificate\ResidentialCertificate;

class PeopleApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:people');
    }

    /**
     * Display a listing of citizen applications.
     */
    public function index()
    {
        $user = Auth::guard('people')->user();

        // Fetch Trade License Applications
        $tradeLicenses = Organization::where('created_by', $user->id)
            ->select('id', 'name', 'bn_name', 'application_id', 'status', 'created_at')
            ->get()
            ->map(function($item) {
                $item->type = 'Trade License';
                $item->type_bn = 'ট্রেড লাইসেন্স';
                return $item;
            });

        // Fetch Certificate Applications
        $certificates = collect();
        
        $certModels = [
            'citizen' => CitizenCertificate::class,
            'character' => CharacterCertificate::class,
            'unmarried' => UnmarriedCertificate::class,
            'residential' => LandlessCertificate::class,
            'income' => YearlyIncomeCertificate::class,
        ];

        $certLabels = [
            'citizen' => 'নাগরিকত্ব সনদ',
            'character' => 'চারিত্রিক সনদ',
            'unmarried' => 'অবিবাহিত সনদ',
            'residential' => 'ভূমিহীন সনদ',
            'income' => 'বার্ষিক আয় সনদ',
        ];

        foreach ($certModels as $key => $modelClass) {
            $records = $modelClass::where('created_by', $user->id)
                ->get()
                ->map(function($item) use ($certLabels, $key) {
                    $item->type = 'Certificate';
                    $item->type_bn = $certLabels[$key];
                    $item->name = $certLabels[$key];
                    return $item;
                });
            $certificates = $certificates->concat($records);
        }

        $allApplications = $tradeLicenses->concat($certificates)->sortByDesc('created_at');

        return view('people.applications.index', compact('allApplications'));
    }

    /**
     * Store certificate application.
     */
    public function certificateStore(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'cert_type' => 'required',
            'purpose' => 'required|max:190',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validate->errors()
            ], 400);
        }

        try {
            $user = Auth::guard('people')->user();
            $model = null;

            switch ($request->cert_type) {
                case 'citizen':
                    $model = new CitizenCertificate();
                    break;
                case 'character':
                    $model = new CharacterCertificate();
                    break;
                case 'unmarried':
                    $model = new UnmarriedCertificate();
                    break;
                case 'residential':
                    $model = new LandlessCertificate();
                    break;
                case 'income':
                    $model = new YearlyIncomeCertificate();
                    break;
                default:
                    return response()->json(['status' => false, 'message' => 'Invalid certificate type'], 400);
            }

            $model->user_id = $user->user_id;
            $model->purpose = $request->purpose;
            $model->status = 0; // Pending
            $model->created_by = $user->id;
            $model->save();

            return response()->json([
                'status' => true,
                'message' => 'আপনার আবেদনটি সফলভাবে জমা দেওয়া হয়েছে। অনুগ্রহ করে অনুমোদনের জন্য অপেক্ষা করুন।',
                'redirect_url' => route('people.dashboard')
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'error' => $th->getMessage()
            ], 500);
        }
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
        $people = Auth::guard('people')->user();
        $instituteId = $people->user->institute_id ?? 1;

        $data['tax_years'] = TaxYear::where('status', true)->latest()->get();
        $data['types'] = OrganizationType::where('status', true)->latest()->get();
        $data['categories'] = OrganizationCategory::where('status', true)->latest()->get();
        $data['ownership_types'] = OrganizationOwnershipType::where('status', true)->latest()->get();
        $data['wards'] = UnionWard::where('status', true)->get();
        $data['roads'] = Road::where('institute_id', $instituteId)->get();
        $data['divisions'] = Division::where('status', true)->get();
        $data['post_officeses'] = PostOffice::latest()->get();
        
        $institute = Institute::find($instituteId);
        $data['villages'] = $institute ? Village::where('union_id', $institute->union_id)->get() : [];

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
