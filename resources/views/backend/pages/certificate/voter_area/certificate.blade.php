@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'VoterArea'])

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
    .inner-frame{
        border: 1px solid #222;
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

    .certificate-signature .qr-code img{
        height: 100px;
        width: 100px;
    }

    .certificate-signature .chairman {
        text-align: center;
        font-weight: 600;
        margin-right: 10mm;
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

        .content-wrapper,
        .wrapper {
            background: #ffffff !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .container {
            width: 297mm !important;
            max-width: 297mm !important;
            height: 210mm !important;
            padding: 0 !important;
            margin: 0 !important;
            overflow: hidden !important;
        }

        .certificate-card,
        .certificate-body,
        .inner-frame {
            page-break-inside: avoid !important;
            overflow: hidden !important;
            box-sizing: border-box !important;
        }

        .certificate-bg {
            display: block !important;
        }

        .main-header,
        .main-sidebar,
        .main-footer,
        .content-header,
        .page-footer,
        .app-footer {
            display: none !important;
        }

        #printPageButton,
        #cancelPageButton,
        .btn {
            display: none !important;
        }

        .badge {
            color: #ffffff !important;
            background-color: #2F318C !important;
        }

        .text-light {
            color: #ffffff !important;
        }
    }
</style>
@endpush

@section('title', 'Voter Area Change Certificate')

@section('content')
<div class="container p-0">
    <div class="certificate-card">
        <div class="certificate-body">
            <div class="inner-frame">

                <!-- Header -->
                <div class="row align-items-center">
                    <div class="col-2 text-center">
                        <img height="90" width="90" src="{{ isset($certificate->user->institute->left_image) ? imageUrl($certificate->user->institute->left_image) : asset('images/dhaka.png') }}">
                    </div>

                    <div class="col-8 text-center">
                        <h2 class="text- font-Nikosh-bold mb-0" style="font-size:18px; position: relative; top: -10px;">
                            গণপ্রজাতন্ত্রী বাংলাদেশ সরকার
                        </h2>
                        <div class="text-center">
                            <h2 class="dynamic-bn-name text-success font-weight-bold mb-0" style="width: max-content; margin: 0 auto; font-family: 'Kalpurush-Bold', sans-serif; font-size:28px; white-space: nowrap;">
                                {{ $certificate->user->institute->union->bn_name ?? '' }}
                            </h2>
                            <h3 class="dynamic-en-name font-weight-bold mb-0" style="width: max-content; margin: 0 auto; color:#2e3192; font-size:22px; line-height: 1.2; white-space: nowrap;">
                                {{ $certificate->user->institute->union->name ?? '' }}
                            </h3>
                        </div>
                        <p class="mb-0" style="font-size:18px; ">
                            Thana: <span>{{ $certificate->user->institute->union->thana->name ?? '' }}</span>,
                            District: <span>{{ $certificate->user->institute->union->thana->district->name ?? '' }}</span>, Bangladesh.
                        </p>
                    </div>

                    <div class="col-2 text-center">
                        <img height="90" width="90" src="{{ asset('images/govt-bd-logo.png') }}">
                    </div>
                </div>

                <!-- Title Row -->
                <div class="row mt-3 align-items-center">
                    <div class="col-3 text-left" style="white-space: nowrap;">
                        <strong>No:</strong> <span style="font-weight:bold;color:blue">{{ $certificate->system_id ?? '' }}</span>
                    </div>
                    <div class="col-6 text-center" style="white-space: nowrap;">
                        <span class="badge text-light px-4 py-2" style="font-size: clamp(12px, 1.5vw, 20px); white-space: nowrap; border-radius:28px; background-color: #2F318C;">
                            Voter Area Change Certificate
                        </span>
                    </div>
                    <div class="col-3 text-right" style="white-space: nowrap;">
                        Date: {{ date('d/m/Y', strtotime($certificate->created_at)) }} 
                    </div>
                </div>

                <!-- Body -->
                <div class="row mt-5">
                    <div class="col-12" style="font-size:18px; line-height:1.9; text-align:justify;">
                        <p>
                            <span style="margin-left:40px;"></span>
                            This is to certify that 
                            {{ $certificate->user->people->gender == 1 ? 'Mr.' : 'Ms.' }}
                            <strong>{{ $certificate->applicant_name ?? $certificate->user->name ?? '' }}</strong>,
                            ID No: {{ $certificate->user->people->approved_id ?? '' }},
                            @php 
                                $nid = $certificate->applicant_nid ?? $certificate->user->nid ?? $certificate->user->people->nid ?? '';
                            @endphp
                            @if($nid && $nid != '1111111114')
                                National ID No: <strong>{{ $nid }}</strong>,
                            @endif
                            Father/Husband: {{ $certificate->user->familyInfo->husband_name ?? $certificate->user->familyInfo->father_name ?? '' }},
                            Village: {{ $certificate->user->addressInfo->permanentVillage->en_name ?? '' }},
                            Post Office: {{ $certificate->user->addressInfo->permanentPostOffice->en_name ?? '' }},
                            Upazila: {{ $certificate->user->addressInfo->permanentThana->en_name ?? '' }},
                            District: {{ $certificate->user->addressInfo->permanentDistrict->en_name ?? '' }}.
                        </p>
                        @php
                            $currentVoterAreaCore = getCoreUnionName($certificate->current_voter_area_name);
                            $currentVoterAreaNo = $certificate->current_voter_area_no;
                            if (empty($currentVoterAreaNo)) {
                                if (preg_match('/(\d+|[০-৯]+)\s*নং\s*ওয়ার্ড/u', normalizeBanglaVowels($certificate->current_voter_area_name), $matches)) {
                                    $currentVoterAreaNo = $matches[1];
                                }
                            }
                        @endphp
                        <p style="margin-top: 15px;">
                            He/She is currently enlisted as a voter in Ward No. {{ $currentVoterAreaNo }} of {{ $currentVoterAreaCore }} Union Parishad, Upazila: {{ $certificate->current_upazila_thana }}, District: {{ $certificate->current_district }}. He/She wishes to change his/her voter area and intends to become a voter in Ward No. {{ $certificate->transfer_ward_no }} of this Union.
                        </p>
                        <p style="margin-top: 15px;">
                            In this regard, I strongly recommend including him/her in the voter list of Ward No. {{ $certificate->transfer_ward_no }} of this Union.
                        </p>
                        <p style="margin-top: 15px; margin-left:40px;">
                            I wish him/her all the best and every success in life.
                        </p>
                    </div>
                </div>

                <!-- Signature Area -->
                @include('backend.partials.chairman_signature', ['certificate' => $certificate])

                <!-- Footer -->
                <div class="certificate-footer">
                    This report generated by CLMS | Powered by <strong>Adventure Soft</strong>
                </div>

            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="text-center mt-2 mb-4 d-print-none">
        <button id="cancelPageButton" class="btn btn-danger btn-sm px-4"
                onclick="window.location.href='{{ route('voter-area.index') }}'">
            Cancel
        </button>

        <button id="printPageButton" class="btn btn-success btn-sm px-4 ms-2"
                onclick="window.print();">
            Print
        </button>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.fonts.ready.then(function() {
            const bnNames = document.querySelectorAll('.dynamic-bn-name');
            const enNames = document.querySelectorAll('.dynamic-en-name');
            for(let i = 0; i < bnNames.length; i++) {
                let bnName = bnNames[i];
                let enName = enNames[i];
                if(bnName && enName) {
                    let bnWidth = bnName.getBoundingClientRect().width;
                    let enWidth = enName.getBoundingClientRect().width;
                    let currentFontSize = parseFloat(window.getComputedStyle(enName).fontSize);
                    if(enWidth > 0 && bnWidth > 0 && enWidth !== bnWidth) {
                        let newFontSize = currentFontSize * (bnWidth / enWidth);
                        enName.style.fontSize = newFontSize + 'px';
                    }
                }
            }
        });
    });
</script>
@endsection
