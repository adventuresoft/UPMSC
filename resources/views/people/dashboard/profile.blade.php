@extends('people.layouts.portal')

@section('title', 'My Profile')
@section('page_title', 'Account Information')

@section('content')
<div class="row g-4">
    <div class="col-lg-12">
        <div class="premium-card">
            <div class="card-body-premium">
                <div class="row align-items-center mb-4">
                    <div class="col-auto">
                        <div style="width: 120px; height: 120px; border-radius: 24px; overflow: hidden; border: 4px solid #f1f5f9;">
                            @if($people->image)
                                <img src="{{ asset($people->image) }}" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div class="bg-primary text-white d-flex align-items-center justify-content-center h-100 fs-1">
                                    {{ strtoupper(substr($people->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <h2 class="mb-1">{{ $people->name }}</h2>
                        <p class="text-muted mb-0"><i class="fas fa-map-marker-alt me-1"></i> {{ $people->user->addressInfo->presentDistrict->name ?? '—' }}, Bangladesh</p>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <h5 class="border-bottom pb-2 mb-3">Personal Details</h5>
                        <table class="table table-borderless">
                            <tr><td class="text-muted ps-0" width="40%">Full Name</td><td class="fw-medium">{{ $people->name }}</td></tr>
                            <tr><td class="text-muted ps-0">Name (Bengla)</td><td class="fw-medium">{{ $people->bn_name ?? '—' }}</td></tr>
                            <tr><td class="text-muted ps-0">Gender</td><td class="fw-medium">{{ people_constant_option('gender')[$people->gender ?? ''] ?? '—' }}</td></tr>
                            <tr><td class="text-muted ps-0">Date of Birth</td><td class="fw-medium">{{ $people->date_of_birth ? \Carbon\Carbon::parse($people->date_of_birth)->format('d M, Y') : '—' }}</td></tr>
                            <tr><td class="text-muted ps-0">Blood Group</td><td class="fw-medium">{{ people_constant_option('blood_group')[$people->blood_group ?? ''] ?? '—' }}</td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5 class="border-bottom pb-2 mb-3">Identification</h5>
                        <table class="table table-borderless">
                            <tr><td class="text-muted ps-0" width="40%">People ID</td><td class="fw-bold text-primary">{{ $people->approved_id }}</td></tr>
                            <tr><td class="text-muted ps-0">National ID</td><td class="fw-medium">{{ $people->nid ?? '—' }}</td></tr>
                            <tr><td class="text-muted ps-0">Birth Certificate</td><td class="fw-medium">{{ $people->birth_certificate ?? '—' }}</td></tr>
                            <tr><td class="text-muted ps-0">Mobile</td><td class="fw-medium">{{ $people->mobile }}</td></tr>
                            <tr><td class="text-muted ps-0">Email</td><td class="fw-medium">{{ $people->email }}</td></tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
