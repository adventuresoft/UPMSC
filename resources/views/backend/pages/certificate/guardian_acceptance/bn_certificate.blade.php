@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'GuardianAcceptance'])

@push('style')
<style>
    .container { max-width: 100% !important; }

    .doc-page {
        width: 297mm;
        height: 210mm;
        margin: 0 auto;
        padding: 15mm 20mm;
        background: #fff;
        box-sizing: border-box;
        font-family: 'SolaimanLipi', 'Kalpurush', 'Noto Serif Bengali', serif;
        font-size: 14pt;
        line-height: 1.9;
        color: #000;
        position: relative;
    }

    .doc-title {
        text-align: center;
        font-size: 18pt;
        font-weight: bold;
        text-decoration: underline;
        margin-bottom: 20px;
    }

    .doc-body {
        text-align: justify;
    }

    .doc-body p {
        text-indent: 60px;
        margin-bottom: 10px;
    }

    .doc-sig {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .sig-left { 
        text-align: left; 
        line-height: 1.9;
    }
    .sig-right { 
        text-align: center; 
        margin-top: 110px;
        line-height: 1.9;
    }
    .sig-left p, .sig-right p {
        margin-bottom: 0;
        line-height: 1.9;
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

        html, body {
            width: 297mm !important;
            height: 210mm !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden !important;
            background: #ffffff !important;
        }

        .content-wrapper {
            background: #ffffff !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .container {
            width: 297mm !important;
            max-width: 297mm !important;
            height: 210mm !important;
            padding: 0 !important;
            margin: 0 !important;
            overflow: hidden !important;
        }

        .main-header,
        .main-sidebar,
        .main-footer,
        .content-header {
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

@section('title', 'অভিভাবকের সম্মতি পত্র')

@section('content')
@php
    $institute = $certificate->user->institute ?? \App\Models\User::find($certificate->created_by)->institute ?? auth()->user()->institute;
    $union     = $institute->union ?? null;
    $thana     = $union->thana ?? null;
    $district  = $thana->district ?? null;

    // Chairman name
    use App\Models\Council;
    use App\Models\CouncilMember;
    $chairmanName = '';
    $chairmanUnion = optional($union)->bn_name ?? '';
    $unionId  = $certificate->user->institute->union_id ?? $institute->union_id ?? null;
    $instId   = $certificate->user->institute_id ?? $institute->id ?? null;

    if ($unionId) {
        $council = Council::where('union_id', $unionId)->where('status', 1)
            ->whereDate('start_date', '<=', now())->whereDate('end_date', '>=', now())->latest()->first();
        if (!$council) { $council = Council::where('union_id', $unionId)->where('status', 1)->latest()->first(); }
        if ($council) {
            $member = CouncilMember::where('council_id', $council->id)->where('concilor_designation_id', 1)->where('status', 1)->first();
            if ($member) {
                $cu = \App\Models\User::find($member->user_id);
                if ($cu) { $chairmanName = optional($cu->people)->bn_name ?? optional($cu->people)->name ?? $cu->name ?? ''; }
            }
        }
    }
    if (!$chairmanName && $instId) {
        $adminUser = \App\Models\User::where('institute_id', $instId)->where('role_id', 6)->first();
        if ($adminUser) { $chairmanName = optional($adminUser->people)->bn_name ?? optional($adminUser->people)->name ?? $adminUser->name ?? ''; }
    }

    // Guardian info
    $guardianNid    = $certificate->guardian->nid ?? $certificate->guardian->people->nid ?? '';
    $guardianMobile = $certificate->guardian->mobile ?? $certificate->guardian->people->mobile ?? '';

    // Applicant NID/BC
    $nid = $certificate->user->nid ?? $certificate->user->people->nid ?? '';
    $bc  = $certificate->user->birth_certificate ?? $certificate->user->people->birth_certificate ?? '';
    $idVal = ($nid && $nid != '1111111114') ? $nid : $bc;
@endphp

<div class="container p-0">
    <div class="doc-page">

        <div class="doc-title">অভিভাবকের সম্মতি পত্র</div>

        <div class="doc-body">
            <p>
                এই মর্মে প্রত্যয়ন করা যাইতেছে যে,
                <strong>{{ $certificate->user->people->bn_name ?? $certificate->user->name ?? '' }}</strong>,
                জাতীয় পরিচয়পত্র/জন্ম নিবন্ধন নং-
                <strong>{{ bnValue($idVal) }}</strong>,
                আইডি- <strong>{{ $certificate->user->people->approved_id ?? '' }}</strong>,
                পিতাঃ <strong>{{ $certificate->user->familyInfo->bn_father_name ?? $certificate->user->familyInfo->father_name ?? 'প্রযোজ্য নয়' }}</strong>,
                মাতাঃ <strong>{{ $certificate->user->familyInfo->bn_mother_name ?? $certificate->user->familyInfo->mother_name ?? 'প্রযোজ্য নয়' }}</strong>,
                গ্রামঃ <strong>{{ $certificate->user->addressInfo->permanentVillage->bn_name ?? 'প্রযোজ্য নয়' }}</strong>,
                ডাকঘরঃ <strong>{{ $certificate->user->addressInfo->permanentPostOffice->bn_name ?? 'প্রযোজ্য নয়' }}</strong>,
                উপজেলাঃ <strong>{{ optional($thana)->bn_name ?? '' }}</strong>,
                জেলাঃ <strong>{{ optional($district)->bn_name ?? '' }}</strong>,
                সে আমার <strong>{{ $certificate->guardian_relation ?? '' }}</strong> এবং অত্র ইউনিয়নের
                <strong>{{ bnValue($certificate->user->addressInfo->permanentWard->bn_ward_no ?? '') }}</strong>নং ওয়ার্ডের একজন স্থায়ী বাসিন্দা।
                আমার জানামতে সে রাষ্ট্র ও সমাজ বিরোধী কোন কাজের সাথে জড়িত নয়।
                সে বাংলাদেশ সেনাবাহিনী/বিমান বাহিনী/নৌ বাহিনী/পুলিশ বাহিনী/আনসার ভিডিপিসহ বাংলাদেশের কোনো সরকারী দপ্তরে এবং সরকারী-বেসরকারী শিক্ষা প্রতিষ্ঠানে চাকুরী করিলে আমার কোনো আপত্তি নেই।
                উপরে উল্লেখিত বিষয়ে আমি সম্মতি প্রদান করিলাম।
            </p>
            <p>আমি তার সর্বাঙ্গীণ কল্যাণ ও ভবিষ্যৎ মঙ্গল কামনা করি।</p>
        </div>

        <div class="doc-sig">
            <div class="sig-left">
                <br><br>
                <p class="mb-0"><strong>অভিভাবকের স্বাক্ষর</strong></p>
                <p class="mb-0">নামঃ {{ $certificate->guardian->people->bn_name ?? $certificate->guardian->name ?? '' }}</p>
                <p class="mb-0">এনআইডি নং- {{ bnValue($guardianNid) }}</p>
                <p class="mb-0">মোবাইল নং- {{ bnValue($guardianMobile) }}</p>
            </div>
            <div class="sig-right">
                <br><br>
                <p class="mb-0">সত্যায়নকারী</p>
                <p class="mb-0"><strong>{{ $chairmanName }}</strong></p>
                <p class="mb-0">চেয়ারম্যান</p>
                <p class="mb-0">{{ $chairmanUnion }}</p>
            </div>
        </div>

    </div>

    <div class="text-center mt-3 mb-4">
        <button id="cancelPageButton" class="btn btn-danger btn-sm px-4"
                onclick="window.location.href='{{ route('guardian-acceptance.index') }}'">বাতিল</button>
        <button id="printPageButton" class="btn btn-success btn-sm px-4 ms-2"
                onclick="window.print();">প্রিন্ট</button>
    </div>
</div>
@endsection