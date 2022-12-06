<?php
$layout = (!empty($layout)) ? $layout : 'col-12';
$idName = str_replace(['[', ']'], '_', $id);
?>
<div id="setting-<?php echo e($idName); ?>" data-condition="<?php echo e($condition); ?>"
     data-unique="<?php echo e($unique); ?>"
     data-operator="<?php echo e($operation); ?>"
     class="form-group mb-3 col <?php echo e($layout); ?> field-<?php echo e($type); ?>">
    <?php
    $tab_title = get_payment_options('title');
    $tab_content = get_payment_options('content');
    ?>
    <div class="col col-12">
        <ul class="nav nav-tabs nav-bordered">
            <?php $__currentLoopData = $tab_title; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $__key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $class = ($__key == 0) ? 'active show' : ''; ?>
                <li class="nav-item">
                    <a href="#<?php echo e($title['id']); ?>"
                       data-toggle="tab"
                       aria-expanded="false"
                       class="nav-link <?php echo e($class); ?>">
                        <?php echo e($title['label']); ?>

                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <div class="tab-content">
            <?php $__currentLoopData = $tab_title; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $__key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $class = ($__key == 0) ? 'active show' : ''; ?>
                <div class="tab-pane <?php echo e($class); ?>"
                     id="<?php echo e($title['id']); ?>">
                    <div class="row">
                        <?php $__currentLoopData = $tab_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $___key => $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            if ($content['section'] == $title['id']) {
                                $currentOptions[] = $content;
                                $content['value'] = \ThemeOptions::getOption($content['id'], '', true);
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
</div>
<?php if($break): ?>
    <div class="w-100"></div> <?php endif; ?>
<?php /**PATH C:\xampp7\htdocs\app\Views/options/fields/payment.blade.php ENDPATH**/ ?>