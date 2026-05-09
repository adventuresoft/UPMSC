@extends('backend.master', ['mainMenu' => 'TradeLicense', 'subMenu' =>'TradeLicenseCreate'])

@section('title', 'ট্রেড লাইসেন্স আবেদন')

@section('content')
<div class="p-4">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-sm-6">
                <h4 class="font-bold text-gray-800">ট্রেড লাইসেন্স আবেদন</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right text-xs">
                    <li class="breadcrumb-item"><a href="{{route('people.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Trade License</li>
                </ol>
            </div>
        </div>

        <div class="card card-outline card-success shadow-sm rounded-xl overflow-hidden border-0">
            <div class="card-header bg-white py-3">
                <h3 class="card-title text-sm font-bold text-gray-700">প্রতিষ্ঠানের তথ্য প্রদান করুন</h3>
            </div>
            
            <!-- form start -->
            <form class="form-horizontal" id="tradeAppForm" method="POST" enctype="multipart/form-data" action="{{ route('organization.store') }}">
                @csrf
                <input type="hidden" name="id" value="">
                
                @include('backend.pages.organization.forms.organization', ['organization' => null])

                <div class="card-footer bg-white py-4 text-right border-t">
                    <a href="{{ route('people.dashboard') }}" class="btn btn-light px-5 py-2.5 rounded-lg font-bold text-sm mr-2 border">বাতিল</a>
                    <button type="submit" class="btn btn-success px-5 py-2.5 rounded-lg font-bold text-sm shadow-sm hover:shadow-md transition">
                        <i class="fas fa-check-circle mr-2"></i> আবেদন জমা দিন
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $(".select2").select2();

        $("#tradeAppForm").on('submit', function(e) {
            e.preventDefault();
            let thisForm = $(this);
            $.ajax({
                type: "POST",
                url: thisForm.attr('action'),
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    thisForm.find('button[type="submit"]').prop("disabled", true);
                },
                success: function (response) {
                    thisForm.find('button[type="submit"]').prop("disabled", false);
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.href = "{{ route('people.dashboard') }}";
                    }, 2000)
                },
                error: function(xhr) {
                    thisForm.find('button[type="submit"]').prop("disabled", false);
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message || "ত্রুটি হয়েছে");
                    if(responseText.errors) {
                        $.each(responseText.errors, function(key, val) {
                            toastr.error(val[0]);
                        });
                    }
                }
            });
        });
    });
</script>
@endpush
