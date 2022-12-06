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
            padding: 10px 15px;
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
            font-weight: bold
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
        <p><?php echo e(__('Hello')); ?> <strong><?php echo e($booking->first_name); ?> <?php echo e($booking->last_name); ?></strong>,</p>
        <p><?php echo e(__('You have booked a service on our system. ')); ?></p>
        <p><?php echo e(__('Please read the information below and click Confirm to let the system confirm the request.')); ?></p>
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
                <span class="title"><?php echo e(__('Created At:')); ?></span>
                <span class="info"><?php echo e(date(hh_date_format(), $booking->created_date)); ?></span>
            </div>
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
        </div>
        <?php
        $encrypt = create_confirmation_code($booking);
        ?>
        <div class="text-center">
            <a class="button-primary confirmation-button"
               href="<?php echo e(dashboard_url('booking-confirmation?token='.$booking->token_code.'&code='. $encrypt)); ?>"><?php echo e(__('Confirm')); ?></a>
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

<?php /**PATH C:\xampp7\htdocs\app\Views/frontend/email/confirmation.blade.php ENDPATH**/ ?>