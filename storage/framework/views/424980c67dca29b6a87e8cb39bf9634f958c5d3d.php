<?php
    $list_users = get_users_in_role(['administrator', 'partner'], $user_id);
?>
<div class="hh-delete-user-option">
    <input type="hidden" name="userID" value="<?php echo e($user_id); ?>"/>
    <input type="hidden" name="userEncrypt" value="<?php echo e($user_encrypt); ?>"/>
    <div class="radio radio-success mb-2">
        <input type="radio" name="delete_type" value="all" checked="" id="delete_type-all">
        <label for="delete_type-all"><?php echo e(__('Delete all service data.')); ?></label>
    </div>
    <div class="radio radio-success">
        <input type="radio" name="delete_type" value="assign" id="delete_type-user">
        <label for="delete_type-user"><?php echo e(__('Assign data to another user.')); ?></label>
        <select data-plugin="customselect" name="user_assign" class="user-option mt-2">
            <?php if(!empty($list_users)): ?>
                <?php $__currentLoopData = $list_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>"><?php echo e($val); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <option value=""><?php echo e(__('No users')); ?></option>
            <?php endif; ?>
        </select>
    </div>

    <div class="notice all mt-2">
        <p><?php echo __('If you select option <b>"Delete all service data"</b>, all the data of this user will be deleted including: '); ?></p>
        <ul>
            <li><?php echo e(__('User information (Email, location, phone)')); ?></li>
            <li><?php echo e(__('User media')); ?></li>
            <li><?php echo e(__('User review/comment')); ?></li>
            <li><?php echo e(__('User payout data')); ?></li>
            <li><?php echo e(__('User notification')); ?></li>
        </ul>
    </div>

    <div class="notice assign mt-2">
        <p><?php echo __('If you select option <b>"Assign data to another user"</b>, the user information will be deleted and listings of this user will be assigned to user you selected (Home, Car, Experience and Media)'); ?></p>
    </div>

</div>
<?php /**PATH /home/salentovacanze/public_html/app/Views/dashboard/screens/administrator/user-confirm-delete-form.blade.php ENDPATH**/ ?>