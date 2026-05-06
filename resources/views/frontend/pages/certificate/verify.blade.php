<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UPMS | সনদ যাচাই</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{asset('assets/style/global.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
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
            <form action="{{ route('certificate.verify') }}" method="GET" class="space-y-6">
              <div>
                <label for="system_id" class="block text-sm font-bold text-gray-700 mb-2">সনদ নং প্রদান করুন</label>
                <div class="flex flex-col sm:flex-row gap-3">
                  <div class="relative flex-grow">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                      <i class="fas fa-certificate"></i>
                    </span>
                    <input 
                      type="text" 
                      name="system_id" 
                      id="system_id"
                      class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#046307] focus:border-transparent outline-none transition"
                      placeholder="যেমন: CERT-12345"
                      value="{{ old('system_id', $system_id ?? '') }}"
                      required
                    >
                  </div>
                  <button type="submit" class="sm:w-auto w-full px-8 py-3.5 bg-[#046307] text-white font-bold rounded-xl hover:bg-[#0a8a0e] transition shadow-lg flex items-center justify-center gap-2">
                    <i class="fas fa-search"></i>
                    অনুসন্ধান
                  </button>
                </div>
              </div>
            </form>

            @if(isset($data))
              <div class="mt-10 p-8 bg-green-50 rounded-2xl border-2 border-green-100 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10">
                  <i class="fas fa-certificate text-8xl text-green-600"></i>
                </div>
                
                <div class="relative z-10">
                  <div class="flex items-center gap-2 text-green-600 font-bold mb-4">
                    <i class="fas fa-check-circle"></i>
                    <span>সঠিক তথ্য পাওয়া গেছে</span>
                  </div>
                  
                  <div class="space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 pb-4 border-b border-green-100">
                      <span class="text-sm text-gray-500 uppercase tracking-wider font-bold">সনদ নং:</span>
                      <span class="text-lg font-mono font-black text-[#046307]">{{ $data->system_id }}</span>
                    </div>
                    
                    <p class="text-gray-700 leading-relaxed">
                      সনদটি <span class="font-bold text-[#046307]">{{ $data->created_at->format('d M, Y') }}</span> তারিখে 
                      <span class="font-bold text-gray-900">{{ $data->user->name }}</span>, 
                      পিতা: <span class="font-medium text-gray-800">{{ $data->user->familyInfo->father_name_bn }}</span>, 
                      মাতা: <span class="font-medium text-gray-800">{{ $data->user->familyInfo->mother_name_bn }}</span>, 
                      জন্ম তারিখ: <span class="font-medium text-gray-800">{{ $data->user->people->date_of_birth ?? 'N/A' }}</span>-কে 
                      <span class="font-bold text-[#046307]">{{ $data->user->institute->union->bn_name ?? '' }}</span> এর চেয়ারম্যান কর্তৃক প্রদান করা হয়েছে।
                    </p>
                  </div>
                </div>
              </div>
            @elseif(isset($system_id))
              <div class="mt-10 p-8 bg-red-50 rounded-2xl border-2 border-red-100 text-center">
                <div class="text-red-500 text-5xl mb-4">
                  <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h3 class="text-xl font-bold text-red-700 mb-2">দুঃখিত!</h3>
                <p class="text-red-600">প্রদানকৃত সনদ নম্বর দিয়ে কোনো তথ্য পাওয়া যায়নি। অনুগ্রহ করে সঠিক নম্বরটি পুনরায় চেক করুন।</p>
              </div>
            @endif
          </div>

          <div class="bg-gray-50 px-8 py-4 border-t border-gray-100">
            <p class="text-xs text-gray-400 text-center italic">ভেরিফিকেশন সিস্টেমটি সরকারি ডিজিটাল সেবার অংশ।</p>
          </div>
        </div>
      </div>
    </main>

    <footer class="bg-gray-800 py-8 px-4 text-white mt-auto">
      <div class="container mx-auto max-w-screen-xl flex flex-col md:flex-row justify-between items-center text-sm opacity-80">
        <p>© 2024 All rights reserved by <span class="font-bold">UPMS</span></p>
        <p>Design & Maintained by <a href="https://adventuresoft.com.bd" class="hover:underline">Adventure Soft</a></p>
      </div>
    </footer>
  </body>
</html>