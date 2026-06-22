@extends('backend.master', ['mainMenu' => 'LocalGovtJudiciary', 'subMenu' => 'VillageCourtCreate'])
@push('style')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@section('title', 'Create Case (মামলা রুজু)')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Case (মামলা রুজু)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('village-court.index') }}">Case</a></li>
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
                            <h3 class="card-title">Create Case Form (মামলা রুজু ফরম)</h3>
                        </div>
                        <form action="{{ route('village-court.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group border p-2 rounded bg-light">
                                            <label>Applicant / বাদী <span class="text-danger">*</span></label>
                                            <div class="mb-2">
                                                <select name="badi_is_union" class="form-control font-weight-bold is_union_select" onchange="toggleUnionSection(this)">
                                                    <option value="1">From this union (ইউনিয়নের বাসিন্দা)</option>
                                                    <option value="0">Outside union (অন্য এলাকার)</option>
                                                </select>
                                            </div>
                                            <div class="union_section">
                                                <select name="badi_id" class="form-control select2">
                                                    <option value="">Select Badi</option>
                                                    @foreach($people as $p)
                                                        <option value="{{ $p->id }}">{{ $p->bn_name ?? $p->name ?? ($p->user->name ?? 'Unknown') }} ({{ $p->nid ?? ($p->user->nid ?? 'No NID') }}) - {{ $p->approved_id }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="outside_section" style="display: none;">
                                                <div class="row">
                                                    <div class="col-sm-6 mb-2"><input type="text" name="badi_name" class="form-control" placeholder="Name"></div>
                                                    <div class="col-sm-6 mb-2"><input type="text" name="badi_mobile" class="form-control" placeholder="Mobile Number"></div>
                                                    <div class="col-sm-6 mb-2"><input type="text" name="badi_nid" class="form-control" placeholder="NID"></div>
                                                    <div class="col-sm-6 mb-2"><input type="text" name="badi_father_name" class="form-control" placeholder="Father's Name"></div>
                                                    <div class="col-sm-12 mb-2"><input type="text" name="badi_address" class="form-control" placeholder="Address"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group border p-2 rounded bg-light">
                                            <label>Defendant / বিবাদী <span class="text-danger">*</span></label>
                                            <div id="bibadi-container">
                                                <div class="row bibadi-row mb-3 pb-2 border-bottom">
                                                    <div class="col-sm-10">
                                                        <div class="mb-2">
                                                            <select name="bibadi_is_union[]" class="form-control font-weight-bold is_union_select" onchange="toggleUnionSection(this)">
                                                                <option value="1">From this union (ইউনিয়নের বাসিন্দা)</option>
                                                                <option value="0">Outside union (অন্য এলাকার)</option>
                                                            </select>
                                                        </div>
                                                        <div class="union_section">
                                                            <select name="bibadi_ids[]" class="form-control select2">
                                                                <option value="">Select Bibadi</option>
                                                                @foreach($people as $p)
                                                                    <option value="{{ $p->id }}">{{ $p->bn_name ?? $p->name ?? ($p->user->name ?? 'Unknown') }} ({{ $p->nid ?? ($p->user->nid ?? 'No NID') }}) - {{ $p->approved_id }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="outside_section" style="display: none;">
                                                            <div class="row">
                                                                <div class="col-sm-6 mb-2"><input type="text" name="bibadi_name[]" class="form-control" placeholder="Name"></div>
                                                                <div class="col-sm-6 mb-2"><input type="text" name="bibadi_mobile[]" class="form-control" placeholder="Mobile Number"></div>
                                                                <div class="col-sm-6 mb-2"><input type="text" name="bibadi_nid[]" class="form-control" placeholder="NID"></div>
                                                                <div class="col-sm-6 mb-2"><input type="text" name="bibadi_father_name[]" class="form-control" placeholder="Father's Name"></div>
                                                                <div class="col-sm-12 mb-2"><input type="text" name="bibadi_address[]" class="form-control" placeholder="Address"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <button type="button" class="btn btn-success add-bibadi"><i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group border p-2 rounded bg-light">
                                            <label>Witness / সাক্ষী</label>
                                            <div id="shakkhi-container">
                                                <div class="row shakkhi-row mb-3 pb-2 border-bottom">
                                                    <div class="col-sm-10">
                                                        <div class="mb-2">
                                                            <select name="shakkhi_is_union[]" class="form-control font-weight-bold is_union_select" onchange="toggleUnionSection(this)">
                                                                <option value="1">From this union (ইউনিয়নের বাসিন্দা)</option>
                                                                <option value="0">Outside union (অন্য এলাকার)</option>
                                                            </select>
                                                        </div>
                                                        <div class="union_section">
                                                            <select name="shakkhi_ids[]" class="form-control select2">
                                                                <option value="">Select Witness</option>
                                                                @foreach($people as $p)
                                                                    <option value="{{ $p->id }}">{{ $p->bn_name ?? $p->name ?? ($p->user->name ?? 'Unknown') }} ({{ $p->nid ?? ($p->user->nid ?? 'No NID') }}) - {{ $p->approved_id }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="outside_section" style="display: none;">
                                                            <div class="row">
                                                                <div class="col-sm-6 mb-2"><input type="text" name="shakkhi_name[]" class="form-control" placeholder="Name"></div>
                                                                <div class="col-sm-6 mb-2"><input type="text" name="shakkhi_mobile[]" class="form-control" placeholder="Mobile Number"></div>
                                                                <div class="col-sm-6 mb-2"><input type="text" name="shakkhi_nid[]" class="form-control" placeholder="NID"></div>
                                                                <div class="col-sm-6 mb-2"><input type="text" name="shakkhi_father_name[]" class="form-control" placeholder="Father's Name"></div>
                                                                <div class="col-sm-12 mb-2"><input type="text" name="shakkhi_address[]" class="form-control" placeholder="Address"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <button type="button" class="btn btn-success add-shakkhi"><i class="fas fa-plus"></i> Add More</button>
                                                    </div>
                                                </div>
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
                                                        <option value="প্রথম অংশ : ফৌজদারী মামলাসমূহ">প্রথম অংশ : ফৌজদারী মামলাসমূহ</option>
                                                        <option value="দ্বিতীয় অংশ : দেওয়ানী মামলাসমূহ">দ্বিতীয় অংশ : দেওয়ানী মামলাসমূহ</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-8">
                                                    <select name="case_type_details" id="case_type_details" class="form-control select2" required>
                                                        <option value="">Select Details (বিস্তারিত নির্বাচন করুন)</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Case Date (মামলার তারিখ) <span class="text-danger">*</span></label>
                                            <input type="date" name="case_date" class="form-control" required value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d', strtotime('-30 days')) }}" max="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Case Time (মামলার সময়) <span class="text-danger">*</span></label>
                                            <input type="time" name="case_time" class="form-control" required value="{{ now()->timezone('Asia/Dhaka')->format('H:i') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Complaint Description / অভিযোগের বিবরণ</label>
                                            <textarea name="ovijog_er_biboron" class="form-control" rows="4" placeholder="Enter details of the complaint..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Create Case / মামলা দায়ের করুন</button>
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
        function toggleUnionSection(element) {
            var val = $(element).val();
            var parent = $(element).closest('.col-sm-10, .col-sm-12');
            if(!parent.length) { parent = $(element).closest('.form-group'); }
            
            if (val == '1') {
                parent.find('.union_section').show();
                parent.find('.outside_section').hide();
                // We shouldn't clear values because user might toggle back
            } else {
                parent.find('.union_section').hide();
                parent.find('.outside_section').show();
            }
        }

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
                '৩। স্থাবর সম্পত্তি বেদখল হওয়ার এক বৎসরের মধ্যে উহার দখল পুনরুদ্ধারের মামলা। (মূল্যমান অনধিক ৭৫ (পঁচাত্তর) হাজার টাকা)',
                '৪। কোন অস্থাবর সম্পত্তির জবর দখল বা ক্ষতি করার জন্য ক্ষতিপূরণ আদায়ের জন্য মামলা।',
                '৫। গবাদিপশু অনধিকার প্রবেশের কারণে ক্ষতিপূরণের মামলা।',
                '৬। কৃষি শ্রমিকদের পরিশোধযোগ্য মজুরী ও ক্ষতিপূরণ আদায়ের মামলা।'
            ];

            $('#case_category').on('change', function() {
                var category = $(this).val();
                var detailsSelect = $('#case_type_details');
                detailsSelect.empty().append('<option value="">Select Details (বিস্তারিত নির্বাচন করুন)</option>');
                
                var options = [];
                if(category === 'প্রথম অংশ : ফৌজদারী মামলাসমূহ') {
                    options = criminalCases;
                } else if(category === 'দ্বিতীয় অংশ : দেওয়ানী মামলাসমূহ') {
                    options = civilCases;
                }

                $.each(options, function(index, value) {
                    detailsSelect.append($('<option></option>').attr('value', value).text(value));
                });
                
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
                    dateInput.val('');
                    alert('নির্বাচিত মামলার ধরনের জন্য মামলার তারিখ ' + minDate + ' এর পূর্বে হতে পারবে না।');
                }
            }

            $(document).on('click', '.add-bibadi', function() {
                var newRow = $('.bibadi-row').first().clone();
                newRow.find('span.select2').remove();
                newRow.find('select.select2').removeClass('select2-hidden-accessible').removeAttr('data-select2-id').val('');
                newRow.find('select.select2').find('option').removeAttr('data-select2-id');
                newRow.find('input').val('');
                newRow.find('select.is_union_select').val('1');
                newRow.find('.union_section').show();
                newRow.find('.outside_section').hide();
                
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
                newRow.find('select.select2').removeClass('select2-hidden-accessible').removeAttr('data-select2-id').val('');
                newRow.find('select.select2').find('option').removeAttr('data-select2-id');
                newRow.find('input').val('');
                newRow.find('select.is_union_select').val('1');
                newRow.find('.union_section').show();
                newRow.find('.outside_section').hide();

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
