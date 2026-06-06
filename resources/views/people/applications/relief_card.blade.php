@extends('backend.master')

@section('title', 'রিলিফ কার্ড আবেদন')

@section('content')
<div class="p-4">
    <div class="container-fluid">
        <div class="row mb-3 align-items-center">
            <div class="col-sm-6">
                <h4 class="font-bold text-gray-800"><i class="fas fa-hand-holding-heart text-red-500 mr-2"></i>রিলিফ কার্ড আবেদন</h4>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-sm-right text-xs bg-transparent p-0 m-0">
                    <li class="breadcrumb-item"><a href="{{ route('people.dashboard') }}" class="text-green-700 font-semibold">ড্যাশবোর্ড</a></li>
                    <li class="breadcrumb-item active text-gray-500">রিলিফ কার্ড</li>
                </ol>
            </div>
        </div>

        <div class="card card-outline card-success shadow-lg rounded-2xl overflow-hidden border-0 bg-white">
            <div class="card-header bg-gradient-to-r from-[#046307] to-[#128a17] py-3.5 px-4 text-white">
                <h3 class="card-title text-base font-bold m-0"><i class="fas fa-file-invoice mr-2"></i>আবেদনকারীর তথ্য ও বিবরণী</h3>
            </div>
            
            <form id="reliefCardForm" method="POST" action="{{ route('people.applications.relief-card.store') }}">
                @csrf
                <div class="card-body bg-gray-50/20 p-4">
                    
                    <!-- Profile Info (Read-only) -->
                    <div class="bg-green-50/40 border border-green-100 rounded-xl p-4 mb-4">
                        <h6 class="text-green-800 font-bold mb-3"><i class="fas fa-user-circle mr-2"></i>প্রোফাইল থেকে সংগৃহীত তথ্য:</h6>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 mb-3">
                                <label class="text-[11px] font-bold text-gray-500 uppercase block mb-1">নাগরিক আইডি</label>
                                <input type="text" class="form-control bg-gray-100/70 border-gray-200 rounded-lg text-sm font-semibold" value="{{ $people->approved_id ?? 'নাগরিক আইডি নেই' }}" readonly>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <label class="text-[11px] font-bold text-gray-500 uppercase block mb-1">আবেদনকারীর নাম</label>
                                <input type="text" class="form-control bg-gray-100/70 border-gray-200 rounded-lg text-sm font-semibold" value="{{ $people->bn_name ?? $people->name }}" readonly>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <label class="text-[11px] font-bold text-gray-500 uppercase block mb-1">জাতীয় পরিচয়পত্র (NID)</label>
                                <input type="text" class="form-control bg-gray-100/70 border-gray-200 rounded-lg text-sm font-semibold" value="{{ $people->nid ?? 'N/A' }}" readonly>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <label class="text-[11px] font-bold text-gray-500 uppercase block mb-1">মোবাইল নম্বর</label>
                                <input type="text" class="form-control bg-gray-100/70 border-gray-200 rounded-lg text-sm font-semibold" value="{{ $people->mobile ?? 'N/A' }}" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Input Fields -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="text-xs font-bold text-gray-600 block mb-2">রিলিফ / সামাজিক নিরাপত্তা কার্ডের ধরন <span class="text-red-500">*</span></label>
                            <select class="form-control border-gray-200 rounded-lg text-sm h-11 focus:ring-green-500 focus:border-green-500" name="relief_type" required>
                                <option value="">কার্ডের ধরন নির্বাচন করুন</option>
                                <option value="VGD (ভিজিডি)">VGD (ভিজিডি কার্ড)</option>
                                <option value="VGF (ভিজিএফ)">VGF (ভিজিএফ কার্ড)</option>
                                <option value="OMS (ওএমএস)">OMS (ওএমএস রেশন কার্ড)</option>
                                <option value="Old Age Allowance (বয়স্ক ভাতা)">Old Age Allowance (বয়স্ক ভাতা কার্ড)</option>
                                <option value="Disability Allowance (প্রতিবন্ধী ভাতা)">Disability Allowance (প্রতিবন্ধী ভাতা কার্ড)</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-4">
                            <label class="text-xs font-bold text-gray-600 block mb-2">মাসিক আয় (টাকা) <span class="text-red-500">*</span></label>
                            <input type="number" class="form-control border-gray-200 rounded-lg text-sm h-11 focus:ring-green-500" name="monthly_income" required min="0" placeholder="উদাঃ ৫০০০">
                        </div>
                        <div class="col-md-3 mb-4">
                            <label class="text-xs font-bold text-gray-600 block mb-2">পরিবারের সদস্য সংখ্যা <span class="text-red-500">*</span></label>
                            <input type="number" class="form-control border-gray-200 rounded-lg text-sm h-11 focus:ring-green-500" name="family_members" required min="1" value="1">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label class="text-xs font-bold text-gray-600 block mb-2">আবেদনের কারণ / প্রয়োজনীয়তা বিবরণ</label>
                            <textarea class="form-control border-gray-200 rounded-lg text-sm p-3 focus:ring-green-500 focus:border-green-500" name="reason" rows="4" placeholder="আপনার আর্থিক অবস্থা বা কেন আপনার এই কার্ড প্রয়োজন তা সংক্ষেপে লিখুন..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white py-4 px-4 text-right border-top d-flex justify-content-end gap-3">
                    <a href="{{ route('people.dashboard') }}" class="btn btn-light px-5 py-2.5 rounded-xl font-bold text-sm border hover:bg-gray-50 mr-2">বাতিল</a>
                    <button type="submit" class="btn btn-success px-5 py-2.5 rounded-xl font-bold text-sm shadow-md hover:shadow-lg transition bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800">
                        <i class="fas fa-check-circle mr-2"></i> আবেদন জমা দিন
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
        $("#reliefCardForm").on('submit', function(e) {
            e.preventDefault();
            let thisForm = $(this);
            let submitBtn = thisForm.find('button[type="submit"]');
            
            $.ajax({
                type: "POST",
                url: thisForm.attr('action'),
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    submitBtn.prop("disabled", true).html('<i class="fas fa-spinner fa-spin mr-2"></i>প্রক্রিয়াধীন...');
                },
                success: function (response) {
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.href = response.redirect_url;
                    }, 2000)
                },
                error: function(xhr) {
                    submitBtn.prop("disabled", false).html('<i class="fas fa-check-circle mr-2"></i>আবেদন জমা দিন');
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message || "ত্রুটি হয়েছে");
                    if(responseText.errors) {
                        $.each(responseText.errors, function(key, val) {
                            toastr.error(val[0]);
                        });
                    }
                }
            });
        });
    });
</script>
@endpush
