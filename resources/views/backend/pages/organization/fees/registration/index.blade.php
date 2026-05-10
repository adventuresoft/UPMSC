@extends('backend.master', ['mainMenu' => 'Organization', 'subMenu' =>'RegistrationFees'])
@push('style')
@endpush
@section('title', 'Organization Registration Fees')
@section('content')
   <!-- Content Header (Page header)
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Organization Registration Fees</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('organizationA.registration-fees.index')}}">Organization Registration Fees List</a></li>
            <li class="breadcrumb-item active">View</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
    -->
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
                                    <h3 class="card-title">Organization Registration Fees List</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{route('organizationA.registration-fees.create')}}" class="btn btn-primary">Create</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">

                          <!-- FILTER BAR -->
                          <div class="row mb-3 align-items-center g-2">

                            <!-- Show Entries -->
                            <div class="col-md-1">
                              <select id="tableLength" class="form-control form-control-sm">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                              </select>
                            </div>

                            <!-- Financial Year Filter -->
                            <div class="col-md-2">
                              <input type="text" id="search_financial_year" class="form-control form-control-sm"
                                placeholder="Financial Year">
                            </div>

                            <!-- Type Filter -->
                            <div class="col-md-2">
                              <input type="text" id="search_type" class="form-control form-control-sm"
                                placeholder="Type">
                            </div>

                            <!-- Category Filter -->
                            <div class="col-md-2">
                              <input type="text" id="search_category" class="form-control form-control-sm"
                                placeholder="Category">
                            </div>

                            <!-- Fees Head Filter -->
                            <div class="col-md-2">
                              <input type="text" id="search_fees_head" class="form-control form-control-sm"
                                placeholder="Fees Head">
                            </div>

                            <!-- GLOBAL SEARCH -->
                            <div class="col-md-2">
                              <input type="text" id="search_global" class="form-control form-control-sm"
                                placeholder="Search">
                            </div>

                          </div>

                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Financial Year</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Fees Head</th>
                                    <th>Category A</th>
                                    <th>Category B</th>
                                    <th>Category C</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>

                                @if (count($fees))
                                  @foreach ($fees as $key=>$fee)
                                    <tr>
                                      <td>{{++$key}}</td>
                                      <td>{{ $fee->taxYear->name ?? '-' }}</td>
                                      <td>{{ $fee->instituteType->name ?? '-' }}</td>
                                      <td>
                                        {{ $fee->organizationCategory->en_name ?? '-' }}
                                        @if(!empty($fee->organizationSubcategory?->en_name))
                                          <small class="text-muted">({{ $fee->organizationSubcategory->en_name }})</small>
                                        @endif
                                      </td>
                                      <td>{{$fee->name}}</td>
                                      <td>{{$fee->category_a_fees}}</td>
                                      <td>{{$fee->category_b_fees}}</td>
                                      <td>{{$fee->category_c_fees}}</td>
                                      <td>
                                        <div class="d-flex">
                                          @if ( basic_settings_permissions() )
                                              <a href="{{ route('organizationA.registration-fees.edit', $fee->id) }}" title="Edit" class="btn btn-primary mx-2"><i class="fa fa-edit"></i></a>
                                              <form class="deleteOrganzationFee" method="post">
                                                @csrf
                                                @method('Delete')
                                                <input type="hidden" class="deleteUrl" name="delete_url" value="{{route('organizationA.registration-fees.destroy', $fee->id)}}">
                                                <button type="submit" class="btn btn-danger mx-2" title="Delete"><i class="fa fa-trash"></i></button>
                                              </form>
                                          @endif
                                      </div>
                                      </td>
                                    </tr>
                                  @endforeach
                                @endif

                              </tbody>

                            </table>
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
  let table = $('#example1').DataTable({
    dom: 'rtip',
    responsive: true,
    autoWidth: false,
    pageLength: 10,
    lengthChange: false,
    order: [[0, 'asc']],
    columnDefs: [
      { targets: 8, orderable: false }
    ],
    language: {
      emptyTable: '<div class="empty-state"><i class="fas fa-folder-open"></i><h5>No data available</h5></div>',
      zeroRecords: '<div class="empty-state"><i class="fas fa-folder-open"></i><h5>No matching records found</h5></div>'
    }
  });

  $('#search_financial_year').keyup(function() {
    table.column(1).search(this.value).draw();
  });

  $('#search_type').keyup(function() {
    table.column(2).search(this.value).draw();
  });

  $('#search_category').keyup(function() {
    table.column(3).search(this.value).draw();
  });

  $('#search_fees_head').keyup(function() {
    table.column(4).search(this.value).draw();
  });

  $('#search_global').keyup(function() {
    table.search(this.value).draw();
  });

  $('#tableLength').change(function() {
    table.page.len($(this).val()).draw();
  });

  $(".deleteOrganzationFee").on('submit', function(e){
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
                          location.reload();
                      },
                      error: function(xhr, status, error) {
                          thisForm.find('button[type="submit"]').prop("disabled",false);
                          var responseText = jQuery.parseJSON(xhr.responseText);
                          toastr.error(responseText.message);
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
