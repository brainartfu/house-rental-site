<?php
global $post;
?>
<?php echo $__env->make('frontend.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $banner_bg = get_attachment_url(get_translate($post->thumbnail_id)); ?>
<div class="page-archive pb-4">
    <div class="banner" style="background: #eee url('<?php echo e($banner_bg); ?>') center center/cover no-repeat;"> <div class="titlepageh1"><?php echo e(get_translate($post->post_title)); ?></div></div>
    <div class="container shadow">
        <?php echo $__env->make('frontend.components.breadcrumb', ['currentPage' => get_translate($post->post_title)], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="page-content">
                    <h1 class="title"><?php echo e(get_translate($post->post_title)); ?></h1>
                    <div class="page-content-inner">
                        <?php echo balanceTags(get_translate($post->post_content)); ?>
                    </div>
                </div>
            </div>
           <!-- <div class="col-12 col-lg-3">
                <div class="page-sidebar">
                    <?php echo $__env->make('frontend.components.sidebar', ['type' => 'page'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>-->
        </div>
    </div>
</div>

<?php echo $__env->make('frontend.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/salentovacanze/public_html/app/Views/frontend/page/default.blade.php ENDPATH**/ ?>