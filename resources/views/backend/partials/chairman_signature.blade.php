@php
use App\Models\Council;
use App\Models\CouncilMember;
use App\Models\User;

$unionId = $certificate->user->institute->union_id ?? null;
$chairmanName = '(Chairman)';
$chairmanTitle = 'Chairman';
$chairmanOrgLine = $certificate->user->institute->union->name ?? '';
$chairmanThana = $certificate->user->institute->union->thana->name ?? '';
$chairmanDistrict = $certificate->user->institute->union->thana->district->name ?? '';

if ($unionId) {
    $council = Council::where('union_id', $unionId)
        ->where('status', 1)
        ->whereDate('start_date', '<=', now())
        ->whereDate('end_date', '>=', now())
        ->latest()
        ->first();

    if (!$council) {
        $council = Council::where('union_id', $unionId)->where('status', 1)->latest()->first();
    }

    if ($council) {
        $member = CouncilMember::where('council_id', $council->id)
            ->where('concilor_designation_id', 1)
            ->where('status', 1)
            ->first();

        if ($member) {
            $user = User::find($member->user_id);
            if ($user) {
                $chairmanName = optional($user->people)->name ?? $user->name ?? $chairmanName;
            }
        }
    }
}
@endphp

<div class="certificate-signature">
    <div class="qr-code" id="qrcode"></div>

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
