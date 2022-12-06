<?php
    $layout = (!empty($layout)) ? $layout : 'col-12';
    if (empty($value)) {
        $value = $std;
    }
    if (!empty($maxlength) && is_array($maxlength)) {
        $maxlengthHtml = '';
        foreach ($maxlength as $k => $v) {
            if ($k == 'max-length') {
                $maxlengthHtml .= ' maxlength="' . $v . '" ';
            } else {
                $maxlengthHtml .= ' data-' . $k . '="' . $v . '" ';
            }
        }
    }
    $idName = str_replace(['[', ']'], '_', $id);
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
    </label>
    <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <textarea <?php if(!empty($item)): ?> data-lang="<?php echo e($item); ?>" <?php endif; ?> name="<?php echo e($id); ?><?php echo e(get_lang_suffix($item)); ?>"
                  id="<?php echo e($idName); ?><?php echo e(get_lang_suffix($item)); ?>"
                  data-validation="<?php echo e($validation); ?>"
                  data-post-id="<?php echo e($post_id); ?>"
                  data-seo-detect="<?php echo e($seo_put_to); ?>"
                  class="form-control <?php echo e($class_seo); ?> <?php echo e(get_lang_class($key, $item)); ?> <?php if(isset($maxlengthHtml)): ?> has-maxLength <?php endif; ?> <?php if(!empty($validation)): ?> has-validation <?php endif; ?>" <?php if(isset($maxlengthHtml)): ?> <?php echo balanceTags($maxlengthHtml); ?> <?php endif; ?>><?php echo e(get_translate($value, $item)); ?></textarea>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php if($break): ?>
    <div class="w-100"></div> <?php endif; ?>
<?php /**PATH C:\xampp7\htdocs\app\Views/options/fields/textarea.blade.php ENDPATH**/ ?>