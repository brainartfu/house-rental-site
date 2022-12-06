<div class="row">
    <div class="col-12 col-sm-6 col-md-7">
        <div class="hh-media-detail-thumbnail">
            <img src="<?php echo e(get_attachment_url($mediaObject)); ?>" alt="<?php echo e($mediaObject->media_description); ?>"
                 class="img-fluid">
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-5">
        <div class="hh-media-detail-description d-none d-md-block">
            <p><strong><?php echo e(__('ID')); ?>:</strong> <?php echo e($mediaObject->media_id); ?></p>
            <p><strong><?php echo e(__('File name')); ?>:</strong> <?php echo e($mediaObject->media_title); ?></p>
            <p><strong><?php echo e(__('File type')); ?>:</strong> <?php echo e($mediaObject->media_type); ?></p>
            <p><strong><?php echo e(__('File size')); ?>:</strong> <?php echo e(get_file_size($mediaObject->media_size)); ?></p>
            <p><strong><?php echo e(__('Uploaded on')); ?>:</strong> <?php echo e(date('Y-m-d', $mediaObject->created_at)); ?></p>
        </div>
        <div class="hh-media-detail-edit form-xs mt-3">
            <table class="table table-borderless">
                <tr>
                    <th class="align-middle"><?php echo e(__('Title')); ?></th>
                    <td class="align-middle">
                        <div class="form-group">
                            <input type="text" class="form-control" name="media_title"
                                   value="<?php echo e($mediaObject->media_title); ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="align-middle"><?php echo e(__('Alternative Text')); ?></th>
                    <td class="align-middle">
                        <div class="form-group">
                            <input type="text" class="form-control" name="media_description"
                                   value="<?php echo e($mediaObject->media_description); ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="align-middle"><?php echo e(__('Uploaded By')); ?></th>
                    <td class="align-middle">
                        <?php echo e(get_username($mediaObject->author)); ?>

                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<input type="hidden" name="media_id" value="<?php echo e($mediaObject->media_id); ?>">
<?php /**PATH C:\xampp7\htdocs\app\Views/dashboard/components/media-item-detail.blade.php ENDPATH**/ ?>