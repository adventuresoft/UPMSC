@extends('backend.master', ['mainMenu' => 'LocalGovtJudiciary', 'subMenu' => 'VillageCourtList'])
@push('style')
@endpush
@section('title', 'Notice List')
@section('content')
   <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Notice List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('village-court.index') }}">Notice</a></li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Notice List</h3>
                            <a href="{{ route('village-court.create') }}" class="btn btn-default btn-sm float-right"><i class="fas fa-plus"></i> Create Notice</a>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl.</th>
                                        <th>Case No</th>
                                        <th>Applicant (Badi)</th>
                                        <th>Defendant (Bibadi)</th>
                                        <th>Case Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cases as $key => $case)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $case->case_no }}</td>
                                            <td>{{ $case->badi->name ?? 'N/A' }}</td>
                                            <td>
                                                @php $bibadis = $case->bibadis(); @endphp
                                                @if($bibadis->count() > 0)
                                                    {{ $bibadis->first()->bn_name ?? $bibadis->first()->name ?? 'Unknown' }}
                                                    @if($bibadis->count() > 1)
                                                        <span class="badge badge-info">+{{ $bibadis->count() - 1 }}</span>
                                                    @endif
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ $case->case_date ? $case->case_date->format('d-m-Y') : '' }}</td>
                                            <td><span class="badge badge-success">{{ ucfirst($case->status) }}</span></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('village-court.show', $case->id) }}" class="btn btn-info btn-sm" title="View/Print"><i class="fas fa-eye"></i></a>
                                                    <a href="{{ route('village-court.edit', $case->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                                    <form action="{{ route('village-court.destroy', $case->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this notice?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
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
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false
            });
        });
    </script>
@endpush
