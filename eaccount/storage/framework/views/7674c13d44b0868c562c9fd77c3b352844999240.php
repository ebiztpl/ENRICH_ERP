



<?php

$moduleName = __('root.settings.general');
$createItemName = "Update " . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " Update";

$breadcrumbMainIcon = "fas fa-project-diagram";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\Setting';
$ParentRouteName = 'settings.general';

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
            <ol class="breadcrumb breadcrumb-col-cyan <?php if($is_rtl): ?> pull-left  <?php else: ?> pull-right <?php endif; ?>">
                <li><a href="<?php echo e(route('dashboard')); ?>"><i class="material-icons">home</i> <?php echo e(__('root.common.home')); ?></a></li>
                <li><a href="<?php echo e(route($ParentRouteName)); ?>"> <i
                                class="material-icons">settings</i>&nbsp;<?php echo e($breadcrumbMainName); ?></a>
                </li>
                <li class="active"><i
                            class="material-icons"><?php echo e($breadcrumbCurrentIcon); ?></i> <?php echo e($breadcrumbCurrentName); ?></li>
            </ol>
            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php echo e($createItemName); ?>

                            </h2>
                            <br>
                            <div class="body">
                                <form enctype="multipart/form-data" class="form" id="form_validation" method="post"
                                      action="<?php echo e(route($ParentRouteName.'.update')); ?>">

                                    <?php echo e(csrf_field()); ?>

                                    <div class="row clearfix">

                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="<?php echo e($settings['company_name']); ?>" name="company_name" type="text"
                                                           class="form-control">
                                                    <label class="form-label">Company Name</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="<?php echo e($settings['contract_person']); ?>" name="contract_person" type="text"
                                                           class="form-control">
                                                    <label class="form-label">Contact Person</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="<?php echo e($settings['email']); ?>" name="email" type="email"
                                                           class="form-control">
                                                    <label class="form-label">Email</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="<?php echo e($settings['phone']); ?>"  name="phone" type="text"
                                                           class="form-control">
                                                    <label class="form-label">Phone</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="<?php echo e($settings['address_1']); ?>"  name="address_1" type="text"
                                                           class="form-control">
                                                    <label class="form-label">Address Line 1</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="<?php echo e($settings['address_2']); ?>"  name="address_2" type="text"
                                                           class="form-control">
                                                    <label class="form-label">Address Line 2</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="<?php echo e($settings['city']); ?>"  name="city" type="text"
                                                           class="form-control">
                                                    <label class="form-label">City</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="<?php echo e($settings['state']); ?>"  name="state" type="text"
                                                           class="form-control">
                                                    <label class="form-label">State</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="<?php echo e($settings['zip_code']); ?>"  name="zip_code" type="text"
                                                           class="form-control">
                                                    <label class="form-label">Zip Code</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group ">
                                                <div class="form-line">
                                                    <input name="company_logo" type="file" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <img class="width-50 height-50"
                                                 src="<?php echo e(asset($settings['company_logo'])); ?> " alt="">
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-line">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                    <?php echo e(__('root.common.update')); ?>

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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/admin/settings/general.blade.php ENDPATH**/ ?>