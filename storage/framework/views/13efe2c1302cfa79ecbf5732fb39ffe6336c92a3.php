<?php
    $layout = (!empty($layout)) ? $layout : 'col-12';
    if (empty($value)) {
        $value = $std;
    }
    $idName = str_replace(['[', ']'], '_', $id);

    enqueue_style('range-slider');
    enqueue_script('range-slider');

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
    </label>
    <input type="range" id="<?php echo e($idName); ?>"
           data-validation="<?php echo e($validation); ?>"
           class="<?php if(!empty($validation)): ?> has-validation <?php endif; ?>"
           min="<?php echo e($minlength); ?>"
           max="<?php echo e($maxlength['max-length']); ?>"
           step="1"
           data-orientation="horizontal"
           data-rangeslider
           name="<?php echo e($id); ?>" value="<?php echo e($value); ?>">
    <input type="number"
           class="form-control"
           min="<?php echo e($minlength); ?>"
           max="<?php echo e($maxlength['max-length']); ?>"
           step="1" value="<?php echo e($value); ?>">
</div>
<?php if($break): ?>
    <div class="w-100"></div> <?php endif; ?>
<?php /**PATH C:\xampp7\htdocs\app\Views/options/fields/range.blade.php ENDPATH**/ ?>