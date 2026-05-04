@extends('backend.master')

@section('title', 'My Profile')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">My Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('people.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            @if($people->image)
                                <img class="profile-user-img img-fluid img-circle" src="{{ asset($people->image) }}" alt="User profile picture">
                            @else
                                <div class="profile-user-img img-fluid img-circle bg-primary d-flex align-items-center justify-content-center text-white" style="height: 100px; width: 100px; font-size: 40px;">
                                    {{ strtoupper(substr($people->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>

                        <h3 class="profile-username text-center">{{ $people->name }}</h3>
                        <p class="text-muted text-center">Verified Citizen</p>
                    </div>
                </div>

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Identification</h3>
                    </div>
                    <div class="card-body">
                        <strong><i class="fas fa-id-card mr-1"></i> National ID</strong>
                        <p class="text-muted">{{ $people->nid ?? 'N/A' }}</p>
                        <hr>
                        <strong><i class="fas fa-id-badge mr-1"></i> People ID</strong>
                        <p class="text-muted">{{ $people->approved_id }}</p>
                        <hr>
                        <strong><i class="fas fa-phone mr-1"></i> Mobile</strong>
                        <p class="text-muted">{{ $people->mobile }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#personal" data-toggle="tab">Personal Details</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="personal">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th style="width: 30%">Full Name</th>
                                            <td>{{ $people->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Name (Bengali)</th>
                                            <td>{{ $people->bn_name ?? '—' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Gender</th>
                                            <td>{{ people_constant_option('gender')[$people->gender ?? ''] ?? '—' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date of Birth</th>
                                            <td>{{ $people->date_of_birth ? \Carbon\Carbon::parse($people->date_of_birth)->format('d M, Y') : '—' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Blood Group</th>
                                            <td>{{ people_constant_option('blood_group')[$people->blood_group ?? ''] ?? '—' }}</td>
                                        </tr>
                                        <tr>
                                            <th>District</th>
                                            <td>{{ $people->user->addressInfo->presentDistrict->name ?? '—' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
