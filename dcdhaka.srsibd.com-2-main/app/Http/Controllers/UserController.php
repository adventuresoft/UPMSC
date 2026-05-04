<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Str;
use App\Models\User;
use Hash;
use App\Models\Role;
use App\Models\Permission;

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

    public function index()
    {
        $users = User::with(['roles'])->orderBy('id', 'desc')->paginate(10);
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
        return view('backend.pages.user.create', compact('roles'))->with(['title' => 'New Operator', 'page' => 'user']);
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
        $user->area = $request->area;
        $user->status = $request->status;
        
        $role = Role::where('id', $request->roles)->orWhere('name', $request->roles)->first();
        $user->role_id = $role ? $role->id : 1;
        
        $user->save();

        if ($role) {
            $user->syncRoles($role->name);
        }

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
        $roles = Role::all();
        return view('backend.pages.user.edit', compact('user', 'roles'))->with(['title' => 'Edit Operator', 'page' => 'user']);
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);
        $user = User::find($id);

        $image =  $user ->image;
        if ($request->hasFile('image')) {
            $image = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(('upload/users/images'), $image);
        }
        $user->image = $image;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->area = $request->area;
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
            $user->delete();
            session()->flash("success", "Operator Access Revoked Successfully");
        }
        return redirect(route('user.index'));
    }
}
