@extends('backend.master', ['mainMenu' => 'Marriage', 'subMenu' =>'MarriageCreate'])

@section('title', 'Marriage Create')

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
        background: linear-gradient(135deg, #14532d 0%, #15803d 100%);
        color: white;
        padding: 15px 25px;
        border-bottom: 4px solid #16a34a;
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
        box-shadow: 0 8px 24px rgba(21, 128, 61, 0.05);
        border-color: #bbf7d0;
    }

    .gov-section-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: #14532d;
        margin-bottom: 20px;
        padding-bottom: 8px;
        border-bottom: 2px solid #f0fdf4;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .gov-section-title i {
        color: #16a34a;
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
        border-color: #16a34a;
        background-color: #ffffff;
        box-shadow: 0 0 0 4px rgba(22, 163, 74, 0.1);
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
        border-color: #16a34a;
        background: #f0fdf4;
    }

    .gov-photo-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
        display: none;
    }

    .gov-photo-wrapper input[type="file"] {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
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
        background: #f0fdf4;
        border-color: #bbf7d0;
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
        background: #16a34a;
        color: white;
        border: none;
        box-shadow: 0 4px 12px rgba(22, 163, 74, 0.2);
    }

    .btn-gov-success:hover {
        background: #15803d;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(22, 163, 74, 0.3);
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

    .btn-gov-info {
        background: #0ea5e9;
        color: white;
        border: none;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.2);
    }

    .btn-gov-info:hover {
        background: #0284c7;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(14, 165, 233, 0.3);
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

    /* Print styles */
    @media print {
        body {
            background: white !important;
            color: black !important;
        }
        .main-header, .main-sidebar, .content-header, .main-footer, .action-buttons-wrap {
            display: none !important;
        }
        .content-wrapper {
            margin-left: 0 !important;
            padding: 0 !important;
            background: white !important;
        }
        .gov-outer-card {
            border: none;
            box-shadow: none;
        }
        .gov-section {
            border: 1px solid #94a3b8 !important;
            margin-bottom: 20px !important;
            page-break-inside: avoid;
        }
        .gov-main-header {
            background: none !important;
            color: black !important;
            border-bottom: 3px double #14532d !important;
            padding: 10px 0 !important;
            text-align: center;
        }
        .gov-main-header h3, .gov-main-header p {
            color: black !important;
        }
        .gov-input {
            border: 1px solid #475569 !important;
            background: none !important;
        }
    }
</style>
@endpush

@section('content')
<div class="content py-4">
    <div class="container-fluid">
        <div class="card gov-outer-card">
            
            <div class="gov-main-header d-flex justify-content-between align-items-center">
                <div>
                    <h3><i class="fas fa-file-contract mr-2"></i> বিবাহ নিবন্ধন ফর্ম (Marriage Registration Form)</h3>
                    <p>গণপ্রজাতন্ত্রী বাংলাদেশ সরকারের বিবাহ আইন ও বিধিমালা অনুযায়ী আইনানুগ নিবন্ধন ফরম</p>
                </div>
                <div class="d-none d-md-block text-right">
                    <span class="badge badge-light p-2 font-weight-bold" style="border: 1px solid #22c55e;"><i class="fas fa-gavel text-success"></i> Official Legal Doc</span>
                </div>
            </div>

            <form id="marriageRegistrationForm" action="{{ route('marriage.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body p-4 p-md-5">

                    <!-- SECTION 1: MARRIAGE BASIC INFORMATION -->
                    <div class="gov-section">
                        <div class="gov-section-title">
                            <i class="fas fa-info-circle"></i> ১. বিবাহ সংক্রান্ত সাধারণ তথ্য (Marriage Basic Information)
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">নিবন্ধন নম্বর (Registration No) <span class="text-danger">*</span></label>
                                <input type="text" name="registration_no" class="form-control gov-input" required placeholder="যেমন: MR-2026-0001">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">বিবাহের ধরণ (Marriage Type) <span class="text-danger">*</span></label>
                                <select name="marriage_type" id="marriageTypeSelect" class="form-control gov-input" required style="padding: 5px 12px;">
                                    <option value="">নির্বাচন করুন</option>
                                    <option value="Islam">ইসলাম (Islam)</option>
                                    <option value="Hindu">হিন্দু (Hindu)</option>
                                    <option value="Christian">খ্রিস্টান (Christian)</option>
                                    <option value="Other">অন্যান্য (Other)</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">বিবাহের তারিখ (Marriage Date) <span class="text-danger">*</span></label>
                                <input type="date" name="marriage_date" class="form-control gov-input" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">নিবন্ধনের তারিখ (Registration Date) <span class="text-danger">*</span></label>
                                <input type="date" name="registration_date" class="form-control gov-input" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">বিবাহের স্থান (Marriage Place) <span class="text-danger">*</span></label>
                                <input type="text" name="marriage_place" class="form-control gov-input" required placeholder="যেমন: কমিউনিটি সেন্টার বা কনের বাড়ি">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">এলাকার ধরণ (Marriage Area Type)</label>
                                <select name="marriage_area_type" class="form-control gov-input" style="padding: 5px 12px;">
                                    <option value="Union Parishad">ইউনিয়ন পরিষদ (Union Parishad)</option>
                                    <option value="Municipality">পৌরসভা (Municipality)</option>
                                    <option value="City Corporation">সিটি কর্পোরেশন (City Corporation)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2: MARRIAGE ADDRESS INFORMATION -->
                    <div class="gov-section">
                        <div class="gov-section-title">
                            <i class="fas fa-map-marked-alt"></i> ২. বিবাহের স্থান সংক্রান্ত ঠিকানা (Marriage Address Information)
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">বিভাগ (Division)</label>
                                <select id="division_id" name="division_id" class="form-control gov-input select2">
                                    <option value="">বিভাগ নির্বাচন</option>
                                    @foreach($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->bn_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">জেলা (District)</label>
                                <select id="district_id" name="district_id" class="form-control gov-input select2">
                                    <option value="">জেলা নির্বাচন</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">উপজেলা/থানা (Upazila/Thana)</label>
                                <select id="upazila_id" name="upazila_id" class="form-control gov-input select2">
                                    <option value="">উপজেলা নির্বাচন</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">ইউনিয়ন/পৌরসভা (Union/Municipality)</label>
                                <select id="union_id" name="union_id" class="form-control gov-input select2">
                                    <option value="">ইউনিয়ন নির্বাচন</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">ওয়ার্ড নং (Ward No)</label>
                                <input type="text" name="ward_no" class="form-control gov-input" placeholder="যেমন: ০৩">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">গ্রাম/মহল্লা (Village/Area)</label>
                                <input type="text" name="village_area" class="form-control gov-input" placeholder="যেমন: পূর্বপাড়া">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">ডাকঘর (Post Office)</label>
                                <input type="text" name="post_office" class="form-control gov-input" placeholder="যেমন: সদর ডাকঘর">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">পোস্ট কোড (Post Code)</label>
                                <input type="text" name="post_code" class="form-control gov-input" placeholder="যেমন: ১২৩০">
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: GROOM INFORMATION -->
                    <div class="gov-section">
                        <div class="gov-section-title d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-user-tie"></i> ৩. বরের পরিচিতি (Groom Information)</span>
                            <div>
                                <span id="groom_search_status" class="badge badge-secondary search-indicator" style="display: none;"></span>
                            </div>
                        </div>
                        
                        <!-- Auto fill input -->
                        <div class="row align-items-center mb-4 p-3 style-box" style="background: #f8fafc; border-radius: 10px; border: 1.5px solid #e2e8f0; margin: 0 1px 20px 1px;">
                            <div class="col-md-8 mb-2 mb-md-0">
                                <label class="gov-label mb-1 text-primary"><i class="fas fa-search"></i> বরের সিস্টেম/অনুমোদিত আইডি (Groom ID) - অটো-সার্চ</label>
                                <input type="text" id="groom_search_id" class="form-control gov-input font-weight-bold" placeholder="বরের আইডি টাইপ করুন, যেমন: 51-830228-0002" style="background-color: #ffffff; border-color: #cbd5e1;">
                                <input type="hidden" name="groom_user_id" id="groom_user_id">
                            </div>
                            <div class="col-md-4 d-flex justify-content-around align-items-center">
                                <div>
                                    <div class="gov-photo-wrapper">
                                        <div class="gov-photo-text"><i class="fas fa-image mb-1"></i><br>বরের ছবি<br>(Photo)</div>
                                        <input type="file" name="groom_photo_file" id="groom_photo_input" accept="image/*">
                                        <img id="groom_photo_preview">
                                    </div>
                                </div>
                                <div>
                                    <div class="gov-photo-wrapper">
                                        <div class="gov-photo-text"><i class="fas fa-pen-fancy mb-1"></i><br>বরের স্বাক্ষর<br>(Signature)</div>
                                        <input type="file" name="groom_signature_file" id="groom_sig_input" accept="image/*">
                                        <img id="groom_sig_preview">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Info details row -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">পূর্ণ নাম (Full Name) <span class="text-danger">*</span></label>
                                <input type="text" name="groom_name" id="groom_name" class="form-control gov-input" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">পিতার নাম (Father Name)</label>
                                <input type="text" name="groom_father_name" id="groom_father_name" class="form-control gov-input">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">মাতার নাম (Mother Name)</label>
                                <input type="text" name="groom_mother_name" id="groom_mother_name" class="form-control gov-input">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">জন্ম তারিখ (Date of Birth)</label>
                                <input type="date" name="groom_dob" id="groom_dob" class="form-control gov-input">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">বয়স (Age)</label>
                                <input type="number" name="groom_age" id="groom_age" class="form-control gov-input" min="21">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="gov-label">এনআইডি/জন্ম সনদ নং (NID/Birth Cert) <span class="text-danger">*</span></label>
                                <input type="text" name="groom_nid" id="groom_nid" class="form-control gov-input" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">ধর্ম (Religion)</label>
                                <input type="text" name="groom_religion" id="groom_religion" class="form-control gov-input">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">পেশা (Occupation)</label>
                                <input type="text" name="groom_occupation" id="groom_occupation" class="form-control gov-input">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">মোবাইল নম্বর (Mobile Number)</label>
                                <input type="text" name="groom_mobile" id="groom_mobile" class="form-control gov-input">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">বৈবাহিক অবস্থা (Marital Status)</label>
                                <select name="groom_marital_status" id="groom_marital_status" class="form-control gov-input" style="padding: 5px 12px;">
                                    <option value="Unmarried">অবিবাহিত (Unmarried)</option>
                                    <option value="Married">বিবাহিত (Married)</option>
                                    <option value="Divorced">তালাকপ্রাপ্ত (Divorced)</option>
                                    <option value="Widower">বিপত্নীক (Widower)</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="gov-label">বর্তমান ঠিকানা (Present Address)</label>
                                <textarea name="groom_present_address" id="groom_present_address" class="form-control gov-input" rows="2"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="gov-label">স্থায়ী ঠিকানা (Permanent Address)</label>
                                <textarea name="groom_permanent_address" id="groom_permanent_address" class="form-control gov-input" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 4: BRIDE INFORMATION -->
                    <div class="gov-section">
                        <div class="gov-section-title d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-user-alt text-danger"></i> ৪. কনের পরিচিতি (Bride Information)</span>
                            <div>
                                <span id="bride_search_status" class="badge badge-secondary search-indicator" style="display: none;"></span>
                            </div>
                        </div>
                        
                        <!-- Auto fill input -->
                        <div class="row align-items-center mb-4 p-3 style-box" style="background: #fff5f5; border-radius: 10px; border: 1.5px solid #fed7d7; margin: 0 1px 20px 1px;">
                            <div class="col-md-8 mb-2 mb-md-0">
                                <label class="gov-label mb-1 text-danger"><i class="fas fa-search"></i> কনের সিস্টেম/অনুমোদিত আইডি (Bride ID) - অটো-সার্চ</label>
                                <input type="text" id="bride_search_id" class="form-control gov-input font-weight-bold" placeholder="কনের আইডি টাইপ করুন, যেমন: 51-830228-0003" style="background-color: #ffffff; border-color: #feb2b2;">
                                <input type="hidden" name="bride_user_id" id="bride_user_id">
                            </div>
                            <div class="col-md-4 d-flex justify-content-around align-items-center">
                                <div>
                                    <div class="gov-photo-wrapper">
                                        <div class="gov-photo-text"><i class="fas fa-image mb-1"></i><br>কনের ছবি<br>(Photo)</div>
                                        <input type="file" name="bride_photo_file" id="bride_photo_input" accept="image/*">
                                        <img id="bride_photo_preview">
                                    </div>
                                </div>
                                <div>
                                    <div class="gov-photo-wrapper">
                                        <div class="gov-photo-text"><i class="fas fa-pen-fancy mb-1"></i><br>কনের স্বাক্ষর<br>(Signature)</div>
                                        <input type="file" name="bride_signature_file" id="bride_sig_input" accept="image/*">
                                        <img id="bride_sig_preview">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Info details row -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">পূর্ণ নাম (Full Name) <span class="text-danger">*</span></label>
                                <input type="text" name="bride_name" id="bride_name" class="form-control gov-input" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">পিতার নাম (Father Name)</label>
                                <input type="text" name="bride_father_name" id="bride_father_name" class="form-control gov-input">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">মাতার নাম (Mother Name)</label>
                                <input type="text" name="bride_mother_name" id="bride_mother_name" class="form-control gov-input">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">জন্ম তারিখ (Date of Birth)</label>
                                <input type="date" name="bride_dob" id="bride_dob" class="form-control gov-input">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">বয়স (Age)</label>
                                <input type="number" name="bride_age" id="bride_age" class="form-control gov-input" min="18">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="gov-label">এনআইডি/জন্ম সনদ নং (NID/Birth Cert) <span class="text-danger">*</span></label>
                                <input type="text" name="bride_nid" id="bride_nid" class="form-control gov-input" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">ধর্ম (Religion)</label>
                                <input type="text" name="bride_religion" id="bride_religion" class="form-control gov-input">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">পেশা (Occupation)</label>
                                <input type="text" name="bride_occupation" id="bride_occupation" class="form-control gov-input">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">মোবাইল নম্বর (Mobile Number)</label>
                                <input type="text" name="bride_mobile" id="bride_mobile" class="form-control gov-input">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="gov-label">বৈবাহিক অবস্থা (Marital Status)</label>
                                <select name="bride_marital_status" id="bride_marital_status" class="form-control gov-input" style="padding: 5px 12px;">
                                    <option value="Unmarried">অবিবাহিত (Unmarried)</option>
                                    <option value="Divorced">তালাকপ্রাপ্ত (Divorced)</option>
                                    <option value="Widow">বিধবা (Widow)</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="gov-label">বর্তমান ঠিকানা (Present Address)</label>
                                <textarea name="bride_present_address" id="bride_present_address" class="form-control gov-input" rows="2"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="gov-label">স্থায়ী ঠিকানা (Permanent Address)</label>
                                <textarea name="bride_permanent_address" id="bride_permanent_address" class="form-control gov-input" rows="2"></textarea>
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
                                <h5 class="font-weight-bold text-success mb-3"><i class="fas fa-user-check"></i> ১ম সাক্ষী (Witness 1)</h5>
                                
                                <div class="form-group mb-3 p-2" style="background: #f8fafc; border-radius: 8px; border: 1px solid #cbd5e1;">
                                    <label class="gov-label text-primary mb-1"><i class="fas fa-search"></i> ১ম সাক্ষী সিস্টেম/অনুমোদিত আইডি (Witness 1 ID) - অটো-সার্চ</label>
                                    <input type="text" id="witness_1_search_id" class="form-control gov-input" placeholder="আইডি টাইপ করুন..." style="background-color: #ffffff;">
                                    <span id="witness_1_search_status" class="badge badge-secondary search-indicator mt-1" style="display: none; width: fit-content;"></span>
                                </div>

                                <div class="form-group mb-2">
                                    <label class="gov-label">পূর্ণ নাম (Full Name)</label>
                                    <input type="text" name="witness_1_name" id="witness_1_name" class="form-control gov-input">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="gov-label">এনআইডি নম্বর (NID Number)</label>
                                    <input type="text" name="witness_1_nid" id="witness_1_nid" class="form-control gov-input">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="gov-label">মোবাইল নম্বর (Mobile Number)</label>
                                    <input type="text" name="witness_1_mobile" id="witness_1_mobile" class="form-control gov-input">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="gov-label">ঠিকানা (Address)</label>
                                    <input type="text" name="witness_1_address" id="witness_1_address" class="form-control gov-input">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="gov-label">সাক্ষীর স্বাক্ষর (Signature Upload)</label>
                                    <input type="file" name="witness_1_signature_file" class="form-control gov-input" style="padding: 5px;">
                                </div>
                            </div>
                            
                            <!-- Witness 2 -->
                            <div class="col-md-6 pl-md-4 mt-4 mt-md-0">
                                <h5 class="font-weight-bold text-success mb-3"><i class="fas fa-user-check"></i> ২য় সাক্ষী (Witness 2)</h5>
                                
                                <div class="form-group mb-3 p-2" style="background: #f8fafc; border-radius: 8px; border: 1px solid #cbd5e1;">
                                    <label class="gov-label text-primary mb-1"><i class="fas fa-search"></i> ২য় সাক্ষী সিস্টেম/অনুমোদিত আইডি (Witness 2 ID) - অটো-সার্চ</label>
                                    <input type="text" id="witness_2_search_id" class="form-control gov-input" placeholder="আইডি টাইপ করুন..." style="background-color: #ffffff;">
                                    <span id="witness_2_search_status" class="badge badge-secondary search-indicator mt-1" style="display: none; width: fit-content;"></span>
                                </div>

                                <div class="form-group mb-2">
                                    <label class="gov-label">পূর্ণ নাম (Full Name)</label>
                                    <input type="text" name="witness_2_name" id="witness_2_name" class="form-control gov-input">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="gov-label">এনআইডি নম্বর (NID Number)</label>
                                    <input type="text" name="witness_2_nid" id="witness_2_nid" class="form-control gov-input">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="gov-label">মোবাইল নম্বর (Mobile Number)</label>
                                    <input type="text" name="witness_2_mobile" id="witness_2_mobile" class="form-control gov-input">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="gov-label">ঠিকানা (Address)</label>
                                    <input type="text" name="witness_2_address" id="witness_2_address" class="form-control gov-input">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="gov-label">সাক্ষীর স্বাক্ষর (Signature Upload)</label>
                                    <input type="file" name="witness_2_signature_file" class="form-control gov-input" style="padding: 5px;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 6: RELIGION SPECIFIC INFORMATION -->
                    <div class="gov-section">
                        <div class="gov-section-title">
                            <i class="fas fa-star-and-crescent"></i> ৬. ধর্মীয় ও কাবিননামা সংক্রান্ত তথ্য (Religion Specific Information)
                        </div>
                        
                        <div class="alert alert-secondary p-3 mb-2" id="select_religion_msg" style="border-left: 5px solid #64748b;">
                            <i class="fas fa-exclamation-circle text-secondary"></i> অনুগ্রহ করে বিবাহের ধরণ (Section 1) নির্বাচন করুন যাতে সংশ্লিষ্ট ধর্মীয় তথ্য পূরণ করা যায়।
                        </div>

                        <!-- Islam specific card -->
                        <div id="religion_Islam" class="religion-sub-card" style="border-top: 4px solid #16a34a; background: #fdfdfd;">
                            <h5 class="text-success font-weight-bold mb-3"><i class="fas fa-mosque mr-2"></i> ইসলাম ধর্মীয় বিবরণী (Islamic Marriage Details)</h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">কাবিননামা নম্বর (Kabin Number)</label>
                                    <input type="text" name="islam_kabin_number" class="form-control gov-input" placeholder="যেমন: KB-1002">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">দেনমোহরের পরিমাণ (Den Mohor Amount)</label>
                                    <input type="text" name="islam_den_mohor_amount" class="form-control gov-input" placeholder="যেমন: ৫,০০,০০০">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">দেনমোহরের ধরণ (Den Mohor Type)</label>
                                    <select name="islam_den_mohor_type" class="form-control gov-input" style="padding: 5px 12px;">
                                        <option value="Prompt">নগদ পরিশোধিত (Prompt/Nogod)</option>
                                        <option value="Deferred">বাকি/ধার্যকৃত (Deferred/Baki)</option>
                                        <option value="Both">উভয়ই (Both)</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">কনের উকিল (Bride Wakil Name)</label>
                                    <input type="text" name="islam_bride_wakil_name" class="form-control gov-input">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">বরের উকিল (Groom Wakil Name)</label>
                                    <input type="text" name="islam_groom_wakil_name" class="form-control gov-input">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">নিবন্ধনকারী কাজী (Kazi Name)</label>
                                    <input type="text" name="islam_kazi_name" class="form-control gov-input" placeholder="যেমন: আলহাজ্ব কাজী আব্দুর রহমান">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">কাজী লাইসেন্স নম্বর (Kazi License No)</label>
                                    <input type="text" name="islam_kazi_license_no" class="form-control gov-input">
                                </div>
                            </div>
                        </div>

                        <!-- Hindu specific card -->
                        <div id="religion_Hindu" class="religion-sub-card" style="border-top: 4px solid #ea580c;">
                            <h5 class="text-danger font-weight-bold mb-3"><i class="fas fa-om mr-2"></i> হিন্দু ধর্মীয় বিবরণী (Hindu Marriage Details)</h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">মন্দিরের নাম (Temple Name)</label>
                                    <input type="text" name="hindu_temple_name" class="form-control gov-input">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">পুরোহিতের নাম (Purohit Name)</label>
                                    <input type="text" name="hindu_purohit_name" class="form-control gov-input">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">ধর্মীয় অনুষ্ঠানের তারিখ (Ritual Date)</label>
                                    <input type="date" name="hindu_marriage_ritual_date" class="form-control gov-input">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="gov-label">কনের গোত্র (Bride Gotra)</label>
                                    <input type="text" name="hindu_bride_gotra" class="form-control gov-input">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="gov-label">বরের গোত্র (Groom Gotra)</label>
                                    <input type="text" name="hindu_groom_gotra" class="form-control gov-input">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="gov-label">সপ্তপদী সম্পন্ন হয়েছে? (Saptapadi Completed)</label>
                                    <select name="hindu_saptapadi_completed" class="form-control gov-input" style="padding: 5px 12px;">
                                        <option value="Yes">হ্যাঁ (Yes)</option>
                                        <option value="No">না (No)</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="gov-label">অগ্নি প্রদক্ষিণ সম্পন্ন? (Sacred Fire Ceremony)</label>
                                    <select name="hindu_sacred_fire_ceremony" class="form-control gov-input" style="padding: 5px 12px;">
                                        <option value="Yes">হ্যাঁ (Yes)</option>
                                        <option value="No">না (No)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Christian specific card -->
                        <div id="religion_Christian" class="religion-sub-card" style="border-top: 4px solid #2563eb;">
                            <h5 class="text-primary font-weight-bold mb-3"><i class="fas fa-cross mr-2"></i> খ্রিস্টান ধর্মীয় বিবরণী (Christian Marriage Details)</h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">গির্জার নাম (Church Name)</label>
                                    <input type="text" name="christian_church_name" class="form-control gov-input">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">পাস্টরের নাম (Pastor Name)</label>
                                    <input type="text" name="christian_pastor_name" class="form-control gov-input">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">লাইসেন্স নম্বর (License No)</label>
                                    <input type="text" name="christian_marriage_license_no" class="form-control gov-input">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="gov-label">বিবাহের বিজ্ঞপ্তি প্রকাশকাল (Publication of Banns)</label>
                                    <input type="text" name="christian_publication_of_banns" class="form-control gov-input" placeholder="যেমন: ৩ সপ্তাহ পূর্বে">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="gov-label">পরিচালনাকারীর নাম (Marriage Conducted By)</label>
                                    <input type="text" name="christian_marriage_conducted_by" class="form-control gov-input">
                                </div>
                            </div>
                        </div>

                        <!-- Other specific card -->
                        <div id="religion_Other" class="religion-sub-card" style="border-top: 4px solid #db2777;">
                            <h5 class="text-pink font-weight-bold mb-3"><i class="fas fa-hands-helping mr-2"></i> অন্যান্য ধর্মীয় বিবরণী (Other Religion Details)</h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">ধর্মের নাম (Religion Name)</label>
                                    <input type="text" name="other_religion_name" class="form-control gov-input">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">ধর্মীয় নেতার নাম (Religious Leader Name)</label>
                                    <input type="text" name="other_religious_leader_name" class="form-control gov-input">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="gov-label">অনুষ্ঠানের ধরণ (Ceremony Type)</label>
                                    <input type="text" name="other_ceremony_type" class="form-control gov-input">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="gov-label">প্রতিষ্ঠান/উপাসনালয়ের নাম (Organization/Temple Name)</label>
                                    <input type="text" name="other_organization_name" class="form-control gov-input">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="gov-label">অন্যান্য বিবরণ (Other Details)</label>
                                    <textarea name="other_other_details" class="form-control gov-input" rows="2"></textarea>
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
                            <!-- Groom NID -->
                            <div class="col-md-4 mb-3">
                                <div class="doc-checkbox-card">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input doc-checkbox" id="chk_groom_nid" name="uploaded_documents[]" value="Groom NID" data-target="file_groom_nid">
                                        <label class="custom-control-label font-weight-bold" for="chk_groom_nid">বরের এনআইডি কপি</label>
                                    </div>
                                    <div id="file_groom_nid" class="doc-file-input" style="display: none;">
                                        <input type="file" name="doc_groom_nid_file" class="form-control gov-input" style="padding: 5px;">
                                    </div>
                                </div>
                            </div>

                            <!-- Bride NID -->
                            <div class="col-md-4 mb-3">
                                <div class="doc-checkbox-card">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input doc-checkbox" id="chk_bride_nid" name="uploaded_documents[]" value="Bride NID" data-target="file_bride_nid">
                                        <label class="custom-control-label font-weight-bold" for="chk_bride_nid">কনের এনআইডি কপি</label>
                                    </div>
                                    <div id="file_bride_nid" class="doc-file-input" style="display: none;">
                                        <input type="file" name="doc_bride_nid_file" class="form-control gov-input" style="padding: 5px;">
                                    </div>
                                </div>
                            </div>

                            <!-- Birth Certificate -->
                            <div class="col-md-4 mb-3">
                                <div class="doc-checkbox-card">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input doc-checkbox" id="chk_birth_certificate" name="uploaded_documents[]" value="Birth Certificate" data-target="file_birth_certificate">
                                        <label class="custom-control-label font-weight-bold" for="chk_birth_certificate">জন্ম নিবন্ধন সনদ কপি</label>
                                    </div>
                                    <div id="file_birth_certificate" class="doc-file-input" style="display: none;">
                                        <input type="file" name="doc_birth_certificate_file" class="form-control gov-input" style="padding: 5px;">
                                    </div>
                                </div>
                            </div>

                            <!-- Passport size Photo -->
                            <div class="col-md-4 mb-3">
                                <div class="doc-checkbox-card">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input doc-checkbox" id="chk_passport_photo" name="uploaded_documents[]" value="Passport Photo" data-target="file_passport_photo">
                                        <label class="custom-control-label font-weight-bold" for="chk_passport_photo">পাসপোর্ট সাইজ ফটো কপি</label>
                                    </div>
                                    <div id="file_passport_photo" class="doc-file-input" style="display: none;">
                                        <input type="file" name="doc_passport_photo_file" class="form-control gov-input" style="padding: 5px;">
                                    </div>
                                </div>
                            </div>

                            <!-- Witness NID -->
                            <div class="col-md-4 mb-3">
                                <div class="doc-checkbox-card">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input doc-checkbox" id="chk_witness_nid" name="uploaded_documents[]" value="Witness NID" data-target="file_witness_nid">
                                        <label class="custom-control-label font-weight-bold" for="chk_witness_nid">সাক্ষীর এনআইডি কপি</label>
                                    </div>
                                    <div id="file_witness_nid" class="doc-file-input" style="display: none;">
                                        <input type="file" name="doc_witness_nid_file" class="form-control gov-input" style="padding: 5px;">
                                    </div>
                                </div>
                            </div>

                            <!-- Marriage Certificate Scan -->
                            <div class="col-md-4 mb-3">
                                <div class="doc-checkbox-card">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input doc-checkbox" id="chk_marriage_certificate" name="uploaded_documents[]" value="Marriage Certificate Scan" data-target="file_marriage_certificate">
                                        <label class="custom-control-label font-weight-bold" for="chk_marriage_certificate">আদালত/কাজী সনদ স্ক্যান</label>
                                    </div>
                                    <div id="file_marriage_certificate" class="doc-file-input" style="display: none;">
                                        <input type="file" name="doc_marriage_certificate_scan_file" class="form-control gov-input" style="padding: 5px;">
                                    </div>
                                </div>
                            </div>

                            <!-- Other -->
                            <div class="col-md-12">
                                <div class="doc-checkbox-card">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input doc-checkbox" id="chk_other" name="uploaded_documents[]" value="Other" data-target="file_other">
                                        <label class="custom-control-label font-weight-bold" for="chk_other">অন্যান্য প্রমাণপত্র (যদি থাকে)</label>
                                    </div>
                                    <div id="file_other" class="doc-file-input" style="display: none;">
                                        <input type="file" name="doc_other_file" class="form-control gov-input" style="padding: 5px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 8: REGISTRAR / KAZI INFORMATION -->
                    <div class="gov-section">
                        <div class="gov-section-title">
                            <i class="fas fa-stamp"></i> ৮. বিবাহ নিবন্ধনকারী কর্মকর্তা/কাজী (Registrar / Kazi Information)
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">কর্মকর্তার নাম (Registrar / Kazi Name)</label>
                                <input type="text" name="registrar_name" class="form-control gov-input">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">লাইসেন্স নম্বর (License Number)</label>
                                <input type="text" name="registrar_license" class="form-control gov-input">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="gov-label">অফিসিয়াল সিল আপলোড (Upload Seal)</label>
                                <input type="file" name="registrar_office_seal_file" class="form-control gov-input" style="padding: 5px;">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="gov-label">অফিসিয়াল ঠিকানা (Office Address)</label>
                                <input type="text" name="registrar_office_address" class="form-control gov-input" placeholder="যেমন: বাড্ডা কাজী অফিস, ঢাকা">
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 9: FINAL DECLARATION & SIGNATURES -->
                    <div class="gov-section">
                        <div class="gov-section-title">
                            <i class="fas fa-signature"></i> ৯. চূড়ান্ত ঘোষণা ও স্বাক্ষর (Final Declaration)
                        </div>
                        
                        <div class="alert alert-success p-3" style="background-color: #f0fdf4; border-left: 5px solid #16a34a; color: #14532d;">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="declaration_check" required style="transform: scale(1.2);">
                                <label class="custom-control-label ml-2 font-weight-bold" for="declaration_check">
                                    আমি/আমরা এতদ্বারা ঘোষণা করছি যে, এই ফর্মে প্রদত্ত তথ্যসমূহ সম্পূর্ণ সত্য ও নির্ভুল। যদি কোনো তথ্য অসত্য প্রমাণিত হয়, তবে আমরা প্রচলিত আইন অনুযায়ী দায়ী থাকবো।
                                </label>
                            </div>
                        </div>

                        <!-- Graphic visual signatures box representation -->
                        <div class="row mt-5 text-center">
                            <div class="col-md-4 mb-4">
                                <div style="border-top: 1.5px dashed #475569; width: 80%; margin: 0 auto; padding-top: 8px;">
                                    <span class="font-weight-bold text-secondary">বরের স্বাক্ষর (Groom Signature)</span>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div style="border-top: 1.5px dashed #475569; width: 80%; margin: 0 auto; padding-top: 8px;">
                                    <span class="font-weight-bold text-secondary">কনের স্বাক্ষর (Bride Signature)</span>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="mb-2">
                                    <label class="gov-label text-success">কর্মকর্তা/কাজী স্বাক্ষর আপলোড</label>
                                    <input type="file" name="registrar_signature_file" class="form-control gov-input mx-auto" style="padding: 5px; width: 80%;">
                                </div>
                                <div style="border-top: 1.5px dashed #475569; width: 80%; margin: 0 auto; padding-top: 8px;">
                                    <span class="font-weight-bold text-secondary">নিবন্ধনকারী স্বাক্ষর (Registrar Signature)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ACTIONS BUTTONS -->
                    <div class="action-buttons-wrap text-center mt-4">
                        <button type="reset" class="btn btn-gov btn-gov-secondary"><i class="fas fa-undo"></i> রিসেট (Reset)</button>
                        <button type="submit" class="btn btn-gov btn-gov-success"><i class="fas fa-save"></i> নিবন্ধন সম্পন্ন করুন (Submit)</button>
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

        // 2. DYNAMIC RELIGION TOGLE
        $("#marriageTypeSelect").on('change', function() {
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
                } else {
                    $(previewEl).hide().attr('src', '');
                }
            });
        }

        registerPhotoPreview('#groom_photo_input', '#groom_photo_preview');
        registerPhotoPreview('#groom_sig_input', '#groom_sig_preview');
        registerPhotoPreview('#bride_photo_input', '#bride_photo_preview');
        registerPhotoPreview('#bride_sig_input', '#bride_sig_preview');

        // 5. GROOM, BRIDE & WITNESSES AUTO-FETCH LOGIC
        let groomTimer;
        let brideTimer;
        let witness1Timer;
        let witness2Timer;
        const typingDelay = 500;

        // Groom search
        $('#groom_search_id').on('keyup input', function() {
            clearTimeout(groomTimer);
            let groomId = $(this).val().trim();
            
            if (groomId.length > 5) {
                groomTimer = setTimeout(function() {
                    fetchGroomDetails(groomId);
                }, typingDelay);
            } else {
                clearGroomFields();
            }
        });

        // Bride search
        $('#bride_search_id').on('keyup input', function() {
            clearTimeout(brideTimer);
            let brideId = $(this).val().trim();
            
            if (brideId.length > 5) {
                brideTimer = setTimeout(function() {
                    fetchBrideDetails(brideId);
                }, typingDelay);
            } else {
                clearBrideFields();
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
            } else {
                clearWitnessFields(1);
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
            } else {
                clearWitnessFields(2);
            }
        });

        function fetchGroomDetails(systemId) {
            $('#groom_search_status').removeClass('badge-secondary badge-danger badge-success').addClass('badge-info').text('Searching...').show();
            $.ajax({
                type: "GET",
                url: "{{ url('/search-user-by-system-id') }}/" + systemId,
                success: function(response) {
                    if (response.status && response.user) {
                        let user = response.user;
                        $('#groom_search_status').removeClass('badge-info').addClass('badge-success').text('Groom Found!');
                        
                        // Populate
                        $('#groom_user_id').val(user.id);
                        $('#groom_name').val(user.people ? (user.people.bn_name ?? user.name) : user.name);
                        
                        let family = user.family_info || user.familyInfo;
                        $('#groom_father_name').val(family ? (family.father_name_bn || family.father_name || '') : '');
                        $('#groom_mother_name').val(family ? (family.mother_name_bn || family.mother_name || '') : '');
                        
                        let dob = user.people ? (user.people.date_of_birth || user.people.dob || '') : '';
                        $('#groom_dob').val(dob);
                        $('#groom_age').val(calculateAge(dob));
                        
                        $('#groom_nid').val(user.nid ?? user.birth_certificate ?? '');
                        $('#groom_religion').val(user.people ? user.people.religion : '');
                        $('#groom_occupation').val(getOccupation(user));
                        $('#groom_mobile').val(user.mobile ?? '');

                        // Construct addresses
                        $('#groom_present_address').val(getFormattedAddress(user, 'present'));
                        $('#groom_permanent_address').val(getFormattedAddress(user, 'permanent'));

                        if(user.image) {
                            $('#groom_photo_preview').attr('src', "{{ asset('') }}" + user.image).show();
                        }
                        
                        toastr.success("Groom data loaded successfully!");
                    } else {
                        $('#groom_search_status').removeClass('badge-info').addClass('badge-danger').text('Not Found');
                        toastr.error("Groom not found.");
                    }
                },
                error: function() {
                    $('#groom_search_status').removeClass('badge-info').addClass('badge-danger').text('Error');
                    toastr.error("Error fetching Groom data.");
                }
            });
        }

        function fetchBrideDetails(systemId) {
            $('#bride_search_status').removeClass('badge-secondary badge-danger badge-success').addClass('badge-info').text('Searching...').show();
            $.ajax({
                type: "GET",
                url: "{{ url('/search-user-by-system-id') }}/" + systemId,
                success: function(response) {
                    if (response.status && response.user) {
                        let user = response.user;
                        $('#bride_search_status').removeClass('badge-info').addClass('badge-success').text('Bride Found!');
                        
                        // Populate
                        $('#bride_user_id').val(user.id);
                        $('#bride_name').val(user.people ? (user.people.bn_name ?? user.name) : user.name);
                        
                        let family = user.family_info || user.familyInfo;
                        $('#bride_father_name').val(family ? (family.father_name_bn || family.father_name || '') : '');
                        $('#bride_mother_name').val(family ? (family.mother_name_bn || family.mother_name || '') : '');
                        
                        let dob = user.people ? (user.people.date_of_birth || user.people.dob || '') : '';
                        $('#bride_dob').val(dob);
                        $('#bride_age').val(calculateAge(dob));
                        
                        $('#bride_nid').val(user.nid ?? user.birth_certificate ?? '');
                        $('#bride_religion').val(user.people ? user.people.religion : '');
                        $('#bride_occupation').val(getOccupation(user));
                        $('#bride_mobile').val(user.mobile ?? '');

                        // Construct addresses
                        $('#bride_present_address').val(getFormattedAddress(user, 'present'));
                        $('#bride_permanent_address').val(getFormattedAddress(user, 'permanent'));

                        if(user.image) {
                            $('#bride_photo_preview').attr('src', "{{ asset('') }}" + user.image).show();
                        }
                        
                        toastr.success("Bride data loaded successfully!");
                    } else {
                        $('#bride_search_status').removeClass('badge-info').addClass('badge-danger').text('Not Found');
                        toastr.error("Bride not found.");
                    }
                },
                error: function() {
                    $('#bride_search_status').removeClass('badge-info').addClass('badge-danger').text('Error');
                    toastr.error("Error fetching Bride data.");
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

        function clearWitnessFields(witnessNum) {
            $('#witness_' + witnessNum + '_search_status').hide();
            $('#witness_' + witnessNum + '_name').val('');
            $('#witness_' + witnessNum + '_nid').val('');
            $('#witness_' + witnessNum + '_mobile').val('');
            $('#witness_' + witnessNum + '_address').val('');
        }

        function clearGroomFields() {
            $('#groom_search_status').hide();
            $('#groom_user_id').val('');
            $('#groom_name').val('');
            $('#groom_father_name').val('');
            $('#groom_mother_name').val('');
            $('#groom_dob').val('');
            $('#groom_age').val('');
            $('#groom_nid').val('');
            $('#groom_religion').val('');
            $('#groom_occupation').val('');
            $('#groom_mobile').val('');
            $('#groom_present_address').val('');
            $('#groom_permanent_address').val('');
            $('#groom_photo_preview').hide().attr('src', '');
        }

        function clearBrideFields() {
            $('#bride_search_status').hide();
            $('#bride_user_id').val('');
            $('#bride_name').val('');
            $('#bride_father_name').val('');
            $('#bride_mother_name').val('');
            $('#bride_dob').val('');
            $('#bride_age').val('');
            $('#bride_nid').val('');
            $('#bride_religion').val('');
            $('#bride_occupation').val('');
            $('#bride_mobile').val('');
            $('#bride_present_address').val('');
            $('#bride_permanent_address').val('');
            $('#bride_photo_preview').hide().attr('src', '');
        }

        // 6. FORM AJAX SUBMIT
        $("#marriageRegistrationForm").on('submit', function(e) {
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
                    submitBtn.prop("disabled", false).html('<i class="fas fa-save"></i> নিবন্ধন সম্পন্ন করুন (Submit)');
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
                    submitBtn.prop("disabled", false).html('<i class="fas fa-save"></i> নিবন্ধন সম্পন্ন করুন (Submit)');
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
