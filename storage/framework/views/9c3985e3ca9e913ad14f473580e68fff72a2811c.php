<?php
$layout = (!empty($layout)) ? $layout : 'col-12';
if (empty($value)) {
    $value = $std;
}
$idName = str_replace(['[', ']'], '_', $id);

enqueue_script('ck-editor-js');
$langs = $translation == false ? [""] : get_languages_field();
$classLangs = '';
if (!empty($langs) && !empty($langs[0])) {
    $classLangs = 'has-editor-translation';
}
?>
<div id="setting-<?php echo e($idName); ?>" data-condition="<?php echo e($condition); ?>"
     data-unique="<?php echo e($unique); ?>"
     data-operator="<?php echo e($operation); ?>"
     class="form-group mb-3 col <?php echo e($layout); ?> field-<?php echo e($type); ?> <?php echo e($classLangs); ?>">
    <label for="<?php echo e($idName); ?>">
        <?php echo e(__($label)); ?>

        <?php if(!empty($desc)): ?>
            <i class="dripicons-information field-desc" data-toggle="popover" data-placement="right"
               data-trigger="hover"
               data-content="<?php echo e(__($desc)); ?>"></i>
        <?php endif; ?>
    </label>
    <?php
    $value = str_replace('\\', '', $value);
    ?>
    <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <textarea data-base-name="<?php echo e($id); ?>"
                  class="form-control hh-editor has-translation hidden"
                  id="<?php echo e($idName); ?><?php echo e(get_lang_suffix($item)); ?>" name="<?php echo e($id); ?><?php echo e(get_lang_suffix($item)); ?>"
                  <?php if(!empty($item)): ?> data-lang="<?php echo e($item); ?>" <?php endif; ?>><?php echo balanceTags(get_translate($value, $item)); ?></textarea>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php if ($break) echo '<div class="w-100"></div>' ?>
<?php /**PATH /home/salentovacanze/public_html/app/Views/options/fields/editor.blade.php ENDPATH**/ ?>