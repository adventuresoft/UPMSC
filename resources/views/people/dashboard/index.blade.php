@extends('backend.master')

@section('title', 'নাগরিক ড্যাশবোর্ড')

@push('style')
<script src="https://cdn.tailwindcss.com"></script>
<style>
  .content-wrapper { background: #f0f4f8 !important; }
  .dash-root { font-family: 'Hind Siliguri', 'Inter', sans-serif; }
  .service-form { max-height: 0; overflow: hidden; transition: max-height 0.35s ease; }
  .service-form.open { max-height: 400px; }
  .lift-hover { transition: transform 0.2s ease, box-shadow 0.2s ease; }
  .lift-hover:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.10); }
</style>
<link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@endpush

@section('content')
<div class="dash-root min-h-screen">

  {{-- PAGE HEADER --}}
  <div class="bg-white border-b border-gray-200 px-5 py-3 flex items-center justify-between" style="min-height:56px">
    <div class="flex items-center gap-3">
      <div class="w-8 h-8 rounded-lg bg-[#046307] flex items-center justify-center flex-shrink-0">
        <i class="fas fa-home text-white text-xs"></i>
      </div>
      <div>
        <h1 class="text-base font-bold text-gray-800 leading-tight">নাগরিক ড্যাশবোর্ড</h1>
        <p class="text-xs text-gray-500 leading-none">স্বাগতম, <span class="font-semibold text-[#046307]">{{ $people->name }}</span></p>
      </div>
    </div>
    <div class="flex items-center gap-2">
      <span class="hidden sm:inline-flex items-center gap-1.5 px-2.5 py-1 bg-green-50 text-green-700 text-xs font-semibold rounded-full border border-green-200">
        <i class="fas fa-check-circle text-green-500 text-xs"></i> যাচাইকৃত নাগরিক
      </span>
      <a href="{{ route('people.profile') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-[#046307] text-white text-xs font-semibold rounded-lg hover:bg-[#0a8a0e] transition">
        <i class="fas fa-user text-xs"></i> <span class="hidden sm:inline">প্রোফাইল</span>
      </a>
    </div>
  </div>

  {{-- MAIN CONTENT --}}
  <div class="px-4 py-4 max-w-screen-xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">

      {{-- LEFT SIDEBAR --}}
      <div class="lg:col-span-3 space-y-4">

        {{-- Profile Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
          <div class="bg-gradient-to-br from-[#046307] to-[#1a7a1e] px-4 py-5 text-center">
            <div class="relative inline-block">
              @if($people->image)
                <img class="w-16 h-16 rounded-full mx-auto object-cover ring-2 ring-white ring-opacity-60 shadow"
                     src="{{ asset($people->image) }}" alt="ছবি">
              @else
                <div class="w-16 h-16 rounded-full mx-auto bg-white bg-opacity-25 flex items-center justify-center text-white text-2xl font-black ring-2 ring-white ring-opacity-40 shadow">
                  {{ strtoupper(substr($people->name, 0, 1)) }}
                </div>
              @endif
              <a href="{{ route('people.profile') }}"
                 class="absolute bottom-0 right-0 w-5 h-5 rounded-full bg-white shadow flex items-center justify-center hover:bg-gray-50 transition">
                <i class="fas fa-camera text-[#046307]" style="font-size:8px"></i>
              </a>
            </div>
            <h3 class="text-white font-bold text-sm mt-2 leading-tight">{{ $people->name }}</h3>
            @if($people->bn_name)
              <p class="text-green-200 text-xs mt-0.5">{{ $people->bn_name }}</p>
            @endif
          </div>

          <div class="px-4 py-3 space-y-2.5">
            <div class="flex justify-between items-center">
              <span class="text-xs text-gray-500 font-medium">রেজিস্ট্রেশন আইডি</span>
              <span class="text-xs font-bold text-[#046307] font-mono">{{ $people->approved_id ?? 'N/A' }}</span>
            </div>
            <div class="w-full h-px bg-gray-100"></div>
            <div class="flex justify-between items-center">
              <span class="text-xs text-gray-500 font-medium">জাতীয় পরিচয়পত্র</span>
              <span class="text-xs font-semibold text-gray-700">{{ $people->nid ?? 'N/A' }}</span>
            </div>
            <div class="w-full h-px bg-gray-100"></div>
            <div class="flex justify-between items-center">
              <span class="text-xs text-gray-500 font-medium">মোবাইল</span>
              <span class="text-xs font-semibold text-gray-700">{{ $people->mobile ?? 'N/A' }}</span>
            </div>
            <div class="w-full h-px bg-gray-100"></div>
            <div class="flex justify-between items-center">
              <span class="text-xs text-gray-500 font-medium">ইমেইল</span>
              <span class="text-xs font-semibold text-gray-700 truncate max-w-28">{{ $people->email ?? 'N/A' }}</span>
            </div>
          </div>

          <div class="px-4 pb-4 space-y-2">
            <a href="{{ route('people.profile') }}"
               class="w-full flex items-center justify-center gap-2 py-2 bg-[#046307] text-white text-xs font-bold rounded-lg hover:bg-[#0a8a0e] transition">
              <i class="fas fa-user-edit"></i> প্রোফাইল দেখুন
            </a>
            <a href="{{ route('people.password.change') }}"
               class="w-full flex items-center justify-center gap-2 py-2 border border-gray-200 text-gray-600 text-xs font-semibold rounded-lg hover:bg-gray-50 transition">
              <i class="fas fa-shield-alt text-amber-500"></i> পাসওয়ার্ড পরিবর্তন
            </a>
          </div>
        </div>

        {{-- Account Status --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
          <h5 class="text-xs font-bold text-gray-600 uppercase tracking-wider mb-3 flex items-center gap-1.5">
            <i class="fas fa-shield-check text-[#046307]"></i> অ্যাকাউন্ট অবস্থা
          </h5>
          <div class="flex items-center gap-2.5 p-3 bg-green-50 rounded-lg border border-green-100">
            <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center flex-shrink-0">
              <i class="fas fa-check text-white text-xs"></i>
            </div>
            <div>
              <p class="text-xs font-bold text-green-800">অ্যাকাউন্ট সক্রিয়</p>
              <p class="text-xs text-green-600 leading-tight mt-0.5">সুরক্ষিত ও যাচাইকৃত</p>
            </div>
          </div>
        </div>

      </div>

      {{-- MAIN RIGHT AREA --}}
      <div class="lg:col-span-9 space-y-4">

        {{-- Service Cards --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
          <div class="px-4 pt-4">
            <h4 class="text-sm font-bold text-gray-700 flex items-center gap-2">
              <i class="fas fa-concierge-bell text-[#046307]"></i>
              নাগরিক সেবাসমূহ
            </h4>
          </div>

          {{-- Status Check Results --}}
          @if(session('status_check'))
          <div class="px-4 pt-4">
            <div class="rounded-xl border border-opacity-30 p-4 {{ session('status_check.found') ? 'bg-green-50 border-green-500' : 'bg-red-50 border-red-500' }}">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full flex items-center justify-center {{ session('status_check.found') ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                  <i class="fas {{ session('status_check.found') ? 'fa-check-circle' : 'fa-exclamation-circle' }}"></i>
                </div>
                <div>
                  <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">আবেদনের বর্তমান অবস্থা</p>
                  <h4 class="text-sm font-bold text-gray-800">
                    আবেদন আইডি: <span class="text-blue-600">{{ session('status_check.id') }}</span>
                  </h4>
                  <p class="text-sm font-bold {{ session('status_check.found') ? 'text-green-700' : 'text-red-700' }}">
                    অবস্থা: {{ session('status_check.status') }}
                  </p>
                </div>
              </div>
            </div>
          </div>
          @endif

          {{-- Row 1: সনদপত্র --}}
          <div class="p-4 pb-2 grid grid-cols-1 sm:grid-cols-2 gap-4">

            {{-- GREEN: সনদপত্র আবেদন --}}
            <div class="rounded-xl border border-[#046307] border-opacity-30 overflow-hidden lift-hover">
              <div class="border-t-4 border-[#046307] p-5">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-3" style="background:#e6f4e7">
                  <i class="fas fa-pen text-[#046307] text-base"></i>
                </div>
                <h5 class="text-sm font-bold text-gray-800 mb-1">সনদপত্র আবেদন</h5>
                <p class="text-xs text-gray-500 leading-relaxed mb-4">অনলাইনে সনদপত্রের জন্য আবেদন করুন।</p>
                <button onclick="toggleServiceForm('form-cert-app', this)"
                        class="w-full inline-flex items-center justify-center gap-2 py-2.5 bg-[#046307] text-white text-xs font-bold rounded-lg hover:bg-[#0a8a0e] transition">
                  <i class="fas fa-pen text-xs"></i> আবেদন করুন
                </button>
              </div>
              <div id="form-cert-app" class="service-form border-t border-[#046307] border-opacity-20" style="background:#f0f9f0">
                <div class="p-4">
                  <p class="text-xs text-gray-600 mb-3 leading-relaxed">কোন ধরনের সনদপত্রের আবেদন করতে চান তা বেছে নিন।</p>
                  <div class="space-y-2">
                    <a href="{{ route('people.applications.certificate.create') }}"
                       class="w-full flex items-center justify-center gap-2 py-2.5 bg-[#046307] text-white text-xs font-bold rounded-lg hover:bg-[#0a8a0e] transition">
                      <i class="fas fa-plus-circle text-xs"></i> নতুন আবেদন করুন
                    </a>
                    <a href="{{ route('certificate.verify') }}"
                       class="w-full flex items-center justify-center gap-2 py-2.5 border border-[#046307] text-[#046307] text-xs font-bold rounded-lg hover:bg-green-50 transition">
                      <i class="fas fa-search text-xs"></i> সনদ যাচাই করুন
                    </a>
                  </div>
                </div>
              </div>
            </div>

            {{-- TEAL: সনদপত্র যাচাই --}}
            <div class="rounded-xl border border-[#17a3b8] border-opacity-30 overflow-hidden lift-hover">
              <div class="border-t-4 border-[#17a3b8] p-5">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-3" style="background:#e0f7fb">
                  <i class="fas fa-search text-[#17a3b8] text-base"></i>
                </div>
                <h5 class="text-sm font-bold text-gray-800 mb-1">সনদপত্র যাচাই</h5>
                <p class="text-xs text-gray-500 leading-relaxed mb-4">সনদপত্র নম্বর দিয়ে সনদের সত্যতা যাচাই করুন।</p>
                <button onclick="toggleServiceForm('form-cert-verify', this)"
                        class="w-full inline-flex items-center justify-center gap-2 py-2.5 bg-[#17a3b8] text-white text-xs font-bold rounded-lg hover:bg-[#138fa3] transition">
                  <i class="fas fa-search text-xs"></i> যাচাই করুন
                </button>
              </div>
              <div id="form-cert-verify" class="service-form border-t border-[#17a3b8] border-opacity-20" style="background:#f0fbfd">
                <div class="p-4">
                  <form action="{{ route('people.status.check') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="certificate">
                    <label class="block text-xs font-bold text-gray-600 mb-1">সনদপত্র নম্বর লিখুন</label>
                    <input type="text" name="id" placeholder="উদাঃ CIT-20240001"
                           class="w-full border border-[#17a3b8] border-opacity-30 rounded-lg px-3 py-2 text-xs bg-white focus:outline-none focus:ring-2 focus:ring-[#17a3b8] mb-3" required>
                    <button type="submit" class="w-full py-2.5 bg-[#17a3b8] text-white text-xs font-bold rounded-lg hover:bg-[#138fa3] transition flex items-center justify-center gap-2">
                      <i class="fas fa-search text-xs"></i> অবস্থা যাচাই করুন
                    </button>
                  </form>
                </div>
              </div>
            </div>

          </div>

          {{-- Row 2: ট্রেড লাইসেন্স --}}
          <div class="px-4 pb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">

            {{-- GREEN: ট্রেড লাইসেন্সের আবেদন --}}
            <div class="rounded-xl border border-[#046307] border-opacity-30 overflow-hidden lift-hover">
              <div class="border-t-4 border-[#046307] p-5">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-3" style="background:#e6f4e7">
                  <i class="fas fa-pen text-[#046307] text-base"></i>
                </div>
                <h5 class="text-sm font-bold text-gray-800 mb-1">ট্রেড লাইসেন্সের আবেদন</h5>
                <p class="text-xs text-gray-500 leading-relaxed mb-4">ট্রেড লাইসেন্সের জন্য অনলাইনে আবেদন করুন।</p>
                <button onclick="toggleServiceForm('form-trade-app', this)"
                        class="w-full inline-flex items-center justify-center gap-2 py-2.5 bg-[#046307] text-white text-xs font-bold rounded-lg hover:bg-[#0a8a0e] transition">
                  <i class="fas fa-pen text-xs"></i> আবেদন করুন
                </button>
              </div>
              <div id="form-trade-app" class="service-form border-t border-[#046307] border-opacity-20" style="background:#f0f9f0">
                <div class="p-4">
                  <p class="text-xs text-gray-600 mb-3 leading-relaxed">ট্রেড লাইসেন্সের জন্য আবেদন করতে নিচের বাটনে ক্লিক করুন।</p>
                  <div class="space-y-2">
                    <a href="{{ route('people.applications.trade-license.create') }}"
                       class="w-full flex items-center justify-center gap-2 py-2.5 bg-[#046307] text-white text-xs font-bold rounded-lg hover:bg-[#0a8a0e] transition">
                      <i class="fas fa-plus-circle text-xs"></i> নতুন আবেদন করুন
                    </a>
                    <a href="{{ route('organizationA.trade-license.index') }}"
                       class="w-full flex items-center justify-center gap-2 py-2.5 border border-[#046307] text-[#046307] text-xs font-bold rounded-lg hover:bg-green-50 transition">
                      <i class="fas fa-list text-xs"></i> আবেদনের তালিকা দেখুন
                    </a>
                  </div>
                </div>
              </div>
            </div>
            {{-- TEAL: ট্রেড লাইসেন্স যাচাই --}}
            <div class="rounded-xl border border-[#17a3b8] border-opacity-30 overflow-hidden lift-hover">
              <div class="border-t-4 border-[#17a3b8] p-5">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-3" style="background:#e0f7fb">
                  <i class="fas fa-search text-[#17a3b8] text-base"></i>
                </div>
                <h5 class="text-sm font-bold text-gray-800 mb-1">ট্রেড লাইসেন্স যাচাই</h5>
                <p class="text-xs text-gray-500 leading-relaxed mb-4">ট্রেড লাইসেন্স নম্বর দিয়ে আবেদনের অবস্থা যাচাই করুন।</p>
                <button onclick="toggleServiceForm('form-trade-verify', this)"
                        class="w-full inline-flex items-center justify-center gap-2 py-2.5 bg-[#17a3b8] text-white text-xs font-bold rounded-lg hover:bg-[#138fa3] transition">
                  <i class="fas fa-search text-xs"></i> যাচাই করুন
                </button>
              </div>
              <div id="form-trade-verify" class="service-form border-t border-[#17a3b8] border-opacity-20" style="background:#f0fbfd">
                <div class="p-4">
                  <form action="{{ route('people.status.check') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="trade_license">
                    <label class="block text-xs font-bold text-gray-600 mb-1">লাইসেন্স/আবেদন আইডি লিখুন</label>
                    <input type="text" name="id" placeholder="উদাঃ TL-20240001"
                           class="w-full border border-[#17a3b8] border-opacity-30 rounded-lg px-3 py-2 text-xs bg-white focus:outline-none focus:ring-2 focus:ring-[#17a3b8] mb-3" required>
                    <button type="submit" class="w-full py-2.5 bg-[#17a3b8] text-white text-xs font-bold rounded-lg hover:bg-[#138fa3] transition flex items-center justify-center gap-2">
                      <i class="fas fa-search text-xs"></i> অবস্থা যাচাই করুন
                    </button>
                  </form>
                </div>
              </div>
            </div>

          </div>
          <div class="px-4 pb-2 grid grid-cols-1 sm:grid-cols-2 gap-4">

            {{-- GREEN: যানবাহন আবেদন --}}
            <div class="rounded-xl border border-[#046307] border-opacity-30 overflow-hidden lift-hover">
              <div class="border-t-4 border-[#046307] p-5">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-3" style="background:#e6f4e7">
                  <i class="fas fa-car text-[#046307] text-base"></i>
                </div>
                <h5 class="text-sm font-bold text-gray-800 mb-1">যানবাহন আবেদন</h5>
                <p class="text-xs text-gray-500 leading-relaxed mb-4">যানবাহনের লাইসেন্স বা নিবন্ধনের জন্য আবেদন করুন।</p>
                <button onclick="toggleServiceForm('form-vehicle-app', this)"
                        class="w-full inline-flex items-center justify-center gap-2 py-2.5 bg-[#046307] text-white text-xs font-bold rounded-lg hover:bg-[#0a8a0e] transition">
                  <i class="fas fa-pen text-xs"></i> আবেদন করুন
                </button>
              </div>
              <div id="form-vehicle-app" class="service-form border-t border-[#046307] border-opacity-20" style="background:#f0f9f0">
                <div class="p-4">
                  <p class="text-xs text-gray-600 mb-3 leading-relaxed">যানবাহন নিবন্ধনের জন্য আবেদন করতে নিচের বাটনে ক্লিক করুন।</p>
                  <div class="space-y-2">
                    <a href="{{ route('people.applications.vehicle.create') }}"
                       class="w-full flex items-center justify-center gap-2 py-2.5 bg-[#046307] text-white text-xs font-bold rounded-lg hover:bg-[#0a8a0e] transition">
                      <i class="fas fa-plus-circle text-xs"></i> নতুন আবেদন করুন
                    </a>
                  </div>
                </div>
              </div>
            </div>

            {{-- TEAL: যানবাহন যাচাই --}}
            <div class="rounded-xl border border-[#17a3b8] border-opacity-30 overflow-hidden lift-hover">
              <div class="border-t-4 border-[#17a3b8] p-5">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-3" style="background:#e0f7fb">
                  <i class="fas fa-search text-[#17a3b8] text-base"></i>
                </div>
                <h5 class="text-sm font-bold text-gray-800 mb-1">যানবাহন যাচাই</h5>
                <p class="text-xs text-gray-500 leading-relaxed mb-4">যানবাহন নম্বর দিয়ে আবেদনের অবস্থা যাচাই করুন।</p>
                <button onclick="toggleServiceForm('form-vehicle-verify', this)"
                        class="w-full inline-flex items-center justify-center gap-2 py-2.5 bg-[#17a3b8] text-white text-xs font-bold rounded-lg hover:bg-[#138fa3] transition">
                  <i class="fas fa-search text-xs"></i> যাচাই করুন
                </button>
              </div>
              <div id="form-vehicle-verify" class="service-form border-t border-[#17a3b8] border-opacity-20" style="background:#f0fbfd">
                <div class="p-4">
                  <form action="{{ route('people.status.check') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="vehicle">
                    <label class="block text-xs font-bold text-gray-600 mb-1">যানবাহন/আবেদন আইডি লিখুন</label>
                    <input type="text" name="id" placeholder="উদাঃ VH-20240001"
                           class="w-full border border-[#17a3b8] border-opacity-30 rounded-lg px-3 py-2 text-xs bg-white focus:outline-none focus:ring-2 focus:ring-[#17a3b8] mb-3" required>
                    <button type="submit" class="w-full py-2.5 bg-[#17a3b8] text-white text-xs font-bold rounded-lg hover:bg-[#138fa3] transition flex items-center justify-center gap-2">
                      <i class="fas fa-search text-xs"></i> অবস্থা যাচাই করুন
                    </button>
                  </form>
                </div>
              </div>
            </div>

          </div>

          {{-- Row 4: হোল্ডিং ট্যাক্স --}}
          <div class="px-4 pb-2 grid grid-cols-1 sm:grid-cols-2 gap-4">

            {{-- GREEN: হোল্ডিং ট্যাক্স আবেদন --}}
            <div class="rounded-xl border border-[#046307] border-opacity-30 overflow-hidden lift-hover">
              <div class="border-t-4 border-[#046307] p-5">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-3" style="background:#e6f4e7">
                  <i class="fas fa-home text-[#046307] text-base"></i>
                </div>
                <h5 class="text-sm font-bold text-gray-800 mb-1">হোল্ডিং ট্যাক্স আবেদন</h5>
                <p class="text-xs text-gray-500 leading-relaxed mb-4">হোল্ডিং ট্যাক্স নির্ধারণ বা পরিবর্তনের আবেদন করুন।</p>
                <button onclick="toggleServiceForm('form-tax-app', this)"
                        class="w-full inline-flex items-center justify-center gap-2 py-2.5 bg-[#046307] text-white text-xs font-bold rounded-lg hover:bg-[#0a8a0e] transition">
                  <i class="fas fa-pen text-xs"></i> আবেদন করুন
                </button>
              </div>
              <div id="form-tax-app" class="service-form border-t border-[#046307] border-opacity-20" style="background:#f0f9f0">
                <div class="p-4">
                  <div class="space-y-2">
                    <a href="{{ route('people.applications.tax.create') }}"
                       class="w-full flex items-center justify-center gap-2 py-2.5 bg-[#046307] text-white text-xs font-bold rounded-lg hover:bg-[#0a8a0e] transition">
                      <i class="fas fa-plus-circle text-xs"></i> নতুন আবেদন করুন
                    </a>
                  </div>
                </div>
              </div>
            </div>

            {{-- TEAL: হোল্ডিং ট্যাক্স যাচাই --}}
            <div class="rounded-xl border border-[#17a3b8] border-opacity-30 overflow-hidden lift-hover">
              <div class="border-t-4 border-[#17a3b8] p-5">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-3" style="background:#e0f7fb">
                  <i class="fas fa-search text-[#17a3b8] text-base"></i>
                </div>
                <h5 class="text-sm font-bold text-gray-800 mb-1">হোল্ডিং ট্যাক্স যাচাই</h5>
                <p class="text-xs text-gray-500 leading-relaxed mb-4">হোল্ডিং নম্বর দিয়ে ট্যাক্স বা আবেদনের অবস্থা যাচাই করুন।</p>
                <button onclick="toggleServiceForm('form-tax-verify', this)"
                        class="w-full inline-flex items-center justify-center gap-2 py-2.5 bg-[#17a3b8] text-white text-xs font-bold rounded-lg hover:bg-[#138fa3] transition">
                  <i class="fas fa-search text-xs"></i> যাচাই করুন
                </button>
              </div>
              <div id="form-tax-verify" class="service-form border-t border-[#17a3b8] border-opacity-20" style="background:#f0fbfd">
                <div class="p-4">
                  <form action="{{ route('people.status.check') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="tax">
                    <label class="block text-xs font-bold text-gray-600 mb-1">হোল্ডিং নম্বর লিখুন</label>
                    <input type="text" name="id" placeholder="উদাঃ HT-20240001"
                           class="w-full border border-[#17a3b8] border-opacity-30 rounded-lg px-3 py-2 text-xs bg-white focus:outline-none focus:ring-2 focus:ring-[#17a3b8] mb-3" required>
                    <button type="submit" class="w-full py-2.5 bg-[#17a3b8] text-white text-xs font-bold rounded-lg hover:bg-[#138fa3] transition flex items-center justify-center gap-2">
                      <i class="fas fa-search text-xs"></i> অবস্থা যাচাই করুন
                    </button>
                  </form>
                </div>
              </div>
            </div>

          </div>

          {{-- Row 5: অনুদান প্রাপ্তি --}}
          <div class="px-4 pb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">

            {{-- GREEN: অনুদান আবেদন --}}
            <div class="rounded-xl border border-[#046307] border-opacity-30 overflow-hidden lift-hover">
              <div class="border-t-4 border-[#046307] p-5">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-3" style="background:#e6f4e7">
                  <i class="fas fa-hand-holding-heart text-[#046307] text-base"></i>
                </div>
                <h5 class="text-sm font-bold text-gray-800 mb-1">অনুদান প্রাপ্তির আবেদন</h5>
                <p class="text-xs text-gray-500 leading-relaxed mb-4">বিভিন্ন সরকারি অনুদান বা সহায়তার জন্য আবেদন করুন।</p>
                <button onclick="toggleServiceForm('form-grant-app', this)"
                        class="w-full inline-flex items-center justify-center gap-2 py-2.5 bg-[#046307] text-white text-xs font-bold rounded-lg hover:bg-[#0a8a0e] transition">
                  <i class="fas fa-pen text-xs"></i> আবেদন করুন
                </button>
              </div>
              <div id="form-grant-app" class="service-form border-t border-[#046307] border-opacity-20" style="background:#f0f9f0">
                <div class="p-4">
                  <div class="space-y-2">
                    <a href="{{ route('people.applications.grant.create') }}"
                       class="w-full flex items-center justify-center gap-2 py-2.5 bg-[#046307] text-white text-xs font-bold rounded-lg hover:bg-[#0a8a0e] transition">
                      <i class="fas fa-plus-circle text-xs"></i> নতুন আবেদন করুন
                    </a>
                  </div>
                </div>
              </div>
            </div>

            {{-- TEAL: অনুদান যাচাই --}}
            <div class="rounded-xl border border-[#17a3b8] border-opacity-30 overflow-hidden lift-hover">
              <div class="border-t-4 border-[#17a3b8] p-5">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-3" style="background:#e0f7fb">
                  <i class="fas fa-search text-[#17a3b8] text-base"></i>
                </div>
                <h5 class="text-sm font-bold text-gray-800 mb-1">অনুদান যাচাই</h5>
                <p class="text-xs text-gray-500 leading-relaxed mb-4">অনুদান আবেদনের বর্তমান অবস্থা যাচাই করুন।</p>
                <button onclick="toggleServiceForm('form-grant-verify', this)"
                        class="w-full inline-flex items-center justify-center gap-2 py-2.5 bg-[#17a3b8] text-white text-xs font-bold rounded-lg hover:bg-[#138fa3] transition">
                  <i class="fas fa-search text-xs"></i> যাচাই করুন
                </button>
              </div>
              <div id="form-grant-verify" class="service-form border-t border-[#17a3b8] border-opacity-20" style="background:#f0fbfd">
                <div class="p-4">
                  <form action="{{ route('people.status.check') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="grant">
                    <label class="block text-xs font-bold text-gray-600 mb-1">আবেদন আইডি লিখুন</label>
                    <input type="text" name="id" placeholder="উদাঃ GR-20240001"
                           class="w-full border border-[#17a3b8] border-opacity-30 rounded-lg px-3 py-2 text-xs bg-white focus:outline-none focus:ring-2 focus:ring-[#17a3b8] mb-3" required>
                    <button type="submit" class="w-full py-2.5 bg-[#17a3b8] text-white text-xs font-bold rounded-lg hover:bg-[#138fa3] transition flex items-center justify-center gap-2">
                      <i class="fas fa-search text-xs"></i> অবস্থা যাচাই করুন
                    </button>
                  </form>
                </div>
              </div>
            </div>

          </div>


        </div>

        {{-- Info Banner --}}
        <div class="bg-gradient-to-r from-[#046307] to-[#0d7a10] rounded-xl p-4 flex items-center gap-4">
          <div class="w-10 h-10 rounded-full bg-white bg-opacity-15 flex items-center justify-center flex-shrink-0">
            <i class="fas fa-info-circle text-white text-base"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-white text-xs font-bold leading-tight">আপনার তথ্য সুরক্ষিত আছে</p>
            <p class="text-green-200 text-xs mt-0.5 leading-relaxed">যেকোনো সমস্যায় ইউনিয়ন পরিষদ অফিসে যোগাযোগ করুন বা হেল্পলাইনে কল করুন।</p>
          </div>
          <a href="{{ route('people.password.change') }}"
             class="flex-shrink-0 px-3 py-1.5 bg-white text-[#046307] text-xs font-bold rounded-lg hover:bg-green-50 transition whitespace-nowrap">
            নিরাপত্তা →
          </a>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
<script>
function toggleServiceForm(formId, btn) {
    const targetForm = document.getElementById(formId);
    const isOpen = targetForm.classList.contains('open');

    document.querySelectorAll('.service-form').forEach(function(f) {
        f.classList.remove('open');
    });

    if (!isOpen) {
        targetForm.classList.add('open');
        setTimeout(function() {
            const inp = targetForm.querySelector('input');
            if (inp) inp.focus();
        }, 350);
    }
}
</script>
@endpush
