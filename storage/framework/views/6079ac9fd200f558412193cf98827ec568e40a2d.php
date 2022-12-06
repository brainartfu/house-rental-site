<!-- Topbar Start -->
<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">
        <?php
        $search = request()->get('_s');
        ?>
        <li class="d-none d-sm-block">
            <form class="app-search" action="<?php echo e(dashboard_url('all-booking')); ?>" method="get">
                <div class="app-search-box">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="<?php echo e(__('Search booking...')); ?>" name="_s"
                               value="<?php echo e($search); ?>">
                        <div class="input-group-append">
                            <button class="btn" type="submit">
                                <i class="fe-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </li>
        <?php
        $langs = get_languages(true);
        $current_session = get_current_language();
        ?>
        <?php if(count($langs) > 1): ?>
            <?php
            $lang_remain = [];
            $current_session = get_current_language();
            $current_lang = [];
            foreach ($langs as $item) {
                if ($item['code'] == $current_session) {
                    $current_lang = $item;
                } else {
                    $lang_remain[] = $item;
                }
            }
            if (empty($current_lang)) {
                $current_lang = $langs[0];
                $lang_remain = $langs;
                if (isset($lang_remain[0])) {
                    unset($lang_remain);
                }
            }
            ?>
            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown"
                   href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="ml-1">
                                <img
                                    src="<?php echo e(esc_attr(asset('vendor/countries/flag/32x32/' . $current_lang['flag_code'] . '.png'))); ?>"/>
                                <i class="mdi mdi-chevron-down"></i>
                            </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <?php $__currentLoopData = $lang_remain; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $url = \Illuminate\Support\Facades\Request::fullUrl();
                        $url = add_query_arg('lang', $item['code'], $url);
                        ?>
                        <a href="<?php echo e($url); ?>" class="dropdown-item notify-item">
                            <span>
                                <img
                                    src="<?php echo e(esc_attr(asset('vendor/countries/flag/32x32/' . $item['flag_code'] . '.png'))); ?>"/>
                                <?php echo e($item['name']); ?>

                            </span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </li>
        <?php endif; ?>
        <?php
        $noti = Notifications::get_inst()->countNotificationByUser(get_current_user_id(), 'to');

        $args = [
            'user_id' => get_current_user_id(),
            'user_encrypt' => hh_encrypt(get_current_user_id())
        ];
        ?>
        <li id="hh-dropdown-notification" class="dropdown notification-list"
            data-action="<?php echo e(url('get-notifications')); ?>"
            data-params="<?php echo e(base64_encode(json_encode($args))); ?>">
            <a class="nav-link dropdown-toggle waves-effect waves-light"
               data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
                <i class="fe-bell noti-icon"></i>
                <?php if($noti['total']): ?>
                    <span class="badge badge-danger rounded-circle noti-icon-badge"><?php echo e($noti['total']); ?></span>
                <?php endif; ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                <!-- item-->
                <div class="dropdown-item noti-title">
                    <h5 class="m-0"><?php echo e(__('Notification')); ?></h5>
                </div>
               
                <!-- All-->
                <a href="<?php echo e(dashboard_url('all-notifications')); ?>"
                   class="dropdown-item text-center text-primary notify-item notify-all">
                    <?php echo e(__('View noti')); ?>

                    <i class="fi-arrow-right"></i>
                </a>

            </div>
        </li>

        <li class="dropdown user-nav-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#"
               role="button" aria-haspopup="false" aria-expanded="false">
                <?php
                $userdata = get_current_user_data();
                ?>
                <img src="<?php echo e(get_user_avatar($userdata->getUserId(), [32,32])); ?>" alt="user-image"
                     class="rounded-circle">
                <span class="pro-user-name ml-1">
                    <?php echo e(get_username($userdata->getUserId())); ?>

                    <i class="mdi mdi-chevron-down"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow"><?php echo e(__('Welcome !')); ?></h6>
                </div>
                <!-- item-->
                <a href="<?php echo e(url('/')); ?>" class="dropdown-item notify-item">
                    <i class="fe-home"></i>
                    <span><?php echo e(__('Goto Home')); ?></span>
                </a>
                <!-- item-->
                <a href="<?php echo e(dashboard_url('profile')); ?>" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span><?php echo e(__('Profile')); ?></span>
                </a>
                <!-- item-->
                <?php if(is_admin() || is_partner()): ?>
                    <?php if(is_enable_service('home')): ?>
                        <a href="<?php echo e(dashboard_url('my-home')); ?>" class="dropdown-item notify-item">
                            <i class="fe-book-open"></i>
                            <span><?php echo e(__('Home')); ?></span>
                        </a>
                    <?php endif; ?>
                    <?php if(is_enable_service('experience')): ?>
                        <a href="<?php echo e(dashboard_url('my-experience')); ?>" class="dropdown-item notify-item">
                            <i class="fe-book-open"></i>
                            <span><?php echo e(__('Experience')); ?></span>
                        </a>
                    <?php endif; ?>
                    <?php if(is_enable_service('car')): ?>
                        <a href="<?php echo e(dashboard_url('my-car')); ?>" class="dropdown-item notify-item">
                            <i class="fe-book-open"></i>
                            <span><?php echo e(__('Car')); ?></span>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="dropdown-divider"></div>
                <!-- item-->
                <?php
                $data = [
                    'user_id' => $userdata->getUserId()
                ];
                ?>
                <a href="javascript:void(0)" data-action="<?php echo e(auth_url('logout')); ?>"
                   data-params="<?php echo e(base64_encode(json_encode($data))); ?>"
                   class="dropdown-item notify-item hh-link-action">
                    <i class="fe-log-out"></i>
                    <span><?php echo e(__('Logout')); ?></span>
                </a>

            </div>
        </li>
        <?php if(is_admin()): ?>
            <li class="dropdown notification-list">
                <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                    <i class="fe-settings noti-icon"></i>
                </a>
            </li>
        <?php endif; ?>
    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="<?php echo e(url('/')); ?>" class="logo text-center">
            <?php
            $dashboard_logo = get_option('dashboard_logo');
            $dashboard_logo_short = get_option('dashboard_logo_short');
            $dashboard_logo_url = get_attachment_url($dashboard_logo);
            $dashboard_logo_short_url = get_attachment_url($dashboard_logo_short);
            ?>
            <span class="logo-lg">
                <img src="<?php echo e($dashboard_logo_url); ?>" alt="" height="40">
            </span>
            <span class="logo-sm">
                <img src="<?php echo e($dashboard_logo_short_url); ?>" alt="" height="40">
            </span>
        </a>
    </div>
    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile waves-effect waves-light">
                <i class="fe-menu"></i>
            </button>
        </li>
        <?php if(is_admin() || is_partner()): ?>
            <li class="dropdown d-none d-lg-block">
                <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown"
                   href="javascript:void(0)" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <?php echo e(__('Create New')); ?>

                    <i class="mdi mdi-chevron-down"></i>
                </a>
                <div class="dropdown-menu">
                <?php if(is_admin()): ?>
                    <!-- item-->
                        <a href="<?php echo e(dashboard_url('add-new-post')); ?>" class="dropdown-item">
                            <span><?php echo e(__('New Post')); ?></span>
                        </a>
                        <!-- item-->
                        <a href="<?php echo e(dashboard_url('add-new-page')); ?>" class="dropdown-item">
                            <span><?php echo e(__('New Page')); ?></span>
                        </a>
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
                <!-- item-->
                    <a href="<?php echo e(dashboard_url('coupon')); ?>" class="dropdown-item">
                        <span><?php echo e(__('New Coupon')); ?></span>
                    </a>
                </div>
            </li>
        <?php endif; ?>
    </ul>
</div>
<!-- end Topbar -->
<?php /**PATH C:\xampp7\htdocs\app\Views/dashboard/components/top-bar.blade.php ENDPATH**/ ?>