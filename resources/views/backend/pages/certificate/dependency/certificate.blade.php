@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'Dependency'])

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
        }</style>
@endpush

@section('title', 'Dependency Certificate')

@section('content')
<div class="container p-0">
    <div class="certificate-card">
        <div class="certificate-body border border-dark">
            <div class="inner-frame">

                <!-- Header -->
                <div class="row align-items-center">
                    <div class="col-2 text-center">
                        <img height="90" width="90" src="{{ isset($certificate->user->institute->left_image) ? imageUrl($certificate->user->institute->left_image) : asset('images/dhaka.png') }}">
                    </div>

                    <div class="col-8 text-center">
                        <h2 class="text- font-Nikosh-bold mb-0" style="font-size:20px; position: relative; top: -10px;"> গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h2>
                        <h2 class="text-success font-weight-bold mb-0" style="font-size:32px;">৩নং শুকতাইল ইউনিয়ন পরিষদ</h2>
                        <h3 class="font-weight-bold" style="color:#2e3192; margin-top:2px; font-size:35px;">No. 3 Suktail Union Parishad</h3>
                        <p class="mb-0" style="font-size:15px; ">
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
                        <strong>No:</strong>  <span style="font-weight:bold;color:blue">{{ $certificate->system_id ?? '' }}</span>
                    </div>
                    <div class="col-6 text-center" style="white-space: nowrap;">
                        <span class="badge text-light px-4 py-2" style="font-size: clamp(12px, 1.5vw, 20px); white-space: nowrap; border-radius:28px; background-color: #2F318C;">
                           Dependency Certificate
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
                             This is to certify that ,
                            {{ $certificate->user->people->gender == 1 ? 'Mr.' : 'Mrs.' }}
                            <strong>{{ $certificate->user->people->name ?? $certificate->user->name ?? '' }}</strong>,
                            ID No.<strong>{{ $certificate->user->people->approved_id ?? '' }}</strong>,
                            Father: <span>{{ $certificate->user->familyInfo->father_name ?? '' }}</span>
                            and Mother: <span>{{ $certificate->user->familyInfo->mother_name ?? '' }}</span>,
                            @php 
                                $nid = $certificate->user->nid ?? $certificate->user->people->nid ?? '';
                                $bc = $certificate->user->birth_certificate ?? $certificate->user->people->birth_certificate ?? '';
                            @endphp
                            @if($nid && $nid != '1111111114')
                                NID No. <strong>{{ $nid }}</strong>,
                            @elseif($bc)
                                Birth Certificate No. <strong>{{ $bc }}</strong>,
                            @endif
                            Address: Village : - <span>{{ $certificate->user->addressInfo->permanentVillage->en_name ?? '' }}</span>,
                            Word:- {{ $certificate->user->addressInfo->permanentWard->en_ward_no ?? '' }},
                            Post Office: - 
{{ optional($certificate->user->addressInfo->permanentPostOffice)->name ?? '' }}-
@if(optional($certificate->user->addressInfo->permanentPostOffice)->postal_code)
{{ $certificate->user->addressInfo->permanentPostOffice->postal_code }},
@endif
                            Upzila:- <span>{{ $certificate->user->institute->union->thana->name ?? '' }}</span>,
                            District: - <span>{{ $certificate->user->institute->union->thana->district->name ?? '' }}</span>.
                           He is a Bangladeshi citizen by birth and a permanent resident of this union.
                           He/She is fully dependent on other members of his/her family or a specific person.
To my knowledge, he is of good character and has not been involved in any crime against law and order or the state.
                        </p>

                        <p style="margin-left:40px;">
                            I wish him all the best and a prosperous life.
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
        <!-- Cancel Button -->
        <button 
            id="cancelPageButton" 
            class="btn btn-danger btn-sm px-4"
            onclick="goToIndex();">
            Cancel
        </button>

        <!-- Print Button -->
        <button 
            id="printPageButton" 
            class="btn btn-success btn-sm px-4 ms-2"
            onclick="window.print();">
            Print
        </button>
    </div>
</div>



@endsection

@push('script')
<script>
    function goToIndex(){
        // Redirect to Character Certificate index page
        window.location.href = "{{ route('dependency.index') }}";
    }
</script>
@endpush



