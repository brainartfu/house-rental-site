<?php echo $__env->make('dashboard.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
enqueue_script('select2-js');
enqueue_style('select2-css');
enqueue_style('flag-icon-css');
?>

<div id="wrapper">
    <?php echo $__env->make('dashboard.components.top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('dashboard.components.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="content-page">
        <div class="content">
            <?php echo $__env->make('dashboard.components.breadcrumb', ['heading' => __('Languages')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            

            <div class="row">
                <div class="col-lg-4">
                    <div class="card-box">
                        <div class="header-area">
                            <h4 class="header-title mb-0"><?php echo e(__('Setup Languages')); ?></h4>
                        </div>
                        <form action="<?php echo e(dashboard_url('update-language')); ?>" class="form form-action mt-3"
                              data-validation-id="form-update-language"
                              data-reload-time="1500"
                              method="post">
                            <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php
                            $edit_id = $isEdit ? $currentLang->id : '';
                            $edit_lang = $isEdit ? $currentLang->code : '';
                            $edit_name = $isEdit ? $currentLang->name : '';
                            $edit_ficon = $isEdit ? $currentLang->flag_code : '';
                            $edit_fname = $isEdit ? $currentLang->flag_name : '';
                            $edit_status = $isEdit ? $currentLang->status : '';
                            $edit_rtl = $isEdit ? $currentLang->rtl : 'no';
                            $edit_action = $isEdit ? 'edit' : 'new';
                            ?>
                            <input type="hidden" name="id" value="<?php echo e($edit_id); ?>"/>
                            <input type="hidden" name="action" value="<?php echo e($edit_action); ?>"/>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="language"><?php echo e(__('Language')); ?></label>
                                        <?php
                                        $languages = config('locales.languages');
                                        ?>
                                        <select name="language" id="language" class="form-control wide"
                                                data-toggle="select2">
                                            <option value=""><?php echo e(__('---- Select ----')); ?></option>
                                            <?php if(!empty($languages)): ?>
                                                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option
                                                        <?php echo e($edit_lang == $key ? 'selected' : ''); ?> value="<?php echo e($key); ?>"><?php echo e($value . ' ('. $key .')'); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="flag_icon"><?php echo e(__('Flag Icon')); ?></label>
                                        <div class="flag-control">
                                            <input type="text" class="form-control hh-icon-input"
                                                   readonly
                                                   id="flag_icon" name="flag_name"
                                                   data-plugin="flagicon" value="<?php echo e($edit_fname); ?>"
                                                   data-flags="<?php echo e(json_encode($countryData)); ?>"
                                                   data-flag-url="<?php echo e(asset('vendor/countries/flag/64x64/')); ?>"
                                                   data-no-flags="<?php echo e(__('No Flags')); ?>"
                                                   placeholder="<?php echo e(__('Flag Icon')); ?>">
                                            <input type="hidden" name="flag_code" value="<?php echo e($edit_ficon); ?>"
                                                   class="flag-code"/>
                                            <div class="flag-display">
                                                <?php if(empty($edit_ficon)): ?>
                                                    <span class="flag-icon"></span>
                                                <?php else: ?>
                                                    <span
                                                        style="display: block"
                                                        data-code="<?php echo e($edit_ficon); ?>"
                                                        data-name="<?php echo e($edit_fname); ?>"
                                                        class="item-flag"
                                                        style="margin: 0px 5px;">
                                                        <img
                                                            src="<?php echo e(asset('vendor/countries/flag/64x64/' . $edit_ficon . '.png')); ?>"/>

                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('Name')); ?></label>
                                        <input type="text" class="form-control has-validation"
                                               data-validation="required" id="name" name="name"
                                               value="<?php echo e($edit_name); ?>" placeholder="<?php echo e(__('Display name')); ?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="status"><?php echo e(__('Right to Left')); ?></label>
                                        <?php
                                        enqueue_script('switchery-js');
                                        enqueue_style('switchery-css');
                                        ?>
                                        <div>
                                            <?php
                                            $checked = 'checked';
                                            if (empty($edit_rtl) || (!empty($edit_rtl) && $edit_rtl == 'no')) {
                                                $checked = '';
                                            }
                                            ?>
                                            <input type="checkbox" id="rtl" name="rtl"
                                                   data-plugin="switchery" data-color="#1abc9c"
                                                   value="on" <?php echo e($checked); ?>/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="status"><?php echo e(__('Status')); ?></label>
                                        <?php
                                        enqueue_script('switchery-js');
                                        enqueue_style('switchery-css');
                                        ?>
                                        <div>
                                            <?php
                                            $checked = 'checked';
                                            if ((!empty($edit_status) && $edit_status == 'off')) {
                                                $checked = '';
                                            }
                                            ?>
                                            <input type="checkbox" id="status" name="status"
                                                   data-plugin="switchery" data-color="#1abc9c"
                                                   value="on" <?php echo e($checked); ?>/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-message"></div>
                            <button type="submit" class="btn btn-success mt-2">
                                <?php if(!$isEdit): ?>
                                    <?php echo e(__('Add new')); ?>

                                <?php else: ?>
                                    <?php echo e(__('Edit')); ?>

                                <?php endif; ?>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-8">
                    <?php

                    $search = request()->get('_s');
                    $order = request()->get('order', 'asc');
                    ?>
                    <div class="card-box">
                        <div class="header-area d-flex align-items-center">
                            <h4 class="header-title mb-0"><?php echo e(__('All Languages')); ?></h4>
                            <form class="form-inline right d-none d-sm-block" method="get">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="_s"
                                           value="<?php echo e($search); ?>"
                                           placeholder="<?php echo e(__('Search by code, name')); ?>">
                                </div>
                                <button type="submit" class="btn btn-default"><i class="ti-search"></i></button>
                            </form>
                        </div>
                        <?php
                        enqueue_style('datatables-css');
                        enqueue_script('datatables-js');
                        enqueue_script('vfs-fonts-js');
                        ?>
                        <table class="table table-large mb-0 dt-responsive nowrap w-100" data-plugin="datatable"
                               data-sort="true"
                               data-sort-field="lang"
                               data-sort-action="change-language-order"
                               data-paging="false"
                               data-ordering="false">
                            <thead>
                            <tr>
                                <th data-priority="3">
                                    <?php echo e(__('Flag')); ?>

                                </th>
                                <?php
                                $_order = ($order == 'asc') ? 'desc' : 'asc';
                                $url = add_query_arg([
                                    'orderby' => 'name',
                                    'order' => $_order
                                ]);
                                ?>
                                <th data-priority="3">
                                    <a href="<?php echo e($url); ?>" class="order">
                                        <?php echo e(__('Name')); ?>

                                        <?php if($order == 'asc'): ?> <i class="icon-arrow-down"></i> <?php else: ?> <i
                                            class="icon-arrow-up"></i> <?php endif; ?>
                                        <span class="exp d-none"><?php echo e(__('Name')); ?></span>
                                    </a>
                                </th>

                                <th data-priority="5" class="text-center">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle not-show-caret" id="dropdownFilterStatus"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?php echo e(__('Status')); ?>

                                            <i class="icon-arrow-down"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownFilterStatus">
                                            <a class="dropdown-item"
                                               href="<?php echo e(remove_query_arg('status')); ?>"><?php echo e(__('All')); ?></a>
                                            <a class="dropdown-item"
                                               href="<?php echo e(add_query_arg('status', 'on')); ?>"><?php echo e(__('ON')); ?></a>
                                            <a class="dropdown-item"
                                               href="<?php echo e(add_query_arg('status', 'off')); ?>"><?php echo e(__('OFF')); ?></a>
                                        </div>
                                        <span class="exp d-none"><?php echo e(__('Status')); ?></span>
                                    </div>
                                </th>
                                <th data-priority="-1" class="text-center"><?php echo e(__('Actions')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($allLanguages['total']): ?>
                                <?php $__currentLoopData = $allLanguages['results']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr data-lang="<?php echo e($item->code); ?>">
                                        <td class="align-middle">
                                            <img
                                                src="<?php echo e(asset('vendor/countries/flag/48x48/' . $item->flag_code . '.png')); ?>"/>
                                        </td>
                                        <td class="align-middle">
                                            <p class="mb-0"><i class="text-muted exp">
                                                    <?php echo e($item->name . ' ('. $item->code .')'); ?><br/>
                                                </i>
                                            </p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?php
                                            $data = [
                                                'languageID' => $item->id,
                                                'languageEncrypt' => hh_encrypt($item->id),
                                            ];
                                            ?>
                                            <?php
                                            enqueue_script('switchery-js');
                                            enqueue_style('switchery-css');
                                            ?>
                                            <div>
                                                <input type="checkbox" id="language_status" name="language_status"
                                                       data-parent="tr"
                                                       data-plugin="switchery" data-color="#1abc9c"
                                                       class="hh-checkbox-action"
                                                       data-action="<?php echo e(dashboard_url('change-language-status')); ?>"
                                                       data-params="<?php echo e(base64_encode(json_encode($data))); ?>"
                                                       value="on" <?php if( $item->status == 'on'): ?> checked <?php endif; ?>/>
                                                <span class="exp d-none"><?php echo e($item->status); ?></span>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="dropdown d-inline-block">
                                                <a href="javascript: void(0)" class="dropdown-toggle table-action-link"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                        class="ti-settings"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <?php
                                                    $data = [
                                                        'languageID' => $item->id,
                                                        'languageEncrypt' => hh_encrypt($item->id),
                                                    ];

                                                    $url = dashboard_url('language');
                                                    $url = add_query_arg([
                                                        'action' => 'edit',
                                                        'id' => $item->id,
                                                    ], $url);
                                                    ?>
                                                    <a href="<?php echo e($url); ?>" class="dropdown-item"><?php echo e(__('Edit')); ?></a>

                                                    <a class="dropdown-item hh-link-action hh-link-delete-language"
                                                       data-action="<?php echo e(dashboard_url('delete-language-item')); ?>"
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
                                    <td colspan="6">
                                        <h4 class="mt-3 text-center"><?php echo e(__('No languages yet.')); ?></h4>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="clearfix">
                            <?php echo e(dashboard_pagination(['total' => $allLanguages['total']])); ?>

                        </div>
                    </div>
                </div>
            </div>
            
            <?php echo $__env->make('dashboard.components.footer-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<?php echo $__env->make('dashboard.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp7\htdocs\app\Views/dashboard/screens/administrator/language.blade.php ENDPATH**/ ?>