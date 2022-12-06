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

    if (!isset($post_type)) {
        $post_type = 'home';
    }
    $post_type_info = post_type_info($post_type);
?>
<div id="setting-<?php echo e($idName); ?>" data-condition="<?php echo e($condition); ?>"
     data-unique="<?php echo e($unique); ?>"
     data-operator="<?php echo e($operation); ?>"
     class="form-group mb-3 col <?php echo e($layout); ?> field-<?php echo e($type); ?>">
    <a class="link" data-toggle="collapse" href="#field-<?php echo e($type); ?>-collapse" aria-expanded="true">
        <i class="fe-link mr-1"></i><?php echo e(__('Change the permalink')); ?>

    </a>
    <div class="collapse show mt-2" id="field-<?php echo e($type); ?>-collapse">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"
                      id="basic-addon1"><?php echo e(get_preview_permalink($post_type, $post_id)); ?>/</span>
            </div>
            <input type="text" id="<?php echo e($idName); ?>"
                   data-validation="<?php echo e($validation); ?>" placeholder="<?php echo e(__('leave empty to apply from the title')); ?>"
                   class="form-control <?php if(!empty($maxlengthHtml)): ?> has-maxLength <?php endif; ?>  <?php if(!empty($validation)): ?> has-validation <?php endif; ?>"
                   <?php if(isset($maxlengthHtml)): ?> <?php echo balanceTags($maxlengthHtml); ?> <?php endif; ?>
                   name="<?php echo e($id); ?>" value="<?php echo e($value); ?>">
        </div>
    </div>
</div>
<?php if($break): ?>
    <div class="w-100"></div> <?php endif; ?>
<?php /**PATH C:\xampp7\htdocs\app\Views/options/fields/permalink.blade.php ENDPATH**/ ?>