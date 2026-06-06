@extends('backend.master', ['mainMenu' => 'House', 'subMenu' =>'HouseList'])
@push('style')
<style>
    .table-action {
        display: flex;
        gap: 6px;
    }

    .row.mb-3 input {
        height: 32px;
        font-size: 13px;
    }

    .row.mb-3 select {
        height: 32px;
        font-size: 13px;
    }

    .dataTables_filter {
        display: none;
    }
</style>
@endpush
@section('title', 'House List')
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-md-6 text-left">
                                    <h3 class="card-title" style="font-size:24px; font-weight: semi-bold;">House Information</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                  @if ((is_superadmin() || Auth::user()->institute_id) && create_permission() )
                                    <a href="{{route('house.create')}}" class="btn btn-primary">Create</a>
                                    <a href="{{route('house.index')}}" class="btn btn-primary">List</a>
                                   @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <!-- FILTER BAR -->
                            <div class="row mb-3 align-items-center g-2">
                                <div class="col-md-1">
                                    <select id="tableLength" class="form-control form-control-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <input type="text" id="search_house_name" class="form-control form-control-sm" placeholder="House Name">
                                </div>

                                <div class="col-md-2">
                                    <input type="text" id="search_owner" class="form-control form-control-sm" placeholder="Owner ID/Name">
                                </div>

                                <div class="col-md-2">
                                    <input type="text" id="search_village" class="form-control form-control-sm" placeholder="Village / Ward">
                                </div>
                                
                                <div class="col-md-2">
                                    <input type="text" id="search_block" class="form-control form-control-sm" placeholder="Block/Section">
                                </div>

                                <div class="col-md-3">
                                    <input type="text" id="search_global" class="form-control form-control-sm" placeholder="Search">
                                </div>
                            </div>

                          <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>House Name</th>
                                    <th>Owner Name & ID</th>
                                    <th>Village / Ward No.</th>
                                    <th>Block/Section/Sector</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>

                                @if (count($houses))
                                  @foreach ($houses as $key => $house)
                                    <tr>
                                      <td>{{++$key}}</td>
                                      <td>{{$house->house}}</td>
                                      <td>
                                        @php
                                            $ownership = $house->ownership->first();
                                            $ownerName = $ownership->name ?? '';
                                            $ownerIdDisplay = '';
                                            if ($ownership) {
                                                if ($ownership->owner && $ownership->owner->people && $ownership->owner->people->approved_id) {
                                                    $ownerIdDisplay = $ownership->owner->people->approved_id;
                                                } elseif ($ownership->nid) {
                                                    $ownerIdDisplay = '(' . $ownership->nid . ')';
                                                }
                                            }
                                        @endphp
                                        {{ $ownerName }} <br>
                                        <small class="text-muted">{{ $ownerIdDisplay }}</small>
                                      </td>
                                      <td>{{$house->village->en_name ?? ''}} / Ward {{$house->unionWard->en_ward_no ?? ''}}</td>
                                      <td>{{ $house->villageArea->en_name ?? $house->block_section ?? '' }}</td>
                                      <td style="width: 10%">

                                        <div class="table-action justify-content-center">
                                            @if ((is_superadmin() || Auth::user()->institute_id) && view_permission() )
                                            @if(edit_permission())
                                                <a href="{{ route('house.show', $house->id) }}" title="View" data-toggle="tooltip" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('house.edit', $house->id) }}" title="Edit" data-toggle="tooltip" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if(delete_permission())
                                                <form class="deleteHouse" method="post" style="display:inline;">
                                                  @csrf
                                                  @method('Delete')
                                                  <input type="hidden" class="deleteUrl" name="delete_url" value="{{route('house.destroy', $house->id)}}">
                                                  <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
                                                </form>
                                            @endif
                                            @endif
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
      
    let table = $('#example1').DataTable({
        responsive: true,
        autoWidth: false,
        pageLength: 10,
        lengthChange: false,
        order: [[0, 'asc']],
        columnDefs: [
            { targets: 5, orderable: false }
        ]
    });

    $('#search_house_name').keyup(function() {
        table.column(1).search(this.value).draw();
    });

    $('#search_owner').keyup(function() {
        table.column(2).search(this.value).draw();
    });
    
    $('#search_village').keyup(function() {
        table.column(3).search(this.value).draw();
    });

    $('#search_block').keyup(function() {
        table.column(4).search(this.value).draw();
    });

    $('#search_global').keyup(function() {
        table.search(this.value).draw();
    });

    $('#tableLength').change(function() {
        table.page.len($(this).val()).draw();
    });

    $(".deleteHouse").on('submit', function(e){
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

