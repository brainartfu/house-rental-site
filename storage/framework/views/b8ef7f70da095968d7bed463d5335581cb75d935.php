<?php echo $__env->make('dashboard.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="wrapper">
    <?php echo $__env->make('dashboard.components.top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('dashboard.components.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="content-page">
        <div class="content">
            
            <?php echo $__env->make('dashboard.components.breadcrumb', ['heading' => __('Add new Home')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php if(!$newHome): ?>
                <div class="card-box">
                    <div class="alert alert-danger"><?php echo e(__('Can not create new Home')); ?></div>
                </div>
            <?php else: ?>
                <?php
                $serviceObject = get_post($newHome, 'home', true);
                ?>
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="card-box">
                            <?php echo \ThemeOptions::renderMeta('home_settings', $serviceObject , false, dashboard_url('post-new-home'), 'my-home'); ?>

                        </div>
                    </div>
                    <div class="d-none d-lg-block col-lg-4">
                        <?php echo $__env->make('dashboard.components.services.home.home_preview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <?php echo $__env->make("dashboard.seo.index", ['serviceObject' => $serviceObject], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php echo $__env->make('dashboard.components.footer-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<?php echo $__env->make('dashboard.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/salentovacanze/public_html/app/Views/dashboard/screens/administrator/services/home/add-new-home.blade.php ENDPATH**/ ?>