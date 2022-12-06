<?php
    global $post;
    $external_link = $post->use_external_link;
    $text_external_link = get_translate($post->text_external_link);

?>


<a href="<?php echo e($external_link); ?>" class="form-group btn btn-primary btn-block text-uppercase">
    <?php echo e($text_external_link); ?>

</a>
<?php /**PATH C:\xampp7\htdocs\app\Views/frontend/home/external-form.blade.php ENDPATH**/ ?>