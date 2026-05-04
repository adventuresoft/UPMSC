@extends('backend.master', ['mainMenu' => 'Vehicle', 'subMenu' =>'VehicleGenerateInvoice'])

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

@section('title', 'Vehicle Generate Invoice')

@section('content')



<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-info">
          <div class="card-header">
            <div class="row">
              <div class="col-md-6 text-left">
                <h3 class="card-title">Vehicle Generate Invoice</h3>
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
                <div class="col-md-2 px-1">
                    <input type="text" id="search_vehicle_name" class="form-control form-control-sm" placeholder="Vehicle Name">
                </div>
                <div class="col-md-2 px-1">
                    <input type="text" id="search_type" class="form-control form-control-sm" placeholder="Vehicle Type">
                </div>
                <div class="col-md-2 px-1">
                    <input type="text" id="search_owner" class="form-control form-control-sm" placeholder="Owner ID/Name">
                </div>
                <div class="col-md-2 px-1">
                    <select id="search_ownership" class="form-control form-control-sm">
                        <option value="">All Ownership</option>
                        <option value="Personal">Personal</option>
                        <option value="Institutional">Institutional</option>
                    </select>
                </div>
                <div class="col-md-1 px-1">
                    <select id="statusFilter" class="form-control form-control-sm" title="Status">
                      <option value="">Status</option>
                      <option value="Pending">Pending</option>
                      <option value="Approved">Approved</option>
                    </select>
                </div>
                <div class="col-md-2 px-1">
                    <input type="text" id="search_global" class="form-control form-control-sm" placeholder="Search...">
                </div>
            </div>

            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Sl.</th>
                  <th>Vehicle Name</th>
                  <th>Owner Name</th>
                  <th>Type</th>
                  <th>Category</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if (count($vehicles))
                @foreach ($vehicles as $key=>$vehicle)
                <tr>
                  <td>{{++$key}}</td>
                  <td>{{$vehicle->vehicle_model ?? '--'}} {{ $vehicle->make_year ? ' ('.$vehicle->make_year.')' : '' }}</td>
                  <td>
                    {{ $vehicle->owner_id ?? '--' }}
                    @php
                        $ownerDisplayName = $vehicle->ownership_type === 'institutional'
                            ? ($vehicle->institutional_name ?? $vehicle->owner_name)
                            : $vehicle->owner_name;
                    @endphp
                    {{ $ownerDisplayName ? ' - ' . $ownerDisplayName : '' }}
                    <span class="d-none ownership-token">{{ ucfirst($vehicle->ownership_type ?? '') }}</span>
                  </td>
                  <td>{{$vehicle->vehicle_type ?? '--'}}</td>
                  <td>{{$vehicle->vehicle_category ?? '--'}}</td>
                  <td>{{date('d-m-Y', strtotime($vehicle->created_at))}}</td>
                  <td>
                    @if ($vehicle->status == 0 || $vehicle->status === null)
                    <label class="badge badge-info">Pending</label>
                    @elseif($vehicle->status == 1)
                    <label class="badge badge-success">Approved</label>
                    @endif
                  </td>
                  <td>
                    <div class="table-action d-flex" style="gap: 5px;">
                      <a href="#"
                        title="Generate Invoice"
                        class="btn btn-sm btn-info btn-fee-modal"
                        data-id="{{ $vehicle->id }}">
                        <i class="fa fa-hand-holding-usd"></i>
                      </a>
                      
                      <a href="{{route('vehicle.invoice.show', $vehicle->id )}}"
                        title="Show"
                        class="btn btn-sm btn-success">
                        <i class="fa fa-eye"></i>
                      </a>
                      
                      <a href="{{route('vehicle.invoice.print', $vehicle->id )}}"
                        title="Print Invoice"
                        class="btn btn-sm btn-info"
                        target="_blank">
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

<!-- Fee Modal -->
<div class="modal fade" id="feeModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title text-white">Vehicle Fees Details</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row align-items-center">
            <label class="col-sm-5 col-form-label mb-0">Application Type:</label>
            <div class="col-sm-7">
                <select id="modalAppType" class="form-control form-control-sm">
                    <option value="new">New</option>
                    <option value="renew">Renew</option>
                </select>
            </div>
        </div>
        <table class="table table-bordered table-sm mt-3">
            <tbody>
                <tr><td id="m_reg_label">Registration</td><td id="m_reg_fee" class="text-right">0.00</td></tr>
                <tr><td>Road</td><td id="m_road_fee" class="text-right">0.00</td></tr>
                <tr><td>Fitness</td><td id="m_fitness_fee" class="text-right">0.00</td></tr>
                <tr><td>VAT</td><td id="m_vat_fee" class="text-right">0.00</td></tr>
                <tr><td>Tax</td><td id="m_tax_fee" class="text-right">0.00</td></tr>
                <tr class="bg-light font-weight-bold"><td>Total</td><td id="m_total_fee" class="text-right">0.00</td></tr>
            </tbody>
        </table>
        <div id="m_error" class="text-danger mt-2 text-center" style="display:none; font-size: 14px;">Fees not configured for this application type.</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
       <!-- <button type="button" class="btn btn-info btn-sm">Generate Invoice</button> -->
      </div>
    </div>
  </div>
</div>

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

    $('#search_type').keyup(function() {
        table.column(3).search(this.value).draw();
    });

    $('#search_owner').keyup(function() {
        table.column(2).search(this.value).draw();
    });

    $('#search_ownership').change(function() {
        table.column(2).search(this.value).draw();
    });

    $('#search_global').keyup(function() {
        table.search(this.value).draw();
    });

    $('#tableLength').change(function() {
        table.page.len($(this).val()).draw();
    });

    $('#statusFilter').on('change', function() {
      table.column(6).search(this.value).draw();
    });

    let feeData = { new: null, renew: null };

    $(document).on('click', '.btn-fee-modal', function(e) {
        e.preventDefault();
        let vehicleId = $(this).data('id');
        let url = "{{ route('vehicle.get.fees', ':id') }}".replace(':id', vehicleId);
        
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                if(response.status) {
                    feeData.new = response.new_fees;
                    feeData.renew = response.renew_fees;
                    
                    $('#modalAppType').val('new').trigger('change');
                    $('#feeModal').modal('show');
                } else {
                    toastr.error(response.message);
                }
            },
            error: function() {
                toastr.error("Failed to load fees data.");
            }
        });
    });

    $('#modalAppType').on('change', function() {
        let type = $(this).val();
        let data = feeData[type];
        
        if(data) {
            $('#m_error').hide();
            $('#m_reg_fee').text(parseFloat(data.registration_fee).toFixed(2));
            $('#m_road_fee').text(parseFloat(data.road_fee).toFixed(2));
            $('#m_fitness_fee').text(parseFloat(data.fitness_fee).toFixed(2));
            $('#m_vat_fee').text(parseFloat(data.vat_fee).toFixed(2));
            $('#m_tax_fee').text(parseFloat(data.tax_fee).toFixed(2));
            $('#m_total_fee').text(parseFloat(data.total_fee).toFixed(2));
            
            if (type === 'renew') {
                $('#m_reg_label').text('Renew Fees');
            } else {
                $('#m_reg_label').text('Registration');
            }
        } else {
            $('#m_error').show();
            $('#m_reg_fee, #m_road_fee, #m_fitness_fee, #m_vat_fee, #m_tax_fee, #m_total_fee').text('0.00');
            if (type === 'renew') {
                $('#m_reg_label').text('Renew Fees');
            } else {
                $('#m_reg_label').text('Registration');
            }
        }
    });
  });
</script>
@endpush
