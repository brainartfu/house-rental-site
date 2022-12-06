<?php echo $__env->make('dashboard.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="wrapper">
    <?php echo $__env->make('dashboard.components.top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('dashboard.components.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="content-page">
        <div class="content">
            <?php echo $__env->make('dashboard.components.breadcrumb', ['heading' => __('All Reservations')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            <div class="card-box">
                <div class="header-area d-flex align-items-center">
                    <h4 class="header-title mb-0"><?php echo e(__('All Reservations')); ?></h4>
                    <form class="form-inline right d-none d-sm-block" method="get">
                        <div class="form-group">
                            <?php
                            $search = request()->get('_s');
                            $order = request()->get('order', 'desc');
                            ?>
                            <input type="text" class="form-control" name="_s"
                                   value="<?php echo e($search); ?>"
                                   placeholder="<?php echo e(__('Search by id, boking id, email')); ?>">
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
                $tableColumns = [0, 1, 2, 3, 4, 5];
                ?>
                <table class="table  table-large mb-0 dt-responsive nowrap w-100" data-plugin="datatable"
                       data-paging="false"
                       data-export="on"
                       data-csv-name="<?php echo e(__('Export to CSV')); ?>"
                       data-pdf-name="<?php echo e(__('Export to PDF')); ?>"
                       data-cols="<?php echo e(base64_encode(json_encode($tableColumns))); ?>"
                       data-ordering="false">
                    <thead>
                    <tr>
                        <th data-priority="1">
                            <?php
                            $_order = ($order == 'asc') ? 'desc' : 'asc';
                            $url = add_query_arg([
                                'orderby' => 'ID',
                                'order' => $_order
                            ]);
                            ?>
                            <a href="<?php echo e($url); ?>" class="order">
                                ID
                                <?php if($order == 'asc'): ?>
                                    <i class="icon-arrow-down"></i>
                                <?php else: ?>
                                    <i class="icon-arrow-up"></i>
                                <?php endif; ?>
                                <span class="exp d-none"><?php echo e(__('ID')); ?></span>
                            </a>
                        </th>
                        <th data-priority="2">
                            <?php echo e(__('Description')); ?>

                        </th>
                        <th data-priority="5" class="text-center">
                            <div class="dropdown">
                                <a class="dropdown-toggle not-show-caret" type="button" id="dropdownFilterStatus"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo e(__('Status')); ?>

                                    <i class="icon-arrow-down"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownFilterStatus">
                                    <a class="dropdown-item"
                                       href="<?php echo e(remove_query_arg('status')); ?>"><?php echo e(__('All')); ?></a>
                                    <?php
                                    $allStatus = booking_status_info();
                                    foreach ($allStatus as $key => $status) {
                                    $url = add_query_arg('status', $key);
                                    ?>
                                    <a class="dropdown-item"
                                       href="<?php echo e($url); ?>"><?php echo e(__($status['label'])); ?></a>
                                    <?php } ?>
                                </div>
                                <span class="exp d-none"><?php echo e(__('Status')); ?></span>
                            </div>
                        </th>
                        <th data-priority="4" class="text-center">
                            <?php
                            $_order = ($order == 'asc') ? 'desc' : 'asc';
                            $url = add_query_arg([
                                'orderby' => 'total',
                                'order' => $_order
                            ]);
                            ?>
                            <a href="<?php echo e($url); ?>" class="order ">
                                <?php echo e(__('Amount')); ?>

                                <?php if($order == 'asc'): ?>
                                    <i class="icon-arrow-down"></i>
                                <?php else: ?>
                                    <i class="icon-arrow-up"></i>
                                <?php endif; ?>
                                <span class="exp d-none"><?php echo e(__('Amount')); ?></span>
                            </a>
                        </th>
                        <th data-priority="6"><?php echo e(__('Check In/Out')); ?></th>
                        <th data-priority="6"><?php echo e(__('Created Date')); ?></th>
                        <th data-priority="-1" class="text-center"><?php echo e(__('Actions')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($allBooking['total']): ?>
                        <?php $__currentLoopData = $allBooking['results']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $ID = $item->ID;
                            $bookingID = $item->booking_id;
                            $bookingStatus = booking_status_info($item->status);
                            $serviceType = $item->service_type;
                            $serviceObject = get_booking_data($ID, 'serviceObject');
                            ?>
                            <tr>
                                <td class="align-middle"><span class="exp"><?php echo e($ID); ?></span></td>
                                <td class="align-middle"><span
                                        class="exp"><?php echo e(get_translate($item->booking_description)); ?></span></td>
                                <td class="align-middle text-center">
                                    <div class="booking-status <?php echo e($item->status); ?>"><span
                                            class="exp"><?php echo e(__($bookingStatus['label'])); ?></span></div>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="exp"><?php echo e(convert_price($item->total)); ?></span>
                                </td>
                                <td class="align-middle">
                                    <?php
                                    $checkIn = $item->start_time;
                                    $checkOut = $item->end_time;
                                    ?>
                                    <?php if($serviceType == 'car'): ?>
                                        <span
                                            class="exp"><?php echo balanceTags(date(hh_date_format(true), $checkIn)) . '<br /><span class="d-none"> - </span><i class="fe-arrow-right"></i><br />' . balanceTags(date(hh_date_format(true), $checkOut)); ?></span>
                                    <?php elseif($serviceType == 'home'): ?>
                                        <?php if(isset($serviceObject->booking_type) && $serviceObject->booking_type == 'per_hour'): ?>
                                            <span class="exp"><?php echo balanceTags(date(hh_date_format(), $checkIn)) . '<span class="d-none"> - </span><br/>'
                                           .balanceTags(date(hh_time_format(), $checkIn)).'<span class="d-none"> - </span><i class="fe-arrow-right ml-2 mr-2"></i>' . balanceTags(date(hh_time_format(), $checkOut)); ?></span>
                                        <?php else: ?>
                                            <span
                                                class="exp"><?php echo balanceTags(date(hh_date_format(), $checkIn)) . '<span class="d-none"> - </span><i class="fe-arrow-right ml-2 mr-2"></i>' . balanceTags(date(hh_date_format(), $checkOut)); ?></span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span
                                            class="exp"><?php echo balanceTags(date(hh_date_format(), $checkIn)) . '<span class="d-none"> - </span><i class="fe-arrow-right ml-2 mr-2"></i>' . balanceTags(date(hh_date_format(), $checkOut)); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="align-middle">
                                    <span
                                        class="exp"><?php echo e(balanceTags(date(hh_date_format(), $item->created_date))); ?></span>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="dropdown dropleft">
                                        <a href="javascript: void(0)" class="dropdown-toggle table-action-link"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                class="ti-settings"></i></a>
                                        <div class="dropdown-menu">
                                            <?php
                                            $data = [
                                                'bookingID' => $ID,
                                                'bookingEncrypt' => hh_encrypt($ID),
                                            ];
                                            ?>
                                            <a class="dropdown-item"
                                               data-toggle="modal"
                                               data-target="#modal-show-booking-invoice"
                                               data-params="<?php echo e(base64_encode(json_encode($data))); ?>"
                                               href="javascript: void(0)"><?php echo e(__('Invoice')); ?></a>
                                            <?php
                                            $allStatus = booking_status_info();
                                            foreach ($allStatus as $key => $status) {
                                            $data = [
                                                'bookingID' => $ID,
                                                'bookingEncrypt' => hh_encrypt($ID),
                                                'status' => $key
                                            ];
                                            ?>
                                            <a class="dropdown-item hh-link-action ots-link-change-status-booking"
                                               data-action="<?php echo e(dashboard_url('change-booking-status')); ?>"
                                               data-parent="tr"
                                               data-params="<?php echo e(base64_encode(json_encode($data))); ?>"
                                               href="javascript: void(0)"><?php echo e(__($status['label'])); ?></a>
                                            <?php } ?>
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
                            <td class="d-none"></td>
                            <td colspan="7">
                                <h4 class="mt-3 text-center"><?php echo e(__('No bookings yet.')); ?></h4>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                <div class="clearfix mt-2">
                    <?php echo e(dashboard_pagination(['total' => $allBooking['total']])); ?>

                </div>
            </div>
            
            <?php echo $__env->make('dashboard.components.footer-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>

<div class="modal fade hh-get-modal-content" id="modal-show-booking-invoice" tabindex="-1" role="dialog"
     aria-hidden="true" data-url="<?php echo e(dashboard_url('get-booking-invoice')); ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="modal-header">
                <h4 class="modal-title"><?php echo e(__('Booking Detail')); ?></h4>
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
<?php /**PATH /home/salentovacanze/public_html/app/Views/dashboard/screens/administrator/all-booking.blade.php ENDPATH**/ ?>