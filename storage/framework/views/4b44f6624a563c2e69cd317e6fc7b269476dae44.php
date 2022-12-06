<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
               <span class="copy-right-text">
                   &copy;<?php echo e(date('Y')); ?> <a href="<?php echo e(url('/')); ?>"><?php echo e(get_option('site_name', '')); ?></a>
               </span>
                <?php
                $awebooking = get_awebooking_info();
                if(!empty($awebooking)){
                ?>
               
                <?php
                }
                ?>
            </div>
            <div class="col-md-6">
                <div class="text-md-right footer-links d-none d-sm-block">
                   <a href="https://www.demonero.it">Soluzioni Web</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH C:\xampp7\htdocs\app\Views/dashboard/components/footer-content.blade.php ENDPATH**/ ?>