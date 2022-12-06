<div class="hh-add-menu-box overflow-hidden">
    <h5 class="title d-flex align-items-center justify-content-between"><?php echo e(__('Tags')); ?> <i class="fe-chevron-down"></i>
    </h5>
    <div class="menu-content-wrapper">
        <div class="content">
            <?php
            $all_posts = get_terms('post-tag', true);
            if(count($all_posts) > 0){
            foreach ($all_posts as $k => $item){
            ?>
            <div class="checkbox  checkbox-success mb-2">
                <input type="checkbox"
                       class="hh-add-menu-item"
                       name="menu_item[]"
                       value="<?php echo e($item->term_id); ?>"
                       data-id="<?php echo e($item->term_id); ?>"
                       data-url="<?php echo e(url('tag/' . $item->term_name)); ?>"
                       data-type="tag"
                       data-name="<?php echo e(get_translate($item->term_title)); ?>"
                       id="menu_item_tag_<?php echo e($item->term_id); ?>"/>
                <label for="menu_item_tag_<?php echo e($item->term_id); ?>"><?php echo e(get_translate($item->term_title)); ?></label>
            </div>
            <?php
            }
            }else {
                echo __('No tags found');
            }
            ?>
        </div>
        <?php if(count( $all_posts ) > 0): ?>
            <a href="#" class="btn btn-success btn-sm mt-2 right hh-btn-add-menu-item"><?php echo e(__('Add to menu')); ?></a>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\xampp7\htdocs\app\Views/dashboard/screens/administrator/menu/item-tag.blade.php ENDPATH**/ ?>