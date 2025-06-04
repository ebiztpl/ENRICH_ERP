

<?php $__env->startPush('include-css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('asset/css/main-report.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title'); ?>
    <?php echo e(config('settings.company_name')); ?> -> <?php echo e($extra['module_name']); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="mid">
        <h2 class="text-center"><?php echo e(config('settings.company_name')); ?></h2>
        <h5 class="text-center "><?php echo e(config('settings.address_1')); ?></h5>
        <hr>
        <h4 class="text-center mb-4"><?php echo e($extra['voucher_type']); ?></h4>
    </div>
    <div class="mid mb-3">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <td class="text-right">Search By:</td>
                            <td class="text-right">Voucher Type</td>
                            <th><?php echo e($search_by['type_name']); ?></th>
                            <td class="text-right">From Date:</td>
                            <th><?php echo e($search_by['from']); ?></th>
                            <td class="text-right">To Date:</td>
                            <th><?php echo e($search_by['to']); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="mid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <table class="table table-bordered table-sm table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">
                                Sl.No
                            </th>
                            <th class="text-center">Voucher No</th>
                            <th class="text-center">Type</th>
                            <th>Particulars</th>
                            <th>Branch Name</th>
                            <th>Date</th>
                            <th>Ledger Name</th>
                            <th>Made Of Payment</th>
                            <th>CHQ. No</th>
                            <th>Debit ( <?php echo config('settings.is_code') == 'code' ? config('settings.currency_code') : config('settings.currency_symbol'); ?>
                                )
                            </th>
                            <th>Credit ( <?php echo config('settings.is_code') == 'code' ? config('settings.currency_code') : config('settings.currency_symbol'); ?>
                                )
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sl = 1;
                        ?>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e($sl); ?></td>
                                <td class="text-center"><?php echo e(str_pad($item->voucher_no, 4, '0', STR_PAD_LEFT)); ?></td>
                                <td><?php echo e($item->voucher_type); ?></td>
                                <td><?php echo e($item->particulars); ?></td>
                                <td><?php echo e($item->Branch ? $item->Branch->name : ''); ?></td>
                                <td><?php echo e(date(config('settings.date_format'), strtotime($item->voucher_date))); ?></td>
                                <td>
                                    <?php echo e($item->IncomeExpenseHead ? $item->IncomeExpenseHead->name : ''); ?>

                                </td>
                                <td>
                                    <?php echo e($item->BankCash ? $item->BankCash->name : ''); ?>

                                </td>
                                <td> <?php echo e($item->cheque_number); ?> </td>
                                <td><?php echo e(Helper::convertMoneyFormat($item->dr)); ?></td>
                                <td><?php echo e(Helper::convertMoneyFormat($item->cr)); ?></td>
                            </tr>
                            <?php
                                $sl++;
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.pdf', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/admin/general-report/voucher/date-wise/index.blade.php ENDPATH**/ ?>