<?php echo $__env->make('dashboard.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
enqueue_style('confirm-css');
enqueue_script('confirm-js');
?>

<div id="wrapper">
    <?php echo $__env->make('dashboard.components.top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('dashboard.components.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="content-page">
        <div class="content">
            <?php echo $__env->make('dashboard.components.breadcrumb', ['heading' => __('Payout')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            <?php

            $search = request()->get('_s');
            $order = request()->get('order', 'asc');
            ?>
            <div class="card-box">
                <div class="header-area d-flex align-items-center">
                    <h4 class="header-title mb-0"><?php echo e(__('All Payouts')); ?></h4>
                    <form class="form-inline right d-none d-sm-block" method="get">
                        <div class="form-group">
                            <input type="text" class="form-control" name="_s"
                                   value="<?php echo e($search); ?>"
                                   placeholder="<?php echo e(__('Search by id')); ?>">
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
                <?php
                $tableColumns = [0, 1, 2, 3, 4];
                ?>
                <table class="table table-large mb-0 dt-responsive nowrap w-100" data-plugin="datatable"
                       data-paging="false"
                       data-export="on"
                       data-csv-name="<?php echo e(__('Export to CSV')); ?>"
                       data-pdf-name="<?php echo e(__('Export to PDF')); ?>"
                       data-cols="<?php echo e(base64_encode(json_encode($tableColumns))); ?>"
                       data-ordering="false">
                    <thead>
                    <tr>
                        <th data-priority="1"><?php echo e(__('Payout ID')); ?></th>
                        <th data-priority="2">
                            <?php echo e(__('Name')); ?>

                        </th>
                        <th data-priority="1" class="text-center">
                            <?php echo e(__('Amount')); ?>

                        </th>
                        <th data-priority="2" class="text-center">
                            <div class="dropdown">
                                <a class="dropdown-toggle not-show-caret" id="dropdownFilterStatus"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo e(__('Status')); ?>

                                    <i class="icon-arrow-down"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownFilterStatus">
                                    <a class="dropdown-item" href="<?php echo e(remove_query_arg('status')); ?>"><?php echo e(__('All')); ?></a>
                                    <a class="dropdown-item"
                                       href="<?php echo e(add_query_arg('status', 'pending')); ?>"><?php echo e(__('Pending')); ?></a>
                                    <a class="dropdown-item"
                                       href="<?php echo e(add_query_arg('status', 'completed')); ?>"><?php echo e(__('Completed')); ?></a>
                                </div>
                                <span class="exp d-none"><?php echo e(__('Status')); ?></span>
                            </div>
                        </th>
                        <th data-priority="6">
                            <?php echo e(__('Created At')); ?>

                        </th>
                        <th data-priority="-1" class="text-center"><?php echo e(__('Actions')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($allPayouts['total']): ?>
                        <?php $__currentLoopData = $allPayouts['results']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="align-middle">
                                    <?php echo e($item->payout_id); ?>

                                </td>
                                <td class="align-middle">
                                    <p class="mb-0"><i class="text-muted exp"><?php echo e(get_username($item->user_id)); ?></i>
                                    </p>
                                </td>
                                <td class="align-middle text-center">
                                    <?php echo e(convert_price($item->amount)); ?>

                                </td>
                                <td class="align-middle text-center">
                                    <?php
                                    $payout_status = payout_status_info($item->status);
                                    ?>
                                    <span class="booking-status booking-bgr <?php echo e($item->status); ?>"><span
                                            class="exp"><?php echo e($payout_status['name']); ?></span></span>
                                </td>
                                <td class="align-middle">
                                    <?php echo e(date(hh_date_format(), $item->created)); ?>

                                </td>
                                <td class="align-middle text-center">
                                    <div class="dropdown d-inline-block">
                                        <a href="javascript: void(0)" class="dropdown-toggle table-action-link"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                class="ti-settings"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php
                                            $data = [
                                                'payoutID' => $item->ID,
                                                'payoutEncrypt' => hh_encrypt($item->ID),
                                            ];
                                            ?>
                                            <a class="dropdown-item"
                                               data-toggle="modal"
                                               data-target="#modal-show-payout-detail"
                                               data-params="<?php echo e(base64_encode(json_encode($data))); ?>"
                                               href="javascript: void(0)"><?php echo e(__('View')); ?></a>
                                            <?php
                                            $payout_status_info = payout_status_info();
                                            ?>
                                            <?php $__currentLoopData = $payout_status_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                $data = [
                                                    'payoutID' => $item->ID,
                                                    'payoutEncrypt' => hh_encrypt($item->ID),
                                                    'status' => $key
                                                ];
                                                ?>
                                                <a class="dropdown-item hh-link-action hh-link-change-status-payout"
                                                   data-action="<?php echo e(dashboard_url('change-status-payout')); ?>"
                                                   data-parent="tr"
                                                   data-is-delete="false"
                                                   data-params="<?php echo e(base64_encode(json_encode($data))); ?>"
                                                   href="javascript: void(0)"><?php echo e(__($status['name'])); ?></a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php
                                            $data = [
                                                'payoutID' => $item->ID,
                                                'payoutEncrypt' => hh_encrypt($item->ID),
                                            ];
                                            ?>
                                            <a class="dropdown-item hh-link-action hh-link-delete-payout"
                                               data-action="<?php echo e(dashboard_url('delete-payout-item')); ?>"
                                               data-parent="tr"
                                               data-is-delete="true"
                                               data-confirm="yes"
                                               data-confirm-title="<?php echo e(__('System Alert')); ?>"
                                               data-confirm-question="<?php echo e(__('Are you sure want to delete this item?')); ?>"
                                               data-confirm-button="<?php echo e(__('Delete it!')); ?>"
                                               data-params="<?php echo e(base64_encode(json_encode($data))); ?>"
                                               href="javascript: void(0)"><?php echo e(__('Delete')); ?>

                                            </a>
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
                            <td class="d-none"></td>
                            <td class="d-none"></td>
                            <td colspan="6">
                                <h4 class="mt-3 text-center"><?php echo e(__('No payout yet.')); ?></h4>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                <div class="clearfix">
                    <?php echo e(dashboard_pagination(['total' => $allPayouts['total']])); ?>

                </div>
            </div>
            
            <?php echo $__env->make('dashboard.components.footer-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<div class="modal fade hh-get-modal-content" id="modal-show-payout-detail" tabindex="-1" role="dialog"
     aria-hidden="true" data-url="<?php echo e(dashboard_url('get-payout-detail')); ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="modal-header">
                <h4 class="modal-title"><?php echo e(__('Payout Detail')); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('dashboard.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/salentovacanze/public_html/app/Views/dashboard/screens/administrator/payout.blade.php ENDPATH**/ ?>