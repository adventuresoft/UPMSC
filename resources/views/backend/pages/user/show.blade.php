@extends('backend.master', ['mainMenu' => 'AccessManagment', 'subMenu' =>'role'])
@section('title', 'Operator Audit Profile')
@section('content')
<div class="rbac-container container-fluid">
    @include('backend.pages.rbac._header')

    <div class="row">
        <div class="col-md-12">
            <div class="card rbac-main-card">
                <div class="rbac-card-header">
                    <h3 class="rbac-card-title">
                        <i class="fas fa-id-card text-primary"></i>
                        Detailed Audit Profile: {{$user->name}}
                    </h3>
                    <div class="card-tools">
                        <a href="{{route('user.edit', $user->id)}}" class="btn btn-sm btn-outline-primary badge-premium">
                            <i class="fas fa-edit mr-1"></i> Edit Profile
                        </a>
                    </div>
                </div>
                <div class="rbac-card-body">
                    <div class="row">
                        <div class="col-md-4 text-center border-right">
                            <div class="mb-3">
                                <div class="bg-light d-inline-block p-4 rounded-circle border" style="width: 150px; height: 150px;">
                                    <i class="fas fa-user text-primary" style="font-size: 5rem;"></i>
                                </div>
                            </div>
                            <h4 class="font-weight-bold mb-1">{{$user->name}}</h4>
                            <p class="text-muted mb-3">{{$user->email}}</p>
                            @if($user->status == 1)
                                <span class="badge badge-success badge-premium px-4 py-2">
                                    <i class="fas fa-check-circle mr-1"></i> VERIFIED OPERATOR
                                </span>
                            @else
                                <span class="badge badge-warning badge-premium px-4 py-2">
                                    <i class="fas fa-clock mr-1"></i> PENDING AUTHORIZATION
                                </span>
                            @endif
                        </div>
                        <div class="col-md-8 pl-md-5">
                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <label class="text-uppercase text-muted small font-weight-bold">System ID</label>
                                    <div class="h6 font-weight-bold">{{$user->system_id}}</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="text-uppercase text-muted small font-weight-bold">Assigned Area</label>
                                    <div class="h6 font-weight-bold text-primary">{{$user->area ?? 'Not Assigned'}}</div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <label class="text-uppercase text-muted small font-weight-bold">Contact Number</label>
                                    <div class="h6 font-weight-bold">{{$user->mobile ?? 'Not Provided'}}</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="text-uppercase text-muted small font-weight-bold">Primary Email</label>
                                    <div class="h6 font-weight-bold">{{$user->email}}</div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label class="text-uppercase text-muted small font-weight-bold">Security Context</label>
                                    <div class="mt-1">
                                        @foreach($user->roles as $role)
                                            <span class="badge badge-info badge-premium mr-1">
                                                <i class="fas fa-user-shield mr-1"></i> {{$role->name}}
                                            </span>
                                        @endforeach
                                        @foreach($user->permissions as $permission)
                                            <span class="badge badge-success badge-premium mr-1">
                                                <i class="fas fa-key mr-1"></i> {{$permission->name}}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            
                            <hr>
                            
                            <div class="row mt-4">
                                <div class="col-12">
                                    <label class="text-uppercase text-muted small font-weight-bold">Identification Documents</label>
                                    <div class="mt-2">
                                        @if($user->identity != null) 
                                            <div class="d-flex align-items-center bg-light p-3 rounded-lg border">
                                                <i class="fas fa-file-image text-info mr-3" style="font-size: 2rem;"></i>
                                                <div>
                                                    <div class="font-weight-bold">Operator Identity Document</div>
                                                    <a href="{{asset('upload/users/images/'.$user->identity)}}" target="_blank" class="small text-primary font-weight-bold">
                                                        <i class="fas fa-external-link-alt mr-1"></i> View Full Document
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <img src="{{asset('upload/users/images/'.$user->identity)}}" class="img-thumbnail shadow-sm" style="max-width: 200px;">
                                            </div>
                                        @else
                                            <div class="text-muted font-italic">No identity documents uploaded for this operator.</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-5">
                        <a href="{{route('user.index')}}" class="btn btn-premium-reset px-5">
                            <i class="fas fa-arrow-left mr-2"></i> Back to Directory
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection