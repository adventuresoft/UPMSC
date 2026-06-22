@extends('backend.master', ['mainMenu' => 'LocalGovtJudiciary', 'subMenu' => 'VillageCourtList'])
@push('style')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .timeline {
            position: relative;
            margin: 0 0 30px 0;
            padding: 0;
            list-style: none;
        }
        .timeline::before {
            content: "";
            position: absolute;
            top: 0;
            bottom: 0;
            left: 31px;
            width: 4px;
            background: #e9ecef;
            border-radius: 2px;
        }
        .timeline > li {
            position: relative;
            margin-right: 10px;
            margin-bottom: 15px;
        }
        .timeline > li::before, .timeline > li::after {
            content: "";
            display: table;
        }
        .timeline > li::after {
            clear: both;
        }
        .timeline > li > .timeline-item {
            box-shadow: 0 0 1px rgba(0,0,0,.125),0 1px 3px rgba(0,0,0,.2);
            border-radius: .25rem;
            background-color: #fff;
            color: #495057;
            margin-left: 60px;
            margin-right: 15px;
            padding: 10px;
            position: relative;
        }
        .timeline > li > .timeline-item > .time {
            color: #999;
            float: right;
            padding: 10px;
            font-size: 12px;
        }
        .timeline > li > .timeline-item > .timeline-header {
            margin: 0;
            color: #495057;
            border-bottom: 1px solid rgba(0,0,0,.125);
            padding: 5px 0 10px 0;
            font-size: 16px;
            font-weight: bold;
        }
        .timeline > li > .timeline-item > .timeline-body {
            padding: 10px 0 0 0;
        }
        .timeline > li > .fa, .timeline > li > .fas, .timeline > li > .far {
            width: 30px;
            height: 30px;
            font-size: 15px;
            line-height: 30px;
            position: absolute;
            color: #fff;
            background-color: #adb5bd;
            border-radius: 50%;
            text-align: center;
            left: 18px;
            top: 0;
        }
    </style>
@endpush
@section('title', 'Case Dashboard')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Case Dashboard - {{ $case->case_no }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('village-court.index') }}">Case</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Left Column: Case Information & Printing -->
                <div class="col-md-8">
                    <!-- Case Summary Card -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Case Details (মামলার বিবরণ)</h3>
                            <div class="card-tools">
                                <span class="badge {{ $case->status == 'pending' ? 'badge-warning' : ($case->status == 'court_formed' ? 'badge-primary' : 'badge-success') }}">
                                    @if($case->status == 'pending')
                                        মামলা রুজু (Pending)
                                    @elseif($case->status == 'court_formed')
                                        আদালত গঠিত (Court Formed)
                                    @elseif($case->status == 'decided')
                                        রায় ঘোষিত (Verdict Declared)
                                    @else
                                        {{ ucfirst($case->status) }}
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-4"><strong>Case Number:</strong> {{ $case->case_no }}</div>
                                <div class="col-sm-4"><strong>Filing Date:</strong> {{ $case->case_date ? $case->case_date->format('d-m-Y') : 'N/A' }}</div>
                                <div class="col-sm-4"><strong>Filing Time:</strong> {{ $case->case_time ? \Carbon\Carbon::parse($case->case_time)->format('h:i A') : 'N/A' }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4"><strong>Case Category (অংশ):</strong> {{ $case->case_category ?? 'N/A' }}</div>
                                <div class="col-sm-8"><strong>Case Type (তফসিল):</strong> {{ $case->case_type_details ?? 'N/A' }}</div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <h5><strong>Plaintiff (বাদী)</strong></h5>
                                    @php
                                        $badiName = $case->badi->name ?? $case->badi->user->name ?? null;
                                        $badiBnName = $case->badi->bn_name ?? null;
                                    @endphp
                                    <p class="mb-1"><strong>Name:</strong> 
                                        @if($badiName && $badiBnName)
                                            {{ $badiName }} ({{ $badiBnName }})
                                        @else
                                            {{ $badiName ?? $badiBnName ?? 'N/A' }}
                                        @endif
                                    </p>
                                    <p class="mb-1"><strong>NID:</strong> {{ $case->badi->nid ?? $case->badi->user->nid ?? 'N/A' }}</p>
                                    <p class="mb-1"><strong>Mobile:</strong> {{ $case->badi->mobile ?? $case->badi->user->mobile ?? 'N/A' }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <h5><strong>Defendant(s) (প্রতিবাদী)</strong></h5>
                                    @php $bibadis = $case->bibadis(); @endphp
                                    @foreach($bibadis as $bibadi)
                                        @php
                                            $bibadiName = $bibadi->name ?? $bibadi->user->name ?? null;
                                            $bibadiBnName = $bibadi->bn_name ?? null;
                                        @endphp
                                        <p class="mb-1"><strong>Name:</strong> 
                                            @if($bibadiName && $bibadiBnName)
                                                {{ $bibadiName }} ({{ $bibadiBnName }})
                                            @else
                                                {{ $bibadiName ?? $bibadiBnName ?? 'N/A' }}
                                            @endif
                                        </p>
                                        <p class="mb-1"><strong>NID:</strong> {{ $bibadi->nid ?? $bibadi->user->nid ?? 'N/A' }}</p>
                                        <p class="mb-1"><strong>Mobile:</strong> {{ $bibadi->mobile ?? $bibadi->user->mobile ?? 'N/A' }}</p>
                                        @if(!$loop->last)<hr class="my-1">@endif
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <h5><strong>Complaint Details (অভিযোগের বিবরণ)</strong></h5>
                                <p class="bg-light p-2 rounded">{{ $case->ovijog_er_biboron ?? 'No description provided.' }}</p>
                            </div>

                            @if($case->status != 'pending')
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5><strong>Court Panel Configuration (আদালত প্যানেল)</strong></h5>
                                    <table class="table table-bordered table-sm mt-2">
                                        <thead>
                                            <tr class="bg-light">
                                                <th>Nomination Role</th>
                                                <th>Nominee Name</th>
                                                <th>Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>Panel Head (চেয়ারম্যান)</strong></td>
                                                <td>{{ $case->panelHead->name ?? 'N/A' }}</td>
                                                <td>Union Chairman</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Badi UP Member</strong></td>
                                                <td>{{ $case->badiUpMember->name ?? 'N/A' }}</td>
                                                <td>UP Member</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Badi Citizen Representative</strong></td>
                                                <td>{{ $case->badiCitizen->name ?? 'N/A' }}</td>
                                                <td>Citizen</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Bibadi UP Member</strong></td>
                                                <td>{{ $case->bibadiUpMember->name ?? 'N/A' }}</td>
                                                <td>UP Member</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Bibadi Citizen Representative</strong></td>
                                                <td>{{ $case->bibadiCitizen->name ?? 'N/A' }}</td>
                                                <td>Citizen</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-6"><strong>Appearance Date (হাজিরার তারিখ):</strong> {{ $case->hajir_date ? $case->hajir_date->format('d-m-Y') : 'N/A' }}</div>
                                <div class="col-sm-6"><strong>Appearance Time (হাজিরার সময়):</strong> {{ $case->hajir_time ? \Carbon\Carbon::parse($case->hajir_time)->format('h:i A') : 'N/A' }}</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-6"><strong>Hearing Date (শুনানির তারিখ):</strong> {{ $case->sunani_date ? $case->sunani_date->format('d-m-Y') : 'N/A' }}</div>
                                <div class="col-sm-6"><strong>Hearing Time (শুনানির সময়):</strong> {{ $case->sunani_time ? \Carbon\Carbon::parse($case->sunani_time)->format('h:i A') : 'N/A' }}</div>
                            </div>
                            @endif

                            @if($case->status == 'decided')
                            <hr>
                            <div class="mb-3">
                                <h5><strong>Court Verdict / Decision (রায়ের কপি)</strong></h5>
                                <div class="alert alert-success">
                                    <h6><strong>Verdict Date:</strong> {{ $case->verdict_date ? $case->verdict_date->format('d-m-Y') : 'N/A' }}</h6>
                                    <p class="mb-0" style="white-space: pre-wrap;">{{ $case->verdict }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Printable Notice Table Card -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Notice & Forms List (নোটিশ ও ফরম তালিকা)</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Notice Type / Form</th>
                                        <th>Description</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>ফরম-১: আবেদনপত্র</strong></td>
                                        <td>Case filing details form.</td>
                                        <td class="text-right">
                                            <button type="button" onclick="openPrintPreview('{{ route('village-court.print-notice', ['id' => $case->id, 'type' => 'form1']) }}')" class="btn btn-sm btn-outline-primary"><i class="fas fa-print"></i> Print</button>
                                        </td>
                                    </tr>
                                    @foreach($bibadis as $bIndex => $bibadi)
                                    <tr>
                                        <td><strong>ফরম-৪: প্রতিবাদীর সমন ({{ $bibadi->name }})</strong></td>
                                        <td>Summons issued to the defendant.</td>
                                        <td class="text-right">
                                            <button type="button" onclick="openPrintPreview('{{ route('village-court.print-notice', ['id' => $case->id, 'type' => 'form4', 'refId' => $bibadi->id]) }}')" class="btn btn-sm btn-outline-primary"><i class="fas fa-print"></i> Print</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @php $shakkhis = $case->shakkhis(); @endphp
                                    @foreach($shakkhis as $sIndex => $shakkhi)
                                    <tr>
                                        <td><strong>ফরম-৫: সাক্ষীর সমন ({{ $shakkhi->name }})</strong></td>
                                        <td>Summons issued to the witness.</td>
                                        <td class="text-right">
                                            <button type="button" onclick="openPrintPreview('{{ route('village-court.print-notice', ['id' => $case->id, 'type' => 'form5', 'refId' => $shakkhi->id]) }}')" class="btn btn-sm btn-outline-primary"><i class="fas fa-print"></i> Print</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td><strong>ফরম-১১: মামলার স্লিপ</strong></td>
                                        <td>Hearing Date and location slip.</td>
                                        <td class="text-right">
                                            <button type="button" onclick="openPrintPreview('{{ route('village-court.print-notice', ['id' => $case->id, 'type' => 'form11']) }}')" class="btn btn-sm btn-outline-primary"><i class="fas fa-print"></i> Print</button>
                                        </td>
                                    </tr>
                                    @if($case->status == 'decided')
                                    <tr>
                                        <td><strong>রায়ের অনুলিপি</strong></td>
                                        <td>Official verdict copy of the court decision.</td>
                                        <td class="text-right">
                                            <button type="button" onclick="openPrintPreview('{{ route('village-court.print-notice', ['id' => $case->id, 'type' => 'verdict']) }}')" class="btn btn-sm btn-success"><i class="fas fa-print"></i> Print Verdict</button>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Case Actions Card -->
                    <div class="card card-primary card-outline mt-3">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-gavel mr-1"></i>
                                Judicial Workflow Steps (মামলা পরিচালনার ধাপসমূহ)
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    @if($case->status == 'pending')
                                        <a href="{{ route('village-court.form-court.view', $case->id) }}" class="btn btn-primary btn-block p-3">
                                            <i class="fas fa-users-cog fa-2x d-block mb-2"></i>
                                            <strong>১. আদালত গঠন</strong><br>
                                            <span class="small">(Create Adalat)</span>
                                        </a>
                                    @else
                                        <button class="btn btn-outline-success btn-block p-3" disabled>
                                            <i class="fas fa-check-circle fa-2x d-block mb-2 text-success"></i>
                                            <strong>১. আদালত গঠিত</strong><br>
                                            <span class="small">(Adalat Created)</span>
                                        </button>
                                    @endif
                                </div>
                                <div class="col-md-4 mb-2">
                                    @if($case->status == 'pending')
                                        <button class="btn btn-outline-secondary btn-block p-3" disabled title="প্রথমে আদালত গঠন করতে হবে">
                                            <i class="fas fa-comments fa-2x d-block mb-2 text-muted"></i>
                                            <strong>২. শুনানি পরিচালনা</strong><br>
                                            <span class="small">(Manage Hearing)</span>
                                        </button>
                                    @elseif($case->status == 'court_formed')
                                        <a href="{{ route('village-court.hearing.view', $case->id) }}" class="btn btn-warning btn-block p-3 text-white">
                                            <i class="fas fa-comments fa-2x d-block mb-2"></i>
                                            <strong>২. শুনানি পরিচালনা</strong><br>
                                            <span class="small">(Manage Hearing)</span>
                                        </a>
                                    @elseif($case->status == 'hearing' || $case->status == 'decided')
                                        <button class="btn btn-outline-success btn-block p-3" disabled>
                                            <i class="fas fa-check-circle fa-2x d-block mb-2 text-success"></i>
                                            <strong>২. শুনানি সম্পন্ন</strong><br>
                                            <span class="small">(Hearing Completed)</span>
                                        </button>
                                    @endif
                                </div>
                                <div class="col-md-4 mb-2">
                                    @if($case->status == 'pending')
                                        <button class="btn btn-outline-secondary btn-block p-3" disabled title="প্রথমে আদালত গঠন করতে হবে">
                                            <i class="fas fa-balance-scale fa-2x d-block mb-2 text-muted"></i>
                                            <strong>৩. রায় ঘোষণা</strong><br>
                                            <span class="small">(Declare Verdict)</span>
                                        </button>
                                    @elseif($case->status == 'court_formed' || $case->status == 'hearing')
                                        <a href="{{ route('village-court.verdict.view', $case->id) }}" class="btn btn-success btn-block p-3">
                                            <i class="fas fa-balance-scale fa-2x d-block mb-2"></i>
                                            <strong>৩. রায় ঘোষণা</strong><br>
                                            <span class="small">(Declare Verdict)</span>
                                        </a>
                                    @elseif($case->status == 'decided')
                                        <button class="btn btn-outline-success btn-block p-3" disabled>
                                            <i class="fas fa-check-circle fa-2x d-block mb-2 text-success"></i>
                                            <strong>৩. রায় ঘোষিত</strong><br>
                                            <span class="small">(Verdict Declared)</span>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: History Log -->
                <div class="col-md-4">
                    <!-- Case Timeline History Card -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Case History Logs (মামলার ইতিহাস)</h3>
                        </div>
                        <div class="card-body" style="max-height: 600px; overflow-y: auto;">
                            @if($case->histories->count() > 0)
                            <ul class="timeline">
                                @foreach($case->histories as $history)
                                <li>
                                    @if($history->action == 'filed')
                                        <i class="fas fa-file-invoice bg-warning"></i>
                                    @elseif($history->action == 'court_formed')
                                        <i class="fas fa-gavel bg-primary"></i>
                                    @elseif($history->action == 'verdict_declared')
                                        <i class="fas fa-check-circle bg-success"></i>
                                    @else
                                        <i class="fas fa-history bg-secondary"></i>
                                    @endif
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> {{ $history->created_at->format('d-m-Y h:i A') }}</span>
                                        <h3 class="timeline-header">
                                            @if($history->action == 'filed')
                                                মামলা রুজু (Case Filed)
                                            @elseif($history->action == 'court_formed')
                                                আদালত গঠিত (Court Formed)
                                            @elseif($history->action == 'verdict_declared')
                                                রায় ঘোষণা (Verdict Declared)
                                            @else
                                                {{ ucfirst($history->action) }}
                                            @endif
                                        </h3>
                                        <div class="timeline-body">
                                            {{ $history->description }}
                                            <div class="text-right mt-1"><small class="text-muted">By: {{ $history->creator->name ?? 'System' }}</small></div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <p class="text-muted text-center py-3">No history logged for this case.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Print Preview Modal -->
    <div class="modal fade" id="printPreviewModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Print Preview (A4 Paper Size)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="background: #525659; padding: 0; height: 75vh;">
              <iframe id="printIframe" src="" style="width: 100%; height: 100%; border: none;"></iframe>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="document.getElementById('printIframe').contentWindow.print()"><i class="fas fa-print"></i> Print Now</button>
          </div>
        </div>
      </div>
    </div>

@endsection
@push('script')
    <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $('.select2').select2({ theme: 'bootstrap4' });
        });

        function openPrintPreview(url) {
            var fullUrl = url + (url.indexOf('?') !== -1 ? '&' : '?') + 'preview=true';
            $('#printIframe').attr('src', fullUrl);
            $('#printPreviewModal').modal('show');
        }
    </script>
@endpush
