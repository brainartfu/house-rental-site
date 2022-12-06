<?php
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
                    <span class="price-inner"><?php echo e(convert_price($item->base_price )); ?> <span style="font-size:10px">&nbsp;/Notte </span></span>
				<?php else: ?>
					 <span class="price-inner"><?php echo e(convert_price($prezzototale )); ?> <span style="font-size:10px">&nbsp;per <?php echo $interval->format('%a Notte/i'); ?> </span></span><?php endif; ?>
<?php /**PATH /home/salentovacanze/public_html/app/Views/frontend/home/loop/price.blade.php ENDPATH**/ ?>