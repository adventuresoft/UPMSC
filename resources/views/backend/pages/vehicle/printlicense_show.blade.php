<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Vehicle License</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
            background: #fff;
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
            font-size: 24px;
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
            font-weight: bold;
            font-size: 13px;
        }

        .signature-area {
            margin-top: 180px;
            bottom: 15mm;
            display: flex;
            justify-content: space-between;
            text-align: center;
        }

        .sig-block {
            width: 30%;
            font-size: 14px;
        }

        .sig-line {
            border-top: 1px solid #000;
            margin: 25px 0 5px;
        }

        .certificate-footer {
            position: absolute;
            bottom: 12mm;
            left: 16mm;
            font-size: 11px;
        }

        @media print {
            .no-print {
                display: none !important;
            }
            .certificate-page {
                margin: 0 !important;
                box-shadow: none !important;
                border: none !important;
            }
        }
    </style>
</head>
<body onload="window.print()">

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

    $ownerAddress = $vehicle->ownership_type === 'institutional'
        ? ($vehicle->institutional_address ?? '--')
        : ($presentAddress ?: '--');

    $ownerPhotoPath = $vehicle->ownership_type === 'institutional'
        ? ($ownerOrganization?->image ?? null)
        : ($ownerUser?->image ?? null);

    $ownerPhotoUrl = $ownerPhotoPath ? imageUrl($ownerPhotoPath) : asset('default.png');

    $totalFee = $fee ? $fee->total_fee : 0;
@endphp

<div class="certificate-page">
    <div class="certificate-content">
        <div class="header-logos">
            <img src="{{ asset('images/dhaka.png') }}">
            <div>
                <h6 class="text-center">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h6>
                <div class="union-title">{{ $headerUnion?->bn_name ?? '' }}</div>
                <div class="union-subtitle">{{ $headerUnion?->name ?? '' }}</div>
            </div>
            <img src="{{ asset('images/govt-bd-logo.png') }}">
        </div>

        <div class="doc-header">
            <div style="margin-top: 20px;">
                <img src="{{ $vehicle->scan_image ?? asset('images/scanner.png') }}" style="width:80px;height:80px;object-fit:cover;"><br><br>
                <u style="font-size: 16px;">লাইসেন্স ইস্যুর তারিখ</u><br>
                <span style="font-size: 15px;">তারিখ: {{ bnValue(date('d/m/Y', strtotime($vehicle->created_at))) }}</span>
            </div>

            <div class="doc-title-block">
                <div class="doc-title">যানবাহন লাইসেন্স</div>
                <div class="validity-info">
                    নতুন<br>
                    অর্থ বছর: {{ bnValue($fee->finance_year ?? 'N/A') }} <br><br><br>
                    <span style="font-size: 14px;">লাইসেন্স নম্বর: <strong>{{ bnValue($vehicle->registration_id) }}</strong></span><br>
                </div>
            </div>

            <div style="text-align:right">
                তারিখ: {{ bnValue(date('d/m/Y', strtotime($vehicle->created_at))) }}<br>
                <img src="{{ $ownerPhotoUrl }}" style="width:1.5in;height:1.9in;object-fit:cover; border:2px solid #000;" onerror="this.src='{{ asset('default.png') }}';">
            </div>
        </div>

        <p class="intro-text">
            স্থানীয় সরকার (ইউনিয়ন পরিষদ) আইন, ২০০৯ এর ধারা ৬৬ অনুযায়ী এই ইউনিয়ন পরিষদ কর্তৃক নির্ধারিত ফি আদায় সাপেক্ষে নিম্নবর্ণিত যানবাহন ও মালিকের অনুকূলে এই লাইসেন্সটি ইস্যু করা হলো।
        </p>

        <div class="section-header">যানবাহনের তথ্য</div>

        <div class="info-row">
            <span class="info-label"><span>১। যানবাহন আইডি</span> <span>:</span></span>
            <span class="info-value">{{ bnValue($vehicle->registration_id) }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"><span>২। Vehicles ধরন</span> <span>:</span></span>
            <span class="info-value">{{ $vehicle->vehicle_type ?? '--' }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"><span>৩। ক্যাটাগরি</span> <span>:</span></span>
            <span class="info-value">{{ $vehicle->vehicle_category ?? '--' }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"><span>৪। প্রস্তুতকারক ও সাল</span> <span>:</span></span>
            <span class="info-value">{{ ($vehicle->make_company ?? '--') . ($vehicle->make_year ? ' (' . $vehicle->make_year . ')' : '') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"><span>৫। ইঞ্জিন ও চ্যাসিস নম্বর</span> <span>:</span></span>
            <span class="info-value">ইঞ্জিন: {{ $vehicle->engine_number ?? '--' }} , চ্যাসিস: {{ $vehicle->chassis_number ?? '--' }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"><span>৬। ক্ষমতা ও আসন</span> <span>:</span></span>
            <span class="info-value">HP/CC: {{ $vehicle->hp_cc ?? '--' }} , সিট: {{ $vehicle->seat_capacity ?? '--' }}</span>
        </div>

        <div class="section-header">মালিকের তথ্য</div>

        <div class="info-row">
            <span class="info-label"><span>১। মালিকের নাম</span> <span>:</span></span>
            <span class="info-value">{{ $ownerName }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"><span>২। মালিকের আইডি</span> <span>:</span></span>
            <span class="info-value">{{ bnValue($vehicle->owner_id ?? $ownerUser?->system_id ?? '--') }}</span>
        </div>
        @if($vehicle->ownership_type === 'institutional')
            <div class="info-row">
                <span class="info-label"><span>৩। ট্রেড লাইসেন্স নম্বর</span> <span>:</span></span>
                <span class="info-value">{{ $vehicle->trade_license ?? '--' }}</span>
            </div>
        @else
            <div class="info-row">
                <span class="info-label"><span>৩। জাতীয় পরিচয়পত্র</span> <span>:</span></span>
                <span class="info-value">{{ bnValue($ownerUser?->nid ?? '--') }}</span>
            </div>
        @endif
        <div class="info-row">
            <span class="info-label"><span>৪। মোবাইল নম্বর</span> <span>:</span></span>
            <span class="info-value">{{ bnValue($ownerUser?->mobile ?? '--') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"><span>৫। মালিকের ঠিকানা</span> <span>:</span></span>
            <span class="info-value">{{ $ownerAddress }}</span>
        </div>

        <div class="section-header">যানবাহন ফিস</div>

        <div style="margin-top: 10px;">
            @if($fee)
                @php
                    $vehicleFeesList = [
                        'নিবন্ধন ফি (Registration)' => $fee->registration_fee,
                        'রাস্তা ফি (Road)' => $fee->road_fee,
                        'ফিটনেস ফি (Fitness)' => $fee->fitness_fee,
                        'ভ্যাট (VAT)' => $fee->vat_fee,
                        'ট্যাক্স (Tax)' => $fee->tax_fee,
                    ];
                @endphp
                @foreach($vehicleFeesList as $name => $amount)
                    <div style="display: flex; margin-bottom: 2px; font-size: 13px; align-items: center;">
                        <div style="width: 220px; display: flex; justify-content: space-between; font-weight: bold;">
                            <span>{{ bnValue($loop->iteration) }}। {{ $name }}</span>
                            <span>:</span>
                        </div>
                        <div style="flex: 1; text-align: right; padding-right: 10px; font-weight: bold;">
                            {{ bnValue(currencyFormat((float) $amount)) }}/-
                        </div>
                    </div>
                @endforeach
                
                <div style="display: flex; margin-top: 8px; border-top: 1px solid #333; padding-top: 5px; font-size: 15px; font-weight: bold; align-items: center;">
                    <div style="width: 220px; display: flex; justify-content: space-between;">
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

        <div class="signature-area">
            @foreach(['লাইসেন্স ও বিজ্ঞাপন সুপারভাইজার', 'সীল', 'কর্তৃপক্ষ'] as $sign)
                <div class="sig-block">
                    <div class="sig-line"></div>
                    {{ $sign }}
                </div>
            @endforeach
        </div>
    </div>

    <div class="certificate-footer">
        This report generated by UPMS | Powered by <strong>Adventure Soft</strong>
    </div>
</div>

<div class="no-print text-center my-4">
    <a href="{{ route('vehicle.license.list') }}" class="btn btn-secondary px-5 py-2">
        Back to License List
    </a>
</div>

</body>
</html>
