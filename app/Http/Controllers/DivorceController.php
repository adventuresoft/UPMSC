<?php

namespace App\Http\Controllers;

use App\Models\Divorce;
use App\Models\Division;
use App\Support\AreaTenancy;
use Illuminate\Http\Request;

class DivorceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divorces = Divorce::latest()->get();
        return view('backend.pages.divorce.index', compact('divorces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::where('status', true)->get();
        return view('backend.pages.divorce.create', compact('divisions'));
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
            'registration_no' => 'required|string|max:255',
            'divorce_type' => 'required|string',
            'divorce_date' => 'required|date',
            'registration_date' => 'required|date',
            'husband_name' => 'required|string|max:255',
            'husband_nid' => 'required|string|max:255',
            'wife_name' => 'required|string|max:255',
            'wife_nid' => 'required|string|max:255',
        ]);
        $this->authorizePeopleInAssignedUnion($request);

        $divorce = new Divorce();

        // 1. Basic Info
        $divorce->registration_no = $request->registration_no;
        $divorce->divorce_type = $request->divorce_type;
        $divorce->divorce_date = $request->divorce_date;
        $divorce->registration_date = $request->registration_date;
        $divorce->divorce_place = $request->divorce_place;
        $divorce->divorce_area_type = $request->divorce_area_type;

        // 2. Address Info
        $location = $this->authorizedLocation($request);
        $divorce->division_id = $location['division_id'];
        $divorce->district_id = $location['district_id'];
        $divorce->upazila_id = $location['upazila_id'];
        $divorce->union_id = $this->authorizedUnionId($request);
        $divorce->ward_no = $request->ward_no;
        $divorce->village_area = $request->village_area;
        $divorce->post_office = $request->post_office;
        $divorce->post_code = $request->post_code;

        // 3. Husband Info
        $divorce->husband_user_id = $request->husband_user_id;
        $divorce->husband_name = $request->husband_name;
        $divorce->husband_father_name = $request->husband_father_name;
        $divorce->husband_mother_name = $request->husband_mother_name;
        $divorce->husband_dob = $request->husband_dob;
        $divorce->husband_age = $request->husband_age;
        $divorce->husband_nid = $request->husband_nid;
        $divorce->husband_religion = $request->husband_religion;
        $divorce->husband_occupation = $request->husband_occupation;
        $divorce->husband_mobile = $request->husband_mobile;
        $divorce->husband_marital_status = $request->husband_marital_status;
        $divorce->husband_present_address = $request->husband_present_address;
        $divorce->husband_permanent_address = $request->husband_permanent_address;

        // Husband Files
        $divorce->husband_photo = $this->uploadFile($request, 'husband_photo_file');
        if (!$divorce->husband_photo && $request->husband_user_id) {
            $husbandUser = \App\Models\User::find($request->husband_user_id);
            if ($husbandUser && $husbandUser->image) {
                $divorce->husband_photo = $husbandUser->image;
            }
        }
        $divorce->husband_signature = $this->uploadFile($request, 'husband_signature_file');

        // 4. Wife Info
        $divorce->wife_user_id = $request->wife_user_id;
        $divorce->wife_name = $request->wife_name;
        $divorce->wife_father_name = $request->wife_father_name;
        $divorce->wife_mother_name = $request->wife_mother_name;
        $divorce->wife_dob = $request->wife_dob;
        $divorce->wife_age = $request->wife_age;
        $divorce->wife_nid = $request->wife_nid;
        $divorce->wife_religion = $request->wife_religion;
        $divorce->wife_occupation = $request->wife_occupation;
        $divorce->wife_mobile = $request->wife_mobile;
        $divorce->wife_marital_status = $request->wife_marital_status;
        $divorce->wife_present_address = $request->wife_present_address;
        $divorce->wife_permanent_address = $request->wife_permanent_address;

        // Wife Files
        $divorce->wife_photo = $this->uploadFile($request, 'wife_photo_file');
        if (!$divorce->wife_photo && $request->wife_user_id) {
            $wifeUser = \App\Models\User::find($request->wife_user_id);
            if ($wifeUser && $wifeUser->image) {
                $divorce->wife_photo = $wifeUser->image;
            }
        }
        $divorce->wife_signature = $this->uploadFile($request, 'wife_signature_file');

        // 5. Witness Info
        $divorce->witness_1_name = $request->witness_1_name;
        $divorce->witness_1_nid = $request->witness_1_nid;
        $divorce->witness_1_mobile = $request->witness_1_mobile;
        $divorce->witness_1_address = $request->witness_1_address;
        $divorce->witness_1_signature = $this->uploadFile($request, 'witness_1_signature_file');

        $divorce->witness_2_name = $request->witness_2_name;
        $divorce->witness_2_nid = $request->witness_2_nid;
        $divorce->witness_2_mobile = $request->witness_2_mobile;
        $divorce->witness_2_address = $request->witness_2_address;
        $divorce->witness_2_signature = $this->uploadFile($request, 'witness_2_signature_file');

        // 6. Religion Specific
        if ($request->divorce_type === 'Islam') {
            $divorce->islam_kabin_number = $request->islam_kabin_number;
            $divorce->islam_den_mohor_amount = $request->islam_den_mohor_amount;
            $divorce->islam_den_mohor_type = $request->islam_den_mohor_type;
            $divorce->islam_wife_wakil_name = $request->islam_wife_wakil_name;
            $divorce->islam_husband_wakil_name = $request->islam_husband_wakil_name;
            $divorce->islam_kazi_name = $request->islam_kazi_name;
            $divorce->islam_kazi_license_no = $request->islam_kazi_license_no;
            $divorce->islam_divorce_reason = $request->islam_divorce_reason;
        } elseif ($request->divorce_type === 'Hindu') {
            $divorce->hindu_temple_name = $request->hindu_temple_name;
            $divorce->hindu_purohit_name = $request->hindu_purohit_name;
            $divorce->hindu_marriage_ritual_date = $request->hindu_marriage_ritual_date;
            $divorce->hindu_wife_gotra = $request->hindu_wife_gotra;
            $divorce->hindu_husband_gotra = $request->hindu_husband_gotra;
        } elseif ($request->divorce_type === 'Christian') {
            $divorce->christian_church_name = $request->christian_church_name;
            $divorce->christian_pastor_name = $request->christian_pastor_name;
            $divorce->christian_marriage_license_no = $request->christian_marriage_license_no;
        } elseif ($request->divorce_type === 'Other') {
            $divorce->other_religion_name = $request->other_religion_name;
            $divorce->other_religious_leader_name = $request->other_religious_leader_name;
            $divorce->other_ceremony_type = $request->other_ceremony_type;
            $divorce->other_organization_name = $request->other_organization_name;
            $divorce->other_other_details = $request->other_other_details;
        }

        // 7. Required Documents
        $divorce->doc_husband_nid = $this->uploadFile($request, 'doc_husband_nid_file');
        $divorce->doc_wife_nid = $this->uploadFile($request, 'doc_wife_nid_file');
        $divorce->doc_birth_certificate = $this->uploadFile($request, 'doc_birth_certificate_file');
        $divorce->doc_divorce_paper_scan = $this->uploadFile($request, 'doc_divorce_paper_scan_file');
        $divorce->doc_other = $this->uploadFile($request, 'doc_other_file');

        // 8. Registrar / Kazi Info
        $divorce->registrar_name = $request->registrar_name;
        $divorce->registrar_license = $request->registrar_license;
        $divorce->registrar_office_address = $request->registrar_office_address;
        $divorce->registrar_office_seal = $this->uploadFile($request, 'registrar_office_seal_file');
        $divorce->registrar_signature = $this->uploadFile($request, 'registrar_signature_file');

        $divorce->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Divorce Registration Form successfully submitted!',
            'redirect_url' => route('divorce.index'),
        ]);
    }

    /**
     * Upload File Helper
     */
    private function uploadFile(Request $request, $fieldName)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/divorces'), $fileName);
            return 'uploads/divorces/' . $fileName;
        }
        return null;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $divorce = Divorce::with(['division', 'district', 'upazila', 'union', 'husbandUser', 'wifeUser'])->findOrFail($id);
        return view('backend.pages.divorce.show', compact('divorce'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $divorce = Divorce::findOrFail($id);
        $divisions = Division::where('status', true)->get();
        $districts = $divorce->division_id ? \App\Models\District::where('division_id', $divorce->division_id)->get() : collect();
        $upazilas = $divorce->district_id ? \App\Models\Thana::where('district_id', $divorce->district_id)->get() : collect();
        $unions = $divorce->upazila_id ? \App\Models\Union::where('thana_id', $divorce->upazila_id)->get() : collect();
        return view('backend.pages.divorce.edit', compact('divorce', 'divisions', 'districts', 'upazilas', 'unions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function update(Request $request, $id)
    {
        $request->validate([
            'registration_no' => 'required|string|max:255',
            'divorce_type' => 'required|string',
            'divorce_date' => 'required|date',
            'registration_date' => 'required|date',
            'husband_name' => 'required|string|max:255',
            'husband_nid' => 'required|string|max:255',
            'wife_name' => 'required|string|max:255',
            'wife_nid' => 'required|string|max:255',
        ]);
        $this->authorizePeopleInAssignedUnion($request);

        $divorce = Divorce::findOrFail($id);

        // 1. Basic Info
        $divorce->registration_no = $request->registration_no;
        $divorce->divorce_type = $request->divorce_type;
        $divorce->divorce_date = $request->divorce_date;
        $divorce->registration_date = $request->registration_date;
        $divorce->divorce_place = $request->divorce_place;
        $divorce->divorce_area_type = $request->divorce_area_type;

        // 2. Address Info
        $location = $this->authorizedLocation($request);
        $divorce->division_id = $location['division_id'];
        $divorce->district_id = $location['district_id'];
        $divorce->upazila_id = $location['upazila_id'];
        $divorce->union_id = $this->authorizedUnionId($request);
        $divorce->ward_no = $request->ward_no;
        $divorce->village_area = $request->village_area;
        $divorce->post_office = $request->post_office;
        $divorce->post_code = $request->post_code;

        // 3. Husband Info
        $divorce->husband_user_id = $request->husband_user_id;
        $divorce->husband_name = $request->husband_name;
        $divorce->husband_father_name = $request->husband_father_name;
        $divorce->husband_mother_name = $request->husband_mother_name;
        $divorce->husband_dob = $request->husband_dob;
        $divorce->husband_age = $request->husband_age;
        $divorce->husband_nid = $request->husband_nid;
        $divorce->husband_religion = $request->husband_religion;
        $divorce->husband_occupation = $request->husband_occupation;
        $divorce->husband_mobile = $request->husband_mobile;
        $divorce->husband_marital_status = $request->husband_marital_status;
        $divorce->husband_present_address = $request->husband_present_address;
        $divorce->husband_permanent_address = $request->husband_permanent_address;

        // Husband Files
        if ($request->hasFile('husband_photo_file')) {
            $divorce->husband_photo = $this->uploadFile($request, 'husband_photo_file');
        }
        elseif (!$divorce->husband_photo && $request->husband_user_id) {
            $husbandUser = \App\Models\User::find($request->husband_user_id);
            if ($husbandUser && $husbandUser->image) {
                $divorce->husband_photo = $husbandUser->image;
            }
        }
        if ($request->hasFile('husband_signature_file')) {
            $divorce->husband_signature = $this->uploadFile($request, 'husband_signature_file');
        }

        // 4. Wife Info
        $divorce->wife_user_id = $request->wife_user_id;
        $divorce->wife_name = $request->wife_name;
        $divorce->wife_father_name = $request->wife_father_name;
        $divorce->wife_mother_name = $request->wife_mother_name;
        $divorce->wife_dob = $request->wife_dob;
        $divorce->wife_age = $request->wife_age;
        $divorce->wife_nid = $request->wife_nid;
        $divorce->wife_religion = $request->wife_religion;
        $divorce->wife_occupation = $request->wife_occupation;
        $divorce->wife_mobile = $request->wife_mobile;
        $divorce->wife_marital_status = $request->wife_marital_status;
        $divorce->wife_present_address = $request->wife_present_address;
        $divorce->wife_permanent_address = $request->wife_permanent_address;

        // Wife Files
        if ($request->hasFile('wife_photo_file')) {
            $divorce->wife_photo = $this->uploadFile($request, 'wife_photo_file');
        }
        elseif (!$divorce->wife_photo && $request->wife_user_id) {
            $wifeUser = \App\Models\User::find($request->wife_user_id);
            if ($wifeUser && $wifeUser->image) {
                $divorce->wife_photo = $wifeUser->image;
            }
        }
        if ($request->hasFile('wife_signature_file')) {
            $divorce->wife_signature = $this->uploadFile($request, 'wife_signature_file');
        }

        // 5. Witness Info
        $divorce->witness_1_name = $request->witness_1_name;
        $divorce->witness_1_nid = $request->witness_1_nid;
        $divorce->witness_1_mobile = $request->witness_1_mobile;
        $divorce->witness_1_address = $request->witness_1_address;
        if ($request->hasFile('witness_1_signature_file')) {
            $divorce->witness_1_signature = $this->uploadFile($request, 'witness_1_signature_file');
        }

        $divorce->witness_2_name = $request->witness_2_name;
        $divorce->witness_2_nid = $request->witness_2_nid;
        $divorce->witness_2_mobile = $request->witness_2_mobile;
        $divorce->witness_2_address = $request->witness_2_address;
        if ($request->hasFile('witness_2_signature_file')) {
            $divorce->witness_2_signature = $this->uploadFile($request, 'witness_2_signature_file');
        }

        // 6. Religion Specific
        if ($request->divorce_type === 'Islam') {
            $divorce->islam_kabin_number = $request->islam_kabin_number;
            $divorce->islam_den_mohor_amount = $request->islam_den_mohor_amount;
            $divorce->islam_den_mohor_type = $request->islam_den_mohor_type;
            $divorce->islam_wife_wakil_name = $request->islam_wife_wakil_name;
            $divorce->islam_husband_wakil_name = $request->islam_husband_wakil_name;
            $divorce->islam_kazi_name = $request->islam_kazi_name;
            $divorce->islam_kazi_license_no = $request->islam_kazi_license_no;
            $divorce->islam_divorce_reason = $request->islam_divorce_reason;
        } elseif ($request->divorce_type === 'Hindu') {
            $divorce->hindu_temple_name = $request->hindu_temple_name;
            $divorce->hindu_purohit_name = $request->hindu_purohit_name;
            $divorce->hindu_marriage_ritual_date = $request->hindu_marriage_ritual_date;
            $divorce->hindu_wife_gotra = $request->hindu_wife_gotra;
            $divorce->hindu_husband_gotra = $request->hindu_husband_gotra;
        } elseif ($request->divorce_type === 'Christian') {
            $divorce->christian_church_name = $request->christian_church_name;
            $divorce->christian_pastor_name = $request->christian_pastor_name;
            $divorce->christian_marriage_license_no = $request->christian_marriage_license_no;
        } elseif ($request->divorce_type === 'Other') {
            $divorce->other_religion_name = $request->other_religion_name;
            $divorce->other_religious_leader_name = $request->other_religious_leader_name;
            $divorce->other_ceremony_type = $request->other_ceremony_type;
            $divorce->other_organization_name = $request->other_organization_name;
            $divorce->other_other_details = $request->other_other_details;
        }

        // 7. Required Documents
        if ($request->hasFile('doc_husband_nid_file')) {
            $divorce->doc_husband_nid = $this->uploadFile($request, 'doc_husband_nid_file');
        }
        if ($request->hasFile('doc_wife_nid_file')) {
            $divorce->doc_wife_nid = $this->uploadFile($request, 'doc_wife_nid_file');
        }
        if ($request->hasFile('doc_birth_certificate_file')) {
            $divorce->doc_birth_certificate = $this->uploadFile($request, 'doc_birth_certificate_file');
        }
        if ($request->hasFile('doc_divorce_paper_scan_file')) {
            $divorce->doc_divorce_paper_scan = $this->uploadFile($request, 'doc_divorce_paper_scan_file');
        }
        if ($request->hasFile('doc_other_file')) {
            $divorce->doc_other = $this->uploadFile($request, 'doc_other_file');
        }

        // 8. Registrar / Kazi Info
        $divorce->registrar_name = $request->registrar_name;
        $divorce->registrar_license = $request->registrar_license;
        $divorce->registrar_office_address = $request->registrar_office_address;
        if ($request->hasFile('registrar_office_seal_file')) {
            $divorce->registrar_office_seal = $this->uploadFile($request, 'registrar_office_seal_file');
        }
        if ($request->hasFile('registrar_signature_file')) {
            $divorce->registrar_signature = $this->uploadFile($request, 'registrar_signature_file');
        }

        $divorce->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Divorce Registration Form successfully updated!',
            'redirect_url' => route('divorce.index'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $divorce = Divorce::findOrFail($id);
        $divorce->delete();

        return response()->json([
            'status' => true,
            'message' => 'Divorce record deleted successfully',
        ]);
    }

    private function authorizedUnionId(Request $request): ?int
    {
        if (AreaTenancy::isUnscoped()) {
            return $request->union_id ? (int) $request->union_id : null;
        }

        $assignedUnionId = AreaTenancy::assignedUnionId();

        abort_unless($assignedUnionId, 403, 'No union is assigned to your account.');

        return $assignedUnionId;
    }

    private function authorizedLocation(Request $request): array
    {
        if (AreaTenancy::isUnscoped()) {
            return [
                'division_id' => $request->division_id,
                'district_id' => $request->district_id,
                'upazila_id' => $request->upazila_id,
            ];
        }

        $union = AreaTenancy::assignedUnion();

        abort_unless($union, 403, 'No union is assigned to your account.');

        return [
            'division_id' => $union->thana?->district?->division_id ?? $request->division_id,
            'district_id' => $union->thana?->district_id ?? $request->district_id,
            'upazila_id' => $union->thana_id ?? $request->upazila_id,
        ];
    }

    private function authorizePeopleInAssignedUnion(Request $request): void
    {
        if (AreaTenancy::isUnscoped()) {
            return;
        }

        abort_unless(
            AreaTenancy::personBelongsToAssignedUnion($request->husband_user_id),
            403,
            'The selected husband is not registered in your assigned union.'
        );

        abort_unless(
            AreaTenancy::personBelongsToAssignedUnion($request->wife_user_id),
            403,
            'The selected wife is not registered in your assigned union.'
        );
    }
}
