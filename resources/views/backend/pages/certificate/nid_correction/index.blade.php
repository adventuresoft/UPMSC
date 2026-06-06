@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'NidCorrection'])

@push('style')
<style>
    .card-info:not(.card-outline) > .card-header {
        background-color: #f3f4f6;
        border-bottom-color: #e6eef3;
        color: #6b7a86;
    }
    .card-title {
        font-weight: semi-bold;
        font-size: 24px;
    }
    .btn-create-list {
        display: inline-block;
        margin-left: 5px;
    }
    .table thead th {
        background-color: #f8f9fa;
        color: #333;
        font-weight: 600;
        font-size: 14px;
        border-bottom: 2px solid #dee2e6;
    }
    .table td {
        vertical-align: middle !important;
        font-size: 14px;
    }
    .badge-pending {
        background-color: #fff3cd;
        color: #856404;
        font-weight: bold;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 11px;
    }
    .badge-approved {
        background-color: #d4edda;
        color: #155724;
        font-weight: bold;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 11px;
    }
    .btn-pdf-en {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 12px;
    }
    .btn-pdf-bn {
        background-color: #17a2b8;
        color: white;
        border: none;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 12px;
    }
    .filter-row input, .filter-row select {
        height: 35px;
        font-size: 13px;
    }
    /* Hide datatable default elements to match image */
    .dataTables_filter, .dataTables_length {
        display: none;
    }
    .img-circle {
        width: 40px;
        height: 40px;
        object-fit: cover;
    }
</style>
@endpush

@section('title', 'NID Correction Certificate')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="card-title">NID Correction Certificate</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('nid-correction.create') }}" class="btn btn-primary">Create</a>
                                <a href="{{ route('nid-correction.index') }}" class="btn btn-primary ml-2">List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- FILTER ROW -->
                        <div class="row mb-3 filter-row">
                            <div class="col-md-1">
                                <select id="customLength" class="form-control">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="text" id="filter_cert_no" class="form-control" placeholder="Certificate No">
                            </div>
                            <div class="col-md-2">
                                <input type="text" id="filter_nid" class="form-control" placeholder="NID Number">
                            </div>
                            <div class="col-md-2">
                                <input type="text" id="filter_name" class="form-control" placeholder="Name">
                            </div>
                            <div class="col-md-2">
                                <select id="filter_status" class="form-control">
                                    <option value="">All Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="customSearch" class="form-control" placeholder="Search">
                            </div>
                        </div>

                        <!-- TABLE -->
                        <table id="nidTable" class="table table-bordered table-hover nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Photo</th>
                                    <th>Certificate No</th>
                                    <th>NID & Name</th>
                                    <th>Address & Mobile</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($certificates as $key => $certificate)
                                @php
                                    // Fallback: use user profile data if certificate fields are empty (pre-migration records)
                                    $displayName    = $certificate->applicant_name ?: ($certificate->user?->name ?? '—');
                                    $displayNid     = $certificate->applicant_nid  ?: ($certificate->user?->people?->nid ?? '—');
                                    $displayMobile  = $certificate->applicant_mobile ?: ($certificate->user?->mobile ?? '—');
                                    $displayImage   = $certificate->user?->people?->image ?? 'assets/images/person-avatar.png';
                                @endphp
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="text-center">
                                        <img src="{{ imageUrl($displayImage) }}" style="width: 55px; height: 65px; border-radius: 0; object-fit: cover;" onerror="this.onerror=null;this.src='{{ asset('assets/images/person-avatar.png') }}'">
                                    </td>
                                    <td class="text-center" style="font-size: 16px;">
                                        {{($certificate->system_id) }}
                                    </td>
                                    <td>
                                        <span style="font-weight: bold; font-size: 16px;">{{ bnValue($displayNid) }}</span><br>
                                        <span style="color: #444;">{{ $displayName }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ $displayMobile }}</strong><br>
                                        <small>
                                            @if($certificate->user && $certificate->user?->addressInfo)
                                                {{ $certificate->user?->addressInfo?->permanentVillage?->bn_name ?? '' }},
                                                ওয়ার্ড নং-{{ bnValue($certificate->user?->addressInfo?->permanentWard?->bn_ward_no ?? '') }},
                                                {{ $certificate->user?->addressInfo?->permanentPostOffice?->bn_name ?? '' }}
                                                @if($certificate->user?->addressInfo?->permanentPostOffice?->postal_code ?? false)
                                                    - {{ bnValue($certificate->user?->addressInfo?->permanentPostOffice?->postal_code) }}
                                                @endif
                                                ,<br>
                                                {{ $certificate->user?->institute?->union?->thana?->bn_name ?? '' }},
                                                {{ $certificate->user?->institute?->union?->thana?->district?->bn_name ?? '' }}।
                                            @elseif($certificate->applicant_address)
                                                {{ $certificate->applicant_address }}
                                            @else
                                                —
                                            @endif
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        {{ date('d-m-Y', strtotime($certificate->created_at)) }}
                                    </td>
                                    <td class="text-center" style="white-space: nowrap;">
                                        <div class="d-flex align-items-center justify-content-center" style="gap: 5px;">
                                            @if (edit_permission('nid_correction_certificate'))
                                            <a href="{{ route('nid-correction.edit', $certificate->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            @endif
                                            <a target="_blank" href="{{ route('nid-correction.show', $certificate->id) }}" class="btn btn-primary btn-sm" title="English Certificate">
                                                <i class="far fa-file-pdf"></i> EN
                                            </a>
                                            <a target="_blank" href="{{ route('nid-correction.bn_certificate', $certificate->id) }}" class="btn btn-info btn-sm" title="Bengali Certificate">
                                                <i class="far fa-file-pdf"></i> BN
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
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
    $(document).ready(function() {
        var table = $('#nidTable').DataTable({
            "responsive": true,
            "autoWidth": false,
            "lengthChange": false,
            "pageLength": 10,
            "dom": 'lrtip' // Hide default search
        });

        // Custom Search
        $('#customSearch').keyup(function() {
            table.search($(this).val()).draw();
        });

        // Custom Length
        $('#customLength').change(function() {
            table.page.len($(this).val()).draw();
        });

        // Filter by Certificate No
        $('#filter_cert_no').keyup(function() {
            table.column(2).search($(this).val()).draw();
        });

        // Filter by NID or Name
        $('#filter_nid').keyup(function() {
            table.column(3).search($(this).val()).draw();
        });

        // Filter by Name (mapping to column 3 as well)
        $('#filter_name').keyup(function() {
            table.column(3).search($(this).val()).draw();
        });
    });
</script>
@endpush