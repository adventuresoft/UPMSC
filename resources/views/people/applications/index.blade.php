@extends('backend.master')

@section('title', 'আমার আবেদনসমূহ')

@section('content')
<div class="p-4">
    <div class="container-fluid">
        <div class="row mb-4 align-items-center">
            <div class="col-sm-6">
                <h4 class="font-bold text-gray-800 m-0">আবেদনসমূহের তালিকা ও অবস্থা</h4>
                <p class="text-xs text-gray-500 mt-1 uppercase tracking-wider">Track your application status in real-time</p>
            </div>
            <div class="col-sm-6 text-right">
                <div class="dropdown d-inline-block">
                    <button class="btn btn-success rounded-lg font-bold text-sm px-4 py-2 shadow-sm dropdown-toggle" type="button" id="newAppBtn" data-toggle="dropdown">
                        <i class="fas fa-plus-circle mr-2"></i> নতুন আবেদন করুন
                    </button>
                    <div class="dropdown-menu dropdown-menu-right shadow-lg border-0 rounded-xl mt-2">
                        <a class="dropdown-item py-2 px-4 text-sm font-medium hover:bg-gray-50" href="{{ route('people.applications.certificate.create') }}">সনদপত্র আবেদন</a>
                        <a class="dropdown-item py-2 px-4 text-sm font-medium hover:bg-gray-50" href="{{ route('people.applications.trade-license.create') }}">ট্রেড লাইসেন্স আবেদন</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item py-2 px-4 text-sm font-medium hover:bg-gray-50 text-gray-400" href="#">অন্যান্য (শীঘ্রই আসছে)</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-success shadow-sm rounded-xl overflow-hidden border-0">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-gray-50 border-bottom">
                                    <tr>
                                        <th class="py-4 px-4 text-xs font-bold text-gray-600 uppercase text-center w-16">ক্রমিক</th>
                                        <th class="py-4 px-4 text-xs font-bold text-gray-600 uppercase">আবেদনের ধরন</th>
                                        <th class="py-4 px-4 text-xs font-bold text-gray-600 uppercase">প্রতিষ্ঠানের নাম/বিবরণ</th>
                                        <th class="py-4 px-4 text-xs font-bold text-gray-600 uppercase">আবেদন আইডি</th>
                                        <th class="py-4 px-4 text-xs font-bold text-gray-600 uppercase">তারিখ</th>
                                        <th class="py-4 px-4 text-xs font-bold text-gray-600 uppercase text-center">অবস্থা (Status)</th>
                                        <th class="py-4 px-4 text-xs font-bold text-gray-600 uppercase text-right">অ্যাকশন</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($allApplications as $index => $app)
                                    <tr class="transition-colors hover:bg-gray-50/50">
                                        <td class="py-4 px-4 text-sm font-medium text-gray-500 text-center">{{ $index + 1 }}</td>
                                        <td class="py-4 px-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center mr-3">
                                                    @if($app->type == 'Trade License')
                                                        <i class="fas fa-store text-green-600 text-xs"></i>
                                                    @else
                                                        <i class="fas fa-file-contract text-blue-600 text-xs"></i>
                                                    @endif
                                                </div>
                                                <div>
                                                    <span class="text-sm font-bold text-gray-800 block">{{ $app->type_bn }}</span>
                                                    <span class="text-[10px] text-gray-400 uppercase tracking-tighter">{{ $app->type }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="text-sm text-gray-700 font-medium">{{ $app->name ?? $app->bn_name ?? '--' }}</span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-600 border">
                                                {{ $app->application_id ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="text-sm text-gray-500">{{ $app->created_at->format('d M, Y') }}</span>
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                            @if($app->status == 0)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-50 text-yellow-700 border border-yellow-100">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 mr-2 animate-pulse"></span>
                                                    অপেক্ষমাণ (Pending)
                                                </span>
                                            @elseif($app->status == 1)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-100">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-2"></span>
                                                    অনুমোদিত (Approved)
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-100">
                                                    বাতিল (Rejected)
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4 text-right">
                                            @if($app->status == 1)
                                                <button class="btn btn-sm btn-outline-success rounded-lg font-bold text-[10px] px-3 py-1.5 uppercase hover:bg-green-600 hover:text-white transition shadow-sm">
                                                    <i class="fas fa-download mr-1"></i> ডাউনলোড
                                                </button>
                                            @else
                                                <button class="btn btn-sm btn-light rounded-lg font-bold text-[10px] px-3 py-1.5 uppercase border cursor-not-allowed opacity-50" disabled>
                                                    <i class="fas fa-eye mr-1"></i> বিস্তারিত
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="py-12 text-center">
                                            <div class="flex flex-col items-center justify-center opacity-40">
                                                <i class="fas fa-folder-open text-4xl mb-3 text-gray-300"></i>
                                                <p class="text-sm font-medium text-gray-500">এখনো কোনো আবেদন করা হয়নি</p>
                                                <a href="{{ route('people.applications.certificate.create') }}" class="mt-4 text-xs font-bold text-green-600 uppercase underline">নতুন আবেদন শুরু করুন</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
