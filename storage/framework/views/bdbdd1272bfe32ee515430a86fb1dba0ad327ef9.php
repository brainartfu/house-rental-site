<?php echo $__env->make('dashboard.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
enqueue_style('confirm-css');
enqueue_script('confirm-js');
enqueue_script('nice-select-js');
enqueue_style('nice-select-css');


$menuLocations = Config::get('awebooking.menu_location');
$listMenus = get_list_menus();
$menu_id = request()->get('menu_id', 'none');
$menu_location = '';
$menu_item = [];
if ($menu_id == 'none') {
    if (count($listMenus) > 0) {
        $menu_id = $listMenus[0]->menu_id;
    }
}
if ($menu_id != 'none') {
    $menu_item = get_menu_by_id($menu_id);
    if (!empty($menu_item)) {
        $menu_location = $menu_item->menu_position;
    }
}
$menu_items = get_menu_items_by_menu_id($menu_id);
?>
<div id="wrapper">
    <?php echo $__env->make('dashboard.components.top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('dashboard.components.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="content-page">
        <div class="content">
            <?php echo $__env->make('dashboard.components.breadcrumb', ['heading' => __('Menu')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card-box">
                <?php echo $__env->make('dashboard.screens.administrator.menu.menu-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="row">
                    <div class="col-lg-3 hh-add-menu-box-wrapper">
                        <?php echo $__env->make('dashboard.screens.administrator.menu.menu-side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="col-lg-9">
                        <?php echo $__env->make('dashboard.screens.administrator.menu.menu-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
            
            <?php echo $__env->make('dashboard.components.footer-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<?php echo $__env->make('dashboard.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp7\htdocs\app\Views/dashboard/screens/administrator/menu.blade.php ENDPATH**/ ?>