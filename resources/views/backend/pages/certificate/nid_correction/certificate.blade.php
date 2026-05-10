@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'NidCorrection'])
@push('style')
<style>
    .form-container {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: auto;
        background: white;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        font-family: 'sans-serif', sans-serif;
        color: #000;
        line-height: 1.5;
    }

    .form-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-title {
        font-weight: bold;
        font-size: 20px;
        margin-bottom: 5px;
    }

    .form-subtitle {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .dotted-line {
        border-bottom: 1px dotted #000;
        display: inline-block;
        min-width: 50px;
        padding: 0 5px;
    }

    .section-title {
        font-weight: bold;
        margin-top: 15px;
        margin-bottom: 10px;
    }

    .post-code-box {
        display: inline-flex;
        border: 1px solid #000;
        margin-left: 10px;
    }

    .post-code-box span {
        width: 25px;
        height: 25px;
        border-right: 1px solid #000;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .post-code-box span:last-child {
        border-right: none;
    }

    @media print {
        @page {
            size: A4 portrait;
            margin: 0;
        }
        body {
            background: none !important;
        }
        .form-container {
            box-shadow: none;
            margin: 0;
            width: 100%;
        }
        #printPageButton, #cancelPageButton {
            display: none !important;
        }
    }
</style>
@endpush

@section('title', 'Voter Transfer Form-13 (EN)')

@section('content')
<div class="container py-4">
    <div class="form-container">
        <div class="form-header">
            <div class="form-title">Form-13</div>
            <div class="form-subtitle">[See Rule 26(7)]</div>
            <div class="font-weight-bold uppercase">Application for Voter Transfer from one voter area to another voter area</div>
        </div>

        <div class="mb-4">
            <strong>To :</strong><br>
            Upazila/Thana Election Officer<br>
            <span class="dotted-line" style="min-width: 200px;">{{ $certificate->recipient_upazila_thana_name }}</span><br>
            District : <span class="dotted-line" style="min-width: 200px;">{{ $certificate->recipient_district }}</span>
        </div>

        <div class="mb-2">
            1. Applicant's Name : <span class="dotted-line" style="min-width: 80%;">{{ $certificate->applicant_name }}</span>
        </div>

        <div class="mb-2">
            2. National Identity Card Number (NID) : <span class="dotted-line" style="min-width: 60%;">{{ $certificate->applicant_nid }}</span>
        </div>

        <div class="mb-2 text-right text-muted small">
            (A photocopy of the National Identity Card must be attached)
        </div>

        <div class="mb-3">
            3. Date of Birth : <span class="dotted-line" style="min-width: 200px;">{{ $certificate->applicant_dob ? date('d/m/Y', strtotime($certificate->applicant_dob)) : '' }}</span>
        </div>

        <div class="mb-3">
            <strong>4. Current Enrollment Information-</strong>
            <div class="pl-4 mt-2">
                Voter Number : <span class="dotted-line" style="min-width: 80%;">{{ $certificate->current_voter_no }}</span><br>
                Voter Area Name : <span class="dotted-line" style="min-width: 40%;">{{ $certificate->current_voter_area_name }}</span>
                Voter Area Number : <span class="dotted-line" style="min-width: 30%;">{{ $certificate->current_voter_area_no }}</span><br>
                Upazila/Thana : <span class="dotted-line" style="min-width: 40%;">{{ $certificate->current_upazila_thana }}</span>
                District : <span class="dotted-line" style="min-width: 40%;">{{ $certificate->current_district }}</span><br>
                Village/Road Name and Number : <span class="dotted-line" style="min-width: 40%;">{{ $certificate->current_village_road }}</span>
                House/Holding Number : <span class="dotted-line" style="min-width: 30%;">{{ $certificate->current_house_holding }}</span>
            </div>
        </div>

        <div class="mb-3">
            <strong>5. Information of the area where transfer is desired-</strong>
            <div class="pl-4 mt-2">
                District : <span class="dotted-line" style="min-width: 40%;">{{ $certificate->transfer_district }}</span>
                Upazila/Thana : <span class="dotted-line" style="min-width: 40%;">{{ $certificate->transfer_upazila_thana }}</span><br>
                {{ $certificate->transfer_entity_type }} : <span class="dotted-line" style="min-width: 40%;">{{ $certificate->transfer_entity_name }}</span>
                Ward Number : <span class="dotted-line" style="min-width: 30%;">{{ $certificate->transfer_ward_no }}</span><br>
                Voter Area Name : <span class="dotted-line" style="min-width: 40%;">{{ $certificate->transfer_voter_area_name }}</span>
                Voter Area Number : <span class="dotted-line" style="min-width: 30%;">{{ $certificate->transfer_voter_area_no }}</span><br>
                Village/Road Name and Number : <span class="dotted-line" style="min-width: 40%;">{{ $certificate->transfer_village_road }}</span>
                House/Holding Number : <span class="dotted-line" style="min-width: 30%;">{{ $certificate->transfer_house_holding }}</span><br>
                Telephone/Mobile Phone Number : <span class="dotted-line" style="min-width: 80%;">{{ $certificate->transfer_phone_mobile }}</span><br>
                Post Office : <span class="dotted-line" style="min-width: 50%;">{{ $certificate->transfer_post_office }}</span>
                Post Code : 
                <div class="post-code-box">
                    @php $pc = str_split($certificate->transfer_post_code ?? '    '); @endphp
                    @foreach($pc as $digit)
                        <span>{{ $digit }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mb-3">
            6. Since when residing at the address described in serial number 5 : <span class="dotted-line" style="min-width: 50%;">{{ $certificate->staying_since }}</span>
        </div>

        <div class="mb-4">
            7. Reason for Transfer : <span class="dotted-line" style="min-width: 80%;">{{ $certificate->transfer_reason }}</span>
        </div>

        <div class="row mt-5 pt-4">
            <div class="col-6"></div>
            <div class="col-6 text-center">
                ..................................................<br>
                <strong>Signature or Thumb Impression of the Applicant</strong>
            </div>
        </div>

        <div class="mt-5">
            <strong>Signature of the Identifier :</strong> .................................................<br>
            Name : <span class="dotted-line" style="min-width: 300px;">{{ $certificate->identifier_name }}</span><br>
            National Identity Card Number : <span class="dotted-line" style="min-width: 300px;">{{ $certificate->identifier_nid }}</span><br>
            Address : <span class="dotted-line" style="min-width: 400px;">{{ $certificate->identifier_address }}</span>
        </div>

        <div class="mt-4 p-3 border text-center small font-italic">
            [For Office Use Only]
        </div>

        <div class="mt-4 row">
            <div class="col-12 text-center">
                <strong>Acknowledgment Receipt</strong>
            </div>
            <div class="col-12 mt-2">
                Application form of Mr./Mrs. <span class="dotted-line" style="min-width: 300px;">{{ $certificate->applicant_name }}</span> has been received.<br>
                Application Form Number <span class="dotted-line" style="min-width: 200px;">{{ $certificate->system_id }}</span>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <button id="cancelPageButton" class="btn btn-danger btn-sm px-4" onclick="window.location.href='{{ route('nid-correction.index') }}'">Cancel</button>
        <button id="printPageButton" class="btn btn-success btn-sm px-4 ms-2" onclick="window.print();">Print</button>
    </div>
</div>
@endsection