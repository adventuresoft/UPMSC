@extends('backend.master')

@section('title', 'নাগরিক নিবন্ধন - সম্পদ তথ্য')

@section('content')
<div class="p-4">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-sm-6">
                <h4 class="font-bold text-gray-800">নাগরিক তথ্য নিবন্ধন</h4>
            </div>
        </div>

        <div class="card card-outline card-success shadow-sm rounded-xl overflow-hidden border-0">
            <div class="card-header bg-white py-3">
                @include('people.registration.tab_header', ['user' => $user, 'active_tab' => 'property'])
            </div>
            
            <form id="peoplePropertyForm" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                
                <div class="card-body bg-gray-50/30">
                    <div id="multiple-property">
                        @if (count($user->propertyInfos))
                            @foreach ($user->propertyInfos as $info)
                                <div class="single-property bg-white p-4 rounded-lg shadow-sm border mb-4 relative">
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        <div class="form-group">
                                            <label class="text-xs font-bold text-gray-600 mb-1 block">খতিয়ান নম্বর</label>
                                            <input type="text" name="land_khatian_idU[{{$info->id}}]" value="{{$info->land_khatian_id}}" class="form-control rounded-lg" placeholder="খতিয়ান নম্বর">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-xs font-bold text-gray-600 mb-1 block">দাগ নম্বর</label>
                                            <input type="text" name="land_dag_noU[{{$info->id}}]" value="{{$info->land_dag_no}}" class="form-control rounded-lg" placeholder="দাগ নম্বর">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-xs font-bold text-gray-600 mb-1 block">জমির পরিমাণ (শতক)</label>
                                            <input type="text" name="land_quantityU[{{$info->id}}]" value="{{$info->land_quantity}}" class="form-control rounded-lg" placeholder="পরিমাণ">
                                        </div>
                                        <!-- Add more fields if necessary, like Mouza/LandType dropdowns -->
                                    </div>
                                    <button type="button" class="absolute top-2 right-2 text-red-500 hover:text-red-700 remove-btn" data-id="{{$info->id}}">
                                        <i class="fas fa-times-circle text-xl"></i>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <button type="button" id="addNewProperty" class="btn btn-outline-primary btn-sm rounded-lg">
                        <i class="fas fa-plus mr-1"></i> সম্পদ তথ্য যোগ করুন
                    </button>
                </div>

                <div class="card-footer bg-white py-4 flex justify-between">
                    <a href="{{route('people.applications.registration.financial', $user->id)}}" class="btn btn-light px-5 py-2.5 rounded-lg font-bold text-sm border">
                        <i class="fas fa-arrow-left mr-2"></i> পূর্ববর্তী
                    </a>
                    <button type="submit" class="btn btn-success px-6 py-2.5 rounded-lg font-bold text-sm shadow-sm hover:shadow-md transition">
                        সংরক্ষণ করুন এবং পরবর্তী <i class="fas fa-arrow-right ml-2"></i>
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
    $("#addNewProperty").on('click', function() {
        let html = `
            <div class="single-property bg-white p-4 rounded-lg shadow-sm border mb-4 relative">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="form-group">
                        <label class="text-xs font-bold text-gray-600 mb-1 block">খতিয়ান নম্বর</label>
                        <input type="text" name="land_khatian_id[]" class="form-control rounded-lg" placeholder="খতিয়ান নম্বর">
                    </div>
                    <div class="form-group">
                        <label class="text-xs font-bold text-gray-600 mb-1 block">দাগ নম্বর</label>
                        <input type="text" name="land_dag_no[]" class="form-control rounded-lg" placeholder="দাগ নম্বর">
                    </div>
                    <div class="form-group">
                        <label class="text-xs font-bold text-gray-600 mb-1 block">জমির পরিমাণ (শতক)</label>
                        <input type="text" name="land_quantity[]" class="form-control rounded-lg" placeholder="পরিমাণ">
                    </div>
                </div>
                <button type="button" class="absolute top-2 right-2 text-red-500 hover:text-red-700 remove-new-btn">
                    <i class="fas fa-times-circle text-xl"></i>
                </button>
            </div>
        `;
        $("#multiple-property").append(html);
    });

    $(document).on('click', '.remove-new-btn', function() {
        $(this).closest('.single-property').remove();
    });

    $("#peoplePropertyForm").on('submit', function(e) {
        e.preventDefault();
        let thisForm = $(this);
        $.ajax({
            type: "POST",
            url: "{{ route('people.applications.registration.propertyStore') }}",
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                thisForm.find('button[type="submit"]').prop("disabled", true).html('<i class="fas fa-spinner fa-spin mr-2"></i> সংরক্ষণ হচ্ছে...');
            },
            success: function(response) {
                toastr.success(response.message);
                setTimeout(function() {
                    location.href = response.redirect_url;
                }, 1000);
            },
            error: function(xhr) {
                thisForm.find('button[type="submit"]').prop("disabled", false).html('সংরক্ষণ করুন এবং পরবর্তী <i class="fas fa-arrow-right ml-2"></i>');
                toastr.error("তথ্য সংরক্ষণে ত্রুটি হয়েছে।");
            }
        });
    });
});
</script>
@endpush
