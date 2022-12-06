<?php
$css = '
        .text-center{
            text-align: center;
        }
        .hh-email-wrapper{
            width: 95%;
            max-width: 650px;
            margin: 20px auto;
            border: 1px solid #EEE;
            padding: 20px;
        }
        .hh-email-wrapper .header-email table{
            width: 100%;
            border: none;
            table-layout: fixed;
        }
        .hh-email-wrapper .header-email .logo{
           width: 60px;
           height: auto;
        }
        .hh-email-wrapper .header-email .description{
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0;
            margin-top: 0;
        }
        .content-email{
            padding-top: 20px;
            padding-bottom: 30px;
        }

        .booking-detail{
            margin-top: 30px;
            padding: 10px 20px;
            border: 1px solid #EEE;
        }
        .booking-detail .item{
            padding-top: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #EEE;
            display: flex;
        }
        .booking-detail .item .title{
            display: inline-block;
            font-size: 15px;
            width: 35%;
        }
        .booking-detail .item .info{
            display: inline-block;
            font-size: 15px;
            font-weight: bold;
            width: 65%;
        }
        .booking-detail .client-info .info{
            font-weight: normal;
        }
        .booking-detail .client-info .info p{
            margin-top: 0;
        }
        .button-primary{
            display: inline-block;
            padding: 10px 20px;
            border: 1px solid #f8546d;
            background: #f8546d;
            color: #FFF;
            text-align: center;
        }
        .confirmation-button{
            margin-top: 30px;
            text-transform: uppercase;
            text-decoration: none;
        }

        .footer-email{
            border-top: 1px solid #EEE;
            padding: 30px 0;
        }
        .cart-list{
            margin-top: 0;
            padding-left: 0;
        }
        .cart-list li{
            padding-top: 5px;
            padding-bottom: 5px;
            border-bottom: 1px dashed #CCC;
        }
        .cart-list li span{
            display: inline-block;
            width: 50%;
        }
        .cart-list li span + span{
            display: inline-block;
            width: auto;
            text-align: right;
        }
        .booking-status{
            padding: 5px 11px;
            font-size: 12px;
            color: #FFF;
        }
        .booking-status.completed {
          background: #1abc9c;
        }

        .booking-status.incomplete {
          background: #f7b84b;
        }

        .booking-status.canceled {
          background: rgba(255, 80, 66, 0.78);
        }

        .booking-status.pending {
          background: #516a77;
        }

        .booking-status.refunded {
          background: #222;
        }
    ';

$service_data = get_booking_data($booking->ID, 'serviceObject');
start_get_view();
?>
<div class="hh-email-wrapper">
    <div class="header-email">
        <table>
            <tr>
                <td style="text-align: left">
                    <?php
                    $logo = get_option('email_logo');
                    $logo_url = get_attachment_url($logo);
                    ?>
                    <a href="<?php echo e(url('/')); ?>" target="_blank">
                        <img src="<?php echo e($logo_url); ?>" alt="<?php echo e(get_option('site_description')); ?>" class="logo">
                    </a>
                </td>
                <td style="text-align: right">
                    <h4 class="description"><?php echo e(get_option('site_name')); ?></h4>
                </td>
            </tr>
        </table>
    </div>
    <div class="content-email">
        <?php if($for == 'customer'): ?>
            <p><?php echo e(__('Hello')); ?> <strong><?php echo e($booking->first_name); ?> <?php echo e($booking->last_name); ?></strong>,</p>
            <p><?php echo e(__('Thank you for using our service!')); ?></p>
            <p><?php echo e(__('Here is your booking information:')); ?></p>
        <?php elseif($for == 'admin'): ?>
            <?php
            $admin_data = get_admin_user();
            ?>
            <p><?php echo sprintf(__('Hello %s'), '<strong>' . $admin_data->first_name . ' ' . $admin_data->last_name . '</strong>'); ?>

                ,</p>
            <p><?php echo e(__('There is a new booking on your system')); ?></p>
        <?php elseif($for == 'partner'): ?>
            <?php
            $partner_data = get_user_by_id($booking->owner);
            ?>
            <p><?php echo sprintf(__('Hello %s'), '<strong>'. $partner_data->first_name . ' ' . $partner_data->last_name .'</strong>'); ?>

                ,</p>
            <p><?php echo sprintf(__('%s has booked your service.'), '<strong>' . $booking->first_name . ' ' . $booking->last_name . '</strong>'); ?></p>
            <p><?php echo e(__('Here is the details of the booking:')); ?></p>
        <?php endif; ?>
        <div class="booking-detail">
            <div class="item">
                <span class="title"><?php echo e(__('Booking ID:')); ?></span>
                <span class="info"><?php echo e($booking->booking_id); ?></span>
            </div>
            <div class="item">
                <span class="title"><?php echo e(__('Name:')); ?></span>
                <span class="info"><?php echo e(get_translate($service_data->post_title)); ?></span>
            </div>
            <div class="item">
                <span class="title"><?php echo e(__('Amount:')); ?></span>
                <span class="info"><?php echo e(convert_price($booking->total)); ?></span>
            </div>
			<?php 
			$acconto = $homeObject->acconto;
			?> 
			<div class="item">
                <span class="title"><?php echo e(__('Bookingfee')); ?> (<?php echo e($acconto); ?>%)</span>
                <span class="info"><?php echo e(convert_price($cart['amount']/$acconto)); ?></span>
            </div>
			
            <div class="item">
                <span class="title"><?php echo e(__('Payment Method:')); ?></span>
                <span class="info">
                     <?php
                    $paymentID = $booking->payment_type;
                    $paymentObject = get_payments($paymentID);
                    ?>
                    <?php echo e($paymentObject::getName()); ?>

                </span>
            </div>
            <div class="item">
                <span class="title"><?php echo e(__('Status:')); ?></span>
                <span class="info">
                    <?php
                    $status = $booking->status;
                    $status_info = booking_status_info($status);
                    ?>
                    <span class="booking-status <?php echo e($status); ?>"><?php echo e(get_translate(__($status_info['label']))); ?></span>
                </span>
            </div>
            <div class="item">
                <span class="title"><?php echo e(__('Created At:')); ?></span>
                <span class="info"><?php echo e(date(hh_date_format(), $booking->created_date)); ?></span>
            </div>
            <div class="item">
                <span class="title"><?php echo e(__('Price Detail:')); ?></span>
                <div class="info">
                    <?php
                    $cartData = get_booking_data($booking->ID, 'cartData');
                    $checkout_data = get_booking_data($booking->ID);
                    ?>
                    <ul class="cart-list">
                        <?php
                        $checkIn = $cartData['startTime'];
                        $checkOut = $cartData['endTime'];
                        $adults = $cartData['numberAdult'];
                        $children = $cartData['numberChild'];
                        $infant = $cartData['numberInfant'];
                        ?>
                        <?php if($service_data->booking_type == 'per_night'): ?>
                            <li>
                                <span><?php echo e(__('Check In/Out')); ?></span>
                                <span>
                                <?php echo e(date(hh_date_format(), $checkIn)); ?> - <?php echo e(date(hh_date_format(), $checkOut)); ?>

                            </span>
                            </li>
                        <?php else: ?>
                            <li>
                                <span><?php echo e(__('Date')); ?></span>
                                <span>
                                <?php echo e(date(hh_date_format(), $checkIn)); ?>

                                </span>
                            </li>
                            <li>
                                <span><?php echo e(__('Time')); ?></span>
                                <span>
                                <?php echo e(date(hh_time_format(), $checkIn)); ?> - <?php echo e(date(hh_time_format(), $checkOut)); ?>

                            </span>
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
                    <ul class="menu cart-list">
                        <?php
                        $numberNight = $cartData['numberNight'];
                        $basePrice = $checkout_data['basePrice'];
                        $extraPrice = $checkout_data['extraPrice'];
                        $tax = $checkout_data['tax'];
                        $coupon = isset($checkout_data['couponPrice']) ? $checkout_data['couponPrice'] : '';
                        ?>
                        <li>
                            <span><?php echo e(_n("[0::Price for %s nights][1::Price for %s night][2::Price for %s nights]", $numberNight)); ?></span>
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
                                <span><?php echo e(__('Coupon')); ?></span>
                                <span>-<?php echo e($coupon); ?></span>
                            </li>
                        <?php endif; ?>
                        <?php
                        $tax_value = (float)$checkout_data['tax']['tax'];
                        if($tax_value > 0):
                        ?>
                        <li class="divider">
                            <span><?php echo e(__('Tax')); ?>

                                <span class="text-muted">
                                    <?php if($checkout_data['tax']['included'] == 'on'): ?>
                                        <?php echo e(__('(included)')); ?>

                                    <?php endif; ?>
                                </span>
                            </span>
                            <span><?php echo e($tax_value); ?>%</span>
                        </li>
                        <?php endif; ?>
                        <li class="amount">
                            <span><?php echo e(__('Amount')); ?></span>
                            <span><?php echo e(convert_price($checkout_data['amount'])); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
            <?php if($for == 'customer'): ?>
                <div class="item client-info">
                    <span class="title"><?php echo e(__('Your information:')); ?></span>
                    <?php
                    $user_data = get_booking_data($booking->ID, 'user_data');
                    ?>
                    <span class="info">
                    <p><?php echo e($user_data['firstName']); ?> <?php echo e($user_data['lastName']); ?></p>
                    <p><?php echo e($user_data['email']); ?></p>
                    <p><?php echo e($user_data['phone']); ?></p>
                    <p><?php echo e($user_data['address']); ?> | <?php echo e($user_data['city']); ?> | <?php echo e($user_data['postCode']); ?></p>
                    <?php if($booking->note): ?>
                            <p><?php echo e(__('Note:')); ?> <?php echo e($booking->note); ?></p>
                        <?php endif; ?>
                </span>
                </div>
            <?php endif; ?>
        </div>
        <div class="text-center">
            <a class="button-primary confirmation-button"
               href="<?php echo e(dashboard_url('all-booking')); ?>"><?php echo e(__('Your Bookings')); ?></a>
        </div>
    </div>
    <div class="footer-email">
        &copy; <?php echo e(date('Y')); ?> - <?php echo e(get_option('site_name')); ?> | <?php echo e(get_option('site_description')); ?>

    </div>
</div>
<?php
$content = end_get_view();
$render = new Emogrifier();
$render->setHtml($content);
$render->setCss($css);
$mergedHtml = $render->emogrify();
$mergedHtml = str_replace('<!DOCTYPE html>', '', $mergedHtml);
unset($render);
?>
<?php echo balanceTags($mergedHtml); ?>

<?php /**PATH C:\xampp7\htdocs\app\Views/frontend/email/home/booking-detail.blade.php ENDPATH**/ ?>