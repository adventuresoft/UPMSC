@extends('backend.master', ['mainMenu' => 'People', 'subMenu' => 'Create'])
@section('title', 'People Create')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>People Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('people.index') }}">People</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-bottom-0 pb-0">
                            <div class="d-block">
                                @include('backend.pages.people.tabs.tab_header', [
                                    'user' => $user,
                                    'active_tab' => 'july_fighter',
                                ])
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="peopleJulyFighterForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-info font-weight-bold">Are you a July 2024 Fighter?</label>
                                    <div class="col-sm-9 px-2 d-flex align-items-center">
                                        <div class="custom-control custom-radio mr-4">
                                            <input class="custom-control-input" type="radio" value="0" {{(isset($user->julyFighterInfo->is_july_fighter) ? (($user->julyFighterInfo->is_july_fighter == 0) ? 'checked' : '') : 'checked')}} id="fighter-no" name="is_july_fighter">
                                            <label for="fighter-no" class="custom-control-label font-weight-normal">No, I am not</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" value="1" {{(isset($user->julyFighterInfo->is_july_fighter) ? (($user->julyFighterInfo->is_july_fighter == 1) ? 'checked' : '') : '')}} id="fighter-yes" name="is_july_fighter">
                                            <label for="fighter-yes" class="custom-control-label font-weight-normal">Yes, I am</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="july-fighter-content {{(isset($user->julyFighterInfo->is_july_fighter) ? (($user->julyFighterInfo->is_july_fighter == 1) ? '' : 'd-none') : 'd-none')}}">
                                    <hr>
                                    <div class="form-group row">
                                        <label for="fighter_type" class="col-sm-3 col-form-label">Fighter Category</label>
                                        <div class="col-sm-9">
                                            <select name="fighter_type" class="form-control" id="fighter_type">
                                                <option value="">Select Category</option>
                                                <option value="Martyr" {{isset($user->julyFighterInfo->fighter_type) && $user->julyFighterInfo->fighter_type == 'Martyr' ? 'selected' : ''}}>Martyr (শহীদ)</option>
                                                <option value="Injured" {{isset($user->julyFighterInfo->fighter_type) && $user->julyFighterInfo->fighter_type == 'Injured' ? 'selected' : ''}}>Injured (আহত)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="incident_location" class="col-sm-3 col-form-label">Movement/Incident Location</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="incident_location" value="{{$user->julyFighterInfo->incident_location ?? ''}}" class="form-control" id="incident_location" placeholder="e.g. Uttara, Badda, Shahbagh...">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="injury_details" class="col-sm-3 col-form-label">Injury Details (If any)</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="injury_details" value="{{$user->julyFighterInfo->injury_details ?? ''}}" class="form-control" id="injury_details" placeholder="Describe any injuries sustained">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="contribution_description" class="col-sm-3 col-form-label">Contribution Description</label>
                                        <div class="col-sm-9">
                                            <textarea name="contribution_description" class="form-control" id="contribution_description" rows="3" placeholder="Briefly describe your participation and contribution">{{$user->julyFighterInfo->contribution_description ?? ''}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-white border-top-0 mt-4">
                                <div class="form-group row align-items-center mb-0">
                                    <div class="col-sm-4">
                                        <a href="{{ route('people.freedom', $user->id) }}" class="btn btn-outline-secondary btn-block">
                                            <i class="fas fa-arrow-left mr-1"></i> Freedom Fighter
                                        </a>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="submit" class="btn btn-primary btn-block shadow-sm" style="background-color: #4f46e5; border-color: #4f46e5;">
                                            <i class="fas fa-check-circle mr-1"></i> Save & Finish
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $("#peopleJulyFighterForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('people.julyFighterStore') }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                    },
                    success: function(response) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.href = response.redirect_url;
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "-error").text(val[0]);
                        });
                    }
                });
            })

            $(document).on('change', 'input[type=radio][name=is_july_fighter]', function(e) {
                if (parseInt($(this).val())) {
                    $(".july-fighter-content").removeClass('d-none');
                } else {
                    $(".july-fighter-content").addClass('d-none');
                }
            })
        })
    </script>
@endpush
