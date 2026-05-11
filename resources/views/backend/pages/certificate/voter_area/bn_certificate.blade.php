@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'VoterArea'])
@push('style')
<style>
    .form-container {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: auto;
        background: white;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        font-family: 'Nikosh', sans-serif;
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

@section('title', 'Voter Transfer Form-13')

@section('content')
<div class="container py-4">
    <div class="form-container">
        <div class="form-header">
            <div class="form-title">ফরম-১৩</div>
            <div class="form-subtitle">[বিধি ২৬(৭) দ্রষ্টব্য]</div>
            <div class="font-weight-bold">এক ভোটার এলাকা হইতে অন্য ভোটার এলাকায় ভোটার স্থানান্তরের আবেদন</div>
        </div>

        <div class="mb-4">
            <strong>প্রাপক :</strong><br>
            উপজেলা/থানা নির্বাচন অফিসার<br>
            <span class="dotted-line" style="min-width: 200px;">{{ $certificate->recipient_upazila_thana_name }}</span><br>
            জেলা : <span class="dotted-line" style="min-width: 200px;">{{ $certificate->recipient_district }}</span>
        </div>

        <div class="mb-2">
            ১। আবেদনকারীর নাম : <span class="dotted-line" style="min-width: 80%;">{{ $certificate->applicant_name }}</span>
        </div>

        <div class="mb-2">
            ২। জাতীয় পরিচয়পত্র নম্বর (NID) : <span class="dotted-line" style="min-width: 75%;">{{ bnValue($certificate->applicant_nid) }}</span>
        </div>

        <div class="mb-2 text-right text-muted small">
            (জাতীয় পরিচয়পত্রের ছায়ালিপি সংযুক্ত করিতে হইবে)
        </div>

        <div class="mb-3">
            ৩। জন্ম তারিখ : <span class="dotted-line" style="min-width: 200px;">{{ $certificate->applicant_dob ? bnValue(date('d/m/Y', strtotime($certificate->applicant_dob))) : '' }}</span>
        </div>

        <div class="mb-3">
            <strong>৪। বর্তমান তালিকাভুক্তি সংক্রান্ত তথ্যাদি-</strong>
            <div class="pl-4 mt-2">
                ভোটার নম্বর : <span class="dotted-line" style="min-width: 80%;">{{ bnValue($certificate->current_voter_no) }}</span><br>
                ভোটার এলাকার নাম : <span class="dotted-line" style="min-width: 40%;">{{ $certificate->current_voter_area_name }}</span>
                ভোটার এলাকার নম্বর : <span class="dotted-line" style="min-width: 30%;">{{ bnValue($certificate->current_voter_area_no) }}</span><br>
                উপজেলা/থানা : <span class="dotted-line" style="min-width: 40%;">{{ $certificate->current_upazila_thana }}</span>
                জেলা : <span class="dotted-line" style="min-width: 40%;">{{ $certificate->current_district }}</span><br>
                গ্রাম/রাস্তার নাম ও নম্বর : <span class="dotted-line" style="min-width: 40%;">{{ $certificate->current_village_road }}</span>
                বাসা/হোল্ডিং নম্বর : <span class="dotted-line" style="min-width: 30%;">{{ bnValue($certificate->current_house_holding) }}</span>
            </div>
        </div>

        <div class="mb-3">
            <strong>৫। যে এলাকায় স্থানান্তর হইতে ইচ্ছুক-</strong>
            <div class="pl-4 mt-2">
                জেলা : <span class="dotted-line" style="min-width: 40%;">{{ $certificate->transfer_district }}</span>
                উপজেলা/থানা : <span class="dotted-line" style="min-width: 40%;">{{ $certificate->transfer_upazila_thana }}</span><br>
                {{ $certificate->transfer_entity_type }} : <span class="dotted-line" style="min-width: 40%;">{{ $certificate->transfer_entity_name }}</span>
                ওয়ার্ড নম্বর : <span class="dotted-line" style="min-width: 30%;">{{ bnValue($certificate->transfer_ward_no) }}</span><br>
                ভোটার এলাকার নাম : <span class="dotted-line" style="min-width: 40%;">{{ $certificate->transfer_voter_area_name }}</span>
                ভোটার এলাকার নম্বর : <span class="dotted-line" style="min-width: 30%;">{{ bnValue($certificate->transfer_voter_area_no) }}</span><br>
                গ্রাম/রাস্তার নাম ও নম্বর : <span class="dotted-line" style="min-width: 40%;">{{ $certificate->transfer_village_road }}</span>
                বাসা/হোল্ডিং নম্বর : <span class="dotted-line" style="min-width: 30%;">{{ bnValue($certificate->transfer_house_holding) }}</span><br>
                টেলিফোন/মোবাইল ফোন নম্বর : <span class="dotted-line" style="min-width: 80%;">{{ bnValue($certificate->transfer_phone_mobile) }}</span><br>
                ডাকঘর : <span class="dotted-line" style="min-width: 50%;">{{ $certificate->transfer_post_office }}</span>
                পোস্ট কোড : 
                <div class="post-code-box">
                    @php $pc = str_split($certificate->transfer_post_code ?? '    '); @endphp
                    @foreach($pc as $digit)
                        <span>{{ bnValue($digit) }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mb-3">
            ৬। ৫ নম্বর ক্রমিকে বর্ণিত ঠিকানায় যে সময় হইতে অবস্থান করিতেছেন : <span class="dotted-line" style="min-width: 50%;">{{ $certificate->staying_since }}</span>
        </div>

        <div class="mb-4">
            ৭। স্থানান্তরের কারণ : <span class="dotted-line" style="min-width: 80%;">{{ $certificate->transfer_reason }}</span>
        </div>

        <div class="row mt-5 pt-4">
            <div class="col-6"></div>
            <div class="col-6 text-center">
                ..................................................<br>
                <strong>আবেদনকারীর স্বাক্ষর বা টিপসহি</strong>
            </div>
        </div>

        <div class="mt-5">
            <strong>আবেদনকারীকে সনাক্তকারীর স্বাক্ষর :</strong> .................................................<br>
            নাম : <span class="dotted-line" style="min-width: 300px;">{{ $certificate->identifier_name }}</span><br>
            জাতীয় পরিচয়পত্র নম্বর : <span class="dotted-line" style="min-width: 300px;">{{ bnValue($certificate->identifier_nid) }}</span><br>
            ঠিকানা : <span class="dotted-line" style="min-width: 400px;">{{ $certificate->identifier_address }}</span>
        </div>

        <div class="mt-4 p-3 border text-center small font-italic">
            [কেবলমাত্র অফিসে ব্যবহারের জন্য]
        </div>

        <div class="mt-4 row">
            <div class="col-12 text-center">
                <strong>প্রাপ্তিস্বীকার পত্র</strong>
            </div>
            <div class="col-12 mt-2">
                জনাব/বেগম <span class="dotted-line" style="min-width: 300px;">{{ $certificate->applicant_name }}</span> এর আবেদন ফরম গৃহীত হইল।<br>
                আবেদন ফরম নম্বর <span class="dotted-line" style="min-width: 200px;">{{ bnValue($certificate->system_id) }}</span>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <button id="cancelPageButton" class="btn btn-danger btn-sm px-4" onclick="window.location.href='{{ route('voter-area.index') }}'">Cancel</button>
        <button id="printPageButton" class="btn btn-success btn-sm px-4 ms-2" onclick="window.print();">Print</button>
    </div>
</div>
@endsection