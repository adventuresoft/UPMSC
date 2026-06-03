@extends('backend.master', ['mainMenu' => 'Relief Card', 'subMenu' => 'ReliefCardList'])

@push('style')
<style>
    .citizen-id {
        font-weight: bold;
        color: black;
        font-size: 15px;
    }

    .table td {
        vertical-align: middle !important;
    }

    .row.mb-3 input {
        height: 32px;
        font-size: 13px;
    }

    .dataTables_filter {
        display: none;
    }
</style>
@endpush

@section('title', 'Relief Card Applications')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header bg-gradient-to-r from-pink-600 to-pink-700 text-white">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="card-title font-bold text-lg"><i class="fas fa-hand-holding-heart mr-2"></i>Relief Card Applications</h3>
                            </div>
                        </div>
                    </div>

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
                                <input type="text" id="search_card" class="form-control form-control-sm" placeholder="Application/Card No">
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="search_name" class="form-control form-control-sm" placeholder="ID or Name">
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="search_type" class="form-control form-control-sm" placeholder="Relief Type (e.g. VGD)">
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="search_global" class="form-control form-control-sm" placeholder="Search All">
                            </div>
                        </div>

                        <!-- TABLE -->
                        <table id="example1" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Photo</th>
                                    <th>Card / App No</th>
                                    <th>ID & Name</th>
                                    <th>Address & Mobile</th>
                                    <th>Relief Type</th>
                                    <th>Monthly Income & Family</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reliefCards as $key => $card)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>
                                        <img src="{{ imageUrl($card->user->image ?? 'default.png') }}"
                                             width="55"
                                             height="65"
                                             class="img rounded border"
                                             onerror="this.src='{{ asset('default.png') }}'">
                                    </td>
                                    <td>{{ $card->system_id }}</td>
                                    <td>
                                        <span class="citizen-id">
                                            {{ $card->user?->people?->approved_id ?? 'No ID' }}
                                        </span><br>
                                        {{ $card->user?->name ?? 'N/A' }}
                                    </td>
                                    <td>
                                        <strong>{{ $card->user?->mobile }}</strong> <br>
                                        {{ $card->user?->addressInfo?->permanentVillage?->bn_name ?? '' }},
                                        ওয়ার্ড নং-{{ $card->user?->addressInfo?->permanentWard?->bn_ward_no ?? '' }},
                                        {{ $card->user?->addressInfo?->permanentPostOffice?->bn_name ?? '' }}
                                        @if($card->user?->addressInfo?->permanentPostOffice?->postal_code)
                                            - {{ $card->user?->addressInfo?->permanentPostOffice?->postal_code }}
                                        @endif <br>
                                        {{ $card->user?->institute?->union?->thana?->bn_name ?? '' }},
                                        {{ $card->user?->institute?->union?->thana?->district?->bn_name ?? '' }}।
                                    </td>
                                    <td><span class="badge badge-info p-2">{{ $card->relief_type }}</span></td>
                                    <td>
                                        <strong>আয়:</strong> ৳{{ number_format($card->monthly_income, 2) }}<br>
                                        <strong>সদস্য:</strong> {{ $card->family_members }} জন
                                    </td>
                                    <td>
                                        @if($card->status == 0)
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($card->status == 1)
                                            <span class="badge badge-success">Approved</span>
                                        @else
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($card->status == 0)
                                            <button onclick="approveCard({{ $card->id }})" class="btn btn-success btn-sm mb-1 mr-1">
                                                <i class="fa fa-check mr-1"></i> Approve
                                            </button>
                                            <button onclick="rejectCard({{ $card->id }})" class="btn btn-danger btn-sm mb-1">
                                                <i class="fa fa-times mr-1"></i> Reject
                                            </button>
                                        @else
                                            <span class="text-xs text-gray-500 font-semibold">
                                                {{ $card->status == 1 ? 'Approved' : ($card->status == 2 ? 'Rejected' : '') }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
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
<script>
    $(function() {
        let table = $('#example1').DataTable({
            responsive: true,
            autoWidth: false,
            scrollX: false,
            pageLength: 10,
            lengthChange: false,
            order: [[0, 'asc']]
        });

        $('#search_card').keyup(function() {
            table.column(2).search(this.value).draw();
        });

        $('#search_name').keyup(function() {
            table.column(3).search(this.value).draw();
        });

        $('#search_type').keyup(function() {
            table.column(5).search(this.value).draw();
        });

        $('#tableLength').change(function() {
            table.page.len($(this).val()).draw();
        });

        $('#search_global').keyup(function() { 
            table.search(this.value).draw(); 
        });
    });

    function approveCard(id) {
        if (confirm('Are you sure you want to approve this relief card application?')) {
            $.ajax({
                type: "POST",
                url: "{{ route('relief-card.approve') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function(response) {
                    if (response.status) {
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error("Something went wrong!");
                }
            });
        }
    }

    function rejectCard(id) {
        if (confirm('Are you sure you want to reject this relief card application?')) {
            $.ajax({
                type: "POST",
                url: "{{ route('relief-card.reject') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function(response) {
                    if (response.status) {
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error("Something went wrong!");
                }
            });
        }
    }
</script>
@endpush
