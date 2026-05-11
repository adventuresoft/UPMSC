@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'Married'])
@push('style')
<style>

</style>
@endpush
@section('title', 'Married Certificate')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Married Certificate</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('married.index')}}">Married Certificate</a></li>
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
                            <h3 class="card-title">People Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="certificateForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="user_id" class="col-sm-2 col-form-label">People</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="user_id">
                                            <option value="">Select People</option>
                                            @if (count($users))
                                                @foreach ($users as $user)
                                                    @if (isset($user->people->approved_id))
                                                        <option value="{{$user->id}}" data-gender="{{$user->people->gender ?? ''}}">
                                                            {{$user->people->approved_id}} - {{$user->name}} - {{$user->email}} - {{$user->mobile}}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @else
                                                <option value="">No People Found</option>
                                            @endif

                                        </select>
                                        <small id="user_gender_hint" class="text-muted d-block mt-1"></small>
                                        <small class="text-danger error user_id-error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="spouse_identifier" class="col-sm-2 col-form-label">Spouse ID</label>
                                    <div class="col-sm-9">
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="spouse_identifier" id="spouse_identifier" placeholder="Spouse Reg. ID (Optional)">
                                            <input type="hidden" name="spouse_user_id" id="spouse_user_id">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-secondary" id="find_spouse_btn">Find by ID</button>
                                            </div>
                                        </div>
                                        <small id="spouse_lookup_hint" class="text-muted d-block mb-2">If spouse exists in Reg. People list, enter ID and click Find. Otherwise type spouse name and NID manually.</small>
                                        <small class="text-danger error spouse_identifier-error"></small>
                                        <small class="text-danger error spouse_user_id-error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="spouse_name" class="col-sm-2 col-form-label">Spouse Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="spouse_name" id="spouse_name" placeholder="Spouse Name">
                                        <small class="text-danger error spouse_name-error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="spouse_nid" class="col-sm-2 col-form-label">Spouse NID</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="spouse_nid" id="spouse_nid" placeholder="Spouse NID">
                                        <small class="text-danger error spouse_nid-error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="marriage_date" class="col-sm-2 col-form-label">Marriage Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" name="marriage_date" id="marriage_date">
                                        <small class="text-danger error marriage_date-error"></small>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <a href="{{route('married.index')}}" class="btn btn-default float-right">Cancel</a>
                                    <div class="col-sm-9">
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
             const spouseSearchUrlTemplate = @json(route('user.searchBySystemID', ['systemID' => '__KEY__']));
             $(".select2").select2();

            function updatePeopleHint() {
                let selected = $('#user_id option:selected');
                let genderRaw = (selected.data('gender') || '').toString().trim().toLowerCase();
                let isHusband = genderRaw === '1' || genderRaw === 'male' || genderRaw === 'm';
                let hint = $('#user_gender_hint');

                if (!$('#user_id').val()) {
                    hint.removeClass('text-danger').addClass('text-muted').text('');
                    return;
                }

                if (isHusband) {
                    hint.removeClass('text-danger').addClass('text-muted').text('Selected person will be treated as husband. Use spouse Reg. ID for auto-fill or type spouse details manually.');
                    return;
                }

                hint.removeClass('text-muted').addClass('text-danger').text('Selected person is not husband. Please select husband from People list.');
            }

            function setSpouseLookupHint(message, type = 'muted') {
                let hint = $('#spouse_lookup_hint');
                hint.removeClass('text-muted text-danger text-success');
                if (type === 'danger') {
                    hint.addClass('text-danger');
                } else if (type === 'success') {
                    hint.addClass('text-success');
                } else {
                    hint.addClass('text-muted');
                }
                hint.text(message);
            }

            function clearSpouseRegSelection() {
                $('#spouse_user_id').val('');
            }

            function fillSpouseFromUser(user) {
                let people = user.people || {};
                let spouseName = user.name || people.bn_name || '';
                let spouseNid = user.nid || people.nid || '';
                let spouseRegId = people.approved_id || user.system_id || '';

                $('#spouse_user_id').val(user.id || '');
                if (spouseRegId) {
                    $('#spouse_identifier').val(spouseRegId);
                }
                if (spouseName) {
                    $('#spouse_name').val(spouseName);
                }
                if (spouseNid) {
                    $('#spouse_nid').val(spouseNid);
                }
                setSpouseLookupHint('Spouse found in Reg. People list. Name and NID were auto-filled.', 'success');
            }

            function findSpouseById() {
                let spouseIdentifier = ($('#spouse_identifier').val() || '').trim();

                if (!spouseIdentifier) {
                    clearSpouseRegSelection();
                    setSpouseLookupHint('If spouse exists in Reg. People list, enter ID and click Find. Otherwise type spouse name and NID manually.', 'muted');
                    return;
                }

                let searchUrl = spouseSearchUrlTemplate.replace('__KEY__', encodeURIComponent(spouseIdentifier));
                let findBtn = $('#find_spouse_btn');
                findBtn.prop('disabled', true);

                $.ajax({
                    type: "GET",
                    url: searchUrl,
                    dataType: "json",
                    success: function(response) {
                        findBtn.prop('disabled', false);
                        if (!response || !response.status || !response.user) {
                            clearSpouseRegSelection();
                            setSpouseLookupHint('Spouse not found in Reg. People list for this ID. Please type spouse name and NID manually.', 'danger');
                            return;
                        }

                        let husbandUserId = ($('#user_id').val() || '').toString();
                        if (husbandUserId && response.user.id && husbandUserId === response.user.id.toString()) {
                            clearSpouseRegSelection();
                            setSpouseLookupHint('Husband and spouse cannot be the same person. Please use spouse ID or type manual spouse details.', 'danger');
                            return;
                        }

                        fillSpouseFromUser(response.user);
                    },
                    error: function() {
                        findBtn.prop('disabled', false);
                        clearSpouseRegSelection();
                        setSpouseLookupHint('Spouse not found in Reg. People list for this ID. Please type spouse name and NID manually.', 'danger');
                    }
                });
            }

            $('#user_id').on('change', updatePeopleHint);
            $('#find_spouse_btn').on('click', findSpouseById);
            $('#spouse_identifier').on('input', function() {
                clearSpouseRegSelection();
                setSpouseLookupHint('Click "Find by ID" to auto-fill from Reg. People list, or type spouse name and NID manually.', 'muted');
            });
            $('#spouse_identifier').on('keypress', function(e) {
                if (e.which === 13) {
                    e.preventDefault();
                    findSpouseById();
                }
            });
            $('#spouse_identifier').on('blur', function() {
                if (($(this).val() || '').trim()) {
                    findSpouseById();
                } else {
                    clearSpouseRegSelection();
                    setSpouseLookupHint('If spouse exists in Reg. People list, enter ID and click Find. Otherwise type spouse name and NID manually.', 'muted');
                }
            });
            updatePeopleHint();

            $("#certificateForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                thisForm.find('.error').text('');

                let selectedGenderRaw = ($('#user_id option:selected').data('gender') || '').toString().trim().toLowerCase();
                let isHusband = selectedGenderRaw === '1' || selectedGenderRaw === 'male' || selectedGenderRaw === 'm';
                if ($('#user_id').val() && !isHusband) {
                    toastr.error('Please select husband from People list.');
                    return;
                }

                let spouseFromReg = ($('#spouse_user_id').val() || '').trim();
                let spouseName = ($('#spouse_name').val() || '').trim();
                let spouseNid = ($('#spouse_nid').val() || '').trim();
                if (!spouseFromReg && (!spouseName || !spouseNid)) {
                    if (!spouseName) {
                        thisForm.find(".spouse_name-error").text("Spouse name is required when spouse is not found in Reg. list.");
                    }
                    if (!spouseNid) {
                        thisForm.find(".spouse_nid-error").text("Spouse NID is required when spouse is not found in Reg. list.");
                    }
                    toastr.error('Enter spouse Reg. ID and find, or provide spouse name and NID manually.');
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('married.store') }}",
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
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#image").change(function() {
            readURL(this);

        });
    </script>
@endpush
