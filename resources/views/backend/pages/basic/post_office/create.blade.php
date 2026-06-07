@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' =>'PostOffice'])
@push('style')
@endpush
@section('title', 'Post Office Create')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Post Office Create</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('basic-settings.post-office.index')}}">Post Office</a></li>
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
                            <h3 class="card-title">Post Office Create Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="postOfficeForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row align-items-center">
                                            <label for="division_id" class="col-auto col-form-label">Division <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                            <div class="col">
                                                @if(isset($is_union_admin) && $is_union_admin && isset($selected_division))
                                                    <select class="form-control select2" name="division_id" id="division_id" disabled>
                                                        <option value="">Select Division</option>
                                                        @if($divisions)
                                                            @foreach($divisions as $division)
                                                                <option value="{{$division->id}}" {{$selected_division == $division->id ? 'selected' : ''}}>{{$division->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                @else
                                                    <select class="form-control select2" name="division_id" id="division_id" required>
                                                        <option value="">Select Division</option>
                                                        @if($divisions)
                                                            @foreach($divisions as $division)
                                                                <option value="{{$division->id}}">{{$division->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                @endif
                                                <span class="text-danger error-text division_id-error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group row align-items-center">
                                            <label for="district_id" class="col-auto col-form-label">District <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                            <div class="col">
                                                @if(isset($is_union_admin) && $is_union_admin && isset($selected_district) && isset($districts))
                                                    <select class="form-control select2" name="district_id" id="district_id" disabled>
                                                        <option value="">Select District</option>
                                                        @foreach($districts as $district)
                                                            <option value="{{$district->id}}" {{$selected_district == $district->id ? 'selected' : ''}}>{{$district->name}}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <select class="form-control select2" name="district_id" id="district_id" required>
                                                        <option value="">Select District</option>
                                                    </select>
                                                @endif
                                                <span class="text-danger error-text district_id-error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group row align-items-center">
                                            <label for="thana_id" class="col-auto col-form-label">Upazilla <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                            <div class="col">
                                                @if(isset($is_union_admin) && $is_union_admin && isset($selected_thana) && isset($upazillas))
                                                    <input type="hidden" name="thana_id" value="{{$selected_thana}}">
                                                    <select class="form-control select2" id="thana_id" disabled>
                                                        <option value="">Select Upazilla</option>
                                                        @foreach($upazillas as $upazilla)
                                                            <option value="{{$upazilla->id}}" {{$selected_thana == $upazilla->id ? 'selected' : ''}}>{{$upazilla->name}}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <select class="form-control select2" name="thana_id" id="thana_id" required>
                                                        <option value="">Select Upazilla</option>
                                                    </select>
                                                @endif
                                                <span class="text-danger error-text thana_id-error"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Post Office Name (EN) <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Post Office Name in English" required>
                                        <span class="text-danger error-text name-error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bn_name" class="col-sm-2 col-form-label">Post Office Name (BN) </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="bn_name" name="bn_name" placeholder="Post Office Name in Bengali">
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
                                            <input type="checkbox" class="custom-control-input" id="status" name="status" checked value="1">
                                            <label class="custom-control-label" for="status">Active</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Save</button>
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
        
        $('#division_id').on('change', function() {
            var divisionID = $(this).val();
            if(divisionID) {
                $.ajax({
                    url: '/get-districts-by-division/'+divisionID,
                    type: "GET",
                    success:function(data) {
                        $('#district_id').html(data);
                        $('#thana_id').html('<option value="">Select Upazilla</option>');
                    }
                });
            } else {
                $('#district_id').html('<option value="">Select District</option>');
                $('#thana_id').html('<option value="">Select Upazilla</option>');
            }
        });

        $('#district_id').on('change', function() {
            var districtID = $(this).val();
            if(districtID) {
                $.ajax({
                    url: '/get-upazillas-by-district/'+districtID,
                    type: "GET",
                    success:function(data) {
                        $('#thana_id').html(data);
                    }
                });
            } else {
                $('#thana_id').html('<option value="">Select Upazilla</option>');
            }
        });

        $("#postOfficeForm").on('submit', function(e) {
            e.preventDefault();
            let thisForm = $(this);
            $.ajax({
                type: "POST",
                url: "{{route('basic-settings.post-office.store')}}",
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
