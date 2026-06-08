@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'GuardianAcceptance'])

@push('style')
<style>
    .container {
        max-width: 100% !important;
    }

    /* ===== Certificate Canvas ===== */
    .certificate-card {
        max-width: 100%;
        margin: 0 auto;
        background-image: url('{{ asset('images/bg-images.jpeg') }}');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        width: 297mm;
        height: 210mm;
        position: relative;
        overflow: hidden;
    }

    .certificate-body {
        width: 100%;
        height: 100%;
        padding: 15mm;
        box-sizing: border-box;
    }

    /* Inner Frame */
    .inner-frame {
        border: 0px solid #0dcaf0;
        height: 100%;
        padding: 15mm;
        position: relative;
    }

    /* Footer */
    .certificate-footer {
        position: absolute;
        bottom: 8px;
        left: 15mm;
        right: 15mm;
        font-size: 11px;
        text-align: left;
        opacity: 0.9;
    }

    /* Signature Area */
    .certificate-signature {
        position: absolute;
        bottom: 14mm;
        left: 15mm;
        right: 15mm;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    }

    .certificate-signature .qr-code {
        width: 100px;
    }

    .certificate-signature .qr-code img {
        height: 100px;
        width: 100px;
    }

    .certificate-signature .chairman {
        text-align: center;
        font-weight: 600;
        margin-right: 10mm;
    }

    .certificate-signature .guardian-signature {
        text-align: left;
        font-weight: 600;
        margin-left: 10mm;
    }

    /* Print Control */
    @media print {
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            box-sizing: border-box !important;
        }

        @page {
            size: A4 landscape;
            margin: 0 !important;
        }

        html, body {
            width: 297mm !important;
            height: 210mm !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden !important;
            background: #ffffff !important;
        }

        .container {
            width: 297mm !important;
            max-width: 297mm !important;
            height: 210mm !important;
            padding: 0 !important;
            margin: 0 !important;
            overflow: hidden !important;
        }

        .main-header,
        .main-sidebar,
        .main-footer,
        .content-header,
        .content-wrapper,
        .wrapper,
        .app-footer {
            display: none !important;
        }

        #printPageButton,
        #cancelPageButton,
        .btn {
            display: none !important;
        }
    }
</style>
@endpush

@section('title', 'Guardian Acceptance Certificate')

@section('content')
<div class="container p-0">
    <div class="certificate-card">
        <div class="certificate-body">
            <div class="inner-frame">

                <!-- ================= Header ================= -->
                @php
                    $institute = $certificate->user->institute ?? \App\Models\User::find($certificate->created_by)->institute ?? auth()->user()->institute;
                    $union = $institute->union ?? null;
                    $thana = $union->thana ?? null;
                    $district = $thana->district ?? null;
                @endphp
                <div class="row align-items-center">
                    <div class="col-2 text-center">
                        <img height="90" width="90" src="{{ isset($institute->left_image) ? imageUrl($institute->left_image) : asset('images/dhaka.png') }}">
                    </div>

                    <div class="col-8 text-center">
                        <h2 class="mb-0" style="font-size:20px; font-weight: normal; color: #000;">
                            Government of the People's Republic of Bangladesh
                        </h2>
                        <h2 class="text-success font-weight-bold mb-0" style="font-size:32px; margin-top: 5px;">
                            {{ $union->bn_name ?? '' }}
                        </h2>
                        <h3 class="font-weight-bold" style="color:#2e3192; margin-top:2px; font-size:30px;">
                            {{ $union->name ?? '' }}
                        </h3>
                        <p class="mb-0" style="font-size:16px; color: #000;">
                            Thana: {{ $thana->name ?? '' }},
                            District: {{ $district->name ?? '' }},
                            Bangladesh
                        </p>
                    </div>

                    <div class="col-2 text-center">
                        <img height="90" width="90" src="{{ asset('images/govt-bd-logo.png') }}">
                    </div>
                </div>

                <!-- ================= Title ================= -->
                <div class="row mt-3 align-items-center">
                    <div class="col-4 text-left">
                        <strong>NO: </strong> <span style="font-weight:bold;color:blue;">{{ $certificate->system_id ?? '' }}</span>
                    </div>

                    <div class="col-4 text-center">
                        <span class="badge text-light px-4 py-2" style="font-size:22px; border-radius:28px; background-color: #2F318C;">
                            Guardian's Consent Letter
                        </span>
                    </div>

                    <div class="col-4 text-right">
                        <strong>Date:</strong>
                        {{ date('d/m/Y', strtotime($certificate->created_at ?? date('Y/m/d'))) }}
                    </div>
                </div>

                <!-- ================= Body ================= -->
                <div class="row mt-4">
                    <div class="col-12 cert-body-text" style="font-size:17px; line-height:1.9; text-align:justify;">
                        @php 
                            $nid = $certificate->user->nid ?? $certificate->user->people->nid ?? '';
                            $bc = $certificate->user->birth_certificate ?? $certificate->user->people->birth_certificate ?? '';
                            $id_label = $nid && $nid != '1111111114' ? 'NID' : ($bc ? 'Birth Certificate' : 'NID/Birth Certificate');
                            $id_val = $nid && $nid != '1111111114' ? $nid : ($bc ? $bc : '');
                        @endphp
                        <p>
                            <span style="margin-left:40px;"></span>
                            This is to certify that, 
                            <strong>{{ $certificate->user->people->en_name ?? $certificate->user->name ?? '' }}</strong>,
                            {{ $id_label }} No. <strong>{{ $id_val }}</strong>,
                            ID- <strong>{{ $certificate->user->people->approved_id ?? '' }}</strong>,
                            Father: <strong>{{ $certificate->user->familyInfo->father_name ?? 'N/A' }}</strong>,
                            Mother: <strong>{{ $certificate->user->familyInfo->mother_name ?? 'N/A' }}</strong>,
                            Village: <strong>{{ $certificate->user->addressInfo->permanentVillage->en_name ?? 'N/A' }}</strong>,
                            Post Office: <strong>{{ $certificate->user->addressInfo->permanentPostOffice->en_name ?? 'N/A' }}</strong>,
                            Upazila: <strong>{{ $thana->name ?? '' }}</strong>,
                            District: <strong>{{ $district->name ?? '' }}</strong>,
                            is my <strong>{{ $certificate->guardian_relation ?? '' }}</strong> and a permanent resident of Ward No. 
                            <strong>{{ $certificate->user->addressInfo->permanentWard->en_ward_no ?? '' }}</strong> of this Union. 
                            To the best of my knowledge, {{ $certificate->user->people->gender == 1 ? 'he' : 'she' }} is not involved in any anti-state or anti-social activities. I have no objection if {{ $certificate->user->people->gender == 1 ? 'he' : 'she' }} is employed in any government department of Bangladesh including Bangladesh Army/Air Force/Navy/Police Force/Ansar VDP and in any government-private educational institution. I hereby give my consent to the above mentioned matter.
                        </p>
                        <p style="margin-left:40px; margin-bottom: 30px;">
                            I wish {{ $certificate->user->people->gender == 1 ? 'him' : 'her' }} all the best and a prosperous future.
                        </p>
                    </div>
                </div>

                <!-- ================= Signature ================= -->
                @php
                    $guardianNid = $certificate->guardian->nid ?? $certificate->guardian->people->nid ?? '';
                    $guardianMobile = $certificate->guardian->mobile ?? $certificate->guardian->people->mobile ?? '';
                @endphp
                <div class="certificate-signature">
                    <div class="guardian-signature">
                        <div style="height:40px;"></div>
                        <p class="mb-0"><strong>Guardian's Signature</strong></p>
                        <p class="mb-0">Name: {{ $certificate->guardian->people->name ?? $certificate->guardian->name ?? '' }}</p>
                        <p class="mb-0">NID No: {{ $guardianNid }}</p>
                        <p class="mb-0">Mobile No: {{ $guardianMobile }}</p>
                    </div>
                    
                    <div class="qr-code" id="qrcode"></div>
                    
                    <div class="chairman">
                        <div style="height:40px;"></div>
                        <p class="mb-1"><strong>Identifier</strong></p>
                        <p class="mb-1">{{ get_chairman_name_en($certificate) }}</p>
                        <p class="mb-0">Chairman</p>
                        <p class="mb-0">{{ $union->name ?? '' }}</p>
                        <p class="mb-0" style="font-size:14px;">{{ $thana->name ?? '' }}, {{ $district->name ?? '' }}</p>
                    </div>
                </div>

                <!-- ================= Footer ================= -->
                <div class="certificate-footer">
                    This report generated by CLMS | Powered by <strong>Adventure Soft</strong>
                </div>

            </div>
        </div>
    </div>

    <!-- ================= Buttons ================= -->
    <div class="text-center mt-2 mb-4">
        <button id="cancelPageButton" class="btn btn-danger btn-sm px-4"
                onclick="window.location.href='{{ route('guardian-acceptance.index') }}'">
            Cancel
        </button>

        <button id="printPageButton" class="btn btn-success btn-sm px-4 ms-2"
                onclick="window.print();">
            Print
        </button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/qrcodejs/qrcode.min.js"></script>

<script>
    new QRCode(document.getElementById("qrcode"), {
        text: "{{ url('/certificate/verify?system_id=' . $certificate->system_id) }}",
        width: 150,
        height: 150
    });
</script>

@endsection