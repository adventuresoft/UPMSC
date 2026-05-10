@extends('backend.master', ['mainMenu' => 'Organization', 'subMenu' =>'TradeLicense'])

@push('style')

<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

@endpush

@section('title', 'Organization Trade License')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">

      <div class="col-sm-6">
        <h1>Organization Trade License List</h1>
      </div>

      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
            <a href="{{route('organizationA.trade-license.index')}}">Trade License List</a>
          </li>
          <li class="breadcrumb-item active">View</li>
        </ol>
      </div>

    </div>
  </div>
</section>


<section class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">

        <div class="card card-info">

          <div class="card-header">

            <div class="row">

              <div class="col-md-6 text-left">
                <h3 class="card-title">Approved Organization List For Invoice</h3>
              </div>

              <div class="col-md-6 text-right">
                <a href="{{route('organizationA.trade-license.create')}}" class="btn btn-primary">Create</a>
              </div>

            </div>

          </div>


          <div class="card-body">

            <div class="row mb-3">

              <div class="col-md-3">
                <select id="statusFilter" class="form-control">
                  <option value="">All Invoice Status</option>
                  <option value="Not Generated">Not Generated</option>
                  <option value="unpaid">Unpaid</option>
                  <option value="paid">Paid</option>
                </select>
              </div>

            </div>


            <table id="example1" class="table table-bordered table-striped">

              <thead>

                <tr>
                  <th>Sl.</th>
                  <th>Application ID</th>
                  <th>Approved ID</th>
                  <th>Organization Name</th>
                  <th>Type</th>
                  <th>Category</th>
                  <th>Tax Year</th>
                  <th>Date</th>
                  <th>Invoice Status</th>
                  <th>Action</th>
                </tr>

              </thead>

              <tbody>

                @if (count($organizations))

                @foreach ($organizations as $key => $organization)
                @php
                  $license = $organization->latestTradeLicense;
                @endphp

                <tr>

                  <td>{{++$key}}</td>

                  <td>{{ $organization->application_id ?? '-' }}</td>

                  <td>{{ $organization->approved_id ?? '-' }}</td>

                  <td>{{ $organization->name ?? '-' }}</td>

                  <td>{{ $organization?->institute?->type?->name ?? $organization?->type?->en_name ?? $organization?->type?->bn_name ?? '-' }}</td>

                  <td>{{ $organization?->category?->en_name ?? '-' }}</td>

                  <td>{{ $license?->taxYear?->name ?? '-' }}</td>

                  <td>{{ date('d-m-Y', strtotime($license?->updated_at ?? $organization->updated_at)) }}</td>

                  <td>
                    @if ($license)
                      <label class="badge badge-info">{{ ucfirst($license->payment_status ?? 'unpaid') }}</label>
                    @else
                      <label class="badge badge-secondary">Not Generated</label>
                    @endif
                  </td>

                  <td>

                    <div class="table-action">
                      @if ($license)
                        <a href="{{ route('organizationA.trade-license.confirmed', $license->id ) }}"
                          title="Confirmed"
                          class="btn btn-sm btn-info">
                          <i class="fa fa-hand-holding-usd"></i>
                        </a>

                        <a href="{{ route('organizationA.trade-license.invoice', $license->id ) }}"
                          title="Invoice View"
                          class="btn btn-sm btn-success">
                          <i class="fa fa-eye"></i>
                        </a>

                        <a target="_blank"
                          href="{{ $license->status == 2 ? route('organizationA.trade-license.preview', $license->id) :'#' }}"
                          title="Print"
                          class="btn btn-sm btn-primary">
                          <i class="fa fa-print"></i>
                        </a>
                      @else
                        <a href="{{ route('organizationA.trade-license.create', ['org_id' => ($organization->approved_id ?? $organization->application_id ?? $organization->system_id)]) }}"
                          title="Generate Invoice"
                          class="btn btn-sm btn-warning">
                          <i class="fa fa-file-invoice"></i>
                        </a>
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
      ordering: true,
      searching: true

    });


    $('#statusFilter').on('change', function() {

      table.column(8).search(this.value).draw();

    });

  });
</script>

@endpush
