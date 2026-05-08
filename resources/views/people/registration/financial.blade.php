@extends('backend.master')

@section('title', 'নাগরিক নিবন্ধন - আর্থিক তথ্য')

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
                @include('people.registration.tab_header', ['user' => $user, 'active_tab' => 'financial'])
            </div>
            
            <form id="peopleFinancialForm" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                
                <div class="card-body bg-gray-50/30">
                    <div id="multiple-financial">
                        @if (count($user->financialInfos))
                            @foreach ($user->financialInfos as $info)
                                <div class="single-financial bg-white p-4 rounded-lg shadow-sm border mb-4 relative">
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                        <div class="form-group">
                                            <label class="text-xs font-bold text-gray-600 mb-1 block">হিসাব নম্বর</label>
                                            <input type="text" name="account_noU[{{$info->id}}]" value="{{$info->account_no}}" required class="form-control rounded-lg" placeholder="হিসাব নম্বর">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-xs font-bold text-gray-600 mb-1 block">হিসাবের ধরণ</label>
                                            <select name="account_typeU[{{$info->id}}]" class="form-control rounded-lg">
                                                @foreach ($account_types as $type)
                                                    <option value="{{$type->id}}" @if($info->account_type_id == $type->id) selected @endif>{{$type->bn_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-xs font-bold text-gray-600 mb-1 block">ব্যাংক</label>
                                            <select name="bank_idU[{{$info->id}}]" class="form-control rounded-lg">
                                                @foreach ($banks as $bank)
                                                    <option value="{{$bank->id}}" @if($info->bank_id == $bank->id) selected @endif>{{$bank->bn_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-xs font-bold text-gray-600 mb-1 block">বর্তমান স্থিতি (টাকা)</label>
                                            <input type="number" name="account_balanceU[{{$info->id}}]" value="{{$info->account_balance}}" class="form-control rounded-lg" placeholder="0.00">
                                        </div>
                                    </div>
                                    <button type="button" class="absolute top-2 right-2 text-red-500 hover:text-red-700 remove-btn" data-id="{{$info->id}}">
                                        <i class="fas fa-times-circle text-xl"></i>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <button type="button" id="addNewFinancial" class="btn btn-outline-primary btn-sm rounded-lg">
                        <i class="fas fa-plus mr-1"></i> আর্থিক তথ্য যোগ করুন
                    </button>
                </div>

                <div class="card-footer bg-white py-4 flex justify-between">
                    <a href="{{route('people.applications.registration.professional', $user->id)}}" class="btn btn-light px-5 py-2.5 rounded-lg font-bold text-sm border">
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
    $("#addNewFinancial").on('click', function() {
        let html = `
            <div class="single-financial bg-white p-4 rounded-lg shadow-sm border mb-4 relative">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="form-group">
                        <label class="text-xs font-bold text-gray-600 mb-1 block">হিসাব নম্বর</label>
                        <input type="text" name="account_no[]" required class="form-control rounded-lg" placeholder="হিসাব নম্বর">
                    </div>
                    <div class="form-group">
                        <label class="text-xs font-bold text-gray-600 mb-1 block">হিসাবের ধরণ</label>
                        <select name="account_type_id[]" class="form-control rounded-lg">
                            <option value="">নির্বাচন করুন</option>
                            @foreach ($account_types as $type)
                                <option value="{{$type->id}}">{{$type->bn_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-xs font-bold text-gray-600 mb-1 block">ব্যাংক</label>
                        <select name="bank_id[]" class="form-control rounded-lg">
                            <option value="">নির্বাচন করুন</option>
                            @foreach ($banks as $bank)
                                <option value="{{$bank->id}}">{{$bank->bn_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-xs font-bold text-gray-600 mb-1 block">বর্তমান স্থিতি (টাকা)</label>
                        <input type="number" name="account_balance[]" class="form-control rounded-lg" placeholder="0.00">
                    </div>
                </div>
                <button type="button" class="absolute top-2 right-2 text-red-500 hover:text-red-700 remove-new-btn">
                    <i class="fas fa-times-circle text-xl"></i>
                </button>
            </div>
        `;
        $("#multiple-financial").append(html);
    });

    $(document).on('click', '.remove-new-btn', function() {
        $(this).closest('.single-financial').remove();
    });

    $("#peopleFinancialForm").on('submit', function(e) {
        e.preventDefault();
        let thisForm = $(this);
        $.ajax({
            type: "POST",
            url: "{{ route('people.applications.registration.financialStore') }}",
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
