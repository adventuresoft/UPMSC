@extends('backend.master', ['mainMenu' => 'Bridge', 'subMenu' =>'BridgeList'])
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
@section('title', 'Bridge List')
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
                                    <h3 class="card-title" style="font-size:24px; font-weight: semi-bold;">Bridge Information</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{route('bridge.create')}}" class="btn btn-primary">Create</a>
                                    <a href="{{route('bridge.index')}}" class="btn btn-primary">List</a>
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
                                    <input type="text" id="search_bridge_name" class="form-control form-control-sm" placeholder="Bridge Name">
                                </div>

                                <div class="col-md-2">
                                    <input type="text" id="search_bridge_type" class="form-control form-control-sm" placeholder="Bridge Type">
                                </div>

                                <div class="col-md-2">
                                    <input type="text" id="search_category" class="form-control form-control-sm" placeholder="Category">
                                </div>
                                
                                <div class="col-md-2">
                                    <input type="text" id="search_condition" class="form-control form-control-sm" placeholder="Condition">
                                </div>

                                <div class="col-md-3">
                                    <input type="text" id="search_global" class="form-control form-control-sm" placeholder="Search">
                                </div>
                            </div>

                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Bridge Name</th>
                                    <th>Bridge Type</th>
                                    <th>Bridge Categoty</th>
                                    <th>Condition</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

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

        $('#search_bridge_name').keyup(function() {
            table.column(1).search(this.value).draw();
        });

        $('#search_bridge_type').keyup(function() {
            table.column(2).search(this.value).draw();
        });
        
        $('#search_category').keyup(function() {
            table.column(3).search(this.value).draw();
        });

        $('#search_condition').keyup(function() {
            table.column(4).search(this.value).draw();
        });

        $('#search_global').keyup(function() {
            table.search(this.value).draw();
        });

        $('#tableLength').change(function() {
            table.page.len($(this).val()).draw();
        });
    });
</script>
@endpush

