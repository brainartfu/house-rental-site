<?php echo $__env->make('dashboard.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
enqueue_script('confirm-js');
enqueue_style('confirm-css');
?>
<div id="wrapper">
    <?php echo $__env->make('dashboard.components.top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('dashboard.components.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="content-page">
        <div class="content">
            <?php echo $__env->make('dashboard.components.breadcrumb', ['heading' => __('User Management')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            <div class="card-box">
                <div class="header-area d-flex align-items-center">
                    <h4 class="header-title mb-0"><?php echo e(__('All Users')); ?></h4>
                    <form class="form-inline right d-none d-sm-block" method="get">
                        <div class="form-group">
                            <?php
                            $search = request()->get('_s');
                            $order = request()->get('order', 'desc');
                            ?>
                            <input type="text" class="form-control" name="_s"
                                   value="<?php echo e($search); ?>"
                                   placeholder="<?php echo e(__('Search by id, email')); ?>">
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
                       data-pdf-name="<?php echo e(__('Export to PDF')); ?>"
                       data-csv-name="<?php echo e(__('Export to CSV')); ?>"
                       data-cols="<?php echo e(base64_encode(json_encode($tableColumns))); ?>"
                       data-ordering="false">
                    <thead>
                    <tr>
                        <?php
                        $_order = ($order == 'asc') ? 'desc' : 'asc';
                        $url = add_query_arg([
                            'orderby' => 'id',
                            'order' => $_order
                        ]);
                        ?>
                        <th data-priority="1">
                            <a href="<?php echo e($url); ?>" class="order">
                                <?php echo e(__('ID')); ?>

                                <?php if($order == 'asc'): ?>
                                    <i class="icon-arrow-down"></i>
                                <?php else: ?>
                                    <i class="icon-arrow-up"></i>
                                <?php endif; ?>
                                <span class="exp d-none"><?php echo e(__('ID')); ?></span>
                            </a>
                        </th>
                        <th data-priority="3">
                            <?php echo e(__('Name')); ?>

                        </th>
                        <th data-priority="4"><?php echo e(__('Email')); ?></th>
                        <th data-priority="4" class="">
                            <div class="dropdown">
                                <a class="dropdown-toggle not-show-caret" id="dropdownFilterStatus"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo e(__('Roles')); ?>

                                    <i class="icon-arrow-down"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownFilterStatus">
                                    <a class="dropdown-item"
                                       href="<?php echo e(remove_query_arg('role')); ?>">All</a>
                                    <?php
                                    $roles = get_all_roles();
                                    foreach ($roles as $key => $role) {
                                    $url = add_query_arg('role', $key);
                                    ?>
                                    <a class="dropdown-item"
                                       href="<?php echo e($url); ?>"><?php echo e(__($role)); ?></a>
                                    <?php } ?>
                                </div>
                                <span class="exp d-none"><?php echo e(__('Roles')); ?></span>
                            </div>
                        </th>
                        <th data-priority="5" class="text-center"><?php echo e(__('Registered At')); ?></th>
                        <th data-priority="-1" class="text-center"><?php echo e(__('Actions')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($allUsers['total']): ?>
                        <?php $__currentLoopData = $allUsers['results']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $userID = $item->id;
                            ?>
                            <tr>
                                <td class="align-middle">
                                    #<?php echo e($userID); ?>

                                </td>
                                <td class="align-middle">
                                    <?php if($item->first_name || $item->last_name): ?>
                                        <?php echo e($item->first_name); ?> <?php echo e($item->last_name); ?>

                                    <?php else: ?>
                                        <?php echo e($item->email); ?>

                                    <?php endif; ?>
                                </td>
                                <td class="align-middle">
                                    <?php echo e($item->email); ?>

                                </td>
                                <td class="align-middle">
                                    <span class="role-status exp <?php echo e($item->role_slug); ?>"><?php echo e($item->role_name); ?></span>
                                </td>
                                <td class="align-middle text-center">
                                    <?php echo e(date(hh_date_format(), strtotime($item->created_at))); ?>

                                </td>
                                <td class="align-middle text-center">
                                    <div class="dropdown dropleft">
                                        <a href="javascript: void(0)" class="dropdown-toggle table-action-link"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                class="ti-settings"></i></a>
                                        <div class="dropdown-menu">
                                            <?php
                                            $params = [
                                                'userID' => $userID,
                                                'userEncrypt' => hh_encrypt($userID)
                                            ];
                                            ?>
                                            <a href="javascript:void(0)" class="dropdown-item" data-toggle="modal"
                                               data-params="<?php echo e(base64_encode(json_encode($params))); ?>"
                                               data-target="#hh-update-user-modal"><?php echo e(__('Edit')); ?></a>

                                            <?php if($item->role_slug != 'customer'): ?>
                                                <a href="javascript:void(0)" class="dropdown-item text-danger"
                                                   data-toggle="modal"
                                                   data-params="<?php echo e(base64_encode(json_encode($params))); ?>"
                                                   data-target="#hh-delete-user-modal"><?php echo e(__('Delete')); ?></a>
                                            <?php else: ?>
                                                <a class="dropdown-item hh-link-action hh-link-change-status-home text-danger"
                                                   data-action="<?php echo e(dashboard_url('delete-user')); ?>"
                                                   data-confirm="yes"
                                                   data-confirm-title="<?php echo e(__('System Alert')); ?>"
                                                   data-confirm-question="<?php echo e(__('Are you sure to delete this user?')); ?>"
                                                   data-confirm-button="<?php echo e(__('Delete it!')); ?>"
                                                   data-parent="tr"
                                                   data-is-delete="true"
                                                   data-params="<?php echo e(base64_encode(json_encode($params))); ?>"
                                                   href="javascript: void(0)"><?php echo e(__('Delete')); ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">
                                <h4 class="mt-3 text-center"><?php echo e(__('No users yet.')); ?></h4>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                <div class="clearfix mt-2">
                    <?php echo e(dashboard_pagination(['total' => $allUsers['total']])); ?>

                </div>
            </div>
            <div id="hh-update-user-modal" class="modal fade hh-get-modal-content" tabindex="-1" role="dialog"
                 aria-hidden="true"
                 data-url="<?php echo e(dashboard_url('get-user-item')); ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="form form-action form-update-coupon-modal relative"
                              data-validation-id="form-update-user"
                              action="<?php echo e(dashboard_url('update-user-item')); ?>">
                            <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="modal-header">
                                <h4 class="modal-title"><?php echo e(__('Update User')); ?></h4>
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

            <div id="hh-delete-user-modal" class="modal fade hh-get-modal-content" tabindex="-1" role="dialog"
                 aria-hidden="true"
                 data-url="<?php echo e(dashboard_url('get-user-delete-modal')); ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="form form-action form-update-coupon-modal relative"
                              data-validation-id="form-delete-user"
                              action="<?php echo e(dashboard_url('delete-user-modal')); ?>">
                            <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="modal-header">
                                <h4 class="modal-title"><?php echo e(__('Delete User')); ?></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                                </button>
                            </div>
                            <div class="modal-body">
                            </div>
                            <div class="modal-footer">
                                <button type="submit"
                                        class="btn btn-info waves-effect waves-light"><?php echo e(__('Confirm Deletion')); ?>

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
<?php /**PATH /home/salentovacanze/public_html/app/Views/dashboard/screens/administrator/user-management.blade.php ENDPATH**/ ?>