<?php
    $class = isset($class) ? $class : '';
    $class_extend = '';
    if (isset($in_map)) {
        $class_extend = '-map';
    }
?>
<div class="hh-loading<?php echo e($class_extend); ?> <?php echo e($class); ?>" style="<?php if(isset($zindex)): ?> z-index: <?php echo e($zindex); ?> <?php endif; ?>">

    <div class="lds-ellipsis">
        <img src="/public/images/loading.gif">
    </div>
</div>
<?php /**PATH C:\xampp7\htdocs\app\Views/common/loading.blade.php ENDPATH**/ ?>