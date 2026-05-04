@extends('backend.master', ['mainMenu' => 'AccessManagment', 'subMenu' =>'role'])
@section('title', 'Operator Security Reset')
@section('content')
<div class="rbac-container container-fluid">
    @include('backend.pages.rbac._header')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card rbac-main-card">
                <div class="rbac-card-header">
                    <h3 class="rbac-card-title">
                        <i class="fas fa-key text-warning mr-2"></i>
                        Force Password Reset: {{$user->name}}
                    </h3>
                </div>
                <div class="rbac-card-body">
                    <form role="form" method="POST" action="{{route('user.updatePass',$user->id)}}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        
                        <div class="alert alert-warning border-0 shadow-sm mb-4">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <strong>Security Protocol:</strong> Changing the password will immediately affect the operator's next login attempt.
                        </div>

                        <div class="form-group">
                            <label for="password" class="font-weight-bold">New Secure Password</label>
                            <input type="password" name="password" id="password" class="form-control form-control-premium" required placeholder="Minimum 6 characters">
                        </div>

                        <div class="form-group mt-3">
                            <label for="password_confirmation" class="font-weight-bold">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-premium" required placeholder="Repeat the password">
                        </div>

                        <div class="text-center mt-5 border-top pt-4">
                            <button type="submit" class="btn btn-premium-save px-5">
                                <i class="fas fa-shield-alt mr-1"></i> Authorize New Password
                            </button>
                            <a href="{{route('user.index')}}" class="btn btn-link text-muted ml-2">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection