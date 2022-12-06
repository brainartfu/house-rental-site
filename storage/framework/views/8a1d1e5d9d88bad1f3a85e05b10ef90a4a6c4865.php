<?php echo $__env->make('dashboard.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="wrapper">
    <?php echo $__env->make('dashboard.components.top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('dashboard.components.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="content-page">
        <div class="content mt-2">
            
            <div class="card-box">
                <div class="header-area">
                    <h4 class="header-title"><?php echo e(__('TinyPNG Compress')); ?></h4>
                    <p class="description mb-0"><?php echo e(__('TinyPNG uses smart lossy compression techniques to reduce the file size of your image files')); ?></p>
                    <p class="description"><?php echo balanceTags(__('Get your API Key at <a target="_blank" href="https://tinypng.com/developers">https://tinypng.com/developers</a>')); ?></p>
                </div>
                <div class="row">
                    <?php
                    $enable_tinypng = get_opt('tinypng_enable', 'off');
                    ?>
                    <?php if($enable_tinypng == 'on'): ?>
                        <div class="col-12 col-md-6">
                            <?php
                            $checked_key = false;
                            try {
                                \Tinify\setKey(get_opt('tinypng_api_key', ''));
                                \Tinify\validate();
                                $checked_key = true;
                            } catch(\Tinify\Exception $e) {
                            ?>
                            <div class="alert alert-danger">
                                <?php echo e(__('Your API Key is invalid')); ?>

                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        <?php if($checked_key): ?>
                            <div class="w-100"></div>
                            <div class="col-12 col-md-6">
                                <div class="card-box card-border widget-rounded-circle card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                                <i class="fe-bar-chart-line- font-22 avatar-title text-info"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <h3 class="mt-1"><span
                                                        data-plugin="counterup"><?php echo e(\Tinify\getCompressionCount()); ?></span>
                                                </h3>
                                                <p class="text-muted mb-1 text-truncate"><?php echo e(__('Compressed')); ?></p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="w-100"></div>
                    <div class="col-12 col-md-6">
                        <form action="<?php echo e(dashboard_url('tinypng-compress-save')); ?>" class="form form-action mt-4"
                              data-validation-id="form-tinypng-compress"
                              method="post">
                            <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php
                            $tinypng_enable = get_opt('tinypng_enable', 'off');
                            $tinypng_api_key = get_opt('tinypng_api_key', '');
                            ?>
                            <div id="setting-tinypng-enable" class="form-group">
                                <label for="tinypng-enable">
                                    <?php echo e(__('Enable TinyPNG')); ?>

                                </label><br/>
                                <input type="checkbox" id="tinypng-enable" name="tinypng_enable"
                                       data-plugin="switchery" data-color="#1abc9c" value="on"
                                       <?php if($tinypng_enable == 'on'): ?> checked <?php endif; ?>/>
                            </div>
                            <div id="setting-tinypng-api-key" class="form-group" data-condition="tinypng-enable:is(on)">
                                <label for="tinypng-api-key"><?php echo e(__('API Key')); ?></label>
                                <input type="text" class="form-control" id="tinypng-api-key" name="tinypng_api_key"
                                       value="<?php echo e($tinypng_api_key); ?>">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success"><?php echo e(__('Save')); ?></button>
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
<?php /**PATH C:\xampp7\htdocs\app\Views/dashboard/screens/administrator/tinypng-compress.blade.php ENDPATH**/ ?>