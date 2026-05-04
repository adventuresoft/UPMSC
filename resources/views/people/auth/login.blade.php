
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UPMS | নাগরিক লগইন</title>
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
    <nav class="bg-[#046307] shadow-md">
      <div class="container mx-auto max-w-screen-xl">
        <ul class="flex items-center gap-6 py-3 px-4 text-white">
          <li><a href="{{url('/')}}" class="font-medium hover:text-green-200 transition">হোম</a></li>
          <li><a href="{{ route('application.create') }}" class="font-medium hover:text-green-200 transition">আবেদন করুন</a></li>
        </ul>
      </div>
    </nav>

    <main class="flex-grow flex items-center justify-center py-12 px-4">
      <div class="max-w-4xl w-full bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
        <!-- Left Side: Branding/Info -->
        <div class="md:w-5/12 bg-gradient-to-br from-[#046307] to-[#0a8a0e] p-10 text-white flex flex-col justify-between">
          <div>
            <h2 class="text-3xl font-black mb-2 uppercase tracking-tighter">CSMCRS</h2>
            <h3 class="text-xl font-bold text-green-200">নাগরিক পোর্টাল</h3>
            <div class="h-1 w-12 bg-white mt-4 rounded-full"></div>
          </div>
          
          <div class="mt-8 space-y-4 text-sm opacity-90">
            <p class="flex items-start gap-3">
              <i class="fas fa-check-circle mt-1 text-green-300"></i>
              সহজে আপনার নাগরিক সেবার আবেদন করুন।
            </p>
            <p class="flex items-start gap-3">
              <i class="fas fa-check-circle mt-1 text-green-300"></i>
              আবেদনের সর্বশেষ অবস্থা যাচাই করুন।
            </p>
            <p class="flex items-start gap-3">
              <i class="fas fa-check-circle mt-1 text-green-300"></i>
              ডিজিটাল সনদপত্র সংগ্রহ করুন।
            </p>
          </div>

          <div class="mt-12">
            <p class="text-[10px] uppercase tracking-widest opacity-60 mb-2">Powered by</p>
            <img src="{{ asset('frontend/img/adv_soft_logo.png') }}" class="h-8 brightness-0 invert opacity-80" alt="Adventure Soft">
          </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="md:w-7/12 p-10 md:p-14">
          <div class="text-center mb-10">
            <img src="{{ asset('frontend/img/govt-logo.png') }}" class="h-16 mx-auto mb-4" alt="Govt Logo">
            <h4 class="text-2xl font-extrabold text-gray-800">লগইন প্যানেল</h4>
            <p class="text-gray-500 text-sm mt-1">আপনার ইউজার আইডি ও পাসওয়ার্ড ব্যবহার করুন</p>
          </div>

          <form method="POST" action="{{ route('people.login.post') }}" class="space-y-6">
            @csrf

            @if (Session::has('success'))
              <div class="bg-green-50 border-l-4 border-green-500 p-4 text-sm text-green-700 rounded shadow-sm">
                {{ Session::get('success') }}
              </div>
            @endif
            
            @if (Session::has('error'))
              <div class="bg-red-50 border-l-4 border-red-500 p-4 text-sm text-red-700 rounded shadow-sm">
                {{ Session::get('error') }}
              </div>
            @endif

            @if ($errors->any())
              <div class="bg-red-50 border-l-4 border-red-500 p-4 text-sm text-red-700 rounded shadow-sm">
                <ul class="list-disc list-inside">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <div>
              <label for="login_id" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">ইউজার আইডি</label>
              <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                  <i class="fas fa-user-circle"></i>
                </span>
                <input
                  type="text"
                  id="login_id"
                  name="login_id"
                  placeholder="ID / Email"
                  class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#046307] focus:border-transparent outline-none transition"
                  required
                  value="{{ old('login_id') }}"
                  autofocus
                >
              </div>
            </div>

            <div>
              <div class="flex justify-between items-center mb-2">
                <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider">পাসওয়ার্ড</label>
                <a href="#" class="text-xs text-[#046307] font-semibold hover:underline">পাসওয়ার্ড ভুলে গেছেন?</a>
              </div>
              <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                  <i class="fas fa-lock"></i>
                </span>
                <input
                  type="password"
                  id="password"
                  name="password"
                  placeholder="••••••••"
                  class="w-full pl-10 pr-12 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#046307] focus:border-transparent outline-none transition"
                  required
                >
                <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600">
                  <i class="fas fa-eye" id="eyeIcon"></i>
                </button>
              </div>
            </div>

            <button type="submit" class="w-full py-4 bg-[#046307] text-white font-bold rounded-xl hover:bg-[#0a8a0e] transition-all transform hover:-translate-y-0.5 shadow-lg active:scale-95">
              লগইন করুন
            </button>
          </form>

          <div class="mt-10 pt-8 border-t border-gray-100 text-center">
            <p class="text-gray-600 text-sm">নতুন ব্যবহারকারী? 
              <a href="{{ route('application.create') }}" class="text-[#046307] font-bold hover:underline">এখানে আবেদন করুন</a>
            </p>
          </div>
          
          <div class="mt-4 text-center">
            <p class="text-xs text-gray-400">অ্যাডমিন? <a href="{{ route('login') }}" class="hover:text-gray-600 underline">অ্যাডমিন প্যানেল</a></p>
          </div>
        </div>
      </div>
    </main>

    <footer class="bg-gray-800 py-6 px-4 text-white text-xs">
      <div class="max-w-screen-xl mx-auto flex flex-col md:flex-row justify-between items-center opacity-70">
        <p>© 2024 All rights reserved by <span class="font-bold">UPMS</span></p>
        <p>Design & Maintained by <a href="https://adventuresoft.com.bd" class="hover:underline">Adventure Soft</a></p>
      </div>
    </footer>

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

