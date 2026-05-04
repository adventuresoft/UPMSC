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

  </head>
  <body class="font-inter">
    <!-- top bar -->
    <div class="top-bar">
      <div class="container mx-auto md:px-4 px-2 max-w-screen-xl">
        <div class="flex flex-col md:flex-row justify-between items-center">
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
          <div class="flex flex-col md:flex-row items-center gap-10">
            <img
              src="{{asset('assets/images/logo/govt-bd-logo.png')}}"
              class="govt-logo"
              alt=""
            />
            <div class="text-black text-center md:text-left">
              <h1 class="md:text-[25px] font-semibold">
                Citizen Service Management and Central Reporting System
              </h1>
              <p>Local Government Division, Local Government Ministry, Bangladesh</p>
            </div>
          </div>

          <ul class="space-y-2 text-center md:space-y-0 mt-2 md:mt-0 md:gap-6">
            <li>
              <a href="{{url('/')}}/login" class="text-white text-lg"> Admin Login </a>
            </li>
          <!--  <li>
            <a
            href="{{url('/')}}/application"
            class="block text-center bg-gradient-to-r from-green-400 to-green-500 text-red font-bold py-1 rounded shadow hover:from-green-300 hover:to-green-400"
          >
            আবেদন করুন
            </a>
            </li> -->
          </ul>
        </div>
      </div>
    </div>
    <!-- Navigation -->
    <nav class="navbar md:block hidden bg-[#046307] shadow-md">
      <div class="container mx-auto max-w-screen-xl">
        <!-- Navigation Links -->
        <ul class="nav-links flex items-left justify-left gap-5 py-2 pl-12">

          <li class="flex items-center">
                <a href="{{url('/')}}" class="inline-flex items-center gap-2">

            <span class="inline-flex h-7 w-7 items-center justify-center text-white" aria-hidden="true">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                <path d="M12 3.1 3 10.4c-.4.3-.5.9-.2 1.3.2.3.5.4.8.4h1.4V20c0 .6.4 1 1 1h4.8c.6 0 1-.4 1-1v-4.6h2.4V20c0 .6.4 1 1 1H20c.6 0 1-.4 1-1v-7.9h1.4c.6 0 1-.4 1-.9 0-.3-.1-.6-.4-.8L12 3.1Z" />
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



          <!--<li><a class="btn btn-outline-success application-link"  href="{{url('/')}}/application">আবেদন করুন</a></li>-->
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
      <section class="bg-gradient-to-b from-[#d3d9e4] to-[#e8ecf2] pt-10 pb-14 md:pt-16 md:pb-20">
        <div class="container mx-auto max-w-screen-xl px-4">
          <div class="mx-auto max-w-3xl text-center">
            <h2 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl lg:text-4xl">
              সিটিজেন সার্ভিস ম্যানেজমেন্ট এন্ড সেন্ট্রাল রিপোর্টিং সিস্টেম
            </h2>
            <p class="mx-auto mt-4 max-w-2xl text-base leading-relaxed text-gray-600 sm:text-lg">
              নাগরিক পোর্টালে প্রবেশ করতে প্রথমে আবেদন করুন। আবেদন অনুমোদনের পর লগইন করে সকল সেবা গ্রহণ করুন।
            </p>
          </div>

          <!-- 3-Step Flow -->
          <div class="mx-auto mt-12 max-w-4xl">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-0 md:gap-0 relative">
              <!-- Connector Lines (desktop only) -->
              <div class="hidden md:block absolute top-10 left-[calc(16.66%+24px)] right-[calc(16.66%+24px)] h-0.5 bg-[#046307]/20 z-0"></div>

              <!-- Step 1 -->
              <div class="relative z-10 flex flex-col items-center text-center px-4 py-4">
                <div class="flex items-center justify-center w-16 h-16 rounded-full bg-[#046307] text-white text-2xl font-black shadow-lg ring-4 ring-white">
                  ১
                </div>
                <h4 class="mt-4 text-base font-bold text-gray-800">আবেদন করুন</h4>
                <p class="mt-1 text-sm text-gray-500 leading-relaxed">নাগরিক পোর্টালের জন্য আবেদন ফরম পূরণ করুন।</p>
              </div>
              <!-- Step 2 -->
              <div class="relative z-10 flex flex-col items-center text-center px-4 py-4">
                <div class="flex items-center justify-center w-16 h-16 rounded-full bg-[#f59e0b] text-white text-2xl font-black shadow-lg ring-4 ring-white">
                  ২
                </div>
                <h4 class="mt-4 text-base font-bold text-gray-800">অনুমোদন পান</h4>
                <p class="mt-1 text-sm text-gray-500 leading-relaxed">আবেদন যাচাই হলে SMS-এ লগইন তথ্য পাবেন।</p>
              </div>
              <!-- Step 3 -->
              <div class="relative z-10 flex flex-col items-center text-center px-4 py-4">
                <div class="flex items-center justify-center w-16 h-16 rounded-full bg-[#0ea5d9] text-white text-2xl font-black shadow-lg ring-4 ring-white">
                  ৩
                </div>
                <h4 class="mt-4 text-base font-bold text-gray-800">লগইন ও সেবা</h4>
                <p class="mt-1 text-sm text-gray-500 leading-relaxed">পোর্টালে লগইন করে সনদ, কর, ও অন্যান্য সেবা নিন।</p>
              </div>
            </div>
          </div>

          <!-- Action Cards -->
          <div class="mx-auto mt-14 max-w-5xl">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

              <!-- Card: নাগরিক আবেদন -->
              <a href="{{ route('application.create') }}" class="group block bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="h-2 bg-gradient-to-r from-[#046307] to-[#0a8a0e]"></div>
                <div class="p-7 text-center">
                  <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-2xl bg-green-50 text-[#046307] group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-10 w-10">
                      <path d="M12 20h9" /><path d="M16.5 3.5a2.1 2.1 0 1 1 3 3L8 18l-4 1 1-4 11.5-11.5Z" />
                    </svg>
                  </div>
                  <h3 class="mt-5 text-lg font-bold text-gray-800">নাগরিক আবেদন</h3>
                  <p class="mt-2 text-sm text-gray-500 leading-relaxed">নাগরিক পোর্টালে প্রবেশের জন্য আবেদন ফরম পূরণ করুন।</p>
                  <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-bold text-[#046307] group-hover:gap-3 transition-all">
                    আবেদন করুন
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                  </span>
                </div>
              </a>

              <!-- Card: নাগরিক লগইন -->
              <a href="{{ route('people.login') }}" class="group block bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="h-2 bg-gradient-to-r from-[#f59e0b] to-[#d97706]"></div>
                <div class="p-7 text-center">
                  <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-2xl bg-amber-50 text-[#f59e0b] group-hover:bg-[#f59e0b] group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-10 w-10">
                      <path d="M12 12a4.2 4.2 0 1 0-4.2-4.2A4.2 4.2 0 0 0 12 12Zm0 1.8c-3.6 0-6.8 2-6.8 5.2 0 .6.4 1 1 1h11.6c.6 0 1-.4 1-1 0-3.2-3.2-5.2-6.8-5.2Z" />
                    </svg>
                  </div>
                  <h3 class="mt-5 text-lg font-bold text-gray-800">নাগরিক লগইন</h3>
                  <p class="mt-2 text-sm text-gray-500 leading-relaxed">অনুমোদিত নাগরিকরা পোর্টালে লগইন করে সেবা নিন।</p>
                  <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-bold text-[#f59e0b] group-hover:gap-3 transition-all">
                    লগইন করুন
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                  </span>
                </div>
              </a>

              <!-- Card: সনদপত্র যাচাই -->
              <a href="{{ route('certificate.verify') }}" class="group block bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="h-2 bg-gradient-to-r from-[#0ea5d9] to-[#0284c7]"></div>
                <div class="p-7 text-center">
                  <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-2xl bg-sky-50 text-[#0ea5d9] group-hover:bg-[#0ea5d9] group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-10 w-10">
                      <circle cx="11" cy="11" r="6.5" /><path d="m16 16 4.2 4.2" stroke-linecap="round" />
                    </svg>
                  </div>
                  <h3 class="mt-5 text-lg font-bold text-gray-800">সনদপত্র যাচাই</h3>
                  <p class="mt-2 text-sm text-gray-500 leading-relaxed">সনদপত্র নম্বর দিয়ে সনদের সত্যতা যাচাই করুন।</p>
                  <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-bold text-[#0ea5d9] group-hover:gap-3 transition-all">
                    যাচাই করুন
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                  </span>
                </div>
              </a>

            </div>
          </div>
        </div>
      </section>



      <section class="bg-[#efefef] py-12 md:py-16">
        <h2 class="relative left-1/2 right-1/2 -mt-6 mb-8 -ml-[50vw] -mr-[50vw] w-screen bg-[#B0E0E6] py-3 text-center text-2xl font-bold tracking-tight text-black md:-mt-16 md:mb-10 md:text-3xl">
          Reports
        </h2>
        <div class="container mx-auto max-w-6xl px-4">
          <div class="grid grid-cols-1 justify-items-center gap-8 sm:grid-cols-2 lg:grid-cols-3 lg:gap-8">
            <div class="h-full w-full max-w-[280px] rounded-xl border border-[#d8dce8] bg-[#e8ebf0] px-6 py-8 text-center shadow-sm">
              <div class="mx-auto flex h-16 w-16 items-center justify-center text-[#4459c2]">
                <img
                  src="{{ asset('images/union1.jpeg') }}"
                  alt="মোট ইউনিয়ন"
                  class="h-12 w-12 object-contain"
                />
              </div>
              <h3 class="mt-6 text-lg font-semibold tracking-tight text-[#4459c2] md:text-xl">মোট ইউনিয়ন</h3>
              <p class="mt-3 text-2xl font-semibold tracking-tight text-[#7fbc4e] md:text-3xl">4578</p>
            </div>

            <div class="h-full w-full max-w-[280px] rounded-xl border border-[#d8dce8] bg-[#e8ebf0] px-6 py-8 text-center shadow-sm">
              <div class="mx-auto flex h-16 w-16 items-center justify-center text-[#4459c2]">
                <img
                  src="{{ asset('images/poroshova1.jpeg') }}"
                  alt="মোট পৌরসভা"
                  class="h-12 w-12 object-contain"
                />
              </div>
              <h3 class="mt-6 text-lg font-semibold tracking-tight text-[#4459c2] md:text-xl">মোট পৌরসভা</h3>
              <p class="mt-3 text-2xl font-semibold tracking-tight text-[#7fbc4e] md:text-3xl">330</p>
            </div>

            <div class="h-full w-full max-w-[280px] rounded-xl border border-[#d8dce8] bg-[#e8ebf0] px-6 py-8 text-center shadow-sm">
              <div class="mx-auto flex h-16 w-16 items-center justify-center text-[#4459c2]">
                <img
                  src="{{ asset('images/citykor1.jpeg') }}"
                  alt="মোট সিটি কর্পোরেশন"
                  class="h-12 w-12 object-contain"
                />
              </div>
              <h3 class="mt-6 text-lg font-semibold tracking-tight text-[#4459c2] md:text-xl">মোট সিটি কর্পোরেশন</h3>
              <p class="mt-3 text-2xl font-semibold tracking-tight text-[#7fbc4e] md:text-3xl">13</p>
            </div>
          </div>
        </div>
      </section>




      <section class="bg-[#ADD8E6] py-12 md:py-16">
        <div class="container mx-auto max-w-6xl px-4">
          <h2 class="-mt-2 mb-8 text-center text-2xl font-bold tracking-tight text-[#1f3f73] md:-mt-12 md:mb-10 md:text-3xl">
            প্রয়োজনীয় তথ্য
          </h2>



          <div class="grid grid-cols-1 justify-items-center gap-8 sm:grid-cols-2 lg:grid-cols-4 lg:gap-6">
            <div class="h-full w-full max-w-[280px] rounded-xl border border-[#d8dce8] bg-[#e8ebf0] px-6 py-8 text-center shadow-sm">
              <div class="mx-auto flex h-16 w-16 items-center justify-center text-[#4459c2]">
                <img
                  src="{{ asset('images/union1.jpeg') }}"
                  alt="মোট ইউনিয়ন"
                  class="h-12 w-12 object-contain"
                />
              </div>
              <h3 class="mt-6 text-lg font-semibold tracking-tight text-[#4459c2] md:text-xl">মোট ইউনিয়ন</h3>
              <p class="mt-3 text-2xl font-semibold tracking-tight text-[#7fbc4e] md:text-3xl">4578</p>
            </div>

            <div class="h-full w-full max-w-[280px] rounded-xl border border-[#d8dce8] bg-[#e8ebf0] px-6 py-8 text-center shadow-sm">
              <div class="mx-auto flex h-16 w-16 items-center justify-center text-[#4459c2]">
                <img
                  src="{{ asset('images/poroshova1.jpeg') }}"
                  alt="মোট পৌরসভা"
                  class="h-12 w-12 object-contain"
                />
              </div>
              <h3 class="mt-6 text-lg font-semibold tracking-tight text-[#4459c2] md:text-xl">মোট পৌরসভা</h3>
              <p class="mt-3 text-2xl font-semibold tracking-tight text-[#7fbc4e] md:text-3xl">330</p>
            </div>

            <div class="h-full w-full max-w-[280px] rounded-xl border border-[#d8dce8] bg-[#e8ebf0] px-6 py-8 text-center shadow-sm">
              <div class="mx-auto flex h-16 w-16 items-center justify-center text-[#4459c2]">
                <img
                  src="{{ asset('images/citykor1.jpeg') }}"
                  alt="মোট সিটি কর্পোরেশন"
                  class="h-12 w-12 object-contain"
                />
              </div>
              <h3 class="mt-6 text-lg font-semibold tracking-tight text-[#4459c2] md:text-xl">মোট সিটি কর্পোরেশন</h3>
              <p class="mt-3 text-2xl font-semibold tracking-tight text-[#7fbc4e] md:text-3xl">13</p>
            </div>

            <div class="h-full w-full max-w-[280px] rounded-xl border border-[#d8dce8] bg-[#e8ebf0] px-6 py-8 text-center shadow-sm">
              <div class="mx-auto flex h-16 w-16 items-center justify-center text-[#4459c2]">
                <img
                  src="{{ asset('images/poroshova1.jpeg') }}"
                  alt="মোট পৌরসভা"
                  class="h-12 w-12 object-contain"
                />
              </div>
              <h3 class="mt-6 text-lg font-semibold tracking-tight text-[#4459c2] md:text-xl">মোট পৌরসভা</h3>
              <p class="mt-3 text-2xl font-semibold tracking-tight text-[#7fbc4e] md:text-3xl">330</p>
            </div>


              <div class="h-full w-full max-w-[280px] rounded-xl border border-[#d8dce8] bg-[#e8ebf0] px-6 py-8 text-center shadow-sm">
              <div class="mx-auto flex h-16 w-16 items-center justify-center text-[#4459c2]">
                <img
                  src="{{ asset('images/union1.jpeg') }}"
                  alt="মোট ইউনিয়ন"
                  class="h-12 w-12 object-contain"
                />
              </div>
              <h3 class="mt-6 text-lg font-semibold tracking-tight text-[#4459c2] md:text-xl">মোট ইউনিয়ন</h3>
              <p class="mt-3 text-2xl font-semibold tracking-tight text-[#7fbc4e] md:text-3xl">4578</p>
            </div>

            <div class="h-full w-full max-w-[280px] rounded-xl border border-[#d8dce8] bg-[#e8ebf0] px-6 py-8 text-center shadow-sm">
              <div class="mx-auto flex h-16 w-16 items-center justify-center text-[#4459c2]">
                <img
                  src="{{ asset('images/poroshova1.jpeg') }}"
                  alt="মোট পৌরসভা"
                  class="h-12 w-12 object-contain"
                />
              </div>
              <h3 class="mt-6 text-lg font-semibold tracking-tight text-[#4459c2] md:text-xl">মোট পৌরসভা</h3>
              <p class="mt-3 text-2xl font-semibold tracking-tight text-[#7fbc4e] md:text-3xl">330</p>
            </div>

            <div class="h-full w-full max-w-[280px] rounded-xl border border-[#d8dce8] bg-[#e8ebf0] px-6 py-8 text-center shadow-sm">
              <div class="mx-auto flex h-16 w-16 items-center justify-center text-[#4459c2]">
                <img
                  src="{{ asset('images/citykor1.jpeg') }}"
                  alt="মোট সিটি কর্পোরেশন"
                  class="h-12 w-12 object-contain"
                />
              </div>
              <h3 class="mt-6 text-lg font-semibold tracking-tight text-[#4459c2] md:text-xl">মোট সিটি কর্পোরেশন</h3>
              <p class="mt-3 text-2xl font-semibold tracking-tight text-[#7fbc4e] md:text-3xl">13</p>
            </div>

            <div class="h-full w-full max-w-[280px] rounded-xl border border-[#d8dce8] bg-[#e8ebf0] px-6 py-8 text-center shadow-sm">
              <div class="mx-auto flex h-16 w-16 items-center justify-center text-[#4459c2]">
                <img
                  src="{{ asset('images/poroshova1.jpeg') }}"
                  alt="মোট পৌরসভা"
                  class="h-12 w-12 object-contain"
                />
              </div>
              <h3 class="mt-6 text-lg font-semibold tracking-tight text-[#4459c2] md:text-xl">মোট পৌরসভা</h3>
              <p class="mt-3 text-2xl font-semibold tracking-tight text-[#7fbc4e] md:text-3xl">330</p>
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
