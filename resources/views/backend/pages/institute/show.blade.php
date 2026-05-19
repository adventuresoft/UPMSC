@extends('backend.master', ['mainMenu' => 'Institute', 'subMenu' =>'InstituteList'])

@push('style')
<style>
    .info-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #edf2f7;
        margin-bottom: 2rem;
        overflow: hidden;
    }
    .info-header {
        background: #f8fafc;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #edf2f7;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .info-title {
        font-size: 16px;
        font-weight: 700;
        color: #1a202c;
        margin: 0;
    }
    .info-body {
        padding: 1.5rem;
    }
    .info-row {
        display: flex;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f7fafc;
    }
    .info-row:last-child {
        border-bottom: none;
    }
    .info-label {
        width: 200px;
        font-weight: 600;
        color: #64748b;
        font-size: 14px;
    }
    .info-value {
        color: #1e293b;
        font-weight: 500;
        font-size: 14px;
    }
    .badge-status {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    .badge-active { background: #dcfce7; color: #16a34a; }
    .image-preview-box {
        width: 100%;
        height: 150px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #e2e8f0;
    }
    .btn-edit-tab {
        font-size: 12px;
        font-weight: 600;
        padding: 6px 16px;
        border-radius: 6px;
        transition: all 0.2s;
    }
</style>
@endpush

@section('title', 'Institute Details')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-sm-6">
                <h1 class="font-weight-bold">Institute Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('institute.index')}}">Institutes</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Left Side: Basic Info -->
            <div class="col-md-8">
                <div class="info-card">
                    <div class="info-header">
                        <h3 class="info-title"><i class="fas fa-university mr-2 text-primary"></i> Basic Information</h3>
                        @can('institute.update')
                        <a href="{{route('institute.edit', $institute->id)}}" class="btn btn-sm btn-outline-primary btn-edit-tab">
                            <i class="fas fa-edit mr-1"></i> Edit Info
                        </a>
                        @endcan
                    </div>
                    <div class="info-body">
                        <div class="info-row">
                            <div class="info-label">Institute Name</div>
                            <div class="info-value">
                                @if ($institute->institute_type_id == 1)
                                    {{$institute->union?->name}} (Union)
                                @elseif($institute->institute_type_id == 2)
                                    {{$institute->pourashava?->name}} (Pourashava)
                                @elseif($institute->institute_type_id == 3)
                                    {{$institute->cityCorporation?->name}} (City Corporation)
                                @endif
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Type</div>
                            <div class="info-value">{{$institute->type?->name}}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Category</div>
                            <div class="info-value">{{$institute->category?->name}}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Subcategory</div>
                            <div class="info-value">
                                @php
                                    $sub = [1 => 'Subcategory A', 2 => 'Subcategory B', 3 => 'Subcategory C'];
                                @endphp
                                {{$sub[$institute->institute_subcategory_id] ?? 'N/A'}}
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Activation Date</div>
                            <div class="info-value text-primary font-weight-bold">
                                {{ date("d M, Y", strtotime($institute->activation_time)) }}
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Location</div>
                            <div class="info-value">
                                @if($institute->institute_type_id == 1 && $institute->union)
                                    {{ $institute->union->thana->name }}, {{ $institute->union->thana->district->name }}, {{ $institute->union->thana->district->division->name }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-header">
                        <h3 class="info-title"><i class="fas fa-user-shield mr-2 text-success"></i> Administrative Access</h3>
                        @can('institutional-admin.update')
                        <a href="{{route('instituteA.adminCreate', $institute->id)}}" class="btn btn-sm btn-outline-success btn-edit-tab">
                            <i class="fas fa-user-edit mr-1"></i> Manage Admin
                        </a>
                        @endcan
                    </div>
                    <div class="info-body">
                        @if($institute->superUser)
                        <div class="info-row">
                            <div class="info-label">Admin Name</div>
                            <div class="info-value">{{$institute->superUser->name}}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Login Email</div>
                            <div class="info-value">{{$institute->superUser->email}}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Mobile</div>
                            <div class="info-value">{{$institute->superUser->mobile ?? 'N/A'}}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Status</div>
                            <div class="info-value">
                                <span class="badge-status badge-active">Active</span>
                            </div>
                        </div>
                        @else
                        <div class="text-center py-4">
                            <p class="text-muted">No admin assigned yet.</p>
                            @can('institutional-admin.create')
                            <a href="{{route('instituteA.adminCreate', $institute->id)}}" class="btn btn-sm btn-primary">Assign Admin</a>
                            @endcan
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Side: Images -->
            <div class="col-md-4">
                <div class="info-card">
                    <div class="info-header">
                        <h3 class="info-title"><i class="fas fa-images mr-2 text-warning"></i> Visual Assets</h3>
                        @can('institute.update')
                        <a href="{{route('instituteA.imagesCreate', $institute->id)}}" class="btn btn-sm btn-outline-warning btn-edit-tab">
                            <i class="fas fa-camera mr-1"></i> Update
                        </a>
                        @endcan
                    </div>
                    <div class="info-body">
                        <div class="mb-4">
                            <label class="info-label d-block mb-2">Top Banner</label>
                            <img src="{{ $institute->top_image ? asset($institute->top_image) : asset('default-banner.png') }}" class="image-preview-box" onerror="this.src='{{asset('default-banner.png')}}'">
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="info-label d-block mb-2">Left Asset</label>
                                <img src="{{ $institute->left_image ? asset($institute->left_image) : asset('default-image.png') }}" class="image-preview-box" onerror="this.src='{{asset('default-image.png')}}'">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="info-label d-block mb-2">Right Asset</label>
                                <img src="{{ $institute->right_image ? asset($institute->right_image) : asset('default-image.png') }}" class="image-preview-box" onerror="this.src='{{asset('default-image.png')}}'">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
@endpush
