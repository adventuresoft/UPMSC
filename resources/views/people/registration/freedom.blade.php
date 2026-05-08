@extends('backend.master')

@section('title', 'নাগরিক নিবন্ধন - মুক্তিযোদ্ধা তথ্য')

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
                @include('people.registration.tab_header', ['user' => $user, 'active_tab' => 'freedom'])
            </div>
            
            <form id="peopleFreedomForm" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                
                <div class="card-body bg-gray-50/30">
                    <div class="bg-white p-6 rounded-xl shadow-sm border mb-4">
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 font-bold text-gray-700">আপনি কি মুক্তিযোদ্ধা?</label>
                            <div class="col-sm-9 flex gap-6">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" value="0" name="is_freedom_fighter" class="w-4 h-4 text-green-600 focus:ring-green-500" {{(isset($user->freedomFighterInfo->is_freedom_fighter) ? (($user->freedomFighterInfo->is_freedom_fighter == 0) ? 'checked' : '') : 'checked')}}>
                                    <span class="ml-2 text-gray-700">না</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" value="1" name="is_freedom_fighter" class="w-4 h-4 text-green-600 focus:ring-green-500" {{(isset($user->freedomFighterInfo->is_freedom_fighter) ? (($user->freedomFighterInfo->is_freedom_fighter == 1) ? 'checked' : '') : '')}}>
                                    <span class="ml-2 text-gray-700">হ্যাঁ</span>
                                </label>
                            </div>
                        </div>

                        <div id="freedom-content" class="{{(isset($user->freedomFighterInfo->is_freedom_fighter) && $user->freedomFighterInfo->is_freedom_fighter == 1) ? '' : 'hidden'}} border-t pt-4 mt-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="form-group">
                                    <label class="text-xs font-bold text-gray-600 mb-1 block">মুক্তিযোদ্ধার ধরণ</label>
                                    <select name="type_id" class="form-control rounded-lg">
                                        <option value="">নির্বাচন করুন</option>
                                        @foreach (freedom_fighter_constant_option('type') as $key => $item)
                                            <option value="{{$key}}" {{isset($user->freedomFighterInfo->type_id) ? (($user->freedomFighterInfo->type_id == $key) ? 'selected' : '' ) : ''}}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="text-xs font-bold text-gray-600 mb-1 block">যুদ্ধ ক্ষেত্র/সেক্টর</label>
                                    <select name="area_id" class="form-control rounded-lg">
                                        <option value="">নির্বাচন করুন</option>
                                        @foreach (freedom_fighter_constant_option('area') as $key => $item)
                                            <option value="{{$key}}" {{isset($user->freedomFighterInfo->area_id) ? (($user->freedomFighterInfo->area_id == $key) ? 'selected' : '' ) : ''}}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="text-xs font-bold text-gray-600 mb-1 block">পদবী</label>
                                    <select name="designation_id" class="form-control rounded-lg">
                                        <option value="">নির্বাচন করুন</option>
                                        @foreach (freedom_fighter_constant_option('designation') as $key => $item)
                                            <option value="{{$key}}" {{isset($user->freedomFighterInfo->designation_id) ? (($user->freedomFighterInfo->designation_id == $key) ? 'selected' : '' ) : ''}}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="text-xs font-bold text-gray-600 mb-1 block">মুক্তিযোদ্ধা আইডি</label>
                                    <input type="text" name="freedom_fighter_id" value="{{$user->freedomFighterInfo->freedom_fighter_id ?? ''}}" class="form-control rounded-lg" placeholder="আইডি নম্বর">
                                </div>
                                <div class="form-group">
                                    <label class="text-xs font-bold text-gray-600 mb-1 block">কমান্ডার এর নাম</label>
                                    <input type="text" name="commander_name" value="{{$user->freedomFighterInfo->commander_name ?? ''}}" class="form-control rounded-lg" placeholder="কমান্ডার এর নাম">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white py-4 flex justify-between">
                    <a href="{{route('people.applications.registration.disability', $user->id)}}" class="btn btn-light px-5 py-2.5 rounded-lg font-bold text-sm border">
                        <i class="fas fa-arrow-left mr-2"></i> পূর্ববর্তী
                    </a>
                    <button type="submit" class="btn btn-success px-6 py-2.5 rounded-lg font-bold text-sm shadow-sm hover:shadow-md transition">
                        সংরক্ষণ করুন এবং শেষ করুন <i class="fas fa-check-circle ml-2"></i>
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
    $('input[name="is_freedom_fighter"]').on('change', function() {
        if($(this).val() == '1') {
            $('#freedom-content').removeClass('hidden');
        } else {
            $('#freedom-content').addClass('hidden');
        }
    });

    $("#peopleFreedomForm").on('submit', function(e) {
        e.preventDefault();
        let thisForm = $(this);
        $.ajax({
            type: "POST",
            url: "{{ route('people.applications.registration.freedomStore') }}",
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
                thisForm.find('button[type="submit"]').prop("disabled", false).html('সংরক্ষণ করুন এবং শেষ করুন <i class="fas fa-check-circle ml-2"></i>');
                toastr.error("তথ্য সংরক্ষণে ত্রুটি হয়েছে।");
            }
        });
    });
});
</script>
@endpush
