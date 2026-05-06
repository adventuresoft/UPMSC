<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UPMS | SUKTAIL UNION PARISHAD</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Splide CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css"
    />

    <!-- Optional: Default Theme -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/themes/splide-default.min.css"
    />

    <link rel="stylesheet" href="{{asset('assets/style/global.css')}}" />
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
      .font-bengali { font-family: 'Hind Siliguri', sans-serif; }
      body { font-family: 'Inter', sans-serif; }
    </style>

  </head>
  <body class="font-inter">
    <!-- top bar -->
    <div class="top-bar">
      <div class="container mx-auto md:px-4 px-2 max-w-screen-xl">
        <div class="flex flex-col md:flex-row justify-center items-center">
          <div class="w-full flex justify-end md:hidden">
            <button
              id="mobile-menu-btn"
              class="md:hidden p-2 text-black"
              aria-label="Open mobile menu"
              title="Open mobile menu"
            >
              <!-- Hamburger Icon -->
              <svg
                id="hamburger-icon"
                xmlns="http://www.w3.org/2000/svg"
                class="w-6 h-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="white"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"
                />
              </svg>

              <!-- Close Icon -->
              <svg
                id="close-icon"
                xmlns="http://www.w3.org/2000/svg"
                class="w-6 h-6 hidden"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>
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

          <!-- Removed Admin Login -->
        </div>
      </div>
    </div>
    <!-- Navigation -->
    <nav class="navbar md:block hidden bg-[#046307] shadow-md">
      <div class="container mx-auto max-w-screen-xl">
        <!-- Navigation Links -->
        <ul class="nav-links flex items-center justify-center gap-6 py-2 text-xs font-bold uppercase tracking-wider">
          <li class="flex items-center">
            <a href="{{url('/')}}" class="inline-flex items-center gap-2">
              <span class="inline-flex h-7 w-7 items-center justify-center rounded-full border border-white/30 text-white transition-all hover:bg-white/10" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-3.5 w-3.5">
                  <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                  <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.432z" />
                </svg>
              </span>
            </a>
          </li>
          <li><a href="{{ route('people.login') }}" class="text-white hover:opacity-80">নাগরিক লগইন</a></li>
          <li><a href="{{url('/')}}/login" class="text-white hover:opacity-80">অ্যাডমিন লগইন</a></li>
          <li><a href="{{url('/')}}/login" class="text-white hover:opacity-80">মনিটরিং লগইন</a></li>
        </ul>
      </div>
    </nav>

    <!-- Mobile Navbar -->
    <nav class="navbar md:hidden bg-white shadow-md relative">
      <div
        id="mobile-menu"
        class="fixed top-0 left-0 h-full w-72 bg-white text-gray-900 transform -translate-x-full transition-transform duration-300 ease-in-out z-50 shadow-lg"
      >
        <div class="p-4 space-y-2">
          <!-- Mobile Nav Links -->
          <a
            href="{{url('/')}}"
            class="block px-1 py-1 hover:bg-gray-100 rounded"
          >
            হোম
          </a>
          <a href="{{ route('people.login') }}" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100 rounded">
            <span class="inline-flex h-5 w-5 items-center justify-center text-red-600" aria-hidden="true">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                <path d="M12 12a4.2 4.2 0 1 0-4.2-4.2A4.2 4.2 0 0 0 12 12Zm0 1.8c-3.6 0-6.8 2-6.8 5.2 0 .6.4 1 1 1h11.6c.6 0 1-.4 1-1 0-3.2-3.2-5.2-6.8-5.2Z" />
              </svg>
            </span>
            নাগরিক লগইন
          </a>
          <a href="{{url('/')}}/login" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100 rounded">
            <span class="inline-flex h-5 w-5 items-center justify-center text-red-600" aria-hidden="true">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                <path d="M12 12a4.2 4.2 0 1 0-4.2-4.2A4.2 4.2 0 0 0 12 12Zm0 1.8c-3.6 0-6.8 2-6.8 5.2 0 .6.4 1 1 1h11.6c.6 0 1-.4 1-1 0-3.2-3.2-5.2-6.8-5.2Z" />
              </svg>
            </span>
            অ্যাডমিন লগইন
          </a>
          <a href="{{url('/')}}/login" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100 rounded">
            <span class="inline-flex h-5 w-5 items-center justify-center text-red-600" aria-hidden="true">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                <path d="M12 12a4.2 4.2 0 1 0-4.2-4.2A4.2 4.2 0 0 0 12 12Zm0 1.8c-3.6 0-6.8 2-6.8 5.2 0 .6.4 1 1 1h11.6c.6 0 1-.4 1-1 0-3.2-3.2-5.2-6.8-5.2Z" />
              </svg>
            </span>
            মনিটরিং লগইন
          </a>

        </div>
      </div>
    </nav>

    <main>
      <section class="bg-gradient-to-b from-[#d3d9e4] to-[#e8ecf2] pt-4 pb-6 md:pt-6 md:pb-8">
        <div class="container mx-auto max-w-screen-xl px-4">
          <div class="mx-auto max-w-7xl text-center font-bengali">
            <h2 class="text-lg font-bold tracking-tight text-[#1a1a1a] sm:text-xl md:text-2xl lg:text-[32px] lg:whitespace-nowrap">
              সিটিজেন সার্ভিস ম্যানেজমেন্ট এন্ড সেন্ট্রাল রিপোর্টিং সিস্টেম
            </h2>
            <p class="mx-auto mt-1 text-[10px] font-medium text-gray-700 sm:text-xs md:text-sm">
              এই প্ল্যাটফর্মে আপনি আপনার প্রয়োজনীয় সেবাগুলো পেতে পারেন।
            </p>
          </div>

          <!-- 3-Step Flow -->
          <div class="mx-auto mt-6 max-w-4xl">
            <div class="flex flex-col md:flex-row items-start justify-between relative gap-6 md:gap-0">
              <!-- Connector Lines (desktop only) -->
              <div class="hidden md:block absolute top-5 left-[10%] right-[10%] h-0.5 bg-[#046307]/20 z-0"></div>
 
              <!-- Step 1 -->
              <div class="relative z-10 flex flex-col items-center text-center w-full md:w-1/3 px-2">
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-[#046307] text-white text-lg font-black shadow-lg ring-4 ring-white">
                  ১
                </div>
                <h4 class="mt-2 text-sm font-bold text-gray-800">আবেদন করুন</h4>
                <p class="mt-0.5 text-[10px] text-gray-500 leading-tight max-w-[150px]">নাগরিক পোর্টালের জন্য আবেদন ফরম পূরণ করুন।</p>
              </div>
              <!-- Step 2 -->
              <div class="relative z-10 flex flex-col items-center text-center w-full md:w-1/3 px-2">
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-[#f59e0b] text-white text-lg font-black shadow-lg ring-4 ring-white">
                  ২
                </div>
                <h4 class="mt-2 text-sm font-bold text-gray-800">অনুমোদন পান</h4>
                <p class="mt-0.5 text-[10px] text-gray-500 leading-tight max-w-[150px]">আবেদন যাচাই হলে SMS-এ লগইন তথ্য পাবেন।</p>
              </div>
              <!-- Step 3 -->
              <div class="relative z-10 flex flex-col items-center text-center w-full md:w-1/3 px-2">
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-[#0ea5d9] text-white text-lg font-black shadow-lg ring-4 ring-white">
                  ৩
                </div>
                <h4 class="mt-2 text-sm font-bold text-gray-800">লগইন ও সেবা</h4>
                <p class="mt-0.5 text-[10px] text-gray-500 leading-tight max-w-[150px]">পোর্টালে লগইন করে সনদ, কর, ও অন্যান্য সেবা নিন।</p>
              </div>
            </div>
          </div>
 
          <!-- Action Cards -->
          <div class="mx-auto mt-8 max-w-4xl px-4">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 justify-items-center">
 
              <!-- Card: নাগরিক আবেদন -->
              <a href="{{ route('application.create') }}" class="group block w-full max-w-[190px] bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="h-1.5 bg-gradient-to-r from-[#046307] to-[#0a8a0e]"></div>
                <div class="p-3 text-center">
                  <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-lg bg-green-50 text-[#046307] group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5">
                      <path d="M12 20h9" /><path d="M16.5 3.5a2.1 2.1 0 1 1 3 3L8 18l-4 1 1-4 11.5-11.5Z" />
                    </svg>
                  </div>
                  <h3 class="mt-2 text-[11px] font-bold text-gray-800">নাগরিক আবেদন</h3>
                  <p class="mt-1 text-[8px] text-gray-500 leading-tight">নাগরিক পোর্টালে প্রবেশের জন্য আবেদন ফরম পূরণ করুন।</p>
                  <span class="mt-2 inline-flex items-center gap-1.5 text-[9px] font-bold text-[#046307] group-hover:gap-2 transition-all">
                    আবেদন করুন
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-2.5 h-2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                  </span>
                </div>
              </a>
 
              <!-- Card: সনদপত্র যাচাই -->
              <a href="{{ route('certificate.verify') }}" class="group block w-full max-w-[190px] bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="h-1.5 bg-gradient-to-r from-[#0ea5d9] to-[#0284c7]"></div>
                <div class="p-3 text-center">
                  <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-lg bg-sky-50 text-[#0ea5d9] group-hover:bg-[#0ea5d9] group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5">
                      <circle cx="11" cy="11" r="6.5" /><path d="m16 16 4.2 4.2" stroke-linecap="round" />
                    </svg>
                  </div>
                  <h3 class="mt-2 text-[11px] font-bold text-gray-800">সনদপত্র যাচাই</h3>
                  <p class="mt-1 text-[8px] text-gray-500 leading-tight">সনদপত্র নম্বর দিয়ে সনদের সত্যতা যাচাই করুন।</p>
                  <span class="mt-2 inline-flex items-center gap-1.5 text-[9px] font-bold text-[#0ea5d9] group-hover:gap-2 transition-all">
                    যাচাই করুন
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-2.5 h-2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                  </span>
                </div>
              </a>

              <!-- Card: ট্রেড লাইসেন্সের আবেদন -->
              <a href="#" class="group block w-full max-w-[190px] bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="h-1.5 bg-gradient-to-r from-[#046307] to-[#0a8a0e]"></div>
                <div class="p-3 text-center">
                  <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-lg bg-green-50 text-[#046307] group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5">
                      <path d="M12 20h9" /><path d="M16.5 3.5a2.1 2.1 0 1 1 3 3L8 18l-4 1 1-4 11.5-11.5Z" />
                    </svg>
                  </div>
                  <h3 class="mt-2 text-[11px] font-bold text-gray-800">ট্রেড লাইসেন্সের আবেদন</h3>
                  <p class="mt-1 text-[8px] text-gray-500 leading-tight">ট্রেড লাইসেন্সের আবেদন করুন।</p>
                  <span class="mt-2 inline-flex items-center gap-1.5 text-[9px] font-bold text-[#046307] group-hover:gap-2 transition-all">
                    আবেদন করুন
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-2.5 h-2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                  </span>
                </div>
              </a>

              <!-- Card: ট্রেড লাইসেন্স যাচাই -->
              <a href="#" class="group block w-full max-w-[190px] bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="h-1.5 bg-gradient-to-r from-[#0ea5d9] to-[#0284c7]"></div>
                <div class="p-3 text-center">
                  <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-lg bg-sky-50 text-[#0ea5d9] group-hover:bg-[#0ea5d9] group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5">
                      <circle cx="11" cy="11" r="6.5" /><path d="m16 16 4.2 4.2" stroke-linecap="round" />
                    </svg>
                  </div>
                  <h3 class="mt-2 text-[11px] font-bold text-gray-800">ট্রেড লাইসেন্স যাচাই</h3>
                  <p class="mt-1 text-[8px] text-gray-500 leading-tight">ট্রেড লাইসেন্স যাচাই করুন।</p>
                  <span class="mt-2 inline-flex items-center gap-1.5 text-[9px] font-bold text-[#0ea5d9] group-hover:gap-2 transition-all">
                    যাচাই করুন
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-2.5 h-2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                  </span>
                </div>
              </a>
 
            </div>
          </div>

            </div>
          </div>
        </div>
      </section>



      <section class="bg-[#efefef] py-4 md:py-6 overflow-hidden">
        <h2 class="w-full bg-[#B0E0E6] py-1.5 text-center text-lg font-bold tracking-tight text-black mb-4 md:mb-6 md:text-xl">
          এক নজরে
        </h2>
        <div class="container mx-auto max-w-4xl px-4">
          <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 justify-items-center">
            <div class="h-full w-full max-w-[190px] rounded-lg border border-[#d8dce8] bg-[#e8ebf0]/80 px-2 py-3 text-center shadow-sm">
              <div class="mx-auto flex h-10 w-10 items-center justify-center text-[#4459c2]">
                <img src="{{ asset('images/union1.jpeg') }}" alt="মোট ইউনিয়ন" class="h-10 w-10 object-contain" />
              </div>
              <h3 class="mt-2 text-[10px] font-bold tracking-tight text-[#4459c2]">মোট ইউনিয়ন</h3>
              <p class="mt-0.5 text-base font-bold tracking-tight text-[#7fbc4e]">4578</p>
            </div>
            <div class="h-full w-full max-w-[190px] rounded-lg border border-[#d8dce8] bg-[#e8ebf0]/80 px-2 py-3 text-center shadow-sm">
              <div class="mx-auto flex h-10 w-10 items-center justify-center text-[#4459c2]">
                <img src="{{ asset('images/poroshova1.jpeg') }}" alt="মোট পৌরসভা" class="h-10 w-10 object-contain" />
              </div>
              <h3 class="mt-2 text-[10px] font-bold tracking-tight text-[#4459c2]">মোট পৌরসভা</h3>
              <p class="mt-0.5 text-base font-bold tracking-tight text-[#7fbc4e]">330</p>
            </div>
            <div class="h-full w-full max-w-[190px] rounded-lg border border-[#d8dce8] bg-[#e8ebf0]/80 px-2 py-3 text-center shadow-sm">
              <div class="mx-auto flex h-10 w-10 items-center justify-center text-[#4459c2]">
                <img src="{{ asset('images/citykor1.jpeg') }}" alt="মোট সিটি কর্পোরেশন" class="h-10 w-10 object-contain" />
              </div>
              <h3 class="mt-2 text-[10px] font-bold tracking-tight text-[#4459c2]">মোট সিটি কর্পোরেশন</h3>
              <p class="mt-0.5 text-base font-bold tracking-tight text-[#7fbc4e]">13</p>
            </div>
             <div class="h-full w-full max-w-[190px] rounded-lg border border-[#d8dce8] bg-[#e8ebf0]/80 px-2 py-3 text-center shadow-sm">
              <div class="mx-auto flex h-10 w-10 items-center justify-center text-[#4459c2]">
                <img src="{{ asset('images/poroshova1.jpeg') }}" alt="মোট পৌরসভা" class="h-10 w-10 object-contain" />
              </div>
              <h3 class="mt-2 text-[10px] font-bold tracking-tight text-[#4459c2]">মোট পৌরসভা</h3>
              <p class="mt-0.5 text-base font-bold tracking-tight text-[#7fbc4e]">330</p>
            </div>
          </div>
        </div>
      </section>






      <section class="bg-[#ADD8E6] py-6 md:py-8">
        <div class="container mx-auto max-w-4xl px-4">
          <h2 class="-mt-1 mb-4 text-center text-lg font-bold tracking-tight text-[#1f3f73] md:-mt-6 md:mb-6 md:text-xl">
            প্রয়োজনীয় তথ্য
          </h2>



          <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 justify-items-center">
            <!-- Row 1 -->
            <div class="h-full w-full max-w-[190px] rounded-lg border border-[#d8dce8] bg-[#e8ebf0]/80 px-2 py-3 text-center shadow-sm">
              <div class="mx-auto flex h-10 w-10 items-center justify-center text-[#4459c2]">
                <img src="{{ asset('images/union1.jpeg') }}" alt="মোট ইউনিয়ন" class="h-10 w-10 object-contain" />
              </div>
              <h3 class="mt-2 text-[10px] font-bold tracking-tight text-[#4459c2]">মোট ইউনিয়ন</h3>
              <p class="mt-0.5 text-base font-bold tracking-tight text-[#7fbc4e]">4578</p>
            </div>
            <div class="h-full w-full max-w-[190px] rounded-lg border border-[#d8dce8] bg-[#e8ebf0]/80 px-2 py-3 text-center shadow-sm">
              <div class="mx-auto flex h-10 w-10 items-center justify-center text-[#4459c2]">
                <img src="{{ asset('images/poroshova1.jpeg') }}" alt="মোট পৌরসভা" class="h-10 w-10 object-contain" />
              </div>
              <h3 class="mt-2 text-[10px] font-bold tracking-tight text-[#4459c2]">মোট পৌরসভা</h3>
              <p class="mt-0.5 text-base font-bold tracking-tight text-[#7fbc4e]">330</p>
            </div>
            <div class="h-full w-full max-w-[190px] rounded-lg border border-[#d8dce8] bg-[#e8ebf0]/80 px-2 py-3 text-center shadow-sm">
              <div class="mx-auto flex h-10 w-10 items-center justify-center text-[#4459c2]">
                <img src="{{ asset('images/citykor1.jpeg') }}" alt="মোট সিটি কর্পোরেশন" class="h-10 w-10 object-contain" />
              </div>
              <h3 class="mt-2 text-[10px] font-bold tracking-tight text-[#4459c2]">মোট সিটি কর্পোরেশন</h3>
              <p class="mt-0.5 text-base font-bold tracking-tight text-[#7fbc4e]">13</p>
            </div>
            <div class="h-full w-full max-w-[190px] rounded-lg border border-[#d8dce8] bg-[#e8ebf0]/80 px-2 py-3 text-center shadow-sm">
              <div class="mx-auto flex h-10 w-10 items-center justify-center text-[#4459c2]">
                <img src="{{ asset('images/poroshova1.jpeg') }}" alt="মোট পৌরসভা" class="h-10 w-10 object-contain" />
              </div>
              <h3 class="mt-2 text-[10px] font-bold tracking-tight text-[#4459c2]">মোট পৌরসভা</h3>
              <p class="mt-0.5 text-base font-bold tracking-tight text-[#7fbc4e]">330</p>
            </div>
            <!-- Row 2 -->
            <div class="h-full w-full max-w-[190px] rounded-lg border border-[#d8dce8] bg-[#e8ebf0]/80 px-2 py-3 text-center shadow-sm">
              <div class="mx-auto flex h-10 w-10 items-center justify-center text-[#4459c2]">
                <img src="{{ asset('images/union1.jpeg') }}" alt="মোট ইউনিয়ন" class="h-10 w-10 object-contain" />
              </div>
              <h3 class="mt-2 text-[10px] font-bold tracking-tight text-[#4459c2]">মোট ইউনিয়ন</h3>
              <p class="mt-0.5 text-base font-bold tracking-tight text-[#7fbc4e]">4578</p>
            </div>
            <div class="h-full w-full max-w-[190px] rounded-lg border border-[#d8dce8] bg-[#e8ebf0]/80 px-2 py-3 text-center shadow-sm">
              <div class="mx-auto flex h-10 w-10 items-center justify-center text-[#4459c2]">
                <img src="{{ asset('images/poroshova1.jpeg') }}" alt="মোট পৌরসভা" class="h-10 w-10 object-contain" />
              </div>
              <h3 class="mt-2 text-[10px] font-bold tracking-tight text-[#4459c2]">মোট পৌরসভা</h3>
              <p class="mt-0.5 text-base font-bold tracking-tight text-[#7fbc4e]">330</p>
            </div>
            <div class="h-full w-full max-w-[190px] rounded-lg border border-[#d8dce8] bg-[#e8ebf0]/80 px-2 py-3 text-center shadow-sm">
              <div class="mx-auto flex h-10 w-10 items-center justify-center text-[#4459c2]">
                <img src="{{ asset('images/citykor1.jpeg') }}" alt="মোট সিটি কর্পোরেশন" class="h-10 w-10 object-contain" />
              </div>
              <h3 class="mt-2 text-[10px] font-bold tracking-tight text-[#4459c2]">মোট সিটি কর্পোরেশন</h3>
              <p class="mt-0.5 text-base font-bold tracking-tight text-[#7fbc4e]">13</p>
            </div>
            <div class="h-full w-full max-w-[190px] rounded-lg border border-[#d8dce8] bg-[#e8ebf0]/80 px-2 py-3 text-center shadow-sm">
              <div class="mx-auto flex h-10 w-10 items-center justify-center text-[#4459c2]">
                <img src="{{ asset('images/poroshova1.jpeg') }}" alt="মোট পৌরসভা" class="h-10 w-10 object-contain" />
              </div>
              <h3 class="mt-2 text-[10px] font-bold tracking-tight text-[#4459c2]">মোট পৌরসভা</h3>
              <p class="mt-0.5 text-base font-bold tracking-tight text-[#7fbc4e]">330</p>
            </div>
          </div>


          </div>
        </div>
      </section>








    </main>

    <footer class="bg-gray-300 py-3 px-4">
      <div
        class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center text-sm text-gray-800"
      >
        <!-- Left side -->
        <p class="mb-2 md:mb-0">
          © 2024 All rights reserved by
          <span class="font-medium">UPMS</span>
        </p>

        <!-- Right side -->
        <p>
          Design &amp; Maintained by
          <a href="https://adventuresoft.com.bd" class="text-blue-600 hover:underline">Adventure Soft</a>
        </p>
      </div>
    </footer>

    <!-- Splide JS -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script src="{{asset('assets/js/navbar.js')}}"></script>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        new Splide("#image-carousel", {
          type: "loop",
          perPage: 1,
          gap: "1rem",
          autoplay: false,
          pagination: false,
        }).mount();
      });
    </script>
  </body>
</html>
