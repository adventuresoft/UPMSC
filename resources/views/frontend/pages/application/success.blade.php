<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UPMS | Success</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{asset('assets/style/global.css')}}" />
  </head>
  <body class="bg-[#f3f4f6] font-inter min-h-screen flex flex-col">
    <!-- top bar -->
    <div class="top-bar">
      <div class="container mx-auto md:px-4 px-2 max-w-screen-xl">
        <div class="flex flex-col md:flex-row justify-between items-center">
          <div class="flex flex-col md:flex-row items-center gap-10">
            <img src="{{asset('assets/images/logo/govt-bd-logo.png')}}" class="govt-logo" alt="" />
            <div class="text-black text-center md:text-left">
              <h1 class="md:text-[25px] font-semibold">Citizen Service Management and Central Reporting System</h1>
              <p>Local Government Division, Local Government Ministry, Bangladesh</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Navigation -->
    <nav class="bg-[#046307] shadow-md sticky top-0 z-50">
      <div class="container mx-auto max-w-screen-xl">
        <ul class="flex items-center gap-6 py-3 px-4 text-white">
          <li><a href="{{url('/')}}" class="font-medium hover:text-green-200 transition">হোম</a></li>
          <li><a href="{{ route('people.login') }}" class="font-medium hover:text-green-200 transition">নাগরিক লগইন</a></li>
        </ul>
      </div>
    </nav>

    <main class="flex-grow py-16">
      <div class="container mx-auto max-w-2xl px-4 text-center">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
          <div class="bg-green-50 py-12 flex justify-center">
            <div class="bg-green-100 rounded-full p-4 text-green-600">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-20 h-20">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
              </svg>
            </div>
          </div>
          
          <div class="p-10">
            @if ($user)
              <h2 class="text-3xl font-extrabold text-gray-900 mb-2">অভিনন্দন!</h2>
              <p class="text-lg text-gray-600 mb-8 font-medium">আপনার আবেদনটি সফলভাবে জমা দেওয়া হয়েছে।</p>
              
              <div class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-xl p-6 mb-8">
                <p class="text-sm text-gray-500 uppercase tracking-widest font-bold mb-1">আবেদন নম্বর (Application ID)</p>
                <p class="text-4xl font-mono font-black text-[#046307]">{{$user->system_id}}</p>
              </div>

              <div class="text-left bg-blue-50 border-l-4 border-blue-400 p-4 mb-8 text-sm text-blue-700">
                <p class="font-bold mb-1">গুরুত্বপূর্ণ তথ্য:</p>
                <p>ভবিষ্যৎ ব্যবহারের জন্য আবেদন নম্বরটি সংরক্ষণ করুন। আপনার আবেদনটি যাচাইয়ের পর আপনাকে এসএমএস-এর মাধ্যমে পরবর্তী ধাপ জানানো হবে।</p>
              </div>

              <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{route('home')}}" class="py-3 px-8 bg-[#046307] text-white font-bold rounded-lg hover:bg-[#0a8a0e] transition shadow-lg">হোমে ফিরে যান</a>
                <a href="{{ route('people.login') }}" class="py-3 px-8 bg-white border-2 border-[#046307] text-[#046307] font-bold rounded-lg hover:bg-green-50 transition">নাগরিক পোর্টালে লগইন করুন</a>
              </div>
            @else
              <div class="py-8">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-red-500 mx-auto mb-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <h2 class="text-2xl font-bold text-gray-800">কোন রেকর্ড পাওয়া যায়নি!</h2>
                <a href="{{route('application.create')}}" class="mt-6 inline-block py-2 px-6 bg-gray-800 text-white rounded-lg">আবার চেষ্টা করুন</a>
              </div>
            @endif
          </div>
          
          <div class="bg-gray-50 px-6 py-4 text-xs text-gray-400 italic border-t border-gray-100">
            ধন্যবাদ, আপনি নাগরিক সেবার সাথে যুক্ত আছেন।
          </div>
        </div>
      </div>
    </main>

    <footer class="bg-gray-800 py-8 px-4 text-white mt-auto">
      <div class="max-w-screen-xl mx-auto flex flex-col md:flex-row justify-between items-center text-sm">
        <p class="mb-4 md:mb-0">© 2024 All rights reserved by <span class="font-bold text-green-400">UPMS</span></p>
        <p>Design & Maintained by <a href="https://adventuresoft.com.bd" class="text-green-400 hover:underline">Adventure Soft</a></p>
      </div>
    </footer>
  </body>
</html>

