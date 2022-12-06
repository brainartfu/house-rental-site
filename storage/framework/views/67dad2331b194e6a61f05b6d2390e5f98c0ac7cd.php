<?php
if (!isset($bookingObject)) {
    return;
}
$status = $bookingObject->status;
$status_info = booking_status_info($status);
?>
<?php echo $__env->make('frontend.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="hh-checkout-redirecting pb-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="payment-item">
                    <div class="payment-status">
                        <i class="<?php echo e($status_info['icon']); ?> payment-icon payment-<?php echo e($status); ?>"></i>
                    </div>
                    <h4 class="payment-title">
                        <?php echo balanceTags(__($status_info['payment_text'])); ?>

                    </h4>
                    <div class="payment-desc">
                        <?php echo e(sprintf(__('Email booking details will be sent to the email address: %s'), $bookingObject->email)); ?>

                    </div>
                    <div class="payment-detail">
                        <div class="item d-flex align-items-center">
                            <span><?php echo e(__('Booking ID')); ?></span>
                            <span class="ml-4"><?php echo e($bookingObject->booking_id); ?></span>
                        </div>
                        <div class="item d-flex align-items-center">
                            <span><?php echo e(__('Created Date')); ?></span>
                            <span class="ml-4"><?php echo e(date(hh_date_format(), $bookingObject->created_date)); ?></span>
                        </div>
                        <div class="item d-flex align-items-center">
                            <span><?php echo e(__('Payment Method')); ?></span>
                            <span class="ml-4">
                                <?php
                                $paymentID = $bookingObject->payment_type;
                                $paymentObject = get_payments($paymentID);
                                ?>
                                <?php echo e($paymentObject::getName()); ?>

                                </span>
                        </div>
                    </div>
                    <h5 class="mt-5"><?php echo e(__('Your Information')); ?></h5>
                    <div class="payment-customer-info">
                        <div class="item">
                            <span><?php echo e(__('First Name')); ?></span>
                            <span><?php echo e($bookingObject->first_name); ?></span>
                        </div>
                        <div class="item">
                            <span><?php echo e(__('Last Name')); ?></span>
                            <span><?php echo e($bookingObject->last_name); ?></span>
                        </div>
                        <div class="item">
                            <span><?php echo e(__('Email')); ?></span>
                            <span><?php echo e($bookingObject->email); ?></span>
                        </div>
                        <div class="item">
                            <span><?php echo e(__('Phone')); ?></span>
                            <span><?php echo e($bookingObject->phone); ?></span>
                        </div>
                        <div class="item">
                            <span><?php echo e(__('Address')); ?></span>
                            <span><?php echo e($bookingObject->address); ?></span>
                        </div>
                        <?php if($bookingObject->note): ?>
                            <div class="item">
                                <span><?php echo e(__('Note')); ?></span>
                                <span><?php echo e($bookingObject->note); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
			
                    <div class="text-center mt-5">
                        <a href="<?php echo e(dashboard_url('all-booking')); ?>"
                           class="btn btn-primary m-auto"><?php echo e(__('Go to Your Booking')); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('frontend.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp7\htdocs\app\Views/frontend/thank-you.blade.php ENDPATH**/ ?>