<?php

namespace App\Http\Controllers\Certificate;

use App\Http\Controllers\Controller;
use App\Models\Certificate\VoterAreaCertificate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;


class VoterAreaCertificateController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('unionAdmin')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = VoterAreaCertificate::with(['user' => function($q) {
            $q->applyMultitenancy();
        }]);
        
        if (Auth::user()->institute_id) {
            $query->whereHas('user', function($q1){
                $q1->applyMultitenancy();
            });
        }

        $data['certificates'] = $query->latest()->get();
        return view('backend.pages.certificate.voter_area.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['users'] = []; // Switched to AJAX search
        return view('backend.pages.certificate.voter_area.create', $data);
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
            'user_id' => 'required',
            'applicant_name' => 'required|string|max:255',
            'applicant_nid' => 'required|string|max:20',
            'applicant_dob' => 'nullable|date',
            'current_voter_no' => 'nullable|string|max:100',
            'current_voter_area_name' => 'nullable|string|max:255',
            'current_voter_area_no' => 'nullable|string|max:100',
            'current_upazila_thana' => 'nullable|string|max:255',
            'current_district' => 'nullable|string|max:255',
            'current_village_road' => 'nullable|string|max:255',
            'current_house_holding' => 'nullable|string|max:255',
            'transfer_district' => 'nullable|string|max:255',
            'transfer_upazila_thana' => 'nullable|string|max:255',
            'transfer_entity_type' => 'nullable|string|max:100',
            'transfer_entity_name' => 'nullable|string|max:255',
            'transfer_ward_no' => 'nullable|string|max:50',
            'transfer_voter_area_name' => 'nullable|string|max:255',
            'transfer_voter_area_no' => 'nullable|string|max:100',
            'transfer_village_road' => 'nullable|string|max:255',
            'transfer_house_holding' => 'nullable|string|max:100',
            'transfer_phone_mobile' => 'nullable|string|max:20',
            'transfer_post_office' => 'nullable|string|max:255',
            'transfer_post_code' => 'nullable|string|max:20',
            'staying_since' => 'nullable|string|max:255',
            'transfer_reason' => 'nullable|string',
            'identifier_name' => 'nullable|string|max:255',
            'identifier_nid' => 'nullable|string|max:20',
            'identifier_address' => 'nullable|string',
            'purpose' => 'nullable|string|max:255',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $result = DB::transaction(function () use ($request) {
            try {
                $certificate = new VoterAreaCertificate();
                $certificate->fill($request->all());
                $certificate->created_by = Auth::id();
                $certificate->status = 1; // Auto approved for admin submission
                $certificate->save();

                $data['status'] = true;
                $data['message'] = "Certificate generated successfully!";
                $data['result'] = $certificate;
                $data['code'] = 200;
                $data['redirect_url'] = route('voter-area.index');
                return $data;
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['message'] = "Something went wrong! Please try again...";
                $data['errors'] = $th->getMessage();
                return $data;
            }
        });

        return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'] ?? 500)->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Certificate\VoterAreaCertificate  $voterAreaCertificate
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $data['certificate'] = VoterAreaCertificate::with(array('user' => function($q1){
            $q1->with('people', 'familyInfo' )->with(array('addressInfo'=>function($q2){
                $q2->with('permanentVillage', 'presentWard', 'presentArea', 'permanentArea');
            }))->with(array('institute' => function($q3){
                $q3->with(array('union'=>function($q4){
                    $q4->with(array('thana'=>function($q5){
                        $q5->with('district');
                    }));
                }));
            }));
        }))->findOrFail($id);

        return view('backend.pages.certificate.voter_area.certificate', $data);
    }
    public function bn_certificate($id){
        $data['certificate'] = VoterAreaCertificate::with(array('user' => function($q1){
            $q1->with('people', 'familyInfo' )->with(array('addressInfo'=>function($q2){
                $q2->with('permanentVillage', 'presentWard', 'presentArea', 'permanentArea');
            }))->with(array('institute' => function($q3){
                $q3->with(array('union'=>function($q4){
                    $q4->with(array('thana'=>function($q5){
                        $q5->with('district');
                    }));
                }));
            }));
        }))->findOrFail($id);

        return view('backend.pages.certificate.voter_area.bn_certificate', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Certificate\VoterAreaCertificate  $voterAreaCertificate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['certificate'] = VoterAreaCertificate::findOrFail($id);
        return view('backend.pages.certificate.voter_area.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Certificate\VoterAreaCertificate  $voterAreaCertificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'applicant_name' => 'required|string|max:255',
            'applicant_nid' => 'required|string|max:20',
            'applicant_dob' => 'nullable|date',
            'current_voter_no' => 'nullable|string|max:100',
            'current_voter_area_name' => 'nullable|string|max:255',
            'current_voter_area_no' => 'nullable|string|max:100',
            'current_upazila_thana' => 'nullable|string|max:255',
            'current_district' => 'nullable|string|max:255',
            'current_village_road' => 'nullable|string|max:255',
            'current_house_holding' => 'nullable|string|max:255',
            'transfer_district' => 'nullable|string|max:255',
            'transfer_upazila_thana' => 'nullable|string|max:255',
            'transfer_entity_type' => 'nullable|string|max:100',
            'transfer_entity_name' => 'nullable|string|max:255',
            'transfer_ward_no' => 'nullable|string|max:50',
            'transfer_voter_area_name' => 'nullable|string|max:255',
            'transfer_voter_area_no' => 'nullable|string|max:100',
            'transfer_village_road' => 'nullable|string|max:255',
            'transfer_house_holding' => 'nullable|string|max:100',
            'transfer_phone_mobile' => 'nullable|string|max:20',
            'transfer_post_office' => 'nullable|string|max:255',
            'transfer_post_code' => 'nullable|string|max:20',
            'staying_since' => 'nullable|string|max:255',
            'transfer_reason' => 'nullable|string',
            'identifier_name' => 'nullable|string|max:255',
            'identifier_nid' => 'nullable|string|max:20',
            'identifier_address' => 'nullable|string',
            'purpose' => 'nullable|string|max:255',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        try {
            $certificate = VoterAreaCertificate::findOrFail($id);
            $certificate->fill($request->all());
            $certificate->save();

            return response()->json([
                'status' => true,
                'message' => 'Certificate updated successfully!',
                'redirect_url' => route('voter-area.index')
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong! ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Certificate\VoterAreaCertificate  $voterAreaCertificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(VoterAreaCertificate $voterAreaCertificate)
    {
        //
    }

    public function approve(Request $request)
    {
        try {
            $certificate = VoterAreaCertificate::findOrFail($request->id);
            $certificate->status = 1;
            $certificate->save();

            return response()->json([
                'status' => true,
                'message' => 'Application approved successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!'
            ]);
        }
    }
}
