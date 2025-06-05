<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php $ApplicationName = Config::get('settings.company_name'); ?>

    <title><?php echo $__env->yieldContent('title', 'Welcome To | ' . $ApplicationName); ?></title>

    <!-- Favicon-->
    <?php $image = Config::get('settings.company_logo'); ?>
    <link rel="icon" href="<?php echo e(asset($image)); ?>" type="image/x-icon">

    <!-- Google Fonts -->

    <link href="<?php echo e(asset('asset/css/font-g/font-1.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('asset/css/font-g/icon-1.css')); ?>" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo e(asset('asset/plugins/bootstrap/css/bootstrap.css')); ?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo e(asset('asset/plugins/node-waves/waves.css')); ?>" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo e(asset('asset/plugins/animate-css/animate.css')); ?>" rel="stylesheet" />

    <!-- Morris Chart Css -->
    <link href="<?php echo e(asset('asset/plugins/morrisjs/morris.css')); ?>" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="<?php echo e(asset('asset/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')); ?>"
        rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo e(asset('asset/css/toastr/toastr.css')); ?>">
    <?php echo $__env->yieldPushContent('include-css'); ?>
    <!-- Custom Css -->
    <link href="<?php echo e(asset('asset/css/style.css')); ?>" rel="stylesheet">
    <?php if($is_rtl): ?>
        <link href="<?php echo e(asset('asset/css/style-rtl.css')); ?>" rel="stylesheet">
    <?php endif; ?>
    <!-- Fonts Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('asset/css/fontawesome.css')); ?>">
    <!-- Utility Css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('asset/layout/css/util.css')); ?>">
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo e(asset('asset/css/themes/all-themes.css')); ?>" rel="stylesheet" />
</head>

<body class="theme-light-blue">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <?php echo $__env->yieldContent('top-bar'); ?>
    <!-- #Top Bar -->
    <!-- Left Sidebar -->
    <?php echo $__env->yieldContent('left-sidebar'); ?>
    <!-- #END# Left Sidebar -->
    <?php echo $__env->yieldContent('content'); ?>
    <!-- base url generator -->
    <script>
        window.url = "<?php echo url('/'); ?>/";
        window.appDebug = parseInt("<?php echo e(env('APP_DEBUG')); ?>");
    </script>

    <!-- Jquery Core Js -->
    <script src="<?php echo e(asset('asset/plugins/jquery/jquery.min.js')); ?>"></script>
    <!-- Bootstrap Core Js -->
    <script src="<?php echo e(asset('asset/plugins/bootstrap/js/bootstrap.js')); ?>"></script>
    <!-- Select Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/bootstrap-select/js/bootstrap-select.js')); ?>"></script>
    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/jquery-slimscroll/jquery.slimscroll.js')); ?>"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo e(asset('asset/plugins/node-waves/waves.js')); ?>"></script>

    <!-- Custom Js -->
    <?php if($is_rtl): ?>
        <script src="<?php echo e(Helper::assetV('asset/js/admin-rtl.js')); ?>"></script>
    <?php else: ?>
        <script src="<?php echo e(Helper::assetV('asset/js/admin.js')); ?>"></script>
    <?php endif; ?>

    <script src="<?php echo e(asset('asset/js/pages/ui/tooltips-popovers.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/js/toastr.min.js')); ?>"></script>
    <!-- Demo Js -->
    <script src="<?php echo e(asset('asset/js/demo.js')); ?>"></script>

    <!-- axios Js -->
    <script src="<?php echo e(asset('asset/js/axios.min.js')); ?>"></script>
    <script src="<?php echo e(Helper::assetV('asset/js/helpers.js')); ?>"></script>
    <!-- page ways script -->
    <?php echo $__env->yieldPushContent('include-js'); ?>
</body>

</html>
<?php /**PATH D:\xampp\htdocs\madhaverp_13_11\eaccount\resources\views/layouts/app.blade.php ENDPATH**/ ?>