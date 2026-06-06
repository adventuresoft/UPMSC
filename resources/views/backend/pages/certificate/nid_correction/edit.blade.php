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

@section('title', 'Edit NID Correction Application (Form-2)')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit NID Correction Application (Form-2)</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('nid-correction.index')}}">NID Correction</a></li>
                    <li class="breadcrumb-item active">Edit</li>
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
                        <h3 class="card-title">Edit: {{ $certificate->system_id }}</h3>
                    </div>
                    <form class="form-horizontal" id="certificateForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            
                            <div class="form-section-title">১. জাতীয় পরিচয়পত্রধারীর তথ্য</div>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">আবেদনকারী</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{ $certificate->user->name ?? 'N/A' }} ({{ $certificate->user->system_id ?? '' }})" disabled>
                                    <input type="hidden" name="user_id" value="{{ $certificate->user_id }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">(ক) নাম</label>
                                <div class="col-sm-4">
                                    <input type="text" name="applicant_name" id="applicant_name" class="form-control" value="{{ $certificate->applicant_name }}" placeholder="নাম (বাংলা)">
                                </div>
                                <label class="col-sm-2 col-form-label text-right">Name (English)</label>
                                <div class="col-sm-4">
                                    <input type="text" name="applicant_name_en" id="applicant_name_en" class="form-control" value="{{ $certificate->applicant_name_en }}" placeholder="Name (English)">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">(খ) এনআইডি নম্বর</label>
                                <div class="col-sm-10">
                                    <input type="text" name="applicant_nid" id="applicant_nid" class="form-control" value="{{ $certificate->applicant_nid }}" placeholder="NID Number" maxlength="17">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">পিতার নাম</label>
                                <div class="col-sm-4">
                                    <input type="text" name="applicant_father_name" id="applicant_father_name" class="form-control" value="{{ $certificate->applicant_father_name }}" placeholder="পিতার নাম">
                                </div>
                                <label class="col-sm-2 col-form-label text-right">মাতার নাম</label>
                                <div class="col-sm-4">
                                    <input type="text" name="applicant_mother_name" id="applicant_mother_name" class="form-control" value="{{ $certificate->applicant_mother_name }}" placeholder="মাতার নাম">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">স্বামীর নাম</label>
                                <div class="col-sm-4">
                                    <input type="text" name="applicant_husband_name" id="applicant_husband_name" class="form-control" value="{{ $certificate->applicant_husband_name }}" placeholder="স্বামীর নাম (প্রযোজ্য ক্ষেত্রে)">
                                </div>
                                <label class="col-sm-2 col-form-label text-right">জন্ম তারিখ</label>
                                <div class="col-sm-4">
                                    <input type="date" name="applicant_dob" id="applicant_dob" class="form-control" value="{{ $certificate->applicant_dob }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">রক্তের গ্রুপ</label>
                                <div class="col-sm-4">
                                    <select name="applicant_blood_group" class="form-control">
                                        <option value="">নির্বাচন করুন</option>
                                        <option value="A+" {{ $certificate->applicant_blood_group == 'A+' ? 'selected' : '' }}>A+</option>
                                        <option value="A-" {{ $certificate->applicant_blood_group == 'A-' ? 'selected' : '' }}>A-</option>
                                        <option value="B+" {{ $certificate->applicant_blood_group == 'B+' ? 'selected' : '' }}>B+</option>
                                        <option value="B-" {{ $certificate->applicant_blood_group == 'B-' ? 'selected' : '' }}>B-</option>
                                        <option value="O+" {{ $certificate->applicant_blood_group == 'O+' ? 'selected' : '' }}>O+</option>
                                        <option value="O-" {{ $certificate->applicant_blood_group == 'O-' ? 'selected' : '' }}>O-</option>
                                        <option value="AB+" {{ $certificate->applicant_blood_group == 'AB+' ? 'selected' : '' }}>AB+</option>
                                        <option value="AB-" {{ $certificate->applicant_blood_group == 'AB-' ? 'selected' : '' }}>AB-</option>
                                    </select>
                                </div>
                                <label class="col-sm-2 col-form-label text-right">মোবাইল নম্বর</label>
                                <div class="col-sm-4">
                                    <input type="text" name="applicant_mobile" id="applicant_mobile" class="form-control" value="{{ $certificate->applicant_mobile }}" placeholder="Mobile">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">ঠিকানা</label>
                                <div class="col-sm-10">
                                    <textarea name="applicant_address" id="applicant_address" class="form-control" rows="2" placeholder="পূর্ণ ঠিকানা">{{ $certificate->applicant_address }}</textarea>
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
                                        $correctionData = is_string($certificate->correction_data) ? json_decode($certificate->correction_data, true) : ($certificate->correction_data ?? []);
                                    @endphp
                                    @foreach($fields as $key => $label)
                                    @php
                                        $oldVal = $correctionData[$key]['old'] ?? '';
                                        $newVal = $correctionData[$key]['new'] ?? '';
                                        $isActive = !empty($correctionData[$key]['active']);
                                    @endphp
                                    <tr>
                                        <td><strong>{{ $label }}</strong></td>
                                        <td><input type="text" name="correction_data[{{ $key }}][old]" value="{{ $oldVal }}" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="correction_data[{{ $key }}][new]" value="{{ $newVal }}" class="form-control form-control-sm"></td>
                                        <td class="text-center">
                                            <input type="checkbox" name="correction_data[{{ $key }}][active]" value="1" {{ $isActive ? 'checked' : '' }}>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="form-section-title">৪. ফী ও দলিলাদি</div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">জমার পরিমাণ (টাকা)</label>
                                <div class="col-sm-4">
                                    <input type="number" name="payment_amount" class="form-control" value="{{ $certificate->payment_amount }}" placeholder="টাকা">
                                </div>
                                <label class="col-sm-2 col-form-label text-right">জমার রসিদ নং</label>
                                <div class="col-sm-4">
                                    <input type="text" name="payment_receipt_no" class="form-control" value="{{ $certificate->payment_receipt_no }}" placeholder="রসিদ নম্বর">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">সংযুক্ত দলিলাদি</label>
                                <div class="col-sm-10">
                                    <textarea name="attachments_list" class="form-control" rows="2" placeholder="সংযুক্ত দলিলাদির বিবরণ লিখুন">{{ $certificate->attachments_list }}</textarea>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <a href="{{route('nid-correction.index')}}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-info float-right">Update Changes</button>
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
        $("#certificateForm").on('submit', function(e) {
            e.preventDefault();

            var submitBtn = $(this).find('button[type=submit]');
            submitBtn.prop('disabled', true).text('Saving...');

            $.ajax({
                type: "POST",
                url: "{{ route('nid-correction.update', $certificate->id) }}",
                data: $(this).serialize(),
                success: function (response) {
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.href = response.redirect_url;
                    }, 1200);
                },
                error: function(xhr) {
                    submitBtn.prop('disabled', false).text('Update Changes');
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
