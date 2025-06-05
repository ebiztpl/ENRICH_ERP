

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
                        <tr>
                            <td colspan="3">
                                <h4>A. Cash flow from Operating actives:</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e($particulars['ProfitLossForTheYear']['name']); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['ProfitLossForTheYear']['balance']['start_balance'])); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['ProfitLossForTheYear']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">Adjustment for:</td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e($particulars['Depreciation']['name']); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['Depreciation']['balance']['start_balance'])); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['Depreciation']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"><b>(Increse)/Decrease in Current Assets:</b> </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e($particulars['AdvanceDepositAndReceivable']['name']); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['AdvanceDepositAndReceivable']['balance']['start_balance'])); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['AdvanceDepositAndReceivable']['balance']['end_balance'])); ?>

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
                            <td colspan="3"><b>Increse/(Decrease) in Current Liabilites:</b> </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e($particulars['AccountPayable']['name']); ?>

                            </td>
                            <td class="text-right">
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
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['ShortTermLoan']['balance']['start_balance'])); ?>

                            </td>
                            <td class="text-right">
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
                            <td class="text-right">
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
                            <td class="font-w-b">
                                <?php echo e($particulars['NetCashUsedInOperatingActives']['name']); ?>

                            </td>
                            <td class="text-right font-w-b">
                                <?php echo e(Helper::convertMoneyFormat($particulars['NetCashUsedInOperatingActives']['balance']['start_balance'])); ?>

                            </td>
                            <td class="text-right font-w-b">
                                <?php echo e(Helper::convertMoneyFormat($particulars['NetCashUsedInOperatingActives']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <h4>B. Cash flow from Investing actives: (Increase) / Decrease</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e($particulars['AcquisitionOfPropertyPlantAndEquipment']['name']); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['AcquisitionOfPropertyPlantAndEquipment']['balance']['start_balance'])); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['AcquisitionOfPropertyPlantAndEquipment']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td class="font-w-b">
                                <?php echo e($particulars['NetCashUsedInInvestingActives']['name']); ?>

                            </td>
                            <td class="text-right font-w-b">
                                <?php echo e(Helper::convertMoneyFormat($particulars['NetCashUsedInInvestingActives']['balance']['start_balance'])); ?>

                            </td>
                            <td class="text-right font-w-b">
                                <?php echo e(Helper::convertMoneyFormat($particulars['NetCashUsedInInvestingActives']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <h4>C. Cash flow from Financing actives: Increase / (Decrease)</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e($particulars['PaidUpCapital']['name']); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['PaidUpCapital']['balance']['start_balance'])); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['PaidUpCapital']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo e($particulars['ShareMoneyDeposit']['name']); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['ShareMoneyDeposit']['balance']['start_balance'])); ?>

                            </td>
                            <td class="text-right">
                                <?php echo e(Helper::convertMoneyFormat($particulars['ShareMoneyDeposit']['balance']['end_balance'])); ?>

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
                                <?php echo e($particulars['NetCashUsedInFinanceActives']['name']); ?>

                            </td>
                            <td class="text-right font-w-b">
                                <?php echo e(Helper::convertMoneyFormat($particulars['NetCashUsedInFinanceActives']['balance']['start_balance'])); ?>

                            </td>
                            <td class="text-right font-w-b">
                                <?php echo e(Helper::convertMoneyFormat($particulars['NetCashUsedInFinanceActives']['balance']['end_balance'])); ?>

                            </td>
                        </tr>
                        <tr>
                            <td class="font-w-b">
                                <h4><?php echo e($particulars['TotalActivitiesABC']['name']); ?></h4>
                            </td>
                            <td class="text-right font-w-b">
                                <h4><?php echo e(Helper::convertMoneyFormat($particulars['TotalActivitiesABC']['balance']['start_balance'])); ?>

                                </h4>
                            </td>
                            <td class="text-right font-w-b">
                                <h4><?php echo e(Helper::convertMoneyFormat($particulars['TotalActivitiesABC']['balance']['end_balance'])); ?>

                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td class=" font-w-b">
                                <h4><?php echo e($particulars['OpeningCashAndBank']['name']); ?></h4>
                            </td>
                            <td class="text-right font-w-b">
                                <h4><?php echo e(Helper::convertMoneyFormat($particulars['OpeningCashAndBank']['balance']['start_balance'])); ?>

                                </h4>
                            </td>
                            <td class="text-right font-w-b">
                                <h4><?php echo e(Helper::convertMoneyFormat($particulars['OpeningCashAndBank']['balance']['end_balance'])); ?>

                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td class=" text-right">
                                <h4><?php echo e($particulars['ClosingCashAndBankBalanceDE']['name']); ?></h4>
                            </td>
                            <td class="font-w-b text-right">
                                <h4><?php echo e(Helper::convertMoneyFormat($particulars['ClosingCashAndBankBalanceDE']['balance']['start_balance'])); ?>

                                </h4>
                            </td>
                            <td class="font-w-b text-right">
                                <h4><?php echo e(Helper::convertMoneyFormat($particulars['ClosingCashAndBankBalanceDE']['balance']['end_balance'])); ?>

                                </h4>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.pdf', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/admin/accounts-report/cash-flow/branch-wise/index.blade.php ENDPATH**/ ?>