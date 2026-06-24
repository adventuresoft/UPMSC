@extends('backend.master', ['mainMenu' => 'LocalGovtJudiciary', 'subMenu' => 'VillageCourtCreate'])
@push('style')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@section('title', 'Edit Case (মামলা সংশোধন)')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Case (মামলা সংশোধন)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('village-court.index') }}">Case</a></li>
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
                            <h3 class="card-title">Edit Case Form (মামলা সংশোধন ফরম)</h3>
                        </div>
                        <form action="{{ route('village-court.update', $case->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Applicant / বাদী <span class="text-danger">*</span></label>
                                            <select name="badi_id" class="form-control select2" required>
                                                <option value="">Select Badi</option>
                                                @foreach($people as $p)
                                                    <option value="{{ $p->id }}" {{ $case->badi_id == $p->id ? 'selected' : '' }}>{{ $p->bn_name ?? $p->name ?? ($p->user->name ?? 'Unknown') }} ({{ $p->nid ?? ($p->user->nid ?? 'No NID') }}) - {{ $p->approved_id }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Defendant / বিবাদী <span class="text-danger">*</span></label>
                                            <div id="bibadi-container">
                                                @php $savedBibadis = is_array($case->bibadi_ids) && count($case->bibadi_ids) > 0 ? $case->bibadi_ids : ['']; @endphp
                                                @foreach($savedBibadis as $index => $bId)
                                                <div class="row bibadi-row {{ $index > 0 ? 'mt-2' : '' }}">
                                                    <div class="col-sm-10">
                                                        <select name="bibadi_ids[]" class="form-control select2" required>
                                                            <option value="">Select Bibadi</option>
                                                            @foreach($people as $p)
                                                                <option value="{{ $p->id }}" {{ $bId == $p->id ? 'selected' : '' }}>{{ $p->bn_name ?? $p->name ?? ($p->user->name ?? 'Unknown') }} ({{ $p->nid ?? ($p->user->nid ?? 'No NID') }}) - {{ $p->approved_id }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        @if($index == 0)
                                                            <button type="button" class="btn btn-success add-bibadi"><i class="fas fa-plus"></i></button>
                                                        @else
                                                            <button type="button" class="btn btn-danger remove-bibadi"><i class="fas fa-trash"></i></button>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Witness / সাক্ষী</label>
                                            <div id="shakkhi-container">
                                                @php $savedShakkhis = is_array($case->shakkhi_ids) && count($case->shakkhi_ids) > 0 ? $case->shakkhi_ids : ['']; @endphp
                                                @foreach($savedShakkhis as $index => $sId)
                                                <div class="row shakkhi-row {{ $index > 0 ? 'mt-2' : '' }}">
                                                    <div class="col-sm-10">
                                                        <select name="shakkhi_ids[]" class="form-control select2">
                                                            <option value="">Select Witness</option>
                                                            @foreach($people as $p)
                                                                <option value="{{ $p->id }}" {{ $sId == $p->id ? 'selected' : '' }}>{{ $p->bn_name ?? $p->name ?? ($p->user->name ?? 'Unknown') }} ({{ $p->nid ?? ($p->user->nid ?? 'No NID') }}) - {{ $p->approved_id }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        @if($index == 0)
                                                            <button type="button" class="btn btn-success add-shakkhi"><i class="fas fa-plus"></i> Add More</button>
                                                        @else
                                                            <button type="button" class="btn btn-danger remove-shakkhi"><i class="fas fa-trash"></i> Remove</button>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group border p-2 rounded bg-light">
                                            <label>Case Type / মামলার ধরন (তফসিল) <span class="text-danger">*</span></label>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <select name="case_category" id="case_category" class="form-control" required>
                                                        <option value="">Select Part (অংশ নির্বাচন করুন)</option>
                                                        <option value="প্রথম অংশ : ফৌজদারী মামলাসমূহ" {{ $case->case_category == 'প্রথম অংশ : ফৌজদারী মামলাসমূহ' ? 'selected' : '' }}>প্রথম অংশ : ফৌজদারী মামলাসমূহ</option>
                                                        <option value="দ্বিতীয় অংশ : দেওয়ানী মামলাসমূহ" {{ $case->case_category == 'দ্বিতীয় অংশ : দেওয়ানী মামলাসমূহ' ? 'selected' : '' }}>দ্বিতীয় অংশ : দেওয়ানী মামলাসমূহ</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-8">
                                                    <select name="case_type_details" id="case_type_details" class="form-control select2" required>
                                                        <option value="">Select Details (বিস্তারিত নির্বাচন করুন)</option>
                                                        @if($case->case_type_details)
                                                            <option value="{{ $case->case_type_details }}" selected>{{ $case->case_type_details }}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Case Date (মামলা সংঘটনের তারিখ) <span class="text-danger">*</span></label>
                                            @php
                                                $caseDate = $case->case_date ? $case->case_date->format('Y-m-d') : date('Y-m-d');
                                                $minDate = min(date('Y-m-d', strtotime('-30 days')), $caseDate);
                                            @endphp
                                            <input type="date" name="case_date" class="form-control" required value="{{ $caseDate }}" min="{{ $minDate }}" max="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Case Time (মামলা সংঘটনের সময়) <span class="text-danger">*</span></label>
                                            <input type="time" name="case_time" class="form-control" required value="{{ $case->case_time ? \Carbon\Carbon::parse($case->case_time)->format('H:i') : date('H:i') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Complaint Description / অভিযোগের বিবরণ</label>
                                            <textarea name="ovijog_er_biboron" class="form-control" rows="4" placeholder="Enter details of the complaint...">{{ $case->ovijog_er_biboron }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Update Case / মামলা হালনাগাদ করুন</button>
                                <a href="{{ route('village-court.index') }}" class="btn btn-default float-right">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $('.select2').select2({ theme: 'bootstrap4' });

            var criminalCases = [
                '১। দণ্ডবিধির ধারা ৩২৩ বা ৪২৬ বা ৪৪৭ মোতাবেক কোন অপরাধ সংঘটন করা, বে-আইনী জনসমাবেশ সাধারণ উদ্দেশ্যে হইলে এবং উক্ত বে-আইনী জনসমাবেশে জড়িত ব্যক্তির সংখ্যা দশের অধিক না হইলে দণ্ডবিধির ১৪৩ ও ১৪৭ ধারা, ১৪১ ধারা এর তৃতীয় বা চতুর্থ দফার সহিত পঠিতব্য।',
                '২। দণ্ডবিধির ধারা ১৬০, ৩৩৪, ৩৪১, ৩৪২, ৩৫২, ৩৫৮, ৫০৪, ৫০৬ (প্রথম অংশ), ৫০৮, ৫০৯ এবং ৫১০।',
                '৩। দণ্ডবিধির ধারা ৩৭৯, ৩৮০ ও ৩৮১ যখন সংঘটিত অপরাধটি গবাদিপশু সংক্রান্ত হয় এবং গবাদিপশুর মূল্য অনধিক ৭৫ (পঁচাত্তর) হাজার টাকা হয়।',
                '৪। দণ্ডবিধির ধারা ৩৭৯, ৩৮০ ও ৩৮১ যখন সংঘটিত অপরাধটি গবাদিপশু ছাড়া অন্য কোন সম্পত্তি সংক্রান্ত হয় এবং উক্ত সম্পত্তির মূল্য অনধিক ৫০ (পঞ্চাশ) হাজার টাকা হয়।',
                '৫। দণ্ডবিধির ধারা ৪০৩, ৪০৬, ৪১৭ ও ৪২০ যখন অপরাধ সংশ্লিষ্ট অর্থের পরিমাণ অনধিক ৭৫ (পঁচাত্তর) হাজার টাকা হয়।',
                '৬। দণ্ডবিধির ধারা ৪২৭, যখন সংশ্লিষ্ট সম্পত্তির মূল্য অনধিক ৭৫ (পঁচাত্তর) হাজার টাকা হয়।',
                '৭। দণ্ডবিধির ধারা ৪২৮ ও ৪২৯ যখন গবাদিপশুর মূল্য অনধিক ৭৫ (পঁচাত্তর) হাজার টাকা হয়।',
                '৯। উপরিউক্ত যে কোন অপরাধ সংঘটনের চেষ্টা বা উহা সংঘটনের সহায়তা প্রদান।'
            ];

            var civilCases = [
                '১। কোন চুক্তি, রশিদ বা অন্য কোন দলিল মূলে প্রাপ্য অর্থ আদায়ের জন্য মামলা। (মূল্যমান অনধিক ৭৫ (পঁচাত্তর) হাজার টাকা)',
                '২। কোন অস্থাবর সম্পত্তি পুনরুদ্ধারের বা উহার মূল্য আদায়ের জন্য মামলা। (মূল্যমান অনধিক ৭৫ (পঁচাত্তর) হাজার টাকা)',
                '৩। স্থাবর সম্পত্তি বেদখল হওয়ার খাওয়ার এক বৎসরের মধ্যে উহার দখল পুনরুদ্ধারের মামলা। (মূল্যমান অনধিক ৭৫ (পঁচাত্তর) হাজার টাকা)',
                '৪। কোন অস্থাবর সম্পত্তির জবর দখল বা ক্ষতি করার জন্য ক্ষতিপূরণ আদায়ের জন্য মামলা।',
                '৫। গবাদিপশু অনধিকার প্রবেশের কারণে ক্ষতিপূরণের মামলা।',
                '৬। কৃষি শ্রমিকদের পরিশোধযোগ্য মজুরী ও ক্ষতিপূরণ আদায়ের মামলা।'
            ];

            function populateDetailsDropdown(category, selectedDetail = null) {
                var detailsSelect = $('#case_type_details');
                detailsSelect.empty().append('<option value="">Select Details (বিস্তারিত নির্বাচন করুন)</option>');
                
                var options = [];
                if(category === 'প্রথম অংশ : ফৌজদারী মামলাসমূহ') {
                    options = criminalCases;
                } else if(category === 'দ্বিতীয় অংশ : দেওয়ানী মামলাসমূহ') {
                    options = civilCases;
                }

                $.each(options, function(index, value) {
                    var selected = (value === selectedDetail) ? 'selected' : '';
                    detailsSelect.append($('<option '+selected+'></option>').attr('value', value).text(value));
                });
                
                // If it was already loaded but the option text didn't exactly match our array (rare), we can just append it:
                if (selectedDetail && !options.includes(selectedDetail)) {
                     detailsSelect.append($('<option selected></option>').attr('value', selectedDetail).text(selectedDetail));
                }
            }

            $('#case_category').on('change', function() {
                populateDetailsDropdown($(this).val());
                updateCaseDateMin();
            });

            $('#case_type_details').on('change', function() {
                updateCaseDateMin();
            });

            function updateCaseDateMin() {
                var category = $('#case_category').val();
                var details = $('#case_type_details').val();
                var d = new Date();
                
                if (category === 'দ্বিতীয় অংশ : দেওয়ানী মামলাসমূহ') {
                    if (details && details.indexOf('৩। স্থাবর সম্পত্তি বেদখল হওয়ার') !== -1) {
                        d.setFullYear(d.getFullYear() - 1); // 1 year
                    } else {
                        d.setDate(d.getDate() - 60); // 60 days
                    }
                } else {
                    d.setDate(d.getDate() - 30); // Default 30 days for others (প্রথম অংশ)
                }
                
                var minDate = d.toISOString().split('T')[0];
                var dateInput = $('input[name="case_date"]');
                dateInput.attr('min', minDate);
                
                // If current selected date is before new min date, reset it
                if (dateInput.val() && dateInput.val() < minDate) {
                    // Do not reset automatically on edit page load unless strictly necessary, 
                    // or just show an alert. But for strictness:
                    // dateInput.val('');
                    // alert('নির্বাচিত মামলার ধরনের জন্য মামলা সংঘটনের তারিখ ' + minDate + ' এর পূর্বে হতে পারবে না।');
                }
            }

            // Initial load for edit page
            var initialCategory = $('#case_category').val();
            var initialDetail = '{{ $case->case_type_details ?? "" }}';
            if(initialCategory) {
                populateDetailsDropdown(initialCategory, initialDetail);
                updateCaseDateMin();
            }

            $(document).on('click', '.add-bibadi', function() {
                var newRow = $('.bibadi-row').first().clone();
                newRow.find('span.select2').remove();
                newRow.find('select').removeClass('select2-hidden-accessible').removeAttr('data-select2-id').val('');
                newRow.find('select').find('option').removeAttr('data-select2-id');
                newRow.addClass('mt-2');
                newRow.find('.add-bibadi').removeClass('btn-success add-bibadi').addClass('btn-danger remove-bibadi').html('<i class="fas fa-trash"></i>');
                $('#bibadi-container').append(newRow);
                newRow.find('.select2').select2({ theme: 'bootstrap4' });
            });

            $(document).on('click', '.remove-bibadi', function() {
                $(this).closest('.bibadi-row').remove();
            });

            $(document).on('click', '.add-shakkhi', function() {
                var newRow = $('.shakkhi-row').first().clone();
                newRow.find('span.select2').remove();
                newRow.find('select').removeClass('select2-hidden-accessible').removeAttr('data-select2-id').val('');
                newRow.find('select').find('option').removeAttr('data-select2-id');
                newRow.addClass('mt-2');
                newRow.find('.add-shakkhi').removeClass('btn-success add-shakkhi').addClass('btn-danger remove-shakkhi').html('<i class="fas fa-trash"></i> Remove');
                $('#shakkhi-container').append(newRow);
                newRow.find('.select2').select2({ theme: 'bootstrap4' });
            });

            $(document).on('click', '.remove-shakkhi', function() {
                $(this).closest('.shakkhi-row').remove();
            });
        });
    </script>
@endpush
