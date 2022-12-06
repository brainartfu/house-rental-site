<?php
    $items = ['page', 'post', 'category', 'tag', 'link', 'home', 'experience', 'car'];
?>
<h4 class="header-title mb-0"><?php echo e(__('Add menu item')); ?></h4>
<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo $__env->make('dashboard.screens.administrator.menu.item-' . $item, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /home/salentovacanze/public_html/app/Views/dashboard/screens/administrator/menu/menu-side.blade.php ENDPATH**/ ?>