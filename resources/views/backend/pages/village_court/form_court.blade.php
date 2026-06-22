@extends('backend.master', ['mainMenu' => 'LocalGovtJudiciary', 'subMenu' => 'VillageCourtList'])
@push('style')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@section('title', 'Form Court - ' . $case->case_no)
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Adalat (আদালত ও প্যানেল গঠন)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('village-court.index') }}">Case</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('village-court.show', $case->id) }}">{{ $case->case_no }}</a></li>
                        <li class="breadcrumb-item active">Form Court</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Nomination Form (প্যানেল ও নোটিশ সমন নির্ধরণ)</h3>
                        </div>
                        <form action="{{ route('village-court.form-court', $case->id) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Panel Head / Chairman (চেয়ারম্যান) <span class="text-danger">*</span></label>
                                    <select name="panel_head_id" class="form-control select2" required>
                                        <option value="">Select Chairman</option>
                                        @foreach($chairmen as $c)
                                            <option value="{{ $c->id }}" {{ $loop->first ? 'selected' : '' }}>{{ $c->name }} ({{ $c->system_id }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <h4 class="mt-4 text-primary">Plaintiff (Badi) Nominated Representatives (বাদী পক্ষ)</h4>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group border p-2 rounded bg-light">
                                            <label>1. UP Member <span class="text-danger">*</span></label>
                                            <div class="mb-2">
                                                <select name="badi_up_member_is_union" class="form-control font-weight-bold is_union_select" onchange="toggleUnionSection(this)">
                                                    <option value="1">From this union (ইউনিয়নের বাসিন্দা)</option>
                                                    <option value="0">Outside union (অন্য এলাকার)</option>
                                                </select>
                                            </div>
                                            <div class="union_section">
                                                <select name="badi_up_member_id" class="form-control select2">
                                                    <option value="">Select UP Member</option>
                                                    @foreach($up_members as $m)
                                                        <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->system_id }})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="outside_section" style="display: none;">
                                                <div class="row">
                                                    <div class="col-sm-12 mb-2"><input type="text" name="badi_up_member_name" class="form-control" placeholder="Name"></div>
                                                    <div class="col-sm-12 mb-2"><input type="text" name="badi_up_member_mobile" class="form-control" placeholder="Mobile Number"></div>
                                                    <div class="col-sm-12 mb-2"><input type="text" name="badi_up_member_nid" class="form-control" placeholder="NID"></div>
                                                    <div class="col-sm-12 mb-2"><input type="text" name="badi_up_member_address" class="form-control" placeholder="Address"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group border p-2 rounded bg-light">
                                            <label>2. Citizen Representative <span class="text-danger">*</span></label>
                                            <div class="mb-2">
                                                <select name="badi_citizen_is_union" class="form-control font-weight-bold is_union_select" onchange="toggleUnionSection(this)">
                                                    <option value="1">From this union (ইউনিয়নের বাসিন্দা)</option>
                                                    <option value="0">Outside union (অন্য এলাকার)</option>
                                                </select>
                                            </div>
                                            <div class="union_section">
                                                <select name="badi_citizen_id" class="form-control select2">
                                                    <option value="">Select Citizen</option>
                                                    @foreach($people as $p)
                                                        @if($p->id != $case->badi_id)
                                                            <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->approved_id }})</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="outside_section" style="display: none;">
                                                <div class="row">
                                                    <div class="col-sm-12 mb-2"><input type="text" name="badi_citizen_name" class="form-control" placeholder="Name"></div>
                                                    <div class="col-sm-12 mb-2"><input type="text" name="badi_citizen_mobile" class="form-control" placeholder="Mobile Number"></div>
                                                    <div class="col-sm-12 mb-2"><input type="text" name="badi_citizen_nid" class="form-control" placeholder="NID"></div>
                                                    <div class="col-sm-12 mb-2"><input type="text" name="badi_citizen_father_name" class="form-control" placeholder="Father's Name"></div>
                                                    <div class="col-sm-12 mb-2"><input type="text" name="badi_citizen_address" class="form-control" placeholder="Address"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="mt-3 text-primary">Defendant (Bibadi) Nominated Representatives (বিবাদী পক্ষ)</h4>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group border p-2 rounded bg-light">
                                            <label>1. UP Member <span class="text-danger">*</span></label>
                                            <div class="mb-2">
                                                <select name="bibadi_up_member_is_union" class="form-control font-weight-bold is_union_select" onchange="toggleUnionSection(this)">
                                                    <option value="1">From this union (ইউনিয়নের বাসিন্দা)</option>
                                                    <option value="0">Outside union (অন্য এলাকার)</option>
                                                </select>
                                            </div>
                                            <div class="union_section">
                                                <select name="bibadi_up_member_id" class="form-control select2">
                                                    <option value="">Select UP Member</option>
                                                    @foreach($up_members as $m)
                                                        <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->system_id }})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="outside_section" style="display: none;">
                                                <div class="row">
                                                    <div class="col-sm-12 mb-2"><input type="text" name="bibadi_up_member_name" class="form-control" placeholder="Name"></div>
                                                    <div class="col-sm-12 mb-2"><input type="text" name="bibadi_up_member_mobile" class="form-control" placeholder="Mobile Number"></div>
                                                    <div class="col-sm-12 mb-2"><input type="text" name="bibadi_up_member_nid" class="form-control" placeholder="NID"></div>
                                                    <div class="col-sm-12 mb-2"><input type="text" name="bibadi_up_member_address" class="form-control" placeholder="Address"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group border p-2 rounded bg-light">
                                            <label>2. Citizen Representative <span class="text-danger">*</span></label>
                                            <div class="mb-2">
                                                <select name="bibadi_citizen_is_union" class="form-control font-weight-bold is_union_select" onchange="toggleUnionSection(this)">
                                                    <option value="1">From this union (ইউনিয়নের বাসিন্দা)</option>
                                                    <option value="0">Outside union (অন্য এলাকার)</option>
                                                </select>
                                            </div>
                                            <div class="union_section">
                                                <select name="bibadi_citizen_id" class="form-control select2">
                                                    <option value="">Select Citizen</option>
                                                    @foreach($people as $p)
                                                        @if(!in_array($p->id, (array)$case->bibadi_ids))
                                                            <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->approved_id }})</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="outside_section" style="display: none;">
                                                <div class="row">
                                                    <div class="col-sm-12 mb-2"><input type="text" name="bibadi_citizen_name" class="form-control" placeholder="Name"></div>
                                                    <div class="col-sm-12 mb-2"><input type="text" name="bibadi_citizen_mobile" class="form-control" placeholder="Mobile Number"></div>
                                                    <div class="col-sm-12 mb-2"><input type="text" name="bibadi_citizen_nid" class="form-control" placeholder="NID"></div>
                                                    <div class="col-sm-12 mb-2"><input type="text" name="bibadi_citizen_father_name" class="form-control" placeholder="Father's Name"></div>
                                                    <div class="col-sm-12 mb-2"><input type="text" name="bibadi_citizen_address" class="form-control" placeholder="Address"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Confirm Court & Emit Summons</button>
                                <a href="{{ route('village-court.show', $case->id) }}" class="btn btn-default float-right">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        function toggleUnionSection(element) {
            var val = $(element).val();
            var parent = $(element).closest('.form-group');
            
            if (val == '1') {
                parent.find('.union_section').show();
                parent.find('.outside_section').hide();
            } else {
                parent.find('.union_section').hide();
                parent.find('.outside_section').show();
            }
        }

        $(function () {
            $('.select2').select2({ theme: 'bootstrap4' });
        });
    </script>
@endpush
