<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\District;
use App\Models\Thana;
use App\Models\Union;
use App\Models\Pourashava;
use App\Models\CityCorporation;
use App\Models\Institute;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
       // $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $query = User::with(['roles', 'roles.permissions']);

        // Apply strict multitenancy (handles both staff and citizen visibility)
        $query->applyMultitenancy();

        // Ensure we only show staff/administrative users in the Operator Registry for local admins
        // Superadmins see every user in the system
        if (!is_superadmin()) {
            $query->where(function($q) {
                $q->whereNotIn('role_id', [5])
                  ->orWhereNotNull('institute_id');
            });
        }

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('mobile', 'like', "%{$search}%")
                  ->orWhere('system_id', 'like', "%{$search}%")
                  ->orWhere('area', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('id', 'desc')->paginate(15)->withQueryString();
        return view('backend.pages.user.index', compact('users'))->with(['title' => 'Operator Directory', 'page' => 'user']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        // Institutional admins can only assign sub-user roles
        if (is_institutional_admin()) {
            $institutionalAdminRoleId = Auth::user()->role_id;
            // Map admin roles to their corresponding sub-user roles
            $subUserRoleMap = [
                2 => [3, 6, 8, 10, 5, 7, 9, 11], // DC can create UNO/ENO and all local admins
                3 => [6, 8, 10, 5, 7, 9, 11],    // UNO/ENO can create Union/Pourashava/CityCorp admins
                6 => [6, 7],  // Union Admin -> can create Union Admin & User
                8 => [8, 9],  // Pourashava Admin -> can create Pourashava Admin & User
                10 => [10, 11] // City Corporation Admin -> can create City Corp Admin & User
            ];
            $allowedRoleIds = $subUserRoleMap[$institutionalAdminRoleId] ?? [];
            $roles = Role::whereIn('id', $allowedRoleIds)->get();
        }

        $assigned_area = Auth::user()->assigned_area;
        
        // Fetch all potential jurisdictions for the dropdown
        $districts = District::orderBy('name')->get();
        $thanas = Thana::orderBy('name')->get();
        $unions = Union::orderBy('name')->get();
        $pourashavas = Pourashava::orderBy('name')->get();
        $city_corps = CityCorporation::orderBy('name')->get();

        return view('backend.pages.user.create', compact('roles', 'assigned_area', 'districts', 'thanas', 'unions', 'pourashavas', 'city_corps'))->with(['title' => 'New Operator', 'page' => 'user']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        
        // Auto-populate area if institutional admin, otherwise use request
        $user->area = is_institutional_admin() ? Auth::user()->assigned_area : $request->area;
        
        $user->status = $request->status;
        
        $role = Role::where('id', $request->roles)->orWhere('name', $request->roles)->first();
        $user->role_id = $role ? $role->id : 1;
        
        $user->save();

        if ($role) {
            $user->syncRoles($role->name);
        }

        // Track institute and creator
        $user->institute_id = Auth::user()->institute_id;
        $user->created_by = Auth::id();
        $user->save();

        session()->flash("success", "Operator Registered Successfully");
        return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('backend.pages.user.show', compact('user'))->with(['title' => 'Student', 'page' => 'user']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with(['roles'])->find($id);

        // Institutional admins can only edit users they created
        if (is_institutional_admin() && $user->created_by !== Auth::id()) {
            abort(403, 'You can only edit users you created.');
        }

        $roles = Role::all();
        // Restrict roles for institutional admins
        if (is_institutional_admin()) {
            $institutionalAdminRoleId = Auth::user()->role_id;
            $subUserRoleMap = [
                2 => [3, 6, 8, 10, 5, 7, 9, 11],
                3 => [6, 8, 10, 5, 7, 9, 11],
                6 => [6, 7],
                8 => [8, 9],
                10 => [10, 11]
            ];
            $allowedRoleIds = $subUserRoleMap[$institutionalAdminRoleId] ?? [];
            $roles = Role::whereIn('id', $allowedRoleIds)->get();
        }

        $assigned_area = Auth::user()->assigned_area;
        
        // Fetch all potential jurisdictions for the dropdown
        $districts = District::orderBy('name')->get();
        $thanas = Thana::orderBy('name')->get();
        $unions = Union::orderBy('name')->get();
        $pourashavas = Pourashava::orderBy('name')->get();
        $city_corps = CityCorporation::orderBy('name')->get();

        return view('backend.pages.user.edit', compact('user', 'roles', 'assigned_area', 'districts', 'thanas', 'unions', 'pourashavas', 'city_corps'))->with(['title' => 'Edit Operator', 'page' => 'user']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        // Institutional admins can only update users they created
        if (is_institutional_admin() && $user->created_by !== Auth::id()) {
            abort(403, 'You can only update users you created.');
        }

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);

        $image =  $user ->image;
        if ($request->hasFile('image')) {
            $image = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(('upload/users/images'), $image);
        }
        $user->image = $image;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        
        // Update area and sync with Institute
        if (is_institutional_admin()) {
            $user->area = Auth::user()->assigned_area;
        } else {
            $user->area = $request->area;
            
            // If it's an institutional admin, sync the underlying Institute record
            if ($user->institute_id && $request->area) {
                $institute = $user->institute;
                $areaParts = explode(':', $request->area);
                if (count($areaParts) == 2) {
                    $type = trim($areaParts[0]);
                    $idVal = trim($areaParts[1]);
                    
                    // Reset all and set the new one
                    $institute->union_id = null;
                    $institute->pourashava_id = null;
                    $institute->city_corporation_id = null;
                    
                    if ($type == 'Union') $institute->union_id = $idVal;
                    if ($type == 'Pourashava') $institute->pourashava_id = $idVal;
                    if ($type == 'City Corp') $institute->city_corporation_id = $idVal;
                    
                    $institute->save();
                }
            }
        }
        
        $user->status = $request->status;
        
        $role = Role::where('id', $request->roles)->orWhere('name', $request->roles)->first();
        if ($role) {
            $user->role_id = $role->id;
        }
        
        $user->save();

        if ($role) {
            $user->syncRoles($role->name);
        } else {
            $user->syncRoles([]);
        }

        session()->flash("success", "Operator Profile Updated Successfully");
        return redirect(route('user.index'));
    }

    /**
     * Show the form for change password the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function changePass($id)
    {
        $user = User::find($id);
        return view('backend.pages.user.changePassword', compact('user'))->with(['title' => 'User Change Password', 'page' => 'user']);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePass(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
        ]);
        $user = User::find($id);
        $user->password = $request->password;
        $user->save();
        session()->flash("success", "Information Update Successfully");
        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            // Institutional admins can only delete users they created
            if (is_institutional_admin() && $user->created_by !== Auth::id()) {
                abort(403, 'You can only revoke access for users you created.');
            }
            $user->delete();
            session()->flash("success", "Operator Access Revoked Successfully");
        }
        return redirect(route('user.index'));
    }
}
