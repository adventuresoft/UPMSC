<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use App\Models\People;
use App\Models\PeopleLoginLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class PeopleAuthController extends Controller
{
    /**
     * Show the portal login page.
     */
    public function showLogin()
    {
        return view('people.auth.login');
    }

    /**
     * Handle portal login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'login_id' => 'required|string',
            'password' => 'required|string',
        ]);

        $throttleKey = Str::lower($request->input('login_id')) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            return back()->withErrors([
                'login_id' => 'Too many attempts. Please try again in 15 minutes.'
            ]);
        }

        $credentials = $request->only('login_id', 'password');

        // Try login with login_id (email)
        if (Auth::guard('people')->attempt($credentials)) {
            $people = Auth::guard('people')->user();
        } 
        // If failed, try login with approved_id (User ID)
        else {
            $approvedCredentials = [
                'approved_id' => $request->login_id,
                'password' => $request->password
            ];
            
            if (Auth::guard('people')->attempt($approvedCredentials)) {
                $people = Auth::guard('people')->user();
            } else {
                $people = null;
            }
        }

        if ($people) {

            if ($people->login_status === 'suspended') {
                Auth::guard('people')->logout();
                return back()->withErrors([
                    'login_id' => 'Your account has been suspended. Please contact the administrator.'
                ]);
            }

            RateLimiter::clear($throttleKey);

            $this->logLogin($people->id, 'success');

            return redirect()->route('people.dashboard');
        }

        RateLimiter::hit($throttleKey, 900); // 15 minutes throttle

        // Log failed attempt if user exists
        $user = People::where('login_id', $request->login_id)->first();
        if ($user) {
            $this->logLogin($user->id, 'failed');
        }

        return back()->withErrors([
            'login_id' => 'The login ID or password you entered is incorrect'
        ]);
    }

    /**
     * Handle portal logout.
     */
    public function logout()
    {
        Auth::guard('people')->logout();
        return redirect()->route('people.login');
    }

    /**
     * Log the login attempt.
     */
    protected function logLogin($peopleId, $status)
    {
        PeopleLoginLog::create([
            'people_id' => $peopleId,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'status' => $status
        ]);
    }
}
