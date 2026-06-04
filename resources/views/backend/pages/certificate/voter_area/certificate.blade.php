@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'VoterArea'])

@push('style')
<style>
    .certificate-canvas {
        background: #f4f6f9;
        padding: 40px 0;
        min-height: 100vh;
    }

    .form-container {
        width: 210mm;
        min-height: 297mm;
        padding: 15mm 10mm;
        margin: 0 auto 20px auto;
        background: white;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        font-family: "Times New Roman", Times, serif;
        color: #000;
        line-height: 1.75;
        font-size: 15px;
        position: relative;
        box-sizing: border-box;
    }

    .text-center { text-align: center !important; }
    .text-right { text-align: right !important; }
    .font-weight-bold { font-weight: bold !important; }

    .flex-row {
        display: flex;
        align-items: baseline;
        width: 100%;
        margin-bottom: 3px;
        white-space: nowrap;
    }

    .flex-row > span {
        white-space: nowrap;
        flex-shrink: 0;
    }

    .dot-line-container {
        flex-grow: 1;
        position: relative;
        border-bottom: 1px dashed #000;
        margin-left: 3px;
        margin-right: 3px;
        display: flex;
        align-items: flex-end;
    }

    .data-span {
        position: relative;
        z-index: 1;
        padding-right: 4px;
        font-weight: normal;
        background: white;
        padding-bottom: 0px;
    }

    .post-code-box {
        display: inline-flex;
        border: 1px solid #000;
        margin-left: 10px;
        vertical-align: middle;
    }

    .post-code-box span {
        width: 28px;
        height: 28px;
        border-right: 1px solid #000;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 17px;
    }

    .post-code-box span:last-child {
        border-right: none;
    }

    .print-controls {
        background: #ffffff;
        padding: 20px;
        text-align: center;
        margin-top: 30px;
        border-top: 1px solid #e0e0e0;
    }

    @media print {
        @page {
            size: A4 portrait;
            margin: 0;
        }
        body { background: none !important; margin: 0; padding: 0; }
        .certificate-canvas { padding: 0; background: none; }
        .form-container {
            box-shadow: none;
            margin: 0 auto;
            padding: 15mm 10mm;
            width: 210mm;
            min-height: auto;
            page-break-after: always;
            box-sizing: border-box;
            border: none;
        }
        .form-container.last-page { page-break-after: auto; }
        .print-controls, .content-header, .main-header, .main-sidebar, .main-footer { display: none !important; }
    }
</style>
@endpush

@section('title', 'Voter Transfer Form-13')

@section('content')
<div class="certificate-canvas">
    <!-- PAGE 1 -->
    <div class="form-container">
        <div class="text-center" style="margin-bottom: 30px;">
            <div style="font-size: 18px; font-weight: bold;">Form-13</div>
            <div style="font-size: 15px;">[See Rule 26(7)]</div>
            <div style="margin-top: 20px; font-size: 17px; font-weight: bold;">Application for Transfer of Voter from One Voter Area to Another Voter Area</div>
        </div>

        <div style="margin-bottom: 30px;">
            <div style="font-weight: bold; font-size: 17px; margin-bottom: 5px;">Receiver :</div>
            <div style="margin-left: 60px;">
                Upazila/Thana Election Officer<br>
                <div class="flex-row" style="width: 350px;">
                    <span>Upazila/Thana</span>
                    <div class="dot-line-container">
                        <span class="data-span">{{ $certificate->recipient_upazila_thana_name }}</span>
                    </div>
                </div>
                <div class="flex-row" style="width: 350px;">
                    <span>District</span>
                    <div class="dot-line-container">
                        <span class="data-span">{{ $certificate->recipient_district }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-row">
            <span style="width: 35px; font-weight: bold;">1.</span>
            <span>Applicant's Name :</span>
            <div class="dot-line-container">
                <span class="data-span">{{ $certificate->applicant_name }}</span>
            </div>
        </div>

        <div class="flex-row">
            <span style="width: 35px; font-weight: bold;">2.</span>
            <span>National Identity Card Number (NID) :</span>
            <div class="dot-line-container">
                <span class="data-span">{{ $certificate->applicant_nid }}</span>
            </div>
        </div>
        <div class="text-center" style="font-size: 13px; margin-top: -5px; margin-bottom: 10px; padding-left: 100px;">
            (Photocopy of National Identity Card must be attached)
        </div>

        <div class="flex-row">
            <span style="width: 35px; font-weight: bold;">3.</span>
            <span>Date of Birth :</span>
            <div class="dot-line-container" style="max-width: 450px;">
                <span class="data-span">{{ $certificate->applicant_dob ? date('d/m/Y', strtotime($certificate->applicant_dob)) : '' }}</span>
            </div>
        </div>

        <div class="flex-row" style="margin-top: 10px;">
            <span style="width: 35px; font-weight: bold;">4.</span>
            <span style="font-weight: bold;">Information regarding current enrollment-</span>
        </div>
        <div style="margin-left: 35px; padding-left: 60px;">
            <div class="flex-row">
                <span>Voter Number :</span>
                <div class="dot-line-container" style="max-width: 450px;">
                    <span class="data-span">{{ $certificate->current_voter_no }}</span>
                </div>
            </div>
            <div class="flex-row">
                <span>Voter Area Name :</span>
                <div class="dot-line-container">
                    <span class="data-span">{{ $certificate->current_voter_area_name }}</span>
                </div>
                <span style="margin-left: 15px;">Voter Area Number :</span>
                <div class="dot-line-container" style="max-width: 150px;">
                    <span class="data-span">{{ $certificate->current_voter_area_no }}</span>
                </div>
            </div>
            <div class="flex-row">
                <span>Upazila/Thana :</span>
                <div class="dot-line-container">
                    <span class="data-span">{{ $certificate->current_upazila_thana }}</span>
                </div>
                <span style="margin-left: 15px;">District :</span>
                <div class="dot-line-container" style="max-width: 200px;">
                    <span class="data-span">{{ $certificate->current_district }}</span>
                </div>
            </div>
            <div class="flex-row">
                <span>Village/Road Name & No. :</span>
                <div class="dot-line-container">
                    <span class="data-span">{{ $certificate->current_village_road }}</span>
                </div>
                <span style="margin-left: 15px;">House/Holding No. :</span>
                <div class="dot-line-container" style="max-width: 150px;">
                    <span class="data-span">{{ $certificate->current_house_holding }}</span>
                </div>
            </div>
        </div>

        <div class="flex-row" style="margin-top: 15px;">
            <span style="width: 35px; font-weight: bold;">5.</span>
            <span style="font-weight: bold;">Area willing to transfer to-</span>
        </div>
        <div style="margin-left: 35px; padding-left: 60px;">
            <div class="flex-row">
                <span>District :</span>
                <div class="dot-line-container">
                    <span class="data-span">{{ $certificate->transfer_district }}</span>
                </div>
                <span style="margin-left: 15px;">Upazila/Thana :</span>
                <div class="dot-line-container" style="max-width: 250px;">
                    <span class="data-span">{{ $certificate->transfer_upazila_thana }}</span>
                </div>
            </div>
            <div class="flex-row">
                <span>City Corp/Municipality/Union/Cantt: Board :</span>
                <div class="dot-line-container">
                    <span class="data-span">{{ $certificate->transfer_entity_name }}</span>
                </div>
                <span style="margin-left: 15px;">Ward Number :</span>
                <div class="dot-line-container" style="max-width: 100px;">
                    <span class="data-span">{{ $certificate->transfer_ward_no }}</span>
                </div>
            </div>
            <div class="flex-row">
                <span>Voter Area Name :</span>
                <div class="dot-line-container">
                    <span class="data-span">{{ $certificate->transfer_voter_area_name }}</span>
                </div>
                <span style="margin-left: 15px;">Voter Area Number :</span>
                <div class="dot-line-container" style="max-width: 150px;">
                    <span class="data-span">{{ $certificate->transfer_voter_area_no }}</span>
                </div>
            </div>
            <div class="flex-row">
                <span>Village/Road Name & No. :</span>
                <div class="dot-line-container">
                    <span class="data-span">{{ $certificate->transfer_village_road }}</span>
                </div>
                <span style="margin-left: 15px;">House/Holding No. :</span>
                <div class="dot-line-container" style="max-width: 150px;">
                    <span class="data-span">{{ $certificate->transfer_house_holding }}</span>
                </div>
            </div>
            <div class="flex-row">
                <span>Telephone/Mobile Number :</span>
                <div class="dot-line-container">
                    <span class="data-span">{{ $certificate->transfer_phone_mobile }}</span>
                </div>
            </div>
            <div class="flex-row">
                <span>Post Office :</span>
                <div class="dot-line-container">
                    <span class="data-span">{{ $certificate->transfer_post_office }}</span>
                </div>
                <span style="margin-left: 15px;">Post Code :</span>
                <div class="post-code-box">
                    @php $pc = str_split($certificate->transfer_post_code ?? '    '); @endphp
                    @foreach(array_pad($pc, 4, ' ') as $digit)
                        <span>{{ $digit }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex-row" style="margin-top: 15px;">
            <span style="width: 35px; font-weight: bold;">6.</span>
            <span>Staying at address in serial no. 5 since :</span>
            <div class="dot-line-container">
                <span class="data-span">{{ $certificate->staying_since }}</span>
            </div>
        </div>

        <div class="flex-row">
            <span style="width: 35px; font-weight: bold;">7.</span>
            <span>Reason for transfer:</span>
            <div class="dot-line-container">
                <span class="data-span">{{ $certificate->transfer_reason }}</span>
            </div>
        </div>
    </div>

    <!-- PAGE 2 -->
    <div class="form-container last-page">
        <div class="flex-row">
            <span style="width: 35px; font-weight: bold;">8.</span>
            <span style="font-weight: bold;">The following documents must be attached for serial no. 5 :</span>
        </div>
        <div style="margin-left: 45px; line-height: 2.0; margin-top: 10px;">
            (a) Certificate from Class I Officer/ Cantonment Board Executive Officer/ Mayor of City Corp/Municipality /Ward Councilor/Union Parishad Chairman.<br>
            (b) Copy of Utility Bill (if any)<br>
            (c) House Rent Receipt/Chowkidar Tax Receipt/Municipal Tax Receipt/Others
        </div>

        <div style="margin-top: 80px; text-align: right; padding-right: 20px;">
            <div style="display: inline-block; text-align: center;">
                <div style="color: #000; font-weight: bold; letter-spacing: 2px; margin-bottom: 5px;">................................................</div>
                <div style="font-weight: bold;">Applicant's Signature or Thumb Impression</div>
            </div>
        </div>

        <div style="margin-top: 50px;">
            <div class="flex-row">
                <span style="font-weight: bold;">Identifier's Signature :</span>
                <div class="dot-line-container"></div>
            </div>
            <div style="margin-left: 150px; margin-top: 10px;">
                <div class="flex-row">Name :<div class="dot-line-container"><span class="data-span">{{ $certificate->identifier_name }}</span></div></div>
                <div class="flex-row">National Identity Card Number :<div class="dot-line-container"><span class="data-span">{{ $certificate->identifier_nid }}</span></div></div>
                <div class="flex-row">Address :<div class="dot-line-container"><span class="data-span">{{ $certificate->identifier_address }}</span></div></div>
            </div>
        </div>

        <div style="text-align: center; margin-top: 60px; margin-bottom: 30px; font-weight: bold; font-size: 17px;">
            [For Office Use Only]
        </div>

        <div style="line-height: 2.5; text-align: justify; font-size: 16px; margin-bottom: 40px;">
            <div class="flex-row">
                After examining submitted documents
                <div class="dot-line-container" style="min-width: 250px;">
                </div>
                voter list name was deleted
            </div>
            <div class="flex-row">
                from and
                <div class="dot-line-container" style="max-width: 350px;">
                </div>
                voter area name was included.
            </div>
        </div>

        <div style="text-align: right; margin-top: 60px; padding-right: 20px;">
            <div style="display: inline-block; text-align: center;">
                <div style="color: #000; font-weight: bold; letter-spacing: 2px; margin-bottom: 5px;">................................................</div>
                <div style="font-weight: bold;">Upazila/Thana Election Officer</div>
            </div>
        </div>

        <div style="margin-top: 60px; margin-bottom: 30px; border-top: 1px dashed #000; width: 100%;"></div>

        <div style="text-align: center; margin-bottom: 25px; font-weight: bold; font-size: 19px;">
            Acknowledgement Receipt
        </div>

        <div style="line-height: 2.2; font-size: 16px;">
            <div class="flex-row">
                Mr./Mrs.
                <div class="dot-line-container">
                    <span class="data-span">{{ $certificate->applicant_name }}</span>
                </div>
                application form has been accepted.
            </div>
            <div class="flex-row">
                Application Form Number
                <div class="dot-line-container" style="max-width: 400px;">
                </div>
            </div>
        </div>

        <div style="text-align: right; margin-top: 60px; padding-right: 20px;">
            <div style="display: inline-block; text-align: center;">
                <div style="color: #000; font-weight: bold; letter-spacing: 2px; margin-bottom: 5px;">................................................</div>
                <div style="font-weight: bold;">Receiver's Signature</div>
            </div>
        </div>
    </div>

    <div class="print-controls">
        <button class="btn btn-danger btn-lg px-5" style="font-size: 18px;" onclick="window.location.href='{{ route('voter-area.index') }}'"><i class="fas fa-times me-2"></i> Cancel</button>
        <button class="btn btn-primary btn-lg px-5 ms-4" style="font-size: 18px;" onclick="window.print();"><i class="fas fa-print me-2"></i> Print Certificate</button>
    </div>
</div>
@endsection