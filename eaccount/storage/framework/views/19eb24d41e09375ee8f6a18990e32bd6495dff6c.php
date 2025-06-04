

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
                            <th class="text-right" scope="col"> <?php echo config('settings.is_code') == 'code' ? config('settings.currency_code') : config('settings.currency_symbol'); ?>
                            </th>
                            <th class="text-right" scope="col"> <?php echo config('settings.is_code') == 'code' ? config('settings.currency_code') : config('settings.currency_symbol'); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3">
                                <h4><?php echo e($particulars['CapitalAndLiabilities']['name']); ?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b><?php echo e($particulars['AuthorizedCapital']['name']); ?> </b>
                                <p>1,00,000 Ordinary Share Of Tk. 100 each</p>
                            </td>
                            <td class="font-w-b text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['AuthorizedCapital']['balance']['start_balance'])); ?>

                            </td>
                            <td class="font-w-b text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['AuthorizedCapital']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td class="font-w-b">
                                ISSUED, SUBSCRIBED &amp; <?php echo e($particulars['IssuedSubscribedAndPaidUpCapital']['name']); ?>

                            </td>
                            <td class="font-w-b text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['IssuedSubscribedAndPaidUpCapital']['balance']['start_balance'])); ?>

                            </td>
                            <td class="font-w-b text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['IssuedSubscribedAndPaidUpCapital']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td class="font-w-b">
                                <?php echo e($particulars['RetainEarning']['name']); ?>

                            </td>
                            <td class="font-w-b text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['RetainEarning']['balance']['start_balance'])); ?>

                            </td>
                            <td class="font-w-b text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['RetainEarning']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td class="font-w-b">
                                <?php echo e($particulars['ShareMoneyDeposit']['name']); ?>

                            </td>
                            <td class="font-w-b text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['ShareMoneyDeposit']['balance']['start_balance'])); ?>

                            </td>
                            <td class="font-w-b text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['ShareMoneyDeposit']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td class="font-w-b">
                                <?php echo e($particulars['NonCurrentLiabilities']['name']); ?>

                            </td>
                            <td class="font-w-b text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['NonCurrentLiabilities']['balance']['start_balance'])); ?>

                            </td>
                            <td class="font-w-b text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['NonCurrentLiabilities']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e($particulars['LongTermLoan']['name']); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['LongTermLoan']['balance']['start_balance'])); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['LongTermLoan']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td class="font-w-b">
                                <?php echo e($particulars['CurrentLiabilities']['name']); ?>

                            </td>
                            <td class="font-w-b text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['CurrentLiabilities']['balance']['start_balance'])); ?>

                            </td>
                            <td class="font-w-b text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['CurrentLiabilities']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e($particulars['AccountPayable']['name']); ?>

                            </td>
                            <td class=" text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['AccountPayable']['balance']['start_balance'])); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['AccountPayable']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e($particulars['ShortTermLoan']['name']); ?>

                            </td>
                            <td class=" text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['ShortTermLoan']['balance']['start_balance'])); ?>

                            </td>
                            <td class=" text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['ShortTermLoan']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e($particulars['AdvanceAgainstSales']['name']); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['AdvanceAgainstSales']['balance']['start_balance'])); ?>

                            </td>
                            <td class=" text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['AdvanceAgainstSales']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e($particulars['OtherPayable']['name']); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['OtherPayable']['balance']['start_balance'])); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['OtherPayable']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e($particulars['AdvanceReceiveFromInvestor']['name']); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['AdvanceReceiveFromInvestor']['balance']['start_balance'])); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['AdvanceReceiveFromInvestor']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td class="font-w-b text-right font-s-20">
                                <?php echo e($particulars['TotalCapitalAndLiabilities']['name']); ?>

                            </td>
                            <td class="font-w-b text-right font-s-20">
                                <?php echo e(Helper::convertMoneyFormat($particulars['TotalCapitalAndLiabilities']['balance']['start_balance'])); ?>

                            </td>
                            <td class="font-w-b text-right font-s-20">
                                <?php echo e(Helper::convertMoneyFormat($particulars['TotalCapitalAndLiabilities']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <h4><?php echo e($particulars['Assets']['name']); ?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-w-b">
                                <?php echo e($particulars['NonCurrentAssets']['name']); ?>

                            </td>
                            <td class="font-w-b text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['NonCurrentAssets']['balance']['start_balance'])); ?>

                            </td>
                            <td class="font-w-b text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['NonCurrentAssets']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e($particulars['fixedAssetsSchedule']['name']); ?>

                            </td>
                            <td class=" text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['fixedAssetsSchedule']['balance']['start_balance'])); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['fixedAssetsSchedule']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td class="font-w-b">
                                <?php echo e($particulars['CurrentAssets']['name']); ?>

                            </td>
                            <td class="font-w-b text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['CurrentAssets']['balance']['start_balance'])); ?>

                            </td>
                            <td class="font-w-b text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['CurrentAssets']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e($particulars['AdvanceDepositReceivables']['name']); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['AdvanceDepositReceivables']['balance']['start_balance'])); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['AdvanceDepositReceivables']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e($particulars['Inventories']['name']); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['Inventories']['balance']['start_balance'])); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['Inventories']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e($particulars['CashAndBankBalance']['name']); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['CashAndBankBalance']['balance']['start_balance'])); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['CashAndBankBalance']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e($particulars['PreliminaryExpense']['name']); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['PreliminaryExpense']['balance']['start_balance'])); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['PreliminaryExpense']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td class="font-w-b text-right fon-s-20">
                                <?php echo e($particulars['TotalAssets']['name']); ?>

                            </td>
                            <td class="font-w-b text-right fon-s-20">
                                <?php echo e(Helper::convertMoneyFormat($particulars['TotalAssets']['balance']['start_balance'])); ?>

                            </td>
                            <td class="font-w-b text-right fon-s-20">
                                <?php echo e(Helper::convertMoneyFormat($particulars['TotalAssets']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.pdf', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/admin/accounts-report/balance-sheet/branch-wise/index.blade.php ENDPATH**/ ?>