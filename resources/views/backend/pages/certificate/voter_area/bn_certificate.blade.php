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
        font-family: 'Nikosh', sans-serif;
        color: #000;
        line-height: 1.5;
        font-size: 16px;
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
            <div>ফরম-১৩</div>
            <div>[বিধি ২৬(৭) দ্রষ্টব্য]</div>
            <div style="margin-top: 15px;">এক ভোটার এলাকা হইতে অন্য ভোটার এলাকায় ভোটার স্থানান্তরের আবেদন</div>
        </div>

        <div style="margin-bottom: 20px;">
            <strong>প্রাপক :</strong><br>
            <div style="margin-left: 40px; line-height: 2;">
                উপজেলা/থানা নির্বাচন অফিসার<br>
                উপজেলা/থানা <span class="dotted-line" style="width: 250px;">{{ $certificate->recipient_upazila_thana_name }}</span><br>
                জেলা <span class="dotted-line" style="width: 250px;">{{ $certificate->recipient_district }}</span>
            </div>
        </div>

        <table style="width: 100%; border: none;">
            <tr>
                <td style="width: 40px; vertical-align: top;">১।</td>
                <td>আবেদনকারীর নাম : <span class="dotted-line" style="min-width: 400px;">{{ $certificate->applicant_name }}</span></td>
            </tr>
            <tr>
                <td style="vertical-align: top;">২।</td>
                <td>জাতীয় পরিচয়পত্র নম্বর (NID) : <span class="dotted-line" style="min-width: 300px;">{{ bnValue($certificate->applicant_nid) }}</span>
                    <div style="text-align: right; padding-right: 50px; font-size: 14px; margin-top: 5px;">(জাতীয় পরিচয়পত্রের ছায়ালিপি সংযুক্ত করিতে হইবে)</div>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">৩।</td>
                <td>জন্ম তারিখ : <span class="dotted-line" style="min-width: 200px;">{{ $certificate->applicant_dob ? bnValue(date('d/m/Y', strtotime($certificate->applicant_dob))) : '' }}</span></td>
            </tr>
            <tr>
                <td style="vertical-align: top;">৪।</td>
                <td>বর্তমান তালিকাভুক্তি সংক্রান্ত তথ্যাদি
                    <table style="width: 100%; margin-left: 30px; line-height: 2;">
                        <tr>
                            <td colspan="2">ভোটার নম্বর : <span class="dotted-line" style="min-width: 300px;">{{ bnValue($certificate->current_voter_no) }}</span></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">ভোটার এলাকার নাম: <span class="dotted-line" style="min-width: 200px;">{{ $certificate->current_voter_area_name }}</span></td>
                            <td style="width: 50%;">ভোটার এলাকার নম্বর : <span class="dotted-line" style="min-width: 150px;">{{ bnValue($certificate->current_voter_area_no) }}</span></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">উপজেলা/থানা : <span class="dotted-line" style="min-width: 200px;">{{ $certificate->current_upazila_thana }}</span></td>
                            <td style="width: 50%;">জেলা : <span class="dotted-line" style="min-width: 150px;">{{ $certificate->current_district }}</span></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">গ্রাম/রাস্তার নাম ও নম্বর : <span class="dotted-line" style="min-width: 200px;">{{ $certificate->current_village_road }}</span></td>
                            <td style="width: 50%;">বাসা/হোল্ডিং নম্বর : <span class="dotted-line" style="min-width: 150px;">{{ bnValue($certificate->current_house_holding) }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">৫।</td>
                <td>যে এলাকায় স্থানান্তর হইতে ইচ্ছুক
                    <table style="width: 100%; margin-left: 30px; line-height: 2;">
                        <tr>
                            <td style="width: 40%;">জেলা : <span class="dotted-line" style="min-width: 150px;">{{ $certificate->transfer_district }}</span></td>
                            <td style="width: 60%;">উপজেলা/থানা : <span class="dotted-line" style="min-width: 200px;">{{ $certificate->transfer_upazila_thana }}</span></td>
                        </tr>
                        <tr>
                            <td colspan="2">{{ $certificate->transfer_entity_type ?? 'সিটি কর্পোরেশন/পৌরসভা/ইউনিয়ন' }} : <span class="dotted-line" style="min-width: 200px;">{{ $certificate->transfer_entity_name }}</span> ওয়ার্ড নম্বর : <span class="dotted-line" style="min-width: 80px;">{{ bnValue($certificate->transfer_ward_no) }}</span></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">ভোটার এলাকার নাম : <span class="dotted-line" style="min-width: 200px;">{{ $certificate->transfer_voter_area_name }}</span></td>
                            <td style="width: 50%;">ভোটার এলাকার নম্বর : <span class="dotted-line" style="min-width: 150px;">{{ bnValue($certificate->transfer_voter_area_no) }}</span></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">গ্রাম/রাস্তার নাম ও নম্বর : <span class="dotted-line" style="min-width: 200px;">{{ $certificate->transfer_village_road }}</span></td>
                            <td style="width: 50%;">বাসা/হোল্ডিং নম্বর : <span class="dotted-line" style="min-width: 150px;">{{ bnValue($certificate->transfer_house_holding) }}</span></td>
                        </tr>
                        <tr>
                            <td colspan="2">টেলিফোন/মোবাইল ফোন নম্বর : <span class="dotted-line" style="min-width: 250px;">{{ bnValue($certificate->transfer_phone_mobile) }}</span></td>
                        </tr>
                        <tr>
                            <td style="width: 60%;">ডাকঘর : <span class="dotted-line" style="min-width: 200px;">{{ $certificate->transfer_post_office }}</span></td>
                            <td style="width: 40%;">পোস্ট কোড : 
                                <div class="post-code-box">
                                    @php $pc = str_split($certificate->transfer_post_code ?? '    '); @endphp
                                    @foreach(array_pad($pc, 4, ' ') as $digit)
                                        <span>{{ bnValue($digit) }}</span>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">৬।</td>
                <td>৫ নম্বর ক্রমিকে বর্ণিত ঠিকানায় যে সময় হইতে অবস্থান করিতেছেন : <span class="dotted-line" style="min-width: 250px;">{{ $certificate->staying_since }}</span></td>
            </tr>
            <tr>
                <td style="vertical-align: top;">৭।</td>
                <td>স্থানান্তরের কারণ: <span class="dotted-line" style="min-width: 400px;">{{ $certificate->transfer_reason }}</span></td>
            </tr>
        </table>
    </div>

    <!-- PAGE 2 -->
    <div class="form-container">
        <table style="width: 100%; border: none;">
            <tr>
                <td style="width: 40px; vertical-align: top;">৮।</td>
                <td>৫ নম্বর ক্রমিকে বর্ণিত ঠিকানায় অবস্থানের সমর্থনে নিম্নের দলিলাদি সংযুক্ত করিতে হইবে :
                    <div style="margin-left: 20px; line-height: 1.8; margin-top: 10px;">
                        (ক) প্রথম শ্রেণীর কর্মকর্তা/ ক্যান্টনমেন্ট বোর্ডের এক্সিকিউটিভ অফিসার/ সিটি কর্পোরেশন/পৌরসভার মেয়র /ওয়ার্ড<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;কাউন্সিলর/ইউনিয়ন পরিষদ চেয়ারম্যান কর্তৃক প্রদত্ত প্রত্যয়ন পত্র।<br>
                        (খ) ইউটিলিটি বিলের অনুলিপি (যদি থাকে)<br>
                        (গ) বাড়ী ভাড়া রশিদ/চৌকিদারী কর রশিদ/পৌরকর রশিদ/অন্যান্য
                    </div>
                </td>
            </tr>
        </table>

        <div style="text-align: right; margin-top: 80px;">
            <span class="dotted-line" style="width: 250px;"></span><br>
            <strong>আবেদনকারীর স্বাক্ষর বা টিপসহি</strong>
        </div>

        <div style="margin-top: 80px;">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 30%;"></td>
                    <td style="width: 70%;">
                        <div style="margin-bottom: 15px;">
                            <strong>আবেদনকারীকে সনাক্তকারীর স্বাক্ষর :</strong> <span class="dotted-line" style="width: calc(100% - 250px);"></span>
                        </div>
                        <div style="margin-bottom: 10px; padding-left: 100px;">
                            নাম : <span class="dotted-line" style="width: calc(100% - 50px);">{{ $certificate->identifier_name }}</span>
                        </div>
                        <div style="margin-bottom: 10px; padding-left: 100px;">
                            জাতীয় পরিচয়পত্র নম্বর : <span class="dotted-line" style="width: calc(100% - 180px);">{{ bnValue($certificate->identifier_nid) }}</span>
                        </div>
                        <div style="padding-left: 100px;">
                            ঠিকানা : <span class="dotted-line" style="width: calc(100% - 60px);">{{ $certificate->identifier_address }}</span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div style="text-align: center; margin-top: 60px; margin-bottom: 30px;">
            <strong>[কেবলমাত্র অফিসে ব্যবহারের জন্য]</strong>
        </div>

        <div style="line-height: 2.5;">
            দাখিলকৃত দলিলাদি পরীক্ষান্তে <span class="dotted-line" style="width: 25%;"></span> ভোটার এলাকার জন্য প্রণীত ভোটার তালিকা হইতে নাম কর্তন এবং <span class="dotted-line" style="width: 25%;"></span> ভোটার এলাকায় নাম অন্তর্ভূক্ত করা হইল।
        </div>

        <div style="text-align: right; margin-top: 80px;">
            <span class="dotted-line" style="width: 250px;"></span><br>
            <strong>উপজেলা/থানা নির্বাচন কর্মকর্তা</strong><br>
            <span class="dotted-line" style="width: 250px;"></span>
        </div>

        <div style="margin-top: 40px; margin-bottom: 40px; border-top: 1px dotted #000;"></div>

        <div style="text-align: center; margin-bottom: 30px;">
            <strong>প্রাপ্তিস্বীকার পত্র</strong>
        </div>

        <div style="line-height: 2.5;">
            জনাব/বেগম <strong>{{ $certificate->applicant_name }}</strong> এর আবেদন ফরম গৃহীত হইল।<br>
            আবেদন ফরম নম্বর <strong>{{ bnValue($certificate->system_id) }}</strong>
        </div>

        <div style="text-align: right; margin-top: 80px;">
            <span class="dotted-line" style="width: 250px;"></span><br>
            <strong>গ্রহণকারীর স্বাক্ষর</strong>
        </div>
    </div>
</div>
@endsection