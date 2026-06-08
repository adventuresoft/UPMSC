@extends('backend.master')

@section('title', 'নাগরিক নিবন্ধন - ঠিকানা')

@section('content')
<div class="p-4">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-sm-6">
                <h4 class="font-bold text-gray-800">নাগরিক তথ্য নিবন্ধন</h4>
            </div>
        </div>

        <div class="card card-outline card-success shadow-sm rounded-xl overflow-hidden border-0">
            <div class="card-header bg-white py-3">
                @include('people.registration.tab_header', ['user' => $user, 'active_tab' => 'address'])
            </div>
            
            <form id="citizenAddressForm" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                
                <div class="card-body bg-gray-50/30">
                    <h6 class="font-bold text-gray-700 mb-4 border-b pb-2">বর্তমান ঠিকানা</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">বিভাগ</label>
                                <select name="present_division_id" class="form-control border-gray-200 rounded-lg text-sm select2-division" data-target="present_district_id">
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{$division->id}}" {{$user->addressInfo ? ($user->addressInfo->present_division_id == $division->id ? 'selected' : '') : ''}}>{{$division->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">জেলা</label>
                                <select name="present_district_id" id="present_district_id" class="form-control border-gray-200 rounded-lg text-sm select2-district" data-target="present_thana_id">
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach ($districts as $district)
                                        <option value="{{$district->id}}" {{$user->addressInfo ? ($user->addressInfo->present_district_id == $district->id ? 'selected' : '') : ''}}>{{$district->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">উপজেলা</label>
                                <select name="present_thana_id" id="present_thana_id" class="form-control border-gray-200 rounded-lg text-sm">
                                    <option value="">নির্বাচন করুন</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white py-4 flex justify-between">
                    <a href="{{route('people.applications.registration.family', $user->id)}}" class="btn btn-light px-5 py-2.5 rounded-lg font-bold text-sm border">
                        <i class="fas fa-arrow-left mr-2"></i> পূর্ববর্তী
                    </a>
                    <button type="submit" class="btn btn-success px-6 py-2.5 rounded-lg font-bold text-sm shadow-sm hover:shadow-md transition">
                        সংরক্ষণ ও পরবর্তী <i class="fas fa-arrow-right ml-2"></i>
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
        // Initialize select2
        $('.select2-division').select2();
        $('.select2-district').select2();

        // Division → District
        $(document).on('change', '.select2-division', function(e){
            e.preventDefault();
            let division_id = $(this).val();
            let targetDistrictId = $(this).data('target');
            let $district = $('#' + targetDistrictId);
            let $thana = $('#' + targetDistrictId.replace('district', 'thana'));

            if ($thana) {
                $thana.html('<option value="">নির্বাচন করুন</option>');
            }

            if (division_id) {
                $district.prop('disabled', true).html('<option value="">লোড হচ্ছে...</option>');
                $.ajax({
                    type: 'GET',
                    url: '{{ url("/get-districts-by-division") }}/' + division_id,
                    success: function(response) {
                        $district.html(response).prop('disabled', false);
                    },
                    error: function() {
                        $district.html('<option value="">নির্বাচন করুন</option>').prop('disabled', false);
                    }
                });
            } else {
                $district.html('<option value="">নির্বাচন করুন</option>').prop('disabled', true);
            }
        });

        // District → Thana
        $(document).on('change', '.select2-district', function(e){
            e.preventDefault();
            let district_id = $(this).val();
            let targetThanaId = $(this).data('target');
            let $thana = $('#' + targetThanaId);

            if (district_id) {
                $thana.prop('disabled', true).html('<option value="">লোড হচ্ছে...</option>');
                $.ajax({
                    type: 'GET',
                    url: '{{ url("/get-thanas-by-district") }}/' + district_id,
                    success: function(response) {
                        $thana.html(response).prop('disabled', false);
                    },
                    error: function() {
                        $thana.html('<option value="">নির্বাচন করুন</option>').prop('disabled', false);
                    }
                });
            } else {
                $thana.html('<option value="">নির্বাচন করুন</option>').prop('disabled', true);
            }
        });

        $("#citizenAddressForm").on('submit', function(e) {
            e.preventDefault();
            let thisForm = $(this);
            $.ajax({
                type: "POST",
                url: "{{ route('people.applications.registration.address.store') }}",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.href = response.redirect_url;
                    }, 2000)
                },
                error: function(xhr) {
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message || "ত্রুটি হয়েছে");
                }
            });
        });
    });
</script>
@endpush
