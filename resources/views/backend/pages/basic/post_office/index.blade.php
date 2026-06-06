@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' =>'PostOffice'])
@push('style')
@endpush
@section('title', 'Post Office')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Post Office</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('basic-settings.post-office.index')}}">Post Office</a></li>
            <li class="breadcrumb-item active">View</li>
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
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <h3 class="card-title">Post Office List</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{route('basic-settings.post-office.create')}}" class="btn btn-primary">Create</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                          <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped" style="width:100%">
                              <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Post Office Name</th>
                                    <th>Bengali Name</th>
                                    <th>Postal Code</th>
                                    <th>District</th>
                                    <th>Thana</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>

                                @if ($post_offices)

                                  @foreach ($post_offices as $key=>$post_office)
                                    <tr>
                                      <td>{{++$key}}</td>
                                      <td>{{$post_office->name}}</td>
                                      <td>{{$post_office->bn_name}}</td>
                                      <td>{{$post_office->postal_code}}</td>
                                      <td>{{$post_office->thana->district->name ?? 'N/A'}}</td>
                                      <td>{{$post_office->thana->name ?? 'N/A'}}</td>
                                      <td>
                                          @if($post_office->status == 1)
                                            <span class="badge badge-success">Active</span>
                                          @else
                                            <span class="badge badge-danger">Inactive</span>
                                          @endif
                                      </td>
                                      <td>
                                        <div class="table-action">
                                            @if(edit_permission())
<a class="btn btn-sm btn-primary" title="Edit" data-toggle="tooltip" href="{{route('basic-settings.post-office.edit', $post_office->id)}}"><i class="fa fa-edit"></i></a>
@endif

                                            <form class="deletePostOffice" method="post">
                                              @csrf
                                              @method('DELETE')
                                              <input type="hidden" class="id" name="id" value="{{$post_office->id}}">
                                              <input type="hidden" class="deleteUrl" name="deleteUrl" value="{{route('basic-settings.post-office.destroy', $post_office->id)}}">
                                              <button type="submit" title="Delete" data-toggle="tooltip" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                      </td>
                                    </tr>
                                  @endforeach
                                    
                                @endif

                              </tbody>

                            </table>
                          </div>
                            
                          </div>
                          <!-- /.card-body -->

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
  
  $(document).ready(function(){
    // Initialize DataTable safely
    if ($.fn.DataTable.isDataTable('#example1')) {
        $('#example1').DataTable().destroy();
    }
    $('#example1').DataTable({
        responsive: true,
        autoWidth: false,
        scrollX: false,
        pageLength: 10,
    });

    $(".deletePostOffice").on('submit', function(e){
      e.preventDefault();
      var thisForm = $(this);
      var formData = $(this).serialize();
      var deleteUrl = $(this).find(".deleteUrl").val();
      $("#toast-container").show();
      toastr.success("<br /><button type='button' id='confirmationRevertNo' class='btn clear'>No</button><br /><button type='button' id='confirmationRevertYes' class='btn clear'>Yes</button>",'Are you sure, you want to delete it?',
		{
			closeButton: false,
			allowHtml: true,
			onShown: function (toast) {
				$("#confirmationRevertYes").click(function(){
					$.ajax({
                    type: "POST",
                    url: deleteUrl,
                    data: formData,
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

				});

        $("#confirmationRevertNo").click(function(){
          $("#toast-container").hide();
        })
			}
		});
    })
  });

</script>
@endpush
