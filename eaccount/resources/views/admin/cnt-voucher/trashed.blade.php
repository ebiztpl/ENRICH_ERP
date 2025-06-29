@extends('layouts.app')

<?php
$moduleName = __('root.contra_voucher.contra_voucher_manage');
$createItemName = __('root.common.create') . ' ' . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = __('root.common.trash');

$breadcrumbMainIcon = 'account_balance_wallet';
$breadcrumbCurrentIcon = 'archive';

$ModelName = 'App\Transaction';
$ParentRouteName = 'contra_voucher';

$voucher_type = 'Contra';

$all = config('role_manage.ContraVoucher.All');
$create = config('role_manage.ContraVoucher.Create');
$delete = config('role_manage.ContraVoucher.Delete');
$edit = config('role_manage.ContraVoucher.Edit');
$pdf = config('role_manage.ContraVoucher.Pdf');
$permanently_delete = config('role_manage.ContraVoucher.PermanentlyDelete');
$restore = config('role_manage.ContraVoucher.Restore');
$show = config('role_manage.ContraVoucher.Show');
$trash_show = config('role_manage.ContraVoucher.TrashShow');

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
                <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> {{ __('root.common.home') }}</a>
                </li>
                <li><a href="{{ route($ParentRouteName) }}"><i
                            class="material-icons">{{ $breadcrumbMainIcon }}</i>&nbsp;{{ $breadcrumbMainName }}</a></li>
                <li class="active"><i
                        class="material-icons">{{ $breadcrumbCurrentIcon }}</i>&nbsp;{{ $breadcrumbCurrentName }}
                </li>
            </ol>
            <!-- Hover Rows -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <a @if ($all == 0) class="dis-none" @endif
                                class="text-black btn btn-xs btn-success waves-effect"
                                href="{{ route($ParentRouteName) }}">{{ __('root.common.all') }}({{ $count_cnt }})</a>
                            <a class="btn btn-xs btn-danger waves-effect"
                                href="{{ route($ParentRouteName) }}">{{ __('root.common.trash') }}({{ $items->count() }})</a>
                            <ul class="header-dropdown m-r--5">
                                <form class="search" action="{{ route($ParentRouteName . '.trashed.search') }}"
                                    method="get">
                                    {{ csrf_field() }}
                                    <input autofocus type="search" name="search" class="form-control input-sm "
                                        placeholder="{{ __('root.common.search') }}" />
                                </form>
                            </ul>
                        </div>
                        <form class="actionForm" action="{{ route($ParentRouteName . '.trashed.action') }}" method="get">
                            <div class="pagination-and-action-area body">
                                <div>
                                    <div class="select-and-apply-area">
                                        <div class="form-group width-300">
                                            <div class="form-line">
                                                <select class="form-control" name="apply_comand_top" id="">
                                                    <option value="0">{{ __('root.common.select_action') }}</option>
                                                    @if ($restore == 1)
                                                        <option value="1">{{ __('root.common.restore') }}</option>
                                                    @endif
                                                    @if ($permanently_delete == 1)
                                                        <option value="2">{{ __('root.common.permanently_delete') }}
                                                        </option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input class="btn btn-sm btn-info waves-effect" type="submit"
                                                value="{{ __('root.common.apply') }}" name="ApplyTop">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="custom-paginate">
                                        {{ $items->links() }}
                                    </div>
                                </div>
                            </div>
                            <div class="body table-responsive">
                                {{ csrf_field() }}
                                @if (count($items) > 0)
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th class="checkbox_custom_style text-center">
                                                    <input name="selectTop" type="checkbox" id="md_checkbox_p"
                                                        class="chk-col-cyan" />
                                                    <label for="md_checkbox_p"></label>
                                                </th>
                                                <th class="text-center">{{ __('root.contra_voucher.voucher_no') }}</th>
                                                <th>{{ __('root.contra_voucher.particulars') }}</th>
                                                <th>{{ __('root.contra_voucher.branch_name') }}</th>
                                                <th>{{ __('root.contra_voucher.head_of_account_name') }}</th>
                                                <th>{{ __('root.contra_voucher.chq_no') }}</th>
                                                <th>{{ __('root.contra_voucher.date') }}</th>
                                                <th>{{ __('root.contra_voucher.made_of_payment') }}</th>
                                                
                                                <th>{{ __('root.contra_voucher.amount') }} ( <?php echo config('settings.is_code') == 'code' ? config('settings.currency_code') : config('settings.currency_symbol'); ?>
                                                    )
                                                </th>
                                                <th>{{ __('root.contra_voucher.options') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($items as $item)
                                                <tr>
                                                    <th class="text-center">
                                                        <input name="items[id][]" value="{{ $item->voucher_no }}"
                                                            type="checkbox" id="md_checkbox_{{ $i }}"
                                                            class="chk-col-cyan selects " />
                                                        <label for="md_checkbox_{{ $i }}"></label>
                                                    </th>
                                                    <td class="text-center">
                                                        {{ str_pad($item->voucher_no, 4, '0', STR_PAD_LEFT) }}</td>
                                                    <td>{{ $item->particulars }}</td>
                                                    <td>{{ $item->Branch != null ? $item->Branch->name : '' }}</td>
                                                    <td>{{ $item->BankCash != null ? $item->BankCash->name : '' }}</td>
                                                    <td>{{ $item->cheque_number }}</td>
                                                    <td>{{ date(config('settings.date_format'), strtotime($item->voucher_date)) }}
                                                    </td>
                                                    <td>{{ Helper::convertMoneyFormat($item->dr) }}</td>
                                                    <td>{{ Helper::convertMoneyFormat($item->cr) }}</td>
                                                    <td class="tdAction">
                                                        <a @if ($restore == 0) class="dis-none" @endif
                                                            class="btn btn-xs btn-info waves-effect"
                                                            href="{{ route($ParentRouteName . '.restore', ['id' => $item->voucher_no]) }}"
                                                            data-toggle="tooltip" data-placement="top" title="Restore"><i
                                                                class="material-icons">restore</i></a>
                                                        <a data-target="#largeModal"
                                                            class="dis-none btn btn-xs btn-success waves-effect ajaxCall"
                                                            href="#" data-toggle="tooltip" data-placement="top"
                                                            title="Preview"><i class="material-icons">pageview</i></a>
                                                        <a @if ($permanently_delete == 0) class="dis-none" @endif
                                                            class="btn btn-xs btn-danger waves-effect"
                                                            href="{{ route($ParentRouteName . '.kill', ['id' => $item->voucher_no]) }}"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Parmanently Delete?"> <i
                                                                class="material-icons">delete</i></a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            @endforeach
                                            <thead>
                                                <tr>
                                                    <th class="checkbox_custom_style text-center">
                                                        <input name="selectBottom" type="checkbox" id="md_checkbox_footer"
                                                            class="chk-col-cyan" />
                                                        <label for="md_checkbox_footer"></label>
                                                    </th>
                                                    <th class="text-center">{{ __('root.contra_voucher.voucher_no') }}</th>
                                                <th>{{ __('root.contra_voucher.particulars') }}</th>
                                                <th>{{ __('root.contra_voucher.branch_name') }}</th>
                                                <th>{{ __('root.contra_voucher.head_of_account_name') }}</th>
                                                <th>{{ __('root.contra_voucher.chq_no') }}</th>
                                                <th>{{ __('root.contra_voucher.date') }}</th>
                                                <th>{{ __('root.contra_voucher.made_of_payment') }}</th>
                                                
                                                <th>{{ __('root.contra_voucher.amount') }} ( <?php echo config('settings.is_code') == 'code' ? config('settings.currency_code') : config('settings.currency_symbol'); ?>
                                                    )
                                                </th>
                                                        
                                                    </th>
                                                    <th>{{ __('root.contra_voucher.options') }}</th>
                                                </tr>
                                            </thead>
                                        </tbody>
                                    </table>
                                @else
                                    <div class="body table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th colspan="8" class="text-danger text-center">
                                                        {{ __('root.common.no_data_found') }}
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                @endif
                            </div>
                            <div class="pagination-and-action-area body">
                                <div>
                                    <div class="select-and-apply-area">
                                        <div class="form-group width-300">
                                            <div class="form-line">
                                                <select class="form-control" name="apply_comand_bottom" id="">
                                                    <option value="0">{{ __('root.common.select_action') }}</option>
                                                    @if ($restore == 1)
                                                        <option value="1">{{ __('root.common.restore') }}</option>
                                                    @endif
                                                    @if ($permanently_delete == 1)
                                                        <option value="2">{{ __('root.common.permanently_delete') }}
                                                        </option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input class="btn btn-sm btn-info waves-effect" type="submit"
                                                value="{{ __('root.common.apply') }}" name="ApplyTop">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="custom-paginate">
                                        {{ $items->links() }}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- #END# Hover Rows -->
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
    </script>
    {{-- All datagrid --}}
    <script src="{{ asset('asset/js/dataTable.js') }}"></script>
    <script>
        BaseController.init();
    </script>
@endpush
