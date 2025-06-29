@extends('layouts.app')

<?php

$moduleName = __('root.ledger_name.ledger_name_manage');
$createItemName = __('root.common.create') . ' ' . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = __('root.common.create');

$breadcrumbMainIcon = 'fas fa-file-invoice-dollar';
$breadcrumbCurrentIcon = 'archive';

$ParentRouteName = 'income_expense_head';

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
                <li class="active"><i class="material-icons">{{ $breadcrumbCurrentIcon }}</i>&nbsp;
                    {{ $breadcrumbCurrentName }}
                </li>
            </ol>
            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                {{ $createItemName }}
                                <small>Put {{ $moduleName }} Information</small>
                            </h2>
                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                    action="{{ route($ParentRouteName . '.store') }}">
                                    {{ csrf_field() }}
                                    <div class="row clearfix">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input autofocus value="{{ old('name') }}" name="name"
                                                        type="text" class="form-control">
                                                    <label class="form-label">Name</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control  show-tick"
                                                        name="income_expense_type_id" id="income_expense_type_id">
                                                        <option value="0">Select Ledger Type</option>
                                                        @foreach ($income_expense_types as $income_expense_type_id)
                                                            <option @if ($income_expense_type_id->id == old('income_expense_type_id')) selected @endif
                                                                value="{{ $income_expense_type_id->id }}">
                                                                {{ $income_expense_type_id->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line" id="append_select"> 
                                                    <select data-live-search="true" class="form-control  show-tick"
                                                        name="income_expense_group_id" id="income_expense_group_id">
                                                        <option value="0">Select Ledger Group</option>
                                                        @foreach ($income_expense_groups as $income_expense_group)
                                                            <option @if ($income_expense_group->id == old('income_expense_group_id')) selected @endif
                                                                value="{{ $income_expense_group->id }}" data-id="{{$income_expense_group->income_expense_type}}">
                                                                {{ $income_expense_group->name }}</option>
                                                        @endforeach
                                                    </select>
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ old('unit') }}" name="unit" type="text"
                                                        class="form-control">
                                                    <label class="form-label">Unit</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group form-float">
                                                <span>Type</span> &nbsp;&nbsp;
                                                <input value="1" name="type" type="radio" id="radio_1"
                                                    class="with-gap radio-col-cyan" checked />
                                                <label for="radio_1">Dr</label>
                                                <input value="0" name="type" type="radio" id="radio_2"
                                                    class="with-gap radio-col-cyan" />
                                                <label for="radio_2">Cr</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-line">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                    {{ __('root.common.save') }}
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
        </div>
    </section>
@stop

@push('include-css')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('asset/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@push('include-js')
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
                income_expense_type_id: 'select[name=income_expense_type_id]',
                income_expense_group_id: 'select[name=income_expense_group_id]',
            };
            return {
                getDOMString: function() {
                    return DOMString;
                },
                getFields: function() {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),
                        get_name: document.querySelector(DOMString.name),
                        get_income_expense_type_id: document.querySelector(DOMString.income_expense_type_id),
                        get_income_expense_group_id: document.querySelector(DOMString.income_expense_group_id),
                    }
                },
                getInputsValue: function() {
                    var Fields = this.getFields();
                    return {
                        name: Fields.get_name.value == "" ? 0 : Fields.get_name.value,
                        income_expense_type_id: Fields.get_income_expense_type_id.value == "" ? 0 : parseFloat(
                            Fields.get_income_expense_type_id.value),
                        income_expense_group_id: Fields.get_income_expense_group_id.value == "" ? 0 :
                            parseFloat(Fields.get_income_expense_group_id.value),
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
                if (input_values.income_expense_group_id == 0) {
                    toastr["error"]('Select Ledger Group');
                    e.preventDefault();
                }
                if (input_values.income_expense_type_id == 0) {
                    toastr["error"]('Select Ledger Type');
                    e.preventDefault();
                }
                if (input_values.name == 0) {
                    toastr["error"]('Name is required');
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
    <script>
          $(document).on('change', '#income_expense_type_id', function() {

            $val = $(this).val();
           
            $('#income_expense_group_id option').each(function() {
    $(this).prop('selected', false);
})

if($val != 0){



    $('#income_expense_group_id option[data-id!="'+$val+'"]').hide();
    $('#income_expense_group_id option[data-id="'+$val+'"]').show();
    $('#income_expense_group_id option[value="0"]').show();
    $('#income_expense_group_id').selectpicker('refresh');

    
}else{

    $('#income_expense_group_id option[value="0"]').show();
    $('#income_expense_group_id').selectpicker('refresh');
}






      
         });
    </script>
@endpush
