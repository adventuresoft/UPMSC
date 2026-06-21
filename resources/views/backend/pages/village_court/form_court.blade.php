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
                                        <div class="form-group">
                                            <label>1. UP Member <span class="text-danger">*</span></label>
                                            <select name="badi_up_member_id" class="form-control select2" required>
                                                <option value="">Select UP Member</option>
                                                @foreach($up_members as $m)
                                                    <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->system_id }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>2. Citizen Representative <span class="text-danger">*</span></label>
                                            <select name="badi_citizen_id" class="form-control select2" required>
                                                <option value="">Select Citizen</option>
                                                @foreach($people as $p)
                                                    @if($p->id != $case->badi_id)
                                                        <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->approved_id }})</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="mt-3 text-primary">Defendant (Bibadi) Nominated Representatives (বিবাদী পক্ষ)</h4>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>1. UP Member <span class="text-danger">*</span></label>
                                            <select name="bibadi_up_member_id" class="form-control select2" required>
                                                <option value="">Select UP Member</option>
                                                @foreach($up_members as $m)
                                                    <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->system_id }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>2. Citizen Representative <span class="text-danger">*</span></label>
                                            <select name="bibadi_citizen_id" class="form-control select2" required>
                                                <option value="">Select Citizen</option>
                                                @foreach($people as $p)
                                                    @if(!in_array($p->id, (array)$case->bibadi_ids))
                                                        <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->approved_id }})</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="mt-3 text-primary">Schedules (হাজিরা ও শুনানির তারিখ-সময় নির্ধারণ)</h4>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Hearing & Appearance Date (হাজিরা ও শুনানির তারিখ) <span class="text-danger">*</span></label>
                                            <input type="date" name="sunani_date" class="form-control" required value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Hearing & Appearance Time (হাজিরা ও শুনানির সময়) <span class="text-danger">*</span></label>
                                            <input type="time" name="sunani_time" class="form-control" required value="10:00">
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
        $(function () {
            $('.select2').select2({ theme: 'bootstrap4' });
        });
    </script>
@endpush
