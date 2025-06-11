@extends('layouts.app')

{{--Important Variables--}}

<?php

$moduleName = __('root.payment_mode.payment_mode_message');;
$createItemName = __('root.common.all') . ' ' . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " All";

$breadcrumbMainIcon = "fas fa-university";
$breadcrumbCurrentIcon = "archive";

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

    <section @if($is_rtl) dir="rtl" @endif class="content">
        <div class="container-fluid">
            <div class="block-header @if ($is_rtl) pull-right @else pull-left @endif">
                <a class="btn btn-sm btn-info waves-effect" href="{{ url()->previous() }}">{{ __('root.common.back') }}</a>
            </div>

            <ol class="breadcrumb breadcrumb-col-cyan @if ($is_rtl) pull-left  @else pull-right @endif">
                <li><a href="{{ route($ParentRouteName) }}"><i class="material-icons">home</i> {{ __('root.common.home') }}</a></li>
                <li><a href="{{ route($ParentRouteName) }}"><i
                                class="{{ $breadcrumbMainIcon }}"></i> &nbsp;{{  $breadcrumbMainName }}</a>
                </li>
                <li class="active"><i
                            class="material-icons">{{ $breadcrumbCurrentIcon  }}</i> {{ $breadcrumbCurrentName  }}</li>
            </ol>

            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               
                                <small>Details Information</small>
                            </h2>

                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                      action="{{ route($ParentRouteName.'.store') }}">

                                    {{ csrf_field() }}
                                    <div class="row clearfix">


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table class="table  table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th scope="col" class="text-center">S.L</th>
                                                    <th scope="col" class="text-center">Name</th>
                                                    <th scope="col" class="text-center">Description</th>
                                                    <th scope="col" class="text-center">Status</th>
                                                    <th scope="col" class="text-center">Option</th>

                                            
                                                </tr>
                                                </thead>
                                                <tbody>


                                                @if ($payment_Mode)
                                                        @foreach($payment_Mode as $key=>$value)
                                                            <tr>
                                                                <td class="text-center">{{$value->id}} </td>
                                                                <td class="text-center">{{$value->name}} </td>
                                                                <td class="text-center">{{$value->decription}} </td>
                                                                <td class="text-center">
                                                                  @if($value->status == 1)
                                                                    <span class="label bg-green">Active</span>
                                                                    @elseif($value->status == 0)
                                                                    <span class="label bg-red">Inactive</span>  
                                                                    @endif  
                                                            </td>
                                                            <td class="text-center">
                                                            
                                                            <a class="btn btn-xs btn-info waves-effect" href="{{ route('bank_cash.payment_mode.edit',$value->id) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="material-icons">mode_edit</i></a>
                                                            
                            <a class="btn btn-xs btn-danger waves-effect"
                            href="{{  route('bank_cash.payment_mode.destroy',$value->id) }}"
                            onclick="return confirm('Are you sure you want to delete this item?')"
                            data-toggle="tooltip" title="Delete">
                            <i class="material-icons">delete</i>
                           </a>



                                                            </tr>
                                                         @endforeach                               
                                                @else
                                                    <tr>
                                                        <th class="text-danger">No Item Available</th>
                                                    </tr>
                                                @endif

                                                </tbody>
                                            </table>

                                        </div>


                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Inline Layout | With Floating Label -->
            </div>
        </div>
    </section>

@stop

@push('include-css')

    <!-- Colorpicker Css -->
    <link href="{{ asset('asset/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" rel="stylesheet"/>

    <!-- Dropzone Css -->
    <link href="{{ asset('asset/plugins/dropzone/dropzone.css') }}" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="{{ asset('asset/plugins/multi-select/css/multi-select.css') }}" rel="stylesheet">

    <!-- Bootstrap Spinner Css -->
    <link href="{{ asset('asset/plugins/jquery-spinner/css/bootstrap-spinner.css') }}" rel="stylesheet">

    <!-- Bootstrap Tagsinput Css -->
    <link href="{{ asset('asset/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{ asset('asset/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"/>



    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('asset/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}"
          rel="stylesheet"/>

    <!-- Bootstrap DatePicker Css -->
    <link href="{{ asset('asset/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet"/>


    <!-- noUISlider Css -->
    <link href="{{ asset('asset/plugins/nouislider/nouislider.min.css') }}" rel="stylesheet"/>

    <!-- Sweet Alert Css -->
    <link href="{{ asset('asset/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet"/>


@endpush

@push('include-js')


    <!-- Moment Plugin Js -->
    <script src="{{ asset('asset/plugins/momentjs/moment.js') }}"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="{{ asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>


    <!-- Sweet Alert Plugin Js -->
    <script src="{{ asset('asset/plugins/sweetalert/sweetalert.min.js') }}"></script>


    <!-- Autosize Plugin Js -->
    <script src="{{ asset('asset/plugins/autosize/autosize.js') }}"></script>

    <script src="{{ asset('asset/js/pages/forms/basic-form-elements.js') }}"></script>



@endpush

