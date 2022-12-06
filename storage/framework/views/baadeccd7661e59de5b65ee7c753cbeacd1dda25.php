<?php
if (is_null($serviceObject)) {
    return;
}
$options = Config::get('awebooking.' . $key);
$availableField = \ThemeOptions::filterFields($options);
?>
<?php
if (is_multi_language()) {
    show_lang_section('mb-2');
}
?>
<div id="hh-options-wrapper" class="hh-options-wrapper">
    <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="hh-options-tab" data-tabs-calculation>
        <div class="nav nav-pills nav-pills-tab <?php if($addNew): ?> disabled-link <?php endif; ?>" id="v-pills-tab"
             role="tablist" data-tabs
             aria-orientation="vertical">
            <?php $__currentLoopData = $options['sections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $class = ($key == 0) ? 'active show' : ''; ?>
                <a class="nav-link mb-2 <?php echo e($class); ?>" data-tabs-item
                   id="v-pills-<?php echo e($section['id']); ?>-tab" data-toggle="pill"
                   href="#v-pills-<?php echo e($section['id']); ?>"
                   role="tab" aria-controls="v-pills-<?php echo e($section['id']); ?>"
                   aria-selected="true">
                    <?php if(!empty($section['icon'])): ?>
                        <i class="tab-icon <?php echo e($section['icon']); ?>"></i>
                    <?php endif; ?>
                    <?php echo e(__($section['label'])); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="hh-options-tab-content">
        <div class="tab-content">
            <?php
            $totalTab = count($options['sections']);
            ?>
            <?php $__currentLoopData = $options['sections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $class = ($key == 0) ? 'active show' : ''; ?>
                <div class="tab-pane fade <?php echo e($class); ?>"
                     id="v-pills-<?php echo e($section['id']); ?>" role="tabpanel"
                     aria-labelledby="v-pills-<?php echo e($section['id']); ?>-tab">
                    <form class="form hh-options-form <?php if($key < $totalTab - 1): ?> save-and-next <?php endif; ?> form-translation"
                          action="<?php echo e($action); ?>"
                          method="post" data-tab="#v-pills-<?php echo e($section['id']); ?>-tab">
                        <input type="hidden" name="postID" value="<?php echo e($serviceObject->post_id); ?>">
                        <input type="hidden" name="postEncrypt"
                               value="<?php echo e(hh_encrypt($serviceObject->post_id)); ?>">
                        <input type="hidden" name="hh_options_available_fields"
                               value="<?php echo e(base64_encode(serialize($availableField))); ?>">
                        <input type="hidden" name="action" value="hh_options_save_metabox">
                        <input type="hidden" name="current_language_switcher" value="<?php echo e(get_current_language()); ?>">
                        <div class="row">
                            <?php
                            $currentOptions = [];
                            ?>
                            <?php $__currentLoopData = $options['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($field['section'] === $section['id']): ?>
                                    <?php if($field['type'] === 'tab'): ?>
                                        <div class="col col-12">
                                            <ul class="nav nav-tabs nav-bordered">
                                                <?php $__currentLoopData = $field['tab_title']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $__key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $_class = ''; ?>
                                                    <?php $class = ($__key == 0) ? 'active show' : ''; ?>
                                                    <li class="nav-item">
                                                        <a href="#<?php echo e($title['id']); ?>"
                                                           data-toggle="tab"
                                                           aria-expanded="false"
                                                           class="nav-link <?php echo e($_class); ?>">
                                                            <?php echo e($title['label']); ?>

                                                        </a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                            <div class="tab-content">
                                                <?php $__currentLoopData = $field['tab_title']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $__key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $class = ($__key == 0) ? 'active show' : ''; ?>
                                                    <div class="tab-pane <?php echo e($_class); ?>"
                                                         id="<?php echo e($title['id']); ?>">
                                                        <div class="row">
                                                            <?php $__currentLoopData = $field['tab_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $___key => $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($content['section'] == $title['id']): ?>
                                                                    <?php
                                                                    $content = \ThemeOptions::mergeField($content);
                                                                    $content['post_id'] = $serviceObject->post_id;
                                                                    $currentOptions[] = $content;
                                                                    $content = \ThemeOptions::applyData($serviceObject->post_id, $content, $serviceObject);
                                                                    echo \ThemeOptions::loadField($content);
                                                                    ?>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <?php
                                        $field = \ThemeOptions::mergeField($field);
                                        $field['post_id'] = $serviceObject->post_id;
                                        $currentOptions[] = $field;
                                        $field = \ThemeOptions::applyData($serviceObject->post_id, $field, $serviceObject);
                                        echo \ThemeOptions::loadField($field);
                                        ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <input type="hidden" name="currentOptions"
                                   value="<?php echo e(base64_encode(serialize($currentOptions))); ?>">
                        </div>
                        <div class="clearfix mt-3">
                            <?php if($key > 0): ?>
                                <div class="button-list">
                                    <button class="btn btn-secondary left waves-effect waves-light btn-prev-tab-option"
                                            data-tab="#v-pills-<?php echo e($section['id']); ?>-tab"
                                            type="button">
                                        <span class="btn-label"><i class="icon-arrow-left"></i></span>
                                        <?php echo e(__('Previous')); ?>

                                    </button>
                                </div>
                            <?php endif; ?>
                            <?php if($key < $totalTab - 1): ?>
                                <input type="hidden" name="step" value="next">
                                <?php if($addNew): ?>
                                    <div class="button-list">
                                        <button
                                            class="btn btn-success right waves-effect waves-light btn-next-tab-option"
                                            data-tab="#v-pills-<?php echo e($section['id']); ?>-tab"
                                            type="button">
                                            <?php echo e(__('Save & Next')); ?>

                                            <span class="btn-label-right"><i
                                                    class="icon-arrow-right"></i></span>
                                        </button>
                                    </div>
                                <?php else: ?>
                                    <div class="button-list">
                                        <button
                                            class="btn btn-success right waves-effect waves-light btn-current-tab-option"
                                            data-tab="#v-pills-<?php echo e($section['id']); ?>-tab"
                                            type="button">
                                            <?php echo e(__('Save')); ?>

                                            <span class="btn-label-right"><i
                                                    class="fe-check"></i></span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <input type="hidden" name="step" value="finish">
                                <?php if(!empty($redirectTo)): ?>
                                    <input type="hidden" name="redirect" value="<?php echo e($redirectTo); ?>">
                                <?php endif; ?>
                                <div class="button-list">
                                    <button class="btn btn-success right waves-effect waves-light"
                                            type="submit">
                                        <?php echo e(__('Save & Finish')); ?>

                                        <span class="btn-label-right"><i class="mdi mdi-check-all"></i></span>
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php /**PATH /home/salentovacanze/public_html/app/Views/options/meta.blade.php ENDPATH**/ ?>