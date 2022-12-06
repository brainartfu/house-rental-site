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
               placeholder="Name">
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
<div class="form-group field-icon relative">
    <label for="term_icon_update">
        <?php echo e(__('Icon')); ?>

    </label>
    <?php
    $icon = $termObject->term_icon;
    ?>
    <input type="text" class="form-control hh-icon-input"
           id="term_icon_update" name="term_icon"
           data-action="<?php echo e(dashboard_url('get-font-icon')); ?>"
           data-plugin="fonticon" value="<?php echo e($icon); ?>"
           placeholder="<?php echo e(__('Icon')); ?>">
</div>
<?php /**PATH C:\xampp7\htdocs\app\Views/dashboard/screens/administrator/services/home/home-amenity-form.blade.php ENDPATH**/ ?>