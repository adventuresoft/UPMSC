@extends('frontend.master')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CLMS || CLMS </title>
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Splide CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" />

  <!-- Optional: Default Theme -->
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/themes/splide-default.min.css" />

  <link rel="stylesheet" href="{{asset('assets/style/global.css')}}?v={{ time() }}" />
  <link rel="stylesheet" href="{{asset('assets/style/upms-theme.css')}}?v={{ time() }}" />
  <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">
  <style>
    .font-bengali {
      font-family: 'Hind Siliguri', sans-serif;
    }

    body {
      font-family: 'Inter', sans-serif;
    }
  </style>

</head>

<body class="font-inter">
  <!-- top bar -->
  <div class="top-bar">
    
  </div>
  <!-- Navigation -->
  <nav class="md:block hidden bg-[#046307]">
    <div class="container mx-auto px-5 max-w-[1200px]">
      <!-- Navigation Links -->
      <ul
        class="nav-links flex items-center md:justify-start justify-center gap-10 py-1.5 leading-none text-xs font-bold uppercase tracking-wider">
        <li class="flex items-center">
          <a href="{{url('/')}}" class="inline-flex items-center gap-2">
            <span
              class="inline-flex h-6 w-6 items-center justify-center rounded border border-white/30 text-white transition-all hover:bg-gray/10"
              aria-hidden="true">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                <path
                  d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                <path
                  d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.432z" />
              </svg>
            </span>
          </a>
        </li>
        @if(Auth::guard('people')->check())
          <li class="relative">
            <button type="button" onclick="document.getElementById('citizenDropdown').classList.toggle('hidden')"
              class="text-white hover:opacity-80 flex items-center gap-1 focus:outline-none user-dropdown-btn">
              {{ Auth::guard('people')->user()->name ?: Auth::guard('people')->user()->bn_name ?: 'আমার প্রোফাইল' }}
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div id="citizenDropdown"
              class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden z-50 text-gray-800 user-dropdown-menu"
              style="text-transform: none;">
              <a href="{{ route('people.dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">ড্যাশবোর্ড</a>
              <a href="{{ route('people.profile') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">প্রোফাইল</a>
              <form method="POST" action="{{ route('people.logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">লগআউট</button>
              </form>
            </div>
          </li>
        @else
          <li><a href="{{ route('people.login') }}" target="_blank" class="text-white hover:opacity-80 flex items-center gap-2"><span
                class="text-red-500"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                  class="h-4 w-4">
                  <path
                    d="M12 12a4.2 4.2 0 1 0-4.2-4.2A4.2 4.2 0 0 0 12 12Zm0 1.8c-3.6 0-6.8 2-6.8 5.2 0 .6.4 1 1 1h11.6c.6 0 1-.4 1-1 0-3.2-3.2-5.2-6.8-5.2Z" />
                </svg></span>নাগরিক লগইন</a></li>
        @endif

        @if(Auth::check())
          <li class="relative">
            <button type="button" onclick="document.getElementById('adminDropdown').classList.toggle('hidden')"
              class="text-white hover:opacity-80 flex items-center gap-1 focus:outline-none user-dropdown-btn">
              {{ Auth::user()->name ?: 'অ্যাডমিন প্রোফাইল' }}
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div id="adminDropdown"
              class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden z-50 text-gray-800 user-dropdown-menu"
              style="text-transform: none;">
              <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">ড্যাশবোর্ড</a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">লগআউট</button>
              </form>
            </div>
          </li>
        @else
          <li><a href="{{url('/')}}/login" target="_blank" class="text-white hover:opacity-80 flex items-center gap-2"><span
                class="text-red-500"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                  class="h-4 w-4">
                  <path
                    d="M12 12a4.2 4.2 0 1 0-4.2-4.2A4.2 4.2 0 0 0 12 12Zm0 1.8c-3.6 0-6.8 2-6.8 5.2 0 .6.4 1 1 1h11.6c.6 0 1-.4 1-1 0-3.2-3.2-5.2-6.8-5.2Z" />
                </svg></span>অ্যাডমিন লগইন</a></li>
          <li><a href="{{url('/')}}/login" target="_blank" class="text-white hover:opacity-80 flex items-center gap-2"><span
                class="text-red-500"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                  class="h-4 w-4">
                  <path
                    d="M12 12a4.2 4.2 0 1 0-4.2-4.2A4.2 4.2 0 0 0 12 12Zm0 1.8c-3.6 0-6.8 2-6.8 5.2 0 .6.4 1 1 1h11.6c.6 0 1-.4 1-1 0-3.2-3.2-5.2-6.8-5.2Z" />
                </svg></span>মনিটরিং লগইন</a></li>
        @endif
      </ul>
    </div>
  </nav>

  <!-- Mobile Header -->
  <div class="md:hidden bg-[#046307] text-white flex items-center justify-between px-4 h-[60px] shadow-md sticky top-0 z-[60]">
    <a href="{{url('/')}}" class="flex items-center gap-2 font-bold text-lg font-bengali">
      <span class="inline-flex h-8 w-8 items-center justify-center rounded bg-white/10 border border-white/20 text-white">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
          <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
          <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.432z" />
        </svg>
      </span>
      সার্টিফিকেট পোর্টাল
    </a>
    <button id="mobile-menu-btn" class="focus:outline-none bg-white/10 hover:bg-white/20 p-2 rounded-lg transition-colors">
      <svg id="hamburger-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
      </svg>
      <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </button>
  </div>

  <!-- Mobile Navbar Menu -->
  <nav class="md:hidden relative z-[70]">
    <div id="mobile-menu"
      class="fixed top-0 left-0 h-full w-72 bg-slate-50 text-gray-900 transform -translate-x-full transition-transform duration-300 ease-in-out shadow-2xl border-r border-gray-200 overflow-y-auto z-[70]">
      <div class="p-5 flex flex-col space-y-5">
        
        <!-- Navigation Links -->
        <div class="space-y-1">
          <a href="{{url('/')}}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-700 bg-white shadow-sm border border-gray-100 hover:border-[#046307] hover:text-[#046307] transition-colors font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#046307]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
            হোমপেজ
          </a>
        </div>

        @if(Auth::guard('people')->check())
          <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-4 border border-green-200 shadow-sm">
            <div class="flex items-center gap-3 mb-4">
              <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#046307] to-green-600 text-white flex items-center justify-center font-bold text-lg shadow-inner">
                {{ mb_substr(Auth::guard('people')->user()->name, 0, 1) }}
              </div>
              <div>
                <div class="font-bold text-gray-800 text-sm">{{ Auth::guard('people')->user()->name }}</div>
                <div class="text-[10px] uppercase tracking-wider font-semibold text-green-700">নাগরিক প্রোফাইল</div>
              </div>
            </div>
            <div class="space-y-2">
              <a href="{{ route('people.dashboard') }}" class="flex items-center gap-2 text-sm text-gray-700 hover:text-[#046307] bg-white px-3 py-2 rounded-lg shadow-sm border border-gray-100 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                ড্যাশবোর্ড
              </a>
              <a href="{{ route('people.profile') }}" class="flex items-center gap-2 text-sm text-gray-700 hover:text-[#046307] bg-white px-3 py-2 rounded-lg shadow-sm border border-gray-100 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                প্রোফাইল
              </a>
            </div>
            <form method="POST" action="{{ route('people.logout') }}" class="mt-3">
              @csrf
              <button type="submit" class="w-full flex justify-center items-center gap-2 text-sm text-red-600 bg-red-50 hover:bg-red-100 px-3 py-2 rounded-lg transition-colors font-semibold border border-red-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                লগআউট
              </button>
            </form>
          </div>
        @elseif(Auth::check())
          <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-200 shadow-sm">
            <div class="flex items-center gap-3 mb-4">
              <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white flex items-center justify-center font-bold text-lg shadow-inner">
                {{ mb_substr(Auth::user()->name, 0, 1) }}
              </div>
              <div>
                <div class="font-bold text-gray-800 text-sm">{{ Auth::user()->name }}</div>
                <div class="text-[10px] uppercase tracking-wider font-semibold text-blue-700">অ্যাডমিন প্রোফাইল</div>
              </div>
            </div>
            <div class="space-y-2">
              <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-sm text-gray-700 hover:text-blue-700 bg-white px-3 py-2 rounded-lg shadow-sm border border-gray-100 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                ড্যাশবোর্ড
              </a>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
              @csrf
              <button type="submit" class="w-full flex justify-center items-center gap-2 text-sm text-red-600 bg-red-50 hover:bg-red-100 px-3 py-2 rounded-lg transition-colors font-semibold border border-red-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                লগআউট
              </button>
            </form>
          </div>
        @else
          <!-- Action Buttons -->
          <div>
            <div class="text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-3 px-1">লগইন প্যানেল</div>
            <div class="space-y-3">
              <a href="{{ route('people.login') }}" target="_blank" class="group relative flex items-center justify-between bg-white border border-gray-200 p-3 rounded-xl shadow-sm hover:shadow-md hover:border-[#046307] transition-all duration-300 overflow-hidden">
                <div class="absolute left-0 top-0 w-1.5 h-full bg-gradient-to-b from-[#046307] to-green-500"></div>
                <div class="flex items-center gap-3 pl-3">
                  <div class="bg-green-50 p-2.5 rounded-lg text-[#046307] group-hover:bg-[#046307] group-hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                      <path d="M12 12a4.2 4.2 0 1 0-4.2-4.2A4.2 4.2 0 0 0 12 12Zm0 1.8c-3.6 0-6.8 2-6.8 5.2 0 .6.4 1 1 1h11.6c.6 0 1-.4 1-1 0-3.2-3.2-5.2-6.8-5.2Z" />
                    </svg>
                  </div>
                  <div>
                    <div class="font-bold text-gray-800 text-[13px]">নাগরিক লগইন</div>
                    <div class="text-[10px] text-gray-500 mt-0.5">সাধারণ নাগরিকদের জন্য</div>
                  </div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-300 group-hover:text-[#046307] group-hover:translate-x-1 transition-all mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
              </a>

              <a href="{{url('/')}}/login" target="_blank" class="group relative flex items-center justify-between bg-white border border-gray-200 p-3 rounded-xl shadow-sm hover:shadow-md hover:border-blue-600 transition-all duration-300 overflow-hidden">
                <div class="absolute left-0 top-0 w-1.5 h-full bg-gradient-to-b from-blue-600 to-sky-500"></div>
                <div class="flex items-center gap-3 pl-3">
                  <div class="bg-blue-50 p-2.5 rounded-lg text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                      <path fill-rule="evenodd" d="M11.986 3H12a2 2 0 0 1 2 2v6a2 2 0 0 1-1.5 1.937V7h-1v5.937A2 2 0 0 1 10 11V5a2 2 0 0 1 1.986-2Zm-3.9 14.882a8.014 8.014 0 0 0 7.828 0A4.015 4.015 0 0 0 18.066 14H19a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h.934a4.016 4.016 0 0 0 2.152 3.882ZM6.444 12H5a2 2 0 0 0-2 2v1h1.564a5.986 5.986 0 0 1 1.88-3Zm11.112 0a5.986 5.986 0 0 1 1.88 3H21v-1a2 2 0 0 0-2-2h-1.444Z" clip-rule="evenodd" />
                    </svg>
                  </div>
                  <div>
                    <div class="font-bold text-gray-800 text-[13px]">অ্যাডমিন লগইন</div>
                    <div class="text-[10px] text-gray-500 mt-0.5">প্রশাসনিক কাজের জন্য</div>
                  </div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-300 group-hover:text-blue-600 group-hover:translate-x-1 transition-all mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
              </a>

              <a href="{{url('/')}}/login" target="_blank" class="group relative flex items-center justify-between bg-white border border-gray-200 p-3 rounded-xl shadow-sm hover:shadow-md hover:border-purple-600 transition-all duration-300 overflow-hidden">
                <div class="absolute left-0 top-0 w-1.5 h-full bg-gradient-to-b from-purple-600 to-fuchsia-500"></div>
                <div class="flex items-center gap-3 pl-3">
                  <div class="bg-purple-50 p-2.5 rounded-lg text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                      <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                      <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                    </svg>
                  </div>
                  <div>
                    <div class="font-bold text-gray-800 text-[13px]">মনিটরিং লগইন</div>
                    <div class="text-[10px] text-gray-500 mt-0.5">তদারকির জন্য</div>
                  </div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-300 group-hover:text-purple-600 group-hover:translate-x-1 transition-all mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
              </a>
            </div>
          </div>
        @endif

      </div>
    </div>
  </nav>

  <main>
    <!-- Hero & Main Services Section -->
    <section class="bg-gradient-to-b from-[#e6fcf5] via-[#f0fdf4] to-white pt-0 pb-2 md:pt-1 md:pb-2 relative overflow-hidden">
      <!-- Decorative background glow / subtle abstract greenery -->
      <div class="absolute top-0 right-0 w-96 h-96 bg-emerald-300/20 rounded-full blur-3xl pointer-events-none -mr-20 -mt-20"></div>
      <div class="absolute bottom-10 left-10 w-72 h-72 bg-teal-200/20 rounded-full blur-3xl pointer-events-none"></div>

      <div class="container mx-auto max-w-[1200px] px-5 relative z-1">
        
        <!-- Hero Top Row -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start pt-6 lg:pt-8">
          
          <!-- Left Column: Title, Subtitle, Buttons -->
          <div class="lg:col-span-7 text-left font-bengali">
            <h1 class="text-base sm:text-lg md:text-xl lg:text-[22px] xl:text-[24px] font-extrabold tracking-tight leading-snug text-[#111827] whitespace-normal sm:whitespace-nowrap">
              সার্টিফিকেট ও লাইসেন্স <span class="text-[#046307]">ম্যানেজমেন্ট সলিউশন</span>
            </h1>
            
            <p class="mt-1.5 sm:mt-2 text-[11px] sm:text-xs md:text-[13px] font-normal text-gray-600 max-w-xl leading-relaxed">
              স্থানীয় সরকারের বিভিন্ন পরিদপ্তরের সার্টিফিকেট ও লাইসেন্স সংক্রান্ত সেবা সহজ, দ্রুত ও নিরাপদ উপায়ে গ্রহণ করুন। এই প্ল্যাটফর্মে আপনি আপনার প্রয়োজনীয় সেবাগুলো পেতে পারেন।
            </p>

            <!-- Buttons -->
            <div class="mt-5 flex flex-wrap items-center justify-start gap-3 sm:gap-4">
              <!-- Button 1: আবেদন করুন -->
              <a href="{{ route('application.create') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl sm:rounded-2xl bg-[#046307] hover:bg-[#034a05] text-white font-bold text-xs sm:text-sm md:text-base shadow-lg shadow-green-700/25 transition-all duration-300 transform hover:-translate-y-0.5 group">
                <span>আবেদন করুন</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
              </a>

              <!-- Button 2: আবেদন স্ট্যাটাস চেক করুন -->
              <a href="{{ route('certificate.verify') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl sm:rounded-2xl bg-white hover:bg-green-50/60 text-gray-800 font-bold text-xs sm:text-sm md:text-base border border-gray-200 shadow-sm hover:shadow hover:border-green-300 transition-all duration-300 group">
                <span>আবেদন স্ট্যাটাস চেক করুন</span>
                <span class="text-[#046307] p-1 bg-green-50 rounded-lg group-hover:bg-[#046307] group-hover:text-white transition-colors">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </span>
              </a>
            </div>
          </div>

          <!-- Right Column: Certificate Podium Illustration -->
          <div class="lg:col-span-5 flex justify-center items-start pt-0 pb-0 relative">
            <!-- Floating Decorative Leaves -->
            <div class="absolute top-2 left-6 sm:left-12 text-emerald-400/60 animate-bounce" style="animation-duration: 4s;">
              <svg class="w-10 h-10 transform -rotate-45" fill="currentColor" viewBox="0 0 24 24"><path d="M17 8C8 10 5 16 5 22C11 22 17 19 19 10C19.5 7.5 18.5 5.5 17 8Z"/></svg>
            </div>
            <div class="absolute bottom-12 right-6 sm:right-12 text-teal-500/50 animate-bounce" style="animation-duration: 5s;">
              <svg class="w-12 h-12 transform rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M17 8C8 10 5 16 5 22C11 22 17 19 19 10C19.5 7.5 18.5 5.5 17 8Z"/></svg>
            </div>

            <!-- Illustration Container -->
            <div class="relative flex flex-col items-center">
              
              <!-- Certificate Paper -->
              <div class="w-56 sm:w-64 bg-white rounded-2xl p-6 shadow-[0_20px_50px_rgba(4,99,7,0.15)] border border-green-100/80 transform rotate-1 hover:rotate-0 transition-transform duration-500 relative z-10 mb-[-20px]">
                <div class="text-center mb-5">
                  <span class="font-serif font-bold text-gray-800 tracking-wider text-base border-b-2 border-emerald-500/30 pb-0.5 px-3">Certificate</span>
                </div>
                <!-- Dummy lines -->
                <div class="space-y-2.5 mb-6">
                  <div class="h-1.5 bg-gray-200/80 rounded-full w-full"></div>
                  <div class="h-1.5 bg-gray-200/80 rounded-full w-5/6 mx-auto"></div>
                  <div class="h-1.5 bg-gray-200/80 rounded-full w-4/6 mx-auto"></div>
                  <div class="h-1.5 bg-gray-200/80 rounded-full w-3/4 mx-auto"></div>
                </div>
                
                <!-- Bottom Seal & Signature -->
                <div class="flex items-end justify-between pt-2">
                  <!-- Green Ribbon Badge -->
                  <div class="relative flex flex-col items-center">
                    <div class="w-11 h-11 rounded-full bg-gradient-to-tr from-[#046307] to-emerald-500 flex items-center justify-center text-white shadow-md relative z-10 border-2 border-white">
                      <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <!-- Ribbons hanging down -->
                    <div class="flex gap-1 -mt-2 relative z-0">
                      <div class="w-2.5 h-6 bg-emerald-700 transform -rotate-12 rounded-b-sm"></div>
                      <div class="w-2.5 h-6 bg-emerald-600 transform rotate-12 rounded-b-sm"></div>
                    </div>
                  </div>

                  <!-- Signature -->
                  <div class="text-right">
                    <div class="font-serif italic text-gray-400 text-sm tracking-wide border-b border-gray-300 pb-0.5 px-2">John Doe</div>
                  </div>
                </div>
              </div>

              <!-- Podium Base Layer 1 -->
              <div class="w-64 sm:w-80 h-14 bg-gradient-to-r from-emerald-500 via-[#046307] to-teal-600 rounded-[50%] shadow-xl border-4 border-emerald-100 relative z-0 flex items-center justify-center"></div>
              <!-- Podium Base Layer 2 (Shadow floor) -->
              <div class="w-72 sm:w-96 h-10 bg-emerald-200/40 rounded-[50%] -mt-8 -z-10 blur-sm"></div>
            </div>
          </div>

        </div>

        <!-- 4 Feature Cards Grid (Compact & Professional) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 mt-6 lg:mt-8 font-bengali">
          
          <!-- Card 1: সার্টিফিকেট আবেদন -->
          <div class="bg-white rounded-2xl p-4 sm:p-5 shadow hover:shadow-xl border border-gray-100 hover:border-green-300 transition-all duration-300 flex flex-col justify-between group transform hover:-translate-y-1">
            <div>
              <!-- Header: Icon + Title -->
              <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform duration-300">
                  <div class="w-7 h-7 rounded-lg bg-[#046307] text-white flex items-center justify-center shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                  </div>
                </div>
                <h3 class="text-base font-bold text-gray-800 group-hover:text-[#046307] transition-colors leading-tight">সার্টিফিকেট আবেদন</h3>
              </div>
              <p class="text-xs text-gray-500 leading-relaxed mb-4">বিভিন্ন ধরনের সার্টিফিকেটের জন্য অনলাইনে আবেদন করুন</p>
            </div>

            <a href="{{ route('application.create') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#046307] group-hover:gap-2 transition-all pt-2 border-t border-gray-50">
              <span>আবেদন করুন</span>
              <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
          </div>

          <!-- Card 2: সার্টিফিকেট যাচাই -->
          <div class="bg-white rounded-2xl p-4 sm:p-5 shadow hover:shadow-xl border border-gray-100 hover:border-sky-300 transition-all duration-300 flex flex-col justify-between group transform hover:-translate-y-1">
            <div>
              <!-- Header: Icon + Title -->
              <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-xl bg-sky-100 flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform duration-300">
                  <div class="w-7 h-7 rounded-lg bg-[#0284c7] text-white flex items-center justify-center shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="6.5"/><path d="m16 16 4.2 4.2" stroke-linecap="round"/></svg>
                  </div>
                </div>
                <h3 class="text-base font-bold text-gray-800 group-hover:text-[#0284c7] transition-colors leading-tight">সার্টিফিকেট যাচাই</h3>
              </div>
              <p class="text-xs text-gray-500 leading-relaxed mb-4">সার্টিফিকেটের সত্যতা যাচাই করুন অনলাইনের মাধ্যমে</p>
            </div>

            <a href="{{ route('certificate.verify') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0284c7] group-hover:gap-2 transition-all pt-2 border-t border-gray-50">
              <span>যাচাই করুন</span>
              <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
          </div>

          <!-- Card 3: ট্রেড লাইসেন্স আবেদন -->
          <div class="bg-white rounded-2xl p-4 sm:p-5 shadow hover:shadow-xl border border-gray-100 hover:border-purple-300 transition-all duration-300 flex flex-col justify-between group transform hover:-translate-y-1">
            <div>
              <!-- Header: Icon + Title -->
              <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform duration-300">
                  <div class="w-7 h-7 rounded-lg bg-[#7e22ce] text-white flex items-center justify-center shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                  </div>
                </div>
                <h3 class="text-base font-bold text-gray-800 group-hover:text-[#7e22ce] transition-colors leading-tight">ট্রেড লাইসেন্স আবেদন</h3>
              </div>
              <p class="text-xs text-gray-500 leading-relaxed mb-4">ট্রেড লাইসেন্সের জন্য অনলাইনে আবেদন করুন</p>
            </div>

            <a href="{{ route('public.organization.create') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#7e22ce] group-hover:gap-2 transition-all pt-2 border-t border-gray-50">
              <span>আবেদন করুন</span>
              <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
          </div>

          <!-- Card 4: ট্রেড লাইসেন্স যাচাই -->
          <div class="bg-white rounded-2xl p-4 sm:p-5 shadow hover:shadow-xl border border-gray-100 hover:border-orange-300 transition-all duration-300 flex flex-col justify-between group transform hover:-translate-y-1">
            <div>
              <!-- Header: Icon + Title -->
              <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform duration-300">
                  <div class="w-7 h-7 rounded-lg bg-[#ea580c] text-white flex items-center justify-center shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="6.5"/><path d="m16 16 4.2 4.2" stroke-linecap="round"/></svg>
                  </div>
                </div>
                <h3 class="text-base font-bold text-gray-800 group-hover:text-[#ea580c] transition-colors leading-tight">ট্রেড লাইসেন্স যাচাই</h3>
              </div>
              <p class="text-xs text-gray-500 leading-relaxed mb-4">ট্রেড লাইসেন্সের সত্যতা যাচাই করুন</p>
            </div>

            <a href="#" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ea580c] group-hover:gap-2 transition-all pt-2 border-t border-gray-50">
              <span>যাচাই করুন</span>
              <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
          </div>

        </div>

      </div>
    </section>



    <!-- এক নজরে আমাদের সেবা (Banner Section) -->
    <section class="container mx-auto max-w-[1200px] px-5 mt-4 sm:mt-5 md:mt-6 mb-6 md:mb-8">
      <div class="bg-gradient-to-r from-[#034A38] via-[#045C45] to-[#034A38] text-white rounded-2xl p-5 sm:p-6 md:p-7 shadow-lg border border-emerald-600/40 relative overflow-hidden">
        <!-- Subtle background glow -->
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none"></div>
        
        <div class="flex flex-col lg:flex-row items-center justify-between gap-6 relative z-10">
          <!-- Left side: Title & Subtitle -->
          <div class="text-center lg:text-left">
            <div class="inline-flex items-center justify-center lg:justify-start gap-2.5">
              <span class="flex h-2.5 w-2.5 relative">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-300 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-400"></span>
              </span>
              <h2 class="text-lg sm:text-xl md:text-2xl font-bold font-bengali tracking-wide text-white drop-shadow-sm">
                এক নজরে আমাদের সেবা
              </h2>
            </div>
            <p class="text-xs sm:text-[13px] text-emerald-100/80 font-bengali mt-1 max-w-xs mx-auto lg:mx-0 leading-relaxed">ডিজিটাল প্ল্যাটফর্মে রিয়েল-টাইম সেবার পরিসংখ্যান</p>
          </div>

          <!-- Right side: Statistics & Chart -->
          <div class="flex flex-wrap items-center justify-center lg:justify-end gap-3 sm:gap-5">
            <!-- Stat 1 -->
            <div class="flex items-center gap-3 bg-white/5 hover:bg-white/10 px-3.5 py-2.5 rounded-xl transition-all border border-white/10 shadow-sm">
              <div class="w-10 h-10 rounded-xl bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center text-emerald-300 shrink-0 shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
              </div>
              <div class="text-left font-bengali">
                <div class="text-lg sm:text-xl font-bold text-white font-inter tracking-tight leading-none">4,578</div>
                <div class="text-[11px] sm:text-xs font-medium text-emerald-100/90 mt-1">মোট ইস্যু সনদ</div>
              </div>
            </div>

            <!-- Stat 2 -->
            <div class="flex items-center gap-3 bg-white/5 hover:bg-white/10 px-3.5 py-2.5 rounded-xl transition-all border border-white/10 shadow-sm">
              <div class="w-10 h-10 rounded-xl bg-sky-500/20 border border-sky-400/30 flex items-center justify-center text-sky-300 shrink-0 shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
              </div>
              <div class="text-left font-bengali">
                <div class="text-lg sm:text-xl font-bold text-white font-inter tracking-tight leading-none">330</div>
                <div class="text-[11px] sm:text-xs font-medium text-sky-100/90 mt-1">মোট পৌরসভা</div>
              </div>
            </div>

            <!-- Stat 3 -->
            <div class="flex items-center gap-3 bg-white/5 hover:bg-white/10 px-3.5 py-2.5 rounded-xl transition-all border border-white/10 shadow-sm">
              <div class="w-10 h-10 rounded-xl bg-amber-500/20 border border-amber-400/30 flex items-center justify-center text-amber-300 shrink-0 shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
              </div>
              <div class="text-left font-bengali">
                <div class="text-lg sm:text-xl font-bold text-white font-inter tracking-tight leading-none">13</div>
                <div class="text-[11px] sm:text-xs font-medium text-amber-100/90 mt-1">মোট সিটি কর্পোরেশন</div>
              </div>
            </div>

            <!-- Glowing Chart Icon -->
            <div class="hidden xl:flex items-center pl-3 border-l border-white/10 text-cyan-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 drop-shadow-[0_0_8px_rgba(6,182,212,0.6)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
              </svg>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- প্রয়োজনীয় সেবাসমূহ (Essential Services Grid) -->
    <section class="container mx-auto max-w-[1200px] px-5 my-6 md:my-8">
      <!-- Heading with decorative dashes -->
      <div class="text-center mb-2 md:mb-2.5">
        <div class="inline-flex items-center justify-center gap-2.5 sm:gap-3">
          <span class="h-[1.5px] w-10 sm:w-16 md:w-24 bg-gradient-to-r from-transparent to-green-600/50"></span>
          <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-[#111827] font-bengali tracking-tight">প্রয়োজনীয় সেবাসমূহ</h2>
          <span class="h-[1.5px] w-10 sm:w-16 md:w-24 bg-gradient-to-l from-transparent to-green-600/50"></span>
        </div>
        <div class="flex items-center justify-center gap-1.5 mt-1.5 text-[#046307]/80">
          <span class="inline-block w-1 h-1 rounded-full bg-[#046307]/40"></span>
          <span class="text-[10px] font-bold tracking-widest text-[#046307]">❖</span>
          <span class="inline-block w-1 h-1 rounded-full bg-[#046307]/40"></span>
        </div>
      </div>

      <!-- Container Box -->
      <div class="bg-gradient-to-b from-green-50/70 via-white to-white border border-green-200/80 rounded-2xl p-4 sm:p-6 md:p-7 shadow-sm">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2.5 sm:gap-3.5">
          
          <!-- 1. জন্মসনদ সংগ্রহ -->
          <a href="#" class="group flex items-center gap-2.5 bg-white border border-green-100/90 rounded-xl p-2.5 sm:p-3 shadow-sm hover:shadow hover:border-[#046307] hover:bg-green-50/40 transition-all duration-300 transform hover:-translate-y-0.5">
            <div class="w-10 h-10 rounded-xl bg-[#e8f5e9] flex items-center justify-center text-[#046307] shrink-0 group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300 shadow-inner">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <span class="text-[11.5px] sm:text-xs font-semibold text-gray-700 group-hover:text-[#046307] transition-colors font-bengali leading-tight">জন্মসনদ সংগ্রহ</span>
          </a>

          <!-- 2. মৃত্যুসনদ সংগ্রহ -->
          <a href="#" class="group flex items-center gap-2.5 bg-white border border-green-100/90 rounded-xl p-2.5 sm:p-3 shadow-sm hover:shadow hover:border-[#046307] hover:bg-green-50/40 transition-all duration-300 transform hover:-translate-y-0.5">
            <div class="w-10 h-10 rounded-xl bg-[#e8f5e9] flex items-center justify-center text-[#046307] shrink-0 group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300 shadow-inner">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <span class="text-[11.5px] sm:text-xs font-semibold text-gray-700 group-hover:text-[#046307] transition-colors font-bengali leading-tight">মৃত্যুসনদ সংগ্রহ</span>
          </a>

          <!-- 3. বিবাহ সনদ সংগ্রহ -->
          <a href="#" class="group flex items-center gap-2.5 bg-white border border-green-100/90 rounded-xl p-2.5 sm:p-3 shadow-sm hover:shadow hover:border-[#046307] hover:bg-green-50/40 transition-all duration-300 transform hover:-translate-y-0.5">
            <div class="w-10 h-10 rounded-xl bg-[#e8f5e9] flex items-center justify-center text-[#046307] shrink-0 group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300 shadow-inner">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
            </div>
            <span class="text-[11.5px] sm:text-xs font-semibold text-gray-700 group-hover:text-[#046307] transition-colors font-bengali leading-tight">বিবাহ সনদ সংগ্রহ</span>
          </a>

          <!-- 4. তালাক সনদ সংগ্রহ -->
          <a href="#" class="group flex items-center gap-2.5 bg-white border border-green-100/90 rounded-xl p-2.5 sm:p-3 shadow-sm hover:shadow hover:border-[#046307] hover:bg-green-50/40 transition-all duration-300 transform hover:-translate-y-0.5">
            <div class="w-10 h-10 rounded-xl bg-[#e8f5e9] flex items-center justify-center text-[#046307] shrink-0 group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300 shadow-inner">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <span class="text-[11.5px] sm:text-xs font-semibold text-gray-700 group-hover:text-[#046307] transition-colors font-bengali leading-tight">তালাক সনদ সংগ্রহ</span>
          </a>

          <!-- 5. উত্তরাধিকার সনদ -->
          <a href="#" class="group flex items-center gap-2.5 bg-white border border-green-100/90 rounded-xl p-2.5 sm:p-3 shadow-sm hover:shadow hover:border-[#046307] hover:bg-green-50/40 transition-all duration-300 transform hover:-translate-y-0.5">
            <div class="w-10 h-10 rounded-xl bg-[#e8f5e9] flex items-center justify-center text-[#046307] shrink-0 group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300 shadow-inner">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <span class="text-[11.5px] sm:text-xs font-semibold text-gray-700 group-hover:text-[#046307] transition-colors font-bengali leading-tight">উত্তরাধিকার সনদ</span>
          </a>

          <!-- 6. হোল্ডিং সনদ -->
          <a href="#" class="group flex items-center gap-2.5 bg-white border border-green-100/90 rounded-xl p-2.5 sm:p-3 shadow-sm hover:shadow hover:border-[#046307] hover:bg-green-50/40 transition-all duration-300 transform hover:-translate-y-0.5">
            <div class="w-10 h-10 rounded-xl bg-[#e8f5e9] flex items-center justify-center text-[#046307] shrink-0 group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300 shadow-inner">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            </div>
            <span class="text-[11.5px] sm:text-xs font-semibold text-gray-700 group-hover:text-[#046307] transition-colors font-bengali leading-tight">হোল্ডিং সনদ</span>
          </a>

          <!-- 7. সম্পত্তি বিভাজন সনদ -->
          <a href="#" class="group flex items-center gap-2.5 bg-white border border-green-100/90 rounded-xl p-2.5 sm:p-3 shadow-sm hover:shadow hover:border-[#046307] hover:bg-green-50/40 transition-all duration-300 transform hover:-translate-y-0.5">
            <div class="w-10 h-10 rounded-xl bg-[#e8f5e9] flex items-center justify-center text-[#046307] shrink-0 group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300 shadow-inner">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            </div>
            <span class="text-[11.5px] sm:text-xs font-semibold text-gray-700 group-hover:text-[#046307] transition-colors font-bengali leading-tight">সম্পত্তি বিভাজন সনদ</span>
          </a>

          <!-- 8. ব্যবসা প্রতিষ্ঠানের সনদ -->
          <a href="#" class="group flex items-center gap-2.5 bg-white border border-green-100/90 rounded-xl p-2.5 sm:p-3 shadow-sm hover:shadow hover:border-[#046307] hover:bg-green-50/40 transition-all duration-300 transform hover:-translate-y-0.5">
            <div class="w-10 h-10 rounded-xl bg-[#e8f5e9] flex items-center justify-center text-[#046307] shrink-0 group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300 shadow-inner">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <span class="text-[11.5px] sm:text-xs font-semibold text-gray-700 group-hover:text-[#046307] transition-colors font-bengali leading-tight">ব্যবসা প্রতিষ্ঠানের সনদ</span>
          </a>

          <!-- 9. ট্রেড লাইসেন্স নবায়ন -->
          <a href="#" class="group flex items-center gap-2.5 bg-white border border-green-100/90 rounded-xl p-2.5 sm:p-3 shadow-sm hover:shadow hover:border-[#046307] hover:bg-green-50/40 transition-all duration-300 transform hover:-translate-y-0.5">
            <div class="w-10 h-10 rounded-xl bg-[#e8f5e9] flex items-center justify-center text-[#046307] shrink-0 group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300 shadow-inner">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            </div>
            <span class="text-[11.5px] sm:text-xs font-semibold text-gray-700 group-hover:text-[#046307] transition-colors font-bengali leading-tight">ট্রেড লাইসেন্স নবায়ন</span>
          </a>

          <!-- 10. পেশা লাইসেন্স সংগ্রহ -->
          <a href="#" class="group flex items-center gap-2.5 bg-white border border-green-100/90 rounded-xl p-2.5 sm:p-3 shadow-sm hover:shadow hover:border-[#046307] hover:bg-green-50/40 transition-all duration-300 transform hover:-translate-y-0.5">
            <div class="w-10 h-10 rounded-xl bg-[#e8f5e9] flex items-center justify-center text-[#046307] shrink-0 group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300 shadow-inner">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
            </div>
            <span class="text-[11.5px] sm:text-xs font-semibold text-gray-700 group-hover:text-[#046307] transition-colors font-bengali leading-tight">পেশা লাইসেন্স সংগ্রহ</span>
          </a>

          <!-- 11. ওয়ারিশ সনদ -->
          <a href="#" class="group flex items-center gap-2.5 bg-white border border-green-100/90 rounded-xl p-2.5 sm:p-3 shadow-sm hover:shadow hover:border-[#046307] hover:bg-green-50/40 transition-all duration-300 transform hover:-translate-y-0.5">
            <div class="w-10 h-10 rounded-xl bg-[#e8f5e9] flex items-center justify-center text-[#046307] shrink-0 group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300 shadow-inner">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <span class="text-[11.5px] sm:text-xs font-semibold text-gray-700 group-hover:text-[#046307] transition-colors font-bengali leading-tight">ওয়ারিশ সনদ</span>
          </a>

          <!-- 12. চারিত্রিক সনদ -->
          <a href="#" class="group flex items-center gap-2.5 bg-white border border-green-100/90 rounded-xl p-2.5 sm:p-3 shadow-sm hover:shadow hover:border-[#046307] hover:bg-green-50/40 transition-all duration-300 transform hover:-translate-y-0.5">
            <div class="w-10 h-10 rounded-xl bg-[#e8f5e9] flex items-center justify-center text-[#046307] shrink-0 group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300 shadow-inner">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <span class="text-[11.5px] sm:text-xs font-semibold text-gray-700 group-hover:text-[#046307] transition-colors font-bengali leading-tight">চারিত্রিক সনদ</span>
          </a>

          <!-- 13. ই-মিউটেশন আবেদন -->
          <a href="#" class="group flex items-center gap-2.5 bg-white border border-green-100/90 rounded-xl p-2.5 sm:p-3 shadow-sm hover:shadow hover:border-[#046307] hover:bg-green-50/40 transition-all duration-300 transform hover:-translate-y-0.5">
            <div class="w-10 h-10 rounded-xl bg-[#e8f5e9] flex items-center justify-center text-[#046307] shrink-0 group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300 shadow-inner">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </div>
            <span class="text-[11.5px] sm:text-xs font-semibold text-gray-700 group-hover:text-[#046307] transition-colors font-bengali leading-tight">ই-মিউটেশন আবেদন</span>
          </a>

          <!-- 14. পৌর ট্যাক্স পেমেন্ট -->
          <a href="#" class="group flex items-center gap-2.5 bg-white border border-green-100/90 rounded-xl p-2.5 sm:p-3 shadow-sm hover:shadow hover:border-[#046307] hover:bg-green-50/40 transition-all duration-300 transform hover:-translate-y-0.5">
            <div class="w-10 h-10 rounded-xl bg-[#e8f5e9] flex items-center justify-center text-[#046307] shrink-0 group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300 shadow-inner">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <span class="text-[11.5px] sm:text-xs font-semibold text-gray-700 group-hover:text-[#046307] transition-colors font-bengali leading-tight">পৌর ট্যাক্স পেমেন্ট</span>
          </a>

          <!-- 15. বাণিজ্য সনদ -->
          <a href="#" class="group flex items-center gap-2.5 bg-white border border-green-100/90 rounded-xl p-2.5 sm:p-3 shadow-sm hover:shadow hover:border-[#046307] hover:bg-green-50/40 transition-all duration-300 transform hover:-translate-y-0.5">
            <div class="w-10 h-10 rounded-xl bg-[#e8f5e9] flex items-center justify-center text-[#046307] shrink-0 group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300 shadow-inner">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
            </div>
            <span class="text-[11.5px] sm:text-xs font-semibold text-gray-700 group-hover:text-[#046307] transition-colors font-bengali leading-tight">বাণিজ্য সনদ</span>
          </a>

          <!-- 16. শিক্ষা প্রতিষ্ঠানের সনদ -->
          <a href="#" class="group flex items-center gap-2.5 bg-white border border-green-100/90 rounded-xl p-2.5 sm:p-3 shadow-sm hover:shadow hover:border-[#046307] hover:bg-green-50/40 transition-all duration-300 transform hover:-translate-y-0.5">
            <div class="w-10 h-10 rounded-xl bg-[#e8f5e9] flex items-center justify-center text-[#046307] shrink-0 group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300 shadow-inner">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
            </div>
            <span class="text-[11.5px] sm:text-xs font-semibold text-gray-700 group-hover:text-[#046307] transition-colors font-bengali leading-tight">শিক্ষা প্রতিষ্ঠানের সনদ</span>
          </a>

          <!-- 17. কমিউনিটি সনদ -->
          <a href="#" class="group flex items-center gap-2.5 bg-white border border-green-100/90 rounded-xl p-2.5 sm:p-3 shadow-sm hover:shadow hover:border-[#046307] hover:bg-green-50/40 transition-all duration-300 transform hover:-translate-y-0.5">
            <div class="w-10 h-10 rounded-xl bg-[#e8f5e9] flex items-center justify-center text-[#046307] shrink-0 group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300 shadow-inner">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <span class="text-[11.5px] sm:text-xs font-semibold text-gray-700 group-hover:text-[#046307] transition-colors font-bengali leading-tight">কমিউনিটি সনদ</span>
          </a>

          <!-- 18. অনাপত্তি সনদ (NOC) -->
          <a href="#" class="group flex items-center gap-2.5 bg-white border border-green-100/90 rounded-xl p-2.5 sm:p-3 shadow-sm hover:shadow hover:border-[#046307] hover:bg-green-50/40 transition-all duration-300 transform hover:-translate-y-0.5">
            <div class="w-10 h-10 rounded-xl bg-[#e8f5e9] flex items-center justify-center text-[#046307] shrink-0 group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300 shadow-inner">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span class="text-[11.5px] sm:text-xs font-semibold text-gray-700 group-hover:text-[#046307] transition-colors font-bengali leading-tight">অনাপত্তি সনদ (NOC)</span>
          </a>

          <!-- 19. জমির খতিয়ান সনদ -->
          <a href="#" class="group flex items-center gap-2.5 bg-white border border-green-100/90 rounded-xl p-2.5 sm:p-3 shadow-sm hover:shadow hover:border-[#046307] hover:bg-green-50/40 transition-all duration-300 transform hover:-translate-y-0.5">
            <div class="w-10 h-10 rounded-xl bg-[#e8f5e9] flex items-center justify-center text-[#046307] shrink-0 group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300 shadow-inner">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
            </div>
            <span class="text-[11.5px] sm:text-xs font-semibold text-gray-700 group-hover:text-[#046307] transition-colors font-bengali leading-tight">জমির খতিয়ান সনদ</span>
          </a>

          <!-- 20. অন্যান্য সেবা সমূহ -->
          <a href="#" class="group flex items-center gap-2.5 bg-white border border-green-100/90 rounded-xl p-2.5 sm:p-3 shadow-sm hover:shadow hover:border-[#046307] hover:bg-green-50/40 transition-all duration-300 transform hover:-translate-y-0.5">
            <div class="w-10 h-10 rounded-xl bg-[#e8f5e9] flex items-center justify-center text-[#046307] shrink-0 group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300 shadow-inner">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            </div>
            <span class="text-[11.5px] sm:text-xs font-semibold text-gray-700 group-hover:text-[#046307] transition-colors font-bengali leading-tight">অন্যান্য সেবা সমূহ</span>
          </a>

        </div>

        <!-- Button: সব সেবা দেখুন -->
        <div class="mt-5 md:mt-6 text-center">
          <a href="#" class="inline-flex items-center gap-1.5 px-6 py-2 rounded-full border border-[#046307] text-[#046307] font-semibold text-xs sm:text-sm hover:bg-[#046307] hover:text-white transition-all duration-300 shadow-sm group font-bengali">
            <span>সব সেবা দেখুন</span>
            <svg class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>
        </div>
      </div>
    </section>

    <!-- প্রয়োজনীয় তথ্য (Essential Information Grid) -->
    <section class="container mx-auto max-w-[1200px] px-5 my-6 md:my-8">
      <!-- Heading with decorative dashes -->
      <div class="text-center mb-2 md:mb-2.5">
        <div class="inline-flex items-center justify-center gap-2.5 sm:gap-3">
          <span class="h-[1.5px] w-10 sm:w-16 md:w-24 bg-gradient-to-r from-transparent to-green-600/50"></span>
          <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-[#111827] font-bengali tracking-tight">প্রয়োজনীয় তথ্য</h2>
          <span class="h-[1.5px] w-10 sm:w-16 md:w-24 bg-gradient-to-l from-transparent to-green-600/50"></span>
        </div>
        <div class="flex items-center justify-center gap-1.5 mt-1.5 text-[#046307]/80">
          <span class="inline-block w-1 h-1 rounded-full bg-[#046307]/40"></span>
          <span class="text-[10px] font-bold tracking-widest text-[#046307]">❖</span>
          <span class="inline-block w-1 h-1 rounded-full bg-[#046307]/40"></span>
        </div>
      </div>

      <!-- Container Box -->
      <div class="bg-gradient-to-b from-green-50/70 via-white to-white border border-green-200/80 rounded-2xl p-4 sm:p-6 md:p-7 shadow-sm">
        @php
          $proyojonioCards = [
            ['title' => 'মন্ত্রণালয় সমূহ', 'icon' => '<path d="M3 21h18" /><path d="M5 21V9l7-4 7 4v12" /><path d="M9 21v-6h6v6" /><path d="M9 11h.01M12 11h.01M15 11h.01" />'],
            ['title' => 'অধিদপ্তর সমূহ', 'icon' => '<path d="M4 21V6h7v15" /><path d="M11 10h9v11" /><path d="M7 10h1M7 14h1M14 14h1M17 14h1" />'],
            ['title' => 'দপ্তর সমূহ', 'icon' => '<path d="M4 21V5h16v16" /><path d="M8 9h2M14 9h2M8 13h2M14 13h2" /><path d="M10 21v-4h4v4" />'],
            ['title' => 'বিভাগ সমূহ', 'icon' => '<path d="M12 3v18" /><path d="M4 8h16" /><path d="M4 16h16" /><path d="M5 4h14v16H5z" />'],
            ['title' => 'জেলা সমূহ', 'icon' => '<path d="M12 21s7-5.4 7-11a7 7 0 1 0-14 0c0 5.6 7 11 7 11Z" /><circle cx="12" cy="10" r="2.4" />'],
            ['title' => 'উপজেলা সমূহ', 'icon' => '<path d="M12 3 4 8v13h16V8l-8-5Z" /><path d="M8 21v-7h8v7" /><path d="M9 10h6" />'],
            ['title' => 'সরকারি বিশ্ববিদ্যালয় সমূহ', 'icon' => '<path d="M3 10h18L12 4 3 10Z" /><path d="M5 10v8M9 10v8M15 10v8M19 10v8" /><path d="M4 18h16M3 21h18" />'],
            ['title' => 'বেসরকারি বিশ্ববিদ্যালয় সমূহ', 'icon' => '<path d="M4 10 12 5l8 5" /><path d="M6 10v9h12v-9" /><path d="M9 19v-5h6v5" /><path d="M10 9h4" />'],
            ['title' => 'সরকারি কলেজ সমূহ', 'icon' => '<path d="m3 8 9-4 9 4-9 4-9-4Z" /><path d="M7 10v5c2.5 2 7.5 2 10 0v-5" /><path d="M21 8v6" />'],
            ['title' => 'বেসরকারি কলেজ সমূহ', 'icon' => '<path d="M4 19h16" /><path d="M6 19V8l6-3 6 3v11" /><path d="M10 12h4M10 15h4" />'],
            ['title' => 'সরকারি স্কুল সমূহ', 'icon' => '<path d="M4 20V8l8-4 8 4v12" /><path d="M8 20v-6h8v6" /><path d="M9 10h6" />'],
            ['title' => 'বেসরকারি স্কুল সমূহ', 'icon' => '<path d="M5 20V7h14v13" /><path d="M8 7V5h8v2" /><path d="M9 12h6M9 16h6" />'],
            ['title' => 'সরকারি হাসপাতাল সমূহ', 'icon' => '<path d="M5 21V5h14v16" /><path d="M9 21v-5h6v5" /><path d="M12 8v6M9 11h6" />'],
            ['title' => 'বেসরকারি হাসপাতাল সমূহ', 'icon' => '<path d="M4 21V9l8-5 8 5v12" /><path d="M12 9v6M9 12h6" /><path d="M9 21v-4h6v4" />'],
            ['title' => 'স্থানীয় মাদ্রাসা সমূহ', 'icon' => '<path d="M4 21V10l8-6 8 6v11" /><path d="M8 21v-7h8v7" /><path d="M12 4v4" /><path d="M9 11h6" />'],
            ['title' => 'কওমি মাদ্রাসা সমূহ', 'icon' => '<path d="M6 21V9a6 6 0 0 1 12 0v12" /><path d="M9 21v-5h6v5" /><path d="M8 12h8" />'],
            ['title' => 'এনজিও সমূহ', 'icon' => '<path d="M7 11a4 4 0 1 1 6.4 3.2" /><path d="M17 13a3 3 0 1 1-4.8 2.4" /><path d="M4 20c1.4-3 4-4.5 8-4.5S18.6 17 20 20" />'],
            ['title' => 'সরকারি ব্যাংক সমূহ', 'icon' => '<path d="M3 10h18L12 4 3 10Z" /><path d="M5 10v8M9 10v8M15 10v8M19 10v8" /><path d="M4 18h16" />'],
            ['title' => 'বেসরকারি ব্যাংক সমূহ', 'icon' => '<path d="M4 21h16" /><path d="M6 10h12" /><path d="M7 10V7l5-3 5 3v3" /><path d="M8 14h2M14 14h2M8 18h8" />'],
            ['title' => 'আইনশৃঙ্খলা বাহিনী সমূহ', 'icon' => '<path d="M12 3 5 6v5c0 4.5 3 8 7 10 4-2 7-5.5 7-10V6l-7-3Z" /><path d="M9.5 12.5 11 14l3.5-4" />'],
            ['title' => 'গোয়েন্দা বিভাগ সমূহ', 'icon' => '<path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z" /><circle cx="12" cy="12" r="3" /><path d="M18 18l2 2" />'],
            ['title' => 'বাণিজ্যিক প্রতিষ্ঠান সমূহ', 'icon' => '<path d="M4 21V7h16v14" /><path d="M8 7V5h8v2" /><path d="M8 11h8M8 15h8" /><path d="M10 21v-3h4v3" />'],
            ['title' => 'ইলেকট্রনিক মিডিয়া সমূহ', 'icon' => '<path d="M12 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16Z" /><path d="M6.7 10.7l5.3 5.3 5.3-5.3" /><path d="M12 16V10" />'],
            ['title' => 'প্রিন্ট মিডিয়া সমূহ', 'icon' => '<path d="M12 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16Z" /><path d="M6.7 10.7l5.3 5.3 5.3-5.3" /><path d="M12 16V10" />'],
            ['title' => 'ধর্মীয় প্রতিষ্ঠান সমূহ', 'icon' => '<path d="M12 3v7.5a6 6 0 0 0 6 6V3" /><path d="M12 3a6 6 0 1 1 6 6h-6Z" /><path d="M6 16.5a6 6 0 1 1-4.76 5.93" /><path d="M19.76 16.5A6 6 0 1 0 24 16.5" />'],
          ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2.5 sm:gap-3.5">
          @foreach($proyojonioCards as $card)
            <a href="#" class="group flex items-center gap-2.5 bg-white border border-green-100/90 rounded-xl p-2.5 sm:p-3 shadow-sm hover:shadow hover:border-[#046307] hover:bg-green-50/40 transition-all duration-300 transform hover:-translate-y-0.5">
              <div class="w-10 h-10 rounded-xl bg-[#e8f5e9] flex items-center justify-center text-[#046307] shrink-0 group-hover:bg-[#046307] group-hover:text-white transition-colors duration-300 shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  {!! $card['icon'] !!}
                </svg>
              </div>
              <span class="text-[11.5px] sm:text-xs font-semibold text-gray-700 group-hover:text-[#046307] transition-colors font-bengali leading-tight">{{ $card['title'] }}</span>
            </a>
          @endforeach
        </div>
      </div>
    </section>

    <!-- Support / Info Cards (3 Column) -->
    <section class="container mx-auto max-w-screen-xl px-4 mb-10 md:mb-12">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-5">
        
        <!-- Card 1: Green -->
        <div class="bg-gradient-to-br from-[#e8f5e9] via-[#f1f8f2] to-[#c8e6c9]/60 border border-green-200/80 rounded-2xl p-4 sm:p-5 relative overflow-hidden shadow-sm flex items-center justify-between group hover:shadow transition-all duration-300">
          <div class="relative z-10 max-w-[70%] font-bengali">
            <h3 class="text-sm sm:text-base font-bold text-[#046307] mb-1 leading-tight">দ্রুত ও সহজ আবেদন</h3>
            <p class="text-[11px] sm:text-xs text-gray-600 mb-3.5 leading-normal">কয়েকটি সহজ ধাপে আপনার আবেদন সম্পন্ন করুন</p>
            <a href="{{ route('application.create') }}" class="inline-flex items-center gap-1.5 bg-[#046307] text-white px-3.5 py-1.5 rounded-lg text-[11px] font-semibold hover:bg-[#034a05] transition-all shadow-sm group-hover:gap-2">
              <span>আবেদন করুন</span>
              <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
          </div>
          <div class="relative z-10 text-[#046307] opacity-75 group-hover:scale-110 transition-transform duration-300">
            <svg class="w-14 h-14 sm:w-16 sm:h-16 text-green-600/70 drop-shadow-sm" viewBox="0 0 24 24" fill="currentColor">
              <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm-2 14l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
            </svg>
          </div>
        </div>

        <!-- Card 2: Blue -->
        <div class="bg-gradient-to-br from-[#e3f2fd] via-[#eff8ff] to-[#bbdefb]/60 border border-blue-200/80 rounded-2xl p-4 sm:p-5 relative overflow-hidden shadow-sm flex items-center justify-between group hover:shadow transition-all duration-300">
          <div class="relative z-10 max-w-[70%] font-bengali">
            <h3 class="text-sm sm:text-base font-bold text-[#0277bd] mb-1 leading-tight">আবেদন স্ট্যাটাস ট্র্যাকিং</h3>
            <p class="text-[11px] sm:text-xs text-gray-600 mb-3.5 leading-normal">আপনার আবেদনের বর্তমান অবস্থা জানুন</p>
            <a href="{{ route('certificate.verify') }}" class="inline-flex items-center gap-1.5 bg-white border border-[#0277bd] text-[#0277bd] px-3.5 py-1.5 rounded-lg text-[11px] font-semibold hover:bg-[#0277bd] hover:text-white transition-all shadow-sm group-hover:gap-2">
              <span>স্ট্যাটাস দেখুন</span>
              <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
          </div>
          <div class="relative z-10 text-[#0277bd] opacity-75 group-hover:scale-110 transition-transform duration-300">
            <svg class="w-14 h-14 sm:w-16 sm:h-16 text-blue-600/70 drop-shadow-sm" viewBox="0 0 24 24" fill="currentColor">
              <path d="M17 1H7c-1.1 0-2 .9-2 2v18c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V3c0-1.1-.9-2-2-2zm0 18H7V5h10v14zm-5-2c.55 0 1-.45 1-1s-.45-1-1-1-1 .45-1 1 .45 1 1 1zm3-7H9v-2h6v2zm0-4H9V4h6v2z"/>
            </svg>
          </div>
        </div>

        <!-- Card 3: Purple -->
        <div class="bg-gradient-to-br from-[#f3e5f5] via-[#faf5fb] to-[#e1bee7]/60 border border-purple-200/80 rounded-2xl p-4 sm:p-5 relative overflow-hidden shadow-sm flex items-center justify-between group hover:shadow transition-all duration-300">
          <div class="relative z-10 max-w-[70%] font-bengali">
            <h3 class="text-sm sm:text-base font-bold text-[#7b1fa2] mb-1 leading-tight">সহায়তা প্রয়োজন?</h3>
            <p class="text-[11px] sm:text-xs text-gray-600 mb-3.5 leading-normal">আমাদের সহায়তা কেন্দ্র যোগাযোগ করুন</p>
            <a href="#" class="inline-flex items-center gap-1.5 bg-white border border-[#7b1fa2] text-[#7b1fa2] px-3.5 py-1.5 rounded-lg text-[11px] font-semibold hover:bg-[#7b1fa2] hover:text-white transition-all shadow-sm group-hover:gap-2">
              <span>যোগাযোগ করুন</span>
              <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
          </div>
          <div class="relative z-10 text-[#7b1fa2] opacity-75 group-hover:scale-110 transition-transform duration-300">
            <svg class="w-14 h-14 sm:w-16 sm:h-16 text-purple-600/70 drop-shadow-sm" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 1c-4.97 0-9 4.03-9 9v7c0 1.66 1.34 3 3 3h3v-8H5v-2c0-3.87 3.13-7 7-7s7 3.13 7 7v2h-4v8h4c1.66 0 3-1.34 3-3v-7c0-4.97-4.03-9-9-9z"/>
            </svg>
          </div>
        </div>

      </div>
    </section>

  </main>

  <!-- Splide JS -->
  <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
  <script src="{{asset('assets/js/navbar.js')}}?v={{ time() }}"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      if (document.querySelector("#image-carousel")) {
        new Splide("#image-carousel", {
          type: "loop",
          perPage: 1,
          gap: "1rem",
          autoplay: false,
          pagination: false,
        }).mount();
      }
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function (e) {
      if (!e.target.closest('.user-dropdown-btn') && !e.target.closest('.user-dropdown-menu')) {
        var menus = document.querySelectorAll('.user-dropdown-menu');
        menus.forEach(function (menu) {
          menu.classList.add('hidden');
        });
      }
    });
  </script>
@endsection
