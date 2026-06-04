@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'GuardianAcceptance'])
@push('style')
<style>
 
</style>
@endpush
@section('title', 'Guardian Acceptance Certificate')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Guardian Acceptance Certificate</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('guardian-acceptance.index')}}">Guardian Acceptance Certificate</a></li>
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
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Certificate Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="certificateForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Applicant (Person)</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control selectAjax" name="user_id" id="user_id" data-placeholder="Search by ID, Name or Mobile">
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="guardian_id" class="col-sm-3 col-form-label">Guardian</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control selectAjax" name="guardian_id" id="guardian_id" data-placeholder="Search by ID, Name or Mobile">
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="guardian_relation" class="col-sm-3 col-form-label">Relation with Guardian</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="guardian_relation" id="guardian_relation" placeholder="e.g. পিতা, মাতা, ভাই" required>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <a href="{{route('guardian-acceptance.index')}}" class="btn btn-default float-right">Cancel</a>
                                    <div class="col-sm-9 text-right">
                                        <button type="submit" class="btn btn-info">Submit</button>
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
            // Setup AJAX Select2 for searching people
            $('.selectAjax').select2({
                ajax: {
                    url: '{{ route("people.search") }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: $.map(data.results, function(item) {
                                return {
                                    text: item.text,
                                    id: item.id
                                }
                            }),
                            pagination: {
                                more: false
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Search for a person...',
                minimumInputLength: 1,
            });

            $("#certificateForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('guardian-acceptance.store') }}",
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
        })

    </script>
@endpush
