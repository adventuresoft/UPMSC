@extends('backend.master', ['mainMenu' => 'AccessManagment', 'subMenu' =>'role'])
@section('title', 'Role Matrix Configuration')
@section('content')
<div class="rbac-container container-fluid">
    @include('backend.pages.rbac._header')

    <div class="row">
        <!-- Form Section -->
        <div class="col-md-5">
            <div class="card rbac-main-card">
                <div class="rbac-card-header">
                    <h3 class="rbac-card-title">
                        <i class="fas fa-project-diagram text-primary"></i>
                        {{ isset($role_permission) ? 'Modify Capability' : 'Map Role to Capability' }}
                    </h3>
                </div>
                <div class="rbac-card-body">
                    @if(isset($role_permission))
                    <form role="form" method="POST" action="{{route('rolepermission.update',$role_permission->role_id)}}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <input type="hidden" name="old_role_id" value="{{$role_permission->role_id}}">
                        <input type="hidden" name="old_permission_id" value="{{$role_permission->permission_id}}">
                        
                        <div class="form-group">
                            <label for="role_id" class="font-weight-bold">Target Identity (Role)</label>
                            <select class="form-control form-control-premium" name="role_id" id="role_id" required>
                                @foreach( $roles as $role)
                                <option {{$role->id==$role_permission->role_id?'selected':''}} value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="permission_id" class="font-weight-bold">Granted Capability (Permission)</label>
                            <select class="form-control form-control-premium select2" name="permission_id" id="permission_id" required>
                                @foreach( $permissions as $permission)
                                <option {{$permission->id==$role_permission->permission_id?'selected':''}} value="{{$permission->id}}">{{$permission->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-premium-save"><i class="fa fa-sync-alt"></i> Update Mapping</button>
                            <a href="{{route('rolepermission.index')}}" class="btn btn-premium-reset ml-2"><i class="fa fa-times"></i> Cancel</a>
                        </div>
                    </form>
                    @else
                    <form role="form" method="POST" action="{{route('rolepermission.store')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="role_id" class="font-weight-bold">Select Identity (Role)</label>
                            <select class="form-control form-control-premium" name="role_id" id="role_id" required>
                                <option value="">-- Select Role --</option>
                                @foreach( $roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="permission_id" class="font-weight-bold">Grant Capability (Permission)</label>
                            <select class="form-control form-control-premium select2" name="permission_id" id="permission_id" required>
                                <option value="">-- Select Permission --</option>
                                @foreach( $permissions as $permission)
                                <option value="{{$permission->id}}">{{$permission->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-premium-save"><i class="fa fa-save"></i> Execute Mapping</button>
                            <button type="reset" class="btn btn-premium-reset ml-2">Reset Form</button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- List Section -->
        <div class="col-md-7">
            <div class="card rbac-main-card">
                <div class="rbac-card-header">
                    <h3 class="rbac-card-title">
                        <i class="fas fa-sitemap text-primary"></i>
                        Role-Permission Capability Matrix
                    </h3>
                </div>
                <div class="rbac-card-body p-0">
                    <div class="table-responsive">
                        @if($role_permissions->count()==0)
                        <div class="text-center py-5">
                            <img src="https://illustrations.popsy.co/blue/manager.svg" alt="No data" style="width: 200px; margin-bottom: 20px;">
                            <h4 class="text-muted">The matrix is currently empty.</h4>
                        </div>
                        @else
                        <table class="table premium-table">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 80px">Index</th>
                                    <th class="text-left">Role Context</th>
                                    <th class="text-left">Capability Granted</th>
                                    <th>Security Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($role_permissions as $key => $value)
                                <tr class="text-center">
                                    <td class="font-weight-bold text-muted">{{$key+1}}</td>
                                    <td class="text-left">
                                        <span class="badge badge-info badge-premium" style="background: #e0f2fe; color: #0369a1;">
                                            <i class="fas fa-user-tag mr-1"></i>
                                            {{ optional($value->Role)->name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="text-left">
                                        <span class="badge badge-success badge-premium">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            {{ optional($value->Permission)->name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('rolepermission.edit',['role_id'=>$value->role_id,'permission_id'=>$value->permission_id])}}" class="btn btn-sm btn-outline-primary" style="border-radius: 50px 0 0 50px;"> 
                                                <i class="fa fa-edit"></i> 
                                            </a>
                                            <a href="#" class="btn btn-sm btn-outline-danger" style="border-radius: 0 50px 50px 0;"
                                               onclick="if (confirm('Sever this capability connection?')){event.preventDefault();document.getElementById('delete-form{{$key}}').submit();}else{event.stopPropagation(); event.preventDefault();};">
                                                <i class="fa fa-trash-alt"></i> 
                                            </a>
                                        </div>
                                        <form id="delete-form{{$key}}" action="{{ route('rolepermission.destroy') }}" method="POST" style="display: none;">
                                            <input type="hidden" name="role_id" value="{{$value->role_id}}">
                                            <input type="hidden" name="permission_id" value="{{$value->permission_id}}">
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
                <div class="card-footer bg-white border-0 py-4 d-flex justify-content-center">
                    {{$role_permissions->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection