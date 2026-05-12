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
        font-size: 22px;
        font-weight: bold;
        color: #006600;
    }

    .union-subtitle {
        text-align: center;
        font-size: 15px;
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

    .main-footer {
        display: none;
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
        body {
            margin: 0;
        }

        .no-print {
            display: none !important;
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

    // IMPORTANT: এখানে তোমার actual approval condition বসাবে
    $isApproved = ($license->status==2 ?? null) == 1;
@endphp

<div class="certificate-page">
    <div class="certificate-content">
        @if(!$organization)
            <div class="alert alert-warning no-print" style="font-size:13px;">
                এই ট্রেড লাইসেন্সের সাথে যুক্ত প্রতিষ্ঠানের তথ্য পাওয়া যায়নি। কিছু তথ্য ফাঁকা থাকতে পারে।
            </div>
        @endif

        <div class="header-logos">
            <img src="{{ asset('images/dhaka.png') }}">
            <div>
                <h6 class="text-center">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h6>
                <div class="union-title">৩নং শুকতাইল ইউনিয়ন পরিষদ</div>
                <div class="union-subtitle">No. 3 Shukhtail Union Parishad</div>
            </div>
            <img src="{{ asset('images/govt-bd-logo.png') }}">
        </div>

        <div class="doc-header">
            <div style="margin-top: 20px;">
                নম্বর: <strong>{{ bnValue($license->system_id) }}</strong><br>
                <img src="{{ $license->scan_image ?? asset('images/scanner.png') }}" style="width:80px;height:80px;object-fit:cover;">
            </div>

            <div class="doc-title-block">
                <div class="doc-title">ট্রেড লাইসেন্স</div>
                <div class="validity-info">
                    নবায়ন/নতুন <br>
                    অর্থ বছর: {{ $license->taxYear?->name ?? '--' }} <br>
                    এই ট্রেড লাইসেন্সের মেয়াদ {{ bnValue(trim($end)) }} সনের ৩০ জুন পর্যন্ত
                </div>
            </div>

            <div style="text-align:right">
                তারিখ: {{ bnValue(date('d/m/Y', strtotime($license->updated_at))) }}<br>
                <img src="{{ ($owner?->image || $owner?->people?->image) ? asset($owner?->image ?? $owner?->people?->image) : asset('images/photo-placeholder.png') }}" style="width:1.5in;height:1.9in;object-fit:cover; border:1px solid #ddd;">
            </div>
        </div>

        <p class="intro-text">
            স্থানীয় সরকার (প্রাদেশিক প্রশাসন) আইন, ২০০৯ (২০০৯ সনের ৬০ নং আইন) এর ধারা ৮৪ অনুযায়ী সরকার প্রণীত আদেশ ও বিধি অনুযায়ী, ২০১৬ সালের ১০ অনুচ্ছেদ অনুযায়ী অনুরূপ ব্যবসা, প্রতিষ্ঠান, দোকান বা শিল্পপ্রতিষ্ঠানের উপর আদায়কৃত কর এবং অন্যান্য ফি পরিশোধের ভিত্তিতে এই ট্রেড লাইসেন্সটি ইস্যু করা হলো।
        </p>

        <div class="section-header">ব্যবসা প্রতিষ্ঠানের তথ্য</div>

        <div class="info-row">
            <span class="info-label"><span style="display:inline-block; width:30px;">১।</span> (ক) প্রতিষ্ঠানের নাম :</span>
            <span class="info-value">{{ $organization?->bn_name ?? ($organization?->name ?? '--') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"><span style="display:inline-block; width:30px;"></span> (খ) প্রতিষ্ঠানের নাম (ইংরেজি) :</span>
            <span class="info-value">{{ $organization?->en_name ?? ($organization?->name ?? '--') }}</span>
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
                <span class="info-label">{{ $label }} :</span>
                <span class="info-value">{{ $value }}</span>
            </div>
        @endforeach

        <div class="section-header">মালিকের তথ্য</div>

        <div class="info-row">
            <span class="info-label"><span style="display:inline-block; width:30px;">১।</span> (ক) মালিকের নাম :</span>
            <span class="info-value">{{ $owner?->people?->bn_name }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"><span style="display:inline-block; width:30px;"></span> (খ) মালিকের নাম (ইংরেজি) :</span>
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
                <span class="info-label">{{ $label }} :</span>
                <span class="info-value">{{ $value }}</span>
            </div>
        @endforeach

        <div class="section-header">ব্যবসা প্রতিষ্ঠানের ফিস</div>
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
                @if(!empty($fees))
                    @foreach($fees as $feeHead => $amount)
                        <tr>
                            <td>{{ bnValue($loop->iteration) }}</td>
                            <td>{{ $feeHead }}</td>
                            <td></td>
                            <td>{{ currencyFormat((float) $amount) }}</td>
                        </tr>
                    @endforeach
                    <tr class="fees-total">
                        <td colspan="3" style="text-align: right; padding-right: 20px;">মোট:</td>
                        <td style="text-align: right;">{{ currencyFormat($totalFee) }}</td>
                    </tr>
                    <tr class="fees-grand-total">
                        <td colspan="3" style="text-align: right; padding-right: 20px;">সর্বমোট:</td>
                        <td style="text-align: right;">{{ currencyFormat($totalFee) }}</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="4" class="text-center py-4">কোন ফি নির্ধারণ করা নেই</td>
                    </tr>
                @endif
            </tbody>
        </table>


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
