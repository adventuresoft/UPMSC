@extends('backend.master')

@section('title', 'Citizen Dashboard')

@push('style')
<script src="https://cdn.tailwindcss.com"></script>
<style>
  .content-wrapper { background: #f3f4f6 !important; }
  .stat-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
  .stat-card:hover { transform: translateY(-3px); box-shadow: 0 12px 30px rgba(0,0,0,0.12); }
</style>
@endpush

@section('content')
<div class="content-header px-6 py-4 bg-white border-b border-gray-200">
  <div class="flex items-center justify-between">
    <div>
      <h1 class="text-2xl font-bold text-gray-800">নাগরিক ড্যাশবোর্ড</h1>
      <p class="text-sm text-gray-500 mt-0.5">স্বাগতম, {{ $people->name }}</p>
    </div>
    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-50 text-green-700 text-xs font-bold rounded-full border border-green-200">
      <i class="fas fa-check-circle text-green-500"></i> যাচাইকৃত নাগরিক
    </span>
  </div>
</div>

<section class="p-6">
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Profile Card -->
    <div class="lg:col-span-1">
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-br from-[#046307] to-[#0a8a0e] p-6 text-center">
          @if($people->image)
            <img class="w-24 h-24 rounded-full mx-auto object-cover ring-4 ring-white ring-opacity-50 shadow-lg"
                 src="{{ asset($people->image) }}" alt="Profile Picture">
          @else
            <div class="w-24 h-24 rounded-full mx-auto bg-white bg-opacity-20 flex items-center justify-center text-white text-4xl font-black ring-4 ring-white ring-opacity-30 shadow-lg">
              {{ strtoupper(substr($people->name, 0, 1)) }}
            </div>
          @endif
          <h3 class="text-white font-bold text-lg mt-3">{{ $people->name }}</h3>
          <p class="text-green-200 text-sm">{{ $people->bn_name ?? '' }}</p>
        </div>

        <div class="p-5 space-y-3">
          <div class="flex justify-between items-center py-2 border-b border-gray-50">
            <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">রেজিস্ট্রেশন আইডি</span>
            <span class="text-sm font-mono font-bold text-[#046307]">{{ $people->approved_id ?? 'N/A' }}</span>
          </div>
          <div class="flex justify-between items-center py-2 border-b border-gray-50">
            <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">জাতীয় পরিচয়পত্র</span>
            <span class="text-sm font-medium text-gray-700">{{ $people->nid ?? 'N/A' }}</span>
          </div>
          <div class="flex justify-between items-center py-2 border-b border-gray-50">
            <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">মোবাইল</span>
            <span class="text-sm font-medium text-gray-700">{{ $people->mobile }}</span>
          </div>
          <div class="flex justify-between items-center py-2">
            <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">ইমেইল</span>
            <span class="text-sm font-medium text-gray-700">{{ $people->email ?? 'N/A' }}</span>
          </div>

          <div class="pt-3">
            <a href="{{ route('people.profile') }}" class="w-full block text-center py-2.5 bg-[#046307] text-white text-sm font-bold rounded-xl hover:bg-[#0a8a0e] transition">
              <i class="fas fa-user-edit mr-1"></i> প্রোফাইল দেখুন
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Right Column -->
    <div class="lg:col-span-2 space-y-6">

      <!-- Quick Actions -->
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h4 class="text-base font-bold text-gray-700 mb-4 flex items-center gap-2">
          <i class="fas fa-th-large text-[#046307]"></i>
          দ্রুত কার্যক্রম
        </h4>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <a href="{{ route('people.profile') }}"
             class="stat-card flex flex-col items-center gap-3 p-5 bg-blue-50 rounded-xl border border-blue-100 text-center hover:bg-blue-100 transition">
            <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white text-xl">
              <i class="fas fa-user-circle"></i>
            </div>
            <span class="text-sm font-bold text-blue-700">আমার প্রোফাইল</span>
          </a>

          <a href="{{ route('people.password.change') }}"
             class="stat-card flex flex-col items-center gap-3 p-5 bg-amber-50 rounded-xl border border-amber-100 text-center hover:bg-amber-100 transition">
            <div class="w-12 h-12 rounded-full bg-amber-500 flex items-center justify-center text-white text-xl">
              <i class="fas fa-shield-alt"></i>
            </div>
            <span class="text-sm font-bold text-amber-700">নিরাপত্তা</span>
          </a>

          <a href="#"
             class="stat-card flex flex-col items-center gap-3 p-5 bg-green-50 rounded-xl border border-green-100 text-center hover:bg-green-100 transition">
            <div class="w-12 h-12 rounded-full bg-[#046307] flex items-center justify-center text-white text-xl">
              <i class="fas fa-certificate"></i>
            </div>
            <span class="text-sm font-bold text-green-700">সনদপত্র</span>
          </a>
        </div>
      </div>

      <!-- Account Security Summary -->
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h4 class="text-base font-bold text-gray-700 mb-4 flex items-center gap-2">
          <i class="fas fa-shield-check text-[#046307]"></i>
          অ্যাকাউন্ট নিরাপত্তা
        </h4>
        <div class="flex items-center justify-between p-4 bg-green-50 rounded-xl border border-green-100">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center text-white">
              <i class="fas fa-check"></i>
            </div>
            <div>
              <p class="font-bold text-green-800 text-sm">অ্যাকাউন্ট সক্রিয়</p>
              <p class="text-xs text-green-600">আপনার অ্যাকাউন্ট সুরক্ষিত আছে।</p>
            </div>
          </div>
          <a href="{{ route('people.password.change') }}" class="text-xs text-[#046307] font-bold hover:underline">
            পাসওয়ার্ড পরিবর্তন করুন <i class="fas fa-arrow-right ml-1"></i>
          </a>
        </div>
      </div>

    </div>
  </div>
</section>
@endsection

