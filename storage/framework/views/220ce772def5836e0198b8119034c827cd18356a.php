<?php echo $__env->make('dashboard.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="wrapper">
    <?php echo $__env->make('dashboard.components.top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('dashboard.components.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="content-page">
        <div class="content mt-2">
            <?php echo $__env->make('dashboard.components.breadcrumb', ['heading' => __('Change SEO of Pages')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            <div class="card-box page-seo-tools">
                <h5><?php echo e(__('Change SEO of Pages')); ?></h5>
                <div class="row pt-3 pb-3">
                    <div class="col-12 col-lg-8">
                        <form class="form form-action hh-options-wrapper form-sm form-seo-tools"
                              action="<?php echo e(dashboard_url('seo-page-save')); ?>"
                              method="post">
                            <?php echo show_lang_section('mb-2'); ?>

                            <?php
                            $pages = config('awebooking.pages_name');
                            $i = 0;
                            foreach ($pages as $name => $page) {
                            if (isset($page['seo_page']) && !$page['seo_page']) {
                                continue;
                            }
                            ?>
                            <div class="accordion" id="accordion-<?php echo e($page['screen']); ?>-<?php echo e($i); ?>">
                                <div class="card">
                                    <div class="card-header p-1" id="heading-<?php echo e($page['screen']); ?>-<?php echo e($i); ?>">
                                        <h2 class="m-0">
                                            <button
                                                class="btn btn-link text-black-50 btn-block text-left d-flex align-items-center justify-content-between"
                                                type="button"
                                                data-toggle="collapse" data-target="#collapse-<?php echo e($page['screen']); ?>-<?php echo e($i); ?>"
                                                aria-expanded="true" aria-controls="collapse-<?php echo e($page['screen']); ?>-<?php echo e($i); ?>">
                                                <?php echo e($page['seo_name']); ?>

                                                <i class="mdi mdi-chevron-down accordion-arrow right"></i>
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapse-<?php echo e($page['screen']); ?>-<?php echo e($i); ?>" class="collapse <?php if($i == 0): ?> show <?php endif; ?>"
                                         aria-labelledby="heading-<?php echo e($page['screen']); ?>-<?php echo e($i); ?>"
                                         data-parent="#accordion-<?php echo e($page['screen']); ?>-<?php echo e($i); ?>">
                                        <div class="card-body">
                                            <div class="row">
                                                <?php
                                                $fields = [
                                                    [
                                                        'id' => 'seo_title__seo_page_' . $page['screen'],
                                                        'label' => __('SEO Title'),
                                                        'type' => 'text',
                                                        'translation' => true,
                                                        'std' => $page['label']
                                                    ],
                                                    [
                                                        'id' => 'seo_description__seo_page_' . $page['screen'],
                                                        'label' => __('SEO Description'),
                                                        'type' => 'textarea',
                                                        'translation' => true,
                                                        'std' => $page['label']
                                                    ],
                                                    [
                                                        'id' => 'facebook_title__seo_page_' . $page['screen'],
                                                        'label' => __('Facebook Title'),
                                                        'type' => 'text',
                                                        'translation' => true,
                                                        'std' => $page['label']
                                                    ],
                                                    [
                                                        'id' => 'facebook_description__seo_page_' . $page['screen'],
                                                        'label' => __('Facebook Description'),
                                                        'type' => 'textarea',
                                                        'translation' => true,
                                                        'std' => $page['label']
                                                    ],
                                                    [
                                                        'id' => 'facebook_image__seo_page_' . $page['screen'],
                                                        'label' => __('Facebook Image'),
                                                        'type' => 'upload',
                                                        'translation' => false,
                                                    ],
                                                    [
                                                        'id' => 'twitter_title__seo_page_' . $page['screen'],
                                                        'label' => __('Twitter Title'),
                                                        'type' => 'text',
                                                        'translation' => true,
                                                        'std' => $page['label']
                                                    ],
                                                    [
                                                        'id' => 'twitter_description__seo_page_' . $page['screen'],
                                                        'label' => __('Twitter Description'),
                                                        'type' => 'textarea',
                                                        'translation' => true,
                                                        'std' => $page['label']
                                                    ],
                                                    [
                                                        'id' => 'twitter_image__seo_page_' . $page['screen'],
                                                        'label' => __('Twitter Image'),
                                                        'type' => 'upload',
                                                        'translation' => false,
                                                    ],
                                                ];
                                                $seo_value = get_seo_item_by_post_id($page['screen'], 'seo_page');
                                                foreach ($fields as $field) {
                                                    $key = explode('__', $field['id']);
                                                    $key = $key[0];
                                                    $field['value'] = (!empty($seo_value->$key)) ? $seo_value->$key : '';
                                                    $field = \ThemeOptions::mergeField($field);
                                                    echo \ThemeOptions::loadField($field);
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $i++;
                            }
                            ?>
                            <div class="clearfix">
                                <button class="btn btn-success btn-has-spinner width-xl waves-effect waves-light"
                                        type="submit"><?php echo __('Save Options'); ?></button>
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
<?php /**PATH C:\xampp7\htdocs\app\Views/dashboard/screens/administrator/seo-tools.blade.php ENDPATH**/ ?>