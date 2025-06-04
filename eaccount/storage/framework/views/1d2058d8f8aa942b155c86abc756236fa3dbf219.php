

<?php $__env->startSection('title'); ?>
    <?php echo e(__('root.reports.cost_of_revenue')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('top-bar'); ?>
    <?php echo $__env->make('includes.top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('left-sidebar'); ?>
    <?php echo $__env->make('includes.left-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section <?php if($is_rtl): ?> dir="rtl" <?php endif; ?> class="content">
        <div class="header">
            <h2 class="text-center"><?php echo e(__('root.reports.cost_of_revenue')); ?></h2>
            <br>
        </div>
        <div class="container-fluid">
            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <!-- Branch Wise Start -->
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 <?php if($is_rtl): ?> float-r <?php endif; ?>">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                <?php echo e(__('root.reports.branch_wise')); ?>

                                <small><?php echo e(__('root.reports.show_all')); ?></small>
                            </h2>
                        </div>
                        <br>
                        <div class="body">
                            <div class="row clearfix">
                                <form class="form" id="form_validation" method="post"
                                    action="<?php echo e(route('reports.accounts.cost_of_revenue.report')); ?>">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select data-live-search="true" class="form-control show-tick"
                                                    name="branch_id">
                                                    <option value=""><?php echo e(__('root.reports.select_branch_name')); ?></option>
                                                    <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($Branch->id); ?>"><?php echo e($Branch->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h2 class="card-inside-title"><?php echo e(__('root.reports.period')); ?></h2>
                                        <div class="input-daterange input-group" id="bs_datepicker_range_container">
                                            <div class="form-line">
                                                <input autocomplete="off" name="start_from" type="text"
                                                    class="form-control" placeholder="<?php echo e(__('root.reports.date_start')); ?>...">
                                            </div>
                                            <span class="input-group-addon"><?php echo e(__('root.reports.to')); ?></span>
                                            <div class="form-line">
                                                <input autocomplete="off" name="start_to" type="text"
                                                    class="form-control" placeholder="<?php echo e(__('root.reports.date_end')); ?>...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h2 class="card-inside-title"><?php echo e(__('root.reports.period')); ?></h2>
                                        <div class="input-daterange input-group" id="bs_datepicker_range_container1">
                                            <div class="form-line">
                                                <input autocomplete="off" name="end_from" type="text"
                                                    class="form-control" placeholder="<?php echo e(__('root.reports.date_start')); ?>...">
                                            </div>
                                            <span class="input-group-addon"><?php echo e(__('root.reports.to')); ?></span>
                                            <div class="form-line">
                                                <input autocomplete="off" name="end_to" type="text" class="form-control"
                                                    placeholder="<?php echo e(__('root.reports.date_end')); ?>...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-line">
                                            <input formtarget="_blank" name="action" value="Show" type="submit"
                                                class="btn btn-primary m-t-15 waves-effect">
                                            <input name="action" value="Pdf" type="submit"
                                                class="btn btn-primary m-t-15 waves-effect">
                                            <input name="action" value="Excel" type="submit"
                                                class="btn btn-primary m-t-15 waves-effect">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Branch Wise End -->
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('include-css'); ?>
    <!-- Multi Select Css -->
    <link href="<?php echo e(asset('asset/plugins/multi-select/css/multi-select.css')); ?>" rel="stylesheet">
    <!-- Bootstrap Tagsinput Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')); ?>" rel="stylesheet">
    <!-- Bootstrap Select Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-select/css/bootstrap-select.css')); ?>" rel="stylesheet" />
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')); ?>"
        rel="stylesheet" />
    <!-- Bootstrap DatePicker Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startPush('include-js'); ?>
    <!-- Moment Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/momentjs/moment.js')); ?>"></script>
    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')); ?>">
    </script>
    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>"></script>
    <!-- Autosize Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/autosize/autosize.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/js/pages/forms/basic-form-elements.js')); ?>"></script>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\madhaverp_13_11\eaccount\resources\views/admin/accounts-report/cost-of-revenue/index.blade.php ENDPATH**/ ?>