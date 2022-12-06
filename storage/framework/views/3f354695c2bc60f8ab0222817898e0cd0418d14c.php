<?php
if (!isset($cart)) {
    return;
}
$homeID = $cart['serviceID'];
$homeObject = unserialize($cart['serviceObject']);
?>
<h3 class="heading"><?php echo e(__('Your Item')); ?></h3>
<div class="card-box mt-3 cart-information cart-home-item">
    <div class="media service-detail d-flex align-items-start">
        <?php
        $thumbnail = get_attachment_url($homeObject->thumbnail_id, [400, 400])
        ?>
        <img src="<?php echo e($thumbnail); ?>" class="mr-3"
             alt="<?php echo e(get_attachment_alt($homeObject->thumbnail_id)); ?>">
        <div class="media-body">
            <a target="_blank"
               href="<?php echo e(get_the_permalink($homeID)); ?>"><?php echo e(get_translate($homeObject->post_title)); ?></a>
            <?php if($address = get_translate($homeObject->location_address)): ?>
                <div class="desc mt-2">
                    <i class="fe-map-pin mr-1"></i> <?php echo e($address); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
    <h5 class="title"><?php echo e(__('Detail')); ?></h5>
    <ul class="menu cart-list">
        <?php
        $checkIn = $cart['cartData']['startDate'];
        $checkOut = $cart['cartData']['endDate'];
        $startTime = $cart['cartData']['startTime'];
        $endTime = $cart['cartData']['endTime'];
        $adults = $cart['cartData']['numberAdult'];
        $children = $cart['cartData']['numberChild'];
        $infant = $cart['cartData']['numberInfant'];
        ?>
        <li>
            <?php if($homeObject->booking_type == 'per_night'): ?>
                <span><?php echo e(__('Check In/Out')); ?></span>
                <span>
                <?php echo e(date(hh_date_format(), $checkIn)); ?> <i class="fe-arrow-right ml-2 mr-2"></i> <?php echo e(date(hh_date_format(), $checkOut)); ?>

                </span>
            <?php elseif($homeObject->booking_type == 'per_hour'): ?>
                <span><?php echo e(__('Date')); ?></span>
                <span>
                <?php echo e(date(hh_date_format(), $checkIn)); ?>

                </span>
            <?php endif; ?>
        </li>
        <?php if($homeObject->booking_type == 'per_hour'): ?>
            <li>
                <span><?php echo e(__('Time')); ?></span>
                <span><?php echo e(date(hh_time_format(), $startTime)); ?> <i class="fe-arrow-right ml-2 mr-2"></i> <?php echo e(date(hh_time_format(), $endTime)); ?></span>
            </li>
        <?php endif; ?>
        <?php if($adults > 0): ?>
            <li>
                <span><?php echo e(_n("[0::Adults][1::Adult][2::Adults]", $adults)); ?></span>
                <span> <?php echo e($adults); ?>  </span>
            </li>
        <?php endif; ?>
        <?php if($children > 0): ?>
            <li>
                <span><?php echo e(_n("[0::Children][1::Child][2::Children]", $children)); ?></span>
                <span><?php echo e($children); ?></span>
            </li>
        <?php endif; ?>
        <?php if($infant > 0): ?>
            <li>
                <span><?php echo e(_n("[0::Infants][1::Infant][2::Infants]", $infant)); ?></span>
                <span><?php echo e($infant); ?></span>
            </li>
        <?php endif; ?>
    </ul>
    <?php
    $coupon = isset($cart['cartData']['coupon']) ? $cart['cartData']['coupon'] : [];
    $couponCode = isset($coupon->coupon_code) ? $coupon->coupon_code : '';
    ?>
    <form action="<?php echo e(url('add-coupon')); ?>" class="form-sm form-action form-add-coupon"
          data-validation-id="form-add-coupon"
          method="post"
          data-reload-time="1000">
        <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="form-group">
            <label for="coupon"><?php echo e(__('Coupon Code')); ?></label>
            <input id="coupon" type="text" class="form-control" name="coupon"
                   value="<?php echo e($couponCode); ?>"
                   placeholder="<?php echo e(__('Have a coupon?')); ?>">
            <input type="hidden" name="service_id"
                   value="<?php echo e($homeID); ?>">
            <input type="hidden" name="service_type"
                   value="home">
            <button class="btn" type="submit" name="sm"><i class="fe-arrow-right "></i>
            </button>
        </div>
        <div class="form-message"></div>
    </form>
    <h5 class="title"><?php echo e(__('Summary')); ?></h5>
    <ul class="menu cart-list">
        <?php
        $numberNight = $cart['cartData']['numberNight'];
        $basePrice = $cart['basePrice'];
        $extraPrice = $cart['extraPrice'];
        $tax = $cart['tax'];
        ?>
        <li>
            <?php if($homeObject->booking_type == 'per_night'): ?>
                <span><?php echo e(_n("[0::Price for %s nights][1::Price for %s night][2::Price for %s nights]", $numberNight)); ?></span>
            <?php elseif($homeObject->booking_type == 'per_hour'): ?>
                <span><?php echo e(_n("0::Price for %s hours][1::Price for %s hour][2::Price for %s hours]", $numberNight)); ?></span>
            <?php endif; ?>
            <span><?php echo e(convert_price($basePrice)); ?></span>
        </li>
        <?php if($extraPrice > 0): ?>
            <li>
                <span><?php echo e(__('Extra Service')); ?></span>
                <span><?php echo e(convert_price($extraPrice)); ?></span>
            </li>
        <?php endif; ?>
        <?php if(!empty($coupon)): ?>
            <li>
                <form action="<?php echo e(url('remove-coupon')); ?>" class="form-action" method="post"
                      data-validation-id="form-remove-coupon"
                      data-reload-time="1500">
                    <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <input type="hidden" name="homeID"
                           value="<?php echo e($homeID); ?>">
                    <div class="d-flex align-items-center">
                        <span>
                            <?php echo e(__('Coupon')); ?>

                            <button class="btn ml-2" type="submit" name="sm">(remove)</button>
                        </span>
                        <span>- <?php echo e($coupon->couponPriceHtml); ?></span>
                    </div>
                    <div class="form-message"></div>
                </form>
            </li>
        <?php endif; ?>
        <?php
		$acconto = $homeObject->acconto;
        $tax_value = (float)$cart['tax']['tax'];
        if($tax_value > 0){
        ?>
        <li class="divider"> <?php if($cart['tax']['included'] == 'on'): ?>
                        <?php echo e(__('(included)')); ?>

            <span><?php echo e(__('Tax')); ?>

                <span class="text-muted">
                   </span>
					
                </span>

            <span><?php echo e($tax_value); ?>%</span></li>
			
			<?php else: ?>

                    <?php endif; ?>
        
        <?php } ?>
        <li class="amount">
            <span><?php echo e(__('Amount')); ?></span>
            <span><?php echo e(convert_price($cart['amount'])); ?></span>
			
        </li>
		<li class="amount ">
		<p><?php echo e(__('Bookingfee')); ?> (<?php echo e($acconto); ?>%)</p>
		<p style="color:green"><?php echo e(convert_price($cart['amount']/$acconto)); ?></p>
		</li>
    </ul>
</div>
<?php /**PATH C:\xampp7\htdocs\app\Views/frontend/home/cart-item.blade.php ENDPATH**/ ?>