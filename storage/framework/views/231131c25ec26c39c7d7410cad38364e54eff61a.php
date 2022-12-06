<?php echo $__env->make('frontend.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
enqueue_style('mapbox-gl-css');
enqueue_style('mapbox-gl-geocoder-css');
enqueue_script('mapbox-gl-js');
enqueue_script('mapbox-gl-geocoder-js');
enqueue_script('search-home-js');

$showmap = request()->get('showmap', 'yes');
?>


		

        </div>
       
    </div>

    
    <?php
    $minmax = \App\Controllers\Services\HomeController::get_inst()->getMinMaxPrice();
    $currencySymbol = current_currency('symbol');
    $currencyPos = current_currency('position');

    ?>

	<?php 
		$titles = DB::table('home')->distinct()->pluck('location_city');
		        $address = request()->get('address');
		?>
	<form action="<?php echo e(get_home_search_page()); ?>" class="form pt-3 searchbarp3" method="get">
	<div class="container">
  <div class="row">
    <div class="col-sm-3">
       <div class="form-group">

     <?php
    if($address){
    ?>
	 <select class="select2 form-control" data-rel="chosen"  name="address" id="selectError">
	 <option value="">Tutte le location</option>  			 
	 <option value="<?php echo $address ?>" selected="selected"><?php echo $address ?></option>
	 <?php }else{ ?>	
	 <select class="select2 form-control" data-rel="chosen"  name="address" id="selectError">
     <option value="" selected="selected">Tutte le location</option>         
	  <?php }  ?>
 <?php
    foreach($titles as $title) { ?>
      <option value="<?= $title ?>"><?= $title ?></option>
  <?php
    } ?>
</select> 
                        </select>
  
        </div>
    </div>
	<?php
	$checkIn = request()->get('checkIn', '');
                $checkOut = request()->get('checkOut', '');
				?>
				
    <div class="col-sm">
       <div class="input-field second-wrap">
            
            <input class="datepicker form-control" data-min-date=today  name="checkIn" placeholder="Check-In" value="<?= $checkIn ?>" />
          </div>
    </div>
    <div class="col-sm">
       <div class="input-field third-wrap">
            
            <input class="datepicker form-control" data-min-date=today  name="checkOut" placeholder="Check-Out" value="<?= $checkOut ?>" />
          </div>
    </div>
		<?php
	$adults = request()->get('num_adults', '');
    $child = request()->get('num_children', '');

				?>
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
                        <input type="number" min="0" step="1" max="15" name="num_children" value="0">
                        <i class="increase ti-plus"></i>
                    </div>
                </div>
              
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
	  <?php   ?>
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
        <input class="btn btn-primary w-100" style="padding:7px" type="submit" name="sm"
               value="<?php echo e(__('Search')); ?>">
    </div>
    </div>
	</div>
	
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
	
  

</div>

<div class="hh-search-result" data-url="<?php echo e(get_home_search_page()); ?>">
    <?php echo $__env->make('frontend.home.search.search_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="hh-search-content-wrapper <?php if($showmap == 'no'): ?> no-map <?php endif; ?>">
        <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="hh-search-results-render" data-url="<?php echo e(get_home_search_page()); ?>">
            <div class="render">
                <div class="hh-search-results-string">
                    <span class="item-found"><?php echo e(__('Searching home...')); ?></span>
                </div>
                <div class="hh-search-content">
                    <div class="service-item list">

                    </div>
                </div>
                <div class="hh-search-pagination">

                </div>
            </div>
        </div>
        <div class="hh-search-results-map">
            <?php
            $lat = request()->get('lat');
            $lng = request()->get('lng');
            $zoom = request()->get('zoom', 5);
            $in_map = true;
            ?>
            <div class="hh-mapbox-search" data-lat="<?php echo e($lat); ?>"
                 data-lng="<?php echo e($lng); ?>" data-zoom="<?php echo e($zoom); ?>"></div>
            <div class="hh-close-map-popup" id="hide-map-mobile"><?php echo e(__('Close')); ?></div>
            <!--<div class="hh-map-tooltip">
                <div class="checkbox checkbox-success">
                    <input id="chk-map-move" type="checkbox" name="map_move" value="1">
                    <label for="chk-map-move"><?php echo e(__('Search as I move the map')); ?></label>
                </div>
                <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>-->
        </div>
    </div>
</div>
<?php echo $__env->make('frontend.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp7\htdocs\app\Views/frontend/home/search/search.blade.php ENDPATH**/ ?>