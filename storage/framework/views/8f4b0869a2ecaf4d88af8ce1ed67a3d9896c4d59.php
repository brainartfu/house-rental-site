<?php echo $__env->make('frontend.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
$banner_bg = get_blog_image_url();
$page_title = __('Blog');
$bread_title = __('Blog');
if (isset($term)) {
    $page_title = $bread_title = $term['taxonomy'];
    $term_obj = get_term_by('name', $term['term_slug']);
    if ($term_obj != null) {
        $page_title = $page_title . ': ' . get_translate($term_obj->term_title);
    }
}
?>
<div class="page-archive blog-page pb-4">
    <div class="banner" style="background: #eee url('<?php echo e($banner_bg); ?>') center center/cover no-repeat;">
    </div>
    <div class="container">
        <div class="d-none d-lg-block"><?php echo $__env->make('frontend.components.breadcrumb', ['currentPage' => $bread_title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
        <div class="row">
            <div class="col-12 col-lg-9">
                <div class="page-content">
                    <h1 class="page-title"><?php echo e($page_title); ?></h1>
                    <?php if(isset($term) && !is_null($term_obj)): ?>
                        <p class="term-description">
                            <?php echo e(get_translate($term_obj->term_description)); ?>

                        </p>
                    <?php endif; ?>
                    <?php if($posts['total'] > 0): ?>
                        <div class="page-content-inner">
                            <div class="row">
                                <?php $__currentLoopData = $posts['results']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $is_blog_page = true ?>
                                    <div class="col-md-6">
                                        <div class="post-item">
                                            <div class="post-thumbnail">
                                                <p class="post-date"><?php echo e(date(hh_date_format(), $post->created_at)); ?></p>
                                                <a href="<?php echo e(get_the_permalink($post->post_id, $post->post_slug, 'post')); ?>">
                                                    <?php
                                                    $thumb_id = $post->thumbnail_id;
                                                    $thumb_src = get_attachment_url($thumb_id, [550, 270], true);
                                                    ?>
                                                    <img src="<?php echo e($thumb_src); ?>"
                                                         alt="<?php echo e(get_attachment_alt($thumb_id)); ?>" class="img-fluid"/>
                                                </a>
                                            </div>
                                            <h3 class="post-title"><a
                                                    href="<?php echo e(get_the_permalink($post->post_id, $post->post_slug, 'post')); ?>">
                                                    <?php echo e(get_translate($post->post_title)); ?></a></h3>

                                            <ul class="post-meta">
                                                <li>
                                                    <?php echo e(sprintf(__('By %s'), get_username($post->author))); ?>

                                                </li>
                                                <?php
                                                $categories = get_category($post->post_id);
                                                if ( !empty($categories) ) {
                                                ?>
                                                <li>
                                                    <?php echo e(__('on')); ?>

                                                    <?php
                                                    $arr_cate = [];
                                                    foreach ($categories as $k => $v) {
                                                        array_push($arr_cate, '<a href="' . get_term_link($v->term_name) . '">' . esc_html(get_translate($v->term_title)) . '</a>');
                                                    }
                                                    echo implode(',', $arr_cate);
                                                    ?>
                                                </li>
                                                <?php
                                                }
                                                ?>
                                            </ul>

                                            <a href="<?php echo e(get_the_permalink($post->post_id, $post->post_slug, 'post')); ?>"
                                               class="readmore">
                                                <?php echo e(__('Read more')); ?>

                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php
                            frontend_pagination([
                                'total' => $posts['total'],
                                'query_page' => false,
                                'force_query_false' => -1,
                                'slug' => isset($slug) ? $slug : '',
                                'posts_per_page' => posts_per_page()
                            ]);
                            ?>
                        </div>
                    <?php else: ?>
                        <p><?php echo e(__('No posts found')); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="page-sidebar">
                    <?php echo $__env->make('frontend.components.sidebar', ['type' => 'post'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('frontend.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp7\htdocs\app\Views/frontend/archive.blade.php ENDPATH**/ ?>