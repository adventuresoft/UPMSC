@extends('backend.master', ['mainMenu' => 'Road', 'subMenu' => 'RoadList'])
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
@section('title', 'Road List')
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
                                    <h3 class="card-title" style="font-size:24px; font-weight: semi-bold;">Road Information</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    @if(create_permission('roads'))
                                    <a href="{{ route('road.create') }}" class="btn btn-primary">Create</a>
                                    <a href="{{ route('road.index') }}" class="btn btn-primary">List</a>
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
                                    <input type="text" id="search_road_name" class="form-control form-control-sm" placeholder="Road Name">
                                </div>

                                <div class="col-md-2">
                                    <input type="text" id="search_road_type" class="form-control form-control-sm" placeholder="Road Type">
                                </div>

                                <div class="col-md-2">
                                    <input type="text" id="search_category" class="form-control form-control-sm" placeholder="Category">
                                </div>
                                
                                <div class="col-md-2">
                                    <input type="text" id="search_owner" class="form-control form-control-sm" placeholder="Owner">
                                </div>

                                <div class="col-md-3">
                                    <input type="text" id="search_global" class="form-control form-control-sm" placeholder="Search">
                                </div>
                            </div>

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl.</th>
                                        <th>Road Name</th>
                                        <th>Road Type</th>
                                        <th>Category</th>
                                        <th>Owner</th>
                                        <th>Condition</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($roads))
                                        @foreach ($roads as $key => $road)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $road->name }}</td>
                                                <td>{{ $road->roadType->en_name ?? '--' }}</td>
                                                <td>{{ $road->roadCategory->en_name ?? '--' }}</td>
                                                <td>{{ $road->roadOwner->en_name ?? '--' }}</td>
                                                <td>{{ $road->current_condition ?? '--' }}</td>
                                                <td style="width: 10%">
                                                    <div class="table-action justify-content-center">
                                                        @if(view_permission('roads'))
                                                        <a class="btn btn-sm btn-info" title="Show" data-toggle="tooltip" href="{{ route('road.show', $road->id) }}"><i class="fa fa-eye"></i></a>
                                                        @endif
                                                        @if(edit_permission('roads'))
                                                        <a class="btn btn-sm btn-primary" title="Edit" data-toggle="tooltip" href="{{ route('road.edit', $road->id) }}"><i class="fa fa-edit"></i></a>
                                                        @endif
                                                        @if(delete_permission('roads'))
                                                        <form class="deleteRoad" method="post" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" class="id" name="id"
                                                                value="{{ $road->id }}">
                                                            <input type="hidden" class="deleteUrl" name="deleteUrl"
                                                                value="{{ route('road.destroy', $road->id) }}">
                                                            <button type="submit" title="Delete" data-toggle="tooltip"
                                                                class="btn btn-sm btn-danger"><i
                                                                    class="fa fa-trash"></i></button>
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
        $(document).ready(function() {
            
            let table = $('#example1').DataTable({
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                lengthChange: false,
                order: [[0, 'asc']],
                columnDefs: [
                    { targets: 6, orderable: false }
                ]
            });

            $('#search_road_name').keyup(function() {
                table.column(1).search(this.value).draw();
            });

            $('#search_road_type').keyup(function() {
                table.column(2).search(this.value).draw();
            });
            
            $('#search_category').keyup(function() {
                table.column(3).search(this.value).draw();
            });

            $('#search_owner').keyup(function() {
                table.column(4).search(this.value).draw();
            });

            $('#search_global').keyup(function() {
                table.search(this.value).draw();
            });

            $('#tableLength').change(function() {
                table.page.len($(this).val()).draw();
            });

            $(".deleteRoad").on('submit', function(e) {
                e.preventDefault();
                var thisForm = $(this);
                var formData = $(this).serialize();
                var deleteUrl = $(this).find(".deleteUrl").val();
                $("#toast-container").show();
                toastr.success(
                    "<br /><button type='button' id='confirmationRevertNo' class='btn clear'>No</button><br /><button type='button' id='confirmationRevertYes' class='btn clear'>Yes</button>",
                    'Are you sure, you want to delete it?', {
                        closeButton: false,
                        allowHtml: true,
                        onShown: function(toast) {
                            $("#confirmationRevertYes").click(function() {

                              
                                $.ajax({
                                    type: "POST",
                                    url: deleteUrl,
                                    data: formData,
                                    beforeSend: function() {
                                        thisForm.find('button[type="submit"]')
                                            .prop("disabled", true);
                                    },
                                    success: function(response) {
                                        thisForm.find('button[type="submit"]')
                                            .prop("disabled", false);
                                        toastr.success(response.message);
                                        setTimeout(function() {
                                            location.href =
                                                "{{ route('road.index') }}";
                                        }, 2000)
                                    },
                                    error: function(xhr, status, error) {
                                        thisForm.find('button[type="submit"]')
                                            .prop("disabled", false);
                                        var responseText = jQuery.parseJSON(xhr
                                            .responseText);
                                        toastr.error(responseText.message);
                                        $.each(responseText.errors, function(
                                            key, val) {
                                            thisForm.find("." + key +
                                                "-error").text(val[
                                                0]);
                                        });
                                    }
                                });



                            });

                            $("#confirmationRevertNo").click(function() {
                                $("#toast-container").hide();
                            })
                        }
                    });
            })
        });
    </script>
@endpush
