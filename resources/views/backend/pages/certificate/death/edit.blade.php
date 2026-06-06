@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'Death'])
@push('style')
@endpush
@section('title', 'Death Certificate')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Death Certificate</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('death.index')}}">Death Certificate</a></li>
            <li class="breadcrumb-item active">Edit</li>
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
                        <form class="form-horizontal" id="deathCertificateForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="user_id" class="col-sm-2 col-form-label">ID & Name</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="user_id">
                                            <option value="">Select People</option>
                                            @if (count($users))
                                                @foreach ($users as $user)
                                                    @if ($user->people->approved_id)
                                                        <option value="{{$user->id}}" {{ $certificate->user_id == $user->id ? 'selected' : '' }}>{{$user->people->approved_id}} - {{$user->name}} - {{$user->email}} - {{$user->mobile ?? '--'}}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                <option value="">No People Found</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Date of Death</label>
                                    <div class="col-sm-9">
                                        <input type="datetime-local" name="date_of_death" class="form-control" id="date_of_death" value="{{ $certificate->date_of_death ? \Carbon\Carbon::parse($certificate->date_of_death)->format('Y-m-d\TH:i') : '' }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="cause_of_death" class="col-sm-2 col-form-label">Cause of Death</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="cause_of_death" id="cause_of_death">
                                            <option value="">Select Cause of Death</option>
                                            <option value="natural" {{ $certificate->cause_of_death == 'natural' ? 'selected' : '' }}>Natural</option>
                                            <option value="accident" {{ $certificate->cause_of_death == 'accident' ? 'selected' : '' }}>Accident</option>
                                            <option value="suicide" {{ $certificate->cause_of_death == 'suicide' ? 'selected' : '' }}>Suicide</option>
                                            <option value="homicide" {{ $certificate->cause_of_death == 'homicide' ? 'selected' : '' }}>Homicide</option>
                                            <option value="stroke" {{ $certificate->cause_of_death == 'stroke' ? 'selected' : '' }}>Stroke</option>
                                            <option value="cancer" {{ $certificate->cause_of_death == 'cancer' ? 'selected' : '' }}>Cancer</option>
                                            <option value="other" {{ $certificate->cause_of_death == 'other' ? 'selected' : '' }}>Others</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="comments" class="col-sm-2 col-form-label">Comment</label>
                                    <div class="col-sm-9">
                                        <textarea name="comments" class="form-control" id="comments" placeholder="Comment" rows="3">{{ $certificate->comments }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <a href="{{route('death.index')}}" class="btn btn-default float-right">Cancel</a>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info">Update</button>
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
            $("#deathCertificateForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('death.update', $certificate->id) }}",
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
