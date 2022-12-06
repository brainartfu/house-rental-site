<?php echo $__env->make('dashboard.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
use Illuminate\Routing\UrlGenerator;
?>
<div id="wrapper">
    <?php echo $__env->make('dashboard.components.top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('dashboard.components.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="content-page">
        <div class="content mt-2">
            
            <div class="card-box">
                <div class="header-area d-flex align-items-center">
                    <h4 class="header-title mb-0 d-block"><?php echo e(__('Sitemap Settings')); ?></h4>
                </div>
                <p class="mt-2 text-muted font-italic"><?php echo e(__('Set up the sitemap settings')); ?></p>
                <div class="mt-2 text-muted font-italic"><span><?php echo e(__('View your sitemap here: ')); ?></span><a
                        href="<?php echo e(url('/sitemap_index.xml')); ?>"><?php echo e(__('sitemap_index.xml ')); ?></a></div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <form action="<?php echo e(dashboard_url('site-map-save')); ?>" class="form form-action relative mt-2"
                              data-validation-id="form-sitemap">
                            <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="form-group">
                                <?php
                                $sitemap_per_page = get_opt('sitemap_per_page', 100);
                                ?>
                                <label for="sitemap-per-page"><?php echo e(__('Sitemap Per Page:')); ?></label>
                                <input id="sitemap-per-page" type="text" class="form-control"
                                       name="sitemap_per_page" value="<?php echo e($sitemap_per_page); ?>">
                            </div>
                            <?php
                            $list_services = get_posttypes(true);
                            foreach($list_services as $key => $service){
                            $service_meta_key = 'sitemap_' . $key . '_enable';
                            $sitemap_service_enable = get_opt($service_meta_key, 'on');
                            ?>
                            <div class="form-group">
                                <label for="sitemap-<?php echo e($key); ?>-enable">
                                    <?php echo e(__('Enable ')); ?> <?php echo e($service); ?>

                                </label><br/>
                                <input type="checkbox" id="sitemap-<?php echo e($key); ?>-enable" name="sitemap_<?php echo e($key); ?>_enable"
                                       data-plugin="switchery" data-color="#1abc9c" value="on"
                                       <?php if($sitemap_service_enable == 'on'): ?> checked <?php endif; ?>/>
                            </div>
                            <?php } ?>
                            <div id="setting-services-enable" class="form-group">
                                <?php  $sitemap_post_enable = get_opt('sitemap_post_enable', 'on'); ?>
                                <label for="sitemap-post-enable">
                                    <?php echo e(__('Enable Post')); ?>

                                </label><br/>
                                <input type="checkbox" id="sitemap-post-enable" name="sitemap_post_enable"
                                       data-plugin="switchery" data-color="#1abc9c" value="on"
                                       <?php if($sitemap_post_enable == 'on'): ?> checked <?php endif; ?>/>
                            </div>
                            <div id="setting-services-enable" class="form-group">
                                <?php  $sitemap_page_enable = get_opt('sitemap_page_enable', 'on'); ?>
                                <label for="sitemap-page-enable">
                                    <?php echo e(__('Enable Page')); ?>

                                </label><br/>
                                <input type="checkbox" id="sitemap-page-enable" name="sitemap_page_enable"
                                       data-plugin="switchery" data-color="#1abc9c" value="on"
                                       <?php if($sitemap_page_enable == 'on'): ?> checked <?php endif; ?>/>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success"><?php echo e(__('Save Change')); ?></button>
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
<?php /**PATH C:\xampp7\htdocs\app\Views/dashboard/screens/administrator/site-map.blade.php ENDPATH**/ ?>