<?php
$options = \ThemeOptions::getOptionsConfig();
$availableFields = \ThemeOptions::filterFields($options);
?>
<div id="hh-options-wrapper" class="hh-options-wrapper">
    <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="hh-options-tab" data-tabs-calculation>
        <div class="nav nav-pills nav-pills-tab" id="v-pills-tab" role="tablist" data-tabs
             aria-orientation="vertical">
            <?php foreach ($options['sections'] as $key => $section){
            $class = ($key == 0) ? 'active show' : '';
            if (isset($section['auto_hide']) && $section['auto_hide']) {
                $count = 0;
                foreach ($options['fields'] as $field) {
                    if ($field['type'] == 'tab' && $field['id'] == 'affiliates_tabs') {
                        if (count($field['tab_content'])) {
                            $count++;
                        }
                    } else {
                        if ($field['section'] === $section['id']) {
                            $count++;
                        }
                    }

                }
                if ($count == 0) {
                    continue;
                }
            }
            ?>
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
            <?php } ?>
        </div>
    </div>
    <div class="hh-options-tab-content">
        <div class="tab-content">
            <?php $__currentLoopData = $options['sections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $class = ($key == 0) ? 'active show' : ''; ?>
                <div class="tab-pane fade <?php echo e($class); ?>"
                     id="v-pills-<?php echo e($section['id']); ?>" role="tabpanel"
                     aria-labelledby="v-pills-<?php echo e($section['id']); ?>-tab">
                    <form class="form hh-options-form form-translation"
                          action="<?php echo e(dashboard_url('settings')); ?>"
                          method="post" data-tab="">
                        <?php
                        if (!isset($section['translation']) || (isset($section['translation']) && !$section['translation'])) {
                            show_lang_section('mb-2');
                        }
                        ?>
                        <input type="hidden" name="hh_options_fields"
                               value="<?php echo e(base64_encode(serialize($options))); ?>">
                        <input type="hidden" name="hh_options_available_fields"
                               value="<?php echo e(base64_encode(serialize($availableFields))); ?>">
                        <input type="hidden" name="action" value="hh_options_save_option">
                        <div class="row">
                            <?php $currentOptions = []; ?>
                            <?php $__currentLoopData = $options['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($field['section'] === $section['id']): ?>
                                    <?php if($field['type'] === 'tab'): ?>
                                        <div class="col col-12">
                                            <ul class="nav nav-tabs nav-bordered">
                                                <?php $__currentLoopData = $field['tab_title']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $__key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $class = ($__key == 0) ? 'active show' : ''; ?>
                                                    <li class="nav-item">
                                                        <a href="#<?php echo e($title['id']); ?>"
                                                           data-toggle="tab"
                                                           aria-expanded="false"
                                                           class="nav-link <?php echo e($class); ?>">
                                                            <?php echo e(__($title['label'])); ?>

                                                        </a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                            <div class="tab-content">
                                                <?php $__currentLoopData = $field['tab_title']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $__key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $class = ($__key == 0) ? 'active show' : ''; ?>
                                                    <div class="tab-pane <?php echo e($class); ?>"
                                                         id="<?php echo e($title['id']); ?>">
                                                        <div class="row">
                                                            <?php $__currentLoopData = $field['tab_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $___key => $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php
                                                                if ($content['section'] == $title['id']) {
                                                                    $currentOptions[] = $content;
                                                                    $content['value'] = \ThemeOptions::getOption($content['id']);
                                                                    $content = \ThemeOptions::mergeField($content);
                                                                    echo \ThemeOptions::loadField($content);
                                                                }
                                                                ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <?php
                                        $currentOptions[] = $field;
                                        $field['value'] = \ThemeOptions::getOption($field['id'], null, true);
                                        $field = \ThemeOptions::mergeField($field);
                                        $field['field'] = $field;
                                        echo \ThemeOptions::loadField($field);
                                        ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <input type="hidden" name="currentOptions"
                                   value="<?php echo e(base64_encode(serialize($currentOptions))); ?>">
                        </div>
                        <div class="clearfix mt-3">
                            <button class="btn btn-success btn-has-spinner right width-xl waves-effect waves-light "
                                    type="submit">
                                <?php echo e(__('Save Options')); ?>

                            </button>
                        </div>
                    </form>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php /**PATH /home/salentovacanze/public_html/app/Views/options/option.blade.php ENDPATH**/ ?>