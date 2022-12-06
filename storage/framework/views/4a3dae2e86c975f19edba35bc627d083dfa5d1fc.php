<?php
    $layout = (!empty($layout)) ? $layout : 'col-12';
    if (empty($value)) {
        $value = $std;
    }
    $idName = str_replace(['[', ']'], '_', $id);
?>
<div id="setting-<?php echo e($idName); ?>" data-condition="<?php echo e($condition); ?>"
     data-unique="<?php echo e($unique); ?>"
     data-operator="<?php echo e($operation); ?>"
     data-hh-bind-value-from="<?php echo e($bind_value_from); ?>"
     class="form-group mb-3 col <?php echo e($layout); ?> field-<?php echo e($type); ?>">
    <label for="<?php echo e($idName); ?>">
        <?php echo e(__($label)); ?>

        <?php if(!empty($desc)): ?>
            <i class="dripicons-information field-desc" data-toggle="popover" data-placement="right"
               data-trigger="hover"
               data-content="<?php echo e(__($desc)); ?>"></i>
        <?php endif; ?>
    </label>
    <div class="input-group input-group--export-ical">
        <div class="input-group-prepend">
            <button class="btn btn-dark waves-effect waves-light" data-message-title="<?php echo e(__('System Alert')); ?>"
                    data-message-message="<?php echo e(__('Copied')); ?>" type="button"><?php echo e(__('Copy Url')); ?></button>
        </div>
        <input type="text" class="form-control" name="export_ical" value="<?php echo e(get_ical_url($post_id, $post_type)); ?>">
    </div>
</div>
<?php if($break): ?>
    <div class="w-100"></div> <?php endif; ?>
<?php /**PATH /home/salentovacanze/public_html/app/Views/options/fields/ical.blade.php ENDPATH**/ ?>