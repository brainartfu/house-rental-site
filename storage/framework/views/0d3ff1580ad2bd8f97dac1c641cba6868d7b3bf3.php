<?php
$layout = (!empty($layout)) ? $layout : 'col-12';
if (empty($value)) {
    $value = $std;
}
$oldValue = $value;
$value = (empty($value)) ? [] : explode(',', $value);
$idName = str_replace(['[', ']'], '_', $id);

enqueue_style('dropzone-css');
enqueue_script('dropzone-js');
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
    </label> <br/>
    <div class="hh-upload-wrapper">
        <div class="hh-upload-wrapper clearfix">
            <div class="attachments">
                <?php if(!empty($value)): ?>
                    <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $url = get_attachment_url($image_id, 'medium', true); ?>
                        <div class="attachment-item">
                            <div class="thumbnail"><img src="<?php echo e($url); ?>" alt="<?php echo e(__('Image')); ?>"></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
            <div class="mt-1">
                <a href="javascript:void(0);" class="remove-attachment"><?php echo e(__('Remove')); ?></a>
                <a href="javascript:void(0);" class="add-attachments"
                   title="<?php echo e(__('Add Image')); ?>"
                   data-text="<?php echo e(__('Add Image')); ?>"
                   data-url="<?php echo e(dashboard_url('all-media')); ?>"><?php echo e(__('Add Images')); ?></a>
                <input type="hidden" class="upload_value input-uploads" value="<?php echo e($oldValue); ?>"
                       name="<?php echo e($id); ?>" data-url="<?php echo e(dashboard_url('get-attachments')); ?>">
            </div>
        </div>
    </div>
</div>
<?php if($break): ?>
    <div class="w-100"></div> <?php endif; ?>

<?php /**PATH C:\xampp7\htdocs\app\Views/options/fields/uploads.blade.php ENDPATH**/ ?>