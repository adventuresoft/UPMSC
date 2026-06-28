<footer class="bg-gradient-to-b from-[#034a38] to-[#02382a] text-white font-bengali border-t-4 border-[#046307]">
  <div class="container mx-auto max-w-screen-xl px-4 py-12 md:py-16">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-10">
      
      <!-- Column 1: About -->
      <div class="space-y-4">
        <div class="flex items-center gap-3">
          <div class="w-12 h-12 rounded-full bg-white p-1 flex items-center justify-center shrink-0 shadow-md">
            <img src="{{ asset('images/govt-bd-logo.png') }}" alt="BD Govt Logo" class="w-full h-full object-contain" />
          </div>
          <div>
            <h3 class="text-base font-bold leading-snug tracking-wide text-white">স্থানীয় সরকার বিভাগ</h3>
            <p class="text-xs text-emerald-200">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</p>
          </div>
        </div>
        <p class="text-xs sm:text-[13px] text-emerald-100/90 leading-relaxed pt-1">
          পৌরসভা ও সিটি কর্পোরেশন সমূহের নাগরিক সেবা প্রদান ও ডিজিটাল সনদায়ন ব্যবস্থাপনা সিস্টেম। সহজে, দ্রুত ও স্বচ্ছতার সাথে ঘরে বসেই সকল নাগরিক সেবা।
        </p>
      </div>

      <!-- Column 2: Quick Links -->
      <div>
        <h4 class="text-base font-bold text-emerald-300 border-b border-emerald-600/60 pb-2.5 mb-4 inline-block tracking-wide">দ্রুত লিংক</h4>
        <ul class="space-y-2.5 text-xs sm:text-[13px]">
          <li>
            <a href="{{ url('/') }}" class="text-emerald-100 hover:text-white hover:translate-x-1 inline-flex items-center gap-2 transition-all">
              <span class="text-emerald-400">❯</span> মূল পাতা
            </a>
          </li>
          <li>
            <a href="{{ route('application.create') }}" class="text-emerald-100 hover:text-white hover:translate-x-1 inline-flex items-center gap-2 transition-all">
              <span class="text-emerald-400">❯</span> আবেদন করুন
            </a>
          </li>
          <li>
            <a href="{{ route('certificate.verify') }}" class="text-emerald-100 hover:text-white hover:translate-x-1 inline-flex items-center gap-2 transition-all">
              <span class="text-emerald-400">❯</span> আবেদন স্ট্যাটাস ও সনদ যাচাই
            </a>
          </li>
          <li>
            <a href="#" class="text-emerald-100 hover:text-white hover:translate-x-1 inline-flex items-center gap-2 transition-all">
              <span class="text-emerald-400">❯</span> নাগরিক সেবাসমূহ
            </a>
          </li>
          <li>
            <a href="#" class="text-emerald-100 hover:text-white hover:translate-x-1 inline-flex items-center gap-2 transition-all">
              <span class="text-emerald-400">❯</span> সাধারণ জিজ্ঞাসা (FAQ)
            </a>
          </li>
        </ul>
      </div>

      <!-- Column 3: Contact Info -->
      <div>
        <h4 class="text-base font-bold text-emerald-300 border-b border-emerald-600/60 pb-2.5 mb-4 inline-block tracking-wide">যোগাযোগের ঠিকানা</h4>
        <ul class="space-y-3 text-xs sm:text-[13px] text-emerald-100">
          <li class="flex items-start gap-3">
            <svg class="w-5 h-5 text-emerald-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <span>স্থানীয় সরকার বিভাগ, বাংলাদেশ সচিবালয়, ঢাকা-১০০০</span>
          </li>
          <li class="flex items-center gap-3">
            <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <span>support@lged.gov.bd</span>
          </li>
          <li class="flex items-center gap-3">
            <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            <span>+৮৮০ ২ ৯৫১৪৪৫৫</span>
          </li>
        </ul>
      </div>

      <!-- Column 4: Social Media -->
      <div>
        <h4 class="text-base font-bold text-emerald-300 border-b border-emerald-600/60 pb-2.5 mb-4 inline-block tracking-wide">সামাজিক যোগাযোগ</h4>
        <p class="text-xs sm:text-[13px] text-emerald-100 mb-4">আমাদের সকল আপডেট ও খবর পেতে সামাজিক যোগাযোগ মাধ্যমে যুক্ত থাকুন।</p>
        <div class="flex items-center gap-3">
          <!-- Facebook -->
          <a href="#" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#1877F2] flex items-center justify-center text-white transition-all transform hover:scale-110 shadow-sm" aria-label="Facebook">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
          </a>
          <!-- Twitter / X -->
          <a href="#" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#1DA1F2] flex items-center justify-center text-white transition-all transform hover:scale-110 shadow-sm" aria-label="Twitter">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.936 9.936 0 0024 4.59z"/></svg>
          </a>
          <!-- YouTube -->
          <a href="#" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#FF0000] flex items-center justify-center text-white transition-all transform hover:scale-110 shadow-sm" aria-label="YouTube">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
          </a>
        </div>
      </div>

    </div>
  </div>

  <!-- Copyright Bottom Bar -->
  <div class="bg-[#02281e] border-t border-emerald-800/60 py-4 px-4 text-xs sm:text-[13px] text-emerald-200">
    <div class="container mx-auto max-w-screen-xl flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
      <div>
        &copy; {{ date('Y') }} <strong>স্থানীয় সরকার বিভাগ</strong>। সর্বস্বত্ব সংরক্ষিত।
      </div>
      <div>
        কারিগরি সহযোগিতায়: <a href="https://www.adventuresoft.com.bd" target="_blank" class="font-bold text-white hover:text-emerald-300 underline underline-offset-4 transition-colors">Adventure Soft</a>
      </div>
    </div>
  </div>
</footer>
