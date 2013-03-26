
jQuery(function($) {
	$('.overlay-image').waitForImages({
		waitForAll: true,
		finished: function() {
			$('#loading').animate({opacity: '0'}, 500);
			$('.overlay-image').animate({opacity: '0.2'}, 1500);

			var todoOffset = Number($('.todo').offset().left);
			var bodyWidth = Number($('body').width())/2;
			var theSum = (todoOffset - bodyWidth);

			$('body,html').stop().animate({
				scrollLeft: (theSum)
			}, 1500);
		}
	});

	$(window).scroll(function(){
		var bodyWidth = Number($('.panel').width());
		var todoWidth = Number($('.todo').width());
		var totalWidth = (bodyWidth - todoWidth);

		if ($(this).scrollLeft() > totalWidth) {
			$('h1 span').replaceWith('<span>Things Still To Do <img src="/assets/images/timeline/1362881045_Construction-Worker.png" width="32" height="32" alt="development"></span');
		} else {
			$('h1 span').replaceWith('<span>Things Already Done <img src="/assets/images/timeline/1362880873_tick.png" width="32" height="32" alt="tick"></span>');
		}
	});

	$('.nextli').bind('click',function(event) {
		$('body,html').stop().animate({
			scrollLeft: ($(this).parent('span').parent('div').parent('li').next('li').position().left)
		}, 1000);

		event.preventDefault();
	});

	$('.prevlink').bind('click', function(event) {
		$('body,html').stop().animate({
			scrollLeft: ($(this).parent('span').parent('div').parent('li').prev('li').position().left)
		}, 1000);

		event.preventDefault();
	});

	$('.currentlink').bind('click', function(event) {
		$('body,html').stop().animate({
			scrollLeft: ($(this).parent('span').parent('div').parent('li').position().left)
		}, 1000);

		event.preventDefault();
	});

	$('a[href="#last"]').bind('click', function(event) {
		var bodyWidther = Number($('.panel').width());

		$('body,html').stop().animate({
			scrollLeft: (bodyWidther)
		}, 2000);

		event.preventDefault();
	});

	$('a[href="#start"]').bind('click', function(event) {
		$('body,html').stop().animate({
			scrollLeft: (0)
		}, 2000);

		event.preventDefault();
	});

	$('.content').mCustomScrollbar({
		advanced: { autoExpandVerticalScroll: true }
	});

	$('.mCSB_container').css('width', '+=30');

	$('.mCustomScrollbar').css('width', '+=30');

	$('body,html').mousewheel(function(event, delta) {
		this.scrollLeft -= (delta * 120);
		event.preventDefault();
	});

	$('.borderless').hover(function(){
		$(this).find('.viewport').stop().animate({opacity: 1},400);
	},function(){
		$(this).find('.viewport').stop().animate({opacity: 0},400);
	});

	$('#counter').countdown({
		timestamp: $('#counter').data('timestamp')
	});
});