@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'NidCorrection'])
@push('style')
<style>
 
</style>
@endpush
@section('title', 'NID Correction Certificate')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>NID Correction Certificate</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('nid-correction.index')}}">NID Correction Certificate</a></li>
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
                                    <label for="user_id" class="col-sm-3 col-form-label text-right">আবেদনকারী নির্বাচন করুন</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control" name="user_id" id="user_id_select">
                                            <option value="">Select People (Search by Name, NID or Phone)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">উপজেলা/থানা নির্বাচন অফিসার</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="recipient_upazila_thana_name" class="form-control" placeholder="উপজেলা/থানা">
                                    </div>
                                    <label class="col-sm-1 col-form-label text-right">জেলা</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="recipient_district" class="form-control" placeholder="জেলা">
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
                                    <label class="col-sm-3 col-form-label text-right">ভোটার এলাকার নাম</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="current_voter_area_name" id="current_voter_area_name" class="form-control">
                                    </div>
                                    <label class="col-sm-2 col-form-label text-right">ভোটার এলাকার নম্বর</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="current_voter_area_no" id="current_voter_area_no" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">উপজেলা/থানা</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="current_upazila_thana" id="current_upazila_thana" class="form-control">
                                    </div>
                                    <label class="col-sm-2 col-form-label text-right">জেলা</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="current_district" id="current_district" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">গ্রাম/রাস্তা/বাসা/হোল্ডিং</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="current_village_road" id="current_village_road" class="form-control" placeholder="ঠিকানা">
                                    </div>
                                </div>

                                <div class="form-group row bg-light p-2 mb-4">
                                    <h5 class="col-12 mb-0 font-weight-bold">৩. যে এলাকায় স্থানান্তর হইতে ইচ্ছুক</h5>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">জেলা</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="transfer_district" class="form-control">
                                    </div>
                                    <label class="col-sm-2 col-form-label text-right">উপজেলা/থানা</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="transfer_upazila_thana" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">ধরন ও নাম</label>
                                    <div class="col-sm-4">
                                        <select name="transfer_entity_type" class="form-control">
                                            <option value="সিটি কর্পোরেশন">সিটি কর্পোরেশন</option>
                                            <option value="পৌরসভা">পৌরসভা</option>
                                            <option value="ইউনিয়ন">ইউনিয়ন</option>
                                            <option value="ক্যান্টনমেন্ট বোর্ড">ক্যান্টনমেন্ট বোর্ড</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text" name="transfer_entity_name" class="form-control" placeholder="নাম">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">ওয়ার্ড নং ও ভোটার এলাকা</label>
                                    <div class="col-sm-2">
                                        <input type="text" name="transfer_ward_no" class="form-control" placeholder="ওয়ার্ড">
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="text" name="transfer_voter_area_name" class="form-control" placeholder="ভোটার এলাকার নাম">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">গ্রাম/রাস্তা/বাসা/হোল্ডিং</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="transfer_village_road" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">ডাকঘর ও পোস্ট কোড</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="transfer_post_office" class="form-control">
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text" name="transfer_post_code" class="form-control" placeholder="পোস্ট কোড">
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
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <a href="{{route('nid-correction.index')}}" class="btn btn-default float-right">Cancel</a>
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
    <!-- /.content -->

@endsection
@push('script')

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
                $('#current_voter_area_name').val(data.voter_area);
                $('#current_upazila_thana').val(data.thana);
                $('#current_district').val(data.district);
                $('#current_village_road').val(data.address);
            });

            $("#certificateForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('nid-correction.store') }}",
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
