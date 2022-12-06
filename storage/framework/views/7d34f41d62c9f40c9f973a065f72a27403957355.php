<?php if(is_enable_service('home')): ?>
    <div class="hh-add-menu-box overflow-hidden">
        <h5 class="title d-flex align-items-center justify-content-between"><?php echo e(__('Home')); ?> <i
                class="fe-chevron-down"></i></h5>
        <div class="menu-content-wrapper">
            <div class="content">
                <?php
                $all_posts = get_all_posts('home');
                if($all_posts['total'] > 0){
                foreach ($all_posts['results'] as $k => $item){
                ?>
                <div class="checkbox  checkbox-success mb-2">
                    <input type="checkbox"
                           class="hh-add-menu-item"
                           name="menu_item[]"
                           value="<?php echo e($item->post_id); ?>"
                           data-id="<?php echo e($item->post_id); ?>"
                           data-url="<?php echo e(get_home_permalink($item->post_id, $item->post_slug)); ?>"
                           data-type="home"
                           data-name="<?php echo e(get_translate($item->post_title)); ?>"
                           id="menu_item_home_<?php echo e($item->post_id); ?>"/>
                    <label for="menu_item_home_<?php echo e($item->post_id); ?>"><?php echo e(get_translate($item->post_title)); ?></label>
                </div>
                <?php
                }
                }else {
                    echo __('No home found');
                }
                ?>
            </div>
            <?php if($all_posts['total'] > 0): ?>
                <a href="#" class="btn btn-success btn-sm mt-2 right hh-btn-add-menu-item"><?php echo e(__('Add to menu')); ?></a>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp7\htdocs\app\Views/dashboard/screens/administrator/menu/item-home.blade.php ENDPATH**/ ?>