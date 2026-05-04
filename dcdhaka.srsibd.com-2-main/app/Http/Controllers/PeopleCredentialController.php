<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Services\PeopleCredentialService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeopleCredentialController extends Controller
{
    protected $credentialService;

    public function __construct(PeopleCredentialService $credentialService)
    {
        $this->credentialService = $credentialService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of approved people with their credentials.
     */
    public function index(Request $request)
    {
        $query = People::with('user')->whereNotNull('approved_id');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('approved_id', 'like', "%$search%")
                  ->orWhere('name', 'like', "%$search%")
                  ->orWhere('login_id', 'like', "%$search%");
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('login_status', $request->status);
        }

        $data['people'] = $query->latest('credentials_set_at')->paginate(20);
        $data['stats'] = [
            'total' => People::whereNotNull('approved_id')->count(),
            'active' => People::where('login_status', 'active')->count(),
            'suspended' => People::where('login_status', 'suspended')->count(),
        ];

        return view('backend.pages.people.credentials', $data);
    }

    /**
     * Securely reveal a person's password hint to an authenticated admin.
     */
    public function reveal($id)
    {
        $people = People::findOrFail($id);
        $password = $this->credentialService->decryptHint($people);

        return response()->json([
            'status' => true,
            'password' => $password
        ]);
    }

    /**
     * Toggle the login status (active/suspended) for a person.
     */
    public function toggleStatus($id)
    {
        $people = People::findOrFail($id);
        
        if ($people->login_status === 'active') {
            $this->credentialService->suspendLogin($people);
            $message = "Login access suspended.";
        } else {
            $this->credentialService->activateLogin($people);
            $message = "Login access activated.";
        }

        return response()->json([
            'status' => true,
            'message' => $message,
            'new_status' => $people->login_status
        ]);
    }

    /**
     * Reset a person's credentials from the admin panel.
     */
    public function reset(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $people = People::findOrFail($id);
        $this->credentialService->resetCredentials($people, $request->password, Auth::user());

        return response()->json([
            'status' => true,
            'message' => 'Credentials reset successfully.'
        ]);
    }
}
