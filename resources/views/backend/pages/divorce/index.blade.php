@extends('backend.master', ['mainMenu' => 'Marriage', 'subMenu' =>'DivorceList'])
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
@section('title', 'Divorce List')
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info" style="border-top: 3px solid #dc2626;">
                        <div class="card-header" style="background-color: #7f1d1d; color: white;">
                            <div class="row align-items-center">
                                <div class="col-md-6 text-left">
                                    <h3 class="card-title" style="font-size:24px; font-weight: semi-bold;">Divorce Registration List</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{route('divorce.create')}}" class="btn btn-sm btn-danger"><i class="fas fa-plus"></i> Create</a>
                                    <a href="{{route('divorce.index')}}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> List</a>
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
                                    <input type="text" id="search_reg_no" class="form-control form-control-sm" placeholder="Registration No">
                                </div>

                                <div class="col-md-2">
                                    <input type="text" id="search_husband" class="form-control form-control-sm" placeholder="Husband Name">
                                </div>

                                <div class="col-md-2">
                                    <input type="text" id="search_wife" class="form-control form-control-sm" placeholder="Wife Name">
                                </div>
                                
                                <div class="col-md-2">
                                    <input type="text" id="search_date" class="form-control form-control-sm" placeholder="Divorce Date">
                                </div>

                                <div class="col-md-3">
                                    <input type="text" id="search_global" class="form-control form-control-sm" placeholder="Search">
                                </div>
                            </div>

                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Reg. No</th>
                                    <th>Husband Name</th>
                                    <th>Wife Name</th>
                                    <th>Divorce Date</th>
                                    <th>Religion</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($divorces as $key => $divorce)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $divorce->registration_no }}</td>
                                    <td>{{ $divorce->husband_name }}</td>
                                    <td>{{ $divorce->wife_name }}</td>
                                    <td>{{ $divorce->divorce_date }}</td>
                                    <td>{{ $divorce->divorce_type }}</td>
                                    <td>
                                        <div class="table-action">
                                            <a href="{{ route('divorce.show', $divorce->id) }}" class="btn btn-sm btn-info" title="View"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('divorce.edit', $divorce->id) }}" class="btn btn-sm btn-success" title="Edit"><i class="fas fa-edit"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
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

        $('#search_reg_no').keyup(function() {
            table.column(1).search(this.value).draw();
        });

        $('#search_husband').keyup(function() {
            table.column(2).search(this.value).draw();
        });
        
        $('#search_wife').keyup(function() {
            table.column(3).search(this.value).draw();
        });

        $('#search_date').keyup(function() {
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
