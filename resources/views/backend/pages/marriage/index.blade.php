@extends('backend.master', ['mainMenu' => 'Marriage', 'subMenu' =>'MarriageList'])
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
@section('title', 'Marriage List')
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
                                    <h3 class="card-title" style="font-size:24px; font-weight: semi-bold;">Marriage Registration List</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{route('marriage.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create</a>
                                    <a href="{{route('marriage.index')}}" class="btn btn-primary"><i class="fas fa-list"></i> List</a>
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
                                    <input type="text" id="search_groom" class="form-control form-control-sm" placeholder="Groom Name">
                                </div>

                                <div class="col-md-2">
                                    <input type="text" id="search_bride" class="form-control form-control-sm" placeholder="Bride Name">
                                </div>
                                
                                <div class="col-md-2">
                                    <input type="text" id="search_date" class="form-control form-control-sm" placeholder="Marriage Date">
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
                                    <th>Groom Name</th>
                                    <th>Bride Name</th>
                                    <th>Marriage Date</th>
                                    <th>Religion</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($marriages as $key => $marriage)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $marriage->registration_no }}</td>
                                    <td>{{ $marriage->groom_name }}</td>
                                    <td>{{ $marriage->bride_name }}</td>
                                    <td>{{ $marriage->marriage_date }}</td>
                                    <td>{{ $marriage->marriage_type }}</td>
                                    <td>
                                        <div class="table-action">
                                            <a href="{{ route('marriage.show', $marriage->id) }}" class="btn btn-sm btn-info" title="View"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('marriage.edit', $marriage->id) }}" class="btn btn-sm btn-success" title="Edit"><i class="fas fa-edit"></i></a>
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

        $('#search_groom').keyup(function() {
            table.column(2).search(this.value).draw();
        });
        
        $('#search_bride').keyup(function() {
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
