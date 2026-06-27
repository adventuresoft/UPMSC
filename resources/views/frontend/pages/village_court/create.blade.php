<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CLMS | Gram Adalat Application</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{asset('assets/style/global.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/style/upms-theme.css')}}?v=1.6" />
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style type="text/tailwindcss">
        @layer utilities {
            .form-input {
                @apply w-full px-3 py-1.5 bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-[#046307]/30 focus:border-[#046307] outline-none transition-all duration-300 text-sm h-[38px] shadow-sm hover:border-gray-400;
            }
            .form-label {
                @apply block text-xs font-bold text-gray-800 mb-1.5 tracking-wide;
            }
            .section-title {
                @apply text-sm font-extrabold text-[#046307] border-b-2 border-[#046307]/20 pb-2.5 mb-5 mt-7 flex items-center gap-2 uppercase tracking-widest;
            }
            .select2-container--default .select2-selection--single {
                height: 38px !important;
                border: 1px solid #d1d5db !important;
                border-radius: 0.375rem !important;
                background-color: #ffffff !important;
            }
            .select2-container--default .select2-selection--single .select2-selection__rendered {
                line-height: 36px !important;
                font-size: 13px !important;
                color: #374151 !important;
                padding-left: 0.75rem !important;
            }
            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: 36px !important;
            }
        }
    </style>
    <style>
        .select2-hidden-accessible {
            display: none !important;
        }
        .select2-container {
            width: 100% !important;
        }
    </style>
  </head>
  <body class="bg-[#f3f4f6] font-inter">
    <!-- top bar -->
    @include('frontend.layouts.header')
    @include('frontend.layouts.public_navbar')
    
    <main>
      
      <div class="container mx-auto max-w-5xl px-4 mt-6 pb-20">
        <div class="bg-white rounded-lg shadow-[0_5px_25px_rgba(0,0,0,0.05)] overflow-hidden border border-gray-100">
          <div class="bg-gray-50 border-b border-gray-100 px-6 py-4 text-center">
            <h2 class="text-xl font-bold text-purple-800">গ্রাম আদালত মামলা আবেদন ফরম</h2>
            <p class="mt-0.5 text-[10px] text-gray-500 italic">সঠিক তথ্য দিয়ে ফরমটি পূরণ করুন</p>
          </div>

          <form class="p-6 pt-2" id="applicationForm" action="{{ route('public.village-court.store') }}" method="POST">
            @csrf
            
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 mt-4" role="alert">
              <strong class="font-bold">সফল!</strong>
              <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 mt-4" role="alert">
              <strong class="font-bold">ত্রুটি!</strong>
              <ul class="list-disc pl-5">
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
            </div>
            @endif

            <!-- Target Union Selection -->
            <div class="section-title text-purple-800 border-purple-200">
                <i class="fas fa-map-marker-alt"></i>
                ইউনিয়ন নির্বাচন (যে ইউনিয়নে মামলা দায়ের করবেন)
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="form-label" for="target_division">বিভাগ <span class="text-red-500">*</span></label>
                    <select name="target_division" id="target_division" class="form-input select2" required>
                        <option value="">বিভাগ নির্বাচন করুন</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label" for="target_district">জেলা <span class="text-red-500">*</span></label>
                    <select name="target_district" id="target_district" class="form-input select2" required>
                        <option value="">জেলা নির্বাচন করুন</option>
                    </select>
                </div>
                <div>
                    <label class="form-label" for="target_thana">উপজেলা <span class="text-red-500">*</span></label>
                    <select name="target_thana" id="target_thana" class="form-input select2" required>
                        <option value="">উপজেলা নির্বাচন করুন</option>
                    </select>
                </div>
                <div>
                    <label class="form-label" for="target_union_id">ইউনিয়ন <span class="text-red-500">*</span></label>
                    <select name="target_union_id" id="target_union_id" class="form-input select2" required>
                        <option value="">ইউনিয়ন নির্বাচন করুন</option>
                    </select>
                </div>
            </div>

            <!-- Case Type Info -->
            <div class="section-title text-purple-800 border-purple-200">
                <i class="fas fa-balance-scale"></i>
                মামলার ধরন (তফসিল) ও সময়
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label" for="case_category">অংশ <span class="text-red-500">*</span></label>
                    <select name="case_category" id="case_category" class="form-input" required>
                        <option value="">অংশ নির্বাচন করুন</option>
                        <option value="প্রথম অংশ : ফৌজদারী মামলাসমূহ">প্রথম অংশ : ফৌজদারী মামলাসমূহ</option>
                        <option value="দ্বিতীয় অংশ : দেওয়ানী মামলাসমূহ">দ্বিতীয় অংশ : দেওয়ানী মামলাসমূহ</option>
                    </select>
                </div>
                <div>
                    <label class="form-label" for="case_type_details">বিস্তারিত ধরন <span class="text-red-500">*</span></label>
                    <select name="case_type_details" id="case_type_details" class="form-input select2" required>
                        <option value="">বিস্তারিত নির্বাচন করুন</option>
                    </select>
                </div>
                <div>
                    <label class="form-label">ঘটনা সংঘটনের তারিখ <span class="text-red-500">*</span></label>
                    <input type="date" name="case_date" class="form-input" required value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d', strtotime('-30 days')) }}" max="{{ date('Y-m-d') }}">
                </div>
                <div>
                    <label class="form-label">ঘটনা সংঘটনের সময় <span class="text-red-500">*</span></label>
                    <input type="time" name="case_time" class="form-input" required value="{{ now()->timezone('Asia/Dhaka')->format('H:i') }}">
                </div>
            </div>

            <div class="mt-4">
                <label class="form-label">অভিযোগের বিবরণ</label>
                <textarea name="ovijog_er_biboron" class="form-input !h-24" placeholder="অভিযোগের বিস্তারিত বিবরণ লিখুন..."></textarea>
            </div>

            <!-- Badi Info -->
            <div class="section-title text-purple-800 border-purple-200">
                <i class="fas fa-user"></i>
                বাদী (আবেদনকারী) এর তথ্য
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div><label class="form-label">নাম <span class="text-red-500">*</span></label><input type="text" name="badi_name" class="form-input" required placeholder="নাম লিখুন"></div>
                <div><label class="form-label">মোবাইল <span class="text-red-500">*</span></label><input type="text" name="badi_mobile" class="form-input" required placeholder="মোবাইল নম্বর"></div>
                <div><label class="form-label">এনআইডি নম্বর</label><input type="text" name="badi_nid" class="form-input" placeholder="NID"></div>
                <div><label class="form-label">পিতা/স্বামীর নাম</label><input type="text" name="badi_father_name" class="form-input" placeholder="পিতা/স্বামীর নাম"></div>
                <div class="lg:col-span-2"><label class="form-label">পূর্ণ ঠিকানা</label><input type="text" name="badi_address" class="form-input" placeholder="ঠিকানা"></div>
            </div>

            <!-- Bibadi Info -->
            <div class="section-title text-purple-800 border-purple-200">
                <i class="fas fa-user-times"></i>
                বিবাদী এর তথ্য <span class="text-red-500 ml-1">*</span>
            </div>

            <div id="bibadi-container">
                <div class="bibadi-row border border-gray-200 p-4 rounded-lg bg-gray-50 mb-3 relative">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 pr-10">
                        <div><label class="form-label">নাম <span class="text-red-500">*</span></label><input type="text" name="bibadi_name[]" class="form-input" required placeholder="নাম লিখুন"></div>
                        <div><label class="form-label">মোবাইল</label><input type="text" name="bibadi_mobile[]" class="form-input" placeholder="মোবাইল নম্বর"></div>
                        <div><label class="form-label">এনআইডি নম্বর</label><input type="text" name="bibadi_nid[]" class="form-input" placeholder="NID"></div>
                        <div><label class="form-label">পিতা/স্বামীর নাম</label><input type="text" name="bibadi_father_name[]" class="form-input" placeholder="পিতা/স্বামীর নাম"></div>
                        <div class="lg:col-span-2"><label class="form-label">পূর্ণ ঠিকানা</label><input type="text" name="bibadi_address[]" class="form-input" placeholder="ঠিকানা"></div>
                    </div>
                    <button type="button" class="absolute top-4 right-4 bg-green-500 hover:bg-green-600 text-white w-8 h-8 rounded-full flex items-center justify-center transition add-bibadi"><i class="fas fa-plus"></i></button>
                </div>
            </div>

            <!-- Shakkhi Info -->
            <div class="section-title text-purple-800 border-purple-200">
                <i class="fas fa-users"></i>
                সাক্ষীর তথ্য (যদি থাকে)
            </div>

            <div id="shakkhi-container">
                <div class="shakkhi-row border border-gray-200 p-4 rounded-lg bg-gray-50 mb-3 relative">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 pr-10">
                        <div><label class="form-label">নাম</label><input type="text" name="shakkhi_name[]" class="form-input" placeholder="নাম লিখুন"></div>
                        <div><label class="form-label">মোবাইল</label><input type="text" name="shakkhi_mobile[]" class="form-input" placeholder="মোবাইল নম্বর"></div>
                        <div><label class="form-label">এনআইডি নম্বর</label><input type="text" name="shakkhi_nid[]" class="form-input" placeholder="NID"></div>
                        <div><label class="form-label">পিতা/স্বামীর নাম</label><input type="text" name="shakkhi_father_name[]" class="form-input" placeholder="পিতা/স্বামীর নাম"></div>
                        <div class="lg:col-span-2"><label class="form-label">পূর্ণ ঠিকানা</label><input type="text" name="shakkhi_address[]" class="form-input" placeholder="ঠিকানা"></div>
                    </div>
                    <button type="button" class="absolute top-4 right-4 bg-green-500 hover:bg-green-600 text-white w-8 h-8 rounded-full flex items-center justify-center transition add-shakkhi"><i class="fas fa-plus"></i></button>
                </div>
            </div>

            <!-- Submit Section -->
            <div class="mt-8 text-center bg-gray-50 p-4 rounded-lg border border-gray-100">
                <div class="flex flex-col md:flex-row items-center justify-center gap-3 mb-4">
                    <button type="submit" class="w-full md:w-40 py-2 px-5 bg-purple-700 text-white font-bold rounded hover:bg-purple-800 transition text-[11px] shadow-md transform active:scale-95 uppercase">মামলা দায়ের করুন</button>
                </div>
                
                <p class="text-gray-500 text-[10px]">
                    আপনার কি ইতোমধ্যে অ্যাকাউন্ট আছে? 
                    <a href="{{ route('people.login') }}" class="text-purple-700 font-black hover:underline">এখানে লগইন করুন</a>
                </p>
            </div>
          </form>

        </div>
      </div>
    </main>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/navbar.js') }}"></script>

    <script>
        $(function () {
            $('.select2').select2({ width: '100%' });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function (e) {
                if (!e.target.closest('.user-dropdown-btn') && !e.target.closest('.user-dropdown-menu')) {
                    var menus = document.querySelectorAll('.user-dropdown-menu');
                    menus.forEach(function (menu) {
                        menu.classList.add('hidden');
                    });
                }
            });

            // Location Fetching Logic
            $('#target_division').change(function() {
                var divisionID = $(this).val();
                if(divisionID) {
                    $.get('/get-districts-by-division/' + divisionID, function(data) {
                        $('#target_district').html(data);
                        $('#target_thana').empty().append('<option value="">উপজেলা নির্বাচন করুন</option>');
                        $('#target_union_id').empty().append('<option value="">ইউনিয়ন নির্বাচন করুন</option>');
                    });
                }
            });

            $('#target_district').change(function() {
                var districtID = $(this).val();
                if(districtID) {
                    $.get('/get-upazillas-by-district/' + districtID, function(data) {
                        $('#target_thana').html(data);
                        $('#target_union_id').empty().append('<option value="">ইউনিয়ন নির্বাচন করুন</option>');
                    });
                }
            });

            $('#target_thana').change(function() {
                var thanaID = $(this).val();
                if(thanaID) {
                    $.get('/get-unions-by-upazilla/' + thanaID, function(data) {
                        $('#target_union_id').html(data);
                    });
                }
            });

            // Case Type Logic
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
                    alert('নির্বাচিত মামলার ধরনের জন্য ঘটনা সংঘটনের তারিখ ' + minDate + ' এর পূর্বে হতে পারবে না।');
                }
            }

            // Dynamic Rows Add/Remove
            $(document).on('click', '.add-bibadi', function() {
                var newRow = $('.bibadi-row').first().clone();
                newRow.find('input').val('');
                
                newRow.find('.add-bibadi')
                    .removeClass('bg-green-500 hover:bg-green-600 add-bibadi')
                    .addClass('bg-red-500 hover:bg-red-600 remove-bibadi')
                    .html('<i class="fas fa-trash"></i>');
                    
                $('#bibadi-container').append(newRow);
            });

            $(document).on('click', '.remove-bibadi', function() {
                $(this).closest('.bibadi-row').remove();
            });

            $(document).on('click', '.add-shakkhi', function() {
                var newRow = $('.shakkhi-row').first().clone();
                newRow.find('input').val('');
                
                newRow.find('.add-shakkhi')
                    .removeClass('bg-green-500 hover:bg-green-600 add-shakkhi')
                    .addClass('bg-red-500 hover:bg-red-600 remove-shakkhi')
                    .html('<i class="fas fa-trash"></i>');
                    
                $('#shakkhi-container').append(newRow);
            });

            $(document).on('click', '.remove-shakkhi', function() {
                $(this).closest('.shakkhi-row').remove();
            });
        });
    </script>
  </body>
</html>
