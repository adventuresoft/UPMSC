@extends('backend.master', ['mainMenu' => 'Road', 'subMenu' =>'RoadList'])

@section('title', 'Road Details')

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
        margin: 20px auto;
        background: white;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden; /* changed to hidden so pseudo element doesn't overflow */
        border-radius: 4px;
        border: 6px solid #34613f; /* thick outer border */
    }

    .people-certificate-page::after {
        content: '';
        position: absolute;
        top: 3px;
        left: 3px;
        right: 3px;
        bottom: 3px;
        border: 1.5px solid #34613f; /* thin inner border */
        pointer-events: none;
    }

    .people-certificate-content {
        padding: 40px 50px;
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
        font-size: 20px;
        font-weight: bold;
        color: #006600;
        margin: 0;
    }

    .union-title-en {
        font-size: 20px;
        font-weight: bold;
        color: #2e3192;
        margin: 2px 0;
    }

    .union-address {
        font-size: 16px;
        margin: 0;
        color: #333;
    }

    .citizen-title {
        text-align: center;
        margin: 10px 0;
    }

    .citizen-title h4 {
        font-size: 20px;
        font-weight: bold;
        color: #006600;
        margin: 0;
    }

    .section-header {
        background: #006600;
        color: #fff;
        font-weight: bold;
        padding: 6px 12px;
        margin: 20px 0 12px 0;
        font-size: 16px;
        border-radius: 4px;
        letter-spacing: 1px;
    }

    .info-row {
        display: flex;
        margin-bottom: 8px;
        font-size: 13px;
        border-bottom: 1px dotted #e0e0e0;
        padding-bottom: 5px;
    }

    .info-label {
        display: inline-block;
        width: 150px;
        font-weight: bold;
        color: #2c3e4e;
        vertical-align: top;
    }

    .info-value {
        flex: 1;
        color: #1e2a36;
        margin-left: 5px;
    }

    .two-columns {
        display: flex;
        gap: 20px;
        margin-top: 10px;
    }

    .col {
        flex: 1;
    }

    .action-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px dashed #aaa;
    }

    .action-right {
        display: flex;
        gap: 8px;
    }

    @media print {
        .no-print {
            display: none !important;
        }

        .people-certificate-page {
            box-shadow: none;
            max-width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="people-certificate-page">
    <div class="people-certificate-content">
        @php
            $headerUnion = auth()->user()?->institute?->union;
            $headerThana = $headerUnion?->thana;
            $headerDistrict = $headerThana?->district;
        @endphp

        <div class="header-logos">
            <img src="{{ asset('images/dhaka.png') }}" alt="City Logo">
            <div class="union-header">
                <h5 class="mb-0">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h5>
                <div class="union-title-bn">{{ $headerUnion?->bn_name ?? '' }}</div>
                <div class="union-title-en">{{ $headerUnion?->name ?? '' }}</div>
                <p class="union-address">
                    থানাঃ {{ $headerThana?->bn_name ?? '' }},
                    জেলাঃ {{ $headerDistrict?->bn_name ?? '' }},
                    বাংলাদেশ।
                </p>
            </div>
            <img src="{{ asset('images/govt-bd-logo.png') }}" alt="Govt Logo">
        </div>

        <div class="citizen-title">
            <h4 class="mb-0">রাস্তার তথ্য</h4>
            <h4>Road Details</h4>
        </div>

        <div class="section-header">Road Information</div>
        
        <div class="info-section" style="background: #f8f9fc; padding: 15px; border-radius: 8px; border: 1px solid #dee2e6; margin-bottom: 10px;">
            <div class="two-columns" style="margin-top: 0;">
                <div class="col">
                    <div class="info-row"><span class="info-label">Road Number/Name</span> : <span class="info-value">{{ $road->name ?? '--' }}</span></div>
                    <div class="info-row"><span class="info-label">Road Number/Name (Bangla)</span> : <span class="info-value">{{ $road->bn_name ?? '--' }}</span></div>
                    <div class="info-row"><span class="info-label">Distance (KM)</span> : <span class="info-value">{{ $road->distance ?? '0.00' }}</span></div>
                    <div class="info-row"><span class="info-label">Start Point</span> : <span class="info-value">{{ $road->start_point ?? '--' }}</span></div>
                    <div class="info-row"><span class="info-label">End Point</span> : <span class="info-value">{{ $road->end_point ?? '--' }}</span></div>
                </div>
                <div class="col">
                    <div class="info-row"><span class="info-label">Road Type</span> : <span class="info-value">{{ $road->roadType->en_name ?? '--' }}</span></div>
                    <div class="info-row"><span class="info-label">Road Category</span> : <span class="info-value">{{ $road->roadCategory->en_name ?? '--' }}</span></div>
                    <div class="info-row"><span class="info-label">Road Owner</span> : <span class="info-value">{{ $road->roadOwner->en_name ?? '--' }}</span></div>
                    <div class="info-row"><span class="info-label">Current Condition</span> : <span class="info-value">{{ $road->current_condition ?? '--' }}</span></div>
                </div>
            </div>
        </div>

        <div class="action-row no-print">
            <div>
                <strong>Created At:</strong> {{ $road->created_at ? $road->created_at->format('d-m-Y h:i A') : '--' }}
            </div>
            <div class="action-right">
                <a href="{{ route('road.index') }}" class="btn btn-secondary">Back to List</a>
                <a href="{{ route('road.edit', $road->id) }}" class="btn btn-primary">Edit Road</a>
                <button type="button" class="btn btn-info" onclick="window.print()">Print Details</button>
            </div>
        </div>
    </div>
</div>
@endsection
