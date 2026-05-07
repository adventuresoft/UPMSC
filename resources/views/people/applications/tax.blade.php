@extends('backend.master')

@section('title', 'হোল্ডিং ট্যাক্স আবেদন')

@section('content')
<div class="p-4">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-sm-6">
                <h4 class="font-bold text-gray-800">হোল্ডিং ট্যাক্স আবেদন</h4>
            </div>
        </div>

        <div class="card card-outline card-success shadow-sm rounded-xl overflow-hidden border-0">
            <div class="card-header bg-white py-3">
                <h3 class="card-title text-sm font-bold text-gray-700">কর নির্ধারণের তথ্য</h3>
            </div>
            
            <form id="taxGenerateForm" method="POST" action="{{ route('tax.store') }}">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::guard('people')->user()->user_id }}">
                <input type="hidden" name="user_system_id" value="{{ Auth::guard('people')->user()->system_id }}">
                
                <div class="card-body bg-gray-50/30">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">নাম (আবেদনকারী)</label>
                                <input type="text" class="form-control bg-white border-gray-200 rounded-lg text-sm" value="{{ Auth::guard('people')->user()->bn_name }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">সিস্টেম আইডি</label>
                                <input type="text" class="form-control bg-white border-gray-200 rounded-lg text-sm" value="{{ Auth::guard('people')->user()->system_id }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
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
                        <div class="col-md-4">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">ওয়ার্ড নং</label>
                                <select class="form-control border-gray-200 rounded-lg text-sm" name="ward_id" required>
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach ($union_wards as $union_ward)
                                        <option value="{{$union_ward->id}}">{{$union_ward->bn_ward_no}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">গ্রাম</label>
                                <select class="form-control border-gray-200 rounded-lg text-sm" name="village_id" id="village_id" required>
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach ($villages as $village)
                                        <option value="{{$village->id}}">{{$village->bn_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive mt-4">
                        <table class="table table-bordered bg-white rounded-lg overflow-hidden shadow-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="text-xs font-bold text-gray-600 py-3">করের বিষয়</th>
                                    <th class="text-xs font-bold text-gray-600 py-3" style="width: 200px">পরিমাণ (টাকা)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-sm text-gray-700 py-3">বসতবাড়ির বাৎসরিক মূল্যের উপর কর</td>
                                    <td><input type="number" class="form-control border-gray-200 rounded-lg text-sm text-right" name="residence_tax" min="0"></td>
                                </tr>
                                <tr>
                                    <td class="text-sm text-gray-700 py-3">ব্যবসা/পেশা/জীবিকার উপর কর</td>
                                    <td><input type="number" class="form-control border-gray-200 rounded-lg text-sm text-right" name="income_tax" min="0"></td>
                                </tr>
                                <tr>
                                    <td class="text-sm text-gray-700 py-3">ভূমি/ইমারত ভাড়ার উপর কর</td>
                                    <td><input type="number" class="form-control border-gray-200 rounded-lg text-sm text-right" name="land_tax" min="0"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer bg-white py-4">
                    <button type="submit" class="btn btn-success px-5 py-2.5 rounded-lg font-bold text-sm shadow-sm hover:shadow-md transition">
                        <i class="fas fa-paper-plane mr-2"></i> আবেদন জমা দিন
                    </button>
                    <a href="{{ route('people.dashboard') }}" class="btn btn-light px-5 py-2.5 rounded-lg font-bold text-sm ml-2 border">বাতিল</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $("#taxGenerateForm").on('submit', function(e) {
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
