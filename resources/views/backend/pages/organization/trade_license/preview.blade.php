@extends('backend.master', ['mainMenu' => 'Organization', 'subMenu' => 'GetTradeLicense'])

@push('style')
<style>
    @page {
        size: A4 portrait;
        margin: 0;
    }

  /* html,
    body {
        margin: 0;
        padding: 0;
        font-family: 'Nikosh', 'Noto Sans Bengali', Arial, sans-serif;
        font-size: 18px !important;
        line-height: 1.4;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    } */

    .header-logos {
        margin-top: -18px;
    }

    .certificate-page {
        width: 267mm;
        height: 374mm;
        margin: auto;
        position: relative;
        background: url('{{ asset("images/sucsesion.png") }}') no-repeat center;
        background-size: 267mm 374mm;
        overflow: hidden;
    }

    .certificate-content {
        position: absolute;
        padding: 10mm !important;
        top: 25mm;
        left: 20mm;
        right: 20mm;
        bottom: 20mm;
    }

    .header-logos {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .header-logos img {
        width: 80px;
        height: 80px;
        object-fit: contain;
    }

    .union-title {
        text-align: center;
        font-size: 25px;
        font-weight: bold;
        color: #006600;
    }

    .union-subtitle {
        text-align: center;
        font-size: 24px;
        color: #003366;
    }

    .doc-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        font-size: 13px;
        margin: 12px 0;
    }

    .doc-title-block {
        flex: 1;
        text-align: center;
    }

    .doc-title {
        background: #006600;
        color: #fff;
        font-size: 22px;
        font-weight: bold;
        padding: 6px 20px;
        border-radius: 4px;
        display: inline-block;
    }

    .validity-info {
        text-align: center;
        font-size: 13px;
        margin-bottom: 10px;
        margin-top: 10px;
    }

    .intro-text {
        font-size: 14px;
        line-height: 1.6;
        text-align: justify;
        margin: 15px 0 10px;
    }

    .section-header {
        background: #006600;
        color: #fff;
        font-weight: bold;
        padding: 6px 10px;
        margin: 12px 0 6px;
        font-size: 14px;
    }

    .info-row {
        display: flex;
        margin-bottom: 4px;
        font-size: 13px;
    }

    .info-label {
        width: 220px;
        font-weight: bold;
        display: flex;
        justify-content: space-between;
        padding-right: 15px;
    }

    .info-value {
        flex: 1;
    }

    .fees-table-new {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .fees-table-new th {
        background: #dcdcdc;
        color: black;
        padding: 8px;
        text-align: center;
        border: 1px solid #333;
        font-size: 14px;
    }

    .fees-table-new td {
        border: 1px solid #333;
        padding: 8px 12px;
        font-size: 13px;
        text-align: center;
    }

    .fees-table-new td:nth-child(2) {
        text-align: left;
        width: 50%;
    }

    .fees-table-new td:nth-child(3),
    .fees-table-new td:nth-child(4) {
        text-align: right;
        width: 20%;
    }

    .fees-total {
        background: #f8f8f8;
        font-weight: bold;
    }

    .fees-grand-total {
        background: #dcdcdc;
        font-weight: bold;
        color: black;
    }

    .signature-area {
        margin-top: 100px;
        bottom: 15mm;
        display: flex;
        justify-content: space-between;
        text-align: center;
    }

    .sig-block {
        width: 30%;
    }

    .sig-line {
        border-top: 1px solid #000;
        margin: 30px 0 5px;
    }

    @media print {
        @page {
            size: auto;
            margin: 0;
        }
        body {
            margin: 0;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        .no-print, .main-footer, .navbar, .sidebar {
            display: none !important;
        }
        .certificate-page {
            margin: 0 !important;
            box-shadow: none !important;
            border: none !important;
        }
    }

    .fees-total {
        background: #f8f8f8;
        font-weight: bold;
    }

    .main-footer {
        display: none;
    }
</style>
@endpush

@section('title','Trade License Preview')

@section('content')

@php
    $organization = $license->organization;
    $ownerships = $organization?->ownership ?? collect();
    $owner = $ownerships->firstWhere('is_trade_license', true)?->user
        ?? $ownerships->firstWhere('is_trade_license', 1)?->user
        ?? $ownerships->first()?->user;
    
    $ownerAddress = $owner?->people?->bn_address ?? $owner?->people?->address;
    if (!$ownerAddress && $owner?->addressInfo) {
        $addr = $owner->addressInfo;
        $ownerAddress = collect([
            $addr->permanent_house ? 'বাড়ী নং: ' . $addr->permanent_house : null,
            $addr->permanent_road ? 'রাস্তা: ' . $addr->permanent_road : null,
            $addr->permanentVillage?->bn_name ?? $addr->permanentVillage?->name,
            $addr->permanentUnion?->bn_name ?? $addr->permanentUnion?->name,
            $addr->permanentThana?->bn_name ?? $addr->permanentThana?->name,
            $addr->permanentDistrict?->bn_name ?? $addr->permanentDistrict?->name,
        ])->filter()->implode(', ');
    }
    $ownerAddress = $ownerAddress ?: '--';
    
    $businessType = $organization?->subcategory?->bn_name 
        ?? $organization?->subcategory?->name 
        ?? $organization?->category?->bn_name 
        ?? $organization?->category?->name 
        ?? '--';

    $businessAddress = $organization?->address 
        ?? collect([
            $organization?->village?->bn_name ?? $organization?->village?->name,
            $organization?->Union?->bn_name ?? $organization?->Union?->name,
            $organization?->Thana?->bn_name ?? $organization?->Thana?->name,
            $organization?->District?->bn_name ?? $organization?->District?->name,
        ])->filter()->implode(', ');
    $businessAddress = $businessAddress ?: '--';

    $fees = json_decode($license->fees ?? '{}', true) ?? [];
    $totalFee = 0;
    foreach ($fees as $amount) {
        $totalFee += (float) $amount;
    }

    if (!empty($license->taxYear?->name) && str_contains($license->taxYear->name, '-')) {
        [$start, $end] = explode('-', $license->taxYear->name);
    } else {
        $start = '';
        $end = '';
    }
@endphp

<div class="certificate-page">
    <div class="certificate-content">

        {{-- Header Logos --}}
        <div class="header-logos">
            <img src="{{ asset('images/dhaka.png') }}">
            <div>
                <h6 class="text-center">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h6>
                <div class="union-title">৩নং শুকতাইল ইউনিয়ন পরিষদ</div>
                <div class="union-subtitle">No. 3 Shukhtail Union Parishad</div>
            </div>
            <img src="{{ asset('images/govt-bd-logo.png') }}">
        </div>

        {{-- Document Header --}}
        <div class="doc-header">
            <div style="margin-top: 20px;">
               
                <img src="{{ $license->scan_image ?? asset('images/scanner.png') }}" style="width:80px;height:80px;object-fit:cover;"><br><br>
                
                <u style="font-size: 15px; font-weight:;">ট্রেড লাইসেন্স ইস্যুর তারিখ</u><br>
                তারিখ: {{ bnValue(date('d/m/Y', strtotime($license->updated_at))) }}
            </div>

            <div class="doc-title-block">
                <div class="doc-title">ট্রেড লাইসেন্স</div>
                <div class="validity-info">
                    নতুন<br>
                    অর্থ বছর: {{ $license->taxYear->name }} <br>
                    এই ট্রেড লাইসেন্সের মেয়াদ {{ bnValue(trim($end)) }} সনের ৩০ জুন পর্যন্ত <br><br><br>
                    নম্বর: <strong>{{ bnValue($license->system_id) }}</strong><br>
                </div>
            </div>

            <div style="text-align:right">
                
                <img src="{{ ($owner?->image || $owner?->people?->image) ? asset($owner?->image ?? $owner?->people?->image) : asset('images/photo-placeholder.png') }}" style="width:1.5in;height:1.9in;object-fit:cover; border:2px solid #000;">
            </div>
        </div>

        <p class="intro-text">
            স্থানীয় সরকার (প্রাদেশিক প্রশাসন) আইন, ২০০৯ (২০০৯ সনের ৬০ নং আইন) এর ধারা ৮৪ অনুযায়ী সরকার প্রণীত আদেশ ও বিধি অনুযায়ী, ২০১৬ সালের ১০ অনুচ্ছেদ অনুযায়ী অনুরূপ ব্যবসা, প্রতিষ্ঠান, দোকান বা শিল্পপ্রতিষ্ঠানের উপর আদায়কৃত কর এবং অন্যান্য ফি পরিশোধের ভিত্তিতে এই ট্রেড লাইসেন্সটি ইস্যু করা হলো।
        </p>

        {{-- Business Info --}}
        <div class="section-header">ব্যবসা প্রতিষ্ঠানের তথ্য</div>
        
        <div class="info-row">
            <span class="info-label"><span><span style="display:inline-block; width:30px;">১।</span> (ক) প্রতিষ্ঠানের নাম</span> <span>:</span></span>
            <span class="info-value" style="font-weight: bold; font-size: 13px;">{{ $license->organization->bn_name ?? $license->organization->name }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"><span><span style="display:inline-block; width:30px;"></span> (খ) প্রতিষ্ঠানের নাম (ইংরেজি)</span> <span>:</span></span>
            <span class="info-value" style="font-weight: bold; font-size: 13px;">{{ $license->organization->en_name ?? $license->organization->name }}</span>
        </div>

        @php
        $otherBusinessInfo = [
            '২। ব্যবসার ধরণ' => $businessType,
            '৩। প্রতিষ্ঠানের ধরণ' => $ownerships->count() == 1 ? 'একক প্রতিষ্ঠান' : 'পার্টনারশিপ',
            '৪। প্রতিষ্ঠানের মূলধন' => bnValue(currencyFormat($organization?->capital ?? 0)),
            '৬। ব্যবসা প্রতিষ্ঠানের ঠিকানা' => $businessAddress
        ];
        @endphp

        @foreach($otherBusinessInfo as $label => $value)
        <div class="info-row">
            <span class="info-label"><span>{{ $label }}</span> <span>:</span></span>
            <span class="info-value">{{ $value }}</span>
        </div>
        @endforeach

        {{-- Owner Info --}}
        <div class="section-header">মালিকের তথ্য</div>
        
        <div class="info-row">
            <span class="info-label"><span><span style="display:inline-block; width:30px;">১।</span> (ক) মালিকের নাম</span> <span>:</span></span>
            <span class="info-value">{{ $owner?->people?->bn_name }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"><span><span style="display:inline-block; width:30px;"></span> (খ) মালিকের নাম (ইংরেজি)</span> <span>:</span></span>
            <span class="info-value">{{ $owner?->name ?? '--' }}</span>
        </div>

        @php
        $otherOwnerInfo = [
            '২। মালিকের আইডি' => bnValue($owner?->system_id ?: '--'),
            '৩। মালিকের এনআইডি' => bnValue($owner?->people?->nid ?: ($owner?->nid ?: '--')),
            '৪। মোবাইল নম্বর' => bnValue($owner?->mobile ?: '--'),
            '৫। ই-মেইল' => $owner?->email ?: '--',
            '৬। মালিকের ঠিকানা' => $ownerAddress ?: '--'
        ];
        @endphp

        @foreach($otherOwnerInfo as $label => $value)
        <div class="info-row">
            <span class="info-label"><span>{{ $label }}</span> <span>:</span></span>
            <span class="info-value">{{ $value }}</span>
        </div>
        @endforeach

        <div class="section-header">ব্যবসা প্রতিষ্ঠানের ফিস</div>
        @php
            $feeMapping = [
                'New Registration Charge' => 'নতুন নিবন্ধন ফি',
                'Yearly Charge' => 'বার্ষিক ফি',
                'Renew Charge' => 'নবায়ন ফি',
                'Signboard Fees' => 'সাইনবোর্ড ফি',
                'Surcharge' => 'সারচার্জ',
                'Others' => 'অন্যান্য',
                'VAT' => 'ভ্যাট',
                'TAX' => 'ট্যাক্স',
                'Fine' => 'জরিমানা',
                'Trade License Fee' => 'ট্রেড লাইসেন্স ফি',
                'Business Tax' => 'ব্যবসা কর',
                'Signboard Tax' => 'সাইনবোর্ড কর',
                'Professional Tax' => 'পেশা কর',
                'Sanitation Fee' => 'স্যানিটেশন ফি',
                'Environmental Fee' => 'পরিবেশ ফি',
                'Application Fee' => 'আবেদন ফি',
                'Service Charge' => 'সার্ভিস চার্জ',
                'Other Fee' => 'অন্যান্য ফি',
                'Penalty' => 'জরিমানা',
            ];
        @endphp

        <div style="margin-top: 10px;">
            @if(!empty($fees))
                @foreach($fees as $feeHead => $amount)
                    <div style="display: flex; margin-bottom: 2px; font-size: 14px; align-items: center;">
                        <div style="width: 180px; display: flex; justify-content: space-between; font-weight: bold;">
                            <span>{{ bnValue($loop->iteration) }}। {{ $feeMapping[$feeHead] ?? $feeHead }}</span>
                            <span>:</span>
                        </div>
                        <div style="flex: 1; text-align: right; padding-right: 10px;">
                            {{ bnValue(currencyFormat((float) $amount)) }}/-
                        </div>
                    </div>
                @endforeach
                
                <div style="display: flex; margin-top: 8px; border-top: 1px solid #333; padding-top: 5px; font-size: 15px; font-weight: bold; align-items: center;">
                    <div style="width: 180px; display: flex; justify-content: space-between;">
                        <span>সর্বমোট</span>
                        <span>:</span>
                    </div>
                    <div style="flex: 1; text-align: right; padding-right: 10px;">
                        {{ bnValue(currencyFormat($totalFee)) }}/-
                    </div>
                </div>
            @else
                <div class="text-center py-2" style="font-size: 13px;">কোন ফি নির্ধারণ করা নেই</div>
            @endif
        </div>


        {{-- Signature --}}
        <div class="signature-area">
            @foreach(['লাইসেন্স ও বিজ্ঞাপন সুপারভাইজার', 'সীল', 'কর্তৃপক্ষ'] as $sign)
            <div class="sig-block">
                <div class="sig-line"></div>
                {{ $sign }}
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Buttons --}}
<div class="no-print text-center my-4">
    <button class="btn btn-success px-5 py-2" onclick="window.print()">Print</button>
    <a href="{{ route('organizationA.trade-license.index') }}" class="btn btn-secondary px-5 py-2 ms-3">Back</a>
</div>

@push('script')
<script>
    $(document).ready(function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('print')) {
            window.print();
        }
    });
</script>
@endpush

@endsection
