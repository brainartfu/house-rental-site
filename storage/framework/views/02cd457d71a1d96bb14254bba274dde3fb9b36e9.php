<?php
$layout = (!empty($layout)) ? $layout : 'col-12';
if ($value === '') {
    $value = $std;
}
$idName = str_replace(['[', ']'], '_', $id);
?>

<div id="setting-<?php echo e($idName); ?>" data-condition="<?php echo e($condition); ?>"
     data-unique="<?php echo e($unique); ?>"
     data-operator="<?php echo e($operation); ?>"
     class="form-group mb-3 col <?php echo e($layout); ?> field-<?php echo e($type); ?>">
    <label for="<?php echo e($idName); ?>">
        <?php echo e(__($label)); ?>

        <?php if(!empty($desc)): ?>
            <i class="dripicons-information field-desc" data-toggle="popover" data-placement="right"
               data-trigger="hover"
               data-content="<?php echo e(__($desc)); ?>"></i>
        <?php endif; ?>
    </label><br/>
    <?php $__currentLoopData = $choices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="radio radio-success <?php echo e($style); ?>">
            <input type="radio"
                   name="<?php echo e($id); ?>"
                   value="<?php echo e($key); ?>"
                   <?php if($key == $value): ?> checked <?php endif; ?>
                   id="<?php echo e($idName); ?>-<?php echo e($key); ?>">
            <label for="<?php echo e($id); ?>-<?php echo e($key); ?>"><?php echo e(__($title)); ?></label>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php if($break): ?>
    <div class="w-100"></div> <?php endif; ?>
<?php /**PATH C:\xampp7\htdocs\app\Views/options/fields/radio.blade.php ENDPATH**/ ?>