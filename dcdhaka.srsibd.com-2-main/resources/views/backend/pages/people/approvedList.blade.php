@extends('backend.master', ['mainMenu' => 'People', 'subMenu' => 'approvedList'])

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

    .row.mb-3 select {
        height: 32px;
        font-size: 13px;
    }

    /* hide datatable search */
    .dataTables_filter {
        display: none;
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

    .table-action {
        display: flex;
        gap: 5px;
    }

    .btn-action {
        padding: 4px 8px;
        font-size: 12px;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .badge-peo {
        background-color: #e7f3ff;
        color: #007bff;
        font-family: monospace;
        font-weight: bold;
        padding: 2px 8px;
        border-radius: 20px;
    }
    .password-masked {
        letter-spacing: 2px;
        color: #6c757d;
        font-family: monospace;
    }
    .reveal-box {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        padding: 2px 6px;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
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

                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="card-title" style="font-size:24px; font-weight: semi-bold;">People Information</h3>
                            </div>

                            <div class="col-md-6 text-right">
                                @if (create_permission())
                                <a href="{{ route('people.create') }}" class="btn btn-primary">Create</a>
                                <a href="{{ route('people.index') }}" class="btn btn-primary">List</a>
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

                            <!-- Name Filter -->
                            <div class="col-md-2">
                                <input type="text" id="search_name" class="form-control form-control-sm"
                                    placeholder="Name">
                            </div>

                            <!-- Mobile Filter -->
                            <div class="col-md-2">
                                <input type="text" id="search_mobile" class="form-control form-control-sm"
                                    placeholder="Mobile">
                            </div>

                            <!-- Email Filter -->
                            <div class="col-md-2">
                                <input type="text" id="search_email" class="form-control form-control-sm"
                                    placeholder="Email">
                            </div>

                            <!-- Gender Filter -->
                            <div class="col-md-2">
                                <select id="search_gender" class="form-control form-control-sm">
                                    <option value="">All Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <!-- Institute Filter -->
                            <!-- <div class="col-md-2">
                                <input type="text" id="search_institute" class="form-control form-control-sm"
                                    placeholder="Institute">
                            </div> -->

                            <!-- GLOBAL SEARCH -->
                            <!-- <div class="col-md-2 mt-2">  -->
                            <div class="col-md-2"> 
                                <input type="text" id="search_global" class="form-control form-control-sm" 
                                    placeholder="Search"> 
                            </div>

                            <!-- Reset Button -->
                            <!-- <div class="col-md-2 mt-2">
                                <button id="resetFilter" class="btn btn-secondary btn-sm w-100">
                                    Reset
                                </button>
                            </div> -->

                        </div>

                        <!-- TABLE -->
                        <table id="example1" class="table table-bordered table-striped">

                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Photo</th>
                                    <th>Reg. ID & Name</th>
                                    <th>Mobile & Email</th>
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
                                            @php
                                                $imagePath = $user->image && file_exists(public_path($user->image)) 
                                                    ? asset($user->image) 
                                                    : asset('default.png');
                                            @endphp
                                            <img src="{{ $imagePath }}"
                                                width="45"
                                                height="55"
                                                class="img"
                                                onerror="this.src='{{ asset('default.png') }}'">
                                        </td>

                                        <td>
                                            <span class="citizen-id">
                                                {{$user->people->approved_id}}
                                            </span><br>
                                            <strong>{{ $user->name ?? '' }}</strong>
                                        </td>

                                        <td>
                                            @if($user->mobile)
                                                <a href="tel:{{ $user->mobile }}">{{ $user->mobile }}</a>
                                            @endif
                                            @if($user->email)
                                                <br><a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
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
                                           {{ optional($user->professionalInfos)->pluck('designation')->implode(', ') }}
                                        </td>

                                        <td>
                                            <!--
                                            @php
                                                $instituteFind = user_institute_information($user->institute_id);
                                            @endphp
                                            {{ $instituteFind['institute']->name ?? '' }} {{ $instituteFind['institute_type'] ?? '' }} -->
                                           {{ collect([
    $user->addressInfo->presentDistrict->name ?? '',
    $user->addressInfo->presentThana->name ?? '',
    $user->addressInfo->presentPostoffice->name ?? '',
])->filter()->implode(', ') }} 

<br/>

{{ collect([
    $user->addressInfo->presentVillage->en_name ?? '',
    $user->addressInfo->presentWard->en_ward_no ?? '',
    $user->addressInfo->present_area ?? '',
    $user->addressInfo->presentRoad->name ?? '',
    $user->addressInfo->presentHouse->house ?? ''
])->filter()->implode(', ') }}
                                        </td>

                                        <td>
                                                <div class="table-action">
                                                    @if (view_permission())
                                                    <a href="{{ route('people.edit', $user->id) }}" 
                                                        class="btn btn-primary btn-sm btn-action" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('people.show', $user->id) }}" 
                                                        class="btn btn-info btn-sm btn-action" title="View">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    
                                                    @if($user->people)
                                                    <div class="reveal-box" id="reveal-box-{{ $user->people->id }}">
                                                        <span class="password-masked" id="password-text-{{ $user->people->id }}">••••</span>
                                                        <button class="btn btn-xs btn-link p-0 btn-reveal" data-id="{{ $user->people->id }}" title="Reveal Password">
                                                            <i class="fas fa-eye text-primary"></i>
                                                        </button>
                                                    </div>
                                                    
                                                    <button class="btn btn-secondary btn-sm btn-action btn-toggle-status" 
                                                        data-id="{{ $user->people->id }}" 
                                                        title="{{ $user->people->login_status === 'active' ? 'Suspend Portal Access' : 'Activate Portal Access' }}">
                                                        <i class="fas {{ $user->people->login_status === 'active' ? 'fa-user-slash text-danger' : 'fa-user-check text-success' }}"></i>
                                                    </button>
                                                    
                                                    <button class="btn btn-warning btn-sm btn-action btn-reset-modal" 
                                                        data-id="{{ $user->people->id }}" 
                                                        data-name="{{ $user->name }}" 
                                                        title="Reset Password">
                                                        <i class="fas fa-key"></i>
                                                    </button>
                                                    @endif
                                                    @endif
                                                </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="empty-state">
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
