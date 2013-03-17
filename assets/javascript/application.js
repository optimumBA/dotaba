jQuery(function($) {
	$('a[class="form_submit"]').on('click', function(e) {
		var self = $(this);

		if (confirm('Jesi li siguran/na?')) {
			self.siblings('form.hidden.'+self.data('form')).submit();
		}

		e.preventDefault();
	});

	$('a[class="edit_comment"]').on('click', function(e) {
		var self         = $(this);
		var text         = self.siblings('.txt').slideUp();
		var editForm     = self.siblings('form.edit').slideDown();
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
				editForm.slideUp();

				if (typeof response.status != 'undefined' && response.status == 'OK') {
					text.html(response.parsed);
				} else {
					editForm.find('textarea[name="body"]').val(unparsedText);
				}

				text.slideDown();
				loader.hide();
			});

			e.stopImmediatePropagation();
			return false;
		});

		e.preventDefault();
	});
});