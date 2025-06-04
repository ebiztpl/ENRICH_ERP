

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

    <div class="mid">
        <?php $total_dr = 0; ?>
        <?php $total_cr = 0;
        $branch_number = 1;
        ?>
        <?php $__currentLoopData = $items['branches']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch_name => $income_expenses): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                    <table class="table table-bordered table-sm table-hover">
                        <thead>
                            <tr>
                                <th colspan="5" class="text-center font-s-25">
                                    <?php echo e($branch_name); ?>

                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">
                                    Sl. No
                                </th>
                                <th class="text-center font-s-18">
                                    Head Of Account
                                </th>
                                <th class="text-center font-s-18" colspan="2">
                                    <?php if(!empty($search_by['from'])): ?>
                                        From <?php echo e(date(config('settings.date_format'), strtotime($search_by['from']))); ?> to
                                        <?php echo e(date(config('settings.date_format'), strtotime($search_by['to']))); ?>

                                    <?php else: ?>
                                        UpTo to <?php echo e($extra['current_date_time']); ?>

                                    <?php endif; ?>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center" scope="col"></th>
                                <th scope="col"></th>
                                <th class="text-right" scope="col">Dr ( <?php echo config('settings.is_code') == 'code' ? config('settings.currency_code') : config('settings.currency_symbol'); ?> )
                                </th>
                                <th class="text-right" scope="col">Cr ( <?php echo config('settings.is_code') == 'code' ? config('settings.currency_code') : config('settings.currency_symbol'); ?> )
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sub_dr = 0; ?>
                            <?php $sub_cr = 0; ?>
                            <?php
                                $key = 0;
                            ?>
                            <?php $__currentLoopData = $income_expenses->whereNotNull('income_expense_head_id')->groupBy('IncomeExpenseHead.name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $income_expense_name => $transactions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $balance = 0;
                                ?>
                                <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($transaction->IncomeExpenseHead->type == 1): ?>
                                        <?php
                                            $balance += $transaction->dr - $transaction->cr;
                                        ?>
                                    <?php else: ?>
                                        <?php
                                            $balance += $transaction->cr - $transaction->dr;
                                        ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th class="text-center" scope="row"><?php echo e($key + 1); ?></th>
                                    <td scope="row"><?php echo e($income_expense_name); ?></td>
                                    <td class="text-right">
                                        <?php if($transaction->IncomeExpenseHead->type == 1): ?>
                                            <?php
                                                $sub_dr += $balance;
                                            ?>
                                            <?php echo e(Helper::convertMoneyFormat($balance)); ?>

                                        <?php else: ?>
                                            0
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-right">
                                        <?php if($transaction->IncomeExpenseHead->type == 0): ?>
                                            <?php
                                                $sub_cr += $balance;
                                            ?>
                                            <?php echo e(Helper::convertMoneyFormat($balance)); ?>

                                        <?php else: ?>
                                            0
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php
                                    $key++;
                                ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php $total_dr += $sub_dr; ?>
                            <?php $total_cr += $sub_cr; ?>
                            <tr>
                                <th class="text-right" colspan="2">Sub Total =</th>
                                <th class="text-right"><?php echo e(Helper::convertMoneyFormat($sub_dr)); ?></th>
                                <th class="text-right"><?php echo e(Helper::convertMoneyFormat($sub_cr)); ?></th>
                            </tr>
                            <?php if(count($items['branches']) == $branch_number): ?>
                                <tr>
                                    <th class="text-right font-s-20" colspan="2">Total Amount=</th>
                                    <th class="text-right font-s-20"><?php echo e(Helper::convertMoneyFormat($total_dr)); ?>

                                    </th>
                                    <th class="text-right font-s-20"><?php echo e(Helper::convertMoneyFormat($total_cr)); ?>

                                    </th>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <?php $branch_number++; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <table class="table table-bordered table-sm table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">
                                Sl. No
                            </th>
                            <th class="text-center font-s-18">
                                Closing Bank & Cash Balance
                            </th>
                            <th class="text-center font-s-18" colspan="2">
                                <?php if(!empty($search_by['from'])): ?>
                                    From <?php echo e(date(config('settings.date_format'), strtotime($search_by['from']))); ?> to
                                    <?php echo e(date(config('settings.date_format'), strtotime($search_by['to']))); ?>

                                <?php else: ?>
                                    UpTo to <?php echo e($extra['current_date_time']); ?>

                                <?php endif; ?>
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center" scope="col"></th>
                            <th scope="col"></th>
                            <th class="text-right" scope="col">Dr ( <?php echo config('settings.is_code') == 'code' ? config('settings.currency_code') : config('settings.currency_symbol'); ?> )
                            </th>
                            <th class="text-right" scope="col">Cr ( <?php echo config('settings.is_code') == 'code' ? config('settings.currency_code') : config('settings.currency_symbol'); ?> )
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $total_bank_cash_balance = 0;
                            $key = 1;
                        ?>
                        <?php $__currentLoopData = $items['bank_cashes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank_cashes_name => $transactions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $bank_dr = 0;
                                $bank_cr = 0;
                            ?>
                            <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $bank_dr += (int) $transaction->dr;
                                    $bank_cr += (int) $transaction->cr;
                                ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th class="text-center" scope="row"><?php echo e($key); ?></th>
                                <td scope="row"><?php echo e($bank_cashes_name); ?></td>
                                <td class="text-right">
                                    <?php
                                        $total_bank_cash_balance += $sub_bank_cash_balance = $bank_cr - $bank_dr;
                                    ?>
                                    <?php echo e(Helper::convertMoneyFormat($sub_bank_cash_balance)); ?>

                                </td>
                                <td class="text-right">
                                    0
                                </td>
                            </tr>
                            <?php
                                $key++;
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th class="text-right" colspan="2">Sub Total =</th>
                            <th class="text-right"><?php echo e(Helper::convertMoneyFormat($total_bank_cash_balance)); ?></th>
                            <th class="text-right"><?php echo e(Helper::convertMoneyFormat(0)); ?></th>
                        </tr>
                        <tr>
                            <th class="text-right font-s-20" colspan="2">Grand Total Amount =</th>
                            <th class="text-right font-s-20"><?php echo e(Helper::convertMoneyFormat($total_cr)); ?></th>
                            <th class="text-right font-s-20">
                                <?php echo e(Helper::convertMoneyFormat($total_dr + $total_bank_cash_balance)); ?></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.pdf', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/admin/accounts-report/receive-and-payment/branch-wise/pdf.blade.php ENDPATH**/ ?>