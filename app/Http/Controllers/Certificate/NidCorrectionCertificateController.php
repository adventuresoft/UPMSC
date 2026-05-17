<?php

namespace App\Http\Controllers\Certificate;

use App\Http\Controllers\Controller;
use App\Models\Certificate\NidCorrectionCertificate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NidCorrectionCertificateController extends Controller
{
    public function index()
    {
        $data['certificates'] = NidCorrectionCertificate::with('user.people', 'user.addressInfo.permanentVillage', 'user.addressInfo.permanentWard', 'user.addressInfo.permanentPostOffice', 'user.institute.union.thana.district')
            ->applyMultitenancy()
            ->latest()
            ->get();
        return view('backend.pages.certificate.nid_correction.index', $data);
    }

    public function create()
    {
        $data['users'] = []; // AJAX search used in view
        return view('backend.pages.certificate.nid_correction.create', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'user_id'        => 'required',
            'applicant_name' => 'nullable|string|max:190',
            'applicant_nid'  => 'nullable|string|max:20',
        ]);

        if ($validate->fails()) {
            return response()->json(['status' => false, 'message' => "Invalid Entry.", 'errors' => $validate->errors()], 400);
        }

        $result = DB::transaction(function () use ($request) {
            try {
                $certificate = new NidCorrectionCertificate();
                $certificate->fill($request->all());
                
                // Filter only active corrections for the JSON field if needed, 
                // but we can just store the whole array
                $certificate->correction_data = $request->correction_data;
                
                $certificate->created_by = Auth::id();
                $certificate->payment_amount = $request->payment_amount ?: 0;
                $certificate->status = 1; // Auto approved for admin
                $certificate->save();

                return [
                    'status' => true,
                    'message' => "NID Correction application generated successfully!",
                    'redirect_url' => route('nid-correction.index')
                ];
            } catch (\Throwable $th) {
                return ['status' => false, 'message' => "Error: " . $th->getMessage(), 'error' => $th->getMessage()];
            }
        });

        return response()->json($result, $result['status'] ? 200 : 500);
    }

    public function show($id)
    {
        $data['certificate'] = NidCorrectionCertificate::with('user.people', 'user.familyInfo', 'user.addressInfo', 'user.institute.union.thana.district')->findOrFail($id);
        return view('backend.pages.certificate.nid_correction.certificate', $data);
    }

    public function bn_certificate($id)
    {
        $data['certificate'] = NidCorrectionCertificate::with('user.people', 'user.familyInfo', 'user.addressInfo', 'user.institute.union.thana.district')->findOrFail($id);
        return view('backend.pages.certificate.nid_correction.bn_certificate', $data);
    }

    public function approve(Request $request)
    {
        try {
            $certificate = NidCorrectionCertificate::findOrFail($request->id);
            $certificate->status = 1;
            $certificate->save();
            return response()->json(['status' => true, 'message' => 'Approved successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Error approving!']);
        }
    }

    public function edit($id)
    {
        $data['certificate'] = NidCorrectionCertificate::findOrFail($id);
        return view('backend.pages.certificate.nid_correction.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'applicant_name' => 'nullable|string|max:190',
            'applicant_nid'  => 'nullable|string|max:20',
        ]);

        if ($validate->fails()) {
            return response()->json(['status' => false, 'message' => "Invalid Entry.", 'errors' => $validate->errors()], 400);
        }

        try {
            $certificate = NidCorrectionCertificate::findOrFail($id);
            $certificate->fill($request->all());
            
            // Filter only active corrections for the JSON field if needed, 
            // but we can just store the whole array
            $certificate->correction_data = $request->correction_data;
            
            $certificate->payment_amount = $request->payment_amount ?: 0;
            $certificate->save();

            return response()->json([
                'status' => true,
                'message' => "NID Correction application updated successfully!",
                'redirect_url' => route('nid-correction.index')
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => "Error: " . $th->getMessage(), 'error' => $th->getMessage()], 500);
        }
    }
}
