@extends('backend.master', ['mainMenu' => 'LocalGovtJudiciary', 'subMenu' => 'VillageCourtList'])
@push('style')
@endpush
@section('title', 'Declare Verdict - ' . $case->case_no)
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Declare Verdict (রায় ঘোষণা)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('village-court.index') }}">Case</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('village-court.show', $case->id) }}">{{ $case->case_no }}</a></li>
                        <li class="breadcrumb-item active">Verdict</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Verdict & Decision Details Form</h3>
                        </div>
                        <form action="{{ route('village-court.declare-verdict', $case->id) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Verdict Details / Decision Summary (রায়ের বিবরণ) <span class="text-danger">*</span></label>
                                    <textarea name="verdict" class="form-control" rows="8" placeholder="Enter the final verdict and decision details as resolved by the court panel..." required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Verdict Date (রায় ঘোষণার তারিখ) <span class="text-danger">*</span></label>
                                    <input type="date" name="verdict_date" class="form-control" required value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Declare final verdict & close case</button>
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
