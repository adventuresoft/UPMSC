@extends('backend.master', ['mainMenu' => 'Vehicle', 'subMenu' =>'VehicleLicense'])

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
        line-height: 1.5;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
        background: #f4f6f9;
    }

    .license-page {
        max-width: 1080px;
        margin: 0 auto;
        background: #fff;
        border: 4px solid #556b2f;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
        padding: 8px;
    }

    .license-inner {
        border: 2px solid #556b2f;
        padding: 8mm 12mm;
    }

    .header-logos {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 14px;
    }

    .header-logos img {
        width: 76px;
        height: 76px;
        object-fit: contain;
    }

    .union-header {
        text-align: center;
        flex: 1;
    }

    .union-title-bn {
        font-size: 21px;
        font-weight: 700;
        color: #006600;
        margin: 0;
    }

    .union-title-en {
        font-size: 16px;
        font-weight: 700;
        color: #2e3192;
        margin: 3px 0;
    }

    .meta-row {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        margin-bottom: 6px;
    }

    .license-title {
        text-align: center;
        margin: 10px 0 8px;
    }

    .license-title h3 {
        background: #006600;
        color: #fff;
        display: inline-block;
        padding: 8px 28px;
        font-size: 20px;
        font-weight: 700;
        border-radius: 4px;
        margin: 0;
    }

    .subtitle {
        text-align: center;
        margin-bottom: 14px;
        color: #333;
        font-size: 13px;
    }

    .section-card {
        border: 1px solid #d7d7d7;
        margin-top: 14px;
    }

    .section-title {
        background: #f2f6f2;
        color: #0f4d0f;
        font-weight: 700;
        padding: 8px 12px;
        font-size: 15px;
        border-bottom: 1px solid #d7d7d7;
    }

    .info-table {
        width: 100%;
        border-collapse: collapse;
    }

    .info-table td {
        border-bottom: 1px solid #ededed;
        padding: 6px 10px;
        vertical-align: top;
        font-size: 12px;
    }

    .info-table tr:last-child td {
        border-bottom: none;
    }

    .info-table .label-cell {
        width: 18%;
        font-weight: 700;
        color: #1f2d3d;
        background: #fbfbfb;
        white-space: nowrap;
    }

    .info-table .value-cell {
        width: 32%;
        color: #162536;
    }

    .info-table .full-label {
        width: 18%;
        font-weight: 700;
        color: #1f2d3d;
        background: #fbfbfb;
    }

    .info-table .full-value {
        width: 82%;
        color: #162536;
    }

    .signature-area {
        margin-top: 90px;
        display: flex;
        justify-content: space-between;
        text-align: center;
    }

    .sig-block {
        width: 210px;
    }

    .sig-line {
        border-top: 1px solid #333;
        margin-bottom: 6px;
    }

    .sig-text {
        font-size: 14px;
        line-height: 1.3;
        color: #333;
    }

    @media print {
        body {
            background: #fff;
        }

        .license-page,
        .license-inner {
            border: none;
            box-shadow: none;
        }

        .no-print,
        .card-footer,
        footer,
        .main-footer {
            display: none !important;
        }
    }
</style>
@endpush

@section('title', 'Vehicle License Details')

@section('content')
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

    $presentAddress = collect([
        $ownerUser?->addressInfo?->presentDistrict?->name ?? '',
        $ownerUser?->addressInfo?->presentThana?->name ?? '',
        $ownerUser?->addressInfo?->presentUnion?->name ?? '',
        $ownerUser?->addressInfo?->present_area ?? $ownerUser?->addressInfo?->present_area_bn ?? '',
        $ownerUser?->addressInfo?->presentRoad?->name ?? $ownerUser?->addressInfo?->present_road ?? '',
        $ownerUser?->addressInfo?->presentHouse?->house ?? $ownerUser?->addressInfo?->present_house ?? '',
    ])->filter()->implode(', ');

    $ownerName = $vehicle->ownership_type === 'institutional'
        ? ($vehicle->institutional_name ?? 'N/A')
        : ($ownerUser?->name ?? $vehicle->owner_name ?? 'N/A');

    $ownerCompactRows = [
        ['label' => 'মালিকানার ধরন', 'value' => ucfirst($vehicle->ownership_type ?? '--')],
        ['label' => 'নাম', 'value' => $ownerName],
        ['label' => 'আইডি নম্বর', 'value' => bnValue($vehicle->owner_id ?? $ownerUser?->system_id ?? '--')],
    ];

    if ($vehicle->ownership_type === 'institutional') {
        $ownerCompactRows[] = ['label' => 'ট্রেড লাইসেন্স নম্বর', 'value' => $vehicle->trade_license ?? '--'];
    } else {
        $ownerCompactRows[] = ['label' => 'জাতীয় পরিচয়পত্র', 'value' => $ownerUser?->nid ?? '--'];
        $ownerCompactRows[] = ['label' => 'মোবাইল নম্বর', 'value' => $ownerUser?->mobile ?? '--'];
    }

    $ownerAddressLabel = $vehicle->ownership_type === 'institutional' ? 'প্রতিষ্ঠানের ঠিকানা' : 'বর্তমান ঠিকানা';
    $ownerAddressValue = $vehicle->ownership_type === 'institutional'
        ? ($vehicle->institutional_address ?? '--')
        : ($presentAddress ?: '--');

    $vehicleCompactRows = [
        ['label' => 'যানবাহন আইডি', 'value' => bnValue($vehicle->registration_id ?? $vehicle->id)],
        ['label' => 'যানবাহনের ধরন', 'value' => $vehicle->vehicle_type ?? '--'],
        ['label' => 'ক্যাটাগরি', 'value' => $vehicle->vehicle_category ?? '--'],
        ['label' => 'মডেল', 'value' => $vehicle->vehicle_model ?? '--'],
        ['label' => 'প্রস্তুতকারক ও সাল', 'value' => ($vehicle->make_company ?? '--') . ($vehicle->make_year ? ' (' . $vehicle->make_year . ')' : '')],
        ['label' => 'ইঞ্জিন নম্বর', 'value' => $vehicle->engine_number ?? '--'],
        ['label' => 'চ্যাসিস নম্বর', 'value' => $vehicle->chassis_number ?? '--'],
        ['label' => 'ক্ষমতা ও আসন', 'value' => 'HP/CC: ' . ($vehicle->hp_cc ?? '--') . ', সিট: ' . ($vehicle->seat_capacity ?? '--')],
        ['label' => 'রং ও টায়ার', 'value' => 'রং: ' . ($vehicle->color ?? '--') . ', টায়ার: ' . ($vehicle->tyre_size ?? '--')],
    ];
@endphp

<div class="license-page mt-4 mb-4">
    <div class="license-inner">
        <div class="header-logos">
            <img src="{{ asset('images/dhaka.png') }}" alt="Left Logo">
            <div class="union-header">
                <h5 class="mb-0">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h5>
                <div class="union-title-bn">{{ $headerUnion?->bn_name ?? '' }}</div>
                <div class="union-title-en">{{ $headerUnion?->name ?? '' }}</div>
                <p class="mb-0">
                    থানাঃ {{ $headerThana?->bn_name ?? $headerThana?->name ?? '' }},
                    জেলাঃ {{ $headerDistrict?->bn_name ?? $headerDistrict?->name ?? '' }}, বাংলাদেশ।
                </p>
            </div>
            <img src="{{ asset('images/govt-bd-logo.png') }}" alt="Right Logo">
        </div>

        <div class="meta-row">
            <div>নম্বর: <strong>{{ bnValue($vehicle->registration_id ?? $vehicle->id) }}</strong></div>
            <div>তারিখ: {{ bnValue(date('d/m/Y', strtotime($vehicle->created_at))) }}</div>
        </div>

        <div class="license-title">
            <h3>যানবাহন লাইসেন্স / VEHICLE LICENSE</h3>
        </div>

        <div class="subtitle">
            যাচাইকৃত আবেদন ও অনুমোদিত তথ্যের ভিত্তিতে এই যানবাহন লাইসেন্স ইস্যু করা হলো।
        </div>

        <div class="section-card">
            <div class="section-title">যানবাহনের তথ্য</div>
            <table class="info-table">
                @foreach(collect($vehicleCompactRows)->chunk(2) as $pair)
                    @php($pair = $pair->values())
                    <tr>
                        <td class="label-cell">{{ $pair[0]['label'] }}</td>
                        <td class="value-cell">{{ $pair[0]['value'] }}</td>
                        @if(isset($pair[1]))
                            <td class="label-cell">{{ $pair[1]['label'] }}</td>
                            <td class="value-cell">{{ $pair[1]['value'] }}</td>
                        @else
                            <td class="label-cell"></td>
                            <td class="value-cell"></td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="section-card">
            <div class="section-title">মালিকের তথ্য</div>
            <table class="info-table">
                @foreach(collect($ownerCompactRows)->chunk(2) as $pair)
                    @php($pair = $pair->values())
                    <tr>
                        <td class="label-cell">{{ $pair[0]['label'] }}</td>
                        <td class="value-cell">{{ $pair[0]['value'] }}</td>
                        @if(isset($pair[1]))
                            <td class="label-cell">{{ $pair[1]['label'] }}</td>
                            <td class="value-cell">{{ $pair[1]['value'] }}</td>
                        @else
                            <td class="label-cell"></td>
                            <td class="value-cell"></td>
                        @endif
                    </tr>
                @endforeach
                <tr>
                    <td class="full-label">{{ $ownerAddressLabel }}</td>
                    <td class="full-value" colspan="3">{{ $ownerAddressValue }}</td>
                </tr>
            </table>
        </div>

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
    <a href="{{ route('vehicle.license.list') }}" class="btn btn-secondary px-5 py-2 ms-3">
        <i class="fa fa-arrow-left"></i> Back to List
    </a>
</div>
@endsection
