@extends('backend.master', ['mainMenu' => 'Vehicle', 'subMenu' =>'VehicleLicense'])

@push('style')
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<style>
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

@section('title', 'Vehicle License List')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-info">
          <div class="card-header">
            <div class="row">
              <div class="col-md-6 text-left">
                <h3 class="card-title">Vehicle License List</h3>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row mb-3 align-items-center g-2">
                <div class="col-md-1 px-1">
                    <select id="tableLength" class="form-control form-control-sm" title="Rows per page">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="col-md-3 px-1">
                    <input type="text" id="search_vehicle_name" class="form-control form-control-sm" placeholder="Vehicle Name">
                </div>
                <div class="col-md-3 px-1">
                    <input type="text" id="search_owner" class="form-control form-control-sm" placeholder="Owner ID/Name">
                </div>
                <div class="col-md-2 px-1">
                    <input type="text" id="search_type" class="form-control form-control-sm" placeholder="Vehicle Type">
                </div>
                <div class="col-md-3 px-1">
                    <input type="text" id="search_global" class="form-control form-control-sm" placeholder="Search...">
                </div>
            </div>

            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Vehicle ID</th>
                  <th>Vehicle Name</th>
                  <th>Owner Name</th>
                  <th>Type</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if (isset($vehicles) && count($vehicles))
                @foreach ($vehicles as $vehicle)
                <tr>
                  <td>{{ $vehicle->registration_id ?? $vehicle->id }}</td>
                  <td>{{ $vehicle->vehicle_model ?? '--' }}{{ $vehicle->make_year ? ' ('.$vehicle->make_year.')' : '' }}</td>
                  <td>
                    {{ $vehicle->owner_id ?? '--' }}
                    @php
                        $ownerDisplayName = $vehicle->ownership_type === 'institutional'
                            ? ($vehicle->institutional_name ?? $vehicle->owner_name)
                            : $vehicle->owner_name;
                    @endphp
                    {{ $ownerDisplayName ? ' - ' . $ownerDisplayName : '' }}
                  </td>
                  <td>{{ $vehicle->vehicle_type ?? '--' }}</td>
                  <td>{{ date('d-m-Y', strtotime($vehicle->created_at)) }}</td>
                  <td>
                    <div class="table-action d-flex" style="gap: 5px;">
                      <a href="{{ route('vehicle.license.show', $vehicle->id ) }}" title="View License" class="btn btn-sm btn-success">
                        <i class="fa fa-eye"></i>
                      </a>

                      <a href="{{ route('vehicle.license.print', $vehicle->id ) }}" title="Print License" class="btn btn-sm btn-info" target="_blank">
                        <i class="fa fa-print"></i>
                      </a>
                    </div>
                  </td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('script')
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>

<script>
  $(function() {
    var table = $("#example1").DataTable({
      responsive: true,
      autoWidth: false,
      pageLength: 10,
      lengthChange: false,
      ordering: true,
      searching: true
    });

    $('#search_vehicle_name').keyup(function() {
        table.column(1).search(this.value).draw();
    });

    $('#search_owner').keyup(function() {
        table.column(2).search(this.value).draw();
    });

    $('#search_type').keyup(function() {
        table.column(3).search(this.value).draw();
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
