<?php
$heading = isset($heading) ? $heading : '';
?>
<div class="page-title-box">
    <div class="page-breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(url('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php echo e($heading); ?>

                </li>
            </ol>
        </nav>
    </div>
    <div class="page-title-right">
        <?php do_action('hh_dashboard_breadcrumb'); ?>
    </div>
</div>
<?php /**PATH /home/salentovacanze/public_html/app/Views/dashboard/components/breadcrumb.blade.php ENDPATH**/ ?>