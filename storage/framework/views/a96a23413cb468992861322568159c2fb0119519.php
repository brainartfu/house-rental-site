<?php echo $__env->make('dashboard.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
enqueue_style('confirm-css');
enqueue_script('confirm-js');
?>
<div id="wrapper">
    <?php echo $__env->make('dashboard.components.top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('dashboard.components.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="content-page">
        <div class="content mt-2">
            
            <div class="card-box">
                <div class="header-area d-flex align-items-center">
                    <h4 class="header-title mb-0 d-block"><?php echo e(__('Email Checker')); ?></h4>
                </div>
                <p class="mt-2 text-muted font-italic"><?php echo e(__('Send a Test email')); ?></p>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <form action="<?php echo e(dashboard_url('email-checker')); ?>" class="form form-action relative mt-2"
                              data-validation-id="form-email-checker">
                            <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="form-group">
                                <label for="email-checker-to"><?php echo e(__('Send To:')); ?></label>
                                <input id="email-checker-to" type="email" class="form-control has-validation"
                                       name="email_to"
                                       data-validation="required">
                            </div>
                            <div class="form-group">
                                <label for="email-checker-subject"><?php echo e(__('Subject')); ?></label>
                                <input id="email-checker-subject" type="text" class="form-control has-validation"
                                       data-validation="required" name="email_subject"
                                       value="<?php echo e(__('Email Checker')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="email-checker-content"><?php echo e(__('Demo Content:')); ?></label>
                                <input id="email-checker-content" type="text" class="form-control has-validation"
                                       name="email_content" value="<?php echo e(__('This is a test mail sent from AweBooking')); ?>"
                                       data-validation="required">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success"><?php echo e(__('Send Now')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <?php echo $__env->make('dashboard.components.footer-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<?php echo $__env->make('dashboard.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/salentovacanze/public_html/app/Views/dashboard/screens/administrator/email-checker.blade.php ENDPATH**/ ?>