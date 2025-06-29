@extends('layouts.app')

<?php

$moduleName = __('root.cr_voucher.cr_voucher_manage');
$createItemName = __('root.common.create') . ' ' . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = __('root.common.create');

$breadcrumbMainIcon = 'account_balance_wallet';
$breadcrumbCurrentIcon = 'archive';

$ModelName = 'App\Transaction';
$ParentRouteName = 'cr_voucher';

$all = config('role_manage.CrVoucher.All');

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
                @if ($all == 1)
                    <a class="btn btn-sm btn-info waves-effect"
                        href="{{ route($ParentRouteName) }}">{{ __('root.common.all') }}</a>
                @endif
            </div>
            <ol class="breadcrumb breadcrumb-col-cyan @if ($is_rtl) pull-left  @else pull-right @endif">
                <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> {{ __('root.common.home') }}</a>
                </li>
                <li><a href="{{ route($ParentRouteName) }}"><i
                            class="material-icons">{{ $breadcrumbMainIcon }}</i>&nbsp;{{ $breadcrumbMainName }}</a>
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
                            <h2 class="m-b-20">
                                {{ $createItemName }}
                                <small>Put {{ $moduleName }} Information</small>
                            </h2>
                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                    action="{{ route($ParentRouteName . '.store') }}">
                                    {{ csrf_field() }}
                                    <div class="row clearfix">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 field_area">
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
                                                        @foreach ($branches as $project)
                                                            <option @if ($project->id == old('branch_id')) selected @endif
                                                                value="{{ $project->id }}">{{ $project->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                        name="bank_cash_id" id="">
                                                        <option value="0"> Select Bank Cash Name</option>
                                                        @foreach ($bank_cashes->sortByDesc('id') as $bank_cash)
                                                            <option @if ($bank_cash->id == old('bank_cash_id')) selected @endif
                                                                value="{{ $bank_cash->id }}">{{ $bank_cash->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input name="cheque_number" type="text" class="form-control">
                                                    <label class="form-label">Cheque Number</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                        class="form-control show-tick income_expense_head_id"
                                                        name="income_expense_head_id[]" id="">
                                                        <option value="0"> Select Head of Account Name</option>
                                                        @foreach ($income_expense_heads->sortByDesc('id') as $HeadOfAccount)
                                                            <option @if ($HeadOfAccount->id == old('income_expense_head_id')) selected @endif
                                                                value="{{ $HeadOfAccount->id }}">
                                                                {{ $HeadOfAccount->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input name="amount[]" type="number" class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i
                                                    class="pointer-cursor  material-icons text-success plus">add_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                        class="form-control show-tick income_expense_head_id"
                                                        name="income_expense_head_id[]" id="">
                                                        <option value="0"> Select Head of Account Name</option>
                                                        @foreach ($income_expense_heads->sortByDesc('id') as $HeadOfAccount)
                                                            <option @if ($HeadOfAccount->id == old('income_expense_head_id')) selected @endif
                                                                value="{{ $HeadOfAccount->id }}">
                                                                {{ $HeadOfAccount->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input name="amount[]" type="number" class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i
                                                    class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i
                                                    class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                        class="form-control show-tick income_expense_head_id"
                                                        name="income_expense_head_id[]" id="">
                                                        <option value="0"> Select Head of Account Name</option>
                                                        @foreach ($income_expense_heads as $HeadOfAccount)
                                                            <option @if ($HeadOfAccount->id == old('income_expense_head_id')) selected @endif
                                                                value="{{ $HeadOfAccount->id }}">
                                                                {{ $HeadOfAccount->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input name="amount[]" type="number" class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i
                                                    class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i
                                                    class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                        class="form-control show-tick income_expense_head_id"
                                                        name="income_expense_head_id[]" id="">
                                                        <option value="0"> Select Head of Account Name</option>
                                                        @foreach ($income_expense_heads as $HeadOfAccount)
                                                            <option @if ($HeadOfAccount->id == old('income_expense_head_id')) selected @endif
                                                                value="{{ $HeadOfAccount->id }}">
                                                                {{ $HeadOfAccount->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input name="amount[]" type="number" class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i
                                                    class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                <i
                                                    class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row dr">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true"
                                                        class="form-control show-tick income_expense_head_id"
                                                        name="income_expense_head_id[]" id="">
                                                        <option value="0"> Select Head of Account Name</option>
                                                        @foreach ($income_expense_heads as $HeadOfAccount)
                                                            <option @if ($HeadOfAccount->id == old('head_of_account_id')) selected @endif
                                                                value="{{ $HeadOfAccount->id }}">
                                                                {{ $HeadOfAccount->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input name="amount[]" type="number" class="form-control amount">
                                                    <label class="form-label">Amount </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                            <div class="form-group form-float">
                                                <i
                                                    class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line" id="bs_datepicker_container">
                                                    <input autocomplete="off" value="{{ old('voucher_date') }}"
                                                        name="voucher_date" type="text" class="form-control"
                                                        placeholder="Please choose a date...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <textarea name="particulars" rows="2" class="form-control no-resize" placeholder="Particulars"></textarea>
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
    <!-- Moment Plugin Js -->
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
        // Validation and calculation on Cr Voucher
        var UiController = (function() {
            var DOMString = {
                submit_form: 'form.form',
                field_area: '.field_area',
                project_id: 'select[name=branch_id]',
                bankcash_id: 'select[name=bank_cash_id]',
                cheque_number: 'input[name=cheque_number]',
                head_of_account_id: '.income_expense_head_id',
                amount: '.amount',
                date: 'input[name=voucher_date]',
                particulars: 'textarea[name=particulars]',
                drCloset: '.dr',
                dr: 'dr',
                plus: 'plus',
                minus: 'minus',
            };
            return {
                getDOMString: function() {
                    return DOMString;
                },
                getFields: function() {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),
                        get_project_id: document.querySelector(DOMString.project_id),
                        get_bankcash_id: document.querySelector(DOMString.bankcash_id),
                        get_cheque_number: document.querySelector(DOMString.cheque_number),
                        get_head_of_account_id: document.querySelectorAll(DOMString.head_of_account_id),
                        get_amount: document.querySelectorAll(DOMString.amount),
                        get_date: document.querySelector(DOMString.date),
                        get_particulars: document.querySelector(DOMString.particulars),
                        get_dr: document.getElementsByClassName(DOMString.dr),
                        get_plus: document.getElementsByClassName(DOMString.plus),
                        get_minus: document.getElementsByClassName(DOMString.minus),
                    }
                },
                getValues: function() {
                    var Fields = this.getFields();
                    return {
                        project_id: Fields.get_project_id.value == "" ? 0 : parseFloat(Fields.get_project_id
                            .value),
                        bankcash_id: Fields.get_bankcash_id.value == "" ? 0 : parseFloat(Fields.get_bankcash_id
                            .value),
                        cheque_number: Fields.get_cheque_number.value == "" ? 0 : parseFloat(Fields
                            .get_cheque_number.value),
                        date: Fields.get_date.value == "" ? 0 : Fields.get_date.value,
                        particulars: Fields.get_particulars.value == "" ? 0 : Fields.get_particulars.value,
                    }
                },
                hide: function(Field) {
                    var DomString = this.getDOMString();
                    var Area = Field.closest(DomString.field_area);
                    if (Area) {
                        Field.value = null;
                        Area.style.display = 'none';
                    }
                },
                show: function(Field) {
                    var DomString = this.getDOMString();
                    var Area = Field.closest(DomString.field_area);
                    if (Area) {
                        Area.style.display = 'block';
                    }
                },
                hideHeadAmountArea: function(Field) {
                    if (Field) {
                        Field.style.display = 'none';
                    }
                },
                showHeadAmountArea: function(Field) {
                    var DomString = this.getDOMString();
                    Field.querySelector('select').value = 0;
                    Field.querySelector(DomString.amount).value = "";
                    if (Field) {
                        Field.style.display = 'block';
                    }
                },
            }
        })();
        var MainController = (function(UICnt) {
            var DOMString = UICnt.getDOMString();
            var Fields = UICnt.getFields();
            var setUpEventListner = function() {
                Fields.get_form.addEventListener('submit', validation);
                Fields.get_bankcash_id.addEventListener('change', bankcashChange);
                Array.prototype.forEach.call(Fields.get_plus, function(plus, index) {
                    plus.addEventListener('click', function() {
                        addItem(index);
                    }, false);
                });
                Array.prototype.forEach.call(Fields.get_minus, function(minus, index) {
                    minus.addEventListener('click', function() {
                        removeItem(index);
                    }, false);
                });
            };
            var validation = function(e) {
                var Values, Fields;
                Values = UICnt.getValues();
                Fields = UICnt.getFields();
                if (Values.project_id == 0) {
                    toastr["error"]('Select  branch name');
                    e.preventDefault();
                }
                if (Values.bankcash_id == 0) {
                    toastr["error"]('Select Bank Cash Name');
                    e.preventDefault();
                }
                if (Fields.get_head_of_account_id[0].querySelector('select').value == 0) {
                    toastr["error"]('Select Head Of Account');
                    e.preventDefault();
                }
                if (Fields.get_amount[0].value == '') {
                    toastr["error"]('Put Amount');
                    e.preventDefault();
                }
                if (Values.date == 0) {
                    toastr["error"]('Set Date');
                    e.preventDefault();
                }
                if (Fields.get_dr[1].style.display == 'block') {
                    if (Fields.get_head_of_account_id[2].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }
                    if (Fields.get_amount[1].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }
                if (Fields.get_dr[2].style.display == 'block') {
                    if (Fields.get_head_of_account_id[4].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }
                    if (Fields.get_amount[2].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }
                if (Fields.get_dr[3].style.display == 'block') {
                    if (Fields.get_head_of_account_id[6].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }
                    if (Fields.get_amount[3].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }
                if (Fields.get_dr[4].style.display == 'block') {
                    if (Fields.get_head_of_account_id[8].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }
                    if (Fields.get_amount[4].value == '') {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }
                var head_of_account_Ids = [];
                var get_head_of_account_id_one = Fields.get_head_of_account_id[0].querySelector('select')
                    .value == "" ? 0 : parseFloat(Fields.get_head_of_account_id[0].querySelector('select')
                        .value);
                var get_head_of_account_id_two = Fields.get_head_of_account_id[2].querySelector('select')
                    .value == "" ? 0 : parseFloat(Fields.get_head_of_account_id[2].querySelector('select')
                        .value);
                var get_head_of_account_id_three = Fields.get_head_of_account_id[4].querySelector('select')
                    .value == "" ? 0 : parseFloat(Fields.get_head_of_account_id[4].querySelector('select')
                        .value);
                var get_head_of_account_id_four = Fields.get_head_of_account_id[6].querySelector('select')
                    .value == "" ? 0 : parseFloat(Fields.get_head_of_account_id[6].querySelector('select')
                        .value);
                var get_head_of_account_id_five = Fields.get_head_of_account_id[8].querySelector('select')
                    .value ==
                    "" ? 0 : parseFloat(Fields.get_head_of_account_id[8].querySelector('select').value);
                if (get_head_of_account_id_one > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_one);
                }
                if (get_head_of_account_id_two > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_two);
                }
                if (get_head_of_account_id_three > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_three);
                }
                if (get_head_of_account_id_four > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_four);
                }
                if (get_head_of_account_id_five > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_five);
                }

                function checkUniqueOrNot(head_of_account_Ids) {
                    var counts = [];
                    for (var i = 0; i <= head_of_account_Ids.length; i++) {
                        if (counts[head_of_account_Ids[i]] === undefined) {
                            counts[head_of_account_Ids[i]] = 1;
                        } else {
                            return true;
                        }
                    }
                    return false;
                }
                if (checkUniqueOrNot(head_of_account_Ids)) {
                    toastr["error"]('Head of Account should unique');
                    e.preventDefault();
                }
            };
            var bankcashChange = function() {
                var Values, Fields;
                Values = UICnt.getValues();
                Fields = UICnt.getFields();
                if (Values.bankcash_id < 1) {
                    UICnt.hide(Fields.get_cheque_number);
                } else {
                    UICnt.show(Fields.get_cheque_number);
                }
            };
            var addItem = function(index) {
                var Fields;
                Fields = UICnt.getFields();
                UICnt.showHeadAmountArea(Fields.get_dr[index + 1]);
            };
            var removeItem = function(index) {
                var Fields;
                Fields = UICnt.getFields();
                UICnt.hideHeadAmountArea(Fields.get_dr[index + 1]);
            };
            return {
                init: function() {
                    console.log("App Is running");
                    setUpEventListner();
                    // Default hide fields
                    var Fields = UICnt.getFields();
                    UICnt.hide(Fields.get_cheque_number);
                    UICnt.hideHeadAmountArea(Fields.get_dr[1]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[2]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[3]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[4]);
                }
            }

        })(UiController);

        MainController.init();
    </script>
@endpush
