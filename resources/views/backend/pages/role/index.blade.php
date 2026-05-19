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

                        <div class="permission-matrix-container border rounded bg-white p-4 shadow-sm">
                            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                                <h5 class="font-weight-bold mb-0 text-dark">
                                    <i class="fas fa-cubes text-primary mr-2"></i> Role-Permission Capability Matrix
                                </h5>
                                <span class="badge badge-light border text-muted px-3 py-2 font-weight-bold" style="font-size: 0.85rem;">
                                    <i class="fas fa-shield-check mr-1 text-success"></i> Granular Access System
                                </span>
                            </div>

                            <!-- Live Search Input -->
                            <div class="mb-4">
                                <div class="input-group input-group-lg shadow-xs">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light border-right-0"><i class="fas fa-search text-muted"></i></span>
                                    </div>
                                    <input type="text" id="matrix-search" class="form-control form-control-premium border-left-0 font-weight-500" placeholder="Search security modules, features, or permissions..." style="font-size: 0.95rem;">
                                </div>
                            </div>

                            <div class="row">
                                <!-- Expandable Sidebar Panel -->
                                <div class="col-md-3 border-right pr-3 rbac-sidebar">
                                    <h6 class="text-muted font-weight-bold text-uppercase small px-2 mb-3" style="letter-spacing: 1px;">Module Categories</h6>
                                    
                                    <div class="nav flex-column nav-pills" id="matrix-pills" role="tablist">
                                        <a class="nav-link active d-flex justify-content-between align-items-center py-3 px-3 mb-2 rounded shadow-xs active-category" id="filter-all" href="#">
                                            <span><i class="fas fa-layer-group mr-2 text-primary"></i> All Modules</span>
                                            <span class="badge badge-primary badge-pill px-2 py-1" id="badge-all">0 / 0</span>
                                        </a>

                                        <a class="nav-link d-flex justify-content-between align-items-center py-3 px-3 mb-2 rounded shadow-xs" id="filter-core" href="#">
                                            <span><i class="fas fa-shield-alt mr-2 text-success"></i> Core Modules</span>
                                            <span class="badge badge-success badge-pill px-2 py-1" id="badge-core">0 / 0</span>
                                        </a>

                                        <a class="nav-link d-flex justify-content-between align-items-center py-3 px-3 mb-2 rounded shadow-xs" id="filter-basic" href="#">
                                            <span><i class="fas fa-sliders-h mr-2 text-warning"></i> Basic Settings</span>
                                            <span class="badge badge-warning badge-pill text-dark px-2 py-1" id="badge-basic">0 / 0</span>
                                        </a>

                                        <a class="nav-link d-flex justify-content-between align-items-center py-3 px-3 mb-2 rounded shadow-xs" id="filter-institute" href="#">
                                            <span><i class="fas fa-university mr-2 text-info"></i> Institute Settings</span>
                                            <span class="badge badge-info badge-pill px-2 py-1" id="badge-institute">0 / 0</span>
                                        </a>
                                    </div>
                                    
                                    <div class="mt-4 pt-3 border-top">
                                        <h6 class="text-muted font-weight-bold text-uppercase small px-2 mb-3" style="letter-spacing: 1px;">Quick Actions</h6>
                                        <div class="px-1">
                                            <button type="button" class="btn btn-block btn-sm btn-outline-success py-2.5 mb-2 font-weight-bold" id="action-select-all">
                                                <i class="fas fa-check-double mr-1"></i> Grant All Capabilities
                                            </button>
                                            <button type="button" class="btn btn-block btn-sm btn-outline-danger py-2.5 font-weight-bold" id="action-deselect-all">
                                                <i class="fas fa-times-circle mr-1"></i> Revoke All Capabilities
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Dynamic Right-Pane Table -->
                                <div class="col-md-9 pl-3">
                                    <div class="table-responsive border rounded" style="max-height: 580px; overflow-y: auto;">
                                        <table class="table table-sm table-hover bg-white rounded mb-0 text-nowrap">
                                            <thead class="bg-light sticky-top shadow-xs" style="z-index: 10;">
                                                <tr>
                                                    <th style="min-width: 250px;" class="pl-4 py-3 text-uppercase small font-weight-bold text-dark">
                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                            <input type="checkbox" id="select_all_global" class="custom-control-input">
                                                            <label class="custom-control-label font-weight-bold" for="select_all_global">Module / Feature</label>
                                                        </div>
                                                    </th>
                                                    <th class="text-center py-3 text-uppercase small font-weight-bold">
                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                            <input type="checkbox" id="select_all_create" class="custom-control-input column-selector" data-column="create">
                                                            <label class="custom-control-label text-success font-weight-bold" for="select_all_create">Create</label>
                                                        </div>
                                                    </th>
                                                    <th class="text-center py-3 text-uppercase small font-weight-bold">
                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                            <input type="checkbox" id="select_all_read" class="custom-control-input column-selector" data-column="read">
                                                            <label class="custom-control-label text-primary font-weight-bold" for="select_all_read">Read</label>
                                                        </div>
                                                    </th>
                                                    <th class="text-center py-3 text-uppercase small font-weight-bold">
                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                            <input type="checkbox" id="select_all_update" class="custom-control-input column-selector" data-column="update">
                                                            <label class="custom-control-label text-warning font-weight-bold" for="select_all_update">Update</label>
                                                        </div>
                                                    </th>
                                                    <th class="text-center py-3 text-uppercase small font-weight-bold">
                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                            <input type="checkbox" id="select_all_delete" class="custom-control-input column-selector" data-column="delete">
                                                            <label class="custom-control-label text-danger font-weight-bold" for="select_all_delete">Delete</label>
                                                        </div>
                                                    </th>
                                                    <th class="text-center py-3 text-uppercase small font-weight-bold text-muted">Other Extras</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($permissionGroups as $groupName => $groupPermissions)
                                                <tr class="border-top matrix-row row-core">
                                                    <td class="pl-4 py-3 font-weight-bold text-dark d-flex align-items-center">
                                                        <div class="custom-control custom-checkbox mr-2">
                                                            <input type="checkbox" id="row_select_{{ $groupName }}" class="custom-control-input row-selector" data-row="{{ $groupName }}">
                                                            <label class="custom-control-label" for="row_select_{{ $groupName }}"></label>
                                                        </div>
                                                        <span class="module-title"><i class="fas fa-folder-open mr-2 text-muted"></i> {{ ucfirst($groupName) }}</span>
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
                                                                        id="perm_{{ $perm->id }}" class="custom-control-input perm-checkbox perm-{{ $action }} group-{{ $groupName }}"
                                                                        data-column="{{ $action }}" data-row="{{ $groupName }}"
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
                                                                        id="perm_{{ $p->id }}" class="custom-control-input perm-checkbox perm-other group-{{ $groupName }}"
                                                                        data-column="other" data-row="{{ $groupName }}"
                                                                        {{ (isset($role) && $role->hasPermissionTo($p->name)) ? 'checked' : '' }}>
                                                                    <label class="custom-control-label" for="perm_{{ $p->id }}"></label>
                                                                    <span class="small ml-1 text-muted">{{ str_replace($groupName.'.', '', $p->name) }}</span>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                @endforeach

                                                @if(isset($basicSettingsGroups) && count($basicSettingsGroups))
                                                @foreach($basicSettingsGroups as $groupName => $groupPermissions)
                                                <tr class="border-top matrix-row row-basic" style="background: #f8fafc;">
                                                    <td class="pl-4 py-3 font-weight-bold text-secondary d-flex align-items-center">
                                                        <div class="custom-control custom-checkbox mr-2">
                                                            <input type="checkbox" id="row_select_basic_{{ $groupName }}" class="custom-control-input row-selector" data-row="basic_{{ $groupName }}">
                                                            <label class="custom-control-label" for="row_select_basic_{{ $groupName }}"></label>
                                                        </div>
                                                        <span class="module-title"><i class="fas fa-chevron-right mr-2 text-muted" style="font-size: 0.75rem;"></i> {{ ucwords(str_replace(['_', '-'], ' ', $groupName)) }}</span>
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
                                                                        id="perm_{{ $perm->id }}" class="custom-control-input perm-checkbox perm-{{ $action }} group-basic_{{ $groupName }}"
                                                                        data-column="{{ $action }}" data-row="basic_{{ $groupName }}"
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
                                                                        id="perm_{{ $p->id }}" class="custom-control-input perm-checkbox perm-other group-basic_{{ $groupName }}"
                                                                        data-column="other" data-row="basic_{{ $groupName }}"
                                                                        {{ (isset($role) && $role->hasPermissionTo($p->name)) ? 'checked' : '' }}>
                                                                    <label class="custom-control-label" for="perm_{{ $p->id }}"></label>
                                                                    <span class="small ml-1 text-muted">{{ str_replace($groupName.'.', '', $p->name) }}</span>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif

                                                @if(isset($instituteSettingsGroups) && count($instituteSettingsGroups))
                                                @foreach($instituteSettingsGroups as $groupName => $groupPermissions)
                                                <tr class="border-top matrix-row row-institute" style="background: #f0f9ff;">
                                                    <td class="pl-4 py-3 font-weight-bold text-info d-flex align-items-center">
                                                        <div class="custom-control custom-checkbox mr-2">
                                                            <input type="checkbox" id="row_select_inst_{{ $groupName }}" class="custom-control-input row-selector" data-row="inst_{{ $groupName }}">
                                                            <label class="custom-control-label" for="row_select_inst_{{ $groupName }}"></label>
                                                        </div>
                                                        <span class="module-title"><i class="fas fa-university mr-2 text-info" style="font-size: 0.75rem;"></i> {{ ucwords(str_replace(['_', '-'], ' ', $groupName)) }}</span>
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
                                                                        id="perm_{{ $perm->id }}" class="custom-control-input perm-checkbox perm-{{ $action }} group-inst_{{ $groupName }}"
                                                                        data-column="{{ $action }}" data-row="inst_{{ $groupName }}"
                                                                        {{ (isset($role) && $role->hasPermissionTo($perm->name)) ? 'checked' : '' }}>
                                                                    <label class="custom-control-label" for="perm_{{ $perm->id }}"></label>
                                                                </div>
                                                            @else
                                                                <span class="text-muted small">-</span>
                                                            @endif
                                                        </td>
                                                    @endforeach

                                                    {{-- Column for other permissions --}}
                                                    <td class="text-center py-3">
                                                        @foreach($groupPermissions as $p)
                                                            @if(!in_array($p->id, $processedPermissions))
                                                                <div class="custom-control custom-checkbox custom-control-inline mb-1" title="{{ $p->name }}">
                                                                    <input type="checkbox" name="permissions[]" value="{{ $p->name }}"
                                                                        id="perm_{{ $p->id }}" class="custom-control-input perm-checkbox perm-other group-inst_{{ $groupName }}"
                                                                        data-column="other" data-row="inst_{{ $groupName }}"
                                                                        {{ (isset($role) && $role->hasPermissionTo($p->name)) ? 'checked' : '' }}>
                                                                    <label class="custom-control-label" for="perm_{{ $p->id }}"></label>
                                                                    <span class="small ml-1 text-muted">{{ str_replace($groupName.'.', '', $p->name) }}</span>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
                                            @if(edit_permission('roles'))
                                            <a href="{{ route('role.edit', $r->id) }}" class="btn btn-sm btn-light border" title="Modify Matrix Architecture">
                                                <i class="fas fa-edit text-primary"></i>
                                            </a>
                                            @endif
                                            @if(delete_permission('roles'))
                                            <form action="{{ route('role.destroy', $r->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-light border btn-delete-confirm" title="Decommission Role">
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
                    </div>
                </div>
                <div class="card-footer bg-white border-0 py-4 d-flex justify-content-center">
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('style')
<style>
    .shadow-xs { box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
    .form-control-premium {
        border: 2px solid #eef2f6 !important;
        border-radius: 10px !important;
        padding: 12px 20px !important;
        transition: all 0.3s ease !important;
        background: #fafbfc !important;
    }
    .form-control-premium:focus {
        border-color: #3b82f6 !important;
        background: #fff !important;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15) !important;
    }
    .rbac-sidebar .nav-link {
        font-weight: 600;
        color: #4b5563;
        transition: all 0.25s ease;
        border: 1px solid #e5e7eb;
        background: #fdfdfd;
    }
    .rbac-sidebar .nav-link:hover {
        background: #f3f4f6;
        color: #1f2937;
        transform: translateX(3px);
    }
    .rbac-sidebar .nav-link.active {
        background: #e0e7ff !important;
        color: #4338ca !important;
        border-color: #c7d2fe !important;
    }
    .badge-pill {
        font-size: 0.78rem;
        padding: 0.35em 0.75em;
    }
    .table-hover tbody tr:hover {
        background-color: #f8fafc !important;
    }
    .custom-control-label::before, .custom-control-label::after {
        top: 0.15rem !important;
        width: 1.25rem !important;
        height: 1.25rem !important;
        border-radius: 4px !important;
    }
    .custom-control-input:checked ~ .custom-control-label::before {
        background-color: #3b82f6 !important;
        border-color: #3b82f6 !important;
    }
    .sticky-top {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        background-color: #f8fafc !important;
    }
    .matrix-row {
        transition: all 0.2s ease;
    }
</style>
@endpush

@push('script')
<script>
(function($) {
    $(document).ready(function() {
        // 1. Live reactive search input
        $('#matrix-search').on('keyup', function() {
            let val = $(this).val().toLowerCase();
            let activeFilter = $('.rbac-sidebar .nav-link.active').attr('id');
            filterRows(activeFilter, val);
        });

        // 2. Left Sidebar Filter tabs
        $('.rbac-sidebar .nav-link').on('click', function(e) {
            e.preventDefault();
            $('.rbac-sidebar .nav-link').removeClass('active');
            $(this).addClass('active');
            
            let filterId = $(this).attr('id');
            let searchVal = $('#matrix-search').val().toLowerCase();
            filterRows(filterId, searchVal);
        });

        function filterRows(filterId, searchVal) {
            $('.matrix-row').each(function() {
                let row = $(this);
                let isCore = row.hasClass('row-core');
                let isBasic = row.hasClass('row-basic');
                let isInstitute = row.hasClass('row-institute');
                let text = row.find('.module-title').text().toLowerCase();
                
                let matchesSearch = text.includes(searchVal);
                let matchesCategory = false;
                
                if (filterId === 'filter-all') {
                    matchesCategory = true;
                } else if (filterId === 'filter-core' && isCore) {
                    matchesCategory = true;
                } else if (filterId === 'filter-basic' && isBasic) {
                    matchesCategory = true;
                } else if (filterId === 'filter-institute' && isInstitute) {
                    matchesCategory = true;
                }
                
                if (matchesSearch && matchesCategory) {
                    row.show();
                } else {
                    row.hide();
                }
            });
            updateCounts();
        }

        // 3. Global selector (Select All in header)
        $('#select_all_global').on('change', function() {
            let checked = $(this).prop('checked');
            $('.matrix-row:visible .perm-checkbox').prop('checked', checked).trigger('change');
        });

        // 4. Column selectors in header
        $('.column-selector').on('change', function() {
            let column = $(this).data('column');
            let checked = $(this).prop('checked');
            $('.matrix-row:visible .perm-' + column).prop('checked', checked).trigger('change');
        });

        // 5. Row-level selectors next to module name
        $('.row-selector').on('change', function() {
            let rowName = $(this).data('row');
            let checked = $(this).prop('checked');
            $('.group-' + rowName).prop('checked', checked).trigger('change');
        });

        // 6. Quick Action buttons
        $('#action-select-all').on('click', function() {
            $('.perm-checkbox').prop('checked', true).trigger('change');
        });

        $('#action-deselect-all').on('click', function() {
            $('.perm-checkbox').prop('checked', false).trigger('change');
        });

        // 7. Individual Checkbox state synchronization and badge counting!
        $('.perm-checkbox').on('change', function() {
            let row = $(this).data('row');
            let col = $(this).data('column');
            
            // Sync row selector state
            let rowCheckboxes = $('.group-' + row);
            let rowChecked = $('.group-' + row + ':checked');
            $('#row_select_' + row).prop('checked', rowCheckboxes.length > 0 && rowCheckboxes.length === rowChecked.length);
            
            // Sync column selector state
            let colCheckboxes = $('.perm-' + col);
            let colChecked = $('.perm-' + col + ':checked');
            $('#select_all_' + col).prop('checked', colCheckboxes.length > 0 && colCheckboxes.length === colChecked.length);
            
            updateCounts();
        });

        function updateCounts() {
            // Update All Modules badge
            let totalAll = $('.perm-checkbox').length;
            let checkedAll = $('.perm-checkbox:checked').length;
            $('#badge-all').text(checkedAll + ' / ' + totalAll);
            
            // Update Core badge
            let totalCore = $('.row-core .perm-checkbox').length;
            let checkedCore = $('.row-core .perm-checkbox:checked').length;
            $('#badge-core').text(checkedCore + ' / ' + totalCore);
            
            // Update Basic badge
            let totalBasic = $('.row-basic .perm-checkbox').length;
            let checkedBasic = $('.row-basic .perm-checkbox:checked').length;
            $('#badge-basic').text(checkedBasic + ' / ' + totalBasic);

            // Update Institute Settings badge
            let totalInstitute = $('.row-institute .perm-checkbox').length;
            let checkedInstitute = $('.row-institute .perm-checkbox:checked').length;
            $('#badge-institute').text(checkedInstitute + ' / ' + totalInstitute);

            // Update overall global header checkbox
            let totalVisible = $('.matrix-row:visible .perm-checkbox').length;
            let checkedVisible = $('.matrix-row:visible .perm-checkbox:checked').length;
            $('#select_all_global').prop('checked', totalVisible > 0 && totalVisible === checkedVisible);
        }

        // Initialize counts and states on page load!
        updateCounts();
        
        // Sync all row selectors with checkboxes on page load
        $('.row-selector').each(function() {
            let row = $(this).data('row');
            let rowCheckboxes = $('.group-' + row);
            let rowChecked = $('.group-' + row + ':checked');
            $(this).prop('checked', rowCheckboxes.length > 0 && rowCheckboxes.length === rowChecked.length);
        });
    });
})(jQuery);
</script>
@endpush
@endsection