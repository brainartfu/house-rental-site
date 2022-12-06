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
                            <p class="text-muted mb-4 mt-3"><?php echo e(__("Enter your email address and we'll send you an email with instructions to reset your password.")); ?></p>
                        </div>
                        <form id="hh-reset-password-form" action="<?php echo e(url('auth/reset-password')); ?>" method="post"
                              data-reload-time="1500"
                              data-validation-id="form-reset-password"
                              class="form form-action">
                            <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="form-group">
                                <label for="email-address"><?php echo e(__('Email address')); ?></label>
                                <input class="form-control has-validation" data-validation="required|email" type="email"
                                       id="email-address" name="email" placeholder="<?php echo e(__('Email')); ?>">
                            </div>
                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block text-uppercase"
                                        type="submit"> <?php echo e(__('Reset Password')); ?> </button>
                            </div>
                            <div class="form-message">

                            </div>
                        </form>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-white-50">
                            <?php echo e(__('Back to')); ?> <a href="<?php echo e(url('auth/login')); ?>"
                                                 class="text-white ml-1"><b><?php echo e(__('Login')); ?></b></a></p>
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
<?php /**PATH /home/salentovacanze/public_html/app/Views/dashboard/reset-password.blade.php ENDPATH**/ ?>