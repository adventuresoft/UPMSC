@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' =>'PostOffice'])
@push('style')
@endpush
@section('title', 'Post Office Edit')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Post Office Edit</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('basic-settings.post-office.index')}}">Post Office</a></li>
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
                            <h3 class="card-title">Post Office Edit Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="postOfficeForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="row">
                                    <input type="hidden" name="thana_id" value="{{$post_office->thana_id}}">
                                    <div class="col-md-4">
                                        <div class="form-group row align-items-center">
                                            <label for="division_id" class="col-auto col-form-label">Division <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                            <div class="col">
                                                @php
                                                    $selectedDivision = $post_office->upazilla->district->division_id ?? null;
                                                @endphp
                                                <select class="form-control select2" id="division_id" disabled>
                                                    <option value="">Select Division</option>
                                                    @if($divisions)
                                                        @foreach($divisions as $division)
                                                            <option value="{{$division->id}}" {{$selectedDivision == $division->id ? 'selected' : ''}}>{{$division->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group row align-items-center">
                                            <label for="district_id" class="col-auto col-form-label">District <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                            <div class="col">
                                                @php
                                                    $selectedDistrict = $post_office->upazilla->district_id ?? null;
                                                @endphp
                                                <select class="form-control select2" id="district_id" disabled>
                                                    <option value="">Select District</option>
                                                    @if(isset($districts))
                                                        @foreach($districts as $district)
                                                            <option value="{{$district->id}}" {{$selectedDistrict == $district->id ? 'selected' : ''}}>{{$district->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group row align-items-center">
                                            <label for="thana_id" class="col-auto col-form-label">Upazilla <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                            <div class="col">
                                                <select class="form-control select2" id="thana_id" disabled>
                                                    <option value="">Select Upazilla</option>
                                                    @if(isset($upazillas))
                                                        @foreach($upazillas as $upazilla)
                                                            <option value="{{$upazilla->id}}" {{$post_office->thana_id == $upazilla->id ? 'selected' : ''}}>{{$upazilla->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Post Office Name (EN) <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Post Office Name in English" value="{{$post_office->name}}" required>
                                        <span class="text-danger error-text name-error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bn_name" class="col-sm-2 col-form-label">Post Office Name (BN) </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="bn_name" name="bn_name" placeholder="Post Office Name in Bengali" value="{{$post_office->bn_name}}">
                                        <span class="text-danger error-text bn_name-error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="postal_code" class="col-sm-2 col-form-label">Postal Code <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Postal Code" value="{{ isset($post_office) ? $post_office->postal_code : '' }}" required>
                                        <span class="text-danger error-text postal_code-error"></span>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-9 pt-2">
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" class="custom-control-input" id="status" name="status" {{$post_office->status == 1 ? 'checked' : ''}} value="1">
                                            <label class="custom-control-label" for="status">Active</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Update</button>
                                <button type="reset" class="btn btn-default float-right">Cancel</button>
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
        $('.select2').select2();

        $("#postOfficeForm").on('submit', function(e) {
            e.preventDefault();
            let thisForm = $(this);
            $.ajax({
                type: "POST",
                url: "{{route('basic-settings.post-office.update', $post_office->id)}}",
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
                        location.href = "{{route('basic-settings.post-office.index')}}";
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
@endpush
