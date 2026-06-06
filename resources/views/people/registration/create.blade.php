@extends('backend.master')

@section('title', 'নাগরিক নিবন্ধন')

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
                @include('people.registration.tab_header', ['user' => $user ?? false, 'active_tab' => 'personal'])
            </div>
            
            <form id="citizenRegistrationForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body bg-gray-50/30">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">নাম (ইংরেজী) <span class="text-danger">*</span></label>
                                <input type="text" required class="form-control border-gray-200 rounded-lg text-sm" name="name" value="{{ $user->name ?? '' }}" placeholder="Name English">
                                <small class="error name-error text-danger"></small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">নাম (বাংলা) <span class="text-danger">*</span></label>
                                <input type="text" required class="form-control border-gray-200 rounded-lg text-sm" name="bn_name" value="{{ $user->people->bn_name ?? '' }}" placeholder="নাম বাংলা">
                                <small class="error bn_name-error text-danger"></small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">জন্ম তারিখ</label>
                                <input type="date" name="date_of_birth" value="{{ $user->people->date_of_birth ?? '' }}" class="form-control border-gray-200 rounded-lg text-sm" id="date_of_birth">
                                <small class="error date_of_birth-error text-danger"></small>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">বয়স</label>
                                <input type="text" class="form-control bg-gray-100 border-gray-200 rounded-lg text-sm" id="age" readonly placeholder="Auto calculated">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">জন্মস্থান (জেলা)</label>
                                <select name="birth_place" class="form-control border-gray-200 rounded-lg text-sm" id="birth_place">
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}" {{ ($user->people->birth_place ?? '') == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">লিঙ্গ</label>
                                <select name="gender" class="form-control border-gray-200 rounded-lg text-sm">
                                    <option value="">নির্বাচন করুন</option>
                                    <option value="Male" {{ ($user->people->gender ?? '') == 'Male' ? 'selected' : '' }}>Male (পুরুষ)</option>
                                    <option value="Female" {{ ($user->people->gender ?? '') == 'Female' ? 'selected' : '' }}>Female (মহিলা)</option>
                                    <option value="Others" {{ ($user->people->gender ?? '') == 'Others' ? 'selected' : '' }}>Others (অন্যান্য)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">ধর্ম</label>
                                <select name="religion" class="form-control border-gray-200 rounded-lg text-sm">
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach ($religions as $religion)
                                        <option value="{{ $religion->id }}" {{ ($user->people->religion_id ?? '') == $religion->id ? 'selected' : '' }}>{{ $religion->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">রক্তের গ্রুপ</label>
                                <select name="blood_group" class="form-control border-gray-200 rounded-lg text-sm">
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $bg)
                                        <option value="{{ $bg }}" {{ ($user->people->blood_group ?? '') == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">জন্ম নিবন্ধন নম্বর</label>
                                <input type="text" name="birth_certificate" value="{{ $user->birth_certificate ?? '' }}" placeholder="জন্ম নিবন্ধন নম্বর" class="form-control border-gray-200 rounded-lg text-sm">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">জাতীয় পরিচয়পত্র নম্বর (NID)</label>
                                <input type="text" name="nid" value="{{ $user->nid ?? '' }}" placeholder="NID No." class="form-control border-gray-200 rounded-lg text-sm">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">মোবাইল নম্বর</label>
                                <input type="tel" name="mobile" value="{{ $user->mobile ?? '' }}" placeholder="মোবাইল নম্বর" class="form-control border-gray-200 rounded-lg text-sm">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">ইমেইল</label>
                                <input type="email" name="email" value="{{ $user->email ?? '' }}" placeholder="ইমেইল" class="form-control border-gray-200 rounded-lg text-sm">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">ছবি</label>
                                <input type="file" name="image" class="form-control-file border p-2 rounded-lg" id="image">
                            </div>
                        </div>
                        <div class="col-sm-6 text-center">
                            <img class="img-fluid img-thumbnail rounded-lg" src="{{ isset($user->image) ? imageUrl($user->image) : asset('no-image-found.jpeg') }}" id="preview" alt="Preview" width="100">
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white py-4 text-right">
                    <a href="{{ route('people.dashboard') }}" class="btn btn-light px-5 py-2.5 rounded-lg font-bold text-sm mr-2 border">বাতিল</a>
                    <button type="submit" class="btn btn-success px-5 py-2.5 rounded-lg font-bold text-sm shadow-sm hover:shadow-md transition">
                        সংরক্ষণ করুন ও পরবর্তী <i class="fas fa-arrow-right ml-2"></i>
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
        // Initial age calculation
        function calculateAge(dob) {
            if (dob) {
                let birthDate = new Date(dob);
                let today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                let monthDiff = today.getMonth() - birthDate.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                return age + ' years';
            }
            return '';
        }

        $('#age').val(calculateAge($('#date_of_birth').val()));

        $('#date_of_birth').on('change', function() {
            $('#age').val(calculateAge($(this).val()));
        });

        // Image preview
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

        // Form submission
        $("#citizenRegistrationForm").on('submit', function(e) {
            e.preventDefault();
            let thisForm = $(this);
            $.ajax({
                type: "POST",
                url: "{{ route('people.applications.registration.store') }}",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    thisForm.find('.error').html('')
                    thisForm.find('button[type="submit"]').prop("disabled", true).html('<i class="fas fa-spinner fa-spin mr-2"></i> সংরক্ষণ হচ্ছে...');
                },
                success: function(response) {
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.href = response.redirect_url;
                    }, 1000)
                },
                error: function(xhr) {
                    thisForm.find('button[type="submit"]').prop("disabled", false).html('সংরক্ষণ করুন ও পরবর্তী <i class="fas fa-arrow-right ml-2"></i>');
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message || "ত্রুটি হয়েছে");
                    if (responseText.errors) {
                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "-error").text(val[0]);
                        });
                    }
                }
            });
        });
    });
</script>
@endpush
