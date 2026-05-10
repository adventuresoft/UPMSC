@extends('backend.master', ['mainMenu' => 'Organization', 'subMenu' =>'GetTradeLicense'])

@push('style')

<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

@endpush

@section('title', 'Organization Trade License')

@section('content')
<!--
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
-->

<section class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">

        <div class="card card-info">

          <div class="card-header">

            <div class="row">

              <div class="col-md-6 text-left">
                <h3 class="card-title">Organization Trade License List</h3>
              </div>

              <div class="col-md-6 text-right">
                <!--<a href="{{route('organizationA.trade-license.create')}}" class="btn btn-primary">Create</a>-->
              </div>

            </div>

          </div>


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

              <!-- Tax Year Filter -->
              <div class="col-md-1">
                <input type="text" id="search_tax_year" class="form-control form-control-sm"
                  placeholder="Tax Year">
              </div>

              <!-- Organization Name Filter -->
              <div class="col-md-2">
                <input type="text" id="search_org_name" class="form-control form-control-sm"
                  placeholder="Organization Name">
              </div>

              <!-- Type Filter -->
              <div class="col-md-1">
                <input type="text" id="search_type" class="form-control form-control-sm"
                  placeholder="Type">
              </div>

              <!-- Category Filter -->
              <div class="col-md-1">
                <input type="text" id="search_category" class="form-control form-control-sm"
                  placeholder="Category">
              </div>

              <!-- Status Filter -->
              <div class="col-md-1">
                <select id="search_status" class="form-control form-control-sm">
                  <option value="">All Status</option>
                  <option value="Pending">Pending</option>
                  <option value="Approved">Approved</option>
                </select>
              </div>

              <!-- GLOBAL SEARCH -->
              <div class="col-md-1">
                <input type="text" id="search_global" class="form-control form-control-sm"
                  placeholder="Search">
              </div>

            </div>


            <table id="example1" class="table table-bordered table-striped">

              <thead>

                <tr>
                  <th>Sl.</th>
                  <th>Tax Year</th>
                  <th>Organization Name</th>
                  <th>Type</th>
                  <th>Category</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>

              </thead>

              <tbody>

                @if (count($trade_licenses))

                @foreach ($trade_licenses as $key=>$license)

                <tr>

                  <td>{{++$key}}</td>

                  <td>{{$license->taxYear->name ?? '-'}}</td>

                  <td>{{$license->organization->name ?? '-'}}</td>

                  <td>{{$license->organization?->type?->en_name ?? $license->organization?->type?->bn_name ?? $license->organization?->category?->en_name ?? '-'}}</td>

                  <td>{{$license->organization?->subcategory?->en_name ?? $license->organization?->category?->en_name ?? '-'}}</td>

                  <td>{{date('d-m-Y', strtotime($license->updated_at))}}</td>

                  <td>



                    <label class="badge badge-success">{{ucfirst($license->payment_status)}}</label>



                  </td>

                  <td>

                    <div class="table-action">

                      <!--<a href="{{route('organizationA.trade-license.confirmed', $license->id )}}"-->
                      <!--  title="Confirmed"-->
                      <!--  class="btn btn-sm btn-info">-->
                      <!--  <i class="fa fa-hand-holding-usd"></i>-->
                      <!--</a>-->


                      <!-- <a href="{{route('organizationA.trade-license.show', $license->id )}}"-->
                      <!--  title="Show"-->
                      <!--  class="btn btn-sm btn-success">-->
                      <!--  <i class="fa fa-eye"></i>-->
                      <!--</a>-->


                      <a target="_blank"
                        href="{{ $license->status == 2 ? route('organizationA.trade-license.preview', $license->id) :'#' }}"
                        title="Print"
                        class="btn btn-sm btn-primary">

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

      dom: 'rtip',
      responsive: true,
      autoWidth: false,
      pageLength: 10,
      lengthChange: false,
      order: [[0, 'asc']],
      columnDefs: [
        { targets: 7, orderable: false }
      ],
      language: {
        emptyTable: '<div class="empty-state"><i class="fas fa-folder-open"></i><h5>No data available</h5></div>',
        zeroRecords: '<div class="empty-state"><i class="fas fa-folder-open"></i><h5>No matching records found</h5></div>'
      }

    });

    $('#search_tax_year').keyup(function() {
      table.column(1).search(this.value).draw();
    });

    $('#search_org_name').keyup(function() {
      table.column(2).search(this.value).draw();
    });

    $('#search_type').keyup(function() {
      table.column(3).search(this.value).draw();
    });

    $('#search_category').keyup(function() {
      table.column(4).search(this.value).draw();
    });

    $('#search_status').on('change', function() {
      table.column(6).search(this.value).draw();
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
