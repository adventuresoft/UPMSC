@extends('backend.master')

@section('title', 'My Profile')

@push('style')
<script src="https://cdn.tailwindcss.com"></script>
<style>
  .content-wrapper { background: #f3f4f6 !important; }
</style>
@endpush

@section('content')
<div class="content-header px-6 py-4 bg-white border-b border-gray-200">
  <div class="flex items-center justify-between">
    <div>
      <h1 class="text-2xl font-bold text-gray-800">আমার প্রোফাইল</h1>
      <nav class="text-sm text-gray-500 mt-0.5">
        <a href="{{ route('people.dashboard') }}" class="hover:text-[#046307]">ড্যাশবোর্ড</a>
        <span class="mx-2">/</span>
        <span>প্রোফাইল</span>
      </nav>
    </div>
    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-50 text-green-700 text-xs font-bold rounded-full border border-green-200">
      <i class="fas fa-check-circle text-green-500"></i> যাচাইকৃত নাগরিক
    </span>
  </div>
</div>

<section class="p-6">
  <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

    <!-- Left: Avatar + ID Card -->
    <div class="lg:col-span-1 space-y-5">
      <!-- Avatar Card -->
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden text-center">
        <div class="bg-gradient-to-br from-[#046307] to-[#0a8a0e] py-8 px-6 relative group">
          <div class="relative inline-block">
            @if($people->image)
              <img class="w-24 h-24 rounded-full mx-auto object-cover ring-4 ring-white ring-opacity-40 shadow-lg"
                   src="{{ imageUrl($people->image) }}" alt="Profile Picture">
            @else
              <div class="w-24 h-24 rounded-full mx-auto bg-white bg-opacity-20 flex items-center justify-center text-white text-4xl font-black ring-4 ring-white ring-opacity-30 shadow-lg">
                {{ strtoupper(substr($people->name, 0, 1)) }}
              </div>
            @endif
            
            <!-- Image Upload Trigger -->
            <form action="{{ route('people.profile.image.update') }}" method="POST" enctype="multipart/form-data" id="imageUploadForm" class="absolute bottom-0 right-0">
              @csrf
              <label for="imageInput" class="w-8 h-8 rounded-full bg-white shadow-md flex items-center justify-center cursor-pointer hover:bg-gray-50 transition border border-gray-100">
                <i class="fas fa-camera text-[#046307] text-xs"></i>
              </label>
              <input type="file" name="image" id="imageInput" class="hidden" accept="image/*" onchange="document.getElementById('imageUploadForm').submit()">
            </form>
          </div>

          <h3 class="text-white font-bold text-lg mt-3">{{ $people->name }}</h3>
          <p class="text-green-200 text-sm mt-0.5">{{ $people->bn_name ?? '' }}</p>
        </div>
        <div class="py-4 px-5">
          <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 text-xs font-bold rounded-full">
            <i class="fas fa-check-circle text-green-500 text-xs"></i> Verified Citizen
          </span>
        </div>
      </div>

      <!-- Identification Card -->
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-5 py-3 border-b border-gray-50">
          <h4 class="text-sm font-bold text-gray-700 flex items-center gap-2">
            <i class="fas fa-id-card text-[#046307]"></i>
            পরিচয়পত্র
          </h4>
        </div>
        <div class="p-5 space-y-4">
          <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">জাতীয় পরিচয়পত্র</p>
            <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $people->nid ?? 'N/A' }}</p>
          </div>
          <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">পিপল আইডি</p>
            <p class="text-sm font-mono font-bold text-[#046307] mt-0.5">{{ $people->approved_id ?? 'N/A' }}</p>
          </div>
          <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">মোবাইল</p>
            <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $people->mobile }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Right: Personal Details -->
    <div class="lg:col-span-3 space-y-6">

      {{-- My Detailed Information Grid --}}
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-50 flex justify-between items-center">
          <h4 class="text-base font-bold text-gray-700 flex items-center gap-2">
            <i class="fas fa-id-card text-[#046307]"></i>
            আমার বিস্তারিত তথ্যসমূহ
          </h4>
          <a href="{{ route('people.applications.registration.create') }}" class="text-xs font-bold text-[#046307] hover:underline">হালনাগাদ করুন →</a>
        </div>
        <div class="p-6 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
          {{-- Education --}}
          <a href="{{ route('people.applications.registration.education', $people->id) }}" class="p-3 rounded-xl border border-gray-100 bg-gray-50 hover:bg-green-50 hover:border-green-200 transition group flex flex-col items-center text-center">
            <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shadow-sm mb-2 relative">
              <i class="fas fa-graduation-cap text-[#046307] text-lg"></i>
              @if(count($people->user->educationInfos ?? []))
                <span class="absolute top-0 right-0 w-3.5 h-3.5 bg-green-500 border-2 border-white rounded-full"></span>
              @endif
            </div>
            <p class="text-[10px] font-bold text-gray-700">শিক্ষাগত তথ্য</p>
          </a>

          {{-- Profession --}}
          <a href="{{ route('people.applications.registration.professional', $people->id) }}" class="p-3 rounded-xl border border-gray-100 bg-gray-50 hover:bg-green-50 hover:border-green-200 transition group flex flex-col items-center text-center">
            <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shadow-sm mb-2 relative">
              <i class="fas fa-briefcase text-[#046307] text-lg"></i>
              @if(count($people->user->professionalInfos ?? []))
                <span class="absolute top-0 right-0 w-3.5 h-3.5 bg-green-500 border-2 border-white rounded-full"></span>
              @endif
            </div>
            <p class="text-[10px] font-bold text-gray-700">পেশাগত তথ্য</p>
          </a>

          {{-- Financial --}}
          <a href="{{ route('people.applications.registration.financial', $people->id) }}" class="p-3 rounded-xl border border-gray-100 bg-gray-50 hover:bg-green-50 hover:border-green-200 transition group flex flex-col items-center text-center">
            <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shadow-sm mb-2 relative">
              <i class="fas fa-wallet text-[#046307] text-lg"></i>
              @if(count($people->user->financialInfos ?? []))
                <span class="absolute top-0 right-0 w-3.5 h-3.5 bg-green-500 border-2 border-white rounded-full"></span>
              @endif
            </div>
            <p class="text-[10px] font-bold text-gray-700">আর্থিক তথ্য</p>
          </a>

          {{-- Property --}}
          <a href="{{ route('people.applications.registration.property', $people->id) }}" class="p-3 rounded-xl border border-gray-100 bg-gray-50 hover:bg-green-50 hover:border-green-200 transition group flex flex-col items-center text-center">
            <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shadow-sm mb-2 relative">
              <i class="fas fa-building text-[#046307] text-lg"></i>
              @if(count($people->user->propertyInfos ?? []))
                <span class="absolute top-0 right-0 w-3.5 h-3.5 bg-green-500 border-2 border-white rounded-full"></span>
              @endif
            </div>
            <p class="text-[10px] font-bold text-gray-700">সম্পদ তথ্য</p>
          </a>

          {{-- Disability --}}
          <a href="{{ route('people.applications.registration.disability', $people->id) }}" class="p-3 rounded-xl border border-gray-100 bg-gray-50 hover:bg-green-50 hover:border-green-200 transition group flex flex-col items-center text-center">
            <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shadow-sm mb-2 relative">
              <i class="fas fa-wheelchair text-[#046307] text-lg"></i>
              @if(($people->user->disabilityInfo->is_disability ?? 0) == 1)
                <span class="absolute top-0 right-0 w-3.5 h-3.5 bg-green-500 border-2 border-white rounded-full"></span>
              @endif
            </div>
            <p class="text-[10px] font-bold text-gray-700">প্রতিবন্ধিতা</p>
          </a>

          {{-- Freedom Fighter --}}
          <a href="{{ route('people.applications.registration.freedom', $people->id) }}" class="p-3 rounded-xl border border-gray-100 bg-gray-50 hover:bg-green-50 hover:border-green-200 transition group flex flex-col items-center text-center">
            <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shadow-sm mb-2 relative">
              <i class="fas fa-medal text-[#046307] text-lg"></i>
              @if(($people->user->freedomFighterInfo->is_freedom_fighter ?? 0) == 1)
                <span class="absolute top-0 right-0 w-3.5 h-3.5 bg-green-500 border-2 border-white rounded-full"></span>
              @endif
            </div>
            <p class="text-[10px] font-bold text-gray-700">মুক্তিযোদ্ধা</p>
          </a>
        </div>
      </div>
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-gray-50 border-b border-gray-100 px-6 py-4">
          <h4 class="text-base font-bold text-gray-700 flex items-center gap-2">
            <i class="fas fa-user text-[#046307]"></i>
            ব্যক্তিগত তথ্য
          </h4>
        </div>

        <div class="divide-y divide-gray-50">
          @php
            $rows = [
              ['label' => 'পূর্ণ নাম (ইংরেজি)', 'icon' => 'fa-user', 'value' => $people->name],
              ['label' => 'পূর্ণ নাম (বাংলা)', 'icon' => 'fa-user', 'value' => $people->bn_name ?? '—'],
              ['label' => 'লিঙ্গ', 'icon' => 'fa-venus-mars', 'value' => people_constant_option('gender')[$people->gender ?? ''] ?? '—'],
              ['label' => 'জন্ম তারিখ', 'icon' => 'fa-calendar-alt', 'value' => $people->date_of_birth ? \Carbon\Carbon::parse($people->date_of_birth)->format('d M, Y') : '—'],
              ['label' => 'রক্তের গ্রুপ', 'icon' => 'fa-tint', 'value' => people_constant_option('blood_group')[$people->blood_group ?? ''] ?? '—'],
              ['label' => 'জেলা', 'icon' => 'fa-map-marker-alt', 'value' => $people->user->addressInfo->presentDistrict->name ?? '—'],
            ];
          @endphp

          @foreach($rows as $row)
            <div class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50 transition">
              <div class="w-9 h-9 rounded-xl bg-green-50 flex items-center justify-center flex-shrink-0">
                <i class="fas {{ $row['icon'] }} text-[#046307] text-sm"></i>
              </div>
              <div class="flex-1 min-w-0">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">{{ $row['label'] }}</p>
                <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $row['value'] }}</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <!-- Action Links -->
      <div class="mt-5 flex flex-wrap gap-3">
        <a href="{{ route('people.password.change') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#046307] text-white text-sm font-bold rounded-xl hover:bg-[#0a8a0e] transition shadow-sm">
          <i class="fas fa-shield-alt"></i>
          পাসওয়ার্ড পরিবর্তন
        </a>
        <a href="{{ route('people.dashboard') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-200 text-gray-600 text-sm font-bold rounded-xl hover:bg-gray-50 transition shadow-sm">
          <i class="fas fa-arrow-left"></i>
          ড্যাশবোর্ডে ফিরুন
        </a>
      </div>
    </div>

  </div>
</section>
@endsection

