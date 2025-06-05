
<?php $__env->startPush('include-css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('asset/css/main-report.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(config('settings.company_name')); ?> -> <?php echo e($extra['module_name']); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="mid">
        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
            <br>
            <h2 class="text-center"><?php echo e(config('settings.company_name')); ?></h2>
            <h6 class="text-center"><?php echo e(config('settings.address_1')); ?></h6>
            <br>
            <h4 class="text-center"><?php echo e($extra['voucher_type']); ?></h4>
            <hr>
        </div>
    </div>
    <div class="mid">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <td class="text-right">Search By:</td>
                    <td class="text-right">Branch Name:</td>
                    <th><?php echo e($search_by['branch_name']); ?></th>
                    <td class="text-right">Head Of Account:</td>
                    <th><?php echo e($search_by['income_expense_head_name']); ?></th>
                    <td class="text-right">From Date:</td>
                    <th><?php echo e($search_by['from']); ?></th>
                    <td class="text-right">To Date:</td>
                    <th><?php echo e($search_by['to']); ?></th>
                </tr>
            </thead>
        </table>
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($item->Transaction->count() > 0): ?>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                        <h4 class="text-center mb-3"><?php echo e($item->name); ?></h4>
                        <table class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">SL. No</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Head Of Account</th>
                                    <th scope="col">Mode Of Payment</th>
                                    <th scope="col">Cheque Number</th>
                                    <th scope="col">Particulars</th>
                                    <th scope="col">Voucher No</th>
                                    <th scope="col">Type Of Voucher</th>
                                    <th class="text-right" scope="col">Dr ( <?php echo config('settings.is_code') == 'code' ? config('settings.currency_code') : config('settings.currency_symbol'); ?> )
                                    </th>
                                    <th class="text-right" scope="col">Cr ( <?php echo config('settings.is_code') == 'code' ? config('settings.currency_code') : config('settings.currency_symbol'); ?> )
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $dr_amount = 0;
                                    $cr_amount = 0;
                                ?>
                                <?php $__currentLoopData = $item->Transaction; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th class="text-center" scope="row"><?php echo e($key + 1); ?></th>
                                        <td><?php echo e(date(config('settings.date_format'), strtotime($transaction->voucher_date))); ?>

                                        </td>
                                        <td> <?php echo e($transaction->IncomeExpenseHead ? $transaction->IncomeExpenseHead->name : ''); ?>

                                        </td>
                                        <td> <?php echo e($transaction->BankCash ? $transaction->BankCash->name : ''); ?> </td>
                                        <td> <?php echo e($transaction->cheque_number); ?> </td>
                                        <td> <?php echo e($transaction->particulars); ?> </td>
                                        <td class="text-center"> <?php echo e($transaction->voucher_no); ?> </td>
                                        <td> <?php echo e($transaction->voucher_type); ?> </td>
                                        <td class="text-right"><?php echo e(Helper::convertMoneyFormat($transaction->dr)); ?></td>
                                        <td class="text-right"><?php echo e(Helper::convertMoneyFormat($transaction->cr)); ?></td>
                                    </tr>
                                    <?php
                                        $dr_amount += $transaction->dr;
                                        $cr_amount += $transaction->cr;
                                    ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th class="text-right" colspan="8">Total =</th>
                                    <th class="text-right"><?php echo e(Helper::convertMoneyFormat($dr_amount)); ?></th>
                                    <th class="text-right"><?php echo e(Helper::convertMoneyFormat($cr_amount)); ?></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.pdf', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/admin/accounts-report/ledger/branch-wise/index.blade.php ENDPATH**/ ?>