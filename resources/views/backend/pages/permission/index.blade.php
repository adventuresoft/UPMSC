@extends('backend.master', ['mainMenu' => 'AccessManagment', 'subMenu' =>'role'])
@section('title', 'Permissions Management')
@section('content')
<div class="rbac-container container-fluid">
    @include('backend.pages.rbac._header')

    <div class="row">
        <!-- Form Section -->
        <div class="col-md-5">
            <div class="card rbac-main-card">
                <div class="rbac-card-header">
                    <h3 class="rbac-card-title">
                        <i class="fas fa-key text-primary"></i>
                        {{ isset($permission) ? 'Modify System Permission' : 'Define New Permission' }}
                    </h3>
                </div>
                <div class="rbac-card-body">
                    @if(isset($permission))
                    <form role="form" method="POST" action="{{route('permission.update',$permission->id)}}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Permission Descriptor</label>
                            <input type="text" name="name" class="form-control form-control-premium" value="{{$permission->name}}" id="name" placeholder="e.g. edit-content" required>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-premium-save"><i class="fa fa-sync-alt"></i> Update Entry</button>
                            <a href="{{route('permission.index')}}" class="btn btn-premium-reset ml-2"><i class="fa fa-times"></i> Cancel</a>
                        </div>
                    </form>
                    @else
                    <form role="form" method="POST" action="{{route('permission.store')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Permission Descriptor</label>
                            <input type="text" name="name" class="form-control form-control-premium" id="name" placeholder="e.g. view-dashboard" required>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-premium-save"><i class="fa fa-plus-circle"></i> Register Entry</button>
                            <button type="reset" class="btn btn-premium-reset ml-2">Reset</button>
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
                        <i class="fas fa-lock text-primary"></i>
                        Global Permission Registry
                    </h3>
                </div>
                <div class="rbac-card-body p-0">
                    <div class="table-responsive">
                        @if($permissions->count()==0)
                        <div class="text-center py-5">
                            <img src="https://illustrations.popsy.co/blue/abstract-art-6.svg" alt="No data" style="width: 200px; margin-bottom: 20px;">
                            <h4 class="text-muted">Security clearance keys are empty.</h4>
                        </div>
                        @else
                        <table class="table premium-table">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 80px">Index</th>
                                    <th class="text-left">Key Identifier</th>
                                    <th style="width: 150px">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $key => $value)
                                <tr class="text-center">
                                    <td class="font-weight-bold text-muted">{{$key+1}}</td>
                                    <td class="text-left">
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3 bg-light p-2 rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-fingerprint text-info"></i>
                                            </div>
                                            <code>{{$value->name}}</code>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group shadow-sm">
                                            @if(edit_permission('roles'))
                                            <a href="{{route('permission.edit',$value->id)}}" class="btn btn-sm btn-light border" title="Modify Identifier">
                                                <i class="fas fa-edit text-primary"></i>
                                            </a>
                                            @endif
                                            @if(delete_permission('roles'))
                                            <form action="{{route('permission.destroy', $value->id)}}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-light border btn-delete-confirm" title="Permanently Revoke Key">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
                <div class="card-footer bg-white border-0 py-4 d-flex justify-content-center">
                    {{$permissions->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection