@extends('backend.master', ['mainMenu' => 'People', 'subMenu' => 'search'])

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

    .btn-edit { background-color: #dbeafe !important; color: #2563eb !important; border-color: #bfdbfe !important; }
    .btn-view { background-color: #e0f2fe !important; color: #0284c7 !important; border-color: #bae6fd !important; }
    .btn-toggle { background-color: #f3f4f6 !important; color: #4b5563 !important; border-color: #e2e8f0 !important; }
    .btn-reset { background-color: #fffbeb !important; color: #d97706 !important; border-color: #fef3c7 !important; }

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

    .password-masked {
        letter-spacing: 2px;
        color: #64748b;
        font-family: monospace;
        font-size: 11px;
    }
    
    .reveal-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 0 10px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        height: 30px;
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

@section('title', 'Search People')

@section('content')

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card card-info">

                    <div class="card-header bg-white py-3 border-bottom">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="card-title text-dark m-0" style="font-size: 14px;">Search Citizen</h3>
                            </div>

                            <div class="col-md-6 text-right">
                                @if (create_permission('people'))
                                <a href="{{ route('people.create') }}" class="btn btn-sm btn-primary font-weight-bold px-3">
                                    <i class="fas fa-plus-circle mr-1"></i> CREATE
                                </a>
                                <a href="{{ route('people.index') }}" class="btn btn-sm btn-secondary font-weight-bold px-3">
                                    <i class="fas fa-list mr-1"></i> APPLICANT LIST
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
                                <div class="col-md-2">
                                    <button type="button" id="resetFilter" class="btn btn-sm btn-outline-danger w-100" style="height: 38px; border-radius: 8px;">
                                        <i class="fas fa-undo mr-1"></i> Reset
                                    </button>
                                </div>
                            </div>

                            <div class="row align-items-center g-3 mt-3">
                                <div class="col-md-3">
                                    <select id="search_profession" class="form-control form-control-sm select2" data-placeholder="Profession...">
                                        <option value="">All Professions</option>
                                        @foreach($professions as $profession)
                                            <option value="{{ $profession->en_name }}">{{ $profession->en_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select id="search_financial" class="form-control form-control-sm select2" data-placeholder="Financial...">
                                        <option value="">All Financial</option>
                                        <option value="Yes">Has Account</option>
                                        <option value="No">No Account</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select id="search_age" class="form-control form-control-sm select2" data-placeholder="Age...">
                                        <option value="">All Ages</option>
                                        <option value="0-18">0 - 18 Years</option>
                                        <option value="19-30">19 - 30 Years</option>
                                        <option value="31-50">31 - 50 Years</option>
                                        <option value="51+">51+ Years</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select id="search_disability" class="form-control form-control-sm select2" data-placeholder="Disability...">
                                        <option value="">All (Disability)</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row align-items-center g-3 mt-3">
                                <div class="col-md-3">
                                    <select id="search_freedom_fighter" class="form-control form-control-sm select2" data-placeholder="Freedom Fighter...">
                                        <option value="">All (Freedom Fighter)</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select id="search_area" class="form-control form-control-sm select2" data-placeholder="Area...">
                                        <option value="">All Areas</option>
                                        @foreach($permittedAreas as $area)
                                            <option value="{{ $area['id'] }}">{{ $area['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select id="search_ward" class="form-control form-control-sm select2" data-placeholder="Ward...">
                                        <option value="">All Wards</option>
                                        @foreach($permittedWards as $ward)
                                            <option value="{{ $ward->id }}">Ward {{ $ward->en_ward_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- TABLE -->
                        <table id="example1" class="table table-bordered table-striped">

                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Photo</th>
                                    <th>Reg. ID & Name</th>
                                    <th>Mobile</th>
                                    <th>Gender & DOB</th>
                                    <th>Profession</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($users && count($users) > 0)
                                    @foreach ($users as $key => $user)
                                    @php
                                        $age = 0;
                                        if (!empty($user->people?->date_of_birth)) {
                                            $age = \Carbon\Carbon::parse($user->people->date_of_birth)->age;
                                        }
                                         $professions_list = [];
                                         foreach ($user->professionalInfos ?? [] as $info) {
                                             if ($info->subcategory?->category?->type?->profession?->en_name) {
                                                 $professions_list[] = $info->subcategory->category->type->profession->en_name;
                                             }
                                             if ($info->subcategory?->category?->type?->en_name) {
                                                 $professions_list[] = $info->subcategory->category->type->en_name;
                                             }
                                             if ($info->subcategory?->category?->en_name) {
                                                 $professions_list[] = $info->subcategory->category->en_name;
                                             }
                                             if ($info->subcategory?->en_name) {
                                                 $professions_list[] = $info->subcategory->en_name;
                                             }
                                             if ($info->designation) {
                                                 $professions_list[] = $info->designation;
                                             }
                                             if ($info->organization) {
                                                 $professions_list[] = $info->organization;
                                             }
                                         }
                                         $professions_list = implode(',', array_unique($professions_list));
                                        $isFinancial = $user->financialInfos && count($user->financialInfos) > 0 ? 'Yes' : 'No';
                                        $isDisability = $user->disabilityInfo && $user->disabilityInfo->is_disability ? 'Yes' : 'No';
                                        $isFreedomFighter = $user->freedomFighterInfo && $user->freedomFighterInfo->is_freedom_fighter ? 'Yes' : 'No';
                                    @endphp
                                    <tr data-profession="{{ strtolower($professions_list) }}" 
                                        data-age="{{ $age }}" 
                                        data-financial="{{ $isFinancial }}" 
                                        data-disability="{{ $isDisability }}" 
                                        data-freedom-fighter="{{ $isFreedomFighter }}"
                                        data-area-id="{{ $user->addressInfo?->permanent_union_id ?? '' }}"
                                        data-ward-id="{{ $user->addressInfo?->permanent_ward_id ?? '' }}">
                                        <td>{{ ++$key }}</td>
                                         <!--<td>
                                            {{ $user->system_id ?? '' }}
                                        </td>-->

                                        <td>
                                            <img src="{{ imageUrl($user->image ?? 'default.png') }}"
                                                width="55"
                                                height="65"
                                                class="img-table"
                                                onerror="this.src='{{ asset('default.png') }}'">
                                        </td>

                                        <td>
                                            <a href="{{ route('people.show', $user->id) }}" style="color: inherit; text-decoration: none;">
                                                <span class="citizen-id">
                                                    {{$user->people?->approved_id}}
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
                                                $gender = isset($user->people?->gender) ? ($genderOptions[$user->people?->gender] ?? '') : '';
                                                $dob = $user->people?->date_of_birth ?? '';
                                            @endphp
                                            {{ $gender }}<br>
                                            <small>{{ $dob ? date('d-m-Y', strtotime($dob)) : 'N/A' }}</small>
                                        </td>

                                        <td>
                                             @foreach($user->professionalInfos ?? [] as $info)
                                                 @php
                                                     $profName = $info->subcategory?->category?->type?->profession?->en_name;
                                                     $typeName = $info->subcategory?->category?->type?->en_name;
                                                     $categoryName = $info->subcategory?->category?->en_name;
                                                     $subcategoryName = $info->subcategory?->en_name;
                                                     $desigName = $info->designation;
                                                     $orgName = $info->organization;
                                                 @endphp
                                                 <div class="profession-item">
                                                     @if($profName)
                                                         <span class="badge badge-info text-white" style="font-size: 12px; padding: 4px 8px; font-weight: 600; border-radius: 4px; display: inline-block;">
                                                             {{ $profName }}
                                                         </span>
                                                     @endif
                                                     
                                                     @if($desigName || $orgName)
                                                         <div style="margin-top: 4px; font-size: 12px; font-weight: 600; color: #2c3e50;">
                                                             {{ $desigName ?? '' }}
                                                             @if($desigName && $orgName) <span style="font-weight: 400; color: #7f8c8d;">at</span> @endif
                                                             <span style="color: #2980b9;">{{ $orgName ?? '' }}</span>
                                                         </div>
                                                     @endif

                                                     @php
                                                         $hierarchy = collect([$typeName, $categoryName, $subcategoryName])->filter()->unique()->implode(' ➔ ');
                                                     @endphp
                                                     @if($hierarchy)
                                                         <div style="margin-top: 3px; font-size: 11px; color: #7f8c8d; font-style: italic; line-height: 1.2;">
                                                             {{ $hierarchy }}
                                                         </div>
                                                     @endif
                                                 </div>
                                                 @if(!$loop->last)
                                                     <hr style="margin: 6px 0; border: 0; border-top: 1px dashed #dee2e6;">
                                                 @endif
                                             @endforeach
                                         </td>

                                        <td>
                                           <strong>Present:</strong> {{ collect([
    $user->addressInfo?->presentDistrict?->name ?? '',
    $user->addressInfo?->presentThana?->name ?? '',
    $user->addressInfo?->presentUnion?->name ?? '',
    $user->addressInfo?->presentPostoffice?->name ?? ''
])->filter()->implode(', ') }} 
<br/>
{{ collect([
    $user->addressInfo?->presentVillage?->en_name ?? '',
    $user->addressInfo?->presentWard?->en_ward_no ?? '',
    $user->addressInfo?->present_area ?? '',
    $user->addressInfo?->presentRoad?->name ?? $user->addressInfo?->present_road ?? '',
    $user->addressInfo?->presentHouse?->house ?? $user->addressInfo?->present_house ?? ''
])->filter()->implode(', ') }}

<br/>
<br/>

                                           <strong>Permanent:</strong> {{ collect([
    $user->addressInfo?->permanentDistrict?->name ?? '',
    $user->addressInfo?->permanentThana?->name ?? '',
    $user->addressInfo?->permanentUnion?->name ?? '',
    $user->addressInfo?->permanentPostOffice?->name ?? ''
])->filter()->implode(', ') }} 
<br/>
{{ collect([
    $user->addressInfo?->permanentVillage?->en_name ?? '',
    $user->addressInfo?->permanentWard?->en_ward_no ?? '',
    $user->addressInfo?->permanent_area ?? '',
    $user->addressInfo?->permanentRoad?->name ?? $user->addressInfo?->permanent_road ?? '',
    $user->addressInfo?->permanentHouse?->house ?? $user->addressInfo?->permanent_house ?? ''
])->filter()->implode(', ') }}
                                        </td>

                                        <td>
                                                <div class="table-action">
                                                    @if (edit_permission('people'))
                                                    <a href="{{ route('people.edit', $user->id) }}" 
                                                        class="btn-action btn-edit" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    @endif
                                                    
                                                    @if (view_permission('people'))
                                                    <a href="{{ route('people.show', $user->id) }}" 
                                                        class="btn-action btn-view" title="View">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    @endif

                                                    @if (delete_permission('people'))
                                                    <form action="{{ route('people.destroy', $user->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn-action btn-danger btn-delete-confirm" title="Delete" style="background-color: #fee2e2 !important; color: #dc2626 !important; border-color: #fca5a5 !important; border-radius: 8px; width: 30px; height: 30px; display: inline-flex; align-items: center; justify-content: center; transition: all 0.2s;">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    @endif
                                                </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="empty-state">
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
                { targets: 7, orderable: false }  // Disable sorting on action column
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

        // Initialize Select2 for advanced filters
        $('.select2').select2({
            theme: 'bootstrap4',
            width: '100%',
            allowClear: true
        });

        // Custom DataTables Filter for Advanced Options
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex, rowData, counter) {
            if (settings.nTable.id !== 'example1') {
                return true;
            }

            var tr = $(settings.aoData[dataIndex].nTr);
            var rowProfession = tr.data('profession') || '';
            var rowAge = parseInt(tr.data('age')) || 0;
            var rowDisability = tr.data('disability') || '';
            var rowFreedomFighter = tr.data('freedom-fighter') || '';
            var rowFinancial = tr.data('financial') || '';
            var rowAreaId = tr.data('area-id') || '';
            var rowWardId = tr.data('ward-id') || '';

            var searchProfession = $('#search_profession').val();
            var searchFinancial = $('#search_financial').val();
            var searchAge = $('#search_age').val();
            var searchDisability = $('#search_disability').val();
            var searchFreedomFighter = $('#search_freedom_fighter').val();
            var searchArea = $('#search_area').val();
            var searchWard = $('#search_ward').val();

            // Profession check
            if (searchProfession && searchProfession !== '') {
                if (rowProfession.indexOf(searchProfession.toLowerCase()) === -1) {
                    return false;
                }
            }

            // Financial check
            if (searchFinancial && searchFinancial !== '') {
                if (rowFinancial !== searchFinancial) return false;
            }

            // Age check
            if (searchAge && searchAge !== '') {
                if (searchAge === '0-18' && (rowAge < 0 || rowAge > 18)) return false;
                if (searchAge === '19-30' && (rowAge < 19 || rowAge > 30)) return false;
                if (searchAge === '31-50' && (rowAge < 31 || rowAge > 50)) return false;
                if (searchAge === '51+' && rowAge <= 50) return false;
            }

            // Disability check
            if (searchDisability && searchDisability !== '') {
                if (rowDisability !== searchDisability) return false;
            }

            // Freedom Fighter check
            if (searchFreedomFighter && searchFreedomFighter !== '') {
                if (rowFreedomFighter !== searchFreedomFighter) return false;
            }

            // Area check
            if (searchArea && searchArea !== '') {
                if (String(rowAreaId) !== String(searchArea)) {
                    return false;
                }
            }

            // Ward check
            if (searchWard && searchWard !== '') {
                if (String(rowWardId) !== String(searchWard)) {
                    return false;
                }
            }

            return true;
        });

        // Trigger redraw when advanced filters change
        $('#search_profession, #search_financial, #search_age, #search_disability, #search_freedom_fighter, #search_area, #search_ward').change(function() {
            table.draw();
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
            
            // Clear advanced filters
            $('#search_profession').val('').trigger('change.select2');
            $('#search_financial').val('').trigger('change.select2');
            $('#search_age').val('').trigger('change.select2');
            $('#search_disability').val('').trigger('change.select2');
            $('#search_freedom_fighter').val('').trigger('change.select2');
            $('#search_area').val('').trigger('change.select2');
            $('#search_ward').val('').trigger('change.select2');
            
            // Clear all searches
            table.search('').columns().search('').draw();
        });

    });
</script>

@endpush
