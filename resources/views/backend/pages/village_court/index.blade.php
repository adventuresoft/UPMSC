@extends('backend.master', ['mainMenu' => 'LocalGovtJudiciary', 'subMenu' => 'VillageCourtList'])
@push('style')
@endpush
@section('title', 'Case List (মামলার তালিকা)')
@section('content')
   <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Case List (মামলার তালিকা)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('village-court.index') }}">Case</a></li>
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
                            <h3 class="card-title">Case List (মামলার তালিকা)</h3>
                            @if(create_permission('village_court'))
                            <a href="{{ route('village-court.create') }}" class="btn btn-default btn-sm float-right"><i class="fas fa-plus"></i> Create Case / মামলা রুজু</a>
                            @endif
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
                                            <td>
                                                @if($case->status == 'pending')
                                                    <span class="badge badge-warning">মামলা রুজু</span>
                                                @elseif($case->status == 'court_formed')
                                                    <span class="badge badge-primary">আদালত গঠিত</span>
                                                @elseif($case->status == 'decided')
                                                    <span class="badge badge-success">রায় ঘোষিত</span>
                                                @else
                                                    <span class="badge badge-secondary">{{ ucfirst($case->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('village-court.show', $case->id) }}" class="btn btn-info btn-sm" title="View/Print"><i class="fas fa-eye"></i> Dashboard</a>
                                                    @if(edit_permission('village_court') && $case->status == 'pending')
                                                    <a href="{{ route('village-court.edit', $case->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                                    @endif
                                                    @if(delete_permission('village_court'))
                                                    <form action="{{ route('village-court.destroy', $case->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this case?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                    @endif
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
