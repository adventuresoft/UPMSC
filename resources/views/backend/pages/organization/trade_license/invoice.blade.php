@extends('backend.master', ['mainMenu' => 'Organization', 'subMenu' => 'TradeLicense'])

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

@section('title', 'Organization Invoice Details')

@section('content')
@php
    $organization = $license->organization;
    $ownerships = $organization?->ownership ?? collect();
    $ownerRecord = $ownerships->firstWhere('is_trade_license', true)
        ?? $ownerships->firstWhere('is_trade_license', 1)
        ?? $ownerships->first();
    $ownerUser = $ownerRecord?->user;
    $ownerPeople = $ownerUser?->people;

    $organizationId = $organization?->approved_id ?? $organization?->application_id ?? $organization?->system_id ?? '--';
    $ownerId = $ownerPeople?->approved_id ?? $ownerUser?->system_id ?? $ownerRecord?->system_id ?? '--';
    $ownerName = $ownerUser?->name ?? $ownerRecord?->user_name ?? '--';

    $organizationAddress = collect([
        $organization?->house_bn ? 'বাড়ি: ' . $organization->house_bn : ($organization?->house ? 'বাড়ি: ' . $organization->house : null),
        $organization?->road ? 'রোড: ' . $organization->road : null,
        $organization?->villageArea?->bn_name ? 'এলাকা: ' . $organization->villageArea->bn_name : null,
        $organization?->village?->bn_name ? 'গ্রাম: ' . $organization->village->bn_name : null,
    ])->filter()->implode(', ');
    $organizationAddress = $organizationAddress ?: '--';

    $organizationType = $organization?->type?->bn_name
        ?? $organization?->type?->en_name
        ?? $organization?->subcategory?->bn_name
        ?? $organization?->subcategory?->en_name
        ?? '--';

    $taxYearName = $license?->taxYear?->bn_name ?? $license?->taxYear?->name ?? 'N/A';
    $fees = json_decode($license->fees ?? '{}', true);
    $fees = is_array($fees) ? $fees : [];

    $totalFee = 0;
    foreach ($fees as $amount) {
        $totalFee += (float) $amount;
    }

    $isApproved = (int) ($license->status ?? 0) === 1;
    $isPaid = ($license->payment_status ?? 'unpaid') === 'paid';
    $canTakePayment = $isApproved && !$isPaid;
    $fallbackHeaderUnion = \App\Models\Institute::with('union.thana.district')
        ->whereNotNull('union_id')
        ->first()?->union;

    $headerUnion = $organization?->Union
        ?? $organization?->institute?->union
        ?? $ownerUser?->addressInfo?->presentUnion
        ?? $ownerUser?->addressInfo?->permanentUnion
        ?? $ownerUser?->institute?->union
        ?? auth()->user()?->institute?->union
        ?? $fallbackHeaderUnion;

    $headerThana = $organization?->Thana
        ?? $headerUnion?->thana
        ?? $organization?->officeThana
        ?? $ownerUser?->addressInfo?->presentThana
        ?? $ownerUser?->addressInfo?->permanentThana
        ?? auth()->user()?->institute?->union?->thana
        ?? $fallbackHeaderUnion?->thana;

    $headerDistrict = $organization?->District
        ?? $headerThana?->district
        ?? $organization?->officeDistrict
        ?? $ownerUser?->addressInfo?->presentDistrict
        ?? $ownerUser?->addressInfo?->permanentDistrict
        ?? auth()->user()?->institute?->union?->thana?->district
        ?? $fallbackHeaderUnion?->thana?->district;
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
            <div>নম্বর: <strong>{{ bnValue($license->system_id ?? $license->id) }}</strong></div>
            <div>তারিখ: {{ bnValue(date('d/m/Y', strtotime($license->updated_at ?? $license->created_at))) }}</div>
        </div>

        <div class="license-title">
            <h3>ট্রেড লাইসেন্স রসিদ / TRADE LICENSE INVOICE</h3>
            <div class="tax-year">
                <br>
                অর্থ বছর: {{ bnValue($taxYearName) }}<br>
                <span style="font-size: 11px;">( স্থানীয় সরকার (ইউনিয়ন পরিষদ) আইন, ২০০৯ অনুযায়ী সরকার প্রণীত বিধি অনুযায়ী এই ফিস নির্ধারণ করা হলো )</span>
            </div>
        </div>

        <div class="invoice-info-simple">
            <div class="info-group">
                <div class="info-header">প্রতিষ্ঠানের তথ্য:</div>
                <div class="info-body">
                    আইডি নম্বর- {{ bnValue($organizationId) }},
                    নাম- {{ $organization?->name ?? '--' }},
                    ধরণ- {{ $organizationType }}
                </div>
            </div>

            <div class="info-group">
                <div class="info-header">মালিকের তথ্য:</div>
                <div class="info-body">
                    আইডি নং- {{ bnValue($ownerId) }},
                    নাম- {{ $ownerName }}
                </div>
            </div>

            <div class="info-group">
                <div class="info-header">প্রতিষ্ঠান সংক্রান্ত তথ্য:</div>
                <div class="info-body">
                    আবেদন আইডি- {{ $organization?->application_id ?? '--' }},
                    অনুমোদন আইডি- {{ $organization?->approved_id ?? '--' }},
                    ঠিকানা- {{ $organizationAddress }}
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
    @if($canTakePayment)
        <button type="button" class="btn btn-primary px-5 py-2" id="showManualPaymentBtn">
            <i class="fa fa-credit-card"></i> Make Payment
        </button>
        <a href="{{ route('organizationA.trade-license.online-payment', $license->id) }}" class="btn btn-warning px-5 py-2 ms-2">
            <i class="fa fa-globe"></i> Online Payment
        </a>
    @elseif($isPaid)
        <span class="badge badge-success p-2" style="font-size: 14px;">Payment Completed</span>
    @endif

    <button class="btn btn-success px-5 py-2" onclick="window.print()">
        <i class="fa fa-print"></i> Print / প্রিন্ট
    </button>
    <a href="{{ route('organizationA.trade-license.index') }}" class="btn btn-secondary px-5 py-2 ms-3">
        <i class="fa fa-arrow-left"></i> Back to List
    </a>
</div>

@if($canTakePayment)
    <div class="no-print" id="manualPaymentBox" style="display:none; max-width: 900px; margin: 0 auto 20px; background: #fff; border: 1px solid #dee2e6; padding: 20px; border-radius: 6px;">
        <h5 class="mb-3">Manual Payment Information</h5>

        <form action="{{ route('organizationA.trade-license.manual-payment.store', $license->id) }}" method="POST">
            @csrf

            <div class="form-group row">
                <label class="col-md-3 col-form-label">Payment Details <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input type="text" name="payment_details" class="form-control" value="{{ old('payment_details') }}" placeholder="Enter payment details" required>
                    @error('payment_details')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label">Transaction ID <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input type="text" name="transaction_id" class="form-control" value="{{ old('transaction_id') }}" placeholder="Enter transaction id" required>
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
