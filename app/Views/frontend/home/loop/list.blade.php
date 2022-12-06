<div class="hh-service-item home list" data-lng="{{ $item->location_lng }}"
     data-lat="{{ $item->location_lat }}" data-id="{{ $item->post_id }}">
    <div class="item-inner">
        <div class="thumbnail-wrapper">
            @if($item->is_featured == 'on')
                <div class="is-featured">{{ get_option('featured_text', __('Featured')) }}</div>
            @endif
            @if(!empty($item->gallery))
                <?php
                $galleries = explode(',', $item->gallery);
                $featured_image = $item->thumbnail_id;
                if(!empty($featured_image)){
                    array_unshift($galleries, $featured_image);
                }
                ?>
                <div id="hh-item-carousel-{{ $item->post_id }}" class="hh-item-carousel carousel slide"
                     data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @foreach ($galleries as $key => $imageID)
                            <div class="carousel-item @if($key == 0) active @endif">
                                <a href="{{ get_the_permalink($item->post_id, $item->post_slug) }}"
                                   class="carousel-cell">
                                    <img src="{{ get_attachment_url($imageID, [400, 300]) }}"
                                         alt="{{ get_translate($item->post_title) }}"/>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#hh-item-carousel-{{ $item->post_id }}" role="button"
                       data-slide="prev">
                        <i class="ti-angle-left"></i>
                        <span class="sr-only">{{__('Previous')}}</span>
                    </a>
                    <a class="carousel-control-next" href="#hh-item-carousel-{{ $item->post_id }}" role="button"
                       data-slide="next">
                        <i class="ti-angle-right"></i>
                        <span class="sr-only">{{__('Next')}}</span>
                    </a>
                </div>
            @else
                <a href="{{ get_the_permalink($item->post_id, $item->post_slug) }}" class="no-gallery">
                    <img src="{{ placeholder_image([400, 300]) }}" alt="{{ get_translate($item->post_title)  }}"
                         class="img-fluid"/>
                </a>
            @endif
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
                    {{ $type_name }} / {{ $type_namesec }}
                </div>
                @if(enable_review())
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
                @endif
            </div>
            <h3 class="title">
                <a href="{{ get_the_permalink($item->post_id, $item->post_slug) }}">{{ get_translate($item->post_title) }}</a>
            </h3>
            <p class="address text-overflow font13"><i class="fe-map-pin mr-1 "></i>{{ get_shorted_address($item) }}</p>
            <div class="facilities">
			<div class="row">
                <div class="item max-people col-sm-6 ">
                 <span class="allignicons"><i class="fa fa-users" aria-hidden="true"></i></span> {{ _n("[0::%s guests][1::%s guest][2::%s guests]", (int)$item->number_of_guest) }}
                </div>
                <div class="item max-bedrooms col-sm-6">
                 <span class="allignicons"><i class="fa fa-bed" aria-hidden="true"></i></span> {{ _n("[0::%s bedrooms][1::%s bedroom][2::%s bedrooms]", (int)$item->number_of_bedrooms) }}
                </div>
                <div class="item max-baths col-sm-6">
               <span class="allignicons m3r"><i class="fa fa-bath" aria-hidden="true"></i> </span> {{ _n("[0::%s bathrooms][1::%s bathroom][2::%s bathrooms]", (int)$item->number_of_bathrooms) }}
                </div>
			
				
@if ($item->dis)
	
			  <div class="item max-baths col-sm-6">
             <span class="allignicons">  <i class='fa fa-water mare'></i></span>{{__('Sea')}} {{ $item->dis }}
            </div>
			@else
				<div class="item max-baths col-sm-6">
                
            </div>
			@endif

			@if ($item->disp)
				<br>
			  <div class="item max-baths col-sm-6">
           <span class="allignicons">  <i class='fa fa-water spiaggia'></i></span>{{__('Beach')}} {{ $item->disp }}
            </div>
			@else
				<div class="item max-baths col-sm-6">
                
            </div>
			@endif
				
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
				@if(empty($prezzototale))
				
                    <span class="price">{{ convert_price($item->base_price ) }}/Notte </h5>
				@else
					 <span class="price">{{ convert_price($prezzototale ) }} </span><h5>&nbsp;per <?php echo $interval->format('%a Notte/i'); ?> </h5>
					@endif
					
					  
				
                </div>

            </div>
        </div>
    </div>
</div>

