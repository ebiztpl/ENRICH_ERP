
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

<?php $__env->startSection('title'); ?>
Session
<?php $__env->stopSection(); ?>

<?php $__env->startSection('top-bar'); ?>
    <?php echo $__env->make('includes.top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('left-sidebar'); ?>
    <?php echo $__env->make('includes.left-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <section <?php if($is_rtl): ?> dir="rtl" <?php endif; ?> class="content">
        <div class="container-fluid">
            <div class="block-header <?php if($is_rtl): ?> pull-right <?php else: ?> pull-left <?php endif; ?>">
                <!-- <a <?php if($create == 0): ?> class="dis-none" <?php endif; ?> class="btn btn-sm btn-info waves-effect"
                    href="<?php echo e(route('session_budget')); ?>"><?php echo e(__('root.common.create')); ?></a> -->
            </div>
            <ol class="breadcrumb breadcrumb-col-cyan <?php if($is_rtl): ?> pull-left  <?php else: ?> pull-right <?php endif; ?>">
                <li><a href="<?php echo e(route('dashboard')); ?>"><i class="material-icons">home</i> <?php echo e(__('root.common.home')); ?></a>
                </li>
                <li><a href="<?php echo e(route('session_budget_list')); ?>"><i class="<?php echo e($breadcrumbMainIcon); ?>"></i>
                        &nbsp;<?php echo e($breadcrumbMainName); ?></a></li>
                <li class="active"><i
                        class="material-icons"><?php echo e($breadcrumbCurrentIcon); ?></i>&nbsp;Budget Report
                </li>
            </ol>
            <!-- Hover Rows -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <?php
                            $sessionsname =\DB::connection('second_db')->table('sessions')->where('id',$selsession)->value('session');
                            ?>
                            <div>
                            <h2>
                               Budget Report  <?php if($selsession): ?> OF <?php echo e($branch->name??''); ?> <?php endif; ?>
                               <?php if($from): ?> <small>From "<?php echo e(date('d-M-Y', strtotime(str_replace("/","-",$start_datee)))); ?>" To "<?php echo e(date('d-M-Y', strtotime(str_replace("/","-",$end_datee)))); ?>" for Session <?php echo e($sessionsname); ?></small><?php endif; ?>
                            </h2>
                            </div>
                        </div>
                        <!-- <form class="actionForm" action="<?php echo e(route($ParentRouteName . '.active.action')); ?>" method="get"> -->
                            <div class="">
                                <div>
                                  
                                </div>
                                <div>
                                    <div class="col-md-12">
                                        <form method="post" action="<?php echo e(route('session_budget_report')); ?>">
                                        <?php echo e(csrf_field()); ?>

                                           <div class="row  m-t-15 ">


                                           <div class="col-md-2">
                                    <div class="form-group">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                        name="session" id="session" required>
                                                        <option value="">Select Session</option>
                                                        <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option  <?php if($session->id == $selsession): ?> selected <?php endif; ?>
                                                                value="<?php echo e($session->id); ?>"><?php echo e($session->session); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            </div>


                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <div class="input-daterange input-group" id="bs_datepicker_range_container11">
                                            <div class="form-line">
                                                <input autocomplete="off" name="from" type="text" id="from" class="form-control"
                                                   value="<?php echo e($from); ?>"  placeholder="<?php echo e(__('root.reports.date_start')); ?>..." required>
                                            </div>                           
                                        </div>
                                    </div>


                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <div class="input-daterange input-group" id="bs_datepicker_range_container12">
                                        <div class="form-line">
                                                <input autocomplete="off" name="to" type="text" id="to" class="form-control"
                                                value="<?php echo e($to); ?>" placeholder="<?php echo e(__('root.reports.date_end')); ?>..." max=<?= date('Y-m-d') ?> required>
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

                            <?php if($selsession): ?>
                            <div class="body table-responsive w-full">
                                <?php echo e(csrf_field()); ?>

                                <?php if(count($types) > 0): ?>
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                            <tr>
                                           
                                                <th>SR</th>
                                                <th>Ledger Group</th>
                                                <th>Actual Amount Of<br> (<?php echo e($prevsession->session); ?>)</th>
                                                <th>Budget Amount</th>
                                                                                   <th>Actual Amount btw<br>(<?php echo e(date('d-M-Y', strtotime(str_replace("/","-",$start_datee)))); ?><br>& <?php echo e(date('d-M-Y', strtotime(str_replace("/","-",$end_datee)))); ?>) </th>

                                                <th>Actual Amount Of<br> (<?php echo e($nextsession->session); ?>)</th>
                                                <th>Budget Amount Of<br> (<?php echo e($nextsession->session); ?>)</th>
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
                                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               <tr style="background-color:#8d888857;">
                                               <th colspan="7" style="border-right: 0px solid #eee;"><?php echo e($type->name); ?></th>
                                             
                                               </tr>
                                               <?php
                                               $groups = \DB::table('income_expense_groups')->where('income_expense_type',$type->id)->get();
                                                
                                               ?>
                                               <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php $i++ ;$budgetdata = array(); ?>
                                               <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(($list->type_id == $type->id)  &&  ($list->group_id == $group->id)): ?>
                                                       <?php $budgetdata = $list; ?>
                                                    <?php endif; ?>
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                               <th><?php echo e($i); ?></th>
                                                <td><?php echo e($group->name); ?></td>
                                                <?php
                                                   $prevamount = 0;
                                                   ?>
                                                   <?php $__currentLoopData = $prevtransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prevtransaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                             <?php if($prevtransaction->group_id == $group->id): ?>
                                                                  <?php if($prevtransaction->voucher_type == 'CV'): ?>
                                                                  <?php
                                                                  $prevamount = $prevamount +  $prevtransaction->cr??0;
                                                                  ?>
                                                                  <?php else: ?>
                                                                  <?php
                                                                  $prevamount = $prevamount - $prevtransaction->dr??0;
                                                                  ?>
                                                                  <?php endif; ?>
                                                               
                                                             <?php endif; ?>
                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                     

                                                <td><?php echo e($prevamount); ?></td>
                                                <td><?php if($budgetdata): ?> <?php echo e($budgetdata->budget_amount); ?> <?php else: ?> NA <?php endif; ?></td>
                                                <!-- CURRENT DATA -->
                                                   <?php
                                                   $amount = 0;
                                                   ?>
                                                   <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                             <?php if($transaction->group_id == $group->id): ?>
                                                                  <?php if($transaction->voucher_type == 'CV'): ?>
                                                                  <?php
                                                                  $amount = $amount +  $transaction->cr??0;
                                                                  ?>
                                                                  <?php else: ?>
                                                                  <?php
                                                                  $amount = $amount - $transaction->dr??0;
                                                                  ?>
                                                                  <?php endif; ?>
                                                               
                                                             <?php endif; ?>
                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                                <td>
                                                        <?php echo e($amount); ?>

                                                </td>
                                                 <!-- CURRENT DATA -->

                                                 <?php
                                                   $nextamount = 0;
                                                   ?>
                                                   <?php $__currentLoopData = $nexttransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nexttransaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                             <?php if($nexttransaction->group_id == $group->id): ?>
                                                                  <?php if($nexttransaction->voucher_type == 'CV'): ?>
                                                                  <?php
                                                                  $nextamount = $nextamount +  $nexttransaction->cr??0;
                                                                  ?>
                                                                  <?php else: ?>
                                                                  <?php
                                                                  $nextamount = $nextamount - $nexttransaction->dr??0;
                                                                  ?>
                                                                  <?php endif; ?>
                                                               
                                                             <?php endif; ?>
                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                   <?php
                                                    $a = $a + $prevamount;
                                                    $b = $b + $amount;
                                                    $c= $c + $nextamount;
                                                    $d= $d + intval($budgetdata->budget_amount??0);
                                                    $e= $e + intval($budgetdata->budget_amount??0);
                                                      ?>

                                                <td> <?php echo e($nextamount); ?></td>


                                                <?php
                                                $nextbudget = \DB::table('session_budget')->where('session',$nextsession->id)->where('ledger_type',$type->id)->where('ledger_group',$group->id)->where('branch_id',$branch->id)->value('budget_amount');
                                                ?>
                                                <td><?php echo e($nextbudget??'NA'); ?></td>
                                                </tr>
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </tbody>
                                              
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <div class="body table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-danger text-center">
                                                        <?php echo e(__('root.common.no_data_found')); ?></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
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



<?php $__env->stopSection(); ?>
<?php $__env->startPush('include-css'); ?>
    <!-- Bootstrap Select Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-select/css/bootstrap-select.css')); ?>" rel="stylesheet" />
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')); ?>"
        rel="stylesheet" />
    <!-- Bootstrap DatePicker Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>
<?php $__env->startPush('include-css'); ?>
    <!-- Wait Me Css -->
    <link href="<?php echo e(asset('asset/plugins/waitme/waitMe.css')); ?>" rel="stylesheet" />
    <!-- Colorpicker Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css')); ?>" rel="stylesheet" />

    <!-- Dropzone Css -->
    <link href="<?php echo e(asset('asset/plugins/dropzone/dropzone.css')); ?>" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="<?php echo e(asset('asset/plugins/multi-select/css/multi-select.css')); ?>" rel="stylesheet">

    <!-- Bootstrap Spinner Css -->
    <link href="<?php echo e(asset('asset/plugins/jquery-spinner/css/bootstrap-spinner.css')); ?>" rel="stylesheet">

    <!-- Bootstrap Tagsinput Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')); ?>" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-select/css/bootstrap-select.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startPush('include-js'); ?>
    
    <script src="<?php echo e(asset('asset/plugins/autosize/autosize.js')); ?>"></script>

    <!-- Moment Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/momentjs/moment.js')); ?>"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')); ?>">
    </script>

    <script src="<?php echo e(asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>"></script>

    <script src="<?php echo e(asset('asset/js/pages/forms/basic-form-elements.js')); ?>"></script>
    <!-- Autosize Plugin Js -->
    <script>
        <?php if(Session::has('success')): ?>
            toastr["success"]('<?php echo e(Session::get('success')); ?>');
        <?php endif; ?>
        <?php if(Session::has('error')): ?>
            toastr["error"]('<?php echo e(Session::get('error')); ?>');
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                toastr["error"]('<?php echo e($error); ?>');
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </script>
    
    <script src="<?php echo e(asset('asset/js/dataTable.js')); ?>"></script>
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
    <script src="<?php echo e(asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/plugins/momentjs/moment.js')); ?>"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="<?php echo e(asset('asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')); ?>">
</script>
<!-- Bootstrap Datepicker Plugin Js -->
<script src="<?php echo e(asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>"></script>
<!-- Autosize Plugin Js -->
<script src="<?php echo e(asset('asset/plugins/autosize/autosize.js')); ?>"></script>
<script src="<?php echo e(asset('asset/js/pages/forms/basic-form-elements.js')); ?>"></script>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/admin/session_budget/report.blade.php ENDPATH**/ ?>