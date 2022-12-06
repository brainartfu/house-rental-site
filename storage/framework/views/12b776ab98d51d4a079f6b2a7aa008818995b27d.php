<?php echo $__env->make('dashboard.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="account-pages hh-dashboard mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-pattern">
                    <div class="card-body p-4">

                        <div class="text-center w-75 m-auto">
                            <a class="logo" href="<?php echo e(dashboard_url()); ?>">
                                <?php
                                $logo = get_option('dashboard_logo');
                                $logo_url = get_attachment_url($logo);
                                ?>
                                <img src="<?php echo e($logo_url); ?>" alt="<?php echo e(get_attachment_alt($logo)); ?>">
                            </a>
                            <p class="text-muted mb-4 mt-3"><?php echo e(__("Don't have an account? Create your account, it takes less than a minute")); ?></p>
                        </div>

                        <form id="hh-sign-up-form" action="<?php echo e(url('auth/sign-up')); ?>" method="post"
                              data-reload-time="1500"
                              data-validation-id="form-sign-up"
                              class="form form-action">
                            <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="form-group">
                                <label for="first-name"><?php echo e(__('First Name')); ?></label>
                                <input class="form-control" type="text" id="first-name" name="first_name"
                                       placeholder="<?php echo e(__('First Name')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="last-name"><?php echo e(__('First Name')); ?></label>
                                <input class="form-control" type="text" id="last-name" name="last_name"
                                       placeholder="<?php echo e(__('Last Name')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="email-address"><?php echo e(__('Email address')); ?></label>
                                <input class="form-control has-validation" data-validation="required|email" type="email"
                                       id="email-address" name="email" placeholder="<?php echo e(__('Email')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="password"><?php echo e(__('Password')); ?></label>
                                <input class="form-control has-validation" data-validation="required|min:6:ms"
                                       name="password" type="password" id="password" placeholder="<?php echo e(__('Password')); ?>">
                            </div>

                            <div class="form-group">
                                <div class="checkbox checkbox-success">
                                    <input type="checkbox" id="reg-term-condition" name="term_condition" value="1">
                                    <label for="reg-term-condition">
                                        <?php echo sprintf(__('I accept %s'), '<a href="'.get_the_permalink(get_option('term_condition_page'), '', 'page').'" class="text-dark">'. __('Terms and Conditions') .'</a>'); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block text-uppercase" type="submit"> Sign Up</button>
                            </div>
                            <div class="form-message">

                            </div>
                        </form>
                        <?php if(has_social_login()): ?>
                            <div class="text-center">
                                <h5 class="mt-3 text-muted"><?php echo e(__('Sign up using')); ?></h5>
                                <ul class="social-list list-inline mt-3 mb-0">
                                    <?php if(social_enable('facebook')): ?>
                                        <li class="list-inline-item">
                                            <a href="<?php echo e(FacebookLogin::get_inst()->getLoginUrl()); ?>"
                                               class="social-list-item border-primary text-primary"><i
                                                    class="mdi mdi-facebook"></i></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(social_enable('google')): ?>
                                        <li class="list-inline-item">
                                            <a href="<?php echo e(GoogleLogin::get_inst()->getLoginUrl()); ?>"
                                               class="social-list-item border-danger text-danger"><i
                                                    class="mdi mdi-google"></i></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <div class="d-flex align-items-center justify-content-center">
                            <p class="text-white-50 mr-2">
                                <?php echo e(__('Back to')); ?>

                                <a class="text-white mr-1" href="<?php echo e(url('/')); ?>"><?php echo e(__('Home')); ?></a>
                            </p>
                            <p class="text-white-50">
                                <?php echo e(__('Already have account?')); ?>

                                <a href="<?php echo e(url('auth/login')); ?>" class="text-white ml-1"><b><?php echo e(__('Sign In')); ?></b></a>
                            </p>
                        </div>

                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<?php echo $__env->make('dashboard.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/salentovacanze/public_html/app/Views/dashboard/sign-up.blade.php ENDPATH**/ ?>