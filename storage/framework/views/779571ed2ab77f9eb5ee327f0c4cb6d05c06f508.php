<?php

$layout = (!empty($layout)) ? $layout : 'col-12';
if (empty($value)) {
    $value = $std;
}
if (empty($value)) {
    $value = ';;';
}
$value = explode(';', $value);

$fontsData = \ThemeOptions::getGoogleFonts();
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
    </label> <br/>
    <select id="<?php echo e($idName); ?>" data-toggle="select2"
            class="hh-google-fonts form-control <?php echo e($style); ?>"
            name="<?php echo e($id); ?>">
        <option data-variants="" data-subsets="" value="">Select Font</option>
        <?php $__currentLoopData = $fontsData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $font): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            $variants = implode(',', $font['variants']);
            $subsets = implode(',', $font['subsets']);
            ?>
            <option value="<?php echo e($key); ?>" <?php if($key == $value[0]): ?> selected <?php endif; ?>
            data-variants="<?php echo e($variants); ?>"
                    data-subsets="<?php echo e($subsets); ?>"><?php echo e($font['name']); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <div class="hh-font-variants clearfix">
        <?php $variants = explode(',', $value[1]); ?>
        <?php if(!empty($fontsData[$value[0]]['variants'])): ?>
            <?php $__currentLoopData = $fontsData[$value[0]]['variants']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(in_array($variant, $variants)): ?>
                    <div class="checkbox checkbox-success"><input type="checkbox" id="font-variant-<?php echo e($variant); ?>"
                                                                  name="font_variants[]" value="<?php echo e($variant); ?>" checked><label
                            for="font-variant-<?php echo e($variant); ?>"><?php echo e($variant); ?></label></div>
                <?php else: ?>
                    <div class="checkbox checkbox-success"><input type="checkbox" id="font-variant-<?php echo e($variant); ?>"
                                                                  name="font_variants[]" value="<?php echo e($variant); ?>"><label
                            for="font-variant-<?php echo e($variant); ?>"><?php echo e($variant); ?></label></div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
    <div class="hh-font-subsets clearfix">
        <?php $subsets = explode(',', $value[2]); ?>
        <?php if(!empty($fontsData[$value[0]]['subsets'])): ?>
            <?php $__currentLoopData = $fontsData[$value[0]]['subsets']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(in_array($subset, $subsets)): ?>
                    <div class="checkbox checkbox-success"><input type="checkbox" id="font-subset-<?php echo e($subset); ?>"
                                                                  name="font_subsets[]" value="<?php echo e($subset); ?>"
                                                                  checked><label
                            for="font-subset-<?php echo e($subset); ?>"><?php echo e($subset); ?></label></div>
                <?php else: ?>
                    <div class="checkbox checkbox-success"><input type="checkbox" id="font-subset-<?php echo e($subset); ?>"
                                                                  name="font_subsets[]" value="<?php echo e($subset); ?>"><label
                            for="font-subset-<?php echo e($subset); ?>"><?php echo e($subset); ?></label></div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
    <div class="clearfix"></div>
</div>
<?php if($break): ?>
    <div class="w-100"></div> <?php endif; ?>
<?php /**PATH C:\xampp7\htdocs\app\Views/options/fields/google_font.blade.php ENDPATH**/ ?>