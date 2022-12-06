<?php
$layout = (!empty($layout)) ? $layout : 'col-12';
if (empty($value)) {
    $value = $std;
}
$idName = str_replace(['[', ']'], '_', $id);

global $post;

enqueue_style('dropzone-css');
enqueue_script('dropzone-js');

enqueue_style('confirm-css');
enqueue_script('confirm-js');
if (empty($style)) {
    $style = [450, 320];
}
?>
<div id="setting-<?php echo e($idName); ?>" data-condition="<?php echo e($condition); ?>"
     data-unique="<?php echo e($unique); ?>"
     data-operator="<?php echo e($operation); ?>"
     class="form-group mb-3 col <?php echo e($layout); ?> field-<?php echo e($type); ?>">
    <div class="hh-upload-wrapper" data-action-set-featured="<?php echo e(dashboard_url('set-featured-image')); ?>">
        <div class="hh-dashboard-upload-area">
            <h2><?php echo e(__('Select photo')); ?></h2>
            <button class="btn btn-upload-media"
                    data-url="<?php echo e(dashboard_url('all-media')); ?>">
                <?php echo e(__('Browse Image')); ?>

            </button>
            <div class="desc">
                <?php echo e(__($desc)); ?>

            </div>
            <input type="hidden" name="<?php echo e($id); ?>" class="upload_value input-advance-uploads"
                   data-post-id="<?php echo e($post_id); ?>" data-url="<?php echo e(dashboard_url('get-advance-attachments')); ?>"
                   data-post-type="<?php echo e($post_type); ?>"
                   data-style="<?php echo e(implode(',', $style)); ?>"
                   id="<?php echo e($idName); ?>" value="<?php echo e($value); ?>">
        </div>
        <div class="hh-dashboard-upload-render row">
            <?php
            if (!empty($value)) {
            $gallery = explode(',', $value);
            $isFetured = $post->thumbnail_id;
            foreach ($gallery as $_id) {
            $img = get_attachment_url($_id);
            $classFeatured = ($_id == $isFetured) ? 'is-featured' : '';
            ?>
            <div class="col-6 col-md-3 item">
                <div class="gallery-item">
                    <?php echo $__env->make('common.loading', ['class' => 'loading-gallery'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="gallery-image">
                        <div class="gallery-action">
                            <a href="javascript: void(0)"
                               title="<?php echo e(__('set is featured')); ?>"
                               class="hh-gallery-add-featured <?php echo e($classFeatured); ?>"
                               data-post-id="<?php echo e($post_id); ?>"
                               data-post-type="<?php echo e($post_type); ?>"
                               data-style="<?php echo e(implode(',', $style)); ?>"
                               data-id="<?php echo e($_id); ?>"><i class="fe-bookmark"></i></a>
                            <a href="javascript: void(0)" class="hh-gallery-delete"
                               title="<?php echo e(__('Delete')); ?>"
                               data-post-id="<?php echo e($post_id); ?>"
                               data-id="<?php echo e($_id); ?>"><i class="dripicons-trash"></i></a>
                        </div>
                        <img src="<?php echo e($img); ?>" alt="<?php echo get_attachment_alt($_id) ?>"
                             class="img-responsive">
                    </div>
                </div>
            </div>
            <?php
            }
            }
            ?>
        </div>
    </div>
</div>

<?php if($break): ?>
    <div class="w-100"></div> <?php endif; ?>
<?php /**PATH C:\xampp7\htdocs\app\Views/options/fields/media_advanced.blade.php ENDPATH**/ ?>