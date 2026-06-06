@extends('backend.master', ['mainMenu' => 'Tax', 'subMenu' =>'TaxList'])
@push('style')
<style>
  .toggle {
      --width: 80px;
      --height: calc(var(--width) / 3);

      position: relative;
      display: inline-block;
      width: var(--width);
      height: var(--height);
      box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
      cursor: pointer;
  }

  .toggle input {
      display: none;
  }

  .toggle .labels {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      font-size: 12px;
      font-family: sans-serif;
      transition: all 0.4s ease-in-out;
      overflow: hidden;
  }

  .toggle .labels::after {
      content: attr(data-off);
      position: absolute;
      display: flex;
      justify-content: center;
      align-items: center;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      color: #ffffff;
      background-color: #dc3545;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);
      transition: all 0.4s ease-in-out;
  }

  .toggle .labels::before {
      content: attr(data-on);
      position: absolute;
      display: flex;
      justify-content: center;
      align-items: center;
      top: 0;
      left: calc(var(--width) * -1);
      height: 100%;
      width: 100%;
      color: #ffffff;
      background-color: #28a745;
      text-align: center;
      text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.4);
      transition: all 0.4s ease-in-out;
  }

  .toggle input:checked~.labels::after {
      transform: translateX(var(--width));
  }

  .toggle input:checked~.labels::before {
      transform: translateX(var(--width));
  }

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
@section('title', 'Tax List')
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
                                    <h3 class="card-title" style="font-size:24px; font-weight: semi-bold;">Tax Information</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    @if(create_permission('taxes'))
                                    <a href="{{route('tax.create')}}" class="btn btn-primary">Generate</a>
                                    <a href="{{route('tax.index')}}" class="btn btn-primary">List</a>
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
                                    <input type="text" id="search_financial_year" class="form-control form-control-sm" placeholder="Financial Year">
                                </div>

                                <div class="col-md-2">
                                    <input type="text" id="search_name" class="form-control form-control-sm" placeholder="Name & ID">
                                </div>

                                <div class="col-md-2">
                                    <input type="text" id="search_house_no" class="form-control form-control-sm" placeholder="House No">
                                </div>
                                
                                <div class="col-md-2">
                                    <input type="text" id="search_area" class="form-control form-control-sm" placeholder="Area & Ward No">
                                </div>

                                <div class="col-md-3">
                                    <input type="text" id="search_global" class="form-control form-control-sm" placeholder="Search">
                                </div>
                            </div>

                            <table id="tax-table" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Financial Year</th>
                                    <th>Name & ID</th>
                                    <th>House No</th>
                                    <th>Area & Ward No.</th>
                                    <th>Village</th>
                                    <th>Status</th>
                                    <th data-orderable="false">Action</th>
                                </tr>
                              </thead>
                              <tbody>

                                @if (count($taxes))
                                  @foreach ($taxes as $key=>$tax)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$tax->taxYear->name ?? ''}}</td>
                                        <td>{{$tax->user->people->bn_name ?? ''}} -- {{$tax->user_system_id}}</td>
                                        <td>{{$tax->house->house_bn ?? ''}}</td>
                                        <td>{{$tax->house->block_section ?? ''}} -- {{$tax->unionWard->bn_ward_no}} </td>
                                        <td>{{$tax->village->bn_name ?? ''}}</td>
                                        <td>
                                          <label class="toggle">
                                            <input type="checkbox" class="changeTaxStatus"
                                                data-id="{{ $tax->id }}" {{$tax->status ? 'checked' : ''}} name="status" value="1">
                                            <span class="labels" data-on="Received" data-off="Generated"></span>
                                          </label>
                                        </td>
                                        <td>
                                          <div class="table-action justify-content-center">
                                            @if(view_permission('taxes'))
                                            <a href="{{route('tax.show', $tax->id)}}" title="Show" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                            @endif
                                            @if(view_permission('taxes'))
                                            <button type="button" data-url="{{route('taxes.receipt', $tax->id)}}" title="Print" class="btn btn-sm btn-primary print-tax-btn"><i class="fa fa-print"></i></button>
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
 $(document).ready( function () {
    let table = $('#tax-table').DataTable({
        responsive: true,
        autoWidth: false,
        pageLength: 10,
        lengthChange: false,
        order: [[0, 'asc']],
        columnDefs: [
            { targets: 7, orderable: false }
        ]
    });

    $('#search_financial_year').keyup(function() {
        table.column(1).search(this.value).draw();
    });

    $('#search_name').keyup(function() {
        table.column(2).search(this.value).draw();
    });
    
    $('#search_house_no').keyup(function() {
        table.column(3).search(this.value).draw();
    });

    $('#search_area').keyup(function() {
        table.column(4).search(this.value).draw();
    });

    $('#search_global').keyup(function() {
        table.search(this.value).draw();
    });

    $('#tableLength').change(function() {
        table.page.len($(this).val()).draw();
    });
});

$(document).on('click', '.print-tax-btn', function(e) {
    e.preventDefault();
    var url = $(this).data('url');
    var iframe = document.createElement('iframe');
    iframe.style.position = 'fixed';
    iframe.style.right = '0';
    iframe.style.bottom = '0';
    iframe.style.width = '0';
    iframe.style.height = '0';
    iframe.style.border = '0';
    iframe.src = url;
    document.body.appendChild(iframe);
    
    iframe.onload = function() {
        iframe.contentWindow.focus();
        iframe.contentWindow.print();
        setTimeout(function() {
            document.body.removeChild(iframe);
        }, 3000);
    };
});

$(document).on('change', '.changeTaxStatus', function(e) {
    e.preventDefault();
    let _this = $(this);
    let _id = _this.attr('data-id');
    if (this.checked) {
        $.ajax({
            type: "POST",
            url: "{{ route('tax.status') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "status": 1,
                "id": _id
            },
            beforeSend: function() {
                _this.prop("disabled", true);
            },
            success: function(response) {
                _this.prop("disabled", false);
                toastr.success(response.message);
            },
            error: function(xhr, status, error) {
                _this.prop("disabled", false);
                var responseText = jQuery.parseJSON(xhr.responseText);
                toastr.error(responseText.message);
            }
        });
    } else {
        $.ajax({
            type: "POST",
            url: "{{ route('tax.status') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "status": 0,
                "id": _id
            },
            beforeSend: function() {
                _this.prop("disabled", true);
            },
            success: function(response) {
                _this.prop("disabled", false);
                toastr.success(response.message);
            },
            error: function(xhr, status, error) {
                _this.prop("disabled", false);
                var responseText = jQuery.parseJSON(xhr.responseText);
                toastr.error(responseText.message);
            }
        });
    }
})
</script>
@endpush

