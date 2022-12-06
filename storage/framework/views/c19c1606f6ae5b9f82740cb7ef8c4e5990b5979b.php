<?php echo $__env->make('dashboard.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="wrapper">
    <?php echo $__env->make('dashboard.components.top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('dashboard.components.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="content-page">
        <div class="content">
            <?php echo $__env->make('dashboard.components.breadcrumb', ['heading' => __('Home Type')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            <?php
            $search = request()->get('_s');
            $order = request()->get('order', 'asc');
            ?>
            <div class="card-box">
                <div class="header-area d-flex align-items-center">
                    <h4 class="header-title mb-0"><?php echo e(__('All Types')); ?></h4>
                    <form class="form-inline right d-none d-sm-block" method="get">
                        <div class="form-group">
                            <input type="text" class="form-control" name="_s"
                                   value="<?php echo e($search); ?>"
                                   placeholder="<?php echo e(__('Search id, name')); ?>">
                        </div>
                        <button type="submit" class="btn btn-default"><i class="ti-search"></i></button>
                    </form>
                </div>
                <?php
                enqueue_style('datatables-css');
                enqueue_script('datatables-js');
                enqueue_script('pdfmake-js');
                enqueue_script('vfs-fonts-js');
                ?>
                <table class="table table-large mb-0 dt-responsive nowrap w-100" data-plugin="datatable"
                       data-paging="false"
                       data-ordering="false">
                    <thead>
                    <tr>
                        <th data-priority="1">
                            <?php echo e(__('ID')); ?>

                        </th>
                        <th data-priority="1" class="force-show">
                            <?php echo e(__('Name')); ?>

                        </th>
                        <th data-priority="3">
                            <?php echo e(__('Description')); ?>

                        </th>
                        <th data-priority="-1" class="text-center"><?php echo e(__('Actions')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($allTerms['total']): ?>
                        <?php $__currentLoopData = $allTerms['results']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $imageID = $item->term_image;
                            ?>
                            <tr>
                                <td class="align-middle">
                                    <?php echo e($item->term_id); ?>

                                </td>
                                <td class="align-middle force-show">
                                    <div class="media align-items-center">
                                        <?php if(!empty($imageID)): ?>
                                            <?php $imageUrl = get_attachment_url($imageID); ?>
                                            <img src="<?php echo e($imageUrl); ?>" class="d-none d-md-block mr-3"
                                                 alt="<?php echo e(__('Featured Image')); ?>">
                                        <?php endif; ?>
                                        <div class="media-body">
                                            <h5 class="m-0">
                                                <?php echo e(get_translate($item->term_title)); ?>

                                            </h5>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <p class="mb-0"><i
                                            class="text-muted"><?php echo e(get_translate($item->term_description)); ?></i>
                                    </p>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="dropdown d-inline-block">
                                        <a href="javascript: void(0)" class="dropdown-toggle table-action-link"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                class="ti-settings"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php
                                            $data = [
                                                'termID' => $item->term_id,
                                                'termEncrypt' => hh_encrypt($item->term_id)
                                            ];
                                            ?>
                                            <a href="javascript:void(0)" class="dropdown-item" data-toggle="modal"
                                               data-params="<?php echo e(base64_encode(json_encode($data))); ?>"
                                               data-target="#hh-update-home-types-modal"><?php echo e(__('Edit')); ?></a>
                                            <a class="dropdown-item hh-link-action hh-link-delete-tax"
                                               data-action="<?php echo e(dashboard_url('delete-term-item')); ?>"
                                               data-parent="tr"
                                               data-is-delete="true"
                                               data-params="<?php echo e(base64_encode(json_encode($data))); ?>"
                                               href="javascript: void(0)"><?php echo e(__('Delete')); ?></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td class="d-none"></td>
                            <td class="d-none"></td>
                            <td class="d-none"></td>
                            <td colspan="4">
                                <h4 class="mt-3 text-center"><?php echo e(__('No term yet.')); ?></h4>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                <div class="clearfix">
                    <?php echo e(dashboard_pagination(['total' => $allTerms['total']])); ?>

                </div>
            </div>
            <div id="hh-update-home-types-modal" class="modal fade hh-get-modal-content" tabindex="-1" role="dialog"
                 aria-hidden="true"
                 data-url="<?php echo e(dashboard_url('get-term-item/home-type')); ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="form form-action form-update-term-modal relative form-translation"
                              data-validation-id="form-update-term"
                              action="<?php echo e(dashboard_url('update-term-item')); ?>">
                            <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="modal-header">
                                <h4 class="modal-title"><?php echo e(__('Update Home Type')); ?></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                                </button>
                            </div>
                            <div class="modal-body">
                            </div>
                            <div class="modal-footer">
                                <button type="submit"
                                        class="btn btn-info waves-effect waves-light"><?php echo e(__('Update')); ?>

                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.modal -->
            
            <?php echo $__env->make('dashboard.components.footer-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<?php echo $__env->make('dashboard.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp7\htdocs\app\Views/dashboard/screens/administrator/services/home/home-type.blade.php ENDPATH**/ ?>