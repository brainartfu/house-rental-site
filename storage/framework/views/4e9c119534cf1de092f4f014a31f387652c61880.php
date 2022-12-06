<?php
if (empty($bookingObject)) {
    return;
}
$status = booking_status_info($bookingObject->status);
$bookingID = $bookingObject->ID;
$paymentID = $bookingObject->payment_type;
$paymentObject = get_payments($paymentID);
$serviceObject = get_booking_data($bookingID, 'serviceObject');
$bookingData = get_booking_data($bookingID);
?>
<ul class="nav nav-tabs nav-bordered">
    <li class="nav-item">
        <a href="#tab-invoice-payment-info" data-toggle="tab" aria-expanded="false" class="nav-link active">
            <?php echo e(__('Transaction')); ?>

        </a>
    </li>
    <li class="nav-item">
        <a href="#tab-invoice-customer" data-toggle="tab" aria-expanded="true" class="nav-link">
            <?php echo e(__('Customer')); ?>

        </a>
    </li>
    <?php if(is_admin()): ?>
        <li class="nav-item">
            <a href="#tab-invoice-partner" data-toggle="tab" aria-expanded="true" class="nav-link">
                <?php echo e(__('Owner')); ?>

            </a>
        </li>
    <?php endif; ?>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="tab-invoice-payment-info">
        <div class="payment-item">
            <div class="item row align-items-center">
                <div class="col-4">
                    <h5 class="title"><?php echo e(__('Booking ID')); ?></h5>
                </div>
                <div class="col-8">
                    <span><?php echo e($bookingObject->booking_id); ?></span>
                </div>
            </div>
            <div class="item row align-items-center">
                <div class="col-4">
                    <h5 class="title"><?php echo e(__('Service Name')); ?></h5>
                </div>
                <div class="col-8">
                    <span><?php echo e(get_translate($serviceObject->post_title)); ?></span>
                </div>
            </div>
            <div class="item row align-items-center">
                <div class="col-4">
                    <h5 class="title"><?php echo e(__('No. Guest')); ?></h5>
                </div>
                <div class="col-8">
                    <span><?php echo e($bookingData['cartData']['numberGuest']); ?></span>
                </div>
            </div>
            <?php if($serviceObject->booking_type == 'per_night'): ?>
                <div class="item row align-items-center">
                    <div class="col-4">
                        <h5 class="title"><?php echo e(__('Check In/Out')); ?></h5>
                    </div>
                    <div class="col-8">
                    <span><?php echo e(date(hh_date_format(), $bookingObject->start_date)); ?>

                        <i class="fe-arrow-right ml-2 mr-2"></i>
                        <?php echo e(date(hh_date_format(), $bookingObject->end_date)); ?>

                    </span>
                    </div>
                </div>
            <?php elseif($serviceObject->booking_type == 'per_hour'): ?>
                <div class="item row align-items-center">
                    <div class="col-4">
                        <h5 class="title"><?php echo e(__('Date')); ?></h5>
                    </div>
                    <div class="col-8">
                        <span><?php echo e(date(hh_date_format(), $bookingObject->start_date)); ?></span>
                    </div>
                </div>
                <div class="item row align-items-center">
                    <div class="col-4">
                        <h5 class="title"><?php echo e(__('Time')); ?></h5>
                    </div>
                    <div class="col-8">
                        <span><?php echo e(date(hh_time_format(), $bookingObject->start_time)); ?>

                            <i class="fe-arrow-right ml-2 mr-2"></i>
                            <?php echo e(date(hh_time_format(), $bookingObject->end_time)); ?>

                    </span>
                    </div>
                </div>
            <?php endif; ?>
            <div class="item row align-items-center">
                <div class="col-4">
                    <h5 class="title"><?php echo e(__('Status')); ?></h5>
                </div>
                <div class="col-8">
                    <span class="booking-status <?php echo e($bookingObject->status); ?>"><?php echo e(__($status['label'])); ?></span>
                </div>
            </div>
            <div class="item row align-items-center">
                <div class="col-4">
                    <h5 class="title"><?php echo e(__('Payment Method')); ?></h5>
                </div>
                <div class="col-8">
                    <?php if(!empty($paymentObject)): ?>
                        <span><?php echo e($paymentObject::getName()); ?></span>
                    <?php else: ?>
                        <span><?php echo e(__('Not Available')); ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="divider"></div>
            <div class="item row align-items-center">
                <div class="col-4">
                    <h5 class="title"><?php echo e(__('Base Price')); ?></h5>
                </div>
                <div class="col-8">
                    <span><?php echo e(convert_price($bookingData['basePrice'])); ?></span>
                </div>
            </div>
            <?php
            $extraPrice = $bookingData['extraPrice'];
            ?>
            <?php if($extraPrice > 0): ?>
                <div class="item row align-items-center">
                    <div class="col-4">
                        <h5 class="title"><?php echo e(__('Extra')); ?></h5>
                    </div>
                    <div class="col-8">
                        <span><?php echo e(convert_price($extraPrice)); ?></span>
                    </div>
                </div>
            <?php endif; ?>
            <?php
            $coupon = isset($bookingData['cartData']['coupon']) ? $bookingData['cartData']['coupon'] : [];
            ?>
            <?php if($coupon): ?>
                <div class="item row align-items-center">
                    <div class="col-4">
                        <h5 class="title"><?php echo e(__('Coupon')); ?></h5>
                    </div>
                    <div class="col-8">
                        <span>- <?php echo e($coupon->couponPriceHtml); ?> (<?php echo e($coupon->coupon_code); ?>)</span>
                    </div>
                </div>
            <?php endif; ?>
            <div class="item row align-items-center">
                <div class="col-4">
                    <h5 class="title"><?php echo e(__('Tax')); ?></h5>
                </div>
                <div class="col-8">
                    <span><?php echo e($bookingData['tax']['tax']); ?>%</span>
                </div>
            </div>
            <div class="item row align-items-center">
                <div class="col-4">
                    <h5 class="title"><?php echo e(__('Amount')); ?></h5>
                </div>
                <div class="col-8">
                    <span><?php echo e(convert_price($bookingObject->total)); ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="tab-invoice-customer">
        <div class="payment-item">
            <div class="item row align-items-center">
                <div class="col-4">
                    <h5 class="title"><?php echo e(__('First Name')); ?></h5>
                </div>
                <div class="col-8">
                    <span><?php echo e($bookingObject->first_name); ?></span>
                </div>
            </div>
            <div class="item row align-items-center">
                <div class="col-4">
                    <h5 class="title"><?php echo e(__('Last Name')); ?></h5>
                </div>
                <div class="col-8">
                    <span><?php echo e($bookingObject->last_name); ?></span>
                </div>
            </div>
            <div class="item row align-items-center">
                <div class="col-4">
                    <h5 class="title"><?php echo e(__('Email')); ?></h5>
                </div>
                <div class="col-8">
                    <span><?php echo e($bookingObject->email); ?></span>
                </div>
            </div>
            <div class="item row align-items-center">
                <div class="col-4">
                    <h5 class="title"><?php echo e(__('Phone')); ?></h5>
                </div>
                <div class="col-8">
                    <span><?php echo e($bookingObject->phone); ?></span>
                </div>
            </div>
            <div class="item row align-items-center">
                <div class="col-4">
                    <h5 class="title"><?php echo e(__('Address')); ?></h5>
                </div>
                <div class="col-8">
                    <span><?php echo e($bookingObject->address); ?></span>
                </div>
            </div>
            <?php if(!empty($bookingObject->note)): ?>
                <div class="item row align-items-center">
                    <div class="col-4">
                        <h5 class="title"><?php echo e(__('Note')); ?></h5>
                    </div>
                    <div class="col-8">
                        <span><?php echo e($bookingObject->note); ?></span>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php if(is_admin()): ?>
        <?php
        $partner_id = $bookingObject->owner;
        $partner_data = get_user_by_id($partner_id);
        ?>
        <div class="tab-pane" id="tab-invoice-partner">
            <div class="payment-item">
                <div class="item row align-items-center">
                    <div class="col-4">
                        <h5 class="title"><?php echo e(__('Full Name')); ?></h5>
                    </div>
                    <div class="col-8">
                        <span><?php echo e(get_username($partner_id)); ?></span>
                    </div>
                </div>
                <div class="item row align-items-center">
                    <div class="col-4">
                        <h5 class="title"><?php echo e(__('Email')); ?></h5>
                    </div>
                    <div class="col-8">
                        <span><?php echo e($partner_data->email); ?></span>
                    </div>
                </div>
                <div class="item row align-items-center">
                    <div class="col-4">
                        <h5 class="title"><?php echo e(__('Phone')); ?></h5>
                    </div>
                    <div class="col-8">
                        <span><?php echo e($partner_data->mobile); ?></span>
                    </div>
                </div>
                <div class="item row align-items-center">
                    <div class="col-4">
                        <h5 class="title"><?php echo e(__('Address')); ?></h5>
                    </div>
                    <div class="col-8">
                        <span><?php echo e($partner_data->address); ?></span>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp7\htdocs\app\Views/dashboard/components/services/home/invoice.blade.php ENDPATH**/ ?>