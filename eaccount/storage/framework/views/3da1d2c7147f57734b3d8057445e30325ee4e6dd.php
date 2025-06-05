



<?php
$moduleName = __('root.role_manage.role_manage');
$createItemName = __('root.common.edit') .' '. $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = __('root.common.edit').' ';

$breadcrumbMainIcon = 'fas fa-user-lock';
$breadcrumbCurrentIcon = 'archive';

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
                <li class="active"><i class="material-icons"><?php echo e($breadcrumbCurrentIcon); ?></i>&nbsp; <?php echo e($breadcrumbCurrentName); ?>

                </li>
            </ol>
            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php echo e($createItemName); ?>

                                <small>Edit <?php echo e($moduleName); ?> Information</small>
                            </h2>
                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                    action="<?php echo e(route($ParentRouteName . '.update', ['id' => $item->id])); ?>">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="row clearfix">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="<?php echo e($item->name); ?>" name="name" type="text"
                                                        class="form-control">
                                                    <label class="form-label">Name</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table class="table  table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="checkbox_custom_style text-center">
                                                            <input name="selectTop" type="checkbox" id="md_checkbox_p"
                                                                class="chk-col-cyan topBottom" />
                                                            <label for="md_checkbox_p"></label>
                                                        </th>
                                                        <th scope="col" class="text-center">Module Name</th>
                                                        <th scope="col" class="text-center">All</th>
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
                                                    <?php if($item->content): ?>
                                                        <?php $sl = 1; ?>
                                                        <?php $__currentLoopData = $item->content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $contents): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <th class="text-center">
                                                                    <input type="checkbox"
                                                                        id="md_checkbox_<?php echo e($sl); ?>"
                                                                        class="chk-col-cyan selects " />
                                                                    <label for="md_checkbox_<?php echo e($sl); ?>"></label>
                                                                </th>
                                                                </th>
                                                                <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key_content => $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <td class="text-center">
                                                                        <?php if($key_content == 0): ?>
                                                                            <input value="<?php echo e($content); ?>"
                                                                                type="hidden"
                                                                                name="details[<?php echo e($key); ?>][<?php echo e($key_content); ?>]">
                                                                            <?php echo e($content); ?>

                                                                        <?php elseif($content == 1): ?>
                                                                            <div class="switch">
                                                                                <label>
                                                                                    <input checked
                                                                                        name="details[<?php echo e($key); ?>][<?php echo e($key_content); ?>]"
                                                                                        type="checkbox"><span
                                                                                        class="lever switch-col-cyan"></span>
                                                                                </label>
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <div class="switch">
                                                                                <label>
                                                                                    <input
                                                                                        name="details[<?php echo e($key); ?>][<?php echo e($key_content); ?>]"
                                                                                        type="checkbox"><span
                                                                                        class="lever switch-col-cyan"></span>
                                                                                </label>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </tr>
                                                            <?php $sl++; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
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
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('include-css'); ?>
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



    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')); ?>"
        rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')); ?>" rel="stylesheet" />


    <!-- noUISlider Css -->
    <link href="<?php echo e(asset('asset/plugins/nouislider/nouislider.min.css')); ?>" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="<?php echo e(asset('asset/plugins/sweetalert/sweetalert.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startPush('include-js'); ?>
    <!-- Moment Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/momentjs/moment.js')); ?>"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')); ?>">
    </script>

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
        var UiController = (function() {

            var DOMString = {
                submit_form: 'form.form',
                name: 'input[name=name]',
                selects: '.selects',
                topBottom: '.topBottom',
            };

            return {
                getDOMString: function() {
                    return DOMString;
                },
                getFields: function() {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),
                        get_name: document.querySelector(DOMString.name),
                        getSelects: document.querySelectorAll(DOMString.selects),
                        getTopBottom: document.querySelectorAll(DOMString.topBottom),

                    }
                },
                getInputsValue: function() {
                    var Fields = this.getFields();
                    return {
                        name: Fields.get_name.value == "" ? 0 : Fields.get_name.value,
                    }
                },

            }
        })();

        var MainController = (function(UICnt) {

            var DOMString = UICnt.getDOMString();
            var Fields = UICnt.getFields();

            var setUpEventListner = function() {

                Fields.get_form.addEventListener('submit', validation);

                for (var i = 0; i < Fields.getSelects.length; i++) {
                    Fields.getSelects[i].addEventListener('click', checkAllAction);
                }

                for (var i = 0; i < Fields.getTopBottom.length; i++) {
                    Fields.getTopBottom[i].addEventListener('click', topBottom);
                }
            };

            var checkedAllItems = function() {

                for (var i = 0; i < Fields.getSelects.length; i++) {
                    var tr = Fields.getSelects[i].closest('tr');
                    var checkBox = tr.querySelectorAll('input[type=checkbox]');
                    checkBox[0].checked = true;
                    checkBox[1].checked = true;
                    checkBox[2].checked = true;
                    checkBox[3].checked = true;
                    checkBox[4].checked = true;
                    checkBox[5].checked = true;
                    checkBox[6].checked = true;
                    checkBox[7].checked = true;
                    checkBox[8].checked = true;
                    checkBox[9].checked = true;
                }
                checkedUncheckedTopBottom(true);
            };

            var unCheckedAllItems = function() {
                for (var i = 0; i < Fields.getSelects.length; i++) {
                    var tr = Fields.getSelects[i].closest('tr');
                    var checkBox = tr.querySelectorAll('input[type=checkbox]');
                    checkBox[0].checked = false;
                    checkBox[1].checked = false;
                    checkBox[2].checked = false;
                    checkBox[3].checked = false;
                    checkBox[4].checked = false;
                    checkBox[5].checked = false;
                    checkBox[6].checked = false;
                    checkBox[7].checked = false;
                    checkBox[8].checked = false;
                    checkBox[9].checked = false;
                }
                checkedUncheckedTopBottom(false);
            };

            var checkedUncheckedTopBottom = function(flag) {
                if (flag == true) {
                    Fields.getTopBottom[0].checked = true;
                } else {
                    Fields.getTopBottom[0].checked = false;
                }
            };


            var topBottom = function(e) {
                if (e.target.checked) {
                    checkedAllItems();

                } else {
                    unCheckedAllItems();

                }
            };

            var checkAllModuleOrNot = function() {

                // Check all module  or check not
                var checkedNo = 0;
                for (var i = 0; i < Fields.getSelects.length; i++) {
                    if (Fields.getSelects[i].checked == true) {
                        checkedNo++;
                    }
                }
                if (Fields.getSelects.length == checkedNo) {
                    checkedUncheckedTopBottom(true);
                } else {
                    checkedUncheckedTopBottom(false);
                }

            };

            var checkAllAction = function(e) {

                var tr = e.target.closest('tr');
                var checkBox = tr.querySelectorAll('input[type=checkbox]');
                if (e.target.checked) {
                    for (var i = 0; i < checkBox.length; i++) {
                        checkBox[i].checked = true;
                    }
                } else {
                    for (var i = 0; i < checkBox.length; i++) {
                        checkBox[i].checked = false;
                    }
                }
                // Check all module  or check not
                checkAllModuleOrNot();

            };

            var validation = function(e) {
                var input_values, Fields;
                input_values = UICnt.getInputsValue();
                Fields = UICnt.getFields();

                var FieldName1 = " Name";


                if (input_values.name == 0) {
                    toastr["error"]('Set Any' + FieldName1);
                    e.preventDefault();
                }


            };

            return {
                init: function() {
                    console.log("App Is running");
                    setUpEventListner();

                }
            }

        })(UiController);

        MainController.init();
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\madhaverp_13_11\eaccount\resources\views/admin/role-manage/edit.blade.php ENDPATH**/ ?>