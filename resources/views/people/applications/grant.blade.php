@extends('backend.master')

@section('title', 'অনুদান প্রাপ্তির আবেদন')

@section('content')
<div class="p-4">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-sm-6">
                <h4 class="font-bold text-gray-800">অনুদান প্রাপ্তির আবেদন</h4>
            </div>
        </div>

        <div class="card card-outline card-success shadow-sm rounded-xl overflow-hidden border-0">
            <div class="card-header bg-white py-3">
                <h3 class="card-title text-sm font-bold text-gray-700">আবেদনপত্র</h3>
            </div>
            
            <div class="card-body bg-gray-50/30 text-center py-10">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-hand-holding-heart text-green-600 text-3xl"></i>
                </div>
                <h5 class="text-lg font-bold text-gray-800 mb-2">অনুদান সেবা শীঘ্রই আসছে</h5>
                <p class="text-sm text-gray-500 max-w-md mx-auto">
                    আমরা এই সেবাটি ডিজিটাল করার কাজ করছি। বর্তমানে অনুদানের জন্য সরাসরি সংশ্লিষ্ট অফিসে যোগাযোগ করার অনুরোধ করা হলো।
                </p>
                <a href="{{ route('people.dashboard') }}" class="btn btn-success mt-6 px-6 py-2.5 rounded-lg font-bold text-sm">ড্যাশবোর্ডে ফিরে যান</a>
            </div>
        </div>
    </div>
</div>
@endsection
