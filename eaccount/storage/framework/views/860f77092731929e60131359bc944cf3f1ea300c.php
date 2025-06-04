<nav class="navbar">
    <div class="container-fluid">
        <div <?php if($is_rtl): ?> dir="rtl"  <?php endif; ?> class="rtl-supported-navbar">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <?php $activ = Session::get('branch_array'); $branch_name =$activ->name; ?>
                <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>"><?php echo e($branch_name); ?></a> 
            </div>
            <div>
                <a href="javascript:void(0);" class="dropdown-toggle text-white" data-toggle="dropdown" role="button"
                    aria-haspopup="true" aria-expanded="true">
                    <i class="material-icons">more_vert</i>
                </a>
                <ul class="dropdown-menu <?php if(!$is_rtl): ?> pull-right <?php endif; ?>">
                    <!-- <li><a href="<?php echo e(route('profile')); ?>"><i class="material-icons">person</i>Profile</a></li>
                    <li role="separator" class="divider"></li> -->
                    <li><a href="javascript:void(0); document.getElementById('logout-form').submit();"><i
                                class=" fas fa-sign-out-alt"></i> Back</a></li>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="dis-none">
                        <?php echo csrf_field(); ?>
                    </form>
                </ul>
            </div>
        </div>

        

    </div>
</nav>
<?php /**PATH /var/www/vhosts/enrichapp.co.in/httpdocs/eaccount/resources/views/includes/top-bar.blade.php ENDPATH**/ ?>