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
            <?php echo $__env->make('dashboard.components.breadcrumb', ['heading' => __('Pages')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            <?php

            $search = request()->get('_s');
            $order = request()->get('order', 'asc');
            ?>
            <div class="card-box card-list-post">
                <div class="header-area d-flex align-items-center">
                    <h4 class="header-title mb-0"><?php echo e(__('All Pages')); ?></h4>
                    <form class="form-inline right d-none d-sm-block" method="get">
                        <div class="form-group">
                            <input type="text" class="form-control" name="_s"
                                   value="<?php echo e($search); ?>"
                                   placeholder="<?php echo e(__('Search Pages')); ?>">
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
                    <form class="hh-form form-inline" action="<?php echo e(dashboard_url('page-bulk-actions')); ?>"
                          data-target="#table-my-page" method="post">
                        <select class="mr-1 min-w-100" name="action" data-plugin="customselect">
                            <option value="none"><?php echo e(__('Bulk Actions')); ?></option>
                            <option value="publish"><?php echo e(__('Publish')); ?></option>
                            <option value="draft"><?php echo e(__('Draft')); ?></option>
                            <option value="trash"><?php echo e(__('Trash')); ?></option>
                            <option value="delete"><?php echo e(__('Delete')); ?></option>
                        </select>
                        <button type="submit" class="btn btn-success"><?php echo e(__('Apply')); ?></button>
                    </form>
                </div>
                <table id="table-my-page" class="table table-large mb-0 dt-responsive nowrap w-100"
                       data-plugin="datatable"
                       data-paging="false"
                       data-ordering="false">
                    <thead>
                    <tr>
                        <?php
                        $_order = ($order == 'asc') ? 'desc' : 'asc';
                        $url = add_query_arg([
                            'orderby' => 'created_at',
                            'order' => $_order
                        ]);
                        ?>
                        <th data-priority="-1" class="hh-checkbox-td">
                            <div class="checkbox checkbox-success hh-check-all d-none d-md-block">
                                <input id="hh-checkbox-all--my-page" type="checkbox">
                                <label for="hh-checkbox-all--my-page"><span
                                        class="d-none"><?php echo e(__('Check All')); ?></span></label>
                            </div>
                        </th>
                        <th data-priority="1" class="force-show">
                            <?php echo e(__('Name')); ?>

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
                                       href="<?php echo e(add_query_arg('status', 'publish')); ?>"><?php echo e(__('Publish')); ?></a>
                                    <a class="dropdown-item"
                                       href="<?php echo e(add_query_arg('status', 'draft')); ?>"><?php echo e(__('Draft')); ?></a>
                                </div>
                            </div>
                        </th>
                        <th data-priority="4">
                            <a href="<?php echo e($url); ?>" class="order">
                                <?php echo e(__('Created at')); ?>

                                <?php if($order == 'asc'): ?>
                                    <i class="icon-arrow-down"></i>
                                <?php else: ?>
                                    <i class="icon-arrow-up"></i>
                                <?php endif; ?>
                            </a>
                        </th>
                        <th data-priority="-1" class="text-center"><?php echo e(__('Actions')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($allPages['total']): ?>
                        <?php $__currentLoopData = $allPages['results']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                        <?php
                                        $img_url = get_attachment_url(get_translate($item->thumbnail_id), [70, 70]);
                                        $img_alt = get_attachment_alt(get_translate($item->thumbnail_id));
                                        ?>
                                        <img src="<?php echo e($img_url); ?>" class="d-none d-md-block mr-3"
                                             alt="<?php echo e($img_alt); ?>">
                                        <div class="media-body">
                                            <h5 class="m-0 title-overflow">
                                                <a class="text" href="<?php echo e(get_the_permalink($item->post_id, $item->post_slug, 'page')); ?>"
                                                   target="_blank">
                                                    <?php echo e(get_translate($item->post_title)); ?>

                                                </a>
                                                <span class="text-muted d-none d-md-inline-block"> - <?php echo e($item->post_id); ?></span>
                                            </h5>
                                            <div class="quick-action-links d-none d-md-block">
                                                <a class="quick-link-item" target="_blank"
                                                   href="<?php echo e(url('dashboard/edit-page/' . $item->post_id )); ?>"><?php echo e(__('Edit')); ?></a>
                                                <?php if($item->status != 'trash'): ?>
                                                    <?php
                                                    $data = [
                                                        'serviceID' => $item->post_id,
                                                        'serviceEncrypt' => hh_encrypt($item->post_id),
                                                        'status' => 'trash'
                                                    ];
                                                    ?>
                                                    <a class="quick-link-item quick-link-item-trash hh-link-action hh-link-change-page-status"
                                                       data-action="<?php echo e(dashboard_url('change-page-status')); ?>"
                                                       data-parent="tr"
                                                       data-is-delete="false"
                                                       data-params="<?php echo e(base64_encode(json_encode($data))); ?>"
                                                       href="javascript: void(0)"><?php echo e(__('Trash')); ?></a>
                                                    <?php if($item->status == 'publish'): ?>
                                                        <a class="quick-link-item"
                                                           href="<?php echo e(get_the_permalink($item->post_id, $item->post_slug, 'page')); ?>"
                                                           target="_blank"><?php echo e(__('View')); ?></a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="service-status <?php echo e($item->status); ?> status-icon"
                                         data-toggle="tooltip" data-placement="right" title=""
                                         data-original-title="<?php echo e(Illuminate\Support\Str::studly($item->status)); ?>"><span
                                            class="d-none"><?php echo e(Illuminate\Support\Str::studly($item->status)); ?></span>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <strong><?php echo e(date(hh_date_format(), $item->created_at)); ?></strong>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="dropdown d-inline-block">
                                        <?php
                                        $data = [
                                            'pageID' => $item->post_id,
                                            'pageEncrypt' => hh_encrypt($item->post_id),
                                        ];
                                        ?>
                                        <a href="javascript: void(0)" class="dropdown-toggle table-action-link"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                class="ti-settings"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="<?php echo e(url('dashboard/edit-page/' . $item->post_id )); ?>"
                                               class="dropdown-item"><?php echo e(__('Edit')); ?></a>
                                            <?php
                                            $page_status_info = page_status_info();
                                            ?>
                                            <?php $__currentLoopData = $page_status_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($key != $item->status): ?>
                                                    <?php
                                                    $data = [
                                                        'serviceID' => $item->post_id,
                                                        'serviceEncrypt' => hh_encrypt($item->post_id),
                                                        'status' => $key
                                                    ];
                                                    ?>
                                                    <a class="dropdown-item hh-link-action hh-link-change-status-page"
                                                       data-action="<?php echo e(dashboard_url('change-page-status')); ?>"
                                                       data-parent="tr"
                                                       data-is-delete="false"
                                                       data-params="<?php echo e(base64_encode(json_encode($data))); ?>"
                                                       href="javascript: void(0)"><?php echo e($status['name']); ?></a>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <a class="dropdown-item hh-link-action hh-link-delete-page text-danger"
                                               data-action="<?php echo e(dashboard_url('delete-page-item')); ?>"
                                               data-parent="tr"
                                               data-is-delete="true"
                                               data-params="<?php echo e(base64_encode(json_encode($data))); ?>"
                                               data-confirm="yes"
                                               data-confirm-title="<?php echo e(__('Confirm Delete')); ?>"
                                               data-confirm-question="<?php echo e(__('Are you sure want to delete this page?')); ?>"
                                               data-confirm-button="<?php echo e(__('Delete it!')); ?>"
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
                            <td class="d-none"></td>
                            <td colspan="5">
                                <h4 class="mt-3 text-center"><?php echo e(__('No pages yet.')); ?></h4>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                <div class="clearfix mt-2">
                    <?php echo e(dashboard_pagination(['total' => $allPages['total']])); ?>

                </div>
            </div>
            
            <?php echo $__env->make('dashboard.components.footer-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<?php echo $__env->make('dashboard.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp7\htdocs\app\Views/dashboard/screens/administrator/services/page/page.blade.php ENDPATH**/ ?>