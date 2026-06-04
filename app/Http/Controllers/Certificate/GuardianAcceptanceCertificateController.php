<?php

namespace App\Http\Controllers\Certificate;

use App\Http\Controllers\Controller;
use App\Models\Certificate\GuardianAcceptanceCertificate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GuardianAcceptanceCertificateController extends Controller
{
    public function __construct()
    {
        $this->middleware('unionAdmin')->except('index', 'show');
    }
   
    public function index()
    {
        $data['certificates'] = GuardianAcceptanceCertificate::with([
            'user.people',
            'user.addressInfo.permanentVillage',
            'user.addressInfo.permanentWard',
            'user.addressInfo.permanentPostOffice',
            'user.institute.union.thana.district',
            'guardian.people'
        ])
        ->applyMultitenancy()
        ->latest()
        ->get();
        return view('backend.pages.certificate.guardian_acceptance.index', $data);
    }

    public function create()
    {
        $data['users'] = []; 
        return view('backend.pages.certificate.guardian_acceptance.create', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'user_id' => 'required',
            'guardian_id' => 'required',
            'guardian_relation' => 'required|string|max:255',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $result = DB::transaction(function () use ($request) {
            $certificate = new GuardianAcceptanceCertificate();
            $certificate->user_id = $request->user_id;
            $certificate->guardian_id = $request->guardian_id;
            $certificate->guardian_relation = $request->guardian_relation;
            $certificate->created_by = Auth::id();
            $certificate->status = 1;

            try {
                $certificate->save();
                $data['status'] = true;
                $data['message'] = "Certificate generated successfully!";
                $data['result'] = $certificate;
                $data['code'] = 200;
                $data['redirect_url'] = route('guardian-acceptance.index');
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

    public function show($id)
    {
        $data['certificate'] = GuardianAcceptanceCertificate::with(array('user' => function($q1){
            $q1->with('people', 'familyInfo' )->with(array('addressInfo'=>function($q2){
                $q2->with('permanentVillage', 'presentWard', 'presentArea', 'permanentArea', 'permanentPostOffice');
            }))->with(array('institute' => function($q3){
                $q3->with(array('union'=>function($q4){
                    $q4->with(array('thana'=>function($q5){
                        $q5->with('district');
                    }));
                }));
            }));
        }, 'guardian' => function($q1){
            $q1->with('people');
        }))->findOrFail($id);

        return view('backend.pages.certificate.guardian_acceptance.certificate', $data);
    }

    public function bn_certificate($id){
        $data['certificate'] = GuardianAcceptanceCertificate::with(array('user' => function($q1){
            $q1->with('people', 'familyInfo' )->with(array('addressInfo'=>function($q2){
                $q2->with('permanentVillage', 'presentWard', 'presentArea', 'permanentArea', 'permanentPostOffice');
            }))->with(array('institute' => function($q3){
                $q3->with(array('union'=>function($q4){
                    $q4->with(array('thana'=>function($q5){
                        $q5->with('district');
                    }));
                }));
            }));
        }, 'guardian' => function($q1){
            $q1->with('people');
        }))->findOrFail($id);

        return view('backend.pages.certificate.guardian_acceptance.bn_certificate', $data);
    }

    public function edit($id)
    {
        $data['certificate'] = GuardianAcceptanceCertificate::findOrFail($id);
        return view('backend.pages.certificate.guardian_acceptance.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'guardian_relation' => 'required|string|max:255',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        try {
            $certificate = GuardianAcceptanceCertificate::findOrFail($id);
            if ($request->has('guardian_id')) {
                $certificate->guardian_id = $request->guardian_id;
            }
            if ($request->has('user_id')) {
                $certificate->user_id = $request->user_id;
            }
            $certificate->guardian_relation = $request->guardian_relation;
            $certificate->save();

            return response()->json([
                'status' => true,
                'message' => 'Certificate updated successfully!',
                'redirect_url' => route('guardian-acceptance.index')
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong! ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $cert = GuardianAcceptanceCertificate::findOrFail($id);
        $cert->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
