<?php
    $homeObject = get_post($post_id, 'home');
    $booking_type = $homeObject->booking_type;
?>
<?php if($booking_type == 'per_hour'): ?>
    <div class="modal fade hh-get-modal-content" id="hh-show-availability-time-slot-modal" tabindex="-1" role="dialog"
         aria-hidden="true" data-url="<?php echo e(dashboard_url('get-availability-time-slot')); ?>">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo e(__('Booking Detail')); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect"
                            data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /home/salentovacanze/public_html/app/Views/options/fields/components/availability-home.blade.php ENDPATH**/ ?>