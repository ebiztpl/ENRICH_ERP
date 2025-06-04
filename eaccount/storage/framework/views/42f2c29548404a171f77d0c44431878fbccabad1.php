

<?php

$moduleName = 'Session Budget';
$createItemName = 'Edit'.' '. $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = __('root.common.create');

$breadcrumbMainIcon = 'fas fa-file-invoice-dollar';
$breadcrumbCurrentIcon = 'archive';

$ModelName = 'App\Expense';
$ParentRouteName = 'bill_recieved';

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
    <section <?php if($is_rtl): ?> dir="rtl" <?php endif; ?> class="content">
        <div class="container-fluid">
            <!-- <div class="block-header <?php if($is_rtl): ?> pull-right <?php else: ?> pull-left <?php endif; ?>">
                <a class="btn btn-sm btn-info waves-effect" href="<?php echo e(url()->previous()); ?>"><?php echo e(__('root.common.back')); ?></a>
            </div> -->
            <ol class="breadcrumb breadcrumb-col-cyan <?php if($is_rtl): ?> pull-left  <?php else: ?> pull-right <?php endif; ?>">
                <li><a href="<?php echo e(route('dashboard')); ?>"><i class="material-icons">home</i>
                        <?php echo e(__('root.common.home')); ?></a></li>
                <li><a href="<?php echo e(route('session_budget_list')); ?>"><i class="<?php echo e($breadcrumbMainIcon); ?>"></i>
                        &nbsp;<?php echo e($breadcrumbMainName); ?></a>
                </li>
                <li class="active"><i class="material-icons"><?php echo e($breadcrumbCurrentIcon); ?></i>&nbsp;
                    Edit
                </li>
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
                                    action="<?php echo e(route($ParentRouteName . '.session_update', ['id' => $edit->id])); ?>" enctype="multipart/form-data" >
                                    <?php echo e(csrf_field()); ?>

                                    <div class="row">

                                    <div class="col-md-3">
                                    <div class="form-group">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                        name="session" id="session" >
                                                        <option value="">Select Session</option>
                                                        <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if($session->id == $edit->session): ?> selected <?php endif; ?>
                                                                value="<?php echo e($session->id); ?>"><?php echo e($session->session); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            </div>



                                            <div class="col-md-3">
                                    <div class="form-group">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                        name="type" id="ledger_type" >
                                                        <option value="">Select Ledger Type</option>
                                                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if($type->id == $edit->ledger_type): ?> selected <?php endif; ?>
                                                                value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            </div>

                                            <div class="col-md-3">
                                    <div class="form-group">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                        name="group" id="ledger_group" >
                                                        <option value="">Select Ledger Group</option>
                                                        <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if($group->id == $edit->ledger_group): ?> selected <?php endif; ?>
                                                                value="<?php echo e($group->id); ?>" data-id="<?php echo e($group->income_expense_type); ?>"><?php echo e($group->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            </div>


                                            <div class="col-md-3">
                                    <div class="form-group">
                                                <div class="form-line">
                                                <input autofocus="" value="<?php echo e($edit->budget_amount); ?>" name="budget_amount" type="text" id="budget_amount" class="form-control">
                                                <label class="form-label">Budget Amount</label>
                                                </div>
                                            </div>
                                            </div>

                                            <div class="col-md-12">
                                    <div class="form-group">
                                                <div class="form-line">
                                                <label class="form-label">Description</label>
                                            <textarea class="form-control no-resize" name="description" rows="1"><?php echo e($edit->description); ?></textarea>

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
    <!-- Bootstrap Select Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-select/css/bootstrap-select.css')); ?>" rel="stylesheet" />
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')); ?>"
        rel="stylesheet" />
    <!-- Bootstrap DatePicker Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')); ?>" rel="stylesheet" />
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
                type: 'input[name=type]',
            };
            return {
                getDOMString: function() {
                    return DOMString;
                },
                getFields: function() {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),
                        get_name: document.querySelector(DOMString.name),
                        get_type: document.querySelector(DOMString.type),
                        get_code: document.querySelector(DOMString.code),
                    }
                },
                getInputsValue: function() {
                    var Fields = this.getFields();
                    return {
                        name: Fields.get_name.value == "" ? 0 : Fields.get_name.value,
                        type: Fields.get_type.value == "" ? 0 : Fields.get_type.value,
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
                if (input_values.name == 0) {
                    toastr["error"]('Ledger Group Name Is Required');
                    e.preventDefault();
                }
                if(input_values.type == 0){
                    toastr["error"]('Ledger Group Type Is Required');
                }
            };
            return {
                init: function() {
                    setUpEventListner();
                }
            }

        })(UiController);
        MainController.init();
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



<script>
          $(document).on('change', '#ledger_type', function() {
            $val = $(this).val();      
            $('#ledger_group option').each(function() {
    $(this).prop('selected', false);
})
if($val != ''){
    $('#ledger_group option[data-id!="'+$val+'"]').hide();
    $('#ledger_group option[data-id="'+$val+'"]').show();
    $('#ledger_group option[value=""]').show();
    $('#ledger_group').selectpicker('refresh');
}else{

    $('#ledger_group option[value=""]').show();
    $('#ledger_group').selectpicker('refresh');
}
      
         });




$(document).ready(function(){
    $val = '<?php echo e($edit->ledger_type); ?>';      

if($val != ''){
    $('#ledger_group option[data-id!="'+$val+'"]').hide();
    $('#ledger_group option[data-id="'+$val+'"]').show();
    $('#ledger_group option[value=""]').show();
    $('#ledger_group').selectpicker('refresh');
}else{

    $('#ledger_group option[value=""]').show();
    $('#ledger_group').selectpicker('refresh');
}
});
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/admin/session_budget/edit.blade.php ENDPATH**/ ?>