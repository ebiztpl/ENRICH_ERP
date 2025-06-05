@extends('layouts.app')

<?php

$moduleName = 'Session Budget';
$createItemName = __('root.common.create') .' '. $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = __('root.common.create');

$breadcrumbMainIcon = 'fas fa-file-invoice-dollar';
$breadcrumbCurrentIcon = 'archive';

$ModelName = 'App\Expense';
$ParentRouteName = 'bill_recieved';

?>

@section('title')
   Session
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
            <!-- <div class="block-header @if ($is_rtl) pull-right @else pull-left @endif">
                <a class="btn btn-sm btn-info waves-effect" href="{{ url()->previous() }}">{{ __('root.common.back') }}</a>
            </div> -->
            <ol class="breadcrumb breadcrumb-col-cyan @if ($is_rtl) pull-left  @else pull-right @endif">
                <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i>
                        {{ __('root.common.home') }}</a></li>
                <li><a href="{{ route('session_budget_list') }}"><i class="{{ $breadcrumbMainIcon }}"></i>
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
                                    action="{{ route($ParentRouteName . '.session_store') }}" enctype="multipart/form-data" >
                                    {{ csrf_field() }}
                                    <div class="row">

                                    <div class="col-md-3">
                                    <div class="form-group">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                        name="session" id="session" >
                                                        <option value="">Select Session</option>
                                                        @foreach ($sessions as $session)
                                                            <option @if ($session->id == old('session')) selected @endif
                                                                value="{{ $session->id }}">{{ $session->session }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            </div>



                                            <div class="col-md-3">
                                    <div class="form-group">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                        name="type" id="ledger_type" >
                                                        <option value="">Select Ledger Type</option>
                                                        @foreach ($types as $type)
                                                            <option @if ($type->id == old('type')) selected @endif
                                                                value="{{ $type->id }}">{{ $type->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            </div>

                                            <div class="col-md-3">
                                    <div class="form-group">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                        name="group" id="ledger_group" >
                                                        <option value="">Select Ledger Group</option>
                                                        @foreach ($groups as $group)
                                                            <option @if ($group->id == old('group')) selected @endif
                                                                value="{{ $group->id }}" data-id="{{ $group->income_expense_type }}">{{ $group->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            </div>


                                            <div class="col-md-3">
                                    <div class="form-group">
                                                <div class="form-line">
                                                <input autofocus="" value="{{ old('budget_amount') }}" name="budget_amount" type="text" id="budget_amount" class="form-control">
                                                <label class="form-label">Budget Amount</label>
                                                </div>
                                            </div>
                                            </div>

                                            <div class="col-md-12">
                                    <div class="form-group">
                                                <div class="form-line">
                                                <label class="form-label">Description</label>
                                            <textarea class="form-control no-resize" name="description" rows="1">{{ old('description') }}</textarea>

                                                </div>
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


								
                        
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <h2>Session Budget List </h2></div>
								<div class="body table-responsive w-full">
                                {{ csrf_field() }}
                                @if (count($list) > 0)
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                            <tr>
                                            <th class="checkbox_custom_style text-center">
                                                    Sr
                                                </th>
												<th>Session</th>
                                                <th>Ledger Type</th>
                                                <th>Ledger Group</th>
                                                <th>Budget Amount</th>
                                                <th>Description</th>
                                                <th>Created At</th>
                                                <th>Created By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach($list as $sess)
                                               <tr>
                                          
                                            <tr>
                                            <td class="checkbox_custom_style text-center">
                                                    <?= $i ?>
                                                </td>
												@php
												$sess_ind = \DB::connection('second_db')->table('sessions')->where('id',$sess->session)->value('session');
												@endphp
												<td>{{$sess_ind}}</td>
                                                <td>{{$sess->name}}</td>
                                                <td>{{$sess->namm}}</td>                                        
                                                <td>{{$sess->budget_amount}}</td>
                                                <td>{{$sess->description}}</td>
                                                <td>{{ date("d-m-Y", strtotime($sess->created_at))}}</td>
                                                <td>{{$sess->created_by}}</td>
                                                <td>
                                                <a class="btn btn-xs btn-info waves-effect" href="{{ route($ParentRouteName . '.editsession', ['id' => $sess->id]) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="material-icons">mode_edit</i></a>
                                                <a class="btn btn-xs btn-danger waves-effect" href="{{ route($ParentRouteName . '.deletesession', ['id' => $sess->id]) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Trash"> <i class="material-icons">delete</i></a>
                                                </td>
                                            </tr>
                                                </tr>
                                                <?php $i++; ?>
                                            @endforeach
                                            <thead>
                                                <tr>
                                                <th class="checkbox_custom_style text-center">
                                                    Sr
                                                </th>
													<th>Session</th>
                                                <th>Ledger Type</th>
                                                <th>Ledger Group</th>
                                                <th>Budget Amount</th>
                                                <th>Description</th>
                                                <th>Created At</th>
                                                <th>Created By</th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                        </tbody>
                                    </table>
                                @else
                                    <div class="body table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-danger text-center">
                                                        {{ __('root.common.no_data_found') }}</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                @endif
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
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('asset/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}"
        rel="stylesheet" />
    <!-- Bootstrap DatePicker Css -->
    <link href="{{ asset('asset/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
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
                type: 'input[name=type]',
            };
            return {
                getDOMString: function() {
                    return DOMString;
                },
                getFields: function() {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),
                        get_name: document.querySelector(DOMString.name),
                        get_type: document.querySelector(DOMString.type),
                        get_code: document.querySelector(DOMString.code),
                    }
                },
                getInputsValue: function() {
                    var Fields = this.getFields();
                    return {
                        name: Fields.get_name.value == "" ? 0 : Fields.get_name.value,
                        type: Fields.get_type.value == "" ? 0 : Fields.get_type.value,
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
                if (input_values.name == 0) {
                    toastr["error"]('Ledger Group Name Is Required');
                    e.preventDefault();
                }
                if(input_values.type == 0){
                    toastr["error"]('Ledger Group Type Is Required');
                }
            };
            return {
                init: function() {
                    setUpEventListner();
                }
            }

        })(UiController);
        MainController.init();
    </script>


    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="{{ asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('asset/plugins/momentjs/moment.js') }}"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="{{ asset('asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}">
</script>
<!-- Bootstrap Datepicker Plugin Js -->
<script src="{{ asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<!-- Autosize Plugin Js -->
<script src="{{ asset('asset/plugins/autosize/autosize.js') }}"></script>
<script src="{{ asset('asset/js/pages/forms/basic-form-elements.js') }}"></script>



<script>
          $(document).on('change', '#ledger_type', function() {
            $val = $(this).val();      
            $('#ledger_group option').each(function() {
    $(this).prop('selected', false);
})
if($val != ''){
    $('#ledger_group option[data-id!="'+$val+'"]').hide();
    $('#ledger_group option[data-id="'+$val+'"]').show();
    $('#ledger_group option[value=""]').show();
    $('#ledger_group').selectpicker('refresh');
}else{

    $('#ledger_group option[value=""]').show();
    $('#ledger_group').selectpicker('refresh');
}
      
         });
    </script>






@endpush
