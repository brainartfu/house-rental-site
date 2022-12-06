<?php
global $post;
enqueue_script('accounting-js');
$langs = get_languages();
?>
<div id="hh-dashboard-service-preview" class="card-box">
    <div class="thumbnail">
        <?php
        $isFeatured = $post->thumbnail_id;
        $classFeatured = ($isFeatured) ? 'is-featured' : '';
        $img = get_attachment_url($isFeatured, [450, 320], true);
        $avatar = get_user_avatar($post->author, [50, 50]);
        ?>
        <img src="<?php echo e($img); ?>"
             alt="<?php echo e(__('Placeholder')); ?>"
             class="img-responsive img-featured">
        <img src="<?php echo e($avatar); ?>"
             alt="<?php echo e(__('Image Profile')); ?>"
             class="img-responsive avatar">
    </div>
    <div class="content">
        <h2 class="title"
            data-hh-bind-default="<?php echo e(__('Title of Home')); ?>">
            <?php if(!empty($langs)): ?>
                <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a class="c-black has-translation <?php echo e($key != 0 ? 'hidden' : ''); ?>"
                       data-hh-bind-from="#post_title_<?php echo e($item); ?>" target="_blank"
                       href="<?php echo e(get_the_permalink($post->post_id)); ?>" data-lang="<?php echo e($item); ?>"><?php echo e(__('Title of Home')); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <a class="c-black" data-hh-bind-from="#post_title" target="_blank"
                   href="<?php echo e(get_the_permalink($post->post_id)); ?>"><?php echo e(__('Title of Home')); ?></a>
            <?php endif; ?>
        </h2>
        <?php if(!empty($langs)): ?>
            <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p class="address has-translation <?php echo e($key != 0 ? 'hidden' : ''); ?>"
                   data-hh-bind-from="#location_address_<?php echo e($item); ?>" data-lang="<?php echo e($item); ?>"
                   data-hh-bind-default="<?php echo e(__('Address')); ?>"><?php echo e(__('Address')); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <p class="address" data-hh-bind-from="#location_address"
               data-hh-bind-default="<?php echo e(__('Address')); ?>"><?php echo e(__('Address')); ?></p>
        <?php endif; ?>
        <div class="facilities">
            <div class="item max-people">
                <?php echo __(':number guests', ['number' => '<span data-hh-bind-from="#number_of_guest"
                      data-hh-bind-default="0">0</span>']); ?>

            </div>
            <div class="item max-bedrooms">
                <?php echo __(':number beds', ['number' => '<span data-hh-bind-from="#number_of_bedrooms"
                      data-hh-bind-default="0">0</span>']); ?>

            </div>
            <div class="item max-baths">
                <?php echo __(':number baths', ['number' => '<span data-hh-bind-from="#number_of_bathrooms" data-hh-bind-default="0">0</span>']); ?>

            </div>
        </div>
        <div class="clearfix">
            <div class="reviews">
                <?php
                for ($i = 1; $i <= 5; $i++) {
                    echo '<i class="fe-star-on"></i>';
                }
                ?>
                <span class="rate"><?php echo e(__('5 Reviews')); ?></span>
            </div>
            <div class="prices">
                <span class="price" data-hh-bind-from="#base_price"
                      data-hh-accounting="1"
                      data-hh-bind-default="0">0</span>
                <span class="unit"><?php echo e(__('/night')); ?></span>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp7\htdocs\app\Views/dashboard/components/services/home/home_preview.blade.php ENDPATH**/ ?>