
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
    <div class="mid mb-3">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <td class="text-right">Search By:</td>
                            <td class="text-right">Branch Name:</td>
                            <th><?php echo e($search_by['branch_name']); ?></th>
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
                                <h5>Particulars </h5>
                            </th>
                            <th class="text-center">
                                <h5>From <?php echo e($search_by['start_from']); ?> To <?php echo e($search_by['start_to']); ?></h5>
                            </th>
                            <th class="text-center">
                                <h5>From <?php echo e($search_by['end_from']); ?> To <?php echo e($search_by['end_to']); ?></h5>
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center" scope="col"></th>
                            <th class="text-right" scope="col"> DR <?php echo config('settings.is_code') == 'code' ? config('settings.currency_code') : config('settings.currency_symbol'); ?>
                            </th>
                            <th class="text-right" scope="col"> CR <?php echo config('settings.is_code') == 'code' ? config('settings.currency_code') : config('settings.currency_symbol'); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $particulars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $particular): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr
                                <?php if($key == 'Revenue' or $key == 'GrossProfit'): ?> class="font-w-b font-s-16"
                            <?php elseif($key == 'NetProfitOrLoss'): ?>
                            class="font-w-b font-s-20" <?php endif; ?>>
                                <td class="text-left" scope="row"><?php echo e($particular['name']); ?></td>
                                <td scope="row" class=" text-right">
                                    <?php echo e(Helper::convertMoneyFormat($particular['balance']['start_balance'])); ?>

                                </td>
                                <td class="text-right">
                                    <?php echo e(Helper::convertMoneyFormat($particular['balance']['end_balance'])); ?> </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.pdf', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/admin/accounts-report/retained-earnings/branch-wise/index.blade.php ENDPATH**/ ?>