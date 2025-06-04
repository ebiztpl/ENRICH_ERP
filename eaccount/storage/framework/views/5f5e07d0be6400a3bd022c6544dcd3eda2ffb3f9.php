



<?php

$moduleName = " Ledger Type";
$createItemName = __('root.common.create') . ' ' . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = __('root.common.create');

$breadcrumbMainIcon = "fas fa-file-invoice-dollar";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\IncomeExpenseType';
$ParentRouteName = 'income_expense_type';




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
                                <?php echo e($createItemName); ?>

                                <small>Put <?php echo e($moduleName); ?> Information</small>
                            </h2>

                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                      action="<?php echo e(route($ParentRouteName.'.store')); ?>">

                                    <?php echo e(csrf_field()); ?>

                                    <div class="row clearfix">

                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input autofocus value="<?php echo e(old('name')); ?>" name="name" type="text"
                                                           class="form-control">
                                                    <label class="form-label">Name</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="<?php echo e(old('code')); ?>" name="code" type="number"
                                                           class="form-control">
                                                    <label class="form-label">Code</label>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-line">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                    <?php echo e(__('root.common.save')); ?>

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



        // Validation and calculation
        var UiController = (function () {

            var DOMString = {
                submit_form: 'form.form',
                name: 'input[name=name]',
                code: 'input[name=code]',
            };

            return {
                getDOMString: function () {
                    return DOMString;
                },
                getFields: function () {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),
                        get_name: document.querySelector(DOMString.name),
                        get_code: document.querySelector(DOMString.code),


                    }
                },
                getInputsValue: function () {
                    var Fields = this.getFields();
                    return {

                        name: Fields.get_name.value == "" ? 0 : Fields.get_name.value,
                        code: Fields.get_code.value == "" ? 0 : Fields.get_code.value,


                    }
                },

            }
        })();

        var MainController = (function (UICnt) {

            var DOMString = UICnt.getDOMString();
            var Fields = UICnt.getFields();

            var setUpEventListner = function () {

                 Fields.get_form.addEventListener('submit', validation);

            };

            var validation = function (e) {
                var input_values, Fields;
                input_values = UICnt.getInputsValue();
                Fields = UICnt.getFields();

                var FieldName1 = " Name";


                if (input_values.name == 0) {
                    toastr["error"]('Ledger Type Name Is Required');
                    e.preventDefault();
                }

                if (input_values.code == 0) {
                    toastr["error"]('Ledger Type Code Is Required');
                    e.preventDefault();
                }



            };

            return {
                init: function () {
                    console.log("App Is running");
                    setUpEventListner();

                }
            }

        })(UiController);

        MainController.init();


    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/admin/income-expense-type/create.blade.php ENDPATH**/ ?>