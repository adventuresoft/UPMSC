@extends('backend.master')

@section('title', 'ট্রেড লাইসেন্স আবেদন')

@section('content')
<div class="p-4">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-sm-6">
                <h4 class="font-bold text-gray-800">ট্রেড লাইসেন্স আবেদন</h4>
            </div>
        </div>

        <div class="card card-outline card-success shadow-sm rounded-xl overflow-hidden border-0">
            <div class="card-header bg-white py-3">
                <h3 class="card-title text-sm font-bold text-gray-700">ব্যবসায়িক তথ্য প্রদান করুন</h3>
            </div>
            
            <form id="tradeAppForm" method="POST" action="{{ route('organizationA.trade-license.store') }}">
                @csrf
                <div class="card-body bg-gray-50/30">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">প্রতিষ্ঠানের নাম</label>
                                <input type="text" class="form-control border-gray-200 rounded-lg text-sm" name="org_name" required placeholder="উদাঃ মেসার্স রহিম স্টোর">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">অর্থ বছর</label>
                                <select class="form-control border-gray-200 rounded-lg text-sm" name="tax_year_id" required>
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach ($tax_years as $year)
                                        <option value="{{$year->id}}">{{$year->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">মালিকের নাম</label>
                                <input type="text" class="form-control bg-gray-100 border-gray-200 rounded-lg text-sm" value="{{ Auth::guard('people')->user()->bn_name }}" readonly>
                                <input type="hidden" name="owner_id" value="{{ Auth::guard('people')->user()->system_id }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">মোবাইল নম্বর</label>
                                <input type="text" class="form-control bg-gray-100 border-gray-200 rounded-lg text-sm" value="{{ Auth::guard('people')->user()->mobile }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">ব্যবসার ধরন/বিবরণ</label>
                                <textarea class="form-control border-gray-200 rounded-lg text-sm" name="business_type" rows="3" required placeholder="আপনার ব্যবসার সংক্ষিপ্ত বিবরণ লিখুন..."></textarea>
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
        $("#tradeAppForm").on('submit', function(e) {
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
