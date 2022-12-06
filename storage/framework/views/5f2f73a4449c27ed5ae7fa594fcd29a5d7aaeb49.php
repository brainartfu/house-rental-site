<?php
enqueue_script('nice-select-js');
enqueue_style('nice-select-css');

enqueue_script('flatpickr-js');
enqueue_style('flatpickr-css');
$user_role = get_user_role($user->getUserId(), 'id');
?>
<div class="form-group">
    <label for="user_email"><?php echo e(__('Email')); ?></label>
    <div class="form-control">
        <?php echo e($user->email); ?>

    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-6">
        <div class="form-group">
            <label for="user_first_name"><?php echo e(__('First Name')); ?> <span class="f12"><?php echo e(__('(Optional)')); ?></span></label>
            <input type="text" class="form-control" id="user_first_name_edit" name="user_first_name"
                   value="<?php echo e($user->first_name); ?>">
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <div class="form-group">
            <label for="user_last_name"><?php echo e(__('Last Name')); ?> <span class="f12"><?php echo e(__('(Optional)')); ?></span></label>
            <input type="text" class="form-control" id="user_last_name_edit" name="user_last_name"
                   value="<?php echo e($user->last_name); ?>">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-6">
        <div class="form-group">
            <label for="user_role"><?php echo e(__('Role')); ?></label>
            <select name="user_role" id="user_role_edit" class="form-control wide" data-plugin="customselect">
                <option value=""><?php echo e(__('---- Select ----')); ?></option>
                <?php
                $roles = get_all_roles();
                ?>
                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php if($user_role == $key): ?> selected <?php endif; ?> value="<?php echo e($key); ?>"><?php echo e($role); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="user_password"><?php echo e(__('Password')); ?></label>
    <div class="input-group">
        <input type="text" class="form-control" data-plugin="password" id="user_password_edit" name="user_password">
        <div class="input-group-append">
            <button class="btn btn-dark waves-effect waves-light" type="button"><?php echo e(__('Create Password')); ?></button>
        </div>
    </div>
</div>
<input type="hidden" name="userID" value="<?php echo e($user->getUserId()); ?>">
<input type="hidden" name="userEncrypt" value="<?php echo e(hh_encrypt($user->getUserId())); ?>">
<?php /**PATH /home/salentovacanze/public_html/app/Views/dashboard/components/user-edit-form.blade.php ENDPATH**/ ?>