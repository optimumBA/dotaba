jQuery(function($) {
	$('a.form_submit').on('click', function(e) {
		var self = $(this);

		if (confirm('Jesi li siguran/na?')) {
			self.siblings('form.hidden.'+self.data('form')).submit();
		}

		e.preventDefault();
	});

	$('a.form_prompt_submit').on('click', function(e) {
		var self = $(this);
		var form = self.siblings('form.hidden.'+self.data('form'));

		var value = prompt(form.data('query'));

		if (value) {
			form.find('input[name="'+form.data('key')+'"]').val(value);
			form.submit();
		}

		e.preventDefault();
	});

	$('a.edit_comment').on('click', function(e) {
		var self         = $(this);
		var text         = self.siblings('.txt').slideUp('fast');
		var editForm     = self.siblings('form.edit').slideDown('fast');
		var textarea     = editForm.find('textarea[name="body"]').focus();
		var unparsedText = textarea.val();

		editForm.on('submit', function(e) {
			var form = $(this);
			var data = new FormData(form[0]);

			var loader = form.find('.ajax-loader').show();

			$.ajax({
				url: form.attr('action'),
				type: 'post',
				dataType: 'json',
				data: data,
				processData: false,
				contentType: false
			}).done(function(response) {
				editForm.slideUp('fast', function() {
					if (typeof response.status == 'undefined' || response.status == 'ERROR') {
						editForm.find('textarea[name="body"]').val(unparsedText);
					}
				});

				if (typeof response.status != 'undefined' && response.status == 'OK') {
					text.html(response.parsed);
				}

				text.slideDown('fast');
				loader.hide();
			});

			self.off('click.cancel');
			e.stopImmediatePropagation();
			return false;
		});

		self.on('click.cancel', function(e) {
			editForm.slideUp('fast', function() {
				editForm.find('textarea[name="body"]').val(unparsedText);
			});

			text.slideDown('fast');

			self.off('click.cancel');
			e.preventDefault();
		});

		e.preventDefault();
	});

	$('#slider').nivoSlider();

	$('.js-search-action').on('click', function() {
		$(this).siblings('form.navbar-search').submit();
	});

	$('input.datetime').datetimepicker({
		dateFormat: 'yy-mm-dd',
		timeFormat: 'HH:mm:ss'
	});

	var nextMatch = new Date($('#countdown-match').data('date'));
	$('#countdown-match').countdown({until: nextMatch});

	$('a.liga').on('click', function(e) {
		$('div.liga-notification').slideDown();
		e.preventDefault();
	});
});