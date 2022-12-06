<?php
$layout = (!empty($layout)) ? $layout : 'col-12';
if (empty($value)) {
    $value = $std;
}
$idName = str_replace(['[', ']'], '_', $id);
enqueue_style('flatpickr-css');
enqueue_script('flatpickr-js');

global $post;
$booking_type = isset($post->booking_type) ? $post->booking_type : '';
?>
<div id="setting-<?php echo e($idName); ?>" data-condition="<?php echo e($condition); ?>"
     data-unique="<?php echo e($unique); ?>" data-delete-url="<?php echo e(dashboard_url('delete-custom-price-item')); ?>"
     data-operator="<?php echo e($operation); ?>"
     class="form-group mb-3 col <?php echo e($layout); ?> field-<?php echo e($type); ?> relative">
    <?php echo $__env->make('common.loading', ['class' => 'loading-custom-price'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <label for="<?php echo e($idName); ?>">
        <?php echo e(__($label)); ?>

        <?php if(!empty($desc)): ?>
            <i class="dripicons-information field-desc" data-toggle="popover" data-placement="right"
               data-trigger="hover"
               data-content="<?php echo e(__($desc)); ?>"></i>
        <?php endif; ?>
    </label>
    <div class="w-100"></div>
    <a href="javascript: void(0)" data-post-id="<?php echo e($post_id); ?>" data-toggle="modal"
       data-target="#hh-bulk-edit-modal"
       class="btn btn-success btn-xs"><?php echo e(__('Add new')); ?></a>
    <div class="price-render mt-4">
        <?php
        $customPrice = \App\Controllers\CustomPriceController::getAllPrices($post_id, $post_type);
        ?>
        <?php echo $__env->make('dashboard.components.services.'.$post_type. '.custom_price', ['custom_price' =>$customPrice, 'booking_type' => $booking_type ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
<?php if($break): ?>
    <div class="w-100"></div> <?php endif; ?>
<div id="hh-bulk-edit-modal" data-action="<?php echo e(dashboard_url('add-new-custom-price')); ?>" class="modal fade" tabindex="-1"
     role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo e(__('Add new Price')); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">
                <?php if($post_type == 'experience'): ?>
                    <div id="setting-time_bulk" class="form-group field-select2_multiple"
                         data-condition="booking_type:is(date_time)">
                        <label for="time_of_day_bulk"><?php echo e(__('Time')); ?></label>
                        <select id="time_of_day_bulk" class="form-control select2-multiple" data-toggle="select2"
                                name="time_of_day_bulk"
                                multiple="multiple" data-placeholder="<?php echo e(__('Choose ...')); ?>">
                            <?php
                            $listTime = list_hours(30);
                            ?>
                            <?php $__currentLoopData = $listTime; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                <?php endif; ?>
                <div id="setting-type_of_bulk" class="form-group field-radio">
                    <div class="row">
                        <div class="col">
                            <div class="radio radio-success">
                                <input type="radio"
                                       name="type_of_bulk"
                                       value="days_of_week"
                                       id="type_of_bulk_week" checked>
                                <label for="type_of_bulk_week"><?php echo e(__('Days of Week')); ?></label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="radio radio-success">
                                <input type="radio"
                                       name="type_of_bulk"
                                       value="days_of_month"
                                       id="type_of_bulk_month">
                                <label for="type_of_bulk_month"><?php echo e(__('Days of Month')); ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                enqueue_script('select2-js');
                enqueue_style('select2-css');
                ?>
                <div id="setting-days_of_week_bulk" class="form-group field-select2_multiple has-validation"
                     data-unique="" data-operator="and"
                     data-condition="type_of_bulk:is(days_of_week)">
                    <label for="days_of_week_bulk"><?php echo e(__('Days of Week')); ?> <span class="text-muted f11">(Leave blank to apply all)</span></label>
                    <select id="days_of_week_bulk" class="form-control select2-multiple" data-toggle="select2"
                            multiple="multiple" data-placeholder="<?php echo e(__('Choose ...')); ?>">
                        <option value="monday"><?php echo e(__('Monday')); ?></option>
                        <option value="tuesday"><?php echo e(__('Tuesday')); ?></option>
                        <option value="wednesday"><?php echo e(__('Wednesday')); ?></option>
                        <option value="thursday"><?php echo e(__('Thursday')); ?></option>
                        <option value="friday"><?php echo e(__('Friday')); ?></option>
                        <option value="saturday"><?php echo e(__('Saturday')); ?></option>
                        <option value="sunday"><?php echo e(__('Sunday')); ?></option>
                    </select>
                </div>
                <div id="setting-days_of_month_bulk" class="form-group field-select2_multiple has-validation"
                     data-unique="" data-operator="and"
                     data-condition="type_of_bulk:is(days_of_month)">
                    <label for="days_of_month_bulk"><?php echo e(__('Days of Month')); ?> <span class="text-muted f11">(Leave blank to apply all)</span></label>
                    <select id="days_of_month_bulk" class="form-control select2-multiple" data-toggle="select2"
                            multiple="multiple" data-placeholder="<?php echo e(__('Choose ...')); ?>">
                        <?php for($i = 1; $i <= 31; $i++): ?>
                            <option value="<?php echo e($i); ?>"><?php echo e(sprintf('%02d', $i)); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div id="setting-month_bulk" class="form-group field-select2_multiple">
                    <label for="month_bulk"><?php echo e(__('Months')); ?> <span class="text-danger">*</span></label>
                    <select id="month_bulk" class="form-control select2-multiple has-validation"
                            data-validation="required" data-toggle="select2"
                            multiple="multiple" data-placeholder="<?php echo e(__('Choose ...')); ?>">
                        <?php for($i = 1; $i <= 12; $i++): ?>
                            <option value="<?php echo e($i); ?>"><?php echo e(sprintf('%02d', $i)); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div id="setting-year_bulk" class="form-group field-select2_multiple">
                    <label for="year_bulk"><?php echo e(__('Years')); ?> <span class="text-danger">*</span></label>
                    <select id="year_bulk" class="form-control select2-multiple has-validation"
                            data-validation="required" data-toggle="select2"
                            multiple="multiple" data-placeholder="<?php echo e(__('Choose ...')); ?>">
                        <?php for($i = date('Y'); $i <= (date('Y') + 2); $i ++): ?>
                            <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="row">
                    <?php if($post_type == 'experience'): ?>
                        <div class="col">
                            <div id="setting-price-bulk-adult" class="form-group form-sm"
                                 data-condition="price_categories:is(enable_adults),booking_type:not(package)">
                                <label for="price_bulk_adult"><?php echo e(__('Adult')); ?></label>
                                <input id="price_bulk_adult" type="text" name="adult_price_bulk" value="0"
                                       data-hh-bind-value-from="#price_categories-price-adult"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div id="setting-price-bulk-child" class="form-group form-sm"
                                 data-condition="price_categories:is(enable_children),booking_type:not(package)">
                                <label for="price_bulk_child"><?php echo e(__('Child')); ?></label>
                                <input id="price_bulk_child" type="text" name="child_price_bulk"
                                       data-hh-bind-value-from="#price_categories-price-child" value="0"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div id="setting-price-bulk-infant" class="form-group form-sm"
                                 data-condition="price_categories:is(enable_infants),booking_type:not(package)">
                                <label for="price_bulk_infant"><?php echo e(__('Infant')); ?></label>
                                <input id="price_bulk_infant" type="text" name="infant_price_bulk"
                                       data-hh-bind-value-from="#price_categories-price-infant" value="0"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-12 col-sm-4">
                            <div id="setting-max-people-bulk-infant" class="form-group form-sm"
                                 data-condition="price_categories:is(enable_infants),booking_type:not(package)">
                                <label for="max_people_bulk"><?php echo e(__('Max. People')); ?></label>
                                <input id="max_people_bulk" type="number" min="0" step="1" name="max_people_bulk"
                                       data-hh-bind-value-from="#number_of_guest" value="0"
                                       class="form-control">
                            </div>
                        </div>
                        <input type="hidden" id="available_bulk" name="available"
                               value="on" checked/>

                        <input type="hidden" name="booking_type_bulk" data-hh-bind-value-from="#booking_type" value="">
                    <?php elseif($post_type == 'home'): ?>
                        <div class="col">
                            <div class="form-group form-sm">
                                <label for="price_bulk"><?php echo e(__('Price')); ?> <span class="text-danger">*</span></label>
                                <input id="price_bulk" type="text" name="price" value="0"
                                       class="form-control has-validation" data-validation="required">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group form-sm">
                                <label for="available_bulk"><?php echo e(__('Available')); ?></label>
                                <div class="w-100"></div>
                                <input type="checkbox" id="available_bulk" name="available"
                                       data-plugin="switchery" data-color="#1abc9c"
                                       value="on" checked/>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="col">
                            <div class="form-group form-sm">
                                <label for="price_bulk"><?php echo e(__('Price')); ?> <span class="text-danger">*</span></label>
                                <input id="price_bulk" type="text" name="price" value="0"
                                       class="form-control has-validation" data-validation="required">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group form-sm">
                                <label for="available_bulk"><?php echo e(__('Available')); ?></label>
                                <div class="w-100"></div>
                                <input type="checkbox" id="available_bulk" name="available"
                                       data-plugin="switchery" data-color="#1abc9c"
                                       value="on" checked/>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <input type="hidden" id="post_id_bulk" name="post_id_bulk" value="<?php echo e($post_id); ?>">
            <input type="hidden" name="post_type_bulk" value="<?php echo e($post_type); ?>">
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-info waves-effect waves-light add-price"><?php echo e(__('Add New')); ?>

                </button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->
<style>
    #hh-bulk-edit-modal .switchery {
        margin-top: 6px;
    }
</style>
<?php /**PATH /home/salentovacanze/public_html/app/Views/options/fields/price.blade.php ENDPATH**/ ?>