@extends('layouts.app')


{{-- Important Variables --}}

<?php
$moduleName = __('root.user.user_manage');
$createItemName = __('root.common.trash') . ' ' . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = __('root.common.trash');

$breadcrumbMainIcon = 'fas fa-user';
$breadcrumbCurrentIcon = 'archive';

$ModelName = 'App\User';
$ParentRouteName = 'user';

$all = config('role_manage.User.All');
$create = config('role_manage.User.Create');
$delete = config('role_manage.User.Delete');
$edit = config('role_manage.User.Edit');
$pdf = config('role_manage.User.Pdf');
$permanently_delete = config('role_manage.User.PermanentlyDelete');
$restore = config('role_manage.User.Restore');
$show = config('role_manage.User.Show');
$trash_show = config('role_manage.User.TrashShow');

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
                <a class="btn btn-sm btn-info" href="{{ url()->previous() }}">{{ __('root.common.back') }}</a>
            </div>
            <ol class="breadcrumb breadcrumb-col-cyan @if ($is_rtl) pull-left  @else pull-right @endif">
                <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> {{ __('root.common.home') }}</a>
                </li>
                <li><a href="{{ route($ParentRouteName) }}"><i class="{{ $breadcrumbMainIcon }}"></i>
                        &nbsp;{{ $breadcrumbMainName }}</a></li>
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
                                class="text-black btn btn-xs btn-success"
                                href="{{ route($ParentRouteName) }}">{{ __('root.common.all') }}({{ $ModelName::all()->count() }})</a>
                            <a class="btn btn-xs btn-danger "
                                href="{{ route($ParentRouteName) }}">{{ __('root.common.trash') }}({{ $ModelName::onlyTrashed()->count() }}
                                )</a>
                            <ul class="header-dropdown m-r--5">
                                <form class="search" action="{{ route($ParentRouteName . '.trashed.search') }}"
                                    method="get">
                                    {{ csrf_field() }}
                                    <input type="search" name="search" class="form-control input-sm "
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
                                                <th>{{ __('root.user.name') }}</th>
                                                <th>{{ __('root.user.email') }}</th>
                                                <th>{{ __('root.user.user_role') }}</th>
                                                <th>{{ __('root.user.options') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($items as $item)
                                                <tr>
                                                    <th class="text-center">
                                                        <input name="items[id][]" value="{{ $item->id }}"
                                                            type="checkbox" id="md_checkbox_{{ $i }}"
                                                            class="chk-col-cyan selects " />
                                                        <label for="md_checkbox_{{ $i }}"></label>
                                                    </th>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    @php
                                         $name = DB::table('role_manages')->where('id',$item->role_manage_id)->value('name');
 
                                                @endphp
                                                <td>
                                                    {{ $name }}
                                                </td>
                                                    <td class="tdAction ">
                                                        <a @if ($restore == 0) class="dis-none" @endif
                                                            class="btn btn-xs btn-info waves-effect"
                                                            href="{{ route($ParentRouteName . '.restore', ['id' => $item->id]) }}"
                                                            data-toggle="tooltip" data-placement="top" title="Restore"><i
                                                                class="material-icons">restore</i></a>
                                                        <a data-target="#largeModal"
                                                            class="dis-none btn btn-xs btn-success waves-effect ajaxCall "
                                                            href="{{ route($ParentRouteName . '.show', ['id' => $item->id]) }}"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="{{ __('root.common.preview') }}"><i
                                                                class="material-icons">pageview</i></a>
                                                        <a @if ($permanently_delete == 0) class="dis-none" @endif
                                                            class="btn btn-xs btn-danger waves-effect"
                                                            href="{{ route($ParentRouteName . '.kill', ['id' => $item->id]) }}"
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
                                                    <th>{{ __('root.user.name') }}</th>
                                                    <th>{{ __('root.user.email') }}</th>
                                                    <th>{{ __('root.user.user_role') }}</th>
                                                    <th>{{ __('root.user.options') }}</th>
                                                </tr>
                                            </thead>
                                        </tbody>
                                    </table>
                                @else
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center text-danger">There has No data</th>
                                            </tr>
                                        </thead>
                                    </table>
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
    <script src="{{ asset('asset/js/pages/forms/basic-form-elements.js') }}"></script>
    <!-- Autosize Plugin Js -->
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
