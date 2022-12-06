<?php if(!empty($rate)): ?>
    <?php
    $rate_full = round($rate, 0, PHP_ROUND_HALF_DOWN);
    if ($rate > $rate_full) {
        $rate_half = 1;
    } else {
        $rate_half = 0;
    }
    $rate_none = 5 - ($rate_full + $rate_half);

    $style = (isset($style)) ? $style : 1;
    ?>
    <div class="hh-star-rating style-<?php echo e($style); ?>">
        <?php if(isset($style) && $style == 2): ?>
            <span class="star-item"><?php echo get_icon('001_star', null, '16px'); ?></span>
            <?php if(isset($show_text) && $show_text): ?>
                <span class="star-text"><?php echo e($rate); ?></span>
            <?php endif; ?>
        <?php else: ?>
            <?php if(!empty($rate_full)): ?>
                <?php for($i = 0; $i < $rate_full; $i++): ?>
                    <span class="star-item"><?php echo get_icon('001_star', null, '16px'); ?></span>
                <?php endfor; ?>
            <?php endif; ?>
            <?php if(!empty($rate_half)): ?>
                <?php for($i = 0; $i < $rate_half; $i++): ?>
                    <span class="star-item"><?php echo get_icon('002_star_haft', null, '16px'); ?></span>
                <?php endfor; ?>
            <?php endif; ?>
            <?php if(!empty($rate_none)): ?>
                <?php for($i = 0; $i < $rate_none; $i++): ?>
                    <span class="star-item"><?php echo get_icon('001_star_empty', null, '16px'); ?></span>
                <?php endfor; ?>
            <?php endif; ?>
            <?php if(isset($show_text) && $show_text): ?>
                <span class="star-text"><?php echo e($rate); ?></span>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp7\htdocs\app\Views/frontend/components/star.blade.php ENDPATH**/ ?>