<?php
enqueue_style('daterangepicker-css');
enqueue_script('daterangepicker-js');
enqueue_script('daterangepicker-lang-js');

enqueue_script('switchery-js');
enqueue_style('switchery-css');

enqueue_style('iconrange-slider');
enqueue_script('iconrange-slider');
?>
<div class="hh-search-bar-wrapper">
    <div class="hh-search-bar-buttons">
        <?php
        $lat = request()->get('lat');
        $lng = request()->get('lng');
        $address = request()->get('address');
        ?>
        <!--<div class="hh-button-item button-location form-group">
            <div class="form-control" data-plugin="mapbox-geocoder" data-value="<?php echo e($address); ?>"
                 data-your-location="<?php echo e(__('Your Location')); ?>" data-current-location="0"
                 data-placeholder="<?php echo e(__('Enter a location ...')); ?>" data-lang="<?php echo e(get_current_language()); ?>"></div>
            <div class="map d-none"></div>
            <input type="hidden" name="lat" value="<?php echo e($lat); ?>">
            <input type="hidden" name="lng" value="<?php echo e($lng); ?>">
            <input type="hidden" name="address" value="<?php echo e($address); ?>">
        </div>-->
        <?php
        $booking_type = request()->get('bookingType', 'per_night');
        ?>
        <?php if($booking_type == 'per_night'): ?>
           <!-- <div class="hh-button-item button-date button-date-double form-group"
                 data-date-format="<?php echo e(hh_date_format_moment()); ?>">
                <span class="text"><?php echo __('Date'); ?></span>
                <?php
                $checkIn = request()->get('checkIn', '');
                $checkOut = request()->get('checkOut', '');
                $checkInOut = request()->get('checkInOut', '');
                ?>
                <input type="hidden" class="check-in-field" name="checkIn" value="<?php echo e($checkIn); ?>">
                <input type="hidden" class="check-out-field" name="checkOut" value="<?php echo e($checkOut); ?>">
                <input type="text" class="input-hidden check-in-out-field" name="checkInOut" value="<?php echo e($checkInOut); ?>">
            </div>
        <?php endif; ?>
        <?php if($booking_type == 'per_hour'): ?>
            <div class="hh-button-item button-date button-date-single button-same-date form-group"
                 data-date-format="<?php echo e(hh_date_format_moment()); ?>">
                <span class="text"><?php echo __('Date'); ?></span>
                <?php
                $checkIn = request()->get('checkInTime', date('Y-m-d'));
                $checkOut = request()->get('checkOutTime', date('Y-m-d'));
                $checkInOut = request()->get('checkInOutTime');
                ?>
                <input type="hidden" class="check-in-field" name="checkInTime" value="<?php echo e($checkIn); ?>">
                <input type="hidden" class="check-out-field" name="checkOutTime" value="<?php echo e($checkOut); ?>">
                <input type="text" class="input-hidden check-in-out-field" name="checkInOutTime"
                       value="<?php echo e($checkInOut); ?>">
            </div>
            <?php
            enqueue_script('flatpickr-js');
            enqueue_style('flatpickr-css');
            $startTime = request()->get('startTime', '12:00 AM');
            if (!$startTime) {
                $startTime = '12:00 AM';
            }
            $endTime = request()->get('endTime', '11:30 PM');
            if (!$endTime) {
                $endTime = '11:30 PM';
            }
                $startTime = date(hh_time_format(), strtotime($startTime));
		        $endTime = date(hh_time_format(), strtotime($endTime));
            ?>
            <div class="dropdown dropdown-button dropdown-button-time">
                <div class="hh-button-item button-time form-group" data-toggle="dropdown" aria-haspopup="true"
                     role="article"
                     aria-expanded="false" data-time-format="<?php echo e(hh_time_format_picker()); ?>" data-time-type="<?php echo e(hh_time_type_picker()); ?>">
                    <span class="text start"><?php echo e($startTime); ?></span>
                    <?php echo get_icon('002_right_arrow', '', '15px'); ?>

                    <span class="text end"><?php echo e($endTime); ?></span>
                    <div class="dropdown-menu">
                        <div class="date-wrapper date-time">
                            <div class="date-render check-in-render"
                                 data-time-format="<?php echo e(hh_time_format()); ?>">
                                <div class="render"><?php echo e(__('Start Time')); ?></div>
                                <input type="hidden" name="startTime" value="<?php echo e($startTime); ?>"
                                       class="input-checkin input-hidden flatpickr"/>
                            </div>
                            <span class="divider"></span>
                            <div class="date-render check-out-render"
                                 data-time-format="<?php echo e(hh_time_format()); ?>">
                                <div class="render"><?php echo e(__('End Time')); ?></div>
                                <input type="hidden" name="endTime" value="<?php echo e($endTime); ?>"
                                       class="input-checkout input-hidden flatpickr"/>
                            </div>
                        </div>
                        <a href="javascript:void(0)"
                           class="apply-time-filter btn btn-primary btn-xs right"><?php echo e(__('Apply')); ?></a>
                    </div>
                </div>
            </div>
        <?php endif; ?>-->
        <?php
        $minmax = \App\Controllers\Services\HomeController::get_inst()->getMinMaxPrice();
        $currencySymbol = current_currency('symbol');
        $priceFilter = request()->get('price_filter');
        $priceFilter = explode(';', $priceFilter);
        if (!isset($priceFilter[1]) || $priceFilter[1] == 0) {
            $priceFilter[1] = $minmax['max'];
        }
        $currencyPos = current_currency('position');
        ?>
        <div class="dropdown dropdown-button dropdown-button-price">
            <div class="hh-button-item button-price form-group" data-toggle="dropdown" aria-haspopup="true"
                 role="article"
                 aria-expanded="false">
                <span class="text"><?php echo e(__('Filtra per prezzo')); ?></span>
                <div class="dropdown-menu">
                    <input type="text" id="price-filter" name="price_filter" data-plugin="ion-range-slider"
                           data-prefix="<?php echo e($currencyPos == 'left' ? $currencySymbol : ''); ?>"
                           data-postfix="<?php echo e($currencyPos == 'right' ? $currencySymbol : ''); ?>"
                           data-min="<?php echo e($minmax['min']); ?>"
                           data-max="<?php echo e($minmax['max']); ?>"
                           data-from="<?php echo e($priceFilter[0]); ?>"
                           data-to="<?php echo e($priceFilter[1]); ?>"
                           data-skin="round">
                </div>
            </div>
        </div>
        <div class="dropdown dropdown-button dropdown-button-more-filter">
            <div class="hh-button-item button-more-filter form-group" data-toggle="dropdown" aria-haspopup="false"
                 role="article"
                 aria-expanded="true">
                <span class="text"><?php echo __('More filters'); ?></span>
                <div class="dropdown-menu">
                    <?php
                    $terms = get_home_terms_filter();
                    ?>
                    <?php if(!empty($terms)): ?>
                        <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term_name => $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $tax = request()->get($term_name);
                            $tax_arr = [];
                            if (!empty($tax)) {
                                $tax_arr = explode(',', $tax);
                            }
                            ?>
                            <div class="item-filter-wrapper" data-type="<?php echo e($term_name); ?>">
                                <div class="label"><?php echo e($term['label']); ?></div>
                                <?php if(!empty($term['items'])): ?>
                                    <div class="content">
                                        <div class="row">
                                            <?php $__currentLoopData = $term['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term_id => $term_title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                $checked = '';
                                                if (in_array($term_id, $tax_arr)) {
                                                    $checked = 'checked';
                                                }
                                                ?>
                                                <div class="col-lg-6 mb-1">
                                                    <div class="item checkbox  checkbox-success ">
                                                        <input type="checkbox" value="<?php echo e($term_id); ?>"
                                                               id="<?php echo e($term_name); ?><?php echo e($term_id); ?>" <?php echo e($checked); ?>/>
                                                        <label
                                                            for="<?php echo e($term_name); ?><?php echo e($term_id); ?>"><?php echo e(get_translate($term_title)); ?></label>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <input type="hidden" name="<?php echo e($term_name); ?>" value="<?php echo e($tax); ?>"/>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <a href="javascript:void(0)"
                       class="apply-more-filter btn btn-primary btn-xs right"><?php echo e(__('Apply')); ?></a>
                </div>
            </div>
        </div>
        <div class="hh-button-item show-filter form-group" id="show-filter-mobile">
            <span class="text"><?php echo e(__('Filters')); ?></span>
        </div>
        <div class="hh-button-item show-map form-group" id="show-map-mobile">
            <span class="text"><?php echo e(__('Show map')); ?></span>
        </div>
    </div>
    <div class="hh-toggle-map-search">
        <label for="hh-map-toggle-search" class="mr-2"><?php echo e(__('Show Map')); ?></label>
        <input id="hh-map-toggle-search" checked type="checkbox" data-plugin="switchery" data-color="#1bb99a"
               name="toggle_map_search" value="1"/>
    </div>
    <div class="hh-search-bar-toggle"></div>
    <div id="filter-mobile-box" class="filter-mobile-box">
        <div class="render-box">
            <div class="popup-filter-header">
                <span><?php echo e(__('Filters')); ?></span>
                <div
                    class="popup-filter-close"><?php echo balanceTags(get_icon('001_close', '#575757', '28px', '28px')); ?></div>
            </div>
            <div class="popup-filter-content">
               <!-- 
                <div class="filter-item">
                    <p class="filter-item-title"><?php echo e(__('Location')); ?></p>
                    <div class="hh-button-item button-location form-group">
                        <div class="form-control" data-plugin="mapbox-geocoder" data-value="<?php echo e($address); ?>"
                             data-your-location="<?php echo e(__('Your Location')); ?>"
                             data-placeholder="<?php echo e(__('Enter a location ...')); ?>"
                             data-lang="<?php echo e(get_current_language()); ?>"></div>
                        <div class="map d-none"></div>
                        <input type="hidden" name="lat" value="<?php echo e($lat); ?>">
                        <input type="hidden" name="lng" value="<?php echo e($lng); ?>">
                        <input type="hidden" name="address" value="<?php echo e($address); ?>">
                    </div>
                </div>

                
                <?php if($booking_type == 'per_night'): ?>
                    <div class="filter-item">
                        <p class="filter-item-title"><?php echo e(__('Date')); ?></p>
                        <div class="hh-button-item button-date button-date-single form-group"
                             data-date-format="<?php echo e(hh_date_format_moment()); ?>">
                            <span class="text"><?php echo __('Date'); ?></span>
                            <input type="hidden" class="check-in-field" name="checkIn" value="<?php echo e($checkIn); ?>">
                            <input type="hidden" class="check-out-field" name="checkOut" value="<?php echo e($checkOut); ?>">
                            <input type="text" class="io-date check-in-out-field" name="checkInOut"
                                   value="<?php echo e($checkInOut); ?>">
                        </div>
                    </div>
                <?php endif; ?>
                <?php if($booking_type == 'per_hour'): ?>
                    <div class="filter-item">
                        <p class="filter-item-title"><?php echo e(__('Date')); ?></p>
                        <div class="hh-button-item button-date button-date-single form-group"
                             data-date-format="<?php echo e(hh_date_format_moment()); ?>">
                            <span class="text"><?php echo __('Date'); ?></span>
                            <input type="hidden" class="check-in-field" name="checkInTime" value="<?php echo e($checkIn); ?>">
                            <input type="hidden" class="check-out-field" name="checkOutTime" value="<?php echo e($checkOut); ?>">
                            <input type="text" class="io-date check-in-out-field" name="checkInOutTime"
                                   value="<?php echo e($checkInOut); ?>">
                        </div>
                    </div>
                    <div class="filter-item">
                        <p class="filter-item-title"><?php echo e(__('Time')); ?></p>
                        <?php
                        $listTime = list_hours(30);
                        ?>
                        <div class="date-wrapper date-time">
                            <div class="date-render check-in-render"
                                 data-time-format="<?php echo e(hh_time_format()); ?>">
                                <div class="render"><?php echo e($startTime); ?></div>
                                <div class="dropdown-time">
                                    <?php $__currentLoopData = $listTime; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item <?php if($key == $startTime): ?> active <?php endif; ?>"
                                             data-value="<?php echo e($key); ?>"><?php echo e($value); ?></div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <input type="hidden" name="startTime" value="<?php echo e($startTime); ?>"
                                       class="input-checkin"/>
                            </div>
                            <span class="divider"><?php echo get_icon('002_right_arrow', '', '15px'); ?></span>
                            <div class="date-render check-out-render"
                                 data-time-format="<?php echo e(hh_time_format()); ?>">
                                <div class="render"><?php echo e($endTime); ?></div>
                                <div class="dropdown-time">
                                    <?php $__currentLoopData = $listTime; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item <?php if($key == $endTime): ?> active <?php endif; ?>"
                                             data-value="<?php echo e($key); ?>"><?php echo e($value); ?></div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <input type="hidden" name="endTime" value="<?php echo e($endTime); ?>"
                                       class="input-checkin"/>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>-->

                
                <div class="filter-item">
                    <p class="filter-item-title"><?php echo e(__('Price')); ?></p>
                    <input type="text" id="price-filter-popup" name="price_filter" data-plugin="ion-range-slider"
                           data-prefix="<?php echo e($currencyPos == 'left' ? $currencySymbol : ''); ?>"
                           data-postfix="<?php echo e($currencyPos == 'right' ? $currencySymbol : ''); ?>"
                           data-min="<?php echo e($minmax['min']); ?>"
                           data-max="<?php echo e($minmax['max']); ?>"
                           data-from="<?php echo e($priceFilter[0]); ?>"
                           data-to="<?php echo e($priceFilter[1]); ?>"
                           data-skin="round">
                </div>

                
                <?php if(!empty($terms)): ?>
                    <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term_name => $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $tax = request()->get($term_name);
                        $tax_arr = [];
                        if (!empty($tax)) {
                            $tax_arr = explode(',', $tax);
                        }
                        ?>
                        <div class="filter-item item-filter-wrapper popup-tax-filter" data-type="<?php echo e($term_name); ?>">
                            <p class="filter-item-title"><?php echo e($term['label']); ?></p>
                            <?php if(!empty($term['items'])): ?>
                                <div class="content">
                                    <div class="row">
                                        <?php $__currentLoopData = $term['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term_id => $term_title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            $checked = '';
                                            if (in_array($term_id, $tax_arr)) {
                                                $checked = 'checked';
                                            }
                                            ?>
                                            <div class="col-sm-4 mb-1">
                                                <div class="item checkbox  checkbox-success ">
                                                    <input type="checkbox" value="<?php echo e($term_id); ?>"
                                                           id="popup-<?php echo e($term_name); ?><?php echo e($term_id); ?>" <?php echo e($checked); ?>/>
                                                    <label
                                                        for="popup-<?php echo e($term_name); ?><?php echo e($term_id); ?>"><?php echo e(get_translate($term_title)); ?></label>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <input type="hidden" name="<?php echo e($term_name); ?>" value="<?php echo e($tax); ?>"/>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="popup-filter-footer">
            <div class="view-result"><?php echo e(__('View filter result')); ?></div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp7\htdocs\app\Views/frontend/home/search/search_bar.blade.php ENDPATH**/ ?>