

<?php

$moduleName = __('root.contra_voucher.contra_voucher_manage');
$createItemName = __('root.common.create') . ' ' . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = __('root.common.create');

$breadcrumbMainIcon = 'account_balance_wallet';
$breadcrumbCurrentIcon = 'archive';

$ModelName = 'App\Transaction';
$ParentRouteName = 'contra_voucher';

$voucher_type = 'Contra';

$all = config('role_manage.ContraVoucher.All');

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
                <?php if($all == 1): ?>
                    <a class="btn btn-sm btn-info waves-effect"
                        href="<?php echo e(route($ParentRouteName)); ?>"><?php echo e(__('root.common.all')); ?></a>
                <?php endif; ?>
            </div>
            <ol class="breadcrumb breadcrumb-col-cyan <?php if($is_rtl): ?> pull-left  <?php else: ?> pull-right <?php endif; ?>">
                <li><a href="<?php echo e(route('dashboard')); ?>"><i class="material-icons">home</i> <?php echo e(__('root.common.home')); ?></a>
                </li>
                <li><a href="<?php echo e(route($ParentRouteName)); ?>"><i
                            class="material-icons"><?php echo e($breadcrumbMainIcon); ?></i>&nbsp;<?php echo e($breadcrumbMainName); ?></a>
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
                            <h2 class="m-b-20">
                                <?php echo e($createItemName); ?>

                                <small>Put <?php echo e($moduleName); ?> Information</small>
                            </h2>
                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                    action="<?php echo e(route($ParentRouteName . '.store')); ?>">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="row clearfix">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                        name="branch_id">
                                                        <option value="0">Select Branch Name</option>
                                                        <?php $__currentLoopData = $branches->sortByDesc('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if($project->id == old('branch_id')): ?> selected <?php endif; ?>
                                                                value="<?php echo e($project->id); ?>"><?php echo e($project->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                        name="bank_cash_id" id="">
                                                        <option value="0"> Select Bank Cash Name ( Dr )</option>
                                                        <?php $__currentLoopData = $bank_cashes->sortByDesc('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank_cash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if($bank_cash->id == old('bank_cash_id')): ?> selected <?php endif; ?>
                                                                value="<?php echo e($bank_cash->id); ?>"><?php echo e($bank_cash->name); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input name="cheque_number" type="text" class="form-control">
                                                    <label class="form-label">Cheque Number</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row dr">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                        name="bank_cash_id_cr" id="">
                                                        <option value="0"> Select Bank Cash Name ( Cr )</option>
                                                        <?php $__currentLoopData = $bank_cashes->sortByDesc('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank_cash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if($bank_cash->id == old('bank_cash_id_cr')): ?> selected <?php endif; ?>
                                                                value="<?php echo e($bank_cash->id); ?>"><?php echo e($bank_cash->name); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input name="amount" type="number" class="form-control amount">
                                                    <label class="form-label"> Amount </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line" id="bs_datepicker_container">
                                                    <input autocomplete="off" value="<?php echo e(old('voucher_date')); ?>"
                                                        name="voucher_date" type="text" class="form-control"
                                                        placeholder="Please choose a date...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 field_area">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <textarea name="particulars" rows="2" class="form-control no-resize" placeholder="Particulars"><?php echo e(old('particulars')); ?></textarea>
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
        // Validation and calculation on Cr Voucher
        var UiController = (function() {
            var DOMString = {
                submit_form: 'form.form',
                field_area: '.field_area',
                project_id: 'select[name=branch_id]',
                bankcash_id: 'select[name=bank_cash_id]',
                bankcash_id_cr: 'select[name=bank_cash_id_cr]',
                cheque_number: 'input[name=cheque_number]',
                amount: 'input[name=amount]',
                date: 'input[name=voucher_date]',
                particulars: 'textarea[name=particulars]',
                drCloset: '.dr',
            };
            return {
                getDOMString: function() {
                    return DOMString;
                },
                getFields: function() {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),
                        get_project_id: document.querySelector(DOMString.project_id),
                        get_bankcash_id: document.querySelector(DOMString.bankcash_id),
                        get_bankcash_id_cr: document.querySelector(DOMString.bankcash_id_cr),
                        get_cheque_number: document.querySelector(DOMString.cheque_number),
                        get_amount: document.querySelector(DOMString.amount),
                        get_date: document.querySelector(DOMString.date),
                        get_particulars: document.querySelector(DOMString.particulars),
                    }
                },
                getValues: function() {
                    var Fields = this.getFields();
                    return {
                        project_id: Fields.get_project_id.value == "" ? 0 : parseFloat(Fields.get_project_id
                            .value),
                        bankcash_id: Fields.get_bankcash_id.value == "" ? 0 : parseFloat(Fields.get_bankcash_id
                            .value),
                        bankcash_id_cr: Fields.get_bankcash_id_cr.value == "" ? 0 : parseFloat(Fields
                            .get_bankcash_id_cr.value),
                        cheque_number: Fields.get_cheque_number.value == "" ? 0 : parseFloat(Fields
                            .get_cheque_number.value),
                        amount: Fields.get_amount.value == "" ? 0 : parseFloat(Fields.get_amount.value),
                        date: Fields.get_date.value == "" ? 0 : Fields.get_date.value,
                        particulars: Fields.get_particulars.value == "" ? 0 : Fields.get_particulars.value,
                    }
                },

                hide: function(Field) {
                    var DomString = this.getDOMString();
                    var Area = Field.closest(DomString.field_area);
                    if (Area) {
                        Area.style.display = 'none';
                    }
                },
                show: function(Field) {
                    var DomString = this.getDOMString();
                    var Area = Field.closest(DomString.field_area);
                    if (Area) {
                        Field.value = 0;
                        Area.style.display = 'block';
                    }
                },
            }
        })();
        var MainController = (function(UICnt) {
            var DOMString = UICnt.getDOMString();
            var Fields = UICnt.getFields();
            var Values;
            Values = UICnt.getValues();
            var setUpEventListner = function() {
                Fields.get_form.addEventListener('submit', validation);
                Fields.get_bankcash_id.addEventListener('change', function() {
                    bankcashChange(this.value);
                });
                Fields.get_bankcash_id_cr.addEventListener('change', function() {
                    bankcashChange(this.value);
                });
            };
            var validation = function(e) {
                var Values, Fields;
                Values = UICnt.getValues();
                Fields = UICnt.getFields();
                if (Values.project_id == 0) {
                    toastr["error"]('Select  branch name');
                    e.preventDefault();
                }
                if (Values.bankcash_id == 0) {
                    toastr["error"]('Select Bank Cash Name ( Dr )');
                    e.preventDefault();
                }
                if (Values.bankcash_id_cr == 0) {
                    toastr["error"]('Select Bank Cash Name ( Cr )');
                    e.preventDefault();
                }
                if (Values.bankcash_id == Values.bankcash_id_cr && Values.bankcash_id != 0 && Values
                    .bankcash_id_cr != 0) {
                    toastr["error"]('Bank Cash ( Dr ) and Bank Cash ( Cr ) should not same');
                    e.preventDefault();
                }
                if (Values.amount == 0) {
                    toastr["error"]('Amount is required');
                    e.preventDefault();
                }
                if (Values.date == 0) {
                    toastr["error"]('Date is required');
                    e.preventDefault();
                }
            };
            var bankcashChange = function(bankcashID) {
                var DomString = UICnt.getDOMString();
                var Area = Fields.get_cheque_number.closest(DomString.field_area);
                if (Area.style.display == 'none') {
                    if (bankcashID <= 1) {
                        UICnt.hide(Fields.get_cheque_number);
                    } else {
                        UICnt.show(Fields.get_cheque_number);
                    }
                }
            };
            return {
                init: function() {
                    console.log("App Is running");
                    setUpEventListner();
                    // Default hide fields
                    var Fields = UICnt.getFields();
                    UICnt.hide(Fields.get_cheque_number);
                }
            }

        })(UiController);
        MainController.init();
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/admin/cnt-voucher/create.blade.php ENDPATH**/ ?>