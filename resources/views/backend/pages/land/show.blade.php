@extends('backend.master', ['mainMenu' => 'Land', 'subMenu' =>'LandList'])
@section('title', 'Land Details')

@push('style')
<style>
    html,
    body {
        margin: 0;
        padding: 0;
        font-family: 'Nikosh', 'Noto Sans Bengali', Arial, sans-serif;
        font-size: 14px !important;
        line-height: 1.4;
        background: #f4f6f9;
    }

    .people-certificate-page {
        max-width: 1100px;
        margin: 0 auto;
        background: white;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        position: relative;
        overflow: visible;
        border-radius: 4px;
        padding: 10mm 15mm;
    }

    .header-logos {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        border-bottom: 2px solid #006600;
        padding-bottom: 10px;
    }

    .header-logos img {
        width: 70px;
        height: 70px;
        object-fit: contain;
    }

    .union-header {
        text-align: center;
        flex: 1;
    }

    .union-title-bn {
        font-size: 22px;
        font-weight: bold;
        color: #006600;
        margin: 0;
    }

    .citizen-title {
        text-align: center;
        margin: 15px 0;
    }

    .citizen-title h4 {
        font-size: 22px;
        font-weight: bold;
        color: #006600;
        margin: 0;
        border-bottom: 2px dashed #006600;
        display: inline-block;
        padding-bottom: 5px;
    }

    .section-header {
        background: #006600;
        color: #fff;
        font-weight: bold;
        padding: 8px 15px;
        margin: 25px 0 15px 0;
        font-size: 16px;
        border-radius: 4px;
        letter-spacing: 1px;
    }

    .info-row {
        display: flex;
        margin-bottom: 10px;
        font-size: 15px;
        border-bottom: 1px dotted #e0e0e0;
        padding-bottom: 6px;
    }

    .info-label {
        display: inline-block;
        width: 140px;
        font-weight: bold;
        color: #2c3e4e;
    }

    .info-value {
        flex: 1;
        color: #1e2a36;
        margin-left: 10px;
    }

    .two-columns {
        display: flex;
        gap: 30px;
        margin-top: 15px;
    }

    .col {
        flex: 1;
    }

    .action-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px dashed #aaa;
    }

    .action-right {
        display: flex;
        gap: 10px;
    }

    @media print {
        .no-print {
            display: none !important;
        }

        .people-certificate-page {
            box-shadow: none;
            max-width: 100%;
            padding: 0;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="people-certificate-page">
        @php
            $headerUnion = auth()->user()?->institute?->union;
            $headerThana = $headerUnion?->thana;
            $headerDistrict = $headerThana?->district;
            $ownerUser = $land->owner_user;
        @endphp

        <div class="header-logos">
            <img src="{{ asset('images/dhaka.png') }}" alt="Logo">
            <div class="union-header">
                <h5 class="mb-1 font-weight-bold">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h5>
                <div class="union-title-bn">{{ $headerUnion?->bn_name ?? 'ইউনিয়ন পরিষদ' }}</div>
                <p class="mb-0" style="font-size: 15px; color: #444;">
                    উপজেলাঃ {{ $headerThana?->bn_name ?? 'সদর' }}, জেলাঃ {{ $headerDistrict?->bn_name ?? 'জেলা' }}, বাংলাদেশ।
                </p>
            </div>
            <img src="{{ asset('images/govt-bd-logo.png') }}" alt="Govt Logo">
        </div>

        <div class="citizen-title">
            <h4 class="mb-1">জমির খতিয়ান ও রেকর্ড বিবরণী</h4>
            <div style="font-size: 16px; color: #555; margin-top: 5px;">Land Record & Details Information</div>
        </div>

        <!-- Owner Information Section -->
        <div class="section-header">মালিকের তথ্য (Owner Information)</div>
        <div class="two-columns" style="background: #f8f9fc; padding: 20px; border-radius: 8px; border: 1px solid #e3e6f0;">
            <div class="col">
                <div class="info-row"><span class="info-label">মালিকের আইডি</span> : <span class="info-value font-weight-bold text-primary">{{ $land->owner_id }}</span></div>
                <div class="info-row"><span class="info-label">মালিকের নাম</span> : <span class="info-value font-weight-bold">{{ $ownerUser->name ?? ($ownerUser->people->bn_name ?? 'N/A') }}</span></div>
            </div>
            <div class="col">
                <div class="info-row"><span class="info-label">মোবাইল নম্বর</span> : <span class="info-value">{{ $ownerUser->mobile ?? 'N/A' }}</span></div>
                <div class="info-row"><span class="info-label">এনআইডি/জন্ম সনদ</span> : <span class="info-value">{{ $ownerUser->nid ?? ($ownerUser->birth_certificate ?? 'N/A') }}</span></div>
            </div>
        </div>

        <!-- Land Records Section -->
        <div class="section-header">জমির রেকর্ড বিবরণী (Land Records Details)</div>
        <div class="table-responsive mt-3">
            <table class="table table-bordered text-center align-middle" style="border-color: #bbb;">
                <thead style="background: #e9ecef; color: #333;">
                    <tr>
                        <th style="width: 10%;">রেকর্ড</th>
                        <th>জেলা</th>
                        <th>উপজেলা</th>
                        <th>মৌজা</th>
                        <th>দাগ নং</th>
                        <th>খতিয়ান নং</th>
                        <th>রেকর্ডীয় শ্রেণি</th>
                        <th>দাগে মোট জমি (একর)</th>
                        <th>জমির পরিমাণ (একর)</th>
                        <th>রেকর্ডীয় মালিকের নাম</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $records = $land->records_data ?? [];
                        $labels = ['cs' => 'সিএস', 'sa' => 'এসএ', 'rs' => 'আরএস', 'brs' => 'সিটি/বিআরএস'];
                    @endphp
                    @foreach($labels as $key => $label)
                        @php $rec = $records[$key] ?? []; @endphp
                        <tr>
                            <td class="font-weight-bold" style="background: #f8f9fa;">{{ $label }}</td>
                            <td>{{ $districts[$rec['district'] ?? ''] ?? '--' }}</td>
                            <td>{{ $thanas[$rec['upazila'] ?? ''] ?? '--' }}</td>
                            <td>{{ $rec['mouza'] ?: '--' }}</td>
                            <td>{{ $rec['dag_no'] ?: '--' }}</td>
                            <td>{{ $rec['khatian_no'] ?: '--' }}</td>
                            <td>{{ $rec['record_class'] ?: '--' }}</td>
                            <td>{{ $rec['total_land_dag'] ?: '0' }}</td>
                            <td>{{ $rec['land_amount'] ?: '0' }}</td>
                            <td>{{ $rec['owner_name'] ?: '--' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="action-row no-print">
            <div>
                <strong>এন্ট্রি তারিখ:</strong> {{ $land->created_at ? $land->created_at->format('d-m-Y h:i A') : '--' }}
            </div>
            <div class="action-right">
                <a href="{{ route('land.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to List</a>
                <a href="{{ route('land.edit', $land->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Edit Record</a>
                <button type="button" class="btn btn-success" onclick="window.print()"><i class="fas fa-print"></i> Print Details</button>
            </div>
        </div>
    </div>
</div>
@endsection
