@include('frontend.components.header')
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
    <div class="hh-gallery hh-thumbnail has-background-image" data-src="{{ $thumbnailUrl }}"
         style="background-image: url({{ $thumbnailUrl }})">
        <div class="controls">
            <a href="javascript: void(0);" class="view-gallery item-link"><span>{{__('View Photos')}}</span> <i
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
                @include('frontend.components.breadcrumb', ['currentPage' => get_translate($post->post_title)])
				@if($post->is_featured == 'on')
                        <span class="is-featured">{{ get_option('featured_text', __('Featured')) }}</span>
                    @endif
                <h1 class="title mt-3 stripsbox">
				
                    {{ get_translate($post->post_title) }}
                    
                </h1>
                <div class="featured-amenities mt-2 mb-2">
                    <div class="item">
                        <h4>{{__('Guests:')}}</h4>
                        <span> {{ $post->number_of_guest }} </span>
                    </div>
                    <div class="item">
                        <h4>{{__('Bedrooms:')}}</h4>
                        <span>{{ $post->number_of_bedrooms }}</span>
                    </div>
                    <div class="item">
                        <h4>{{__('Bathrooms:')}}</h4>
                        <span>{{ $post->number_of_bathrooms }}</span>
                    </div>
                    <div class="item">
                        <h4>{{__('Footage:')}}</h4>
                        <span>{{ $post->size }} {{ get_option('unit_of_measure', 'm2') }}</span>
                    </div>
                    <?php
                    $type = get_term_by('id', $post->home_type);
                    $type_name = $type ? get_translate($type->term_title) : '';
                    ?>
                    @if(!empty($type_name))
                        <div class="item">
                            <h4>{{__('Type:')}}</h4>
                            <span>{{ $type_name }}</span>
                        </div>
                    @endif
					   <?php
                    $typesec = get_term_by('id', $post->home_typesec);
                    $type_namesec = $type ? get_translate($typesec->term_title) : '';
                    ?>
                    @if(!empty($type_namesec))
                        <div class="item">
                            <h4>{{__('Typesec:')}}</h4>
                            <span>{{ $type_namesec }}</span>
                        </div>
                    @endif
					
			
                </div>
                <h2 class="heading mt-3 mb-3">{{__('Description')}}</h2>
                <div class="descbox">{!! balanceTags(get_translate($post->post_description)) !!}</div>
				<hr>
				<h2 class="heading mt-3 mb-3">{{__('Detail')}}</h2>
                <div class="stripsbox">{!! balanceTags(get_translate($post->post_content)) !!}</div>
                <?php
                $amenities = $post->tax_home_amenity;
                ?>
				<hr>
				<h2 class="heading mt-3 mb-3">{{__('Additional detail')}}</h2>
				<div class="row">
				 <div class="col-sm">
				 <div class="amenity-item">
                <p class="location stripsbox">
                        <i class="ti-info-alt"></i>
                        {{__('Home_id')}}: <strong><?php echo $post->post_id  ?></strong>
                    </p>
					</div></div>
                <?php
                $rate = $post->review_count;
                ?>
               
                           
							<div class="col-sm">
                            <p class="location stripsbox">{{__('Price')}}: 
                            @if($post->booking_type != 'external_link')
                                <span class="highview">{{ convert_price($post->base_price) }}/{{$post->unit}}</span>
                            @endif
                        </div>
                 @if ($rate)
					<div class="col-sm">
				 <div class="amenity-item">
                    <p class="location stripsbox">
                        {{ _n("[0::%s reviews][1::%s review][2::%s reviews]", $rate) }}
                        {!! star_rating_render($post->rating) !!}
                   </p>
					  </div></div>@endif</div>
                @if (!empty($amenities) && is_object($amenities))
                    <h2 class="heading mt-3 mb-3">{{__('Amenities')}}</h2>
                    <div class="amenities row">
                        @foreach ($amenities as $amenity)
                            <div class="col-6 col-sm-4 col-lg-3">
                                <div class="amenity-item" data-toggle="ots-tooltip"
                                     data-title="{{ get_translate($amenity->term_description) }}">
                                    @if (!$amenity->term_icon)
                                        <i class="fe-check"></i>
                                    @else
                                        {!! get_icon($amenity->term_icon, '#2a2a2a', '#2a2a2a', '30px', '')  !!}
                                    @endif
                                    <span class="title">{{ get_translate($amenity->term_title) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                <h2 class="heading mt-3 mb-3">{{__('Policies')}}</h2>
                <?php
                $checkIn = $post->checkin_time;
                $checkOut = $post->checkout_time;
                $enableCancellation = $post->enable_cancellation;
                $cancelBeforeDay = (int)$post->cancel_before;
                $cancellationDetail = $post->cancellation_detail;
                ?>

                @if($checkIn)
                    <div class="item d-inline-block mr-4 mb-3 stripsbox">
                        <span class="font-weight-bold"><i class=" ti-time mr-1"></i>{{__('Check-in Time:')}}</span>
                        <span class="ml-2" style="color:green">{{ $checkIn }}</span>
                    </div>
                @endif
                @if ($checkOut)
                    <div class="item d-inline-block mr-4 mb-3 stripsbox">
                        <span class="font-weight-bold"><i class=" ti-time mr-1"></i>{{__('Check-out Time:')}}</span>
                        <span class="ml-2"style="color:red">{{ $checkOut }}</span>
                    </div>
                @endif
               
                @if ($enableCancellation == 'on')
                    <div class="item d-inline-block mr-4 mb-3 stripsbox">
                        <span class="font-weight-bold">{{__('Cancellation:')}}</span>
                        <span class="ml-2 small-info bg-success">{{__('enable')}}</span>
                        <span class="d-inline-block ml-1">{{ sprintf(__('before %s day(s)'), $cancelBeforeDay) }}</span>
                    </div>
                    @if (get_translate($cancellationDetail))
                        <div class="w-100">{!! balanceTags(get_translate($cancellationDetail)) !!}</div>
                    @endif
                @endif
                <h2 class="heading mt-3 mb-3">{{__('Availability')}}</h2>
                <div class="hh-availability-wrapper">
                    <div class="hh-availability stripsbox">
                        <input type="hidden" class="calendar_input"
                               data-id="{{$post->post_id}}"
                               data-encrypt="{{hh_encrypt($post->post_id)}}"
                               data-action="{{ url('get-inventory-home') }}"
                               data-date-format="{{hh_date_format_moment()}}">
                    </div>
                </div>
                @if($post->video)
                    <h2 class="heading mt-3 mb-3">{{__('Video')}}</h2>
                    <div class="video-wrapper stripsbox">
                        {!! balanceTags(get_video_embed_url(get_translate($post->video))) !!}
                    </div>
                @endif
                <h2 class="heading mt-3 mb-3">{{__('On Map')}}</h2>
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
                <div class="hh-mapbox-single" data-lat="{{ $lat }}"
                     data-lng="{{ $lng }}" data-zoom="{{ $zoom }}"></div>
                <?php
                $author = get_user_by_id($post->author);
                $address = $author->address;
                $location = $author->location;
                $country = get_country_by_code($location);
                $description = $author->description;
                ?>
				</div>
				<hr>
				 @if ($post->location_address)
                    <p class="location stripsbox">
                        <i class="ti-location-pin"></i>
                       Indirizzo: {{ get_translate($post->location_address) }}<a class="btn pulsantemappa" href="http://maps.google.com/maps/place/<?php echo get_translate($post->location_address) ?>" role="button" target="_blank">Apri su google Maps</a>
                    </p>
                @endif

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
                     data-real-price="{{ url('get-home-price-realtime') }}">
                    <div class="popup-booking-form-close">{!! get_icon('001_close', '#FFFFFF', '28px', '28px') !!}</div>
                 
                    <div class="form-body relative shadow">
                        @include('common.loading', ['class' => 'booking-loading'])
                        @if($booking_form == 'instant_enquiry')
                            <ul class="nav nav-tabs nav-bordered row">
                                <li class="nav-item nav-item-booking-form-instant col">
                                    <a href="#booking-form-instant"
                                       data-toggle="tab"
                                       aria-expanded="false"
                                       class="nav-link @if($booking_form == 'instant_enquiry' ||$booking_form == 'instant') active @endif">
                                        @if($post->booking_type == 'external_link')
                                            {{ __('External') }}
                                        @else
                                            {{ __('Instant') }}
                                        @endif
                                    </a>
                                </li>
                                <li class="nav-item nav-item-booking-form-instant col">
                                    <a href="#booking-form-enquiry"
                                       data-toggle="tab"
                                       aria-expanded="false"
                                       class="nav-link @if($booking_form == 'enquiry') active @endif">
                                        {{ __('Enquiry') }}
                                    </a>
                                </li>
                            </ul>
                        @endif
                        @if($booking_form == 'instant_enquiry')
                            <div class="tab-content">
                                @endif
                                @if($booking_form == 'instant_enquiry' || $booking_form == 'instant')
                                    <div
                                        class="tab-pane @if($booking_form == 'instant_enquiry' ||$booking_form == 'instant') active @endif"
                                        id="booking-form-instant">
                                        @if($post->booking_type == 'external_link')
                                            @include('frontend.home.external-form')
                                        @else
                                            @include('frontend.home.booking-form')
                                        @endif
                                    </div>
                                @endif
                                @if($booking_form == 'instant_enquiry' || $booking_form == 'enquiry')
                                    <div class="tab-pane @if($booking_form == 'enquiry') active @endif"
                                         id="booking-form-enquiry">
                                        <form action="{{ url('home-send-enquiry-form') }}" data-google-captcha="yes"
                                              data-validation-id="form-send-enquiry"
                                              class="form-action form-sm has-reset" data-loading-from=".form-body">
                                            <div class="form-group">
                                                <label for="full-name-enquiry-form">{{ __('Full Name') }} <span
                                                        class="text-danger">*</span></label>
                                                <input id="full-name-enquiry-form" type="text" name="name"
                                                       class="form-control has-validation" data-validation="required">
                                            </div>
                                            <div class="form-group">
                                                <label for="email-enquiry-form">{{ __('Email') }} <span
                                                        class="text-danger">*</span></label>
                                                <input id="email-enquiry-form" type="email" name="email"
                                                       class="form-control has-validation"
                                                       data-validation="required|email">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-enquiry-form">{{ __('Message') }} <span
                                                        class="text-danger">*</span></label>
                                                <textarea id="message-enquiry-form" class="form-control has-validation"
                                                          name="message" data-validation="required"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary btn-block text-uppercase"
                                                       name="sm"
                                                       value="{{ __('Send a Request') }}">
                                            </div>
                                            <input type="hidden" name="post_id" value="{{ $post->post_id }}">
                                            <input type="hidden" name="post_encrypt"
                                                   value="{{ hh_encrypt($post->post_id) }}">
                                            <div class="form-message"></div>
                                        </form>
                                    </div>
                                @endif
                                @if($booking_form == 'instant_enquiry')
                            </div>
                        @endif
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
        @if(count($list_services['results']))
            <h2 class="heading mt-3 mb-3">{{__('Homes Near By')}}</h2>
            <div class="hh-list-of-services stripsbox">
                <div class="row">
                    @foreach($list_services['results'] as $item)
                        <div class="col-12 col-md-6 col-lg-3">
                            @include('frontend.home.loop.grid', ['item' => $item, 'show_distance' => true])
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if(enable_review())
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-content">
                    @include('frontend.home.review')
                </div>
            </div>
        @endif
    </div>
    <div class="mobile-book-action">
        <div class="container">
            <div class="action-inner">
                <div class="action-price-wrapper">
                    <span class="price">{{ convert_price($post->base_price) }}</span>
                    <span class="unit">/{{$post->unit}}</span>
                </div>
                <a class="btn btn-primary action-button" id="mobile-check-availability">{{__('Check Availability')}}</a>
            </div>
        </div>
    </div>
</div>
@include('frontend.components.footer')
