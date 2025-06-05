

<?php $__env->startSection('title'); ?>
    <?php echo e($extra['module_name']); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('include-css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('asset/css/only-voucher.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <?php
    $transaction = new \App\Transaction();
    ?>
    <p>Printing Date & Time: <?php echo e($extra['current_date_time']); ?></p>

    <div>
        <div class="f-l-W-600">
            <img class="width-60 height-60 margin-top-20"
                 src="<?php echo e(asset( config('settings.company_logo'))); ?>"
                 alt="">
        </div>
        <br>
        <div class="f-r width-200 margin-bottom-10">
            <p class="text-a-c border-t-1 border-l-1 border-r-1 line-h-20">
                Voucher No <br></p>
            <p class="text-a-c border-1 line-h-20"><?php echo e(str_pad($items[0]->voucher_no, 4, '0', STR_PAD_LEFT)); ?></p>
        </div>
    </div>
    <br><br><br>
    <div class="border-b-1">
        <h4 class="text-a-c font-w-b"><?php echo e(config('settings.company_name')); ?></h4>
        <h5 class="text-a-c"><?php echo e(config('settings.address_1')); ?></h5>
    </div>
    <h4 class="text-a-c margin-top-20"><?php echo e($extra['voucher_type']); ?></h4>
    <table class="table table-bordered table-sm">
        <tbody>
        <tr>
            <td>Branch Name: <?php echo e(App\Transaction::find($items[0]->id)->Branch->name); ?></td>
            <td>Location: <?php echo e(App\Transaction::find($items[0]->id)->Branch->location); ?></td>
            <td>Made Of Payment: <?php echo e(App\Transaction::find($items[0]->id)->BankCash->name); ?></td>
            <td>Date: <?php echo e(date(config('settings.date_format'), strtotime($items[0]->voucher_date))); ?></td>
        </tr>
        </tbody>
    </table>

    <table class="table table-bordered table-sm">
        <thead>
        <tr>
            <th scope="col" class="text-center">SL.NO</th>

            <th scope="col">Head Of Accounts</th>
            <th scope="col">CHQ. No</th>
            <th scope="col">Amount ( <?php echo (config('settings.is_code') == 'code') ?
                    config('settings.currency_code') : config('settings.currency_symbol')  ?>
                )
        </tr>
        </thead>
        <tbody>

        <?php $total_amount = 0; ?>
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php
            if ($item->cr > 0) {
                $amount = $item->cr;
            } else {
                $amount = $item->dr;
            }
            $total_amount += $amount;
            ?>
            <tr>
                <th scope="row" class="text-center"><?php echo e($key+1); ?></th>
                <td><?php echo e(App\Transaction::find($item->id)->IncomeExpenseHead->name); ?></td>
                <td><?php echo e($item->cheque_number); ?></td>
                <td><?php echo e($transaction->convert_money_format($amount)); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <th scope="row" colspan="3" class="text-right">Total =</th>
            <th><?php echo e($transaction->convert_money_format($total_amount)); ?> /=</th>
        </tr>
        </tbody>
    </table>
    <p>In word: <span
                class="font-w-b"><?php echo e($transaction->convert_number_to_words($total_amount)); ?>  <?php echo config('settings.currency_code'); ?> </span>
        only.
    </p>

    <?php if(!empty($items[0]->particulars)): ?>
        <br>
        <p>Particulars: <span class="font-w-b"> <?php echo e($items[0]->particulars); ?></span></p>
    <?php endif; ?>

    <?php if(count($items)==1): ?>
        <br><br><br><br>
    <?php endif; ?>

    <?php if(count($items)==2): ?>
        <br><br>
    <?php endif; ?>

    <?php if(count($items)==3): ?>
        <br>
    <?php endif; ?>
    <?php if(count($items) >= 4): ?>
        <br><br><br><br>
    <?php endif; ?>

    <table class="table">
        <tr>
            <td class="text-center border-n">
                - - - - -<br>
                Prepared by
            </td>
            <td class="text-center border-n">
                - - - - -<br>
                Checked by
            </td>
            <td class="text-center border-n">
                - - - - -<br>
                Forward by
            </td>
            <td class="text-center border-n">
                - - - - -<br>
                Approved by
            </td>
        </tr>
    </table>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.pdf', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/admin/cr-voucher/pdf.blade.php ENDPATH**/ ?>