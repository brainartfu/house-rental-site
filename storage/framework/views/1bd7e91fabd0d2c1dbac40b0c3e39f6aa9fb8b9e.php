<?php echo $__env->make('dashboard.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
enqueue_style('context-menu');
enqueue_script('context-menu-pos');
enqueue_script('context-menu');

enqueue_style('confirm-css');
enqueue_script('confirm-js');
?>
<div id="wrapper">
    <?php echo $__env->make('dashboard.components.top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('dashboard.components.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="content-page">
        <div class="content">
            
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="page-title">
                                <?php echo e(__('Media library')); ?>

                                <a class="btn btn-info btn-xs waves-effect waves-light ml-1"
                                   data-toggle="collapse" href="#hh-media-add-new" aria-expanded="true"><?php echo e(__('new image')); ?>

                                </a>
                            </h4>
                            <?php
                            $sort = request()->get('sort', 'grid');
                            ?>
                            <div class="list-gid-sorts">
                                <a href="<?php echo e(add_query_arg('sort', 'list', current_url())); ?>"
                                   class="list <?php if($sort == 'list'): ?> active <?php endif; ?>"><i
                                        class=" ti-layout-list-thumb "></i></a>
                                <a href="<?php echo e(add_query_arg('sort', 'grid', current_url())); ?>"
                                   class="grid <?php if($sort == 'grid'): ?> active <?php endif; ?>"><i class="ti-view-grid"></i></a>
                            </div>
                        </div>

                        <?php
                        enqueue_style('dropzone-css');
                        enqueue_script('dropzone-js');
                        ?>
                        <div id="hh-media-add-new" class="hh-media-upload-area collapse mt-3">
                            <form action="<?php echo e(dashboard_url('add-media')); ?>" method="post" class="hh-dropzone relative"
                                  id="hh-upload-form" enctype="multipart/form-data">
                                <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <div class="fallback">
                                    <input name="file" type="file" multiple/>
                                </div>
                                <div class="dz-message text-center needsclick">
                                    <i class="h1 text-muted dripicons-cloud-upload"></i>
                                    <h3><?php echo e(__('Drop files here or click to upload.')); ?></h3>
                                    <p class="text-muted">
                                        <span><?php echo e(get_media_upload_message()['type']); ?></span>
                                        <span><?php echo e(get_media_upload_message()['size']); ?></span>
                                    </p>
                                </div>
                            </form>
                        </div>
                        <div class="hh-all-media mt-3">
                            <form action="<?php echo e(dashboard_url('all-media')); ?>" class="form form-all-media" method="post">
                                <input type="hidden" name="sort" value="<?php echo e($sort); ?>">
                            </form>
                            <div class="hh-all-media-render relative">
                                <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php if($sort == 'grid'): ?>
                                    <ul class="render"></ul>
                                <?php else: ?>
                                    <?php
                                    enqueue_script('nice-select-js');
                                    enqueue_style('nice-select-css');
                                    ?>
                                    <div class="action-toolbar">
                                        <form class="hh-form form-inline"
                                              action="<?php echo e(dashboard_url('media-bulk-actions')); ?>"
                                              data-target="#table-my-media" method="post">
                                            <select class="mr-1 min-w-100" name="action" data-plugin="customselect">
                                                <option value="none"><?php echo e(__('Bulk Actions')); ?></option>
                                                <option value="delete"><?php echo e(__('Delete')); ?></option>
                                            </select>
                                            <button type="submit" class="btn btn-success"><?php echo e(__('Apply')); ?></button>
                                        </form>
                                    </div>
                                    <?php
                                    enqueue_style('datatables-css');
                                    enqueue_script('datatables-js');

                                    $order = request()->get('order', 'desc');
                                    $_order = ($order == 'asc') ? 'desc' : 'asc';
                                    $url = add_query_arg([
                                        'orderby' => 'media_title',
                                        'order' => $_order
                                    ]);

                                    ?>
                                    <table id="table-my-media" class="table table-large mb-0 dt-responsive nowrap w-100"
                                           data-plugin="datatable"
                                           data-paging="false"
                                           data-export="off"
                                           data-ordering="false">
                                        <thead>
                                        <tr>
                                            <th data-priority="-1" class="hh-checkbox-td">
                                                <div class="checkbox checkbox-success hh-check-all">
                                                    <input id="hh-checkbox-all--my-media" type="checkbox">
                                                    <label for="hh-checkbox-all--my-media"><span
                                                            class="d-none"><?php echo e(__('Check All')); ?></span></label>
                                                </div>
                                            </th>
                                            <th data-priority="1">
                                                <a href="<?php echo e($url); ?>" class="order">
                                                    <span class="exp"><?php echo e(__('Name')); ?></span>
                                                    <?php if($order == 'asc'): ?> <i class="icon-arrow-down"></i> <?php else: ?> <i
                                                        class="icon-arrow-up"></i> <?php endif; ?>
                                                </a>
                                            </th>
                                            <th data-priority="2">
                                                <?php echo e(__('Size/Type')); ?>

                                            </th>
                                            <th data-priority="2">
                                                <?php echo e(__('Author')); ?>

                                            </th>
                                            <th data-priority="3">
                                                <?php echo e(__('Date')); ?>

                                            </th>
                                            <th data-priority="-1" class="text-center"><?php echo e(__('Actions')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody class="render">

                                        </tbody>
                                    </table>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php echo $__env->make('dashboard.components.footer-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<div id="hh-media-item-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <form class="form form-action form-update-media-item-modal relative"
                  data-validation-id="form-media-item"
                  action="<?php echo e(dashboard_url('update-media-item-detail')); ?>" method="post">
                <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo e(__('Attachment Details')); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect"
                            data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                    <button type="submit"
                            class="btn btn-info waves-effect waves-light"><?php echo e(__('Update')); ?>

                    </button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->
<?php echo $__env->make('dashboard.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/salentovacanze/public_html/app/Views/dashboard/screens/administrator/media.blade.php ENDPATH**/ ?>