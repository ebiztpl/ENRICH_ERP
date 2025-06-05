<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- Seo meta tag -->
    <meta name="author" content="mamun2074">
    <meta name="keywords"
        content="account, Accounting Software, balance sheet, cash flow, Cost Of Revenue, fixed asset schedule, ledger, multi branch, Profit Or Loss Account, receive payment, trial balance">
    <meta name="description"
        content="E-Account is a dynamic, open source, easy to use, user friendly web base application. Which is built in PHP – MySQL">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon-->
    <?php $image = Config::get('settings.company_logo'); ?>
    <link rel="icon" href="<?php echo e(asset($image)); ?>" type="image/x-icon">
    <!-- End -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- Bootstrap Core Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap/v400/bootstrap.min.css')); ?>" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo e(asset('asset/css/report.css')); ?>">
    <title><?php echo $__env->yieldContent('title', 'Report'); ?></title>
    <?php echo $__env->yieldPushContent('include-css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('asset/layout/css/util.css')); ?>">
</head>

<body>
    <?php echo $__env->yieldContent('content'); ?>
    <!-- Optional JavaScript -->
    <!-- Jquery Core Js -->
    <script src="<?php echo e(asset('asset/plugins/jquery/jquery.min.js')); ?>"></script>
    <!-- Bootstrap Core Js -->
    <script src="<?php echo e(asset('asset/plugins/bootstrap/js/bootstrap.js')); ?>"></script>
</body>

</html>
<?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/layouts/pdf.blade.php ENDPATH**/ ?>