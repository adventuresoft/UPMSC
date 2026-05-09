<?php

namespace App\Http\Controllers\Certificate;

use App\Http\Controllers\Controller;
use App\Models\Certificate\NidCorrectionCertificate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;


class NidCorrectionCertificateController extends Controller
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
        $query = NidCorrectionCertificate::with('user');
        
        if (Auth::user()->institute_id) {
            $query->whereHas('user', function($q1){
                $q1->where('institute_id', Auth::user()->institute_id);
            });
        }

        $data['certificates'] = $query->latest()->get();
        return view('backend.pages.certificate.nid_correction.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['users'] = []; // Switched to AJAX search
        return view('backend.pages.certificate.nid_correction.create', $data);
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
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $result = DB::transaction(function () use ($request) {
            try {
                $certificate = new NidCorrectionCertificate();
                $certificate->fill($request->all());
                $certificate->created_by = Auth::id();
                $certificate->status = 1; // Auto approved for admin submission
                $certificate->save();

                $data['status'] = true;
                $data['message'] = "Certificate generated successfully!";
                $data['result'] = $certificate;
                $data['code'] = 200;
                $data['redirect_url'] = route('nid-correction.index');
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
     * @param  \App\Models\Certificate\NidCorrectionCertificate  $nidCorrectionCertificate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['certificate'] = NidCorrectionCertificate::with(array('user' => function($q1){
            $q1->with('people', 'familyInfo' )->with(array('addressInfo'=>function($q2){
                $q2->with('permanentVillage', 'presentWard', 'presentArea', 'permanentArea');
            }))->with(array('institute' => function($q3){
                $q3->with(array('union'=>function($q4){
                    $q4->with(array('thana'=>function($q5){
                        $q5->with('district');
                    }));
                }));
            }));
        }))->find($id);
        // return response()->json($data, 200);
        return view('backend.pages.certificate.nid_correction.certificate', $data);
        $html = view('backend.pages.certificate.nid_correction.certificate', $data)->render();
        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape')
        ->setOptions([
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ]);
        return $pdf->stream('nid_correction-certificate.pdf');
    }
    public function bn_certificate($id){
        $data['certificate'] = NidCorrectionCertificate::with(array('user' => function($q1){
            $q1->with('people', 'familyInfo' )->with(array('addressInfo'=>function($q2){
                $q2->with('permanentVillage', 'presentWard', 'presentArea', 'permanentArea');
            }))->with(array('institute' => function($q3){
                $q3->with(array('union'=>function($q4){
                    $q4->with(array('thana'=>function($q5){
                        $q5->with('district');
                    }));
                }));
            }));
        }))->find($id);
        // return response()->json($data, 200);
        return view('backend.pages.certificate.nid_correction.bn_certificate', $data);
        $html = view('backend.pages.certificate.nid_correction.certificate', $data)->render();
        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape')
        ->setOptions([
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ]);
        return $pdf->stream('nid_correction-certificate.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Certificate\NidCorrectionCertificate  $nidCorrectionCertificate
     * @return \Illuminate\Http\Response
     */
    public function edit(NidCorrectionCertificate $nidCorrectionCertificate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Certificate\NidCorrectionCertificate  $nidCorrectionCertificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NidCorrectionCertificate $nidCorrectionCertificate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Certificate\NidCorrectionCertificate  $nidCorrectionCertificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(NidCorrectionCertificate $nidCorrectionCertificate)
    {
        //
    }

    public function approve(Request $request)
    {
        try {
            $certificate = NidCorrectionCertificate::findOrFail($request->id);
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
