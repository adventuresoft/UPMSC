@extends('backend.master')

@section('title', 'নাগরিক নিবন্ধন - শিক্ষাগত যোগ্যতা')

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
                @include('people.registration.tab_header', ['user' => $user, 'active_tab' => 'education'])
            </div>
            
            <form id="peopleEducationForm" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                
                <div class="card-body bg-gray-50/30">
                    <div id="multiple-education">
                        @if (count($user->educationInfos))
                            @foreach ($user->educationInfos as $education)
                                <div class="single-education bg-white p-4 rounded-lg shadow-sm border mb-4 relative">
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        <div class="form-group">
                                            <label class="text-xs font-bold text-gray-600 mb-1 block">ডিগ্রী</label>
                                            <select name="degree_idU[{{$education->id}}]" required class="form-control rounded-lg">
                                                <option value="1" @if($education->degree_id == 1) selected @endif >HSC</option>
                                                <option value="2" @if($education->degree_id == 2) selected @endif >SSC</option>
                                                <option value="3" @if($education->degree_id == 3) selected @endif >JSC</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-xs font-bold text-gray-600 mb-1 block">বিভাগ/গ্রুপ</label>
                                            <select name="group_idU[{{$education->id}}]" class="form-control rounded-lg">
                                                <option value="1" @if($education->group_id == 1) selected @endif >Science</option>
                                                <option value="2" @if($education->group_id == 2) selected @endif >Business</option>
                                                <option value="3" @if($education->group_id == 3) selected @endif >Humanities</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-xs font-bold text-gray-600 mb-1 block">গ্রেড/জিপিএ</label>
                                            <select name="grade_idU[{{$education->id}}]" class="form-control rounded-lg">
                                                <option value="1" @if($education->grade_id == 1) selected @endif >A+</option>
                                                <option value="2" @if($education->grade_id == 2) selected @endif >A</option>
                                                <option value="3" @if($education->grade_id == 3) selected @endif >A-</option>
                                                <option value="4" @if($education->grade_id == 4) selected @endif >B+</option>
                                                <option value="5" @if($education->grade_id == 5) selected @endif >B</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-xs font-bold text-gray-600 mb-1 block">বোর্ড</label>
                                            <select name="board_idU[{{$education->id}}]" class="form-control rounded-lg">
                                                <option value="1" @if($education->board_id == 1) selected @endif >Dhaka</option>
                                                <option value="2" @if($education->board_id == 2) selected @endif >Rajshahi</option>
                                                <option value="3" @if($education->board_id == 3) selected @endif >Rangpur</option>
                                            </select>
                                        </div>
                                        <div class="form-group md:col-span-2">
                                            <label class="text-xs font-bold text-gray-600 mb-1 block">শিক্ষা প্রতিষ্ঠান</label>
                                            <input type="text" name="instituteU[{{$education->id}}]" value="{{$education->institute}}" class="form-control rounded-lg" placeholder="শিক্ষা প্রতিষ্ঠানের নাম">
                                        </div>
                                    </div>
                                    <button type="button" class="absolute top-2 right-2 text-red-500 hover:text-red-700 remove-btn" data-id="{{$education->id}}">
                                        <i class="fas fa-times-circle text-xl"></i>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <button type="button" id="addNewEducation" class="btn btn-outline-primary btn-sm rounded-lg">
                        <i class="fas fa-plus mr-1"></i> আরও যোগ করুন
                    </button>
                </div>

                <div class="card-footer bg-white py-4 flex justify-between">
                    <a href="{{route('people.applications.registration.address', $user->id)}}" class="btn btn-light px-5 py-2.5 rounded-lg font-bold text-sm border">
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
    $("#addNewEducation").on('click', function() {
        let html = `
            <div class="single-education bg-white p-4 rounded-lg shadow-sm border mb-4 relative">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="form-group">
                        <label class="text-xs font-bold text-gray-600 mb-1 block">ডিগ্রী</label>
                        <select name="degree_id[]" required class="form-control rounded-lg">
                            <option value="">নির্বাচন করুন</option>
                            <option value="1">HSC</option>
                            <option value="2">SSC</option>
                            <option value="3">JSC</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-xs font-bold text-gray-600 mb-1 block">বিভাগ/গ্রুপ</label>
                        <select name="group_id[]" class="form-control rounded-lg">
                            <option value="1">Science</option>
                            <option value="2">Business</option>
                            <option value="3">Humanities</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-xs font-bold text-gray-600 mb-1 block">গ্রেড/জিপিএ</label>
                        <select name="grade_id[]" class="form-control rounded-lg">
                            <option value="1">A+</option>
                            <option value="2">A</option>
                            <option value="3">A-</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-xs font-bold text-gray-600 mb-1 block">বোর্ড</label>
                        <select name="board_id[]" class="form-control rounded-lg">
                            <option value="1">Dhaka</option>
                            <option value="2">Rajshahi</option>
                            <option value="3">Rangpur</option>
                        </select>
                    </div>
                    <div class="form-group md:col-span-2">
                        <label class="text-xs font-bold text-gray-600 mb-1 block">শিক্ষা প্রতিষ্ঠান</label>
                        <input type="text" name="institute[]" class="form-control rounded-lg" placeholder="শিক্ষা প্রতিষ্ঠানের নাম">
                    </div>
                </div>
                <button type="button" class="absolute top-2 right-2 text-red-500 hover:text-red-700 remove-new-btn">
                    <i class="fas fa-times-circle text-xl"></i>
                </button>
            </div>
        `;
        $("#multiple-education").append(html);
    });

    $(document).on('click', '.remove-new-btn', function() {
        $(this).closest('.single-education').remove();
    });

    $("#peopleEducationForm").on('submit', function(e) {
        e.preventDefault();
        let thisForm = $(this);
        $.ajax({
            type: "POST",
            url: "{{ route('people.applications.registration.educationStore') }}",
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
