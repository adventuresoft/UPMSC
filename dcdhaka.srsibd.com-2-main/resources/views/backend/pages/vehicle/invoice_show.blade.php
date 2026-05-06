@extends('backend.master', ['mainMenu' => 'Vehicle', 'subMenu' =>'VehicleGenerateInvoice'])

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

    /* Main license container */
    .trade-license-page {
        max-width: 1100px;
        margin: 0 auto;
        background: white;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        position: relative;
        overflow: visible;
        border-radius: 0px;
        border: 4px solid #556b2f;
        padding: 8px;
    }
    
    .inner-border {
        border: 2px solid #556b2f;
        padding: 8mm 12mm;
    }

    /* Header Logos and Title */
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
        font-size: 24px;
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

    /* Section Headers */
    .section-header {
        background: #006600;
        color: white;
        padding: 5px 10px;
        font-weight: bold;
        margin-bottom: 0px;
        margin-top: 15px;
        font-size: 14px;
    }

    /* Info Tables */
    .info-table {
        width: 100%;
        margin-bottom: 15px;
        border-collapse: collapse;
    }

    .info-table td {
        padding: 6px 10px;
        border: none;
        vertical-align: top;
    }

    .info-table td:first-child {
        font-weight: bold;
        width: 35%;
    }

    /* Fees Table */
    .fees-table {
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
    }

    .fees-table th,
    .fees-table td {
        border: none;
        padding: 6px 10px;
        vertical-align: middle;
    }

    .fees-table td:first-child {
        text-align: left;
        width: 60%;
    }

    .fees-table td:nth-child(2) {
        text-align: right;
        width: 40%;
    }

    /* Footer totals */
    .total-row {
        font-weight: bold;
        border-top: 1px solid #000;
    }

    /* Signature area */
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

    /* Simplified Info Layout */
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

    /* Fees Table from Screenshot */
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
    
    .fees-table-new td:nth-child(4) {
        text-align: right;
    }

    .fees-footer {
        background: #dcdcdc;
        font-weight: bold;
    }
    
    .total-final {
        background: #dcdcdc;
        color: black;
    }

    /* Print styles */
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
        .info-label {
            background-color: transparent !important;
            color: black !important;
        }
        .total-final, .fees-footer, .fees-table-new th {
            background-color: #dcdcdc !important;
            color: black !important;
            -webkit-print-color-adjust: exact;
        }
        .fees-table-new th, .fees-table-new td {
            border: 1px solid #333 !important;
        }
    }
</style>
@endpush

@section('title', 'Vehicle Invoice Details')

@section('content')
<div class="trade-license-page mt-4 mb-4">
    <div class="inner-border">
        @php
            $fallbackHeaderUnion = \App\Models\Institute::with('union.thana.district')
                ->whereNotNull('union_id')
                ->first()?->union;

            $headerUnion = $ownerOrganization?->Union
                ?? $ownerOrganization?->institute?->union
                ?? $ownerUser?->addressInfo?->presentUnion
                ?? $ownerUser?->addressInfo?->permanentUnion
                ?? $ownerUser?->institute?->union
                ?? auth()->user()?->institute?->union
                ?? $fallbackHeaderUnion;

            $headerThana = $ownerOrganization?->Thana
                ?? $headerUnion?->thana
                ?? $ownerOrganization?->officeThana
                ?? $ownerUser?->addressInfo?->presentThana
                ?? $ownerUser?->addressInfo?->permanentThana
                ?? auth()->user()?->institute?->union?->thana
                ?? $fallbackHeaderUnion?->thana;

            $headerDistrict = $ownerOrganization?->District
                ?? $headerThana?->district
                ?? $ownerOrganization?->officeDistrict
                ?? $ownerUser?->addressInfo?->presentDistrict
                ?? $ownerUser?->addressInfo?->permanentDistrict
                ?? auth()->user()?->institute?->union?->thana?->district
                ?? $fallbackHeaderUnion?->thana?->district;
        @endphp
        
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
            <div>নম্বর: <strong>{{ bnValue($vehicle->id ?? '') }}</strong></div>
            <div>তারিখ: {{ bnValue(date('d/m/Y', strtotime($vehicle->created_at))) }}</div>
        </div>

        <div class="license-title">
            <h3>যানবাহন ফিস (Invoice)</h3>
            <div class="tax-year">
               <!-- নবায়ন/নতুন  --> <br>
                অর্থ বছর: {{ bnValue($fee->finance_year ?? 'N/A') }}<br>
                <span style="font-size: 11px;">( স্থানীয় সরকার (ইউনিয়ন পরিষদ) আইন, ২০০৯ অনুযায়ী সরকার প্রণীত বিধি অনুযায়ী এই ফিস নির্ধারণ করা হলো )</span>
            </div>
        </div>

        <!-- Simplified Info Section -->
        <div class="invoice-info-simple">
            <div class="info-group">
                <div class="info-header">যানবাহন সংক্রান্ত তথ্য:</div>
                <div class="info-body">
                    যানবাহন আইডি নম্বর- {{ bnValue($vehicle->registration_id ?? $vehicle->id) }} , ধরন- {{ $vehicle->vehicle_category ?? $vehicle->vehicle_type ?? '' }}
                    {{-- <br>ইঞ্জিন নম্বর- {{ bnValue($vehicle->engine_number ?? '') }} , চ্যাসিস নম্বর- {{ bnValue($vehicle->chassis_number ?? '') }} , রং- {{ $vehicle->color ?? '' }} --}}
                </div>
            </div>

            <div class="info-group">
                <div class="info-header">
                    @if($vehicle->ownership_type === 'institutional')
                        প্রতিষ্ঠানের তথ্য:
                    @else
                        মালিকের তথ্য:
                    @endif
                </div>
                <div class="info-body">
                    @if($vehicle->ownership_type === 'institutional')
                        ট্রেড লাইসেন্স নং- {{ $vehicle->trade_license ?? '--' }} , নাম: {{ $vehicle->institutional_name ?? 'N/A' }}
                    @else
                        আইডি নং- {{ bnValue($vehicle->owner_id ?? '') }} , নাম: {{ $vehicle->owner_name ?? 'N/A' }}
                    @endif
                </div>
            </div>
        </div>

        <table class="fees-table-new">
            <thead>
                <tr>
                    <th>ক্রমিক নং</th>
                    <th>ফি এর বিষয়</th>
                    <th>বকেয়া</th>
                    <th>টাকা</th>
                </tr>
            </thead>
            <tbody>
                @if($fee)
                    <tr>
                        <td>১</td>
                        <td>নিবন্ধন ফি (Registration)</td>
                        <td></td>
                        <td>{{ currencyFormat($fee->registration_fee) ?? '০.০০' }}</td>
                    </tr>
                    <tr>
                        <td>২</td>
                        <td>রাস্তা ফি (Road)</td>
                        <td></td>
                        <td>{{ currencyFormat($fee->road_fee) ?? '০.০০' }}</td>
                    </tr>
                    <tr>
                        <td>৩</td>
                        <td>ফিটনেস ফি (Fitness)</td>
                        <td></td>
                        <td>{{ currencyFormat($fee->fitness_fee) ?? '০.০০' }}</td>
                    </tr>
                    <tr>
                        <td>৪</td>
                        <td>ভ্যাট (VAT)</td>
                        <td></td>
                        <td>{{ currencyFormat($fee->vat_fee) ?? '০.০০' }}</td>
                    </tr>
                    <tr>
                        <td>৫</td>
                        <td>ট্যাক্স (Tax)</td>
                        <td></td>
                        <td>{{ currencyFormat($fee->tax_fee) ?? '০.০০' }}</td>
                    </tr>
                    <tr class="fees-footer">
                        <td colspan="3" style="text-align: right; padding-right: 20px;">মোট:</td>
                        <td style="text-align: right;">{{ currencyFormat($fee->total_fee) ?? '০.০০' }}</td>
                    </tr>
                    <tr class="fees-footer total-final">
                        <td colspan="3" style="text-align: right; padding-right: 20px;">সর্বমোট:</td>
                        <td style="text-align: right;">{{ currencyFormat($fee->total_fee) ?? '০.০০' }}</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="4" class="text-center py-4">কোন ফি নির্ধারণ করা নেই</td>
                    </tr>
                @endif
            </tbody>
        </table>

        {{-- Signature Area --}}
        <div class="signature-area">
            <div class="sig-block">
                <div class="sig-line"></div>
                <div class="sig-text">লাইসেন্স ও বিজ্ঞাপন<br>সুপারভাইজার</div>
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
    <a href="{{ route('vehicle.invoice.list') }}" class="btn btn-secondary px-5 py-2 ms-3">
        <i class="fa fa-arrow-left"></i> Back to List
    </a>
</div>
@endsection
