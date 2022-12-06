<?php
    show_lang_section('mb-2');
    $langs = get_languages_field();
?>

<div class="form-group">
    <label for="term_name_update">
        <?php echo e(__('Name')); ?>

    </label>
    <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <input type="text" class="form-control has-validation <?php echo e(get_lang_class($key, $item)); ?>"
               data-validation="required" id="term_name_update<?php echo e(get_lang_suffix($item)); ?>"
               name="term_name<?php echo e(get_lang_suffix($item)); ?>"
               value="<?php echo e(get_translate($termObject->term_title, $item)); ?>" <?php if(!empty($item)): ?> data-lang="<?php echo e($item); ?>"
               <?php endif; ?>
               placeholder="<?php echo e(__('Name')); ?>">
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <input type="hidden" name="term_id" value="<?php echo e($termObject->term_id); ?>">
    <input type="hidden" name="term_encrypt" value="<?php echo e(hh_encrypt($termObject->term_id)); ?>">
</div>
<div class="form-group">
    <label for="term_description_update">
        <?php echo e(__('Description')); ?>

    </label>
    <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <textarea name="term_description<?php echo e(get_lang_suffix($item)); ?>"
                  id="term_description_update<?php echo e(get_lang_suffix($item)); ?>"
                  class="form-control <?php echo e(get_lang_class($key, $item)); ?>"
                  placeholder="<?php echo e(__('Description')); ?>"
                  <?php if(!empty($item)): ?> data-lang="<?php echo e($item); ?>" <?php endif; ?>><?php echo e(get_translate($termObject->term_description, $item)); ?></textarea>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\xampp7\htdocs\app\Views/dashboard/components/post-category-form.blade.php ENDPATH**/ ?>