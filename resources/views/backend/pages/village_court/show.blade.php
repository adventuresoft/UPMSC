@extends('backend.master', ['mainMenu' => 'LocalGovtJudiciary', 'subMenu' => 'VillageCourtList'])
@push('style')
    <style>
        .print-btn-container { margin-bottom: 20px; }
        .page-break { page-break-after: always; }
        .form-container {
            width: 100%; max-width: 800px; margin: 0 auto;
            background: #fff; padding: 40px; font-family: 'SolaimanLipi', Arial, sans-serif;
            color: #000; border: 1px solid #ccc; margin-bottom: 30px;
        }
        .form-title { text-align: center; font-weight: bold; margin-bottom: 20px; }
        .form-title h4 { margin: 0; font-size: 18px; }
        .form-title h5 { margin: 5px 0; font-size: 16px; }
        .form-row { display: flex; margin-bottom: 10px; font-size: 16px; align-items: flex-end; }
        .form-label { white-space: nowrap; margin-right: 10px; }
        .form-value { flex-grow: 1; border-bottom: 1px dotted #000; padding-bottom: 2px; }
        .signature-section { display: flex; justify-content: space-between; margin-top: 50px; }
        .signature-box { text-align: center; }
        .signature-line { border-top: 1px dotted #000; width: 200px; margin-bottom: 5px; }

        @media print {
            @page {
                size: A4;
                margin: 15mm;
            }
            body, html { background: #fff !important; margin: 0; padding: 0; }
            .wrapper, .content-wrapper, .content, .container-fluid { 
                margin: 0 !important; 
                padding: 0 !important; 
                width: 100% !important; 
                background: #fff !important; 
            }
            .main-header, .main-sidebar, .main-footer, .no-print, .content-header { display: none !important; }
            
            .form-container { 
                border: none !important; 
                box-shadow: none !important; 
            }
            
            .print-area { width: 100% !important; }
            .form-row { display: flex !important; align-items: flex-end !important; }
            .form-value { flex-grow: 1 !important; border-bottom: 1px dashed #000 !important; }
            
            .page-break { page-break-after: always !important; }
        }
    </style>
@endpush
@section('title', 'Notice Forms')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Notice Forms - {{ $case->case_no }}</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('village-court.index') }}">Notice</a></li>
                        <li class="breadcrumb-item active">Forms</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="print-btn-container text-center no-print">
                <button onclick="window.print()" class="btn btn-primary"><i class="fas fa-print"></i> Print All Forms</button>
            </div>

            <div class="print-area">
                @php
                    $badi = $case->badi;
                    $badiFamily = $badi->familyInfo ?? null;
                    $badiFamily = $badi->familyInfo ?? null;
                    $bibadis = $case->bibadis();
                    $shakkhis = $case->shakkhis();
                    $unionName = $badi->user->addressInfo->permanentUnion->name ?? '.......................';
                    $upazillaName = $badi->user->addressInfo->permanentThana->name ?? '.......................';
                    $districtName = $badi->user->addressInfo->permanentDistrict->name ?? '.......................';
                @endphp

                <!-- Form 1 -->
                <div class="form-container page-break">
                    <div class="form-title">
                        <h4>ফরম-১</h4>
                        <h5>[ বিধি ৩ দ্রষ্টব্য ]</h5>
                    </div>
                    
                    <div class="form-row"><div class="form-label">১। আবেদনকারীর নাম :</div><div class="form-value">{{ $badi->name }}</div></div>
                    <div class="form-row"><div class="form-label">২। আবেদনকারীর পিতার নাম :</div><div class="form-value">{{ $badiFamily->father_name ?? '' }}</div></div>
                    <div class="form-row"><div class="form-label">৩। আবেদনকারীর মাতার নাম :</div><div class="form-value">{{ $badiFamily->mother_name ?? '' }}</div></div>
                    <div class="form-row"><div class="form-label">৪। আবেদনকারীর স্বামী/স্ত্রীর নাম :</div><div class="form-value">{{ $badiFamily->husband_name ?? ($badiFamily->wife_name ?? '') }}</div></div>
                    <div class="form-row"><div class="form-label">৫। আবেদনকারীর জাতীয় পরিচয় পত্র নং :</div><div class="form-value">{{ $badi->nid ?? '' }}</div></div>
                    
                    @foreach($bibadis as $bIndex => $bibadi)
                        @php $bibadiFamily = $bibadi->familyInfo ?? null; @endphp
                        <div class="form-row mt-3"><div class="form-label">৬{{ $bIndex > 0 ? '('.$bIndex.')' : '' }}। প্রতিবাদীর নাম :</div><div class="form-value">{{ $bibadi->bn_name ?? $bibadi->name ?? ($bibadi->user->name ?? '') }}</div></div>
                        <div class="form-row"><div class="form-label">৭{{ $bIndex > 0 ? '('.$bIndex.')' : '' }}। প্রতিবাদীর পিতার নাম :</div><div class="form-value">{{ $bibadiFamily->father_name ?? '' }}</div></div>
                        <div class="form-row"><div class="form-label">৮{{ $bIndex > 0 ? '('.$bIndex.')' : '' }}। প্রতিবাদীর মাতার নাম :</div><div class="form-value">{{ $bibadiFamily->mother_name ?? '' }}</div></div>
                    @endforeach
                    
                    <div class="mt-3">
                        @foreach($shakkhis as $index => $shakkhi)
                            <div class="form-row"><div class="form-label">{{ 9 + ($index*5) }}। সাক্ষীর নাম :</div><div class="form-value">{{ $shakkhi->name }}</div></div>
                            <div class="form-row"><div class="form-label">{{ 10 + ($index*5) }}। সাক্ষীর পিতার নাম :</div><div class="form-value">{{ $shakkhi->familyInfo->father_name ?? '' }}</div></div>
                            <div class="form-row"><div class="form-label">{{ 11 + ($index*5) }}। সাক্ষীর মাতার নাম :</div><div class="form-value">{{ $shakkhi->familyInfo->mother_name ?? '' }}</div></div>
                            <div class="form-row"><div class="form-label">{{ 12 + ($index*5) }}। সাক্ষীর স্বামী/স্ত্রীর নাম :</div><div class="form-value">{{ $shakkhi->familyInfo->husband_name ?? ($shakkhi->familyInfo->wife_name ?? '') }}</div></div>
                            <div class="form-row"><div class="form-label">{{ 13 + ($index*5) }}। সাক্ষীর জাতীয় পরিচয় পত্র নং :</div><div class="form-value">{{ $shakkhi->nid ?? '' }}</div></div>
                        @endforeach
                    </div>

                    <div class="form-row mt-3"><div class="form-label">ইউনিয়নের নাম :</div><div class="form-value">{{ $unionName }}</div></div>
                    <div class="form-row mt-3" style="align-items: flex-start;">
                        <div class="form-label">বিরোধীয় বিষয় :</div>
                        <div class="form-value" style="min-height: 60px;">{{ $case->ovijog_er_biboron }}</div>
                    </div>
                    <div class="form-row mt-3" style="align-items: flex-start;">
                        <div class="form-label">প্রার্থিত প্রতিকার :</div>
                        <div class="form-value" style="min-height: 60px;">{{ $case->ghotona_sombolito }}</div>
                    </div>

                    <div style="margin-top: 40px; text-align: right; font-size: 14px;">[ প্রয়োজনে অতিরিক্ত কাগজ সংযুক্ত করা যাইবে ]</div>
                    
                    <div class="signature-section">
                        <div class="signature-box"></div>
                        <div class="signature-box">
                            <div class="signature-line"></div>
                            <div>(আবেদনকারীর স্বাক্ষর বা টিপসহি)</div>
                        </div>
                    </div>
                </div>

                <!-- Form 4 -->
                @foreach($bibadis as $bibadi)
                <div class="form-container page-break">
                    <div class="form-title">
                        <h4>ফরম-৪</h4>
                        <h5>[ বিধি ৮ (১) দ্রষ্টব্য ]</h5>
                        <h4>প্রতিবাদীর প্রতি সমন</h4>
                    </div>
                    
                    <p class="text-center">...................................................... ইউনিয়ন পরিষদ</p>
                    <div class="d-flex justify-content-between">
                        <div style="width: 48%">উপজেলা: <strong>{{ $upazillaName }}</strong></div>
                        <div style="width: 48%">জেলা: <strong>{{ $districtName }}</strong></div>
                    </div>
                    
                    <div class="mt-4">
                        <p>বরাবর</p>
                        <div style="border-bottom: 1px dotted #000; height: 25px; margin-bottom: 10px;">{{ $bibadi->bn_name ?? $bibadi->name ?? ($bibadi->user->name ?? '') }}</div>
                        <div style="border-bottom: 1px dotted #000; height: 25px; margin-bottom: 10px;"></div>
                        <div style="border-bottom: 1px dotted #000; height: 25px; margin-bottom: 10px;"></div>
                    </div>

                    <div class="mt-4" style="line-height: 2;">
                        যেহেতু <strong>{{ $badi->bn_name ?? $badi->name ?? ($badi->user->name ?? '') }}</strong> এর <strong>{{ $case->ovijog_er_biboron }}</strong> সংক্রান্ত অভিযোগ/দাবী সম্পর্কে তাহার আবেদনপত্রের জবাব দেওয়ার জন্য আপনার উপস্থিতি প্রয়োজন; সেইহেতু, এতদ্বারা আপনাকে <strong>{{ \Carbon\Carbon::parse($case->hajir_date)->format('Y') }}</strong> সালের <strong>{{ \Carbon\Carbon::parse($case->hajir_date)->format('F') }}</strong> মাসের <strong>{{ \Carbon\Carbon::parse($case->hajir_date)->format('d') }}</strong> তারিখে <strong>{{ \Carbon\Carbon::parse($case->hajir_time)->format('h:i A') }}</strong> টার সময় আমার নিকট হাজির হইতে নির্দেশ দেওয়া গেল।
                    </div>

                    <div class="signature-section" style="margin-top: 100px;">
                        <div class="signature-box" style="text-align: left;">
                            <div style="margin-bottom: 10px;">তাং ....................................</div>
                            <div>সীলমোহর ..........................</div>
                        </div>
                        <div class="signature-box">
                            <div class="signature-line"></div>
                            <div>গ্রাম আদালত/ইউনিয়ন পরিষদ এর<br>চেয়ারম্যানের স্বাক্ষর</div>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Form 5 -->
                <div class="form-container page-break">
                    <div class="form-title">
                        <h4>ফরম-৫</h4>
                        <h5>[ বিধি ১৫ (১) দ্রষ্টব্য ]</h5>
                        <h4>সাক্ষীর প্রতি সমন</h4>
                    </div>
                    
                    <p>....................................... ইউনিয়ন পরিষদ এর গ্রাম আদালতের ........................ নং</p>
                    <div class="d-flex mb-3">
                        <div style="width: 15%">মামলায়</div>
                        <div style="width: 85%; border-bottom: 1px dotted #000;">{{ $badi->name }}</div>
                    </div>
                    <div class="text-center mb-4">আবেদনকারী বনাম<br>প্রতিবাদী ।</div>
                    
                    <div>
                        <p>বরাবর</p>
                        @foreach($shakkhis as $shakkhi)
                            <div style="border-bottom: 1px dotted #000; height: 25px; margin-bottom: 10px;">{{ $shakkhi->name }}</div>
                        @endforeach
                        @if($shakkhis->count() == 0)
                            <div style="border-bottom: 1px dotted #000; height: 25px; margin-bottom: 10px;"></div>
                            <div style="border-bottom: 1px dotted #000; height: 25px; margin-bottom: 10px;"></div>
                        @endif
                    </div>

                    <div class="mt-4" style="line-height: 2;">
                        যেহেতু উপরি-উল্লিখিত মামলার আবেদনকারী/প্রতিবাদীর পক্ষে কতিপয় বিষয়ে সাক্ষ্য দেওয়া এবং/অথবা নিম্নেবর্ণিত দলিলপত্র পেশ করিবার জন্য আপনার উপস্থিতি আবশ্যক; সেইহেতু এতদ্বারা আপনাকে <strong>{{ \Carbon\Carbon::parse($case->hajir_date)->format('Y') }}</strong> সালের <strong>{{ \Carbon\Carbon::parse($case->hajir_date)->format('F') }}</strong> মাসের <strong>{{ \Carbon\Carbon::parse($case->hajir_date)->format('d') }}</strong> তারিখে <strong>{{ \Carbon\Carbon::parse($case->hajir_time)->format('h:i A') }}</strong> ঘটিকায় ব্যক্তিগতভাবে নিম্নলিখিত দলিলপত্রসহ এই আদালত সমক্ষে হাজির হইবার জন্য নির্দেশ দেওয়া গেল।
                    </div>

                    <div class="mt-4" style="line-height: 2;">
                        ১। ................................................................................................................<br>
                        ২। ................................................................................................................<br>
                        ৩। ................................................................................................................
                    </div>

                    <div class="mt-4">
                        আইন সংগত কারণ ব্যতিরেকে আপনি যদি এই আদেশ পালনে ব্যর্থ হন, তাহা হইলে গ্রাম আদালত আইন ২০০৬ এবং গ্রাম আদালত (সংশোধন) আইন ২০১৩ এর বিধানাবলী মোতাবেক আপনি অর্থ দণ্ডে দণ্ডনীয় হইবেন।
                    </div>

                    <div class="signature-section" style="margin-top: 80px;">
                        <div class="signature-box" style="text-align: left;">
                            <div style="margin-bottom: 10px;">তারিখ....................................</div>
                            <div>সীলমোহর ..........................</div>
                        </div>
                        <div class="signature-box">
                            <div class="signature-line"></div>
                            <div>গ্রাম আদালতের<br>চেয়ারম্যানের স্বাক্ষর</div>
                        </div>
                    </div>
                </div>

                <!-- Form 11 -->
                <div class="form-container">
                    <div class="form-title">
                        <h4>ফরম-১১</h4>
                        <h5>[ বিধি ১৪ (৩) দ্রষ্টব্য ]</h5>
                        <h4>মামলার স্লিপ</h4>
                    </div>
                    
                    <div class="form-row"><div class="form-value text-center" style="font-weight: bold; font-size: 18px;">{{ $unionName }}</div><div class="form-label ml-2">ইউনিয়ন/গ্রাম আদালত</div></div>
                    
                    <div class="d-flex justify-content-between mt-3">
                        <div class="form-row" style="width: 48%"><div class="form-label">মামলা নং-</div><div class="form-value">{{ $case->case_no }}</div></div>
                        <div class="form-row" style="width: 48%"><div class="form-label">দায়েরের তারিখ :</div><div class="form-value">{{ $case->case_date ? $case->case_date->format('d/m/Y') : '' }}</div></div>
                    </div>
                    
                    <div class="form-row mt-2"><div class="form-label">আবেদনকারী</div><div class="form-value">{{ $badi->bn_name ?? $badi->name ?? ($badi->user->name ?? '') }}</div></div>
                    <div class="form-row mt-2"><div class="form-label">প্রতিবাদী</div><div class="form-value">{{ $bibadis->pluck('bn_name')->implode(', ') ?: $bibadis->pluck('name')->implode(', ') }}</div></div>
                    
                    <div class="mt-4" style="line-height: 2;">
                        মামলার আগামী তারিখ (প্রতিবাদীর জবাব প্রদানের জন্য/সাক্ষ্য গ্রহণের জন্য/আপোষ-নিষ্পত্তির জন্য/শুনানীর জন্য/সিদ্ধান্ত ঘোষণার জন্য/ ........................................................)
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <div class="form-row" style="width: 48%"><div class="form-label">বার</div><div class="form-value">{{ $case->hajir_date ? $case->hajir_date->format('l') : '' }}</div></div>
                        <div class="form-row" style="width: 48%"><div class="form-label">সময়</div><div class="form-value">{{ $case->hajir_time ? \Carbon\Carbon::parse($case->hajir_time)->format('h:i A') : '' }}</div></div>
                    </div>
                    <div class="form-row mt-2"><div class="form-label">স্থান</div><div class="form-value">{{ $unionName }} ইউনিয়ন পরিষদ</div></div>
                    
                    <div class="signature-section" style="margin-top: 60px;">
                        <div class="signature-box"></div>
                        <div class="signature-box">
                            <div class="signature-line" style="width: 150px;"></div>
                            <div>আদালত সহকারী/সচিব<br>ইউনিয়ন পরিষদ</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
