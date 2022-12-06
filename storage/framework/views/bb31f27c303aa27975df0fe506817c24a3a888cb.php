<?php echo $__env->make('dashboard.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="wrapper">
    <?php echo $__env->make('dashboard.components.top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('dashboard.components.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="content-page">
        <div class="content">
            <?php echo $__env->make('dashboard.components.breadcrumb', ['heading' => __('Dashboard')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            <?php
            $earning = \App\Controllers\EarningController::get_inst()->getEarning(get_current_user_id());
            ?>
            <div class="earning-section">
                <div class="row">
                    <div class="d-block col-6 d-sm-none">
                        <p><span class="font-14"><?php echo e(__('Balance:')); ?> <span
                                    class="font-16"><?php echo e(convert_price($earning['balance'], false)); ?></span></span></p>
                    </div>
                    <div class="d-block col-6 d-sm-none">
                        <p><span class="font-14"><?php echo e(__('Net Earning:')); ?> <span
                                    class="font-16"><?php echo e(convert_price($earning['net_amount'], false)); ?></span></span></p>
                    </div>
                    <div class="d-block col-6 d-sm-none">
                        <p><span class="font-14"><?php echo e(__('Earning:')); ?> <span
                                    class="font-16"><?php echo e(convert_price($earning['amount'], false)); ?></span></span></p>
                    </div>
                    <div class="d-block col-6 d-sm-none">
                        <p><span class="font-14"><?php echo e(__('Payout:')); ?> <span
                                    class="font-16"><?php echo e(convert_price($earning['payout'], false)); ?></span></span></p>
                    </div>
                    <div class="d-none d-sm-block col-sm-6 col-md-6 col-xl-3">
                        <div class="card-box card-balance">
                            <i class="fa fa-info-circle float-right" data-toggle="tooltip"
                               data-placement="bottom" title=""
                               data-original-title="<?php echo e(__('You can make payout with this balance')); ?>"></i>
                            <h4 class="mt-0 font-16"><?php echo e(__('Balance')); ?></h4>
                            <h2 class="my-3 text-center">
                                <span><?php echo e(convert_price($earning['balance'])); ?></span>
                            </h2>
                        </div>
                    </div>

                    <div class="d-none d-sm-block col-sm-6 col-md-6 col-xl-3">
                        <div class="card-box card-net-earning">
                            <i class="fa fa-info-circle float-right" data-toggle="tooltip"
                               data-placement="bottom" title=""
                               data-original-title="<?php echo e(__('Total amount of owner after minus all the fees (commission) for administrator')); ?>"></i>
                            <h4 class="mt-0 font-16"><?php echo e(__('Net Earning')); ?></h4>
                            <h2 class="my-3 text-center">
                                <span><?php echo e(convert_price($earning['net_amount'])); ?></span>
                            </h2>
                        </div>
                    </div>

                    <div class="d-none d-sm-block col-sm-6 col-md-6 col-xl-3">
                        <div class="card-box card-earning">
                            <i class="fa fa-info-circle float-right" data-toggle="tooltip"
                               data-placement="bottom" title=""
                               data-original-title="<?php echo e(__('Your total amount')); ?>"></i>
                            <h4 class="mt-0 font-16"><?php echo e(__('Earning')); ?></h4>
                            <h2 class="my-3 text-center">
                                <span><?php echo e(convert_price($earning['amount'])); ?></span>
                            </h2>
                        </div>
                    </div>

                    <div class="d-none d-sm-block col-sm-6 col-md-6 col-xl-3">
                        <div class="card-box card-payout">
                            <i class="fa fa-info-circle float-right" data-toggle="tooltip"
                               data-placement="bottom" title=""
                               data-original-title="<?php echo e(__('The total of withdrawals')); ?>"></i>
                            <h4 class="mt-0 font-16"><?php echo e(__('Payout')); ?></h4>
                            <h2 class="my-3 text-center">
                                <span><?php echo e(convert_price($earning['payout'])); ?></span>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            enqueue_script('flot');
            enqueue_script('flot-time');
            enqueue_script('flot-tooltip');
            enqueue_script('flot-crosshair');
            enqueue_script('flot-selection');

            enqueue_style('nice-select-css');
            enqueue_script('nice-select-js');

            $label = [
                __('Completed'),
                __('Incomplete'),
                __('Canceled'),
                __('Refunded')
            ];
            ?>
            <div class="card-box">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="header-title mb-3"><?php echo e(__('Booking Analytics')); ?></h4>
                    <?php
                    $show_analytics_by = request()->get('show_analytics_by', 'this_month');
                    $url = current_url();
                    ?>
                    <div class="form-group form-xs mb-3">
                        <select name="show_analytics_by" class="form-control" data-plugin="customselect">
                            <option data-url="<?php echo e(add_query_arg('show_analytics_by', 'this_month', $url)); ?>"
                                    value="this_month" <?php if($show_analytics_by == 'this_month'): ?> selected <?php endif; ?>>
                                <?php echo e(__('This month')); ?>

                            </option>
                            <option data-url="<?php echo e(add_query_arg('show_analytics_by', 'last_month', $url)); ?>"
                                    value="last_month" <?php if($show_analytics_by == 'last_month'): ?> selected <?php endif; ?>>
                                <?php echo e(__('Last month')); ?>

                            </option>
                            <option data-url="<?php echo e(add_query_arg('show_analytics_by', 'this_week', $url)); ?>"
                                    value="this_week" <?php if($show_analytics_by == 'this_week'): ?> selected <?php endif; ?>>
                                <?php echo e(__('This week')); ?>

                            </option>
                            <option data-url="<?php echo e(add_query_arg('show_analytics_by', 'last_week', $url)); ?>"
                                    value="last_week" <?php if($show_analytics_by == 'last_week'): ?> selected <?php endif; ?>>
                                <?php echo e(__('Last week')); ?>

                            </option>
                        </select>
                    </div>
                </div>
                <?php
                $show_analytics_by = request()->get('show_analytics_by', 'this_month');
                $startDate = $endDate = 0;
                if ($show_analytics_by == 'this_month') {
                    $startDate = strtotime(date('Y-m-01'));
                    $endDate = strtotime(date('Y-m-t 23:59:59'));
                } elseif ($show_analytics_by == 'last_month') {
                    $startDate = strtotime(date('Y-m-d', strtotime('first day of -1 month')));
                    $endDate = strtotime(date('Y-m-d 23:59:59', strtotime('last day of -1 month')));
                } elseif ($show_analytics_by == 'this_week') {
                    $startDate = strtotime(date('Y-m-d', strtotime('monday this week')));
                    $endDate = strtotime(date('Y-m-d 23:59:59', strtotime('sunday this week')));
                } elseif ($show_analytics_by == 'last_week') {
                    $startDate = strtotime(date('Y-m-d', strtotime('monday last week')));
                    $endDate = strtotime(date('Y-m-d 23:59:59', strtotime('sunday last week')));
                }

                $projection = \App\Controllers\BookingController::get_inst()->getProjection($startDate, $endDate);
                $dataDate = [];
                $dataTotal = [];
                $step = 0;
                for ($i = $startDate; $i <= $endDate; $i = strtotime('+1 day', $i)) {
                    $_total = [
                        'completed' => 0,
                        'incomplete' => 0,
                        'canceled' => 0,
                        'refunded' => 0,
                    ];
                    if ($step % 5 == 0) {
                        $dataDate[] = [$step, date('M d', $i)];
                    } else {
                        $dataDate[] = [$step, ""];
                    }

                    if (is_object($projection)) {
                        foreach ($projection as $item) {
                            if ($i == strtotime(date('Y-m-d', $item->created_date))) {
                                if ($item->status == 'completed') {
                                    $_total['completed'] += (float)$item->total;
                                } elseif ($item->status == 'incomplete') {
                                    $_total['incomplete'] += (float)$item->total;
                                } elseif ($item->status == 'canceled') {
                                    $_total['canceled'] += (float)$item->total;
                                } elseif ($item->status == 'refunded') {
                                    $_total['refunded'] += (float)$item->total;
                                }
                            }
                        }
                    }

                    foreach ($_total as $key => $val) {
                        $dataTotal[$key][] = [$step, round($val, 2)];
                    }

                    $step++;
                }
                ?>
                <div class="overflow-x-auto">
                    <div id="booking-analytics" class="flot-chart mt-4 pt-1 booking-analytics"
                         data-min-width="1250px"
                         data-label="<?php echo e(base64_encode(json_encode($label))); ?>"
                         data-total="<?php echo e(base64_encode(json_encode($dataTotal))); ?>"
                         data-date="<?php echo e(base64_encode(json_encode($dataDate))); ?>"
                         data-min-height="350px"></div>
                </div>
            </div> <!-- end card-box -->
            <div class="card-box">
                <h4 class="header-title mb-3"><?php echo e(__('The newest bookings')); ?></h4>
                <div class="hh-slimscroll" data-max-height="350px">
                    <?php
                    enqueue_style('datatables-css');
                    enqueue_script('datatables-js');
                    enqueue_script('pdfmake-js');
                    enqueue_script('vfs-fonts-js');
                    $data = [
                        'number' => 10,
                        'orderby' => 'ID',
                        'order' => 'desc',
                        'services' => get_enabled_service_keys()
                    ];
                    $allBooking = \App\Controllers\BookingController::get_inst()->allBookings($data);
                    ?>
                    <table class="table table-large mb-0 dt-responsive nowrap w-100" data-plugin="datatable"
                           data-pdf="off" data-pdf-name="<?php echo e(__('Export PDF')); ?>"
                           data-paging="false"
                           data-ordering="false">
                        <thead>
                        <tr>
                            <th data-priority="1">
                                <?php echo e(__('Booking ID')); ?>

                            </th>
                            <th data-priority="5" class="text-center">
                                <?php echo e(__('Status')); ?>

                            </th>
                            <th data-priority="4" class="text-center">
                                <?php echo e(__('Amount')); ?>

                            </th>
                            <th data-priority="6"><?php echo e(__('Check In/Out')); ?></th>
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
                                    <td class="align-middle"><?php echo e($item->booking_id); ?></td>
                                    <td class="align-middle text-center">
                                        <div
                                            class="booking-status <?php echo e($item->status); ?>"><?php echo e(__($bookingStatus['label'])); ?></div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <?php echo e(convert_price($item->total)); ?>

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
                                    <td class="align-middle text-center">
                                        <?php
                                        $data = [
                                            'bookingID' => $ID,
                                            'bookingEncrypt' => hh_encrypt($ID),
                                        ];
                                        ?>
                                        <a href="javascript: void(0);"
                                           data-toggle="modal"
                                           data-target="#modal-show-booking-invoice"
                                           data-params="<?php echo e(base64_encode(json_encode($data))); ?>"
                                           class="btn btn-xs btn-secondary"><i
                                                class="mdi mdi-information-variant "></i>
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
                                <td colspan="5">
                                    <h4 class="mt-3 text-center"><?php echo e(__('No bookings yet.')); ?></h4>
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div> <!-- end .table-responsive-->
            </div> <!-- end card-box-->
            
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
<?php /**PATH C:\xampp7\htdocs\app\Views/dashboard/screens/administrator/dashboard.blade.php ENDPATH**/ ?>