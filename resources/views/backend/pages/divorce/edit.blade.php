@extends('backend.master', ['mainMenu' => 'Marriage', 'subMenu' =>'DivorceList'])

@section('title', 'Divorce Edit')

@push('style')
<style>
    /* Premium Official Form Styling */
    .gov-outer-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
        background: #ffffff;
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }
    
    .gov-main-header {
        background: linear-gradient(135deg, #7f1d1d 0%, #b91c1c 100%);
        color: white;
        padding: 15px 25px;
        border-bottom: 4px solid #dc2626;
        position: relative;
    }

    .gov-main-header h3 {
        margin: 0;
        font-weight: 800;
        font-size: 1.1rem;
        letter-spacing: 0.5px;
        font-family: 'Nikosh', 'Arial', sans-serif;
    }

    .gov-main-header p {
        margin: 5px 0 0 0;
        opacity: 0.9;
        font-size: 0.78rem;
    }

    .gov-section {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        margin-bottom: 30px;
        padding: 25px;
        transition: all 0.3s ease;
        position: relative;
    }

    .gov-section:hover {
        box-shadow: 0 8px 24px rgba(185, 28, 28, 0.05);
        border-color: #fca5a5;
    }

    .gov-section-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: #7f1d1d;
        margin-bottom: 20px;
        padding-bottom: 8px;
        border-bottom: 2px solid #fef2f2;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .gov-section-title i {
        color: #dc2626;
        font-size: 1.25rem;
    }

    .gov-label {
        font-weight: 600;
        color: #374151;
        font-size: 0.88rem;
        margin-bottom: 6px;
        display: inline-block;
    }

    .gov-input {
        height: 44px;
        border: 1.5px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.92rem;
        transition: all 0.2s ease;
        color: #1f2937;
        background-color: #f9fafb;
    }

    .gov-input:focus {
        border-color: #dc2626;
        background-color: #ffffff;
        box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.1);
        outline: none;
    }

    textarea.gov-input {
        height: auto;
        padding: 10px 12px;
    }

    /* Photos boxes */
    .gov-photo-wrapper {
        width: 110px;
        height: 130px;
        border: 2px dashed #cbd5e1;
        border-radius: 10px;
        overflow: hidden;
        position: relative;
        background: #f8fafc;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .gov-photo-wrapper:hover {
        border-color: #dc2626;
        background: #fef2f2;
    }

    .gov-photo-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
    }

    .gov-photo-wrapper input[type="file"] {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 10;
    }

    .gov-photo-text {
        font-size: 11px;
        color: #64748b;
        text-align: center;
        pointer-events: none;
        padding: 5px;
    }

    /* Custom check lists */
    .doc-checkbox-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 15px;
        transition: all 0.2s ease;
    }

    .doc-checkbox-card:hover {
        background: #fef2f2;
        border-color: #fca5a5;
    }

    .doc-file-input {
        margin-top: 10px;
    }

    /* Religions specific sub sections */
    .religion-sub-card {
        background: #fcfdfd;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 22px;
        margin-top: 15px;
        display: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.01);
    }

    /* Buttons */
    .btn-gov {
        padding: 12px 28px;
        font-weight: 700;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-gov-success {
        background: #dc2626;
        color: white;
        border: none;
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2);
    }

    .btn-gov-success:hover {
        background: #b91c1c;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(220, 38, 38, 0.3);
        color: white;
    }

    .btn-gov-secondary {
        background: #64748b;
        color: white;
        border: none;
    }

    .btn-gov-secondary:hover {
        background: #475569;
        transform: translateY(-1px);
        color: white;
    }

    /* Search badge info */
    .search-indicator {
        font-size: 0.75rem;
        padding: 3px 8px;
        border-radius: 50px;
        font-weight: 700;
        margin-left: 10px;
    }
</style>
@endpush

@section('content')
<div class="content py-4">
    <div class="container-fluid">
        <div class="card gov-outer-card">
            
            <div class="gov-main-header d-flex justify-content-between align-items-center">
                <div>
                    <h3><i class="fas fa-edit mr-2"></i> বিবাহবিচ্ছেদ নিবন্ধন তথ্য সংশোধন (Divorce Registration Edit Form)</h3>
                    <p>নিবন্ধিত তথ্যাদি আইনানুগ সংশোধন ও হালনাগাদ করার আবেদন ফর্ম</p>
                </div>
                <div class="d-none d-md-block text-right">
                    <span class="badge badge-light p-2 font-weight-bold" style="border: 1px solid #ef4444;"><i class="fas fa-edit text-danger"></i> Edit Mode</span>
                </div>
            </div>

            <form id="divorceRegistrationForm" action="{{ route('divorce.update', $divorce->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body p-4 p-md-5">

                    <!-- SECTION 1: DIVORCE BASIC INFORMATION -->
                    <div class="gov-section">
                        <div class="gov-section-title">
                            <i class="fas fa-info-circle"></i> ১. বিবাহবিচ্ছেদ সংক্রান্ত সাধারণ তথ্য (Divorce Basic Information)
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">নিবন্ধন নম্বর (Registration No) <span class="text-danger">*</span></label>
                                <input type="text" name="registration_no" class="form-control gov-input" required value="{{ $divorce->registration_no }}" placeholder="যেমন: DR-2026-0001">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">বিবাহবিচ্ছেদের ধরণ (Divorce Type) <span class="text-danger">*</span></label>
                                <select name="divorce_type" id="divorceTypeSelect" class="form-control gov-input" required style="padding: 5px 12px;">
                                    <option value="">নির্বাচন করুন</option>
                                    <option value="Islam" {{ $divorce->divorce_type == 'Islam' ? 'selected' : '' }}>ইসলাম (Islam)</option>
                                    <option value="Hindu" {{ $divorce->divorce_type == 'Hindu' ? 'selected' : '' }}>হিন্দু (Hindu)</option>
                                    <option value="Christian" {{ $divorce->divorce_type == 'Christian' ? 'selected' : '' }}>খ্রিস্টান (Christian)</option>
                                    <option value="Other" {{ $divorce->divorce_type == 'Other' ? 'selected' : '' }}>অন্যান্য (Other)</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">বিবাহবিচ্ছেদের তারিখ (Divorce Date) <span class="text-danger">*</span></label>
                                <input type="date" name="divorce_date" class="form-control gov-input" required value="{{ $divorce->divorce_date }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">নিবন্ধনের তারিখ (Registration Date) <span class="text-danger">*</span></label>
                                <input type="date" name="registration_date" class="form-control gov-input" required value="{{ $divorce->registration_date }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">বিবাহবিচ্ছেদের স্থান (Divorce Place) <span class="text-danger">*</span></label>
                                <input type="text" name="divorce_place" class="form-control gov-input" required value="{{ $divorce->divorce_place }}" placeholder="যেমন: বাড্ডা, ঢাকা বা কাজী অফিস">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">এলাকার ধরণ (Divorce Area Type)</label>
                                <select name="divorce_area_type" class="form-control gov-input" style="padding: 5px 12px;">
                                    <option value="Union Parishad" {{ $divorce->divorce_area_type == 'Union Parishad' ? 'selected' : '' }}>ইউনিয়ন পরিষদ (Union Parishad)</option>
                                    <option value="Municipality" {{ $divorce->divorce_area_type == 'Municipality' ? 'selected' : '' }}>পৌরসভা (Municipality)</option>
                                    <option value="City Corporation" {{ $divorce->divorce_area_type == 'City Corporation' ? 'selected' : '' }}>সিটি কর্পোরেশন (City Corporation)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2: DIVORCE ADDRESS INFORMATION -->
                    <div class="gov-section">
                        <div class="gov-section-title">
                            <i class="fas fa-map-marked-alt"></i> ২. বিবাহবিচ্ছেদের স্থান সংক্রান্ত ঠিকানা (Divorce Address Information)
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">বিভাগ (Division)</label>
                                <select id="division_id" name="division_id" class="form-control gov-input select2">
                                    <option value="">বিভাগ নির্বাচন</option>
                                    @foreach($divisions as $division)
                                        <option value="{{ $division->id }}" {{ $divorce->division_id == $division->id ? 'selected' : '' }}>{{ $division->bn_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">জেলা (District)</label>
                                <select id="district_id" name="district_id" class="form-control gov-input select2">
                                    <option value="">জেলা নির্বাচন</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}" {{ $divorce->district_id == $district->id ? 'selected' : '' }}>{{ $district->bn_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">উপজেলা/থানা (Upazila/Thana)</label>
                                <select id="upazila_id" name="upazila_id" class="form-control gov-input select2">
                                    <option value="">উপজেলা নির্বাচন</option>
                                    @foreach($upazilas as $upazila)
                                        <option value="{{ $upazila->id }}" {{ $divorce->upazila_id == $upazila->id ? 'selected' : '' }}>{{ $upazila->bn_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">ইউনিয়ন/পৌরসভা (Union/Municipality)</label>
                                <select id="union_id" name="union_id" class="form-control gov-input select2">
                                    <option value="">ইউনিয়ন নির্বাচন</option>
                                    @foreach($unions as $union)
                                        <option value="{{ $union->id }}" {{ $divorce->union_id == $union->id ? 'selected' : '' }}>{{ $union->bn_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">ওয়ার্ড নং (Ward No)</label>
                                <input type="text" name="ward_no" class="form-control gov-input" value="{{ $divorce->ward_no }}" placeholder="যেমন: ০৩">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">গ্রাম/মহল্লা (Village/Area)</label>
                                <input type="text" name="village_area" class="form-control gov-input" value="{{ $divorce->village_area }}" placeholder="যেমন: পূর্বপাড়া">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">ডাকঘর (Post Office)</label>
                                <input type="text" name="post_office" class="form-control gov-input" value="{{ $divorce->post_office }}" placeholder="যেমন: সদর ডাকঘর">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">পোস্ট কোড (Post Code)</label>
                                <input type="text" name="post_code" class="form-control gov-input" value="{{ $divorce->post_code }}" placeholder="যেমন: ১২৩০">
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: HUSBAND INFORMATION -->
                    <div class="gov-section">
                        <div class="gov-section-title d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-user-tie"></i> ৩. স্বামীর পরিচিতি (Husband Information)</span>
                            <div>
                                <span id="husband_search_status" class="badge badge-secondary search-indicator" style="display: none;"></span>
                            </div>
                        </div>
                        
                        <!-- Auto fill input -->
                        <div class="row align-items-center mb-4 p-3 style-box" style="background: #f8fafc; border-radius: 10px; border: 1.5px solid #e2e8f0; margin: 0 1px 20px 1px;">
                            <div class="col-md-8 mb-2 mb-md-0">
                                <label class="gov-label mb-1 text-primary"><i class="fas fa-search"></i> স্বামীর সিস্টেম/অনুমোদিত আইডি (Husband ID) - অটো-সার্চ</label>
                                <input type="text" id="husband_search_id" class="form-control gov-input font-weight-bold" value="{{ $divorce->husbandUser?->system_id }}" placeholder="স্বামীর আইডি টাইপ করুন, যেমন: 51-830228-0002" style="background-color: #ffffff; border-color: #cbd5e1;">
                                <input type="hidden" name="husband_user_id" id="husband_user_id" value="{{ $divorce->husband_user_id }}">
                            </div>
                            <div class="col-md-4 d-flex justify-content-around align-items-center">
                                <div>
                                    <div class="gov-photo-wrapper">
                                        <div class="gov-photo-text"><i class="fas fa-image mb-1"></i><br>স্বামীর ছবি<br>(Photo)</div>
                                        <input type="file" name="husband_photo_file" id="husband_photo_input" accept="image/*">
                                        <img id="husband_photo_preview" src="{{ $divorce->husband_photo ? asset($divorce->husband_photo) : '' }}" style="{{ $divorce->husband_photo ? 'display: block;' : 'display: none;' }}">
                                    </div>
                                </div>
                                <div>
                                    <div class="gov-photo-wrapper">
                                        <div class="gov-photo-text"><i class="fas fa-pen-fancy mb-1"></i><br>স্বামীর স্বাক্ষর<br>(Signature)</div>
                                        <input type="file" name="husband_signature_file" id="husband_sig_input" accept="image/*">
                                        <img id="husband_sig_preview" src="{{ $divorce->husband_signature ? asset($divorce->husband_signature) : '' }}" style="{{ $divorce->husband_signature ? 'display: block;' : 'display: none;' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Info details row -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">পূর্ণ নাম (Full Name) <span class="text-danger">*</span></label>
                                <input type="text" name="husband_name" id="husband_name" class="form-control gov-input" required value="{{ $divorce->husband_name }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">পিতার নাম (Father Name)</label>
                                <input type="text" name="husband_father_name" id="husband_father_name" class="form-control gov-input" value="{{ $divorce->husband_father_name }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">মাতার নাম (Mother Name)</label>
                                <input type="text" name="husband_mother_name" id="husband_mother_name" class="form-control gov-input" value="{{ $divorce->husband_mother_name }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">জন্ম তারিখ (Date of Birth)</label>
                                <input type="date" name="husband_dob" id="husband_dob" class="form-control gov-input" value="{{ $divorce->husband_dob }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">বয়স (Age)</label>
                                <input type="number" name="husband_age" id="husband_age" class="form-control gov-input" min="21" value="{{ $divorce->husband_age }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="gov-label">এনআইডি/জন্ম সনদ নং (NID/Birth Cert) <span class="text-danger">*</span></label>
                                <input type="text" name="husband_nid" id="husband_nid" class="form-control gov-input" required value="{{ $divorce->husband_nid }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">ধর্ম (Religion)</label>
                                <input type="text" name="husband_religion" id="husband_religion" class="form-control gov-input" value="{{ $divorce->husband_religion }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">পেশা (Occupation)</label>
                                <input type="text" name="husband_occupation" id="husband_occupation" class="form-control gov-input" value="{{ $divorce->husband_occupation }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">মোবাইল নম্বর (Mobile Number)</label>
                                <input type="text" name="husband_mobile" id="husband_mobile" class="form-control gov-input" value="{{ $divorce->husband_mobile }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">বৈবাহিক অবস্থা (Marital Status)</label>
                                <select name="husband_marital_status" id="husband_marital_status" class="form-control gov-input" style="padding: 5px 12px;">
                                    <option value="Married" {{ $divorce->husband_marital_status == 'Married' ? 'selected' : '' }}>বিবাহিত (Married)</option>
                                    <option value="Divorced" {{ $divorce->husband_marital_status == 'Divorced' ? 'selected' : '' }}>তালাকপ্রাপ্ত (Divorced)</option>
                                    <option value="Widower" {{ $divorce->husband_marital_status == 'Widower' ? 'selected' : '' }}>বিপত্নীক (Widower)</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="gov-label">বর্তমান ঠিকানা (Present Address)</label>
                                <textarea name="husband_present_address" id="husband_present_address" class="form-control gov-input" rows="2">{{ $divorce->husband_present_address }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="gov-label">স্থায়ী ঠিকানা (Permanent Address)</label>
                                <textarea name="husband_permanent_address" id="husband_permanent_address" class="form-control gov-input" rows="2">{{ $divorce->husband_permanent_address }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 4: WIFE INFORMATION -->
                    <div class="gov-section">
                        <div class="gov-section-title d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-user-alt text-danger"></i> ৪. স্ত্রীর পরিচিতি (Wife Information)</span>
                            <div>
                                <span id="wife_search_status" class="badge badge-secondary search-indicator" style="display: none;"></span>
                            </div>
                        </div>
                        
                        <!-- Auto fill input -->
                        <div class="row align-items-center mb-4 p-3 style-box" style="background: #fff5f5; border-radius: 10px; border: 1.5px solid #fed7d7; margin: 0 1px 20px 1px;">
                            <div class="col-md-8 mb-2 mb-md-0">
                                <label class="gov-label mb-1 text-danger"><i class="fas fa-search"></i> স্ত্রীর সিস্টেম/অনুমোদিত আইডি (Wife ID) - অটো-সার্চ</label>
                                <input type="text" id="wife_search_id" class="form-control gov-input font-weight-bold" value="{{ $divorce->wifeUser?->system_id }}" placeholder="স্ত্রীর আইডি টাইপ করুন, যেমন: 51-830228-0003" style="background-color: #ffffff; border-color: #feb2b2;">
                                <input type="hidden" name="wife_user_id" id="wife_user_id" value="{{ $divorce->wife_user_id }}">
                            </div>
                            <div class="col-md-4 d-flex justify-content-around align-items-center">
                                <div>
                                    <div class="gov-photo-wrapper">
                                        <div class="gov-photo-text"><i class="fas fa-image mb-1"></i><br>স্ত্রীর ছবি<br>(Photo)</div>
                                        <input type="file" name="wife_photo_file" id="wife_photo_input" accept="image/*">
                                        <img id="wife_photo_preview" src="{{ $divorce->wife_photo ? asset($divorce->wife_photo) : '' }}" style="{{ $divorce->wife_photo ? 'display: block;' : 'display: none;' }}">
                                    </div>
                                </div>
                                <div>
                                    <div class="gov-photo-wrapper">
                                        <div class="gov-photo-text"><i class="fas fa-pen-fancy mb-1"></i><br>স্ত্রীর স্বাক্ষর<br>(Signature)</div>
                                        <input type="file" name="wife_signature_file" id="wife_sig_input" accept="image/*">
                                        <img id="wife_sig_preview" src="{{ $divorce->wife_signature ? asset($divorce->wife_signature) : '' }}" style="{{ $divorce->wife_signature ? 'display: block;' : 'display: none;' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Info details row -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">পূর্ণ নাম (Full Name) <span class="text-danger">*</span></label>
                                <input type="text" name="wife_name" id="wife_name" class="form-control gov-input" required value="{{ $divorce->wife_name }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">পিতার নাম (Father Name)</label>
                                <input type="text" name="wife_father_name" id="wife_father_name" class="form-control gov-input" value="{{ $divorce->wife_father_name }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">মাতার নাম (Mother Name)</label>
                                <input type="text" name="wife_mother_name" id="wife_mother_name" class="form-control gov-input" value="{{ $divorce->wife_mother_name }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">জন্ম তারিখ (Date of Birth)</label>
                                <input type="date" name="wife_dob" id="wife_dob" class="form-control gov-input" value="{{ $divorce->wife_dob }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">বয়স (Age)</label>
                                <input type="number" name="wife_age" id="wife_age" class="form-control gov-input" min="18" value="{{ $divorce->wife_age }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="gov-label">এনআইডি/জন্ম সনদ নং (NID/Birth Cert) <span class="text-danger">*</span></label>
                                <input type="text" name="wife_nid" id="wife_nid" class="form-control gov-input" required value="{{ $divorce->wife_nid }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">ধর্ম (Religion)</label>
                                <input type="text" name="wife_religion" id="wife_religion" class="form-control gov-input" value="{{ $divorce->wife_religion }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">পেশা (Occupation)</label>
                                <input type="text" name="wife_occupation" id="wife_occupation" class="form-control gov-input" value="{{ $divorce->wife_occupation }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">মোবাইল নম্বর (Mobile Number)</label>
                                <input type="text" name="wife_mobile" id="wife_mobile" class="form-control gov-input" value="{{ $divorce->wife_mobile }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">বৈবাহিক অবস্থা (Marital Status)</label>
                                <select name="wife_marital_status" id="wife_marital_status" class="form-control gov-input" style="padding: 5px 12px;">
                                    <option value="Married" {{ $divorce->wife_marital_status == 'Married' ? 'selected' : '' }}>বিবাহিত (Married)</option>
                                    <option value="Divorced" {{ $divorce->wife_marital_status == 'Divorced' ? 'selected' : '' }}>তালাকপ্রাপ্ত (Divorced)</option>
                                    <option value="Widow" {{ $divorce->wife_marital_status == 'Widow' ? 'selected' : '' }}>বিধবা (Widow)</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="gov-label">বর্তমান ঠিকানা (Present Address)</label>
                                <textarea name="wife_present_address" id="wife_present_address" class="form-control gov-input" rows="2">{{ $divorce->wife_present_address }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="gov-label">স্থায়ী ঠিকানা (Permanent Address)</label>
                                <textarea name="wife_permanent_address" id="wife_permanent_address" class="form-control gov-input" rows="2">{{ $divorce->wife_permanent_address }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 5: WITNESS INFORMATION -->
                    <div class="gov-section">
                        <div class="gov-section-title">
                            <i class="fas fa-users"></i> ৫. সাক্ষীদের তথ্য (Witness Information)
                        </div>
                        <div class="row">
                            <!-- Witness 1 -->
                            <div class="col-md-6 border-md-right pr-md-4">
                                <h5 class="font-weight-bold text-danger mb-3"><i class="fas fa-user-check"></i> ১ম সাক্ষী (Witness 1)</h5>
                                
                                <div class="form-group mb-3 p-2" style="background: #f8fafc; border-radius: 8px; border: 1px solid #cbd5e1;">
                                    <label class="gov-label text-primary mb-1"><i class="fas fa-search"></i> ১ম সাক্ষী সিস্টেম/অনুমোদিত আইডি (Witness 1 ID) - অটো-সার্চ</label>
                                    <input type="text" id="witness_1_search_id" class="form-control gov-input" placeholder="আইডি টাইপ করুন..." style="background-color: #ffffff;">
                                    <span id="witness_1_search_status" class="badge badge-secondary search-indicator mt-1" style="display: none; width: fit-content;"></span>
                                </div>

                                <div class="form-group mb-2">
                                    <label class="gov-label">পূর্ণ নাম (Full Name)</label>
                                    <input type="text" name="witness_1_name" id="witness_1_name" class="form-control gov-input" value="{{ $divorce->witness_1_name }}">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="gov-label">এনআইডি নম্বর (NID Number)</label>
                                    <input type="text" name="witness_1_nid" id="witness_1_nid" class="form-control gov-input" value="{{ $divorce->witness_1_nid }}">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="gov-label">মোবাইল নম্বর (Mobile Number)</label>
                                    <input type="text" name="witness_1_mobile" id="witness_1_mobile" class="form-control gov-input" value="{{ $divorce->witness_1_mobile }}">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="gov-label">ঠিকানা (Address)</label>
                                    <input type="text" name="witness_1_address" id="witness_1_address" class="form-control gov-input" value="{{ $divorce->witness_1_address }}">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="gov-label">সাক্ষীর স্বাক্ষর (Signature Upload)</label>
                                    <input type="file" name="witness_1_signature_file" class="form-control gov-input" style="padding: 5px;">
                                    @if($divorce->witness_1_signature)
                                        <div class="mt-2">
                                            <img src="{{ asset($divorce->witness_1_signature) }}" height="50" style="border: 1px solid #ccc; border-radius: 4px; padding: 2px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Witness 2 -->
                            <div class="col-md-6 pl-md-4 mt-4 mt-md-0">
                                <h5 class="font-weight-bold text-danger mb-3"><i class="fas fa-user-check"></i> ২য় সাক্ষী (Witness 2)</h5>
                                
                                <div class="form-group mb-3 p-2" style="background: #f8fafc; border-radius: 8px; border: 1px solid #cbd5e1;">
                                    <label class="gov-label text-primary mb-1"><i class="fas fa-search"></i> ২য় সাক্ষী সিস্টেম/অনুমোদিত আইডি (Witness 2 ID) - অটো-সার্চ</label>
                                    <input type="text" id="witness_2_search_id" class="form-control gov-input" placeholder="আইডি টাইপ করুন..." style="background-color: #ffffff;">
                                    <span id="witness_2_search_status" class="badge badge-secondary search-indicator mt-1" style="display: none; width: fit-content;"></span>
                                </div>

                                <div class="form-group mb-2">
                                    <label class="gov-label">পূর্ণ নাম (Full Name)</label>
                                    <input type="text" name="witness_2_name" id="witness_2_name" class="form-control gov-input" value="{{ $divorce->witness_2_name }}">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="gov-label">এনআইডি নম্বর (NID Number)</label>
                                    <input type="text" name="witness_2_nid" id="witness_2_nid" class="form-control gov-input" value="{{ $divorce->witness_2_nid }}">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="gov-label">মোবাইল নম্বর (Mobile Number)</label>
                                    <input type="text" name="witness_2_mobile" id="witness_2_mobile" class="form-control gov-input" value="{{ $divorce->witness_2_mobile }}">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="gov-label">ঠিকানা (Address)</label>
                                    <input type="text" name="witness_2_address" id="witness_2_address" class="form-control gov-input" value="{{ $divorce->witness_2_address }}">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="gov-label">সাক্ষীর স্বাক্ষর (Signature Upload)</label>
                                    <input type="file" name="witness_2_signature_file" class="form-control gov-input" style="padding: 5px;">
                                    @if($divorce->witness_2_signature)
                                        <div class="mt-2">
                                            <img src="{{ asset($divorce->witness_2_signature) }}" height="50" style="border: 1px solid #ccc; border-radius: 4px; padding: 2px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 6: RELIGION SPECIFIC INFORMATION -->
                    <div class="gov-section">
                        <div class="gov-section-title">
                            <i class="fas fa-star-and-crescent"></i> ৬. ধর্মীয় ও বিবাহবিচ্ছেদ সংক্রান্ত তথ্য (Religion Specific Information)
                        </div>
                        
                        <div class="alert alert-secondary p-3 mb-2" id="select_religion_msg" style="border-left: 5px solid #64748b;">
                            <i class="fas fa-exclamation-circle text-secondary"></i> অনুগ্রহ করে বিবাহবিচ্ছেদের ধরণ (Section 1) নির্বাচন করুন যাতে সংশ্লিষ্ট ধর্মীয় তথ্য পূরণ করা যায়।
                        </div>

                        <!-- Islam specific card -->
                        <div id="religion_Islam" class="religion-sub-card" style="border-top: 4px solid #dc2626; background: #fdfdfd;">
                            <h5 class="text-danger font-weight-bold mb-3"><i class="fas fa-mosque mr-2"></i> ইসলাম ধর্মীয় তালাকনামা বিবরণী (Islamic Divorce Details)</h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">কাবিননামা নম্বর (Kabin Number)</label>
                                    <input type="text" name="islam_kabin_number" class="form-control gov-input" value="{{ $divorce->islam_kabin_number }}" placeholder="যেমন: KB-1002">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">দেনমোহরের পরিমাণ (Den Mohor Amount)</label>
                                    <input type="text" name="islam_den_mohor_amount" class="form-control gov-input" value="{{ $divorce->islam_den_mohor_amount }}" placeholder="যেমন: ৫,০০,০০০">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">দেনমোহরের ধরণ (Den Mohor Type)</label>
                                    <select name="islam_den_mohor_type" class="form-control gov-input" style="padding: 5px 12px;">
                                        <option value="Prompt" {{ $divorce->islam_den_mohor_type == 'Prompt' ? 'selected' : '' }}>নগদ পরিশোধিত (Prompt/Nogod)</option>
                                        <option value="Deferred" {{ $divorce->islam_den_mohor_type == 'Deferred' ? 'selected' : '' }}>বাকি/ধার্যকৃত (Deferred/Baki)</option>
                                        <option value="Both" {{ $divorce->islam_den_mohor_type == 'Both' ? 'selected' : '' }}>উভয়ই (Both)</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">স্ত্রীর উকিল (Wife Wakil Name)</label>
                                    <input type="text" name="islam_wife_wakil_name" class="form-control gov-input" value="{{ $divorce->islam_wife_wakil_name }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">স্বামীর উকিল (Husband Wakil Name)</label>
                                    <input type="text" name="islam_husband_wakil_name" class="form-control gov-input" value="{{ $divorce->islam_husband_wakil_name }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">নিবন্ধনকারী কাজী (Kazi Name)</label>
                                    <input type="text" name="islam_kazi_name" class="form-control gov-input" value="{{ $divorce->islam_kazi_name }}" placeholder="যেমন: আলহাজ্ব কাজী আব্দুর রহমান">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">কাজী লাইসেন্স নম্বর (Kazi License No)</label>
                                    <input type="text" name="islam_kazi_license_no" class="form-control gov-input" value="{{ $divorce->islam_kazi_license_no }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="gov-label">বিবাহবিচ্ছেদের কারণ (Divorce Reason)</label>
                                    <textarea name="islam_divorce_reason" class="form-control gov-input" rows="2" placeholder="বিবাহবিচ্ছেদের সংক্ষিপ্ত কারণ বা রেফারেন্স উল্লেখ করুন">{{ $divorce->islam_divorce_reason }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Hindu specific card -->
                        <div id="religion_Hindu" class="religion-sub-card" style="border-top: 4px solid #ea580c;">
                            <h5 class="text-danger font-weight-bold mb-3"><i class="fas fa-om mr-2"></i> হিন্দু বিবাহবিচ্ছেদ বিবরণী (Hindu Separation Details)</h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">মন্দিরের নাম (Temple Name)</label>
                                    <input type="text" name="hindu_temple_name" class="form-control gov-input" value="{{ $divorce->hindu_temple_name }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">পুরোহিতের নাম (Purohit Name)</label>
                                    <input type="text" name="hindu_purohit_name" class="form-control gov-input" value="{{ $divorce->hindu_purohit_name }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">ধর্মীয় অনুষ্ঠানের তারিখ (Ritual Date)</label>
                                    <input type="date" name="hindu_marriage_ritual_date" class="form-control gov-input" value="{{ $divorce->hindu_marriage_ritual_date }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="gov-label">স্ত্রীর গোত্র (Wife Gotra)</label>
                                    <input type="text" name="hindu_wife_gotra" class="form-control gov-input" value="{{ $divorce->hindu_wife_gotra }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="gov-label">স্বামীর গোত্র (Husband Gotra)</label>
                                    <input type="text" name="hindu_husband_gotra" class="form-control gov-input" value="{{ $divorce->hindu_husband_gotra }}">
                                </div>
                            </div>
                        </div>

                        <!-- Christian specific card -->
                        <div id="religion_Christian" class="religion-sub-card" style="border-top: 4px solid #2563eb;">
                            <h5 class="text-primary font-weight-bold mb-3"><i class="fas fa-cross mr-2"></i> খ্রিস্টান বিবাহবিচ্ছেদ বিবরণী (Christian Separation Details)</h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">গির্জার নাম (Church Name)</label>
                                    <input type="text" name="christian_church_name" class="form-control gov-input" value="{{ $divorce->christian_church_name }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">পাস্টরের নাম (Pastor Name)</label>
                                    <input type="text" name="christian_pastor_name" class="form-control gov-input" value="{{ $divorce->christian_pastor_name }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">লাইসেন্স নম্বর (License No)</label>
                                    <input type="text" name="christian_marriage_license_no" class="form-control gov-input" value="{{ $divorce->christian_marriage_license_no }}">
                                </div>
                            </div>
                        </div>

                        <!-- Other specific card -->
                        <div id="religion_Other" class="religion-sub-card" style="border-top: 4px solid #db2777;">
                            <h5 class="text-pink font-weight-bold mb-3"><i class="fas fa-hands-helping mr-2"></i> অন্যান্য বিবাহবিচ্ছেদ বিবরণী (Other Religion Separation Details)</h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">ধর্মের নাম (Religion Name)</label>
                                    <input type="text" name="other_religion_name" class="form-control gov-input" value="{{ $divorce->other_religion_name }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">ধর্মীয় নেতার নাম (Religious Leader Name)</label>
                                    <input type="text" name="other_religious_leader_name" class="form-control gov-input" value="{{ $divorce->other_religious_leader_name }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">অনুষ্ঠানের ধরণ (Ceremony Type)</label>
                                    <input type="text" name="other_ceremony_type" class="form-control gov-input" value="{{ $divorce->other_ceremony_type }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="gov-label">প্রতিষ্ঠান/উপাসনালয়ের নাম (Organization/Temple Name)</label>
                                    <input type="text" name="other_organization_name" class="form-control gov-input" value="{{ $divorce->other_organization_name }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="gov-label">অন্যান্য বিবরণ (Other Details)</label>
                                    <textarea name="other_other_details" class="form-control gov-input" rows="2">{{ $divorce->other_other_details }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 7: REQUIRED DOCUMENTS -->
                    <div class="gov-section">
                        <div class="gov-section-title">
                            <i class="fas fa-file-upload"></i> ৭. প্রয়োজনীয় প্রমাণপত্র ও আপলোড (Required Documents Upload)
                        </div>
                        <div class="row">
                            <!-- Husband NID -->
                            <div class="col-md-4 mb-3">
                                <div class="doc-checkbox-card">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input doc-checkbox" id="chk_husband_nid" name="uploaded_documents[]" value="Husband NID" data-target="file_husband_nid" {{ $divorce->doc_husband_nid ? 'checked' : '' }}>
                                        <label class="custom-control-label font-weight-bold" for="chk_husband_nid">স্বামীর এনআইডি কপি</label>
                                    </div>
                                    <div id="file_husband_nid" class="doc-file-input" style="{{ $divorce->doc_husband_nid ? 'display: block;' : 'display: none;' }}">
                                        <input type="file" name="doc_husband_nid_file" class="form-control gov-input" style="padding: 5px;">
                                        @if($divorce->doc_husband_nid)
                                            <div class="mt-1"><a href="{{ asset($divorce->doc_husband_nid) }}" target="_blank" class="small text-danger"><i class="fas fa-file"></i> View Current Doc</a></div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Wife NID -->
                            <div class="col-md-4 mb-3">
                                <div class="doc-checkbox-card">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input doc-checkbox" id="chk_wife_nid" name="uploaded_documents[]" value="Wife NID" data-target="file_wife_nid" {{ $divorce->doc_wife_nid ? 'checked' : '' }}>
                                        <label class="custom-control-label font-weight-bold" for="chk_wife_nid">স্ত্রীর এনআইডি কপি</label>
                                    </div>
                                    <div id="file_wife_nid" class="doc-file-input" style="{{ $divorce->doc_wife_nid ? 'display: block;' : 'display: none;' }}">
                                        <input type="file" name="doc_wife_nid_file" class="form-control gov-input" style="padding: 5px;">
                                        @if($divorce->doc_wife_nid)
                                            <div class="mt-1"><a href="{{ asset($divorce->doc_wife_nid) }}" target="_blank" class="small text-danger"><i class="fas fa-file"></i> View Current Doc</a></div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Birth Certificate -->
                            <div class="col-md-4 mb-3">
                                <div class="doc-checkbox-card">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input doc-checkbox" id="chk_birth_certificate" name="uploaded_documents[]" value="Birth Certificate" data-target="file_birth_certificate" {{ $divorce->doc_birth_certificate ? 'checked' : '' }}>
                                        <label class="custom-control-label font-weight-bold" for="chk_birth_certificate">জন্ম নিবন্ধন সনদ কপি</label>
                                    </div>
                                    <div id="file_birth_certificate" class="doc-file-input" style="{{ $divorce->doc_birth_certificate ? 'display: block;' : 'display: none;' }}">
                                        <input type="file" name="doc_birth_certificate_file" class="form-control gov-input" style="padding: 5px;">
                                        @if($divorce->doc_birth_certificate)
                                            <div class="mt-1"><a href="{{ asset($divorce->doc_birth_certificate) }}" target="_blank" class="small text-danger"><i class="fas fa-file"></i> View Current Doc</a></div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Divorce Paper scan -->
                            <div class="col-md-4 mb-3">
                                <div class="doc-checkbox-card">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input doc-checkbox" id="chk_divorce_paper" name="uploaded_documents[]" value="Divorce Paper scan" data-target="file_divorce_paper" {{ $divorce->doc_divorce_paper_scan ? 'checked' : '' }}>
                                        <label class="custom-control-label font-weight-bold" for="chk_divorce_paper">তালাকনামা/আদালত রায় স্ক্যান</label>
                                    </div>
                                    <div id="file_divorce_paper" class="doc-file-input" style="{{ $divorce->doc_divorce_paper_scan ? 'display: block;' : 'display: none;' }}">
                                        <input type="file" name="doc_divorce_paper_scan_file" class="form-control gov-input" style="padding: 5px;">
                                        @if($divorce->doc_divorce_paper_scan)
                                            <div class="mt-1"><a href="{{ asset($divorce->doc_divorce_paper_scan) }}" target="_blank" class="small text-danger"><i class="fas fa-file"></i> View Current Doc</a></div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Other -->
                            <div class="col-md-8 mb-3">
                                <div class="doc-checkbox-card">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input doc-checkbox" id="chk_other" name="uploaded_documents[]" value="Other" data-target="file_other" {{ $divorce->doc_other ? 'checked' : '' }}>
                                        <label class="custom-control-label font-weight-bold" for="chk_other">অন্যান্য প্রমাণপত্র (যদি থাকে)</label>
                                    </div>
                                    <div id="file_other" class="doc-file-input" style="{{ $divorce->doc_other ? 'display: block;' : 'display: none;' }}">
                                        <input type="file" name="doc_other_file" class="form-control gov-input" style="padding: 5px;">
                                        @if($divorce->doc_other)
                                            <div class="mt-1"><a href="{{ asset($divorce->doc_other) }}" target="_blank" class="small text-danger"><i class="fas fa-file"></i> View Current Doc</a></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 8: REGISTRAR / KAZI INFORMATION -->
                    <div class="gov-section">
                        <div class="gov-section-title">
                            <i class="fas fa-stamp"></i> ৮. বিবাহবিচ্ছেদ নিবন্ধনকারী কর্মকর্তা/কাজী (Registrar / Kazi Information)
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">নিবন্ধনকারী কর্মকর্তার নাম (Registrar Name)</label>
                                <input type="text" name="registrar_name" class="form-control gov-input" value="{{ $divorce->registrar_name }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">লাইসেন্স নম্বর (License Number)</label>
                                <input type="text" name="registrar_license" class="form-control gov-input" value="{{ $divorce->registrar_license }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">অফিসিয়াল সিল আপলোড (Upload Seal)</label>
                                <input type="file" name="registrar_office_seal_file" class="form-control gov-input" style="padding: 5px;">
                                @if($divorce->registrar_office_seal)
                                    <div class="mt-2">
                                        <img src="{{ asset($divorce->registrar_office_seal) }}" height="50" style="border: 1px solid #ccc; border-radius: 4px; padding: 2px;">
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="gov-label">অফিসিয়াল ঠিকানা (Office Address)</label>
                                <input type="text" name="registrar_office_address" class="form-control gov-input" value="{{ $divorce->registrar_office_address }}" placeholder="যেমন: বাড্ডা কাজী অফিস, ঢাকা">
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 9: FINAL DECLARATION & SIGNATURES -->
                    <div class="gov-section">
                        <div class="gov-section-title">
                            <i class="fas fa-signature"></i> ৯. চূড়ান্ত ঘোষণা ও স্বাক্ষর (Final Declaration)
                        </div>
                        
                        <div class="alert alert-danger p-3" style="background-color: #fef2f2; border-left: 5px solid #dc2626; color: #7f1d1d;">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="declaration_check" required style="transform: scale(1.2);">
                                <label class="custom-control-label ml-2 font-weight-bold" for="declaration_check">
                                    আমি/আমরা এতদ্বারা ঘোষণা করছি যে, এই বিবাহবিচ্ছেদ ফর্মে প্রদত্ত তথ্যসমূহ সম্পূর্ণ সত্য ও নির্ভুল। যদি কোনো তথ্য অসত্য প্রমাণিত হয়, তবে আমরা প্রচলিত আইন অনুযায়ী দায়ী থাকবো।
                                </label>
                            </div>
                        </div>

                        <!-- Graphic visual signatures box representation -->
                        <div class="row mt-5 text-center">
                            <div class="col-md-4 mb-4">
                                <div style="border-top: 1.5px dashed #475569; width: 80%; margin: 0 auto; padding-top: 8px;">
                                    <span class="font-weight-bold text-secondary">স্বামীর স্বাক্ষর (Husband Signature)</span>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div style="border-top: 1.5px dashed #475569; width: 80%; margin: 0 auto; padding-top: 8px;">
                                    <span class="font-weight-bold text-secondary">স্ত্রীর স্বাক্ষর (Wife Signature)</span>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="mb-2">
                                    <label class="gov-label text-danger">কর্মকর্তা/কাজী স্বাক্ষর আপলোড</label>
                                    <input type="file" name="registrar_signature_file" class="form-control gov-input mx-auto" style="padding: 5px; width: 80%;">
                                    @if($divorce->registrar_signature)
                                        <div class="mt-2">
                                            <img src="{{ asset($divorce->registrar_signature) }}" height="50" style="border: 1px solid #ccc; border-radius: 4px; padding: 2px;">
                                        </div>
                                    @endif
                                </div>
                                <div style="border-top: 1.5px dashed #475569; width: 80%; margin: 0 auto; padding-top: 8px;">
                                    <span class="font-weight-bold text-secondary">নিবন্ধনকারী স্বাক্ষর (Registrar Signature)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ACTIONS BUTTONS -->
                    <div class="action-buttons-wrap text-center mt-4">
                        <a href="{{ route('divorce.index') }}" class="btn btn-gov btn-gov-secondary"><i class="fas fa-arrow-left"></i> তালিকা (Back to List)</a>
                        <button type="submit" class="btn btn-gov btn-gov-success"><i class="fas fa-save"></i> তথ্য হালনাগাদ করুন (Update)</button>
                    </div>

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

        // Show religion sub-card on load
        let initialRel = "{{ $divorce->divorce_type }}";
        if(initialRel) {
            $('#select_religion_msg').hide();
            $('#religion_' + initialRel).show();
        }

        // 1. DYNAMIC ADDRESS LOGIC
        $('#division_id').on('change', function() {
            let divId = $(this).val();
            let distSelect = $('#district_id');
            distSelect.empty().append('<option value="">Select District</option>');
            $('#upazila_id').empty().append('<option value="">Select Upazila</option>');
            $('#union_id').empty().append('<option value="">Select Union</option>');
            
            if(divId) {
                $.ajax({
                    url: "{{ url('/get-districts-by-division') }}/" + divId,
                    type: "GET",
                    success: function(data) {
                        distSelect.empty().append(data);
                    }
                });
            }
        });

        $('#district_id').on('change', function() {
            let distId = $(this).val();
            let thanaSelect = $('#upazila_id');
            thanaSelect.empty().append('<option value="">Select Upazila</option>');
            $('#union_id').empty().append('<option value="">Select Union</option>');
            
            if(distId) {
                $.ajax({
                    url: "{{ url('/get-thanas-by-district') }}/" + distId,
                    type: "GET",
                    success: function(data) {
                        thanaSelect.empty().append(data);
                    }
                });
            }
        });

        $('#upazila_id').on('change', function() {
            let thanaId = $(this).val();
            let unionSelect = $('#union_id');
            unionSelect.empty().append('<option value="">Select Union</option>');
            
            if(thanaId) {
                $.ajax({
                    url: "{{ url('/get-unions-by-thana') }}/" + thanaId,
                    type: "GET",
                    success: function(data) {
                        unionSelect.empty().append(data);
                    }
                });
            }
        });

        // 2. DYNAMIC RELIGION TOGGLE
        $("#divorceTypeSelect").on('change', function() {
            let rel = $(this).val();
            $('.religion-sub-card').hide();
            $('#select_religion_msg').show();
            
            if(rel) {
                $('#select_religion_msg').hide();
                $('#religion_' + rel).fadeIn();
            }
        });

        // 3. DYNAMIC DOCUMENTS SHOW/HIDE ON CHECKBOX
        $('.doc-checkbox').on('change', function() {
            let targetId = $(this).data('target');
            let isChecked = $(this).is(':checked');
            
            if(isChecked) {
                $('#' + targetId).slideDown(200);
            } else {
                $('#' + targetId).slideUp(200).find('input').val('');
            }
        });

        // 4. IMAGE UPLOAD PREVIEW
        function registerPhotoPreview(inputEl, previewEl) {
            $(inputEl).on('change', function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(previewEl).attr('src', e.target.result).show();
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }

        registerPhotoPreview('#husband_photo_input', '#husband_photo_preview');
        registerPhotoPreview('#husband_sig_input', '#husband_sig_preview');
        registerPhotoPreview('#wife_photo_input', '#wife_photo_preview');
        registerPhotoPreview('#wife_sig_input', '#wife_sig_preview');

        // 5. HUSBAND, WIFE & WITNESSES AUTO-FETCH LOGIC
        let husbandTimer;
        let wifeTimer;
        let witness1Timer;
        let witness2Timer;
        const typingDelay = 500;

        // Husband search
        $('#husband_search_id').on('keyup input', function() {
            clearTimeout(husbandTimer);
            let husbandId = $(this).val().trim();
            
            if (husbandId.length > 5) {
                husbandTimer = setTimeout(function() {
                    fetchHusbandDetails(husbandId);
                }, typingDelay);
            }
        });

        // Wife search
        $('#wife_search_id').on('keyup input', function() {
            clearTimeout(wifeTimer);
            let wifeId = $(this).val().trim();
            
            if (wifeId.length > 5) {
                wifeTimer = setTimeout(function() {
                    fetchWifeDetails(wifeId);
                }, typingDelay);
            }
        });

        // Witness 1 search
        $('#witness_1_search_id').on('keyup input', function() {
            clearTimeout(witness1Timer);
            let witnessId = $(this).val().trim();
            
            if (witnessId.length > 5) {
                witness1Timer = setTimeout(function() {
                    fetchWitnessDetails(witnessId, 1);
                }, typingDelay);
            }
        });

        // Witness 2 search
        $('#witness_2_search_id').on('keyup input', function() {
            clearTimeout(witness2Timer);
            let witnessId = $(this).val().trim();
            
            if (witnessId.length > 5) {
                witness2Timer = setTimeout(function() {
                    fetchWitnessDetails(witnessId, 2);
                }, typingDelay);
            }
        });

        function fetchHusbandDetails(systemId) {
            $('#husband_search_status').removeClass('badge-secondary badge-danger badge-success').addClass('badge-info').text('Searching...').show();
            $.ajax({
                type: "GET",
                url: "{{ url('/search-user-by-system-id') }}/" + systemId,
                success: function(response) {
                    if (response.status && response.user) {
                        let user = response.user;
                        $('#husband_search_status').removeClass('badge-info').addClass('badge-success').text('Husband Found!');
                        
                        // Populate
                        $('#husband_user_id').val(user.id);
                        $('#husband_name').val(user.people ? (user.people.bn_name ?? user.name) : user.name);
                        
                        let family = user.family_info || user.familyInfo;
                        $('#husband_father_name').val(family ? (family.father_name_bn || family.father_name || '') : '');
                        $('#husband_mother_name').val(family ? (family.mother_name_bn || family.mother_name || '') : '');
                        
                        let dob = user.people ? (user.people.date_of_birth || user.people.dob || '') : '';
                        $('#husband_dob').val(dob);
                        $('#husband_age').val(calculateAge(dob));
                        
                        $('#husband_nid').val(user.nid ?? user.birth_certificate ?? '');
                        $('#husband_religion').val(user.people ? user.people.religion : '');
                        $('#husband_occupation').val(getOccupation(user));
                        $('#husband_mobile').val(user.mobile ?? '');

                        // Construct addresses
                        $('#husband_present_address').val(getFormattedAddress(user, 'present'));
                        $('#husband_permanent_address').val(getFormattedAddress(user, 'permanent'));

                        if(user.image) {
                            $('#husband_photo_preview').attr('src', "{{ asset('') }}" + user.image).show();
                        }
                        
                        toastr.success("Husband data loaded successfully!");
                    } else {
                        $('#husband_search_status').removeClass('badge-info').addClass('badge-danger').text('Not Found');
                        toastr.error("Husband not found.");
                    }
                },
                error: function() {
                    $('#husband_search_status').removeClass('badge-info').addClass('badge-danger').text('Error');
                    toastr.error("Error fetching Husband data.");
                }
            });
        }

        function fetchWifeDetails(systemId) {
            $('#wife_search_status').removeClass('badge-secondary badge-danger badge-success').addClass('badge-info').text('Searching...').show();
            $.ajax({
                type: "GET",
                url: "{{ url('/search-user-by-system-id') }}/" + systemId,
                success: function(response) {
                    if (response.status && response.user) {
                        let user = response.user;
                        $('#wife_search_status').removeClass('badge-info').addClass('badge-success').text('Wife Found!');
                        
                        // Populate
                        $('#wife_user_id').val(user.id);
                        $('#wife_name').val(user.people ? (user.people.bn_name ?? user.name) : user.name);
                        
                        let family = user.family_info || user.familyInfo;
                        $('#wife_father_name').val(family ? (family.father_name_bn || family.father_name || '') : '');
                        $('#wife_mother_name').val(family ? (family.mother_name_bn || family.mother_name || '') : '');
                        
                        let dob = user.people ? (user.people.date_of_birth || user.people.dob || '') : '';
                        $('#wife_dob').val(dob);
                        $('#wife_age').val(calculateAge(dob));
                        
                        $('#wife_nid').val(user.nid ?? user.birth_certificate ?? '');
                        $('#wife_religion').val(user.people ? user.people.religion : '');
                        $('#wife_occupation').val(getOccupation(user));
                        $('#wife_mobile').val(user.mobile ?? '');

                        // Construct addresses
                        $('#wife_present_address').val(getFormattedAddress(user, 'present'));
                        $('#wife_permanent_address').val(getFormattedAddress(user, 'permanent'));

                        if(user.image) {
                            $('#wife_photo_preview').attr('src', "{{ asset('') }}" + user.image).show();
                        }
                        
                        toastr.success("Wife data loaded successfully!");
                    } else {
                        $('#wife_search_status').removeClass('badge-info').addClass('badge-danger').text('Not Found');
                        toastr.error("Wife not found.");
                    }
                },
                error: function() {
                    $('#wife_search_status').removeClass('badge-info').addClass('badge-danger').text('Error');
                    toastr.error("Error fetching Wife data.");
                }
            });
        }

        function calculateAge(dob) {
            if(!dob) return '';
            let birthDate = new Date(dob);
            let today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            let m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        }

        function getFormattedAddress(user, type = 'present') {
            let ai = user.address_info || user.addressInfo;
            if (!ai) return '';
            
            let house = type === 'present' 
                ? (ai.present_house || ai.presentHouse) 
                : (ai.permanent_house || ai.permanentHouse);
            let road = type === 'present' 
                ? (ai.present_road || ai.presentRoad) 
                : (ai.permanent_road || ai.permanentRoad);
            let ward = type === 'present' 
                ? (ai.present_ward || ai.presentWard) 
                : (ai.permanent_ward || ai.permanentWard);
            let village = type === 'present' 
                ? (ai.present_village || ai.presentVillage) 
                : (ai.permanent_village || ai.permanentVillage);
            let thana = type === 'present' 
                ? (ai.present_thana || ai.presentThana) 
                : (ai.permanent_thana || ai.permanentThana);
            let district = type === 'present' 
                ? (ai.present_district || ai.presentDistrict) 
                : (ai.permanent_district || ai.permanentDistrict);

            return [
                house ? (house.bn_name || house.name || '') : '',
                road ? (road.bn_name || road.name || '') : '',
                ward ? (ward.bn_name || ward.name || '') : '',
                village ? (village.bn_name || village.name || '') : '',
                thana ? (thana.bn_name || thana.name || '') : '',
                district ? (district.bn_name || district.name || '') : ''
            ].filter(Boolean).join(', ');
        }

        function getOccupation(user) {
            let infos = user.professional_infos || user.professionalInfos;
            if (!infos || !infos.length) return '';
            
            let occupations = infos.map(function(info) {
                let sub = info.subcategory;
                let cat = sub ? sub.category : null;
                let type = cat ? cat.type : null;
                let prof = type ? type.profession : null;
                
                let profName = prof ? (prof.bn_name || prof.en_name || '') : '';
                let designation = info.designation || '';
                
                return [profName, designation].filter(Boolean).join(' - ');
            });
            
            return occupations.filter(Boolean).join(', ');
        }

        function fetchWitnessDetails(systemId, witnessNum) {
            let statusBadge = $('#witness_' + witnessNum + '_search_status');
            statusBadge.removeClass('badge-secondary badge-danger badge-success').addClass('badge-info').text('Searching...').show();
            $.ajax({
                type: "GET",
                url: "{{ url('/search-user-by-system-id') }}/" + systemId,
                success: function(response) {
                    if (response.status && response.user) {
                        let user = response.user;
                        statusBadge.removeClass('badge-info').addClass('badge-success').text('Witness Found!');
                        
                        // Populate
                        $('#witness_' + witnessNum + '_name').val(user.people ? (user.people.bn_name ?? user.name) : user.name);
                        $('#witness_' + witnessNum + '_nid').val(user.nid ?? user.birth_certificate ?? '');
                        $('#witness_' + witnessNum + '_mobile').val(user.mobile ?? '');

                        // Construct addresses
                        $('#witness_' + witnessNum + '_address').val(getFormattedAddress(user, 'present'));
                        
                        toastr.success("Witness " + witnessNum + " data loaded successfully!");
                    } else {
                        statusBadge.removeClass('badge-info').addClass('badge-danger').text('Not Found');
                        toastr.error("Witness not found.");
                    }
                },
                error: function() {
                    statusBadge.removeClass('badge-info').addClass('badge-danger').text('Error');
                    toastr.error("Error fetching Witness data.");
                }
            });
        }

        // 6. FORM AJAX SUBMIT
        $("#divorceRegistrationForm").on('submit', function(e) {
            e.preventDefault();
            
            let thisForm = $(this);
            let submitBtn = thisForm.find('button[type="submit"]');
            
            $.ajax({
                type: "POST",
                url: thisForm.attr('action'),
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    submitBtn.prop("disabled", true).html('<i class="fas fa-spinner fa-spin"></i> সংরক্ষণ হচ্ছে...');
                },
                success: function (response) {
                    submitBtn.prop("disabled", false).html('<i class="fas fa-save"></i> তথ্য হালনাগাদ করুন (Update)');
                    if(response.status === 'success') {
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.href = response.redirect_url;
                        }, 2000)
                    } else {
                        toastr.error("ত্রুটি ঘটেছে!");
                    }
                },
                error: function(xhr, status, error) {
                    submitBtn.prop("disabled", false).html('<i class="fas fa-save"></i> তথ্য হালনাগাদ করুন (Update)');
                    if(xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, val) {
                            toastr.error(val[0]);
                        });
                    } else {
                        toastr.error("সার্ভার ত্রুটি ঘটেছে, দয়া করে আবার চেষ্টা করুন।");
                    }
                }
            });
        });
    });
</script>
@endpush
