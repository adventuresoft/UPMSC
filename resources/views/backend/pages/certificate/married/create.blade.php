@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'Married'])
@push('style')
<style>

</style>
@endpush
@section('title', 'Married Certificate')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Married Certificate</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('married.index')}}">Married Certificate</a></li>
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
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">People Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="certificateForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="user_id" class="col-sm-2 col-form-label">People</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="user_id">
                                            <option value="">Select People</option>
                                            @if (count($users))
                                                @foreach ($users as $user)
                                                    @if (isset($user->people->approved_id))
                                                        <option value="{{$user->id}}" data-gender="{{$user->people->gender ?? ''}}">
                                                            {{$user->people->approved_id}} - {{$user->name}} - {{$user->email}} - {{$user->mobile}}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @else
                                                <option value="">No People Found</option>
                                            @endif

                                        </select>
                                        <small id="user_gender_hint" class="text-muted d-block mt-1"></small>
                                        <small class="text-danger error user_id-error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="spouse_name" class="col-sm-2 col-form-label">Spouse Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="spouse_name" id="spouse_name" placeholder="Spouse Name">
                                        <small class="text-danger error spouse_name-error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="spouse_nid" class="col-sm-2 col-form-label">Spouse NID</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="spouse_nid" id="spouse_nid" placeholder="Spouse NID">
                                        <small class="text-danger error spouse_nid-error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="marriage_date" class="col-sm-2 col-form-label">Marriage Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" name="marriage_date" id="marriage_date">
                                        <small class="text-danger error marriage_date-error"></small>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <a href="{{route('married.index')}}" class="btn btn-default float-right">Cancel</a>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info">Submit</button>
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
    <!-- /.content -->

@endsection
@push('script')

    <script>

         $(document).ready(function() {
             $(".select2").select2();

            function updatePeopleHint() {
                let selected = $('#user_id option:selected');
                let genderRaw = (selected.data('gender') || '').toString().trim().toLowerCase();
                let isHusband = genderRaw === '1' || genderRaw === 'male' || genderRaw === 'm';
                let hint = $('#user_gender_hint');

                if (!$('#user_id').val()) {
                    hint.removeClass('text-danger').addClass('text-muted').text('');
                    return;
                }

                if (isHusband) {
                    hint.removeClass('text-danger').addClass('text-muted').text('Selected person will be treated as husband. Enter spouse details manually.');
                    return;
                }

                hint.removeClass('text-muted').addClass('text-danger').text('Selected person is not husband. Please select husband from People list.');
            }

            $('#user_id').on('change', updatePeopleHint);
            updatePeopleHint();

            $("#certificateForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                thisForm.find('.error').text('');

                let selectedGenderRaw = ($('#user_id option:selected').data('gender') || '').toString().trim().toLowerCase();
                let isHusband = selectedGenderRaw === '1' || selectedGenderRaw === 'male' || selectedGenderRaw === 'm';
                if ($('#user_id').val() && !isHusband) {
                    toastr.error('Please select husband from People list.');
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('married.store') }}",
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
            })
        })

    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#image").change(function() {
            readURL(this);

        });
    </script>
@endpush
