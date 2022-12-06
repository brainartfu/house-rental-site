<div class="hh-select-menu mb-3">
    <form action="<?php echo e(current_url()); ?>" method="GET">
        <div class="form-inline form-xs">
            <div class="form-group">
                <label for="hh-menu-selection" class="mr-2"><?php echo e(__('Select menu:')); ?></label>
                <select id="hh-menu-selection" name="menu_id" class="form-control min-w-100" data-plugin="customselect">
                    <?php
                    if(empty($menu_item) || count($listMenus) <= 0){
                    ?>
                    <option
                        value="" <?php echo ($menu_id == 'none') ? 'selected' : ''; ?>><?php echo e(__('--- Select ---')); ?></option>
                    <?php
                    }
                    if (count($listMenus) > 0) {
                        foreach ($listMenus as $key => $value) {
                            $selected = '';
                            if ($value->menu_id == $menu_id) {
                                $selected = 'selected';
                            }
                            echo '<option value="' . esc_attr($value->menu_id) . '" ' . $selected . '>' . esc_html($value->menu_title) . '</option>';
                        }
                    }
                    ?>
                </select>
                <button type="submit" class="btn btn-success btn-sm ml-sm-2 mt-2 mt-sm-0"><?php echo e(__('Select')); ?></button>
                <a href="<?php echo e(url('dashboard/menus?menu_id=0')); ?>" class="ml-2"><?php echo e(__('or create a new menu.')); ?></a>
            </div>
        </div>
    </form>
</div>
<?php /**PATH C:\xampp7\htdocs\app\Views/dashboard/screens/administrator/menu/menu-bar.blade.php ENDPATH**/ ?>