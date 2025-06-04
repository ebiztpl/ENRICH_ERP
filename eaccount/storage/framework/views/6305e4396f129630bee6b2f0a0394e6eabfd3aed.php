



<?php

$moduleName = " Cr Voucher";
$createItemName = "Show" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " Show";

$breadcrumbMainIcon = "account_balance_wallet";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\Transaction';
$ParentRouteName = 'cr_voucher';



$transaction = new \App\Transaction();

?>

<?php $__env->startSection('title'); ?>
    <?php echo e($moduleName); ?>-><?php echo e($createItemName); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('top-bar'); ?>
    <?php echo $__env->make('includes.top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('left-sidebar'); ?>
    <?php echo $__env->make('includes.left-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


    <section <?php if($is_rtl): ?> dir="rtl" <?php endif; ?> class="content">
        <div class="container-fluid">
            <div class="block-header <?php if($is_rtl): ?> pull-right <?php else: ?> pull-left <?php endif; ?>">
                <a class="btn btn-sm btn-info waves-effect" href="<?php echo e(url()->previous()); ?>"><?php echo e(__('root.common.back')); ?></a>
            </div>

            <ol class="breadcrumb breadcrumb-col-cyan <?php if($is_rtl): ?> pull-left  <?php else: ?> pull-right <?php endif; ?>">
                <li><a href="<?php echo e(route($ParentRouteName)); ?>"><i class="material-icons">home</i> <?php echo e(__('root.common.home')); ?></a></li>
                <li><a href="<?php echo e(route($ParentRouteName)); ?>"><i
                                class="material-icons"><?php echo e($breadcrumbMainIcon); ?></i><?php echo e($breadcrumbMainName); ?></a>
                </li>
                <li class="active"><i
                            class="material-icons"><?php echo e($breadcrumbCurrentIcon); ?></i> <?php echo e($breadcrumbCurrentName); ?></li>
            </ol>

            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h3><?php echo e($moduleName); ?> ( <?php echo e(str_pad($items[0]->voucher_no, 4, '0', STR_PAD_LEFT)); ?> )
                                Information</h3>
                        </div>

                        <div class="body">
                            <table class="table  table-bordered table-hover">
                                <thead>
                                <tr>
                                    <td> Branch Name: &nbsp; <span class="text-bold"
                                        ><?php echo e(App\Transaction::find($items[0]->id)->Branch->name); ?></span>
                                    </td>
                                    <td> Made Of Payment: &nbsp; <span class="text-bold"
                                        ><?php echo e(App\Transaction::find($items[0]->id)->BankCash->name); ?></span>
                                    </td>
                                    <td>Particulars: &nbsp; <span class="text-bold"
                                        ><?php echo e($items[0]->particulars); ?></span></td>
                                    <td> Voucher Date: &nbsp; <span class="text-bold"
                                        ><?php echo e(date(config('settings.date_format'), strtotime($items[0]->voucher_date))); ?></span>
                                    </td>
                                </tr>
                                </thead>
                            </table>
                        </div>

                        <div class="body">
                            <table class="table  table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>S.L No</th>
                                    <th>Head Of Account Name</th>
                                    <th>CHQ. No</th>
                                    <th>Amount ( <?php echo (config('settings.is_code') == 'code') ?
                                            config('settings.currency_code') : config('settings.currency_symbol')  ?>
                                        )
                                </tr>
                                </thead>
                                <tbody>
                                <?php $total_amount = 0; ?>
                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php
                                    $amount = $item->cr;
                                    if ($amount <= 0) {
                                        $amount = $item->dr;
                                    }
                                    $total_amount += $amount;

                                    ?>

                                    <tr>
                                        <td class="text-center"><?php echo e($key+1); ?></td>
                                        <td><?php echo e(App\Transaction::find($item->id)->IncomeExpenseHead->name); ?></td>
                                        <td><?php echo e($item->cheque_number); ?></td>
                                        <td> <?php echo e($transaction->convert_money_format($amount)); ?></td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($total_amount>0): ?>
                                    <tr>
                                        <th colspan="3" class="text-right">Total=</th>
                                        <th><?php echo e($transaction->convert_money_format($total_amount)); ?>=/</th>

                                    </tr>
                                <?php endif; ?>

                                </tbody>
                            </table>
                        </div>

                        <div class="body">
                            <table class="table  table-bordered table-hover">
                                <thead>
                                <tr>
                                    <td>Created By: &nbsp; <span class="text-bold"><?php echo e($items[0]->created_by); ?></span></td>
                                    <td>Created at: &nbsp; <span class="text-bold"><?php echo e(date(config('settings.date_format')." h:i:s", strtotime($items[0]->created_at))); ?></span>
                                    </td>
                                    <td>Deleted By: &nbsp; <span class="text-bold"><?php echo e($items[0]->deleted_by); ?></span></td>
                                    <td>Modified by: &nbsp; <span class="text-bold"><?php echo e($items[0]->updated_by); ?></span></td>
                                    <td>Modified at: &nbsp; <span class="text-bold"><?php echo e(date(config('settings.date_format')." h:i:s", strtotime($items[0]->updated_at))); ?></span>
                                    </td>
                                </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- #END# Inline Layout | With Floating Label -->
            </div>

        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('include-css'); ?>

    <!-- Colorpicker Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css')); ?>" rel="stylesheet"/>

    <!-- Dropzone Css -->
    <link href="<?php echo e(asset('asset/plugins/dropzone/dropzone.css')); ?>" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="<?php echo e(asset('asset/plugins/multi-select/css/multi-select.css')); ?>" rel="stylesheet">

    <!-- Bootstrap Spinner Css -->
    <link href="<?php echo e(asset('asset/plugins/jquery-spinner/css/bootstrap-spinner.css')); ?>" rel="stylesheet">

    <!-- Bootstrap Tagsinput Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')); ?>" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-select/css/bootstrap-select.css')); ?>" rel="stylesheet"/>



    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')); ?>"
          rel="stylesheet"/>

    <!-- Bootstrap DatePicker Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')); ?>" rel="stylesheet"/>


    <!-- noUISlider Css -->
    <link href="<?php echo e(asset('asset/plugins/nouislider/nouislider.min.css')); ?>" rel="stylesheet"/>

    <!-- Sweet Alert Css -->
    <link href="<?php echo e(asset('asset/plugins/sweetalert/sweetalert.css')); ?>" rel="stylesheet"/>


<?php $__env->stopPush(); ?>

<?php $__env->startPush('include-js'); ?>


    <!-- Moment Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/momentjs/moment.js')); ?>"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')); ?>"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>"></script>


    <!-- Sweet Alert Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/sweetalert/sweetalert.min.js')); ?>"></script>


    <!-- Autosize Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/autosize/autosize.js')); ?>"></script>

    <script src="<?php echo e(asset('asset/js/pages/forms/basic-form-elements.js')); ?>"></script>



<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/admin/cr-voucher/show.blade.php ENDPATH**/ ?>