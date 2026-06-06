@extends('backend.master')

@section('title', 'নাগরিক ড্যাশবোর্ড')

@section('content')
<div class="p-4">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-sm-6">
                <h4 class="font-bold text-gray-800">নাগরিক ড্যাশবোর্ড</h4>
            </div>
        </div>

        <div class="row">
            {{-- LEFT SIDEBAR --}}
            <div class="col-lg-3">
                {{-- Profile Card --}}
                <div class="card card-outline card-success shadow-sm rounded-xl overflow-hidden mb-4">
                    <div class="card-body text-center bg-gradient-to-br from-[#046307] to-[#1a7a1e] p-4">
                        <div class="relative inline-block mb-3">
                            @if($people->image)
                                <img class="w-20 h-20 rounded-full mx-auto object-cover ring-4 ring-white ring-opacity-30 shadow-lg" src="{{ imageUrl($people->image) }}" alt="ছবি">
                            @else
                                <div class="w-20 h-20 rounded-full mx-auto bg-white bg-opacity-20 flex items-center justify-center text-white text-3xl font-black ring-4 ring-white ring-opacity-20 shadow-lg">
                                    {{ strtoupper(substr($people->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <h5 class="text-white font-bold mb-1">{{ $people->name }}</h5>
                        <p class="text-green-100 text-xs mb-0">{{ $people->approved_id ?? 'নাগরিক আইডি নেই' }}</p>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item px-4 py-3 d-flex justify-content-between align-items-center border-0 border-bottom">
                            <span class="text-xs text-gray-500 font-medium">জাতীয় পরিচয়পত্র</span>
                            <span class="text-xs font-bold text-gray-700">{{ $people->nid ?? 'N/A' }}</span>
                        </div>
                        <div class="list-group-item px-4 py-3 d-flex justify-content-between align-items-center border-0 border-bottom">
                            <span class="text-xs text-gray-500 font-medium">মোবাইল</span>
                            <span class="text-xs font-bold text-gray-700">{{ $people->mobile ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="card-footer bg-white p-3">
                        <a href="{{ route('people.profile') }}" class="btn btn-success btn-sm btn-block rounded-lg py-2 font-bold shadow-sm">
                            <i class="fas fa-user-edit mr-1"></i> প্রোফাইল আপডেট
                        </a>
                    </div>
                </div>
                
                {{-- Account Status --}}
                <div class="card shadow-sm border-0 rounded-xl mb-4">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-3">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <h6 class="font-bold text-gray-800 mb-0">অ্যাকাউন্ট সক্রিয়</h6>
                                <p class="text-[10px] text-gray-500 mb-0">যাচাইকৃত প্রোফাইল</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MAIN CONTENT --}}
            <div class="col-lg-9">
                {{-- Registration Status / My Information --}}
                <div class="card shadow-sm border-0 rounded-xl overflow-hidden mb-4">
                    <div class="card-header bg-white py-3 border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="font-bold text-gray-800 mb-0">
                                <i class="fas fa-id-card text-[#046307] mr-2"></i>
                                আমার বিস্তারিত তথ্যসমূহ
                            </h6>
                            <a href="{{ route('people.applications.registration.create') }}" class="text-xs font-bold text-[#046307] hover:underline">হালনাগাদ করুন →</a>
                        </div>
                    </div>
                    <div class="card-body bg-gray-50/30 p-4">
                        <div class="row">
                            {{-- Education --}}
                            <div class="col-6 col-md-4 col-lg-2 mb-3">
                                <a href="{{ route('people.applications.registration.education', $people->id) }}" class="d-block p-3 rounded-xl bg-white border border-gray-100 text-center hover:shadow-md transition">
                                    <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mx-auto mb-2 relative">
                                        <i class="fas fa-graduation-cap"></i>
                                        @if(count($people->user->educationInfos ?? []))
                                            <span class="absolute top-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                                        @endif
                                    </div>
                                    <p class="text-[11px] font-bold text-gray-700 mb-0">শিক্ষা</p>
                                </a>
                            </div>
                            {{-- Profession --}}
                            <div class="col-6 col-md-4 col-lg-2 mb-3">
                                <a href="{{ route('people.applications.registration.professional', $people->id) }}" class="d-block p-3 rounded-xl bg-white border border-gray-100 text-center hover:shadow-md transition">
                                    <div class="w-12 h-12 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center mx-auto mb-2 relative">
                                        <i class="fas fa-briefcase"></i>
                                        @if(count($people->user->professionalInfos ?? []))
                                            <span class="absolute top-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                                        @endif
                                    </div>
                                    <p class="text-[11px] font-bold text-gray-700 mb-0">পেশা</p>
                                </a>
                            </div>
                            {{-- Financial --}}
                            <div class="col-6 col-md-4 col-lg-2 mb-3">
                                <a href="{{ route('people.applications.registration.financial', $people->id) }}" class="d-block p-3 rounded-xl bg-white border border-gray-100 text-center hover:shadow-md transition">
                                    <div class="w-12 h-12 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center mx-auto mb-2 relative">
                                        <i class="fas fa-wallet"></i>
                                        @if(count($people->user->financialInfos ?? []))
                                            <span class="absolute top-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                                        @endif
                                    </div>
                                    <p class="text-[11px] font-bold text-gray-700 mb-0">আর্থিক</p>
                                </a>
                            </div>
                            {{-- Property --}}
                            <div class="col-6 col-md-4 col-lg-2 mb-3">
                                <a href="{{ route('people.applications.registration.property', $people->id) }}" class="d-block p-3 rounded-xl bg-white border border-gray-100 text-center hover:shadow-md transition">
                                    <div class="w-12 h-12 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto mb-2 relative">
                                        <i class="fas fa-building"></i>
                                        @if(count($people->user->propertyInfos ?? []))
                                            <span class="absolute top-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                                        @endif
                                    </div>
                                    <p class="text-[11px] font-bold text-gray-700 mb-0">সম্পদ</p>
                                </a>
                            </div>
                            {{-- Disability --}}
                            <div class="col-6 col-md-4 col-lg-2 mb-3">
                                <a href="{{ route('people.applications.registration.disability', $people->id) }}" class="d-block p-3 rounded-xl bg-white border border-gray-100 text-center hover:shadow-md transition">
                                    <div class="w-12 h-12 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center mx-auto mb-2 relative">
                                        <i class="fas fa-wheelchair"></i>
                                        @if(($people->user->disabilityInfo->is_disability ?? 0) == 1)
                                            <span class="absolute top-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                                        @endif
                                    </div>
                                    <p class="text-[11px] font-bold text-gray-700 mb-0">প্রতিবন্ধিতা</p>
                                </a>
                            </div>
                            {{-- Freedom Fighter --}}
                            <div class="col-6 col-md-4 col-lg-2 mb-3">
                                <a href="{{ route('people.applications.registration.freedom', $people->id) }}" class="d-block p-3 rounded-xl bg-white border border-gray-100 text-center hover:shadow-md transition">
                                    <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto mb-2 relative">
                                        <i class="fas fa-medal"></i>
                                        @if(($people->user->freedomFighterInfo->is_freedom_fighter ?? 0) == 1)
                                            <span class="absolute top-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                                        @endif
                                    </div>
                                    <p class="text-[11px] font-bold text-gray-700 mb-0">মুক্তিযোদ্ধা</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Citizen Services Grid --}}
                <div class="card shadow-sm border-0 rounded-xl overflow-hidden mb-4">
                    <div class="card-header bg-white py-3 border-0">
                        <h6 class="font-bold text-gray-800 mb-0">
                            <i class="fas fa-concierge-bell text-[#046307] mr-2"></i>
                            নাগরিক সেবাসমূহ
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            {{-- Service Cards Re-implemented --}}
                            <div class="col-md-6 mb-4">
                                <div class="p-4 rounded-xl border border-green-100 bg-green-50/30 hover:shadow-md transition">
                                    <div class="w-10 h-10 rounded-lg bg-green-100 text-green-700 flex items-center justify-center mb-3">
                                        <i class="fas fa-file-signature"></i>
                                    </div>
                                    <h6 class="font-bold text-gray-800">সনদপত্র আবেদন</h6>
                                    <p class="text-xs text-gray-500 mb-3">নাগরিকত্ব, চারিত্রিকসহ বিভিন্ন সনদপত্রের আবেদন।</p>
                                    <a href="{{ route('people.applications.certificate.create') }}" class="btn btn-success btn-sm px-4 rounded-lg">আবেদন করুন</a>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="p-4 rounded-xl border border-blue-100 bg-blue-50/30 hover:shadow-md transition">
                                    <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center mb-3">
                                        <i class="fas fa-store"></i>
                                    </div>
                                    <h6 class="font-bold text-gray-800">ট্রেড লাইসেন্স</h6>
                                    <p class="text-xs text-gray-500 mb-3">নতুন ট্রেড লাইসেন্স বা নবায়নের আবেদন।</p>
                                    <a href="{{ route('people.applications.trade-license.create') }}" class="btn btn-primary btn-sm px-4 rounded-lg">আবেদন করুন</a>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="p-4 rounded-xl border border-amber-100 bg-amber-50/30 hover:shadow-md transition">
                                    <div class="w-10 h-10 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center mb-3">
                                        <i class="fas fa-car"></i>
                                    </div>
                                    <h6 class="font-bold text-gray-800">যানবাহন আবেদন</h6>
                                    <p class="text-xs text-gray-500 mb-3">রিকশা, ভ্যান বা অটোরিকশা নিবন্ধনের আবেদন।</p>
                                    <a href="{{ route('people.applications.vehicle.create') }}" class="btn btn-warning btn-sm px-4 rounded-lg">আবেদন করুন</a>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="p-4 rounded-xl border border-indigo-100 bg-indigo-50/30 hover:shadow-md transition">
                                    <div class="w-10 h-10 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center mb-3">
                                        <i class="fas fa-home"></i>
                                    </div>
                                    <h6 class="font-bold text-gray-800">হোল্ডিং ট্যাক্স</h6>
                                    <p class="text-xs text-gray-500 mb-3">হোল্ডিং ট্যাক্স নির্ধারণ বা পরিবর্তনের আবেদন।</p>
                                    <a href="{{ route('people.applications.tax.create') }}" class="btn btn-info btn-sm px-4 rounded-lg">আবেদন করুন</a>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="p-4 rounded-xl border border-rose-100 bg-rose-50/30 hover:shadow-md transition">
                                    <div class="w-10 h-10 rounded-lg bg-rose-100 text-rose-700 flex items-center justify-center mb-3">
                                        <i class="fas fa-hand-holding-heart"></i>
                                    </div>
                                    <h6 class="font-bold text-gray-800">রিলিফ কার্ড আবেদন</h6>
                                    <p class="text-xs text-gray-500 mb-3">ভিজিডি, ভিজিএফ, ওএমএস এবং অন্যান্য সামাজিক নিরাপত্তা কার্ডের আবেদন।</p>
                                    <a href="{{ route('people.applications.relief-card.create') }}" class="btn btn-danger btn-sm px-4 rounded-lg">আবেদন করুন</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Help Banner --}}
                <div class="bg-gradient-to-r from-[#046307] to-[#0d7a10] rounded-xl p-4 d-flex align-items-center">
                    <div class="w-12 h-12 rounded-full bg-white bg-opacity-20 flex items-center justify-center mr-4">
                        <i class="fas fa-headset text-white"></i>
                    </div>
                    <div>
                        <h6 class="text-white font-bold mb-0">সহায়তা প্রয়োজন?</h6>
                        <p class="text-green-100 text-xs mb-0">যেকোনো সমস্যায় ইউনিয়ন পরিষদে যোগাযোগ করুন।</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<script src="https://cdn.tailwindcss.com"></script>
<style>
    .content-wrapper { background: #f4f6f9 !important; }
    body { font-family: 'Hind Siliguri', sans-serif; }
</style>
<link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;700&display=swap" rel="stylesheet">
@endpush
