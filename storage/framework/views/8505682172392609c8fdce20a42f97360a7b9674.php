<?php
enqueue_script('nice-select-js');
enqueue_style('nice-select-css');

enqueue_script('flatpickr-js');
enqueue_style('flatpickr-css');
?>
<a class="btn btn-success waves-effect waves-light" href="javascript:void(0)" data-toggle="modal"
   data-target="#hh-add-new-user-modal">
    <i class="ti-plus mr-1"></i>
    <?php echo e(__('Create New')); ?>

</a>
<div id="hh-add-new-user-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form form-action relative" action="<?php echo e(dashboard_url('add-new-user')); ?>" data-validation-id="form-add-new-user">
            <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo e(__('Add new User')); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user_email">Email</label>
                        <input type="text" class="form-control has-validation"
                               data-validation="required" id="user_email" name="user_email">
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="user_first_name"><?php echo e(__('First Name')); ?> <span
                                        class="f12">(Optional)</span></label>
                                <input type="text" class="form-control" id="user_first_name" name="user_first_name">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="user_last_name"><?php echo e(__('Last Name')); ?> <span
                                        class="f12"><?php echo e(__('(Optional)')); ?></span></label>
                                <input type="text" class="form-control" id="user_last_name" name="user_last_name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="user_role"><?php echo e(__('Role')); ?></label>
                                <select name="user_role" id="user_role" class="form-control wide"
                                        data-plugin="customselect">
                                    <option value=""><?php echo e(__('---- Select ----')); ?></option>
                                    <?php
                                    $roles = get_all_roles();
                                    ?>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>"><?php echo e($role); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>;
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_password"><?php echo e(__('Password')); ?></label>
                        <div class="input-group">
                            <input type="text" class="form-control has-validation"
                                   data-validation="required|min:6:m" data-plugin="password" id="user_password"
                                   name="user_password">
                            <div class="input-group-append">
                                <button class="btn btn-dark waves-effect waves-light"
                                        type="button"><?php echo e(__('Create Password')); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"
                            class="btn btn-info waves-effect waves-light"><?php echo e(__('Add New')); ?>

                    </button>
                </div>
            </div>
        </form>
    </div>
</div><!-- /.modal -->
<?php /**PATH /home/salentovacanze/public_html/app/Views/dashboard/components/quick-add-user.blade.php ENDPATH**/ ?>