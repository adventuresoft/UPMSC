<?php

namespace App\Http\Controllers;

use App\Models\ReliefCard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReliefCardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of relief card applications.
     */
    public function index()
    {
        $authUser = Auth::user();
        $instituteIds = $authUser->institutes ? $authUser->institutes->pluck('id') : [];
        
        if (empty($instituteIds) && $authUser->institute_id) {
            $instituteIds = [$authUser->institute_id];
        }

        $unionId = null;
        if (!empty($instituteIds)) {
            $institute = \App\Models\Institute::find($instituteIds[0]);
            if ($institute && $institute->union_id) {
                $unionId = $institute->union_id;
            }
        }

        $wards = [];
        if ($unionId) {
            $wards = \App\Models\UnionWard::where('union_id', $unionId)->get();
        }

        $reliefCards = ReliefCard::with([
            'user.people',
            'user.addressInfo.permanentVillage',
            'user.addressInfo.permanentWard',
            'user.addressInfo.permanentPostOffice',
            'user.institute.union.thana.district',
        ])
        ->applyMultitenancy()
        ->latest()
        ->get();

        $groupedByWard = [];
        foreach ($reliefCards as $card) {
            $wardId = $card->user->addressInfo?->permanent_ward_id ?? 'no_ward';
            if (!isset($groupedByWard[$wardId])) {
                $groupedByWard[$wardId] = [
                    'ward' => $card->user->addressInfo?->permanentWard ?? null,
                    'cards' => [],
                    'count' => 0,
                ];
            }
            // Add processed data to card for JS
            $cardArray = $card->toArray();
            $cardArray['user']['image_url'] = imageUrl($card->user?->image ?? 'default.png');
            $cardArray['edit_url'] = route('relief-card.edit', $card->id);
            $cardArray['delete_url'] = route('relief-card.destroy', $card->id);
            $groupedByWard[$wardId]['cards'][] = $cardArray;
            $groupedByWard[$wardId]['count']++;
        }

        return view('backend.pages.relief_card.index', compact('wards', 'groupedByWard', 'reliefCards'));
    }

    /**
     * Show the form for creating a relief card application.
     */
    public function create()
    {
        $authUser = Auth::user();
        $instituteIds = $authUser->institutes ? $authUser->institutes->pluck('id') : [];
        
        // If no institutes found, use the user's own institute_id if available
        if (empty($instituteIds) && $authUser->institute_id) {
            $instituteIds = [$authUser->institute_id];
        }

        // Get the union ID from the institute
        $unionId = null;
        if (!empty($instituteIds)) {
            $institute = \App\Models\Institute::find($instituteIds[0]);
            if ($institute && $institute->union_id) {
                $unionId = $institute->union_id;
            }
        }

        // Get union-specific wards if we have a union ID
        $wards = [];
        if ($unionId) {
            $wards = \App\Models\UnionWard::where('union_id', $unionId)->get();
        }

        $users = User::with(['people', 'addressInfo.permanentWard'])
            ->when(!empty($instituteIds), function($query) use ($instituteIds) {
                $query->whereHas('institute', function($q) use ($instituteIds) {
                    $q->whereIn('id', $instituteIds);
                });
            })
            ->orderBy('name')
            ->get();

        return view('backend.pages.relief_card.create', compact('users', 'wards'));
    }

    /**
     * Store a newly created relief card application in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'user_ids' => 'required|array|min:1',
            'user_ids.*' => 'exists:users,id',
            'relief_type' => 'required|string',
            'monthly_income' => 'required|numeric|min:0',
            'family_members' => 'required|integer|min:1',
            'reason' => 'nullable|string',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        try {
            $count = 0;
            foreach ($request->user_ids as $userId) {
                $reliefCard = new ReliefCard();
                $reliefCard->user_id = $userId;
                $reliefCard->relief_type = $request->relief_type;
                $reliefCard->monthly_income = $request->monthly_income;
                $reliefCard->family_members = $request->family_members;
                $reliefCard->reason = $request->reason;
                $reliefCard->status = 1; // Auto-approved when created by admin
                $reliefCard->created_by = Auth::id();
                $reliefCard->approved_by = Auth::id();
                $reliefCard->approved_at = now();
                $reliefCard->save();
                $count++;
            }

            $message = $count > 1 
                ? "{$count} Relief Cards created successfully!" 
                : "Relief Card created successfully!";

            return redirect()->route('relief-card.index')->with('success', $message);
        } catch (\Throwable $th) {
            return redirect()->back()
                ->with('error', 'Something went wrong! ' . $th->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing relief card.
     */
    public function edit($id)
    {
        $reliefCard = ReliefCard::findOrFail($id);
        $authUser = Auth::user();
        $instituteIds = $authUser->institutes ? $authUser->institutes->pluck('id') : [];
        
        // If no institutes found, use the user's own institute_id if available
        if (empty($instituteIds) && $authUser->institute_id) {
            $instituteIds = [$authUser->institute_id];
        }

        // Get the union ID from the institute
        $unionId = null;
        if (!empty($instituteIds)) {
            $institute = \App\Models\Institute::find($instituteIds[0]);
            if ($institute && $institute->union_id) {
                $unionId = $institute->union_id;
            }
        }

        // Get union-specific wards if we have a union ID
        $wards = [];
        if ($unionId) {
            $wards = \App\Models\UnionWard::where('union_id', $unionId)->get();
        }

        $users = User::with(['people', 'addressInfo.permanentWard'])
            ->when(!empty($instituteIds), function($query) use ($instituteIds) {
                $query->whereHas('institute', function($q) use ($instituteIds) {
                    $q->whereIn('id', $instituteIds);
                });
            })
            ->orderBy('name')
            ->get();

        return view('backend.pages.relief_card.edit', compact('reliefCard', 'users', 'wards'));
    }

    /**
     * Update the specified relief card.
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'relief_type' => 'required|string',
            'monthly_income' => 'required|numeric|min:0',
            'family_members' => 'required|integer|min:1',
            'reason' => 'nullable|string',
            'status' => 'required|integer|in:0,1,2,3,4',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        try {
            $reliefCard = ReliefCard::findOrFail($id);
            $reliefCard->user_id = $request->user_id;
            $reliefCard->relief_type = $request->relief_type;
            $reliefCard->monthly_income = $request->monthly_income;
            $reliefCard->family_members = $request->family_members;
            $reliefCard->reason = $request->reason;
            $reliefCard->status = $request->status;
            $reliefCard->save();

            return redirect()->route('relief-card.index')->with('success', 'Relief Card updated successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()
                ->with('error', 'Something went wrong! ' . $th->getMessage())
                ->withInput();
        }
    }

    /**
     * Approve the relief card application.
     */
    public function approve(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id' => 'required|exists:relief_cards,id',
        ]);

        if ($validate->fails()) {
            return response()->json(['status' => false, 'message' => 'Invalid Request'], 400);
        }

        try {
            $reliefCard = ReliefCard::findOrFail($request->id);
            $reliefCard->status = 1; // Approved
            $reliefCard->approved_by = Auth::id();
            $reliefCard->approved_at = now();
            $reliefCard->save();

            return response()->json(['status' => true, 'message' => 'Relief Card approved successfully!']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Error approving relief card application', 'error' => $th->getMessage()], 500);
        }
    }

    /**
     * Reject the relief card application.
     */
    public function reject(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id' => 'required|exists:relief_cards,id',
        ]);

        if ($validate->fails()) {
            return response()->json(['status' => false, 'message' => 'Invalid Request'], 400);
        }

        try {
            $reliefCard = ReliefCard::findOrFail($request->id);
            $reliefCard->status = 2; // Rejected
            $reliefCard->save();

            return response()->json(['status' => true, 'message' => 'Relief Card application rejected successfully!']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Error rejecting relief card application', 'error' => $th->getMessage()], 500);
        }
    }

    /**
     * Update status.
     */
    public function updateStatus(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id' => 'required|exists:relief_cards,id',
            'status' => 'required|integer|in:0,1,2,3,4',
        ]);

        if ($validate->fails()) {
            return response()->json(['status' => false, 'message' => 'Invalid Request'], 400);
        }

        try {
            $reliefCard = ReliefCard::findOrFail($request->id);
            $reliefCard->status = $request->status;
            $reliefCard->save();

            $statusText = ['Pending', 'Approved', 'Rejected', 'Received', 'Dispatched'][$request->status];
            return response()->json(['status' => true, 'message' => "Relief Card status updated to {$statusText}!"]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Error updating relief card status', 'error' => $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $reliefCard = ReliefCard::findOrFail($id);
            $reliefCard->delete();
            return redirect()->route('relief-card.index')->with('success', 'Relief Card application deleted successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Delete all relief cards for a ward
     */
    public function deleteWard(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'ward_id' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', 'Invalid request!');
        }

        try {
            // Get all cards for this ward
            $wardId = $request->ward_id;
            $cards = ReliefCard::whereHas('user.addressInfo', function($q) use ($wardId) {
                $q->where('permanent_ward_id', $wardId);
            })
            ->orWhereDoesntHave('user.addressInfo')
            ->applyMultitenancy()
            ->get();

            $count = 0;
            foreach ($cards as $card) {
                $card->delete();
                $count++;
            }

            return redirect()->route('relief-card.index')->with('success', "Successfully deleted {$count} relief cards!");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong! ' . $th->getMessage());
        }
    }
}
