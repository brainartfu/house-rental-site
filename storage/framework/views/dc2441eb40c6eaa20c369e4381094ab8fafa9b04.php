<?php echo $__env->make('frontend.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="hh-checkout-page pb-4">
    <?php echo $__env->make('frontend.components.breadcrumb', ['currentPage' => 'Checkout', 'inContainer' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container">
        <?php if($cart): ?>
            <?php
            $service_type = $cart['serviceType'];
            ?>
            <div class="row">
                <div class="col-12 col-lg-4 order-lg-8">
                    <div class="checkout-sidebar mt-4">
                        <?php echo $__env->make('frontend.'. $service_type.'.cart-item', ['cart' => $cart], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
                <div class="col-12 col-lg-8 order-lg-0">
                    <div class="checkout-content mt-4">
                        <h3 class="heading"><?php echo e(__('Checkout')); ?></h3>
                        <div class="card-box card-border mt-3">
                            <ul class="nav nav-tabs nav-bordered">
                                <li class="nav-item">
                                    <a href="#co-customer-information" data-toggle="tab" aria-expanded="false"
                                       class="nav-link active">
                                        <?php echo e(__('1. Customer Information')); ?>

                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#co-payment-selection" data-toggle="tab" aria-expanded="true"
                                       class="nav-link">
                                        <?php echo e(__('2. Payment Selection')); ?>

                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane relative show active" id="co-customer-information">
                                    <form id="checkout-customer-info" action="<?php echo e(url('validation-user-checkout')); ?>"
                                          class="form checkout-form relative">
                                        <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php
                                        if (is_user_logged_in()) {
                                            $user_checkout = get_user_meta(get_current_user_id(), 'user_checkout_information', false);
                                        } else {
                                            $user_checkout = false;
                                        }
                                        ?>
                                        <?php if($user_checkout): ?>
                                            <?php
                                            enqueue_script('switchery-js');
                                            enqueue_style('switchery-css');
                                            ?>
                                            <div class="use-last-user-checkout">
                                                <div class="form-group d-flex align-items-center">
                                                    <input type="checkbox" id="last-user-checkout"
                                                           name="use_last_checkout"
                                                           data-plugin="switchery" data-color="#1abc9c" value="on"
                                                           data-size="small"/>
                                                    <label class="mb-0 ml-1"
                                                           for="last-user-checkout"><?php echo e(__('Use last your information')); ?></label>
                                                </div>
                                                <div class="detail">
                                                    <p>
                                                        <strong><?php echo e(__('Email:')); ?> </strong><span><?php echo e($user_checkout['email']); ?></span>
                                                    </p>
                                                    <p>
                                                        <strong><?php echo e(__('Full Name:')); ?> </strong><span><?php echo e($user_checkout['firstName']); ?> <?php echo e($user_checkout['lastName']); ?></span>
                                                    </p>
                                                    <p>
                                                        <strong><?php echo e(__('Phone:')); ?> </strong><span><?php echo e($user_checkout['phone']); ?></span>
                                                    </p>
                                                    <p>
                                                        <strong><?php echo e(__('Address:')); ?> </strong><span><?php echo e($user_checkout['address']); ?> | <?php echo e($user_checkout['city']); ?> | <?php echo e(!empty($user_checkout['country'])? $user_checkout['country'] . ' | ': ''); ?> <?php echo e($user_checkout['postCode']); ?></span>
                                                    </p>
                                                </div>
                                                <input type="hidden" name="last_user_checkout"
                                                       value="<?php echo e(base64_encode(json_encode($user_checkout))); ?>">
                                            </div>
                                        <?php endif; ?>
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label for="co-firstname"><?php echo e(__('First Name')); ?></label>
                                                    <input type="text" name="firstName" id="co-firstname"
                                                           class="form-control has-validation"
                                                           data-validation="required"
                                                           placeholder="<?php echo e(__('First name')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label for="co-lastname"><?php echo e(__('Last Name')); ?></label>
                                                    <input type="text" name="lastName" id="co-lastname"
                                                           class="form-control has-validation"
                                                           data-validation="required"
                                                           placeholder="<?php echo e(__('Last Name')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label for="co-email"><?php echo e(__('Email')); ?></label>
                                                    <input type="text" name="email" id="co-email"
                                                           class="form-control has-validation"
                                                           data-validation="required|email"
                                                           placeholder="<?php echo e(__('Email')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label for="co-phone"><?php echo e(__('Phone')); ?></label>
                                                    <input type="text" name="phone" id="co-phone"
                                                           class="form-control has-validation"
                                                           data-validation="required"
                                                           placeholder="<?php echo e(__('Phone')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mb-3">
                                                    <label for="co-address"><?php echo e(__('Address')); ?></label>
                                                    <input type="text" name="address" id="co-address"
                                                           class="form-control has-validation"
                                                           data-validation="required"
                                                           placeholder="<?php echo e(__('Address')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label for="co-city"><?php echo e(__('City (Optional)')); ?></label>
                                                    <input type="text" name="city" id="co-city" class="form-control"
                                                           placeholder="<?php echo e(__('City')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label for="co-country"><?php echo e(__('Country')); ?> (Optional)</label>
                                                    <?php
                                                    enqueue_script('nice-select-js');
                                                    enqueue_style('nice-select-css');

                                                    $countries = list_countries();
                                                    ?>
                                                    <select name="country" id="cc-country" class="form-control wide"
                                                            data-plugin="customselect">
                                                        <option value=""><?php echo e(__('---- Select ----')); ?></option>
                                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($key); ?>"
                                                                    data-icon="<?php echo e($value['flag24']); ?>"><?php echo e($value['name']); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label for="co-postcode"><?php echo e(__('Postcode')); ?> (Optional)</label>
                                                    <input type="text" name="postCode" id="co-postcode"
                                                           class="form-control"
                                                           placeholder="<?php echo e(__('Postcode')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mb-3">
                                                    <label for="co-note"><?php echo e(__('Note (Optional)')); ?></label>
                                                    <textarea name="note" id="co-note"
                                                              class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <?php if(!is_user_logged_in()): ?>
                                                <div class="col-12">
                                                    <div class="form-group mb-3">
                                                        <div class="checkbox checkbox-success">
                                                            <input type="checkbox" id="create-user-checkout"
                                                                   name="create_user_checkout"
                                                                   value="1">
                                                            <label
                                                                for="create-user-checkout"><?php echo e(__('Create an account?')); ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="tab-footer d-flex align-items-center">
                                            <a href="<?php echo e(url('/')); ?>" class="c-black"><i
                                                    class="fe-arrow-left mr-2"></i><?php echo e(__('Return to Home')); ?>

                                            </a>
                                            <a href="javascript: void(0)"
                                               class="btn btn-primary text-uppercase float-right ml-auto waves-effect waves-light btn-next-payment">
                                                <?php echo e(__('Continue to Payment')); ?>

                                            </a>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane relative" id="co-payment-selection">
                                    <form id="checkout-payment-info" action="<?php echo e(url('checkout')); ?>"
                                          data-google-captcha="yes"
                                          class="form checkout-form checkout-form-payment relative">
                                        <div class="payment-gateways">
                                            <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php
                                            $allPayment = get_available_payments();
                                            ?>
                                            <?php if(!empty($allPayment)): ?>
                                                <?php $__currentLoopData = $allPayment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $paymentName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="payment-item payment-<?php echo e($paymentName::getID()); ?>">
                                                        <div
                                                            class="radio radio-success mb-1 mb-md-3 d-flex align-content-center">
                                                            <input id="payment-<?php echo e($paymentName::getID()); ?>"
                                                                   class="payment-method"
                                                                   type="radio" name="payment"
                                                                   value="<?php echo e($paymentName::getID()); ?>"
                                                                   <?php if($key == 0): ?> checked <?php endif; ?>>
                                                            <label
                                                                for="payment-<?php echo e($paymentName::getID()); ?>"><?php echo e($paymentName::getName()); ?></label>
                                                        </div>
                                                        <?php
                                                        $desc = $paymentName::getDescription();
                                                        ?>
                                                        <?php if(!empty($desc)): ?>
                                                            <div
                                                                class="payment-desc"><?php echo balanceTags(nl2br($desc)); ?></div>
                                                        <?php endif; ?>
                                                        <img src="<?php echo e($paymentName::getLogo()); ?>"
                                                             alt="<?php echo e($paymentName::getName()); ?>"
                                                             class="payment-logo d-none d-md-inline-block">
                                                        <?php
                                                        $html = $paymentName::getHtml();
                                                        ?>
                                                        <?php if(!empty($html)): ?>
                                                            <div class="payment-html"><?php echo balanceTags($html); ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group mt-4">
                                            <div class="checkbox checkbox-success mb-2">
                                                <input type="checkbox" id="term-condition-checkout"
                                                       name="term_condition"
                                                       value="1">
                                                <label for="term-condition-checkout">
                                                    <?php
                                                    $term_page_id = get_option('term_condition_page');
                                                    $term_page = get_post($term_page_id, 'page');
                                                    $url = url('/');
                                                    if ($term_page) {
                                                        $url = get_the_permalink($term_page->post_id, $term_page->post_slug, 'page');
                                                    }
                                                    ?>

                                                    <?php echo sprintf(__('Agree with <a href="%s" target="_blank">The Terms and Conditions</a>'), $url); ?>

                                                </label>
                                            </div>
                                        </div>
                                        <div class="tab-footer d-flex align-items-center">
                                            <a href="javascript: void(0);"
                                               class="btn-prev-customer c-black"><i
                                                    class="fe-arrow-left mr-2"></i><?php echo e(__('Back to Customer Information')); ?>

                                            </a>
                                            <input type="submit" name="sm"
                                                   value="<?php echo e(__('Complete Booking')); ?>"
                                                   class="btn btn-primary text-uppercase float-right ml-auto waves-effect waves-light btn-complete-payment">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="mt-4">
                <?php echo $__env->make('common.alert', ['type' => 'danger', 'message' => __('The cart is empty')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php echo $__env->make('frontend.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp7\htdocs\app\Views/frontend/checkout.blade.php ENDPATH**/ ?>