@extends('backend.master')

@section('title', 'নাগরিক নিবন্ধন - পারিবারিক তথ্য')

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
                @include('people.registration.tab_header', ['user' => $user, 'active_tab' => 'family'])
            </div>
            
            <form id="citizenFamilyForm" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                
                <div class="card-body bg-gray-50/30">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">পারিবারিক সদস্যের ধরন <span class="text-danger">*</span></label>
                                <select name="family_type_id" required class="form-control border-gray-200 rounded-lg text-sm">
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach ($familyTypes as $familyType)
                                        <option value="{{$familyType->id}}" {{$user->familyInfo ? ($user->familyInfo->family_type_id == $familyType->id ? 'selected' : '') : ''}}>{{$familyType->bn_name ?? $familyType->en_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">পারিবারিক শ্রেণী <span class="text-danger">*</span></label>
                                <select name="family_category_id" required class="form-control border-gray-200 rounded-lg text-sm">
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach ($familyCategories as $familyCategory)
                                        <option value="{{$familyCategory->id}}" {{$user->familyInfo ? ($user->familyInfo->family_category_id == $familyCategory->id ? 'selected' : '') : ''}}>{{$familyCategory->bn_name ?? $familyCategory->en_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">পিতার নাম (ইংরেজী)</label>
                                <input type="text" name="father_name" value="{{$user->familyInfo->father_name ?? ''}}" class="form-control border-gray-200 rounded-lg text-sm" placeholder="Father's Name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">পিতার নাম (বাংলা)</label>
                                <input type="text" name="father_name_bn" value="{{$user->familyInfo->father_name_bn ?? ''}}" class="form-control border-gray-200 rounded-lg text-sm" placeholder="পিতার নাম">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">পিতার বর্তমান অবস্থা</label>
                                <select name="father_live_status" class="form-control border-gray-200 rounded-lg text-sm">
                                    <option value="1" {{$user->familyInfo ? ($user->familyInfo->father_live_status == 1 ? 'selected' : '') : ''}}>জীবিত (Alive)</option>
                                    <option value="2" {{$user->familyInfo ? ($user->familyInfo->father_live_status == 2 ? 'selected' : '') : ''}}>মৃত (Dead)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">মাতার নাম (ইংরেজী)</label>
                                <input type="text" name="mother_name" value="{{$user->familyInfo->mother_name ?? ''}}" class="form-control border-gray-200 rounded-lg text-sm" placeholder="Mother's Name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">মাতার নাম (বাংলা)</label>
                                <input type="text" name="mother_name_bn" value="{{$user->familyInfo->mother_name_bn ?? ''}}" class="form-control border-gray-200 rounded-lg text-sm" placeholder="মাতার নাম">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">মাতার বর্তমান অবস্থা</label>
                                <select name="mother_live_status" class="form-control border-gray-200 rounded-lg text-sm">
                                    <option value="1" {{$user->familyInfo ? ($user->familyInfo->mother_live_status == 1 ? 'selected' : '') : ''}}>জীবিত (Alive)</option>
                                    <option value="2" {{$user->familyInfo ? ($user->familyInfo->mother_live_status == 2 ? 'selected' : '') : ''}}>মৃত (Dead)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">বৈবাহিক অবস্থা</label>
                                <select name="marital_status" class="form-control border-gray-200 rounded-lg text-sm" id="maritalStatus">
                                    <option value="1" {{$user->familyInfo ? ($user->familyInfo->marital_status == 1 ? 'selected' : '') : ''}}>অবিবাহিত (Unmarried)</option>
                                    <option value="2" {{$user->familyInfo ? ($user->familyInfo->marital_status == 2 ? 'selected' : '') : ''}}>বিবাহিত (Married)</option>
                                    <option value="3" {{$user->familyInfo ? ($user->familyInfo->marital_status == 3 ? 'selected' : '') : ''}}>বিপত্নীক/বিধবা (Widow/Widower)</option>
                                    <option value="4" {{$user->familyInfo ? ($user->familyInfo->marital_status == 4 ? 'selected' : '') : ''}}>তালাকপ্রাপ্ত (Divorced)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="spouseInfo" class="{{$user->familyInfo ? ( ($user->familyInfo->marital_status == 1) ? 'hidden' : '') : 'hidden'}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">স্বামী/স্ত্রীর নাম</label>
                                    <input type="text" name="spouse_name" value="{{$user->familyInfo->spouse_name ?? ''}}" class="form-control border-gray-200 rounded-lg text-sm" placeholder="Spouse Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">স্বামী/স্ত্রীর NID</label>
                                    <input type="text" name="spouse_nid" value="{{$user->familyInfo->spouse_nid ?? ''}}" class="form-control border-gray-200 rounded-lg text-sm" placeholder="Spouse NID">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white py-4 flex justify-between">
                    <a href="{{route('people.applications.registration.create', $user->id)}}" class="btn btn-light px-5 py-2.5 rounded-lg font-bold text-sm border">
                        <i class="fas fa-arrow-left mr-2"></i> পূর্ববর্তী
                    </a>
                    <button type="submit" class="btn btn-success px-6 py-2.5 rounded-lg font-bold text-sm shadow-sm hover:shadow-md transition">
                        সংরক্ষণ ও পরবর্তী <i class="fas fa-arrow-right ml-2"></i>
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
        $('#maritalStatus').on('change', function() {
            if ($(this).val() == 1) {
                $('#spouseInfo').addClass('hidden');
            } else {
                $('#spouseInfo').removeClass('hidden');
            }
        });

        $("#citizenFamilyForm").on('submit', function(e) {
            e.preventDefault();
            let thisForm = $(this);
            $.ajax({
                type: "POST",
                url: "{{ route('people.applications.registration.family.store') }}",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.href = response.redirect_url;
                    }, 2000)
                },
                error: function(xhr) {
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message || "ত্রুটি হয়েছে");
                }
            });
        });
    });
</script>
@endpush
