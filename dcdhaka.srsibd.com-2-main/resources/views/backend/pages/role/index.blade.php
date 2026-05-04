@extends('backend.master', ['mainMenu' => 'AccessManagment', 'subMenu' =>'role'])
@section('title', 'Security Role Matrix')
@section('content')
<div class="rbac-container container-fluid">
    @include('backend.pages.rbac._header')

    <div class="row">
        <!-- Role Creation/Edit Column -->
        <div class="col-md-12 mb-4">
            <div class="card rbac-main-card shadow-sm">
                <div class="rbac-card-header d-flex justify-content-between align-items-center">
                    <h3 class="rbac-card-title mb-0">
                        <i class="fas {{ isset($role) ? 'fa-edit text-warning' : 'fa-plus-circle text-primary' }} mr-2"></i>
                        {{ isset($role) ? 'Modify Security Role Architecture' : 'Initialize New Security Role' }}
                    </h3>
                    @if(isset($role))
                        <a href="{{ route('role.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-undo mr-1"></i> Reset to Definition Mode
                        </a>
                    @endif
                </div>
                <div class="rbac-card-body">
                    <form role="form" method="POST" action="{{ isset($role) ? route('role.update', $role->id) : route('role.store') }}">
                        @csrf
                        @if(isset($role)) @method('PATCH') @endif
                        
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label for="name" class="font-weight-bold text-uppercase small text-muted">Role Identity</label>
                                <input type="text" name="name" class="form-control form-control-premium" id="name" value="{{ $role->name ?? old('name') }}" placeholder="e.g. Finance Administrator" required>
                                <small class="text-muted">Unique name for this security profile.</small>
                            </div>
                        </div>

                        <div class="permission-matrix-container border rounded bg-light p-3">
                            <h5 class="font-weight-bold mb-3 border-bottom pb-2">
                                <i class="fas fa-grid-2 text-primary mr-2"></i> Capability Matrix (Permissions)
                            </h5>
                            
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless table-hover bg-white rounded shadow-sm mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="width: 250px" class="pl-4 py-3 text-uppercase small font-weight-bold">Module / Feature</th>
                                            <th class="text-center py-3 text-uppercase small font-weight-bold text-success">Create</th>
                                            <th class="text-center py-3 text-uppercase small font-weight-bold text-primary">Read</th>
                                            <th class="text-center py-3 text-uppercase small font-weight-bold text-warning">Update</th>
                                            <th class="text-center py-3 text-uppercase small font-weight-bold text-danger">Delete</th>
                                            <th class="text-center py-3 text-uppercase small font-weight-bold text-muted">Other Extras</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($permissionGroups as $groupName => $groupPermissions)
                                        <tr class="border-top">
                                            <td class="pl-4 py-3 font-weight-bold text-dark">
                                                <i class="fas fa-folder-open mr-2 text-muted"></i> {{ ucfirst($groupName) }}
                                            </td>
                                            
                                            {{-- Dynamic columns for CRUD --}}
                                            @php
                                                $crudActions = ['create', 'read', 'update', 'delete'];
                                                $processedPermissions = [];
                                            @endphp
                                            
                                            @foreach($crudActions as $action)
                                                <td class="text-center py-3">
                                                    @php
                                                        $perm = $groupPermissions->first(function($p) use ($action) {
                                                            return str_ends_with($p->name, '.' . $action);
                                                        });
                                                    @endphp
                                                    
                                                    @if($perm)
                                                        @php $processedPermissions[] = $perm->id; @endphp
                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                            <input type="checkbox" name="permissions[]" value="{{ $perm->name }}" 
                                                                id="perm_{{ $perm->id }}" class="custom-control-input"
                                                                {{ (isset($role) && $role->hasPermissionTo($perm->name)) ? 'checked' : '' }}>
                                                            <label class="custom-control-label" for="perm_{{ $perm->id }}"></label>
                                                        </div>
                                                    @else
                                                        <span class="text-muted small">-</span>
                                                    @endif
                                                </td>
                                            @endforeach

                                            {{-- Column for other permissions in this group --}}
                                            <td class="text-center py-3">
                                                @foreach($groupPermissions as $p)
                                                    @if(!in_array($p->id, $processedPermissions))
                                                        <div class="custom-control custom-checkbox custom-control-inline mb-1" title="{{ $p->name }}">
                                                            <input type="checkbox" name="permissions[]" value="{{ $p->name }}" 
                                                                id="perm_{{ $p->id }}" class="custom-control-input"
                                                                {{ (isset($role) && $role->hasPermissionTo($p->name)) ? 'checked' : '' }}>
                                                            <label class="custom-control-label" for="perm_{{ $perm->id ?? $p->id }}"></label>
                                                            <span class="small ml-1 text-muted">{{ str_replace($groupName.'.', '', $p->name) }}</span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="text-right mt-4">
                            <button type="submit" class="btn btn-premium-save px-5 shadow-sm">
                                <i class="fas fa-check-double mr-2"></i> {{ isset($role) ? 'Finalize Architecture Changes' : 'Initialize Role with Selected Matrix' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Role Inventory Column -->
        <div class="col-md-12">
            <div class="card rbac-main-card">
                <div class="rbac-card-header">
                    <h3 class="rbac-card-title">
                        <i class="fas fa-shield-alt text-primary mr-2"></i> Strategic Role Registry
                    </h3>
                </div>
                <div class="rbac-card-body p-0">
                    <div class="table-responsive">
                        <table class="table premium-table mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 60px" class="text-center">#</th>
                                    <th style="width: 250px">Role Definition</th>
                                    <th>Embedded Matrix Summary</th>
                                    <th style="width: 120px" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $key => $r)
                                <tr>
                                    <td class="text-center text-muted font-weight-bold">{{ $key + 1 }}</td>
                                    <td>
                                        <div class="font-weight-bold text-dark">{{ $r->name }}</div>
                                        <div class="small text-muted text-uppercase">{{ count($r->permissions) }} capabilities assigned</div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            @php
                                                $roleGroups = $r->permissions->groupBy(function($p) {
                                                    $parts = explode('.', $p->name);
                                                    return count($parts) > 1 ? $parts[0] : 'Others';
                                                });
                                            @endphp
                                            
                                            @foreach($roleGroups as $gn => $gp)
                                                <div class="mr-3 mb-2 p-2 bg-light border rounded shadow-xs" style="min-width: 140px;">
                                                    <div class="font-weight-bold small text-primary mb-1 border-bottom pb-1">{{ ucfirst($gn) }}</div>
                                                    <div class="d-flex gap-1">
                                                        @foreach($gp as $p)
                                                            @php $action = str_replace($gn.'.', '', $p->name); @endphp
                                                            <span class="badge badge-white border text-{{ 
                                                                $action == 'create' ? 'success' : 
                                                                ($action == 'read' ? 'primary' : 
                                                                ($action == 'update' ? 'warning' : 
                                                                ($action == 'delete' ? 'danger' : 'secondary'))) 
                                                            }} mr-1" style="font-size: 0.65rem;" title="{{ $p->name }}">
                                                                {{ strtoupper(substr($action, 0, 1)) }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group shadow-sm">
                                            <a href="{{ route('role.edit', $r->id) }}" class="btn btn-sm btn-light border" title="Modify Matrix Architecture">
                                                <i class="fas fa-edit text-primary"></i>
                                            </a>
                                            <form action="{{ route('role.destroy', $r->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-light border btn-delete-confirm" title="Decommission Role">
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
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .shadow-xs { box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
    .custom-control-label::before, .custom-control-label::after {
        top: 0.2rem !important;
        width: 1.2rem !important;
        height: 1.2rem !important;
    }
    .custom-control-input:checked ~ .custom-control-label::before {
        background-color: var(--rbac-primary) !important;
        border-color: var(--rbac-primary) !important;
    }
</style>
@endsection