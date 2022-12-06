<h1 class="h3" style="text-align:center"><?php echo e(__('Book unique places to stay')); ?></h1>

		
<!--<form action="<?php echo e(get_home_search_page()); ?>" class="form mt-3" method="get">
    <div class="form-group">
        <label><?php echo e(__('Where')); ?></label>
      <!--  <div class="form-control" data-plugin="mapbox-geocoder" data-value=""
             data-current-location="1"
             data-your-location="<?php echo e(__('Your Locatione')); ?>"
             data-placeholder="<?php echo e(__('Enter a location ...')); ?>" data-lang="<?php echo e(get_current_language()); ?>"></div>
        <div class="map d-none"></div>
        <input type="hidden" name="lat" value="">
        <input type="hidden" name="lng" value="">
        <input type="hidden" name="address" value="">
    </div>
	 <select class="select2 form-control" data-rel="chosen"  name="address" id="selectError">
	 <option value="">Tutte le Località</option>
               
                        </select>
   <!-- PRENOTAZIONE A ORE <div class="form-group hidden-sm">
        <div class="radio radio-pink form-check-inline ml-1">
            <input id="booking_type_home_night" type="radio" name="bookingType" value="per_night"
                   checked >
            <label for="booking_type_home_night"><?php echo e(__('per Night')); ?></label>-->
        </div>
       <!-- <div class="radio radio-pink form-check-inline ml-1">
            <input id="booking_type_home_hour" type="radio" name="bookingType" value="per_hour">
            <label for="booking_type_home_hour"><?php echo e(__('per Hour')); ?></label>
        </div>-->
    </div>

    <!--<div class="form-group form-group-date-single d-none">
        <label><?php echo e(__('Check In')); ?></label>
        <div class="date-wrapper date date-single"
             data-date-format="<?php echo e(hh_date_format_moment()); ?>">
            <input type="text"
                   class="input-hidden check-in-out-field"
                   name="checkInOutTime">
            <input type="text" class="input-hidden check-in-field"
                   name="checkInTime">
            <input type="text" class="input-hidden check-out-field"
                   name="checkOutTime">
            <span class="check-in-render"
                  data-date-format="<?php echo e(hh_date_format_moment()); ?>"></span>
        </div>
    </div>
    <div class="form-group form-group-date-time d-none">
        <label><?php echo e(__('Time')); ?></label>
        <?php
        $listTime = list_hours(30);
        ?>
        <div class="date-wrapper date-time">
            <div class="date-render check-in-render"
                 data-time-format="<?php echo e(hh_time_format()); ?>">
                <div class="render"><?php echo e(__('Start Time')); ?></div>
                <div class="dropdown-time">
                    <?php $__currentLoopData = $listTime; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item" data-value="<?php echo e($key); ?>"><?php echo e($value); ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <input type="hidden" name="startTime" value=""
                       class="input-checkin"/>
            </div>
            <span class="divider"></span>
            <div class="date-render check-out-render"
                 data-time-format="<?php echo e(hh_time_format()); ?>">
                <div class="render"><?php echo e(__('End Time')); ?></div>
                <div class="dropdown-time">
                    <?php $__currentLoopData = $listTime; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item" data-value="<?php echo e($key); ?>"><?php echo e($value); ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <input type="hidden" name="endTime" value=""
                       class="input-checkin"/>
            </div>
        </div>
    </div>
    <div class="form-group form-group-date">
        <label><?php echo e(__('Check In')); ?></label>
		<!--RICERCA MODULATA
        <div class="date-wrapper date" style="display:none" data-date-format="<?php echo e(hh_date_format_moment()); ?>">
            <input type="text" class="input-hidden check-in-out-field" name="checkInOut">
            <input type="text" class="input-hidden check-in-field" name="checkIn">
            <input type="text" class="input-hidden check-out-field" name="checkOut">
            <span class="check-in-render"
                  data-date-format="<?php echo e(hh_date_format_moment()); ?>"></span>
            <span class="divider"></span>
            <span class="check-out-render"
                  data-date-format="<?php echo e(hh_date_format_moment()); ?>"></span>
        </div>


		<!--RICERCA SEPARATA
 <div class="input-field second-wrap">
            
            <input class="datepicker form-control" data-min-date=today  name="checkIn" placeholder="Check-In" />
          </div>
          <div class="input-field third-wrap">
            
            <input class="datepicker form-control" data-min-date=today  name="checkOut" placeholder="Check-Out" />
          </div>

    </div>
	
    <div class="form-group">
        <label><?php echo e(__('Guests')); ?></label>
        <div class="guest-group">
            <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown"
                    data-text-guest="<?php echo e(__('Guest')); ?>"
                    data-text-guests="<?php echo e(__('Guests')); ?>"
                    data-text-infant="<?php echo e(__('Infant')); ?>"
                    data-text-infants="<?php echo e(__('Infants')); ?>"
                    aria-haspopup="true" aria-expanded="false">
                &nbsp;
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="group">
                    <span class="pull-left"><?php echo e(__('Adults')); ?></span>
                    <div class="control-item">
                        <i class="decrease ti-minus"></i>
                        <input type="number" min="1" step="1" max="15" name="num_adults" value="1">
                        <i class="increase ti-plus"></i>
                    </div>
                </div>
                <div class="group">
                    <span class="pull-left"><?php echo e(__('Children')); ?></span>
                    <div class="control-item">
                        <i class="decrease ti-minus"></i>
                        <input type="number" min="0" step="1" max="15" name="num_children"
                               value="0">
                        <i class="increase ti-plus"></i>
                    </div>
                </div>
                <!--OPZIONE NEONATI<div class="group">
                    <span class="pull-left"><?php echo e(__('Infants')); ?></span>
                    <div class="control-item">
                        <i class="decrease ti-minus"></i>
                        <input type="number" min="0" step="1" max="10" name="num_infants" value="0">
                        <i class="increase ti-plus"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $minmax = \App\Controllers\Services\HomeController::get_inst()->getMinMaxPrice();
    $currencySymbol = current_currency('symbol');
    $currencyPos = current_currency('position');

    ?>
    <div class="form-group">
        <label><?php echo e(__('Price Range')); ?></label>
        <input type="text" name="price_filter"
               data-plugin="ion-range-slider"
               data-prefix="<?php echo e($currencyPos == 'left' ? $currencySymbol : ''); ?>"
               data-postfix="<?php echo e($currencyPos == 'right' ? $currencySymbol : ''); ?>"
               data-min="<?php echo e($minmax['min']); ?>"
               data-max="<?php echo e($minmax['max']); ?>"
               data-from="<?php echo e($minmax['min']); ?>"
               data-to="<?php echo e($minmax['max']); ?>"
               data-skin="round">
    </div>
	
    <div class="form-group">
        <input class="btn btn-primary w-100" type="submit" name="sm"
               value="<?php echo e(__('Search')); ?>">
    </div>
</form>
    
    </div>-->
	<?php 
		$titles = DB::table('home')->distinct()->pluck('location_city');
		?>
	<form action="<?php echo e(get_home_search_page()); ?>" class="form mt-3" method="get">
	<div class="container">
  <div class="row">
    <div class="col-sm-4">
       <div class="form-group">

      <!--  <div class="form-control" data-plugin="mapbox-geocoder" data-value=""
             data-current-location="1"
             data-your-location="<?php echo e(__('Your Locatione')); ?>"
             data-placeholder="<?php echo e(__('Enter a location ...')); ?>" data-lang="<?php echo e(get_current_language()); ?>"></div>
        <div class="map d-none"></div>
        <input type="hidden" name="lat" value="">
        <input type="hidden" name="lng" value="">
        <input type="hidden" name="address" value="">
    </div>-->
	 <select class="select2 form-control" data-rel="chosen"  name="address" id="selectError">
	  <option value="" selected="selected">Tutte le location</option>
  <?php
    foreach($titles as $title) { ?>
      <option value="<?= $title ?>"><?= $title ?></option>
  <?php
    } ?>
</select> 
                        </select>
   <!-- PRENOTAZIONE A ORE <div class="form-group hidden-sm">
        <div class="radio radio-pink form-check-inline ml-1">
            <input id="booking_type_home_night" type="radio" name="bookingType" value="per_night"
                   checked >
            <label for="booking_type_home_night"><?php echo e(__('per Night')); ?></label>-->
        </div>
    </div>
    <div class="col-sm">
       <div class="input-field second-wrap">
            
            <input class="datepicker form-control" data-min-date=today  name="checkIn" placeholder="Check-In" />
          </div>
    </div>
    <div class="col-sm">
       <div class="input-field third-wrap">
            
            <input class="datepicker form-control" data-min-date=today  name="checkOut" placeholder="Check-Out" />
          </div>
    </div>
	   <div class="col-sm">
       <div class="form-group">
        <div class="guest-group">
            <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown"
                    data-text-guest="<?php echo e(__('Guest')); ?>"
                    data-text-guests="<?php echo e(__('Guests')); ?>"
                    data-text-infant="<?php echo e(__('Infant')); ?>"
                    data-text-infants="<?php echo e(__('Infants')); ?>"
                    aria-haspopup="true" aria-expanded="false">
                &nbsp;
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="group">
                    <span class="pull-left"><?php echo e(__('Adults')); ?></span>
                    <div class="control-item">
                        <i class="decrease ti-minus"></i>
                        <input type="number" min="1" step="1" max="15" name="num_adults" value="1">
                        <i class="increase ti-plus"></i>
                    </div>
                </div>
                <div class="group">
                    <span class="pull-left"><?php echo e(__('Children')); ?></span>
                    <div class="control-item">
                        <i class="decrease ti-minus"></i>
                        <input type="number" min="0" step="1" max="15" name="num_children"
                               value="0">
                        <i class="increase ti-plus"></i>
                    </div>
                </div>
                <!--OPZIONE NEONATI<div class="group">
                    <span class="pull-left"><?php echo e(__('Infants')); ?></span>
                    <div class="control-item">
                        <i class="decrease ti-minus"></i>
                        <input type="number" min="0" step="1" max="10" name="num_infants" value="0">
                        <i class="increase ti-plus"></i>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
    </div>
	 <?php
        $home_types = get_terms('home-type', true);

        ?>
		    <div class="col-sm">
       <div class="form-group">
 
   	 <select class="select2 form-control" data-rel="chosen"  name="home-type" id="home-type">     

	 
	
	  <option value="" >Tutte le strutture</option>
 <?php
    foreach($home_types as $item) { ?>
	
      <option value="<?php echo $item->term_id ?>" ><?php echo $item->term_title ?></option>
	 
  <?php
    } ?>
	
</select> 

    
  
        </div>
    </div>
	 <div class="col-sm">
<div class="form-group">
        <input class="btn btn-primary w-100" type="submit" name="sm"
               value="<?php echo e(__('Search')); ?>">
    </div>
    </div>
	</div>
	<!--<div class="row">
	<div class="col-sm">
           <?php
    $minmax = \App\Controllers\Services\HomeController::get_inst()->getMinMaxPrice();
    $currencySymbol = current_currency('symbol');
    $currencyPos = current_currency('position');

    ?>
    <div class="form-group">
 
        <input type="text" name="price_filter"
               data-plugin="ion-range-slider"
               data-prefix="<?php echo e($currencyPos == 'left' ? $currencySymbol : ''); ?>"
               data-postfix="<?php echo e($currencyPos == 'right' ? $currencySymbol : ''); ?>"
               data-min="<?php echo e($minmax['min']); ?>"
               data-max="<?php echo e($minmax['max']); ?>"
               data-from="<?php echo e($minmax['min']); ?>"
               data-to="<?php echo e($minmax['max']); ?>"
               data-skin="round">
    </div>
	
    </div></div>
	   <div class="col-sm">
<div class="form-group">
        <input class="btn btn-primary w-100" type="submit" name="sm"
               value="<?php echo e(__('Search')); ?>">
    </div>
    </div>-->
  </div>
</div>
</form>
</div>
    <script src="js/extention/choices.js"></script>
    <script src="js/extention/flatpickr.js"></script>
	<script src="https://npmcdn.com/flatpickr/dist/l10n/it.js"></script>
	<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/confetti.css">

    <script>
      flatpickr(".datepicker",{
       "locale": "it"  ,
	format: "d-m-Y",
altFormat: "d-m-Y",
disableMobile: "true",
altInput: true
});
    </script>
	
    <script>
      const choices = new Choices('[data-trigger]',
      {
        searchEnabled: false,
        itemSelectText: '',
      });

    </script>

</div>
<?php /**PATH C:\xampp7\htdocs\app\Views/frontend/home/search/search-form.blade.php ENDPATH**/ ?>