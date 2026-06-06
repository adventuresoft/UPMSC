@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' => 'Birth'])

@push('style')
<style>
    .citizen-id {
        font-weight: bold;
        color: black;
        font-size: 15px;
    }
    .table td { vertical-align: middle !important; }
    .row.mb-3 input { height: 32px; font-size: 13px; }
    .dataTables_filter { display: none; }
    .empty-state { text-align: center; padding: 40px 20px; color: #6c757d; }
</style>
@endpush

@section('title', 'Birth Certificate')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">

                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="card-title" style="font-size:24px;">Birth Certificate</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                @if (create_permission())
                                    <a href="{{ route('certificate/birth.create') }}" class="btn btn-primary">Create</a>
                                    <a href="{{ route('certificate/birth.index') }}" class="btn btn-primary">List</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        {{-- FILTER BAR --}}
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
                                <input type="text" id="search_cert" class="form-control form-control-sm" placeholder="Certificate No">
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="search_name" class="form-control form-control-sm" placeholder="ID or Name">
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="search_address" class="form-control form-control-sm" placeholder="Address or Mobile">
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="search_global" class="form-control form-control-sm" placeholder="Global Search">
                            </div>
                        </div>

                        {{-- TABLE --}}
                        <table id="example1" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Photo</th>
                                    <th>Certificate No</th>
                                    <th>ID &amp; Name</th>
                                    <th>Address &amp; Mobile</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($certificates as $key => $certificate)
                                <tr>
                                    <td>{{ ++$key }}</td>

                                    <td>
                                        <img src="{{ imageUrl($certificate->user?->image ?? 'default.png') }}"
                                             width="55" height="65" class="img"
                                             onerror="this.src='{{ asset('default.png') }}'">
                                    </td>

                                    <td>{{($certificate->system_id) }}</td>

                                    <td>
                                        <span class="citizen-id">
                                            {{ $certificate->user?->people?->approved_id ?? 'No ID' }}
                                        </span><br>
                                        {{ $certificate->user?->name ?? 'N/A' }}
                                    </td>

                                    <td>
                                        <strong>{{ $certificate->user?->mobile ?? 'N/A' }}</strong><br>
                                        {{ $certificate->user?->addressInfo?->permanentVillage?->bn_name ?? '' }},
                                        ওয়ার্ড নং-{{ $certificate->user?->addressInfo?->permanentWard?->bn_ward_no ?? '' }},
                                        {{ optional($certificate->user?->addressInfo?->permanentPostOffice)->bn_name ?? '' }}
                                        @if(optional($certificate->user?->addressInfo?->permanentPostOffice)->postal_code)
                                            - {{ bnValue($certificate->user?->addressInfo?->permanentPostOffice?->postal_code) }},
                                        @endif
                                        <br>
                                        {{ $certificate->user?->institute?->union?->thana?->bn_name ?? '' }},
                                        {{ $certificate->user?->institute?->union?->thana?->district?->bn_name ?? '' }}
                                    </td>

                                    <td>{{ $certificate->created_at->format('d-m-Y') }}</td>

                                    <td>
                                        <a target="_blank"
                                           href="{{ route('certificate/birth.show', $certificate->id) }}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-file-pdf"></i> EN
                                        </a>
                                        <a target="_blank"
                                           href="{{ route('birth.bn_certificate', $certificate->id) }}"
                                           class="btn btn-info btn-sm">
                                            <i class="fa fa-file-pdf"></i> BN
                                        </a>
                                        @if(delete_permission())
                                        <button class="btn btn-danger btn-sm btn-delete-cert"
                                                data-id="{{ $certificate->id }}"
                                                title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="empty-state">
                                        <i class="fas fa-folder-open fa-2x mb-2"></i>
                                        <h5>No birth certificates found.</h5>
                                    </td>
                                </tr>
                                @endforelse
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
        order: [[0, 'asc']],
        columnDefs: [
            { targets: 1, orderable: false },
            { targets: 6, orderable: false }
        ],
        language: {
            emptyTable:  '<div class="empty-state"><i class="fas fa-folder-open"></i><h5>No data available</h5></div>',
            zeroRecords: '<div class="empty-state"><i class="fas fa-folder-open"></i><h5>No matching records found</h5></div>'
        }
    });

    $('#search_cert').keyup(function()    { table.column(2).search(this.value).draw(); });
    $('#search_name').keyup(function()    { table.column(3).search(this.value).draw(); });
    $('#search_address').keyup(function() { table.column(4).search(this.value).draw(); });
    $('#search_global').keyup(function()  { table.search(this.value).draw(); });
    $('#tableLength').change(function()   { table.page.len($(this).val()).draw(); });

    // Delete certificate
    $(document).on('click', '.btn-delete-cert', function() {
        const id = $(this).data('id');
        if (!confirm('Are you sure you want to delete this certificate?')) return;

        $.ajax({
            type: 'DELETE',
            url: '/certificate/birth/' + id,
            data: { _token: '{{ csrf_token() }}' },
            success: function(res) {
                toastr.success(res.message ?? 'Deleted successfully.');
                setTimeout(() => location.reload(), 1200);
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON?.message ?? 'Delete failed.');
            }
        });
    });
});
</script>
@endpush
