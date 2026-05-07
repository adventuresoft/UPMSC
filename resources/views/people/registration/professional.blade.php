@extends('backend.master')

@section('title', 'নাগরিক নিবন্ধন - পেশাগত তথ্য')

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
                @include('people.registration.tab_header', ['user' => $user, 'active_tab' => 'professional'])
            </div>
            
            <form id="peopleProfessionalForm" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                
                <div class="card-body bg-gray-50/30">
                    <div id="multiple-professional">
                        @if (count($user->professionalInfos))
                            @foreach ($user->professionalInfos as $info)
                                <div class="single-professional bg-white p-4 rounded-lg shadow-sm border mb-4 relative">
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                        <div class="form-group">
                                            <label class="text-xs font-bold text-gray-600 mb-1 block">পেশা</label>
                                            <select name="professionU[{{$info->id}}]" class="form-control rounded-lg profession-select">
                                                <option value="">নির্বাচন করুন</option>
                                                @foreach ($professions as $p)
                                                    <option value="{{$p->id}}" @if(isset($info->subcategory->category->type->profession_id) && $info->subcategory->category->type->profession_id == $p->id) selected @endif>{{$p->bn_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-xs font-bold text-gray-600 mb-1 block">পেশার ধরণ</label>
                                            <select name="profession_typeU[{{$info->id}}]" class="form-control rounded-lg profession-type">
                                                <option value="{{$info->subcategory->category->type->id ?? ''}}">{{$info->subcategory->category->type->bn_name ?? 'নির্বাচন করুন'}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-xs font-bold text-gray-600 mb-1 block">ক্যাটাগরি</label>
                                            <select name="profession_categoryU[{{$info->id}}]" class="form-control rounded-lg profession-category">
                                                <option value="{{$info->subcategory->category->id ?? ''}}">{{$info->subcategory->category->bn_name ?? 'নির্বাচন করুন'}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-xs font-bold text-gray-600 mb-1 block">সাব-ক্যাটাগরি</label>
                                            <select name="profession_subcategoryU[{{$info->id}}]" required class="form-control rounded-lg profession-subcategory">
                                                <option value="{{$info->subcategory->id ?? ''}}">{{$info->subcategory->bn_name ?? 'নির্বাচন করুন'}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-xs font-bold text-gray-600 mb-1 block">শুরু তারিখ</label>
                                            <input type="date" name="profession_startU[{{$info->id}}]" value="{{$info->profession_start}}" class="form-control rounded-lg">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-xs font-bold text-gray-600 mb-1 block">শেষ তারিখ</label>
                                            <input type="date" name="profession_endU[{{$info->id}}]" value="{{$info->profession_end}}" class="form-control rounded-lg">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-xs font-bold text-gray-600 mb-1 block">প্রতিষ্ঠান</label>
                                            <input type="text" name="organizationU[{{$info->id}}]" value="{{$info->organization}}" class="form-control rounded-lg" placeholder="প্রতিষ্ঠানের নাম">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-xs font-bold text-gray-600 mb-1 block">পদবী</label>
                                            <input type="text" name="designationU[{{$info->id}}]" value="{{$info->designation}}" class="form-control rounded-lg" placeholder="পদবী">
                                        </div>
                                        <div class="form-group md:col-span-4">
                                            <label class="text-xs font-bold text-gray-600 mb-1 block">ঠিকানা</label>
                                            <textarea name="addressU[{{$info->id}}]" class="form-control rounded-lg" rows="2">{{$info->address}}</textarea>
                                        </div>
                                    </div>
                                    <button type="button" class="absolute top-2 right-2 text-red-500 hover:text-red-700 remove-btn" data-id="{{$info->id}}">
                                        <i class="fas fa-times-circle text-xl"></i>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <button type="button" id="addNewProfessional" class="btn btn-outline-primary btn-sm rounded-lg">
                        <i class="fas fa-plus mr-1"></i> পেশাগত তথ্য যোগ করুন
                    </button>
                </div>

                <div class="card-footer bg-white py-4 flex justify-between">
                    <a href="{{route('people.applications.registration.education', $user->id)}}" class="btn btn-light px-5 py-2.5 rounded-lg font-bold text-sm border">
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
    $("#addNewProfessional").on('click', function() {
        let html = `
            <div class="single-professional bg-white p-4 rounded-lg shadow-sm border mb-4 relative">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="form-group">
                        <label class="text-xs font-bold text-gray-600 mb-1 block">পেশা</label>
                        <select name="profession[]" class="form-control rounded-lg profession-select">
                            <option value="">নির্বাচন করুন</option>
                            @foreach ($professions as $p)
                                <option value="{{$p->id}}">{{$p->bn_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-xs font-bold text-gray-600 mb-1 block">পেশার ধরণ</label>
                        <select name="profession_type[]" class="form-control rounded-lg profession-type">
                            <option value="">নির্বাচন করুন</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-xs font-bold text-gray-600 mb-1 block">ক্যাটাগরি</label>
                        <select name="profession_category[]" class="form-control rounded-lg profession-category">
                            <option value="">নির্বাচন করুন</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-xs font-bold text-gray-600 mb-1 block">সাব-ক্যাটাগরি</label>
                        <select name="profession_subcategory[]" required class="form-control rounded-lg profession-subcategory">
                            <option value="">নির্বাচন করুন</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-xs font-bold text-gray-600 mb-1 block">শুরু তারিখ</label>
                        <input type="date" name="profession_start[]" class="form-control rounded-lg">
                    </div>
                    <div class="form-group">
                        <label class="text-xs font-bold text-gray-600 mb-1 block">শেষ তারিখ</label>
                        <input type="date" name="profession_end[]" class="form-control rounded-lg">
                    </div>
                    <div class="form-group">
                        <label class="text-xs font-bold text-gray-600 mb-1 block">প্রতিষ্ঠান</label>
                        <input type="text" name="organization[]" class="form-control rounded-lg" placeholder="প্রতিষ্ঠানের নাম">
                    </div>
                    <div class="form-group">
                        <label class="text-xs font-bold text-gray-600 mb-1 block">পদবী</label>
                        <input type="text" name="designation[]" class="form-control rounded-lg" placeholder="পদবী">
                    </div>
                    <div class="form-group md:col-span-4">
                        <label class="text-xs font-bold text-gray-600 mb-1 block">ঠিকানা</label>
                        <textarea name="address[]" class="form-control rounded-lg" rows="2"></textarea>
                    </div>
                </div>
                <button type="button" class="absolute top-2 right-2 text-red-500 hover:text-red-700 remove-new-btn">
                    <i class="fas fa-times-circle text-xl"></i>
                </button>
            </div>
        `;
        $("#multiple-professional").append(html);
    });

    $(document).on('click', '.remove-new-btn', function() {
        $(this).closest('.single-professional').remove();
    });

    // Dependent Dropdowns
    $(document).on('change', '.profession-select', function() {
        let id = $(this).val();
        let target = $(this).closest('.single-professional').find('.profession-type');
        if(id) {
            $.get("/profession-type-options-by-profession/" + id, function(data) {
                target.html(data);
            });
        }
    });

    $(document).on('change', '.profession-type', function() {
        let id = $(this).val();
        let target = $(this).closest('.single-professional').find('.profession-category');
        if(id) {
            $.get("/profession-category-options-by-profession-type/" + id, function(data) {
                target.html(data);
            });
        }
    });

    $(document).on('change', '.profession-category', function() {
        let id = $(this).val();
        let target = $(this).closest('.single-professional').find('.profession-subcategory');
        if(id) {
            $.get("/profession-subcategory-options-by-profession-category/" + id, function(data) {
                target.html(data);
            });
        }
    });

    $("#peopleProfessionalForm").on('submit', function(e) {
        e.preventDefault();
        let thisForm = $(this);
        $.ajax({
            type: "POST",
            url: "{{ route('people.applications.registration.professionalStore') }}",
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
