@extends('backend.master', ['mainMenu' => 'People', 'subMenu' =>'Create'])
@section('title', 'People Create')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>People Information</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('people.index')}}">People</a></li>
            <li class="breadcrumb-item active">Create</li>
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
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-bottom-0 pb-0">
                            <div class="d-block">
                                @include('backend.pages.people.tabs.tab_header', ['user' => $user, 'active_tab' => 'education'])
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="peopleEducationForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <div class="card-body p-0">
                                <div class="d-flex justify-content-between align-items-center p-3 bg-light mx-3 mt-3 rounded">
                                    <h5 class="mb-0 text-indigo font-weight-bold"><i class="fas fa-graduation-cap mr-2"></i>Educational Background</h5>
                                    <button type="button" id="addNewEducation" class="btn btn-primary btn-sm shadow-sm" style="background-color: #4f46e5; border-color: #4f46e5;">
                                        <i class="fas fa-plus-circle mr-1"></i> Add More Info
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover mb-0" id="education-table">
                                        <thead class="bg-light">
                                            <tr>
                                                <th style="min-width: 150px;">Degree <span class="text-danger">*</span></th>
                                                <th style="min-width: 150px;">Group</th>
                                                <th style="min-width: 120px;">Grade</th>
                                                <th style="min-width: 150px;">Board</th>
                                                <th style="min-width: 250px;">Educational Institute</th>
                                                <th style="width: 60px;" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="multiple-education">
                                            @if (count($user->educationInfos))
                                                @foreach ($user->educationInfos as $education)
                                                    <tr class="single-education-{{$education->id}}">
                                                        <td>
                                                            <select name="degree_idU[{{$education->id}}]" required class="form-control form-control-sm">
                                                                <option value="1" @if($education->degree_id == 1) selected @endif >HSC</option>
                                                                <option value="2" @if($education->degree_id == 2) selected @endif >SSC</option>
                                                                <option value="3" @if($education->degree_id == 3) selected @endif >JSC</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="group_idU[{{$education->id}}]" class="form-control form-control-sm">
                                                                <option value="1" @if($education->group_id == 1) selected @endif >Science</option>
                                                                <option value="2" @if($education->group_id == 2) selected @endif >Business</option>
                                                                <option value="3" @if($education->group_id == 3) selected @endif >Humanties</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="grade_idU[{{$education->id}}]" class="form-control form-control-sm">
                                                                <option value="1" @if($education->grade_id == 1) selected @endif >A+</option>
                                                                <option value="2" @if($education->grade_id == 2) selected @endif>A</option>
                                                                <option value="3" @if($education->grade_id == 3) selected @endif>A-</option>
                                                                <option value="4" @if($education->grade_id == 4) selected @endif>B+</option>
                                                                <option value="5" @if($education->grade_id == 5) selected @endif>B</option>
                                                                <option value="6" @if($education->grade_id == 6) selected @endif>B-</option>
                                                                <option value="7" @if($education->grade_id == 7) selected @endif>C+</option>
                                                                <option value="8" @if($education->grade_id == 8) selected @endif>C</option>
                                                                <option value="9" @if($education->grade_id == 9) selected @endif>D</option>
                                                                <option value="10" @if($education->grade_id == 10) selected @endif>F</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="board_idU[{{$education->id}}]" class="form-control form-control-sm">
                                                                <option value="1" @if($education->board_id == 1) selected @endif >Dhaka</option>
                                                                <option value="2" @if($education->board_id == 2) selected @endif>Rajshashi</option>
                                                                <option value="3" @if($education->board_id == 3) selected @endif>Rangpur</option>
                                                                <option value="4" @if($education->board_id == 4) selected @endif>Jessore</option>
                                                                <option value="5" @if($education->board_id == 5) selected @endif>Comilla</option>
                                                                <option value="6" @if($education->board_id == 6) selected @endif>Sylhet</option>
                                                                <option value="7" @if($education->board_id == 7) selected @endif>Chittagong</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="instituteU[{{$education->id}}]" value="{{$education->institute}}" placeholder="Educational Institute" class="form-control form-control-sm">
                                                        </td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteEducation({{$education->id}})" title="Delete">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr class="single-education">
                                                    <td>
                                                        <select name="degree_id[]" required class="form-control form-control-sm">
                                                            <option value="1">HSC</option>
                                                            <option value="2">SSC</option>
                                                            <option value="3">JSC</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="group_id[]" class="form-control form-control-sm">
                                                            <option value="1">Science</option>
                                                            <option value="2">Business</option>
                                                            <option value="3">Humanties</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="grade_id[]" class="form-control form-control-sm">
                                                            <option value="1">A+</option>
                                                            <option value="2">A</option>
                                                            <option value="3">A-</option>
                                                            <option value="4">B+</option>
                                                            <option value="5">B</option>
                                                            <option value="6">B-</option>
                                                            <option value="7">C+</option>
                                                            <option value="8">C</option>
                                                            <option value="9">D</option>
                                                            <option value="10">F</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="board_id[]" class="form-control form-control-sm">
                                                            <option value="1">Dhaka</option>
                                                            <option value="2">Rajshashi</option>
                                                            <option value="3">Rangpur</option>
                                                            <option value="4">Jessore</option>
                                                            <option value="5">Comilla</option>
                                                            <option value="6">Sylhet</option>
                                                            <option value="7">Chittagong</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="institute[]" placeholder="Educational Institute" class="form-control form-control-sm">
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-sm btn-danger remove-single-education">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer bg-white border-top-0 mt-4">
                                <div class="form-group row align-items-center mb-0">
                                    <div class="col-sm-4">
                                        <a href="{{route('people.address',$user->id)}}" class="btn btn-outline-secondary btn-block">
                                            <i class="fas fa-arrow-left mr-1"></i> Address
                                        </a>
                                    </div>
                                    <div class="col-sm-4 text-center">
                                        <button type="submit" class="btn btn-primary btn-block shadow-sm" style="background-color: #4f46e5; border-color: #4f46e5;">
                                            Save & Next <i class="fas fa-arrow-right ml-1"></i>
                                        </button>
                                    </div>
                                    <div class="col-sm-4 text-right">
                                        <a href="{{route('people.professional',$user->id)}}" class="btn btn-outline-primary btn-block">
                                            Profession <i class="fas fa-arrow-right ml-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-footer -->
                        </form>
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
         $(document).ready(function() {
            $("#peopleEducationForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('people.educationStore') }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType:false,
                    cache:false,
                    processData:false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled",true);
                    },
                    success: function (response) {
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.href = response.redirect_url;
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "-error").text(val[0]);
                        });
                    }
                });
            })

            $("#addNewEducation").on('click', function () {
                var row = '<tr class="single-education">';
                row += '<td><select name="degree_id[]" required class="form-control form-control-sm">';
                row += '<option value="1">HSC</option><option value="2">SSC</option><option value="3">JSC</option>';
                row += '</select></td>';
                row += '<td><select name="group_id[]" class="form-control form-control-sm">';
                row += '<option value="1">Science</option><option value="2">Business</option><option value="3">Humanties</option>';
                row += '</select></td>';
                row += '<td><select name="grade_id[]" class="form-control form-control-sm">';
                row += '<option value="1">A+</option><option value="2">A</option><option value="3">A-</option>';
                row += '<option value="4">B+</option><option value="5">B</option><option value="6">B-</option>';
                row += '<option value="7">C+</option><option value="8">C</option><option value="9">D</option><option value="10">F</option>';
                row += '</select></td>';
                row += '<td><select name="board_id[]" class="form-control form-control-sm">';
                row += '<option value="1">Dhaka</option><option value="2">Rajshashi</option><option value="3">Rangpur</option>';
                row += '<option value="4">Jessore</option><option value="5">Comilla</option><option value="6">Sylhet</option><option value="7">Chittagong</option>';
                row += '</select></td>';
                row += '<td><input type="text" name="institute[]" placeholder="Educational Institute" class="form-control form-control-sm"></td>';
                row += '<td class="text-center"><button type="button" class="btn btn-sm btn-danger remove-single-education"><i class="fas fa-times"></i></button></td>';
                row += '</tr>';

                $("#multiple-education").append(row);
            })
        })

        $(document).on('click', '.remove-single-education', function(){
            $(this).closest('tr').remove();
        })

        function deleteEducation(id)
        {
           if (id) {
            if (confirm("Are you sure?")) {
                $.ajax({
                    type: "GET",
                    url: "{{url('/admin/people/education-delete')}}/"+id,
                    success: function (response) {
                        toastr.success(response.message);
                        $(".single-education-"+id).remove();
                    },
                    error: function(xhr, status, error) {
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });
            }
           }
        }
    </script>
@endpush
