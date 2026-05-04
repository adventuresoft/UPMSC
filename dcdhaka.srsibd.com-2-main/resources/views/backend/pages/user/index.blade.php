@extends('backend.master', ['mainMenu' => 'AccessManagment', 'subMenu' =>'role'])
@section('title', 'Authorized Operator Directory')
@section('content')
<div class="rbac-container container-fluid">
    @include('backend.pages.rbac._header')

    <div class="row">
        <div class="col-md-12">
            <div class="card rbac-main-card">
                <div class="rbac-card-header d-flex justify-content-between align-items-center">
                    <h3 class="rbac-card-title">
                        <i class="fas fa-users-cog text-primary mr-2"></i>
                        Active Operator Registry
                    </h3>
                    <div class="card-tools">
                        <a href="{{route('user.create')}}" class="btn btn-premium-save btn-sm px-4 shadow-sm">
                            <i class="fas fa-plus-circle mr-1"></i> Register New Operator
                        </a>
                    </div>
                </div>
                <div class="rbac-card-body p-0">
                    <div class="table-responsive">
                        <table class="table premium-table mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 60px">#</th>
                                    <th>Operator Profile</th>
                                    <th>Contact & Area</th>
                                    <th>Primary Security Role</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center" style="width: 150px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                <tr>
                                    <td class="text-center text-muted font-weight-bold">{{ $key + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm mr-3 bg-light rounded-circle text-center pt-1" style="width: 40px; height: 40px;">
                                                <i class="fas fa-user text-primary"></i>
                                            </div>
                                            <div>
                                                <div class="font-weight-bold text-dark">{{ $user->name }}</div>
                                                <div class="small text-muted">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small font-weight-bold"><i class="fas fa-phone-alt mr-1 text-muted"></i> {{ $user->mobile ?? 'N/A' }}</div>
                                        <div class="small text-primary"><i class="fas fa-map-marker-alt mr-1"></i> {{ $user->area ?? 'N/A' }}</div>
                                    </td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <span class="badge badge-info badge-premium shadow-none">
                                                <i class="fas fa-user-shield mr-1"></i> {{ $role->name }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        @if($user->status == 1)
                                            <span class="badge badge-success px-3 py-1 rounded-pill shadow-sm">Verified</span>
                                        @else
                                            <span class="badge badge-warning px-3 py-1 rounded-pill shadow-sm">Pending</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group shadow-sm">
                                            <a href="{{route('user.show', $user->id)}}" class="btn btn-sm btn-light border" title="Audit Profile">
                                                <i class="fas fa-eye text-primary"></i>
                                            </a>
                                            <a href="{{route('user.edit', $user->id)}}" class="btn btn-sm btn-light border" title="Modify Credentials">
                                                <i class="fas fa-edit text-primary"></i>
                                            </a>
                                            <form action="{{route('user.destroy', $user->id)}}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-light border btn-delete-confirm" title="Revoke Access">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 py-4 d-flex justify-content-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
