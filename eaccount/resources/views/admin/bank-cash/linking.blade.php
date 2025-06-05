@extends('layouts.app')

{{-- Important Variables --}}

<?php

$moduleName = $item->name." Linking With Branches";
$createItemName = $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = ' All';

$breadcrumbMainIcon = 'fas fa-university';
$breadcrumbCurrentIcon = 'archive';

$ModelName = 'App\BankCash';
$ParentRouteName = 'bank_cash';

?>

@section('title')
    {{ $moduleName }}->{{ $createItemName }}
@stop

@section('top-bar')
    @include('includes.top-bar')
@stop
@section('left-sidebar')
    @include('includes.left-sidebar')
@stop
@section('content')

    <section @if ($is_rtl) dir="rtl" @endif class="content">
        <div class="container-fluid">
            <div class="block-header @if ($is_rtl) pull-right @else pull-left @endif">
                <a class="btn btn-sm btn-info waves-effect" href="{{ url()->previous() }}">{{ __('root.common.back') }}</a>
            </div>

            <ol class="breadcrumb breadcrumb-col-cyan @if ($is_rtl) pull-left  @else pull-right @endif">
                <li><a href="{{ route($ParentRouteName) }}"><i class="material-icons">home</i>
                        {{ __('root.common.home') }}</a></li>
                <li><a href="{{ route($ParentRouteName) }}"><i class="{{ $breadcrumbMainIcon }}"></i>
                        &nbsp;{{ $breadcrumbMainName }}</a>
                </li>
                <li class="active"><i class="material-icons">{{ $breadcrumbCurrentIcon }}</i> {{ $breadcrumbCurrentName }}
                </li>
            </ol>
            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                {{ $createItemName }}
                                <small>{{ $item->name }} Linking With Branches</small>
                            </h2>
                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                    action="{{ route($ParentRouteName . '.linkingsave', ['id' => $item->id]) }}">
                                    {{ csrf_field() }}
                                    <div class="row">

                              
                                        @foreach($branches as $branche)
                                        @if(in_array($branche->id, $branch_array))
                                        
                                    <div class="col-md-3">
                                    <label style="cursor:pointer" class="btn btn-success btn-sm " for="lef{{$loop->iteration}}"><input type="checkbox" name="branches[]" id="lef{{$loop->iteration}}" style="position:unset ; opacity:1" value="{{$branche->id}}" checked> {{$branche->name}}</label>
                                    </div>
                                    @else
                                    <div class="col-md-3">
                                    <label style="cursor:pointer" class="btn btn-success btn-sm " for="lef{{$loop->iteration}}"><input type="checkbox" name="branches[]" id="lef{{$loop->iteration}}" style="position:unset ; opacity:1" value="{{$branche->id}}"> {{$branche->name}}</label>
                                    </div>
                                    @endif
                                    @endforeach

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-line">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                    {{ __('root.common.update') }}
                                                </button>
                                            </div>
                                        </div>


                                    </div>




                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
             
                <!-- #END# Inline Layout | With Floating Label -->
            </div>
    </section>

@stop

@push('include-css')
    <!-- Colorpicker Css -->
    <link href="{{ asset('asset/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" rel="stylesheet" />

    <!-- Dropzone Css -->
    <link href="{{ asset('asset/plugins/dropzone/dropzone.css') }}" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="{{ asset('asset/plugins/multi-select/css/multi-select.css') }}" rel="stylesheet">

    <!-- Bootstrap Spinner Css -->
    <link href="{{ asset('asset/plugins/jquery-spinner/css/bootstrap-spinner.css') }}" rel="stylesheet">

    <!-- Bootstrap Tagsinput Css -->
    <link href="{{ asset('asset/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{ asset('asset/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('asset/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}"
        rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="{{ asset('asset/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <!-- noUISlider Css -->
    <link href="{{ asset('asset/plugins/nouislider/nouislider.min.css') }}" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="{{ asset('asset/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />
@endpush

@push('include-js')
    <!-- Moment Plugin Js -->
    <script src="{{ asset('asset/plugins/momentjs/moment.js') }}"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}">
    </script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="{{ asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>


    <!-- Sweet Alert Plugin Js -->
    <script src="{{ asset('asset/plugins/sweetalert/sweetalert.min.js') }}"></script>


    <!-- Autosize Plugin Js -->
    <script src="{{ asset('asset/plugins/autosize/autosize.js') }}"></script>

    <script src="{{ asset('asset/js/pages/forms/basic-form-elements.js') }}"></script>


    <script>
        @if (Session::has('success'))
            toastr["success"]('{{ Session::get('success') }}');
        @endif

        @if (Session::has('error'))
            toastr["error"]('{{ Session::get('error') }}');
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr["error"]('{{ $error }}');
            @endforeach
        @endif



        // Validation and calculation
        var UiController = (function() {

            var DOMString = {
                submit_form: 'form.form',
                name: 'input[name=name]',

            };

            return {
                getDOMString: function() {
                    return DOMString;
                },
                getFields: function() {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),
                        get_name: document.querySelector(DOMString.name),


                    }
                },
                getInputsValue: function() {
                    var Fields = this.getFields();
                    return {

                        name: Fields.get_name.value == "" ? 0 : Fields.get_name.value,


                    }
                },

            }
        })();

        var MainController = (function(UICnt) {

            var DOMString = UICnt.getDOMString();
            var Fields = UICnt.getFields();

            var setUpEventListner = function() {

                Fields.get_form.addEventListener('submit', validation);

            };

            var validation = function(e) {
                var input_values, Fields;
                input_values = UICnt.getInputsValue();
                Fields = UICnt.getFields();

                var FieldName1 = " Name";

                if (input_values.name == 0) {
                    toastr["error"]('Set Any' + FieldName1);
                    e.preventDefault();
                }


            };

            return {
                init: function() {
                    console.log("App Is running");
                    setUpEventListner();

                }
            }

        })(UiController);

        MainController.init();
    </script>
@endpush
