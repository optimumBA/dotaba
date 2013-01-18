var launchDate = new Date("February 7, 2013 21:00:00");

var progressBarEnabled = true;

var progressBarOptions = {
	percentage: 25,
	startAnimation: true,
	startAnimationDuration: 5000,
	stripeAnimation: true,
	stripeAnimationDuration: 6000
};

var secondsRemaining = Math.floor(launchDate.getTime() / 1000) - Math.floor(new Date().getTime() / 1000);

$(document).ready(function() {

	$(window).bind('load', function() {

		var $text = $('.main-content-text').find('div'),
		    textHeight = $text.height();
		    imageHeight = $('.main-content-image-wrap').height();
		    
		if(imageHeight > textHeight) {
			$text.css({ marginTop: (textHeight / 2) * -1, visibility: 'visible' });
		} else {
			$text.css({ marginTop: 0, visibility: 'visible', position: 'static', top: 0 });
		}
		
		countdown(secondsRemaining);
		
		if(progressBarEnabled === true) {
			progressbar(progressBarOptions);
		}
	
	});
	
	$('#notify-submit').find('input').click(function() {
	
		if($('#notify-input').find('input').val() == '' || $('#notify-input').find('input').val() == 'Your email address') $('#notify-input').find('input').addClass('error');
	
		if(!$('#notify-input').find('input').hasClass('error')) {
	
			$('.notify-steps').animate({ marginTop: '-45px' }, 500, function() {
			
				$.post('admin/ajax.php?subscribe', { email: $('#notify-input').find('input').val() }, function(response) {
				
					$('.notify-steps').animate({ marginTop: '-90px' }, 500);
				
				});
			
			});
		
		}
	
	});
	
	$('#notify-input').find('input').keyup(function() {
	
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		if(!emailReg.test($(this).val())) {
			$(this).addClass('error');
		} else {
			$(this).removeClass('error');
		}
	
	});

});

var countdownElem = {
	days: $('#countdown-numbers').find('li').eq(0).find('strong'),
	hours: $('#countdown-numbers').find('li').eq(1).find('strong'),
	minutes: $('#countdown-numbers').find('li').eq(2).find('strong'),
	seconds: $('#countdown-numbers').find('li').eq(3).find('strong')
};

function countdown(secondsRemaining) {

	var days = Math.floor(secondsRemaining / 86400),
	    hours = Math.floor((secondsRemaining - (days * 86400)) / 3600),
	    minutes = Math.floor((secondsRemaining - (days * 86400) - (hours * 3600)) / 60),
	    seconds = secondsRemaining - (days * 86400) - (hours * 3600) - (minutes * 60);
	    
	if(secondsRemaining > 0) {
	
		if(days < 10) { days = '0' + days; }
		if(hours < 10) { hours = '0' + hours; }
		if(minutes < 10) { minutes = '0' + minutes; }
		if(seconds < 10) { seconds = '0' + seconds; }
		
		countdownElem.days.html(days);
		countdownElem.hours.html(hours);
		countdownElem.minutes.html(minutes);
		countdownElem.seconds.html(seconds);
		
		secondsRemaining--;
		
	} else {
	
		if(secondsRemaining == 0) {
	
			window.location.reload();
		
		}
		
	}
	window.setTimeout(function() {
	
   		countdown(secondsRemaining);
   		
	}, 1000);
	
}

function progressbar(options) {

	var defaults = {
		percentage: 50,
		startAnimation: true,
		startAnimationDuration: 2000,
		stripeAnimation: true,
		stripeAnimationDuration: 2000
	};
	
	options = $.extend({}, defaults, options);

	var progressbarWidth = 815 / 100 * options.percentage;

	var progressbarMarkup  = '<div id="progressbar-frame">';
	    progressbarMarkup +=     '<div id="progressbar-percentage"><span>0</span>% gotovo</div>';
	    progressbarMarkup +=     '<div id="progressbar-fill-frame" style="width:11px;">';
	    progressbarMarkup +=         '<div id="progressbar-fill" style="width:9px;">';
	    progressbarMarkup +=             '<div id="progressbar-fill-stripes"></div>';
	    progressbarMarkup +=         '</div>';
	    progressbarMarkup +=         '<div id="progressbar-fill-frame-left"></div>';
	    progressbarMarkup +=         '<div id="progressbar-fill-frame-right"></div>';
	    progressbarMarkup +=         '<div id="progressbar-fill-frame-middle"></div>';
	    progressbarMarkup +=     '</div>';
	    progressbarMarkup += '</div>';
	
	$('#progressbar').css({ 'padding-bottom' : '44px' }).html(progressbarMarkup);
	
	if(options.stripeAnimation === true) {
	
		var $progressbarStripes = $("#progressbar-fill-stripes");
		
		(function animateProgressbarFillStripes() {
			$progressbarStripes.css({ 'margin-left' : '-100px' }).animate({ 'margin-left' : '0px' }, options.stripeAnimationDuration, 'linear', animateProgressbarFillStripes);
		})();
	
	}
	
	var $progressbarPercentage = $('#progressbar-percentage').find('span');
	
	if(options.startAnimation === true) {
	
		(function countUp(currentPercentage) {
			$progressbarPercentage.text(currentPercentage);
			if(currentPercentage < options.percentage) {
				setTimeout(function() {
					countUp(++currentPercentage);
				}, Math.ceil(options.startAnimationDuration / options.percentage));
			}
		})(0);
	
		$('#progressbar-fill-frame').animate({ width: progressbarWidth }, options.startAnimationDuration, 'linear');
		$('#progressbar-fill').animate({ width: (progressbarWidth - 2) }, options.startAnimationDuration, 'linear');
	
	} else {
	
		$progressbarPercentage.text(options.percentage);
		
		$('#progressbar-fill-frame').css({ width: progressbarWidth });
		$('#progressbar-fill').css({ width: (progressbarWidth - 2) });
	
	}

}