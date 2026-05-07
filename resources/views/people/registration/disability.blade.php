@extends('backend.master')

@section('title', 'নাগরিক নিবন্ধন - প্রতিবন্ধিতা তথ্য')

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
                @include('people.registration.tab_header', ['user' => $user, 'active_tab' => 'disability'])
            </div>
            
            <form id="peopleDisabilityForm" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                
                <div class="card-body bg-gray-50/30">
                    <div class="bg-white p-6 rounded-xl shadow-sm border mb-4">
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 font-bold text-gray-700">আপনি কি প্রতিবন্ধী?</label>
                            <div class="col-sm-9 flex gap-6">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" value="0" name="is_disability" class="w-4 h-4 text-green-600 focus:ring-green-500" {{(isset($user->disabilityInfo->is_disability) ? (($user->disabilityInfo->is_disability == 0) ? 'checked' : '') : 'checked')}}>
                                    <span class="ml-2 text-gray-700">না</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" value="1" name="is_disability" class="w-4 h-4 text-green-600 focus:ring-green-500" {{(isset($user->disabilityInfo->is_disability) ? (($user->disabilityInfo->is_disability == 1) ? 'checked' : '') : '')}}>
                                    <span class="ml-2 text-gray-700">হ্যাঁ</span>
                                </label>
                            </div>
                        </div>

                        <div id="disability-content" class="{{(isset($user->disabilityInfo->is_disability) && $user->disabilityInfo->is_disability == 1) ? '' : 'hidden'}} border-t pt-4 mt-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="form-group">
                                    <label class="text-xs font-bold text-gray-600 mb-1 block">প্রতিবন্ধিতার ধরণ</label>
                                    <select name="disability_type_id" class="form-control rounded-lg">
                                        <option value="">নির্বাচন করুন</option>
                                        @foreach (disability_constant_option('disability_type') as $key => $item)
                                            <option value="{{$key}}" {{isset($user->disabilityInfo->disability_type_id) ? (($user->disabilityInfo->disability_type_id == $key) ? 'selected' : '' ) : ''}}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="text-xs font-bold text-gray-600 mb-1 block">প্রতিবন্ধিতার নাম</label>
                                    <select name="disability_name_id" class="form-control rounded-lg">
                                        <option value="">নির্বাচন করুন</option>
                                        @foreach (disability_constant_option('disability_name') as $key => $item)
                                            <option value="{{$key}}" {{isset($user->disabilityInfo->disability_name_id) ? (($user->disabilityInfo->disability_name_id == $key) ? 'selected' : '' ) : ''}}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="text-xs font-bold text-gray-600 mb-1 block">প্রতিবন্ধিতার ধরণ (Category)</label>
                                    <select name="disability_category_id" class="form-control rounded-lg">
                                        <option value="">নির্বাচন করুন</option>
                                        @foreach (disability_constant_option('disability_category') as $key => $item)
                                            <option value="{{$key}}" {{isset($user->disabilityInfo->disability_category_id) ? (($user->disabilityInfo->disability_category_id == $key) ? 'selected' : '' ) : ''}}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="text-xs font-bold text-gray-600 mb-1 block">শুরু হওয়ার তারিখ</label>
                                    <input type="date" name="start_date" value="{{$user->disabilityInfo->start_date ?? ''}}" class="form-control rounded-lg">
                                </div>
                                <div class="form-group">
                                    <label class="text-xs font-bold text-gray-600 mb-1 block">চিকিৎসার অবস্থা</label>
                                    <select name="treatment_status_id" class="form-control rounded-lg">
                                        <option value="">নির্বাচন করুন</option>
                                        @foreach (disability_constant_option('treatment_status') as $key => $item)
                                            <option value="{{$key}}" {{isset($user->disabilityInfo->treatment_status_id) ? (($user->disabilityInfo->treatment_status_id == $key) ? 'selected' : '' ) : ''}}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white py-4 flex justify-between">
                    <a href="{{route('people.applications.registration.property', $user->id)}}" class="btn btn-light px-5 py-2.5 rounded-lg font-bold text-sm border">
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
    $('input[name="is_disability"]').on('change', function() {
        if($(this).val() == '1') {
            $('#disability-content').removeClass('hidden');
        } else {
            $('#disability-content').addClass('hidden');
        }
    });

    $("#peopleDisabilityForm").on('submit', function(e) {
        e.preventDefault();
        let thisForm = $(this);
        $.ajax({
            type: "POST",
            url: "{{ route('people.applications.registration.disabilityStore') }}",
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
