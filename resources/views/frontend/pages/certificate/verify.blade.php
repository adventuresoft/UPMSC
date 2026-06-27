<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CLMS | সনদ যাচাই</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{asset('assets/style/global.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/style/upms-theme.css')}}?v=1.4" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style type="text/tailwindcss">
        @layer utilities {
            .form-input {
                @apply w-full px-3 py-1.5 bg-gray-50 border border-gray-200 rounded focus:ring-1 focus:ring-[#046307] focus:border-transparent outline-none transition-all duration-300 text-xs h-[38px] shadow-sm hover:border-gray-300;
            }
            .form-label {
                @apply block text-[10px] font-bold text-gray-700 uppercase tracking-widest mb-1;
            }
        }
    </style>
  </head>
  <body class="bg-[#f3f4f6] font-inter min-h-screen flex flex-col">
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

    <main class="flex-grow py-16 px-4">
      <div class="container mx-auto max-w-3xl">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
          <div class="bg-[#046307] px-8 py-6 text-white flex items-center gap-3">
            <i class="fas fa-shield-check text-2xl text-green-300"></i>
            <div>
              <h2 class="text-2xl font-bold">সনদ যাচাই করুন</h2>
              <p class="text-green-100 text-sm opacity-80">সনদ নম্বর প্রদান করে অনুসন্ধান করুন</p>
            </div>
          </div>

          <div class="p-8">
            <form action="{{ route('certificate.verify.search') }}" method="POST" class="space-y-6">
              @csrf
              <div>
                <label for="system_id" class="form-label">সনদ নং প্রদান করুন</label>
                <div class="flex flex-col sm:flex-row gap-3">
                  <div class="relative flex-grow">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                      <i class="fas fa-certificate text-sm"></i>
                    </span>
                    <input 
                      type="text" 
                      name="system_id" 
                      id="system_id"
                      class="form-input !pl-11"
                      placeholder="যেমন: CERT-12345"
                      value="{{ old('system_id', $system_id ?? '') }}"
                      required
                    >
                  </div>
                  <button type="submit" class="sm:w-auto w-full px-8 h-[45px] bg-[#046307] text-white font-bold rounded-lg hover:bg-[#0a8a0e] transition-all shadow-lg active:scale-95 flex items-center justify-center gap-2">
                    <i class="fas fa-search text-sm"></i>
                    অনুসন্ধান
                  </button>
                </div>
              </div>
            </form>

            @if(isset($data))
              <!-- Result Modal -->
              <div id="resultModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
                <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden animate-[fadeIn_0.3s_ease-out]">
                  <div class="bg-[#046307] px-6 py-4 flex justify-between items-center text-white">
                    <h3 class="text-lg font-bold flex items-center gap-2">
                      <i class="fas fa-check-circle"></i> সঠিক তথ্য পাওয়া গেছে
                    </h3>
                    <button onclick="document.getElementById('resultModal').remove()" class="hover:bg-white/20 p-1.5 rounded-lg transition-colors">
                      <i class="fas fa-times text-xl"></i>
                    </button>
                  </div>
                  
                  <div class="p-6 relative">
                    <div class="absolute top-4 right-4 p-4 opacity-5">
                      <i class="fas fa-certificate text-8xl text-green-600"></i>
                    </div>
                    
                    <div class="relative z-10 space-y-4">
                      <div class="flex flex-col gap-1 pb-4 border-b border-gray-100">
                        <span class="text-xs text-gray-500 uppercase tracking-wider font-bold">সনদ নং:</span>
                        <span class="text-xl font-mono font-black text-[#046307]">{{ $data->system_id }}</span>
                      </div>
                      
                      <div class="space-y-3 text-gray-700 leading-relaxed text-sm">
                        <div class="flex">
                          <span class="w-32 font-bold text-gray-500">ইস্যুর তারিখ:</span>
                          <span class="font-bold text-[#046307]">{{ $data->created_at ? $data->created_at->format('d M, Y') : 'N/A' }}</span>
                        </div>
                        <div class="flex">
                          <span class="w-32 font-bold text-gray-500">নাম:</span>
                          <span class="font-bold text-gray-900">{{ $data->user->name ?? $data->user->people->bn_name ?? '--' }}</span>
                        </div>
                        <div class="flex">
                          <span class="w-32 font-bold text-gray-500">পিতা:</span>
                          <span class="font-medium text-gray-800">{{ $data->user->familyInfo->father_name_bn ?? '--' }}</span>
                        </div>
                        <div class="flex">
                          <span class="w-32 font-bold text-gray-500">মাতা:</span>
                          <span class="font-medium text-gray-800">{{ $data->user->familyInfo->mother_name_bn ?? '--' }}</span>
                        </div>
                        <div class="flex">
                          <span class="w-32 font-bold text-gray-500">জন্ম তারিখ:</span>
                          <span class="font-medium text-gray-800">{{ $data->user->people->date_of_birth ?? 'N/A' }}</span>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                          সনদটি <span class="font-bold text-[#046307]">{{ $data->user->institute->union->bn_name ?? '' }}</span> এর চেয়ারম্যান কর্তৃক প্রদান করা হয়েছে।
                        </div>
                      
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @elseif(session('error'))
              <div class="mt-10 p-8 bg-red-50 rounded-2xl border-2 border-red-100 text-center">
                <div class="text-red-500 text-5xl mb-4">
                  <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h3 class="text-xl font-bold text-red-700 mb-2">দুঃখিত!</h3>
                <p class="text-red-600">{{ session('error') }}</p>
              </div>
            @endif
          </div>

          <div class="bg-gray-50 px-8 py-4 border-t border-gray-100">
            <p class="text-xs text-gray-400 text-center italic">ভেরিফিকেশন সিস্টেমটি সরকারি ডিজিটাল সেবার অংশ।</p>
          </div>
        </div>
      </div>
    </main>

    <footer class="bg-gray-900 py-8 px-4 text-white mt-auto border-t border-gray-800">
      <div class="container mx-auto max-w-screen-xl flex flex-col md:flex-row justify-between items-center text-sm opacity-70">
        <p>© 2024 All rights reserved by <span class="font-bold text-gray-300">UPMS</span></p>
        <p>Design & Maintained by <a href="https://adventuresoft.com.bd" class="hover:text-white transition-colors underline decoration-gray-700 underline-offset-4">Adventure Soft</a></p>
      </div>
    </footer>
    <script src="{{asset('assets/js/navbar.js')}}"></script>
    @stack('script')
  </body>
</html>
