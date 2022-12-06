<?php echo $__env->make('frontend.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
enqueue_script('scroll-magic-js');
global $post;
?>
<div class="single-page single-home pb-5">
    <!-- Gallery -->
    <?php
    $gallery = $post->gallery;
    $thumbnail_id = get_home_thumbnail_id($post->post_id);
    $thumbnailUrl = get_attachment_url($thumbnail_id, 'full');
    ?>
    <div class="hh-gallery hh-thumbnail has-background-image" data-src="<?php echo e($thumbnailUrl); ?>"
         style="background-image: url(<?php echo e($thumbnailUrl); ?>)">
        <div class="controls">
            <a href="javascript: void(0);" class="view-gallery item-link"><span><?php echo e(__('View Photos')); ?></span> <i
                    class="ti-gallery"></i> </a>
        </div>
        <?php
        if (!empty($gallery)) {
            enqueue_script('light-gallery-js');
            enqueue_style('light-gallery-css');

            $gallery = explode(',', $gallery);
            $data = [];
            foreach ($gallery as $key => $val) {
                $url = get_attachment_url($val);
                if (!empty($url)) {
                    $data[] = [
                        'src' => $url
                    ];
                }
            }
            if (!empty($data)) {
                $data = base64_encode(json_encode($data));
                echo '<div class="data-gallery" data-gallery="' . esc_attr($data) . '"></div>';
            }
        }
        ?>
    </div>
    <div class="container shadow">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-8 col-lg-9 col-content panel-wrapper">
                <?php echo $__env->make('frontend.components.breadcrumb', ['currentPage' => get_translate($post->post_title)], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php if($post->is_featured == 'on'): ?>
                        <span class="is-featured"><?php echo e(get_option('featured_text', __('Featured'))); ?></span>
                    <?php endif; ?>
                <h1 class="title mt-3 stripsbox">
				
                    <?php echo e(get_translate($post->post_title)); ?>

                    
                </h1>
                <div class="featured-amenities mt-2 mb-2">
                    <div class="item">
                        <h4><?php echo e(__('Guests:')); ?></h4>
                        <span> <?php echo e($post->number_of_guest); ?> </span>
                    </div>
                    <div class="item">
                        <h4><?php echo e(__('Bedrooms:')); ?></h4>
                        <span><?php echo e($post->number_of_bedrooms); ?></span>
                    </div>
                    <div class="item">
                        <h4><?php echo e(__('Bathrooms:')); ?></h4>
                        <span><?php echo e($post->number_of_bathrooms); ?></span>
                    </div>
                    <div class="item">
                        <h4><?php echo e(__('Footage:')); ?></h4>
                        <span><?php echo e($post->size); ?> <?php echo e(get_option('unit_of_measure', 'm2')); ?></span>
                    </div>
                    <?php
                    $type = get_term_by('id', $post->home_type);
                    $type_name = $type ? get_translate($type->term_title) : '';
                    ?>
                    <?php if(!empty($type_name)): ?>
                        <div class="item">
                            <h4><?php echo e(__('Type:')); ?></h4>
                            <span><?php echo e($type_name); ?></span>
                        </div>
                    <?php endif; ?>
					   <?php
                    $typesec = get_term_by('id', $post->home_typesec);
                    $type_namesec = $type ? get_translate($typesec->term_title) : '';
                    ?>
                    <?php if(!empty($type_namesec)): ?>
                        <div class="item">
                            <h4><?php echo e(__('Typesec:')); ?></h4>
                            <span><?php echo e($type_namesec); ?></span>
                        </div>
                    <?php endif; ?>
					
			
                </div>
                <h2 class="heading mt-3 mb-3"><?php echo e(__('Description')); ?></h2>
                <div class="descbox"><?php echo balanceTags(get_translate($post->post_description)); ?></div>
				<hr>
				<h2 class="heading mt-3 mb-3"><?php echo e(__('Detail')); ?></h2>
                <div class="stripsbox"><?php echo balanceTags(get_translate($post->post_content)); ?></div>
                <?php
                $amenities = $post->tax_home_amenity;
                ?>
				<hr>
				<h2 class="heading mt-3 mb-3"><?php echo e(__('Additional detail')); ?></h2>
				<div class="row">
				 <div class="col-sm">
				 <div class="amenity-item">
                <p class="location stripsbox">
                        <i class="ti-info-alt"></i>
                        <?php echo e(__('Home_id')); ?>: <strong><?php echo $post->post_id  ?></strong>
                    </p>
					</div></div>
                <?php
                $rate = $post->review_count;
                ?>
               
                           
							<div class="col-sm">
                            <p class="location stripsbox"><?php echo e(__('Price')); ?>: 
                            <?php if($post->booking_type != 'external_link'): ?>
                                <span class="highview"><?php echo e(convert_price($post->base_price)); ?>/<?php echo e($post->unit); ?></span>
                            <?php endif; ?>
                        </div>
                 <?php if($rate): ?>
					<div class="col-sm">
				 <div class="amenity-item">
                    <p class="location stripsbox">
                        <?php echo e(_n("[0::%s reviews][1::%s review][2::%s reviews]", $rate)); ?>

                        <?php echo star_rating_render($post->rating); ?>

                   </p>
					  </div></div><?php endif; ?></div>
                <?php if(!empty($amenities) && is_object($amenities)): ?>
                    <h2 class="heading mt-3 mb-3"><?php echo e(__('Amenities')); ?></h2>
                    <div class="amenities row">
                        <?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-6 col-sm-4 col-lg-3">
                                <div class="amenity-item" data-toggle="ots-tooltip"
                                     data-title="<?php echo e(get_translate($amenity->term_description)); ?>">
                                    <?php if(!$amenity->term_icon): ?>
                                        <i class="fe-check"></i>
                                    <?php else: ?>
                                        <?php echo get_icon($amenity->term_icon, '#2a2a2a', '#2a2a2a', '30px', ''); ?>

                                    <?php endif; ?>
                                    <span class="title"><?php echo e(get_translate($amenity->term_title)); ?></span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <h2 class="heading mt-3 mb-3"><?php echo e(__('Policies')); ?></h2>
                <?php
                $checkIn = $post->checkin_time;
                $checkOut = $post->checkout_time;
                $enableCancellation = $post->enable_cancellation;
                $cancelBeforeDay = (int)$post->cancel_before;
                $cancellationDetail = $post->cancellation_detail;
                ?>

                <?php if($checkIn): ?>
                    <div class="item d-inline-block mr-4 mb-3 stripsbox">
                        <span class="font-weight-bold"><i class=" ti-time mr-1"></i><?php echo e(__('Check-in Time:')); ?></span>
                        <span class="ml-2" style="color:green"><?php echo e($checkIn); ?></span>
                    </div>
                <?php endif; ?>
                <?php if($checkOut): ?>
                    <div class="item d-inline-block mr-4 mb-3 stripsbox">
                        <span class="font-weight-bold"><i class=" ti-time mr-1"></i><?php echo e(__('Check-out Time:')); ?></span>
                        <span class="ml-2"style="color:red"><?php echo e($checkOut); ?></span>
                    </div>
                <?php endif; ?>
               
                <?php if($enableCancellation == 'on'): ?>
                    <div class="item d-inline-block mr-4 mb-3 stripsbox">
                        <span class="font-weight-bold"><?php echo e(__('Cancellation:')); ?></span>
                        <span class="ml-2 small-info bg-success"><?php echo e(__('enable')); ?></span>
                        <span class="d-inline-block ml-1"><?php echo e(sprintf(__('before %s day(s)'), $cancelBeforeDay)); ?></span>
                    </div>
                    <?php if(get_translate($cancellationDetail)): ?>
                        <div class="w-100"><?php echo balanceTags(get_translate($cancellationDetail)); ?></div>
                    <?php endif; ?>
                <?php endif; ?>
                <h2 class="heading mt-3 mb-3"><?php echo e(__('Availability')); ?></h2>
                <div class="hh-availability-wrapper">
                    <div class="hh-availability stripsbox">
                        <input type="hidden" class="calendar_input"
                               data-id="<?php echo e($post->post_id); ?>"
                               data-encrypt="<?php echo e(hh_encrypt($post->post_id)); ?>"
                               data-action="<?php echo e(url('get-inventory-home')); ?>"
                               data-date-format="<?php echo e(hh_date_format_moment()); ?>">
                    </div>
                </div>
                <?php if($post->video): ?>
                    <h2 class="heading mt-3 mb-3"><?php echo e(__('Video')); ?></h2>
                    <div class="video-wrapper stripsbox">
                        <?php echo balanceTags(get_video_embed_url(get_translate($post->video))); ?>

                    </div>
                <?php endif; ?>
                <h2 class="heading mt-3 mb-3"><?php echo e(__('On Map')); ?></h2>
				<div class="stripsbox">
                <?php
                $lat = $post->location_lat;
                $lng = $post->location_lng;
                $zoom = $post->location_zoom;

                enqueue_style('mapbox-gl-css');
                enqueue_style('mapbox-gl-geocoder-css');
                enqueue_script('mapbox-gl-js');
                enqueue_script('mapbox-gl-geocoder-js');
                ?>
                <div class="hh-mapbox-single" data-lat="<?php echo e($lat); ?>"
                     data-lng="<?php echo e($lng); ?>" data-zoom="<?php echo e($zoom); ?>"></div>
                <?php
                $author = get_user_by_id($post->author);
                $address = $author->address;
                $location = $author->location;
                $country = get_country_by_code($location);
                $description = $author->description;
                ?>
				</div>
				<hr>
				 <?php if($post->location_address): ?>
                    <p class="location stripsbox">
                        <i class="ti-location-pin"></i>
                       Indirizzo: <?php echo e(get_translate($post->location_address)); ?><a class="btn pulsantemappa" href="http://maps.google.com/maps/place/<?php echo get_translate($post->location_address) ?>" role="button" target="_blank">Apri su google Maps</a>
                    </p>
                <?php endif; ?>

                <div class="w-100 mt-3"></div>
                
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-3 col-sidebar">
                <?php
                enqueue_style('daterangepicker-css');
                enqueue_script('daterangepicker-js');
                enqueue_script('daterangepicker-lang-js');
                ?>
                <?php
                $booking_form = $post->booking_form;
                $text_external_link = $post->text_external_link;
                $external_link = $post->use_external_link;
                ?>
                <div id="form-book-home" class="form-book"
                     data-real-price="<?php echo e(url('get-home-price-realtime')); ?>">
                    <div class="popup-booking-form-close"><?php echo get_icon('001_close', '#FFFFFF', '28px', '28px'); ?></div>
                 
                    <div class="form-body relative shadow">
                        <?php echo $__env->make('common.loading', ['class' => 'booking-loading'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php if($booking_form == 'instant_enquiry'): ?>
                            <ul class="nav nav-tabs nav-bordered row">
                                <li class="nav-item nav-item-booking-form-instant col">
                                    <a href="#booking-form-instant"
                                       data-toggle="tab"
                                       aria-expanded="false"
                                       class="nav-link <?php if($booking_form == 'instant_enquiry' ||$booking_form == 'instant'): ?> active <?php endif; ?>">
                                        <?php if($post->booking_type == 'external_link'): ?>
                                            <?php echo e(__('External')); ?>

                                        <?php else: ?>
                                            <?php echo e(__('Instant')); ?>

                                        <?php endif; ?>
                                    </a>
                                </li>
                                <li class="nav-item nav-item-booking-form-instant col">
                                    <a href="#booking-form-enquiry"
                                       data-toggle="tab"
                                       aria-expanded="false"
                                       class="nav-link <?php if($booking_form == 'enquiry'): ?> active <?php endif; ?>">
                                        <?php echo e(__('Enquiry')); ?>

                                    </a>
                                </li>
                            </ul>
                        <?php endif; ?>
                        <?php if($booking_form == 'instant_enquiry'): ?>
                            <div class="tab-content">
                                <?php endif; ?>
                                <?php if($booking_form == 'instant_enquiry' || $booking_form == 'instant'): ?>
                                    <div
                                        class="tab-pane <?php if($booking_form == 'instant_enquiry' ||$booking_form == 'instant'): ?> active <?php endif; ?>"
                                        id="booking-form-instant">
                                        <?php if($post->booking_type == 'external_link'): ?>
                                            <?php echo $__env->make('frontend.home.external-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php else: ?>
                                            <?php echo $__env->make('frontend.home.booking-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if($booking_form == 'instant_enquiry' || $booking_form == 'enquiry'): ?>
                                    <div class="tab-pane <?php if($booking_form == 'enquiry'): ?> active <?php endif; ?>"
                                         id="booking-form-enquiry">
                                        <form action="<?php echo e(url('home-send-enquiry-form')); ?>" data-google-captcha="yes"
                                              data-validation-id="form-send-enquiry"
                                              class="form-action form-sm has-reset" data-loading-from=".form-body">
                                            <div class="form-group">
                                                <label for="full-name-enquiry-form"><?php echo e(__('Full Name')); ?> <span
                                                        class="text-danger">*</span></label>
                                                <input id="full-name-enquiry-form" type="text" name="name"
                                                       class="form-control has-validation" data-validation="required">
                                            </div>
                                            <div class="form-group">
                                                <label for="email-enquiry-form"><?php echo e(__('Email')); ?> <span
                                                        class="text-danger">*</span></label>
                                                <input id="email-enquiry-form" type="email" name="email"
                                                       class="form-control has-validation"
                                                       data-validation="required|email">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-enquiry-form"><?php echo e(__('Message')); ?> <span
                                                        class="text-danger">*</span></label>
                                                <textarea id="message-enquiry-form" class="form-control has-validation"
                                                          name="message" data-validation="required"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary btn-block text-uppercase"
                                                       name="sm"
                                                       value="<?php echo e(__('Send a Request')); ?>">
                                            </div>
                                            <input type="hidden" name="post_id" value="<?php echo e($post->post_id); ?>">
                                            <input type="hidden" name="post_encrypt"
                                                   value="<?php echo e(hh_encrypt($post->post_id)); ?>">
                                            <div class="form-message"></div>
                                        </form>
                                    </div>
                                <?php endif; ?>
                                <?php if($booking_form == 'instant_enquiry'): ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $lat = $post->location_lat;
        $lng = $post->location_lng;
        $list_services = \App\Controllers\Services\HomeController::get_inst()->listOfHomes([
            'number' => 4,
            'location' => [
                'lat' => $lat,
                'lng' => $lng,
                'radius' => 25
            ],
            'orderby' => 'distance',
            'order' => 'asc',
            'not_in' => [$post->post_id]
        ]);
        ?>
        <?php if(count($list_services['results'])): ?>
            <h2 class="heading mt-3 mb-3"><?php echo e(__('Homes Near By')); ?></h2>
            <div class="hh-list-of-services stripsbox">
                <div class="row">
                    <?php $__currentLoopData = $list_services['results']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12 col-md-6 col-lg-3">
                            <?php echo $__env->make('frontend.home.loop.grid', ['item' => $item, 'show_distance' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if(enable_review()): ?>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-content">
                    <?php echo $__env->make('frontend.home.review', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="mobile-book-action">
        <div class="container">
            <div class="action-inner">
                <div class="action-price-wrapper">
                    <span class="price"><?php echo e(convert_price($post->base_price)); ?></span>
                    <span class="unit">/<?php echo e($post->unit); ?></span>
                </div>
                <a class="btn btn-primary action-button" id="mobile-check-availability"><?php echo e(__('Check Availability')); ?></a>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('frontend.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/salentovacanze/public_html/app/Views/frontend/home/default.blade.php ENDPATH**/ ?>