<?php echo $__env->make('dashboard.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
enqueue_script('nice-select-js');
enqueue_style('nice-select-css');
?>
<div id="wrapper">
    <?php echo $__env->make('dashboard.components.top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('dashboard.components.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="content-page">
        <div class="content mt-2">
            
            <?php echo $__env->make('dashboard.components.breadcrumb', ['heading' => __('API Settings')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div id="api-settings">
                <div class="card-box">
                    <div class="header-area d-flex align-items-center">
                        <h4 class="header-title mb-0"><?php echo e(__('API Settings')); ?></h4>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4">
                            <?php
                            $api_lifetime = get_opt('api_lifetime', 30);
                            $api_lifetime_type = get_opt('api_lifetime_type', 'day');
                            ?>
                            <form action="<?php echo e(dashboard_url('save-api-settings')); ?>"
                                  class="form-action form-sm relative mt-3">
                                <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <div class="form-group">
                                    <label for="api-lifetime"><?php echo e(__('API Token Lifetime')); ?></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="api_lifetime" id="api-lifetime"
                                               value="<?php echo e($api_lifetime); ?>">
                                        <div class="input-group-append">
                                            <select name="api_lifetime_type" id="api-lifetime-type"
                                                    data-plugin="customselect">
                                                <option value="seconds"
                                                        <?php if($api_lifetime_type == 'seconds'): ?> selected <?php endif; ?>><?php echo e(__('Seconds')); ?></option>
                                                <option value="minute"
                                                        <?php if($api_lifetime_type == 'minute'): ?> selected <?php endif; ?>><?php echo e(__('Minute')); ?></option>
                                                <option value="hour"
                                                        <?php if($api_lifetime_type == 'hour'): ?> selected <?php endif; ?>><?php echo e(__('Hour')); ?></option>
                                                <option value="day"
                                                        <?php if($api_lifetime_type == 'day'): ?> selected <?php endif; ?>><?php echo e(__('Day')); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-success"><?php echo e(__('Save Change')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            
            <?php echo $__env->make('dashboard.components.footer-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<?php echo $__env->make('dashboard.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/salentovacanze/public_html/app/Views/dashboard/screens/administrator/api.blade.php ENDPATH**/ ?>