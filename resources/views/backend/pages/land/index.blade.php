@extends('backend.master', ['mainMenu' => 'Land', 'subMenu' =>'LandList'])
@push('style')
@endpush
@section('title', 'Land List')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Land List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('land.index')}}">Land List</a></li>
            <li class="breadcrumb-item active">View</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <h3 class="card-title">Land List</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{route('land.create')}}" class="btn btn-primary">Create</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>BRS Dag No. </th>
                                    <th>BRS Khotian No.</th>
                                    <th>Mouza & Thana</th>
                                    <th>District</th>
                                    <th>Owner ID & Name</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                                @foreach($lands as $key => $land)
                                    @php
                                        $records = $land->records_data ?? [];
                                        $brs = $records['brs'] ?? ($records['rs'] ?? ($records['sa'] ?? ($records['cs'] ?? [])));
                                        $districtName = $districts[$brs['district'] ?? ''] ?? 'N/A';
                                        $thanaName = $thanas[$brs['upazila'] ?? ''] ?? 'N/A';
                                        $ownerUser = $land->owner_user;
                                        $ownerName = $ownerUser->name ?? ($ownerUser->people->bn_name ?? ($brs['owner_name'] ?? 'N/A'));
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-center">{{ $brs['dag_no'] ?? 'N/A' }}</td>
                                        <td class="text-center">{{ $brs['khatian_no'] ?? 'N/A' }}</td>
                                        <td class="text-center">{{ $brs['mouza'] ?? 'N/A' }}, {{ $thanaName }}</td>
                                        <td class="text-center">{{ $districtName }}</td>
                                        <td class="text-center">{{ $land->owner_id }} - {{ $ownerName }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('land.show', $land->id) }}" class="btn btn-sm btn-info" title="View"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('land.edit', $land->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('land.destroy', $land->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
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
@endpush

