@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'VoterArea'])
@push('style')
<style>
 
</style>
@endpush
@section('title', 'Voter Area Certificate')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Voter Area Certificate</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('voter-area.index')}}">Voter Area Certificate</a></li>
            <li class="breadcrumb-item active">Create</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">People Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="certificateForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row bg-light p-2 mb-4">
                                    <h5 class="col-12 mb-0 font-weight-bold">১. প্রাপক ও আবেদনকারীর তথ্য</h5>
                                </div>
                                <div class="form-group row">
                                    <label for="user_id" class="col-sm-3 col-form-label text-right">ID & Name</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control" name="user_id" id="user_id_select">
                                            <option value="">Select People (Search by Name, NID or Phone)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">জেলা</label>
                                    <div class="col-sm-4">
                                        <select id="recipient_district_id" class="form-control select2">
                                            <option value="">জেলা নির্বাচন করুন</option>
                                            @foreach($districts as $district)
                                                <option value="{{ $district->id }}" data-name="{{ $district->bn_name }}">{{ $district->bn_name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="recipient_district" id="recipient_district_name">
                                    </div>
                                    <label class="col-sm-2 col-form-label text-right">উপজেলা/থানা নির্বাচন অফিসার</label>
                                    <div class="col-sm-3">
                                        <select id="recipient_upazila_id" class="form-control select2">
                                            <option value="">উপজেলা/থানা নির্বাচন করুন</option>
                                        </select>
                                        <input type="hidden" name="recipient_upazila_thana_name" id="recipient_upazila_thana_name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">আবেদনকারীর নাম</label>
                                    <div class="col-sm-9">
                                        <input type="text" required name="applicant_name" id="applicant_name" class="form-control" placeholder="আবেদনকারীর নাম">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">জাতীয় পরিচয়পত্র নম্বর (NID)</label>
                                    <div class="col-sm-4">
                                        <input type="text" required name="applicant_nid" id="applicant_nid" class="form-control" placeholder="NID Number">
                                    </div>
                                    <label class="col-sm-1 col-form-label text-right">জন্ম তারিখ</label>
                                    <div class="col-sm-4">
                                        <input type="date" name="applicant_dob" id="applicant_dob" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row bg-light p-2 mb-4">
                                    <h5 class="col-12 mb-0 font-weight-bold">২. বর্তমান তালিকাভুক্তি সংক্রান্ত তথ্যাদি</h5>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">ভোটার নম্বর</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="current_voter_no" id="current_voter_no" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">জেলা</label>
                                    <div class="col-sm-4">
                                        <select id="current_district_id" class="form-control select2">
                                            <option value="">জেলা নির্বাচন করুন</option>
                                            @foreach($districts as $district)
                                                <option value="{{ $district->id }}" data-name="{{ $district->bn_name }}">{{ $district->bn_name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="current_district" id="current_district_name">
                                    </div>
                                    <label class="col-sm-2 col-form-label text-right">উপজেলা/থানা</label>
                                    <div class="col-sm-3">
                                        <select id="current_upazila_id" class="form-control select2">
                                            <option value="">উপজেলা/থানা নির্বাচন করুন</option>
                                        </select>
                                        <input type="hidden" name="current_upazila_thana" id="current_upazila_thana_name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">ভোটার এলাকার নাম</label>
                                    <div class="col-sm-4">
                                        <select id="current_union_id" class="form-control select2">
                                            <option value="">ইউনিয়ন নির্বাচন করুন</option>
                                        </select>
                                        <input type="hidden" name="current_voter_area_name" id="current_voter_area_name">
                                    </div>
                                    <label class="col-sm-2 col-form-label text-right">ওয়ার্ড নং</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="current_voter_area_no" id="current_voter_area_no" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                     <label class="col-sm-3 col-form-label text-right">গ্রাম/রাস্তা/বাসা/হোল্ডিং</label>
                                     <div class="col-sm-4">
                                         <input type="text" name="current_village_road" id="current_village_road" class="form-control" placeholder="গ্রাম/রাস্তা/বাসা">
                                     </div>
                                     <label class="col-sm-2 col-form-label text-right">হোল্ডিং নম্বর</label>
                                     <div class="col-sm-3">
                                         <input type="text" name="current_house_holding" id="current_house_holding" class="form-control" placeholder="হোল্ডিং">
                                     </div>
                                 </div>

                                <div class="form-group row bg-light p-2 mb-4">
                                    <h5 class="col-12 mb-0 font-weight-bold">৩. যে এলাকায় স্থানান্তর হইতে ইচ্ছুক</h5>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">জেলা</label>
                                    <div class="col-sm-4">
                                        <select id="transfer_district_id" class="form-control select2">
                                            <option value="">জেলা নির্বাচন করুন</option>
                                            @foreach($districts as $district)
                                                <option value="{{ $district->id }}" data-name="{{ $district->bn_name }}">{{ $district->bn_name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="transfer_district" id="transfer_district_name">
                                    </div>
                                    <label class="col-sm-2 col-form-label text-right">উপজেলা/থানা</label>
                                    <div class="col-sm-3">
                                        <select id="transfer_upazila_id" class="form-control select2">
                                            <option value="">উপজেলা/থানা নির্বাচন করুন</option>
                                        </select>
                                        <input type="hidden" name="transfer_upazila_thana" id="transfer_upazila_thana_name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">ইউনিয়ন</label>
                                    <div class="col-sm-9">
                                        <select id="transfer_union_id" class="form-control select2">
                                            <option value="">ইউনিয়ন নির্বাচন করুন</option>
                                        </select>
                                        <input type="hidden" name="transfer_entity_type" value="ইউনিয়ন">
                                        <input type="hidden" name="transfer_entity_name" id="transfer_entity_name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">ডাকঘর ও পোস্ট কোড</label>
                                    <div class="col-sm-4">
                                        <select id="transfer_post_office_id" class="form-control select2">
                                            <option value="">ডাকঘর নির্বাচন করুন</option>
                                        </select>
                                        <input type="hidden" name="transfer_post_office" id="transfer_post_office_name">
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text" name="transfer_post_code" id="transfer_post_code_input" class="form-control" placeholder="পোস্ট কোড">
                                    </div>
                                </div>
                                <div class="form-group row">
                                     <label class="col-sm-3 col-form-label text-right">গ্রাম/রাস্তা/বাসা/হোল্ডিং</label>
                                     <div class="col-sm-5">
                                         <input type="text" name="transfer_village_road" class="form-control" placeholder="গ্রাম/রাস্তা/বাসা">
                                     </div>
                                     <label class="col-sm-1 col-form-label text-right">হোল্ডিং</label>
                                     <div class="col-sm-3">
                                         <input type="text" name="transfer_house_holding" class="form-control" placeholder="হোল্ডিং নম্বর">
                                     </div>
                                 </div>
                                <div class="form-group row">
                                     <label class="col-sm-3 col-form-label text-right">ওয়ার্ড নং ও ভোটার এলাকা</label>
                                     <div class="col-sm-2">
                                         <input type="text" name="transfer_ward_no" class="form-control" placeholder="ওয়ার্ড">
                                     </div>
                                     <div class="col-sm-4">
                                         <input type="text" name="transfer_voter_area_name" class="form-control" placeholder="ভোটার এলাকার নাম">
                                     </div>
                                     <div class="col-sm-3">
                                         <input type="text" name="transfer_voter_area_no" class="form-control" placeholder="ভোটার এলাকা নম্বর">
                                     </div>
                                 </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">ফোন/মোবাইল</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="transfer_phone_mobile" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row bg-light p-2 mb-4">
                                    <h5 class="col-12 mb-0 font-weight-bold">৪. অতিরিক্ত তথ্য ও সনাক্তকারী</h5>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">অবস্থানের সময়</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="staying_since" class="form-control" placeholder="যে সময় হইতে অবস্থান করিতেছেন">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">স্থানান্তরের কারণ</label>
                                    <div class="col-sm-9">
                                        <textarea name="transfer_reason" class="form-control" rows="2"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">সনাক্তকারীর নাম ও NID</label>
                                    <div class="col-sm-5">
                                        <input type="text" name="identifier_name" class="form-control" placeholder="নাম">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" name="identifier_nid" class="form-control" placeholder="NID">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">সনাক্তকারীর ঠিকানা</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="identifier_address" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">উদ্দেশ্য (Purpose)</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="purpose" class="form-control" placeholder="কি কারণে প্রয়োজন">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <a href="{{route('voter-area.index')}}" class="btn btn-default float-right">Cancel</a>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2();

            // Transfer District Change
            $('#transfer_district_id').on('change', function() {
                var district_id = $(this).val();
                var district_name = $(this).find(':selected').data('name');
                
                $('#transfer_district_name').val(district_name);
                $('#transfer_upazila_id').empty().append('<option value="">উপজেলা/থানা নির্বাচন করুন</option>').trigger('change');
                $('#transfer_post_office_id').empty().append('<option value="">ডাকঘর নির্বাচন করুন</option>').trigger('change');
                $('#transfer_upazila_thana_name').val('');
                $('#transfer_post_office_name').val('');
                $('#transfer_post_code_input').val('');

                if (district_id) {
                    $.ajax({
                        url: "{{ url('/get-thanas-by-district') }}/" + district_id,
                        type: "GET",
                        dataType: "html",
                        success: function(data) {
                            $('#transfer_upazila_id').html(data).trigger('change');
                            // We need to fetch texts manually since options just have values
                            $('#transfer_upazila_id option').each(function() {
                                $(this).attr('data-name', $(this).text());
                            });
                        }
                    });
                }
            });

            // Transfer Upazila/Thana Change
            $('#transfer_upazila_id').on('change', function() {
                var upazila_id = $(this).val();
                var upazila_name = $(this).find(':selected').data('name');
                if(!upazila_name) upazila_name = $(this).find(':selected').text();
                
                $('#transfer_upazila_thana_name').val(upazila_name);
                $('#transfer_post_office_id').empty().append('<option value="">ডাকঘর নির্বাচন করুন</option>').trigger('change');
                $('#transfer_union_id').empty().append('<option value="">ইউনিয়ন নির্বাচন করুন</option>').trigger('change');
                $('#transfer_post_office_name').val('');
                $('#transfer_entity_name').val('');
                $('#transfer_post_code_input').val('');

                if (upazila_id) {
                    $.ajax({
                        url: "{{ url('/get-post-offices-by-thana') }}/" + upazila_id,
                        type: "GET",
                        dataType: "html",
                        success: function(data) {
                            $('#transfer_post_office_id').html(data).trigger('change');
                            $('#transfer_post_office_id option').each(function() {
                                $(this).attr('data-name', $(this).text());
                            });
                        }
                    });

                    $.ajax({
                        url: "{{ url('/get-unions-by-thana') }}/" + upazila_id,
                        type: "GET",
                        dataType: "html",
                        success: function(data) {
                            $('#transfer_union_id').html(data).trigger('change');
                            $('#transfer_union_id option').each(function() {
                                $(this).attr('data-name', $(this).text());
                            });
                        }
                    });
                }
            });

            // Transfer Post Office Change
            $('#transfer_post_office_id').on('change', function() {
                var post_office_name = $(this).find(':selected').data('name');
                if(!post_office_name) post_office_name = $(this).find(':selected').text();
                
                $('#transfer_post_office_name').val(post_office_name);
            });

            // Transfer Union Change
            $('#transfer_union_id').on('change', function() {
                var union_name = $(this).find(':selected').data('name');
                if(!union_name) union_name = $(this).find(':selected').text();
                
                $('#transfer_entity_name').val(union_name);
            });

            // Recipient District Change
            $('#recipient_district_id').on('change', function() {
                var district_id = $(this).val();
                var district_name = $(this).find(':selected').data('name');
                
                $('#recipient_district_name').val(district_name);
                $('#recipient_upazila_id').empty().append('<option value="">উপজেলা/থানা নির্বাচন করুন</option>').trigger('change');
                $('#recipient_upazila_thana_name').val('');

                if (district_id) {
                    $.ajax({
                        url: "{{ url('/get-thanas-by-district') }}/" + district_id,
                        type: "GET",
                        dataType: "html",
                        success: function(data) {
                            $('#recipient_upazila_id').html(data).trigger('change');
                            $('#recipient_upazila_id option').each(function() {
                                $(this).attr('data-name', $(this).text());
                            });
                        }
                    });
                }
            });

            // Recipient Upazila Change
            $('#recipient_upazila_id').on('change', function() {
                var upazila_name = $(this).find(':selected').data('name');
                if(!upazila_name) upazila_name = $(this).find(':selected').text();
                $('#recipient_upazila_thana_name').val(upazila_name);
            });

            // Current District Change
            $('#current_district_id').on('change', function() {
                var district_id = $(this).val();
                var district_name = $(this).find(':selected').data('name');
                
                $('#current_district_name').val(district_name);
                $('#current_upazila_id').empty().append('<option value="">উপজেলা/থানা নির্বাচন করুন</option>').trigger('change');
                $('#current_union_id').empty().append('<option value="">ইউনিয়ন নির্বাচন করুন</option>').trigger('change');
                $('#current_upazila_thana_name').val('');
                $('#current_voter_area_name').val('');

                if (district_id) {
                    $.ajax({
                        url: "{{ url('/get-thanas-by-district') }}/" + district_id,
                        type: "GET",
                        dataType: "html",
                        success: function(data) {
                            $('#current_upazila_id').html(data).trigger('change');
                            $('#current_upazila_id option').each(function() {
                                $(this).attr('data-name', $(this).text());
                            });
                        }
                    });
                }
            });

            // Current Upazila Change
            $('#current_upazila_id').on('change', function() {
                var upazila_id = $(this).val();
                var upazila_name = $(this).find(':selected').data('name');
                if(!upazila_name) upazila_name = $(this).find(':selected').text();
                
                $('#current_upazila_thana_name').val(upazila_name);
                $('#current_union_id').empty().append('<option value="">ইউনিয়ন নির্বাচন করুন</option>').trigger('change');
                $('#current_voter_area_name').val('');

                if (upazila_id) {
                    $.ajax({
                        url: "{{ url('/get-unions-by-thana') }}/" + upazila_id,
                        type: "GET",
                        dataType: "html",
                        success: function(data) {
                            $('#current_union_id').html(data).trigger('change');
                            $('#current_union_id option').each(function() {
                                $(this).attr('data-name', $(this).text());
                            });
                        }
                    });
                }
            });

            // Current Union Change
            $('#current_union_id').on('change', function() {
                var union_name = $(this).find(':selected').data('name');
                if(!union_name) union_name = $(this).find(':selected').text();
                
                $('#current_voter_area_name').val(union_name);
            });
        });
    </script>
    <script>
          $(document).ready(function() {
             
             $("#user_id_select").select2({
                ajax: {
                    url: "{{ route('people.search') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.results
                        };
                    },
                    cache: true
                },
                placeholder: 'Select People (Search by Name, NID or Phone)',
                minimumInputLength: 1,
                width: '100%'
            });

            $('#user_id_select').on('select2:select', function (e) {
                var data = e.params.data;
                
                $('#applicant_name').val(data.name);
                $('#applicant_nid').val(data.nid);
                if(data.dob) {
                    $('#applicant_dob').val(data.dob);
                }
                
                // Fill address fields
                $('#current_village_road').val(data.address);
                $('#current_voter_area_no').val(data.ward_no);

                // Auto-select Current District, Thana and Union
                if (data.district) {
                    let districtOpt = $('#current_district_id option').filter(function() {
                        return $(this).data('name') === data.district;
                    });
                    if (districtOpt.length > 0) {
                        let district_id = districtOpt.val();
                        $('#current_district_id').val(district_id).trigger('change.select2');
                        $('#current_district_name').val(data.district);

                        $.ajax({
                            url: "{{ url('/get-thanas-by-district') }}/" + district_id,
                            type: "GET",
                            dataType: "html",
                            success: function(responseHtml) {
                                $('#current_upazila_id').html(responseHtml);
                                $('#current_upazila_id option').each(function() {
                                    $(this).attr('data-name', $(this).text());
                                });
                                
                                if (data.thana) {
                                    let thanaOpt = $('#current_upazila_id option').filter(function() {
                                        return $(this).text() === data.thana;
                                    });
                                    if (thanaOpt.length > 0) {
                                        let thana_id = thanaOpt.val();
                                        $('#current_upazila_id').val(thana_id).trigger('change.select2');
                                        $('#current_upazila_thana_name').val(data.thana);

                                        // Fetch and select Union
                                        $.ajax({
                                            url: "{{ url('/get-unions-by-thana') }}/" + thana_id,
                                            type: "GET",
                                            dataType: "html",
                                            success: function(unionHtml) {
                                                $('#current_union_id').html(unionHtml);
                                                $('#current_union_id option').each(function() {
                                                    $(this).attr('data-name', $(this).text());
                                                });

                                                if (data.union) {
                                                    let unionOpt = $('#current_union_id option').filter(function() {
                                                        return $(this).text() === data.union;
                                                    });
                                                    if (unionOpt.length > 0) {
                                                        $('#current_union_id').val(unionOpt.val()).trigger('change.select2');
                                                        $('#current_voter_area_name').val(data.union);
                                                    }
                                                }
                                            }
                                        });
                                    }
                                }
                            }
                        });
                    }
                }
            });

            $("#certificateForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('voter-area.store') }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType:false,
                    cache:false,
                    processData:false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled",true);
                    },
                    success: function (response) {
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.href = response.redirect_url;
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "-error").text(val[0]);
                        });
                    }
                });
            })
        })

    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#image").change(function() {
            readURL(this);

        });
    </script>
@endpush
