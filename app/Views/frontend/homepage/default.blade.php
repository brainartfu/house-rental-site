@include('frontend.components.header')
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
    @if(!empty($tab_services))
        <div class="hh-search-form-wrapper">
            <div class="ots-slider-wrapper" data-style="full-screen" data-slider="ots-slider">
                <div class="ots-slider">
                    <?php
                    $sliders = get_option('home_slider');
                    $sliders = explode(',', $sliders);
                    ?>
                    @if(!empty($sliders) && is_array($sliders))
                        @foreach($sliders as $id)
                            <?php
                            $url = get_attachment_url($id);
                            ?>
                            <div class="item">
                                <div class="outer has-background-image" data-src="{{ $url }}"
                                     style="background-image: url('{{ $url }}')">	<div class="contento">
		<h2>Salento Vacanze Affitti</h2>
		<h2>Salento Vacanze Affitti</h2>
	</div></div>
                                <div class="inner">
                                    <div class="img has-background-image" data-src="{{ $url }}"
                                         style="background-image: url('{{ $url }}');"></div>
                                </div>
                            </div>
                        @endforeach
                    @endif
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

@keyframes animate {
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
                        @if(!empty($tab_services))
                            <div class="nav-wrapper relative" data-tabs-calculation>
                               <!-- <ul class="nav nav-tabs" data-tabs>
                                    @foreach($tab_services as $key => $item)
                                        <li class="nav-item">
                                            <a href="#tab-search-{{$item['id']}}" data-toggle="tab"
                                               aria-expanded="false" data-tabs-item
                                               class="nav-link {{$key == 0 ? 'active' : ''}}">
                                                {{ get_translate($item['label']) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>-->
                            </div>
                            <div class="tab-content  @if(count($tab_services) == 1) pt-0 @endif">
                                @foreach($tab_services as $key => $item)
                                    <div class="tab-pane {{$key == 0 ? 'active' : ''}}" id="tab-search-{{$item['id']}}">
                                        <?php
                                        start_get_view();
                                        if(View::exists('frontend.' . $item['id'] . '.search.search-form')){
                                        ?>
                                        @include('frontend.'. $item['id'] .'.search.search-form')
                                        <?php }
                                        $content = end_get_view();
                                        echo apply_filters('hh_tab_services_html', $content, $item);
                                        ?>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
	
    <div class="container">
        <!-- SFOGLIA PER TIPOLOGIA -->
        <?php
        $home_types = get_terms('home-type', true);
        ?>
        @if(count($home_types) > 0)
            <h2 class="h3 mt-4">{{__('Find a Home type')}}</h2>
            <div class="hh-list-terms mt-3">
                @if(count($home_types))
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
                         data-responsive="{{ base64_encode(json_encode($responsive)) }}" data-margin="15" data-loop="0">
                        <div class="owl-carousel">
                            @foreach($home_types as $item)
                                <?php
                                $url = get_attachment_url($item->term_image, [350, 300]);
                                ?>
                                <div class="item">
                                    <div class="hh-term-item">
                                        <a href="{{ get_home_search_page('?home-type=' . $item->term_id) }}">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="thumbnail has-matchHeight">
                                                        <div class="thumbnail-outer">
                                                            <div class="thumbnail-inner">
                                                                <img src="{{ $url }}"
                                                                     alt="{{ get_attachment_alt($item->term_image ) }}"
                                                                     class="img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 d-flex align-items-center">
                                                    <div class="clearfix">
                                                        <h5>{{ get_translate($item->term_title) }}</h5>
                                                        <?php
                                                        $home_count = count_home_in_home_type($item->term_id);
                                                        ?>
                                                        <p class="text-muted">{{ _n("[0::%s Homes][1::%s Home][2::%s Homes]", $home_count) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="owl-nav">
                            <a href="javascript:void(0)"
                               class="prev"><i class="ti-angle-left"></i></a>
                            <a href="javascript:void(0)"
                               class="next"><i class="ti-angle-right"></i></a>
                        </div>
                    </div>
                @endif
            </div>
        @endif
		<!--CASE IN EVIDENZA -->
        @if(is_enable_service('home'))
            <?php
            $list_services = \App\Controllers\Services\HomeController::get_inst()->listOfHomes([
                'number' => 4,
                'is_featured' => 'on'
            ]);
            ?>
            @if(count($list_services['results']))
                <h2 class="h3 mt-4">{{__('Featured Homes')}}</h2>
                <p>{{__('Browse beautiful places to stay with all the comforts of home, plus more')}}</p>
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
                         data-responsive="{{ base64_encode(json_encode($responsive)) }}" data-margin="15" data-loop="0">
                        <div class="owl-carousel">
                            @foreach($list_services['results'] as $item)
                                <div class="item">
                                    @include('frontend.home.loop.grid', ['item' => $item])
                                </div>
                            @endforeach
                        </div>
                        <div class="owl-nav">
                            <a href="javascript:void(0)"
                               class="prev"><i class="ti-angle-left"></i></a>
                            <a href="javascript:void(0)"
                               class="next"><i class="ti-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            @endif
        @endif
  
    <!-- Case Gallipoli -->
        @if(is_enable_service('home'))
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
            @if(count($list_services['results']))
                <h2 class="h3 mt-4">{{__('Homes in Gallipoli')}}</h2>
                <p>{{__('Browse beautiful places to stay with all the comforts of home, plus more')}}</p>
                <div class="hh-list-of-services">
                    <div class="row">
                        @foreach($list_services['results'] as $item)
                            <div class="col-12 col-md-6 col-lg-3">
                                @include('frontend.home.loop.grid', ['item' => $item])
                            </div>
                        @endforeach
                    </div>
                </div></div>
            @endif
        @endif
		 <!-- Location -->
       
               
                
                                @include('frontend.home.loop.location', ['item' => $item])
                           
 
    <!-- Destination -->
        <?php
        $locations = get_option('top_destination');
        ?>
        @if(!empty($locations))
			<div class="container">
            <h2 class="h3 mt-4">{{__('Top destinations')}}</h2>
            <p>{{__('Browse beautiful places to stay with all the comforts of home, plus more')}}</p>
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
                     data-responsive="{{ base64_encode(json_encode($responsive)) }}" data-margin="15" data-loop="0">
                    <div class="owl-carousel">
                        @foreach($locations as $location)
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
                                    <a href="{{ $location_url }}">
                                        <div class="thumbnail has-matchHeight">
                                            <div class="thumbnail-outer">
                                                <div class="thumbnail-inner">
                                                    <img src="{{ get_attachment_url($location['image']) }}"
                                                         alt="{{ get_attachment_alt($location['image'] ) }}"
                                                         class="img-fluid">
                                                </div>
                                            </div>
                                            <div class="detail">
                                                <h2 class="text-center des-paterm-{{$rand}}">{{ $address }}</h2><hr>
												<h4 class="shadowtr text-shadow text-center text-light des-paterm-{{$rand}}">{{ $address2 }}</h4>
                                                @if(count($services) > 1)
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

                                                        <div class="item item-{{$service}}">
                                                            <a href="{{$location_url}}">
                                                                <span class="count">{{$list_services['total']}}</span>
                                                                <span
                                                                    class="service">{{__($service_info['names'])}}</span>
                                                            </a>
                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="owl-nav">
                        <a href="javascript:void(0)"
                           class="prev"><i class="ti-angle-left"></i></a>
                        <a href="javascript:void(0)"
                           class="next"><i class="ti-angle-right"></i></a>
                    </div>
                </div>
            </div>
        @endif
    
   
    </div></div>

    <!-- Call to action -->
    <?php
    $page_id = get_option('call_to_action_page');
    $cta_background_id = get_option('call_to_action_background', '');
    ?>
    @if(!empty($page_id))
        <?php
        $link = get_permalink_by_id($page_id, 'page');
        $cta_background_url = '';
        $cta_background_url = get_attachment_url($cta_background_id, 'full');
        ?>
        <div class="container mt-4">
            <div class="call-to-action pl-4 pr-4 has-background-image" data-src="{{ $cta_background_url }}"
                 style="background-image: url('{{$cta_background_url}}')">
                <div class="row">
                    <div class="col-lg-8">
                        <h5 class="main-text">{{__('The most exciting trip this summer')}}</h5>
                        <p class="sub-text">{{__('Enjoy moments at the beach Maldives with friends')}}</p>
                    </div>
                    <div class="col-lg-4">
                        <a href="{{ $link }}" class="btn btn-primary right">{{__('Watch now')}}</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
	    <?php
    $testimonial_bgr = get_option('testimonial_background', '#dd556a');
    ?>
	<div class="section section-background pt-5 pb-5 mt-4" style="background-color: {{$testimonial_bgr}};">
            <div class="container">
                <h2 class="h3 mt-0 text-center c-white">{{__('Say about Us')}}</h2></div>
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
    @if(count($testimonials))
        <div class="section section-background pt-5 pb-5 mt-4" style="background-color: {{$testimonial_bgr}};">
            <div class="container">
                <h2 class="h3 mt-0 c-white">{{__('Say about Us')}}</h2>

                <div class="hh-testimonials">
                    <div class="hh-carousel carousel-padding nav-style2"
                         data-responsive="{{ base64_encode(json_encode($responsive)) }}" data-margin="30" data-loop="0">
                        <div class="owl-carousel">
                            @foreach($testimonials as $testimonial)
                                <div class="item">
                                    <div class="testimonial-item">
                                        <div class="testimonial-inner">
                                            <h4>
                                                {{ get_translate($testimonial['author_name']) }}
                                            </h4>
                                            <div class="author-rate">
                                                @include('frontend.components.star', ['rate' => (int) $testimonial['author_rate']])
                                            </div>
                                            <div class="author-comment">
                                                {{ Str::limit(get_translate($testimonial['author_comment'],140)) }}
                                            </div>
                                           
                                            @if($testimonial['date'])
                                                <div
                                                    class="author-date">{{sprintf(__('on %s'), date(hh_date_format(), strtotime($testimonial['date'])))}}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
@endif
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
        @if(count($list_services['results']))
            <h2 class="h3 mt-4 mb-3">{{__('The latest from Blog')}}</h2>
            <div class="hh-list-of-blog">
                <div class="row">
                    @foreach($list_services['results'] as $item)
                        <div class="col-12 col-md-6">
                            <div class="hh-blog-item style-2">
                                <a href="{{ get_the_permalink($item->post_id, $item->post_slug, 'post') }}">
                                    <div class="thumbnail">
                                        <div class="thumbnail-outer">
                                            <div class="thumbnail-inner">
                                                <img src="{{ get_attachment_url($item->thumbnail_id, 'full') }}"
                                                     alt="{{ get_attachment_alt($item->thumbnail_id ) }}"
                                                     class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="category">{{__('Action')}}
                                    <div class="date">{{ date(hh_date_format(), $item->created_at) }}</div>
                                </div>
                                <h2 class="title"><a
                                        href="{{ get_the_permalink($item->post_id, $item->post_slug, 'post') }}">{{ get_translate($item->post_title) }}</a>
                                </h2>
                                <div
                                    class="description">{!! balanceTags(short_content(get_translate($item->post_content), 55)) !!}</div>
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
                                    @include('frontend.components.share', ['share' => $share])
                                    <a href="{{ get_the_permalink($item->post_id, $item->post_slug, 'post') }}"
                                       class="read-more">{{__('Keep Reading')}} {!! balanceTags(get_icon('002_right_arrow', '#F8546D', '12px', '')) !!}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@include('frontend.components.newsletter')
@include('frontend.components.footer')
