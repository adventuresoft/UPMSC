@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'Succession'])

@push('style')
<style>
    .container {
        max-width: 100% !important;
    }

/* =========================
   A4 CANVAS
========================= */
.certificate-card {
    max-width: 100%;
    margin: 0 auto;
    background-image: url('{{ asset('images/sucsesion.png') }}');
    background-size: 100% 100%;
    background-repeat: no-repeat;
    background-position: center;
    width: 210mm;
    min-height: 297mm;
    height: auto;
    position: relative;
    box-sizing: border-box;
    margin: 0 auto;
}

/* =========================
   BODY WRAPPER
========================= */
.certificate-body {
    width: 100%;
    height: 100%;
    padding: 15mm;
    box-sizing: border-box;
}

.inner-frame{
    height: 100%;
    min-height: 267mm; /* 297mm - 30mm padding */
    padding: 15mm;
    position: relative;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
}

/* =========================
   FOOTER
========================= */
.certificate-footer {
    font-size: 10px;
    text-align: center;
    opacity: 0.85;
    margin-top: 15px;
}

/* =========================
   SIGNATURE
========================= */
.certificate-signature {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-top: auto;
    padding-top: 30px;
}

.certificate-signature .qr-code img{
    height: 90px;
    width: 90px;
}

.certificate-signature .chairman {
    text-align: center;
    font-weight: 400;
    font-size: 14px;
}

/* =========================
   MEMBER TABLE
========================= */
.member-table{
    width:100%;
    border-collapse: collapse;
    margin-top: 10px;
    font-size: 14px;
}

.member-table th,
.member-table td{
    border:1px solid #000;
    padding:6px;
    text-align:center;
}

.member-table th{
    background:#e9f6ff;
    font-weight:600;
}

/* =========================
   PRINT CONFIG
========================= */
    @media print {
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            box-sizing: border-box !important;
        }

        @page {
            size: a4 portrait;
            margin: 0mm !important;
        }

        html, body {
            width: 100% !important;
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden !important;
            background: #ffffff !important;
        }

        .container {
            width: 100% !important;
            max-width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
            overflow: hidden !important;
        }

        .certificate-card {
            width: 100% !important;
            height: auto !important;
            min-height: 297mm !important;
            max-width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            border: none !important;
            box-shadow: none !important;
            background-size: 100% 100% !important;
            background-repeat: no-repeat !important;
            position: relative !important;
        }

        .content-wrapper,
        .wrapper {
            background: #ffffff !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .main-header,
        .main-sidebar,
        .main-footer,
        .content-header,
        .app-footer {
            display: none !important;
        }

        #printPageButton,
        #cancelPageButton,
        .btn {
            display: none !important;
        }
    }</style>
@endpush

@section('title', 'Succession Certificate')

@section('content')
<div class="container p-0">
    <div class="certificate-card">
        <div class="certificate-body">
            <div class="inner-frame">

                <!-- ================= Header ================= -->
                <div class="row align-items-center">
                    <div class="col-2 text-center">
                        <img height="90" width="90" src="{{ isset($certificate->user->institute->left_image) ? imageUrl($certificate->user->institute->left_image) : asset('images/dhaka.png') }}">
                    </div>

                    <div class="col-8 text-center">
                        <h2 class="text- font-Tahoma-bold mb-0" style="font-size:16px;">
                          Government of the People's Republic of Bangladesh
                        </h2>
                        @php
                            $institute = $certificate->user->institute;
                            $auth = $institute->union ?? ($institute->pourashava ?? $institute->cityCorporation);
                            $thana = '';
                            $district = '';
                            
                            if ($institute->union && $institute->union->thana) {
                                $thana = str_replace('Upazila', '', $institute->union->thana->name);
                                $district = $institute->union->thana->district->name ?? '';
                            } elseif ($institute->pourashava) {
                                $district = $institute->pourashava->District->name ?? '';
                            } elseif ($institute->cityCorporation) {
                                $district = $institute->cityCorporation->District->name ?? '';
                            }
                        @endphp
                        <h3 class="font-weight-bold" style="color:#2e3192; margin-top:2px; font-size:23px;">
                            {{ $auth->name ?? '' }}
                        </h3>
                        <h4 class="text-success font-Nikosh-bold mb-0" style="font-family: 'Kalpurush-Bold', sans-serif; font-size:24px;">
                            {{ $auth->bn_name ?? '' }}
                        </h4>
                        <p class="mb-0" style="font-size:15px;">
                            @if($thana) Thana: {{ $thana }}, @endif
                            District: {{ $district }},
                            Bangladesh
                        </p>
                    </div>

                    <div class="col-2 text-center">
                        <img height="90" width="90" src="{{ asset('images/govt-bd-logo.png') }}">
                    </div>
                </div>

                <!-- ================= Title ================= 
                <div class="row mt-3 align-items-center">
                    <div class="col-4 text-left">
                        <strong> NO: </strong >  <span style="font-weight:bold;color:blue">      {{ $certificate->system_id ?? '' }}   </span>
                    </div>

                    <div class="col-4 text-center">
                        <span class="badge text-light px-4 py-2" style="font-size:24px; border-radius:28px; background-color: #2F318C;">
                           Citizenship Certificate
                        </span>
                    </div>

                    <div class="col-4 text-right">
                        Date:
                        {{ date('d/m/Y', strtotime($certificate->created_at)) }}
                    </div>
                </div>
                -->

                <!-- ================= Body ================= -->
                <div class="row mt-2 align-items-center">
                    <div class="col-3 text-left">
                        <strong>No:</strong>  <span style="font-weight:bold;color:blue">{{ $certificate->system_id ?? '' }}</span>
                    </div>

                    <div class="col-6 text-center">
                        <span class="badge text-light px-4 py-2" style="font-size:22px; border-radius:26px;; background-color: #2F318C;">
                            Certificate of Succession
                        </span>
                    </div>

                    <div class="col-3 text-right">
                        Date: {{ date('d/m/Y', strtotime($certificate->created_at)) }} 
                    </div>
                </div>

                <!-- ===== Body ===== -->
                <div class="row mt-3">
                    <div class="col-12" style="font-size:15px; line-height:1.9; text-align:justify;">

                        <p>
                            <span style="margin-left:40px;"></span>
                            This is to certify that ,
                            {{ $certificate->user->people->gender == 1 ? 'Mr.' : 'Mrs.' }}
                            <strong>{{ $certificate->user->people->name ?? '' }}</strong>,
                            ID No.<strong>{{ $certificate->user->people->approved_id ?? '' }}</strong>,
                            Father: <span>{{ $certificate->user->familyInfo->father_name ?? '' }}</span>
                            and Mother: <span>{{ $certificate->user->familyInfo->mother_name ?? '' }}</span>,
                            @php 
                                $nid = $certificate->user->nid ?? $certificate->user->people->nid ?? '';
                                $bc = $certificate->user->birth_certificate ?? $certificate->user->people->birth_certificate ?? '';
                            @endphp
                            @if($nid && $nid != '1111111114')
                                NID No. <strong>{{ $nid }}</strong>,
                            @elseif($bc)
                                Birth Certificate No. <strong>{{ $bc }}</strong>,
                            @endif
                            Address: Village : - <span>{{ $certificate->user->addressInfo->permanentVillage->en_name ?? '' }}</span>,
                            Word:- {{ $certificate->user->addressInfo->permanentWard->en_ward_no ?? '' }},
                            Post Office: - 
{{ optional(optional(optional($certificate->user)->addressInfo)->permanentPostOffice)->bn_name ?? '' }}
@if(optional(optional(optional($certificate->user)->addressInfo)->permanentPostOffice)->postal_code)
    {{ bnValue(optional(optional(optional($certificate->user)->addressInfo)->permanentPostOffice)->postal_code) }},
@endif
                            Upzila:- <span>{{ $certificate->user->institute->union->thana->name ?? '' }}</span>,
                            District: - <span>{{ $certificate->user->institute->union->thana->district->name ?? '' }}</span>.
                            He was a permanent resident of this union. Last
                            <strong>
                                @if($certificate->deathPerson)
                                    {{ $certificate->deathPerson->date_of_death ? date('d/m/Y', strtotime($certificate->deathPerson->date_of_death)) : '00/00/0000' }}
                                @else
                                    {{ $certificate->date_of_death ? date('d/m/Y', strtotime($certificate->date_of_death)) : '00/00/0000' }}
                                @endif
                            </strong> Date 
                            <strong>
                                @if($certificate->deathPerson)
                                    {{ $certificate->deathPerson->cause_of_death ?? '' }}
                                @else
                                    {{ $certificate->death_cause ?? '' }}
                                @endif
                            </strong> He died of causes related to his death.
His death registration number is -
                            <strong>
                                @if($certificate->deathPerson)
                                    {{ $certificate->deathPerson->system_id ?? '' }}
                                @else
                                    {{ $certificate->death_reg_no ?? '' }}
                                @endif
                            </strong>।
                            To the best of my knowledge, at the time of his death he left behind the heirs/heirs mentioned in the table below.
                        </p>


                        <p class="text-center"><strong>- List of heirs -</strong></p>

                        @php
                            $members = is_null($certificate->members) ? [] : json_decode($certificate->members, true);
                        @endphp

                        <table class="member-table">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>NID</th>
                                    <th>Relation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($members as $member)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $member['name'] }}</td>
                                        <td>{{ $member['age'] }}</td>
                                        <td>{{ $member['nid'] }}</td>
                                        <td>{{ $member['relation'] }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No heir information found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <p style="margin-top:10px;">
                            <span style="margin-left:40px;"></span>
                           I wish him all the best and a prosperous life.
                        </p>

                    </div>
                </div>

                <!-- ================= Signature ================= -->
                @include('backend.partials.chairman_signature', ['certificate' => $certificate])

                <!-- ================= Footer ================= -->
                <div class="certificate-footer">
                    This report generated by CLMS | Powered by <strong>Adventure Soft</strong>
                </div>

            </div>
        </div>
    </div>

    <!-- ===== Buttons ===== -->
    <div class="text-center mt-2 mb-4">
        <button 
            id="cancelPageButton" 
            class="btn btn-danger btn-sm px-4"
            onclick="goToIndex();">
            Cancel
        </button>

        <button 
            id="printPageButton" 
            class="btn btn-success btn-sm px-4 ms-2"
            onclick="window.print();">
            Print
        </button>
    </div>
</div>


@endsection

@push('script')
<script>
    function goToIndex(){
        window.location.href = "{{ route('succession.index') }}";
    }
</script>
@endpush




