@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'NidCorrection'])

@push('style')
<style>
        .container {
        max-width: 100% !important;
    }

.form-container {
        width: 210mm;
        min-height: 297mm;
        padding: 15mm;
        margin: auto;
        background: white;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        font-family: 'Nikosh', sans-serif;
        color: #000;
        line-height: 1.4;
        position: relative;
    }

    .form-header {
        text-align: center;
        margin-bottom: 10px;
    }

    .form-title {
        font-weight: bold;
        font-size: 18px;
        text-decoration: underline;
        margin-bottom: 5px;
    }

    .form-subtitle {
        font-size: 14px;
        margin-bottom: 10px;
    }

    .staple-box {
        position: absolute;
        top: 20mm;
        right: 15mm;
        width: 40mm;
        height: 40mm;
        border: 1px solid #000;
        text-align: center;
        padding: 5px;
        font-size: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .nid-digits {
        display: inline-flex;
        border-left: 1px solid #000;
        margin-left: 10px;
    }

    .nid-digits span {
        width: 22px;
        height: 25px;
        border-top: 1px solid #000;
        border-right: 1px solid #000;
        border-bottom: 1px solid #000;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 14px;
    }

    .dotted-line {
        border-bottom: 1px dotted #000;
        display: inline-block;
        padding: 0 5px;
    }

    .table-correction {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .table-correction th, .table-correction td {
        border: 1px solid #000;
        padding: 5px;
        font-size: 13px;
    }

    .table-correction th {
        background: #f0f0f0;
        text-align: center;
    }

    .section-num {
        font-weight: bold;
        margin-top: 10px;
    }

        @media print {
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            box-sizing: border-box !important;
        }

        @page {
            size: A4 landscape;
            margin: 0 !important;
        }

        html, body {
            width: 297mm !important;
            height: 210mm !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden !important;
            background: #ffffff !important;
        }

        .container {
            width: 297mm !important;
            max-width: 297mm !important;
            height: 210mm !important;
            padding: 0 !important;
            margin: 0 !important;
            overflow: hidden !important;
        }

        

        .main-header,
        .main-sidebar,
        .main-footer,
        .content-header,
        .content-wrapper,
        .wrapper,
        .app-footer {
            display: none !important;
        }

        #printPageButton,
        #cancelPageButton,
        .btn {
            display: none !important;
        }
    }
</style>
@endpush

@section('title', 'NID Correction Form-2 (BN)')

@section('content')
@php
    // Fallback to user profile for pre-migration records with empty fields
    $displayName   = $certificate->applicant_name ?: ($certificate->user->name ?? '');
    $displayNid    = $certificate->applicant_nid ?: ($certificate->user->people->nid ?? '');
    $displayMobile = $certificate->applicant_mobile ?: ($certificate->user->mobile ?? '');
    $displayAddr   = $certificate->applicant_address ?: implode(', ', array_filter([
        $certificate->user->addressInfo->permanentVillage->bn_name ?? null,
        $certificate->user->institute->union->thana->bn_name ?? null,
        $certificate->user->institute->union->thana->district->bn_name ?? null,
    ]));
@endphp
<div class="container py-4">
    <div class="form-container">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div style="width: 40mm;"></div> <!-- spacer -->
            <div class="form-header flex-grow-1" style="margin-bottom: 0;">
                <p class="mb-0"><strong>ফরম-২</strong></p>
                <p class="mb-0" style="font-size: 12px;">[প্রবিধান ৪ দ্রষ্টব্য]</p>
                <h1 class="form-title">জাতীয় পরিচয়পত্র বা তথ্য-উপাত্ত<br>সংশোধনের আবেদন</h1>
            </div>
            <div class="staple-box" style="position: relative; top: 0; right: 0;">
                মূল জাতীয় পরিচয়পত্র এখানে সংযুক্ত করুন (স্ট্যাপল)
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <p class="mb-1">ক্রমিক নম্বর : <span class="dotted-line" style="min-width: 100px;">{{ bnValue($certificate->system_id) }}</span></p>
                <p class="mb-1" style="font-size: 11px;">(অফিস কর্তৃক পূরণীয়)</p>
            </div>
            <div class="col-6 text-right">
                <p class="mb-1">আবেদনের তারিখ : <span class="dotted-line" style="min-width: 120px;">{{ bnValue(date('d/m/Y', strtotime($certificate->created_at))) }}</span></p>
            </div>
        </div>

        <div class="section-num">১। জাতীয় পরিচয়পত্রধারীর -</div>
        <div class="pl-4">
            <div class="d-flex align-items-end mb-2">
                <span class="mr-2">(ক) নাম :</span>
                <div class="dotted-line flex-grow-1">{{ $displayName }}</div>
            </div>
            <div class="d-flex align-items-center">
                <span class="mr-2">(খ) জাতীয় পরিচিতি নম্বর (NID) :</span>
                <div class="nid-digits">
                    @php 
                        $nid = str_pad($displayNid, 17, ' ', STR_PAD_LEFT);
                        $digits = str_split($nid);
                    @endphp
                    @foreach($digits as $digit)
                        <span>{{ $digit != ' ' ? bnValue($digit) : '' }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="section-num">২। আঠারো বৎসরের কম বয়স্ক/আদালত কর্তৃক অপ্রকৃতিস্থ ঘোষিত জাতীয় পরিচয়পত্রধারীর ক্ষেত্রে, আইনানুগ অভিভাবকের -</div>
        <div class="pl-4">
            <div class="d-flex align-items-end mb-2">
                <span class="mr-2">(ক) নাম :</span>
                <div class="dotted-line flex-grow-1">{{ $certificate->guardian_name }}</div>
            </div>
            <div class="d-flex align-items-end">
                <span class="mr-2">(খ) জাতীয় পরিচিতি নম্বর (NID) :</span>
                <div class="dotted-line flex-grow-1">{{ bnValue($certificate->guardian_nid) }}</div>
            </div>
        </div>

        <div class="section-num">৩। জাতীয় পরিচয়পত্র বা সংরক্ষিত তথ্য-উপাত্তে যে তথ্য সংশোধন করিতে হইবে (অপ্রয়োজনীয় অংশ কাটিয়া দিন):</div>
        
        <table class="table-correction">
            <thead>
                <tr>
                    <th style="width: 15%;">বিষয়</th>
                    <th style="width: 35%;">বর্তমানে জাতীয় পরিচয়পত্র বা সংরক্ষিত তথ্য-উপাত্তে বিদ্যমান তথ্য</th>
                    <th style="width: 35%;">চাহিত সংশোধিত তথ্য</th>
                    <th style="width: 15%;">সংযুক্ত দলিলাদি/মন্তব্য</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $fields = [
                        'name_bn' => '(ক) নাম (বাংলা)',
                        'name_en' => '(খ) নাম (ইংরেজি)',
                        'father_name' => '(গ) পিতার নাম',
                        'mother_name' => '(ঘ) মাতার নাম',
                        'husband_name' => '(ঙ) স্বামীর নাম',
                        'dob' => '(চ) জন্মতারিখ',
                        'address' => '(ছ) ঠিকানা',
                        'blood_group' => '(জ) রক্তের গ্রুপ',
                        'others' => '(ঝ) অন্যান্য'
                    ];
                @endphp
                @foreach($fields as $key => $label)
                <tr>
                    <td>{{ $label }}</td>
                    <td>{{ $certificate->correction_data[$key]['old'] ?? '' }}</td>
                    <td>{{ $certificate->correction_data[$key]['new'] ?? '' }}</td>
                    <td>{{ isset($certificate->correction_data[$key]['active']) ? 'সংশোধন' : '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="section-num">৪। জমাকৃত ফি এর পরিমাণ (১১ এর উপ-প্রবিধান (১) এর ক্রমিক নং ১ বা, প্রযোজ্য ক্ষেত্রে, ২ এ উল্লিখিত ফি অনুসারে):</div>
        <p class="pl-4 mb-1"><span class="dotted-line" style="min-width: 200px;">{{ bnValue($certificate->payment_amount) }} টাকা</span></p>

        <div class="section-num">৫। প্রযোজ্য ক্ষেত্রে ফি জমা দানের রশিদ :</div>
        <p class="pl-4 mb-1"><span class="dotted-line" style="min-width: 200px;">{{ $certificate->payment_receipt_no }}</span></p>

        <div class="section-num">৬। আবেদনপত্রের সহিত সংযুক্ত দলিলাদির বিবরণ:</div>
        <p class="pl-4 mb-3"><span class="dotted-line" style="min-width: 90%;">{{ $certificate->attachments_list }}</span></p>

        <div class="row mt-5">
            <div class="col-6">
                <p class="mb-0">..................................................</p>
                <p class="mb-0"><strong>আইনানুগ অভিভাবকের স্বাক্ষর/টিপসহি (প্রযোজ্য ক্ষেত্রে)</strong></p>
                <p class="mb-0">নাম: <span class="dotted-line" style="min-width: 150px;">{{ $certificate->guardian_name }}</span></p>
                <p class="mb-0">ঠিকানা: <span class="dotted-line" style="min-width: 150px;"></span></p>
                <p class="mb-0">মোবাইল নম্বর: <span class="dotted-line" style="min-width: 150px;"></span></p>
                <p class="mb-0">ই-মেইল (যদি থাকে) : <span class="dotted-line" style="min-width: 150px;"></span></p>
            </div>
            <div class="col-6">
                <p class="mb-0">..................................................</p>
                <p class="mb-0"><strong>আবেদনকারীর স্বাক্ষর/টিপসহি</strong></p>
                <p class="mb-0">নাম: <span class="dotted-line" style="min-width: 150px;">{{ $displayName }}</span></p>
                <p class="mb-0">ঠিকানা: <span class="dotted-line" style="min-width: 150px;">{{ $displayAddr }}</span></p>
                <p class="mb-0">মোবাইল নম্বর: <span class="dotted-line" style="min-width: 150px;">{{ bnValue($displayMobile) }}</span></p>
                <p class="mb-0">ই-মেইল (যদি থাকে) : <span class="dotted-line" style="min-width: 150px;"></span></p>
            </div>
        </div>


    </div>

    <div class="text-center mt-4">
        <button id="cancelPageButton" class="btn btn-danger btn-sm px-4" onclick="window.location.href='{{ route('nid-correction.index') }}'">Cancel</button>
        <button id="printPageButton" class="btn btn-success btn-sm px-4 ms-2" onclick="window.print();">Print Form-2</button>
    </div>
</div>
@endsection