<?php
    if (empty($value)) {
        $value = $std;
    }
    $idName = str_replace(['[', ']'], '_', $id);
?>
<input type="hidden" class="form-control"
       name="<?php echo e($id); ?>"
       id="<?php echo e($idName); ?>" value="<?php echo e($value); ?>">
<?php /**PATH /home/salentovacanze/public_html/app/Views/options/fields/hidden.blade.php ENDPATH**/ ?>