<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <!-- Bootstrap Core Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap/css/bootstrap.css')); ?>" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo e(asset('asset/css/pdf.css')); ?>">


    <title><?php echo e($extra['module_name']); ?></title>
</head>
<body>


<section <?php if($is_rtl): ?> dir="rtl" <?php endif; ?> class="content">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div  class="bb-1 margin-bottom-10">
            <div class="header">
                <p><?php echo e($extra['current_date_time']); ?></p>

                <h1 class="text-center"><?php echo e(Config('settings.company_name')); ?></h1>
                <p class="text-center"><?php echo e(Config('settings.address_1')); ?></p>

            </div>
        </div>
        <div class="module_name">
            <p>Module Name : <?php echo e($extra['module_name']); ?></p>
        </div>
        <div class="card">
            <div class="header">
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table class="table  table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center">Name</th>
                                    <th>Ledger Type Name</th>
                                    <th>Ledger Group Name</th>
                                    <th scope="col" class="text-center">Unit</th>
                                    <th scope="col" class="text-center">Type</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <td class="text-center">
                                        <?php echo e($items->name); ?>

                                    </td>
                                    <td class="text-center">
                                        <?php echo e(App\IncomeExpenseHead::find($items->id)
                                               ->IncomeExpenseType->name); ?>

                                    </td>

                                    <td><?php echo e(App\IncomeExpenseHead::find($items->id)
                                                    ->IncomeExpenseGroup->name); ?></td>


                                    <td class="text-center">
                                        <?php echo e($items->unit); ?>

                                    </td>
                                    <td class="text-center">
                                        <?php if($items->type=='0'): ?>
                                            Cr
                                        <?php else: ?>
                                            Dr
                                        <?php endif; ?>

                                    </td>


                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Inline Layout | With Floating Label -->
</section>

</body>
</html>

<?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/admin/income-expense-head/pdf.blade.php ENDPATH**/ ?>