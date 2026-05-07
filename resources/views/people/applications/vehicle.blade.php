@extends('backend.master')

@section('title', 'যানবাহন নিবন্ধন আবেদন')

@section('content')
<div class="p-4">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-sm-6">
                <h4 class="font-bold text-gray-800">যানবাহন নিবন্ধন আবেদন</h4>
            </div>
        </div>

        <div class="card card-outline card-success shadow-sm rounded-xl overflow-hidden border-0">
            <div class="card-header bg-white py-3">
                <h3 class="card-title text-sm font-bold text-gray-700">যানবাহনের তথ্য প্রদান করুন</h3>
            </div>
            
            <form id="vehicleAppForm" method="POST" action="{{ route('vehicle.store') }}">
                @csrf
                <div class="card-body bg-gray-50/30">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">যানবাহনের ধরন</label>
                                <select class="form-control border-gray-200 rounded-lg text-sm" name="vehicle_type" required>
                                    <option value="">নির্বাচন করুন</option>
                                    <option value="Auto">Auto (অটো)</option>
                                    <option value="Manual">Manual (ম্যানুয়াল)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">যানবাহনের শ্রেণী</label>
                                <select class="form-control border-gray-200 rounded-lg text-sm" name="vehicle_category" required>
                                    <option value="">নির্বাচন করুন</option>
                                    <option value="Rickshaw - রিকশা">Rickshaw - রিকশা</option>
                                    <option value="Van - ভ্যান / ভ্যানগাড়ি">Van - ভ্যান / ভ্যানগাড়ি</option>
                                    <option value="Thela Gari - ঠেলাগাড়ি">Thela Gari - ঠেলাগাড়ি</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">মডেল</label>
                                <input type="text" class="form-control border-gray-200 rounded-lg text-sm" name="vehicle_model" required placeholder="উদাঃ ২০২৪ মডেল">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">তৈরির বছর</label>
                                <input type="number" class="form-control border-gray-200 rounded-lg text-sm" name="make_year" required value="{{ date('Y') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">মালিকানার ধরন</label>
                                <select class="form-control border-gray-200 rounded-lg text-sm" name="ownership_type" required readonly>
                                    <option value="personal" selected>Personal (ব্যক্তিগত)</option>
                                </select>
                                <input type="hidden" name="owner_id" value="{{ Auth::guard('people')->user()->system_id }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">মালিকের নাম</label>
                                <input type="text" class="form-control bg-gray-100 border-gray-200 rounded-lg text-sm" value="{{ Auth::guard('people')->user()->bn_name }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white py-4 text-right">
                    <a href="{{ route('people.dashboard') }}" class="btn btn-light px-5 py-2.5 rounded-lg font-bold text-sm mr-2 border">বাতিল</a>
                    <button type="submit" class="btn btn-success px-5 py-2.5 rounded-lg font-bold text-sm shadow-sm hover:shadow-md transition">
                        <i class="fas fa-save mr-2"></i> আবেদন জমা দিন
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $("#vehicleAppForm").on('submit', function(e) {
            e.preventDefault();
            let thisForm = $(this);
            $.ajax({
                type: "POST",
                url: thisForm.attr('action'),
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.href = "{{ route('people.dashboard') }}";
                    }, 2000)
                },
                error: function(xhr) {
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message || "ত্রুটি হয়েছে");
                }
            });
        });
    });
</script>
@endpush
