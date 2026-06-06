<?php

namespace App\Http\Controllers;

use App\Models\Marriage;
use App\Models\Division;
use App\Support\AreaTenancy;
use Illuminate\Http\Request;

class MarriageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marriages = Marriage::latest()->get();
        return view('backend.pages.marriage.index', compact('marriages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::where('status', true)->get();
        return view('backend.pages.marriage.create', compact('divisions'));
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
            'marriage_type' => 'required|string',
            'marriage_date' => 'required|date',
            'registration_date' => 'required|date',
            'groom_name' => 'required|string|max:255',
            'groom_nid' => 'required|string|max:255',
            'bride_name' => 'required|string|max:255',
            'bride_nid' => 'required|string|max:255',
        ]);
        $this->authorizePeopleInAssignedUnion($request);

        $marriage = new Marriage();

        // 1. Basic Info
        $marriage->registration_no = $request->registration_no;
        $marriage->marriage_type = $request->marriage_type;
        $marriage->marriage_date = $request->marriage_date;
        $marriage->registration_date = $request->registration_date;
        $marriage->marriage_place = $request->marriage_place;
        $marriage->marriage_area_type = $request->marriage_area_type;

        // 2. Address Info
        $location = $this->authorizedLocation($request);
        $marriage->division_id = $location['division_id'];
        $marriage->district_id = $location['district_id'];
        $marriage->upazila_id = $location['upazila_id'];
        $marriage->union_id = $this->authorizedUnionId($request);
        $marriage->ward_no = $request->ward_no;
        $marriage->village_area = $request->village_area;
        $marriage->post_office = $request->post_office;
        $marriage->post_code = $request->post_code;

        // 3. Groom Info
        $marriage->groom_user_id = $request->groom_user_id;
        $marriage->groom_name = $request->groom_name;
        $marriage->groom_father_name = $request->groom_father_name;
        $marriage->groom_mother_name = $request->groom_mother_name;
        $marriage->groom_dob = $request->groom_dob;
        $marriage->groom_age = $request->groom_age;
        $marriage->groom_nid = $request->groom_nid;
        $marriage->groom_religion = $request->groom_religion;
        $marriage->groom_occupation = $request->groom_occupation;
        $marriage->groom_mobile = $request->groom_mobile;
        $marriage->groom_marital_status = $request->groom_marital_status;
        $marriage->groom_present_address = $request->groom_present_address;
        $marriage->groom_permanent_address = $request->groom_permanent_address;

        // Groom Files
        $marriage->groom_photo = $this->uploadFile($request, 'groom_photo_file');
        if (!$marriage->groom_photo && $request->groom_user_id) {
            $groomUser = \App\Models\User::find($request->groom_user_id);
            if ($groomUser && $groomUser->image) {
                $marriage->groom_photo = $groomUser->image;
            }
        }
        $marriage->groom_signature = $this->uploadFile($request, 'groom_signature_file');

        // 4. Bride Info
        $marriage->bride_user_id = $request->bride_user_id;
        $marriage->bride_name = $request->bride_name;
        $marriage->bride_father_name = $request->bride_father_name;
        $marriage->bride_mother_name = $request->bride_mother_name;
        $marriage->bride_dob = $request->bride_dob;
        $marriage->bride_age = $request->bride_age;
        $marriage->bride_nid = $request->bride_nid;
        $marriage->bride_religion = $request->bride_religion;
        $marriage->bride_occupation = $request->bride_occupation;
        $marriage->bride_mobile = $request->bride_mobile;
        $marriage->bride_marital_status = $request->bride_marital_status;
        $marriage->bride_present_address = $request->bride_present_address;
        $marriage->bride_permanent_address = $request->bride_permanent_address;

        // Bride Files
        $marriage->bride_photo = $this->uploadFile($request, 'bride_photo_file');
        if (!$marriage->bride_photo && $request->bride_user_id) {
            $brideUser = \App\Models\User::find($request->bride_user_id);
            if ($brideUser && $brideUser->image) {
                $marriage->bride_photo = $brideUser->image;
            }
        }
        $marriage->bride_signature = $this->uploadFile($request, 'bride_signature_file');

        // 5. Witness Info
        $marriage->witness_1_name = $request->witness_1_name;
        $marriage->witness_1_nid = $request->witness_1_nid;
        $marriage->witness_1_mobile = $request->witness_1_mobile;
        $marriage->witness_1_address = $request->witness_1_address;
        $marriage->witness_1_signature = $this->uploadFile($request, 'witness_1_signature_file');

        $marriage->witness_2_name = $request->witness_2_name;
        $marriage->witness_2_nid = $request->witness_2_nid;
        $marriage->witness_2_mobile = $request->witness_2_mobile;
        $marriage->witness_2_address = $request->witness_2_address;
        $marriage->witness_2_signature = $this->uploadFile($request, 'witness_2_signature_file');

        // 6. Religion Specific
        if ($request->marriage_type === 'Islam') {
            $marriage->islam_kabin_number = $request->islam_kabin_number;
            $marriage->islam_den_mohor_amount = $request->islam_den_mohor_amount;
            $marriage->islam_den_mohor_type = $request->islam_den_mohor_type;
            $marriage->islam_bride_wakil_name = $request->islam_bride_wakil_name;
            $marriage->islam_groom_wakil_name = $request->islam_groom_wakil_name;
            $marriage->islam_kazi_name = $request->islam_kazi_name;
            $marriage->islam_kazi_license_no = $request->islam_kazi_license_no;
        } elseif ($request->marriage_type === 'Hindu') {
            $marriage->hindu_temple_name = $request->hindu_temple_name;
            $marriage->hindu_purohit_name = $request->hindu_purohit_name;
            $marriage->hindu_marriage_ritual_date = $request->hindu_marriage_ritual_date;
            $marriage->hindu_bride_gotra = $request->hindu_bride_gotra;
            $marriage->hindu_groom_gotra = $request->hindu_groom_gotra;
            $marriage->hindu_saptapadi_completed = $request->hindu_saptapadi_completed;
            $marriage->hindu_sacred_fire_ceremony = $request->hindu_sacred_fire_ceremony;
        } elseif ($request->marriage_type === 'Christian') {
            $marriage->christian_church_name = $request->christian_church_name;
            $marriage->christian_pastor_name = $request->christian_pastor_name;
            $marriage->christian_marriage_license_no = $request->christian_marriage_license_no;
            $marriage->christian_publication_of_banns = $request->christian_publication_of_banns;
            $marriage->christian_marriage_conducted_by = $request->christian_marriage_conducted_by;
        } elseif ($request->marriage_type === 'Other') {
            $marriage->other_religion_name = $request->other_religion_name;
            $marriage->other_religious_leader_name = $request->other_religious_leader_name;
            $marriage->other_ceremony_type = $request->other_ceremony_type;
            $marriage->other_organization_name = $request->other_organization_name;
            $marriage->other_other_details = $request->other_other_details;
        }

        // 7. Required Documents
        $marriage->doc_groom_nid = $this->uploadFile($request, 'doc_groom_nid_file');
        $marriage->doc_bride_nid = $this->uploadFile($request, 'doc_bride_nid_file');
        $marriage->doc_birth_certificate = $this->uploadFile($request, 'doc_birth_certificate_file');
        $marriage->doc_passport_photo = $this->uploadFile($request, 'doc_passport_photo_file');
        $marriage->doc_witness_nid = $this->uploadFile($request, 'doc_witness_nid_file');
        $marriage->doc_marriage_certificate_scan = $this->uploadFile($request, 'doc_marriage_certificate_scan_file');
        $marriage->doc_other = $this->uploadFile($request, 'doc_other_file');

        // 8. Registrar / Kazi Info
        $marriage->registrar_name = $request->registrar_name;
        $marriage->registrar_license = $request->registrar_license;
        $marriage->registrar_office_address = $request->registrar_office_address;
        $marriage->registrar_office_seal = $this->uploadFile($request, 'registrar_office_seal_file');
        $marriage->registrar_signature = $this->uploadFile($request, 'registrar_signature_file');

        $marriage->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Marriage Registration Form successfully submitted!',
            'redirect_url' => route('marriage.index'),
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
            $file->move(base_path('uploads/marriages'), $fileName);
            return 'uploads/marriages/' . $fileName;
        }
        return null;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marriage  $marriage
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marriage = Marriage::with(['division', 'district', 'upazila', 'union', 'groomUser', 'brideUser'])->findOrFail($id);
        return view('backend.pages.marriage.show', compact('marriage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marriage  $marriage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marriage = Marriage::findOrFail($id);
        $divisions = Division::where('status', true)->get();
        $districts = $marriage->division_id ? \App\Models\District::where('division_id', $marriage->division_id)->get() : collect();
        $upazilas = $marriage->district_id ? \App\Models\Thana::where('district_id', $marriage->district_id)->get() : collect();
        $unions = $marriage->upazila_id ? \App\Models\Union::where('thana_id', $marriage->upazila_id)->get() : collect();
        return view('backend.pages.marriage.edit', compact('marriage', 'divisions', 'districts', 'upazilas', 'unions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marriage  $marriage
     * @return \Illuminate\Http\Response
     */
        public function update(Request $request, $id)
    {
        $request->validate([
            'registration_no' => 'required|string|max:255',
            'marriage_type' => 'required|string',
            'marriage_date' => 'required|date',
            'registration_date' => 'required|date',
            'groom_name' => 'required|string|max:255',
            'groom_nid' => 'required|string|max:255',
            'bride_name' => 'required|string|max:255',
            'bride_nid' => 'required|string|max:255',
        ]);
        $this->authorizePeopleInAssignedUnion($request);

        $marriage = Marriage::findOrFail($id);

        // 1. Basic Info
        $marriage->registration_no = $request->registration_no;
        $marriage->marriage_type = $request->marriage_type;
        $marriage->marriage_date = $request->marriage_date;
        $marriage->registration_date = $request->registration_date;
        $marriage->marriage_place = $request->marriage_place;
        $marriage->marriage_area_type = $request->marriage_area_type;

        // 2. Address Info
        $location = $this->authorizedLocation($request);
        $marriage->division_id = $location['division_id'];
        $marriage->district_id = $location['district_id'];
        $marriage->upazila_id = $location['upazila_id'];
        $marriage->union_id = $this->authorizedUnionId($request);
        $marriage->ward_no = $request->ward_no;
        $marriage->village_area = $request->village_area;
        $marriage->post_office = $request->post_office;
        $marriage->post_code = $request->post_code;

        // 3. Groom Info
        $marriage->groom_user_id = $request->groom_user_id;
        $marriage->groom_name = $request->groom_name;
        $marriage->groom_father_name = $request->groom_father_name;
        $marriage->groom_mother_name = $request->groom_mother_name;
        $marriage->groom_dob = $request->groom_dob;
        $marriage->groom_age = $request->groom_age;
        $marriage->groom_nid = $request->groom_nid;
        $marriage->groom_religion = $request->groom_religion;
        $marriage->groom_occupation = $request->groom_occupation;
        $marriage->groom_mobile = $request->groom_mobile;
        $marriage->groom_marital_status = $request->groom_marital_status;
        $marriage->groom_present_address = $request->groom_present_address;
        $marriage->groom_permanent_address = $request->groom_permanent_address;

        // Groom Files
        if ($request->hasFile('groom_photo_file')) {
            $marriage->groom_photo = $this->uploadFile($request, 'groom_photo_file');
        }
        elseif (!$marriage->groom_photo && $request->groom_user_id) {
            $groomUser = \App\Models\User::find($request->groom_user_id);
            if ($groomUser && $groomUser->image) {
                $marriage->groom_photo = $groomUser->image;
            }
        }
        if ($request->hasFile('groom_signature_file')) {
            $marriage->groom_signature = $this->uploadFile($request, 'groom_signature_file');
        }

        // 4. Bride Info
        $marriage->bride_user_id = $request->bride_user_id;
        $marriage->bride_name = $request->bride_name;
        $marriage->bride_father_name = $request->bride_father_name;
        $marriage->bride_mother_name = $request->bride_mother_name;
        $marriage->bride_dob = $request->bride_dob;
        $marriage->bride_age = $request->bride_age;
        $marriage->bride_nid = $request->bride_nid;
        $marriage->bride_religion = $request->bride_religion;
        $marriage->bride_occupation = $request->bride_occupation;
        $marriage->bride_mobile = $request->bride_mobile;
        $marriage->bride_marital_status = $request->bride_marital_status;
        $marriage->bride_present_address = $request->bride_present_address;
        $marriage->bride_permanent_address = $request->bride_permanent_address;

        // Bride Files
        if ($request->hasFile('bride_photo_file')) {
            $marriage->bride_photo = $this->uploadFile($request, 'bride_photo_file');
        }
        elseif (!$marriage->bride_photo && $request->bride_user_id) {
            $brideUser = \App\Models\User::find($request->bride_user_id);
            if ($brideUser && $brideUser->image) {
                $marriage->bride_photo = $brideUser->image;
            }
        }
        if ($request->hasFile('bride_signature_file')) {
            $marriage->bride_signature = $this->uploadFile($request, 'bride_signature_file');
        }

        // 5. Witness Info
        $marriage->witness_1_name = $request->witness_1_name;
        $marriage->witness_1_nid = $request->witness_1_nid;
        $marriage->witness_1_mobile = $request->witness_1_mobile;
        $marriage->witness_1_address = $request->witness_1_address;
        if ($request->hasFile('witness_1_signature_file')) {
            $marriage->witness_1_signature = $this->uploadFile($request, 'witness_1_signature_file');
        }

        $marriage->witness_2_name = $request->witness_2_name;
        $marriage->witness_2_nid = $request->witness_2_nid;
        $marriage->witness_2_mobile = $request->witness_2_mobile;
        $marriage->witness_2_address = $request->witness_2_address;
        if ($request->hasFile('witness_2_signature_file')) {
            $marriage->witness_2_signature = $this->uploadFile($request, 'witness_2_signature_file');
        }

        // 6. Religion Specific
        if ($request->marriage_type === 'Islam') {
            $marriage->islam_kabin_number = $request->islam_kabin_number;
            $marriage->islam_den_mohor_amount = $request->islam_den_mohor_amount;
            $marriage->islam_den_mohor_type = $request->islam_den_mohor_type;
            $marriage->islam_bride_wakil_name = $request->islam_bride_wakil_name;
            $marriage->islam_groom_wakil_name = $request->islam_groom_wakil_name;
            $marriage->islam_kazi_name = $request->islam_kazi_name;
            $marriage->islam_kazi_license_no = $request->islam_kazi_license_no;
        } elseif ($request->marriage_type === 'Hindu') {
            $marriage->hindu_temple_name = $request->hindu_temple_name;
            $marriage->hindu_purohit_name = $request->hindu_purohit_name;
            $marriage->hindu_marriage_ritual_date = $request->hindu_marriage_ritual_date;
            $marriage->hindu_bride_gotra = $request->hindu_bride_gotra;
            $marriage->hindu_groom_gotra = $request->hindu_groom_gotra;
            $marriage->hindu_saptapadi_completed = $request->hindu_saptapadi_completed;
            $marriage->hindu_sacred_fire_ceremony = $request->hindu_sacred_fire_ceremony;
        } elseif ($request->marriage_type === 'Christian') {
            $marriage->christian_church_name = $request->christian_church_name;
            $marriage->christian_pastor_name = $request->christian_pastor_name;
            $marriage->christian_marriage_license_no = $request->christian_marriage_license_no;
            $marriage->christian_publication_of_banns = $request->christian_publication_of_banns;
            $marriage->christian_marriage_conducted_by = $request->christian_marriage_conducted_by;
        } elseif ($request->marriage_type === 'Other') {
            $marriage->other_religion_name = $request->other_religion_name;
            $marriage->other_religious_leader_name = $request->other_religious_leader_name;
            $marriage->other_ceremony_type = $request->other_ceremony_type;
            $marriage->other_organization_name = $request->other_organization_name;
            $marriage->other_other_details = $request->other_other_details;
        }

        // 7. Required Documents
        if ($request->hasFile('doc_groom_nid_file')) {
            $marriage->doc_groom_nid = $this->uploadFile($request, 'doc_groom_nid_file');
        }
        if ($request->hasFile('doc_bride_nid_file')) {
            $marriage->doc_bride_nid = $this->uploadFile($request, 'doc_bride_nid_file');
        }
        if ($request->hasFile('doc_birth_certificate_file')) {
            $marriage->doc_birth_certificate = $this->uploadFile($request, 'doc_birth_certificate_file');
        }
        if ($request->hasFile('doc_passport_photo_file')) {
            $marriage->doc_passport_photo = $this->uploadFile($request, 'doc_passport_photo_file');
        }
        if ($request->hasFile('doc_witness_nid_file')) {
            $marriage->doc_witness_nid = $this->uploadFile($request, 'doc_witness_nid_file');
        }
        if ($request->hasFile('doc_marriage_certificate_scan_file')) {
            $marriage->doc_marriage_certificate_scan = $this->uploadFile($request, 'doc_marriage_certificate_scan_file');
        }
        if ($request->hasFile('doc_other_file')) {
            $marriage->doc_other = $this->uploadFile($request, 'doc_other_file');
        }

        // 8. Registrar / Kazi Info
        $marriage->registrar_name = $request->registrar_name;
        $marriage->registrar_license = $request->registrar_license;
        $marriage->registrar_office_address = $request->registrar_office_address;
        if ($request->hasFile('registrar_office_seal_file')) {
            $marriage->registrar_office_seal = $this->uploadFile($request, 'registrar_office_seal_file');
        }
        if ($request->hasFile('registrar_signature_file')) {
            $marriage->registrar_signature = $this->uploadFile($request, 'registrar_signature_file');
        }

        $marriage->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Marriage Registration Form successfully updated!',
            'redirect_url' => route('marriage.index'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marriage  $marriage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $marriage = Marriage::findOrFail($id);
        $marriage->delete();

        return response()->json([
            'status' => true,
            'message' => 'Marriage record deleted successfully',
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
            AreaTenancy::personBelongsToAssignedUnion($request->groom_user_id),
            403,
            'The selected groom is not registered in your assigned union.'
        );

        abort_unless(
            AreaTenancy::personBelongsToAssignedUnion($request->bride_user_id),
            403,
            'The selected bride is not registered in your assigned union.'
        );
    }
}

