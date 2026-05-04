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