<?php
$comments = get_comment_list($post->post_id, [
    'number' => comments_per_page(),
    'page' => request()->get('review_page', 1),
    'type' => 'home',
]);
$comment_number = get_comment_number($post->post_id, 'home');
?>


<?php if(user_can_review(get_current_user_id(), $post->post_id, 'home')): ?>
	
<div class="stripsbox">
	<div class="home-comment-list">

    <?php if(!empty($comment_number)): ?>
        <?php
        render_home_comment_list($comments['results']);
        frontend_pagination([
            'total' => $comments['count'],
            'posts_per_page' => comments_per_page(),
            'query_string' => '',
            'current_url' => '',
            'type' => 'home',
            'page' => request()->get('review_page', 1)
        ], true);
        ?>
    <?php endif; ?>
</div>
    <div class="post-comment parent-form" id="hh-comment-section">
        <div class="comment-form-wrapper">
            <form action="<?php echo e(url('add-post-comment')); ?>" class="comment-form form-sm form-action form-add-post-comment"
                  data-google-captcha="yes"
                  data-validation-id="form-add-comment"
                  method="post" data-reload-time="1000">
				      <h3 class="comment-count">
        <?php echo e(_n("[0::%s reviews for this home][1::%s review for this home][2::%s reviews for this home]", $comment_number)); ?>

    </h3>
                <h3 class="comment-title"><?php echo e(__('Leave a Review')); ?></h3>
                <p class="notice"><?php echo e(__('Your email address will not be published. Required fields are marked *')); ?></p>
                <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <input type="hidden" name="post_id" value="<?php echo e($post->post_id); ?>"/>
                <input type="hidden" name="comment_id" value="0"/>
                <input type="hidden" name="comment_type" value="home"/>
                <div class="row">
                    <?php if(!is_user_logged_in()){ ?>
                    <div class="form-group col-lg-6">
                        <input id="comment-name" type="text" name="comment_name" class="form-control has-validation"
                               placeholder="<?php echo e(__('Your name*')); ?>" data-validation="required"/>
                    </div>
                    <div class="form-group col-lg-6">
                        <input id="comment-email" type="email" name="comment_email" class="form-control has-validation"
                               placeholder="<?php echo e(__('Your email*')); ?>" data-validation="required"/>
                    </div>
                    <?php } ?>
                    <div class="form-group col-lg-6">
                        <input id="comment-title" type="text" name="comment_title" class="form-control has-validation"
                               placeholder="<?php echo e(__('Comment title*')); ?>" data-validation="required"/>
                    </div>
                    <div class="form-group col-lg-6">
                        <div class="review-select-rate">
                            <span><?php echo e(__('Your rating')); ?></span>
                            <div class="fas-star">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <input type="hidden" name="review_star" value="5" class="review_star">
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                    <textarea id="comment-content" name="comment_content" placeholder="<?php echo e(__('Comment*')); ?>"
                              class="form-control has-validation" data-validation="required"></textarea>
                    </div>
                </div>
                <div class="form-message"></div>
                <button type="submit" class="btn btn-primary text-uppercase"><?php echo e(__('Submit Review')); ?></button>
            </form>
        </div>
    </div> </div>
<?php endif; ?>
<?php /**PATH /home/salentovacanze/public_html/app/Views/frontend/home/review.blade.php ENDPATH**/ ?>