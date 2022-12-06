<div class="hh-service-item home list" data-lng="<?php echo e($item->location_lng); ?>"
     data-lat="<?php echo e($item->location_lat); ?>" data-id="<?php echo e($item->post_id); ?>">
    <div class="item-inner">
        <div class="thumbnail-wrapper">
            <?php if($item->is_featured == 'on'): ?>
                <div class="is-featured"><?php echo e(get_option('featured_text', __('Featured'))); ?></div>
            <?php endif; ?>
            <?php if(!empty($item->gallery)): ?>
                <?php
                $galleries = explode(',', $item->gallery);
                $featured_image = $item->thumbnail_id;
                if(!empty($featured_image)){
                    array_unshift($galleries, $featured_image);
                }
                ?>
                <div id="hh-item-carousel-<?php echo e($item->post_id); ?>" class="hh-item-carousel carousel slide"
                     data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $imageID): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="carousel-item <?php if($key == 0): ?> active <?php endif; ?>">
                                <a href="<?php echo e(get_the_permalink($item->post_id, $item->post_slug)); ?>"
                                   class="carousel-cell">
                                    <img src="<?php echo e(get_attachment_url($imageID, [400, 300])); ?>"
                                         alt="<?php echo e(get_translate($item->post_title)); ?>"/>
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <a class="carousel-control-prev" href="#hh-item-carousel-<?php echo e($item->post_id); ?>" role="button"
                       data-slide="prev">
                        <i class="ti-angle-left"></i>
                        <span class="sr-only"><?php echo e(__('Previous')); ?></span>
                    </a>
                    <a class="carousel-control-next" href="#hh-item-carousel-<?php echo e($item->post_id); ?>" role="button"
                       data-slide="next">
                        <i class="ti-angle-right"></i>
                        <span class="sr-only"><?php echo e(__('Next')); ?></span>
                    </a>
                </div>
            <?php else: ?>
                <a href="<?php echo e(get_the_permalink($item->post_id, $item->post_slug)); ?>" class="no-gallery">
                    <img src="<?php echo e(placeholder_image([400, 300])); ?>" alt="<?php echo e(get_translate($item->post_title)); ?>"
                         class="img-fluid"/>
                </a>
            <?php endif; ?>
        </div>
        <div class="content">
            <div class="d-flex justify-content-between align-items-center infotestata">
                <div class="home-type">
                    <?php
                    $type = get_term_by('id', $item->home_type);
                    $type_name = $type ? get_translate($type->term_title) : '';
					$typesec = get_term_by('id', $item->home_typesec);
                    $type_namesec = $type ? get_translate($typesec->term_title) : '';
                    ?>
                    <?php echo e($type_name); ?> / <?php echo e($type_namesec); ?>

                </div>
                <?php if(enable_review()): ?>
                    <div class="rating">
                        <?php
                        $review_number = get_comment_number($item->post_id, 'home');
                        if ($review_number > 0) {
                            echo '<i class="fe-star-on"></i> ';
                            echo '<b>' . esc_attr($item->rating) . '</b> ';
                        }
                        echo '<span>(';
                        echo _n("[0::No reviews][1::%s review][2::%s reviews]", $review_number);
                        echo ')</span>';
                        ?>
                    </div>
                <?php endif; ?>
            </div>
            <h3 class="title">
                <a href="<?php echo e(get_the_permalink($item->post_id, $item->post_slug)); ?>"><?php echo e(get_translate($item->post_title)); ?></a>
            </h3>
            <p class="address text-overflow font13"><i class="fe-map-pin mr-1 "></i><?php echo e(get_shorted_address($item)); ?></p>
            <div class="facilities">
			<div class="row">
                <div class="item max-people col-sm-6 ">
                 <span class="allignicons"><i class="fa fa-users" aria-hidden="true"></i></span> <?php echo e(_n("[0::%s guests][1::%s guest][2::%s guests]", (int)$item->number_of_guest)); ?>

                </div>
                <div class="item max-bedrooms col-sm-6">
                 <span class="allignicons"><i class="fa fa-bed" aria-hidden="true"></i></span> <?php echo e(_n("[0::%s bedrooms][1::%s bedroom][2::%s bedrooms]", (int)$item->number_of_bedrooms)); ?>

                </div>
                <div class="item max-baths col-sm-6">
               <span class="allignicons m3r"><i class="fa fa-bath" aria-hidden="true"></i> </span> <?php echo e(_n("[0::%s bathrooms][1::%s bathroom][2::%s bathrooms]", (int)$item->number_of_bathrooms)); ?>

                </div>
			
				
<?php if($item->dis): ?>
	
			  <div class="item max-baths col-sm-6">
             <span class="allignicons">  <i class='fa fa-water mare'></i></span><?php echo e(__('Sea')); ?> <?php echo e($item->dis); ?>

            </div>
			<?php else: ?>
				<div class="item max-baths col-sm-6">
                
            </div>
			<?php endif; ?>

			<?php if($item->disp): ?>
				<br>
			  <div class="item max-baths col-sm-6">
           <span class="allignicons">  <i class='fa fa-water spiaggia'></i></span><?php echo e(__('Beach')); ?> <?php echo e($item->disp); ?>

            </div>
			<?php else: ?>
				<div class="item max-baths col-sm-6">
                
            </div>
			<?php endif; ?>
				
            </div>
			</div>
			
            <div class="meta-footer">
                <div class="price-wrapper"><?php
                $checkIn = request()->get('checkIn', '');
                $checkOut = request()->get('checkOut', '');
                $checkInOut = request()->get('checkInOut', '');
				
				//DEMONERO ACQUISIZIONE DATA INIZIO E DATA FINE
				$datetime1 	= new DateTime ($checkIn = request()->get('checkIn', ''));
				$datetime2 	= new DateTime ($checkOut = request()->get('checkOut', ''));
				$interval 	= $datetime1->diff($datetime2);
				//DEMONERO CALCOLO PREZZO SINGOLA NOTTE * NOTTI RICHIESTE
					$prezzototale = $item->base_price * $interval->format('%a');
                ?>
				<?php if(empty($prezzototale)): ?>
				
                    <span class="price"><?php echo e(convert_price($item->base_price )); ?>/Notte </h5>
				<?php else: ?>
					 <span class="price"><?php echo e(convert_price($prezzototale )); ?> </span><h5>&nbsp;per <?php echo $interval->format('%a Notte/i'); ?> </h5>
					<?php endif; ?>
					
					  
				
                </div>

            </div>
        </div>
    </div>
</div>

<?php /**PATH /home/salentovacanze/public_html/app/Views/frontend/home/loop/list.blade.php ENDPATH**/ ?>