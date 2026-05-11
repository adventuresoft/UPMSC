@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'NidCorrection'])

@push('style')
<style>
    .form-section-title {
        background: #f8f9fa;
        padding: 10px;
        margin-bottom: 20px;
        border-left: 4px solid #17a2b8;
        font-weight: bold;
    }
    .nid-boxes {
        display: flex;
        gap: 5px;
        margin-top: 5px;
    }
    .nid-box {
        width: 30px;
        height: 35px;
        border: 1px solid #ccc;
        text-align: center;
        font-weight: bold;
    }
    .table-correction th {
        background: #e9ecef;
        font-size: 13px;
        text-align: center;
    }
    .table-correction td {
        padding: 5px;
    }
</style>
@endpush

@section('title', 'NID Correction Application (Form-2)')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>NID Correction Application (Form-2)</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('nid-correction.index')}}">NID Correction</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">জাতীয় পরিচয়পত্র বা তথ্য-উপাত্ত সংশোধনের আবেদন (ফরম-২)</h3>
                    </div>
                    <form class="form-horizontal" id="certificateForm" method="POST">
                        @csrf
                        <div class="card-body">
                            
                            <div class="form-section-title">১. জাতীয় পরিচয়পত্রধারীর তথ্য</div>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">আবেদনকারী খুঁজুন</label>
                                <div class="col-sm-10">
                                    <select required class="form-control" name="user_id" id="user_id_select">
                                        <option value="">Search by Name, NID or Phone</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">(ক) নাম</label>
                                <div class="col-sm-4">
                                    <input type="text" name="applicant_name" id="applicant_name" class="form-control" placeholder="নাম (বাংলা)">
                                </div>
                                <label class="col-sm-2 col-form-label text-right">Name (English)</label>
                                <div class="col-sm-4">
                                    <input type="text" name="applicant_name_en" id="applicant_name_en" class="form-control" placeholder="Name (English)">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">(খ) এনআইডি নম্বর</label>
                                <div class="col-sm-10">
                                    <input type="text" name="applicant_nid" id="applicant_nid" class="form-control" placeholder="NID Number" maxlength="17">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">পিতার নাম</label>
                                <div class="col-sm-4">
                                    <input type="text" name="applicant_father_name" id="applicant_father_name" class="form-control" placeholder="পিতার নাম">
                                </div>
                                <label class="col-sm-2 col-form-label text-right">মাতার নাম</label>
                                <div class="col-sm-4">
                                    <input type="text" name="applicant_mother_name" id="applicant_mother_name" class="form-control" placeholder="মাতার নাম">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">স্বামীর নাম</label>
                                <div class="col-sm-4">
                                    <input type="text" name="applicant_husband_name" id="applicant_husband_name" class="form-control" placeholder="স্বামীর নাম (প্রযোজ্য ক্ষেত্রে)">
                                </div>
                                <label class="col-sm-2 col-form-label text-right">জন্ম তারিখ</label>
                                <div class="col-sm-4">
                                    <input type="date" name="applicant_dob" id="applicant_dob" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">রক্তের গ্রুপ</label>
                                <div class="col-sm-4">
                                    <select name="applicant_blood_group" class="form-control">
                                        <option value="">নির্বাচন করুন</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                    </select>
                                </div>
                                <label class="col-sm-2 col-form-label text-right">মোবাইল নম্বর</label>
                                <div class="col-sm-4">
                                    <input type="text" name="applicant_mobile" id="applicant_mobile" class="form-control" placeholder="Mobile">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">ঠিকানা</label>
                                <div class="col-sm-10">
                                    <textarea name="applicant_address" id="applicant_address" class="form-control" rows="2" placeholder="পূর্ণ ঠিকানা"></textarea>
                                </div>
                            </div>

                            <div class="form-section-title">২. সংশোধন সংক্রান্ত তথ্যাদি</div>

                            <table class="table table-bordered table-correction">
                                <thead>
                                    <tr>
                                        <th style="width: 20%;">বিষয়</th>
                                        <th style="width: 35%;">বর্তমানে বিদ্যমান তথ্য</th>
                                        <th style="width: 35%;">চাহিত সংশোধিত তথ্য</th>
                                        <th style="width: 10%;">সংশোধন?</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $fields = [
                                            'name_bn' => 'নাম (বাংলা)',
                                            'name_en' => 'নাম (ইংরেজি)',
                                            'father_name' => 'পিতার নাম',
                                            'mother_name' => 'মাতার নাম',
                                            'husband_name' => 'স্বামীর নাম',
                                            'dob' => 'জন্মতারিখ',
                                            'address' => 'ঠিকানা',
                                            'blood_group' => 'রক্তের গ্রুপ',
                                            'others' => 'অন্যান্য'
                                        ];
                                    @endphp
                                    @foreach($fields as $key => $label)
                                    <tr>
                                        <td><strong>{{ $label }}</strong></td>
                                        <td><input type="text" name="correction_data[{{ $key }}][old]" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="correction_data[{{ $key }}][new]" class="form-control form-control-sm"></td>
                                        <td class="text-center">
                                            <input type="checkbox" name="correction_data[{{ $key }}][active]" value="1">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="form-section-title">৪. ফী ও দলিলাদি</div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">জমার পরিমাণ (টাকা)</label>
                                <div class="col-sm-4">
                                    <input type="number" name="payment_amount" class="form-control" placeholder="টাকা">
                                </div>
                                <label class="col-sm-2 col-form-label text-right">জমার রসিদ নং</label>
                                <div class="col-sm-4">
                                    <input type="text" name="payment_receipt_no" class="form-control" placeholder="রসিদ নম্বর">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">সংযুক্ত দলিলাদি</label>
                                <div class="col-sm-10">
                                    <textarea name="attachments_list" class="form-control" rows="2" placeholder="সংযুক্ত দলিলাদির বিবরণ লিখুন"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <a href="{{route('nid-correction.index')}}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-info float-right">Generate Form-2 Application</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
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
                    return { q: params.term };
                },
                processResults: function (data) {
                    return { results: data.results };
                },
                cache: true
            },
            placeholder: 'Search People...',
            minimumInputLength: 1,
            width: '100%'
        });

        $('#user_id_select').on('select2:select', function (e) {
            var data = e.params.data;
            if(data.name)    $('#applicant_name').val(data.name);
            if(data.nid)     $('#applicant_nid').val(data.nid);
            if(data.mobile)  $('#applicant_mobile').val(data.mobile);
            if(data.dob)     $('#applicant_dob').val(data.dob);
            if(data.address) $('#applicant_address').val(data.address);
            
            // Auto fill "Existing Info" correction table
            if(data.name)    $('input[name="correction_data[name_bn][old]"]').val(data.name);
            if(data.dob)     $('input[name="correction_data[dob][old]"]').val(data.dob);
            if(data.address) $('input[name="correction_data[address][old]"]').val(data.address);
        });

        $("#certificateForm").on('submit', function(e) {
            e.preventDefault();

            // Ensure user_id is selected
            var userId = $('#user_id_select').val();
            if (!userId) {
                toastr.error('অনুগ্রহ করে একজন আবেদনকারী নির্বাচন করুন।');
                return;
            }

            var submitBtn = $(this).find('button[type=submit]');
            submitBtn.prop('disabled', true).text('Saving...');

            $.ajax({
                type: "POST",
                url: "{{ route('nid-correction.store') }}",
                data: $(this).serialize(),
                success: function (response) {
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.href = response.redirect_url;
                    }, 1200);
                },
                error: function(xhr) {
                    submitBtn.prop('disabled', false).text('Generate Form-2 Application');
                    var resp = xhr.responseJSON;
                    if (resp && resp.errors) {
                        // Show validation errors
                        $.each(resp.errors, function(key, msgs) {
                            toastr.error(msgs[0]);
                        });
                    } else {
                        toastr.error((resp && resp.message) ? resp.message : 'Form submission failed!');
                    }
                }
            });
        });
    });
</script>
@endpush
