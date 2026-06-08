<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CLMS | Nagorik Application</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{asset('assets/style/global.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/style/upms-theme.css')}}" />
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
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
  </head>
  <body class="bg-[#f3f4f6] font-inter">
    <!-- top bar -->
    @include('frontend.layouts.header')
    
    <!-- Navigation -->
    <nav class="md:block hidden bg-[#046307]">
      <div class="container mx-auto md:px-32 px-4 max-w-[1200px]">
        <!-- Navigation Links -->
        <ul class="nav-links flex items-center md:justify-start justify-center gap-10 py-1.5 leading-none text-xs font-bold uppercase tracking-wider">
          <li class="flex items-center">
            <a href="{{url('/')}}" class="inline-flex items-center gap-2">
              <span class="inline-flex h-6 w-6 items-center justify-center rounded border border-white/30 text-white transition-all hover:bg-gray/10" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                  <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                  <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.432z" />
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
              <div id="citizenDropdown" class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden z-50 text-gray-800 user-dropdown-menu" style="text-transform: none;">
                <a href="{{ route('people.dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">ড্যাশবোর্ড</a>
                <a href="{{ route('people.profile') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">প্রোফাইল</a>
                <form method="POST" action="{{ route('people.logout') }}">
                  @csrf
                  <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">লগআউট</button>
                </form>
              </div>
            </li>
          @else
            <li><a href="{{ route('people.login') }}" target="_blank" class="text-white hover:opacity-80 flex items-center gap-2"><span class="text-red-500"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path d="M12 12a4.2 4.2 0 1 0-4.2-4.2A4.2 4.2 0 0 0 12 12Zm0 1.8c-3.6 0-6.8 2-6.8 5.2 0 .6.4 1 1 1h11.6c.6 0 1-.4 1-1 0-3.2-3.2-5.2-6.8-5.2Z" /></svg></span>নাগরিক লগইন</a></li>
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
              <div id="adminDropdown" class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden z-50 text-gray-800 user-dropdown-menu" style="text-transform: none;">
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">ড্যাশবোর্ড</a>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">লগআউট</button>
                </form>
              </div>
            </li>
          @else
            <li><a href="{{url('/')}}/login" target="_blank" class="text-white hover:opacity-80 flex items-center gap-2"><span class="text-red-500"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path d="M12 12a4.2 4.2 0 1 0-4.2-4.2A4.2 4.2 0 0 0 12 12Zm0 1.8c-3.6 0-6.8 2-6.8 5.2 0 .6.4 1 1 1h11.6c.6 0 1-.4 1-1 0-3.2-3.2-5.2-6.8-5.2Z" /></svg></span>অ্যাডমিন লগইন</a></li>
            <li><a href="{{url('/')}}/login" target="_blank" class="text-white hover:opacity-80 flex items-center gap-2"><span class="text-red-500"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path d="M12 12a4.2 4.2 0 1 0-4.2-4.2A4.2 4.2 0 0 0 12 12Zm0 1.8c-3.6 0-6.8 2-6.8 5.2 0 .6.4 1 1 1h11.6c.6 0 1-.4 1-1 0-3.2-3.2-5.2-6.8-5.2Z" /></svg></span>মনিটরিং লগইন</a></li>
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
    <nav class="md:hidden relative z-50">
      <div id="mobile-menu"
        class="fixed top-[60px] left-0 h-[calc(100vh-60px)] w-72 bg-slate-50 text-gray-900 transform -translate-x-full transition-transform duration-300 ease-in-out shadow-2xl border-r border-gray-200 overflow-y-auto">
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
      
      <div class="container mx-auto max-w-5xl px-4 mt-6 pb-20">
        <div class="bg-white rounded-lg shadow-[0_5px_25px_rgba(0,0,0,0.05)] overflow-hidden border border-gray-100">
          <div class="bg-gray-50 border-b border-gray-100 px-6 py-4 text-center">
            <h2 class="text-xl font-bold text-[#046307]">নাগরিক আবেদন ফরম</h2>
            <p class="mt-0.5 text-[10px] text-gray-500 italic">সঠিক তথ্য দিয়ে ফরমটি পূরণ করুন</p>
          </div>

          <form class="p-6 pt-2" id="applicationForm" enctype="multipart/form-data">
            @csrf
            
            <!-- Personal Information -->
            <div class="section-title">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                ব্যক্তিগত তথ্য
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a5.97 5.97 0 0 0-.94 3.197m0 0a5.995 5.995 0 0 0 5.058 2.771ZM12 11.25a3.375 3.375 0 1 0 0-6.75 3.375 3.375 0 0 0 0 6.75ZM9.75 8.625a2.625 2.625 0 1 1 5.25 0 2.625 2.625 0 0 1-5.25 0Z" />
                </svg>
                পিতা-মাতার তথ্য
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                </svg>
                যোগাযোগ ও ছবি
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label" for="mobile">মোবাইল নম্বর <span class="text-red-500">*</span></label>
                    <div class="flex items-stretch">
                        <span class="bg-gray-50 border border-r-0 border-gray-200 rounded-l flex items-center px-3 text-gray-500 text-xs h-[38px] shadow-sm font-medium">+88</span>
                        <input type="tel" required name="mobile" id="mobile" class="form-input rounded-l-none" placeholder="017XXXXXXXX" maxlength="11" inputmode="numeric" autocomplete="tel" oninput="validateMobileInput(this)">
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
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                স্থায়ী ঠিকানা
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                            <option value="{{$post_office->id}}">{{ $post_office->bn_name ?: $post_office->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label" for="permanent_ward">ওয়ার্ড নম্বর</label>
                    <select name="permanent_ward" id="permanent_ward" class="form-input select2">
                        <option value="">ওয়ার্ড নির্বাচন করুন</option>
                        @foreach ($wards as $ward)
                            <option value="{{ $ward->id }}">{{ $ward->bn_ward_no ?? $ward->en_ward_no }}</option>
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
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    বর্তমান ঠিকানা
                </div>
                <div class="flex items-center gap-2 text-sm font-normal text-gray-600 bg-gray-100 px-3 py-1 rounded-full border border-gray-200">
                    <input type="checkbox" name="same_as_permanent_address" id="same_as_permanent_address" class="w-4 h-4 accent-[#046307]">
                    <label for="same_as_permanent_address" class="cursor-pointer">স্থায়ী ঠিকানার মতই?</label>
                </div>
            </div>

            <div id="same-as-permanent-address-section">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                                <option value="{{$post_office->id}}">{{ $post_office->bn_name ?: $post_office->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label" for="present_ward">ওয়ার্ড নম্বর</label>
                        <select name="present_ward" id="present_ward" class="form-input select2">
                            <option value="">ওয়ার্ড নির্বাচন করুন</option>
                            @foreach ($wards as $ward)
                                <option value="{{ $ward->id }}">{{ $ward->bn_ward_no ?? $ward->en_ward_no }}</option>
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
            <div class="mt-8 text-center bg-gray-50 p-4 rounded-lg border border-gray-100">
                <div class="flex flex-col md:flex-row items-center justify-center gap-3 mb-4">
                    <input type="hidden" name="union_id" value="3503">
                    <a href="{{ url('/') }}" class="w-full md:w-24 text-center py-2 px-3 bg-gray-500 text-white font-bold rounded hover:bg-gray-600 transition text-[11px] shadow-sm uppercase">বাতিল</a>
                    <button type="reset" class="w-full md:w-24 py-2 px-3 bg-red-500 text-white font-bold rounded hover:bg-red-600 transition text-[11px] shadow-sm uppercase">পুনরায় শুরু</button>
                    <button type="submit" class="w-full md:w-40 py-2 px-5 bg-[#046307] text-white font-bold rounded hover:bg-[#0a8a0e] transition text-[11px] shadow-md transform active:scale-95 uppercase">আবেদন জমা দিন</button>
                </div>
                
                <p class="text-gray-500 text-[10px]">
                    আপনার কি ইতোমধ্যে অ্যাকাউন্ট আছে? 
                    <a href="{{ route('people.login') }}" class="text-[#046307] font-black hover:underline">এখানে লগইন করুন</a>
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
        // Mobile number: block Bangla digits, max 11 English digits
        function validateMobileInput(input) {
            const banglaDigits = /[\u09E6-\u09EF]/g;
            const errorEl = document.querySelector('.mobile-error');

            if (banglaDigits.test(input.value)) {
                input.value = input.value.replace(banglaDigits, '');
                errorEl.textContent = 'Please type in English';
                return;
            }

            // Remove any non-digit characters
            input.value = input.value.replace(/\D/g, '');

            // Limit to 11 digits
            if (input.value.length > 11) {
                input.value = input.value.slice(0, 11);
            }

            // Clear error if valid
            if (input.value.length > 0 && input.value.length <= 11) {
                errorEl.textContent = '';
            }
        }

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

            $(document).on('submit', "#applicationForm", function(e) {
                e.preventDefault();
                let thisForm = $(this);
                let _this_button = thisForm.find('button[type="submit"]');
                let _original_text = _this_button.text();
                
                $.ajax({
                    type: "POST",
                    url: "{{url('/')}}/application/store",
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
            $(document).on('change', "#permanent_division, #permanent_district, #permanent_thana, #permanent_union, #present_division, #present_district, #present_thana, #present_union", function() {
                let _this = $(this);
                let _this_id = _this.attr('id');
                let prefix = _this_id.split("_")[0];
                let val = _this.val();

                if (_this_id.includes('division')) {
                    findDistrict(val, prefix);
                } else if (_this_id.includes('district')) {
                    findThana(val, prefix);
                } else if (_this_id.includes('thana')) {
                    findThanaDependencies(val, prefix);
                } else if (_this_id.includes('union')) {
                    findUnionDependencies(val, prefix);
                }
            });

            function refreshSelect2(selector) {
                var $el = $(selector);
                if ($el.hasClass('select2-hidden-accessible')) {
                    $el.trigger('change');
                } else {
                    $el.select2({ width: '100%' });
                }
            }

            function findDistrict(division, prefix) {
                if (!division) return;
                $.get("{{ url('/get-districts-by-division') }}/" + division, {id: prefix}, function(res) {
                    var $el = $('#' + prefix + "_district");
                    $el.html(res);
                    refreshSelect2($el);
                    $el.trigger('change');
                });
            }

            function findThana(district, prefix) {
                if (!district) return;
                $.get("{{ url('/get-thanas-by-district') }}/" + district, {id: prefix}, function(res) {
                    var $el = $('#' + prefix + "_thana");
                    $el.html(res);
                    refreshSelect2($el);
                    $el.trigger('change');
                });
            }

            function findThanaDependencies(thana, prefix) {
                if (!thana) return;
                // Load Unions
                $.get("{{ url('/get-unions-by-thana') }}/" + thana, {id: prefix}, function(res) {
                    var $el = $('#' + prefix + "_union");
                    $el.html(res);
                    refreshSelect2($el);
                    $el.trigger('change');
                });
                // Load Post Offices
                $.get("{{ url('/get-post-offices-by-thana') }}/" + thana, {id: prefix}, function(res) {
                    var $el = $('#' + prefix + "_post_office_id");
                    $el.html(res);
                    refreshSelect2($el);
                });
            }

            function findUnionDependencies(union, prefix) {
                if (!union) return;
                // Wards are independent and statically populated, do not fetch dynamically.
                // Load Villages
                $.ajax({
                    url: "{{ url('/get-villages-by-union') }}/" + union,
                    type: 'GET',
                    data: { id: prefix },
                    dataType: 'json',
                    success: function(res) {
                        var html = (res && res.villageOptions) ? res.villageOptions : res;
                        var $el = $('#' + prefix + "_village");
                        $el.html(html);
                        refreshSelect2($el);
                    },
                    error: function() {
                        // fallback — clear the village dropdown
                        var $el = $('#' + prefix + "_village");
                        $el.html('<option value="">গ্রাম নির্বাচন করুন</option>');
                        refreshSelect2($el);
                    }
                });
            }

            // Same as Permanent Address Logic
            $(document).on('change', '#same_as_permanent_address', function() {
                if($(this).is(':checked')) {
                    // Copy select values and trigger change
                    const fields = [
                        'division', 'district', 'thana', 'union', 
                        'post_office_id', 'ward', 'village'
                    ];

                    fields.forEach(function(field) {
                        const permSelect = $('#permanent_' + field);
                        const presSelect = $('#present_' + field);
                        
                        presSelect.html(permSelect.html());
                        presSelect.val(permSelect.val()).trigger('change');
                    });
                    
                    // Copy text inputs
                    const inputFields = ['road', 'house_no', 'house_no_en'];
                    inputFields.forEach(function(field) {
                        $('#present_' + field).val($('#permanent_' + field).val());
                    });

                    $("#same-as-permanent-address-section").slideUp();
                } else {
                    $("#same-as-permanent-address-section").slideDown();
                }
            });
        });
    </script>
    <script src="{{asset('assets/js/navbar.js')}}"></script>
    @stack('script')
  </body>
</html>

