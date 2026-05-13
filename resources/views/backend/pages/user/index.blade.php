@extends('backend.master', ['mainMenu' => 'AccessManagment', 'subMenu' =>'role'])
@section('title', 'Authorized Operator Directory')
@section('content')
<div class="rbac-container container-fluid">
    @include('backend.pages.rbac._header')

    <div class="row">
        <div class="col-md-12">
            <div class="card rbac-main-card">
                <div class="rbac-card-header d-flex justify-content-between align-items-center flex-wrap" style="gap: 12px;">
                    <h3 class="rbac-card-title mb-0">
                        <i class="fas fa-users-cog text-primary mr-2"></i>
                        Active Operator Registry
                        @if(request('search'))
                            <small class="text-muted font-weight-normal ml-2" style="font-size: 0.8rem;">
                                — results for "<em>{{ request('search') }}</em>"
                            </small>
                        @endif
                    </h3>
                    <div class="d-flex align-items-center" style="gap: 10px; flex-wrap: wrap;">
                        {{-- Search Bar --}}
                        <form method="GET" action="{{ route('user.index') }}" class="d-flex" style="gap: 6px;">
                            <div class="input-group input-group-sm" style="width: 280px;">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="form-control border" placeholder="Search name, email, mobile, ID..."
                                    style="border-radius: 8px 0 0 8px !important; font-size: 0.875rem;">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" style="border-radius: 0 8px 8px 0 !important;">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            @if(request('search'))
                                <a href="{{ route('user.index') }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 8px;">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </form>

                        @if(create_permission('users'))
                        <a href="{{ route('user.create') }}" class="btn btn-premium-save btn-sm px-4 shadow-sm">
                            <i class="fas fa-plus-circle mr-1"></i> Register New Operator
                        </a>
                        @endif
                    </div>
                </div>
                <div class="rbac-card-body p-0">
                    <div class="table-responsive">
                        <table class="table premium-table mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px">#</th>
                                    <th style="min-width: 180px;">Operator Profile</th>
                                    <th style="min-width: 140px;">Contact & Area</th>
                                    <th style="min-width: 140px;">Roles</th>
                                    <th style="min-width: 200px;">Permissions</th>
                                    <th class="text-center" style="width: 80px;">Status</th>
                                    <th class="text-center" style="width: 120px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $key => $user)
                                <tr>
                                    <td class="text-center text-muted font-weight-bold">{{ $users->firstItem() + $key }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3 bg-light rounded-circle text-center d-flex align-items-center justify-content-center flex-shrink-0"
                                                style="width: 40px; height: 40px;">
                                                <i class="fas fa-user text-primary"></i>
                                            </div>
                                            <div>
                                                <div class="font-weight-bold text-dark">{{ $user->name }}</div>
                                                <div class="small text-muted">{{ $user->email }}</div>
                                                @if($user->system_id)
                                                    <div class="small text-muted" style="font-size: 0.72rem;">
                                                        <i class="fas fa-id-badge mr-1"></i>{{ $user->system_id }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small font-weight-bold">
                                            <i class="fas fa-phone-alt mr-1 text-muted"></i> {{ $user->mobile ?? 'N/A' }}
                                        </div>
                                        <div class="small text-primary">
                                            <i class="fas fa-map-marker-alt mr-1"></i> {{ $user->area ?? 'N/A' }}
                                        </div>
                                    </td>
                                    {{-- Roles Column --}}
                                    <td>
                                        @forelse($user->roles as $role)
                                            <span class="badge badge-info mr-1 mb-1"
                                                style="font-size: 0.72rem; padding: 4px 8px; border-radius: 6px;">
                                                <i class="fas fa-user-shield mr-1"></i>{{ $role->name }}
                                            </span>
                                        @empty
                                            <span class="text-muted small">No role</span>
                                        @endforelse
                                    </td>
                                    {{-- Permissions Column --}}
                                    <td>
                                        @php
                                            $allPerms = $user->roles->flatMap(fn($r) => $r->permissions)->unique('id');
                                            $permGroups = $allPerms->groupBy(function($p) {
                                                $parts = explode('.', $p->name);
                                                return count($parts) > 1 ? $parts[0] : 'Other';
                                            });
                                        @endphp
                                        @if($permGroups->isEmpty())
                                            <span class="text-muted small">No permissions</span>
                                        @else
                                            <div class="d-flex flex-wrap" style="gap: 4px;">
                                                @foreach($permGroups as $group => $perms)
                                                    <span class="badge border text-dark mr-1 mb-1"
                                                        style="font-size: 0.68rem; padding: 3px 7px; border-radius: 5px; background: #f1f5f9;"
                                                        title="{{ $perms->pluck('name')->implode(', ') }}">
                                                        {{ ucfirst($group) }}
                                                        <span class="badge badge-secondary ml-1"
                                                            style="font-size: 0.62rem; border-radius: 4px;">
                                                            {{ $perms->count() }}
                                                        </span>
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($user->status == 1)
                                            <span class="badge badge-success px-2 py-1 rounded-pill shadow-sm"
                                                style="font-size: 0.72rem;">
                                                <i class="fas fa-check-circle mr-1"></i>Verified
                                            </span>
                                        @else
                                            <span class="badge badge-warning px-2 py-1 rounded-pill shadow-sm"
                                                style="font-size: 0.72rem;">
                                                <i class="fas fa-clock mr-1"></i>Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center" style="gap: 4px;">
                                            @if(view_permission('users'))
                                            <a href="{{ route('user.show', $user->id) }}"
                                                class="btn btn-sm btn-light border" title="View Profile"
                                                style="border-radius: 6px; padding: 4px 8px;">
                                                <i class="fas fa-eye text-primary"></i>
                                            </a>
                                            @endif
                                            @if(edit_permission('users'))
                                            <a href="{{ route('user.edit', $user->id) }}"
                                                class="btn btn-sm btn-light border" title="Edit Operator"
                                                style="border-radius: 6px; padding: 4px 8px;">
                                                <i class="fas fa-edit text-warning"></i>
                                            </a>
                                            @endif
                                            @if(delete_permission('users'))
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="btn btn-sm btn-light border btn-delete-confirm"
                                                    title="Revoke Access"
                                                    style="border-radius: 6px; padding: 4px 8px;">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="fas fa-users-slash fa-2x mb-2 d-block text-light"></i>
                                        @if(request('search'))
                                            No operators found matching "<strong>{{ request('search') }}</strong>".
                                            <br><a href="{{ route('user.index') }}" class="btn btn-sm btn-outline-primary mt-2">Clear Search</a>
                                        @else
                                            No operators registered yet.
                                        @endif
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($users->hasPages())
                <div class="card-footer bg-white border-0 py-3 d-flex justify-content-between align-items-center px-4">
                    <div class="small text-muted">
                        Showing {{ $users->firstItem() }}–{{ $users->lastItem() }} of {{ $users->total() }} operators
                    </div>
                    {{ $users->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
