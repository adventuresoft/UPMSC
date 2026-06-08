@extends('backend.master', ['mainMenu' => 'Land', 'subMenu' =>'LandList'])
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
@section('title', 'Land List')
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
                                    <h3 class="card-title" style="font-size:24px; font-weight: semi-bold;">Land Information</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{route('land.create')}}" class="btn btn-primary">Create</a>
                                    <a href="{{route('land.index')}}" class="btn btn-primary">List</a>
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
                                    <input type="text" id="search_dag" class="form-control form-control-sm" placeholder="Dag No.">
                                </div>

                                <div class="col-md-2">
                                    <input type="text" id="search_khotian" class="form-control form-control-sm" placeholder="Khotian No.">
                                </div>

                                <div class="col-md-2">
                                    <input type="text" id="search_mouza" class="form-control form-control-sm" placeholder="Mouza & Thana">
                                </div>

                                <div class="col-md-2">
                                    <input type="text" id="search_owner" class="form-control form-control-sm" placeholder="Owner ID/Name">
                                </div>

                                <div class="col-md-3">
                                    <input type="text" id="search_global" class="form-control form-control-sm" placeholder="Search">
                                </div>
                            </div>

                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>BRS Dag No. </th>
                                    <th>BRS Khotian No.</th>
                                    <th>Mouza & Thana</th>
                                    <th>District</th>
                                    <th>Owner ID & Name</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($lands as $key => $land)
                                    @php
                                        $records = $land->records_data ?? [];
                                        $brs = $records['brs'] ?? ($records['rs'] ?? ($records['sa'] ?? ($records['cs'] ?? [])));
                                        $districtName = $districts[$brs['district'] ?? ''] ?? 'N/A';
                                        $thanaName = $thanas[$brs['upazila'] ?? ''] ?? 'N/A';
                                        $ownerUser = $land->owner_user;
                                        $ownerName = $ownerUser->name ?? ($ownerUser->people->bn_name ?? ($brs['owner_name'] ?? 'N/A'));
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-center">{{ $brs['dag_no'] ?? 'N/A' }}</td>
                                        <td class="text-center">{{ $brs['khatian_no'] ?? 'N/A' }}</td>
                                        <td class="text-center">{{ $brs['mouza'] ?? 'N/A' }}, {{ $thanaName }}</td>
                                        <td class="text-center">{{ $districtName }}</td>
                                        <td class="text-center">{{ $land->owner_id }} - {{ $ownerName }}</td>
                                        <td class="text-center">
                                            <div class="table-action justify-content-center">
                                                <a href="{{ route('land.show', $land->id) }}" class="btn btn-sm btn-info" title="View"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('land.edit', $land->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                                @if(delete_permission('land'))
                                                <form action="{{ route('land.destroy', $land->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                                </form>
                                                @endif
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
    $(function() {
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

        $('#search_dag').keyup(function() {
            table.column(1).search(this.value).draw();
        });

        $('#search_khotian').keyup(function() {
            table.column(2).search(this.value).draw();
        });
        
        $('#search_mouza').keyup(function() {
            table.column(3).search(this.value).draw();
        });

        $('#search_owner').keyup(function() {
            table.column(5).search(this.value).draw();
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

