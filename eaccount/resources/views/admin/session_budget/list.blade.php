@extends('layouts.app')
<?php
$moduleName = 'Session List';
$createItemName = __('root.common.create') . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = ' ' . __('root.common.all');

$breadcrumbMainIcon = 'fas fa-language';
$breadcrumbCurrentIcon = 'archive';

$ParentRouteName = 'language';

$all = config('role_manage.Language.All');
$create = config('role_manage.Language.Create');
$delete = config('role_manage.Language.Delete');
$edit = config('role_manage.Language.Edit');
$pdf = config('role_manage.Language.Pdf');
$permanently_delete = config('role_manage.Language.PermanentlyDelete');
$restore = config('role_manage.Language.Restore');
$show = config('role_manage.Language.Show');
$trash_show = config('role_manage.Language.TrashShow');

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
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <section @if ($is_rtl) dir="rtl" @endif class="content">
        <div class="container-fluid">
            <div class="block-header @if ($is_rtl) pull-right @else pull-left @endif">
                <a @if ($create == 0) class="dis-none" @endif class="btn btn-sm btn-info waves-effect"
                    href="{{ route('session_budget') }}">{{ __('root.common.create') }}</a>
            </div>
            <ol class="breadcrumb breadcrumb-col-cyan @if ($is_rtl) pull-left  @else pull-right @endif">
                <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> {{ __('root.common.home') }}</a>
                </li>
                <li><a href="{{ route('session_budget_list') }}"><i class="{{ $breadcrumbMainIcon }}"></i>
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
                            

                            <div>
                 
                            </div>
                        </div>
                        <form class="actionForm" action="{{ route($ParentRouteName . '.active.action') }}" method="get">
                            <div class="pagination-and-action-area body">
                                <div>
                               
                                </div>
                                <div>
                                    <div class="custom-paginate">
                                        {{ $list->links() }}
                                    </div>
                                </div>
                            </div>
                            <div class="body table-responsive w-full">
                                {{ csrf_field() }}
                                @if (count($list) > 0)
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                            <tr>
                                            <th class="checkbox_custom_style text-center">
                                                    Sr
                                                </th>
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
                            <div class="pagination-and-action-area body">
                                <div>
                                    
                                </div>
                                <div>
                                    <div class="custom-paginate">
                                        {{ $list->links() }}
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
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('asset/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}"
        rel="stylesheet" />
    <!-- Bootstrap DatePicker Css -->
    <link href="{{ asset('asset/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
@endpush
@push('include-css')
    <!-- Wait Me Css -->
    <link href="{{ asset('asset/plugins/waitme/waitMe.css') }}" rel="stylesheet" />
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
@endpush

@push('include-js')
    {{-- <script src="{{ asset('asset/js/pages/ui/modals.js') }}"></script> --}}
    <script src="{{ asset('asset/plugins/autosize/autosize.js') }}"></script>

    <!-- Moment Plugin Js -->
    <script src="{{ asset('asset/plugins/momentjs/moment.js') }}"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}">
    </script>

    <script src="{{ asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>

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
        var set_as_default = document.querySelectorAll(".set_as_default");
        set_as_default.forEach(element => {
            element.addEventListener("click", (e) => {
                Helper.ajaxRequest('GET', `language/attatchLang/${parseInt(e.target.value)}`, true);
            });
        });
        BaseController.init();
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<script type="text/javascript">
	var start =moment().startOf('month');
    var end =moment().endOf('month');
	



    
	$(document).ready(function(){
	 	$('#txtFromDate').daterangepicker({
			//startDate: start,
			//endDate: end,
			autoUpdateInput: false,
			locale: {
				cancelLabel: 'Clear'
			},
			ranges: {
				'Today': [moment(), moment()], 
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			}
        },cb);
		cb(start, end);
		$('#txtFromDate').on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('YYYY-MM-DD')+"" + ' and ' + ""+picker.endDate.format('YYYY-MM-DD'));
		});

		$('#txtFromDate').on('cancel.daterangepicker', function(ev, picker) {
			$(this).val('');
		});
	 	
	});	
</script>

@endpush
