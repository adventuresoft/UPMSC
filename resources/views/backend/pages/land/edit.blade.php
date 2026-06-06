@extends('backend.master', ['mainMenu' => 'Land', 'subMenu' =>'LandList'])
@push('style')
<style>
    /* Card & General Styling */
    .premium-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        background: #ffffff;
    }
    .premium-header {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        padding: 20px 28px;
        border-bottom: none;
    }
    .premium-header h3 {
        margin: 0;
        font-weight: 700;
        font-size: 1.0rem;
        letter-spacing: 0.5px;
    }
    
    /* Wizard Steps Styling */
    .step-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
        padding-bottom: 16px;
        border-bottom: 2px solid #edf2f9;
    }
    .step-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .step-indicator {
        background: #e2e8f0;
        color: #64748b;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .step-active {
        background: #e0e7ff;
        color: #4f46e5;
    }

    /* Table Styling */
    .premium-table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        table-layout: fixed;
        margin-bottom: 2rem;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
    }
    .premium-table thead {
        background: #f8fafc;
    }
    .premium-table th {
        color: #334155;
        font-weight: 700;
        font-size: 0.82rem;
        padding: 12px 6px;
        border-bottom: 2px solid #e2e8f0;
        text-align: center;
        vertical-align: middle;
        word-wrap: break-word;
    }
    .premium-table td {
        padding: 8px 6px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        border-right: 1px solid #f1f5f9;
        word-wrap: break-word;
    }
    .premium-table tbody tr:last-child td {
        border-bottom: none;
    }
    .premium-table tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Input & Select Customization */
    .premium-input {
        border-radius: 6px;
        border: 1px solid #cbd5e1;
        padding: 8px 10px;
        font-size: 0.9rem;
        height: 38px;
        width: 100%;
        transition: all 0.2s ease;
        background: #ffffff;
        color: #1e293b;
    }
    .premium-input:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
        outline: none;
        background: #ffffff;
    }
    
    /* Record Badge */
    .record-badge {
        background: #f1f5f9;
        color: #1e293b;
        font-weight: 700;
        font-size: 0.9rem;
        padding: 8px 12px;
        border-radius: 6px;
        display: inline-block;
        border-left: 4px solid #4f46e5;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    
    /* Buttons */
    .btn-premium {
        padding: 12px 30px;
        font-weight: 700;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-next {
        background: #4f46e5;
        color: white;
        border: none;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }
    .btn-next:hover {
        background: #4338ca;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.3);
    }
    .btn-prev {
        background: #64748b;
        color: white;
        border: none;
    }
    .btn-prev:hover {
        background: #475569;
        color: white;
    }
    
    /* Select2 Container Override */
    .select2-container--default .select2-selection--single {
        border-radius: 6px !important;
        border: 1px solid #cbd5e1 !important;
        height: 38px !important;
        display: flex;
        align-items: center;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: normal !important;
        padding-left: 10px !important;
        font-size: 0.9rem;
        color: #1e293b !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
        right: 6px !important;
    }
</style>
@endpush
@section('title', 'Land Edit')
@section('content')
<!--
<section class="content-header py-3">
    <div class="container-fluid">
        <div class="row mb-2 align-items-center">
            <div class="col-sm-6">
                <h1 class="font-weight-bold" style="color: #1e293b;">জমির রেকর্ড সংশোধন (Edit Land Record)</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('land.index') }}" style="color: #4f46e5; font-weight: 600;">Land List</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</section>
-->
 
<section class="content py-2">
    <div class="container-fluid">
        <div class="card premium-card">
            
                
            <div class="premium-header">
                <h3><i class="fas fa-edit mr-2"></i> জমির রেকর্ড সংশোধন ফরম</h3>
            </div> 
            <form class="form-horizontal" id="landEditForm" method="POST" action="{{ route('land.update', $land->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body p-4"> 

                    <!-- STEP 1: Land Records -->
                    <div id="step-1">
                        <div class="step-header">
                            <h4 class="step-title"><i class="fas fa-file-signature text-primary"></i> ধাপ ১: জমির খতিয়ান ও দাগ বিবরণী সংশোধন</h4>
                            <div class="step-indicator step-active"><i class="fas fa-check-circle"></i> Step 1 of 2</div>
                        </div>
                        <div class="table-responsive" style="overflow-x: hidden;">
                            <table class="premium-table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 8%;">রেকর্ড</th>
                                        <th style="width: 11%;">জেলা <span class="text-danger">*</span></th>
                                        <th style="width: 11%;">উপজেলা <span class="text-danger">*</span></th>
                                        <th style="width: 12%;">মৌজা <span class="text-danger">*</span></th>
                                        <th style="width: 8%;">দাগ নং <span class="text-danger">*</span></th>
                                        <th style="width: 8%;">খতিয়ান নং <span class="text-danger">*</span></th>
                                        <th style="width: 10%;">রেকর্ডীয় শ্রেণি <span class="text-danger">*</span></th>
                                        <th style="width: 10%;">দাগে মোট জমি (একর) <span class="text-danger">*</span></th>
                                        <th style="width: 10%;">জমির পরিমাণ (একর) <span class="text-danger">*</span></th>
                                        <th style="width: 12%;">মালিকের নাম <span class="text-danger">*</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $recordsList = ['cs' => 'সিএস', 'sa' => 'এসএ', 'rs' => 'আরএস', 'brs' => 'সিটি/বিআরএস'];
                                        $classes = ['বাড়ী','নাল','রাস্তা','খাল','নদী','হালট','পুকুর','পতিত','ভেড়া','ভিটি','পেট্রোল পাম্প','ফুটপথ','আইল্যান্ড','পথ','কবরস্থান','পথের পাশ','দোকান','নয়নজলী','বোরা','ভিটা','রেললাইন','বর্গা','গলি','পুকুর পাড়','টটি','গ্যারেজ','মসজিদ','কারখানা','বালু চর','চালা','পাকা রাস্তা','দালান','বাগান','ড্রেন','নালা','কাঁচা রাস্তা','শ্মশান','বাজার','দরগাহ','সিকস্তি ভূমি','স্কুল','খেলার মাঠ','গড় লায়েক','লায়েক','বিল','ইটখোলা','গোপাট','বালুচর','বাইদ','টানারী'];
                                        $existingData = $land->records_data ?? [];
                                    @endphp
                                    @foreach($recordsList as $key => $label)
                                    @php $rec = $existingData[$key] ?? []; @endphp
                                    <tr>
                                        <td class="text-center"><span class="record-badge">{{ $label }}</span></td>
                                        <td>
                                            <select name="records[{{$key}}][district]" class="form-control select2 district-select" data-key="{{$key}}">
                                                <option value="">জেলা নির্বাচন করুন</option>
                                                @foreach($districts as $district)
                                                    <option value="{{ $district->id }}" {{ ($rec['district'] ?? '') == $district->id ? 'selected' : '' }}>{{ $district->bn_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="records[{{$key}}][upazila]" class="form-control select2 upazila-select" id="upazila_{{$key}}">
                                                <option value="{{ $rec['upazila'] ?? '' }}">{{ $rec['upazila'] ? \App\Models\Thana::find($rec['upazila'])->bn_name ?? 'Selected' : 'উপজেলা নির্বাচন' }}</option>
                                            </select>
                                        </td>
                                        <td><input type="text" name="records[{{$key}}][mouza]" class="premium-input" value="{{ $rec['mouza'] ?? '' }}" placeholder="মৌজার নাম"></td>
                                        <td><input type="text" name="records[{{$key}}][dag_no]" class="premium-input text-center" value="{{ $rec['dag_no'] ?? '' }}" placeholder="দাগ নং"></td>
                                        <td><input type="text" name="records[{{$key}}][khatian_no]" class="premium-input text-center" value="{{ $rec['khatian_no'] ?? '' }}" placeholder="খতিয়ান নং"></td>
                                        <td>
                                            <select name="records[{{$key}}][record_class]" class="form-control select2">
                                                <option value="">শ্রেণি নির্বাচন</option>
                                                @foreach($classes as $cls)
                                                    <option value="{{ $cls }}" {{ ($rec['record_class'] ?? '') == $cls ? 'selected' : '' }}>{{ $cls }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" name="records[{{$key}}][total_land_dag]" class="premium-input text-center" value="{{ $rec['total_land_dag'] ?? '' }}" placeholder="০.০০"></td>
                                        <td><input type="text" name="records[{{$key}}][land_amount]" class="premium-input text-center" value="{{ $rec['land_amount'] ?? '' }}" placeholder="০.০০"></td>
                                        <td><input type="text" name="records[{{$key}}][owner_name]" class="premium-input" value="{{ $rec['owner_name'] ?? '' }}" placeholder="মালিকের নাম"></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 text-right">
                            <button type="button" class="btn btn-premium btn-next" id="nextBtn">পরবর্তী ধাপ (Owner Info) <i class="fas fa-arrow-right ml-1"></i></button>
                        </div>
                    </div>

                    <!-- STEP 2: Owner Information -->
                    <div id="step-2" style="display: none;">
                        <div class="step-header">
                            <h4 class="step-title"><i class="fas fa-user-shield text-primary"></i> ধাপ ২: জমির মালিকের পরিচিতি (Owner Information)</h4>
                            <div class="step-indicator step-active"><i class="fas fa-check-circle"></i> Step 2 of 2</div>
                        </div>
                        
                        <div class="p-4" style="background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0;">
                            <div class="form-group row align-items-center mb-0">
                                <label for="owner_id" class="col-sm-4 col-form-label font-weight-bold" style="font-size: 0.95rem; color: #334155;">মালিকের সিস্টেম/অনুমোদিত আইডি :</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="background: #e2e8f0; border-color: #cbd5e1;"><i class="fas fa-id-card text-secondary"></i></span>
                                        </div>
                                        <input type="text" name="owner_id" class="form-control" id="owner_id" placeholder="যেমন: 51-830228-0002" value="{{ $land->owner_id }}" style="height: 45px; border-radius: 0 8px 8px 0; font-size: 1.05rem;" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @php 
                            $ownerUser = $land->owner_user; 
                            $name = $ownerUser->people ? ($ownerUser->people->bn_name ?? $ownerUser->name) : $ownerUser->name;
                            $nidBc = $ownerUser->nid ?? ($ownerUser->birth_certificate ?? 'N/A');
                        @endphp
                        <div id="ownerDetails" class="alert mt-4 p-4 shadow-sm" style="display: block; background: #ffffff; border-left: 5px solid #10b981; border-radius: 8px; border-top: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0;">
                            <div class="d-flex align-items-center">
                                <div>
                                    @if($ownerUser->image)
                                        <img src="{{ imageUrl($ownerUser->image) }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 2px solid #e2e8f0;" alt="Owner Photo">
                                    @else
                                        <div style="width: 80px; height: 80px; background: #e2e8f0; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b;"><i class="fas fa-user fa-2x"></i></div>
                                    @endif
                                </div>
                                <div style="margin-left: 15px;">
                                    <h5 class="mb-1 font-weight-bold" style="color: #1e293b;">{{ $name }}</h5>
                                    <p class="mb-0" style="color: #475569;"><i class="fas fa-phone-alt text-secondary mr-1"></i> {{ $ownerUser->mobile ?? 'N/A' }}</p>
                                    <p class="mb-0" style="color: #475569;"><i class="fas fa-id-card text-secondary mr-1"></i> NID/Birth Cert: {{ $nidBc }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 pt-3 border-top d-flex justify-content-between">
                            <button type="button" class="btn btn-premium btn-prev" id="prevBtn"><i class="fas fa-arrow-left mr-1"></i> পূর্ববর্তী ধাপ</button>
                            <button type="submit" class="btn btn-premium btn-success" style="box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);"><i class="fas fa-save mr-2"></i> তথ্য হালনাগাদ করুন (Update)</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $(".select2").select2();

        // Fetch Upazila on District Change
        $('.district-select').on('change', function() {
            let districtId = $(this).val();
            let key = $(this).data('key');
            let upazilaSelect = $('#upazila_' + key);
            
            upazilaSelect.empty();
            upazilaSelect.append('<option value="">Select Upazila</option>');
            
            if(districtId) {
                $.ajax({
                    url: "{{ url('/get-thanas-by-district') }}/" + districtId,
                    type: "GET",
                    success: function(data) {
                        upazilaSelect.empty();
                        upazilaSelect.append(data);
                    }
                });
            }
        });

        // Next Button click
        $("#nextBtn").click(function() {
            $("#step-1").hide();
            $("#step-2").show();
        });

        // Previous Button click
        $("#prevBtn").click(function() {
            $("#step-2").hide();
            $("#step-1").show();
        });

        // Find Owner AJAX on typing
        let typingTimer;
        const doneTypingInterval = 500;
        
        $("#owner_id").on('keyup input', function() {
            clearTimeout(typingTimer);
            let ownerId = $(this).val();
            
            if (ownerId.length > 5) {
                typingTimer = setTimeout(function() {
                    searchOwner(ownerId);
                }, doneTypingInterval);
            } else {
                $("#ownerDetails").html('').hide();
            }
        });

        function searchOwner(ownerId) {
            $.ajax({
                type: "GET",
                url: "{{ url('/search-user-by-system-id') }}/" + ownerId,
                success: function (response) {
                    if(response.status) {
                        let data = response.user;
                        let name = data.people ? (data.people.bn_name ?? data.name) : data.name;
                        let nidBc = data.nid ?? data.birth_certificate ?? 'N/A';
                        
                        let photoHtml = data.image 
                            ? `<img src="{{ asset('') }}${data.image}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 2px solid #e2e8f0;" alt="Owner Photo">` 
                            : `<div style="width: 80px; height: 80px; background: #e2e8f0; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #64748b;"><i class="fas fa-user fa-2x"></i></div>`;
                        
                        let html = `<div class="d-flex align-items-center">
                                        <div>${photoHtml}</div>
                                        <div style="margin-left: 15px;">
                                            <h5 class="mb-1 font-weight-bold" style="color: #1e293b;">${name}</h5>
                                            <p class="mb-0" style="color: #475569;"><i class="fas fa-phone-alt text-secondary mr-1"></i> ${data.mobile ?? 'N/A'}</p>
                                            <p class="mb-0" style="color: #475569;"><i class="fas fa-id-card text-secondary mr-1"></i> NID/Birth Cert: ${nidBc}</p>
                                        </div>
                                    </div>`;
                        $("#ownerDetails").html(html).show();
                        toastr.success("Owner found!");
                    } else {
                        $("#ownerDetails").html('<div class="text-danger font-weight-bold"><i class="fas fa-exclamation-circle"></i> Owner not found.</div>').show();
                    }
                },
                error: function() {
                    $("#ownerDetails").html('<div class="text-danger font-weight-bold"><i class="fas fa-exclamation-circle"></i> Error finding owner.</div>').show();
                }
            });
        }

        $("#landEditForm").on('submit', function(e) {
            e.preventDefault();
            let thisForm = $(this);
            $.ajax({
                type: "POST",
                url: thisForm.attr('action'),
                data: new FormData(this),
                dataType: "json",
                contentType:false,
                cache:false,
                processData:false,
                beforeSend: function() {
                    thisForm.find('button[type="submit"]').prop("disabled",true);
                },
                success: function (response) {
                    thisForm.find('button[type="submit"]').prop("disabled",false);
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.href = response.redirect_url;
                    }, 2000)
                },
                error: function(xhr, status, error) {
                    thisForm.find('button[type="submit"]').prop("disabled",false);
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                    $.each(responseText.errors, function(key, val) {
                        thisForm.find("." + key + "-error").text(val[0]);
                    });
                }
            });
        });
    });
</script>
@endpush
