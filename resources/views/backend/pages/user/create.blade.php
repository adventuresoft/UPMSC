@extends('backend.master', ['mainMenu' => 'AccessManagment', 'subMenu' =>'role'])
@section('title', 'Operator Registration')
@section('content')
<div class="rbac-container container-fluid">
    @include('backend.pages.rbac._header')

    <div class="row">
        <div class="col-md-12">
            <div class="card rbac-main-card">
                <div class="rbac-card-header">
                    <h3 class="rbac-card-title">
                        <i class="fas fa-user-plus text-primary"></i>
                        Register New Authorized Operator
                    </h3>
                </div>
                <div class="rbac-card-body">
                    <form role="form" method="POST" action="{{route('user.store')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name" class="font-weight-bold">Full Name</label>
                                        <input type="text" name="name" class="form-control form-control-premium" id="name" placeholder="Enter Full Name" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email" class="font-weight-bold">Email Address</label>
                                        <input type="email" name="email" class="form-control form-control-premium" id="email" placeholder="email@example.com" required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group col-md-6">
                                        <label for="mobile" class="font-weight-bold">Contact Number</label>
                                        <input type="text" name="mobile" class="form-control form-control-premium" id="mobile" placeholder="e.g. 01700000000" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="area" class="font-weight-bold">Assigned Area</label>
                                        @if(is_institutional_admin() && !is_superadmin())
                                            <input type="text" name="area" class="form-control form-control-premium" id="area" value="{{ $assigned_area }}" readonly style="background-color:#e9ecef;">
                                            <small class="text-muted font-italic">Automatically assigned based on your jurisdiction.</small>
                                        @else
                                            <select name="area" id="area" class="form-control select2" required>
                                                <option value="">-- Select Area --</option>
                                                <option value="All">All System Areas (Full Access)</option>
                                                <optgroup label="Districts (for DC)">
                                                    @foreach($districts as $d)
                                                        <option value="District:{{ $d->id }}">{{ $d->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                                <optgroup label="Thanas (for UNO/ENO)">
                                                    @foreach($thanas as $t)
                                                        <option value="Thana:{{ $t->id }}">{{ $t->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                                <optgroup label="Unions">
                                                    @foreach($unions as $union)
                                                        <option value="Union:{{ $union->id }}">{{ $union->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                                <optgroup label="Pourashavas">
                                                    @foreach($pourashavas as $p)
                                                        <option value="Pourashava:{{ $p->id }}">{{ $p->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                                <optgroup label="City Corporations">
                                                    @foreach($city_corps as $c)
                                                        <option value="City Corp:{{ $c->id }}">{{ $c->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group col-md-6">
                                        <label for="password" class="font-weight-bold">Access Password</label>
                                        <input type="password" name="password" class="form-control form-control-premium" id="password" placeholder="Minimum 6 characters" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="password_confirmation" class="font-weight-bold">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control form-control-premium" id="password_confirmation" placeholder="Repeat password" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 border-left">
                                <h5 class="font-weight-bold text-muted mb-4"><i class="fas fa-shield-alt mr-2"></i> Security Identity</h5>
                                
                                <div class="form-group">
                                    <label for="roles" class="font-weight-bold">Primary Security Role</label>
                                    <select name="roles" id="roles" class="form-control select2" data-placeholder="Select a Role" required>
                                        <option value=""></option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Users inherit all capabilities assigned to their chosen role. Direct overrides are disabled for simplicity.</small>
                                </div>

                                <div class="form-group mt-5">
                                    <label class="font-weight-bold d-block">Account Status</label>
                                    <div class="mt-2">
                                        <div class="custom-control custom-radio mb-2">
                                            <input type="radio" id="status_active" name="status" value="1" class="custom-control-input" checked>
                                            <label class="custom-control-label text-success font-weight-bold" for="status_active">Verified / Active</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="status_pending" name="status" value="0" class="custom-control-input">
                                            <label class="custom-control-label text-warning font-weight-bold" for="status_pending">Pending Review</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-5 border-top pt-4">
                            <button type="submit" class="btn btn-premium-save shadow-sm px-5">
                                <i class="fas fa-check-circle mr-1"></i> Finalize Registration
                            </button>
                            <a href="{{route('user.index')}}" class="btn btn-premium-reset ml-2">
                                <i class="fas fa-arrow-left mr-1"></i> Return to Directory
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4',
            width: '100%'
        });
    });
</script>
@endpush
@endsection