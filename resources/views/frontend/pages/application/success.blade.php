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
        <div class="flex flex-col md:flex-row justify-center items-center">
          <div class="flex flex-col md:flex-row items-center gap-4 py-1">
            <img
              src="{{asset('assets/images/logo/govt-bd-logo.png')}}"
              class="h-14 w-auto object-contain"
              alt="Govt Logo"
            />
            <div class="text-black text-center md:text-left">
              <h1 class="md:text-[18px] font-bold leading-tight">
                Citizen Service Management and Central Reporting System
              </h1>
              <p class="text-[10px] font-medium opacity-90">Local Government Division, Local Government Ministry, Bangladesh</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar md:block hidden bg-[#046307] shadow-md sticky top-0 z-50">
      <div class="container mx-auto max-w-screen-xl">
        <!-- Navigation Links -->
        <ul class="nav-links flex items-center justify-center gap-6 py-2">

          <li class="flex items-center">
            <a href="{{url('/')}}" class="inline-flex items-center gap-2">
              <span class="inline-flex h-8 w-8 items-center justify-center rounded-full border border-white/30 text-white transition-all hover:bg-white/10" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                  <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                  <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.432z" />
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

