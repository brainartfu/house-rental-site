<?php
    if (!isset($status)) {
        return false;
    }
?>
<?php if($status == 0): ?>
    <?php echo e(__('Invalid url.')); ?>

<?php elseif($status == 1): ?>
    <?php echo e(__('Thank you for your confirmation.')); ?>

    <?php echo e(__('You will receive a booking email. Please check your inbox!')); ?>

<?php elseif($status == 2): ?>
    <?php echo e(__('You have already confirmed')); ?>

<?php endif; ?>
<?php /**PATH /home/salentovacanze/public_html/app/Views/frontend/confirmation-detail.blade.php ENDPATH**/ ?>