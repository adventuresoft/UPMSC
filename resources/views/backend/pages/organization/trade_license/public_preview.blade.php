<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ট্রেড লাইসেন্স যাচাই | Trade License Verify</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 0;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        html, body {
            background: #ffffff;
            font-family: 'Nikosh', 'Noto Sans Bengali', Arial, sans-serif;
            font-size: 13px;
            line-height: 1.35;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .certificate-page {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            position: relative;
            background: #ffffff;
            box-sizing: border-box;
        }

        .certificate-page::before {
            content: "";
            position: absolute;
            top: 12mm;
            left: 12mm;
            right: 12mm;
            bottom: 12mm;
            border: 4px double #2f684f;
            pointer-events: none;
            z-index: 1;
        }

        .certificate-content {
            position: relative;
            padding: 18mm 18mm 14mm 18mm;
            z-index: 2;
        }

        .header-logos {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }

        .header-text-block {
            text-align: center;
            margin-top: 15px;
        }

        .header-logos img {
            width: 64px;
            height: 64px;
            object-fit: contain;
        }

        .header-logos h6 {
            font-size: 14px;
            font-weight: bold;
            margin: 0 0 4px 0;
            padding: 0;
            line-height: 1;
        }

        .union-title {
            text-align: center;
            font-size: 26px;
            font-weight: bold;
            color: #006600;
            margin: 0 0 4px 0;
            line-height: 1;
        }

        .union-subtitle {
            text-align: center;
            font-size: 18px;
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
            font-size: 20px;
            font-weight: bold;
            padding: 4px 18px;
            border-radius: 4px;
            display: inline-block;
        }

        .validity-info {
            text-align: center;
            font-size: 12px;
            margin-bottom: 6px;
            margin-top: 6px;
        }

        .intro-text {
            font-size: 12px;
            line-height: 1.5;
            text-align: justify;
            margin: 12px 0;
        }

        .section-header {
            background: #006600;
            color: #fff;
            font-weight: bold;
            padding: 4px 8px;
            margin: 7px 0 4px;
            font-size: 12px;
        }

        .info-row {
            display: flex;
            margin-bottom: 2px;
            font-size: 12px;
        }

        .info-label {
            width: 190px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            padding-right: 10px;
        }

        .info-value {
            flex: 1;
            font-weight: bold;
            font-size: 12px;
        }

        .signature-area {
            margin-top: 38px;
            display: flex;
            justify-content: space-between;
            text-align: center;
            font-size: 12px;
        }

        .sig-block { width: 30%; }

        .sig-line {
            border-top: 1px solid #000;
            margin: 22px 0 4px;
        }

        .certificate-footer {
            margin-top: 10mm;
            font-size: 9px;
            color: #555;
        }

        @media print {
            @page {
                size: A4 portrait;
                margin: 0;
            }
            html, body {
                margin: 0;
                padding: 0;
                width: 210mm;
                background: #ffffff !important;
            }
            .certificate-page {
                width: 210mm;
                min-height: 297mm;
                margin: 0 !important;
            }
        }
    </style>
</head>
<body>

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

    $feeMapping = [
        'New Registration Charge' => 'নতুন নিবন্ধন ফি',
        'Yearly Charge'           => 'বার্ষিক ফি',
        'Renew Charge'            => 'নবায়ন ফি',
        'Signboard Fees'          => 'সাইনবোর্ড ফি',
        'Surcharge'               => 'সারচার্জ',
        'Others'                  => 'অন্যান্য',
        'VAT'                     => 'ভ্যাট',
        'TAX'                     => 'ট্যাক্স',
        'Fine'                    => 'জরিমানা',
        'Trade License Fee'       => 'ট্রেড লাইসেন্স ফি',
        'Business Tax'            => 'ব্যবসা কর',
        'Signboard Tax'           => 'সাইনবোর্ড কর',
        'Professional Tax'        => 'পেশা কর',
        'Sanitation Fee'          => 'স্যানিটেশন ফি',
        'Environmental Fee'       => 'পরিবেশ ফি',
        'Application Fee'         => 'আবেদন ফি',
        'Service Charge'          => 'সার্ভিস চার্জ',
        'Other Fee'               => 'অন্যান্য ফি',
        'Penalty'                 => 'জরিমানা',
    ];
@endphp

<div class="certificate-page">
    <div class="certificate-content">

        {{-- Header --}}
        <div class="header-logos">
            <img src="{{ asset('images/dhaka.png') }}" alt="Logo">
            <div class="header-text-block">
                <h6>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h6>
                <div class="union-title">{{ $license->organization->institute->union->bn_name ?? '৩নং শুকতাইল ইউনিয়ন পরিষদ' }}</div>
                <div class="union-subtitle">{{ $license->organization->institute->union->name ?? 'No. 3 Shukhtail Union Parishad' }}</div>
            </div>
            <img src="{{ asset('images/govt-bd-logo.png') }}" alt="BD Logo">
        </div>

        {{-- Document Header --}}
        <div class="doc-header">
            <div style="margin-top: 20px; text-align:center;">
                <img src="{{ 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . urlencode(route('trade-license.public-verify', $license->id)) }}"
                     style="width:80px;height:80px;object-fit:cover;"><br><br>
                <u style="font-size: 13px; font-weight: bold;">ট্রেড লাইসেন্স ইস্যুর তারিখ</u><br>
                <span style="font-size: 12px;">তারিখ: {{ bnValue(date('d/m/Y', strtotime($license->updated_at))) }}</span>
            </div>

            <div class="doc-title-block">
                <div class="doc-title">ট্রেড লাইসেন্স</div>
                <div class="validity-info">
                    নতুন<br>
                    অর্থ বছর: {{ $license->taxYear->name }}<br>
                    <span style="color: red;">এই ট্রেড লাইসেন্সের মেয়াদ {{ bnValue(trim($end)) }} সনের ৩০ জুন পর্যন্ত</span><br><br><br>
                    <span style="font-size: 16px;">ট্রেড লাইসেন্স নম্বর: <strong style="font-size: 18px;">{{ bnValue($license->system_id) }}</strong></span><br>
                </div>
            </div>

            <div style="text-align:right; margin-top: 20px;">
                <img src="{{ ($owner?->image || $owner?->people?->image) ? imageUrl($owner?->image ?? $owner?->people?->image) : asset('images/photo-placeholder.png') }}"
                     style="width:1.3in;height:1.5in;object-fit:cover; border:2px solid #000;">
            </div>
        </div>

        <p class="intro-text">
            স্থানীয় সরকার (প্রাদেশিক প্রশাসন) আইন, ২০০৯ (২০০৯ সনের ৬০ নং আইন) এর ধারা ৮৪ অনুযায়ী সরকার প্রণীত আদেশ ও বিধি অনুযায়ী, ২০১৬ সালের ১০ অনুচ্ছেদ অনুযায়ী অনুরূপ ব্যবসা, প্রতিষ্ঠান, দোকান বা শিল্পপ্রতিষ্ঠানের উপর আদায়কৃত কর এবং অন্যান্য ফি পরিশোধের ভিত্তিতে এই ট্রেড লাইসেন্সটি ইস্যু করা হলো।
        </p>

        {{-- Business Info --}}
        <div class="section-header">ব্যবসা প্রতিষ্ঠানের তথ্য</div>

        <div class="info-row">
            <span class="info-label"><span><span style="display:inline-block;width:30px;">১।</span>(ক) প্রতিষ্ঠানের নাম</span><span>:</span></span>
            <span class="info-value" style="font-weight:bold;font-size:13px;">{{ $license->organization->bn_name ?? $license->organization->name }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"><span><span style="display:inline-block;width:30px;"></span>(খ) প্রতিষ্ঠানের নাম (ইংরেজি)</span><span>:</span></span>
            <span class="info-value" style="font-weight:bold;font-size:13px;">{{ $license->organization->en_name ?? $license->organization->name }}</span>
        </div>

        @php
        $otherBusinessInfo = [
            '২। ব্যবসার ধরণ'              => $businessType,
            '৩। প্রতিষ্ঠানের ধরণ'          => $ownerships->count() == 1 ? 'একক প্রতিষ্ঠান' : 'পার্টনারশিপ',
            '৪। প্রতিষ্ঠানের মূলধন'         => bnValue(currencyFormat($organization?->capital ?? 0)),
            '৬। ব্যবসা প্রতিষ্ঠানের ঠিকানা' => $businessAddress,
        ];
        @endphp

        @foreach($otherBusinessInfo as $label => $value)
        <div class="info-row">
            <span class="info-label"><span>{{ $label }}</span><span>:</span></span>
            <span class="info-value">{{ $value }}</span>
        </div>
        @endforeach

        {{-- Owner Info --}}
        <div class="section-header">মালিকের তথ্য</div>

        <div class="info-row">
            <span class="info-label"><span><span style="display:inline-block;width:30px;">১।</span>(ক) মালিকের নাম</span><span>:</span></span>
            <span class="info-value">{{ $owner?->people?->bn_name }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"><span><span style="display:inline-block;width:30px;"></span>(খ) মালিকের নাম (ইংরেজি)</span><span>:</span></span>
            <span class="info-value">{{ $owner?->name ?? '--' }}</span>
        </div>

        @php
        $otherOwnerInfo = [
            '২। মালিকের আইডি'    => bnValue($owner?->system_id ?: '--'),
            '৩। মালিকের এনআইডি' => bnValue($owner?->people?->nid ?: ($owner?->nid ?: '--')),
            '৪। মোবাইল নম্বর'    => bnValue($owner?->mobile ?: '--'),
            '৫। ই-মেইল'          => $owner?->email ?: '--',
            '৬। মালিকের ঠিকানা'  => $ownerAddress,
        ];
        @endphp

        @foreach($otherOwnerInfo as $label => $value)
        <div class="info-row">
            <span class="info-label"><span>{{ $label }}</span><span>:</span></span>
            <span class="info-value">{{ $value }}</span>
        </div>
        @endforeach

        {{-- Fees --}}
        <div class="section-header">ব্যবসা প্রতিষ্ঠানের ফিস</div>

        <div style="margin-top:10px;">
            @if(!empty($fees))
                @foreach($fees as $feeHead => $amount)
                <div style="display:flex;margin-bottom:2px;font-size:13px;align-items:center;">
                    <div style="width:180px;display:flex;justify-content:space-between;font-weight:bold;">
                        <span>{{ bnValue($loop->iteration) }}। {{ $feeMapping[$feeHead] ?? $feeHead }}</span>
                        <span>:</span>
                    </div>
                    <div style="flex:1;text-align:right;padding-right:10px;font-weight:bold;">
                        {{ bnValue(currencyFormat((float) $amount)) }}/-
                    </div>
                </div>
                @endforeach

                <div style="display:flex;margin-top:8px;border-top:1px solid #333;padding-top:5px;font-size:15px;font-weight:bold;align-items:center;">
                    <div style="width:180px;display:flex;justify-content:space-between;">
                        <span>সর্বমোট</span><span>:</span>
                    </div>
                    <div style="flex:1;text-align:right;padding-right:10px;">
                        {{ bnValue(currencyFormat($totalFee)) }}/-
                    </div>
                </div>
            @else
                <div style="text-align:center;padding:8px 0;font-size:13px;">কোন ফি নির্ধারণ করা নেই</div>
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

        <div class="certificate-footer">
            This report generated by UPMS | Powered by <strong>Adventure Soft</strong>
        </div>

    </div>
</div>

<script>
    window.onload = function() { window.print(); };
</script>

</body>
</html>
