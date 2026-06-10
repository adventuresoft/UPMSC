<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Character Certificate</title>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    <style>
        .container {
            max-width: 100% !important;
        }

        body {
            background-color: #ffffff !important;
            padding: 0;
            margin: 0;
        }

        .certificate-card {
            max-width: 100%;
            margin: 0 auto;
            width: 297mm;
            height: 210mm;
            position: relative;
            overflow: hidden;
        }

        .certificate-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
            pointer-events: none;
        }

        .certificate-body {
            width: 100%;
            height: 100%;
            padding: 15mm;
            box-sizing: border-box;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .inner-frame {
            border: 0px solid #0dcaf0;
            height: 100%;
            padding: 15mm;
            position: relative;
        }

        .certificate-footer {
            position: absolute;
            bottom: 8px;
            left: 15mm;
            right: 15mm;
            font-size: 11px;
            text-align: left;
            opacity: 0.9;
        }

        .certificate-signature {
            position: absolute;
            bottom: 14mm;
            left: 15mm;
            right: 15mm;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
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

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .text-success {
            color: #28a745;
        }

        .text-danger {
            color: #dc3545;
        }

        .text-light {
            color: #fff;
        }

        .bg-success {
            background-color: #28a745;
        }

        .ml-2 {
            padding-left: 2rem;
        }

        .mr-2 {
            padding-right: 2rem;
        }

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

            html,
            body {
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

            .certificate-card,
            .certificate-body,
            .inner-frame {
                page-break-inside: avoid !important;
                overflow: hidden !important;
                box-sizing: border-box !important;
            }
        }
    </style>
</head>

<body>
    <div class="container p-0">
        <div class="certificate-card">
            <img src="{{ asset('images/bg-images.jpeg') }}" alt="" class="certificate-bg">
            <div class="certificate-body">
                <div class="inner-frame">

                    <!-- ================= Header ================= -->
                    <div class="row align-items-center">
                        <div class="col-2 text-center">
                            <img height="90" width="90" src="{{ isset($certificate->user->institute->left_image) ? imageUrl($certificate->user->institute->left_image) : asset('images/dhaka.png') }}">
                        </div>

                        <div class="col-8 text-center">
                            <h2 class="text- font-Tahoma-bold mb-0" style="font-size:16px;">
                              Government of the People's Republic of Bangladesh
                            </h2>
                            <h3 class="font-weight-bold" style="color:#2e3192; margin-top:2px; font-size:30px;">
                                {{ $certificate->user->institute->union->name ?? '' }}
                            </h3>
                            <h2 class="text-success font-Nikosh-bold mb-0" style="font-family: 'Kalpurush-Bold', sans-serif; font-size:28px;">
                                {{ $certificate->user->institute->union->bn_name ?? '' }}
                            </h2>
                            <p class="mb-0" style="font-size:15px;">
                                Thana: {{ $certificate->user->institute->union->thana->name ?? '' }},
                                District: {{ $certificate->user->institute->union->thana->district->name ?? '' }},
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
                            <strong>No:</strong>  <span style="font-weight:bold;color:blue">{{ $certificate->system_id ?? '' }}</span>
                        </div>

                        <div class="col-4 text-center">
                            <span class="badge text-light px-4 py-2" style="font-size:24px; border-radius:28px; background-color: #2F318C;">
                                Character certificate
                            </span>
                        </div>

                        <div class="col-4 text-right">
                            <strong>Date: </strong> {{ date('d/m/Y', strtotime($certificate->created_at)) }}
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="row mt-5">
                        <div class="col-12" style="font-size:18px; line-height:1.9; text-align:justify;">
                            <p>
                                <span style="margin-left:40px;"></span>
                                 This is to certify that ,
                                {{ $certificate->user->people->gender == 1 ? 'Mr.' : 'Mrs.' }}
                                <strong>{{ $certificate->user->people->name ?? '' }}</strong>,
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
                                Date of Birth: {{ $certificate->user->people->date_of_birth ? date('d/m/Y', strtotime($certificate->user->people->date_of_birth)) : '' }},
                                Address: Village : - <span>{{ $certificate->user->addressInfo->permanentVillage->en_name ?? '' }}</span>,
                                Word:- {{ $certificate->user->addressInfo->permanentWard->en_ward_no ?? '' }},
                                Post Office: - {{ optional($certificate->user->addressInfo->permanentPostOffice)->name ?? '' }}-
                                @if(optional($certificate->user->addressInfo->permanentPostOffice)->postal_code)
                                {{ $certificate->user->addressInfo->permanentPostOffice->postal_code }},
                                @endif
                                Upzila:- <span>{{ $certificate->user->institute->union->thana->name ?? '' }}</span>,
                                District: - <span>{{ $certificate->user->institute->union->thana->district->name ?? '' }}</span>.
                               He is a Bangladeshi citizen by birth and a permanent resident of this union.
                            To my knowledge, he is of good character and has not been involved in any crime against law and order or the state.
                            </p>

                            <p style="margin-left:40px;">
                                I wish him all the best and a prosperous life.
                            </p>
                        </div>
                    </div>

                    <!-- ================= Signature ================= -->
                    @include('backend.partials.chairman_signature', ['certificate' => $certificate])

                    <!-- ================= Footer ================= -->
                    <div class="certificate-footer">
                        This report generated by CLMS | Powered by <strong>Adventure Soft</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-2 mb-4">
            <button id="cancelPageButton" class="btn btn-danger btn-sm px-4" onclick="window.history.back();">
                Cancel
            </button>
            <button id="printPageButton" class="btn btn-success btn-sm px-4 ms-2" onclick="window.print();">
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
</body>

</html>

