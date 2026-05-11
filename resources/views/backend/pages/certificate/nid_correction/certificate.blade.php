@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'NidCorrection'])

@push('style')
<style>
    .form-container {
        width: 210mm;
        min-height: 297mm;
        padding: 15mm;
        margin: auto;
        background: white;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        font-family: 'Times New Roman', Times, serif;
        color: #000;
        line-height: 1.4;
        position: relative;
    }

    .form-header {
        text-align: center;
        margin-bottom: 10px;
    }

    .form-title {
        font-weight: bold;
        font-size: 18px;
        text-decoration: underline;
        margin-bottom: 5px;
    }

    .form-subtitle {
        font-size: 14px;
        margin-bottom: 10px;
    }

    .staple-box {
        position: absolute;
        top: 20mm;
        right: 15mm;
        width: 40mm;
        height: 40mm;
        border: 1px solid #000;
        text-align: center;
        padding: 5px;
        font-size: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .nid-digits {
        display: inline-flex;
        border-left: 1px solid #000;
        margin-left: 10px;
    }

    .nid-digits span {
        width: 22px;
        height: 25px;
        border-top: 1px solid #000;
        border-right: 1px solid #000;
        border-bottom: 1px solid #000;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 14px;
    }

    .dotted-line {
        border-bottom: 1px dotted #000;
        display: inline-block;
        padding: 0 5px;
    }

    .table-correction {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .table-correction th, .table-correction td {
        border: 1px solid #000;
        padding: 5px;
        font-size: 13px;
    }

    .table-correction th {
        background: #f0f0f0;
        text-align: center;
    }

    .section-num {
        font-weight: bold;
        margin-top: 10px;
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
            padding: 10mm;
        }
        #printPageButton, #cancelPageButton {
            display: none !important;
        }
    }
</style>
@endpush

@section('title', 'NID Correction Form-2 (EN)')

@section('content')
@php
    // Fallback to user profile for pre-migration records with empty fields
    $displayName   = $certificate->applicant_name_en ?: ($certificate->applicant_name ?: ($certificate->user->name ?? ''));
    $displayNid    = $certificate->applicant_nid ?: ($certificate->user->people->nid ?? '');
    $displayMobile = $certificate->applicant_mobile ?: ($certificate->user->mobile ?? '');
    $displayAddr   = $certificate->applicant_address ?: implode(', ', array_filter([
        $certificate->user->addressInfo->permanentVillage->bn_name ?? null,
        $certificate->user->institute->union->thana->bn_name ?? null,
        $certificate->user->institute->union->thana->district->bn_name ?? null,
    ]));
    $displayFather = $certificate->applicant_father_name ?: ($certificate->user->familyInfo->father_name_en ?? '');
    $displayMother = $certificate->applicant_mother_name ?: ($certificate->user->familyInfo->mother_name_en ?? '');
@endphp
<div class="container py-4">
    <div class="form-container">
        <div class="form-header">
            <p class="mb-0"><strong>Form-2</strong></p>
            <p class="mb-0" style="font-size: 12px;">[See Regulation 4]</p>
            <h1 class="form-title">Application for Correction of National Identity Card or Data</h1>
        </div>

        <div class="staple-box">
            Attach Original National Identity Card Here (Staple)
        </div>

        <div class="row">
            <div class="col-8">
                <p class="mb-1">Serial Number: <span class="dotted-line" style="min-width: 100px;">{{ $certificate->system_id }}</span></p>
                <p class="mb-1" style="font-size: 11px;">(To be filled by office)</p>
            </div>
            <div class="col-4">
                <p class="mb-1">Application Date: <span class="dotted-line" style="min-width: 120px;">{{ date('d/m/Y', strtotime($certificate->created_at)) }}</span></p>
            </div>
        </div>

        <div class="section-num">1. Information of the National ID Holder -</div>
        <div class="pl-4">
            (a) Name: <span class="dotted-line" style="min-width: 80%;">{{ $displayName }}</span><br>
            (b) National Identification Number (NID): 
            <div class="nid-digits">
                @php 
                    $nid = str_pad($displayNid, 17, ' ', STR_PAD_LEFT);
                    $digits = str_split($nid);
                @endphp
                @foreach($digits as $digit)
                    <span>{{ $digit }}</span>
                @endforeach
            </div>
        </div>

        <div class="section-num">2. In case of NID holder under 18 or declared incompetent by court, information of Legal Guardian -</div>
        <div class="pl-4">
            (a) Name: <span class="dotted-line" style="min-width: 80%;">{{ $certificate->guardian_name }}</span><br>
            (b) National Identification Number (NID): <span class="dotted-line" style="min-width: 60%;">{{ $certificate->guardian_nid }}</span>
        </div>

        <div class="section-num">3. Information to be corrected in NID or stored data:</div>
        
        <table class="table-correction">
            <thead>
                <tr>
                    <th style="width: 20%;">Subject</th>
                    <th style="width: 35%;">Existing Information in NID/Data</th>
                    <th style="width: 35%;">Requested Corrected Information</th>
                    <th style="width: 10%;">Remarks</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $fields = [
                        'name_bn' => '(a) Name (Bengali)',
                        'name_en' => '(b) Name (English)',
                        'father_name' => '(c) Father\'s Name',
                        'mother_name' => '(d) Mother\'s Name',
                        'husband_name' => '(e) Husband\'s Name',
                        'dob' => '(f) Date of Birth',
                        'address' => '(g) Address',
                        'blood_group' => '(h) Blood Group',
                        'others' => '(i) Others'
                    ];
                @endphp
                @foreach($fields as $key => $label)
                <tr>
                    <td>{{ $label }}</td>
                    <td>{{ $certificate->correction_data[$key]['old'] ?? '' }}</td>
                    <td>{{ $certificate->correction_data[$key]['new'] ?? '' }}</td>
                    <td>{{ isset($certificate->correction_data[$key]['active']) ? 'Correction' : '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="section-num">4. Amount of Fees Deposited:</div>
        <p class="pl-4 mb-1"><span class="dotted-line" style="min-width: 200px;">{{ $certificate->payment_amount }} BDT</span></p>

        <div class="section-num">5. Payment Receipt Number (where applicable):</div>
        <p class="pl-4 mb-1"><span class="dotted-line" style="min-width: 200px;">{{ $certificate->payment_receipt_no }}</span></p>

        <div class="section-num">6. Description of documents attached with the application:</div>
        <p class="pl-4 mb-3"><span class="dotted-line" style="min-width: 90%;">{{ $certificate->attachments_list }}</span></p>

        <div class="row mt-5">
            <div class="col-6">
                <p class="mb-0">..................................................</p>
                <p class="mb-0"><strong>Signature/Thumb Impression of Legal Guardian</strong></p>
                <p class="mb-0">Name: <span class="dotted-line" style="min-width: 150px;">{{ $certificate->guardian_name }}</span></p>
                <p class="mb-0">Address: <span class="dotted-line" style="min-width: 150px;"></span></p>
                <p class="mb-0">Mobile Number: <span class="dotted-line" style="min-width: 150px;"></span></p>
            </div>
            <div class="col-6">
                <p class="mb-0">..................................................</p>
                <p class="mb-0"><strong>Signature/Thumb Impression of Applicant</strong></p>
                <p class="mb-0">Name: <span class="dotted-line" style="min-width: 150px;">{{ $displayName }}</span></p>
                <p class="mb-0">Address: <span class="dotted-line" style="min-width: 150px;">{{ $displayAddr }}</span></p>
                <p class="mb-0">Mobile Number: <span class="dotted-line" style="min-width: 150px;">{{ $displayMobile }}</span></p>
            </div>
        </div>

        <div class="mt-5 text-center" style="border-top: 1px solid #eee; padding-top: 20px;">
            <div style="font-size: 11px; font-weight: bold; color: #666; text-transform: uppercase; letter-spacing: 3px; margin-bottom: 12px;">POWERED BY</div>
            <img src="{{ public_path('frontend/img/adv_soft_logo.png') }}" style="height: 60px; margin-bottom: 8px;">
            <div style="font-size: 18px; font-weight: bold; color: #222; letter-spacing: -0.5px;">Adventure Soft</div>
            <div style="font-size: 9px; color: #888; font-style: italic; margin-top: 2px;">...for comfortable life with technology</div>
            <div style="font-size: 8px; color: #aaa; margin-top: 10px; text-transform: uppercase; letter-spacing: 1px;">This report generated by UPMS</div>
        </div>
    </div>

    <div class="text-center mt-4">
        <button id="cancelPageButton" class="btn btn-danger btn-sm px-4" onclick="window.location.href='{{ route('nid-correction.index') }}'">Cancel</button>
        <button id="printPageButton" class="btn btn-success btn-sm px-4 ms-2" onclick="window.print();">Print Form-2</button>
    </div>
</div>
@endsection