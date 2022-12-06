<?php
$layout = (!empty($layout)) ? $layout : 'col-12';
if (empty($value)) {
    $value = $std;
}
$idName = str_replace(['[', ']'], '_', $id);

enqueue_script('nice-select-js');
enqueue_style('nice-select-css');
?>

<div id="setting-<?php echo e($idName); ?>" data-condition="<?php echo e($condition); ?>"
     data-unique="<?php echo e($unique); ?>"
     data-operator="<?php echo e($operation); ?>"
     class="form-group mb-3 col <?php echo e($layout); ?> field-<?php echo e($type); ?>">
    <label for="<?php echo e($idName); ?>">
        <?php echo e(__($label)); ?>

        <?php if(!empty($desc)): ?>
            <i class="dripicons-information field-desc" data-toggle="popover" data-placement="right"
               data-trigger="hover"
               data-content="<?php echo e(__($desc)); ?>"></i>
        <?php endif; ?>
    </label><br/>
    <select id="<?php echo e($idName); ?>"
            class="<?php echo e($style); ?> <?php if(!empty($validation)): ?> has-validation <?php endif; ?>"
            data-plugin="customselect"
            data-validation="<?php echo e($validation); ?>"
            name="<?php echo e($id); ?>">
        <?php
        if (!empty($choices)){
        if (!is_array($choices)) {
            $choices = explode(':', $choices);
            if ($choices[0] == 'number_range') {
                $range = explode('_', $choices[1]);
                $choices = [];
                for ($i = $range[0]; $i <= $range[1]; $i++) {
                    $choices[$i] = $i;
                }
            } elseif ($choices[0] == 'hh_currencies') {
                $choices = list_currencies(true);
            } elseif ($choices[0] == 'taxonomy') {
                $choices = get_taxonomies();
            } elseif ($choices[0] == 'terms') {
                $choices = get_terms($choices[1]);
            } elseif ($choices[0] == 'page') {
                $pages = get_all_posts('page');
                $choices = [];
                if ($pages['total'] > 0) {
                    foreach ($pages['results'] as $item) {
                        $choices[$item->post_id] = $item->post_title;
                    }
                }
            } elseif ($choices[0] == 'user') {
                $for_option = true;
                if (isset($choices[2])) {
                    $for_option = $choices[2];
                }
                $choices = get_users_by_role($choices[1], $for_option);
            } elseif ($choices[0] == 'nav') {
                $choices = get_navigation();
            } elseif ($choices[0] == 'language') {
                $langs = config('locales.languages');
                array_unshift($langs, __('Select language'));
                $choices = $langs;
            } elseif ($choices[0] == 'post_type') {
                $choices = get_posttypes(true);
            }elseif($choices[0] == 'list'){
	            if (isset($choices[1]) && $choices[1] == 'hour') {
		            $choices = list_hours($choices[2]);
	            }
            }
        }
        if(is_array($choices)){
        foreach ($choices as $key => $title){
        if (empty($title)) {
            $title = __('Default - 0');
        }
        ?>
        <option value="<?php echo e($key); ?>" <?php if($key == $value): ?> selected <?php endif; ?>><?php echo e(__(get_translate($title))); ?></option>
        <?php
        }
        }
        }
        ?>
    </select>
    <div class="clearfix"></div>
</div>
<?php if($break): ?>
    <div class="w-100"></div> <?php endif; ?>
<?php /**PATH C:\xampp7\htdocs\app\Views/options/fields/select.blade.php ENDPATH**/ ?>