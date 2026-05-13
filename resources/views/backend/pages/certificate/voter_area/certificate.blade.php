@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'VoterArea'])
@push('style')
<style>
    .form-container {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: 20px auto;
        background: white;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        font-family: 'Arial', sans-serif;
        color: #000;
        line-height: 1.5;
        font-size: 15px;
    }

    .dotted-line {
        border-bottom: 1px dotted #000;
        display: inline-block;
        min-height: 1em;
    }

    .post-code-box {
        display: inline-flex;
        border: 1px solid #000;
        margin-left: 10px;
        vertical-align: middle;
    }

    .post-code-box span {
        width: 30px;
        height: 30px;
        border-right: 1px solid #000;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .post-code-box span:last-child {
        border-right: none;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        padding: 8px 0;
    }

    @media print {
        @page {
            size: A4 portrait;
            margin: 0;
        }
        body {
            background: none !important;
            margin: 0;
            padding: 0;
        }
        .form-container {
            box-shadow: none;
            margin: 0;
            padding: 15mm 20mm;
            width: 210mm;
            min-height: 297mm;
            page-break-after: always;
        }
        .form-container:last-child {
            page-break-after: auto;
        }
        #printPageButton, #cancelPageButton, .content-header, .main-header, .main-sidebar, .main-footer {
            display: none !important;
        }
    }
</style>
@endpush

@section('title', 'Voter Transfer Form-13')

@section('content')
<div class="container-fluid py-4" style="background: #f4f6f9;">
    
    <div class="text-center mb-4">
        <button id="cancelPageButton" class="btn btn-danger px-4" onclick="window.location.href='{{ route('voter-area.index') }}'">Cancel</button>
        <button id="printPageButton" class="btn btn-success px-4 ms-2" onclick="window.print();">Print</button>
    </div>

    <!-- PAGE 1 -->
    <div class="form-container">
        <div class="text-center font-weight-bold" style="margin-bottom: 30px; font-size: 18px;">
            <div>Form-13</div>
            <div>[See Rule 26(7)]</div>
            <div style="margin-top: 15px;">Application for Transfer of Voter from One Voter Area to Another Voter Area</div>
        </div>

        <div style="margin-bottom: 20px;">
            <strong>Recipient :</strong><br>
            <div style="margin-left: 40px; line-height: 2;">
                Upazila/Thana Election Officer<br>
                Upazila/Thana <span class="dotted-line" style="width: 250px;">{{ $certificate->recipient_upazila_thana_name }}</span><br>
                District <span class="dotted-line" style="width: 250px;">{{ $certificate->recipient_district }}</span>
            </div>
        </div>

        <table style="width: 100%; border: none;">
            <tr>
                <td style="width: 40px; vertical-align: top;">1.</td>
                <td>Applicant's Name : <span class="dotted-line" style="min-width: 400px;">{{ $certificate->applicant_name }}</span></td>
            </tr>
            <tr>
                <td style="vertical-align: top;">2.</td>
                <td>National Identity Card Number (NID) : <span class="dotted-line" style="min-width: 300px;">{{ $certificate->applicant_nid }}</span>
                    <div style="text-align: right; padding-right: 50px; font-size: 13px; margin-top: 5px;">(Photocopy of National Identity Card must be attached)</div>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">3.</td>
                <td>Date of Birth : <span class="dotted-line" style="min-width: 200px;">{{ $certificate->applicant_dob ? date('d/m/Y', strtotime($certificate->applicant_dob)) : '' }}</span></td>
            </tr>
            <tr>
                <td style="vertical-align: top;">4.</td>
                <td>Information regarding current enrollment
                    <table style="width: 100%; margin-left: 30px; line-height: 2;">
                        <tr>
                            <td colspan="2">Voter Number : <span class="dotted-line" style="min-width: 300px;">{{ $certificate->current_voter_no }}</span></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">Voter Area Name: <span class="dotted-line" style="min-width: 200px;">{{ $certificate->current_voter_area_name }}</span></td>
                            <td style="width: 50%;">Voter Area Number : <span class="dotted-line" style="min-width: 150px;">{{ $certificate->current_voter_area_no }}</span></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">Upazila/Thana : <span class="dotted-line" style="min-width: 200px;">{{ $certificate->current_upazila_thana }}</span></td>
                            <td style="width: 50%;">District : <span class="dotted-line" style="min-width: 150px;">{{ $certificate->current_district }}</span></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">Village/Road Name & Number : <span class="dotted-line" style="min-width: 200px;">{{ $certificate->current_village_road }}</span></td>
                            <td style="width: 50%;">House/Holding Number : <span class="dotted-line" style="min-width: 150px;">{{ $certificate->current_house_holding }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">5.</td>
                <td>Area willing to transfer to
                    <table style="width: 100%; margin-left: 30px; line-height: 2;">
                        <tr>
                            <td style="width: 40%;">District : <span class="dotted-line" style="min-width: 150px;">{{ $certificate->transfer_district }}</span></td>
                            <td style="width: 60%;">Upazila/Thana : <span class="dotted-line" style="min-width: 200px;">{{ $certificate->transfer_upazila_thana }}</span></td>
                        </tr>
                        <tr>
                            <td colspan="2">{{ $certificate->transfer_entity_type ?? 'City Corp/Municipality/Union' }} : <span class="dotted-line" style="min-width: 200px;">{{ $certificate->transfer_entity_name }}</span> Ward Number : <span class="dotted-line" style="min-width: 80px;">{{ $certificate->transfer_ward_no }}</span></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">Voter Area Name : <span class="dotted-line" style="min-width: 200px;">{{ $certificate->transfer_voter_area_name }}</span></td>
                            <td style="width: 50%;">Voter Area Number : <span class="dotted-line" style="min-width: 150px;">{{ $certificate->transfer_voter_area_no }}</span></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">Village/Road Name & No. : <span class="dotted-line" style="min-width: 200px;">{{ $certificate->transfer_village_road }}</span></td>
                            <td style="width: 50%;">House/Holding No. : <span class="dotted-line" style="min-width: 150px;">{{ $certificate->transfer_house_holding }}</span></td>
                        </tr>
                        <tr>
                            <td colspan="2">Telephone/Mobile Number : <span class="dotted-line" style="min-width: 250px;">{{ $certificate->transfer_phone_mobile }}</span></td>
                        </tr>
                        <tr>
                            <td style="width: 60%;">Post Office : <span class="dotted-line" style="min-width: 200px;">{{ $certificate->transfer_post_office }}</span></td>
                            <td style="width: 40%;">Post Code : 
                                <div class="post-code-box">
                                    @php $pc = str_split($certificate->transfer_post_code ?? '    '); @endphp
                                    @foreach(array_pad($pc, 4, ' ') as $digit)
                                        <span>{{ $digit }}</span>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">6.</td>
                <td>Staying at the address mentioned in serial no. 5 since : <span class="dotted-line" style="min-width: 250px;">{{ $certificate->staying_since }}</span></td>
            </tr>
            <tr>
                <td style="vertical-align: top;">7.</td>
                <td>Reason for transfer: <span class="dotted-line" style="min-width: 400px;">{{ $certificate->transfer_reason }}</span></td>
            </tr>
        </table>
    </div>

    <!-- PAGE 2 -->
    <div class="form-container">
        <table style="width: 100%; border: none;">
            <tr>
                <td style="width: 40px; vertical-align: top;">8.</td>
                <td>The following documents must be attached in support of staying at the address mentioned in serial no. 5 :
                    <div style="margin-left: 20px; line-height: 1.8; margin-top: 10px;">
                        (a) Certificate issued by Class I Officer/ Cantonment Board Executive Officer/ Mayor of City Corporation/Municipality / Ward<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Councilor/ Union Parishad Chairman.<br>
                        (b) Copy of Utility Bill (if any)<br>
                        (c) House Rent Receipt/Choukidari Tax Receipt/Municipal Tax Receipt/Others
                    </div>
                </td>
            </tr>
        </table>

        <div style="text-align: right; margin-top: 80px;">
            <span class="dotted-line" style="width: 280px;"></span><br>
            <strong>Applicant's Signature or Thumb Impression</strong>
        </div>

        <div style="margin-top: 80px;">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 30%;"></td>
                    <td style="width: 70%;">
                        <div style="margin-bottom: 15px;">
                            <strong>Identifier's Signature :</strong> <span class="dotted-line" style="width: calc(100% - 180px);"></span>
                        </div>
                        <div style="margin-bottom: 10px; padding-left: 60px;">
                            Name : <span class="dotted-line" style="width: calc(100% - 70px);">{{ $certificate->identifier_name }}</span>
                        </div>
                        <div style="margin-bottom: 10px; padding-left: 60px;">
                            National Identity Card Number : <span class="dotted-line" style="width: calc(100% - 240px);">{{ $certificate->identifier_nid }}</span>
                        </div>
                        <div style="padding-left: 60px;">
                            Address : <span class="dotted-line" style="width: calc(100% - 90px);">{{ $certificate->identifier_address }}</span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div style="text-align: center; margin-top: 60px; margin-bottom: 30px;">
            <strong>[For Office Use Only]</strong>
        </div>

        <div style="line-height: 2.5;">
            After examining the submitted documents, name deleted from the voter list prepared for the voter area <span class="dotted-line" style="width: 25%;"></span> and name included in the voter area <span class="dotted-line" style="width: 25%;"></span>.
        </div>

        <div style="text-align: right; margin-top: 80px;">
            <span class="dotted-line" style="width: 250px;"></span><br>
            <strong>Upazila/Thana Election Officer</strong><br>
            <span class="dotted-line" style="width: 250px;"></span>
        </div>

        <div style="margin-top: 40px; margin-bottom: 40px; border-top: 1px dotted #000;"></div>

        <div style="text-align: center; margin-bottom: 30px;">
            <strong>Acknowledgement Receipt</strong>
        </div>

        <div style="line-height: 2.5;">
            Mr./Mrs. <strong>{{ $certificate->applicant_name }}</strong> 's application form has been accepted.<br>
            Application Form Number <strong>{{ $certificate->system_id }}</strong>
        </div>

        <div style="text-align: right; margin-top: 80px;">
            <span class="dotted-line" style="width: 200px;"></span><br>
            <strong>Receiver's Signature</strong>
        </div>
    </div>
</div>
@endsection