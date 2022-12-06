<?php
$layout = (!empty($layout)) ? $layout : 'col-12';
if (empty($value) && !is_array($value)) {
    $value = $std;
}
$idName = str_replace(['[', ']'], '_', $id);
$value = explode(',', $value);
$langs = $translation == false ? [""] : get_languages_field();
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
    </label><br/>
    <div class="checkbox-wrapper">
        <?php if(!empty($choices)): ?>
            <?php if(!is_array($choices)): ?>
                <?php
                $choicesTemp = explode(':', $choices);
                if ($choicesTemp[0] == 'taxonomy') {
                    $choicesTemp = get_taxonomies();
                } elseif ($choicesTemp[0] == 'terms') {
                    $choicesTemp = get_terms($choicesTemp[1]);
                }
                ?>
            <?php else: ?>
                <?php $choicesTemp = $choices; ?>
            <?php endif; ?>
            <?php if(!empty($choicesTemp)): ?>
                <?php if($style == 'col'): ?>
                    <div class="row">
                        <?php endif; ?>
                        <?php $__currentLoopData = $choicesTemp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($style == 'col'): ?>
                                <div class="col-12 col-sm-4 col-md-3">
                                    <?php endif; ?>
                                    <div class="checkbox  checkbox-success <?php if($style != 'col'): ?> <?php echo e($style); ?> <?php endif; ?>">
                                        <input type="checkbox"
                                               name="<?php echo e($id); ?>[]"
                                               value="<?php echo e($key); ?>"
                                               <?php if(in_array($key, $value)): ?> checked <?php endif; ?>
                                               id="<?php echo e($idName); ?>-<?php echo e($key); ?>">

                                        <label for="<?php echo e($idName); ?>-<?php echo e($key); ?>">
                                            <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span class="<?php echo e(get_lang_class($key, $item)); ?>"
                                                      <?php if(!empty($item)): ?> data-lang="<?php echo e($item); ?>" <?php endif; ?>>
                                                <?php echo balanceTags(get_translate($title, $item)); ?>

                                            </span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </label>
                                    </div>
                                    <?php if($style == 'col'): ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($style == 'col'): ?>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <small><i><?php echo e(__('No data')); ?></i></small>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<?php if($break): ?>
    <div class="w-100"></div> <?php endif; ?>
<?php /**PATH C:\xampp7\htdocs\app\Views/options/fields/checkbox.blade.php ENDPATH**/ ?>