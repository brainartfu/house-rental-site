<?php do_action('init'); ?>
<?php do_action('frontend_init'); ?>
    <!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <?php
    $favicon = get_option('favicon');
    $favicon_url = get_attachment_url($favicon);
    ?>
    <link rel="shortcut icon" type="image/png" href="<?php echo e($favicon_url); ?>"/>
    <title><?php echo e(page_title()); ?></title>
    <?php echo e(seo_output()); ?>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;1,400&display=swap"
          rel="stylesheet">
    <?php do_action('header'); ?>
    <?php do_action('init_header'); ?>
    <?php do_action('init_frontend_header'); ?>
    <?php
    $body_class = isset($bodyClass) ? $bodyClass : '';
    if (is_user_logged_in() && (is_admin() || is_partner())) {
        $body_class .= ' has-admin-bar';
    }
    ?>
</head>
<body class="awe-booking <?php echo e(is_rtl()? 'rtl': ''); ?> <?php echo e($body_class); ?>">
<?php do_action('after_body_frontend'); ?>
<nav id="mobile-navigation" class="main-navigation mobile-natigation d-lg-none"
     aria-label="<?php echo e(__('Top Menu')); ?>">
    <div class="menu-primary-container">
        <?php
        if (has_nav_primary()) {
            get_nav([
                'location' => 'primary',
                'walker' => 'main-mobile'
            ]);
        }
        ?>
    </div>
</nav><!-- #site-navigation -->
<?php echo $__env->make('common.loading', ['class' => 'page-loading'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if(!is_user_logged_in()): ?>
    <div id="hh-login-modal" class="modal fade modal-no-footer" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-uppercase"><?php echo e(__('Login')); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <form id="hh-login-form" class="form form-sm form-action" action="<?php echo e(url('auth/login')); ?>"
                          data-validation-id="form-login"
                          data-reload-time="1500"
                          method="post">
                        <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="form-group mb-3">
                            <label for="email-login-form"><?php echo e(__('Email address')); ?></label>
                            <input class="form-control has-validation" data-validation="required" type="text"
                                   id="email-login-form" name="email" placeholder="<?php echo e(__('Enter your email')); ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password-login-form"><?php echo e(__('Password')); ?></label>
                            <input class="form-control has-validation" data-validation="required|min:6:ms"
                                   type="password" id="password-login-form" name="password"
                                   placeholder="<?php echo e(__('Enter your password')); ?>">
                        </div>
                        <div class="form-group mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="checkbox-signin-login-form"
                                       checked>
                                <label class="custom-control-label"
                                       for="checkbox-signin-login-form"><?php echo e(__('Remember me')); ?></label>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-center">
                            <?php echo referer_field(false); ?>

                            <button class="btn btn-primary btn-block text-uppercase"
                                    type="submit"> <?php echo e(__('Log In')); ?></button>
                        </div>
                        <div class="form-message"></div>
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
                        <div class="mt-3 d-sm-flex align-items-center justify-content-between">
                            <p><?php echo e(__('Don\'t have an account?')); ?>

                                <a href="javascript: void(0)" data-toggle="modal" data-target="#hh-register-modal"
                                   class="font-weight-bold"><?php echo e(__('Sign Up')); ?></a>
                            </p>
                            <p>
                                <a href="javascript: void(0)" data-toggle="modal" data-target="#hh-fogot-password-modal"
                                   class="font-weight-bold"><?php echo e(__('Reset Password')); ?></a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
    <div id="hh-register-modal" class="modal fade modal-no-footer" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-uppercase"><?php echo e(__('Sign Up')); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <form id="hh-sign-up-form" action="<?php echo e(url('auth/sign-up')); ?>" method="post" data-reload-time="1500"
                          data-validation-id="form-sign-up"
                          class="form form-action">
                        <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="form-group">
                            <label for="first-name-reg-form"><?php echo e(__('First Name')); ?></label>
                            <input class="form-control" type="text" id="first-name-reg-form" name="first_name"
                                   placeholder="<?php echo e(__('First Name')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="last-name-reg-form"><?php echo e(__('Last Name')); ?></label>
                            <input class="form-control" type="text" id="last-name-reg-form" name="last_name"
                                   placeholder="<?php echo e(__('Last Name')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="email-address-reg-form"><?php echo e(__('Email address')); ?></label>
                            <input class="form-control has-validation" data-validation="required|email" type="email"
                                   id="email-address-reg-form" name="email" placeholder="<?php echo e(__('Email')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="password-reg-form"><?php echo e(__('Password')); ?></label>
                            <input class="form-control has-validation" data-validation="required|min:6:ms"
                                   name="password" type="password" id="password-reg-form"
                                   placeholder="<?php echo e(__('Password')); ?>">
                        </div>
                        <div class="form-group">
                            <div class="checkbox checkbox-success">
                                <input type="checkbox" id="reg-term-condition" name="term_condition" value="1">
                                <label for="reg-term-condition">
                                    <?php echo sprintf(__('I accept %s'), '<a class="c-pink" href="'.get_the_permalink(get_option('term_condition_page'), '', 'page').'" class="text-dark">'. __('Terms and Conditions') .'</a>'); ?>

                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary btn-block text-uppercase"
                                    type="submit"> <?php echo e(__('Sign Up')); ?></button>
                        </div>
                        <div class="form-message"></div>
                        <div class="mt-3 d-sm-flex align-items-center justify-content-between">
                            <p><?php echo e(__('Have an account?')); ?>

                                <a href="javascript: void(0)" data-toggle="modal" data-target="#hh-login-modal"
                                   class="font-weight-bold"><?php echo e(__('Log In')); ?></a>
                            </p>
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
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
    <div id="hh-fogot-password-modal" class="modal fade modal-no-footer" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-uppercase"><?php echo e(__('Reset Password')); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <form id="hh-reset-password-form" action="<?php echo e(url('auth/reset-password')); ?>" method="post"
                          data-validation-id="form-reset-password"
                          data-reload-time="1500"
                          class="form form-action">
                        <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="form-group">
                            <label for="email-address-reset-pass-form"><?php echo e(__('Email address')); ?></label>
                            <input class="form-control has-validation" data-validation="required|email" type="email"
                                   id="email-address-reset-pass-form" name="email" placeholder="<?php echo e(__('Email')); ?>">
                        </div>
                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary btn-block text-uppercase"
                                    type="submit"> <?php echo e(__('Reset Password')); ?></button>
                        </div>
                        <div class="form-message"></div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
<?php endif; ?>
<?php
$langs = get_languages(true);
$currencies = list_currencies();
$current_lang = get_current_language();
?>
<div id="hh-modal-global" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header no-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <?php if(count($langs)): ?>
                    <h4 class="title mt-0"><?php echo e(__('Select Language')); ?></h4>
                    <ul class="list-unstyled list-languages row mt-3">
                        <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($current_lang == $lang['code']): ?>
                                <li class="col-6 col-md-4 mb-3 item current">
                                    <a href="javascript: void(0)"><?php echo e(__($lang['name'])); ?></a>
                                </li>
                            <?php else: ?>
                                <li class="col-6 col-md-4 mb-3 item">
                                    <a href="<?php echo e(add_query_arg('lang', $lang['code'], current_url())); ?>"><?php echo e($lang['name']); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endif; ?>
                <?php if(count($currencies)): ?>
                    <h4 class="title mt-0"><?php echo e(__('Select Currency')); ?></h4>
                    <ul class="list-unstyled list-currencies row mt-3">
                        <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($currency['unit'] == current_currency('unit')): ?>
                                <li class="col-6 col-md-4 mb-3 item current">
                                    <a href="javascript: void(0)">
                                        <span class="symbol"><?php echo e($currency['unit']); ?> - <?php echo e($currency['symbol']); ?></span>
                                        <span class="name"><?php echo e(get_translate($currency['name'])); ?></span></a>
                                </li>
                            <?php else: ?>
                                <li class="col-6 col-md-4 mb-3 item">
                                    <a href="<?php echo e(add_query_arg('currency', $currency['unit'], current_url())); ?>">
                                        <span class="symbol"><?php echo e($currency['unit']); ?> - <?php echo e($currency['symbol']); ?></span>
                                        <span class="name"><?php echo e(get_translate($currency['name'])); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="body-wrapper">
    <?php
    $sticky = get_option('enable_sticky', 'off');
    $classSticky = '';
    if ($sticky == 'on') {
        enqueue_script('sticky-js');
        $classSticky = 'has-sticky';
    }
    ?>
    <header id="header" class="header container <?php echo e($classSticky); ?>">
    <span class="d-block d-lg-none" id="toggle-mobile-menu"><span class="top"></span><span class="center"></span><span
            class="bottom"></span></span>
        <a href="<?php echo e(url('/')); ?>" id="logo">
            <?php
            $logo = get_option('logo');
            $logo_url = get_attachment_url($logo);
            ?>
            <img src="<?php echo e($logo_url); ?>" alt="img-logo" class="img-logo">
        </a>
        <nav id="site-navigation" class="main-navigation d-none d-lg-block"
             aria-label="Primary Menu">
            <div class="menu-prmary-container">
                <?php
                if (has_nav_primary()) {
                    get_nav([
                        'location' => 'primary',
                        'walker' => 'main'
                    ]);
                }
                ?>
            </div>
        </nav><!-- #site-navigation -->
        <div id="right-navigation" class="right-navigation">
            <ul class="list-unstyled topnav-menu mb-0">
                <?php if(count($langs)): ?>
                    <li class="dropdown global-list">
                        <a class="nav-item nav-item--global" href="javascript: void(0)" data-toggle="modal"
                           data-target="#hh-modal-global">
                            <?php echo balanceTags(get_icon('global', '#AAAAAA', '18px', '18px')); ?>

                            <i class="ti-angle-down"></i>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(is_user_logged_in()): ?>
                    <?php
                    $noti = Notifications::get_inst()->countNotificationByUser(get_current_user_id());
                    $user_id = get_current_user_id();
                    $args = [
                        'user_id' => $user_id,
                        'user_encrypt' => hh_encrypt($user_id)
                    ];
                    $userData = get_current_user_data();
                    ?>
                    <li id="hh-dropdown-notification" class="dropdown notification-list"
                        data-action="<?php echo e(url('get-notifications')); ?>"
                        data-params="<?php echo e(base64_encode(json_encode($args))); ?>">
                        <a class="nav-item dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"
                           role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fe-bell noti-icon"></i>
                            <?php if($noti['total']): ?>
                                <span
                                    class="badge badge-danger rounded-circle noti-icon-badge"><?php echo e($noti['total']); ?></span>
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
                    <li class="dropdown notification-list">
                        <a class="nav-item dropdown-toggle nav-user waves-effect waves-light" data-toggle="dropdown"
                           href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="<?php echo e(get_user_avatar($userData->getUserId(), [32,32])); ?>" alt="user-image"
                                 class="rounded-circle">
                            <span class="pro-user-name ml-1">
                            <?php echo e(get_username($userData->getUserId())); ?> <i class="ti-angle-down"></i>
                        </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow"><?php echo e(__('Welcome !')); ?></h6>
                            </div>
                            <!-- item-->
                            <a href="<?php echo e(dashboard_url('profile')); ?>" class="dropdown-item notify-item">
                                <i class="fe-user"></i>
                                <span><?php echo e(__('Profile')); ?></span>
                            </a>
                        <?php if(is_admin() || is_partner()): ?>
                            <?php if(is_enable_service('home')): ?>
                                <!-- item-->
                                    <a href="<?php echo e(dashboard_url('my-home')); ?>" class="dropdown-item notify-item">
                                        <i class="fe-book-open"></i>
                                        <span><?php echo e(__('My Homes')); ?></span>
                                    </a>
                            <?php endif; ?>
                            <?php if(is_enable_service('experience')): ?>
                                <!-- item-->
                                    <a href="<?php echo e(dashboard_url('my-experience')); ?>" class="dropdown-item notify-item">
                                        <i class="fe-book-open"></i>
                                        <span><?php echo e(__('My Experiences')); ?></span>
                                    </a>
                            <?php endif; ?>
                            <?php if(is_enable_service('car')): ?>
                                <!-- item-->
                                    <a href="<?php echo e(dashboard_url('my-car')); ?>" class="dropdown-item notify-item">
                                        <i class="fe-book-open"></i>
                                        <span><?php echo e(__('My Cars')); ?></span>
                                    </a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(is_admin()): ?>
                            <!-- item-->
                                <a href="<?php echo e(dashboard_url('settings')); ?>" class="dropdown-item notify-item">
                                    <i class="fe-settings "></i>
                                    <span><?php echo e(__('Settings')); ?></span>
                                </a>
                        <?php endif; ?>
                        <!-- item-->
                        <?php
                        $data = [
                            'user_id' => $userData->getUserId(),
                            'redirect_url' => current_url()
                        ];
                        ?>
                        <!-- item-->
                            <a href="<?php echo e(dashboard_url('/')); ?>" class="dropdown-item notify-item">
                                <i class="fe-stop-circle "></i>
                                <span><?php echo e(__('Dashboard')); ?></span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:void(0)" data-action="<?php echo e(auth_url('logout')); ?>"
                               data-params="<?php echo e(base64_encode(json_encode($data))); ?>"
                               class="dropdown-item notify-item hh-link-action">
                                <i class="fe-log-out"></i>
                                <span><?php echo e(__('Logout')); ?></span>
                            </a>
                        </div>
                    </li>
                <?php else: ?>
                    <li class="li-become">
                        <a href="javascript: void(0);" class="nav-item become-a-host "
                           data-toggle="modal"
                           data-target="#hh-login-modal"><?php echo e(__('Login')); ?></a>
                    </li>
                    <?php if(get_option('enable_partner_registration', 'on') == 'on'): ?>
                        <li class="d-none d-lg-block li-become">
                            <a href="<?php echo e(url('become-a-host')); ?>"
                               class="nav-item become-a-host"><?php echo e(__('Become a Partner')); ?></a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
    </header>
    <!--<div id="content-area">-->
<?php /**PATH C:\xampp7\htdocs\app\Views/frontend/components/header.blade.php ENDPATH**/ ?>