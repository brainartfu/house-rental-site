<a class="btn btn-success waves-effect waves-light" href="javascript:void(0)" data-toggle="modal"
   data-target="#hh-add-new-term-modal">
    <i class="ti-plus mr-1"></i>
    <?php echo e(__('Create New')); ?>

</a>
<div id="hh-add-new-term-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form form-action form-add-term-modal form-translation"
                  data-validation-id="form-add-term"
                  action="<?php echo e(dashboard_url('add-new-term')); ?>">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo e(__('Create New')); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body relative">
                    <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php
                    show_lang_section('mb-2');
                    $langs = get_languages_field();
                    ?>
                    <div class="form-group">
                        <label for="term_name"><?php echo e(__('Name')); ?></label>
                        <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <input type="text" class="form-control has-validation <?php echo e(get_lang_class($key, $item)); ?>"
                                   data-validation="required" id="term_name<?php echo e(get_lang_suffix($item)); ?>"
                                   name="term_name<?php echo e(get_lang_suffix($item)); ?>" <?php if(!empty($item)): ?> data-lang="<?php echo e($item); ?>"
                                   <?php endif; ?>
                                   placeholder="<?php echo e(__('Name')); ?>">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="form-group">
                        <label for="term_description"><?php echo e(__('Description')); ?></label>
                        <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <textarea name="term_description<?php echo e(get_lang_suffix($item)); ?>"
                                      id="term_description<?php echo e(get_lang_suffix($item)); ?>"
                                      class="form-control <?php echo e(get_lang_class($key, $item)); ?>"
                                      placeholder="<?php echo e(__('Description')); ?>"
                                      <?php if(!empty($item)): ?> data-lang="<?php echo e($item); ?>" <?php endif; ?>></textarea>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="form-group field-icon relative">
                        <label for="term_icon">
                            <?php echo e(__('Icon')); ?>

                        </label>
                        <input type="text" class="form-control hh-icon-input"
                               id="term_icon" name="term_icon"
                               data-action="<?php echo e(dashboard_url('get-font-icon')); ?>"
                               data-plugin="fonticon" value=""
                               placeholder="<?php echo e(__('Icon')); ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="taxonomy_name"
                           value="home-amenity">
                    <button type="submit"
                            class="btn btn-info waves-effect waves-light"><?php echo e(__('Create New')); ?>

                    </button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->
<?php /**PATH C:\xampp7\htdocs\app\Views/dashboard/screens/administrator/services/home/quick-add-home-amenity.blade.php ENDPATH**/ ?>