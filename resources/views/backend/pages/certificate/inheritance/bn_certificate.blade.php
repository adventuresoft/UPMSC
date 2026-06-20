@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'Inheritance'])

@push('style')
<style>
    .container {
        max-width: 100% !important;
    }

/* =========================
   A4 CANVAS
========================= */
.certificate-card {
    max-width: 100%;
    margin: 0 auto;
    background-image: url('{{ asset('images/sucsesion.png') }}');
    background-size: 100% 100%;
    background-repeat: no-repeat;
    background-position: center;
    width: 210mm;
    min-height: 297mm;
    height: auto;
    position: relative;
    box-sizing: border-box;
    margin: 0 auto;
}

/* =========================
   BODY WRAPPER
========================= */
.certificate-body {
    width: 100%;
    height: 100%;
    padding: 15mm;
    box-sizing: border-box;
}

.inner-frame{
    height: 100%;
    min-height: 267mm; /* 297mm - 30mm padding */
    padding: 15mm;
    position: relative;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
}

/* =========================
   FOOTER
========================= */
.certificate-footer {
    font-size: 10px;
    text-align: center;
    opacity: 0.85;
    margin-top: 15px;
}

/* =========================
   SIGNATURE
========================= */
.certificate-signature {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-top: auto;
    padding-top: 30px;
}

.certificate-signature .qr-code img{
    height: 90px;
    width: 90px;
}

.certificate-signature .chairman {
    text-align: center;
    font-weight: 400;
    font-size: 14px;
}

/* =========================
   MEMBER TABLE
========================= */
.member-table{
    width:100%;
    border-collapse: collapse;
    margin-top: 10px;
    font-size: 14px;
}

.member-table th,
.member-table td{
    border:1px solid #000;
    padding:6px;
    text-align:center;
}

.member-table th{
    background:#e9f6ff;
    font-weight:600;
}

/* =========================
   PRINT CONFIG
========================= */
    @media print {
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            box-sizing: border-box !important;
        }

        @page {
            size: a4 portrait;
            margin: 0mm !important;
        }

        html, body {
            width: 100% !important;
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden !important;
            background: #ffffff !important;
        }

        .container {
            width: 100% !important;
            max-width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
            overflow: hidden !important;
        }

        .certificate-card {
            width: 100% !important;
            height: auto !important;
            min-height: 297mm !important;
            max-width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            border: none !important;
            box-shadow: none !important;
            background-size: 100% 100% !important;
            background-repeat: no-repeat !important;
            position: relative !important;
        }

        

        .content-wrapper,
        .wrapper {
            background: #ffffff !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .main-header,
        .main-sidebar,
        .main-footer,
        .content-header,
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

@section('title', 'Inheritance Certificate')

@section('content')
<div class="container p-0">
    <div class="certificate-card">
        <div class="certificate-body">
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
                        @php
                            $institute = $certificate->user->institute;
                            $auth = $institute->union ?? ($institute->pourashava ?? $institute->cityCorporation);
                            $thanaBn = '';
                            $districtBn = '';
                            
                            if ($institute->union && $institute->union->thana) {
                                $thanaBn = $institute->union->thana->bn_name ?? '';
                                $districtBn = $institute->union->thana->district->bn_name ?? '';
                            } elseif ($institute->pourashava) {
                                $districtBn = $institute->pourashava->District->bn_name ?? '';
                            } elseif ($institute->cityCorporation) {
                                $districtBn = $institute->cityCorporation->District->bn_name ?? '';
                            }
                        @endphp
                        <h2 class="text-success font-weight-bold mb-0" style="font-family: 'Kalpurush-Bold', sans-serif; font-size:23px; ">
                            {{ $auth->bn_name ?? '' }}
                        </h2>
                        <h3 class="font-weight-bold" style="color:#2e3192;  font-size:24px; line-height: 1.1;">
                            {{ $auth->name ?? '' }}
                        </h3>
                        <p class="mb-0" style="font-size:15px; ">
                            @if($thanaBn) উপজেলাঃ {{ $thanaBn }}, @endif
                            জেলাঃ {{ $districtBn }},
                            বাংলাদেশ।
                        </p>
                    </div>

                    <div class="col-2 text-center">
                        <img height="90" width="90" src="{{ asset('images/govt-bd-logo.png') }}">
                    </div>
                </div>

                <!-- ================= Title ================= -->
                <div class="row mt-2 align-items-center">
                    <div class="col-2 text-left">
                        <strong>নম্বরঃ</strong>  <span style="font-weight:bold;color:blue">{{ bnValue($certificate->system_id ?? '') }}</span>
                    </div>

                    <div class="col-8 text-center">
                        <span class="badge text-light px-4 py-2" style="font-size:22px; border-radius:26px;; background-color: #2F318C;">
                            উত্তরাধিকার সনদ
                        </span>
                    </div>

                    <div class="col-2 text-right">
                        তারিখঃ
                        {{ bnValue(date('d/m/Y', strtotime($certificate->created_at))) }} খ্রিঃ
                    </div>
                </div>

                <!-- ===== Body ===== -->
                <div class="row mt-3">
                    <div class="col-12" style="font-size:15px; line-height:1.9; text-align:justify;">

                        <p>
                            <span style="margin-left:40px;"></span>
                            এই মর্মে প্রত্যয়ন করা যাচ্ছে যে,
                            {{ $certificate->user->people->gender == 1 ? 'জনাব' : 'জনাবা' }}
                            <strong>{{ $certificate->user->people->bn_name ?? '' }}</strong>,
                            আইডি নং <strong>{{ bnValue($certificate->user->people->approved_id?? '') }}</strong>,
                            পিতাঃ {{ $certificate->user->familyInfo->father_name_bn ?? '' }},
                            মাতাঃ {{ $certificate->user->familyInfo->mother_name_bn ?? '' }}।
                            @php 
                                $nid = $certificate->user->nid ?? $certificate->user->people->nid ?? '';
                                $bc = $certificate->user->birth_certificate ?? $certificate->user->people->birth_certificate ?? '';
                            @endphp
                            @if($nid && $nid != '1111111114')
                                এনআইডিঃ {{ bnValue($nid) }},
                            @elseif($bc)
                                জন্ম নিবন্ধন নং- {{ bnValue($bc) }},
                            @endif
                            ঠিকানাঃ গ্রাম- {{ $certificate->user->addressInfo->permanentVillage->bn_name ?? '' }},
                            ওয়ার্ড: {{ $certificate->user->addressInfo->permanentWard->bn_ward_no ?? '' }},
                            ডাকঘর: {{ optional(optional(optional($certificate->user)->addressInfo)->permanentPostOffice)->bn_name ?? '' }}
@if(optional(optional(optional($certificate->user)->addressInfo)->permanentPostOffice)->postal_code)
    {{ bnValue(optional(optional(optional($certificate->user)->addressInfo)->permanentPostOffice)->postal_code) }},
@endif
                            @if($thanaBn) উপজেলা- {{ $thanaBn }}, @endif
                            জেলা- {{ $districtBn }}।
                            তিনি অত্র ইউনিয়নের একজন স্থায়ী বাসিন্দা । 
                            তার দেয়া তথ্য মতে নিম্ন ছকে বর্ণিত উত্তরাধিকারীগণ রয়েছেন ।
                        </p>

                        <p class="text-center"><strong>- ওয়ারিশগণের তালিকা -</strong></p>

                        @php
                            $members = is_null($certificate->members) ? [] : json_decode($certificate->members, true);
                        @endphp

                        <table class="member-table">
                            <thead>
                                <tr>
                                    <th>ক্র.নং</th>
                                    <th>ওয়ারিশের নাম</th>
                                    <th>সম্পর্ক</th>
                                    <th>এনআইডি</th>
                                    <th>বয়স</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($members as $member)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $member['name'] }}</td>
                                        <td>{{ $member['relation'] }}</td>
                                        <td>{{ $member['nid'] }}</td>
                                        <td>{{ $member['age'] }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">কোনো ওয়ারিশ তথ্য পাওয়া যায়নি</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <p style="margin-top:10px;">
                            <span style="margin-left:40px;"></span>
                            আমি তাদের সার্বিক কল্যাণ ও মঙ্গলময় জীবন কামনা করি।
                        </p>

                    </div>
                </div>

                <!-- ===== Signature ===== -->
                <div class="certificate-signature">
                     <div class="qr-code">{!! QrCode::encoding('UTF-8')->size(100)->generate(get_qr_text($certificate)) !!}</div>

                    <div class="chairman">
                        <div style="height:40px;"></div>
                        <p class="mb-1">({{ get_chairman_name_bn($certificate) }})</p>
                        <p class="mb-0">চেয়ারম্যান</p>
                        <p class="mb-0">৩ নং শুকতাইল ইউনিয়ন পরিষদ</p>
                        <p class="mb-0" style="font-size:14px;">
                            @if($thanaBn) {{ $thanaBn }}, @endif
                            {{ $districtBn }}
                        </p>
                    </div>
                </div>

                <!-- ===== Footer ===== -->
                <div class="certificate-footer">
                    This report generated by CLMS | Powered by <strong>Adventure Soft</strong>
                </div>

            </div>
        </div>
    </div>

    <!-- ===== Buttons ===== -->
    <div class="text-center mt-2 mb-4 d-print-none">
        <button 
            id="cancelPageButton" 
            class="btn btn-danger btn-sm px-4"
            onclick="goToIndex();">
            Cancel
        </button>

        <button 
            id="printPageButton" 
            class="btn btn-success btn-sm px-4 ms-2"
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

@push('script')
<script>
    function goToIndex(){
        window.location.href = "{{ route('inheritance.index') }}";
    }
</script>
@endpush













