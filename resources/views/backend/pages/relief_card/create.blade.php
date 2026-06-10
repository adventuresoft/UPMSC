@extends('backend.master', ['mainMenu' => 'Relief Card', 'subMenu' => 'ReliefCardList'])

@section('title', 'Create Relief Card')

@section('content')
<div class="p-4">
    <div class="container-fluid">
        <div class="row mb-3 align-items-center">
            <div class="col-sm-6">
                <h4 class="font-bold text-gray-800"><i class="fas fa-hand-holding-heart text-pink-600 mr-2"></i>Create Relief Card</h4>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-sm-right text-xs bg-transparent p-0 m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-pink-700 font-semibold">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('relief-card.index') }}" class="text-pink-700 font-semibold">Relief Cards</a></li>
                    <li class="breadcrumb-item active text-gray-500">Create</li>
                </ol>
            </div>
        </div>

        <div class="card card-outline card-pink shadow-lg rounded-xl overflow-hidden border-0 bg-white">
            <div class="card-header bg-gradient-to-r from-pink-600 to-pink-700 py-3.5 px-4 text-white">
                <h3 class="card-title text-base font-bold m-0"><i class="fas fa-file-invoice mr-2"></i>Relief Card Information</h3>
            </div>
            
            <form id="reliefCardForm" method="POST" action="{{ route('relief-card.store') }}">
                @csrf
                <div class="card-body bg-gray-50/20 p-4">
                    <!-- Input Fields (Filters) -->
                    <div class="row">
                        @if(count($wards) > 0)
                        <div class="col-md-4 mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="text-xs font-bold text-gray-600 m-0">Select Wards</label>
                                <button type="button" id="selectAllWardsBtn" class="btn btn-sm btn-secondary">Select All Wards</button>
                            </div>
                            <select class="form-control border-gray-200 rounded-lg text-sm h-11 focus:ring-pink-500 focus:border-pink-500 select2" id="ward_filter" multiple>
                                @foreach($wards as $ward)
                                    <option value="{{ $ward->id }}">
                                        Ward {{ $ward->en_ward_no ?? $ward->bn_ward_no ?? $ward->id }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="col-md-4 mb-4">
                            <label class="text-xs font-bold text-gray-600 block mb-2">Relief / Social Security Card Type <span class="text-red-500">*</span></label>
                            <select class="form-control border-gray-200 rounded-lg text-sm h-11 focus:ring-pink-500 focus:border-pink-500" name="relief_type" required>
                                <option value="">Select card type</option>
                                <option value="VGD (ভিজিডি)" {{ old('relief_type') == 'VGD (ভিজিডি)' ? 'selected' : '' }}>VGD (ভিজিডি কার্ড)</option>
                                <option value="VGF (ভিজিএফ)" {{ old('relief_type') == 'VGF (ভিজিএফ)' ? 'selected' : '' }}>VGF (ভিজিএফ কার্ড)</option>
                                <option value="OMS (ওএমএস)" {{ old('relief_type') == 'OMS (ওএমএস)' ? 'selected' : '' }}>OMS (ওএমএস রেশন কার্ড)</option>
                                <option value="Old Age Allowance (বয়স্ক ভাতা)" {{ old('relief_type') == 'Old Age Allowance (বয়স্ক ভাতা)' ? 'selected' : '' }}>Old Age Allowance (বয়স্ক ভাতা কার্ড)</option>
                                <option value="Disability Allowance (প্রতিবন্ধী ভাতা)" {{ old('relief_type') == 'Disability Allowance (প্রতিবন্ধী ভাতা)' ? 'selected' : '' }}>Disability Allowance (প্রতিবন্ধী ভাতা কার্ড)</option>
                                <option value="Medicine (ওষুধ)" {{ old('relief_type') == 'Medicine (ওষুধ)' ? 'selected' : '' }}>Medicine (ওষুধ)</option>
                                <option value="Food (খাদ্য)" {{ old('relief_type') == 'Food (খাদ্য)' ? 'selected' : '' }}>Food (খাদ্য)</option>
                                <option value="Cloths (কাপড়)" {{ old('relief_type') == 'Cloths (কাপড়)' ? 'selected' : '' }}>Cloths (কাপড়)</option>
                                <option value="Materials (উপকরণ)" {{ old('relief_type') == 'Materials (উপকরণ)' ? 'selected' : '' }}>Materials (উপকরণ)</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-4">
                            <label class="text-xs font-bold text-gray-600 block mb-2">Monthly Income (Taka) <span class="text-red-500">*</span></label>
                            <input type="number" class="form-control border-gray-200 rounded-lg text-sm h-11 focus:ring-pink-500" name="monthly_income" required min="0" placeholder="e.g., 5000" value="{{ old('monthly_income') }}">
                        </div>
                        <div class="col-md-2 mb-4">
                            <label class="text-xs font-bold text-gray-600 block mb-2">Family Members <span class="text-red-500">*</span></label>
                            <input type="number" class="form-control border-gray-200 rounded-lg text-sm h-11 focus:ring-pink-500" name="family_members" required min="1" value="{{ old('family_members', 1) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label class="text-xs font-bold text-gray-600 block mb-2">Reason / Requirement Description</label>
                            <textarea class="form-control border-gray-200 rounded-lg text-sm p-3 focus:ring-pink-500 focus:border-pink-500" name="reason" rows="2" placeholder="Briefly describe the financial situation or why this card is needed...">{{ old('reason') }}</textarea>
                        </div>
                    </div>

                    <!-- Hidden inputs for selected users -->
                    <div id="selectedUsersContainer"></div>

                    <!-- Selected Users Section -->
                    <div class="row mb-4" id="selectedUsersSection" style="display: none;">
                        <div class="col-md-12">
                            <div class="card card-outline card-info">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-users mr-2"></i>Selected Citizens (<span id="selectedCountDisplay">0</span>)</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row" id="selectedUsersGrid">
                                        <!-- Selected users will be populated here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Citizen Table -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <label class="text-xs font-bold text-gray-600 m-0">Select Citizens <span class="text-red-500">*</span> (<span id="selectedCount">0</span> selected)</label>
                                <button type="button" id="selectAllBtn" class="btn btn-sm btn-primary">Select All</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="citizenTable">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-center" style="width: 60px;">
                                                <input type="checkbox" id="selectAllCheckbox">
                                            </th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Approved ID</th>
                                            <th>Ward</th>
                                        </tr>
                                    </thead>
                                    <tbody id="citizenTableBody">
                                        @foreach($users as $user)
                                        <tr class="citizen-row" data-ward-id="{{ $user->addressInfo?->permanent_ward_id ?? '' }}" data-user-id="{{ $user->id }}" data-name="{{ $user->name }}" data-approved-id="{{ $user->people?->approved_id ?? 'No ID' }}" data-ward-name="{{ $user->addressInfo?->permanentWard ? 'Ward ' . ($user->addressInfo->permanentWard->en_ward_no ?? $user->addressInfo->permanentWard->bn_ward_no ?? $user->addressInfo->permanentWard->id) : '' }}" data-image-url="{{ imageUrl($user->image ?? 'default.png') }}">
                                            <td class="text-center">
                                                <input type="checkbox" class="citizen-checkbox" data-user-id="{{ $user->id }}" {{ (is_array(old('user_ids')) && in_array($user->id, old('user_ids'))) ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <img src="{{ imageUrl($user->image ?? 'default.png') }}" width="50" height="60" class="img rounded border">
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->people?->approved_id ?? 'No ID' }}</td>
                                            <td>
                                                @if($user->addressInfo?->permanentWard)
                                                    Ward {{ $user->addressInfo->permanentWard->en_ward_no ?? $user->addressInfo->permanentWard->bn_ward_no ?? $user->addressInfo->permanentWard->id }}
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                {{ $users->appends(request()->except('page'))->links() }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white py-4 px-4 text-right border-top d-flex justify-content-end gap-3">
                    <a href="{{ route('relief-card.index') }}" class="btn btn-light px-5 py-2.5 rounded-xl font-bold text-sm border hover:bg-gray-50 mr-2">Cancel</a>
                    <button type="submit" class="btn btn-pink px-5 py-2.5 rounded-xl font-bold text-sm shadow-md hover:shadow-lg transition bg-gradient-to-r from-pink-600 to-pink-700 hover:from-pink-700 hover:to-pink-800">
                        <i class="fas fa-check-circle mr-2"></i> Create Relief Card
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('style')
<style>
    .content-wrapper { background: #f4f6f9 !important; }
    body { font-family: 'Hind Siliguri', sans-serif; }
    .citizen-row { cursor: pointer; }
    .citizen-row:hover { background-color: #fef5f7; }
</style>
<link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;700&display=swap" rel="stylesheet">
@endpush

@push('script')
<script>
    $(document).ready(function() {
        // Store all users data (passed from controller)
        var allUsersData = @json($allUsers->keyBy('id'));

        // Initialize selected users from old input or empty array
        var selectedUserIds = @json(old('user_ids', []));

        // Create hidden inputs for selected users
        function updateSelectedUsersContainer() {
            var container = $('#selectedUsersContainer');
            container.empty();
            
            selectedUserIds.forEach(function(userId) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'user_ids[]',
                    value: userId
                }).appendTo(container);
            });

            updateSelectedCount();
            renderSelectedUsers();
        }

        // Function to update selected count
        function updateSelectedCount() {
            $('#selectedCount').text(selectedUserIds.length);
            $('#selectedCountDisplay').text(selectedUserIds.length);
        }

        // Function to render selected users grid
        function renderSelectedUsers() {
            var grid = $('#selectedUsersGrid');
            var section = $('#selectedUsersSection');
            grid.empty();

            if (selectedUserIds.length === 0) {
                section.hide();
                return;
            }

            section.show();

            selectedUserIds.forEach(function(userId) {
                var user = allUsersData[userId];
                // If user data isn't available, create a minimal card
                if (!user) {
                    user = {
                        id: userId,
                        name: 'User ' + userId,
                        approved_id: 'N/A',
                        ward_name: 'N/A',
                        image_url: '{{ asset('default.png') }}'
                    };
                }

                var card = '<div class="col-md-4 mb-3" id="selectedUserCard-' + userId + '">' +
                    '<div class="card">' +
                    '<div class="card-body d-flex align-items-center">' +
                    '<img src="' + user.image_url + '" width="50" height="60" class="img rounded border mr-3">' +
                    '<div class="flex-grow-1">' +
                    '<h6 class="mb-0 font-bold">' + user.name + '</h6>' +
                    '<small class="text-muted">' + user.approved_id + ' • ' + user.ward_name + '</small>' +
                    '</div>' +
                    '<button type="button" class="btn btn-sm btn-danger remove-user-btn" data-user-id="' + userId + '">' +
                    '<i class="fas fa-times"></i>' +
                    '</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                grid.append(card);
            });
        }

        // Initialize selected users container
        updateSelectedUsersContainer();

        // Initialize checkboxes based on selectedUserIds
        $('.citizen-checkbox').each(function() {
            var userId = $(this).data('user-id');
            if (selectedUserIds.includes(userId)) {
                $(this).prop('checked', true);
            }
        });

        $('.select2').select2({
            width: '100%',
            placeholder: 'Select a ward'
        });

        // Filter citizens by selected wards
        $('#ward_filter').on('change', function() {
            var selectedWardIds = $(this).val();
            $('.citizen-row').each(function() {
                var rowWardId = $(this).data('ward-id');
                var $checkbox = $(this).find('.citizen-checkbox');
                var isChecked = $checkbox.is(':checked');
                
                // Show row if no ward selected, or ward matches, or already checked
                if (!selectedWardIds || selectedWardIds.length === 0 || selectedWardIds.includes(String(rowWardId)) || isChecked) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // Select All Wards functionality
        $('#selectAllWardsBtn').on('click', function() {
            var $wardOptions = $('#ward_filter').find('option');
            var allWardIds = $wardOptions.map(function() { return $(this).val(); }).get();
            var allSelected = $wardOptions.length === $wardOptions.filter(':selected').length;
            
            if (allSelected) {
                $('#ward_filter').val([]);
            } else {
                $('#ward_filter').val(allWardIds);
            }
            
            $('#ward_filter').trigger('change');
        });

        // Individual checkbox change
        $(document).on('change', '.citizen-checkbox', function() {
            var userId = $(this).data('user-id');
            var isChecked = $(this).is(':checked');

            if (isChecked) {
                if (!selectedUserIds.includes(userId)) {
                    selectedUserIds.push(userId);
                }
            } else {
                selectedUserIds = selectedUserIds.filter(function(id) {
                    return id !== userId;
                });
            }

            updateSelectedUsersContainer();
        });

        // Click row to toggle checkbox
        $(document).on('click', '.citizen-row td:not(:first-child)', function() {
            var $checkbox = $(this).closest('.citizen-row').find('.citizen-checkbox');
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.trigger('change');
        });

        // Select All Citizens via button
        $('#selectAllBtn').on('click', function() {
            var $visibleCheckboxes = $('.citizen-row:visible').find('.citizen-checkbox');
            var allVisibleSelected = $visibleCheckboxes.length === $visibleCheckboxes.filter(':checked').length;
            
            if (allVisibleSelected) {
                $visibleCheckboxes.each(function() {
                    var userId = $(this).data('user-id');
                    $(this).prop('checked', false);
                    selectedUserIds = selectedUserIds.filter(function(id) {
                        return id !== userId;
                    });
                });
            } else {
                $visibleCheckboxes.each(function() {
                    var userId = $(this).data('user-id');
                    $(this).prop('checked', true);
                    if (!selectedUserIds.includes(userId)) {
                        selectedUserIds.push(userId);
                    }
                });
            }

            updateSelectedUsersContainer();
        });

        // Select All via header checkbox
        $('#selectAllCheckbox').on('change', function() {
            var isChecked = $(this).is(':checked');
            var $visibleCheckboxes = $('.citizen-row:visible').find('.citizen-checkbox');

            if (isChecked) {
                $visibleCheckboxes.each(function() {
                    var userId = $(this).data('user-id');
                    $(this).prop('checked', true);
                    if (!selectedUserIds.includes(userId)) {
                        selectedUserIds.push(userId);
                    }
                });
            } else {
                $visibleCheckboxes.each(function() {
                    var userId = $(this).data('user-id');
                    $(this).prop('checked', false);
                    selectedUserIds = selectedUserIds.filter(function(id) {
                        return id !== userId;
                    });
                });
            }

            updateSelectedUsersContainer();
        });

        // Remove user from selected
        $(document).on('click', '.remove-user-btn', function() {
            var userId = $(this).data('user-id');
            selectedUserIds = selectedUserIds.filter(function(id) {
                return id !== userId;
            });

            // Uncheck the checkbox if it's visible on current page
            var $checkbox = $('.citizen-checkbox[data-user-id="' + userId + '"]');
            if ($checkbox.length > 0) {
                $checkbox.prop('checked', false);
            }

            updateSelectedUsersContainer();
        });
    });
</script>
@endpush
