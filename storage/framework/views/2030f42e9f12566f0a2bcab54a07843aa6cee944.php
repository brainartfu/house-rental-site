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
            <?php echo $__env->make('dashboard.components.breadcrumb', ['heading' => __('My Homes')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            <div class="card-box card-list-post">
                <div class="header-area d-flex align-items-center">
                    <h4 class="header-title mb-0"><?php echo e(__('All Homes')); ?></h4>
                    <form class="form-inline right d-none d-sm-block" method="get">
                        <div class="form-group">
                            <?php
                            $search = request()->get('_s');
                            $order = request()->get('order', 'desc');
                            ?>
                            <input type="text" class="form-control" name="_s"
                                   value="<?php echo e($search); ?>"
                                   placeholder="<?php echo e(__('Search by id, title')); ?>">
                        </div>
                        <button type="submit" class="btn btn-default"><i class="ti-search"></i></button>
                    </form>
                </div>
                <?php
                enqueue_style('datatables-css');
                enqueue_script('datatables-js');
                enqueue_script('pdfmake-js');
                enqueue_script('vfs-fonts-js');
                enqueue_script('nice-select-js');
                enqueue_style('nice-select-css');
                ?>
                <div class="action-toolbar">
                    <form class="hh-form form-inline" action="<?php echo e(dashboard_url('home-bulk-actions')); ?>"
                          data-target="#table-my-home" method="post">
                        <select class="mr-1 min-w-100" name="action" data-plugin="customselect">
                            <option value="none"><?php echo e(__('Bulk Actions')); ?></option>
                            <option value="publish"><?php echo e(__('Publish')); ?></option>
                            <option value="pending"><?php echo e(__('Pending')); ?></option>
                            <option value="draft"><?php echo e(__('Draft')); ?></option>
                            <option value="trash"><?php echo e(__('Trash')); ?></option>
                            <option value="delete"><?php echo e(__('Delete')); ?></option>
                        </select>
                        <button type="submit" class="btn btn-success"><?php echo e(__('Apply')); ?></button>
                    </form>
                </div>

                <?php
                $tableColumns = [1, 2, 3, 4, 5];
                ?>

                <table id="table-my-home" class="table table-large mb-0 dt-responsive nowrap w-100"
                       data-plugin="datatable"
                       data-paging="false"
                       data-export="on"
                       data-csv-name="<?php echo e(__('Export to CSV')); ?>"
                       data-pdf-name="<?php echo e(__('Export to PDF')); ?>"
                       data-cols="<?php echo e(base64_encode(json_encode($tableColumns))); ?>"
                       data-ordering="false">
                    <thead>
                    <tr>
                        <?php
                        $_order = ($order == 'asc') ? 'desc' : 'asc';
                        $url = add_query_arg([
                            'orderby' => 'post_title',
                            'order' => $_order
                        ]);
                        ?>

                        <th data-priority="-1" class="hh-checkbox-td">
                            <div class="checkbox checkbox-success hh-check-all d-none d-md-block">
                                <input id="hh-checkbox-all--my-home" type="checkbox">
                                <label for="hh-checkbox-all--my-home"><span
                                        class="d-none"><?php echo e(__('Check All')); ?></span></label>
                            </div>
                        </th>
                        <th data-priority="1" class="force-show">
                            <a href="<?php echo e($url); ?>" class="order">
                                <span class="exp"><?php echo e(__('Name')); ?></span>
                                <?php if($order == 'asc'): ?> <i class="icon-arrow-down"></i> <?php else: ?> <i
                                    class="icon-arrow-up"></i> <?php endif; ?>
                            </a>
                        </th>
                        <?php
                        $_order = ($order == 'asc') ? 'desc' : 'asc';
                        $url = add_query_arg([
                            'orderby' => 'base_price',
                            'order' => $_order
                        ]);
                        ?>
                        <th data-priority="3">
                            <a href="<?php echo e($url); ?>" class="order">
                                <span class="exp"><?php echo e(__('Price')); ?></span>
                                <?php if($order == 'asc'): ?> <i class="icon-arrow-down"></i> <?php else: ?> <i
                                    class="icon-arrow-up"></i> <?php endif; ?>
                            </a>
                        </th>
                        <th data-priority="4" class="text-center">
                            <div class="dropdown">
                                <a class="dropdown-toggle not-show-caret" id="dropdownFilterStatus"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="exp"><?php echo e(__('Status')); ?></span>
                                    <i class="icon-arrow-down"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownFilterStatus">
                                    <a class="dropdown-item"
                                       href="<?php echo e(remove_query_arg('status')); ?>"><?php echo e(__('All')); ?></a>
                                    <?php
                                    $status = service_status_info();
                                    foreach ($status as $key => $_status) {
                                    $url = add_query_arg('status', $key);
                                    ?>
                                    <a class="dropdown-item"
                                       href="<?php echo e($url); ?>"><?php echo e(__($_status['name'])); ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </th>
                        <th data-priority="5" class="text-center"><span class="exp"><?php echo e(__('No. Guest')); ?></span></th>
                        <th data-priority="6"><span class="exp"><?php echo e(__('Home Type')); ?></span></th>
                        <th data-priority="-1" class="text-center"><?php echo e(__('Actions')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($allHomes['total']): ?>
                        <?php $__currentLoopData = $allHomes['results']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $homeID = $item->post_id;
                            $thumbnail_id = get_home_thumbnail_id($homeID);
                            $thumbnail = get_attachment_url($thumbnail_id, [75, 75]);
                            $homeType = $item->home_type;
                            $term = get_term_by('term_id', $homeType);
                            ?>
                            <tr>
                                <td class="align-middle hh-checkbox-td">
                                    <div class="checkbox checkbox-success d-none d-md-block">
                                        <input type="checkbox" name="post_id" value="<?php echo e($item->post_id); ?>"
                                               id="hh-check-all-item-<?php echo e($item->post_id); ?>" class="hh-check-all-item">
                                        <label for="hh-check-all-item-<?php echo e($item->post_id); ?>"></label>
                                    </div>
                                </td>
                                <td class="align-middle force-show">
                                    <div class="media align-items-center">
                                        <img src="<?php echo e($thumbnail); ?>" class="d-none d-md-block mr-3"
                                             alt="<?php echo e(get_attachment_alt($thumbnail_id)); ?>">
                                        <div class="media-body">
                                            <h5 class="m-0 title-overflow">
                                                <a class="text"
                                                   href="<?php echo e(get_home_permalink($homeID, $item->post_slug)); ?>"
                                                   target="_blank"><?php echo e(get_translate($item->post_title)); ?></a>
                                                <span
                                                    class="d-none d-md-inline-block text-muted"> - <?php echo e($homeID); ?></span>
                                            </h5>
                                            <span
                                                class="exp d-none">[<?php echo e($homeID); ?>] <?php echo e(get_translate($item->post_title)); ?></span>
                                            <div class="quick-action-links d-none d-md-block">
                                                <a class="quick-link-item" target="_blank"
                                                   href="<?php echo e(dashboard_url('edit-home', $homeID)); ?>"><?php echo e(__('Edit')); ?></a>
                                                <?php if($item->status != 'trash'): ?>
                                                    <?php
                                                    $data = [
                                                        'serviceID' => $homeID,
                                                        'serviceEncrypt' => hh_encrypt($homeID),
                                                        'serviceType' => 'home',
                                                        'status' => 'trash'
                                                    ];
                                                    ?>
                                                    <a class="quick-link-item quick-link-item-trash hh-link-action hh-link-change-status-home"
                                                       data-action="<?php echo e(dashboard_url('change-status-home')); ?>"
                                                       data-parent="tr"
                                                       data-is-delete="false"
                                                       data-params="<?php echo e(base64_encode(json_encode($data))); ?>"
                                                       href="javascript: void(0)"><?php echo e(__('Trash')); ?></a>
                                                    <?php if($item->status == 'publish'): ?>
                                                        <a class="quick-link-item"
                                                           href="<?php echo e(get_home_permalink($homeID, $item->post_slug)); ?>"
                                                           target="_blank"><?php echo e(__('View')); ?></a>

                                                        <a class="quick-link-item" href="javascript:void(0)"
                                                           data-params="<?php echo e(base64_encode(json_encode($data))); ?>"
                                                           data-toggle="modal" data-target="#hh-get-qrcode-modal">
                                                            <?php echo e(__('QR Code')); ?>

                                                        </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <span class="exp"><?php echo e(convert_price($item->base_price)); ?></span>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="service-status <?php echo e($item->status); ?> status-icon"
                                         data-toggle="tooltip" data-placement="right" title=""
                                         data-original-title="<?php echo e(service_status_info($item->status)['name']); ?>"><span
                                            class="exp d-none"><?php echo e(service_status_info($item->status)['name']); ?></span>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="exp"><?php echo e($item->number_of_guest); ?></span>
                                </td>
                                <td class="align-middle">
                                    <span class="exp"><?php if($term): ?> <?php echo e(get_translate($term->term_title)); ?> <?php endif; ?></span>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="dropdown dropleft">
                                        <?php
                                        $data = [
                                            'serviceID' => $homeID,
                                            'serviceEncrypt' => hh_encrypt($homeID),
                                            'serviceType' => 'home'
                                        ];
                                        ?>
                                        <a href="javascript: void(0)" class="dropdown-toggle table-action-link"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                class="ti-settings"></i></a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" target="_blank"
                                               href="<?php echo e(dashboard_url('edit-home', $homeID)); ?>"><?php echo e(__('Edit')); ?></a>
                                            <?php
                                            $service_status_info = service_status_info();
                                            ?>
                                            <?php $__currentLoopData = $service_status_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $data['status'] = $key; ?>
                                                <a class="dropdown-item hh-link-action hh-link-change-status-home"
                                                   data-action="<?php echo e(dashboard_url('change-status-home')); ?>"
                                                   data-parent="tr"
                                                   data-is-delete="false"
                                                   data-params="<?php echo e(base64_encode(json_encode($data))); ?>"
                                                   href="javascript: void(0)"><?php echo e(__($status['name'])); ?></a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <a class="dropdown-item hh-link-action hh-link-duplicate-home"
                                               data-action="<?php echo e(dashboard_url('duplicate-home')); ?>"
                                               data-parent="tr"
                                               data-is-delete="false"
                                               data-params="<?php echo e(base64_encode(json_encode($data))); ?>"
                                               href="javascript: void(0)"><?php echo e(__('Duplicate')); ?></a>

                                            <a class="dropdown-item hh-link-action hh-link-delete-home"
                                               data-action="<?php echo e(dashboard_url('delete-home-item')); ?>"
                                               data-parent="tr"
                                               data-is-delete="true"
                                               data-confirm="yes"
                                               data-confirm-title="<?php echo e(__('System Alert')); ?>"
                                               data-confirm-question="<?php echo e(__('Are you sure want to delete this home?')); ?>"
                                               data-confirm-button="<?php echo e(__('Delete it!')); ?>"
                                               data-params="<?php echo e(base64_encode(json_encode($data))); ?>"
                                               href="javascript: void(0)"><?php echo e(__('Delete')); ?>

                                            </a>
                                            <?php if($item->status == 'publish'): ?>
                                                <a class="dropdown-item" href="javascript:void(0)"
                                                   data-params="<?php echo e(base64_encode(json_encode($data))); ?>"
                                                   data-toggle="modal" data-target="#hh-get-qrcode-modal">
                                                    <?php echo e(__('QR Code')); ?>

                                                </a>
                                            <?php endif; ?>
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
                                <h4 class="mt-3 text-center"><?php echo e(__('No home yet.')); ?></h4>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                <div class="clearfix mt-2">
                    <?php echo e(dashboard_pagination(['total' => $allHomes['total']])); ?>

                </div>
            </div>
            <?php echo $__env->make('dashboard.components.qr-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            <?php echo $__env->make('dashboard.components.footer-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<?php echo $__env->make('dashboard.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/salentovacanze/public_html/app/Views/dashboard/screens/administrator/services/home/my-home.blade.php ENDPATH**/ ?>