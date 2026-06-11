@extends('backend.master', ['mainMenu' => 'Organization', 'subMenu' => 'IncomingTransferRequest'])

@section('title', 'Incoming Transfer Requests')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Incoming Transfer Requests</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('organization.index') }}">Organization</a></li>
                    <li class="breadcrumb-item active">Incoming Requests</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Pending Incoming Transfer Requests</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Organization</th>
                                <th>From</th>
                                <th>Target Authority</th>
                                <th>Requested At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transferRequests as $transfer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transfer->organization->name ?? 'N/A' }}</td>
                                    <td>{{ $transfer->sourceInstitute->union->name ?? $transfer->sourceInstitute->pourashava->name ?? $transfer->sourceInstitute->cityCorporation->name ?? 'N/A' }}</td>
                                    <td>{{ $transfer->toInstitute->union->name ?? $transfer->toInstitute->pourashava->name ?? $transfer->toInstitute->cityCorporation->name ?? 'N/A' }}</td>
                                    <td>{{ $transfer->requested_at ? $transfer->requested_at->format('d-m-Y H:i') : '--' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-success approve-transfer" data-id="{{ $transfer->id }}">Approve</button>
                                        <button class="btn btn-sm btn-danger reject-transfer" data-id="{{ $transfer->id }}">Reject</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No incoming transfer requests found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
    $(document).ready(function () {
        $('.approve-transfer').click(function () {
            if (!confirm('Approve this transfer request?')) {
                return;
            }
            let transferId = $(this).data('id');
            $.ajax({
                url: '{{ url("/dashboard/organization-transfer") }}/' + transferId + '/approve',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    toastr.success(response.message);
                    setTimeout(function () { location.reload(); }, 800);
                },
                error: function (xhr) {
                    let response = xhr.responseJSON || {};
                    toastr.error(response.message || 'Failed to approve request.');
                }
            });
        });

        $('.reject-transfer').click(function () {
            let transferId = $(this).data('id');
            let reason = prompt('Enter rejection comment (optional):');
            if (reason === null) {
                return;
            }

            $.ajax({
                url: '{{ url("/dashboard/organization-transfer") }}/' + transferId + '/reject',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    response_comment: reason,
                },
                success: function (response) {
                    toastr.success(response.message);
                    setTimeout(function () { location.reload(); }, 800);
                },
                error: function (xhr) {
                    let response = xhr.responseJSON || {};
                    toastr.error(response.message || 'Failed to reject request.');
                }
            });
        });
    });
</script>
@endpush
