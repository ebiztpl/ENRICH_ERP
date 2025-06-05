

<?php $__env->startSection('title'); ?>
    <?php echo e($extra['module_name']); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="mid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <table class="table table-bordered table-sm table-hover">
                    <thead>
                        <tr>
                            <th colspan="4">
                                <?php echo e($extra['module_name']); ?>

                            </th>
                        </tr>
                        <tr>
                            <th>
                                Sl.No
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Account Number
                            </th>
                            <th>
                                Description
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sl = 1;
                        ?>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($sl); ?></td>
                                <td><?php echo e($item->name); ?></td>
                                <td><?php echo e($item->account_number); ?></td>
                                <td><?php echo e($item->description); ?></td>
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

<?php echo $__env->make('layouts.pdf', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/admin/general-report/bank-cash/date-wise/exl.blade.php ENDPATH**/ ?>