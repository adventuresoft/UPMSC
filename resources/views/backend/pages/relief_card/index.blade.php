@extends('backend.master', ['mainMenu' => 'Relief Card', 'subMenu' => 'ReliefCardList'])

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

    .dataTables_filter {
        display: none;
    }

    .status-badge {
        cursor: pointer;
        transition: all 0.3s;
    }

    .status-badge:hover {
        transform: scale(1.05);
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }
</style>
@endpush

@section('title', 'Relief Card Applications')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header bg-gradient-to-r from-pink-600 to-pink-700 text-white">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="card-title font-bold text-lg"><i class="fas fa-hand-holding-heart mr-2"></i>Relief Card Applications</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('relief-card.create') }}" class="btn btn-sm btn-light font-bold text-pink-700 shadow-sm">
                                    <i class="fas fa-plus mr-2"></i> Create New
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- FILTER BAR -->
                        <div class="row mb-3 align-items-center g-2">
                            <div class="col-md-1">
                                <select id="tableLength" class="form-control form-control-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="text" id="search_ward" class="form-control form-control-sm" placeholder="Search Ward">
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="search_global" class="form-control form-control-sm" placeholder="Search All">
                            </div>
                        </div>

                        <!-- WARD-WISE TABLE -->
                        <table id="wardTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Ward</th>
                                    <th>Number of People</th>
                                    <th>Status Summary</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($groupedByWard as $wardId => $data)
                                <tr class="ward-row">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($data['ward'])
                                            Ward {{ $data['ward']->en_ward_no ?? $data['ward']->bn_ward_no ?? $data['ward']->id }}
                                        @else
                                            No Ward
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info people-btn" data-ward-id="{{ $wardId }}" data-edit-mode="false" onclick="showPeopleModal(this)">
                                            <i class="fas fa-users mr-2"></i>{{ $data['count'] }} People
                                        </button>
                                    </td>
                                    <td>
                                        @php
                                            $statusCounts = [];
                                            $statusText = ['Pending', 'Approved', 'Rejected', 'Received', 'Dispatched'];
                                            $statusBadge = ['warning', 'success', 'danger', 'primary', 'dark'];
                                            foreach ($data['cards'] as $card) {
                                                if (!isset($statusCounts[$card['status']])) {
                                                    $statusCounts[$card['status']] = 0;
                                                }
                                                $statusCounts[$card['status']]++;
                                            }
                                        @endphp
                                        @foreach($statusCounts as $status => $count)
                                            <span class="badge badge-{{ $statusBadge[$status] }} mr-1">
                                                {{ $statusText[$status] }}: {{ $count }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <!-- Edit button (opens modal with edit mode) -->
                                        <button class="btn btn-sm btn-warning mb-1 mr-1" data-ward-id="{{ $wardId }}" data-edit-mode="true" onclick="showPeopleModal(this)">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </button>
                                        
                                        <!-- Delete button (deletes all in ward) -->
                                        <button class="btn btn-sm btn-danger mb-1 mr-1" data-ward-id="{{ $wardId }}" data-count="{{ $data['count'] }}" onclick="deleteWard(this)">
                                            <i class="fas fa-trash mr-1"></i> Delete
                                        </button>
                                        
                                        <!-- Ward-level status buttons -->
                                        <button class="btn btn-sm btn-success mb-1 mr-1" data-ward-id="{{ $wardId }}" data-status="1" onclick="updateWardStatus(this)">
                                            <i class="fas fa-check mr-1"></i> Mark All Approved
                                        </button>
                                        <button class="btn btn-sm btn-primary mb-1 mr-1" data-ward-id="{{ $wardId }}" data-status="3" onclick="updateWardStatus(this)">
                                            <i class="fas fa-inbox mr-1"></i> Mark All Received
                                        </button>
                                        <button class="btn btn-sm btn-dark mb-1 mr-1" data-ward-id="{{ $wardId }}" data-status="4" onclick="updateWardStatus(this)">
                                            <i class="fas fa-paper-plane mr-1"></i> Mark All Dispatched
                                        </button>
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

<!-- PEOPLE MODAL -->
<div class="modal fade" id="peopleModal" tabindex="-1" role="dialog" aria-labelledby="peopleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-to-r from-pink-600 to-pink-700 text-white">
                <h5 class="modal-title" id="peopleModalLabel">
                    <i class="fas fa-users mr-2"></i>People in Ward
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="peopleModalBody">
                <!-- Content will be populated by JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
    // Store grouped data for modal
    const groupedData = JSON.parse('{!! addslashes(json_encode($groupedByWard)) !!}');

    $(function() {
        // Basic search functionality
        $('#search_ward, #search_global').keyup(function() {
            const searchTerm = $(this).val().toLowerCase();
            $('.ward-row').each(function() {
                const text = $(this).text().toLowerCase();
                $(this).toggle(text.includes(searchTerm));
            });
        });
    });

    function showPeopleModal(element) {
        const wardId = element.getAttribute('data-ward-id');
        const isEditMode = element.getAttribute('data-edit-mode') === 'true';
        const data = groupedData[wardId];
        const statusText = ['Pending', 'Approved', 'Rejected', 'Received', 'Dispatched'];
        const statusBadge = ['warning', 'success', 'danger', 'primary', 'dark'];
        
        let html = `
            <table class="table table-bordered table-striped mt-3">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Photo</th>
                        <th>Card/App No</th>
                        <th>ID & Name</th>
                        <th>Relief Type</th>
                        <th>Status</th>
                        ${isEditMode ? '<th>Action</th>' : ''}
                    </tr>
                </thead>
                <tbody>
        `;
        
        data.cards.forEach((card, index) => {
            const nextStatus = card.status < 4 ? card.status + 1 : null;
            html += `
                <tr>
                    <td>${index + 1}</td>
                    <td><img src="${card.user.image_url}" width="50" height="60" class="img rounded border" onerror="this.src='{{ asset('default.png') }}'"></td>
                    <td>${card.system_id}</td>
                    <td>
                        <span class="citizen-id">${card.user.people?.approved_id ?? 'No ID'}</span><br>
                        ${card.user.name ?? 'N/A'}
                    </td>
                    <td><span class="badge badge-info">${card.relief_type}</span></td>
                    <td>
                        <span class="badge badge-${statusBadge[card.status]} ${isEditMode ? 'status-badge' : ''}" 
                              ${isEditMode && nextStatus !== null ? `onclick="updateStatus(${card.id}, ${nextStatus})" title="Click to update to ${statusText[nextStatus]}"` : ''}>
                            ${statusText[card.status]}
                        </span>
                    </td>
                    ${isEditMode ? `
                    <td>
                        <a href="${card.edit_url}" class="btn btn-sm btn-primary mb-1 mr-1">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        <button onclick="deleteCard('${card.delete_url}')" class="btn btn-sm btn-danger mb-1">
                            <i class="fas fa-trash mr-1"></i> Delete
                        </button>
                    </td>
                    ` : ''}
                </tr>
            `;
        });
        
        html += `</tbody></table>`;
        document.getElementById('peopleModalBody').innerHTML = html;
        $('#peopleModal').modal('show');
    }

    function updateStatus(id, status) {
        const statusText = ['Pending', 'Approved', 'Rejected', 'Received', 'Dispatched'];
        if (confirm('Are you sure you want to update status to ' + statusText[status] + '?')) {
            $.ajax({
                type: "POST",
                url: '{{ route("relief-card.update-status") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    status: status
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
                    toastr.error('Something went wrong!');
                }
            });
        }
    }

    function updateWardStatus(element) {
        const wardId = element.getAttribute('data-ward-id');
        const status = parseInt(element.getAttribute('data-status'), 10);
        const statusText = ['Pending', 'Approved', 'Rejected', 'Received', 'Dispatched'];
        const data = groupedData[wardId];
        
        if (confirm(`Are you sure you want to mark all ${data.cards.length} people in this ward as ${statusText[status]}?`)) {
            // Create a counter to track completed requests
            let completed = 0;
            let failed = 0;
            
            data.cards.forEach((card) => {
                $.ajax({
                    type: "POST",
                    url: '{{ route("relief-card.update-status") }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: card.id,
                        status: status
                    },
                    success: function(response) {
                        if (response.status) {
                            completed++;
                        } else {
                            failed++;
                        }
                    },
                    error: function() {
                        failed++;
                    },
                    complete: function() {
                        // Check if all requests are done
                        if (completed + failed === data.cards.length) {
                            if (failed === 0) {
                                toastr.success(`Successfully updated ${completed} cards to ${statusText[status]}!`);
                            } else {
                                toastr.warning(`Updated ${completed} cards, but ${failed} failed!`);
                            }
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    }
                });
            });
        }
    }

    function deleteWard(element) {
        const wardId = element.getAttribute('data-ward-id');
        const count = parseInt(element.getAttribute('data-count'), 10);
        
        if (confirm(`Are you sure you want to delete all ${count} relief cards in this ward? This action cannot be undone!`)) {
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("relief-card.delete-ward") }}';
            
            let csrfToken = document.createElement('input');
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            let wardIdField = document.createElement('input');
            wardIdField.name = 'ward_id';
            wardIdField.value = wardId;
            
            form.appendChild(csrfToken);
            form.appendChild(wardIdField);
            document.body.appendChild(form);
            form.submit();
        }
    }

    function deleteCard(url) {
        if (confirm('Are you sure you want to delete this relief card application?')) {
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = url;
            
            let csrfToken = document.createElement('input');
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            let methodField = document.createElement('input');
            methodField.name = '_method';
            methodField.value = 'DELETE';
            
            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
@endpush
