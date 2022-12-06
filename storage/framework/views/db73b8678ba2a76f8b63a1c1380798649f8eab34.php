<?php echo $__env->make('dashboard.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
<?php
enqueue_style('confirm-css');
enqueue_script('confirm-js');
enqueue_script('nice-select-js');
enqueue_style('nice-select-css');
?>
<div id="wrapper">
    <?php echo $__env->make('dashboard.components.top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('dashboard.components.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="content-page">
        <div class="content">
            <?php echo $__env->make('dashboard.components.breadcrumb', ['heading' => __('New Page')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php if(!$newPage): ?>
                <div class="card-box">
                    <div class="alert alert-danger"><?php echo e(__('Can not create Page')); ?></div>
                </div>
            <?php else: ?>
                <?php
                $pageObject = get_post($newPage, 'page', true);
                ?>
                <form class="form form-action relative form-translation" action="<?php echo e(dashboard_url('edit-page')); ?>"
                      data-validation-id="form-new-page"
                      method="post" data-reload-time="1000">
                <?php show_lang_section(); ?>
                <!-- <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> -->
                    <input type="hidden" name="postID" value="<?php echo e($newPage); ?>">
                    <input type="hidden" name="postEncrypt" value="<?php echo e(hh_encrypt($newPage)); ?>">
                    <input type="hidden" name="action" value="add-new">
                    <input type="hidden" name="current_language_switcher" value="<?php echo e(get_current_language()); ?>">
                    <div class="row">
                        <div class="col-12 col-md-8 order-md-4">
                            <div class="card-box">
                                <h4 class="page-title">
                                    <?php echo e(__('New Page')); ?>

                                </h4>
                                <hr/>
                                <?php echo \ThemeOptions::renderPageMeta('page_settings.content', $newPage, true, 'all-page'); ?>

                            </div>
                        </div>
                        <div class="col-12 col-md-4 order-md-8">
                            <div class="card-box">
                                <div
                                    class="d-flex d-md-block d-xl-flex align-items-center mb-2 justify-content-between">
                                    <div class="d-flex align-items-center form-xs">
                                        <label for="hh-page-status" class="mb-0"><?php echo e(__('Status')); ?> &nbsp;</label>
                                        <select class="form-control min-w-100" id="hh-page-status" name="post_status"
                                                data-plugin="customselect">
                                            <option
                                                value="publish" <?php echo e($pageObject->status == 'publish' ? 'selected' : ''); ?>><?php echo e(__('Publish')); ?></option>
                                            <option
                                                value="draft" <?php echo e($pageObject->status == 'draft' ? 'selected' : ''); ?>><?php echo e(__('Draft')); ?></option>
                                        </select>
                                    </div>
                                    <button class="btn btn-success waves-effect waves-light mb-0 mt-md-2 mt-xl-0"
                                            type="submit"><?php echo e(__('Publish')); ?></button>
                                </div>
                                <?php echo \ThemeOptions::renderPageMeta('page_settings.sidebar', $newPage, true, 'all-page'); ?>

                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <?php echo $__env->make("dashboard.seo.index", ['serviceObject' => $pageObject], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php echo $__env->make('dashboard.components.footer-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<?php echo $__env->make('dashboard.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
<?php /**PATH C:\xampp7\htdocs\app\Views/dashboard/screens/administrator/services/page/add-new-page.blade.php ENDPATH**/ ?>