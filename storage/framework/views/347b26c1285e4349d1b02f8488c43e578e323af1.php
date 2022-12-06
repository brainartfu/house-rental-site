<?php echo $__env->make('dashboard.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
enqueue_style('dropzone-css');
enqueue_script('dropzone-js');
?>

<div id="wrapper">
    <?php echo $__env->make('dashboard.components.top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('dashboard.components.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="content-page">
        <div class="content">
            <?php echo $__env->make('dashboard.components.breadcrumb', ['heading' => __('Profile')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            <?php
            $current_user = get_current_user_data();
            $user_id = $current_user->getUserId();
            ?>
            <div class="row">
                <div class="col-12 col-lg-4 order-lg-8 ">
                    <div class="profile-preview card relative p-3  bg-pattern-1">
                        <form action="<?php echo e(dashboard_url('update-your-avatar')); ?>" class="form form-action"
                              data-validation-id="form-update-avatar">
                            <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <input type="hidden" name="user_id" value="<?php echo e($user_id); ?>">
                            <input type="hidden" name="user_encrypt" value="<?php echo e(hh_encrypt($user_id)); ?>">
                            <div class="avatar-preview">
                                <div class="media align-items-center mb-2">
                                    <img src="<?php echo e(get_user_avatar($user_id, [85,85])); ?>" class="avatar"
                                         alt="<?php echo e(__('Avatar')); ?>">
                                    <div class="media-body">
                                        <h4 class="mb-1 mt-3"><?php echo e(get_username($user_id)); ?></h4>
                                        <p class="text-muted"><?php echo e($current_user->getUserLogin()); ?></p>
                                    </div>
                                </div>
                                <a href="javascript:void(0)" class="change-avatar"><?php echo e(__('Change Avatar')); ?></a>
                                <div class="hh-upload-wrapper d-none">
                                    <div class="hh-upload-wrapper clearfix">
                                        <div class="attachments">
                                        </div>
                                        <div class="mt-1">
                                            <a href="javascript:void(0);" class="add-attachment"
                                               title="<?php echo e(__('Add Image')); ?>"
                                               data-text="<?php echo e(__('Add Image')); ?>"
                                               data-url="<?php echo e(dashboard_url('all-media')); ?>"><?php echo e(__('Add Image')); ?></a>
                                            <input type="hidden" name="avatar" class="upload_value input-upload"
                                                   data-size="85" data-url="<?php echo e(dashboard_url('get-attachments')); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-left mt-3">
                                <h4 class="font-13 text-uppercase"><?php echo e(__('About Me:')); ?></h4>
                                <p class="text-muted font-13 mb-3">
                                    <?php if($current_user->description): ?>
                                        <?php echo balanceTags(nl2br($current_user->description)); ?>

                                    <?php else: ?>
                                        <?php echo e(__('Nothing :)')); ?>

                                    <?php endif; ?>
                                </p>
                                <p class="text-muted mb-2 font-13"><strong><?php echo e(__('Full Name:')); ?></strong>
                                    <span class="ml-2"
                                          data-hh-bind-from="#first_name"><?php echo e($current_user->first_name); ?></span>
                                    <span class="ml-1"
                                          data-hh-bind-from="#last_name"><?php echo e($current_user->last_name); ?></span>
                                </p>
                                <p class="text-muted mb-2 font-13">
                                    <strong><?php echo e(__('Mobile:')); ?></strong>
                                    <span class="ml-2"><?php echo e($current_user->mobile); ?></span></p>

                                <p class="text-muted mb-2 font-13">
                                    <strong><?php echo e(__('Email:')); ?></strong>
                                    <span class="ml-2 "><?php echo e($current_user->email); ?></span>
                                </p>

                                <p class="text-muted mb-1 font-13">
                                    <strong><?php echo e(__('Location:')); ?></strong>
                                    <span class="ml-2"><?php echo e(get_country_by_code($current_user->location)['name']); ?></span>
                                </p>
                            </div>
                        </form>
                    </div>

                    
                    <div class="card relative p-3">
                        <form action="<?php echo e(dashboard_url('update-password')); ?>" class="form form-action mt-1"
                              data-validation-id="form-update-password"
                              method="post">
                            <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <input type="hidden" name="user_id" value="<?php echo e($user_id); ?>">
                            <input type="hidden" name="user_encrypt" value="<?php echo e(hh_encrypt($user_id)); ?>">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="new_password"><?php echo e(__('New Password')); ?></label>
                                        <input id="new_password" type="password" class="form-control has-validation"
                                               data-validation="required" name="password" value="">
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="new_re_password"><?php echo e(__('Re-Password')); ?></label>
                                        <input id="new_re_password" type="password" class="form-control has-validation"
                                               data-validation="required" name="password_confirmation" value="">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-warning btn-rounded waves-effect waves-light right">
                                <span class="btn-label">
                                    <i class="mdi mdi-check-all"></i>
                                </span>
                                <?php echo e(__('Change Password')); ?>

                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-lg-8 order-lg-4">
                    <div class="card relative p-3">
                        <h5><?php echo e(__('Your Profile')); ?></h5>
                        <form action="<?php echo e(dashboard_url('update-your-profile')); ?>" class="form form-action mt-3"
                              data-validation-id="form-update-profile"
                              method="post">
                            <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <input type="hidden" name="user_id" value="<?php echo e($user_id); ?>">
                            <input type="hidden" name="user_encrypt" value="<?php echo e(hh_encrypt($user_id)); ?>">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="email"><?php echo e(__('Email')); ?></label>
                                        <input id="email" type="email" class="form-control" name="email"
                                               value="<?php echo e($current_user->email); ?>">
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-6 col-md-4">
                                    <div class="form-group">
                                        <label for="first_name"><?php echo e(__('First Name')); ?></label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                               value="<?php echo e($current_user->first_name); ?>">
                                    </div>
                                </div>
                                <div class="col-6 col-md-4">
                                    <div class="form-group">
                                        <label for="last_name"><?php echo e(__('Last Name')); ?></label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                               value="<?php echo e($current_user->last_name); ?>">
                                    </div>
                                </div>
                                <div class="col-6 col-md-4">
                                    <div class="form-group">
                                        <label for="mobile"><?php echo e(__('Mobile')); ?></label>
                                        <input type="text" class="form-control" id="mobile" name="mobile"
                                               value="<?php echo e($current_user->mobile); ?>">
                                    </div>
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="form-group">
                                        <label for="mobile"><?php echo e(__('Address')); ?></label>
                                        <input type="text" class="form-control" id="address" name="address"
                                               value="<?php echo e($current_user->address); ?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="location"><?php echo e(__('Country')); ?></label>
                                        <?php
                                        enqueue_script('nice-select-js');
                                        enqueue_style('nice-select-css');

                                        $location = $current_user->location;
                                        $countries = list_countries();
                                        ?>
                                        <select name="location" id="location" class="form-control wide"
                                                data-plugin="customselect">
                                            <option value=""><?php echo e(__('---- Select ----')); ?></option>
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>" data-icon="<?php echo e($value['flag24']); ?>"
                                                        <?php if($key == $location): ?> selected <?php endif; ?>><?php echo e($value['name']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="description"><?php echo e(__('Description')); ?></label>
                                        <textarea name="description" id="description"
                                                  class="form-control"><?php echo e($current_user->description); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-rounded waves-effect waves-light right">
                                <span class="btn-label"><i class="mdi mdi-check-all"></i></span>
                                <?php echo e(__('Update')); ?>

                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <?php echo $__env->make('dashboard.components.footer-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<?php echo $__env->make('dashboard.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/salentovacanze/public_html/app/Views/dashboard/screens/administrator/profile.blade.php ENDPATH**/ ?>