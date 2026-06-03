@extends('backend.master', ['mainMenu' => 'Marriage', 'subMenu' =>'DivorceShow'])

@section('title', 'Divorce View')

@push('style')
<style>
    html,
    body {
        margin: 0;
        padding: 0;
        font-family: 'Nikosh', 'Noto Sans Bengali', Arial, sans-serif;
        font-size: 14px !important;
        line-height: 1.4;
        background: #f4f6f9;
    }

    .people-certificate-page {
        max-width: 1100px;
        margin: 0 auto;
        background: white;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        position: relative;
        overflow: visible;
        border-radius: 4px;
    }

    .people-certificate-content {
        padding: 10mm 15mm;
    }

    .header-logos {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        border-bottom: 2px solid #7f1d1d;
        padding-bottom: 10px;
    }

    .header-logos img {
        width: 70px;
        height: 70px;
        object-fit: contain;
    }

    .union-header {
        text-align: center;
        flex: 1;
    }

    .union-title-bn {
        font-size: 24px;
        font-weight: bold;
        color: #7f1d1d;
        margin: 0;
    }

    .union-title-en {
        font-size: 18px;
        font-weight: bold;
        color: #2e3192;
        margin: 2px 0;
    }

    .union-address {
        font-size: 16px;
        margin: 0;
        color: #333;
    }

    .citizen-title {
        text-align: center;
        margin: 10px 0;
    }

    .citizen-title h4 {
        font-size: 20px;
        font-weight: bold;
        color: #7f1d1d;
        margin: 0;
    }

    .section-header {
        background: #7f1d1d;
        color: #fff;
        font-weight: bold;
        padding: 6px 12px;
        margin: 20px 0 12px 0;
        font-size: 16px;
        border-radius: 4px;
        letter-spacing: 1px;
    }

    .info-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px 30px;
        width: 100%;
    }

    .info-row {
        display: flex;
        align-items: center;
        margin-bottom: 0;
        font-size: 13px;
        border-bottom: 1px dotted #e0e0e0;
        padding-bottom: 5px;
        width: 100%;
    }

    .info-row.span-2 {
        grid-column: span 2;
    }

    .info-label {
        width: 220px;
        min-width: 220px;
        font-weight: bold;
        color: #2c3e4e;
        white-space: nowrap;
    }

    .info-colon {
        width: 15px;
        min-width: 15px;
        font-weight: bold;
        color: #2c3e4e;
        text-align: center;
        white-space: nowrap;
    }

    .info-value {
        flex: 1;
        color: #1e2a36;
        text-align: left;
        word-break: break-word;
    }

    .profile-card {
        background: #fdf8f8;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #fca5a5;
        margin-bottom: 15px;
    }

    .profile-serial-title {
        font-size: 16px;
        font-weight: 700;
        color: #7f1d1d;
        margin-bottom: 15px;
        border-bottom: 2px solid #fca5a5;
        padding-bottom: 5px;
    }

    .profile-top {
        display: flex;
        gap: 20px;
        align-items: flex-start;
        margin-bottom: 15px;
    }

    .profile-photo img {
        width: 120px;
        height: 120px;
        border-radius: 8px;
        object-fit: cover;
        border: 2px solid #7f1d1d;
        background: #fff;
    }

    .profile-info-list {
        flex: 1;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 6px 20px;
    }

    /* Override label widths in profile and witness cards to maximize value space */
    .profile-info-list .info-label,
    .witness-card .info-label {
        width: 170px;
        min-width: 170px;
    }

    .signature-box {
        text-align: center;
        background: #fdfdfd;
        border: 1px dashed #cbd5e1;
        padding: 10px;
        border-radius: 6px;
        margin-top: 10px;
        width: 200px;
    }

    .signature-box img {
        max-height: 50px;
        object-fit: contain;
        margin-bottom: 5px;
    }

    .two-columns {
        display: flex;
        gap: 30px;
        margin-top: 10px;
    }

    .col {
        flex: 1;
    }

    .action-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 25px;
        padding-top: 15px;
        border-top: 1px dashed #aaa;
    }

    .attachment-img {
        max-width: 100%;
        max-height: 150px;
        object-fit: contain;
        border: 1px solid #cbd5e1;
        border-radius: 4px;
        margin-top: 5px;
    }

    @media print {
        body {
            background: white !important;
        }
        .people-certificate-page {
            box-shadow: none !important;
            border: none !important;
        }
        .action-row, .main-footer, .main-header, .brand-link, .sidebar-wrapper {
            display: none !important;
        }
        .people-certificate-content {
            padding: 0 !important;
        }
    }

    @media (max-width: 768px) {
        .profile-top {
            flex-direction: column;
        }

        .profile-photo {
            margin: 0 auto 15px auto;
        }

        .profile-info-list {
            grid-template-columns: 1fr;
        }

        .info-grid-2 {
            grid-template-columns: 1fr;
        }

        .two-columns {
            flex-direction: column;
            gap: 15px;
        }

        .info-label {
            width: auto;
            min-width: 150px;
        }
    }
</style>
@endpush

@section('content')
<div class="people-certificate-page mt-3 mb-3">
    <div class="people-certificate-content">
        <!-- Gov Header -->
        <div class="header-logos">
            <img src="{{ asset('images/dhaka.png') }}" alt="BD Seal Logo">
            <div class="union-header">
                <h5 class="mb-0">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h5>
                <div class="union-title-bn">{{ $divorce->union?->bn_name ?? '' }} ইউনিয়ন পরিষদ</div>
                <div class="union-title-en">{{ $divorce->union?->name ?? '' }} Union Parishad</div>
                <p class="union-address">
                    উপজেলাঃ {{ $divorce->upazila?->bn_name ?? $divorce->upazila?->name ?? '' }},
                    জেলাঃ {{ $divorce->district?->bn_name ?? $divorce->district?->name ?? '' }},
                    বাংলাদেশ।
                </p>
            </div>
            <img src="{{ asset('images/govt-bd-logo.png') }}" alt="Govt Logo">
        </div>

        <div class="citizen-title">
            <h4 class="mb-0">বিবাহবিচ্ছেদ নিবন্ধন তথ্য</h4>
            <h4>Divorce Registration Details</h4>
        </div>

        <!-- Section 1: Basic Info -->
        <div class="section-header">১. মৌলিক তথ্য (Basic Information)</div>
        <div class="profile-card">
            <div class="info-grid-2">
                <div class="info-row">
                    <span class="info-label">নিবন্ধন নম্বর (Reg No)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value"><strong>{{ $divorce->registration_no }}</strong></span>
                </div>
                <div class="info-row">
                    <span class="info-label">নিবন্ধন তারিখ (Reg Date)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $divorce->registration_date }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">বিবাহবিচ্ছেদের ধরণ (Divorce Type)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $divorce->divorce_type }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">বিচ্ছেদ সম্পন্ন তারিখ (Divorce Date)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $divorce->divorce_date }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">বিচ্ছেদের স্থান (Place of Separation)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $divorce->divorce_place }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">এলাকার ধরণ (Area Type)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $divorce->divorce_area_type }}</span>
                </div>
                <div class="info-row span-2">
                    <span class="info-label">ঠিকানা (Location Address)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">গ্রাম: {{ $divorce->village_area }}, ওয়ার্ড: {{ $divorce->ward_no }}, ডাকঘর: {{ $divorce->post_office }} ({{ $divorce->post_code }})</span>
                </div>
            </div>
        </div>

        <!-- Section 2: Husband Profile -->
        <div class="section-header">২. স্বামীর বিবরণ (Husband Information)</div>
        <div class="profile-card">
            <div class="profile-serial-title">স্বামীর পূর্ণ বিবরণ (Husband Details)</div>
            <div class="profile-top">
                <div class="profile-photo">
                    <img src="{{ $divorce->husband_photo ? imageUrl($divorce->husband_photo) : ($divorce->husbandUser && $divorce->husbandUser->image ? imageUrl($divorce->husbandUser->image) : asset('no-image-found.jpeg')) }}" alt="Husband Photo">
                </div>
                <div class="profile-info-list">
                    <div class="info-row">
                        <span class="info-label">নাম (Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value"><strong>{{ $divorce->husband_name }}</strong></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">জাতীয় পরিচয়পত্র (NID)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value"><strong>{{ $divorce->husband_nid }}</strong></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">পিতার নাম (Father's Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->husband_father_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">মাতার নাম (Mother's Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->husband_mother_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">জন্ম তারিখ (DOB)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->husband_dob }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">বয়স (Age)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->husband_age }} বছর</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">ধর্ম (Religion)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->husband_religion }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">পেশা (Occupation)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->husband_occupation ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">মোবাইল (Mobile)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->husband_mobile }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">বৈবাহিক অবস্থা (Marital Status)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->husband_marital_status }}</span>
                    </div>
                </div>
            </div>
            
            <div class="info-grid-2">
                <div class="info-row">
                    <span class="info-label">বর্তমান ঠিকানা (Present Address)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $divorce->husband_present_address }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">স্থায়ী ঠিকানা (Permanent Address)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $divorce->husband_permanent_address }}</span>
                </div>
            </div>

            @if($divorce->husband_signature)
            <div class="signature-box">
                <img src="{{ imageUrl($divorce->husband_signature) }}" alt="Husband Signature">
                <div class="font-weight-bold" style="font-size:11px;">স্বামীর স্বাক্ষর (Husband's Signature)</div>
            </div>
            @endif
        </div>

        <!-- Section 3: Wife Profile -->
        <div class="section-header">৩. স্ত্রীর বিবরণ (Wife Information)</div>
        <div class="profile-card">
            <div class="profile-serial-title">স্ত্রীর পূর্ণ বিবরণ (Wife Details)</div>
            <div class="profile-top">
                <div class="profile-photo">
                    <img src="{{ $divorce->wife_photo ? imageUrl($divorce->wife_photo) : ($divorce->wifeUser && $divorce->wifeUser->image ? imageUrl($divorce->wifeUser->image) : asset('no-image-found.jpeg')) }}" alt="Wife Photo">
                </div>
                <div class="profile-info-list">
                    <div class="info-row">
                        <span class="info-label">নাম (Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value"><strong>{{ $divorce->wife_name }}</strong></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">জাতীয় পরিচয়পত্র (NID)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value"><strong>{{ $divorce->wife_nid }}</strong></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">পিতার নাম (Father's Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->wife_father_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">মাতার নাম (Mother's Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->wife_mother_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">জন্ম তারিখ (DOB)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->wife_dob }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">বয়স (Age)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->wife_age }} বছর</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">ধর্ম (Religion)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->wife_religion }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">পেশা (Occupation)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->wife_occupation ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">মোবাইল (Mobile)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->wife_mobile }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">বৈবাহিক অবস্থা (Marital Status)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->wife_marital_status }}</span>
                    </div>
                </div>
            </div>
            
            <div class="info-grid-2">
                <div class="info-row">
                    <span class="info-label">বর্তমান ঠিকানা (Present Address)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $divorce->wife_present_address }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">স্থায়ী ঠিকানা (Permanent Address)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $divorce->wife_permanent_address }}</span>
                </div>
            </div>

            @if($divorce->wife_signature)
            <div class="signature-box">
                <img src="{{ imageUrl($divorce->wife_signature) }}" alt="Wife Signature">
                <div class="font-weight-bold" style="font-size:11px;">স্ত্রীর স্বাক্ষর (Wife's Signature)</div>
            </div>
            @endif
        </div>

        <!-- Section 4: Witness Info -->
        <div class="section-header">৪. সাক্ষীদের বিবরণ (Witness Information)</div>
        <div class="two-columns">
            <div class="col profile-card witness-card">
                <h6 class="font-weight-bold text-danger mb-3"><i class="fas fa-check-circle"></i> ১ম সাক্ষী (Witness 1)</h6>
                <div class="info-row">
                    <span class="info-label">নাম (Name)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value"><strong>{{ $divorce->witness_1_name }}</strong></span>
                </div>
                <div class="info-row">
                    <span class="info-label">এনআইডি (NID)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $divorce->witness_1_nid }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">মোবাইল (Mobile)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $divorce->witness_1_mobile }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">ঠিকানা (Address)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $divorce->witness_1_address }}</span>
                </div>
                @if($divorce->witness_1_signature)
                <div class="signature-box mt-2">
                    <img src="{{ imageUrl($divorce->witness_1_signature) }}" alt="Witness 1 Signature">
                </div>
                @endif
            </div>

            <div class="col profile-card witness-card">
                <h6 class="font-weight-bold text-danger mb-3"><i class="fas fa-check-circle"></i> ২য় সাক্ষী (Witness 2)</h6>
                <div class="info-row">
                    <span class="info-label">নাম (Name)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value"><strong>{{ $divorce->witness_2_name }}</strong></span>
                </div>
                <div class="info-row">
                    <span class="info-label">এনআইডি (NID)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $divorce->witness_2_nid }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">মোবাইল (Mobile)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $divorce->witness_2_mobile }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">ঠিকানা (Address)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $divorce->witness_2_address }}</span>
                </div>
                @if($divorce->witness_2_signature)
                <div class="signature-box mt-2">
                    <img src="{{ imageUrl($divorce->witness_2_signature) }}" alt="Witness 2 Signature">
                </div>
                @endif
            </div>
        </div>

        <!-- Section 5: Religion / Kabin Details -->
        @if($divorce->divorce_type === 'Islam' || $divorce->divorce_type === 'Hindu' || $divorce->divorce_type === 'Christian' || $divorce->divorce_type === 'Other')
        <div class="section-header">৫. ধর্মীয় ও কাবিননামা সংক্রান্ত তথ্য (Religious & Kabin Details)</div>
        <div class="profile-card">
            <div class="info-grid-2">
                @if($divorce->divorce_type === 'Islam')
                    <div class="info-row">
                        <span class="info-label">কাবিননামা নম্বর (Kabin No)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value"><strong>{{ $divorce->islam_kabin_number }}</strong></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">স্ত্রীর উকিল (Wife Wakil)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->islam_wife_wakil_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">দেনমোহর পরিমাণ (Den Mohor)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value"><strong>৳{{ number_format($divorce->islam_den_mohor_amount, 2) }}</strong></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">স্বামীর উকিল (Husband Wakil)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->islam_husband_wakil_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">মোহরানার ধরণ (Den Mohor Type)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->islam_den_mohor_type }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">নিবন্ধনকারী কাজী (Kazi Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->islam_kazi_name }} (লাইসেন্স: {{ $divorce->islam_kazi_license_no }})</span>
                    </div>
                    <div class="info-row span-2">
                        <span class="info-label">বিবাহবিচ্ছেদের কারণ (Divorce Reason)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->islam_divorce_reason }}</span>
                    </div>
                @elseif($divorce->divorce_type === 'Hindu')
                    <div class="info-row">
                        <span class="info-label">মন্দিরের নাম (Temple Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->hindu_temple_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">স্ত্রীর গোত্র (Wife Gotra)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->hindu_wife_gotra }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">পুরোহিতের নাম (Purohit Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->hindu_purohit_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">স্বামীর গোত্র (Husband Gotra)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->hindu_husband_gotra }}</span>
                    </div>
                @elseif($divorce->divorce_type === 'Christian')
                    <div class="info-row">
                        <span class="info-label">গীর্জার নাম (Church Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->christian_church_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">পাস্টর নাম (Pastor Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->christian_pastor_name }}</span>
                    </div>
                @elseif($divorce->divorce_type === 'Other')
                    <div class="info-row">
                        <span class="info-label">ধর্মের নাম (Religion Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->other_religion_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">প্রতিষ্ঠানের নাম (Org Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->other_organization_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">ধর্মীয় নেতার নাম (Leader Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->other_religious_leader_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">অন্যান্য বিবরণ (Other Details)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->other_other_details }}</span>
                    </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Section 6: Uploaded Legal Documents -->
        <div class="section-header">৬. সংযুক্ত আইনগত নথিপত্র (Attached Legal Documents)</div>
        <div class="profile-card">
            <div class="row">
                @if($divorce->doc_husband_nid)
                <div class="col-md-3 text-center mb-3">
                    <div class="font-weight-bold" style="font-size:12px;">স্বামীর জাতীয় পরিচয়পত্র</div>
                    <a href="{{ imageUrl($divorce->doc_husband_nid) }}" target="_blank">
                        <img src="{{ imageUrl($divorce->doc_husband_nid) }}" class="attachment-img">
                    </a>
                </div>
                @endif

                @if($divorce->doc_wife_nid)
                <div class="col-md-3 text-center mb-3">
                    <div class="font-weight-bold" style="font-size:12px;">স্ত্রীর জাতীয় পরিচয়পত্র</div>
                    <a href="{{ imageUrl($divorce->doc_wife_nid) }}" target="_blank">
                        <img src="{{ imageUrl($divorce->doc_wife_nid) }}" class="attachment-img">
                    </a>
                </div>
                @endif

                @if($divorce->doc_birth_certificate)
                <div class="col-md-3 text-center mb-3">
                    <div class="font-weight-bold" style="font-size:12px;">জন্ম নিবন্ধন সনদ</div>
                    <a href="{{ imageUrl($divorce->doc_birth_certificate) }}" target="_blank">
                        <img src="{{ imageUrl($divorce->doc_birth_certificate) }}" class="attachment-img">
                    </a>
                </div>
                @endif

                @if($divorce->doc_divorce_paper_scan)
                <div class="col-md-3 text-center mb-3">
                    <div class="font-weight-bold" style="font-size:12px;">তালাকনামা স্ক্যান কপি</div>
                    <a href="{{ imageUrl($divorce->doc_divorce_paper_scan) }}" target="_blank">
                        <img src="{{ imageUrl($divorce->doc_divorce_paper_scan) }}" class="attachment-img">
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Section 7: Registrar Details -->
        <div class="section-header">৭. নিবন্ধনকারী কাজী / রেজিস্টার বিবরণ (Registrar Information)</div>
        <div class="profile-card">
            <div class="row">
                <div class="col-md-8">
                    <div class="info-row">
                        <span class="info-label">রেজিস্টারের নাম (Registrar Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value"><strong>{{ $divorce->registrar_name }}</strong></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">লাইসেন্স নম্বর (License No)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->registrar_license }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">অফিসের ঠিকানা (Office Address)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $divorce->registrar_office_address }}</span>
                    </div>
                </div>
                <div class="col-md-4 text-center" style="display: flex; flex-direction: column; align-items: center; justify-content: center; border-left: 1px dashed #cbd5e1; padding-left: 20px;">
                    @if($divorce->registrar_office_seal)
                    <div class="mb-2">
                        <img src="{{ imageUrl($divorce->registrar_office_seal) }}" style="max-height: 80px; object-fit: contain;">
                        <div class="font-weight-bold" style="font-size:11px;">অফিসিয়াল সিল (Parishad/Office Seal)</div>
                    </div>
                    @endif

                    @if($divorce->registrar_signature)
                    <div class="mt-2">
                        <img src="{{ imageUrl($divorce->registrar_signature) }}" style="max-height: 60px; object-fit: contain;">
                        <div class="font-weight-bold" style="font-size:11px;">নিবন্ধনকারীর স্বাক্ষর (Registrar Signature)</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Action Row -->
        <div class="action-row">
            <div>
                <strong>স্ট্যাটাস (Status):</strong>
                <span class="badge badge-danger">আইনসম্মত বিবাহবিচ্ছেদ নিবন্ধিত (Separated)</span>
            </div>
            <div>
                <a href="{{ route('divorce.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to List</a>
                <button type="button" class="btn btn-danger" onclick="window.print()"><i class="fas fa-print"></i> Print Details</button>
            </div>
        </div>

    </div>
</div>
@endsection
