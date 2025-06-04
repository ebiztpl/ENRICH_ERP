

<?php

$moduleName = __('root.ledger_name.ledger_name_manage');
$createItemName = __('root.common.edit') .' '. $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = ' ' . __('root.common.edit');

$breadcrumbMainIcon = 'fas fa-file-invoice-dollar';
$breadcrumbCurrentIcon = 'archive';

$ModelName = 'App\IncomeExpenseHead';
$ParentRouteName = 'income_expense_head';

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
                <a class="btn btn-sm btn-info waves-effect"
                    href="<?php echo e(route($ParentRouteName)); ?>"><?php echo e(__('root.common.all')); ?></a>
            </div>
            <ol class="breadcrumb breadcrumb-col-cyan <?php if($is_rtl): ?> pull-left  <?php else: ?> pull-right <?php endif; ?>">
                <li><a href="<?php echo e(route($ParentRouteName)); ?>"><i class="material-icons">home</i>
                        <?php echo e(__('root.common.home')); ?></a></li>
                <li><a href="<?php echo e(route($ParentRouteName)); ?>"><i class="<?php echo e($breadcrumbMainIcon); ?>"></i>
                        &nbsp;<?php echo e($breadcrumbMainName); ?></a>
                </li>
                <li class="active"><i class="material-icons"><?php echo e($breadcrumbCurrentIcon); ?></i>&nbsp;
                    <?php echo e($breadcrumbCurrentName); ?>

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
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control  show-tick"
                                                        name="income_expense_type_id" id="income_expense_type_id">
                                                        <option value="0">Select Income/Expense Head Type</option>
                                                        <?php $__currentLoopData = $income_expense_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $income_expense_type_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if($income_expense_type_id->id == $item->income_expense_type_id): ?> selected <?php endif; ?>
                                                                value="<?php echo e($income_expense_type_id->id); ?>">
                                                                <?php echo e($income_expense_type_id->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control  show-tick"
                                                        name="income_expense_group_id" id="income_expense_group_id">
                                                        <option value="0">Select Ledger Group</option>
                                                        <?php $__currentLoopData = $income_expense_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $IncomeExpenseGroups): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if($IncomeExpenseGroups->id == $item->income_expense_group_id): ?> selected <?php endif; ?>
                                                                value="<?php echo e($IncomeExpenseGroups->id); ?>" data-id="<?php echo e($IncomeExpenseGroups->income_expense_type); ?>">
                                                                <?php echo e($IncomeExpenseGroups->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="<?php echo e($item->unit); ?>" name="unit" type="text"
                                                        class="form-control">
                                                    <label class="form-label">Unit</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group form-float">
                                                <span>Type</span> &nbsp;&nbsp;
                                                <input value="1" name="type" type="radio" id="radio_1"
                                                    class="with-gap radio-col-cyan"
                                                    <?php if($item->type == '1'): ?> checked <?php endif; ?> />
                                                <label for="radio_1">Dr</label>
                                                <input value="0" name="type" type="radio" id="radio_2"
                                                    class="with-gap radio-col-cyan"
                                                    <?php if($item->type == '0'): ?> checked <?php endif; ?> />
                                                <label for="radio_2">Cr</label>
                                            </div>
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
    <!-- Bootstrap Select Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-select/css/bootstrap-select.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startPush('include-js'); ?>
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
                income_expense_type_id: 'select[name=income_expense_type_id]',
                income_expense_group_id: 'select[name=income_expense_group_id]',
            };
            return {
                getDOMString: function() {
                    return DOMString;
                },
                getFields: function() {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),
                        get_name: document.querySelector(DOMString.name),
                        get_income_expense_type_id: document.querySelector(DOMString.income_expense_type_id),
                        get_income_expense_group_id: document.querySelector(DOMString.income_expense_group_id),
                    }
                },
                getInputsValue: function() {
                    var Fields = this.getFields();
                    return {
                        name: Fields.get_name.value == "" ? 0 : Fields.get_name.value,
                        income_expense_type_id: Fields.get_income_expense_type_id.value == "" ? 0 : parseFloat(
                            Fields.get_income_expense_type_id.value),
                        income_expense_group_id: Fields.get_income_expense_group_id.value == "" ? 0 :
                            parseFloat(Fields.get_income_expense_group_id.value),
                    }
                },
            }
        })();
        var MainController = (function(UICnt) {
            var DOMString = UICnt.getDOMString();
            var Fields = UICnt.getFields();
            var setUpEventListner = function() {
                Fields.get_form.addEventListener('submit', validation);
            };
            var validation = function(e) {
                var input_values, Fields;
                input_values = UICnt.getInputsValue();
                Fields = UICnt.getFields();
                var FieldName1 = " Name";
                if (input_values.income_expense_group_id == 0) {
                    toastr["error"]('Select Ledger Group');
                    e.preventDefault();
                }
                if (input_values.income_expense_type_id == 0) {
                    toastr["error"]('Select Ledger Type');
                    e.preventDefault();
                }
                if (input_values.name == 0) {
                    toastr["error"]('Name is required');
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
        <script>
$(document).ready(function(){
    $prev = $('#income_expense_type_id').val();
    $('#income_expense_group_id option[data-id!="'+$prev+'"]').hide();
    $('#income_expense_group_id option[value="0"]').show();
    $('#income_expense_group_id').selectpicker('refresh');
});

          $(document).on('change', '#income_expense_type_id', function() {

            $val = $(this).val();
           
            $('#income_expense_group_id option').each(function() {
    $(this).prop('selected', false);
})

if($val != 0){



    $('#income_expense_group_id option[data-id!="'+$val+'"]').hide();
    $('#income_expense_group_id option[data-id="'+$val+'"]').show();
    $('#income_expense_group_id option[value="0"]').show();
    $('#income_expense_group_id').selectpicker('refresh');

    
}else{

    $('#income_expense_group_id option[value="0"]').show();
    $('#income_expense_group_id').selectpicker('refresh');
}






      
         });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/admin/income-expense-head/edit.blade.php ENDPATH**/ ?>