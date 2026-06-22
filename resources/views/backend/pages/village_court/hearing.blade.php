@extends('backend.master', ['mainMenu' => 'LocalGovtJudiciary', 'subMenu' => 'VillageCourtList'])
@push('style')
@endpush
@section('title', 'Manage Hearing - ' . $case->case_no)
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Hearing (শুনানি পরিচালনা)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('village-court.index') }}">Case</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('village-court.show', $case->id) }}">{{ $case->case_no }}</a></li>
                        <li class="breadcrumb-item active">Hearing</li>
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
                            <h3 class="card-title">Hearing Log & Schedule Form</h3>
                        </div>
                        <form action="{{ route('village-court.hearing', $case->id) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Hearing Notes / Progress Description (শুনানির বিবরণ) <span class="text-danger">*</span></label>
                                    <textarea name="hearing_notes" class="form-control" rows="6" placeholder="Describe the outcome of the hearing session (e.g. witnesses heard, document reviewed)..." required></textarea>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Appearance Date (হাজিরার তারিখ) <span class="text-danger">*</span></label>
                                            <input type="date" name="hajir_date" id="hajir_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Appearance Time (হাজিরার সময়) <span class="text-danger">*</span></label>
                                            <input type="time" name="hajir_time" id="hajir_time" class="form-control" value="10:00" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Hearing Date (শুনানির তারিখ) <span class="text-danger">*</span></label>
                                            <input type="date" name="sunani_date" id="sunani_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Hearing Time (শুনানির সময়) <span class="text-danger">*</span></label>
                                            <input type="time" name="sunani_time" id="sunani_time" class="form-control" value="10:00" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save Hearing & Continue</button>
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
@endpush
