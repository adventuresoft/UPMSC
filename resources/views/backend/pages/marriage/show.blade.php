@extends('backend.master', ['mainMenu' => 'Marriage', 'subMenu' =>'MarriageShow'])

@section('title', 'Marriage View')

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
        border-bottom: 2px solid #1e5e3a;
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
        color: #1e5e3a;
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
        color: #1e5e3a;
        margin: 0;
    }

    .section-header {
        background: #1e5e3a;
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
        background: #f8f9fc;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        margin-bottom: 15px;
    }

    .profile-serial-title {
        font-size: 16px;
        font-weight: 700;
        color: #1e5e3a;
        margin-bottom: 15px;
        border-bottom: 2px solid #cbd5e1;
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
        border: 2px solid #1e5e3a;
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
                <div class="union-title-bn">{{ $marriage->union?->bn_name ?? '' }} ইউনিয়ন পরিষদ</div>
                <div class="union-title-en">{{ $marriage->union?->name ?? '' }} Union Parishad</div>
                <p class="union-address">
                    উপজেলাঃ {{ $marriage->upazila?->bn_name ?? $marriage->upazila?->name ?? '' }},
                    জেলাঃ {{ $marriage->district?->bn_name ?? $marriage->district?->name ?? '' }},
                    বাংলাদেশ।
                </p>
            </div>
            <img src="{{ asset('images/govt-bd-logo.png') }}" alt="Govt Logo">
        </div>

        <div class="citizen-title">
            <h4 class="mb-0">বিবাহ নিবন্ধন তথ্য</h4>
            <h4>Marriage Registration Details</h4>
        </div>

        <!-- Section 1: Basic Info -->
        <div class="section-header">১. মৌলিক তথ্য (Basic Information)</div>
        <div class="profile-card">
            <div class="info-grid-2">
                <div class="info-row">
                    <span class="info-label">নিবন্ধন নম্বর (Reg No)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value"><strong>{{ $marriage->registration_no }}</strong></span>
                </div>
                <div class="info-row">
                    <span class="info-label">নিবন্ধন তারিখ (Reg Date)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $marriage->registration_date }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">বিবাহের ধরণ (Marriage Type)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $marriage->marriage_type }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">বিবাহ সম্পন্ন তারিখ (Marriage Date)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $marriage->marriage_date }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">বিবাহের স্থান (Place of Marriage)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $marriage->marriage_place }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">এলাকার ধরণ (Area Type)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $marriage->marriage_area_type }}</span>
                </div>
                <div class="info-row span-2">
                    <span class="info-label">ঠিকানা (Location Address)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">গ্রাম: {{ $marriage->village_area }}, ওয়ার্ড: {{ $marriage->ward_no }}, ডাকঘর: {{ $marriage->post_office }} ({{ $marriage->post_code }})</span>
                </div>
            </div>
        </div>

        <!-- Section 2: Groom Profile -->
        <div class="section-header">২. বরের বিবরণ (Groom Information)</div>
        <div class="profile-card">
            <div class="profile-serial-title">বরের পূর্ণ বিবরণ (Groom Details)</div>
            <div class="profile-top">
                <div class="profile-photo">
                    <img src="{{ $marriage->groom_photo ? asset($marriage->groom_photo) : ($marriage->groomUser && $marriage->groomUser->image ? asset($marriage->groomUser->image) : asset('no-image-found.jpeg')) }}" alt="Groom Photo">
                </div>
                <div class="profile-info-list">
                    <div class="info-row">
                        <span class="info-label">নাম (Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value"><strong>{{ $marriage->groom_name }}</strong></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">জাতীয় পরিচয়পত্র (NID)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value"><strong>{{ $marriage->groom_nid }}</strong></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">পিতার নাম (Father's Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->groom_father_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">মাতার নাম (Mother's Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->groom_mother_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">জন্ম তারিখ (DOB)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->groom_dob }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">বয়স (Age)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->groom_age }} বছর</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">ধর্ম (Religion)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->groom_religion }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">পেশা (Occupation)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->groom_occupation ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">মোবাইল (Mobile)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->groom_mobile }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">বৈবাহিক অবস্থা (Marital Status)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->groom_marital_status }}</span>
                    </div>
                </div>
            </div>
            
            <div class="info-grid-2">
                <div class="info-row">
                    <span class="info-label">বর্তমান ঠিকানা (Present Address)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $marriage->groom_present_address }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">স্থায়ী ঠিকানা (Permanent Address)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $marriage->groom_permanent_address }}</span>
                </div>
            </div>

            @if($marriage->groom_signature)
            <div class="signature-box">
                <img src="{{ asset($marriage->groom_signature) }}" alt="Groom Signature">
                <div class="font-weight-bold" style="font-size:11px;">বরের স্বাক্ষর (Groom's Signature)</div>
            </div>
            @endif
        </div>

        <!-- Section 3: Bride Profile -->
        <div class="section-header">৩. কনের বিবরণ (Bride Information)</div>
        <div class="profile-card">
            <div class="profile-serial-title">কনের পূর্ণ বিবরণ (Bride Details)</div>
            <div class="profile-top">
                <div class="profile-photo">
                    <img src="{{ $marriage->bride_photo ? asset($marriage->bride_photo) : ($marriage->brideUser && $marriage->brideUser->image ? asset($marriage->brideUser->image) : asset('no-image-found.jpeg')) }}" alt="Bride Photo">
                </div>
                <div class="profile-info-list">
                    <div class="info-row">
                        <span class="info-label">নাম (Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value"><strong>{{ $marriage->bride_name }}</strong></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">জাতীয় পরিচয়পত্র (NID)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value"><strong>{{ $marriage->bride_nid }}</strong></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">পিতার নাম (Father's Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->bride_father_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">মাতার নাম (Mother's Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->bride_mother_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">জন্ম তারিখ (DOB)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->bride_dob }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">বয়স (Age)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->bride_age }} বছর</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">ধর্ম (Religion)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->bride_religion }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">পেশা (Occupation)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->bride_occupation ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">মোবাইল (Mobile)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->bride_mobile }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">বৈবাহিক অবস্থা (Marital Status)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->bride_marital_status }}</span>
                    </div>
                </div>
            </div>
            
            <div class="info-grid-2">
                <div class="info-row">
                    <span class="info-label">বর্তমান ঠিকানা (Present Address)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $marriage->bride_present_address }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">স্থায়ী ঠিকানা (Permanent Address)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $marriage->bride_permanent_address }}</span>
                </div>
            </div>

            @if($marriage->bride_signature)
            <div class="signature-box">
                <img src="{{ asset($marriage->bride_signature) }}" alt="Bride Signature">
                <div class="font-weight-bold" style="font-size:11px;">কনের স্বাক্ষর (Bride's Signature)</div>
            </div>
            @endif
        </div>

        <!-- Section 4: Witness Info -->
        <div class="section-header">৪. সাক্ষীদের বিবরণ (Witness Information)</div>
        <div class="two-columns">
            <div class="col profile-card witness-card">
                <h6 class="font-weight-bold text-success mb-3"><i class="fas fa-check-circle"></i> ১ম সাক্ষী (Witness 1)</h6>
                <div class="info-row">
                    <span class="info-label">নাম (Name)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value"><strong>{{ $marriage->witness_1_name }}</strong></span>
                </div>
                <div class="info-row">
                    <span class="info-label">এনআইডি (NID)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $marriage->witness_1_nid }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">মোবাইল (Mobile)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $marriage->witness_1_mobile }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">ঠিকানা (Address)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $marriage->witness_1_address }}</span>
                </div>
                @if($marriage->witness_1_signature)
                <div class="signature-box mt-2">
                    <img src="{{ asset($marriage->witness_1_signature) }}" alt="Witness 1 Signature">
                </div>
                @endif
            </div>

            <div class="col profile-card witness-card">
                <h6 class="font-weight-bold text-success mb-3"><i class="fas fa-check-circle"></i> ২য় সাক্ষী (Witness 2)</h6>
                <div class="info-row">
                    <span class="info-label">নাম (Name)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value"><strong>{{ $marriage->witness_2_name }}</strong></span>
                </div>
                <div class="info-row">
                    <span class="info-label">এনআইডি (NID)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $marriage->witness_2_nid }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">মোবাইল (Mobile)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $marriage->witness_2_mobile }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">ঠিকানা (Address)</span>
                    <span class="info-colon">:</span>
                    <span class="info-value">{{ $marriage->witness_2_address }}</span>
                </div>
                @if($marriage->witness_2_signature)
                <div class="signature-box mt-2">
                    <img src="{{ asset($marriage->witness_2_signature) }}" alt="Witness 2 Signature">
                </div>
                @endif
            </div>
        </div>

        <!-- Section 5: Religion / Kabin Details -->
        @if($marriage->marriage_type === 'Islam' || $marriage->marriage_type === 'Hindu' || $marriage->marriage_type === 'Christian' || $marriage->marriage_type === 'Other')
        <div class="section-header">৫. ধর্মীয় ও কাবিননামা সংক্রান্ত তথ্য (Religious & Kabin Details)</div>
        <div class="profile-card">
            <div class="info-grid-2">
                @if($marriage->marriage_type === 'Islam')
                    <div class="info-row">
                        <span class="info-label">কাবিননামা নম্বর (Kabin No)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value"><strong>{{ $marriage->islam_kabin_number }}</strong></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">কনের উকিল (Bride Wakil)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->islam_bride_wakil_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">দেনমোহর পরিমাণ (Den Mohor)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value"><strong>৳{{ number_format($marriage->islam_den_mohor_amount, 2) }}</strong></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">বরের উকিল (Groom Wakil)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->islam_groom_wakil_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">মোহরানার ধরণ (Den Mohor Type)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->islam_den_mohor_type }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">নিবন্ধনকারী কাজী (Kazi Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->islam_kazi_name }} (লাইসেন্স: {{ $marriage->islam_kazi_license_no }})</span>
                    </div>
                @elseif($marriage->marriage_type === 'Hindu')
                    <div class="info-row">
                        <span class="info-label">মন্দিরের নাম (Temple Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->hindu_temple_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">কনের গোত্র (Bride Gotra)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->hindu_bride_gotra }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">পুরোহিতের নাম (Purohit Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->hindu_purohit_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">বরের গোত্র (Groom Gotra)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->hindu_groom_gotra }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">ধর্মীয় বিবাহ তারিখ (Ritual Date)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->hindu_marriage_ritual_date }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">সপ্তপদী সম্পন্ন? (Saptapadi)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->hindu_saptapadi_completed ? 'হ্যাঁ (Yes)' : 'না (No)' }}</span>
                    </div>
                @elseif($marriage->marriage_type === 'Christian')
                    <div class="info-row">
                        <span class="info-label">গীর্জার নাম (Church Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->christian_church_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">ঘোষণা প্রকাশ (Banns)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->christian_publication_of_banns }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">পাস্টর নাম (Pastor Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->christian_pastor_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">বিবাহ পরিচালনাকারী (Conducted By)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->christian_marriage_conducted_by }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">ম্যারেজ লাইসেন্স (License No)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->christian_marriage_license_no }}</span>
                    </div>
                @elseif($marriage->marriage_type === 'Other')
                    <div class="info-row">
                        <span class="info-label">ধর্মের নাম (Religion Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->other_religion_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">প্রতিষ্ঠানের নাম (Org Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->other_organization_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">ধর্মীয় নেতার নাম (Leader Name)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->other_religious_leader_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">অন্যান্য বিবরণ (Other Details)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->other_other_details }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">বিবাহের রীতি (Ceremony Type)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->other_ceremony_type }}</span>
                    </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Section 6: Uploaded Legal Documents -->
        <div class="section-header">৬. সংযুক্ত আইনগত নথিপত্র (Attached Legal Documents)</div>
        <div class="profile-card">
            <div class="row">
                @if($marriage->doc_groom_nid)
                <div class="col-md-3 text-center mb-3">
                    <div class="font-weight-bold" style="font-size:12px;">বরের জাতীয় পরিচয়পত্র</div>
                    <a href="{{ asset($marriage->doc_groom_nid) }}" target="_blank">
                        <img src="{{ asset($marriage->doc_groom_nid) }}" class="attachment-img">
                    </a>
                </div>
                @endif

                @if($marriage->doc_bride_nid)
                <div class="col-md-3 text-center mb-3">
                    <div class="font-weight-bold" style="font-size:12px;">কনের জাতীয় পরিচয়পত্র</div>
                    <a href="{{ asset($marriage->doc_bride_nid) }}" target="_blank">
                        <img src="{{ asset($marriage->doc_bride_nid) }}" class="attachment-img">
                    </a>
                </div>
                @endif

                @if($marriage->doc_birth_certificate)
                <div class="col-md-3 text-center mb-3">
                    <div class="font-weight-bold" style="font-size:12px;">জন্ম নিবন্ধন সনদ</div>
                    <a href="{{ asset($marriage->doc_birth_certificate) }}" target="_blank">
                        <img src="{{ asset($marriage->doc_birth_certificate) }}" class="attachment-img">
                    </a>
                </div>
                @endif

                @if($marriage->doc_marriage_certificate_scan)
                <div class="col-md-3 text-center mb-3">
                    <div class="font-weight-bold" style="font-size:12px;">বিবাহের কাবিন স্ক্যান</div>
                    <a href="{{ asset($marriage->doc_marriage_certificate_scan) }}" target="_blank">
                        <img src="{{ asset($marriage->doc_marriage_certificate_scan) }}" class="attachment-img">
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
                        <span class="info-value"><strong>{{ $marriage->registrar_name }}</strong></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">লাইসেন্স নম্বর (License No)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->registrar_license }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">অফিসের ঠিকানা (Office Address)</span>
                        <span class="info-colon">:</span>
                        <span class="info-value">{{ $marriage->registrar_office_address }}</span>
                    </div>
                </div>
                <div class="col-md-4 text-center" style="display: flex; flex-direction: column; align-items: center; justify-content: center; border-left: 1px dashed #cbd5e1; padding-left: 20px;">
                    @if($marriage->registrar_office_seal)
                    <div class="mb-2">
                        <img src="{{ asset($marriage->registrar_office_seal) }}" style="max-height: 80px; object-fit: contain;">
                        <div class="font-weight-bold" style="font-size:11px;">অফিসিয়াল সিল (Parishad/Office Seal)</div>
                    </div>
                    @endif

                    @if($marriage->registrar_signature)
                    <div class="mt-2">
                        <img src="{{ asset($marriage->registrar_signature) }}" style="max-height: 60px; object-fit: contain;">
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
                <span class="badge badge-success">আইনসম্মত নিবন্ধিত (Registered)</span>
            </div>
            <div>
                <a href="{{ route('marriage.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to List</a>
                <button type="button" class="btn btn-info" onclick="window.print()"><i class="fas fa-print"></i> Print Details</button>
            </div>
        </div>

    </div>
</div>
@endsection
