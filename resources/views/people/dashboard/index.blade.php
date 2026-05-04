@extends('people.layouts.portal')

@section('title', 'Dashboard')
@section('page_title', 'Citizen Dashboard')

@section('content')
<div class="row g-4">
    <!-- Profile Card -->
    <div class="col-lg-8">
        <div class="premium-card h-100">
            <div class="card-body-premium">
                <div class="d-flex align-items-center gap-4 mb-4">
                    <div class="profile-img-large" style="width: 100px; height: 100px; border-radius: 20px; overflow: hidden; border: 4px solid #f1f5f9;">
                        @if($people->image)
                            <img src="{{ asset($people->image) }}" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div class="bg-primary text-white d-flex align-items-center justify-content-center h-100 fs-1">
                                {{ strtoupper(substr($people->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div>
                        <h3 class="mb-1">{{ $people->name }}</h3>
                        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                            <i class="fas fa-check-circle me-1"></i> Verified Citizen
                        </span>
                        <p class="text-muted mt-2 mb-0"><i class="fas fa-id-badge me-1"></i> Reg ID: <strong>{{ $people->approved_id }}</strong></p>
                    </div>
                </div>

                <div class="row g-4 mt-2">
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-4">
                            <small class="text-muted d-block mb-1">National ID</small>
                            <span class="fw-semibold">{{ $people->nid ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-4">
                            <small class="text-muted d-block mb-1">Mobile</small>
                            <span class="fw-semibold">{{ $people->mobile }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-4">
                            <small class="text-muted d-block mb-1">Email</small>
                            <span class="fw-semibold">{{ $people->email }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="col-lg-4">
        <div class="premium-card bg-primary text-white h-100">
            <div class="card-body-premium">
                <h5 class="mb-4">Account Security</h5>
                <div class="mb-4">
                    <small class="d-block opacity-75">Last Login</small>
                    <span class="fs-5 fw-bold">{{ $people->loginLogs()->where('status', 'success')->latest()->first() ? $people->loginLogs()->where('status', 'success')->latest()->first()->created_at->format('d M, Y h:i A') : 'First session' }}</span>
                </div>
                <div class="mb-4">
                    <small class="d-block opacity-75">Account Status</small>
                    <span class="badge bg-white text-primary px-3 py-1">Active</span>
                </div>
                <a href="{{ route('people.password.change') }}" class="btn btn-light w-100 fw-bold">
                    <i class="fas fa-key me-2"></i> Update Password
                </a>
            </div>
        </div>
    </div>

    <!-- Features Grid -->
    <div class="col-md-4">
        <div class="premium-card">
            <div class="card-body-premium text-center">
                <div class="icon-circle bg-info-subtle text-info mb-3 mx-auto" style="width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <h5>Apply for Certificate</h5>
                <p class="text-muted small">Request citizen, character or birth certificates online.</p>
                <button class="btn btn-outline-info btn-sm px-4">Apply Now</button>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="premium-card">
            <div class="card-body-premium text-center">
                <div class="icon-circle bg-success-subtle text-success mb-3 mx-auto" style="width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                    <i class="fas fa-coins"></i>
                </div>
                <h5>Tax Payments</h5>
                <p class="text-muted small">View your tax history and make secure online payments.</p>
                <button class="btn btn-outline-success btn-sm px-4">Pay Taxes</button>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="premium-card">
            <div class="card-body-premium text-center">
                <div class="icon-circle bg-warning-subtle text-warning mb-3 mx-auto" style="width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <h5>Complaints</h5>
                <p class="text-muted small">Submit feedback or complaints directly to the council.</p>
                <button class="btn btn-outline-warning btn-sm px-4">Submit</button>
            </div>
        </div>
    </div>
</div>
@endsection
