<?php
    $layout = (!empty($layout)) ? $layout : 'col-12';
    if (empty($value)) {
        $value = $std;
    }
    $idName = str_replace(['[', ']'], '_', $id);

    enqueue_script('flatpickr-js');
    enqueue_style('flatpickr-css');

    if ($min_date == -1) {
        $min_date = '';
    }
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
    <input type="text" id="<?php echo e($idName); ?>" class="form-control <?php if(!empty($validation)): ?> has-validation <?php endif; ?>"
           data-plugin="datepicker"
           data-min-date="<?php echo e($min_date); ?>"
           data-validation="<?php echo e($validation); ?>"
           name="<?php echo e($id); ?>" value="<?php echo e($value); ?>">
</div>
<?php if($break): ?>
    <div class="w-100"></div> <?php endif; ?>
<?php /**PATH C:\xampp7\htdocs\app\Views/options/fields/datepicker.blade.php ENDPATH**/ ?>