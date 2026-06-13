@extends('backend.master', ['mainMenu' => 'chairman', 'subMenu' =>'chairmanList'])
@push('style')
@endpush
@section('title', 'Chairman & Mayor List')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Chairman List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('chairman.chairmanList')}}">Chairman List</a></li>
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
                                    <h3 class="card-title">Chairman List</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    @if(create_permission('chairman'))
                                    <a href="{{route('chairman.create')}}" class="btn btn-primary">Create</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Member Name</th>
                                    <th>System ID</th>
                                    <th>Division</th>
                                    <th>District</th>
                                    <th>Thana</th>
                                    <th>Union</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($members as $member)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$member->user->name??''}}</td>
                                    <td>{{$member->user->system_id??''}}</td>
                                    <td>{{$member->council->union->Thana->District->Division->name??''}}</td>
                                    <td>{{$member->council->union->Thana->District->name??''}}</td>
                                    <td>{{$member->council->union->Thana->name??''}}</td>
                                    <td>{{$member->council->union->name??''}}</td>
                                    <td>{{date('d-m-Y',strtotime($member->start_date))}}</td>
                                    <td>{{date('d-m-Y',strtotime($member->end_date))}}</td>
                                    <td>{{$member->status==1?'Active':'Inactive'}}</td>
                                    <td>
                                        @if(edit_permission('chairman'))
                                        <a href="{{ route('chairman.changeMember', $member->id) }}" class="btn btn-sm btn-info" title="Edit"> <i class="fas fa-pencil-alt"></i> Edit </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                              </tbody>

                            </table>
                            <div class="d-flex justify-content-end">
                                {{ $members->links() }}
                            </div>
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
