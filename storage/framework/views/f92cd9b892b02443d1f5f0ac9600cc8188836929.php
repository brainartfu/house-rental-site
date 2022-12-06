<?php
$layout = (!empty($layout)) ? $layout : 'col-12';
if (empty($value)) {
    $value = $std;
}
$idName = str_replace(['[', ']'], '_', $id);

enqueue_script('select2-js');
enqueue_style('select2-css');
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
    <select id="<?php echo e($idName); ?>"
            class="form-control <?php echo e($style); ?> <?php if(!empty($validation)): ?> has-validation <?php endif; ?>"
            data-validation="<?php echo e($validation); ?>"
            data-toggle="select2" name="<?php echo e($id); ?>">
        <?php if(!empty($choices)): ?>
            <?php if(!is_array($choices)): ?>
                <?php
                $choices = explode(':', $choices);
                if ($choices[0] == 'number_range') {
                    $range = explode('_', $choices[1]);
                    $choices = [];
                    for ($i = $range[0]; $i <= $range[1]; $i++) {
                        $choices[$i] = $i;
                    }
                } elseif ($choices[0] == 'hh_currencies') {
                    $choices = list_currencies(true);
                } elseif ($choices[0] == 'taxonomy') {
                    $choices = get_taxonomies();
                } elseif ($choices[0] == 'terms') {
                    $choices = get_terms($choices[1]);
                }
                ?>
            <?php endif; ?>
            <?php if($choice_group): ?>
                <?php $__currentLoopData = $choices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <optgroup label="<?php echo e($key); ?>">
                        <?php $__currentLoopData = $option; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($_key); ?>" <?php if($_key == $value): ?> selected <?php endif; ?>><?php echo e($title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </optgroup>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <?php $__currentLoopData = $choices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?php if($key == $value): ?> selected <?php endif; ?>><?php echo e($title); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endif; ?>
    </select>
    <div class="clearfix"></div>
</div>
<?php if($break): ?>
    <div class="w-100"></div> <?php endif; ?>
<?php /**PATH C:\xampp7\htdocs\app\Views/options/fields/select2.blade.php ENDPATH**/ ?>