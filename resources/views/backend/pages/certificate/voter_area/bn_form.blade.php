@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'VoterArea'])

@push('style')
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@400;700&display=swap" rel="stylesheet">
<style>
    /* @font-face {
        font-family: 'Nikosh';
        src: url('https://cdn.jsdelivr.net/gh/atulkumar-ak/Nikosh@master/Nikosh.ttf') format('truetype');
    } */

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
        font-family: 'Nikosh', 'Noto Serif Bengali', serif;
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

@section('title', 'ভোটার স্থানান্তর ফরম-১৩')

@section('content')
<div class="certificate-canvas">
    <!-- PAGE 1 -->
    <div class="form-container">
        <div class="text-center" style="margin-bottom: 30px;">
            <div style="font-size: 20px; font-weight: bold;">ফরম-১৩</div>
            <div style="font-size: 16px;">[বিধি ২৬(৭) দ্রষ্টব্য]</div>
            <div style="margin-top: 20px; font-size: 18px; font-weight: bold;">এক ভোটার এলাকা হইতে অন্য ভোটার এলাকায় ভোটার স্থানান্তরের আবেদন</div>
        </div>

        <div style="margin-bottom: 30px;">
            <div style="font-weight: bold; font-size: 18px; margin-bottom: 5px;">প্রাপক :</div>
            <div style="margin-left: 60px;">
                উপজেলা/থানা নির্বাচন অফিসার<br>
                <div class="flex-row" style="width: 350px;">
                    <span>উপজেলা/থানা</span>
                    <div class="dot-line-container">
                        <span class="data-span">{{ $certificate->recipient_upazila_thana_name }}</span>
                    </div>
                </div>
                <div class="flex-row" style="width: 350px;">
                    <span>জেলা</span>
                    <div class="dot-line-container">
                        <span class="data-span">{{ $certificate->recipient_district }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-row">
            <span style="width: 35px; font-weight: bold;">১।</span>
            <span>আবেদনকারীর নাম :</span>
            <div class="dot-line-container">
                <span class="data-span">{{ $certificate->applicant_name }}</span>
            </div>
        </div>

        <div class="flex-row">
            <span style="width: 35px; font-weight: bold;">২।</span>
            <span>জাতীয় পরিচয়পত্র নং (এনআইডি) :</span>
            <div class="dot-line-container">
                <span class="data-span">{{ bnValue($certificate->applicant_nid) }}</span>
            </div>
        </div>
        <div class="text-center" style="font-size: 14px; margin-top: -5px; margin-bottom: 10px; padding-left: 100px;">
            (জাতীয় পরিচয়পত্রের ছায়ালিপি সংযুক্ত করিতে হইবে)
        </div>

        <div class="flex-row">
            <span style="width: 35px; font-weight: bold;">৩।</span>
            <span>জন্ম তারিখ :</span>
            <div class="dot-line-container" style="max-width: 450px;">
                <span class="data-span">{{ $certificate->applicant_dob ? bnValue(date('d/m/Y', strtotime($certificate->applicant_dob))) : '' }}</span>
            </div>
        </div>

        <div class="flex-row" style="margin-top: 10px;">
            <span style="width: 35px; font-weight: bold;">৪।</span>
            <span style="font-weight: bold;">বর্তমান তালিকাভুক্তি সংক্রান্ত তথ্যাদি-</span>
        </div>
        <div style="margin-left: 35px; padding-left: 60px;">
            <div class="flex-row">
                <span>ভোটার নম্বর :</span>
                <div class="dot-line-container" style="max-width: 450px;">
                    <span class="data-span">{{ bnValue($certificate->current_voter_no) }}</span>
                </div>
            </div>
            @php
                $currentVoterAreaCore = getCoreUnionName($certificate->current_voter_area_name);
                $currentVoterAreaNo = $certificate->current_voter_area_no;
                if (empty($currentVoterAreaNo)) {
                    if (preg_match('/(\d+|[০-৯]+)\s*নং\s*ওয়ার্ড/u', normalizeBanglaVowels($certificate->current_voter_area_name), $matches)) {
                        $currentVoterAreaNo = $matches[1];
                    }
                }
            @endphp
            <div class="flex-row">
                <span>ভোটার এলাকার নাম :</span>
                <div class="dot-line-container">
                    <span class="data-span">{{ $currentVoterAreaCore }}</span>
                </div>
                <span style="margin-left: 15px;">ওয়ার্ড নং :</span>
                <div class="dot-line-container" style="max-width: 150px;">
                    <span class="data-span">{{ bnValue($currentVoterAreaNo) }}</span>
                </div>
            </div>
            <div class="flex-row">
                <span>উপজেলা/থানা :</span>
                <div class="dot-line-container">
                    <span class="data-span">{{ $certificate->current_upazila_thana }}</span>
                </div>
                <span style="margin-left: 15px;">জেলা :</span>
                <div class="dot-line-container" style="max-width: 200px;">
                    <span class="data-span">{{ $certificate->current_district }}</span>
                </div>
            </div>
            <div class="flex-row">
                <span>গ্রাম/রাস্তার নাম ও নম্বর :</span>
                <div class="dot-line-container">
                    <span class="data-span">{{ $certificate->current_village_road }}</span>
                </div>
                <span style="margin-left: 15px;">বাসা/হোল্ডিং নম্বর :</span>
                <div class="dot-line-container" style="max-width: 150px;">
                    <span class="data-span">{{ bnValue($certificate->current_house_holding) }}</span>
                </div>
            </div>
        </div>

        <div class="flex-row" style="margin-top: 15px;">
            <span style="width: 35px; font-weight: bold;">৫।</span>
            <span style="font-weight: bold;">যে এলাকায় স্থানান্তর হইতে ইচ্ছুক-</span>
        </div>
        <div style="margin-left: 35px; padding-left: 60px;">
            <div class="flex-row">
                <span>জেলা :</span>
                <div class="dot-line-container">
                    <span class="data-span">{{ $certificate->transfer_district }}</span>
                </div>
                <span style="margin-left: 15px;">উপজেলা/থানা :</span>
                <div class="dot-line-container" style="max-width: 250px;">
                    <span class="data-span">{{ $certificate->transfer_upazila_thana }}</span>
                </div>
            </div>
            <div class="flex-row">
                <span>সিটি কর্পোরেশন/পৌরসভা/ইউনিয়ন/ক্যান্ট: বোর্ড :</span>
                <div class="dot-line-container">
                    <span class="data-span">{{ $certificate->transfer_entity_name }}</span>
                </div>
                <span style="margin-left: 15px;">ওয়ার্ড নম্বর :</span>
                <div class="dot-line-container" style="max-width: 100px;">
                    <span class="data-span">{{ bnValue($certificate->transfer_ward_no) }}</span>
                </div>
            </div>
            <div class="flex-row">
                <span>ভোটার এলাকার নাম :</span>
                <div class="dot-line-container">
                    <span class="data-span">{{ $certificate->transfer_voter_area_name }}</span>
                </div>
                <span style="margin-left: 15px;">ভোটার এলাকার নম্বর :</span>
                <div class="dot-line-container" style="max-width: 150px;">
                    <span class="data-span">{{ bnValue($certificate->transfer_voter_area_no) }}</span>
                </div>
            </div>
            <div class="flex-row">
                <span>গ্রাম/রাস্তার নাম ও নম্বর :</span>
                <div class="dot-line-container">
                    <span class="data-span">{{ $certificate->transfer_village_road }}</span>
                </div>
                <span style="margin-left: 15px;">বাসা/হোল্ডিং নম্বর :</span>
                <div class="dot-line-container" style="max-width: 150px;">
                    <span class="data-span">{{ bnValue($certificate->transfer_house_holding) }}</span>
                </div>
            </div>
            <div class="flex-row">
                <span>টেলিফোন/মোবাইল ফোন নম্বর :</span>
                <div class="dot-line-container">
                    <span class="data-span">{{ bnValue($certificate->transfer_phone_mobile) }}</span>
                </div>
            </div>
            <div class="flex-row">
                <span>ডাকঘর :</span>
                <div class="dot-line-container">
                    <span class="data-span">{{ $certificate->transfer_post_office }}</span>
                </div>
                <span style="margin-left: 15px;">পোস্ট কোড :</span>
                <div class="post-code-box">
                    @php $pc = str_split($certificate->transfer_post_code ?? '    '); @endphp
                    @foreach(array_pad($pc, 4, ' ') as $digit)
                        <span>{{ bnValue($digit) }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex-row" style="margin-top: 15px;">
            <span style="width: 35px; font-weight: bold;">৬।</span>
            <span>৫ নম্বর ক্রমিকে বর্ণিত ঠিকানায় যে সময় হইতে অবস্থান করিতেছেন :</span>
            <div class="dot-line-container">
                <span class="data-span">{{ $certificate->staying_since }}</span>
            </div>
        </div>

        <div class="flex-row">
            <span style="width: 35px; font-weight: bold;">৭।</span>
            <span>স্থানান্তরের কারণঃ</span>
            <div class="dot-line-container">
                <span class="data-span">{{ $certificate->transfer_reason }}</span>
            </div>
        </div>
    </div>

    <!-- PAGE 2 -->
    <div class="form-container last-page">
        <div class="flex-row">
            <span style="width: 35px; font-weight: bold;">৮।</span>
            <span style="font-weight: bold;">৫ নম্বর ক্রমিকে বর্ণিত ঠিকানায় অবস্থানের সমর্থনে নিম্নের দলিলাদি সংযুক্ত করিতে হইবে :</span>
        </div>
        <div style="margin-left: 45px; line-height: 2.0; margin-top: 10px;">
            (ক) প্রথম শ্রেণীর কর্মকর্তা/ ক্যান্টনমেন্ট বোর্ডের এক্সিকিউটিভ অফিসার/ সিটি কর্পোরেশন/পৌরসভার মেয়র /ওয়ার্ড কাউন্সিলর/ইউনিয়ন পরিষদ চেয়ারম্যান কর্তৃক প্রদত্ত প্রত্যয়ন পত্র।<br>
            (খ) ইউটিলিটি বিলের অনুলিপি (যদি থাকে)<br>
            (গ) বাড়ী ভাড়া রশিদ/চৌকিদারী কর রশিদ/পৌরকর রশিদ/অন্যান্য
        </div>

        <div style="margin-top: 80px; text-align: right; padding-right: 20px;">
            <div style="display: inline-block; text-align: center;">
                <div style="color: #000; font-weight: bold; letter-spacing: 2px; margin-bottom: 5px;">................................................</div>
                <div style="font-weight: bold;">আবেদনকারীর স্বাক্ষর বা টিপসহ</div>
            </div>
        </div>

        <div style="margin-top: 50px;">
            <div class="flex-row">
                <span style="font-weight: bold;">আবেদনকারীকে শনাক্তকারীর স্বাক্ষর :</span>
                <div class="dot-line-container"></div>
            </div>
            <div style="margin-left: 150px; margin-top: 10px;">
                <div class="flex-row"><span>নাম :</span><div class="dot-line-container"><span class="data-span">{{ $certificate->identifier_name }}</span></div></div>
                <div class="flex-row"><span>জাতীয় পরিচয়পত্র নম্বর :</span><div class="dot-line-container"><span class="data-span">{{ bnValue($certificate->identifier_nid) }}</span></div></div>
                <div class="flex-row"><span>ঠিকানা :</span><div class="dot-line-container"><span class="data-span">{{ $certificate->identifier_address }}</span></div></div>
            </div>
        </div>

        <div style="text-align: center; margin-top: 60px; margin-bottom: 30px; font-weight: bold; font-size: 18px;">
            [কেবলমাত্র অফিসে ব্যবহারের জন্য]
        </div>

        <div style="line-height: 2.5; text-align: justify; font-size: 17px; margin-bottom: 40px;">
            <div class="flex-row">
                <span>দাখিলকৃত দলিলাদি পরীক্ষান্তে</span>
                <div class="dot-line-container" style="min-width: 250px;">
                </div>
                <span>ভোটার এলাকার জন্য প্রণীত ভোটার তালিকা হইতে নাম</span>
            </div>
            <div class="flex-row">
                <span>কর্তন এবং</span>
                <div class="dot-line-container" style="max-width: 350px;">
                </div>
                <span>ভোটার এলাকায় নাম অন্তর্ভুক্ত করা হইল।</span>
            </div>
        </div>

        <div style="text-align: right; margin-top: 60px; padding-right: 20px;">
            <div style="display: inline-block; text-align: center;">
                <div style="color: #000; font-weight: bold; letter-spacing: 2px; margin-bottom: 5px;">................................................</div>
                <div style="font-weight: bold;">উপজেলা/থানা নির্বাচন কর্মকর্তা</div>
            </div>
        </div>

        <div style="margin-top: 60px; margin-bottom: 30px; border-top: 1px dashed #000; width: 100%;"></div>

        <div style="text-align: center; margin-bottom: 25px; font-weight: bold; font-size: 20px;">
            প্রাপ্তিস্বীকার পত্র
        </div>

        <div style="line-height: 2.2; font-size: 17px;">
            <div class="flex-row">
                জনাব/বেগম
                <div class="dot-line-container">
                    <span class="data-span">{{ $certificate->applicant_name }}</span>
                </div>
                এর আবেদন ফরম গৃহীত হইল।
            </div>
            <div class="flex-row">
                আবেদন ফরম নম্বর
                <div class="dot-line-container" style="max-width: 400px;">
                </div>
            </div>
        </div>

        <div style="text-align: right; margin-top: 60px; padding-right: 20px;">
            <div style="display: inline-block; text-align: center;">
                <div style="color: #000; font-weight: bold; letter-spacing: 2px; margin-bottom: 5px;">................................................</div>
                <div style="font-weight: bold;">গ্রহণকারীর স্বাক্ষর</div>
            </div>
        </div>
    </div>

    <div class="print-controls">
        <button class="btn btn-danger btn-lg px-5" style="font-size: 18px;" onclick="window.location.href='{{ route('voter-area.index') }}'"><i class="fas fa-times me-2"></i> Cancel</button>
        <button class="btn btn-primary btn-lg px-5 ms-4" style="font-size: 18px;" onclick="window.print();"><i class="fas fa-print me-2"></i> Print Certificate</button>
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












