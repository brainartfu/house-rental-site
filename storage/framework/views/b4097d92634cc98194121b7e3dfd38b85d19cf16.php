<?php
$layout = (!empty($layout)) ? $layout : 'col-12';
if ($value === '') {
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
    <?php
    $class_seo = $seo_detect ? 'seo-detect' : '';
    ?>
    <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <input type="text" id="<?php echo e($idName); ?><?php echo e(get_lang_suffix($item)); ?>"
               data-validation="<?php echo e($validation); ?>"
               class="form-control <?php echo e($class_seo); ?> <?php echo e(get_lang_class($key, $item)); ?> <?php if(!empty($maxlengthHtml)): ?> has-maxLength <?php endif; ?>  <?php if(!empty($validation)): ?> has-validation <?php endif; ?>"
               <?php if(isset($maxlengthHtml)): ?> <?php echo balanceTags($maxlengthHtml); ?> <?php endif; ?>
               name="<?php echo e($id); ?><?php echo e(get_lang_suffix($item)); ?>" value="<?php echo e(get_translate($value, $item)); ?>"
               data-post-id="<?php echo e($post_id); ?>"
               data-seo-detect="<?php echo e($seo_put_to); ?>"
               <?php if(!empty($item)): ?> data-lang="<?php echo e($item); ?>" <?php endif; ?>>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php if($break): ?>
    <div class="w-100"></div> <?php endif; ?>
<?php /**PATH /home/salentovacanze/public_html/app/Views/options/fields/text.blade.php ENDPATH**/ ?>