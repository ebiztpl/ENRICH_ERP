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
                <!-- <a @if ($create == 0) class="dis-none" @endif class="btn btn-sm btn-info waves-effect"
                    href="{{ route('session_budget') }}">{{ __('root.common.create') }}</a> -->
            </div>
            <ol class="breadcrumb breadcrumb-col-cyan @if ($is_rtl) pull-left  @else pull-right @endif">
                <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> {{ __('root.common.home') }}</a>
                </li>
                <li><a href="{{ route('session_budget_list') }}"><i class="{{ $breadcrumbMainIcon }}"></i>
                        &nbsp;{{ $breadcrumbMainName }}</a></li>
                <li class="active"><i
                        class="material-icons">{{ $breadcrumbCurrentIcon }}</i>&nbsp;Budget Report
                </li>
            </ol>
            <!-- Hover Rows -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            @php
                            $sessionsname =\DB::connection('second_db')->table('sessions')->where('id',$selsession)->value('session');
                            @endphp
                            <div>
                            <h2>
                               Budget Report  @if($selsession) OF {{$branch->name??''}} @endif
                               @if($from) <small>From "{{ date('d-M-Y', strtotime(str_replace("/","-",$start_datee))) }}" To "{{ date('d-M-Y', strtotime(str_replace("/","-",$end_datee))) }}" for Session {{ $sessionsname }}</small>@endif
                            </h2>
                            </div>
                        </div>
                        <!-- <form class="actionForm" action="{{ route($ParentRouteName . '.active.action') }}" method="get"> -->
                            <div class="">
                                <div>
                                  
                                </div>
                                <div>
                                    <div class="col-md-12">
                                        <form method="post" action="{{ route('session_budget_report') }}">
                                        {{ csrf_field() }}
                                           <div class="row  m-t-15 ">


                                           <div class="col-md-2">
                                    <div class="form-group">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                        name="session" id="session" required>
                                                        <option value="">Select Session</option>
                                                        @foreach ($sessions as $session)
                                                            <option  @if ($session->id == $selsession) selected @endif
                                                                value="{{ $session->id }}">{{ $session->session }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            </div>


                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <div class="input-daterange input-group" id="bs_datepicker_range_container11">
                                            <div class="form-line">
                                                <input autocomplete="off" name="from" type="text" id="from" class="form-control"
                                                   value="{{$from}}"  placeholder="{{ __('root.reports.date_start') }}..." required>
                                            </div>                           
                                        </div>
                                    </div>


                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <div class="input-daterange input-group" id="bs_datepicker_range_container12">
                                        <div class="form-line">
                                                <input autocomplete="off" name="to" type="text" id="to" class="form-control"
                                                value="{{$to}}" placeholder="{{ __('root.reports.date_end') }}..." max=<?= date('Y-m-d') ?> required>
                                            </div>                      
                                        </div>
                                    </div>

                                    


                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                    <div class="form-line">
                                                <button type="submit" class="btn btn-primary waves-effect">
                                                    Search
                                                </button>
                                            </div>
                                    </div>
                                            
                                           </div>
                                         </form>
                                       
                                    </div>
                                </div>
                            </div>

                            @if($selsession)
                            <div class="body table-responsive w-full">
                                {{ csrf_field() }}
                                @if (count($types) > 0)
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                            <tr>
                                           
                                                <th>SR</th>
                                                <th>Ledger Group</th>
                                                <th>Actual Amount Of<br> ({{ $prevsession->session }})</th>
                                                <th>Budget Amount</th>
                                                                                   <th>Actual Amount btw<br>({{ date('d-M-Y', strtotime(str_replace("/","-",$start_datee))) }}<br>& {{ date('d-M-Y', strtotime(str_replace("/","-",$end_datee))) }}) </th>

                                                <th>Actual Amount Of<br> ({{ $nextsession->session }})</th>
                                                <th>Budget Amount Of<br> ({{ $nextsession->session }})</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1;
                                        $a= 0;
                                        $b =0;
                                        $c=0;
                                        $d=0;
                                        $e=0;
                                        $budgetdata = '';
                                        ?>
                                        @foreach($types as $type)
                                               <tr style="background-color:#8d888857;">
                                               <th colspan="7" style="border-right: 0px solid #eee;">{{ $type->name }}</th>
                                             
                                               </tr>
                                               @php
                                               $groups = \DB::table('income_expense_groups')->where('income_expense_type',$type->id)->get();
                                                
                                               @endphp
                                               @foreach($groups as $group)
  @php $i++ ;$budgetdata = array(); @endphp
                                               @foreach($lists as $list)
                                                    @if(($list->type_id == $type->id)  &&  ($list->group_id == $group->id))
                                                       @php $budgetdata = $list; @endphp
                                                    @endif
                                               @endforeach

                                               <th>{{$i}}</th>
                                                <td>{{$group->name}}</td>
                                                @php
                                                   $prevamount = 0;
                                                   @endphp
                                                   @foreach($prevtransactions as $prevtransaction)
                                                             @if($prevtransaction->group_id == $group->id)
                                                                  @if($prevtransaction->voucher_type == 'CV')
                                                                  @php
                                                                  $prevamount = $prevamount +  $prevtransaction->cr??0;
                                                                  @endphp
                                                                  @else
                                                                  @php
                                                                  $prevamount = $prevamount - $prevtransaction->dr??0;
                                                                  @endphp
                                                                  @endif
                                                               
                                                             @endif
                                                   @endforeach

                                                     

                                                <td>{{ $prevamount }}</td>
                                                <td>@if($budgetdata) {{ $budgetdata->budget_amount }} @else NA @endif</td>
                                                <!-- CURRENT DATA -->
                                                   @php
                                                   $amount = 0;
                                                   @endphp
                                                   @foreach($transactions as $transaction)
                                                             @if($transaction->group_id == $group->id)
                                                                  @if($transaction->voucher_type == 'CV')
                                                                  @php
                                                                  $amount = $amount +  $transaction->cr??0;
                                                                  @endphp
                                                                  @else
                                                                  @php
                                                                  $amount = $amount - $transaction->dr??0;
                                                                  @endphp
                                                                  @endif
                                                               
                                                             @endif
                                                   @endforeach
                                            
                                                <td>
                                                        {{$amount }}
                                                </td>
                                                 <!-- CURRENT DATA -->

                                                 @php
                                                   $nextamount = 0;
                                                   @endphp
                                                   @foreach($nexttransactions as $nexttransaction)
                                                             @if($nexttransaction->group_id == $group->id)
                                                                  @if($nexttransaction->voucher_type == 'CV')
                                                                  @php
                                                                  $nextamount = $nextamount +  $nexttransaction->cr??0;
                                                                  @endphp
                                                                  @else
                                                                  @php
                                                                  $nextamount = $nextamount - $nexttransaction->dr??0;
                                                                  @endphp
                                                                  @endif
                                                               
                                                             @endif
                                                   @endforeach

                                                   @php
                                                    $a = $a + $prevamount;
                                                    $b = $b + $amount;
                                                    $c= $c + $nextamount;
                                                    $d= $d + intval($budgetdata->budget_amount??0);
                                                    $e= $e + intval($budgetdata->budget_amount??0);
                                                      @endphp

                                                <td> {{$nextamount }}</td>


                                                @php
                                                $nextbudget = \DB::table('session_budget')->where('session',$nextsession->id)->where('ledger_type',$type->id)->where('ledger_group',$group->id)->where('branch_id',$branch->id)->value('budget_amount');
                                                @endphp
                                                <td>{{$nextbudget??'NA'}}</td>
                                                </tr>
                                               @endforeach
                                            @endforeach

                                                </tbody>
                                              
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
                            @endif
                            <div class="pagination-and-action-area body">
                                <div>
                                    
                                </div>
                                <div>
                                    <div class="custom-paginate">
                                        
                                    </div>
                                </div>
                            </div>
                        <!-- </form> -->
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
	
<script>
     $(document).on('change', '#session', function() {
    	$('#from').val('');
        $('#to').val('');  
      var range =  $(this).find(':selected').text() ;

      var arr = range.split('-');
// alert(arr[0]);
// alert(arr[1]);

$newstart = arr[0]+"-4-1";
$newend = "20"+arr[1]+"-3-31";



        $('#bs_datepicker_range_container11').datepicker('remove');
        $('#bs_datepicker_range_container12').datepicker('remove');


        $('#bs_datepicker_range_container11').datepicker({
        autoclose: true,
        container: '#bs_datepicker_range_container11',
       startDate: new Date($newstart),
        endDate: new Date($newend),
    });
      
    $('#bs_datepicker_range_container12').datepicker({
        autoclose: true,
        container: '#bs_datepicker_range_container12',
       startDate: new Date($newstart),
        endDate: new Date($newend),
    });




});	


$('#bs_datepicker_range_container11').datepicker({
        autoclose: true,
        container: '#bs_datepicker_range_container11',
    });
$('#bs_datepicker_range_container12').datepicker({
        autoclose: true,
        container: '#bs_datepicker_range_container12',
    });
</script>    
@endpush
