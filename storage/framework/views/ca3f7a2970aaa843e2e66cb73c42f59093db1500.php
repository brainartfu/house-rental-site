<?php
$custom_price = isset($custom_price) ? $custom_price : [];
$post_type = isset($post_type) ? $post_type : 'home';
?>
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col"><?php echo e(__('Start Date')); ?></th>
            <th scope="col"><?php echo e(__('End Date')); ?></th>
            <th scope="col"><?php echo e(__('Price')); ?></th>
            <?php if($post_type != 'experience' ): ?>
                <th scope="col"><?php echo e(__('Available')); ?></th>
            <?php endif; ?>
            <th scope="col" width="100"><?php echo e(__('Action')); ?></th>
        </tr>
        </thead>
        <?php if(!empty($custom_price['total'])): ?>
            <tbody>
            <?php $__currentLoopData = $custom_price['results']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($key + 1); ?></td>
                    <td><?php echo e(date('Y-m-d', $item->start_time)); ?></td>
                    <td><?php echo e(date('Y-m-d', $item->end_time)); ?></td>
                    <td><?php echo e(convert_price($item->price)); ?></td>
                    <td>
                        <?php
                        $data = [
                            'priceID' => $item->ID,
                            'priceEncrypt' => hh_encrypt($item->ID),
                            'postType' => $post_type
                        ];
                        ?>
                        <input type="checkbox" id="coupon_status" name="coupon_status" data-parent="tr"
                               data-plugin="switchery" data-color="#1abc9c" class="hh-checkbox-action"
                               data-action="<?php echo e(dashboard_url('change-price-status')); ?>"
                               data-params="<?php echo e(base64_encode(json_encode($data))); ?>"
                               value="on" <?php if( $item->available == 'on'): ?> checked <?php endif; ?>/>
                    </td>
                    <td>
                        <?php
                        if ($post_type == 'car') {
                            $post_id = $item->car_id;
                        } elseif ($post_type == 'experience') {
                            $post_id = $item->exprience_id;
                        } else {
                            $post_id = $item->home_id;
                        }
                        ?>
                        <a href="javascript: void(0)" class="btn btn-danger btn-sm delete-price"
                           data-title="<?php echo e(__('Delete this item?')); ?>"
                           data-content="<?php echo e(__('Are you sure to delete this item?')); ?>"
                           data-post-type="<?php echo e($post_type); ?>"
                           data-post-id="<?php echo e($post_id); ?>"
                           data-price-id="<?php echo e($item->ID); ?>"><?php echo e(__('Delete')); ?></a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tbody>
        <?php endif; ?>
    </table>
</div>
<?php /**PATH /home/salentovacanze/public_html/app/Views/dashboard/components/services/home/custom_price.blade.php ENDPATH**/ ?>