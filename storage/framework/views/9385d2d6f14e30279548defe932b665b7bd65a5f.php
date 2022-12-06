<?php
if (!enable_seo()) {
    return;
}
$options = $options = Config::get('awebooking.seo_options');
$langs = get_languages();
$seo_item = get_seo_item_by_post_id($serviceObject->post_id, $serviceObject->post_type);
?>
<div class="card-box card-seo-options">
    <h4 class="page-title">
        <?php echo e(__('Seo Options')); ?>

        <i class="dripicons-information field-desc" data-toggle="modal" data-target="#hh-seo-guide-modal"></i>
    </h4>
    <div class="hh-options-wrapper">
        <form action="<?php echo e(dashboard_url('save-seo')); ?>" class="form form-translation relative" method="post">
            <div class="hh-options-tab disable" data-tabs-calculation>
                <div class="nav nav-pills nav-pills-tab" role="tablist" data-tabs="" aria-orientation="vertical">
                    <a class="nav-link mb-2 active show" data-tabs-item id="v-pills-google-seo-tab" data-toggle="pill"
                       href="#v-pills-google-seo" role="tab" aria-selected="true">
                        <?php echo e(__('Google')); ?>

                    </a>
                    <a class="nav-link mb-2" data-tabs-item id="v-pills-facebook-seo-tab" data-toggle="pill"
                       href="#v-pills-facebook-seo" role="tab" aria-selected="true">
                        <?php echo e(__('Facebook')); ?>

                    </a>
                    <a class="nav-link mb-2" data-tabs-item id="v-pills-twitter-seo-tab" data-toggle="pill"
                       href="#v-pills-twitter-seo" role="tab" aria-selected="true">
                        <?php echo e(__('Twitter')); ?>

                    </a>
                </div>
            </div>
            <div class="hh-options-tab-content relative">
                <?php echo $__env->make("common.loading", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="v-pills-google-seo" role="tabpanel">
                        <div class="google-seo-preview">
                            <div class="google-seo-preview-inner">
                                <div class="google-seo-logo-preview">
                                    <img src="<?php echo e(asset('images/seo/google_logo.png')); ?>" alt="<?php echo e(__('Google')); ?>">
                                </div>
                                <div class="google-seo-link-preview">
                                    <?php echo e(get_the_permalink($serviceObject->post_id, $serviceObject->post_slug, $serviceObject->post_type )); ?>

                                </div>
                                <h2 class="google-seo-title-preview" data-seo-detect-seo-title></h2>
                                <div class="google-seo-extra-preview">
                                    <div
                                        class="google-seo-date-preview"><?php echo e(date(hh_date_format(), $serviceObject->created_at)); ?></div>
                                    <div class="google-seo-description-preview" data-seo-detect-seo-description></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                            foreach ($options['google'] as $field) {
                                $field = \ThemeOptions::mergeField($field);
                                $field['post_id'] = $serviceObject->post_id;
                                $field = \App\Controllers\SeoController::get_inst()->applyData($field, $seo_item);
                                echo \ThemeOptions::loadField($field);
                            }
                            ?>
                        </div>
                    </div>
                    <div class="tab-pane" id="v-pills-facebook-seo" role="tabpanel">
                        <div class="facebook-seo-preview">
                            <div class="facebook-seo-preview-inner">
                                <div class="facebook-seo-thumbnail-preview" data-seo-detect-facebook-thumbnail>
                                    <img src="<?php echo e(placeholder_image([500, 350])); ?>" alt="<?php echo e(__('Thumbnail')); ?>">
                                </div>
                                <div class="facebook-seo-content-preview">
                                    <div class="facebook-seo-link-preview">
                                        <?php echo e(get_the_permalink($serviceObject->post_id, $serviceObject->post_slug, $serviceObject->post_type )); ?>

                                    </div>
                                    <h2 class="facebook-seo-title-preview" data-seo-detect-facebook-title></h2>
                                    <div class="facebook-seo-extra-preview">
                                        <div class="facebook-seo-description-preview"
                                             data-seo-detect-facebook-description></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                            foreach ($options['facebook'] as $field) {
                                $field = \ThemeOptions::mergeField($field);
                                $field['post_id'] = $serviceObject->post_id;
                                $field = \App\Controllers\SeoController::get_inst()->applyData($field, $seo_item);
                                echo \ThemeOptions::loadField($field);
                            }
                            ?>
                        </div>
                    </div>
                    <div class="tab-pane" id="v-pills-twitter-seo" role="tabpanel">
                        <div class="twitter-seo-preview">
                            <div class="twitter-seo-preview-inner">
                                <div class="twitter-seo-thumbnail-preview" data-seo-detect-twitter-thumbnail>
                                    <img src="<?php echo e(placeholder_image([500, 350])); ?>" alt="<?php echo e(__('Thumbnail')); ?>">
                                </div>
                                <div class="twitter-seo-content-preview">
                                    <h2 class="twitter-seo-title-preview" data-seo-detect-twitter-title></h2>
                                    <div class="twitter-seo-extra-preview">
                                        <div class="twitter-seo-description-preview"
                                             data-seo-detect-twitter-description></div>
                                    </div>
                                    <div class="twitter-seo-link-preview">
                                        <i class="hh-icon ti-link"></i><?php echo e(get_the_permalink($serviceObject->post_id, $serviceObject->post_slug, $serviceObject->post_type )); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                            foreach ($options['twitter'] as $field) {
                                $field = \ThemeOptions::mergeField($field);
                                $field['service_id'] = $serviceObject->post_id;
                                $field = \App\Controllers\SeoController::get_inst()->applyData($field, $seo_item);
                                echo \ThemeOptions::loadField($field);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix mt-3">
                <div class="button-list">
                    <button class="btn btn-dark right waves-effect waves-light save-seo" type="submit"><?php echo e(__('Save')); ?>

                        <span
                            class="btn-label-right"><i class="fe-check"></i></span>
                    </button>
                </div>
            </div>
            <input type="hidden" name="postType" value="<?php echo e($serviceObject->post_type); ?>">
            <input type="hidden" name="postID" value="<?php echo e($serviceObject->post_id); ?>">
            <input type="hidden" name="postEncrypt"
                   value="<?php echo e(hh_encrypt($serviceObject->post_id)); ?>">
            <input type="hidden" name="current_language_switcher" value="<?php echo e(get_current_language()); ?>">
        </form>
    </div>
</div>
<div id="hh-seo-guide-modal" class="modal fade show" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo e(__('How to use?')); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group mb-2">
                    <h5><?php echo e(__('Shortcode')); ?></h5>
                    <ul class="list">
                        <li><code><?php echo '{{id}}'; ?></code> - <?php echo e(__('Show the post ID ')); ?></li>
                        <li><code><?php echo '{{title}}'; ?></code> - <?php echo e(__('Show the post title ')); ?></li>
                        <li><code><?php echo '{{description}}'; ?></code> - <?php echo e(__('Show the post description')); ?></li>
                        <li><code><?php echo '{{site-title}}'; ?></code> - <?php echo e(__('Show the site name')); ?></li>
                        <li><code><?php echo '{{site-description}}'; ?></code> - <?php echo e(__('Show the site description')); ?>

                        </li>
                        <li><code><?php echo '{{separator}}'; ?></code> - <?php echo e(__('Show a separator icon')); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/salentovacanze/public_html/app/Views/dashboard/seo/index.blade.php ENDPATH**/ ?>