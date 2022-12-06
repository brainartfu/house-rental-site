<?php
    global $post;
?>
<div id="admin-bar" class="admin-bar">
    <div class="admin-bar__logo">
        <a href="<?php echo e(dashboard_url('/')); ?>"><span
                class="mr-1"><?php echo get_icon('001_dashboard', '#D8D8D8', '18px', '18px'); ?></span><?php echo e(__('Dashboard')); ?>

        </a>
    </div>
    <div class="admin-bar__actions">
        <div class="admin-bar-item admin-bar-action--add-new dropdown">
            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                <span class="icon"><i class="mdi mdi-plus mr-1"></i></span>
                <?php echo e(__('Add New')); ?>

            </button>
            <div class="dropdown-menu dropdown-menu-right">
            <?php if(is_admin()): ?>
                <!-- item-->
                    <a href="<?php echo e(dashboard_url('add-new-post')); ?>" class="dropdown-item">
                        <span><?php echo e(__('New Post')); ?></span>
                    </a>
                    <!-- item-->
                    <a href="<?php echo e(dashboard_url('add-new-page')); ?>" class="dropdown-item">
                        <span><?php echo e(__('New Page')); ?></span>
                    </a>
                    <div class="dropdown-divider"></div>
            <?php endif; ?>
            <!-- item-->
                <?php if(is_enable_service('home')): ?>
                    <a href="<?php echo e(dashboard_url('add-new-home')); ?>" class="dropdown-item">
                        <span><?php echo e(__('New Home')); ?></span>
                    </a>
                <?php endif; ?>
            <!-- item-->
                <?php if(is_enable_service('experience')): ?>
                    <a href="<?php echo e(dashboard_url('add-new-experience')); ?>" class="dropdown-item">
                        <span><?php echo e(__('New Experience')); ?></span>
                    </a>
                <?php endif; ?>
            <!-- item-->
                <?php if(is_enable_service('car')): ?>
                    <a href="<?php echo e(dashboard_url('add-new-car')); ?>" class="dropdown-item">
                        <span><?php echo e(__('New Car')); ?></span>
                    </a>
                <?php endif; ?>
                <?php if(is_admin()): ?>
                    <div class="dropdown-divider"></div>
                    <!-- item-->
                    <a href="<?php echo e(dashboard_url('coupon')); ?>" class="dropdown-item">
                        <span><?php echo e(__('New Coupon')); ?></span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <?php if(user_can_edit_service($post) && get_edit_link()): ?>
            <div class="admin-bar-item admin-bar-action--edit">
                <a class="link" href="<?php echo e(get_edit_link()); ?>">
                    <span class="icon mr-1"><i class="ti-pencil"></i></span>
                    <?php echo e(__('Edit')); ?>

                </a>
            </div>
        <?php endif; ?>
        <?php if(get_option('optimize_site', 'off') == 'on'): ?>
            <?php
            $current_route = Route::current();
            $name = $current_route->getName();
            ?>
            <div class="admin-bar-item admin-bar-action--clear-cache d-none d-md-block">
                <a class="link" href="<?php echo e(url('cache/'. $name. '/'. base64_encode(urlencode(current_url())))); ?>">
                    <span class="icon mr-1"><i class="mdi mdi-cached"></i></span>
                    <?php echo e(__('Clear cache this page')); ?>

                </a>
            </div>
            <div class="admin-bar-item d-block d-md-none dropdown">
                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    <i class="icon-layers"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="<?php echo e(url('cache/'. $name. '/'. base64_encode(current_url()))); ?>">
                        <span class="icon mr-1"><i class="mdi mdi-cached"></i></span>
                        <?php echo e(__('Clear cache this page')); ?>

                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /home/salentovacanze/public_html/app/Views/frontend/components/admin-bar.blade.php ENDPATH**/ ?>