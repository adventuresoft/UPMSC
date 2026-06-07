@extends('backend.master', ['mainMenu' => 'House', 'subMenu' =>'HouseList'])

@section('title', 'House Details')

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
    }

    .people-certificate-content {
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
        width: 105px;
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

    .room-card-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 15px;
        margin-top: 10px;
    }

    .room-card {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        background: #f8f9fa;
        overflow: hidden;
    }

    .room-card-header {
        background: #e9ecef;
        padding: 8px 12px;
        font-weight: bold;
        font-size: 14px;
        border-bottom: 1px solid #dee2e6;
    }

    .room-card-body {
        padding: 10px;
        font-size: 13px;
    }

    .owner-section {
        margin-top: 15px;
        background: #f8f9fc;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        margin-bottom: 10px;
    }

    .owner-header {
        font-weight: bold;
        color: #006600;
        margin-bottom: 10px;
        border-bottom: 1px solid #006600;
        padding-bottom: 5px;
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
            $headerUnion = $house->village?->union ?? auth()->user()?->institute?->union;
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
            <h4 class="mb-0">বাড়ির তথ্য</h4>
            <h4>House Details</h4>
        </div>

        <div class="section-header">House Information</div>
        
        <div class="two-columns">
            <div class="col">
                <div class="info-row"><span class="info-label">House/Holding Number</span> : <span class="info-value">{{ $house->house }}</span></div>
                <div class="info-row"><span class="info-label">House/Holding No (Bangla)</span> : <span class="info-value">{{ $house->house_bn }}</span></div>
                <div class="info-row"><span class="info-label">Village</span> : <span class="info-value">{{ $house->village->en_name ?? '--' }}</span></div>
                <div class="info-row"><span class="info-label">Block/Sec/Sector</span> : <span class="info-value">{{ $house->block_section ?? '--' }}</span></div>
                <div class="info-row"><span class="info-label">Ward No</span> : <span class="info-value">{{ $house->unionWard->en_ward_no ?? '--' }}</span></div>
                <div class="info-row"><span class="info-label">Room Usage</span> : <span class="info-value">{{ $house->room_usage ?? '--' }}</span></div>
            </div>
            <div class="col">
                <div class="info-row"><span class="info-label">Land Quantity</span> : <span class="info-value">{{ $house->land_quantity ?? '0.00' }} একর</span></div>
                <div class="info-row"><span class="info-label">Total Land Price</span> : <span class="info-value">{{ number_format((float) ($house->land_price ?? 0), 2) }} BDT</span></div>
                <div class="info-row"><span class="info-label">Total Building Price</span> : <span class="info-value">{{ number_format((float) ($house->house_price ?? 0), 2) }} BDT</span></div>
                <div class="info-row"><span class="info-label font-weight-bold" style="color: #006600;">Total Grand Price</span> : <span class="info-value font-weight-bold" style="color: #006600;">{{ number_format((float) ($house->grand_total_price ?? 0), 2) }} BDT</span></div>
                <div class="info-row"><span class="info-label">Number of Buildings</span> : <span class="info-value">{{ $house->number_of_rooms ?? '0' }}</span></div>
            </div>
        </div>

        @if($house->room_details)
            @php $rooms = json_decode($house->room_details, true); @endphp
            @if(count($rooms))
                <div class="section-header">Building/Structure Details</div>
                <div class="room-card-container">
                    @foreach($rooms as $index => $room)
                        <div class="room-card">
                            <div class="room-card-header">Building/Structure {{ $index + 1 }}</div>
                            <div class="room-card-body">
                                <div><strong>Area:</strong> {{ $room['area'] ?? '0' }} Sq. Ft</div>
                                <div><strong>Type:</strong> {{ $room['type'] ?? '--' }}</div>
                                <div><strong>Price/Sq. Ft:</strong> {{ number_format((float) ($room['price_per_sq_ft'] ?? 0), 2) }} BDT</div>
                                <hr class="my-1">
                                <div><strong>Total:</strong> {{ number_format((float) (($room['area'] ?? 0) * ($room['price_per_sq_ft'] ?? 0)), 2) }} BDT</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="section-header">Ownership Information</div>
        @if(count($house->ownership))
            @foreach($house->ownership as $index => $owner)
                <div class="owner-section">
                    <div class="owner-header">Owner #{{ $index + 1 }}</div>
                    <div class="two-columns">
                        <div class="col">
                            <div class="info-row"><span class="info-label">Name</span> : <span class="info-value">{{ $owner->name }}</span></div>
                            <div class="info-row"><span class="info-label">Mobile</span> : <span class="info-value">{{ $owner->mobile ?? '--' }}</span></div>
                            <div class="info-row"><span class="info-label">Is this Union?</span> : <span class="info-value text-capitalize">{{ $owner->is_union ?? 'no' }}</span></div>
                            
                        </div>
                        <div class="col">
                            
                            <div class="info-row"><span class="info-label">NID/Birth ID</span> : <span class="info-value">{{ $owner->nid ?? '--' }}</span></div>
                            <div class="info-row"><span class="info-label">Address</span> : <span class="info-value">{{ $owner->address ?? '--' }}</span></div>
                             @if(($owner->is_union ?? 'no') == 'yes')
                                <div class="info-row"><span class="info-label">Owner ID</span> : <span class="info-value">{{ $owner->owner_id ?? '--' }}</span></div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-warning">No ownership information found.</div>
        @endif

        <div class="action-row no-print">
            <div>
                <strong>Created At:</strong> {{ $house->created_at ? $house->created_at->format('d-m-Y h:i A') : '--' }}
            </div>
            <div class="action-right">
                <a href="{{ route('house.index') }}" class="btn btn-secondary">Back to List</a>
                <a href="{{ route('house.edit', $house->id) }}" class="btn btn-primary">Edit House</a>
                <button type="button" class="btn btn-info" onclick="window.print()">Print Details</button>
            </div>
        </div>
    </div>
</div>
@endsection
