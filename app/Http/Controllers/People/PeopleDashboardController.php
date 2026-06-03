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
        $people = Auth::guard('people')->user()->load([
            'user.educationInfos', 
            'user.professionalInfos', 
            'user.financialInfos', 
            'user.propertyInfos', 
            'user.disabilityInfo', 
            'user.freedomFighterInfo',
            'user.familyInfo',
            'user.addressInfo'
        ]);
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

    /**
     * Update the portal user profile image.
     */
    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $people = Auth::guard('people')->user();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = 'citizen-' . $people->id . '-' . time();
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . "." . $ext;
            $upload_path = 'uploads/citizens/';
            $image_url = $upload_path . $image_full_name;

            // Ensure directory exists
            if (!file_exists(base_path($upload_path))) {
                mkdir(base_path($upload_path), 0777, true);
            }

            // Move the file
            $image->move(base_path($upload_path), $image_full_name);

            // Delete old image if exists
            if ($people->image && file_exists(base_path($people->image))) {
                @unlink(base_path($people->image));
            }

            // Update database
            $people->image = $image_url;
            $people->save();

            return back()->with('success', 'Profile image updated successfully.');
        }

        return back()->withErrors(['image' => 'Failed to upload image.']);
    }
}

