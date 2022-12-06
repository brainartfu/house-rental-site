<?php
$setup_mailc_api = get_option('mailchimp_api_key');
$setup_mailc_list_id = get_option('mailchimp_list');
$screen = current_screen();
enqueue_script('nice-select-js');
enqueue_style('nice-select-css');
?> 
 <!--<div class="col-lg-12 col-md-12">
             <div class="container">
                    <h4 class="footer-title">{{ get_option('footer_subscribe_label') }}</h4>
                    <p>{{ get_option('footer_subscribe_description') }}</p>
                    <form action="{{ url('subscribe-email') }}" class="subscribe-form form-sm form-action"
                          data-validation-id="form-subscribe"
                          method="post" data-reload-time="1000">
                        <input type="email" id="mc-email" name="email" placeholder="{{__('Enter your email')}}"
                               class="form-control has-validation" data-validation="required"/>
                        <button type="submit"><i class="fe-arrow-right"></i> <span class="hh-loading"></span></button>
                        <div class="form-message"></div>
                    </form>
               
            </div></div>-->
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<section class="subscribe-area pb-50 pt-70 mt-3 mb-3">
<div class="container shadowtr">
	<div class="row">

					<div class="col-md-2 col-sm-12 mb-2 mt-2">
						<div class="subscribe-text text-center mb-5">
						<h4 class="footer-title text-light mb-1">{{ get_option('footer_subscribe_label') }}</h4>
							<p class="text-light">{{ get_option('footer_subscribe_description') }}</p>
						</div>
					</div>
					<div class="col-md-9 col-sm-12 mb-2 mt-2">
						<div class="subscribe-wrapper subscribe2-wrapper mb-15">
							<div class="subscribe-form">
								<form action="{{ url('subscribe-email') }}" class="subscribe-form form-sm form-action"
                          data-validation-id="form-subscribe"
                          method="post" data-reload-time="1000">
                        <input type="email" id="mc-email" name="email" placeholder="{{__('Enter your email')}}"
                               class="col-md-9 col-sm-12 mb-2 mt-2 form-control has-validation text-dark" data-validation="required"/>
									<button class="col-md-2 col-sm-12 mb-2 mt-2">{{__('Signup newsletter')}} <i class="fas fa-long-arrow-alt-right"></i></button>
								</form>
							</div>
						</div>
					</div>
				</div>

</div>
</section>
<style>
.subscribe-area {
background-image: linear-gradient(to top, #00c6fb 0%, #005bea 100%);
}

.pb-50 {
    padding-bottom: 50px;
}
.pt-70 {
    padding-top: 70px;
}

.mb-15 {
    margin-bottom: 15px;
}

.subscribe-text span {
    font-size: 12px;
    font-weight: 700;
    color: #fff;
    letter-spacing: 5px;
}
.subscribe-text h2 {
    color: #fff;
    font-size: 36px;
    font-weight: 300;
    margin-bottom: 0;
    margin-top: 6px;
}
.subscribe-wrapper {
    overflow: hidden;
}
.mb-15 {
    margin-bottom: 15px;
}
.subscribe-form {
	    margin-top: 8px;
}
.subscribe2-wrapper .subscribe-form input {
    background: #fff;
    border: 1px solid #fff;
    border-radius: 30px;
    color: #fff;
    display: inline-block;
    font-size: 15px;
    font-weight: 300;
    height: 57px;
    margin-right: 17px;
    padding-left: 35px;
    cursor: pointer;
}
 
.subscribe2-wrapper .subscribe-form button {
    background: #ffff;
    border: none;
    border-radius: 30px;
    color: #4b5d73;
    display: inline-block;
    font-size: 18px;
    font-weight: 400;
    line-height: 1;
    padding: 18px 46px;
    transition: all 0.3s ease 0s;
}
.subscribe2-wrapper .subscribe-form button i {
    font-size: 18px;
    padding-left: 5px;
}

</style>