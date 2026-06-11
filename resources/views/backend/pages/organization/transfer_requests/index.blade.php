@extends('backend.master', ['mainMenu' => 'Organization', 'subMenu' => 'OrganizationTransferRequest'])

@section('title', 'Transfer Requests')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Transfer Requests</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('organization.index') }}">Organization</a></li>
                    <li class="breadcrumb-item active">Transfer Requests</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Request Organization Transfer</h3>
                    </div>
                    <form id="transferRequestForm" class="form-horizontal">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="organization_id">Organization</label>
                                <select name="organization_id" id="organization_id" class="form-control select2">
                                    <option value="">Select Organization</option>
                                    @foreach($organizations as $organization)
                                        <option value="{{ $organization->id }}">
                                            {{ $organization->approved_id ?? $organization->application_id ?? $organization->system_id }} - {{ $organization->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-danger error organization_id_error"></small>
                            </div>

                            <div class="form-group">
                                <label for="division_id">Division</label>
                                <select name="division_id" id="division_id" class="form-control select2">
                                    <option value="">Select Division</option>
                                    @foreach($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger error division_id_error"></small>
                            </div>

                            <div class="form-group">
                                <label for="district_id">District</label>
                                <select name="district_id" id="district_id" class="form-control select2">
                                    <option value="">Select District</option>
                                </select>
                                <small class="text-danger error district_id_error"></small>
                            </div>

                            <div class="form-group">
                                <label for="thana_id">Upazilla / Thana</label>
                                <select name="thana_id" id="thana_id" class="form-control select2">
                                    <option value="">Select Upazilla / Thana</option>
                                </select>
                                <small class="text-danger error thana_id_error"></small>
                            </div>

                            <div class="form-group">
                                <label>Target Authority Type</label>
                                <select name="target_type" id="target_type" class="form-control select2">
                                    <option value="">Select Authority Type</option>
                                    <option value="union">Union</option>
                                    <option value="pourashava">Pourashava</option>
                                    <option value="city_corporation">City Corporation</option>
                                </select>
                                <small class="text-danger error target_type_error"></small>
                            </div>

                            <div class="form-group" id="target_authority_group" style="display:none;">
                                <label id="targetAuthorityLabel" for="target_id">Target Authority</label>
                                <select name="target_id" id="target_id" class="form-control select2">
                                    <option value="">Select target authority</option>
                                </select>
                                <small class="text-danger error target_id_error"></small>
                            </div>

                            <div class="form-group">
                                <label for="remarks">Remarks</label>
                                <textarea name="remarks" id="remarks" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit Request</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Outgoing Transfer Requests</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Organization</th>
                                        <th>Target Authority</th>
                                        <th>Status</th>
                                        <th>Requested At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transferRequests as $transfer)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $transfer->organization->name ?? 'N/A' }}</td>
                                            <td>
                                                {{ $transfer->toInstitute->union->name ?? $transfer->toInstitute->pourashava->name ?? $transfer->toInstitute->cityCorporation->name ?? 'N/A' }}
                                                <br>
                                                <small>{{ ucfirst(str_replace('_', ' ', $transfer->status)) }}</small>
                                            </td>
                                            <td>
                                                @if($transfer->status === 'pending')
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif($transfer->status === 'approved')
                                                    <span class="badge badge-success">Approved</span>
                                                @else
                                                    <span class="badge badge-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td>{{ $transfer->requested_at ? $transfer->requested_at->format('d-m-Y H:i') : '--' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No transfer requests found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
    $(document).ready(function () {
        $('.select2').select2({ width: '100%' });

        $('#division_id').change(function () {
            let divisionId = $(this).val();
            $('#district_id').html('<option value="">Select District</option>');
            $('#thana_id').html('<option value="">Select Upazilla / Thana</option>');
            $('#target_id').html('<option value="">Select target authority</option>');
            $('#target_authority_group').hide();
            $('#target_type').val('').trigger('change');

            if (!divisionId) {
                return;
            }

            $.get('/get-districts-by-division/' + divisionId, function (districts) {
                if (typeof districts === 'string') {
                    $('#district_id').html(districts);
                } else {
                    $.each(districts, function (index, district) {
                        $('#district_id').append($('<option>', {
                            value: district.id,
                            text: district.name,
                        }));
                    });
                }
            });
        });

        $('#district_id').change(function () {
            let districtId = $(this).val();
            $('#thana_id').html('<option value="">Select Upazilla / Thana</option>');
            $('#target_id').html('<option value="">Select target authority</option>');
            $('#target_authority_group').hide();

            if (!districtId) {
                return;
            }

            $.get('/get-thanas-by-district/' + districtId, function (thanas) {
                if (typeof thanas === 'string') {
                    $('#thana_id').html(thanas);
                } else {
                    $.each(thanas, function (index, thana) {
                        $('#thana_id').append($('<option>', {
                            value: thana.id,
                            text: thana.name,
                        }));
                    });
                }
            });
        });

        $('#target_type').change(function () {
            let type = $(this).val();
            let districtId = $('#district_id').val();
            let thanaId = $('#thana_id').val();

            $('#target_id').html('<option value="">Select target authority</option>');
            if (!type || !districtId) {
                $('#target_authority_group').hide();
                return;
            }

            $('#target_authority_group').show();
            let label = 'Target Authority';
            let endpoint = '';

            if (type === 'union') {
                label = 'Union';
                if (!thanaId) {
                    $('#target_id').html('<option value="">Select Upazilla first</option>');
                    return;
                }
                endpoint = '/get-unions-by-upazilla/' + thanaId;
            }
            if (type === 'pourashava') {
                label = 'Pourashava';
                endpoint = '/get-pourashavas-by-district/' + districtId;
            }
            if (type === 'city_corporation') {
                label = 'City Corporation';
                endpoint = '/get-citi-corporation-by-district/' + districtId;
            }

            $('#targetAuthorityLabel').text(label);

            if (!endpoint) {
                return;
            }

            $.get(endpoint, function (items) {
                if (typeof items === 'string') {
                    $('#target_id').html(items);
                } else {
                    $.each(items, function (index, item) {
                        let text = item.name || item.bn_name || item.en_name || item.id;
                        $('#target_id').append($('<option>', {
                            value: item.id,
                            text: text,
                        }));
                    });
                }
            });
        });

        $('#transferRequestForm').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            $.ajax({
                url: '{{ route('organization.transfer.store') }}',
                type: 'POST',
                data: form.serialize(),
                success: function (response) {
                    toastr.success(response.message);
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                },
                error: function (xhr) {
                    let response = xhr.responseJSON || {};
                    toastr.error(response.message || 'Failed to submit transfer request.');
                    if (response.errors) {
                        Object.keys(response.errors).forEach(function (key) {
                            $('.' + key + '_error').text(response.errors[key][0]);
                        });
                    }
                }
            });
        });
    });
</script>
@endpush
