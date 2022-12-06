<?php echo $__env->make('frontend.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
enqueue_style('home-slider');
enqueue_script('home-slider');

enqueue_style('mapbox-gl-css');
enqueue_style('mapbox-gl-geocoder-css');
enqueue_script('mapbox-gl-js');
enqueue_script('mapbox-gl-geocoder-js');

enqueue_style('daterangepicker-css');
enqueue_script('daterangepicker-js');
enqueue_script('daterangepicker-lang-js');

enqueue_style('iconrange-slider');
enqueue_script('iconrange-slider');

enqueue_script('owl-carousel');
enqueue_style('owl-carousel');
enqueue_style('owl-carousel-theme');

$tab_services = list_tabs_services_sorted();
?>
<div class="home-page pb-5">
    <?php if(!empty($tab_services)): ?>
        <div class="hh-search-form-wrapper">
            <div class="ots-slider-wrapper" data-style="full-screen" data-slider="ots-slider">
                <div class="ots-slider">
                    <?php
                    $sliders = get_option('home_slider');
                    $sliders = explode(',', $sliders);
                    ?>
                    <?php if(!empty($sliders) && is_array($sliders)): ?>
                        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $url = get_attachment_url($id);
                            ?>
                            <div class="item">
                                <div class="outer has-background-image" data-src="<?php echo e($url); ?>"
                                     style="background-image: url('<?php echo e($url); ?>')">	<div class="contento">
		<h2>Salento Vacanze Affitti</h2>
		<h2>Salento Vacanze Affitti</h2>
	</div></div>
                                <div class="inner">
                                    <div class="img has-background-image" data-src="<?php echo e($url); ?>"
                                         style="background-image: url('<?php echo e($url); ?>');"></div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
			<style>
			.contento {
	
}

.contento h2 {
	color: #fff;
	font-size: 5em;
	position: absolute;
	transform: translate(-50%, -50%);
	top: 50%;
    left: 50%;
}

.contento h2:nth-child(1) {
	color: transparent;
	-webkit-text-stroke: 2px #fff;
}

.contento h2:nth-child(2) {
	color: #729add;
	animation: animate 4s ease-in-out infinite;
}

@keyframes  animate {
	0%,
	100% {
		clip-path: polygon(
			0% 45%,
			16% 44%,
			33% 50%,
			54% 60%,
			70% 61%,
			84% 59%,
			100% 52%,
			100% 100%,
			0% 100%
		);
	}

	50% {
		clip-path: polygon(
			0% 60%,
			15% 65%,
			34% 66%,
			51% 62%,
			67% 50%,
			84% 45%,
			100% 46%,
			100% 100%,
			0% 100%
		);
	}
}

</style>
			<!--VIDEO
<video autoplay muted loop id="myVideo" style="    position: absolute;
    right: 0;
    top: 0px;
    min-width: 100%;
    min-height: 100%;">
  <source src="/public/images/spiaggi2a.mp4" type="video/mp4">
</video>

<!-- VIDEO-->

		
            <div class="hh-search-form-section">
                <div class="container">
                    <div class="hh-search-form">
                        <?php if(!empty($tab_services)): ?>
                            <div class="nav-wrapper relative" data-tabs-calculation>
                               <!-- <ul class="nav nav-tabs" data-tabs>
                                    <?php $__currentLoopData = $tab_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="nav-item">
                                            <a href="#tab-search-<?php echo e($item['id']); ?>" data-toggle="tab"
                                               aria-expanded="false" data-tabs-item
                                               class="nav-link <?php echo e($key == 0 ? 'active' : ''); ?>">
                                                <?php echo e(get_translate($item['label'])); ?>

                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>-->
                            </div>
                            <div class="tab-content  <?php if(count($tab_services) == 1): ?> pt-0 <?php endif; ?>">
                                <?php $__currentLoopData = $tab_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="tab-pane <?php echo e($key == 0 ? 'active' : ''); ?>" id="tab-search-<?php echo e($item['id']); ?>">
                                        <?php
                                        start_get_view();
                                        if(View::exists('frontend.' . $item['id'] . '.search.search-form')){
                                        ?>
                                        <?php echo $__env->make('frontend.'. $item['id'] .'.search.search-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php }
                                        $content = end_get_view();
                                        echo apply_filters('hh_tab_services_html', $content, $item);
                                        ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
	
    <div class="container">
        <!-- SFOGLIA PER TIPOLOGIA -->
        <?php
        $home_types = get_terms('home-type', true);
        ?>
        <?php if(count($home_types) > 0): ?>
            <h2 class="h3 mt-4"><?php echo e(__('Find a Home type')); ?></h2>
            <div class="hh-list-terms mt-3">
                <?php if(count($home_types)): ?>
                    <?php
                    $responsive = [
                        0 => [
                            'items' => 1
                        ],
                        768 => [
                            'items' => 2
                        ],
                        992 => [
                            'items' => 3
                        ],
                        1200 => [
                            'items' => 4
                        ]
                    ];
                    ?>
                    <div class="hh-carousel carousel-padding nav-style2"
                         data-responsive="<?php echo e(base64_encode(json_encode($responsive))); ?>" data-margin="15" data-loop="0">
                        <div class="owl-carousel">
                            <?php $__currentLoopData = $home_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $url = get_attachment_url($item->term_image, [350, 300]);
                                ?>
                                <div class="item">
                                    <div class="hh-term-item">
                                        <a href="<?php echo e(get_home_search_page('?home-type=' . $item->term_id)); ?>">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="thumbnail has-matchHeight">
                                                        <div class="thumbnail-outer">
                                                            <div class="thumbnail-inner">
                                                                <img src="<?php echo e($url); ?>"
                                                                     alt="<?php echo e(get_attachment_alt($item->term_image )); ?>"
                                                                     class="img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 d-flex align-items-center">
                                                    <div class="clearfix">
                                                        <h5><?php echo e(get_translate($item->term_title)); ?></h5>
                                                        <?php
                                                        $home_count = count_home_in_home_type($item->term_id);
                                                        ?>
                                                        <p class="text-muted"><?php echo e(_n("[0::%s Homes][1::%s Home][2::%s Homes]", $home_count)); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="owl-nav">
                            <a href="javascript:void(0)"
                               class="prev"><i class="ti-angle-left"></i></a>
                            <a href="javascript:void(0)"
                               class="next"><i class="ti-angle-right"></i></a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
		<!--CASE IN EVIDENZA -->
        <?php if(is_enable_service('home')): ?>
            <?php
            $list_services = \App\Controllers\Services\HomeController::get_inst()->listOfHomes([
                'number' => 4,
                'is_featured' => 'on'
            ]);
            ?>
            <?php if(count($list_services['results'])): ?>
                <h2 class="h3 mt-4"><?php echo e(__('Featured Homes')); ?></h2>
                <p><?php echo e(__('Browse beautiful places to stay with all the comforts of home, plus more')); ?></p>
                <div class="hh-list-of-services">
                    <?php
                    $responsive = [
                        0 => [
                            'items' => 1
                        ],
                        768 => [
                            'items' => 2
                        ],
                        992 => [
                            'items' => 3
                        ],
                        1200 => [
                            'items' => 4
                        ],
                    ];
                    ?>
                    <div class="hh-carousel carousel-padding nav-style2"
                         data-responsive="<?php echo e(base64_encode(json_encode($responsive))); ?>" data-margin="15" data-loop="0">
                        <div class="owl-carousel">
                            <?php $__currentLoopData = $list_services['results']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item">
                                    <?php echo $__env->make('frontend.home.loop.grid', ['item' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="owl-nav">
                            <a href="javascript:void(0)"
                               class="prev"><i class="ti-angle-left"></i></a>
                            <a href="javascript:void(0)"
                               class="next"><i class="ti-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
  
    <!-- Case Gallipoli -->
        <?php if(is_enable_service('home')): ?>
            <?php
            $list_services = \App\Controllers\Services\HomeController::get_inst()->listOfHomes([
                'number' => 8,
                'location' => [
                    'lat' => '40.056252',
                    'lng' => '17.978840',
                    'radius' => 10
                ]
            ]);
            ?>
            <?php if(count($list_services['results'])): ?>
                <h2 class="h3 mt-4"><?php echo e(__('Homes in Gallipoli')); ?></h2>
                <p><?php echo e(__('Browse beautiful places to stay with all the comforts of home, plus more')); ?></p>
                <div class="hh-list-of-services">
                    <div class="row">
                        <?php $__currentLoopData = $list_services['results']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-12 col-md-6 col-lg-3">
                                <?php echo $__env->make('frontend.home.loop.grid', ['item' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div></div>
            <?php endif; ?>
        <?php endif; ?>
		 <!-- Location -->
       
               
                
                                <?php echo $__env->make('frontend.home.loop.location', ['item' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                           
 
    <!-- Destination -->
        <?php
        $locations = get_option('top_destination');
        ?>
        <?php if(!empty($locations)): ?>
			<div class="container">
            <h2 class="h3 mt-4"><?php echo e(__('Top destinations')); ?></h2>
            <p><?php echo e(__('Browse beautiful places to stay with all the comforts of home, plus more')); ?></p>
            <div class="hh-list-destinations">
                <?php
                $responsive = [
                    0 => [
                        'items' => 1
                    ],
                    768 => [
                        'items' => 2
                    ],
                    992 => [
                        'items' => 4
                    ],
                ];
                ?>
                <div class="hh-carousel carousel-padding nav-style2"
                     data-responsive="<?php echo e(base64_encode(json_encode($responsive))); ?>" data-margin="15" data-loop="0">
                    <div class="owl-carousel">
                        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $lat = $location['lat'];
                            $lng = $location['lng'];
                            $address = get_translate($location['name']);
							$address2 = get_translate($location['description']);
                            if (isset($location['service']) && !empty($location['service'])) {
                                $services = explode(',', $location['service']);
                            } else {
                                $services = [];
                            }

                            $location_query = [
                                'lat' => $lat,
                                'lng' => $lng,
                                'address' => urlencode($address),
                            ];
                            $location_url = url('/');
                            if (count($services) == 0) {
                                $enable_services = get_enabled_service_keys();
                                if (count($enable_services)) {
                                    $location_url = get_search_page($enable_services[0]);
                                } else {
                                    $location_url = '';
                                }
                            } elseif (count($services) == 1 && is_enable_service($services[0])) {
                                $location_url = get_search_page($services[0]);
                            } elseif (count($services) > 1) {
                                $enable_services = [];
                                foreach ($services as $service) {
                                    if (is_enable_service($service)) {
                                        $enable_services[] = $service;
                                    }
                                }
                                if (count($enable_services)) {
                                    $location_url = get_search_page($enable_services[0]);
                                } else {
                                    $location_url = '';
                                }
                            }
                            if (!empty($location_url)) {
                                $location_url = add_query_arg($location_query, $location_url);
                            } else {
                                $location_url = 'javascript: void(0)';
                            }

                            $rand = rand(1, 6);
                            ?>
                            <div class="item">
                                <div class="hh-destination-item">
                                    <a href="<?php echo e($location_url); ?>">
                                        <div class="thumbnail has-matchHeight">
                                            <div class="thumbnail-outer">
                                                <div class="thumbnail-inner">
                                                    <img src="<?php echo e(get_attachment_url($location['image'])); ?>"
                                                         alt="<?php echo e(get_attachment_alt($location['image'] )); ?>"
                                                         class="img-fluid">
                                                </div>
                                            </div>
                                            <div class="detail">
                                                <h2 class="text-center des-paterm-<?php echo e($rand); ?>"><?php echo e($address); ?></h2><hr>
												<h4 class="shadowtr text-shadow text-center text-light des-paterm-<?php echo e($rand); ?>"><?php echo e($address2); ?></h4>
                                                <?php if(count($services) > 1): ?>
                                                    <div
                                                        class="count-services d-flex align-items-center justify-content-center mt-3">
                                                        <?php
                                                        foreach($services as $service){
                                                        if (!is_enable_service($service)) {
                                                            continue;
                                                        }
                                                        if ($service == 'home') {
                                                            $location_query['bookingType'] = 'per_night';
                                                        }
                                                        $location_url = get_search_page($service);
                                                        $location_url = add_query_arg($location_query, $location_url);
                                                        $radius = get_option($service . '_search_radius', 10);
                                                        $controller = '\\App\\Controllers\\Services\\' . ucfirst($service) . 'Controller';
                                                        $method = 'listOf' . ucfirst($service) . 's';
                                                        $list_services = $controller::get_inst()->$method([
                                                            'location' => [
                                                                'lat' => $lat,
                                                                'lng' => $lng,
                                                                'radius' => $radius
                                                            ],
                                                        ]);
                                                        $service_info = post_type_info($service);
                                                        ?>

                                                        <div class="item item-<?php echo e($service); ?>">
                                                            <a href="<?php echo e($location_url); ?>">
                                                                <span class="count"><?php echo e($list_services['total']); ?></span>
                                                                <span
                                                                    class="service"><?php echo e(__($service_info['names'])); ?></span>
                                                            </a>
                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="owl-nav">
                        <a href="javascript:void(0)"
                           class="prev"><i class="ti-angle-left"></i></a>
                        <a href="javascript:void(0)"
                           class="next"><i class="ti-angle-right"></i></a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    
   
    </div></div>

    <!-- Call to action -->
    <?php
    $page_id = get_option('call_to_action_page');
    $cta_background_id = get_option('call_to_action_background', '');
    ?>
    <?php if(!empty($page_id)): ?>
        <?php
        $link = get_permalink_by_id($page_id, 'page');
        $cta_background_url = '';
        $cta_background_url = get_attachment_url($cta_background_id, 'full');
        ?>
        <div class="container mt-4">
            <div class="call-to-action pl-4 pr-4 has-background-image" data-src="<?php echo e($cta_background_url); ?>"
                 style="background-image: url('<?php echo e($cta_background_url); ?>')">
                <div class="row">
                    <div class="col-lg-8">
                        <h5 class="main-text"><?php echo e(__('The most exciting trip this summer')); ?></h5>
                        <p class="sub-text"><?php echo e(__('Enjoy moments at the beach Maldives with friends')); ?></p>
                    </div>
                    <div class="col-lg-4">
                        <a href="<?php echo e($link); ?>" class="btn btn-primary right"><?php echo e(__('Watch now')); ?></a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
	    <?php
    $testimonial_bgr = get_option('testimonial_background', '#dd556a');
    ?>
	<div class="section section-background pt-5 pb-5 mt-4" style="background-color: <?php echo e($testimonial_bgr); ?>;">
            <div class="container">
                <h2 class="h3 mt-0 text-center c-white"><?php echo e(__('Say about Us')); ?></h2></div>
    <script src="https://widget.trustmary.com/VYHo235X2j"></script>
	
	</div>
    <!-- recensioni 
    <?php
    $testimonials = get_option('testimonial', []);
    $responsive = [
        0 => [
            'items' => 1
        ],
        768 => [
            'items' => 2
        ],
        992 => [
            'items' => 2
        ],
        1200 => [
            'items' => 5
        ],
    ];

    $testimonial_bgr = get_option('testimonial_background', '#dd556a');
    ?>
    <?php if(count($testimonials)): ?>
        <div class="section section-background pt-5 pb-5 mt-4" style="background-color: <?php echo e($testimonial_bgr); ?>;">
            <div class="container">
                <h2 class="h3 mt-0 c-white"><?php echo e(__('Say about Us')); ?></h2>

                <div class="hh-testimonials">
                    <div class="hh-carousel carousel-padding nav-style2"
                         data-responsive="<?php echo e(base64_encode(json_encode($responsive))); ?>" data-margin="30" data-loop="0">
                        <div class="owl-carousel">
                            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item">
                                    <div class="testimonial-item">
                                        <div class="testimonial-inner">
                                            <h4>
                                                <?php echo e(get_translate($testimonial['author_name'])); ?>

                                            </h4>
                                            <div class="author-rate">
                                                <?php echo $__env->make('frontend.components.star', ['rate' => (int) $testimonial['author_rate']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </div>
                                            <div class="author-comment">
                                                <?php echo e(Str::limit(get_translate($testimonial['author_comment'],140))); ?>

                                            </div>
                                           
                                            <?php if($testimonial['date']): ?>
                                                <div
                                                    class="author-date"><?php echo e(sprintf(__('on %s'), date(hh_date_format(), strtotime($testimonial['date'])))); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="owl-nav">
                            <a href="javascript:void(0)"
                               class="prev"><i class="ti-angle-left"></i></a>
                            <a href="javascript:void(0)"
                               class="next"><i class="ti-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php endif; ?>
<!-- Blog -->
    <div class="container">
        <?php
        $list_services = \App\Controllers\PostController::get_inst()->listOfPosts([
            'number' => 3
        ]);
        $responsive = [
            0 => [
                'items' => 1
            ]
        ];
        ?>
        <?php if(count($list_services['results'])): ?>
            <h2 class="h3 mt-4 mb-3"><?php echo e(__('The latest from Blog')); ?></h2>
            <div class="hh-list-of-blog">
                <div class="row">
                    <?php $__currentLoopData = $list_services['results']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12 col-md-6">
                            <div class="hh-blog-item style-2">
                                <a href="<?php echo e(get_the_permalink($item->post_id, $item->post_slug, 'post')); ?>">
                                    <div class="thumbnail">
                                        <div class="thumbnail-outer">
                                            <div class="thumbnail-inner">
                                                <img src="<?php echo e(get_attachment_url($item->thumbnail_id, 'full')); ?>"
                                                     alt="<?php echo e(get_attachment_alt($item->thumbnail_id )); ?>"
                                                     class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="category"><?php echo e(__('Action')); ?>

                                    <div class="date"><?php echo e(date(hh_date_format(), $item->created_at)); ?></div>
                                </div>
                                <h2 class="title"><a
                                        href="<?php echo e(get_the_permalink($item->post_id, $item->post_slug, 'post')); ?>"><?php echo e(get_translate($item->post_title)); ?></a>
                                </h2>
                                <div
                                    class="description"><?php echo balanceTags(short_content(get_translate($item->post_content), 55)); ?></div>
                                <div class="w-100 mt-2"></div>
                                <div class="d-flex justify-content-between">
                                    <?php
                                    $url = get_the_permalink($item->post_id, $item->post_slug, 'post');
                                    $img = get_attachment_url($item->thumbnail_id);
                                    $desc = get_translate($item->post_title);

                                    $share = [
                                        'facebook' => [
                                            'url' => $url
                                        ],
                                        'twitter' => [
                                            'url' => $url
                                        ],
                                        'pinterest' => [
                                            'url' => $url,
                                            'img' => $img,
                                            'description' => $desc
                                        ]
                                    ];
                                    ?>
                                    <?php echo $__env->make('frontend.components.share', ['share' => $share], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <a href="<?php echo e(get_the_permalink($item->post_id, $item->post_slug, 'post')); ?>"
                                       class="read-more"><?php echo e(__('Keep Reading')); ?> <?php echo balanceTags(get_icon('002_right_arrow', '#F8546D', '12px', '')); ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php echo $__env->make('frontend.components.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('frontend.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp7\htdocs\app\Views/frontend/homepage/default.blade.php ENDPATH**/ ?>