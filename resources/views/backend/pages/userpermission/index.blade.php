@extends('backend.master', ['mainMenu' => 'AccessManagment', 'subMenu' =>'role'])
@section('title', 'Direct Capability Override')
@section('content')
<div class="rbac-container container-fluid">
    @include('backend.pages.rbac._header')

    <div class="row">
        <!-- Form Section -->
        <div class="col-md-5">
            <div class="card rbac-main-card">
                <div class="rbac-card-header">
                    <h3 class="rbac-card-title">
                        <i class="fas fa-user-check text-primary"></i>
                        {{ isset($userPermission) ? 'Modify Individual Grant' : 'Grant Individual Override' }}
                    </h3>
                </div>
                <div class="rbac-card-body">
                    @if(isset($userPermission))
                    <form role="form" method="POST" action="{{route('userper.update',$userPermission->model_id)}}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <input type="hidden" name="old_model_id" value="{{$userPermission->model_id}}">
                        <input type="hidden" name="old_permission_id" value="{{$userPermission->permission_id}}">
                        
                        <div class="form-group">
                            <label for="user_id" class="font-weight-bold">Target Operator</label>
                            <select class="form-control form-control-premium select2" name="user_id" id="user_id" required>
                                @foreach( $admins as $admin)
                                <option {{$userPermission->model_id==$admin->id?'selected':''}} value="{{$admin->id}}">{{$admin->name}} ({{$admin->email}})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="permission_id" class="font-weight-bold">Override Capability (Permission)</label>
                            <select class="form-control form-control-premium select2" name="permission_id" id="permission_id" required>
                                @foreach( $permissions as $permission)
                                <option {{$userPermission->permission_id==$permission->id?'selected':''}} value="{{$permission->id}}">{{$permission->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-premium-save"><i class="fa fa-sync-alt"></i> Update Override</button>
                            <a href="{{route('userper.index')}}" class="btn btn-premium-reset ml-2"><i class="fa fa-times"></i> Cancel</a>
                        </div>
                    </form>
                    @else
                    <form role="form" method="POST" action="{{route('userper.store')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="user_id" class="font-weight-bold">Select Operator</label>
                            <select class="form-control form-control-premium select2" name="user_id" id="user_id" required>
                                <option value="">-- Select User --</option>
                                @foreach( $admins as $admin)
                                <option value="{{$admin->id}}">{{$admin->name}} ({{$admin->email}})</option>
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
                            <button type="submit" class="btn btn-premium-save"><i class="fa fa-save"></i> Apply Override</button>
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
                        <i class="fas fa-shield-alt text-primary"></i>
                        Individual Override Log
                    </h3>
                </div>
                <div class="rbac-card-body p-0">
                    <div class="table-responsive">
                        @if($userPermissions->count()==0)
                        <div class="text-center py-5">
                            <img src="https://illustrations.popsy.co/blue/creative-process.svg" alt="No data" style="width: 200px; margin-bottom: 20px;">
                            <h4 class="text-muted">No individual overrides have been recorded.</h4>
                        </div>
                        @else
                        <table class="table premium-table">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 80px">Index</th>
                                    <th class="text-left">Target Identity</th>
                                    <th class="text-left">Override Key</th>
                                    <th>Security Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($userPermissions as $key => $value)
                                <tr class="text-center">
                                    <td class="font-weight-bold text-muted">{{$key+1}}</td>
                                    <td class="text-left">
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3 bg-light p-2 rounded-lg">
                                                <i class="fas fa-user-tag text-primary"></i>
                                            </div>
                                            <div>
                                                <div class="font-weight-bold text-dark">{{ optional($value->User)->name ?? 'N/A' }}</div>
                                                <small class="text-muted">{{ optional($value->User)->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-left">
                                        <code>{{ optional($value->Permission)->name ?? 'N/A' }}</code>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('userper.edit',['model_id'=>$value->model_id,'permission_id'=>$value->permission_id])}}" class="btn btn-sm btn-outline-primary" style="border-radius: 50px 0 0 50px;"> 
                                                <i class="fa fa-edit"></i> 
                                            </a>
                                            <a href="#" class="btn btn-sm btn-outline-danger" style="border-radius: 0 50px 50px 0;"
                                               onclick="if (confirm('Revoke this individual override?')){event.preventDefault();document.getElementById('delete-form{{$key}}').submit();}else{event.stopPropagation(); event.preventDefault();};">
                                                <i class="fa fa-trash-alt"></i> 
                                            </a>
                                        </div>
                                        <form id="delete-form{{$key}}" action="{{ route('userper.destroy') }}" method="POST" style="display: none;">
                                            <input type="hidden" name="model_id" value="{{$value->model_id}}">
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
                    {{$userPermissions->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
