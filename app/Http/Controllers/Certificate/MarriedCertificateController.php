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
        $data['certificates'] = MarriedCertificate::with([
            'user.people',
            'user.addressInfo.permanentVillage',
            'user.addressInfo.permanentWard',
            'user.addressInfo.permanentPostOffice',
            'user.institute.union.thana.district',
            'husband.people',
            'wife.people'
        ])
        ->applyMultitenancy()
        ->latest()
        ->get();
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
        ->applyMultitenancy()
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
            'spouse_identifier' => 'nullable|string|max:190',
            'spouse_user_id' => 'nullable|integer|exists:users,id',
            'spouse_name' => 'nullable|string|max:190',
            'spouse_nid' => 'nullable|string|max:190',
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
                ->applyMultitenancy()
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

            $spouseUser = null;
            $spouseIdentifier = trim((string) $request->spouse_identifier);

            if ($request->filled('spouse_user_id')) {
                $spouseUser = User::with('people')
                    ->where('id', $request->spouse_user_id)
                    ->where('role_id', 5)
                    ->applyMultitenancy()
                    ->first();
            }

            if (!$spouseUser && $spouseIdentifier !== '') {
                $spouseUserQuery = User::with('people')
                    ->where('role_id', 5)
                    ->applyMultitenancy()
                    ->where(function ($query) use ($spouseIdentifier) {
                        $query->where('system_id', $spouseIdentifier)
                            ->orWhereHas('people', function ($q) use ($spouseIdentifier) {
                                $q->where('approved_id', $spouseIdentifier);
                            });

                        if (ctype_digit($spouseIdentifier)) {
                            $query->orWhere('id', (int) $spouseIdentifier);
                        }
                    });

                $spouseUser = $spouseUserQuery->first();
            }

            if ($spouseUser && (int) $spouseUser->id === (int) $user->id) {
                return [
                    'status' => false,
                    'message' => "Husband and spouse cannot be the same person.",
                    'errors' => [
                        'spouse_identifier' => ['Husband and spouse cannot be the same person.'],
                    ],
                    'code' => 422,
                ];
            }

            $resolvedSpouseName = trim((string) $request->spouse_name);
            $resolvedSpouseNid = trim((string) $request->spouse_nid);
            $resolvedWifeSystemId = null;
            $resolvedWifeUserId = null;

            if ($spouseUser) {
                $resolvedWifeUserId = $spouseUser->id;
                $resolvedSpouseName = $spouseUser->name
                    ?? optional($spouseUser->people)->bn_name
                    ?? $resolvedSpouseName;
                $resolvedSpouseNid = $spouseUser->nid
                    ?? optional($spouseUser->people)->nid
                    ?? $resolvedSpouseNid;
                $resolvedWifeSystemId = optional($spouseUser->people)->approved_id
                    ?? $spouseUser->system_id
                    ?? ($spouseIdentifier ?: $resolvedSpouseNid);
                if ($resolvedSpouseNid === '') {
                    $resolvedSpouseNid = (string) ($spouseIdentifier ?: $resolvedWifeSystemId ?: '');
                }
            } else {
                if ($resolvedSpouseName === '' || $resolvedSpouseNid === '') {
                    $manualErrors = [];
                    if ($resolvedSpouseName === '') {
                        $manualErrors['spouse_name'] = ['Spouse name is required when spouse is not in Reg. list.'];
                    }
                    if ($resolvedSpouseNid === '') {
                        $manualErrors['spouse_nid'] = ['Spouse NID is required when spouse is not in Reg. list.'];
                    }
                    return [
                        'status' => false,
                        'message' => "Spouse information is required.",
                        'errors' => $manualErrors,
                        'code' => 422,
                    ];
                }
                $resolvedWifeSystemId = $resolvedSpouseNid;
            }

            $certificate = new MarriedCertificate();
            $hasSpouseNameColumn = Schema::hasColumn('married_certificates', 'spouse_name');
            $hasSpouseNidColumn = Schema::hasColumn('married_certificates', 'spouse_nid');
            $hasWifeIdColumn = Schema::hasColumn('married_certificates', 'wife_id');
            $hasWifeSystemIdColumn = Schema::hasColumn('married_certificates', 'wife_system_id');
            $certificate->user_id = $user->id;
            $certificate->husband_id = $user->id;
            $certificate->husband_system_id = $user->people->approved_id ?? $user->system_id ?? null;
            if ($hasWifeIdColumn) {
                $certificate->wife_id = $resolvedWifeUserId;
            }
            if ($hasWifeSystemIdColumn) {
                $certificate->wife_system_id = $resolvedWifeSystemId;
            }
            if ($hasSpouseNameColumn) {
                $certificate->spouse_name = $resolvedSpouseName;
            }
            if ($hasSpouseNidColumn) {
                $certificate->spouse_nid = $resolvedSpouseNid;
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
