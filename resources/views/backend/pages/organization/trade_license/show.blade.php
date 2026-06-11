@extends('backend.master', ['mainMenu' => 'Organization', 'subMenu' => 'GetTradeLicense'])

@push('style')
<style>
    @page {
        size: A4 portrait;
        margin: 0;
    }

    html,
    body {
        margin: 0;
        padding: 0;
        font-family: 'Nikosh', 'Noto Sans Bengali', Arial, sans-serif;
        font-size: 18px !important;
        line-height: 1.4;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    .header-logos {
        margin-top: -18px;
    }

    .certificate-page {
        width: 210mm;
        height: 297mm;
        margin: auto;
        position: relative;
        background: url('{{ asset("images/sucsesion.png") }}') no-repeat center;
        background-size: 210mm 297mm;
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

    .header-text-block {
        margin-top: 15px;
    }

    .header-logos img {
        width: 80px;
        height: 80px;
        object-fit: contain;
    }

    .header-logos h6 {
        margin: 0 0 5px 0;
        padding: 0;
        line-height: 1;
    }

    .union-title {
        text-align: center;
        font-size: 30px;
        font-weight: bold;
        color: #006600;
        margin: 0 0 5px 0;
        line-height: 1;
    }

    .union-subtitle {
        text-align: center;
        font-size: 20px;
        color: #003366;
        margin: 0;
        line-height: 1;
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
        font-size: 13px;
        line-height: 1.5;
        text-align: justify;
        margin: 12px 0;
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
        font-weight: bold;
        font-size: 13px;
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

    .main-footer {
        display: none;
    }

    .certificate-footer {
        position: absolute;
        bottom: 12mm;
        left: 16mm;
        font-size: 11px;
    }

    .manual-payment-box {
        max-width: 900px;
        margin: 25px auto 0;
        background: #fff;
        border: 1px solid #dee2e6;
        padding: 20px;
        border-radius: 6px;
    }

    @media print {
        @page {
            size: A4 portrait;
            margin: 0;
        }
        html,
        body {
            margin: 0;
            padding: 0;
            width: 210mm;
            height: 297mm;
            background: #ffffff !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        body * {
            visibility: hidden !important;
        }
        .certificate-page,
        .certificate-page * {
            visibility: visible !important;
        }
        .no-print, .main-footer, .navbar, .sidebar, .main-sidebar, .main-header {
            display: none !important;
        }
        .wrapper,
        .content-wrapper,
        .content,
        .container-fluid {
            margin: 0 !important;
            margin-left: 0 !important;
            padding: 0 !important;
            width: 210mm !important;
            max-width: none !important;
            min-height: 0 !important;
            background: #ffffff !important;
        }
        .certificate-page {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            right: auto !important;
            bottom: auto !important;
            display: block !important;
            width: 210mm !important;
            height: 297mm !important;
            margin: 0 !important;
            border: none !important;
            box-sizing: border-box !important;
            box-shadow: none !important;
            overflow: hidden !important;
            transform: none !important;
            page-break-after: avoid;
            page-break-inside: avoid;
        }
        .certificate-content {
            top: 25mm !important;
            left: 20mm !important;
            right: 20mm !important;
            bottom: 20mm !important;
            padding: 10mm !important;
        }
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
            $addr->permanent_house ? 'বাড়ী নং: ' . $addr->permanent_house : null,
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

    // IMPORTANT: এখানে তোমার actual approval condition বসাবে
    $isApproved = ($license->status==2 ?? null) == 1;
@endphp

<div class="certificate-page">
    <div class="certificate-content">
        @if(!$organization)
            <div class="alert alert-warning no-print" style="font-size:13px;">
                এই ট্রেড লাইসেন্সের সাথে যুক্ত প্রতিষ্ঠানের তথ্য পাওয়া যায়নি। কিছু তথ্য ফাঁকা থাকতে পারে।
            </div>
        @endif

        <div class="header-logos">
            <img src="{{ asset('images/dhaka.png') }}">
            <div class="header-text-block" style="text-align: center; line-height: 1.1;">
                <div style="font-size: 14px; color: #000; margin-bottom: 4px;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</div>
                @php
                    $institute = $license->organization->institute;
                    $auth = $institute->union ?? ($institute->pourashava ?? $institute->cityCorporation);
                    $thanaBn = '';
                    $districtBn = '';
                    
                    if ($institute->union && $institute->union->thana) {
                        $thanaBn = $institute->union->thana->bn_name ?? '';
                        $districtBn = $institute->union->thana->district->bn_name ?? '';
                    } elseif ($institute->pourashava) {
                        $districtBn = $institute->pourashava->District->bn_name ?? '';
                    } elseif ($institute->cityCorporation) {
                        $districtBn = $institute->cityCorporation->District->bn_name ?? '';
                    }
                @endphp
                <div style="font-size: 20px; color: #006600; font-weight: bold; margin-bottom: 4px;">{{ $auth->bn_name ?? '৩নং শুকতাইল ইউনিয়ন পরিষদ' }}</div>
                <div style="font-size: 20px; color: #2e3192; font-weight: bold; margin-bottom: 4px;">{{ $auth->name ?? 'No. 3 Shukhtail Union Parishad' }}</div>
                <div style="font-size: 13px; color: #000;">
                    @if($thanaBn) উপজেলাঃ {{ $thanaBn }}, @endif
                    জেলাঃ {{ $districtBn }},
                    বাংলাদেশ।
                </div>
            </div>
            <img src="{{ asset('images/govt-bd-logo.png') }}">
        </div>

         {{-- Document Header --}}
        <div class="doc-header">
            <div style="margin-top: 20px;">
               
                <img src="{{ 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . urlencode(route('trade-license.public-verify', $license->id)) }}" style="width:80px;height:80px;object-fit:cover;"><br><br>
                
                <u style="font-size: 13px; font-weight: bold;">ট্রেড লাইসেন্স ইস্যুর তারিখ</u><br>
                <span style="font-size: 12px;">তারিখ: {{ bnValue(date('d/m/Y', strtotime($license->updated_at))) }}</span>
            </div>

            <div class="doc-title-block">
                <div class="doc-title">ট্রেড লাইসেন্স @if($license->organization->transferRequests()->where('status', 'approved')->exists()) <span style="font-size: 12px; background: #ff0000; color: #fff; padding: 2px 6px; border-radius: 4px; vertical-align: middle; margin-left: 5px;">Transferred</span> @endif</div>
                <div class="validity-info">
                    নতুন<br>
                    অর্থ বছর: {{ $license->taxYear->name }} <br>
                    <span style="color: red;">এই ট্রেড লাইসেন্সের মেয়াদ {{ bnValue(trim($end)) }} সনের ৩০ জুন পর্যন্ত</span> <br><br><br>
                    <span style="font-size: 16px;">নম্বর: <strong style="font-size: 18px;">{{ bnValue($license->system_id) }}</strong></span><br>
                </div>
            </div>

            <div style="text-align:right">
                তারিখ: {{ bnValue(date('d/m/Y', strtotime($license->updated_at))) }}<br>
                <img src="{{ ($owner?->image || $owner?->people?->image) ? imageUrl($owner?->image ?? $owner?->people?->image) : asset('images/photo-placeholder.png') }}" style="width:1.3in;height:1.5in;object-fit:cover; border:2px solid #000;">
            </div>
        </div>

        <p class="intro-text">
            স্থানীয় সরকার (প্রাদেশিক প্রশাসন) আইন, ২০০৯ (২০০৯ সনের ৬০ নং আইন) এর ধারা ৮৪ অনুযায়ী সরকার প্রণীত আদেশ ও বিধি অনুযায়ী, ২০১৬ সালের ১০ অনুচ্ছেদ অনুযায়ী অনুরূপ ব্যবসা, প্রতিষ্ঠান, দোকান বা শিল্পপ্রতিষ্ঠানের উপর আদায়কৃত কর এবং অন্যান্য ফি পরিশোধের ভিত্তিতে এই ট্রেড লাইসেন্সটি ইস্যু করা হলো।
        </p>

        <div class="section-header">ব্যবসা প্রতিষ্ঠানের তথ্য</div>

        <div class="info-row">
            <span class="info-label"><span><span style="display:inline-block; width:30px;">১।</span> (ক) প্রতিষ্ঠানের নাম</span> <span>:</span></span>
            <span class="info-value" style="font-weight: bold; font-size: 13px;">{{ $organization?->bn_name ?? ($organization?->name ?? '--') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"><span><span style="display:inline-block; width:30px;"></span> (খ) প্রতিষ্ঠানের নাম (ইংরেজি)</span> <span>:</span></span>
            <span class="info-value" style="font-weight: bold; font-size: 13px;">{{ $organization?->en_name ?? ($organization?->name ?? '--') }}</span>
        </div>

        @php
        $otherBusinessInfo = [
            '২। ব্যবসার ধরণ' => $businessType,
            '৩। প্রতিষ্ঠানের ধরণ' => $ownerships->count() == 1 ? 'একক প্রতিষ্ঠান' : ($ownerships->count() > 1 ? 'পার্টনারশিপ' : '--'),
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
                    <div style="display: flex; margin-bottom: 2px; font-size: 13px; align-items: center;">
                        <div style="width: 180px; display: flex; justify-content: space-between; font-weight: bold;">
                            <span>{{ bnValue($loop->iteration) }}। {{ $feeMapping[$feeHead] ?? $feeHead }}</span>
                            <span>:</span>
                        </div>
                        <div style="flex: 1; text-align: right; padding-right: 10px; font-weight: bold;">
                            {{ bnValue(currencyFormat((float) $amount)) }}
                        </div>
                    </div>
                @endforeach
                
                <div style="display: flex; margin-top: 8px; border-top: 1px solid #333; padding-top: 5px; font-size: 15px; font-weight: bold; align-items: center;">
                    <div style="width: 180px; display: flex; justify-content: space-between;">
                        <span>সর্বমোট</span>
                        <span>:</span>
                    </div>
                    <div style="flex: 1; text-align: right; padding-right: 10px;">
                        {{ bnValue(currencyFormat($totalFee)) }}
                    </div>
                </div>
            @else
                <div class="text-center py-2" style="font-size: 13px;">কোন ফি নির্ধারণ করা নেই</div>
            @endif
        </div>


        <div class="signature-area">
            @foreach(['লাইসেন্স ও বিজ্ঞাপন সুপারভাইজার', 'সীল', 'কর্তৃপক্ষ'] as $sign)
                <div class="sig-block">
                    <div class="sig-line"></div>
                    {{ $sign }}
                </div>
            @endforeach
        </div>
    </div>

    <!-- ================= Footer ================= -->
    <div class="certificate-footer">
        This report generated by CLMS | Powered by <strong>Adventure Soft</strong>
    </div>
</div>

<div class="no-print text-center my-4">
    @if($isApproved)
        <button type="button" class="btn btn-primary px-4 py-2 mr-2" id="showManualPaymentBtn">Manual Payment</button>

        <a href="{{ route('organizationA.trade-license.online-payment', $license->id) }}" class="btn btn-warning px-4 py-2 mr-2">
            Online Payment
        </a>

        <button type="button" class="btn btn-success px-4 py-2 mr-2" onclick="window.print()">Print</button>
    @endif

    <a href="{{ route('organizationA.trade-license.index') }}" class="btn btn-secondary px-4 py-2">Back</a>
</div>

@if($isApproved)
<div class="manual-payment-box no-print" id="manualPaymentBox" style="display:none;">
    <h4 class="mb-3">Manual Payment Information</h4>

    <form action="{{ route('organizationA.trade-license.manual-payment.store', $license->id) }}" method="POST">
        @csrf

        <div class="form-group row">
            <label class="col-md-3 col-form-label">Payment Details <span class="text-danger">*</span></label>
            <div class="col-md-9">
                <input type="text" name="payment_details" class="form-control" value="{{ old('payment_details') }}" placeholder="Enter payment details">
                @error('payment_details')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label">Transaction ID <span class="text-danger">*</span></label>
            <div class="col-md-9">
                <input type="text" name="transaction_id" class="form-control" value="{{ old('transaction_id') }}" placeholder="Enter transaction id">
                @error('transaction_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label">Note</label>
            <div class="col-md-9">
                <textarea name="note" class="form-control" rows="3" placeholder="Enter note">{{ old('note') }}</textarea>
                @error('note')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-info">Save Manual Payment</button>
        </div>
    </form>
</div>
@endif

@endsection

@push('script')
<script>
    $(document).ready(function () {
        $('#showManualPaymentBtn').on('click', function () {
            $('#manualPaymentBox').slideToggle();
        });
    });
</script>
@endpush
