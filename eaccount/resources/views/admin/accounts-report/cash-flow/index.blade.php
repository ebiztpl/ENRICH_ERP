@extends('layouts.app')

{{-- Important Variables --}}


@section('title')
    {{ __('root.reports.cash_flow_statement') }}
@stop

@section('top-bar')
    @include('includes.top-bar')
@stop
@section('left-sidebar')
    @include('includes.left-sidebar')
@stop
@section('content')

    <section @if ($is_rtl) dir="rtl" @endif class="content">
        <div class="header">
            <h2 class="text-center">{{ __('root.reports.cash_flow_statement') }}</h2>
            <br>
        </div>
        <div class="container-fluid">
            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <!-- Branch Wise Start -->
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 @if ($is_rtl) float-r @endif">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                {{ __('root.reports.branch_wise') }}
                                <small>{{ __('root.reports.show_all') }}</small>
                            </h2>
                        </div>
                        <br>
                        <div class="body">
                            <div class="row clearfix">
                                <form class="form" id="form_validation" method="post"
                                    action="{{ route('reports.accounts.cash_flow.report') }}">
                                    {{ csrf_field() }}
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select data-live-search="true" class="form-control show-tick"
                                                    name="branch_id">
                                                    @php
														
														// Illuminate\Support\Facades\Session;
														
														 $activ = Session::get('branch_array');
                                                         $branch_id = $activ->id;
														@endphp
														
														@if($branch_id == 1)
                                                        <option value="0">Select Branch Name</option>
														@endif
                                                    @foreach ($branches as $branch)
                                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h2 class="card-inside-title">{{ __('root.reports.period') }}</h2>
                                        <div class="input-daterange input-group" id="bs_datepicker_range_container">
                                            <div class="form-line">
                                                <input autocomplete="off" name="start_from" type="text"
                                                    class="form-control"
                                                    placeholder="{{ __('root.reports.date_start') }}...">
                                            </div>
                                            <span class="input-group-addon">{{ __('root.reports.to') }}</span>
                                            <div class="form-line">
                                                <input autocomplete="off" name="start_to" type="text"
                                                    class="form-control"
                                                    placeholder="{{ __('root.reports.date_end') }}...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h2 class="card-inside-title">{{ __('root.reports.period') }}</h2>
                                        <div class="input-daterange input-group" id="bs_datepicker_range_container1">
                                            <div class="form-line">
                                                <input autocomplete="off" name="end_from" type="text"
                                                    class="form-control"
                                                    placeholder="{{ __('root.reports.date_start') }}...">
                                            </div>
                                            <span class="input-group-addon">{{ __('root.reports.to') }}</span>
                                            <div class="form-line">
                                                <input autocomplete="off" name="end_to" type="text" class="form-control"
                                                    placeholder="{{ __('root.reports.date_end') }}...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-line">
                                            <input formtarget="_blank" name="action" value="Show" type="submit"
                                                class="btn btn-primary m-t-15 waves-effect">
                                            <input formtarget="_blank"  name="action" value="Pdf" type="submit"
                                                class="btn btn-primary m-t-15 waves-effect">
                                            <input name="action" value="Excel" type="submit"
                                                class="btn btn-primary m-t-15 waves-effect">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Branch Wise End -->
            </div>
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

                branch_id: 'select[name=branch_id]',
                start_from: 'input[name=start_from]',

                end_from: 'input[name=end_from]',

            };

            return {
                getDOMString: function() {
                    return DOMString;
                },
                getFields: function() {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),

                        get_start_from: document.querySelector(DOMString.start_from),
                        get_end_from: document.querySelector(DOMString.end_from),

                    }
                },
                getInputsValue: function() {
                    var Fields = this.getFields();
                    return {

                        start_from: Fields.get_start_from.value == "" ? 0 : Fields.get_start_from,
                        end_from: Fields.get_end_from.value == "" ? 0 : Fields.get_end_from,


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



                if (input_values.start_from == 0) {
                    toastr["error"]('Set {{ __('root.reports.period') }} Date');
                    e.preventDefault();
                }

                if (input_values.end_from == 0) {
                    toastr["error"]('Set {{ __('root.reports.period') }} Date');
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
