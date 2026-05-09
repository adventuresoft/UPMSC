<?php

namespace App\Http\Controllers;

use App\Models\BasicSettings\AccountType;
use App\Models\BasicSettings\Bank;
use App\Models\BasicSettings\Country;
use App\Models\BasicSettings\FamilyCategory;
use App\Models\BasicSettings\FamilyType;
use App\Models\BasicSettings\Profession;
use App\Models\BasicSettings\Village;
use App\Models\District;
use App\Models\Division;
use App\Models\House;
use App\Models\Mouza;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\People;
use App\Models\Religion;
use App\Models\Road;
use App\Models\Thana;
use App\Models\UnionWard;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Services\PeopleCredentialService;
use App\Services\AdaReachSmsService;

class PeopleController extends Controller
{
    protected $credentialService;
    protected $smsService;

    public function __construct(PeopleCredentialService $credentialService, AdaReachSmsService $smsService)
    {
        $this->credentialService = $credentialService;
        $this->smsService        = $smsService;
        $this->middleware('unionAdmin')->except('index', 'approvedlist', 'show', 'searchUser', 'edit', 'update', 'approve');
    }


    public function searchUser($system_id)
    {
        $searchKey = trim((string) $system_id);

        $user = User::with('people', 'familyInfo')
            ->where(function ($query) use ($searchKey) {
                $query->where('system_id', $searchKey)
                    ->orWhereHas('people', function ($q) use ($searchKey) {
                        $q->where('approved_id', $searchKey);
                    });

                if (ctype_digit($searchKey)) {
                    $query->orWhere('id', (int) $searchKey);
                }
            })
            ->first();

        if ($user) {
            $data['status'] = true;
            $data['message'] = "People information loaded.";
            $data['user'] = $user;
            return response()->json($data, 200);
        }

        $data['status'] = false;
        $data['message'] = "People not found.";
        $data['user'] = null;
        return response()->json($data, 404);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = User::with([
            'people',
            'professionalInfos',
            'addressInfo.presentWard',
            'addressInfo.presentDistrict',
            'addressInfo.presentThana',
            'addressInfo.presentPostoffice',
            'addressInfo.presentVillage',
            'addressInfo.presentRoad',
            'addressInfo.presentHouse',
            'addressInfo.permanentDistrict',
            'addressInfo.permanentThana',
            'addressInfo.permanentPostOffice',
            'addressInfo.permanentVillage',
            'addressInfo.permanentRoad',
            'addressInfo.permanentHouse',
        ])->whereHas('people', function ($q) {
            $q->whereNull('approved_id');
        });

        if (Auth::user()->institute_id) {
            $query->where('institute_id', Auth::user()->institute_id);
        }

        $data['users'] = $query->latest()->get();
        return view('backend.pages.people.index', $data);
    }

    public function approvedlist()
    {
        $data['subMenu']='approvedList';
        $query = User::with([
            'people',
            'professionalInfos',
            'addressInfo.presentDistrict',
            'addressInfo.presentThana',
            'addressInfo.presentPostoffice',
            'addressInfo.presentVillage',
            'addressInfo.presentWard',
            'addressInfo.presentRoad',
            'addressInfo.presentHouse',
        ])->whereHas('people', function ($q) {
            $q->whereNotNull('approved_id');
        });

        if (Auth::user()->institute_id) {
            $query->where('institute_id', Auth::user()->institute_id);
        }

        $data['users'] = $query->latest()->get();
        return view('backend.pages.people.approvedList', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['religions'] = Religion::where('status', true)->get();
        $data['districts'] =  District::where('status', true)->orderBy('name')->get();
        $data['countries'] =  Country::orderBy('name')->get();
        return view('backend.pages.people.create', $data);
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
            'name' => 'nullable|max:190',
            'bn_name' => 'nullable|max:190',
            'date_of_birth' => 'nullable|max:190',
            'birth_place' => 'nullable|max:190',
            'gender' => 'nullable|max:190',
            'religion' => 'nullable|max:190',
            'blood_group' => 'nullable|max:190',
            'mobile' => 'nullable|max:190',
            'email' => 'nullable|max:190',
            'birth_certificate' => 'nullable|max:190',
            'nid' => 'nullable|max:190',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $result = DB::transaction(function () use ($request) {
            try {
                $user = new User();
                $user->role_id = 5; // 5 => User Role
                $user->institute_id = Auth::user()->institute_id ?? '';

                $user->name = $request->name;
                $user->email = $request->email;
                $user->mobile = $request->mobile;
                $user->birth_certificate = $request->birth_certificate;
                $user->nid = $request->nid;
                $user->status = $request->status ?? true;
                $user->created_by = Auth::id();
                $user->password = Hash::make('12345678');
                $image = $request->file('image');
                if ($image) {
                    $image_name = Str::slug($request->name) . '-' . time();
                    $ext = strtolower($image->getClientOriginalExtension());
                    $image_full_name = $image_name . "." . $ext;
                    $upload_path = public_path('uploads/users/');
                    $image_url = 'uploads/users/' . $image_full_name;
                    $success = $image->move($upload_path, $image_full_name);
                    if ($success) {
                        $user->image = $image_url;
                    }
                }
                if ($user->save()) {
                    $people = new People();
                    $people->user_id = $user->id;
                    $people->bn_name = $request->bn_name;
                    $people->date_of_birth = $request->date_of_birth;
                    $people->birth_place = $request->birth_place;
                    $people->district_id = $request->district_id;
                    $people->country_id = $request->country_id;
                    $people->gender = $request->gender;
                    $people->religion_id = $request->religion;
                    $people->blood_group = $request->blood_group;
                    if ($people->save()) {


                        $data['status'] = true;
                        $data['message'] = "People saved successfully.";
                        $data['user'] = $user;
                        $data['people'] = $people;
                        $data['code'] = 200;
                        $data['redirect_url'] = route('people.family', $people->user_id);
                        return $data;
                    } else {
                        $data['status'] = false;
                        $data['message'] = "People save failed! Please try again...";
                        $data['people'] = $people;
                        $data['code'] = 500;
                        return $data;
                    }
                }
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['code'] = 500;
                $data['errors'] = $th;
                $data['message'] = "Something went wrong! Please try again or contact on support...";
                return $data;
            }
        });
        return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data['religions'] = Religion::where('status', true)->get();
        $data['districts'] =  District::where('status', true)->orderBy('name')->get();
        $data['countries'] =  Country::orderBy('name')->get();
        $data['religions'] = Religion::where('status', true)->get();
        $data['familyTypes'] = FamilyType::where('status', true)->get();
        $data['familyCategories'] = FamilyCategory::where('status', true)->get();
        $data['user'] = $user = User::with('familyInfo', 'educationInfos', 'financialInfos', 'propertyInfos', 'disabilityInfo', 'freedomFighterInfo')
        ->with( 'institute')
        ->with(array('addressInfo' => function($address){
            $address->with('presentUnion', 'permanentHouse', 'presentHouse', 'presentRoad', 'permanentRoad',  'presentVillage', 'presentDistrict', 'presentThana');
        }))
        ->with(array('professionalInfos' => function($q1){
            $q1->with(array('subcategory' => function($q2){
                $q2->with(array('category' => function($q3){
                    $q3->with(array('type'=> function($q4){
                        $q4->with('profession');
                    }));
                }));
            }));
        }))
        ->find($id);

        if (! $user) {
            return redirect()->route('people.index')->with('error', 'User not found.');
        }

        $institute = $user->institute;
        $data['people']=People::where('user_id',$id)->first();

        $data['religions'] = Religion::where('status', true)->get();
        $data['villages'] = [];
        $data['wards'] = [];
        $data['permanent_houses'] = [];
        $data['roads'] = [];
        if(isset($institute?->institute_type_id) && $institute->institute_type_id == 1) {
            $data['villages'] = Village::where('union_id', $institute->union_id)->get();
            $data['wards'] = UnionWard::where('status', true)->get();
            $data['roads'] = Road::where('institute_id',  $institute->id)->latest()->get();
        } else if (isset($institute?->institute_type_id) && $institute->institute_type_id == 2) {

        } else if (isset($institute?->institute_type_id) && $institute->institute_type_id == 3) {

        }
        $data['divisions'] = Division::where('status', true)->get();

        if($user->addressInfo){
            if($user->addressInfo->permanent_ward_id && $institute){
                $data['permanent_houses'] = House::where('institute_id',  $institute->id)
                ->where('union_ward_id', $user->addressInfo->permanent_ward_id)
                ->latest()
                ->get();
            }
        }
        $data['professions'] = Profession::where('status', true)->get();

        $data['account_types'] = AccountType::where('status', true)->latest()->get();
        $data['user'] = $user;
        $data['districts'] = District::latest()->get();
        
        $propertyInfo = $user->propertyInfos->first();

        $data['landThanas'] = $propertyInfo ? ($propertyInfo->land_district_id ? Thana::where('district_id', $propertyInfo->land_district_id)->get() : []) : [];
        $data['landMouzas'] = $propertyInfo ? ($propertyInfo->land_thana_id ? Mouza::where('thana_id', $propertyInfo->land_thana_id)->get() : []) : [];

        $data['flatThanas'] = $propertyInfo ? ($propertyInfo->flat_district_id ? Thana::where('district_id', $propertyInfo->flat_district_id)->get() : []) : [];
        $data['flatMouzas'] = $propertyInfo ? ($propertyInfo->flat_thana_id ? Mouza::where('thana_id', $propertyInfo->flat_thana_id)->get() : []) : [];

        $data['active_tab'] = 'property';

        return view('backend.pages.people.tabs.property', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!view_permission()) {
            return redirect()->back();
        }

        $data['religions'] = Religion::where('status', true)->get();
        $data['districts'] =  District::where('status', true)->orderBy('name')->get();
        $data['countries'] =  Country::orderBy('name')->get();
        $data['user'] =  $user=User::with('people')->find($id);

        if (! $user) {
            return redirect()->route('people.index')->with('error', 'User not found.');
        }

        $presentUnionId = $user->addressInfo ? $user->addressInfo->present_union_id : null;
        $data['villages'] = $presentUnionId ? Village::where('union_id', $presentUnionId)->get() : [];



        return view('backend.pages.people.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userID)
    {
        if (!view_permission()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access.',
            ], 403);
        }

        $validate = Validator::make($request->all(), [
            'name' => 'required|max:190',
            'bn_name' => 'required|max:190',
            'date_of_birth' => 'nullable|max:190',
            'birth_place' => 'nullable|max:190',
            'gender' => 'nullable|max:190',
            'religion' => 'nullable|max:190',
            'blood_group' => 'nullable|max:190',
            'mobile' => 'nullable|max:190',
            'email' => 'required|max:190|email',
            'birth_certificate' => 'nullable|max:190',
            'nid' => 'nullable|max:190',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $result = DB::transaction(function () use ($request, $userID) {
                $user = User::find($userID);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->mobile = $request->mobile;
                $user->birth_certificate = $request->birth_certificate;
                $user->nid = $request->nid;
                $user->status = $request->status ?? true;
                $user->updated_by = Auth::id();

                $image = $request->file('image');
                if ($image) {
                    //if ($user->image) {unlink($user->image);}
                    // $image_name = $user->username;
                    $image_name = Str::slug($request->name) . '-' . time();
                    $ext = strtolower($image->getClientOriginalExtension());
                    $image_full_name = $image_name . "." . $ext;
                    $upload_path = public_path('uploads/users/');
                    $image_url = 'uploads/users/' . $image_full_name;
                    $success = $image->move($upload_path, $image_full_name);
                    if ($success) { $user->image = $image_url; }
                }


                try {
                    $user->save();
                    $people = People::firstOrNew(['user_id' => $userID]);
                    $people->bn_name = $request->bn_name;
                    $people->date_of_birth = $request->date_of_birth;
                    $people->birth_place = $request->birth_place;
                    $people->district_id = $request->district_id;
                    $people->country_id = $request->country_id;
                    $people->gender = $request->gender;
                    $people->religion_id = $request->religion;
                    $people->blood_group = $request->blood_group;

                    try {
                        $people->save();
                        $data['status'] = true;
                        $data['message'] = "People updated successfully.";
                        $data['user'] = $user;
                        $data['people'] = $people;
                        $data['code'] = 200;
                        $data['redirect_url'] = route('people.family', $userID);
                        return $data;
                    } catch (\Throwable $th) {
                        $data['status'] = false;
                        $data['message'] = "Something went wrong! Please try again...";
                        $data['code'] = 500;
                        $data['errors'] = $th;
                        return $data;
                    }
                } catch (\Throwable $th) {
                    $data['status'] = false;
                    $data['message'] = "Something went wrong! Please try again...";
                    $data['code'] = 500;
                    $data['errors'] = $th;
                    return $data;
                }

        });

        return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy(People $people)
    {
        //
    }

    private function generateApprovedId($date_of_birth, $district_id)
    {

        // DOB থেকে YYMMDD
        $datePart = Carbon::parse($date_of_birth)->format('ymd');

        // District ID 2 digit
        $districtPart = str_pad($district_id, 2, '0', STR_PAD_LEFT);

        // একই district + DOB এর last serial বের করা
        $last = People::where('district_id', $district_id)
            ->whereNotNull('approved_id')
            ->orderBy('id', 'desc')
            ->first();

        if ($last) {
            $lastSerial = (int) substr($last->approved_id, -4);
            $newSerial = $lastSerial + 1;
        } else {
            $newSerial = 1;
        }

        // 4 digit serial
        $serialPart = str_pad($newSerial, 4, '0', STR_PAD_LEFT);

        return $districtPart . '-' . $datePart . '-' . $serialPart;
    }


    public function approve(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $people = People::findOrFail($id);
            Log::info('[PeopleApproval] Starting process', ['id' => $id, 'name' => $people->name]);

            if (!empty($people->approved_id)) {
                DB::rollBack();
                Log::warning('[PeopleApproval] Already approved', ['id' => $id]);
                return response()->json([
                    'status' => false,
                    'message' => 'This applicant is already approved.'
                ], 400);
            }

            // Resilience: Fallbacks
            $district_id = $people->district_id ?? 0;
            $dob = $people->date_of_birth ?? now()->format('Y-m-d');

            Log::info('[PeopleApproval] Generating IDs', ['dob' => $dob, 'district' => $district_id]);
            $approvedId = $this->generateApprovedId($dob, $district_id);

            // Auto-generate credentials
            $emailCandidate = optional($people->user)->email ?? $people->email;

            // Resilience: Ensure login_id is unique in the people table
            if ($emailCandidate && !People::where('login_id', $emailCandidate)->exists()) {
                $loginId = $emailCandidate;
            } else {
                $loginId = $approvedId; // Fallback to unique approved_id
            }

            $password = Str::random(8);

            Log::info('[PeopleApproval] Data generated', ['approvedId' => $approvedId, 'loginId' => $loginId]);

            $people->approved_id = $approvedId;
            if ($people->user) {
                $people->user->status = 1;
                $people->user->save();
            }

            $admin = Auth::user() ?? User::find(1);
            $this->credentialService->setCredentials($people, $loginId, $password, $admin);

            $people->save();
            Log::info('[PeopleApproval] Database saved');

            DB::commit();
            Log::info('[PeopleApproval] Transaction committed');

            // ── Send welcome SMS ──────────────────────────────────────────
            $smsSent = false;
            $smsError = null;
            $phone = optional($people->user)->mobile ?? $people->mobile;

            if ($phone) {
                Log::info('[PeopleApproval] Sending SMS', ['phone' => $phone]);
                $smsMessage = AdaReachSmsService::buildApprovalMessage(
                    optional($people->user)->name ?? ($people->name ?? 'Citizen'),
                    $loginId,
                    $password,
                    $approvedId
                );
                $smsResult = $this->smsService->send($phone, $smsMessage);
                $smsSent = $smsResult['success'] ?? false;
                $smsError = !$smsSent ? ($smsResult['response']['description'] ?? 'API Error') : null;
                Log::info('[PeopleApproval] SMS dispatch finished', ['success' => $smsSent]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Approved Successfully!',
                'sms_status' => $smsSent,
                'people_id' => $approvedId,
                'redirect_url' => route('peopleapprovedlist')
            ], 200);

        } catch (\Throwable $e) {
            if (DB::transactionLevel() > 0) {
                DB::rollBack();
            }
            Log::error('[PeopleApproval] CRITICAL FAILURE', [
                'id' => $id,
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Server Error: ' . $e->getMessage()
            ], 500);
        }
    }

}
