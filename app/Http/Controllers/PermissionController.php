<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct() {
        // Restrict permission management to superadmins only
    }

    private function guardSuperadmin() {
        if (!is_superadmin()) {
            abort(403, 'Only Superadmins can manage Permissions.');
        }
    }
    
    public function index()
    {
        $permissions = Permission::paginate(20);        
        return view('backend.pages.permission.index', compact('permissions'))->with(['title'=>'Permission','page'=>'permission']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->guardSuperadmin();
        $this->validate($request, [
            'name' => 'required',            
        ]);
        Permission::create(['name' => $request->name]);
        session()->flash("success", "Information saved Successfully");
        return redirect(route('permission.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->guardSuperadmin();
        $permission = Permission::find($id);
        $permissions = Permission::paginate(20);
        return view('backend.pages.permission.index', compact('permission', 'permissions'))->with('title', 'Edit Complain Type')->with('page', 'comType');
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
        $this->guardSuperadmin();
        $this->validate($request, [
            'name' => 'required',            
        ]);
        $comType = Permission::find($id);
        $comType->name = $request->name;                             
        $comType->save();
        session()->flash("success", "Information saved Successfully");
        return redirect(route('permission.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->guardSuperadmin();
        $permission = Permission::find($id);
        if ($permission) {
            $permission->delete();
            session()->flash("success", "Permission Removed Successfully");
        }
        return redirect(route('permission.index'));
    }
}
