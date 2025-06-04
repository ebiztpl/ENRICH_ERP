

<?php

$moduleName = __('root.ledger_name.ledger_name_manage');
$createItemName = __('root.common.create') .' '. $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = ' ' . __('root.common.all');

$breadcrumbMainIcon = 'fas fa-file-invoice-dollar';
$breadcrumbCurrentIcon = 'archive';

$ModelName = 'App\IncomeExpenseHead';
$ParentRouteName = 'income_expense_head';

$all = config('role_manage.LedgerName.All');
$create = config('role_manage.LedgerName.Create');
$delete = config('role_manage.LedgerName.Delete');
$edit = config('role_manage.LedgerName.Edit');
$pdf = config('role_manage.LedgerName.Pdf');
$permanently_delete = config('role_manage.LedgerName.PermanentlyDelete');
$restore = config('role_manage.LedgerName.Restore');
$show = config('role_manage.LedgerName.Show');
$trash_show = config('role_manage.LedgerName.TrashShow');

?>

<?php $__env->startSection('title'); ?>
    <?php echo e($moduleName); ?> -> <?php echo e($breadcrumbCurrentName); ?>

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
                <a <?php if($create == 0): ?> class="dis-none" <?php endif; ?> class="btn btn-sm btn-info waves-effect"
                    href="<?php echo e(route($ParentRouteName . '.create')); ?>"><?php echo e(__('root.common.create')); ?></a>
            </div>
            <ol class="breadcrumb breadcrumb-col-cyan <?php if($is_rtl): ?> pull-left  <?php else: ?> pull-right <?php endif; ?>">
                <li><a href="<?php echo e(route('dashboard')); ?>"><i class="material-icons">home</i> <?php echo e(__('root.common.home')); ?></a>
                </li>
                <li><a href="<?php echo e(route($ParentRouteName)); ?>"><i class="<?php echo e($breadcrumbMainIcon); ?>"></i>
                        &nbsp;<?php echo e($breadcrumbMainName); ?></a></li>
                <li class="active"><i
                        class="material-icons"><?php echo e($breadcrumbCurrentIcon); ?></i>&nbsp;<?php echo e($breadcrumbCurrentName); ?>

                </li>
            </ol>
            <!-- Hover Rows -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <a class="btn btn-xs btn-info waves-effect"
                                href="<?php echo e(route($ParentRouteName)); ?>"><?php echo e(__('root.common.all')); ?>(<?php echo e($items->count()); ?>)</a>
                            <a <?php if($trash_show == 0): ?> class="dis-none" <?php endif; ?>
                                class="btn btn-xs btn-danger waves-effect text-black"
                                href="<?php echo e(route($ParentRouteName)); ?>"><?php echo e(__('root.common.trash')); ?>(<?php echo e($total_trashed_income_expense_heads); ?>

                                )</a>
                            <ul class="header-dropdown m-r--5">
                                <form class="search" action="<?php echo e(route($ParentRouteName . '.active.search')); ?>"
                                    method="get">
                                    <?php echo e(csrf_field()); ?>

                                    <input autofocus type="search" name="search" class="form-control input-sm "
                                        placeholder="<?php echo e(__('root.common.search')); ?>" />
                                </form>
                            </ul>
                        </div>
                        <form class="actionForm" action="<?php echo e(route($ParentRouteName . '.active.action')); ?>" method="get">
                            <div class="pagination-and-action-area body">
                                <div>
                                    <div class="select-and-apply-area">
                                        <div class="form-group width-300">
                                            <div class="form-line">
                                                <select class="form-control" name="apply_comand_top" id="">
                                                    <option value="0"><?php echo e(__('root.common.select_action')); ?></option>
                                                    <?php if($delete): ?>
                                                        <option value="3"><?php echo e(__('root.common.move_to_trash')); ?>

                                                        </option>
                                                    <?php endif; ?>
                                                    <?php if($permanently_delete): ?>
                                                        <option value="2"><?php echo e(__('root.common.permanently_delete')); ?>

                                                        </option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input class="btn btn-sm btn-info waves-effect" type="submit"
                                                value="<?php echo e(__('root.common.apply')); ?>" name="ApplyTop">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="custom-paginate">
                                        <?php echo e($items->links()); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="body table-responsive">
                                <?php echo e(csrf_field()); ?>

                                <?php if(count($items) > 0): ?>
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th class="checkbox_custom_style text-center">
                                                    <input name="selectTop" type="checkbox" id="md_checkbox_p"
                                                        class="chk-col-cyan" />
                                                    <label for="md_checkbox_p"></label>
                                                </th>
                                                <th><?php echo e(__('root.ledger_name.name')); ?></th>
                                                <th><?php echo e(__('root.ledger_name.ledger_type_name')); ?></th>
                                                <th><?php echo e(__('root.ledger_name.ledger_group_name')); ?></th>
                                                <th><?php echo e(__('root.ledger_name.unit')); ?></th>
                                                <th><?php echo e(__('root.ledger_name.dr')); ?></th>
                                                <th><?php echo e(__('root.ledger_name.options')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <th class="text-center">
                                                        <input name="items[id][]" value="<?php echo e($item->id); ?>"
                                                            type="checkbox" id="md_checkbox_<?php echo e($i); ?>"
                                                            class="chk-col-cyan selects " />
                                                        <label for="md_checkbox_<?php echo e($i); ?>"></label>
                                                    </th>
                                                    <td><?php echo e($item->name); ?></td>
                                                    <td><?php echo e($item->IncomeExpenseType ? $item->IncomeExpenseType->name : ''); ?>

                                                    </td>
                                                    <td><?php echo e($item->IncomeExpenseGroup ? $item->IncomeExpenseGroup->name : ''); ?>

                                                    </td>
                                                    <td><?php echo e($item->unit); ?></td>
                                                    <?php if($item->type == '1'): ?>
                                                        <td>
                                                            <i class="fas fa-check text-success"></i>
                                                        </td>
                                                    <?php else: ?>
                                                        <td>
                                                            <i class="fas fa-times text-danger"></i>
                                                        </td>
                                                    <?php endif; ?>
                                                    <td class="tdTrashAction">
                                                        <a <?php if($edit == 0): ?> class="dis-none" <?php endif; ?>
                                                            class="btn btn-xs btn-info waves-effect"
                                                            href="<?php echo e(route($ParentRouteName . '.edit', ['id' => $item->id])); ?>"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="<?php echo e(__('root.common.edit')); ?>"><i
                                                                class="material-icons">mode_edit</i></a>
                                                        <a <?php if($show == 0): ?> class="dis-none" <?php endif; ?>
                                                            target="_blank" data-target="#largeModal"
                                                            class="btn btn-xs btn-success waves-effect ajaxCall dis-none"
                                                            href="<?php echo e(route($ParentRouteName . '.show', ['id' => $item->id])); ?>"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="<?php echo e(__('root.common.preview')); ?>"><i
                                                                class="material-icons">pageview</i></a>
                                                        <a <?php if($delete == 0): ?> class="dis-none" <?php endif; ?>
                                                            class="btn btn-xs btn-danger waves-effect"
                                                            href="<?php echo e(route($ParentRouteName . '.destroy', ['id' => $item->id])); ?>"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="<?php echo e(__('root.common.trash')); ?>"> <i
                                                                class="material-icons">delete</i></a>
                                                        <a <?php if($pdf == 0): ?> class="dis-none" <?php endif; ?>
                                                            class="btn btn-xs btn-warning waves-effect"
                                                            href="<?php echo e(route($ParentRouteName . '.pdf', ['id' => $item->id])); ?>"
                                                            data-toggle="tooltip" data-placement="top" target="blank"
                                                            title="<?php echo e(__('root.common.pdf_generator')); ?>"> <i
                                                                class="material-icons">picture_as_pdf</i></a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <thead>
                                                <tr>
                                                    <th class="checkbox_custom_style text-center">
                                                        <input name="selectBottom" type="checkbox" id="md_checkbox_footer"
                                                            class="chk-col-cyan" />
                                                        <label for="md_checkbox_footer"></label>
                                                    </th>
                                                    <th><?php echo e(__('root.ledger_name.name')); ?></th>
                                                    <th><?php echo e(__('root.ledger_name.ledger_type_name')); ?></th>
                                                    <th><?php echo e(__('root.ledger_name.ledger_group_name')); ?></th>
                                                    <th><?php echo e(__('root.ledger_name.unit')); ?></th>
                                                    <th><?php echo e(__('root.ledger_name.dr')); ?></th>
                                                    <th><?php echo e(__('root.ledger_name.options')); ?></th>
                                                </tr>
                                            </thead>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <div class="body">
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
                            <div class="pagination-and-action-area body">
                                <div>
                                    <div class="select-and-apply-area">
                                        <div class="form-group width-300">
                                            <div class="form-line">
                                                <select class="form-control" name="apply_comand_bottom" id="">
                                                    <option value="0"><?php echo e(__('root.common.select_action')); ?></option>
                                                    <?php if($delete): ?>
                                                        <option value="3"><?php echo e(__('root.common.move_to_trash')); ?>

                                                        </option>
                                                    <?php endif; ?>
                                                    <?php if($permanently_delete): ?>
                                                        <option value="2"><?php echo e(__('root.common.permanently_delete')); ?>

                                                        </option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input class="btn btn-sm btn-info waves-effect" type="submit"
                                                value="<?php echo e(__('root.common.apply')); ?>" name="ApplyTop">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="custom-paginate">
                                        <?php echo e($items->links()); ?>

                                    </div>
                                </div>
                            </div>
                        </form>
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
    </script>
    
    <script src="<?php echo e(asset('asset/js/dataTable.js')); ?>"></script>
    <script>
        BaseController.init();
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/admin/income-expense-head/index.blade.php ENDPATH**/ ?>