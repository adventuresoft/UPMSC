@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' => 'Birth'])

@push('style')
<style></style>
@endpush

@section('title', 'Birth Certificate - Create')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Birth Certificate</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('certificate/birth.index') }}">Birth Certificate</a>
                    </li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Citizen Information</h3>
                    </div>

                    <form class="form-horizontal" id="certificateForm" method="POST" enctype="multipart/form-data">
                        @csrf
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
                                                <option value="{{ $user->id }}">
                                                    {{ $user->people->approved_id }} &mdash; {{ $user->name }}
                                                    @if($user->mobile) &mdash; {{ $user->mobile }} @endif
                                                </option>
                                            @endif
                                        @empty
                                            <option value="">No approved citizens found</option>
                                        @endforelse
                                    </select>
                                    <small class="text-muted">Only approved citizens are listed.</small>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-info" id="submitBtn">
                                        <i class="fa fa-save mr-1"></i> Generate Certificate
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

    $("#certificateForm").on('submit', function(e) {
        e.preventDefault();
        const thisForm = $(this);
        const btn = $('#submitBtn');

        $.ajax({
            type: "POST",
            url: "{{ route('certificate/birth.store') }}",
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                btn.prop("disabled", true).html('<i class="fa fa-spinner fa-spin mr-1"></i> Generating...');
            },
            success: function(response) {
                btn.prop("disabled", false).html('<i class="fa fa-save mr-1"></i> Generate Certificate');
                toastr.success(response.message);
                setTimeout(function() {
                    location.href = response.redirect_url;
                }, 1500);
            },
            error: function(xhr) {
                btn.prop("disabled", false).html('<i class="fa fa-save mr-1"></i> Generate Certificate');
                const responseText = xhr.responseJSON ?? {};
                toastr.error(responseText.message ?? 'Something went wrong.');
                if (responseText.errors) {
                    $.each(responseText.errors, function(key, val) {
                        thisForm.find("." + key + "-error").text(val[0]);
                    });
                }
            }
        });
    });
});
</script>
@endpush
