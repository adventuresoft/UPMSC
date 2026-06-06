<?php

namespace App\Http\Controllers;

use App\Models\ReliefCard;
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
