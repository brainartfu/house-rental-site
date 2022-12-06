<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">
    <div class="slimscroll-menu">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <?php
                $currentScreen = Request::route()->getName();
                $current_params = \Illuminate\Support\Facades\Route::current()->parameters();
                foreach ($current_params as $key => $param) {
                    if ($key !== 'page' && $key !== 'id') {
                        $currentScreen .= '/' . $param;
                    }
                }
                $prefix = Config::get('awebooking.prefix_dashboard');
                $menuItems = get_menu_dashboard();
                ?>
                <?php if($menuItems): ?>
                    <?php $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        if (empty($menu)) {
                            continue;
                        }
                        if (isset($menu['service'])) {
                            if (!is_enable_service($menu['service'])) {
                                continue;
                            }
                        }
                        if (isset($menu['services'])) {
                            $total_service = count($menu['services']);
                            $count_service = 0;
                            foreach ($menu['services'] as $service_item) {
                                if (!is_enable_service($service_item)) {
                                    $count_service += 1;
                                }
                            }
                            if ($total_service == $count_service) {
                                continue;
                            }
                        }
                        ?>
                        <?php if($menu['type'] == 'heading'): ?>
                            <li class="menu-title"><?php echo e(__($menu['label'])); ?></li>
                            <?php
                            $menu_id = isset($menu['id']) ? $menu['id'] : '';
                            do_action('awebooking_dashboard_after_menu_' . $menu_id, $menu);
                            ?>
                        <?php endif; ?>
                        <?php if($menu['type'] === 'item' || $menu['type'] == 'hidden'): ?>
                            <?php
                            $url = 'javascript:void(0);';
                            $icon = '';
                            $active = ($currentScreen == $menu['screen']) ? 'active' : '';
                            if (!empty($menu['icon'])) {
                                $icon = get_icon($menu['icon'], '#555', '20px');
                            }
                            if (!empty($menu['screen'])) {
                                $screen = ($menu['screen'] == 'dashboard') ? '' : $menu['screen'];
                                $url = url($prefix . '/' . $screen);
                            }
                            do_action('awebooking_dashboard_menu_item_' . $menu['screen'] . '_before');
                            ?>
                            <li><a href="<?php echo e($url); ?>" class="<?php echo e($active); ?>"><?php echo $icon; ?>

                                    <span><?php echo e(__($menu['label'])); ?></span></a>
                            </li>
                            <?php do_action('awebooking_dashboard_menu_item_' . $menu['screen'] . '_after'); ?>
                        <?php endif; ?>
                        <?php if($menu['type'] === 'parent'): ?>
                            <?php

                            $menu_id = isset($menu['id']) ? $menu['id'] : '';

                            $icon = '';
                            if (!empty($menu['icon'])) {
                                $icon = get_icon($menu['icon'], '#555', '20px');
                            }
                            ?>
                            <li class="<?php if(in_array($currentScreen, $menu['screen'])): ?> active <?php endif; ?>"><a
                                    class="<?php if(in_array($currentScreen, $menu['screen'])): ?> active <?php endif; ?>"
                                    aria-expanded="<?php if (in_array($currentScreen, $menu['screen'])) echo 'true'; ?>"
                                    href="javascript: void(0);"><?php echo $icon; ?><span><?php echo e(__($menu['label'])); ?></span>
                                    <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <?php $__currentLoopData = $menu['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if (empty($child)) continue; ?>
                                        <?php if($child['type'] === 'item'): ?>
                                            <?php
                                            $url = 'javascript:void(0);';
                                            $icon = '';

                                            $active = ($currentScreen == $child['screen']) ? 'active' : '';
                                            if (!empty($child['icon'])) {
                                                $icon = '<i class="' . $child['icon'] . '"></i>';
                                            }
                                            if (!empty($child['screen'])) {
                                                $url = url($prefix . '/' . $child['screen']);
                                            }
                                            ?>
                                            <li class="<?php echo e($active); ?>"><a href="<?php echo e($url); ?>"
                                                                         class="<?php echo e($active); ?>"><?php echo e($icon); ?>

                                                    <span><?php echo e(__($child['label'])); ?></span></a></li>
                                            <?php do_action('awebooking_dashboard_menu_item_' . $child['screen'] . '_after'); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php do_action('awebooking_dashboard_menu_' . $menu_id, $menu); ?>
                                </ul>
                            </li>
                                <?php do_action('awebooking_dashboard_menu_item_' . $menu_id . '_after'); ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </ul>

        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->
<?php /**PATH C:\xampp7\htdocs\app\Views/dashboard/components/nav.blade.php ENDPATH**/ ?>