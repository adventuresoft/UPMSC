@extends('frontend.master')
@section('title', 'ট্রেড লাইসেন্স আবেদন')
@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow border-success">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0 font-weight-bold">ট্রেড লাইসেন্স আবেদন (Organization Information)</h4>
                </div>
                <form class="form-horizontal" id="organizationForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="">
                    
                    @include('backend.pages.organization.forms.organization', ['organization' => null])
                    
                    <div class="card-footer bg-white border-top text-right">
                        <button type="submit" class="btn btn-success px-5 font-weight-bold">আবেদন জমা দিন</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
             $(".select2").select2();
            $("#organizationForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{route('public.organization.store')}}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType:false,
                    cache:false,
                    processData:false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled",true);
                    },
                    success: function (response) {
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        toastr.success(response.message);
                        setTimeout(() => {
                            location.href= response.redirect_url || '/';
                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message || "ত্রুটি হয়েছে");
                        if (responseText.errors) {
                            $.each(responseText.errors, function(key, val) {
                                thisForm.find("." + key + "_error").text(val[0]);
                                toastr.error(val[0]);
                            });
                        }
                    }
                });
            })
        })
    </script>
@endpush
