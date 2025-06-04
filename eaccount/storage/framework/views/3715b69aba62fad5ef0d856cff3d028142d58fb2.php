

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
                                <h5>
                                    Opening Balance ( <?php echo e($search_by['from']); ?> )
                                    <?php echo config('settings.is_code') == 'code' ? config('settings.currency_code') : config('settings.currency_symbol'); ?>
                                </h5>
                            </th>
                            <th class="text-center">
                                <h5>Addition During Year</h5>
                            </th>
                            <th class="text-center">
                                <h5>Deduction During Year</h5>
                            </th>
                            <th class="text-center">
                                <h5>Total Assets</h5>
                            </th>
                            <th class="text-center">
                                <h5>Dep.Rate (%)</h5>
                            </th>
                            <th class="text-center">
                                <h5>Accumulated Depreciation</h5>
                            </th>
                            <th class="text-center">
                                <h5>Current Year Depreciation</h5>
                            </th>
                            <th class="text-center">
                                <h5>Total Depreciation</h5>
                            </th>
                            <th class="text-center font-s-16">
                                <h5>Closing Balance ( <?php echo e($search_by['to']); ?> )
                                    <?php echo config('settings.is_code') == 'code' ? config('settings.currency_code') : config('settings.currency_symbol'); ?>
                                </h5>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $particulars['StartDate']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $particular => $balance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-left" scope="row"><?php echo e($particular); ?></td>
                                <td class="text-right" scope="row"><?php echo e(Helper::convertMoneyFormat($balance)); ?></td>
                                <td class="text-center" scope="row">0</td>
                                <td class="text-center" scope="row">0</td>
                                <td class="text-center" scope="row">0</td>
                                <td class="text-center" scope="row">0</td>
                                <td class="text-center" scope="row">0</td>
                                <td class="text-center" scope="row">0</td>
                                <td class="text-center" scope="row">0</td>
                                <td class="text-right" scope="row">
                                    <?php echo e(Helper::convertMoneyFormat($particulars['EndDate'][$particular])); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-right font-w-b font-s-20" scope="row">Total=</td>
                            <td class="text-right font-w-b font-s-20" scope="row">
                                <?php echo e(Helper::convertMoneyFormat($particulars['TotalBalance']['start_balance'])); ?></td>
                            <td class="text-left font-w-b font-s-20" colspan="7" scope="row"></td>
                            <td class="text-right font-w-b font-s-20" scope="row">
                                <?php echo e(Helper::convertMoneyFormat($particulars['TotalBalance']['end_balance'])); ?>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.pdf', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/admin/accounts-report/fixed-asset-schedule/branch-wise/index.blade.php ENDPATH**/ ?>