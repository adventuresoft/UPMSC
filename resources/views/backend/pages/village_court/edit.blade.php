@extends('backend.master', ['mainMenu' => 'LocalGovtJudiciary', 'subMenu' => 'VillageCourtCreate'])
@push('style')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@section('title', 'Edit Notice')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Notice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('village-court.index') }}">Notice</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Edit Notice Form</h3>
                        </div>
                        <form action="{{ route('village-court.update', $case->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Applicant / Badi <span class="text-danger">*</span></label>
                                            <select name="badi_id" class="form-control select2" required>
                                                <option value="">Select Badi</option>
                                                @foreach($people as $p)
                                                    <option value="{{ $p->id }}" {{ $case->badi_id == $p->id ? 'selected' : '' }}>{{ $p->bn_name ?? $p->name ?? ($p->user->name ?? 'Unknown') }} ({{ $p->nid ?? ($p->user->nid ?? 'No NID') }}) - {{ $p->approved_id }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Defendant / Bibadi <span class="text-danger">*</span></label>
                                            <div id="bibadi-container">
                                                @php $savedBibadis = is_array($case->bibadi_ids) && count($case->bibadi_ids) > 0 ? $case->bibadi_ids : ['']; @endphp
                                                @foreach($savedBibadis as $index => $bId)
                                                <div class="row bibadi-row {{ $index > 0 ? 'mt-2' : '' }}">
                                                    <div class="col-sm-10">
                                                        <select name="bibadi_ids[]" class="form-control select2" required>
                                                            <option value="">Select Bibadi</option>
                                                            @foreach($people as $p)
                                                                <option value="{{ $p->id }}" {{ $bId == $p->id ? 'selected' : '' }}>{{ $p->bn_name ?? $p->name ?? ($p->user->name ?? 'Unknown') }} ({{ $p->nid ?? ($p->user->nid ?? 'No NID') }}) - {{ $p->approved_id }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        @if($index == 0)
                                                            <button type="button" class="btn btn-success add-bibadi"><i class="fas fa-plus"></i></button>
                                                        @else
                                                            <button type="button" class="btn btn-danger remove-bibadi"><i class="fas fa-trash"></i></button>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Witness / Shakkhi</label>
                                            <div id="shakkhi-container">
                                                @php $savedShakkhis = is_array($case->shakkhi_ids) && count($case->shakkhi_ids) > 0 ? $case->shakkhi_ids : ['']; @endphp
                                                @foreach($savedShakkhis as $index => $sId)
                                                <div class="row shakkhi-row {{ $index > 0 ? 'mt-2' : '' }}">
                                                    <div class="col-sm-10">
                                                        <select name="shakkhi_ids[]" class="form-control select2">
                                                            <option value="">Select Witness</option>
                                                            @foreach($people as $p)
                                                                <option value="{{ $p->id }}" {{ $sId == $p->id ? 'selected' : '' }}>{{ $p->bn_name ?? $p->name ?? ($p->user->name ?? 'Unknown') }} ({{ $p->nid ?? ($p->user->nid ?? 'No NID') }}) - {{ $p->approved_id }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        @if($index == 0)
                                                            <button type="button" class="btn btn-success add-shakkhi"><i class="fas fa-plus"></i> Add More</button>
                                                        @else
                                                            <button type="button" class="btn btn-danger remove-shakkhi"><i class="fas fa-trash"></i> Remove</button>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Case Date (মামলার তারিখ) <span class="text-danger">*</span></label>
                                            @php
                                                $caseDate = $case->case_date ? $case->case_date->format('Y-m-d') : date('Y-m-d');
                                                $minDate = min(date('Y-m-d', strtotime('-30 days')), $caseDate);
                                            @endphp
                                            <input type="date" name="case_date" class="form-control" required value="{{ $caseDate }}" min="{{ $minDate }}" max="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Case Time (মামলার সময়) <span class="text-danger">*</span></label>
                                            <input type="time" name="case_time" class="form-control" required value="{{ $case->case_time ? \Carbon\Carbon::parse($case->case_time)->format('H:i') : date('H:i') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Appearance Date (হাজিরার তারিখ) <span class="text-danger">*</span></label>
                                            <input type="date" name="hajir_date" class="form-control" required value="{{ $case->hajir_date ? $case->hajir_date->format('Y-m-d') : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Appearance Time (হাজিরার সময়) <span class="text-danger">*</span></label>
                                            <input type="time" name="hajir_time" class="form-control" required value="{{ $case->hajir_time ? \Carbon\Carbon::parse($case->hajir_time)->format('H:i') : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Complaint Description / Ovijog er Biboron</label>
                                            <textarea name="ovijog_er_biboron" class="form-control" rows="4" placeholder="Enter details of the complaint...">{{ $case->ovijog_er_biboron }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Incident Details / Ghotona Sombolito</label>
                                            <textarea name="ghotona_sombolito" class="form-control" rows="4" placeholder="Enter details related to the incident...">{{ $case->ghotona_sombolito }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Update Notice</button>
                                <a href="{{ route('village-court.index') }}" class="btn btn-default float-right">Cancel</a>
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

            $(document).on('click', '.add-bibadi', function() {
                var newRow = $('.bibadi-row').first().clone();
                newRow.find('span.select2').remove();
                newRow.find('select').removeClass('select2-hidden-accessible').removeAttr('data-select2-id').val('');
                newRow.find('select').find('option').removeAttr('data-select2-id');
                newRow.addClass('mt-2');
                newRow.find('.add-bibadi').removeClass('btn-success add-bibadi').addClass('btn-danger remove-bibadi').html('<i class="fas fa-trash"></i>');
                $('#bibadi-container').append(newRow);
                newRow.find('.select2').select2({ theme: 'bootstrap4' });
            });

            $(document).on('click', '.remove-bibadi', function() {
                $(this).closest('.bibadi-row').remove();
            });

            $(document).on('click', '.add-shakkhi', function() {
                var newRow = $('.shakkhi-row').first().clone();
                newRow.find('span.select2').remove();
                newRow.find('select').removeClass('select2-hidden-accessible').removeAttr('data-select2-id').val('');
                newRow.find('select').find('option').removeAttr('data-select2-id');
                newRow.addClass('mt-2');
                newRow.find('.add-shakkhi').removeClass('btn-success add-shakkhi').addClass('btn-danger remove-shakkhi').html('<i class="fas fa-trash"></i> Remove');
                $('#shakkhi-container').append(newRow);
                newRow.find('.select2').select2({ theme: 'bootstrap4' });
            });

            $(document).on('click', '.remove-shakkhi', function() {
                $(this).closest('.shakkhi-row').remove();
            });
        });
    </script>
@endpush
