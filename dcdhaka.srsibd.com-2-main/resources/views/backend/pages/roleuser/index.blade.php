@extends('backend.master', ['mainMenu' => 'AccessManagment', 'subMenu' =>'role'])
@section('title', 'User Role Assignments')
@section('content')
<div class="rbac-container container-fluid">
    @include('backend.pages.rbac._header')

    <div class="row">
        <!-- Form Section -->
        <div class="col-md-5">
            <div class="card rbac-main-card">
                <div class="rbac-card-header">
                    <h3 class="rbac-card-title">
                        <i class="fas fa-user-shield text-primary"></i>
                        {{ isset($singleRoleUser) ? 'Modify Assignment' : 'New Identity Mapping' }}
                    </h3>
                </div>
                <div class="rbac-card-body">
                    @if(isset($singleRoleUser))
                    <form role="form" method="POST" action="{{route('roleuser.update',$singleRoleUser->role_id)}}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <input type="hidden" name="old_model_id" value="{{$singleRoleUser->model_id}}">
                        
                        <div class="form-group">
                            <label for="user_id" class="font-weight-bold">Select Operator</label>
                            <select class="form-control form-control-premium select2" id="user_id" name="user_id" required>
                                @foreach($admins as $user)
                                <option {{$user->id==$singleRoleUser->model_id?'selected':''}} value="{{$user->id}}">{{$user->name}} ({{$user->email}})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="role_id" class="font-weight-bold">Target Identity (Role)</label>
                            <select class="form-control form-control-premium" id="role_id" name="role_id" required>
                                @foreach($roles as $role)
                                <option {{$role->id==$singleRoleUser->role_id?'selected':''}} value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-premium-save"><i class="fa fa-sync-alt"></i> Re-assign Role</button>
                            <a href="{{route('roleuser.index')}}" class="btn btn-premium-reset ml-2"><i class="fa fa-times"></i> Cancel</a>
                        </div>
                    </form>
                    @else
                    <form role="form" method="POST" action="{{route('roleuser.store')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="user_id" class="font-weight-bold">Select Operator</label>
                            <select class="form-control form-control-premium select2" id="user_id" name="user_id" required>
                                <option value="">-- Select User --</option>
                                @foreach($admins as $user)
                                <option value="{{$user->id}}">{{$user->name}} ({{$user->email}})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="role_id" class="font-weight-bold">Assign Identity (Role)</label>
                            <select class="form-control form-control-premium" id="role_id" name="role_id" required>
                                <option value="">-- Select Role --</option>
                                @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
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
                        <i class="fas fa-users-cog text-primary"></i>
                        Active Role Assignments
                    </h3>
                </div>
                <div class="rbac-card-body p-0">
                    <div class="table-responsive">
                        @if($roleUser->count()==0)
                        <div class="text-center py-5">
                            <img src="https://illustrations.popsy.co/blue/work-from-home.svg" alt="No data" style="width: 200px; margin-bottom: 20px;">
                            <h4 class="text-muted">No security identities have been mapped.</h4>
                        </div>
                        @else
                        <table class="table premium-table">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 80px">Index</th>
                                    <th class="text-left">Target Identity</th>
                                    <th class="text-left">Assigned Role</th>
                                    <th>Security Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roleUser as $key => $value)
                                @php
                                $unique='_'.$value->role_id.'_'.$value->model_id;
                                @endphp
                                <tr class="text-center">
                                    <td class="font-weight-bold text-muted">{{$key+1}}</td>
                                    <td class="text-left">
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3 bg-light p-2 rounded-lg">
                                                <i class="fas fa-user text-primary"></i>
                                            </div>
                                            <div>
                                                <div class="font-weight-bold text-dark">{{ optional($value->User)->name ?? 'System Ghost' }}</div>
                                                <small class="text-muted">{{ optional($value->User)->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-left">
                                        <span class="badge badge-primary badge-premium">
                                            <i class="fas fa-id-badge mr-1"></i>
                                            {{ optional($value->Role)->name ?? 'Undefined' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('roleuser.edit',['role_id'=>$value->role_id,'user_id'=>$value->model_id])}}" class="btn btn-sm btn-outline-primary" style="border-radius: 50px 0 0 50px;"> 
                                                <i class="fa fa-edit"></i> 
                                            </a>
                                            <a href="#" class="btn btn-sm btn-outline-danger" style="border-radius: 0 50px 50px 0;"
                                               onclick="if (confirm('De-authorize this identity mapping?')){event.preventDefault();document.getElementById('delete-form{{$unique}}').submit();}else{event.stopPropagation(); event.preventDefault();};">
                                                <i class="fa fa-trash-alt"></i> 
                                            </a>
                                        </div>
                                        <form id="delete-form{{$unique}}" action="{{ route('roleuser.roleusersoft') }}" method="POST" style="display: none;">
                                            <input type="hidden" name="model_id" value="{{$value->model_id}}">
                                            <input type="hidden" name="role_id" value="{{$value->role_id}}">
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
                    {{$roleUser->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
