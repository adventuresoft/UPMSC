@extends('backend.master', ['mainMenu' => 'People', 'subMenu' => 'approvedList'])

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
                                <h3 class="card-title text-dark m-0" style="font-size: 14px;">Registered People</h3>
                            </div>

                            <div class="col-md-6 text-right">
                                @if (create_permission())
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
                                    <th>Present Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($users && count($users) > 0)
                                    @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                         <!--<td>
                                            {{ $user->system_id ?? '' }}
                                        </td>-->

                                        <td>
                                            <img src="{{ asset($user->image ?? 'default.png') }}"
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
                                            @foreach(optional($user->professionalInfos) as $info)
                                                <span class="badge-profession">{{ $info->designation }}</span>
                                            @endforeach
                                        </td>

                                        <td>
                                            <!--
                                            @php
                                                $instituteFind = user_institute_information($user->institute_id);
                                            @endphp
                                            {{ $instituteFind['institute']->name ?? '' }} {{ $instituteFind['institute_type'] ?? '' }} -->
                                           {{ collect([
    $user->addressInfo?->presentDistrict?->name ?? '',
    $user->addressInfo?->presentThana?->name ?? '',
    $user->addressInfo?->presentPostoffice?->name ?? '',
])->filter()->implode(', ') }} 

<br/>

{{ collect([
    $user->addressInfo?->presentVillage?->en_name ?? '',
    $user->addressInfo?->presentWard?->en_ward_no ?? '',
    $user->addressInfo?->present_area ?? '',
    $user->addressInfo?->presentRoad?->name ?? '',
    $user->addressInfo?->presentHouse?->house ?? ''
])->filter()->implode(', ') }}
                                        </td>

                                        <td>
                                                <div class="table-action">
                                                    @if (view_permission())
                                                        @if(is_superadmin())
                                                        <a href="{{ route('people.edit', $user->id) }}" 
                                                            class="btn-action btn-edit" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        @endif
                                                        
                                                        <a href="{{ route('people.show', $user->id) }}" 
                                                            class="btn-action btn-view" title="View">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
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

<!-- Reset Password Modal -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="resetPasswordForm" method="POST">
                @csrf
                <div class="modal-header bg-warning">
                    <h5 class="modal-title"><i class="fas fa-key mr-2"></i> Reset Credentials</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Resetting password for: <strong><span id="resetPersonName"></span></strong></p>
                    
                    <div class="form-group mb-3">
                        <label>New Password</label>
                        <input type="password" name="password" id="new_password" class="form-control" required minlength="8">
                    </div>
                    <div class="form-group mb-0">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning" id="btnSubmitReset">Reset Now</button>
                </div>
            </form>
        </div>
    </div>
</div>

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

        // --- Credential Management Scripts ---
        
        // Reveal Password
        $('.btn-reveal').click(function() {
            const id = $(this).data('id');
            const textSpan = $('#password-text-' + id);
            const icon = $(this).find('i');
            const box = $('#reveal-box-' + id);

            if (icon.hasClass('fa-eye')) {
                $.get("{{ route('peoples.credentials.reveal', ':id') }}".replace(':id', id), function(res) {
                    if (res.status) {
                        textSpan.text(res.password).removeClass('password-masked').addClass('text-danger font-weight-bold');
                        icon.removeClass('fa-eye').addClass('fa-eye-slash');

                        // Auto-hide after 10 seconds
                        setTimeout(() => {
                            textSpan.text('••••').addClass('password-masked').removeClass('text-danger font-weight-bold');
                            icon.removeClass('fa-eye-slash').addClass('fa-eye');
                        }, 10000);
                    }
                });
            } else {
                textSpan.text('••••').addClass('password-masked').removeClass('text-danger font-weight-bold');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        // Toggle Status
        $('.btn-toggle-status').click(function() {
            const id = $(this).data('id');
            if (!confirm("Are you sure you want to change portal access status?")) return;

            $.post("{{ route('peoples.credentials.toggle', ':id') }}".replace(':id', id), {
                _token: "{{ csrf_token() }}"
            }, function(res) {
                if (res.status) {
                    toastr.success(res.message);
                    setTimeout(() => window.location.reload(), 1000);
                }
            });
        });

        // Reset Modal
        let resetId = null;
        $('.btn-reset-modal').click(function() {
            resetId = $(this).data('id');
            $('#resetPersonName').text($(this).data('name'));
            $('#resetPasswordModal').modal('show');
        });

        $('#resetPasswordForm').submit(function(e) {
            e.preventDefault();
            const btn = $('#btnSubmitReset');
            btn.prop('disabled', true).text('Processing...');

            $.post("{{ route('peoples.credentials.reset', ':id') }}".replace(':id', resetId), $(this).serialize(), function(res) {
                if (res.status) {
                    toastr.success(res.message);
                    $('#resetPasswordModal').modal('hide');
                    btn.prop('disabled', false).text('Reset Now');
                }
            }).fail(function(xhr) {
                btn.prop('disabled', false).text('Reset Now');
                toastr.error(xhr.responseJSON.message || "Reset failed");
            });
        });

    });
</script>

@endpush
