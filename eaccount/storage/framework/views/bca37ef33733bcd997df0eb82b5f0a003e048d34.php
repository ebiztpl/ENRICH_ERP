<section>
    <aside id="leftsidebar" class="sidebar">
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li <?php if(Request::url() === route('dashboard')): ?> class="active" <?php endif; ?>>
                    <a href="<?php echo e(route('dashboard')); ?>">
                        <i class="material-icons">dashboard</i>
                        <span><?php echo e(__('root.menu.dashboard')); ?></span>
                    </a>
                </li>
                
                <li <?php if(config('role_manage.Branch.All') == 0 and
                    config('role_manage.Branch.TrashShow') == 0 and
                    config('role_manage.Branch.Create') == 0): ?> class="dis-none" <?php endif; ?>
                    <?php if(Request::url() === route('branch') or
                        Request::url() === route('branch.create') or
                        Request::url() === route('branch.trashed') or
                        Request::url() === route('branch.active.search') or
                        Request::url() === route('branch.trashed.search')): ?> class="active " <?php endif; ?>>
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-project-diagram"></i>
                        <span><?php echo e(__('root.menu.branch')); ?> </span>
                    </a>
                    <ul class="ml-menu">
                        <li <?php if(Request::url() === route('branch') or Request::url() === route('branch.active.search')): ?> class="active" <?php endif; ?>>
                            <a <?php if(config('role_manage.Branch.All') == 0): ?> class="dis-none" <?php endif; ?>
                                href="<?php echo e(route('branch')); ?>"><?php echo e(__('root.menu.branch_all')); ?></a>
                        </li>
                        <li <?php if(Request::url() === route('branch.create')): ?> class="active" <?php endif; ?>>
                            <a <?php if(config('role_manage.Branch.Create') == 0): ?> class="dis-none" <?php endif; ?>
                                href="<?php echo e(route('branch.create')); ?>"><?php echo e(__('root.menu.branch_create')); ?></a>
                        </li>
                        <li <?php if(Request::url() === route('branch.trashed') or Request::url() === route('branch.trashed.search')): ?> class="active" <?php endif; ?>>
                            <a <?php if(config('role_manage.Branch.TrashShow') == 0): ?> class="dis-none" <?php endif; ?>
                                href="<?php echo e(route('branch.trashed')); ?>"><?php echo e(__('root.menu.branch_trashed')); ?></a>
                        </li>
                    </ul>
                </li>
                
                
                <li <?php if(config('role_manage.LedgerType.All') == 0 and
                    config('role_manage.LedgerType.TrashShow') == 0 and
                    config('role_manage.LedgerType.Create') == 0 and
                    config('role_manage.LedgerGroup.All') == 0 and
                    config('role_manage.LedgerGroup.TrashShow') == 0 and
                    config('role_manage.LedgerGroup.Create') == 0 and
                    config('role_manage.LedgerName.All') == 0 and
                    config('role_manage.LedgerName.TrashShow') == 0 and
                    config('role_manage.LedgerName.Create') == 0): ?> class="dis-none" <?php endif; ?>
                    <?php if(Request::url() === route('income_expense_type') or
                        Request::url() === route('income_expense_type.create') or
                        Request::url() === route('income_expense_type.trashed') or
                        Request::url() === route('income_expense_type.active.search') or
                        Request::url() === route('income_expense_type.trashed.search') or
                        Request::url() === route('income_expense_group') or
                        Request::url() === route('income_expense_group.create') or
                        Request::url() === route('income_expense_group.trashed') or
                        Request::url() === route('income_expense_group.active.search') or
                        Request::url() === route('income_expense_group.trashed.search') or
                        Request::url() === route('income_expense_head') or
                        Request::url() === route('income_expense_head.create') or
                        Request::url() === route('income_expense_head.trashed') or
                        Request::url() === route('income_expense_head.active.search') or
                        Request::url() === route('income_expense_head.trashed.search')): ?> class="active" <?php endif; ?>>
                    <a class="menu-toggle" href="javascript:void(0);">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span><?php echo e(__('root.menu.ledger')); ?> </span>
                    </a>
                    <ul class="ml-menu">

                        
                        <li <?php if(config('role_manage.LedgerType.All') == 0 and
                            config('role_manage.LedgerType.TrashShow') == 0 and
                            config('role_manage.LedgerType.Create') == 0): ?> class="dis-none" <?php endif; ?>
                            <?php if(Request::url() === route('income_expense_type') or
                                Request::url() === route('income_expense_type.create') or
                                Request::url() === route('income_expense_type.trashed') or
                                Request::url() === route('income_expense_type.active.search') or
                                Request::url() === route('income_expense_type.trashed.search')): ?> class="active " <?php endif; ?>>
                            <a class="menu-toggle " href="javascript:void(0);">
                                <span><?php echo e(__('root.menu.type')); ?> </span>
                            </a>
                            <ul class="ml-menu">
                                <li <?php if(Request::url() === route('income_expense_type') or
                                    Request::url() === route('income_expense_type.active.search')): ?> class="active" <?php endif; ?>>
                                    <a <?php if(config('role_manage.LedgerType.All') == 0): ?> class="dis-none" <?php endif; ?>
                                        href="<?php echo e(route('income_expense_type')); ?>"><?php echo e(__('root.menu.type_all')); ?></a>
                                </li>
                            </ul>
                        </li>

                        

                        
                        <li <?php if(config('role_manage.LedgerGroup.All') == 0 and
                            config('role_manage.LedgerGroup.TrashShow') == 0 and
                            config('role_manage.LedgerGroup.Create') == 0): ?> class="dis-none" <?php endif; ?>
                            <?php if(Request::url() === route('income_expense_group') or
                                Request::url() === route('income_expense_group.create') or
                                Request::url() === route('income_expense_group.trashed') or
                                Request::url() === route('income_expense_group.active.search') or
                                Request::url() === route('income_expense_group.trashed.search')): ?> class="active " <?php endif; ?>>
                            <a class="menu-toggle " href="javascript:void(0);">
                                <span><?php echo e(__('root.menu.group')); ?> </span>
                            </a>
                            <ul class="ml-menu">
                                <li <?php if(Request::url() === route('income_expense_group') or
                                    Request::url() === route('income_expense_group.active.search')): ?> class="active" <?php endif; ?>>
                                    <a <?php if(config('role_manage.LedgerGroup.All') == 0): ?> class="dis-none" <?php endif; ?>
                                        href="<?php echo e(route('income_expense_group')); ?>"><?php echo e(__('root.menu.group_all')); ?></a>
                                </li>
                                <li <?php if(Request::url() === route('income_expense_group.create')): ?> class="active" <?php endif; ?>>
                                    <a <?php if(config('role_manage.LedgerGroup.Create') == 0): ?> class="dis-none" <?php endif; ?>
                                        href="<?php echo e(route('income_expense_group.create')); ?>"><?php echo e(__('root.menu.group_create')); ?></a>
                                </li>
                                <li <?php if(Request::url() === route('income_expense_group.trashed') or
                                    Request::url() === route('income_expense_group.trashed.search')): ?> class="active" <?php endif; ?>>
                                    <a <?php if(config('role_manage.LedgerGroup.TrashShow') == 0): ?> class="dis-none" <?php endif; ?>
                                        href="<?php echo e(route('income_expense_group.trashed')); ?>"><?php echo e(__('root.menu.group_trashed')); ?></a>
                                </li>
                            </ul>
                        </li>

                        

                        
                        <li <?php if(config('role_manage.LedgerName.All') == 0 and
                            config('role_manage.LedgerName.TrashShow') == 0 and
                            config('role_manage.LedgerName.Create') == 0): ?> class="dis-none" <?php endif; ?>
                            <?php if(Request::url() === route('income_expense_head') or
                                Request::url() === route('income_expense_head.create') or
                                Request::url() === route('income_expense_head.trashed') or
                                Request::url() === route('income_expense_head.active.search') or
                                Request::url() === route('income_expense_head.trashed.search')): ?> class="active " <?php endif; ?>>
                            <a class="menu-toggle " href="javascript:void(0);">
                                <span><?php echo e(__('root.menu.name')); ?> </span>
                            </a>
                            <ul class="ml-menu">
                                <li <?php if(Request::url() === route('income_expense_head') or
                                    Request::url() === route('income_expense_head.active.search')): ?> class="active" <?php endif; ?>>
                                    <a <?php if(config('role_manage.LedgerName.All') == 0): ?> class="dis-none" <?php endif; ?>
                                        href="<?php echo e(route('income_expense_head')); ?>"><?php echo e(__('root.menu.name_all')); ?></a>
                                </li>
                                <li <?php if(Request::url() === route('income_expense_head.create')): ?> class="active" <?php endif; ?>>
                                    <a <?php if(config('role_manage.LedgerName.Create') == 0): ?> class="dis-none" <?php endif; ?>
                                        href="<?php echo e(route('income_expense_head.create')); ?>"><?php echo e(__('root.menu.name_create')); ?></a>
                                </li>
                                <li <?php if(Request::url() === route('income_expense_head.trashed') or
                                    Request::url() === route('income_expense_head.trashed.search')): ?> class="active" <?php endif; ?>>
                                    <a <?php if(config('role_manage.LedgerName.TrashShow') == 0): ?> class="dis-none" <?php endif; ?>
                                        href="<?php echo e(route('income_expense_head.trashed')); ?>"><?php echo e(__('root.menu.name_trashed')); ?></a>
                                </li>

                                <?php $activ = Session::get('branch_array');
$branchid =$activ->id; ?>
<?php if($branchid == 1): ?>

                                <li <?php if(Request::url() === route('income_expense_head.linking') ): ?> class="active" <?php endif; ?>>
                                    <a 
                                        href="<?php echo e(route('income_expense_head.linking')); ?>">Ledger Branches</a>
                                </li>
                                <?php endif; ?>




                            </ul>
                        
                        </li>
                         <!-- custom code byb hritik -->


 <!-- custom code byb hritik -->
                        
                    </ul>
                </li>
                

                
                <li <?php if(config('role_manage.BankCash.All') == 0 and
                    config('role_manage.BankCash.TrashShow') == 0 and
                    config('role_manage.BankCash.Create') == 0): ?> class="dis-none" <?php endif; ?>
                    <?php if(Request::url() === route('bank_cash') or
                        Request::url() === route('bank_cash.create') or
                        Request::url() === route('bank_cash.trashed') or
                        Request::url() === route('bank_cash.active.search') or
                        Request::url() === route('bank_cash.trashed.search')): ?> class="active " <?php endif; ?>>
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-university"></i>
                        <span><?php echo e(__('root.menu.bank_cash')); ?></span>
                    </a>
                    <ul class="ml-menu">
                        <li <?php if(Request::url() === route('bank_cash') or Request::url() === route('bank_cash.active.search')): ?> class="active" <?php endif; ?>>
                            <a <?php if(config('role_manage.BankCash.All') == 0): ?> class="dis-none" <?php endif; ?>
                                href="<?php echo e(route('bank_cash')); ?>"><?php echo e(__('root.menu.bank_cash_all')); ?></a>
                        </li>
                        <li <?php if(Request::url() === route('bank_cash.create')): ?> class="active" <?php endif; ?>>
                            <a <?php if(config('role_manage.BankCash.Create') == 0): ?> class="dis-none" <?php endif; ?>
                                href="<?php echo e(route('bank_cash.create')); ?>"><?php echo e(__('root.menu.bank_cash_create')); ?></a>
                        </li>
                        <li <?php if(Request::url() === route('bank_cash.trashed') or Request::url() === route('bank_cash.trashed.search')): ?> class="active" <?php endif; ?>>
                            <a <?php if(config('role_manage.BankCash.TrashShow') == 0): ?> class="dis-none" <?php endif; ?>
                                href="<?php echo e(route('bank_cash.trashed')); ?>"><?php echo e(__('root.menu.bank_cash_trashed')); ?></a>
                        </li>
                    </ul>
                </li>
                <?php if(env('DEMO_MODE') == false && env('INITIAL_BALANCE_ACTIVITY') == true): ?>
                    
                    <li <?php if(config('role_manage.InitialIncomeExpenseHeadBalance.All') == 0 and
                        config('role_manage.InitialIncomeExpenseHeadBalance.TrashShow') == 0 and
                        config('role_manage.InitialIncomeExpenseHeadBalance.Create') == 0 and
                        config('role_manage.InitialBankCashBalance.All') == 0 and
                        config('role_manage.InitialBankCashBalance.TrashShow') == 0 and
                        config('role_manage.InitialBankCashBalance.Create') == 0): ?> class="dis-none" <?php endif; ?>
                        <?php if(Request::url() === route('initial_bank_cash_balance') or
                            Request::url() === route('initial_bank_cash_balance.create') or
                            Request::url() === route('initial_bank_cash_balance.trashed') or
                            Request::url() === route('initial_bank_cash_balance.active.search') or
                            Request::url() === route('initial_bank_cash_balance.trashed.search') or
                            Request::url() === route('initial_income_expense_head_balance') or
                            Request::url() === route('initial_income_expense_head_balance.create') or
                            Request::url() === route('initial_income_expense_head_balance.trashed') or
                            Request::url() === route('initial_income_expense_head_balance.active.search') or
                            Request::url() === route('initial_income_expense_head_balance.trashed.search')): ?> class="active " <?php endif; ?>>
                        <a class="menu-toggle" href="javascript:void(0);">
                            <i class="fas fa-balance-scale"></i>
                            <span>Initial Balance</span>
                        </a>
                        <ul class="ml-menu">
                            
                            <li <?php if(config('role_manage.InitialBankCashBalance.All') == 0 and
                                config('role_manage.InitialBankCashBalance.TrashShow') == 0 and
                                config('role_manage.InitialBankCashBalance.Create') == 0): ?> class="dis-none" <?php endif; ?>
                                <?php if(Request::url() === route('initial_bank_cash_balance') or
                                    Request::url() === route('initial_bank_cash_balance.create') or
                                    Request::url() === route('initial_bank_cash_balance.trashed') or
                                    Request::url() === route('initial_bank_cash_balance.active.search') or
                                    Request::url() === route('initial_bank_cash_balance.trashed.search')): ?> class="active " <?php endif; ?>>
                                <a class="menu-toggle " href="javascript:void(0);">
                                    <span>Bank or Cash </span>
                                </a>
                                <ul class="ml-menu">
                                    <li <?php if(Request::url() === route('initial_bank_cash_balance') or
                                        Request::url() === route('initial_bank_cash_balance.active.search')): ?> class="active" <?php endif; ?>>
                                        <a <?php if(config('role_manage.InitialBankCashBalance.All') == 0): ?> class="dis-none" <?php endif; ?>
                                            href="<?php echo e(route('initial_bank_cash_balance')); ?>">All</a>
                                    </li>
                                    <li <?php if(Request::url() === route('initial_bank_cash_balance.create')): ?> class="active" <?php endif; ?>>
                                        <a <?php if(config('role_manage.InitialBankCashBalance.Create') == 0): ?> class="dis-none" <?php endif; ?>
                                            href="<?php echo e(route('initial_bank_cash_balance.create')); ?>">Create</a>
                                    </li>
                                    <li <?php if(Request::url() === route('initial_bank_cash_balance.trashed') or
                                        Request::url() === route('initial_bank_cash_balance.trashed.search')): ?> class="active" <?php endif; ?>>
                                        <a <?php if(config('role_manage.InitialBankCashBalance.TrashShow') == 0): ?> class="dis-none" <?php endif; ?>
                                            href="<?php echo e(route('initial_bank_cash_balance.trashed')); ?>">Trashed</a>
                                    </li>
                                </ul>
                            </li>
                            
                            
                            <li <?php if(config('role_manage.InitialIncomeExpenseHeadBalance.All') == 0 and
                                config('role_manage.InitialIncomeExpenseHeadBalance.TrashShow') == 0 and
                                config('role_manage.InitialIncomeExpenseHeadBalance.Create') == 0): ?> class="dis-none" <?php endif; ?>
                                <?php if(Request::url() === route('initial_income_expense_head_balance') or
                                    Request::url() === route('initial_income_expense_head_balance.create') or
                                    Request::url() === route('initial_income_expense_head_balance.trashed') or
                                    Request::url() === route('initial_income_expense_head_balance.active.search') or
                                    Request::url() === route('initial_income_expense_head_balance.trashed.search')): ?> class="active " <?php endif; ?>>
                                <a class="menu-toggle " href="javascript:void(0);">
                                    <span>Ledger</span>
                                </a>
                                <ul class="ml-menu">
                                    <li <?php if(Request::url() === route('initial_income_expense_head_balance') or
                                        Request::url() === route('initial_income_expense_head_balance.active.search')): ?> class="active" <?php endif; ?>>
                                        <a <?php if(config('role_manage.InitialIncomeExpenseHeadBalance.All') == 0): ?> class="dis-none" <?php endif; ?>
                                            href="<?php echo e(route('initial_income_expense_head_balance')); ?>">All</a>
                                    </li>
                                    <li <?php if(Request::url() === route('initial_income_expense_head_balance.create')): ?> class="active" <?php endif; ?>>
                                        <a <?php if(config('role_manage.InitialIncomeExpenseHeadBalance.Create') == 0): ?> class="dis-none" <?php endif; ?>
                                            href="<?php echo e(route('initial_income_expense_head_balance.create')); ?>">Create</a>
                                    </li>
                                    <li <?php if(Request::url() === route('initial_income_expense_head_balance.trashed') or
                                        Request::url() === route('initial_income_expense_head_balance.trashed.search')): ?> class="active" <?php endif; ?>>
                                        <a <?php if(config('role_manage.InitialIncomeExpenseHeadBalance.TrashShow') == 0): ?> class="dis-none" <?php endif; ?>
                                            href="<?php echo e(route('initial_income_expense_head_balance.trashed')); ?>">Trashed</a>
                                    </li>
                                </ul>
                            </li>
                            
                        </ul>
                    </li>
                <?php endif; ?>
                

                
                <li <?php if(config('role_manage.CrVoucher.All') == 0 and
                    config('role_manage.CrVoucher.TrashShow') == 0 and
                    config('role_manage.CrVoucher.Create') == 0 and
                    config('role_manage.DrVoucher.All') == 0 and
                    config('role_manage.DrVoucher.TrashShow') == 0 and
                    config('role_manage.DrVoucher.Create') == 0 and
                    config('role_manage.JnlVoucher.All') == 0 and
                    config('role_manage.JnlVoucher.TrashShow') == 0 and
                    config('role_manage.JnlVoucher.Create') == 0 and
                    config('role_manage.ContraVoucher.All') == 0 and
                    config('role_manage.ContraVoucher.TrashShow') == 0 and
                    config('role_manage.ContraVoucher.Create') == 0): ?> class="dis-none" <?php endif; ?>
                    <?php if(Request::url() === route('dr_voucher') or
                        Request::url() === route('dr_voucher.create') or
                        Request::url() === route('dr_voucher.trashed') or
                        Request::url() === route('dr_voucher.active.search') or
                        Request::url() === route('dr_voucher.trashed.search') or
                        Request::url() === route('cr_voucher') or
                        Request::url() === route('cr_voucher.create') or
                        Request::url() === route('cr_voucher.trashed') or
                        Request::url() === route('cr_voucher.active.search') or
                        Request::url() === route('cr_voucher.trashed.search') or
                        Request::url() === route('jnl_voucher') or
                        Request::url() === route('jnl_voucher.create') or
                        Request::url() === route('jnl_voucher.trashed') or
                        Request::url() === route('jnl_voucher.active.search') or
                        Request::url() === route('jnl_voucher.trashed.search') or
                        Request::url() === route('contra_voucher') or
                        Request::url() === route('contra_voucher.create') or
                        Request::url() === route('contra_voucher.trashed') or
                        Request::url() === route('contra_voucher.active.search') or
                        Request::url() === route('contra_voucher.trashed.search')): ?> class="active " <?php endif; ?>>
                    <a class="menu-toggle" href="javascript:void(0);">
                        <i class="material-icons">account_balance_wallet</i>
                        <span><?php echo e(__('root.menu.voucher')); ?></span>
                    </a>

                    <ul class="ml-menu">

                        

                        <li <?php if(config('role_manage.CrVoucher.All') == 0 and
                            config('role_manage.CrVoucher.TrashShow') == 0 and
                            config('role_manage.CrVoucher.Create') == 0): ?> class="dis-none" <?php endif; ?>
                            <?php if(Request::url() === route('cr_voucher') or
                                Request::url() === route('cr_voucher.create') or
                                Request::url() === route('cr_voucher.trashed') or
                                Request::url() === route('cr_voucher.active.search') or
                                Request::url() === route('cr_voucher.trashed.search')): ?> class="active " <?php endif; ?>>
                            <a class="menu-toggle " href="javascript:void(0);">
                                <i class="fas fa-arrow-right"></i>
                                <span><?php echo e(__('root.menu.voucher_credit')); ?></span>
                            </a>

                            <ul class="ml-menu">
                                <li <?php if(Request::url() === route('cr_voucher') or Request::url() === route('cr_voucher.active.search')): ?> class="active" <?php endif; ?>>
                                    <a <?php if(config('role_manage.CrVoucher.All') == 0): ?> class="dis-none" <?php endif; ?>
                                        href="<?php echo e(route('cr_voucher')); ?>"><?php echo e(__('root.menu.voucher_all')); ?></a>
                                </li>
                                <li <?php if(Request::url() === route('cr_voucher.create')): ?> class="active" <?php endif; ?>>
                                    <a <?php if(config('role_manage.CrVoucher.Create') == 0): ?> class="dis-none" <?php endif; ?>
                                        href="<?php echo e(route('cr_voucher.create')); ?>"><?php echo e(__('root.menu.voucher_create')); ?></a>
                                </li>
                                <li <?php if(Request::url() === route('cr_voucher.trashed') or Request::url() === route('cr_voucher.trashed.search')): ?> class="active" <?php endif; ?>>
                                    <a <?php if(config('role_manage.CrVoucher.TrashShow') == 0): ?> class="dis-none" <?php endif; ?>
                                        href="<?php echo e(route('cr_voucher.trashed')); ?>"><?php echo e(__('root.menu.voucher_trashed')); ?></a>
                                </li>
                            </ul>
                        </li>

                        

                        

                        <li <?php if(config('role_manage.DrVoucher.All') == 0 and
                            config('role_manage.DrVoucher.TrashShow') == 0 and
                            config('role_manage.DrVoucher.Create') == 0): ?> class="dis-none" <?php endif; ?>
                            <?php if(Request::url() === route('dr_voucher') or
                                Request::url() === route('dr_voucher.create') or
                                Request::url() === route('dr_voucher.trashed') or
                                Request::url() === route('dr_voucher.active.search') or
                                Request::url() === route('dr_voucher.trashed.search')): ?> class="active " <?php endif; ?>>
                            <a class="menu-toggle " href="javascript:void(0);">
                                <i class="fas fa-arrow-left"></i>
                                <span><?php echo e(__('root.menu.debit')); ?></span>
                            </a>

                            <ul class="ml-menu">
                                <li <?php if(Request::url() === route('dr_voucher') or Request::url() === route('dr_voucher.active.search')): ?> class="active" <?php endif; ?>>
                                    <a <?php if(config('role_manage.DrVoucher.All') == 0): ?> class="dis-none" <?php endif; ?>
                                        href="<?php echo e(route('dr_voucher')); ?>"><?php echo e(__('root.menu.debit_all')); ?></a>
                                </li>
                                <li <?php if(Request::url() === route('dr_voucher.create')): ?> class="active" <?php endif; ?>>
                                    <a <?php if(config('role_manage.DrVoucher.Create') == 0): ?> class="dis-none" <?php endif; ?>
                                        href="<?php echo e(route('dr_voucher.create')); ?>"><?php echo e(__('root.menu.debit_create')); ?></a>
                                </li>
                                <li <?php if(Request::url() === route('dr_voucher.trashed') or Request::url() === route('dr_voucher.trashed.search')): ?> class="active" <?php endif; ?>>
                                    <a <?php if(config('role_manage.DrVoucher.TrashShow') == 0): ?> class="dis-none" <?php endif; ?>
                                        href="<?php echo e(route('dr_voucher.trashed')); ?>"><?php echo e(__('root.menu.debit_trashed')); ?></a>
                                </li>
                            </ul>
                        </li>

                        


                        

                        <li <?php if(config('role_manage.JnlVoucher.All') == 0 and
                            config('role_manage.JnlVoucher.TrashShow') == 0 and
                            config('role_manage.JnlVoucher.Create') == 0): ?> class="dis-none" <?php endif; ?>
                            <?php if(Request::url() === route('jnl_voucher') or
                                Request::url() === route('jnl_voucher.create') or
                                Request::url() === route('jnl_voucher.trashed') or
                                Request::url() === route('jnl_voucher.active.search') or
                                Request::url() === route('jnl_voucher.trashed.search')): ?> class="active " <?php endif; ?>>
                            <a class="menu-toggle " href="javascript:void(0);">
                                <i class="fas fa-arrows-alt-h"></i>
                                <span><?php echo e(__('root.menu.journal')); ?></span>
                            </a>

                            <ul class="ml-menu">
                                <li <?php if(Request::url() === route('jnl_voucher') or Request::url() === route('jnl_voucher.active.search')): ?> class="active" <?php endif; ?>>
                                    <a <?php if(config('role_manage.JnlVoucher.All') == 0): ?> class="dis-none" <?php endif; ?>
                                        href="<?php echo e(route('jnl_voucher')); ?>"><?php echo e(__('root.menu.journal_all')); ?></a>
                                </li>
                                <li <?php if(Request::url() === route('jnl_voucher.create')): ?> class="active" <?php endif; ?>>
                                    <a <?php if(config('role_manage.JnlVoucher.Create') == 0): ?> class="dis-none" <?php endif; ?>
                                        href="<?php echo e(route('jnl_voucher.create')); ?>"><?php echo e(__('root.menu.journal_create')); ?></a>
                                </li>
                                <li <?php if(Request::url() === route('jnl_voucher.trashed') or Request::url() === route('jnl_voucher.trashed.search')): ?> class="active" <?php endif; ?>>
                                    <a <?php if(config('role_manage.JnlVoucher.TrashShow') == 0): ?> class="dis-none" <?php endif; ?>
                                        href="<?php echo e(route('jnl_voucher.trashed')); ?>"><?php echo e(__('root.menu.journal_trashed')); ?></a>
                                </li>
                            </ul>
                        </li>

                        

                        

                        <li <?php if(config('role_manage.ContraVoucher.All') == 0 and
                            config('role_manage.ContraVoucher.TrashShow') == 0 and
                            config('role_manage.ContraVoucher.Create') == 0): ?> class="dis-none" <?php endif; ?>
                            <?php if(Request::url() === route('contra_voucher') or
                                Request::url() === route('contra_voucher.create') or
                                Request::url() === route('contra_voucher.trashed') or
                                Request::url() === route('contra_voucher.active.search') or
                                Request::url() === route('contra_voucher.trashed.search')): ?> class="active " <?php endif; ?>>
                            <a class="menu-toggle " href="javascript:void(0);">
                                <i class="fas fa-arrows-alt-h"></i>
                                <span><?php echo e(__('root.menu.contra')); ?></span>
                            </a>

                            <ul class="ml-menu">
                                <li <?php if(Request::url() === route('contra_voucher') or Request::url() === route('contra_voucher.active.search')): ?> class="active" <?php endif; ?>>
                                    <a <?php if(config('role_manage.ContraVoucher.All') == 0): ?> class="dis-none" <?php endif; ?>
                                        href="<?php echo e(route('contra_voucher')); ?>"><?php echo e(__('root.menu.contra_all')); ?></a>
                                </li>
                                <li <?php if(Request::url() === route('contra_voucher.create')): ?> class="active" <?php endif; ?>>
                                    <a <?php if(config('role_manage.ContraVoucher.Create') == 0): ?> class="dis-none" <?php endif; ?>
                                        href="<?php echo e(route('contra_voucher.create')); ?>"><?php echo e(__('root.menu.contra_create')); ?></a>
                                </li>
                                <li <?php if(Request::url() === route('contra_voucher.trashed') or
                                    Request::url() === route('contra_voucher.trashed.search')): ?> class="active" <?php endif; ?>>
                                    <a <?php if(config('role_manage.ContraVoucher.TrashShow') == 0): ?> class="dis-none" <?php endif; ?>
                                        href="<?php echo e(route('contra_voucher.trashed')); ?>"><?php echo e(__('root.menu.contra_trashed')); ?></a>
                                </li>
                            </ul>
                        </li>

                        

                    </ul>
                </li>

                

                

                <?php
            
                $AccountsShow = (config('role_manage.Ledger.All') or config('role_manage.TrialBalance.All') or config('role_manage.CostOfRevenue.All') or config('role_manage.ProfitOrLossAccount.All') or config('role_manage.RetainedEarning.All') or config('role_manage.FixedAssetsSchedule.All') or config('role_manage.StatementOfFinancialPosition.All') or config('role_manage.CashFlow.All') or config('role_manage.ReceiveAndPayment.All') or config('role_manage.Notes.All'));
                
                $generalShow = (config('role_manage.GeneralBranch.All') or config('role_manage.GeneralLedger.All') or config('role_manage.GeneralBankCash.All') or config('role_manage.GeneralVoucher.All'));
                
                ?>

                <li <?php if($AccountsShow == false and $generalShow == false): ?> class="dis-none" <?php endif; ?>
                    <?php if(Request::url() === route('reports.accounts.ledger') or
                        Request::url() === route('reports.accounts.trial_balance') or
                        Request::url() === route('reports.accounts.cost_of_revenue') or
                        Request::url() === route('reports.accounts.profit_or_loss_account') or
                        Request::url() === route('reports.accounts.retained_earnings') or
                        Request::url() === route('reports.accounts.fixed_asset_schedule') or
                        Request::url() === route('reports.accounts.balance_sheet') or
                        Request::url() === route('reports.accounts.receive_payment') or
                        Request::url() === route('reports.accounts.notes') or
                        Request::url() === route('reports.accounts.cash_flow') or
                        Request::url() === route('reports.general.branch') or
                        Request::url() === route('reports.general.ledger.type') or
                        Request::url() === route('reports.general.bank_cash') or
                        Request::url() === route('reports.general.voucher')): ?> class="active " <?php endif; ?>>
                    <a class="menu-toggle" href="javascript:void(0);">
                        <i class="fas fa-receipt"></i>
                        <span><?php echo e(__('root.menu.report')); ?></span>
                    </a>
                    <ul class="ml-menu">
                        
                        <li <?php if($AccountsShow == false): ?> class="dis-none" <?php endif; ?>
                            <?php if(Request::url() === route('reports.accounts.ledger') or
                                Request::url() === route('reports.accounts.trial_balance') or
                                Request::url() === route('reports.accounts.cost_of_revenue') or
                                Request::url() === route('reports.accounts.profit_or_loss_account') or
                                Request::url() === route('reports.accounts.retained_earnings') or
                                Request::url() === route('reports.accounts.fixed_asset_schedule') or
                                Request::url() === route('reports.accounts.balance_sheet') or
                                Request::url() === route('reports.accounts.receive_payment') or
                                Request::url() === route('reports.accounts.notes') or
                                Request::url() === route('reports.accounts.cash_flow')): ?> class="active " <?php endif; ?>>
                            <a class="menu-toggle " href="javascript:void(0);">
                                <span><?php echo e(__('root.menu.accounts')); ?> </span>
                            </a>
                            <ul class="ml-menu">
                                <li <?php if(config('role_manage.Ledger.All') == 0): ?> class="dis-none" <?php endif; ?>
                                    <?php if(Request::url() === route('reports.accounts.ledger')): ?> class="active " <?php endif; ?>>
                                    <a href="<?php echo e(route('reports.accounts.ledger')); ?>"><?php echo e(__('root.menu.ledger')); ?></a>
                                </li>
                                <li <?php if(config('role_manage.TrialBalance.All') == 0): ?> class="dis-none" <?php endif; ?>
                                    <?php if(Request::url() === route('reports.accounts.trial_balance')): ?> class="active " <?php endif; ?>>
                                    <a href="<?php echo e(route('reports.accounts.trial_balance')); ?>"><?php echo e(__('root.menu.trial_balance')); ?></a>
                                </li>
                                <li <?php if(config('role_manage.CostOfRevenue.All') == 0): ?> class="dis-none" <?php endif; ?>
                                    <?php if(Request::url() === route('reports.accounts.cost_of_revenue')): ?> class="active " <?php endif; ?>>
                                    <a href="<?php echo e(route('reports.accounts.cost_of_revenue')); ?>"><?php echo e(__('root.menu.cost_of_revenue')); ?></a>
                                </li>
                                <li <?php if(config('role_manage.ProfitOrLossAccount.All') == 0): ?> class="dis-none" <?php endif; ?>
                                    <?php if(Request::url() === route('reports.accounts.profit_or_loss_account')): ?> class="active " <?php endif; ?>>
                                    <a href="<?php echo e(route('reports.accounts.profit_or_loss_account')); ?>"><?php echo e(__('root.menu.profit_or_loss_account')); ?></a>
                                </li>
                                <li <?php if(config('role_manage.RetainedEarning.All') == 0): ?> class="dis-none" <?php endif; ?>
                                    <?php if(Request::url() === route('reports.accounts.retained_earnings')): ?> class="active " <?php endif; ?>>
                                    <a href="<?php echo e(route('reports.accounts.retained_earnings')); ?>"><?php echo e(__('root.menu.retained_earnings')); ?></a>
                                </li>
                                <li <?php if(config('role_manage.FixedAssetsSchedule.All') == 0): ?> class="dis-none" <?php endif; ?>
                                    <?php if(Request::url() === route('reports.accounts.fixed_asset_schedule')): ?> class="active " <?php endif; ?>>
                                    <a href="<?php echo e(route('reports.accounts.fixed_asset_schedule')); ?>"><?php echo e(__('root.menu.fixed_asset_schedule')); ?></a>
                                </li>
                                <li <?php if(config('role_manage.StatementOfFinancialPosition.All') == 0): ?> class="dis-none" <?php endif; ?>
                                    <?php if(Request::url() === route('reports.accounts.balance_sheet')): ?> class="active " <?php endif; ?>>
                                    <a href=" <?php echo e(route('reports.accounts.balance_sheet')); ?> "><?php echo e(__('root.menu.balance_sheet')); ?></a>
                                </li>

                                <li <?php if(config('role_manage.CashFlow.All') == 0): ?> class="dis-none" <?php endif; ?>
                                    <?php if(Request::url() === route('reports.accounts.cash_flow')): ?> class="active" <?php endif; ?>>
                                    <a href="<?php echo e(route('reports.accounts.cash_flow')); ?>"><?php echo e(__('root.menu.cash_flow')); ?></a>
                                </li>

                                <li <?php if(config('role_manage.ReceiveAndPayment.All') == 0): ?> class="dis-none" <?php endif; ?>
                                    <?php if(Request::url() === route('reports.accounts.receive_payment')): ?> class="active " <?php endif; ?>>
                                    <a href="<?php echo e(route('reports.accounts.receive_payment')); ?>"><?php echo e(__('root.menu.receive_payment')); ?></a>
                                </li>
                                <li <?php if(config('role_manage.Notes.All') == 0): ?> class="dis-none" <?php endif; ?>
                                    <?php if(Request::url() === route('reports.accounts.notes')): ?> class="active " <?php endif; ?>>
                                    <a href="<?php echo e(route('reports.accounts.notes')); ?>"><?php echo e(__('root.menu.notes')); ?></a>
                                </li>
                            </ul>
                        </li>

                        

                        
                        <li <?php if($generalShow == false): ?> class="dis-none" <?php endif; ?>
                            <?php if(Request::url() === route('reports.general.branch') or
                                Request::url() === route('reports.general.ledger.type') or
                                Request::url() === route('reports.general.bank_cash') or
                                Request::url() === route('reports.general.voucher')): ?> class="active " <?php endif; ?>>
                            <a class="menu-toggle " href="javascript:void(0);">
                                <span><?php echo e(__('root.menu.general')); ?></span>
                            </a>

                            <ul class="ml-menu">
                                <li <?php if(config('role_manage.GeneralBranch.All') == 0): ?> class="dis-none" <?php endif; ?>
                                    <?php if(Request::url() === route('reports.general.branch')): ?> class="active " <?php endif; ?>>
                                    <a href="<?php echo e(route('reports.general.branch')); ?>"><?php echo e(__('root.menu.general_branch')); ?></a>
                                </li>

                                <li <?php if(config('role_manage.GeneralLedger.All') == 0): ?> class="dis-none" <?php endif; ?>
                                    <?php if(Request::url() === route('reports.general.ledger.type')): ?> class="active " <?php endif; ?>>
                                    <a href="<?php echo e(route('reports.general.ledger.type')); ?>"><?php echo e(__('root.menu.general_ledger')); ?></a>
                                </li>

                                <li <?php if(config('role_manage.GeneralBankCash.All') == 0): ?> class="dis-none" <?php endif; ?>
                                    <?php if(Request::url() === route('reports.general.bank_cash')): ?> class="active " <?php endif; ?>>
                                    <a href="<?php echo e(route('reports.general.bank_cash')); ?>"><?php echo e(__('root.menu.general_bank_cash')); ?></a>
                                </li>

                                <li <?php if(config('role_manage.GeneralVoucher.All') == 0): ?> class="dis-none" <?php endif; ?>
                                    <?php if(Request::url() === route('reports.general.voucher')): ?> class="active " <?php endif; ?>>
                                    <a href="<?php echo e(route('reports.general.voucher')); ?>"><?php echo e(__('root.menu.general_voucher')); ?></a>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                </li>
                
                
                <!-- <li <?php if(config('role_manage.Language.All') == 0 and
                    config('role_manage.Language.TrashShow') == 0 and
                    config('role_manage.Language.Create') == 0): ?> class="dis-none" <?php endif; ?>
                    <?php if(Request::url() === route('language') or
                        Request::url() === route('language.create') or
                        Request::url() === route('language.trashed') or
                        Request::url() === route('language.active.search') or
                        Request::url() === route('language.trashed.search')): ?> class="active " <?php endif; ?>>
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-language"></i>
                        <span><?php echo e(__('root.menu.language')); ?></span>
                    </a>
                    <ul class="ml-menu">
                        <li <?php if(Request::url() === route('language') or Request::url() === route('language.active.search')): ?> class="active" <?php endif; ?>>
                            <a <?php if(config('role_manage.Language.All') == 0): ?> class="dis-none" <?php endif; ?>
                                href="<?php echo e(route('language')); ?>"><?php echo e(__('root.menu.language_all')); ?></a>
                        </li>
                        <li <?php if(Request::url() === route('language.create')): ?> class="active" <?php endif; ?>>
                            <a <?php if(config('role_manage.Language.Create') == 0): ?> class="dis-none" <?php endif; ?>
                                href="<?php echo e(route('language.create')); ?>"><?php echo e(__('root.menu.language_create')); ?></a>
                        </li>
                        <li <?php if(Request::url() === route('language.trashed') or Request::url() === route('language.trashed.search')): ?> class="active" <?php endif; ?>>
                            <a <?php if(config('role_manage.Language.TrashShow') == 0): ?> class="dis-none" <?php endif; ?>
                                href="<?php echo e(route('language.trashed')); ?>"><?php echo e(__('root.menu.language_trashed')); ?></a>
                        </li>
                    </ul>
                </li> -->
                



                


                <li >
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-coins"></i>
                        <span>Expenses</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a
                                href="<?php echo e(route('bill_recieved')); ?>">Bill Received Create</a>
                        </li>
                        <li>
                            <a
                                href="<?php echo e(route('bill_recieved_list')); ?>">Bill Received List</a>
                        </li>
                       
                    </ul>
                </li>

                





<li >
    <a class="menu-toggle " href="javascript:void(0);">
        <i class="fas fa-coins"></i>
        <span>Budget</span>
    </a>
    <ul class="ml-menu">
        <li>
            <a
                href="<?php echo e(route('session_budget')); ?>">Session Budget</a>
        </li>
      <!--  <li>
                            <a
                                href="<?php echo e(route('session_budget_list')); ?>">Session Budget List</a>
                        </li> -->

       

                        <li>
                            <a
                                href="<?php echo e(route('session_budget_report')); ?>">Budget Report</a>
                        </li>



    </ul>
</li>



                
                <li <?php if(config('role_manage.User.All') == 0 and
                    config('role_manage.User.TrashShow') == 0 and
                    config('role_manage.User.Create') == 0): ?> class="dis-none" <?php endif; ?>
                    <?php if(Request::url() === route('user') or
                        Request::url() === route('user.create') or
                        Request::url() === route('user.trashed') or
                        Request::url() === route('user.active.search') or
                        Request::url() === route('user.trashed.search')): ?> class="active " <?php endif; ?>>
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-user"></i>
                        <span>User</span>
                    </a>
                    <ul class="ml-menu">
                        <li <?php if(Request::url() === route('user') or Request::url() === route('user.active.search')): ?> class="active" <?php endif; ?>>
                            <a <?php if(config('role_manage.User.All') == 0): ?> class="dis-none" <?php endif; ?>
                                href="<?php echo e(route('user')); ?>"><?php echo e(__('root.menu.user_all')); ?></a>
                        </li>
                        <li <?php if(Request::url() === route('user.create')): ?> class="active" <?php endif; ?>>
                            <a <?php if(config('role_manage.User.Create') == 0): ?> class="dis-none" <?php endif; ?>
                                href="<?php echo e(route('user.create')); ?>"><?php echo e(__('root.menu.user_create')); ?></a>
                        </li>
                        <li <?php if(Request::url() === route('user.trashed') or Request::url() === route('user.trashed.search')): ?> class="active" <?php endif; ?>>
                            <a <?php if(config('role_manage.User.TrashShow') == 0): ?> class="dis-none" <?php endif; ?>
                                href="<?php echo e(route('user.trashed')); ?>"><?php echo e(__('root.menu.user_trashed')); ?></a>
                        </li>
                    </ul>
                </li>
                


                
                <li <?php if(Request::url() === route('role-manage') or
                    Request::url() === route('role-manage.create') or
                    Request::url() === route('role-manage.trashed') or
                    Request::url() === route('role-manage.active.search') or
                    Request::url() === route('role-manage.trashed.search')): ?> class="active" <?php endif; ?>
                    <?php if(config('role_manage.RoleManager.All') == 0 and
                        config('role_manage.RoleManager.TrashShow') == 0 and
                        config('role_manage.RoleManager.Create') == 0): ?> class="dis-none" <?php endif; ?>>
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-user-lock "></i>
                        <span><?php echo e(__('root.menu.role_manage')); ?></span>
                    </a>

                    <ul class="ml-menu">
                        <li <?php if(Request::url() === route('role-manage') or Request::url() === route('role-manage.active.search')): ?> class="active" <?php endif; ?>>
                            <a <?php if(config('role_manage.RoleManager.All') == 0): ?> class="dis-none" <?php endif; ?>
                                href="<?php echo e(route('role-manage')); ?>"><?php echo e(__('root.menu.role_manage_all')); ?></a>
                        </li>
                        <li <?php if(Request::url() === route('role-manage.create')): ?> class="active" <?php endif; ?>>
                            <a <?php if(config('role_manage.RoleManager.Create') == 0): ?> class="dis-none" <?php endif; ?>
                                href="<?php echo e(route('role-manage.create')); ?>"><?php echo e(__('root.menu.role_manage_create')); ?></a>
                        </li>
                        <li <?php if(Request::url() === route('role-manage.trashed') or Request::url() === route('role-manage.trashed.search')): ?> class="active" <?php endif; ?>>
                            <a <?php if(config('role_manage.RoleManager.TrashShow') == 0): ?> class="dis-none" <?php endif; ?>
                                href="<?php echo e(route('role-manage.trashed')); ?>"><?php echo e(__('root.menu.role_manage_trashed')); ?></a>
                        </li>
                    </ul>
                </li>
                

                
                <li <?php if(Request::url() === route('settings.system') or Request::url() === route('settings.general')): ?> class="active" <?php endif; ?>
                    <?php if(config('role_manage.Settings.All') == 0 and config('role_manage.Settings.Show') == 0): ?> class="dis-none" <?php endif; ?>>
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="material-icons">settings</i>
                        <span><?php echo e(__('root.menu.settings')); ?></span>
                    </a>
                    <ul class="ml-menu">
                        <li <?php if(config('role_manage.Settings.All') == 0): ?> class="dis-none" <?php endif; ?>
                            <?php if(Request::url() === route('settings.general')): ?> class="active" <?php endif; ?>>
                            <a href="<?php echo e(route('settings.general')); ?>"> <?php echo e(__('root.menu.settings_general')); ?> </a>
                        </li>
                        <li <?php if(config('role_manage.Settings.Show') == 0): ?> class="dis-none" <?php endif; ?>
                            <?php if(Request::url() === route('settings.system')): ?> class="active" <?php endif; ?>>
                            <a href="<?php echo e(route('settings.system')); ?>"><?php echo e(__('root.menu.settings_system')); ?></a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">

                            </a>
                        </li>
                    </ul>
                </li>
                
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                <?php echo e(config('settings.developed_label')); ?> 
            </div>
            <div class="version">
            <a target="_blank"
            href="https://ebiztechnocrats.com/">e-Biz Technocrats Pvt. Ltd.</a>
            </div>
        </div>
        <!-- #Footer -->
    </aside>
</section>
<?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/includes/left-sidebar.blade.php ENDPATH**/ ?>