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
       ';
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

        <p><?php echo e(__('Hello')); ?> <strong><?php echo e(get_username($user->getUserId())); ?></strong>,</p>
        <p><?php echo sprintf(__('Welcome to the website %s'), '<a href="' . url('/') . '">' . get_option('site_name') .'</a>'); ?> </p>
        <p><?php echo e(__('Here is your information:')); ?></p>
        <div class="booking-detail">
            <div class="item">
                <span class="title"><?php echo e(__('User ID:')); ?></span>
                <span class="info"><?php echo e($user->getUserId()); ?></span>
            </div>
            <div class="item">
                <span class="title"><?php echo e(__('Email:')); ?></span>
                <span class="info"><?php echo e($user->email); ?></span>
            </div>
            <div class="item">
                <span class="title"><?php echo e(__('First Name:')); ?></span>
                <span class="info"><?php echo e($user->first_name); ?></span>
            </div>
            <div class="item">
                <span class="title"><?php echo e(__('Last Name:')); ?></span>
                <span class="info"><?php echo e($user->last_name); ?></span>
            </div>
            <div class="item">
                <span class="title"><?php echo e(__('Password:')); ?></span>
                <span class="info"><?php echo e($password); ?></span>
            </div>
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

<?php /**PATH /home/salentovacanze/public_html/app/Views/frontend/email/welcome-user.blade.php ENDPATH**/ ?>