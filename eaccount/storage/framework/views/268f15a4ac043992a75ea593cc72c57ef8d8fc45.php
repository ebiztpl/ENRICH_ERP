<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Seo meta tag -->
    <meta name="author" content="mamun2074">
    <meta name="keywords"
        content="account, Accounting Software, balance sheet, cash flow, Cost Of Revenue, fixed asset schedule, ledger, multi branch, Profit Or Loss Account, receive payment, trial balance">
    <meta name="description"
        content="E-Account is a dynamic, open source, easy to use, user friendly web base application. Which is built in PHP – MySQL">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- End -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Welcome To | ' . Config::get('settings.company_name')); ?></title>
    <link rel="icon" href="<?php echo e(asset(Config::get('settings.company_logo'))); ?>" type="image/x-icon">
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('asset/layout/fonts/font-awesome-4.7.0/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('asset/layout/fonts/iconic/css/material-design-iconic-font.min.css')); ?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('asset/css/e-bootstrap.min.css')); ?>">
    
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('asset/layout/css/util.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('asset/layout/css/main.css')); ?>">
</head>

<body>
    <div>
        <?php echo $__env->yieldContent('auth-body'); ?>
    </div>
    <!-- Jquery Core Js -->
    <script src="<?php echo e(asset('asset/layout/vendor/jquery/jquery-3.2.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/layout/js/main.js')); ?>"></script>
</body>

</html>
<?php /**PATH D:\xampp\htdocs\madhav_collage_erp\eaccount\resources\views/layouts/etemplate.blade.php ENDPATH**/ ?>