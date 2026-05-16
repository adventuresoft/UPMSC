<?php

namespace App\Http\Controllers\Certificate;

use App\Http\Controllers\Controller;
use App\Models\Certificate\BirthCertificate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class BirthCertificateController extends Controller
{
    public function __construct()
    {
        $this->middleware('unionAdmin')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['certificates'] = BirthCertificate::with([
            'user.people',
            'user.familyInfo',
            'user.addressInfo.permanentVillage',
            'user.addressInfo.permanentWard',
            'user.addressInfo.permanentPostOffice',
            'user.institute.union.thana.district',
        ])
        ->applyMultitenancy()
        ->latest()
        ->get();

        return view('backend.pages.certificate.birth.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['users'] = User::with('people')
            ->where('status', true)
            ->where('role_id', 5)
            ->applyMultitenancy()
            ->whereHas('people', function ($q) {
                $q->whereNotNull('approved_id');
            })
            ->get();

        return view('backend.pages.certificate.birth.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Sorry! Invalid Entry.',
                'errors'  => $validate->errors(),
                'code'    => 400,
            ], 400);
        }

        $result = DB::transaction(function () use ($request) {
            try {
                $certificate           = new BirthCertificate();
                $certificate->user_id  = $request->user_id;
                $certificate->created_by = Auth::id();
                $certificate->save();

                return [
                    'status'       => true,
                    'message'      => 'Birth certificate generated successfully!',
                    'result'       => $certificate,
                    'code'         => 200,
                    'redirect_url' => route('certificate/birth.index'),
                ];
            } catch (\Throwable $th) {
                return [
                    'status'  => false,
                    'message' => 'Something went wrong! Please try again...',
                    'errors'  => $th->getMessage(),
                    'code'    => 500,
                ];
            }
        });

        return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])
            ->header('Content-Type', 'application/json');
    }

    /**
     * Display / print the certificate (EN).
     */
    public function show($id)
    {
        $data['certificate'] = BirthCertificate::with([
            'user.people',
            'user.familyInfo',
            'user.addressInfo.permanentVillage',
            'user.addressInfo.permanentWard',
            'user.addressInfo.permanentPostOffice',
            'user.institute.union.thana.district',
        ])->findOrFail($id);

        return view('backend.pages.certificate.birth.certificate', $data);
    }

    /**
     * Display / print the certificate (BN).
     */
    public function bn_certificate($id)
    {
        $data['certificate'] = BirthCertificate::with([
            'user.people',
            'user.familyInfo',
            'user.addressInfo.permanentVillage',
            'user.addressInfo.permanentWard',
            'user.addressInfo.permanentPostOffice',
            'user.institute.union.thana.district',
        ])->findOrFail($id);

        return view('backend.pages.certificate.birth.bn_certificate', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['certificate'] = BirthCertificate::applyMultitenancy()->findOrFail($id);
        $data['users'] = User::with('people')
            ->where('status', true)
            ->where('role_id', 5)
            ->applyMultitenancy()
            ->whereHas('people', function ($q) {
                $q->whereNotNull('approved_id');
            })
            ->get();

        return view('backend.pages.certificate.birth.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $certificate = BirthCertificate::applyMultitenancy()->findOrFail($id);

        $validate = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Sorry! Invalid Entry.',
                'errors'  => $validate->errors(),
            ], 400);
        }

        try {
            $certificate->user_id = $request->user_id;
            $certificate->save();

            return response()->json([
                'status'       => true,
                'message'      => 'Certificate updated successfully!',
                'redirect_url' => route('certificate/birth.index'),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => 'Update failed: ' . $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $certificate = BirthCertificate::applyMultitenancy()->findOrFail($id);
            $certificate->delete();

            return response()->json([
                'status'  => true,
                'message' => 'Certificate deleted successfully!',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => 'Delete failed: ' . $th->getMessage(),
            ], 500);
        }
    }
}
