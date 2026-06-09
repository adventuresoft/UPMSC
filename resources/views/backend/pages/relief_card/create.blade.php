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
                    <!-- User Selection -->
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
                        <div class="col-md-{{ count($wards) > 0 ? '8' : '12' }} mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="text-xs font-bold text-gray-600 m-0">Select Citizens <span class="text-red-500">*</span></label>
                                <button type="button" id="selectAllBtn" class="btn btn-sm btn-primary">Select All</button>
                            </div>
                            <select class="form-control border-gray-200 rounded-lg text-sm h-11 focus:ring-pink-500 focus:border-pink-500 select2" name="user_ids[]" id="user_select" required multiple>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" 
                                        data-ward-id="{{ $user->addressInfo?->permanent_ward_id ?? '' }}"
                                        {{ (is_array(old('user_ids')) && in_array($user->id, old('user_ids'))) ? 'selected' : '' }}>
                                        {{ $user->name }} 
                                        @if($user->people && $user->people->approved_id)
                                            (ID: {{ $user->people->approved_id }})
                                        @endif
                                        @if($user->addressInfo?->permanentWard)
                                            - Ward {{ $user->addressInfo->permanentWard->en_ward_no ?? $user->addressInfo->permanentWard->bn_ward_no ?? $user->addressInfo->permanentWard->id }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Input Fields -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
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
                        <div class="col-md-3 mb-4">
                            <label class="text-xs font-bold text-gray-600 block mb-2">Monthly Income (Taka) <span class="text-red-500">*</span></label>
                            <input type="number" class="form-control border-gray-200 rounded-lg text-sm h-11 focus:ring-pink-500" name="monthly_income" required min="0" placeholder="e.g., 5000" value="{{ old('monthly_income') }}">
                        </div>
                        <div class="col-md-3 mb-4">
                            <label class="text-xs font-bold text-gray-600 block mb-2">Family Members <span class="text-red-500">*</span></label>
                            <input type="number" class="form-control border-gray-200 rounded-lg text-sm h-11 focus:ring-pink-500" name="family_members" required min="1" value="{{ old('family_members', 1) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label class="text-xs font-bold text-gray-600 block mb-2">Reason / Requirement Description</label>
                            <textarea class="form-control border-gray-200 rounded-lg text-sm p-3 focus:ring-pink-500 focus:border-pink-500" name="reason" rows="4" placeholder="Briefly describe the financial situation or why this card is needed...">{{ old('reason') }}</textarea>
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
</style>
<link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;700&display=swap" rel="stylesheet">
@endpush

@push('script')
<script>
    $(document).ready(function() {
        // Store original user options
        var originalUserOptions = $('#user_select').html();
        // Store selected user IDs
        var selectedUserIds = [];
        
        $('.select2').select2({
            width: '100%',
            placeholder: 'Select a citizen'
        });

        // Initialize selectedUserIds with any pre-selected values
        selectedUserIds = $('#user_select').val() || [];

        // Function to update user select dropdown
        function updateUserSelect() {
            var selectedWardIds = $('#ward_filter').val();
            
            // Get all original options
            var $originalOptions = $(originalUserOptions);
            
            // Filter options based on selected wards
            var filteredOptions = $originalOptions.filter(function() {
                var optionValue = $(this).val();
                if (optionValue === '') {
                    return true;
                }
                
                var optionWardId = $(this).data('ward-id');
                
                // If user is already selected, always include them
                if (selectedUserIds.includes(optionValue)) {
                    return true;
                }
                
                // Otherwise, filter by ward
                if (!selectedWardIds || selectedWardIds.length === 0) {
                    return true;
                }
                
                return selectedWardIds.includes(String(optionWardId));
            });
            
            // Update the dropdown
            $('#user_select').html(filteredOptions);
            
            // Re-apply selected state
            $('#user_select').val(selectedUserIds);
            
            // Re-initialize select2
            $('#user_select').select2('destroy').select2({
                width: '100%',
                placeholder: 'Select a citizen'
            });
        }

        // Filter users by selected wards
        $('#ward_filter').on('change', function() {
            updateUserSelect();
        });

        // Track selected users
        $('#user_select').on('change', function() {
            selectedUserIds = $(this).val() || [];
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

        // Select All functionality
        $('#selectAllBtn').on('click', function() {
            var $options = $('#user_select').find('option:not([value=""])');
            
            // Check if all are already selected
            var allSelected = $options.length === $options.filter(':selected').length;
            
            if (allSelected) {
                // Deselect all visible options
                var visibleSelectedIds = $options.filter(':selected').map(function() { return $(this).val(); }).get();
                selectedUserIds = selectedUserIds.filter(id => !visibleSelectedIds.includes(id));
                $options.prop('selected', false);
            } else {
                // Select all visible options
                var visibleIds = $options.map(function() { return $(this).val(); }).get();
                selectedUserIds = [...new Set([...selectedUserIds, ...visibleIds])];
                $options.prop('selected', true);
            }
            
            $('#user_select').val(selectedUserIds);
            $('#user_select').trigger('change');
        });
    });
</script>
@endpush
