<?php

namespace App\Http\Controllers\Certificate;

use App\Http\Controllers\Controller;
use App\Models\Certificate\MarriedCertificate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class MarriedCertificateController extends Controller
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
        $data['certificates'] = MarriedCertificate::with(['user.people', 'husband.people', 'wife.people'])
        ->whereHas('user', function($q1){
            $q1->where('institute_id', Auth::user()->institute_id);
        })->latest()->get();
        return view('backend.pages.certificate.married.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['users'] = User::with('people')
        ->where('status', true)
        ->where('role_id', 5)
        ->whereHas('people', function ($q) {$q->whereNotNull('approved_id');})
        ->where('institute_id', Auth::user()->institute_id)
        ->get();
        return view('backend.pages.certificate.married.create', $data);
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
            'user_id' => 'required|exists:users,id',
            'spouse_name' => 'required|string|max:190',
            'spouse_nid' => 'required|string|max:190',
            'marriage_date' => 'nullable|date',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $result = DB::transaction(function () use ($request) {
            $user = User::with('people')
                ->where('id', $request->user_id)
                ->where('institute_id', Auth::user()->institute_id)
                ->first();

            if (!$user || !$user->people) {
                return [
                    'status' => false,
                    'message' => "Selected people data was not found.",
                    'errors' => [
                        'user_id' => ['Selected people data was not found.'],
                    ],
                    'code' => 422,
                ];
            }

            $gender = strtolower(trim((string) $user->people->gender));
            $isHusband = in_array($gender, ['1', 'male', 'm'], true);
            if (!$isHusband) {
                return [
                    'status' => false,
                    'message' => "Please select husband from People list.",
                    'errors' => [
                        'user_id' => ['Please select husband from People list.'],
                    ],
                    'code' => 422,
                ];
            }

            $certificate = new MarriedCertificate();
            $hasSpouseNameColumn = Schema::hasColumn('married_certificates', 'spouse_name');
            $hasSpouseNidColumn = Schema::hasColumn('married_certificates', 'spouse_nid');
            $certificate->user_id = $user->id;
            $certificate->husband_id = $user->id;
            $certificate->husband_system_id = $user->people->approved_id ?? $user->system_id ?? null;
            $certificate->wife_system_id = $request->spouse_nid;
            if ($hasSpouseNameColumn) {
                $certificate->spouse_name = $request->spouse_name;
            }
            if ($hasSpouseNidColumn) {
                $certificate->spouse_nid = $request->spouse_nid;
            }
            $certificate->marriage_date = $request->marriage_date;
            $certificate->created_by = Auth::id();

            try {
                $certificate->save();
                $data['status'] = true;
                $data['message'] = "Certificate generated successfully!";
                $data['result'] = $certificate;
                $data['code'] = 200;
                $data['redirect_url'] = route('married.index');
                // $data['redirect_url'] = route('married.show', $certificate->id);
                return $data;
            } catch (\Throwable $th) {
                report($th);
                $data['status'] = false;
                $data['message'] = config('app.debug') ? $th->getMessage() : "Something went wrong! Please try again...";
                $data['errors'] = config('app.debug') ? $th->getTrace() : [];
                $data['code'] = 500;
                return $data;
            }
        });

        return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Certificate\MarriedCertificate  $marriedCertificate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['certificate'] = MarriedCertificate::with(array('user' => function($q1){
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
        return view('backend.pages.certificate.married.certificate', $data);
        $html = view('backend.pages.certificate.married.certificate', $data)->render();
        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape')
        ->setOptions([
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ]);
        return $pdf->stream('married-certificate.pdf');
    }

    public function bn_certificate($id){
        $data['certificate'] = MarriedCertificate::with(array('user' => function($q1){
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
        return view('backend.pages.certificate.married.bn_certificate', $data);
        $html = view('backend.pages.certificate.married.certificate', $data)->render();
        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape')
        ->setOptions([
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ]);
        return $pdf->stream('married-certificate.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Certificate\MarriedCertificate  $marriedCertificate
     * @return \Illuminate\Http\Response
     */
    public function edit(MarriedCertificate $marriedCertificate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Certificate\MarriedCertificate  $marriedCertificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MarriedCertificate $marriedCertificate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Certificate\MarriedCertificate  $marriedCertificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(MarriedCertificate $marriedCertificate)
    {
        //
    }
}
