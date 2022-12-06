<?php echo $__env->make('dashboard.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="wrapper">
    <?php echo $__env->make('dashboard.components.top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('dashboard.components.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="content-page">
        <div class="content">
            <?php echo $__env->make('dashboard.components.breadcrumb', ['heading' => __('Notifications')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            <div class="card-box">
                <div class="header-area d-flex align-items-center">
                    <h4 class="header-title mb-0"><?php echo e(__('Notifications')); ?></h4>
                </div>
                <?php
                enqueue_style('datatables-css');
                enqueue_script('datatables-js');
                enqueue_script('pdfmake-js');
                enqueue_script('vfs-fonts-js');
                ?>
                <?php
                $tableColumns = [
                    __('Name'),
                    __('Price'),
                    __('Status'),
                    __('No. Guest'),
                    __('Home Type')
                ];
                ?>
                <table class="table table-large mb-0 dt-responsive nowrap w-100" data-plugin="datatable"
                       data-paging="false"
                       data-pdf="off"
                       data-pdf-name="<?php echo e(__('Export to PDF')); ?>"
                       data-cols="<?php echo e(base64_encode(json_encode($tableColumns))); ?>"
                       data-ordering="false">
                    <thead>
                    <tr>
                        <th data-priority="1">
                            <?php echo e(__('#ID')); ?>

                        </th>
                        <th data-priority="1">
                            <?php echo e(__('Title')); ?>

                        </th>
                        <th data-priority="3">
                            <?php echo e(__('Message')); ?>

                        </th>
                        <th data-priority="4" class="text-center">
                            <?php echo e(__('Type')); ?>

                        </th>
                        <th data-priority="5" class="text-center"><?php echo e(__('Created at')); ?></th>
                        <th data-priority="-1" class="text-center"><?php echo e(__('Actions')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($allNotifications['total']): ?>
                        <?php $__currentLoopData = $allNotifications['results']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="align-middle">
                                    #<?php echo e($item->ID); ?>

                                </td>
                                <td class="align-middle">
                                    <?php echo balanceTags(get_translate($item->title)); ?>

                                </td>
                                <td class="align-middle">
                                    <?php echo balanceTags(get_translate($item->message)); ?>

                                </td>
                                <td class="align-middle text-center">
                                    <div class="notify-item">
                                        <span class="small-info notify-<?php echo e($item->type); ?>"><?php echo e($item->type); ?></span>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <?php echo e(date(hh_date_format(), $item->created_at)); ?>

                                </td>
                                <td class="align-middle text-center">
                                    <?php
                                    $data = [
                                        'notiID' => $item->ID,
                                        'notiEncrypt' => hh_encrypt($item->ID),
                                    ];
                                    ?>
                                    <a class="hh-link-action hh-link-delete-notification"
                                       data-action="<?php echo e(dashboard_url('delete-notification')); ?>"
                                       data-parent="tr"
                                       data-is-delete="true"
                                       data-params="<?php echo e(base64_encode(json_encode($data))); ?>"
                                       href="javascript: void(0)">
                                        <i class="text-danger mdi mdi-delete font-16"></i>
                                    </a>
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
                                <h4 class="mt-3 text-center"><?php echo e(__('No notification yet.')); ?></h4>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                <div class="clearfix mt-2">
                    <?php echo e(dashboard_pagination(['total' => $allNotifications['total']])); ?>

                </div>
            </div>
            
            <?php echo $__env->make('dashboard.components.footer-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<?php echo $__env->make('dashboard.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/salentovacanze/public_html/app/Views/dashboard/screens/administrator/notifications.blade.php ENDPATH**/ ?>