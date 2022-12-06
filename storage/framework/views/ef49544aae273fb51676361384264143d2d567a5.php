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
<footer id="footer" class="<?php echo e($screen == 'home-search-result' ? 'hide-footer' : ''); ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <?php if(!empty($logo_footer)): ?>
                    <img src="<?php echo e(get_attachment_url($logo_footer)); ?>" alt="footer logo" class="footer-logo"/>
                <?php endif; ?>
				
				<p class="footerjust"><?php echo e(__('Business Description Footer')); ?><p>
				  
             
            </div>
           
                    <div class="col-lg-3 col-md-12">
                        <h4 class="footer-title"><?php echo e(get_option('footer_menu1_label')); ?></h4>
                        <?php
                        $menu_id = get_option('footer_menu1');
                        get_nav_by_id($menu_id);
                        ?>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <h4 class="footer-title"><?php echo e(get_option('footer_menu2_label')); ?></h4>
                        <?php
                        $menu_id = get_option('footer_menu2');
                        get_nav_by_id($menu_id);
                        ?>
                    </div>
					<div class="col-lg-3 col-md-12">
                        <h4 class="footer-title"><?php echo e(get_option('footer_menu3_label')); ?></h4>
                        <?php
                        $menu_id = get_option('footer_menu3');
                        get_nav_by_id($menu_id);
                        ?>
						   <?php if(!empty($list_social)): ?>
                    <ul class="social">
				<?php echo balanceTags($contact_detail); ?>

                        <?php $__currentLoopData = $list_social; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php echo e($item['social_link']); ?>">
                                    <?php echo get_icon($item['social_icon']); ?>

                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endif; ?>
				<hr>
						<!-- TrustBox script -->
<script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
<!-- End TrustBox script -->

<!-- TrustBox widget - Micro Review Count -->
<div class="trustpilot-widget" data-locale="it-IT" data-template-id="5419b6a8b0d04a076446a9ad" data-businessunit-id="6228be4a1db5134e8e0e9c38" data-style-height="24px" data-style-width="100%" data-theme="light" data-min-review-count="10" data-style-alignment="center">
  <a href="https://it.trustpilot.com/review/salentovacanzeaffitti.it" target="_blank" rel="noopener">Trustpilot</a>
</div>
<!-- End TrustBox widget -->
                
            </div>
		
            
		
        </div>
      
    </div>
</div>
<?php do_action('footer'); ?>
<?php do_action('init_footer'); ?>
<?php do_action('init_frontend_footer'); ?>
<script src="<?php echo e(asset('js/frontend.js')); ?>"></script>

</body><hr>
<div class="footercopy">
				<h6 class="text-center" style="color:#fff">Questo sito è protetto da reCAPTCHA e si applicano la <a href="https://policies.google.com/privacy" target="_blank">Privacy Policy</a> e i <a href="https://policies.google.com/terms" target="_blank">Termini e Condizioni</a> di Google.<hr>     <?php echo balanceTags(get_option('copy_right')); ?></h6></div></footer>

</html>
<?php /**PATH C:\xampp7\htdocs\app\Views/frontend/components/footer.blade.php ENDPATH**/ ?>