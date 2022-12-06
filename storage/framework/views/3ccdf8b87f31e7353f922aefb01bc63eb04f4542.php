<?php echo $__env->make('dashboard.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="account-pages login-page hh-dashboard mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-pattern">
                    <div class="card-body p-4 hh-relative">
                        <form id="hh-login-form" class="form form-sm form-action" action="<?php echo e(url('auth/login')); ?>"
                              data-validation-id="form-login"
                              data-reload-time="1500"
                              method="post">
                            <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="text-center m-auto">
                                <a class="logo" href="<?php echo e(dashboard_url()); ?>">
                                    <?php
                                    $logo = get_option('dashboard_logo');
                                    $logo_url = get_attachment_url($logo);
                                    ?>
                                    <img src="<?php echo e($logo_url); ?>" alt="<?php echo e(get_attachment_alt($logo)); ?>">
                                </a>
                                <p class="text-muted mb-4 mt-3"><?php echo e(__('Enter your account to access dashboard.')); ?></p>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email"><?php echo e(__('Email address')); ?></label>
                                <input class="form-control has-validation" data-validation="required" type="text"
                                       id="email" name="email" placeholder="<?php echo e(__('Enter your email')); ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password"><?php echo e(__('Password')); ?></label>
                                <input class="form-control has-validation" data-validation="required|min:6:ms"
                                       type="password" id="password" name="password"
                                       placeholder="<?php echo e(__('Enter your password')); ?>">
                            </div>
                            <div class="form-group mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                    <label class="custom-control-label"
                                           for="checkbox-signin"><?php echo e(__('Remember me')); ?></label>
                                </div>
                            </div>
                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block text-uppercase"
                                        type="submit"> <?php echo e(__('Log In')); ?></button>
                            </div>
                            <div class="form-message">

                            </div>
                            <?php if(has_social_login()): ?>
                                <div class="text-center">
                                    <p class="mt-3 text-muted"><?php echo e(__('Log in with')); ?></p>
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
                        </form>
                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p><a href="<?php echo e(url('auth/reset-password')); ?>"
                              class="text-white ml-1"><?php echo e(__('Forgot your password?')); ?></a></p>
                        <div class="d-flex align-items-center justify-content-center">
                            <p class="text-white-50 mr-2">
                                <?php echo e(__('Back to')); ?>

                                <a class="text-white mr-1" href="<?php echo e(url('/')); ?>"><?php echo e(__('Home')); ?></a>
                            </p>
                            <p class="text-white-50 ml-2">
                                <?php echo e(__("Don't have an account?")); ?>

                                <a href="<?php echo e(url('auth/sign-up')); ?>" class="text-white ml-1"><b><?php echo e(__('Sign Up')); ?></b></a>
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
<?php /**PATH /home/salentovacanze/public_html/app/Views/dashboard/login.blade.php ENDPATH**/ ?>