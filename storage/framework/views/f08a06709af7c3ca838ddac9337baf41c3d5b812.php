<?php
extract($attachment);
$params = [
    'attachment_id' => $media_id,
    'attachment_encrypt' => hh_encrypt($media_id)
];
$media_url = get_attachment_url($media_id, [130, 130])
?>
<?php if(!isset($sort) || $sort == 'grid'): ?>
    <li>
        <div class="hh-media-item relative <?php if(isset($selected) && $selected): ?> selected <?php endif; ?>" data-params="<?php echo e(base64_encode(json_encode($params))); ?>"
             data-delete-url="<?php echo e(dashboard_url('delete-media-item')); ?>">
            <div class="hh-media-thumbnail">
                <img src="<?php echo e($media_url); ?>" alt="<?php echo e($media_description); ?>" class="img-fluid">
            </div>
            <?php if($type === 'normal'): ?>
                <a href="javascript:void(0)" class="link link-absolute"
                   data-attachment-id="<?php echo e($media_id); ?>"
                   data-url="<?php echo e($media_url); ?>">&nbsp;</a>
            <?php else: ?>
                <a href="javascript:void(0)" class="link link-absolute" data-toggle="modal"
                   data-target="#hh-media-item-modal"
                   data-attachment-id="<?php echo e($media_id); ?>"
                   data-url="<?php echo e(dashboard_url('media-item-detail')); ?>">&nbsp;</a>
            <?php endif; ?>
        </div>
    </li>
<?php else: ?>
    <tr>
        <td class="align-middle hh-checkbox-td">
            <div class="checkbox checkbox-success">
                <input type="checkbox" name="post_id" value="<?php echo e($media_id); ?>" id="hh-check-all-item-<?php echo e($media_id); ?>"
                       class="hh-check-all-item">
                <label for="hh-check-all-item-<?php echo e($media_id); ?>"></label>
            </div>
        </td>
        <td class="align-middle">
            <div class="media align-items-center relative">
                <a href="javascript:void(0)" class="link link-absolute" data-toggle="modal"
                   data-target="#hh-media-item-modal"
                   data-attachment-id="<?php echo e($media_id); ?>"
                   data-url="<?php echo e(dashboard_url('media-item-detail')); ?>"><span
                        class="d-none"><?php echo e(get_translate($media_title)); ?></span></a>
                <img src="<?php echo e($media_url); ?>" class="d-none d-md-block mr-3"
                     alt="<?php echo e($media_description); ?>">
                <div class="media-body">
                    <h5 class="m-0"><?php echo e(get_translate($media_title)); ?>

                        <span class="text-muted"> - <?php echo e($media_id); ?></span>
                    </h5>
                </div>
            </div>
        </td>
        <td class="align-middle">
            <?php echo e(get_file_size($media_size)); ?>/<?php echo e($media_type); ?>

        </td>
        <td class="align-middle">
            <?php echo e(get_username($author)); ?>

        </td>
        <td class="align-middle">
            <?php echo e(date(hh_date_format(), $created_at)); ?>

        </td>
        <td class="align-middle text-center">
            <div class="dropdown dropleft">
                <a href="javascript: void(0)" class="dropdown-toggle table-action-link"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                        class="ti-settings"></i></a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" target="_blank" data-toggle="modal"
                       data-target="#hh-media-item-modal"
                       data-attachment-id="<?php echo e($media_id); ?>"
                       data-url="<?php echo e(dashboard_url('media-item-detail')); ?>"
                       href="javascript:void(0)"><?php echo e(__('View')); ?></a>
                    <?php
                    $data = [
                        'attachment_id' => $media_id,
                        'attachment_encrypt' => hh_encrypt($media_id),
                    ];
                    ?>
                    <a class="dropdown-item hh-link-action hh-link-delete-media"
                       data-action="<?php echo e(dashboard_url('delete-media-item')); ?>"
                       data-parent="tr"
                       data-is-delete="true"
                       data-confirm="yes"
                       data-confirm-title="<?php echo e(__('System Alert')); ?>"
                       data-confirm-question="<?php echo e(__('Are you sure want to delete this media?')); ?>"
                       data-confirm-button="<?php echo e(__('Delete it!')); ?>"
                       data-params="<?php echo e(base64_encode(json_encode($data))); ?>"
                       href="javascript: void(0)"><?php echo e(__('Delete')); ?>

                    </a>
                </div>
            </div>
        </td>
    </tr>
<?php endif; ?>
<?php /**PATH /home/salentovacanze/public_html/app/Views/dashboard/components/media-item.blade.php ENDPATH**/ ?>