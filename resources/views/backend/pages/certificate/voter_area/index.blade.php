@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'VoterArea'])

@push('style')
<style>
    .citizen-id {
        font-weight: bold;
        color: black;
        font-size: 15px;
    }

    .table td {
        vertical-align: middle !important;
    }

    .row.mb-3 input {
        height: 32px;
        font-size: 13px;
    }

    /* hide datatable search */
    .dataTables_filter {
        display: none;
    }

    /* Keep some premium elements */
    .badge-nid {
        background: #e9ecef;
        color: #495057;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
    }

    .badge-date {
        background: #e9ecef;
        color: #495057;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
    }

    .status-badge {
        display: inline-block;
        padding: 3px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-badge.pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-badge.approved {
        background: #d4edda;
        color: #155724;
    }

    .status-badge.rejected {
        background: #f8d7da;
        color: #721c24;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
    }

    .img-circle {
        border-radius: 50%;
        object-fit: cover;
    }
</style>
@endpush

@section('title', 'Voter Area Certificate')

@section('content')

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card card-info">

                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="card-title" style="font-size:24px; font-weight: semi-bold;">Voter Area Certificate</h3>
                            </div>

                            <div class="col-md-6 text-right">
                                @if (create_permission('certificate'))
                                <a href="{{ route('voter-area.create') }}" class="btn btn-primary">Create</a>
                                <a href="{{ route('voter-area.index') }}" class="btn btn-primary">List</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <!-- FILTER BAR -->
                        <div class="row mb-3 align-items-center g-2">

                            <!-- Show Entries -->
                            <div class="col-md-1">
                                <select id="tableLength" class="form-control form-control-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>

                            <!-- Certificate Number Filter -->
                            <div class="col-md-2">
                                <input type="text" id="search_cert" class="form-control form-control-sm"
                                    placeholder="Certificate No">
                            </div>

                            <!-- NID Number Filter -->
                            <div class="col-md-2">
                                <input type="text" id="search_nid" class="form-control form-control-sm"
                                    placeholder="ID or Name">
                            </div>

                            <!-- Name Filter -->
                            <div class="col-md-2">
                                <input type="text" id="search_name" class="form-control form-control-sm"
                                    placeholder="Name">
                            </div>

                            <!-- Status Filter -->
                            <div class="col-md-2">
                                <select id="search_status" class="form-control form-control-sm">
                                    <option value="">All Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>

                            <!-- GLOBAL SEARCH -->
                            <div class="col-md-3"> 
                                <input type="text" id="search_global" class="form-control form-control-sm" 
                                    placeholder="Search"> 
                            </div>

                        </div>

                        <!-- TABLE -->
                        <table id="example1" class="table table-bordered table-striped" style="width:100%">

                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Photo</th>
                                    <th>Certificate No & Date</th>
                                    <th>ID & Name</th>
                                    <th>Address & Mobile</th>
                                    <th>Voter Area Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($certificates && count($certificates) > 0)
                                    @foreach ($certificates as $key => $certificate)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>

                                        <td>
                                            <img src="{{ imageUrl($certificate->user?->image ?? 'default.png') }}"
                                                width="55"
                                                height="65"
                                                class="img"
                                                onerror="this.src='{{ asset('default.png') }}'">
                                        </td>

                                        <td>
                                            <span class="badge-nid">
                                                <strong>{{ $certificate->certificate_number ??($certificate->system_id ?? 'N/A') }}</strong>
                                            </span><br>
                                            <small class="text-muted">{{ $certificate->created_at ? date('d-m-Y', strtotime($certificate->created_at)) : 'N/A' }}</small>
                                        </td>

                                        <td>
                                            <span class="citizen-id">
                                                {{ $certificate->user?->people?->approved_id ?? 'No ID' }}
                                            </span><br>
                                            <strong>{{ $certificate->applicant_name ?? $certificate->user?->name ?? 'N/A' }}</strong>
                                        </td>

                                        <td>
                                            {{ $certificate->current_village_road ?? $certificate->user?->address ?? 'N/A' }} <br>
                                            <strong>{{ $certificate->transfer_phone_mobile ?? $certificate->user?->mobile ?? 'N/A' }}</strong>
                                        </td>

                                        <td>
                                            @if($certificate->current_voter_area_name)
                                                <span class="badge badge-info">Current: {{ $certificate->current_voter_area_name }}</span><br>
                                            @endif
                                            @if($certificate->transfer_voter_area_name)
                                                <span class="badge badge-success">Transfer: {{ $certificate->transfer_voter_area_name }}</span>
                                            @endif
                                        </td>





                                        <td style="white-space: nowrap;">
                                            <div class="d-flex align-items-center justify-content-center" style="gap: 5px;">
                                                @if($certificate->status == 0)
                                                    <button onclick="approveCertificate({{ $certificate->id }})" class="btn btn-success btn-sm">
                                                        <i class="fa fa-check"></i> Approve
                                                    </button>
                                                    @if (edit_permission('voter_area_certificate'))
                                                    <a href="{{ route('voter-area.edit', $certificate->id) }}" 
                                                        class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    @endif
                                                @else
                                                    @if (edit_permission('voter_area_certificate'))
                                                    <a href="{{ route('voter-area.edit', $certificate->id) }}" 
                                                        class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    @endif
                                                    <a target="_blank" href="{{ route('voter-area.show', $certificate->id) }}" 
                                                        class="btn btn-primary btn-sm" title="English Certificate">
                                                        <i class="fa fa-file-pdf"></i> EN
                                                    </a>
                                                    <a target="_blank" href="{{ route('voter-area.bn_certificate', $certificate->id) }}" 
                                                        class="btn btn-info btn-sm" title="Bengali Certificate">
                                                        <i class="fa fa-file-pdf"></i> BN
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="100%" class="empty-state">
                                            <i class="fas fa-folder-open"></i>
                                            <h5>No voter area certificates found</h5>
                                            <p class="text-muted">Get started by creating a new certificate.</p>
                                            @if (create_permission('certificate'))
                                            <a href="{{ route('voter-area.create') }}" class="btn btn-primary mt-2">
                                                <i class="fas fa-plus-circle mr-1"></i> Create New
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('script')

<script>
    $(function() {

        let table = $('#example1').DataTable({
            responsive: true,
            autoWidth: false,
            scrollX: false,
            pageLength: 10,
            lengthChange: false,
            order: [[0, 'asc']],
            columnDefs: [
                { targets: 1, orderable: false }, // Disable sorting on photo column
                { targets: 8, orderable: false }  // Disable sorting on action column
            ],
            language: {
                emptyTable: '<div class="empty-state"><i class="fas fa-folder-open"></i><h5>No data available</h5></div>',
                zeroRecords: '<div class="empty-state"><i class="fas fa-folder-open"></i><h5>No matching records found</h5></div>'
            }
        });

        // Certificate No (Column 2)
        $('#search_cert').keyup(function() {
            table.column(2).search(this.value).draw();
        });

        // ID & Name (Column 3)
        $('#search_name').keyup(function() {
            table.column(3).search(this.value).draw();
        });

        // Status (Column 6)
        $('#search_status').change(function() {
            table.column(6).search(this.value).draw();
        });

        $('#search_global').keyup(function() { 
            table.search(this.value).draw(); 
        });

        // Change show entries
        $('#tableLength').change(function() {
            table.page.len($(this).val()).draw();
        });

    });

    function approveCertificate(id) {
        if (confirm('Are you sure you want to approve this application?')) {
            $.ajax({
                type: "POST",
                url: "{{ route('voter-area.approve') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function(response) {
                    if (response.status) {
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error("Something went wrong!");
                }
            });
        }
    }
</script>

@endpush