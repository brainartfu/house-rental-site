<?php
$logo_footer = get_option('footer_logo');
if (empty($logo_footer)) {
    $logo_footer = get_option('logo');
}
$list_social = get_option('list_social');
$screen = current_screen();
$setup_mailc_api = get_option('mailchimp_api_key');
$setup_mailc_list_id = get_option('mailchimp_list');
enqueue_script('nice-select-js');
enqueue_style('nice-select-css');
$contact_detail = get_option('contact_detail');
?>
</div>
<footer id="footer" class="{{ $screen == 'home-search-result' ? 'hide-footer' : '' }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                @if(!empty($logo_footer))
                    <img src="{{ get_attachment_url($logo_footer) }}" alt="footer logo" class="footer-logo"/>
                @endif
				
				<p class="footerjust">{{__('Business Description Footer')}}<p>
				  
             
            </div>
           
                    <div class="col-lg-3 col-md-12">
                        <h4 class="footer-title">{{ get_option('footer_menu1_label') }}</h4>
                        <?php
                        $menu_id = get_option('footer_menu1');
                        get_nav_by_id($menu_id);
                        ?>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <h4 class="footer-title">{{ get_option('footer_menu2_label') }}</h4>
                        <?php
                        $menu_id = get_option('footer_menu2');
                        get_nav_by_id($menu_id);
                        ?>
                    </div>
					<div class="col-lg-3 col-md-12">
                        <h4 class="footer-title">{{ get_option('footer_menu3_label') }}</h4>
                        <?php
                        $menu_id = get_option('footer_menu3');
                        get_nav_by_id($menu_id);
                        ?>
						   @if(!empty($list_social))
                    <ul class="social">
				{!! balanceTags($contact_detail) !!}
                        @foreach($list_social as $item)
                            <li>
                                <a href="{{ $item['social_link'] }}">
                                    {!! get_icon($item['social_icon']) !!}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
				<hr>
						
                
            </div>
		
            
		
        </div>
      
    </div>
</div>
<?php do_action('footer'); ?>
<?php do_action('init_footer'); ?>
<?php do_action('init_frontend_footer'); ?>
<script src="{{asset('js/frontend.js')}}"></script>

</body><hr>
<div class="footercopy">
				<h6 class="text-center" style="color:#fff">Questo sito è protetto da reCAPTCHA e si applicano la <a href="https://policies.google.com/privacy" target="_blank">Privacy Policy</a> e i <a href="https://policies.google.com/terms" target="_blank">Termini e Condizioni</a> di Google.<hr>     {!! balanceTags(get_option('copy_right')) !!}</h6></div></footer>

</html>
