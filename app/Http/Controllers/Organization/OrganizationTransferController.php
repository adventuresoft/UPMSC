<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\CityCorporation;
use App\Models\Institute;
use App\Models\Organization\Organization;
use App\Models\Organization\OrganizationTransfer;
use App\Models\Pourashava;
use App\Models\Division;
use App\Models\District;
use App\Models\Thana;
use App\Models\Union;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class OrganizationTransferController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $data['organizations'] = Organization::where('status', 1)
            ->applyMultitenancy()
            ->latest()
            ->get();

        $data['divisions'] = Division::where('status', true)->get();

        $data['transferRequests'] = OrganizationTransfer::with([
            'organization.category',
            'organization.type',
            'toInstitute.union',
            'toInstitute.pourashava',
            'toInstitute.cityCorporation',
        ])
        ->where(function ($query) use ($user) {
            if ($user->institute_id) {
                $query->where('source_institute_id', $user->institute_id);
            } else {
                $query->where('requested_by', $user->id);
            }
        })
        ->latest()
        ->get();

        return view('backend.pages.organization.transfer_requests.index', $data);
    }

    public function incoming()
    {
        $user = Auth::user();
        $targetInstituteIds = $this->resolveUserAreaInstituteIds($user);

        $query = OrganizationTransfer::with([
            'organization.category',
            'organization.type',
            'sourceInstitute.union',
            'sourceInstitute.pourashava',
            'sourceInstitute.cityCorporation',
            'requestedBy',
        ])
        ->where('status', 'pending');

        if (!empty($targetInstituteIds)) {
            $query->whereIn('to_institute_id', $targetInstituteIds);
        } elseif ($user->institute_id) {
            $query->where('to_institute_id', $user->institute_id);
        } else {
            $query->whereRaw('0 = 1');
        }

        $data['transferRequests'] = $query->latest()->get();

        return view('backend.pages.organization.transfer_requests.incoming', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'organization_id' => 'required|integer|exists:organizations,id',
            'division_id' => 'nullable|integer|exists:divisions,id',
            'district_id' => 'required|integer|exists:districts,id',
            'thana_id' => 'nullable|integer|exists:thanas,id',
            'target_type' => 'required|in:union,pourashava,city_corporation',
            'target_id' => 'required|integer',
            'remarks' => 'nullable|string|max:1000',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Please check your entries.',
                'errors' => $validate->errors(),
            ], 422);
        }

        $organization = Organization::findOrFail($request->organization_id);

        if ($organization->status != 1) {
            return response()->json([
                'status' => false,
                'message' => 'Only approved organizations can be transferred.',
            ], 422);
        }

        if (OrganizationTransfer::where('organization_id', $organization->id)
            ->where('status', 'pending')
            ->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'A pending transfer already exists for this organization.',
            ], 422);
        }

        $targetInstitute = $this->resolveTargetInstitute(
            $request->target_type,
            $request->target_id,
            $request->district_id,
            $request->thana_id
        );

        if (!$targetInstitute) {
            return response()->json([
                'status' => false,
                'message' => 'The selected target authority was not found or is not valid for the selected area.',
            ], 422);
        }

        if ($targetInstitute->id === $organization->institute_id) {
            return response()->json([
                'status' => false,
                'message' => 'Target authority must be different from the current authority.',
            ], 422);
        }

        $transfer = OrganizationTransfer::create([
            'organization_id' => $organization->id,
            'source_institute_id' => $organization->institute_id,
            'to_institute_id' => $targetInstitute->id,
            'status' => 'pending',
            'requested_by' => Auth::id(),
            'remarks' => $request->remarks,
            'requested_at' => Carbon::now(),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Transfer request submitted successfully.',
            'result' => $transfer,
        ], 200);
    }

    public function approve(Request $request, $id)
    {
        $request->validate([
            'response_comment' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        $transfer = OrganizationTransfer::with('organization', 'toInstitute')->findOrFail($id);

        if ($transfer->status !== 'pending') {
            return response()->json([
                'status' => false,
                'message' => 'Only pending transfer requests can be approved.',
            ], 422);
        }

        $allowedInstituteIds = $this->resolveUserAreaInstituteIds($user);
        if (!empty($allowedInstituteIds) && !in_array($transfer->to_institute_id, $allowedInstituteIds, true)) {
            return response()->json([
                'status' => false,
                'message' => 'You are not authorized to approve this transfer request.',
            ], 403);
        }

        DB::transaction(function () use ($transfer, $user) {
            $transfer->status = 'approved';
            $transfer->responded_by = $user->id;
            $transfer->responded_at = Carbon::now();
            $transfer->save();

            $organization = $transfer->organization;
            $organization->institute_id = $transfer->to_institute_id;
            $organization->union_id = $transfer->toInstitute->union_id ?? null;
            if (isset($organization->updated_by)) {
                $organization->updated_by = $user->id;
            }
            $organization->save();
        });

        return response()->json([
            'status' => true,
            'message' => 'Transfer request approved and organization moved to the new authority.',
        ], 200);
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'response_comment' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        $transfer = OrganizationTransfer::findOrFail($id);

        if ($transfer->status !== 'pending') {
            return response()->json([
                'status' => false,
                'message' => 'Only pending transfer requests can be rejected.',
            ], 422);
        }

        $allowedInstituteIds = $this->resolveUserAreaInstituteIds($user);
        if (!empty($allowedInstituteIds) && !in_array($transfer->to_institute_id, $allowedInstituteIds, true)) {
            return response()->json([
                'status' => false,
                'message' => 'You are not authorized to reject this transfer request.',
            ], 403);
        }

        $transfer->status = 'rejected';
        $transfer->responded_by = $user->id;
        $transfer->responded_at = Carbon::now();
        $transfer->response_comment = $request->response_comment;
        $transfer->save();

        return response()->json([
            'status' => true,
            'message' => 'Transfer request rejected.',
        ], 200);
    }

    public function pourashavasByDistrict($districtId)
    {
        $pourashavas = Pourashava::where('district_id', $districtId)->where('status', true)->get();
        return response()->json($pourashavas);
    }

    private function resolveTargetInstitute(string $type, int $targetId, int $districtId, ?int $thanaId)
    {
        if ($type === 'union') {
            $union = Union::find($targetId);
            if (!$union || $union->thana_id !== $thanaId) {
                return null;
            }
            return Institute::where('union_id', $union->id)->first();
        }

        if ($type === 'pourashava') {
            $pourashava = Pourashava::find($targetId);
            if (!$pourashava || $pourashava->district_id !== $districtId) {
                return null;
            }
            return Institute::where('pourashava_id', $pourashava->id)->first();
        }

        if ($type === 'city_corporation') {
            $cityCorp = CityCorporation::find($targetId);
            if (!$cityCorp || $cityCorp->district_id !== $districtId) {
                return null;
            }
            return Institute::where('city_corporation_id', $cityCorp->id)->first();
        }

        return null;
    }

    private function resolveUserAreaInstituteIds($user)
    {
        if (!$user) {
            return [];
        }

        if ($user->institute_id) {
            return [$user->institute_id];
        }

        if (!$user->area || $user->area === 'All') {
            return [];
        }

        $area = trim($user->area);

        if (str_contains($area, 'Union:')) {
            $id = (int) trim(str_replace('Union:', '', $area));
            return Institute::where('union_id', $id)->pluck('id')->toArray();
        }

        if (str_contains($area, 'Pourashava:')) {
            $id = (int) trim(str_replace('Pourashava:', '', $area));
            return Institute::where('pourashava_id', $id)->pluck('id')->toArray();
        }

        if (str_contains($area, 'City Corp:')) {
            $id = (int) trim(str_replace('City Corp:', '', $area));
            return Institute::where('city_corporation_id', $id)->pluck('id')->toArray();
        }

        if (str_contains($area, 'Upazilla:')) {
            $id = (int) trim(str_replace('Upazilla:', '', $area));
            return Institute::whereHas('union', function ($query) use ($id) {
                $query->where('thana_id', $id);
            })->pluck('id')->toArray();
        }

        if (str_contains($area, 'District:')) {
            $id = (int) trim(str_replace('District:', '', $area));
            return Institute::where(function ($query) use ($id) {
                $query->whereHas('union.thana', function ($query) use ($id) {
                    $query->where('district_id', $id);
                })
                ->orWhereHas('pourashava', function ($query) use ($id) {
                    $query->where('district_id', $id);
                })
                ->orWhereHas('cityCorporation', function ($query) use ($id) {
                    $query->where('district_id', $id);
                });
            })->pluck('id')->toArray();
        }

        return [];
    }
}
