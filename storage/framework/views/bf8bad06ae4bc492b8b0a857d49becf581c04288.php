<nav aria-label="breadcrumb">
    <?php if(isset($inContainer)): ?>
        <div class="container">
            <?php endif; ?>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="<?php echo e(url('/')); ?>"><?php echo e(__('Homepage')); ?></a>
                </li>
                <li class="breadcrumb-item"><?php echo e($currentPage); ?></li>
            </ol>
            <?php if(isset($inContainer)): ?>
        </div>
    <?php endif; ?>
</nav>
<?php /**PATH /home/salentovacanze/public_html/app/Views/frontend/components/breadcrumb.blade.php ENDPATH**/ ?>