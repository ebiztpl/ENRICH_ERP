@extends('layouts.app')

<?php

$moduleName = __('root.ledger_name.ledger_name_manage');
$createItemName = __('root.common.create') .' '. $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = ' ' . __('root.common.all');

$breadcrumbMainIcon = 'fas fa-file-invoice-dollar';
$breadcrumbCurrentIcon = 'archive';

$ModelName = 'App\IncomeExpenseHead';
$ParentRouteName = 'income_expense_head';

$all = config('role_manage.LedgerName.All');
$create = config('role_manage.LedgerName.Create');
$delete = config('role_manage.LedgerName.Delete');
$edit = config('role_manage.LedgerName.Edit');
$pdf = config('role_manage.LedgerName.Pdf');
$permanently_delete = config('role_manage.LedgerName.PermanentlyDelete');
$restore = config('role_manage.LedgerName.Restore');
$show = config('role_manage.LedgerName.Show');
$trash_show = config('role_manage.LedgerName.TrashShow');

?>

@section('title')
    {{ $moduleName }} -> {{ $breadcrumbCurrentName }}
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
                <a @if ($create == 0) class="dis-none" @endif class="btn btn-sm btn-info waves-effect"
                    href="{{ route($ParentRouteName . '.create') }}">{{ __('root.common.create') }}</a>
            </div> -->
            <ol class="breadcrumb breadcrumb-col-cyan @if ($is_rtl) pull-left  @else pull-right @endif">
                <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> {{ __('root.common.home') }}</a>
                </li>
                <li><a href="{{ route($ParentRouteName) }}"><i class="{{ $breadcrumbMainIcon }}"></i>
                        &nbsp;{{ $breadcrumbMainName }}</a></li>
                <li class="active"><i
                        class="material-icons">{{ $breadcrumbCurrentIcon }}</i>&nbsp;Linking
                </li>
            </ol>
            <!-- Hover Rows -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h4>Ledger Linking With Branches</h4>
                            <!-- <a class="btn btn-xs btn-info waves-effect"
                                href="{{ route($ParentRouteName) }}">{{ __('root.common.all') }}({{ $items->count() }})</a>
                            <a @if ($trash_show == 0) class="dis-none" @endif
                                class="btn btn-xs btn-danger waves-effect text-black"
                                href="{{ route($ParentRouteName) }}">{{ __('root.common.trash') }}({{ $total_trashed_income_expense_heads }}
                                )</a> -->
                            <!-- <ul class="header-dropdown m-r--5">
                                <form class="search" action="{{ route($ParentRouteName . '.active.search') }}"
                                    method="get">
                                    {{ csrf_field() }}
                                    <input autofocus type="search" name="search" class="form-control input-sm "
                                        placeholder="{{ __('root.common.search') }}" />
                                </form>
                            </ul> -->
                        </div>
                        <form class="actionForm" action="{{ route($ParentRouteName . '.active.action') }}" method="get">
                            <div class="pagination-and-action-area body">
                                <div>
                                    <div class="select-and-apply-area">
                                        <!-- <div class="form-group width-300">
                                            <div class="form-line">
                                                <select class="form-control" name="apply_comand_top" id="">
                                                    <option value="0">{{ __('root.common.select_action') }}</option>
                                                    @if ($delete)
                                                        <option value="3">{{ __('root.common.move_to_trash') }}
                                                        </option>
                                                    @endif
                                                    @if ($permanently_delete)
                                                        <option value="2">{{ __('root.common.permanently_delete') }}
                                                        </option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input class="btn btn-sm btn-info waves-effect" type="submit"
                                                value="{{ __('root.common.apply') }}" name="ApplyTop">
                                        </div> -->
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
                                                <th class="checkbox_custom_style text-center">Sr.
                                                </th>
                                                <th>{{ __('root.ledger_name.name') }}</th>
                                                @foreach($branches as $branch)
                                                <th>{{ $branch->name }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($items as $item)
                                            @php
                                                $check = \DB::table('ledger_branch')->where('ledger_id',$item->id)->pluck('branch_id')->toArray();
                                                @endphp
                                                <tr>
                                                    <th class="text-center" style="/* display: flex; */">
                                                        <span style="margin-right:5px">{{$loop->iteration}}</span>
                                                        <!-- <input data-id="{{$item->id}}" 
                                                            type="checkbox" id="{{$item->id}}"
                                                            class="chk-col-cyan selects checkall"  />
                                                        <label for="{{$item->id}}"></label> -->
                                                    </th>
                                                    <td>{{ $item->name }}
                                                        <input type='hidden' class="form-control" value="{{$item->id}}" />
                                                    </td>
                                                    @foreach($branches as $branch)
                                                <td class="text-center">
                                               
                                                @if(in_array($branch->id, $check))

                                                <input name="{{$branch->id}}[]" data-id="{{$item->id}}"  value="{{ $branch->id }}"
                                                            type="checkbox" id="{{$branch->id}}_{{ $i }}" checked
                                                            class="chk-col-cyan selects ritikch" />
                                                        <label for="{{$branch->id}}_{{ $i }}"></label>
                                                        @else
                                                        <input name="{{$branch->id}}[]" data-id="{{$item->id}}"  value="{{ $branch->id }}"
                                                            type="checkbox" id="{{$branch->id}}_{{ $i }}"
                                                            class="chk-col-cyan selects ritikch" />
                                                        <label for="{{$branch->id}}_{{ $i }}"></label>
                                                @endif

                                               

                                                </td>
                                                @endforeach
                                                </tr>
                                                <?php $i++; ?>
                                            @endforeach
                                            <thead>
                                                <tr>
                                                    <th class="checkbox_custom_style text-center">
                                                        Sr.
                                                    </th>
                                                    <th>{{ __('root.ledger_name.name') }}</th>
                                                    @foreach($branches as $branch)
                                                <th>{{ $branch->name }}</th>
                                                @endforeach
                                                </tr>
                                            </thead>
                                        </tbody>
                                    </table>
                                @else
                                    <div class="body">
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
                            <div class="pagination-and-action-area body">
                                <div>
                                    <div class="select-and-apply-area">
                                        <!-- <div class="form-group width-300">
                                            <div class="form-line">
                                                <select class="form-control" name="apply_comand_top" id="">
                                                    <option value="0">{{ __('root.common.select_action') }}</option>
                                                    @if ($delete)
                                                        <option value="3">{{ __('root.common.move_to_trash') }}
                                                        </option>
                                                    @endif
                                                    @if ($permanently_delete)
                                                        <option value="2">{{ __('root.common.permanently_delete') }}
                                                        </option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input class="btn btn-sm btn-info waves-effect" type="submit"
                                                value="{{ __('root.common.apply') }}" name="ApplyTop">
                                        </div> -->
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
  <script>
$(document).on('change', '.ritikch', function() {
 $branch_id = $(this).val();
 $ledger_id = $(this).attr('data-id');

if ($(this).prop('checked')==true){ 
    $data_recordid = 0;   
    }else{
        $data_recordid = 1;  

    }
 $.ajax({
            type: 'POST',
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ route($ParentRouteName . '.linking.savelinking') }}",
            data: {
                branch_id: $branch_id,
                ledger_id: $ledger_id,
                data_recordid: $data_recordid,
            },
         
        });





});
</script>
<script>
$(document).on('change', '.checkall', function() {
    if ($(this).prop('checked')==true){ 
        $(this).closest('tr').find('.ritikch').prop('checked',true); 
        $(this).closest('tr').find('.ritikch').trigger("change"); 
    }else{
        $(this).closest('tr').find('.ritikch').prop('checked',false);
        $(this).closest('tr').find('.ritikch').trigger("change");
    }
   

});
</script>
@endpush
