@extends('backend.master', ['mainMenu' => 'Tax', 'subMenu' =>'TaxList'])

@push('style')
<style>
    @page {
        size: A4 portrait;
        margin: 12mm 8mm;
    }

    html,
    body {
        margin: 0;
        padding: 0;
        font-family: 'Nikosh', 'Noto Sans Bengali', Arial, sans-serif;
        font-size: 13px !important;
        line-height: 1.4;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
        background: #f4f6f9;
    }

    .trade-license-page {
        max-width: 1100px;
        margin: 0 auto;
        background: white;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: visible;
        border-radius: 0;
        border: 4px solid #556b2f;
        padding: 8px;
    }

    .inner-border {
        border: 2px solid #556b2f;
        padding: 8mm 12mm;
    }

    .header-logos {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .header-logos img {
        width: 80px;
        height: 80px;
        object-fit: contain;
    }

    .union-header {
        text-align: center;
        flex: 1;
    }

    .union-title-bn {
        font-size: 20px;
        font-weight: bold;
        color: #006600;
        margin: 0;
    }

    .union-title-en {
        font-size: 16px;
        font-weight: bold;
        color: #2e3192;
        margin: 2px 0;
    }

    .union-address {
        margin: 0;
    }

    .license-title {
        text-align: center;
        margin: 15px 0 25px 0;
    }

    .license-title h3 {
        background: #006600;
        color: #fff;
        display: inline-block;
        padding: 8px 30px;
        font-size: 18px;
        font-weight: bold;
        border-radius: 4px;
        margin: 0;
    }

    .tax-year {
        font-size: 13px;
        color: #333;
        margin-top: 8px;
        line-height: 1.6;
    }

    .invoice-info-simple {
        margin-bottom: 25px;
        line-height: 1.8;
    }

    .info-group {
        display: flex;
        margin-bottom: 8px;
        align-items: flex-start;
    }

    .info-header {
        font-weight: bold;
        font-size: 15px;
        white-space: nowrap;
        margin-right: 5px;
    }

    .info-body {
        font-size: 14px;
        flex: 1;
    }

    .fees-table-new {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        table-layout: fixed;
    }

    .fees-table-new th,
    .fees-table-new td {
        border: 1px solid #333;
        padding: 8px 12px;
        font-size: 13px;
    }

    .fees-table-new th {
        background: #dcdcdc;
        color: black;
        text-align: center;
        font-weight: bold;
    }

    .fees-table-new th:nth-child(1),
    .fees-table-new td:nth-child(1) {
        width: 8%;
        text-align: center;
    }

    .fees-table-new th:nth-child(2),
    .fees-table-new td:nth-child(2) {
        text-align: left;
        width: 62%;
    }

    .fees-table-new th:nth-child(3),
    .fees-table-new td:nth-child(3) {
        width: 15%;
        text-align: center;
    }

    .fees-table-new th:nth-child(4),
    .fees-table-new td:nth-child(4) {
        width: 15%;
        text-align: center;
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
        display: flex;
        justify-content: space-between;
        text-align: center;
    }

    .sig-block {
        width: 200px;
    }

    .sig-line {
        border-top: 1px solid #333;
        margin-bottom: 5px;
    }

    .sig-text {
        font-size: 14px;
        line-height: 1.2;
        color: #333;
    }

    @media print {
        body {
            background: white;
        }

        .trade-license-page {
            box-shadow: none;
            border: none;
        }

        .inner-border {
            border: none;
        }

        .no-print,
        .card-footer,
        footer,
        .main-footer {
            display: none !important;
        }

        .fees-grand-total,
        .fees-total,
        .fees-table-new th {
            background-color: #f0f0f0 !important;
            color: black !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .fees-grand-total {
            background-color: #e8e8e8 !important;
        }

        .fees-table-new th,
        .fees-table-new td {
            border: 1px solid #333 !important;
        }
    }

    @media (max-width: 768px) {
        .info-group {
            flex-direction: column;
            margin-bottom: 14px;
        }

        .info-header {
            margin-right: 0;
            margin-bottom: 3px;
        }
    }
</style>
@endpush

@section('title', 'Tax Receipt Details')

@section('content')
@php
    $ownerUser = $tax->user;
    $ownerPeople = $ownerUser?->people;
    $ownerFamily = $ownerUser?->familyInfo;

    $ownerId = $tax->user_system_id ?? $ownerUser?->system_id ?? '--';
    $ownerName = $ownerPeople?->bn_name ?? $ownerUser?->name ?? '--';
    $ownerFatherName = $ownerFamily?->father_name_bn ?? '--';

    $taxYearName = $tax->taxYear?->bn_name ?? $tax->taxYear?->name ?? ($tax->year == 1 ? '2022-2023' : '2021-2022');
    
    $fallbackHeaderUnion = \App\Models\Institute::with('union.thana.district')
        ->whereNotNull('union_id')
        ->first()?->union;

    $headerUnion = $tax->user?->addressInfo?->presentUnion
        ?? $tax->user?->addressInfo?->permanentUnion
        ?? auth()->user()?->institute?->union
        ?? $fallbackHeaderUnion;

    $headerThana = $headerUnion?->thana
        ?? $tax->user?->addressInfo?->presentThana
        ?? $tax->user?->addressInfo?->permanentThana
        ?? auth()->user()?->institute?->union?->thana
        ?? $fallbackHeaderUnion?->thana;

    $headerDistrict = $headerThana?->district
        ?? $tax->user?->addressInfo?->presentDistrict
        ?? $tax->user?->addressInfo?->permanentDistrict
        ?? auth()->user()?->institute?->union?->thana?->district
        ?? $fallbackHeaderUnion?->thana?->district;

    $taxItems = [
        ['name' => 'বসতবাড়ির বাৎসরিক মূল্যের উপর কর', 'previous' => $tax->previous_residence_tax, 'current' => $tax->residence_tax],
        ['name' => 'ব্যবসা/পেশা/জীবিকার উপর কর', 'previous' => $tax->previous_income_tax, 'current' => $tax->income_tax],
        ['name' => 'সিনেমা/যাত্রা/থিয়েটার বা বিনোদেনমূলক অনুষ্ঠানের উপর কর', 'previous' => $tax->previous_entertainment_institute_tax, 'current' => $tax->entertainment_institute_tax],
        ['name' => 'লাইসেন্স ও পারমিট ফিস', 'previous' => $tax->previous_license_tax, 'current' => $tax->license_tax],
        ['name' => 'হাট-বাজার/ফেরিঘাট ও জলমহল ইজারা বাবদ ফি', 'previous' => $tax->previous_bazar_tax, 'current' => $tax->bazar_tax],
        ['name' => 'ভূমি/ইমারত ভাড়ার উপর কর', 'previous' => $tax->previous_land_tax, 'current' => $tax->land_tax],
        ['name' => 'নিলামে বিক্রয়লব্ধ আয়', 'previous' => $tax->previous_auction_tax, 'current' => $tax->auction_tax],
        ['name' => 'জরিমানা (যদি থাকে)', 'previous' => $tax->previous_fine, 'current' => $tax->fine],
        ['name' => 'অন্যান্য দাবি আদায় (যদি থাকে)', 'previous' => $tax->previous_others, 'current' => $tax->others],
        ['name' => 'বিবিধ', 'previous' => $tax->previous_extra, 'current' => $tax->extra],
    ];
@endphp

<div class="trade-license-page mt-4 mb-4">
    <div class="inner-border">
        <div class="header-logos">
            <img src="{{ asset('images/dhaka.png') }}" alt="Left Logo">
            <div class="union-header">
                <h5 class="mb-0">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h5>
                <div class="union-title-bn">{{ $headerUnion?->bn_name ?? '' }}</div>
                <div class="union-title-en">{{ $headerUnion?->name ?? '' }}</div>
                <p class="union-address">
                    থানাঃ {{ $headerThana?->bn_name ?? $headerThana?->name ?? '' }},
                    জেলাঃ {{ $headerDistrict?->bn_name ?? $headerDistrict?->name ?? '' }},
                    বাংলাদেশ।
                </p>
            </div>
            <img src="{{ asset('images/govt-bd-logo.png') }}" alt="Right Logo">
        </div>

        <div style="display: flex; justify-content: space-between; margin-bottom: -15px; position: relative; z-index: 10;">
            <div>আইডি নং: <strong>{{ bnValue($tax->system_id ?? $tax->id) }}</strong></div>
            <div>তারিখ: {{ bnValue(date('d/m/Y', strtotime($tax->updated_at ?? $tax->created_at))) }}</div>
        </div>

        <div class="license-title">
            <h3>কর রসিদ / TAX RECEIPT</h3>
            <div class="tax-year">
                <br>
                অর্থ বছর: {{ bnValue($taxYearName) }}<br>
                <span style="font-size: 11px;">( স্থানীয় সরকার (ইউনিয়ন পরিষদ) আইন, ২০০৯ অনুযায়ী সরকার প্রণীত বিধি অনুযায়ী এই কর নির্ধারণ করা হলো )</span>
            </div>
        </div>

        <div class="invoice-info-simple">
            <div class="info-group">
                <div class="info-header">মালিকের তথ্য:</div>
                <div class="info-body">
                    আইডি নং- {{ bnValue($ownerId) }},
                    নাম- {{ $ownerName }},
                    পিতার নাম- {{ $ownerFatherName }}
                </div>
            </div>

            <div class="info-group">
                <div class="info-header">ঠিকানা ও অন্যান্য:</div>
                <div class="info-body">
                    বাড়ি নং- {{ bnValue($tax->house?->house_bn ?? '--') }},
                    ব্লক/সেকশন- {{ bnValue($tax->house?->block_section ?? '--') }},
                    গ্রাম- {{ $tax->village?->bn_name ?? '--' }},
                    ওয়ার্ড- {{ bnValue($tax->unionWard?->bn_ward_no ?? '--') }}
                </div>
            </div>
        </div>

        <table class="fees-table-new">
            <thead>
                <tr>
                    <th>ক্রমিক নং</th>
                    <th>কর এর বিষয়</th>
                    <th>বকেয়া</th>
                    <th>বর্তমান কর</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalPrevious = 0;
                    $totalCurrent = 0;
                    $index = 1;
                @endphp
                @foreach($taxItems as $item)
                    @php 
                        $prev = (float)($item['previous'] ?? 0);
                        $curr = (float)($item['current'] ?? 0);
                        $totalPrevious += $prev;
                        $totalCurrent += $curr;
                    @endphp
                    <tr>
                        <td>{{ bnValue($index++) }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $prev > 0 ? bnValue(currencyFormat($prev)) : '--' }}</td>
                        <td>{{ $curr > 0 ? bnValue(currencyFormat($curr)) : '--' }}</td>
                    </tr>
                @endforeach
                <tr class="fees-total">
                    <td colspan="2" style="text-align: right; padding-right: 20px;">মোট:</td>
                    <td style="text-align: right;">{{ bnValue(currencyFormat($totalPrevious)) }}</td>
                    <td style="text-align: right;">{{ bnValue(currencyFormat($totalCurrent)) }}</td>
                </tr>
                <tr class="fees-grand-total">
                    <td colspan="2" style="text-align: right; padding-right: 20px;">সর্বমোট:</td>
                    <td colspan="2" style="text-align: right;">{{ bnValue(currencyFormat($totalPrevious + $totalCurrent)) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="signature-area">
            <div class="sig-block">
                <div class="sig-line"></div>
                <div class="sig-text">কর আদায়কারী</div>
            </div>
            <div class="sig-block">
                <div class="sig-line"></div>
                <div class="sig-text">সীল</div>
            </div>
            <div class="sig-block">
                <div class="sig-line"></div>
                <div class="sig-text">কর্তৃপক্ষ</div>
            </div>
        </div>
    </div>
</div>

<div class="no-print text-center my-4">
    <button class="btn btn-success px-5 py-2" onclick="window.print()">
        <i class="fa fa-print"></i> Print / প্রিন্ট
    </button>
    <a href="{{ route('tax.index') }}" class="btn btn-secondary px-5 py-2 ms-3">
        <i class="fa fa-arrow-left"></i> Back to List
    </a>
</div>
@endsection
