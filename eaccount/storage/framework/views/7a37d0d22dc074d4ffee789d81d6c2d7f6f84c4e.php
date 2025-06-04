



<?php
$moduleName = " Role Manage";
$createItemName = "Show" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = "show";

$breadcrumbMainIcon = "fas fa-user-lock";
$breadcrumbCurrentIcon = "archive";


$ModelName = 'App\RoleManage';

$ParentRouteName = 'role-manage';

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
                                class="<?php echo e($breadcrumbMainIcon); ?>"></i> &nbsp;<?php echo e($breadcrumbMainName); ?></a>
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
                                <?php echo e($items->name); ?>

                                <small>Details <?php echo e($items->name); ?> Information</small>
                            </h2>

                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                      action="<?php echo e(route($ParentRouteName.'.store')); ?>">

                                    <?php echo e(csrf_field()); ?>

                                    <div class="row clearfix">


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table class="table  table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th scope="col" class="text-center">S.L</th>
                                                    <th scope="col" class="text-center">Module Name</th>
                                                    <th scope="col" class="text-center">Module Show</th>
                                                    <th scope="col" class="text-center">Show</th>
                                                    <th scope="col" class="text-center">Create</th>
                                                    <th scope="col" class="text-center">Edit</th>
                                                    <th scope="col" class="text-center">Delete</th>
                                                    <th scope="col" class="text-center">PDF</th>
                                                    <th scope="col" class="text-center">Trash Show</th>
                                                    <th scope="col" class="text-center">Restore</th>
                                                    <th scope="col" class="text-center">Permanently Delete</th>
                                                </tr>
                                                </thead>
                                                <tbody>


                                                <?php if($items->content): ?>
                                                    <?php $sl=1; ?>
                                                    <?php $__currentLoopData = $items->content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemKey=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <th scope="row" class="text-center"><?php echo e($sl); ?></th>

                                                            <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <td class="text-center">
                                                                    <?php if($key==0): ?>
                                                                        <?php echo e($value); ?>

                                                                    <?php elseif($value==1): ?>
                                                                        <i class="fas fa-check text-success"></i>
                                                                    <?php else: ?>
                                                                        <i class="fas fa-times text-danger"></i>
                                                                    <?php endif; ?>
                                                                </td>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </tr>
                                                        <?php $sl++; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                <?php else: ?>
                                                    <tr>
                                                        <th class="text-danger">No Item Available</th>
                                                    </tr>
                                                <?php endif; ?>

                                                </tbody>
                                            </table>

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



<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/admin/role-manage/show.blade.php ENDPATH**/ ?>