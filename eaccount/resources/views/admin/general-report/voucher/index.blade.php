@extends('layouts.app')

@section('title')
    {{ config('settings.company_name') }} -> Voucher
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
            <h2 class="text-center">Voucher Report</h2>
        </div>
        <div class="container-fluid">
            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <!-- Credit Voucher Wise Start -->
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 @if ($is_rtl) float-r @endif">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                Voucher Wise
                                <small>Anything is select show all</small>
                            </h2>
                        </div>
                        <br>
                        <div class="body">
                            <div class="row clearfix">
                                <form class="form" id="form_validation" method="post"
                                    action="{{ route('reports.general.voucher.report') }}">
                                    {{ csrf_field() }}
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select data-live-search="true" class="form-control show-tick"
                                                    name="voucher_type">
                                                    <option value="">Select Voucher Type</option>
                                                    <option value="CV">Credit Voucher</option>
                                                    <option value="DV">Debit Voucher</option>
                                                    <option value="JV">Journal Voucher</option>
                                                    <option value="Contra">Contra Voucher</option>
                                                    <option value="IBCBV">Initial Bank Cash</option>
                                                    <option value="IIEHBV">Initial Ledger</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="input-daterange input-group" id="bs_datepicker_range_container2">
                                            <div class="form-line">
                                                <input autocomplete="off" name="from" type="text" class="form-control"
                                                    placeholder="Date start...">
                                            </div>
                                            <span class="input-group-addon">to</span>
                                            <div class="form-line">
                                                <input autocomplete="off" name="to" type="text" class="form-control"
                                                    placeholder="Date end...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-line">
                                            <input formtarget="_blank" name="action" value="Show" type="submit"
                                                class="btn btn-primary m-t-15 waves-effect">
                                            <input formtarget="_blank" name="action" value="Pdf" type="submit"
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
                <!-- Credit Voucher Wise End -->
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
    </script>
@endpush
