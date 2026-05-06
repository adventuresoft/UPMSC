<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UPMS | Nagorik Application</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{asset('assets/style/global.css')}}" />
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <style>
        .form-input {
            @apply w-full px-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#046307] focus:border-transparent outline-none transition duration-200 text-base h-[42px];
        }
        .form-label {
            @apply block text-base font-semibold text-gray-700 mb-1.5;
        }
        .section-title {
            @apply text-2xl font-bold text-[#046307] border-b-2 border-[#046307] pb-2 mb-8 mt-10 flex items-center gap-2;
        }
        .select2-container--default .select2-selection--single {
            height: 42px !important;
            border: 1px solid #d1d5db !important;
            border-radius: 0.375rem !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 40px !important;
            font-size: 16px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
        }
    </style>
  </head>
  <body class="bg-[#f3f4f6] font-inter">
    <!-- top bar -->
    <div class="top-bar">
      <div class="container mx-auto md:px-4 px-2 max-w-screen-xl">
        <div class="flex flex-col md:flex-row justify-center items-center">
          <div class="flex flex-col md:flex-row items-center gap-4 py-1">
            <img
              src="{{asset('assets/images/logo/govt-bd-logo.png')}}"
              class="h-14 w-auto object-contain"
              alt="Govt Logo"
            />
            <div class="text-black text-center md:text-left">
              <h1 class="md:text-[18px] font-bold leading-tight">
                Citizen Service Management and Central Reporting System
              </h1>
              <p class="text-[10px] font-medium opacity-90">Local Government Division, Local Government Ministry, Bangladesh</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar md:block hidden bg-[#046307] shadow-md sticky top-0 z-50">
      <div class="container mx-auto max-w-screen-xl">
        <!-- Navigation Links -->
        <ul class="nav-links flex items-center justify-center gap-6 py-2">

          <li class="flex items-center">
            <a href="{{url('/')}}" class="inline-flex items-center gap-2">
              <span class="inline-flex h-8 w-8 items-center justify-center rounded-full border border-white/30 text-white transition-all hover:bg-white/10" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                  <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                  <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.432z" />
                </svg>
              </span>
            </a>
          </li>
          <li>
            <a href="{{ route('people.login') }}" class="inline-flex items-center gap-2 text-white">
              <span class="inline-flex h-7 w-7 items-center justify-center text-red-600" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                  <path d="M12 12a4.2 4.2 0 1 0-4.2-4.2A4.2 4.2 0 0 0 12 12Zm0 1.8c-3.6 0-6.8 2-6.8 5.2 0 .6.4 1 1 1h11.6c.6 0 1-.4 1-1 0-3.2-3.2-5.2-6.8-5.2Z" />
                </svg>
              </span>
              নাগরিক লগইন
            </a>
          </li>
          <li>
            <a href="{{url('/')}}/login" class="inline-flex items-center gap-2 text-white">
              <span class="inline-flex h-7 w-7 items-center justify-center text-red-600" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                  <path d="M12 12a4.2 4.2 0 1 0-4.2-4.2A4.2 4.2 0 0 0 12 12Zm0 1.8c-3.6 0-6.8 2-6.8 5.2 0 .6.4 1 1 1h11.6c.6 0 1-.4 1-1 0-3.2-3.2-5.2-6.8-5.2Z" />
                </svg>
              </span>
              অ্যাডমিন লগইন
            </a>
          </li>
          <li>
            <a href="{{url('/')}}/login" class="inline-flex items-center gap-2 text-white">
              <span class="inline-flex h-7 w-7 items-center justify-center text-red-600" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                  <path d="M12 12a4.2 4.2 0 1 0-4.2-4.2A4.2 4.2 0 0 0 12 12Zm0 1.8c-3.6 0-6.8 2-6.8 5.2 0 .6.4 1 1 1h11.6c.6 0 1-.4 1-1 0-3.2-3.2-5.2-6.8-5.2Z" />
                </svg>
              </span>
              মনিটরিং লগইন
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main>
      <section class="bg-gradient-to-b from-[#d3d9e4] to-[#e8ecf2] pt-10 pb-14 md:pt-12 md:pb-16 mb-10">
        <div class="container mx-auto max-w-none px-4 text-center overflow-visible">
          <div class="flex flex-col items-center justify-center">
            <h2 class="inline-block whitespace-nowrap text-base md:text-lg lg:text-xl font-extrabold tracking-tight text-gray-900 mb-2">
              সিটিজেন সার্ভিস ম্যানেজমেন্ট এন্ড সেন্ট্রাল রিপোর্টিং সিস্টেম
            </h2>
            <p class="inline-block whitespace-nowrap text-[10px] md:text-xs lg:text-sm text-gray-600">
              নাগরিক পোর্টালে প্রবেশ করতে প্রথমে আবেদন করুন। আবেদন অনুমোদনের পর লগইন করে সকল সেবা গ্রহণ করুন।
            </p>
          </div>
        </div>
      </section>

      <div class="container mx-auto max-w-6xl px-4 pb-20">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
          <div class="bg-gray-50 border-b border-gray-200 px-8 py-6 text-center">
            <h2 class="text-3xl font-bold text-[#046307]">নাগরিক আবেদন ফরম</h2>
            <p class="mt-2 text-gray-600 italic">সঠিক তথ্য দিয়ে ফরমটি পূরণ করুন</p>
          </div>

          <form class="p-8" id="applicationForm" enctype="multipart/form-data">
            @csrf
            
            <!-- Personal Information -->
            <div class="section-title">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                ব্যক্তিগত তথ্য
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="form-label" for="name">নাম (ইংরেজিতে) <span class="text-red-500">*</span></label>
                    <input type="text" required name="name" id="name" class="form-input" placeholder="Enter Full Name">
                    <small class="error name-error text-red-500"></small>
                </div>
                <div>
                    <label class="form-label" for="bn_name">নাম (বাংলায়) <span class="text-red-500">*</span></label>
                    <input type="text" required name="bn_name" id="bn_name" class="form-input" placeholder="নাম বাংলায় লিখুন">
                    <small class="error bn_name-error text-red-500"></small>
                </div>
                <div>
                    <label class="form-label" for="nid_no">এনআইডি নম্বর</label>
                    <input type="text" name="nid" id="nid_no" class="form-input" placeholder="NID Number">
                </div>
                <div>
                    <label class="form-label" for="birth_reg">জন্ম নিবন্ধন নম্বর</label>
                    <input type="text" name="birth_certificate" id="birth_reg" class="form-input" placeholder="Birth Certificate No">
                </div>
                <div>
                    <label class="form-label" for="date_of_birth">জন্ম তারিখ <span class="text-red-500">*</span></label>
                    <input type="date" required name="date_of_birth" id="date_of_birth" class="form-input">
                </div>
                <div>
                    <label class="form-label" for="age">বয়স (অটো ক্যালকুলেটেড)</label>
                    <input type="text" id="age" class="form-input bg-gray-50 font-semibold text-[#046307]" readonly placeholder="--">
                </div>
                <div>
                    <label class="form-label" for="birth_place">জন্মস্থান <span class="text-red-500">*</span></label>
                    <select name="birth_place" id="birth_place" class="form-input" required>
                        <option value="">জন্মস্থান নির্বাচন করুন</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label" for="gender">লিঙ্গ <span class="text-red-500">*</span></label>
                    <select name="gender" id="gender" class="form-input" required>
                        <option value="">লিঙ্গ নির্বাচন করুন</option>
                        @foreach (people_constant_option('gender') as $key => $item)
                            <option value="{{ $key }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label" for="religion">ধর্ম</label>
                    <select name="religion" id="religion" class="form-input">
                        <option value="">ধর্ম নির্বাচন করুন</option>
                        @foreach ($religions as $religion)
                            <option value="{{ $religion->id }}">{{ $religion->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label" for="marital_status">বৈবাহিক অবস্থা</label>
                    <select name="marital_status" id="marital_status" class="form-input">
                        <option value="">বৈবাহিক অবস্থা নির্বাচন করুন</option>
                        @foreach (family_constant_option('marital_status') as $key => $marital_status)
                            <option value="{{$key}}" >{{$marital_status}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Parent Info -->
            <div class="section-title">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a5.97 5.97 0 0 0-.94 3.197m0 0a5.995 5.995 0 0 0 5.058 2.771ZM12 11.25a3.375 3.375 0 1 0 0-6.75 3.375 3.375 0 0 0 0 6.75ZM9.75 8.625a2.625 2.625 0 1 1 5.25 0 2.625 2.625 0 0 1-5.25 0Z" />
                </svg>
                পিতা-মাতার তথ্য
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="form-label" for="father_name">পিতার নাম (ইংরেজিতে)</label>
                    <input type="text" name="father_name" id="father_name" class="form-input">
                </div>
                <div>
                    <label class="form-label" for="father_name_bn">পিতার নাম (বাংলায়)</label>
                    <input type="text" name="father_name_bn" id="father_name_bn" class="form-input">
                </div>
                <div>
                    <label class="form-label" for="mother_name">মাতার নাম (ইংরেজিতে)</label>
                    <input type="text" name="mother_name" id="mother_name" class="form-input">
                </div>
                <div>
                    <label class="form-label" for="mother_name_bn">মাতার নাম (বাংলায়)</label>
                    <input type="text" name="mother_name_bn" id="mother_name_bn" class="form-input">
                </div>
            </div>

            <!-- Contact & Image -->
            <div class="section-title">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                </svg>
                যোগাযোগ ও ছবি
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="form-label" for="mobile">মোবাইল নম্বর <span class="text-red-500">*</span></label>
                    <div class="flex">
                        <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-md px-3 py-2 flex items-center text-gray-600">+88</span>
                        <input type="tel" required name="mobile" id="mobile" class="form-input rounded-l-none" placeholder="017XXXXXXXX">
                    </div>
                    <small class="error mobile-error text-red-500"></small>
                </div>
                <div>
                    <label class="form-label" for="email">ই-মেইল</label>
                    <input type="email" name="email" id="email" class="form-input" placeholder="example@mail.com">
                </div>
                <div class="md:col-span-2">
                    <label class="form-label" for="image">আবেদনকারীর ছবি</label>
                    <input type="file" accept="image/*" name="image" id="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#046307] file:text-white hover:file:bg-[#0a8a0e] cursor-pointer">
                </div>
            </div>

            <!-- Permanent Address -->
            <div class="section-title">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                স্থায়ী ঠিকানা
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="form-label" for="permanent_division">বিভাগ</label>
                    <select name="permanent_division" id="permanent_division" class="form-input select2">
                        <option value="">বিভাগ নির্বাচন করুন</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label" for="permanent_district">জেলা</label>
                    <select name="permanent_district" id="permanent_district" class="form-input select2">
                        <option value="">জেলা নির্বাচন করুন</option>
                    </select>
                </div>
                <div>
                    <label class="form-label" for="permanent_thana">উপজেলা</label>
                    <select name="permanent_thana" id="permanent_thana" class="form-input select2">
                        <option value="">উপজেলা নির্বাচন করুন</option>
                    </select>
                </div>
                <div>
                    <label class="form-label" for="permanent_union">ইউনিয়ন</label>
                    <select name="permanent_union" id="permanent_union" class="form-input select2">
                        <option value="">ইউনিয়ন নির্বাচন করুন</option>
                    </select>
                </div>
                <div>
                    <label class="form-label" for="permanent_post_office_id">ডাকঘর</label>
                    <select name="permanent_post_office_id" id="permanent_post_office_id" class="form-input select2">
                        <option value="">ডাকঘর নির্বাচন করুন</option>
                        @foreach ($permanent_post_offices as $post_office)
                            <option value="{{$post_office->id}}">{{$post_office->bn_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label" for="permanent_ward">ওয়ার্ড নম্বর</label>
                    <select name="permanent_ward" id="permanent_ward" class="form-input select2">
                        <option value="">ওয়ার্ড নির্বাচন করুন</option>
                        @foreach ($wards as $ward)
                            <option value="{{ $ward->id }}">{{ $ward->en_ward_no }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label" for="permanent_village">গ্রাম</label>
                    <select id="permanent_village" name="permanent_village" class="form-input select2">
                        <option value="">গ্রাম নির্বাচন করুন</option>
                        @foreach ($permanent_villages as $village)
                            <option value="{{ $village->id }}">{{ $village->bn_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label" for="permanent_road">রাস্তা</label>
                    <input type="text" name="permanent_road" id="permanent_road" class="form-input" placeholder="Road Name/No">
                </div>
                <div>
                    <label class="form-label" for="permanent_house_no">হোল্ডিং নম্বর (বাংলায়)</label>
                    <input type="text" name="permanent_house_no" id="permanent_house_no" class="form-input" placeholder="যেমন: ১২৩">
                </div>
                <div>
                    <label class="form-label" for="permanent_house_no_en">হোল্ডিং নম্বর (ইংরেজিতে)</label>
                    <input type="text" name="permanent_house_no_en" id="permanent_house_no_en" class="form-input" placeholder="Example: 123">
                </div>
            </div>

            <!-- Present Address -->
            <div class="flex items-center justify-between section-title">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    বর্তমান ঠিকানা
                </div>
                <div class="flex items-center gap-2 text-sm font-normal text-gray-600 bg-gray-100 px-3 py-1 rounded-full border border-gray-200">
                    <input type="checkbox" name="same_present_addres" id="same_as_present_address" class="w-4 h-4 accent-[#046307]">
                    <label for="same_as_present_address" class="cursor-pointer">স্থায়ী ঠিকানার মতই?</label>
                </div>
            </div>

            <div id="same-as-permanent-address-section">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="form-label" for="present_division">বিভাগ</label>
                        <select name="present_division" id="present_division" class="form-input select2">
                            <option value="">বিভাগ নির্বাচন করুন</option>
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label" for="present_district">জেলা</label>
                        <select name="present_district" id="present_district" class="form-input select2">
                            <option value="">জেলা নির্বাচন করুন</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label" for="present_thana">উপজেলা</label>
                        <select name="present_thana" id="present_thana" class="form-input select2">
                            <option value="">উপজেলা নির্বাচন করুন</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label" for="present_union_name">ইউনিয়ন</label>
                        <select name="present_union_name" id="present_union" class="form-input select2">
                            <option value="">ইউনিয়ন নির্বাচন করুন</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label" for="present_post_office_id">ডাকঘর</label>
                        <select name="present_post_office_id" id="present_post_office_id" class="form-input select2">
                            <option value="">ডাকঘর নির্বাচন করুন</option>
                            @foreach ($permanent_post_offices as $post_office)
                                <option value="{{$post_office->id}}">{{$post_office->bn_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label" for="present_ward">ওয়ার্ড নম্বর</label>
                        <select name="present_ward" id="present_ward" class="form-input select2">
                            <option value="">ওয়ার্ড নির্বাচন করুন</option>
                            @foreach ($wards as $ward)
                                <option value="{{ $ward->id }}">{{ $ward->en_ward_no }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label" for="present_village">গ্রাম</label>
                        <select id="present_village" name="present_village" class="form-input select2">
                            <option value="">গ্রাম নির্বাচন করুন</option>
                            @foreach ($permanent_villages as $village)
                                <option value="{{ $village->id }}">{{ $village->bn_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label" for="present_road">রাস্তা</label>
                        <input type="text" name="present_road" id="present_road" class="form-input" placeholder="Road Name/No">
                    </div>
                    <div>
                        <label class="form-label" for="present_house_no">হোল্ডিং নম্বর (বাংলায়)</label>
                        <input type="text" name="present_house_no" id="present_house_no" class="form-input" placeholder="যেমন: ১২৩">
                    </div>
                    <div>
                        <label class="form-label" for="present_house_no_en">হোল্ডিং নম্বর (ইংরেজিতে)</label>
                        <input type="text" name="present_house_no_en" id="present_house_no_en" class="form-input" placeholder="Example: 123">
                    </div>
                </div>
            </div>

            <!-- Submit Section -->
            <div class="mt-12 text-center bg-gray-50 p-6 rounded-lg border border-gray-200">
                <div class="flex flex-col md:flex-row items-center justify-center gap-4 mb-6">
                    <input type="hidden" name="union_id" value="3503">
                    <a href="{{ url('/') }}" class="w-full md:w-32 text-center py-2.5 px-4 bg-gray-500 text-white font-bold rounded-md hover:bg-gray-600 transition shadow-sm">বাতিল</a>
                    <button type="reset" class="w-full md:w-32 py-2.5 px-4 bg-red-500 text-white font-bold rounded-md hover:bg-red-600 transition shadow-sm">পুনরায় শুরু</button>
                    <button type="submit" class="w-full md:w-48 py-2.5 px-6 bg-[#046307] text-white font-bold rounded-md hover:bg-[#0a8a0e] transition shadow-lg transform active:scale-95">আবেদন জমা দিন</button>
                </div>
                
                <p class="text-gray-600 text-sm">
                    আপনার কি ইতোমধ্যে অ্যাকাউন্ট আছে? 
                    <a href="{{ route('people.login') }}" class="text-[#046307] font-bold hover:underline">এখানে লগইন করুন</a>
                </p>
            </div>
          </form>

        </div>
      </div>
    </main>

    <footer class="bg-gray-800 py-8 px-4 text-white">
      <div class="max-w-screen-xl mx-auto flex flex-col md:flex-row justify-between items-center text-sm">
        <p class="mb-4 md:mb-0">© 2024 All rights reserved by <span class="font-bold text-green-400">UPMS</span></p>
        <p>Design & Maintained by <a href="https://adventuresoft.com.bd" class="text-green-400 hover:underline">Adventure Soft</a></p>
      </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%'
            });

            function calculateAge(dob) {
                if (!dob) return '';
                let birthDate = new Date(dob);
                if (Number.isNaN(birthDate.getTime())) return '';
                let today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                let monthDiff = today.getMonth() - birthDate.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                return age;
            }

            function setAgeFromDob(dob) {
                let age = calculateAge(dob);
                $('#age').val(age !== '' && age >= 0 ? age + ' years' : '');
            }

            setAgeFromDob($('#date_of_birth').val());
            $('#date_of_birth').on('change', function() {
                setAgeFromDob($(this).val());
            });

            $(document).on('change', '#same_as_present_address', function(e){
                if ($(this).is(':checked')) {
                    $("#same-as-permanent-address-section").slideUp();
                } else {
                    $("#same-as-permanent-address-section").slideDown();
                }
            });

            $(document).on('submit', "#applicationForm", function(e) {
                e.preventDefault();
                let thisForm = $(this);
                let _this_button = thisForm.find('button[type="submit"]');
                let _original_text = _this_button.text();
                
                $.ajax({
                    type: "POST",
                    url: "{{url('/')}}/api/application-store",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        _this_button.prop("disabled", true).text("অপেক্ষা করুন...");
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        setTimeout(() => {
                            location.href = response.redirect_url;
                        }, 2000);
                    },
                    error: function(xhr) {
                        _this_button.prop("disabled", false).text(_original_text);
                        let responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message || "ত্রুটি ঘটেছে!");
                        $('.error').text('');
                        $.each(responseText.errors, function(key, val) {
                            $("." + key + "-error").text(val[0]);
                        });
                    }
                });
            });

            // Dynamic Location Loading
            $(document).on('change', "#permanent_division, #permanent_district, #permanent_thana, #present_division, #present_district, #present_thana", function() {
                let _this = $(this);
                let _this_id = _this.attr('id');
                let prefix = _this_id.split("_")[0];
                let val = _this.val();

                if (_this_id.includes('division')) {
                    findDistrict(val, prefix);
                } else if (_this_id.includes('district')) {
                    findThana(val, prefix);
                } else if (_this_id.includes('thana')) {
                    findUnion(val, prefix);
                }
            });

            function findDistrict(division, prefix) {
                if (!division) return;
                $.get("{{ url('/get-districts-by-division') }}/" + division, {id: prefix}, function(res) {
                    $('#' + prefix + "_district").html(res).trigger('change');
                });
            }

            function findThana(district, prefix) {
                if (!district) return;
                $.get("{{ url('/get-thanas-by-district') }}/" + district, {id: prefix}, function(res) {
                    $('#' + prefix + "_thana").html(res).trigger('change');
                });
            }

            function findUnion(thana, prefix) {
                if (!thana) return;
                $.get("{{ url('/get-unions-by-thana') }}/" + thana, {id: prefix}, function(res) {
                    $('#' + prefix + "_union").html(res);
                });
            }
        });
    </script>
  </body>
</html>

