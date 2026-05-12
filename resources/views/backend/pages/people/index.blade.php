@extends('backend.master', ['mainMenu' => 'People', 'subMenu' => 'View'])

@push('style')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

    .card {
        border-radius: 12px !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04) !important;
        border: 1px solid #edf2f7 !important;
        font-family: 'Inter', sans-serif;
        background: #fff !important;
    }

    .card-header {
        background: #fff !important;
        border-bottom: 1px solid #edf2f7 !important;
        padding: 1rem 1.25rem !important;
    }

    .card-title {
        font-size: 14px !important;
        font-weight: 800 !important;
        color: #1a202c !important;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .filter-bar {
        background-color: #f8fafc;
        padding: 1.25rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        border: 1px solid #e2e8f0;
    }

    .table {
        margin: 0 !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
    }

    .table thead th {
        background-color: #f8fafc !important;
        text-transform: uppercase;
        font-size: 10px !important;
        font-weight: 700 !important;
        letter-spacing: 0.05em;
        color: #64748b !important;
        border-top: 1px solid #e2e8f0 !important;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 12px 10px !important;
        white-space: nowrap;
        vertical-align: middle !important;
        position: relative;
    }

    /* Fix DataTable sorting icon overlap */
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc:after {
        bottom: 0.5em !important;
    }

    .table thead th.sorting,
    .table thead th.sorting_asc,
    .table thead th.sorting_desc {
        padding-right: 25px !important;
    }

    /* Specific fix for SL column */
    .table thead th:first-child {
        min-width: 60px !important;
        text-align: center !important;
        padding-right: 10px !important; /* Less padding since it's centered */
    }
    
    .table thead th:first-child:before,
    .table thead th:first-child:after {
        display: none !important; /* Hide sort icons for SL to save space if needed */
    }

    .table tbody td:first-child {
        text-align: left !important;
        padding-left: 30px !important; /* Compact space for button */
        font-weight: 600;
        color: #64748b;
        position: relative;
    }

    /* Standard Blue Circular Toggle (+) */
    table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control:before {
        top: 50% !important;
        left: 6px !important;
        height: 16px !important;
        width: 16px !important;
        margin-top: -8px !important;
        display: block !important;
        position: absolute !important;
        color: white !important;
        border: 2px solid white !important;
        border-radius: 50% !important;
        box-shadow: 0 0 3px rgba(0,0,0,0.2) !important;
        box-sizing: content-box !important;
        text-align: center !important;
        text-indent: 0 !important;
        line-height: 16px !important;
        content: '+' !important;
        background-color: #3182ce !important; /* Standard blue */
        font-family: inherit !important;
        font-size: 14px !important;
    }

    /* Compact SL column */
    .table thead th:first-child {
        min-width: 50px !important;
        padding-left: 10px !important;
    }

    .table tbody td {
        vertical-align: middle !important;
        font-size: 12px !important;
        color: #334155 !important;
        padding: 10px !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }

    .table tbody tr:hover {
        background-color: #f8fafc !important;
    }

    /* Hide default DataTable elements we replaced */
    .dataTables_filter, .dataTables_length {
        display: none !important;
    }

    .citizen-id {
        font-weight: 800;
        color: #1e293b;
        font-size: 11px;
        background: #f1f5f9;
        padding: 2px 8px;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
    }

    .form-control-sm {
        height: 38px !important;
        font-size: 12px !important;
        border-radius: 8px !important;
        border: 1px solid #e2e8f0 !important;
        background-color: #ffffff !important;
        padding: 0 12px !important;
        color: #475569 !important;
        transition: all 0.2s ease;
    }

    .form-control-sm:focus {
        border-color: #046307 !important;
        box-shadow: 0 0 0 3px rgba(4, 99, 7, 0.08) !important;
        background-color: #fff !important;
    }

    .btn-action {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        border: 1px solid transparent !important;
        margin-right: 4px;
    }

    .btn-action i { font-size: 12px; }

    .btn-approve-people { background-color: #dcfce7 !important; color: #16a34a !important; border-color: #bbf7d0 !important; }
    .btn-edit { background-color: #dbeafe !important; color: #2563eb !important; border-color: #bfdbfe !important; }
    .btn-view { background-color: #e0f2fe !important; color: #0284c7 !important; border-color: #bae6fd !important; }

    .btn-action:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05) !important;
    }

    .img-table {
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #e2e8f0;
        padding: 1px;
        background: #fff;
    }

    .badge-profession {
        background-color: #f1f5f9;
        color: #475569;
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 700;
        display: inline-block;
        margin: 1px;
        border: 1px solid #e2e8f0;
    }
    .dataTables_info {
        font-size: 11px !important;
        color: #64748b !important;
        font-weight: 500 !important;
    }

    .pagination {
        margin-top: 1rem !important;
    }

    .page-link {
        padding: 6px 12px !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        color: #475569 !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        margin: 0 2px !important;
    }

    .page-item.active .page-link {
        background-color: #046307 !important;
        border-color: #046307 !important;
        color: #ffffff !important;
    }

    .page-link:hover {
        background-color: #f1f5f9 !important;
        color: #0f172a !important;
    }
</style>
@endpush

@section('title', 'People View')

@section('content')

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card card-info">

                    <div class="card-header bg-white py-3 border-bottom">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="card-title text-dark m-0" style="font-size: 14px;">Applicant Information</h3>
                            </div>

                            <div class="col-md-6 text-right">
                                @if (create_permission())
                                <a href="{{ route('people.create') }}" class="btn btn-sm btn-primary font-weight-bold px-3">
                                    <i class="fas fa-plus-circle mr-1"></i> CREATE
                                </a>
                                <a href="{{ route('people.index') }}" class="btn btn-sm btn-secondary font-weight-bold px-3">
                                    <i class="fas fa-list mr-1"></i> LIST
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <!-- FILTER BAR -->
                        <div class="filter-bar">
                            <div class="row align-items-center g-3">
                                <div class="col-md-2">
                                    <select id="tableLength" class="form-control form-control-sm">
                                        <option value="10">10 entries</option>
                                        <option value="25">25 entries</option>
                                        <option value="50">50 entries</option>
                                        <option value="100">100 entries</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" id="search_name" class="form-control form-control-sm" placeholder="Search Name...">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" id="search_mobile" class="form-control form-control-sm" placeholder="Mobile No...">
                                </div>
                                <div class="col-md-2">
                                    <select id="search_gender" class="form-control form-control-sm">
                                        <option value="">All Genders</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" id="search_global" class="form-control form-control-sm" placeholder="Global search...">
                                </div>
                            </div>
                        </div>

                        <!-- TABLE -->
                        <table id="example1" class="table table-bordered table-striped">

                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    
                                    <th>Photo</th>
                                    <th>ID & Name</th>
                                    <th>Mobile</th>
                                    <th>Gender & DOB</th>
                                    <th>Profession</th>
                                    <th>Ward</th>
                                    <th>District & Upazila</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($users && count($users) > 0)
                                    @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                         

                                        <td>
                                            @php
                                                $imagePath = $user->image && file_exists(public_path($user->image)) 
                                                    ? asset($user->image) 
                                                    : asset('default.png');
                                            @endphp
                                            <img src="{{ $imagePath }}"
                                                width="40"
                                                height="50"
                                                class="img-table"
                                                onerror="this.src='{{ asset('default.png') }}'">
                                        </td>

                                        <td>
                                            <a href="{{ route('people.show', $user->id) }}" style="color: inherit; text-decoration: none;">
                                                <span class="citizen-id">
                                                    {{ $user->system_id ?? '' }}
                                                </span><br>
                                                <strong>{{ $user->name ?? '' }}</strong>
                                            </a>
                                        </td>

                                        <td>
                                            @if($user->mobile)
                                                <span style="color: black;">{{ $user->mobile }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            @php
                                                $genderOptions = people_constant_option('gender');
                                                $gender = isset($user->people->gender) ? ($genderOptions[$user->people->gender] ?? '') : '';
                                                $dob = $user->people->date_of_birth ?? '';
                                            @endphp
                                            {{ $gender }}<br>
                                            <small>{{ $dob ? date('d-m-Y', strtotime($dob)) : 'N/A' }}</small>
                                        </td>

                                        <td>
                                            @foreach(optional($user->professionalInfos) as $info)
                                                <span class="badge-profession">{{ $info->designation }}</span>
                                            @endforeach
                                        </td>

                                        <td>
                                           
                                            {{ $user->addressInfo->presentWard->en_ward_no ?? ''}} 
                                        </td>
                                        

                                        <td>
                                            {{ collect([
    $user->addressInfo->presentDistrict->name ?? '',
    $user->addressInfo->presentThana->name ?? ''
])->filter()->implode(', ') }} 
                                        </td>

                                        <td>
                                            <!--
                                            @php
                                                $instituteFind = user_institute_information($user->institute_id);
                                            @endphp
                                            {{ $instituteFind['institute']->name ?? '' }} {{ $instituteFind['institute_type'] ?? '' }} -->
                                          <strong>Present:</strong>  {{ collect([
    $user->addressInfo->presentPostoffice->name ?? '',
    $user->addressInfo->presentVillage->en_name ?? '',
    $user->addressInfo->present_area ?? '',
    $user->addressInfo->presentRoad->name ?? '',
    $user->addressInfo->presentHouse->house ?? ''
])->filter()->implode(', ') }} 

<br/>
<strong>
Permanent:</strong>
{{ collect([
    $user->addressInfo->permanentDistrict->name ?? '',
    $user->addressInfo->permanentThana->name ?? '',
    $user->addressInfo->permanentPostoffice->name ?? '',
    $user->addressInfo->permanentVillage->en_name ?? '',
    $user->addressInfo->permanent_area ?? '',
    $user->addressInfo->permanentRoad->name ?? '',
    $user->addressInfo->permanentHouse->house ?? ''
])->filter()->implode(', ') }}
                                        </td>

                                        <td>
                                            <div class="table-action">
                                                @if(empty($user->people->approved_id))
                                                    <button class="btn-action btn-approve-people btn-approve-people-trigger" 
                                                        data-id="{{ $user->people->id }}" 
                                                        data-name="{{ $user->name }}" 
                                                        title="Approve Applicant">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                @endif

                                                @if(Auth::user()->role_id == 1)
                                                <a href="{{ route('people.edit', $user->id) }}" 
                                                    class="btn-action btn-edit" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                @endif

                                                <a href="{{ route('people.show', $user->id) }}" 
                                                    class="btn-action btn-view" title="View">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="empty-state">
                                            <i class="fas fa-folder-open"></i>
                                            <h5>No people found</h5>
                                            <p class="text-muted">Get started by creating a new person.</p>
                                            @if (create_permission())
                                            <a href="{{ route('people.create') }}" class="btn btn-primary mt-2">
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

@include('backend.pages.people.partials.approve-modal')

@endsection

@push('script')

<script>
    $(function() {

        let table = $('#example1').DataTable({
            responsive: true,
            autoWidth: false,
            pageLength: 10,
            lengthChange: false,
            order: [[0, 'asc']],
            columnDefs: [
                { targets: 1, orderable: false }, // Disable sorting on photo column
                { targets: 9, orderable: false }  // Disable sorting on action column
            ],
            language: {
                emptyTable: '<div class="empty-state"><i class="fas fa-folder-open"></i><h5>No data available</h5></div>',
                zeroRecords: '<div class="empty-state"><i class="fas fa-folder-open"></i><h5>No matching records found</h5></div>'
            }
        });

        // Name (Column 2)
        $('#search_name').keyup(function() {
            table.column(2).search(this.value).draw();
        });

        // Mobile & Email (Column 3)
        $('#search_mobile').keyup(function() {
            table.column(3).search(this.value).draw();
        });

        // Email (also Column 3 - combined with mobile)
        $('#search_email').keyup(function() {
            table.column(3).search(this.value).draw();
        });

        // Gender & DOB (Column 4)
        $('#search_gender').change(function() {
            table.column(4).search(this.value).draw();
        });

        // Institute (Column 5)
        $('#search_institute').keyup(function() {
            table.column(5).search(this.value).draw();
        });

        // Global Search
        $('#search_global').keyup(function() { 
            table.search(this.value).draw(); 
        });

        // Change show entries
        $('#tableLength').change(function() {
            table.page.len($(this).val()).draw();
        });

        // Reset filter
        $('#resetFilter').click(function() {
            // Clear all input fields
            $('#search_name').val('');
            $('#search_mobile').val('');
            $('#search_email').val('');
            $('#search_gender').val('');
            $('#search_institute').val('');
            $('#search_global').val('');
            
            // Clear all searches
            table.search('').columns().search('').draw();
        });

    });
</script>

@endpush
