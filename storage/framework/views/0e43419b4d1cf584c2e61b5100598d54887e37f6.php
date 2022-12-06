<?php
global $post;
?>
<form class="form-action" action="<?php echo e(url('add-to-cart-home')); ?>" name="form" method="post" data-loading-from=".form-body"
      data-validation-id="form-add-cart">
    <?php if($post->booking_type == 'per_night'): ?>
        <div class="form-group">
           
            <!--<div class="date-wrapper date-double"
                 data-date-format="<?php echo e(hh_date_format_moment()); ?>"
                 data-action="<?php echo e(url('get-home-availability-single')); ?>">
                <input type="text" class="input-hidden check-in-out-field"
                       name="checkInOut" data-home-id="<?php echo e($post->post_id); ?>"
                       data-home-encrypt="<?php echo e(hh_encrypt($post->post_id)); ?>">
                <input type="text" class="input-hidden check-in-field"
                       name="checkIn">
                <input type="text" class="input-hidden check-out-field"
                       name="checkOut">
					   <span class="check-in-render"
                      data-date-format="<?php echo e(hh_date_format_moment()); ?>"></span>
                <span class="divider"></span>
                <span class="check-out-render"
                      data-date-format="<?php echo e(hh_date_format_moment()); ?>"></span>
            
            </div>-->
		

        </div>
		<!-- <label for="checkinout"><?php echo e(__('Check In/Out')); ?></label>
		  <input type="text" class="input-hidden check-in-field"
                       name="checkIn">
                <input type="text" class="input-hidden check-out-field"
                       name="checkOut">
					   <span class="check-in-render">
		 <input class="datepicker form-control" id="check_in_date" data-date-format="<?php echo e(hh_date_format_moment()); ?>" name="checkIn" placeholder="Check-In"  /></span>
		 <span class="check-in-render">
			<input class="datepicker form-control" id="check_out_date" data-date-format="<?php echo e(hh_date_format_moment()); ?>" name="checkOut" placeholder="Check-Out" /></span>-->
			<label for="checkinout"><?php echo e(__('Check In/Out')); ?></label>
			<div class="header-booking" id="prenota" role="form" aria-label="Prenota">
 <input type="text" class="input-hidden check-in-field"
                       name="checkIn">
                <input type="text" class="input-hidden check-out-field"
                       name="checkOut">
				<span class="check-in-render"><input type="date" class="datepicker form-control arrival" name="checkIn" ></span>
				<span class="check-out-render"><input type="date" class="datepicker form-control departure" name="checkOut" ></span>
			<!--<span class="check-in-render"><input class="datepicker form-control" id="check_in_date" data-date-format="<?php echo e(hh_date_format_moment()); ?>" name="checkIn" placeholder="Check-In"  /></span>
				<span class="check-in-render"><input class="datepicker form-control" id="check_out_date" data-date-format="<?php echo e(hh_date_format_moment()); ?>" name="checkOut" placeholder="Check-Out" /></span>-->

    

    
 
</div>

			
   <!--  <?php elseif($post->booking_type == 'per_hour'): ?>
       <div class="form-group">
            <label for="checkinout"><?php echo e(__('Check In')); ?></label>
            <div class="date-wrapper date-single"
                 data-date-format="<?php echo e(hh_date_format_moment()); ?>"
                 data-action-time="<?php echo e(url('get-home-availability-time-single')); ?>"
                 data-action="<?php echo e(url('get-home-availability-single')); ?>">
                <input type="text"
                       class="input-hidden check-in-out-single-field"
                       name="checkInOut" data-home-id="<?php echo e($post->post_id); ?>"
                       data-home-encrypt="<?php echo e(hh_encrypt($post->post_id)); ?>">
                <input type="text" class="input-hidden check-in-field"
                       name="checkIn">
                <input type="text" class="input-hidden check-out-field"
                       name="checkOut">
                <span class="check-in-render"
                      data-date-format="<?php echo e(hh_date_format_moment()); ?>"></span>
            </div>
        </div>
        <div class="form-group form-group-date-time d-none">
            <label><?php echo e(__('Time')); ?></label>
            <div class="date-wrapper date-time">
                <div class="date-render check-in-render"
                     data-time-format="<?php echo e(hh_time_format()); ?>">
                    <div class="render"><?php echo e(__('Start Time')); ?></div>
                    <div class="dropdown-time">

                    </div>
                    <input type="hidden" name="startTime" value=""
                           class="input-checkin"/>
                </div>
                <span class="divider"></span>
                <div class="date-render check-out-render"
                     data-time-format="<?php echo e(hh_time_format()); ?>">
                    <div class="render"><?php echo e(__('End Time')); ?></div>
                    <div class="dropdown-time">

                    </div>
                    <input type="hidden" name="endTime" value=""
                           class="input-checkin"/>
                </div>
            </div>
        </div>
    <?php endif; ?>-->
	<hr>
    <?php
    $max_guest = (int)$post->number_of_guest;
    ?>
    <div class="form-group">
        <label for="guest"><?php echo e(__('Guests')); ?></label>
        <div
            class="guest-group <?php if($post->enable_extra_guest == 'on'): ?> has-extra-guest <?php endif; ?>">
            <button type="button" class="btn btn-light dropdown-toggle"
                    data-toggle="dropdown"
                    data-text-guest="<?php echo e(__('Guest')); ?>"
                    data-text-guests="<?php echo e(__('Guests')); ?>"
                    data-text-infant="<?php echo e(__('Infant')); ?>"
                    data-text-infants="<?php echo e(__('Infants')); ?>"
                    aria-haspopup="true" aria-expanded="false">
                &nbsp;
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="group">
                    <span class="pull-left"><?php echo e(__('Adults')); ?></span>
                    <div class="control-item">
                        <i class="decrease ti-minus"></i>
                        <input type="number" min="1" step="1"
                               max="<?php echo e($max_guest); ?>"
                               name="num_adults"
                               value="1">
                        <i class="increase ti-plus"></i>
                    </div>
                </div>
                <div class="group">
                    <span class="pull-left"><?php echo e(__('Children')); ?></span>
                    <div class="control-item">
                        <i class="decrease ti-minus"></i>
                        <input type="number" min="0" step="1"
                               max="<?php echo e($max_guest); ?>"
                               name="num_children"
                               value="0">
                        <i class="increase ti-plus"></i>
                    </div>
                </div>
                <div class="group">
                    <span class="pull-left"><?php echo e(__('Infants')); ?></span>
                    <div class="control-item">
                        <i class="decrease ti-minus"></i>
                        <input type="number" min="0" step="1"
                               max="<?php echo e($max_guest); ?>"
                               name="num_infants"
                               value="0">
                        <i class="increase ti-plus"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?php
        $requiredExtra = $post->required_extra;
        ?>
        <?php if($requiredExtra): ?>
            <div class="extra-services">
                <label class="d-block mb-2" for="extra-services">
                    <?php echo e(__('Extra')); ?>

                    <span class="text-danger f12"><?php echo e(__('(required)')); ?></span>
                    <a href="#extra-collapse" class="right"
                       data-toggle="collapse"><?php echo get_icon('002_download_1', '#2a2a2a','15px'); ?></a>
                </label>
                <div id="extra-collapse" class="collapse show">
                    <?php $__currentLoopData = $requiredExtra; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="extra-item d-flex">
                            <span
                                class="name"><?php echo e(get_translate($ex['name'])); ?></span>
                            <span
                                class="price ml-auto"><?php echo e(convert_price($ex['price'])); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
        <?php
        $extra = $post->not_required_extra;
        ?>
        <?php if($extra): ?>
            <div class="extra-services">
                <label class="d-block mb-2" for="extra-services">
                    <span><?php echo e(__('Extra (optional)')); ?></span>
                    <a href="#extra-not-required-collapse" class="right"
                       data-toggle="collapse"><?php echo get_icon('002_download_1', '#2a2a2a','15px'); ?></a>
                </label>
                <div id="extra-not-required-collapse" class="collapse">
                    <?php $__currentLoopData = $extra; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="extra-item d-flex">
                            <div class="checkbox checkbox-success">
                                <input
                                    id="extra-service-<?php echo e($ex['name_unique']); ?>"
                                    class="input-extra"
                                    type="checkbox" name="extraServices[]"
                                    value="<?php echo e($ex['name_unique']); ?>">
                                <label
                                    for="extra-service-<?php echo e($ex['name_unique']); ?>">
                                    <span
                                        class="name"><?php echo e(get_translate($ex['name'])); ?></span>
                                </label>
                            </div>
                            <span
                                class="price ml-auto"><?php echo e(convert_price($ex['price'])); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="form-group form-render">
    </div>
    <div class="form-group mt-2">
        <input type="hidden" name="homeID" value="<?php echo e($post->post_id); ?>">
        <input type="hidden" name="homeEncrypt"
               value="<?php echo e(hh_encrypt($post->post_id)); ?>">
        <input type="submit" class="btn btn-primary btn-block text-uppercase"
               name="sm"
               value="<?php echo e(__('Book Now')); ?>">
    </div>
    <div class="form-message"></div>
</form>
 <script src="../../js/extention/choices.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="../../js/extention/flatpickr.js"></script>
	<script src="https://npmcdn.com/flatpickr/dist/l10n/it.js"></script>
	<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/confetti.css">

    <script>
	
/* 	const fp = flatpickr(".datepicker", {
		"locale": "it"  ,
  altInput: false,
  dateFormat: "YYYY-MM-DD",
  altFormat: "DD-MM-YYYY",
  allowInput: true,
   disableMobile: "true",
  parseDate: (datestr, format) => {
    return moment(datestr, format, true).toDate();
  },
  formatDate: (date, format, locale) => {
    // locale can also be used
    return moment(date).format(format);
  }
 */
  

      //flatpickr(".datepicker",{
    //"locale": "it"  ,
	//format: "dd-mm-YYYY",
	
	//dateFormat: 'dd-mm-yy',
//altFormat: "dd-mm-YYYY",
//altInput: true,
  //disableMobile: "true",

   //  });  



    </script>
	<script>
/* check_in = document.getElementById("check_in_date").flatpickr({
      parseDate: (datestr, format) => {
    return moment(datestr, format, true).toDate();
  },
  formatDate: (date, format, locale) => {
    // locale can also be used
    return moment(date).format(format);
  },
    minDate: new Date()
});
check_out = document.getElementById("check_out_date").flatpickr({
   parseDate: (datestr, format) => {
    return moment(datestr, format, true).toDate();
  },
  formatDate: (date, format, locale) => {
    // locale can also be used
    return moment(date).format(format);
  },
    minDate: new Date().fp_incr(1)
});

check_in.config.onChange = function(dateObj) {
    check_out.set("mindate", dateObj.fp_incr(-1));
};
check_out.config.onChange = function(dateObj) {
    check_in.set("maxdate", dateObj.fp_incr(1));
}
 */

</script>
<script>
const booking = (bookingId) => {
    // Get DOM elements
    const bookingForm = bookingId.querySelector('.form');
   // const bookingSubmit = bookingId.querySelector('.booking-submit');
    const arrival = bookingId.querySelector('.arrival');
    const departure = bookingId.querySelector('.departure');

    // default input placeholders
    const arrivalPlaceholder = 'Check-in';
    const departurePlaceholder = 'Check-out';
    arrival.setAttribute('placeholder', arrivalPlaceholder);
    departure.setAttribute('placeholder', departurePlaceholder);

    // arrival flatpickr instance
    const arrivalFp = flatpickr(arrival, {
        minDate: 'today', // ensures user cannot select a date prior to today
        disableMobile: 'true', // disables native datepicker on mobile
        monthSelectorType: 'static', // disables 'month' dropdown from flatpickr's datepicker (hope they add yearSelectorType soon)
        altInput: true,
		disableMobile: "true",
		"locale": "it"  ,
		parseDate: (datestr, format) => {
    return moment(datestr, format, true).toDate();
  },
  formatDate: (date, format, locale) => {
    // locale can also be used
    return moment(date).format(format);
  },
        altFormat: "DD-MM-YYYY",
       dateFormat: "YYYY-MM-DD",
        onReady: (a, b, fp) => {
            fp.altInput.setAttribute('aria-label', arrivalPlaceholder);
        }
    });

    // departure flatpickr instance
    const departureFp = flatpickr(departure, {
        minDate: new Date().fp_incr(1), // ensures user cannot select a date prior to tomorrow
        disableMobile: 'true', // disables native datepicker on mobile
        monthSelectorType: 'static', // disables 'month' dropdown from flatpickr's datepicker (hope they add yearSelectorType soon)
        altInput: true,
		"locale": "it"  ,
		parseDate: (datestr, format) => {
    return moment(datestr, format, true).toDate();
  },
  formatDate: (date, format, locale) => {
    // locale can also be used
    return moment(date).format(format);
  },
        altFormat: "DD-MM-YYYY",
       dateFormat: "YYYY-MM-DD",
        onReady: (a, b, fp) => {
            fp.altInput.setAttribute('aria-label', departurePlaceholder);
        }
    });

    // add custom classes to the arrival and departure 'flatpickr-calendar' elements
    arrivalFp.calendarContainer.classList.add('arrival-calendar');
    departureFp.calendarContainer.classList.add('departure-calendar');

    // flatpickr's date values
    let checkInChosen = arrivalFp.selectedDates;
    let checkOutChosen = departureFp.selectedDates;
    // js date objects
    let checkInObj = new Date(checkInChosen);
    let checkOutObj = new Date(checkOutChosen);

    // update flatpickr's date values
    const updateDates = () => {
        // flatpickr date values
        checkInChosen = arrivalFp.selectedDates;
        checkOutChosen = departureFp.selectedDates;
        // js date objects
        checkInObj = new Date(checkInChosen);
        checkOutObj = new Date(checkOutChosen);
    };

    // run 'updateDates' function every time the user selects a new arrival or departure
    [arrival, departure].forEach((item) => {
        item.addEventListener('change', () => {
            updateDates();
        });
    });

    // amount of days to add or subtract
    const defaultDaySpan = 1;

    // add days to departure date
    const addDays = () => {
        checkOutObj = new Date(checkInObj);
        checkOutObj.setDate(checkInObj.getDate() + defaultDaySpan)
        departureFp.setDate(checkOutObj);
    };

    // subtract days from arrival date
    const subDays = () => {
        checkInObj = new Date(checkOutObj);
        checkInObj.setDate(checkOutObj.getDate() - defaultDaySpan)
        arrivalFp.setDate(checkInObj);
    };

    // 86400000 milliseconds = 1 day
    let minimumDistance = 86400000;
    let dayDistance = 0;
    // get the distance between days as a number of milliseconds
    let getDayDistance = () => {
        dayDistance = checkOutObj - checkInObj;
    };

    // user selects arrival date
    arrival.addEventListener('change', () => {
        getDayDistance();

        // if departure date is not selected yet - or -
        // if arrival date is SAME DAY or AFTER currently selected departure date
        if ((checkOutChosen.length == 0) || (checkOutChosen.length !== 0 && dayDistance < minimumDistance)) {
            addDays();
        }

        updateDates();
    });

    // user selects departure date
    departure.addEventListener('change', () => {
        getDayDistance();

        // if arrival date is not selected yet - or -
        // if departure date is SAME DAY or BEFORE currently selected arrival date
        if ((checkInChosen.length == 0) || (checkInChosen.length !== 0 && dayDistance < minimumDistance)) {
            subDays();
        };

        updateDates();
    });

    // validate the form when the submit button is clicked
    let errorMessageVisible = false; // prevents odd behaviour if user is button mashing

    // create 'booking-error' element and get DOM elements
    document.querySelector('body').insertAdjacentHTML('beforeend', '<div class="booking-error"><div class="booking-error-content"><p></p></div></div>');
    const error = document.querySelector('.booking-error');
    const errorText = document.querySelector('.booking-error p');

    // submit button is clicked
    bookingSubmit.addEventListener('click', (event) => {
        // show the error message for X seconds (if one isn't already shown)
        const errorMessage = (message) => {
            if (!errorMessageVisible) {
                errorMessageVisible = true;

                errorText.textContent = message;
                error.classList.add('show');

                setTimeout(function() {
                    errorMessageVisible = false;
                    error.classList.remove('show');
                }, 4000)
            };

            event.preventDefault();
        }

        // validate: errors
        if (checkInChosen.length == 0 && checkOutChosen.length == 0) {
            errorMessage('Please select an arrival and departure date');
        }
        else if (checkInChosen.length == 0) {
            errorMessage('Please select an arrival date');
        }
        else if (checkOutChosen.length == 0) {
            errorMessage('Please select a departure date');
        }
        // validate: success
        else {
            // Google Analytics event tracking
            try {
                gtag('event', 'click', {
                    'event_category': 'Booking',
                    'event_label': 'Booking Form Submit'
                });
            }
            catch(err) {}




            // *****************************************************
            //  Split dates into separate variables
            //  Use only if needed
            // *****************************************************

            // regular expression that looks for YYYY-MM-DD
            const regex = /(?<year>\d{4})-(?<month>\d{2})-(?<day>\d{2})/;
            
            // match 'arrival' and 'departure' with 'regex'
            const regexArrival = arrival.value.match(regex);
            const regexDeparture = departure.value.match(regex);
            
            // split into separate variables
            const arrivalY = regexArrival.groups.year;
            const arrivalM = regexArrival.groups.month;
            const arrivalD = regexArrival.groups.day;
            const departureY = regexDeparture.groups.year;
            const departureM = regexDeparture.groups.month;
            const departureD = regexDeparture.groups.day;

            // testing
            /*
            console.log('arrival: ' + arrival.value);
            console.log('departure: ' + departure.value);
            console.log('arrival year: ' + arrivalY);
            console.log('arrival month: ' + arrivalM);
            console.log('arrival day: ' + arrivalD);
            console.log('departure year: ' + departureY);
            console.log('departure month: ' + departureM);
            console.log('departure day: ' + departureD);
            */




            // *****************************************************
            //  IHG only!
            //  Comment out or delete as needed!
            // *****************************************************
            
            // IHG requires that the month value does not have a leading 0:
            const checkInDate = parseInt(arrivalD, 10);
            const checkOutDate = parseInt(departureD, 10);

            // IHG requires that the month value is zero-based:
            const checkInMonth = parseInt(arrivalM, 10) - 1;            
            const checkOutMonth = parseInt(departureM, 10) - 1;

            // IHG requires the year value too of course
            const checkInYear = arrivalY;
            const checkOutYear = departureY;

            // IHG requires that we combine the month value and the year value together
            const checkInMonthYear = checkInMonth + checkInYear;
            const checkOutMonthYear = checkOutMonth + checkOutYear;

            // set the value for the 'checkInDate' input
            document.querySelector('input[name="checkInDate"]').setAttribute('value', checkInDate);

            // set the value for the 'checkOutDate' input
            document.querySelector('input[name="checkOutDate"]').setAttribute('value', checkOutDate);

            // set the value for the 'checkInMonthYear' input
            document.querySelector('input[name="checkInMonthYear"]').setAttribute('value', checkInMonthYear);

            // set the value for the 'checkInMonthYear' input
            document.querySelector('input[name="checkOutMonthYear"]').setAttribute('value', checkOutMonthYear);

            // testing
            /*
            console.log('checkInDate: ' + checkInDate);
            console.log('checkOutDate: ' + checkOutDate);
            console.log('checkInMonth: ' + checkInMonth);
            console.log('checkOutMonth: ' + checkOutMonth);
            console.log('checkInYear: ' + checkInYear);
            console.log('checkOutYear: ' + checkOutYear);
            console.log('checkInMonthYear: ' + checkInMonthYear);
            console.log('checkOutMonthYear: ' + checkOutMonthYear);
            */




            // *****************************************************
            //  Submit the form!
            // *****************************************************
            bookingForm.submit();

            event.preventDefault();
        };
    });
};

// Default booking instance:
let booking1 = document.querySelector('#prenota');
booking(booking1);

// Add additional booking instances if necessary:
/*
let booking2 = document.querySelector('#booking-2');
booking(booking2);
*/
</script><?php /**PATH C:\xampp7\htdocs\app\Views/frontend/home/booking-form.blade.php ENDPATH**/ ?>