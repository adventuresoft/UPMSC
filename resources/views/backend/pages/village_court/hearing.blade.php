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

                                <div class="form-group mt-4">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="rescheduleSwitch" name="reschedule" value="1" onchange="toggleRescheduleFields(this)">
                                        <label class="custom-control-label font-weight-bold" for="rescheduleSwitch">Reschedule Next Hearing (পুনরায় শুনানির দিন ধার্য করুন)</label>
                                    </div>
                                </div>

                                <div id="rescheduleFields" style="display: none;">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Next Hearing Date (পরবর্তী শুনানির তারিখ) <span class="text-danger">*</span></label>
                                                <input type="date" name="sunani_date" id="sunani_date" class="form-control" value="{{ date('Y-m-d') }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Next Hearing Time (পরবর্তী শুনানির সময়) <span class="text-danger">*</span></label>
                                                <input type="time" name="sunani_time" id="sunani_time" class="form-control" value="10:00">
                                            </div>
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
    <script>
        function toggleRescheduleFields(checkbox) {
            const fieldsDiv = document.getElementById('rescheduleFields');
            const dateInput = document.getElementById('sunani_date');
            const timeInput = document.getElementById('sunani_time');
            if (checkbox.checked) {
                fieldsDiv.style.display = 'block';
                dateInput.setAttribute('required', 'required');
                timeInput.setAttribute('required', 'required');
            } else {
                fieldsDiv.style.display = 'none';
                dateInput.removeAttribute('required');
                timeInput.removeAttribute('required');
            }
        }
    </script>
@endpush
