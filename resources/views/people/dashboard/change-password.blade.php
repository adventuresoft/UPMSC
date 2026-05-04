@extends('backend.master')

@section('title', 'Account Security')

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
      <h1 class="text-2xl font-bold text-gray-800">অ্যাকাউন্ট নিরাপত্তা</h1>
      <nav class="text-sm text-gray-500 mt-0.5">
        <a href="{{ route('people.dashboard') }}" class="hover:text-[#046307]">ড্যাশবোর্ড</a>
        <span class="mx-2">/</span>
        <span>নিরাপত্তা</span>
      </nav>
    </div>
  </div>
</div>

<section class="p-6">
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- Password Form -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
      <div class="bg-gradient-to-r from-[#046307] to-[#0a8a0e] px-6 py-4">
        <h3 class="text-white font-bold text-base flex items-center gap-2">
          <i class="fas fa-key"></i>
          পাসওয়ার্ড পরিবর্তন করুন
        </h3>
      </div>
      <div class="p-6">

        @if(session('success'))
          <div class="mb-5 flex items-start gap-3 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
            <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
            <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
          </div>
        @endif

        @if($errors->any())
          <div class="mb-5 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
            <div class="flex items-center gap-2 text-red-700 font-bold text-sm mb-2">
              <i class="fas fa-exclamation-circle"></i> ত্রুটি পাওয়া গেছে
            </div>
            <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('people.password.update') }}" method="POST" class="space-y-5">
          @csrf

          <div>
            <label for="current_password" class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">বর্তমান পাসওয়ার্ড</label>
            <div class="relative">
              <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                <i class="fas fa-lock text-sm"></i>
              </span>
              <input type="password" name="current_password" id="current_password"
                     class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#046307] focus:border-transparent outline-none transition text-sm"
                     placeholder="বর্তমান পাসওয়ার্ড লিখুন" required>
            </div>
          </div>

          <div>
            <label for="password" class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">নতুন পাসওয়ার্ড</label>
            <div class="relative">
              <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                <i class="fas fa-shield-alt text-sm"></i>
              </span>
              <input type="password" name="password" id="password"
                     class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#046307] focus:border-transparent outline-none transition text-sm"
                     placeholder="নতুন পাসওয়ার্ড লিখুন (কমপক্ষে ৮ অক্ষর)" required>
            </div>
          </div>

          <div>
            <label for="password_confirmation" class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">পাসওয়ার্ড নিশ্চিত করুন</label>
            <div class="relative">
              <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                <i class="fas fa-check-circle text-sm"></i>
              </span>
              <input type="password" name="password_confirmation" id="password_confirmation"
                     class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#046307] focus:border-transparent outline-none transition text-sm"
                     placeholder="পাসওয়ার্ড পুনরায় লিখুন" required>
            </div>
          </div>

          <button type="submit" class="w-full py-3.5 bg-[#046307] text-white font-bold rounded-xl hover:bg-[#0a8a0e] transition shadow-lg active:scale-95">
            <i class="fas fa-save mr-2"></i> পাসওয়ার্ড আপডেট করুন
          </button>
        </form>
      </div>
    </div>

    <!-- Recent Login Activity -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
      <div class="bg-gray-700 px-6 py-4">
        <h3 class="text-white font-bold text-base flex items-center gap-2">
          <i class="fas fa-history"></i>
          সাম্প্রতিক লগইন কার্যক্রম
        </h3>
      </div>
      <div class="divide-y divide-gray-50">
        @forelse(Auth::guard('people')->user()->loginLogs()->latest()->take(5)->get() as $log)
          <div class="flex items-center justify-between px-6 py-4">
            <div class="flex items-center gap-3">
              @if($log->status === 'success')
                <span class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                  <i class="fas fa-check text-xs"></i>
                </span>
                <div>
                  <p class="text-sm font-bold text-green-700">সফল লগইন</p>
                  <p class="text-xs text-gray-500">{{ $log->ip_address }}</p>
                </div>
              @else
                <span class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center text-red-600">
                  <i class="fas fa-times text-xs"></i>
                </span>
                <div>
                  <p class="text-sm font-bold text-red-700">ব্যর্থ লগইন</p>
                  <p class="text-xs text-gray-500">{{ $log->ip_address }}</p>
                </div>
              @endif
            </div>
            <span class="text-xs text-gray-400">{{ $log->created_at->format('d M, h:i A') }}</span>
          </div>
        @empty
          <div class="px-6 py-10 text-center">
            <i class="fas fa-history text-3xl text-gray-200 mb-3"></i>
            <p class="text-sm text-gray-400">কোনো সাম্প্রতিক কার্যক্রম পাওয়া যায়নি।</p>
          </div>
        @endforelse
      </div>
    </div>

  </div>
</section>
@endsection

