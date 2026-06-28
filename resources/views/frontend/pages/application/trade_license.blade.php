@extends('frontend.master')
@section('title', 'ট্রেড লাইসেন্স আবেদন')
@section('content')

@push('style')
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    corePlugins: {
      preflight: false,
    }
  }
</script>
<link rel="stylesheet" href="{{asset('assets/style/global.css')}}?v={{ time() }}" />
@endpush

  <!-- Navigation -->
  <nav class="md:block hidden bg-[#046307]">
    <div class="container mx-auto px-5 max-w-[1200px]">
      <!-- Navigation Links -->
      <ul class="nav-links list-none flex items-center md:justify-start justify-center gap-10 py-1.5 leading-none text-xs font-bold uppercase tracking-wider">
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

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow border-success">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0 font-weight-bold">ট্রেড লাইসেন্স আবেদন (Organization Information)</h4>
                </div>
                <form class="form-horizontal" id="organizationForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="">
                    
                    @include('backend.pages.organization.forms.organization', ['organization' => null])
                    
                    <div class="card-footer bg-white border-top text-right">
                        <button type="submit" class="btn btn-success px-5 font-weight-bold">আবেদন জমা দিন</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script src="{{asset('assets/js/navbar.js')}}?v={{ time() }}"></script>
    <script>
        $(document).ready(function() {
             $(".select2").select2();

             // Close dropdowns when clicking outside
             document.addEventListener('click', function (e) {
               if (!e.target.closest('.user-dropdown-btn') && !e.target.closest('.user-dropdown-menu')) {
                 var menus = document.querySelectorAll('.user-dropdown-menu');
                 menus.forEach(function (menu) {
                   menu.classList.add('hidden');
                 });
               }
             });

            $("#organizationForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{route('public.organization.store')}}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType:false,
                    cache:false,
                    processData:false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled",true);
                    },
                    success: function (response) {
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        toastr.success(response.message);
                        setTimeout(() => {
                            location.href= response.redirect_url || '/';
                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message || "ত্রুটি হয়েছে");
                        if (responseText.errors) {
                            $.each(responseText.errors, function(key, val) {
                                thisForm.find("." + key + "_error").text(val[0]);
                                toastr.error(val[0]);
                            });
                        }
                    }
                });
            })
        })
    </script>
@endpush
