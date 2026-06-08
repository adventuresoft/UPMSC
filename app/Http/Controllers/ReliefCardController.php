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
        $reliefCards = ReliefCard::with([
            'user.people',
            'user.addressInfo.permanentVillage',
            'user.addressInfo.permanentWard',
            'user.addressInfo.permanentPostOffice',
            'user.institute.union.thana.district'
        ])
        ->applyMultitenancy()
        ->latest()
        ->get();

        return view('backend.pages.relief_card.index', compact('reliefCards'));
    }

    /**
     * Show the form for creating a new relief card application.
     */
    public function create()
    {
        $authUser = Auth::user();
        $instituteIds = $authUser->institutes ? $authUser->institutes->pluck('id') : [];
        
        // If no institutes found, use the user's own institute_id if available
        if (empty($instituteIds) && $authUser->institute_id) {
            $instituteIds = [$authUser->institute_id];
        }

        $users = User::with('people')
            ->when(!empty($instituteIds), function($query) use ($instituteIds) {
                $query->whereHas('institute', function($q) use ($instituteIds) {
                    $q->whereIn('id', $instituteIds);
                });
            })
            ->orderBy('name')
            ->get();

        return view('backend.pages.relief_card.create', compact('users'));
    }

    /**
     * Store a newly created relief card application in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
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
            $reliefCard = new ReliefCard();
            $reliefCard->user_id = $request->user_id;
            $reliefCard->relief_type = $request->relief_type;
            $reliefCard->monthly_income = $request->monthly_income;
            $reliefCard->family_members = $request->family_members;
            $reliefCard->reason = $request->reason;
            $reliefCard->status = 1; // Auto-approved when created by admin
            $reliefCard->created_by = Auth::id();
            $reliefCard->approved_by = Auth::id();
            $reliefCard->approved_at = now();
            $reliefCard->save();

            return redirect()->route('relief-card.index')->with('success', 'Relief Card created successfully!');
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
}
