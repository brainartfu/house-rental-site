<?php
$layout = (!empty($layout)) ? $layout : 'col-12';
if ($value === '') {
    $value = $std;
}
$idName = str_replace(['[', ']'], '_', $id);

enqueue_style('daterangepicker-css');
enqueue_script('daterangepicker-js');
enqueue_script('daterangepicker-lang-js');
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
    <div class="hh-availability">
        <input type="hidden" class="calendar_input"
               data-service-type="<?php echo e($post_type); ?>"
               data-id="<?php echo e($post_id); ?>" data-action="<?php echo e(dashboard_url('get-inventory')); ?>">
    </div>
</div>
<?php if($break): ?>
    <div class="w-100"></div>
<?php endif; ?>
<?php echo $__env->make('options.fields.components.availability-'.$post_type, ['post_id' => $post_id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/salentovacanze/public_html/app/Views/options/fields/availability.blade.php ENDPATH**/ ?>