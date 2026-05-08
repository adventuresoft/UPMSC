@extends('backend.master')

@section('title', 'সনদপত্র আবেদন')

@section('content')
<div class="p-4">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-sm-6">
                <h4 class="font-bold text-gray-800">সনদপত্র আবেদন</h4>
            </div>
        </div>

        <div class="card card-outline card-success shadow-sm rounded-xl overflow-hidden border-0">
            <div class="card-header bg-white py-3">
                <h3 class="card-title text-sm font-bold text-gray-700">আবেদনকারীর তথ্য ও সনদের ধরন</h3>
            </div>
            
            <form id="certAppForm" method="POST" action="{{ route('citizen.store') }}">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::guard('people')->user()->user_id }}">
                
                <div class="card-body bg-gray-50/30">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">সনদপত্রের ধরন</label>
                                <select class="form-control border-gray-200 rounded-lg text-sm" name="cert_type" required>
                                    <option value="">নির্বাচন করুন</option>
                                    <option value="citizen">নাগরিকত্ব সনদ (Citizenship)</option>
                                    <option value="character">চারিত্রিক সনদ (Character)</option>
                                    <option value="unmarried">অবিবাহিত সনদ (Unmarried)</option>
                                    <option value="residential">ভূমিহীন সনদ (Landless)</option>
                                    <option value="income">বার্ষিক আয় সনদ (Yearly Income)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="text-xs font-bold text-gray-600 uppercase mb-2 block">আবেদনের উদ্দেশ্য</label>
                                <input type="text" class="form-control border-gray-200 rounded-lg text-sm" name="purpose" required placeholder="উদাঃ চাকরির জন্য / ব্যাংক একাউন্ট">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="p-4 bg-white rounded-lg border border-dashed border-gray-300 text-center">
                                <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-user text-green-600"></i>
                                </div>
                                <h6 class="text-xs font-bold text-gray-800">{{ Auth::guard('people')->user()->bn_name }}</h6>
                                <p class="text-[10px] text-gray-500 uppercase">আবেদনকারী</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 bg-white rounded-lg border border-dashed border-gray-300 text-center">
                                <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-id-card text-blue-600"></i>
                                </div>
                                <h6 class="text-xs font-bold text-gray-800">{{ Auth::guard('people')->user()->system_id }}</h6>
                                <p class="text-[10px] text-gray-500 uppercase">সিস্টেম আইডি</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 bg-white rounded-lg border border-dashed border-gray-300 text-center">
                                <div class="w-12 h-12 rounded-full bg-purple-50 flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-phone text-purple-600"></i>
                                </div>
                                <h6 class="text-xs font-bold text-gray-800">{{ Auth::guard('people')->user()->mobile }}</h6>
                                <p class="text-[10px] text-gray-500 uppercase">মোবাইল নম্বর</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded-r-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle text-yellow-400 mt-1"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-xs text-yellow-700 leading-relaxed">
                                    আপনার সংরক্ষিত প্রোফাইল থেকে প্রয়োজনীয় তথ্য (নাম, ঠিকানা, পিতার নাম ইত্যাদি) স্বয়ংক্রিয়ভাবে সনদে ব্যবহৃত হবে। তথ্য পরিবর্তন করতে চাইলে প্রোফাইল আপডেট করুন।
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white py-4 text-right border-t">
                    <a href="{{ route('people.dashboard') }}" class="btn btn-light px-5 py-2.5 rounded-lg font-bold text-sm mr-2 border">বাতিল</a>
                    <button type="submit" class="btn btn-success px-5 py-2.5 rounded-lg font-bold text-sm shadow-sm hover:shadow-md transition">
                        <i class="fas fa-check-circle mr-2"></i> আবেদন নিশ্চিত করুন
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $("#certAppForm").on('submit', function(e) {
            e.preventDefault();
            let thisForm = $(this);
            $.ajax({
                type: "POST",
                url: thisForm.attr('action'),
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.href = "{{ route('people.dashboard') }}";
                    }, 2000)
                },
                error: function(xhr) {
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message || "ত্রুটি হয়েছে");
                }
            });
        });
    });
</script>
@endpush
