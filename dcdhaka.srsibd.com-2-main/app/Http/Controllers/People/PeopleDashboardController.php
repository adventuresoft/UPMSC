<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PeopleDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:people');
    }

    /**
     * Show the portal dashboard.
     */
    public function index()
    {
        $people = Auth::guard('people')->user();
        $mainMenu = 'Dashboard';
        $subMenu = 'dashboard';
        return view('people.dashboard.index', compact('people', 'mainMenu', 'subMenu'));
    }

    /**
     * Show the portal user profile.
     */
    public function profile()
    {
        $people = Auth::guard('people')->user()->load('user.addressInfo', 'user.familyInfo');
        $mainMenu = 'Profile';
        $subMenu = 'profile';
        return view('people.dashboard.profile', compact('people', 'mainMenu', 'subMenu'));
    }

    /**
     * Show the change password form.
     */
    public function showChangePassword()
    {
        $mainMenu = 'Security';
        $subMenu = 'password.change';
        return view('people.dashboard.change-password', compact('mainMenu', 'subMenu'));
    }

    /**
     * Update the portal user password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $people = Auth::guard('people')->user();

        if (!Hash::check($request->current_password, $people->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match.']);
        }

        $people->password = Hash::make($request->password);
        $people->save();

        return back()->with('success', 'Password updated successfully.');
    }
}
