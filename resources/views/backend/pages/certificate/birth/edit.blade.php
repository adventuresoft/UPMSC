@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' => 'Birth'])

@push('style')
<style></style>
@endpush

@section('title', 'Birth Certificate - Edit')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Birth Certificate</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('certificate/birth.index') }}">Birth Certificate</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">
                            Edit Certificate #{{ $certificate->system_id ?? $certificate->id }}
                        </h3>
                    </div>

                    <form class="form-horizontal" id="editCertificateForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="user_id" class="col-sm-2 col-form-label">
                                    ID &amp; Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <select required class="form-control select2" name="user_id" id="user_id">
                                        <option value="">Select Citizen</option>
                                        @forelse ($users as $user)
                                            @if (isset($user->people->approved_id))
                                                <option value="{{ $user->id }}"
                                                    {{ $certificate->user_id == $user->id ? 'selected' : '' }}>
                                                    {{ $user->people->approved_id }} &mdash; {{ $user->name }}
                                                    @if($user->mobile) &mdash; {{ $user->mobile }} @endif
                                                </option>
                                            @endif
                                        @empty
                                            <option value="">No approved citizens found</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-warning" id="updateBtn">
                                        <i class="fa fa-save mr-1"></i> Update Certificate
                                    </button>
                                    <a href="{{ route('certificate/birth.index') }}" class="btn btn-default ml-2">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('script')
<script>
$(document).ready(function() {
    $(".select2").select2();

    $("#editCertificateForm").on('submit', function(e) {
        e.preventDefault();
        const btn = $('#updateBtn');

        $.ajax({
            type: "POST",
            url: "{{ route('certificate/birth.update', $certificate->id) }}",
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                btn.prop("disabled", true).html('<i class="fa fa-spinner fa-spin mr-1"></i> Updating...');
            },
            success: function(response) {
                btn.prop("disabled", false).html('<i class="fa fa-save mr-1"></i> Update Certificate');
                toastr.success(response.message);
                setTimeout(function() {
                    location.href = response.redirect_url;
                }, 1500);
            },
            error: function(xhr) {
                btn.prop("disabled", false).html('<i class="fa fa-save mr-1"></i> Update Certificate');
                toastr.error(xhr.responseJSON?.message ?? 'Update failed.');
            }
        });
    });
});
</script>
@endpush
