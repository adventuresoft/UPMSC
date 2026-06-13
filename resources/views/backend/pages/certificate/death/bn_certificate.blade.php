@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'Death'])

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

        .content-wrapper {
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

        .main-header,
        .main-sidebar,
        .main-footer,
        .content-header {
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

@section('title', 'মৃত্যু সনদপত্র')

@section('content')
<div class="container p-0">
    <div class="certificate-card">
        <div class="certificate-body border border-dark">
            <div class="inner-frame">

                <!-- ================= Header ================= -->
                <div class="row align-items-center">
                    <div class="col-2 text-center">
                        <img height="90" width="90" src="{{ isset($certificate->user->institute->left_image) ? imageUrl($certificate->user->institute->left_image) : asset('images/dhaka.png') }}">
                    </div>

                    <div class="col-8 text-center">
                        <h2 class="text- font-Nikosh-bold mb-0" style="font-size:18px; position: relative; top: -10px;">
                            গণপ্রজাতন্ত্রী বাংলাদেশ সরকার
                        </h2>
                        <h2 class="text-success font-weight-bold mb-0" style="font-family: 'Kalpurush-Bold', sans-serif; font-size:28px; ">
                            {{ $certificate->user->institute->union->bn_name ?? '' }}
                        </h2>
                        <h3 class="font-weight-bold" style="color:#2e3192;  font-size:29px; line-height: 1.1;">
                            {{ $certificate->user->institute->union->name ?? '' }}
                        </h3>
                        <p class="mb-0" style="font-size:15px; ">
                            উপজেলাঃ {{ $certificate->user->institute->union->thana->bn_name ?? '' }},
                            জেলাঃ {{ $certificate->user->institute->union->thana->district->bn_name ?? '' }},
                            বাংলাদেশ।
                        </p>
                    </div>

                    <div class="col-2 text-center">
                        <img height="90" width="90" src="{{ asset('images/govt-bd-logo.png') }}">
                    </div>
                </div>

                <!-- ================= Title ================= -->
                <div class="row mt-3 align-items-center">
                    <div class="col-4 text-left">
                        <strong>নম্বরঃ</strong>  <span style="font-weight:bold;color:blue">{{ bnValue($certificate->system_id ?? '') }}</span>
                    </div>

                    <div class="col-4 text-center">
                        <span class="badge bg-danger text-light px-4 py-2" style="font-size:24px; border-radius:28px;">
                            মৃত্যু সনদপত্র
                        </span>
                    </div>

                    <div class="col-4 text-right">
                        তারিখঃ {{ bnValue(date('d/m/Y', strtotime($certificate->created_at))) }} খ্রিঃ
                    </div>
                </div>

                <!-- Body -->
                <div class="row mt-5">
                    <div class="col-12" style="font-size:18px; line-height:1.9; text-align:justify;">

                        <span>
                            <span style="margin-left:40px;"></span>
                            এই মর্মে প্রত্যয়ন করা যাচ্ছে যে,
                            {{ $certificate->user->people->gender == 1 ? 'জনাব' : 'জনাবা' }}
                            <strong>{{ $certificate->user->people->bn_name ?? '' }}</strong>,
                            আইডি নং -
                            <strong>{{ bnValue($certificate->user->people->approved_id ?? '') }}</strong>,
                            পিতাঃ <span>{{ $certificate->user->familyInfo->father_name_bn ?? '' }}</span>,
                            মাতাঃ <span>{{ $certificate->user->familyInfo->mother_name_bn ?? '' }}</span>,
                            @php 
                                $nid = $certificate->user->nid ?? $certificate->user->people->nid ?? '';
                                $bc = $certificate->user->birth_certificate ?? $certificate->user->people->birth_certificate ?? '';
                            @endphp
                            @if($nid && $nid != '1111111114')
                                এনআইডিঃ {{ bnValue($nid) }},
                            @elseif($bc)
                                জন্ম নিবন্ধন নং- {{ bnValue($bc) }},
                            @endif
                            ঠিকানাঃ গ্রাম: - <span>{{ $certificate->user->addressInfo->permanentVillage->bn_name ?? '' }}</span>,
                            ওয়ার্ড:- {{ $certificate->user->addressInfo->permanentWard->bn_ward_no ?? '' }},
                            ডাকঘর: - 
                            {{ optional(optional(optional($certificate->user)->addressInfo)->permanentPostOffice)->bn_name ?? '' }}
                            @if(optional(optional(optional($certificate->user)->addressInfo)->permanentPostOffice)->postal_code)
                                {{ bnValue(optional(optional(optional($certificate->user)->addressInfo)->permanentPostOffice)->postal_code) }},
                            @endif
                            উপজেলা: - <span>{{ $certificate->user->institute->union->thana->bn_name ?? '' }}</span>,
                            জেলা: - <span>{{ $certificate->user->institute->union->thana->district->bn_name ?? '' }}</span>।

                        <span>
                            তিনি 
                            <strong>
                                {{ bnValue(date('d/m/Y', strtotime ($certificate->date_of_death  ?? ''))) }}
                            </strong>
                            তারিখে মৃত্যুবরণ করেন।
                        </span>

                        <span >
                            মৃত্যুর কারণঃ 
                            <strong>{{ deathCauseBn($certificate->cause_of_death ?? 'উল্লেখ নেই') }}</strong>
                        </span>

                        <span>
                            এই সনদপত্রটি ইউনিয়ন পরিষদের নথিভুক্ত তথ্যের ভিত্তিতে প্রদান করা হলো এবং এটি সকল সরকারি ও বেসরকারি
                            কাজে প্রযোজ্য ও গ্রহণযোগ্য।
                        </p>

                        <p style="margin-left:40px;">
                            আমি তার বিদেহী আত্মার মাগফিরাত কামনা করি।
                        </p>
                    </div>
                </div>

                <!-- Signature Area -->
                <div class="certificate-signature">
                    <div class="qr-code">{!! QrCode::encoding('UTF-8')->size(100)->generate(get_qr_text($certificate)) !!}</div>
                    <div class="chairman">
                        <div style="height:40px;"></div>
                        <p class="mb-1" >({{ get_chairman_name_bn($certificate) }})</p>
                        <p class="mb-0">চেয়ারম্যান</p>
                        <p class="mb-0">{{ $certificate->user->institute->union->bn_name ?? '' }}</p>
                        <p class="mb-0" style="font-size:14px;">{{ $certificate->user->institute->union->thana->bn_name ?? '' }}, {{ $certificate->user->institute->union->thana->district->bn_name ?? '' }}</p>
                    </div>
                </div>
<!-- Footer -->
                <div class="certificate-footer">
                    This report generated by CLMS | Powered by <strong>Adventure Soft</strong>
                </div>

            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="text-center mt-2 mb-4">
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
        window.location.href = "{{ route('death.index') }}";
    }
</script>
@endpush