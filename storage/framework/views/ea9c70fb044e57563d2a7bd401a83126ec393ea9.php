<?php

    $layout = (!empty($layout)) ? $layout : 'col-12';
    if (empty($value)) {
        $value = $std;
    }
    if (empty($value)) {
        $value = '#FFFFFF';
    }
    $idName = str_replace(['[', ']'], '_', $id);

    enqueue_script('bootstrap-colorpicker-js');
    enqueue_style('bootstrap-colorpicker-css');
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
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text color"></div>
        </div>
        <input type="text" id="<?php echo e($idName); ?>" data-plugin="colorpicker"
               class="form-control <?php if(!empty($validation)): ?> has-validation <?php endif; ?>"
               data-validation="<?php echo e($validation); ?>"
               name="<?php echo e($id); ?>" value="<?php echo e($value); ?>">
    </div>
</div>
<?php if($break): ?>
    <div class="w-100"></div> <?php endif; ?>
<?php /**PATH /home/salentovacanze/public_html/app/Views/options/fields/colorpicker.blade.php ENDPATH**/ ?>