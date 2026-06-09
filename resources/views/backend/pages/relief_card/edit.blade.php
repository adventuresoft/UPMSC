@extends('backend.master', ['mainMenu' => 'Relief Card', 'subMenu' => 'ReliefCardList'])

@section('title', 'Edit Relief Card')

@section('content')
<div class="p-4">
    <div class="container-fluid">
        <div class="row mb-3 align-items-center">
            <div class="col-sm-6">
                <h4 class="font-bold text-gray-800"><i class="fas fa-hand-holding-heart text-pink-600 mr-2"></i>Edit Relief Card</h4>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-sm-right text-xs bg-transparent p-0 m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-pink-700 font-semibold">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('relief-card.index') }}" class="text-pink-700 font-semibold">Relief Cards</a></li>
                    <li class="breadcrumb-item active text-gray-500">Edit</li>
                </ol>
            </div>
        </div>

        <div class="card card-outline card-pink shadow-lg rounded-xl overflow-hidden border-0 bg-white">
            <div class="card-header bg-gradient-to-r from-pink-600 to-pink-700 py-3.5 px-4 text-white">
                <h3 class="card-title text-base font-bold m-0"><i class="fas fa-file-invoice mr-2"></i>Relief Card Information</h3>
            </div>
            
            <form id="reliefCardForm" method="POST" action="{{ route('relief-card.update', $reliefCard->id) }}">
                @csrf
                @method('PUT')
                <div class="card-body bg-gray-50/20 p-4">
                    <!-- User Selection -->
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label class="text-xs font-bold text-gray-600 block mb-2">Select Citizen <span class="text-red-500">*</span></label>
                            <select class="form-control border-gray-200 rounded-lg text-sm h-11 focus:ring-pink-500 focus:border-pink-500 select2" name="user_id" id="user_select" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" 
                                        data-ward-id="{{ $user->addressInfo?->permanent_ward_id ?? '' }}"
                                        {{ $reliefCard->user_id == $user->id ? 'selected' : '' }}>
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
                                <option value="VGD (ভিজিডি)" {{ $reliefCard->relief_type == 'VGD (ভিজিডি)' ? 'selected' : '' }}>VGD (ভিজিডি কার্ড)</option>
                                <option value="VGF (ভিজিএফ)" {{ $reliefCard->relief_type == 'VGF (ভিজিএফ)' ? 'selected' : '' }}>VGF (ভিজিএফ কার্ড)</option>
                                <option value="OMS (ওএমএস)" {{ $reliefCard->relief_type == 'OMS (ওএমএস)' ? 'selected' : '' }}>OMS (ওএমএস রেশন কার্ড)</option>
                                <option value="Old Age Allowance (বয়স্ক ভাতা)" {{ $reliefCard->relief_type == 'Old Age Allowance (বয়স্ক ভাতা)' ? 'selected' : '' }}>Old Age Allowance (বয়স্ক ভাতা কার্ড)</option>
                                <option value="Disability Allowance (প্রতিবন্ধী ভাতা)" {{ $reliefCard->relief_type == 'Disability Allowance (প্রতিবন্ধী ভাতা)' ? 'selected' : '' }}>Disability Allowance (প্রতিবন্ধী ভাতা কার্ড)</option>
                                <option value="Medicine (ওষুধ)" {{ $reliefCard->relief_type == 'Medicine (ওষুধ)' ? 'selected' : '' }}>Medicine (ওষুধ)</option>
                                <option value="Food (খাদ্য)" {{ $reliefCard->relief_type == 'Food (খাদ্য)' ? 'selected' : '' }}>Food (খাদ্য)</option>
                                <option value="Cloths (কাপড়)" {{ $reliefCard->relief_type == 'Cloths (কাপড়)' ? 'selected' : '' }}>Cloths (কাপড়)</option>
                                <option value="Materials (উপকরণ)" {{ $reliefCard->relief_type == 'Materials (উপকরণ)' ? 'selected' : '' }}>Materials (উপকরণ)</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-4">
                            <label class="text-xs font-bold text-gray-600 block mb-2">Monthly Income (Taka) <span class="text-red-500">*</span></label>
                            <input type="number" class="form-control border-gray-200 rounded-lg text-sm h-11 focus:ring-pink-500" name="monthly_income" required min="0" placeholder="e.g., 5000" value="{{ $reliefCard->monthly_income }}">
                        </div>
                        <div class="col-md-3 mb-4">
                            <label class="text-xs font-bold text-gray-600 block mb-2">Family Members <span class="text-red-500">*</span></label>
                            <input type="number" class="form-control border-gray-200 rounded-lg text-sm h-11 focus:ring-pink-500" name="family_members" required min="1" value="{{ $reliefCard->family_members }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="text-xs font-bold text-gray-600 block mb-2">Status <span class="text-red-500">*</span></label>
                            <select class="form-control border-gray-200 rounded-lg text-sm h-11 focus:ring-pink-500 focus:border-pink-500" name="status" required>
                                <option value="0" {{ $reliefCard->status == 0 ? 'selected' : '' }}>Pending</option>
                                <option value="1" {{ $reliefCard->status == 1 ? 'selected' : '' }}>Approved</option>
                                <option value="2" {{ $reliefCard->status == 2 ? 'selected' : '' }}>Rejected</option>
                                <option value="3" {{ $reliefCard->status == 3 ? 'selected' : '' }}>Received</option>
                                <option value="4" {{ $reliefCard->status == 4 ? 'selected' : '' }}>Dispatched</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="text-xs font-bold text-gray-600 block mb-2">Reason / Requirement Description</label>
                            <textarea class="form-control border-gray-200 rounded-lg text-sm p-3 focus:ring-pink-500 focus:border-pink-500" name="reason" rows="4" placeholder="Briefly describe the financial situation or why this card is needed...">{{ $reliefCard->reason }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white py-4 px-4 text-right border-top d-flex justify-content-end gap-3">
                    <a href="{{ route('relief-card.index') }}" class="btn btn-light px-5 py-2.5 rounded-xl font-bold text-sm border hover:bg-gray-50 mr-2">Cancel</a>
                    <button type="submit" class="btn btn-pink px-5 py-2.5 rounded-xl font-bold text-sm shadow-md hover:shadow-lg transition bg-gradient-to-r from-pink-600 to-pink-700 hover:from-pink-700 hover:to-pink-800">
                        <i class="fas fa-check-circle mr-2"></i> Update Relief Card
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
        $('.select2').select2({
            width: '100%',
            placeholder: 'Select a citizen'
        });
    });
</script>
@endpush
