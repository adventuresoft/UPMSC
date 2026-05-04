@extends('people.layouts.portal')

@section('title', 'Security Settings')
@section('page_title', 'Security & Access')

@section('content')
<div class="row g-4">
    <div class="col-lg-6">
        <div class="premium-card">
            <div class="card-body-premium">
                <h5 class="mb-4">Update Password</h5>
                
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('people.password.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control" required>
                        <div class="form-text">Minimum 8 characters with a mix of letters and numbers.</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-premium btn-primary-premium w-100">
                        Update Security Credentials
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="premium-card h-100">
            <div class="card-body-premium">
                <h5 class="mb-4">Recent Login Activity</h5>
                <div class="list-group list-group-flush">
                    @forelse(Auth::guard('people')->user()->loginLogs()->latest()->take(5)->get() as $log)
                        <div class="list-group-item bg-transparent px-0 border-slate-100">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0 {{ $log->status === 'failed' ? 'text-danger' : 'text-success' }}">
                                        {{ $log->status === 'success' ? 'Successful Login' : 'Failed Attempt' }}
                                    </h6>
                                    <small class="text-muted">{{ $log->ip_address }} • {{ $log->created_at->format('d M, h:i A') }}</small>
                                </div>
                                @if($log->status === 'success')
                                    <i class="fas fa-check-circle text-success"></i>
                                @else
                                    <i class="fas fa-exclamation-triangle text-danger"></i>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-muted py-4 text-center">No recent activity found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
