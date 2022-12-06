<?php
$layout = (!empty($layout)) ? $layout : 'col-12';
if (empty($value)) {
    $value = $std;
}
$idName = str_replace(['[', ']'], '_', $id);
enqueue_style('dropzone-css');
enqueue_script('dropzone-js');
$langs = $translation == false ? [""] : get_languages_field();
$class_seo = $seo_detect ? 'seo-detect' : '';
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

    <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $url = get_attachment_url(get_translate($value, $item), 'medium');
        ?>
        <div class="hh-upload-wrapper <?php echo e(get_lang_class($key, $item)); ?>"
             <?php if(!empty($item)): ?> data-lang="<?php echo e($item); ?>" <?php endif; ?>>
            <div class="hh-upload-wrapper clearfix">
                <div class="attachments">
                    <?php if($url): ?>
                        <div class="attachment-item">
                            <div class="thumbnail"><img src="<?php echo e($url); ?>" alt="Image"></div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mt-1">
                    <a href="javascript:void(0);" class="remove-attachment"><?php echo e(__('Remove')); ?></a>
                    <a href="javascript:void(0);" class="add-attachment"
                       title="<?php echo e(__('Add Image')); ?>"
                       data-text="<?php echo e(__('Add Image')); ?>"
                       data-url="<?php echo e(dashboard_url('all-media')); ?>"><?php echo e(__('Add Image')); ?></a>
                    <input id="<?php echo e($id); ?><?php echo e(get_lang_suffix($item)); ?>" type="hidden"
                           class="upload_value input-upload <?php echo e($class_seo); ?>" value="<?php echo e(get_translate($value, $item)); ?>"
                           data-seo-detect="<?php echo e($seo_put_to); ?>"
                           name="<?php echo e($id); ?><?php echo e(get_lang_suffix($item)); ?>" data-url="<?php echo e(dashboard_url('get-attachments')); ?>">
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php if($break): ?>
    <div class="w-100"></div> <?php endif; ?>

<?php /**PATH C:\xampp7\htdocs\app\Views/options/fields/upload.blade.php ENDPATH**/ ?>