

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
                            <td class="text-right">Ledger Type</td>
                            <th><?php echo e($search_by['type_name']); ?></th>
                            <td class="text-right">Branch Name:</td>
                            <th><?php echo e($search_by['branch_name']); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="mid">
        <?php
            $grand_total = 0;
        ?>
        <?php $__currentLoopData = $particulars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $types): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <table class="table table-bordered table-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center padding-t-8" colspan="2">
                            <h3><?php echo e($key); ?></h3>
                        </th>
                    </tr>
                    <?php if($search_by['start_from']): ?>
                        <tr>
                            <th class="text-center">
                            </th>
                            <th class="text-center">
                                <h5>From <?php echo e($search_by['start_from']); ?> To <?php echo e($search_by['start_to']); ?></h5>
                            </th>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <th class="text-left" scope="col">Ledger Name</th>
                        <th class="text-right" scope="col"> <?php echo config('settings.is_code') == 'code' ? config('settings.currency_code') : config('settings.currency_symbol'); ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sub_total = 0;
                    ?>
                    <?php $__currentLoopData = $types->groupBy('IncomeExpenseHead.name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyHead => $transactions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $head_balance = 0;
                        ?>
                        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($transaction->IncomeExpenseHead->type): ?>
                                <?php
                                    $head_balance += (int) $transaction->dr - (int) $transaction->cr;
                                ?>
                            <?php else: ?>
                                <?php
                                    $head_balance += (int) $transaction->cr - (int) $transaction->dr;
                                ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-left" scope="row"><?php echo e($keyHead); ?></td>
                            <td scope="row" class=" text-right">
                                <?php echo e(Helper::convertMoneyFormat($head_balance)); ?></td>
                        </tr>
                        <?php
                            $sub_total += $head_balance;
                        ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th class="text-right"> Sub Total =</th>
                        <th class="text-right"><?php echo e(Helper::convertMoneyFormat($sub_total)); ?></th>
                    </tr>
                    <?php
                        $grand_total += $sub_total;
                    ?>
                </tbody>
            </table>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-right">
                        <h2>Grand Total = </h2>
                    </th>
                    <th class="text-right">
                        <h2><?php echo e(Helper::convertMoneyFormat($grand_total)); ?> </h2>
                    </th>
                </tr>
            </thead>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.pdf', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/admin/accounts-report/notes/type-wise/pdf.blade.php ENDPATH**/ ?>