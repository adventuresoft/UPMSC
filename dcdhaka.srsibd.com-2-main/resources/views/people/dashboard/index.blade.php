@extends('backend.master')

@section('title', 'Dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Citizen Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-8">
                <!-- Profile Card -->
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

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Registration ID</b> <a class="float-right">{{ $people->approved_id }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>National ID</b> <a class="float-right">{{ $people->nid ?? 'N/A' }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Mobile</b> <a class="float-right">{{ $people->mobile }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Email</b> <a class="float-right">{{ $people->email }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Info Boxes -->
                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="fas fa-shield-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Account Security</span>
                        <span class="info-box-number">Status: Active</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                            <a href="{{ route('people.password.change') }}" class="text-white">Update Password <i class="fas fa-arrow-circle-right"></i></a>
                        </span>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quick Actions</h3>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-file-invoice text-primary"></i> Apply for Certificate
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-coins text-success"></i> Tax Payments
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-bullhorn text-warning"></i> Submit Complaint
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
