@php
$chairmanName = get_chairman_name_en($certificate);
$chairmanTitle = 'Chairman';
$chairmanOrgLine = optional($certificate->user->institute->union)->name ?? '';
$chairmanThana = optional(optional($certificate->user->institute->union)->thana)->name ?? '';
$chairmanDistrict = optional(optional(optional($certificate->user->institute->union)->thana)->district)->name ?? '';
@endphp

<div class="certificate-signature">
    <div class="qr-code">
        {!! QrCode::encoding('UTF-8')->size(100)->generate(get_qr_text($certificate)) !!}
    </div>

    <div class="chairman">
        <div style="height:40px;"></div>
        <p class="mb-1">{{ $chairmanName }}</p>
        <p class="mb-0">{{ $chairmanTitle }}</p>
        <p class="mb-0">{{ $chairmanOrgLine }}</p>
        <p class="mb-0" style="font-size:14px;">
            {{ $chairmanThana }}, {{ $chairmanDistrict }}
        </p>
    </div>
</div>
