@extends('backend.master', ['mainMenu' => 'People', 'subMenu' => 'Create'])
@section('title', 'People Create')
@push('style')
    {{-- <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgb(251, 24, 24);
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 19px;
            width: 19px;
            left: 4px;
            bottom: 3px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #21d937;
        }




        input:focus+.slider {
            box-shadow: 0 0 1px #21d937;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style> --}}

    <style>
    
        .knobs,
        .layer {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        .toggle-button {
            position: relative;
            top: 50%;
            width: 74px;
            height: 36px;
            overflow: hidden;
        }

        .toggle-button.r,
        .toggle-button.r .layer {
            border-radius: 100px;
        }

        .checkbox {
            position: relative;
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            opacity: 0;
            cursor: pointer;
            z-index: 3;
        }

        .knobs {
            z-index: 2;
        }

        .layer {
            width: 100%;
            background-color: #fcebeb;
            transition: 0.3s ease all;
            z-index: 1;
        }

        /* Button 1 */
        .toggle-button-1 .knobs:before {
            content: "NO";
            position: absolute;
            top: 4px;
            left: 4px;
            width: 30px;
            height: 30px;
            color: #fff;
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            line-height: 1;
            padding: 9px 4px;
            background-color: #f44336;
            border-radius: 50%;
            transition: 0.3s cubic-bezier(0.18, 0.89, 0.35, 1.15) all;
        }

        .toggle-button-1 .checkbox:checked + .knobs:before {
            content: "YES";
            left: 42px;
            background-color: #03a9f4;
        }

        .toggle-button-1 .checkbox:checked ~ .layer {
            background-color: #ebf7fc;
        }

        .toggle-button-1 .knobs,
        .toggle-button-1 .knobs:before,
        .toggle-button-1 .layer {
            transition: 0.3s ease all;
        }

    </style>
@endpush
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
                        <li class="breadcrumb-item"><a href="{{ route('people.index') }}">People</a></li>
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
                                @include('backend.pages.people.tabs.tab_header', [
                                    'user' => $user,
                                    'active_tab' => 'property',
                                ])
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="peoplePropertyForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">


                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="is_property" class="col-sm-2 col-form-label">Any Property?</label>
                                    <div class="col-sm-10 px-2">
                                        <label for="property-no">
                                            <input type="radio" value="0" {{(isset($user->propertyInfos->first()->is_property) ?  (($user->propertyInfos->first()->is_property == 0) ? 'checked' : '')  : 'checked')}} id="property-no"
                                                name="is_property">
                                            No
                                        </label>

                                        <label for="property-yes">
                                            <input type="radio" value="1" {{(isset($user->propertyInfos->first()->is_property) ?  (($user->propertyInfos->first()->is_property == 1) ? 'checked' : '')  : '')}} id="property-yes" name="is_property">
                                            Yes
                                        </label>
                                    </div>
                                </div>

                                <div class="property-content {{(isset($user->propertyInfos->first()->is_property) ?  (($user->propertyInfos->first()->is_property == 1) ? '' : 'd-none')  : 'd-none')}}">
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row align-items-center">
                                                <label for="cash_amount" class="col-sm-4 col-form-label">Cash Amount</label>
                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control"
                                                        value="{{ $user->propertyInfos->first()->cash_amount ?? '' }}" name="cash_amount"
                                                        id="cash_amount" placeholder="Cash Amount">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row align-items-center">
                                                <label for="tin_number" class="col-sm-4 col-form-label">E-TIN</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="tin_number"
                                                        value="{{ $user->propertyInfos->first()->tin_number ?? '' }}" class="form-control"
                                                        id="tin_number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <br><br>
                                    <div class="row mb-4">
                                        {{-- House Column --}}
                                        <div class="col">
                                            <div class="text-center mb-3">
                                                <label for="house" class="d-block"><i class="fa fa-home"></i> Have any house?</label>
                                                <div class="toggle-button r toggle-button-1 mx-auto">
                                                    <input type="checkbox" autocomplete="off" class="checkbox" name="house" id="house" value="1"  {{ optional($user->propertyInfos->first())->house ? 'checked' : '' }} />
                                                    <div class="knobs"></div><div class="layer"></div>
                                                </div>
                                            </div>
                                            <div class="house-property text-left {{ optional($user->propertyInfos->first())->house ? '' : 'd-none' }}">
                                                <div class="form-group mb-2">
                                                    <label for="house_type" class="small mb-1">House Type</label>
                                                    <input type="text" name="house_type" value="{{ $user->propertyInfos->first()->house_type ?? '' }}" placeholder="House Type" class="form-control form-control-sm" id="house_type">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="house_land_quantity" class="small mb-1">Land Quantity (in Acre)</label>
                                                    <input type="number" step="0.0001" name="house_land_quantity" value="{{ optional($user->propertyInfos->first())->house_land_quantity ?? '' }}" placeholder="0.0000" class="form-control form-control-sm" id="house_land_quantity">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="house_price" class="small mb-1">House Price</label>
                                                    <input type="number" step="0.01" name="house_price" value="{{ $user->propertyInfos->first()->house_price ?? '' }}" placeholder="0.00" class="form-control form-control-sm" id="house_price">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="house_information" class="small mb-1">House Information</label>
                                                    <textarea class="form-control form-control-sm" rows="3" name="house_information" placeholder="House Information" id="house_information">{{ optional($user->propertyInfos->first())->house_information ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Land Column --}}
                                        <div class="col">
                                            <div class="text-center mb-3">
                                                <label for="land" class="d-block"><i class="fa fa-mountain"></i> Have any land?</label>
                                                <div class="toggle-button r toggle-button-1 mx-auto">
                                                    <input type="checkbox" autocomplete="off" class="checkbox" name="land" id="land" value="1"  {{ optional($user->propertyInfos->first())->land ? 'checked' : '' }} />
                                                    <div class="knobs"></div><div class="layer"></div>
                                                </div>
                                            </div>
                                            <div class="land-property text-left {{ optional($user->propertyInfos->first())->land ? '' : 'd-none' }}">
                                                <div class="form-group mb-2">
                                                    <label for="land_type" class="small mb-1">Land Type</label>
                                                    <input type="text" name="land_type" value="{{ optional($user->propertyInfos->first())->land_type ?? '' }}" placeholder="Land Type" class="form-control form-control-sm" id="land_type">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="land_quantity" class="small mb-1">Land Quantity (in Acre)</label>
                                                    <input type="number" step="0.0001" name="land_quantity" value="{{ optional($user->propertyInfos->first())->land_quantity ?? '' }}" placeholder="0.0000" class="form-control form-control-sm" id="land_quantity">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="land_price" class="small mb-1">Land Price</label>
                                                    <input type="number" step="0.01" name="land_price" value="{{ optional($user->propertyInfos->first())->land_price ?? '' }}" placeholder="0.00" class="form-control form-control-sm" id="land_price">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="land_information" class="small mb-1">Land Information</label>
                                                    <textarea class="form-control form-control-sm" rows="3" name="land_information" placeholder="Land Information" id="land_information">{{ optional($user->propertyInfos->first())->land_information ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Diamond Column --}}
                                        <div class="col">
                                            <div class="text-center mb-3">
                                                <label for="diamond" class="d-block"><i class="fa fa-gem"></i> Have any diamond?</label>
                                                <div class="toggle-button r toggle-button-1 mx-auto">
                                                    <input type="checkbox" autocomplete="off" class="checkbox" name="diamond" id="diamond" value="1"  {{ optional($user->propertyInfos->first())->diamond ? 'checked' : '' }} />
                                                    <div class="knobs"></div><div class="layer"></div>
                                                </div>
                                            </div>
                                            <div class="diamond-property text-left {{ optional($user->propertyInfos->first())->diamond ? '' : 'd-none' }}">
                                                <div class="form-group mb-2">
                                                    <label for="diamond_quantity" class="small mb-1">Diamond Quantity (in gram)</label>
                                                    <input type="number" step="0.01" name="diamond_quantity" value="{{ optional($user->propertyInfos->first())->diamond_quantity ?? '' }}" placeholder="0.00" class="form-control form-control-sm" id="diamond_quantity">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="diamond_price" class="small mb-1">Diamond Price</label>
                                                    <input type="number" step="0.01" name="diamond_price" value="{{ optional($user->propertyInfos->first())->diamond_price !== null ? number_format((float)optional($user->propertyInfos->first())->diamond_price, 2, '.', '') : '' }}" placeholder="0.00" class="form-control form-control-sm" id="diamond_price">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="diamond_information" class="small mb-1">Diamond Information</label>
                                                    <textarea class="form-control form-control-sm" rows="3" name="diamond_information" placeholder="Diamond Information" id="diamond_information">{{ optional($user->propertyInfos->first())->diamond_information ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Gold Column --}}
                                        <div class="col">
                                            <div class="text-center mb-3">
                                                <label for="gold" class="d-block"><i class="fa fa-coins"></i> Have any gold?</label>
                                                <div class="toggle-button r toggle-button-1 mx-auto">
                                                    <input type="checkbox" autocomplete="off" class="checkbox" name="gold" id="gold" value="1"  {{ optional($user->propertyInfos->first())->gold ? 'checked' : '' }} />
                                                    <div class="knobs"></div><div class="layer"></div>
                                                </div>
                                            </div>
                                            <div class="gold-property text-left {{ optional($user->propertyInfos->first())->gold ? '' : 'd-none' }}">
                                                <div class="form-group mb-2">
                                                    <label for="gold_quantity" class="small mb-1">Gold Quantity (in gram)</label>
                                                    <input type="number" step="0.01" name="gold_quantity" value="{{ optional($user->propertyInfos->first())->gold_quantity ?? '' }}" placeholder="0.00" class="form-control form-control-sm" id="gold_quantity">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="gold_price" class="small mb-1">Gold Price</label>
                                                    <input type="number" step="0.01" name="gold_price" value="{{ optional($user->propertyInfos->first())->gold_price !== null ? number_format((float)optional($user->propertyInfos->first())->gold_price, 2, '.', '') : '' }}" placeholder="0.00" class="form-control form-control-sm" id="gold_price">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="gold_information" class="small mb-1">Gold Information</label>
                                                    <textarea class="form-control form-control-sm" rows="3" name="gold_information" placeholder="Gold Information" id="gold_information">{{ optional($user->propertyInfos->first())->gold_information ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Silver Column --}}
                                        <div class="col">
                                            <div class="text-center mb-3">
                                                <label for="silver" class="d-block"><i class="fa fa-utensil-spoon"></i> Have any silver?</label>
                                                <div class="toggle-button r toggle-button-1 mx-auto">
                                                    <input type="checkbox" autocomplete="off" class="checkbox" name="silver" id="silver" value="1"  {{ optional($user->propertyInfos->first())->silver ? 'checked' : '' }} />
                                                    <div class="knobs"></div><div class="layer"></div>
                                                </div>
                                            </div>
                                            <div class="silver-property text-left {{ optional($user->propertyInfos->first())->silver ? '' : 'd-none' }}">
                                                <div class="form-group mb-2">
                                                    <label for="silver_quantity" class="small mb-1">Silver Quantity (in gram)</label>
                                                    <input type="number" step="0.01" name="silver_quantity" value="{{ optional($user->propertyInfos->first())->silver_quantity ?? '' }}" placeholder="0.00" class="form-control form-control-sm" id="silver_quantity">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="silver_price" class="small mb-1">Silver Price</label>
                                                    <input type="number" step="0.01" name="silver_price" value="{{ optional($user->propertyInfos->first())->silver_price !== null ? number_format((float)optional($user->propertyInfos->first())->silver_price, 2, '.', '') : '' }}" placeholder="0.00" class="form-control form-control-sm" id="silver_price">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="silver_information" class="small mb-1">Silver Information</label>
                                                    <textarea class="form-control form-control-sm" rows="3" name="silver_information" placeholder="Silver Information" id="silver_information">{{ optional($user->propertyInfos->first())->silver_information ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>



                            <!-- /.card-body -->
                            <div class="card-footer bg-white border-top-0 mt-4">
                                <div class="form-group row align-items-center mb-0">
                                    <div class="col-sm-4">
                                        <a href="{{ route('people.financial', $user->id) }}"
                                            class="btn btn-outline-secondary btn-block">
                                            <i class="fas fa-arrow-left mr-1"></i> Financial
                                        </a>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="submit" class="btn btn-primary btn-block shadow-sm" style="background-color: #4f46e5; border-color: #4f46e5;">
                                            <i class="fas fa-save mr-1"></i> Save & Next
                                        </button>
                                    </div>
                                    <div class="col-sm-4">
                                        <a href="{{ route('people.disability', $user->id) }}"
                                            class="btn btn-outline-primary btn-block">
                                            Disability <i class="fas fa-arrow-right ml-1"></i>
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
            $(".select2").select2();
            $("#peoplePropertyForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('people.propertyStore') }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                    },
                    success: function(response) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.href = response.redirect_url;
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "-error").text(val[0]);
                        });
                    }
                });
            })
        })

        $(document).on('change', '#house', function(e) {
            e.preventDefault();
            if ($(this).is(':checked')) {
                $('.house-property').removeClass('d-none');
            } else {
                $('.house-property').addClass('d-none');
            }
        })

        $(document).on('change', '#land', function(e) {
            e.preventDefault();
            if ($(this).is(':checked')) {
                $('.land-property').removeClass('d-none');
            } else {
                $('.land-property').addClass('d-none');
            }
        })

        $(document).on('change', '#diamond', function(e) {
            e.preventDefault();
            if ($(this).is(':checked')) {
                $('.diamond-property').removeClass('d-none');
            } else {
                $('.diamond-property').addClass('d-none');
            }
        })

        $(document).on('change', '#gold', function(e) {
            e.preventDefault();
            if ($(this).is(':checked')) {
                $('.gold-property').removeClass('d-none');
            } else {
                $('.gold-property').addClass('d-none');
            }
        })

        $(document).on('change', '#silver', function(e) {
            e.preventDefault();
            if ($(this).is(':checked')) {
                $('.silver-property').removeClass('d-none');
            } else {
                $('.silver-property').addClass('d-none');
            }
        })

        $(document).on('change', '#land_district_id', function(e){
            e.preventDefault();
            let district_id = $(this).val();
            let land_thana_id = $("#land_thana_id");

            if (district_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-thanas-by-district') }}/"+district_id,
                    beforeSend: function() {
                        land_thana_id.prop("disabled", true);
                        console.log("Searcing Thana");
                    },
                    success: function(response) {
                        land_thana_id.html(response)
                        land_thana_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        land_thana_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            } else {
                land_thana_id.prop("disabled", true);
            }
        })

        $(document).on('change', '#land_thana_id', function(e){
            e.preventDefault();
            let thana_id = $(this).val();
            let land_mouza_id = $("#land_mouza_id");

            if (thana_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-mouzas-by-thana') }}/"+thana_id,
                    beforeSend: function() {
                        land_mouza_id.prop("disabled", true);
                        console.log("Searcing Mouza");
                    },
                    success: function(response) {
                        land_mouza_id.html(response)
                        land_mouza_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        land_mouza_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            } else {
                land_mouza_id.prop("disabled", true);
            }
        })

        $(document).on('change', 'input[type=radio][name=is_property]', function(e) {
            e.preventDefault();
            let _this_value = $(this).val();
            let _this_property_content =  $(".property-content");
            if (parseInt(_this_value)) {
                _this_property_content.removeClass('d-none');
                _this_property_content.find('input').prop('disabled', false);
            } else {
                _this_property_content.removeClass('d-none').addClass('d-none');
                _this_property_content.find('input').prop('disabled', true);
            }
        })
    </script>
@endpush
