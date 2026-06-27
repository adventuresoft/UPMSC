
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CLMS | নাগরিক লগইন</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{asset('assets/style/global.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/style/upms-theme.css')}}?v=1.6" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  </head>
  <body class="bg-[#f3f4f6] font-inter min-h-screen flex flex-col">
    <div class="fixed top-6 left-6 z-50">
      <a href="{{ url('/') }}" class="group flex items-center gap-3 text-gray-600 hover:text-[#046307] transition-all">
        <span class="flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 bg-white shadow-sm transition-all group-hover:border-[#046307] group-hover:bg-[#046307] group-hover:text-white">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="h-5 w-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
          </svg>
        </span>
        <span class="text-sm font-bold uppercase tracking-wider">ফিরে যান</span>
      </a>
    </div>

    <main class="flex-grow flex items-start justify-center min-h-screen pt-24 pb-12 px-4">
      <div class="max-w-[680px] w-full bg-white rounded-[10px] shadow-[0_4px_20px_rgba(0,0,0,0.12)] overflow-hidden flex flex-col md:flex-row">
        <!-- Left Side: Branding/Info -->
        <div class="md:w-[260px] flex-shrink-0 bg-gradient-to-br from-[#046307] to-[#0a8a0e] p-6 text-white flex flex-col justify-between">
          <div>
            <h2 class="text-3xl font-black mb-2 uppercase tracking-tighter">CLMS</h2>
            <h3 class="text-xl font-bold text-green-200">নাগরিক পোর্টাল</h3>
            <div class="h-1 w-12 bg-white mt-4 rounded-full"></div>
          </div>
          
          <div class="mt-8 space-y-4 text-[12px] opacity-90">
            <p class="flex items-start gap-3 leading-snug">
              <i class="fas fa-check-circle mt-1 text-green-300 text-[10px]"></i>
              সহজে আপনার নাগরিক সেবার আবেদন করুন।
            </p>
            <p class="flex items-start gap-3 leading-snug">
              <i class="fas fa-check-circle mt-1 text-green-300 text-[10px]"></i>
              আবেদনের সর্বশেষ অবস্থা যাচাই করুন।
            </p>
            <p class="flex items-start gap-3 leading-snug">
              <i class="fas fa-check-circle mt-1 text-green-300 text-[10px]"></i>
              ডিজিটাল সনদপত্র সংগ্রহ করুন।
            </p>
          </div>

          <div class="mt-12 text-center">
            <p class="text-[10px] font-bold uppercase tracking-widest opacity-60 mb-3">Powered by</p>
            <div class="flex justify-center transform transition-transform hover:scale-110 duration-300">
              <img src="{{ asset('frontend/img/adv_soft_logo.png') }}" class="h-12 brightness-0 invert opacity-90" alt="Adventure Soft">
            </div>
          </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="flex-grow p-6 md:p-8 bg-[#f8f9fb]">
          <div class="text-center mb-6">
            <img src="{{ asset('images/govt-bd-logo.png') }}" class="h-10 w-10 mx-auto mb-3" alt="Govt Logo">
            <h4 class="text-[10px] font-bold text-[#1a9f5c] uppercase tracking-wider mb-0.5">নাগরিক প্যানেল</h4>
            <h5 class="text-base font-bold text-[#1a3a7d]">লগইন করুন</h5>
          </div>

          <form method="POST" action="{{ route('people.login.post') }}" class="space-y-4">
            @csrf

            @if (Session::has('success'))
              <div class="bg-green-100 border border-green-200 p-3 text-[11px] text-green-700 rounded">
                {{ Session::get('success') }}
              </div>
            @endif
            
            @if (Session::has('error'))
              <div class="bg-red-100 border border-red-200 p-3 text-[11px] text-red-700 rounded">
                {{ Session::get('error') }}
              </div>
            @endif

            @if ($errors->any())
              <div class="bg-red-100 border border-red-200 p-3 text-[11px] text-red-700 rounded">
                <ul class="list-disc list-inside">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <div class="flex flex-col gap-1.5">
              <label for="login_id" class="text-[11px] font-bold text-gray-700 uppercase">ইউজার আইডি</label>
              <input
                type="text"
                id="login_id"
                name="login_id"
                placeholder="ID / Email"
                class="w-full px-3 py-2 bg-white border border-gray-300 rounded focus:ring-1 focus:ring-[#1a3a7d] focus:border-[#1a3a7d] outline-none transition text-sm"
                required
                value="{{ old('login_id') }}"
                autofocus
              >
            </div>

            <div class="flex flex-col gap-1.5">
              <div class="flex justify-between items-center">
                <label for="password" class="text-[11px] font-bold text-gray-700 uppercase">পাসওয়ার্ড</label>
              </div>
              <div class="relative">
                <input
                  type="password"
                  id="password"
                  name="password"
                  placeholder="Password"
                  class="w-full px-3 py-2 pr-10 bg-white border border-gray-300 rounded focus:ring-1 focus:ring-[#1a3a7d] focus:border-[#1a3a7d] outline-none transition text-sm"
                  required
                >
                <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                  <i class="fas fa-eye text-xs" id="eyeIcon"></i>
                </button>
              </div>
            </div>

            <button type="submit" class="w-full py-2 bg-[#046307] text-white font-bold rounded hover:bg-[#034d05] transition-all shadow-sm text-sm mt-1">
              Login
            </button>
          </form>

          <div class="mt-6 pt-4 border-t border-gray-100 text-center">
            <p class="text-gray-500 text-[11px]">নতুন ব্যবহারকারী? 
              <a href="{{ route('application.create') }}" class="text-[#046307] font-bold hover:underline">এখানে আবেদন করুন</a>
            </p>
          </div>
          
          <div class="mt-2 text-center">
            <p class="text-[10px] text-gray-400">অ্যাডমিন? <a href="{{ route('login') }}" class="hover:text-gray-600 underline">অ্যাডমিন প্যানেল</a></p>
          </div>
        </div>
      </div>
    </main>

    <script>
      function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          eyeIcon.classList.remove('fa-eye');
          eyeIcon.classList.add('fa-eye-slash');
        } else {
          passwordInput.type = 'password';
          eyeIcon.classList.remove('fa-eye-slash');
          eyeIcon.classList.add('fa-eye');
        }
      }
    </script>
  </body>
</html>

