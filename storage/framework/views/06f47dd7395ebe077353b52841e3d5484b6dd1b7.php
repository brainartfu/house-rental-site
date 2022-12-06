<?php
if ($value === '') {
    $value = $std;
}
$idName = str_replace(['[', ']'], '_', $id);
?>
<div id="setting-<?php echo e($idName); ?>" data-condition="<?php echo e($condition); ?>"
     data-unique="<?php echo e($unique); ?>"
     data-operator="<?php echo e($operation); ?>"
     data-hh-bind-value-from="<?php echo e($bind_value_from); ?>"
     class="form-group mb-2 col <?php echo e($layout); ?> field-<?php echo e($type); ?>">
    <div class="alert alert-<?php echo e($style); ?>" role="alert">
        <?php if(!empty($label)): ?>
            <h5 class="title"><?php echo e($label); ?></h5>
        <?php endif; ?>
        <p class="f12"><?php echo balanceTags($desc); ?></p>
    </div>
</div>
<?php if($break): ?>
    <div class="w-100"></div> <?php endif; ?>
<?php /**PATH C:\xampp7\htdocs\app\Views/options/fields/alert.blade.php ENDPATH**/ ?>