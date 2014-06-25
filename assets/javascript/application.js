jQuery(function($) {
	$(document).on('click', 'a.form_submit', function(e) {
		var self = $(this);

		if (confirm('Jesi li siguran/na?')) {
			self.siblings('form.hidden.'+self.data('form')).submit();
		}

		e.preventDefault();
	});

	$(document).on('click', 'a.form_prompt_submit', function(e) {
		var self = $(this);
		var form = self.siblings('form.hidden.'+self.data('form'));

		var value = prompt(form.data('query'));

		if (value) {
			form.find('input[name="'+form.data('key')+'"]').val(value);
			form.submit();
		}

		e.preventDefault();
	});

	$('#add-comment').on('submit', addComment);

	var commentsList = $('.comments > ul');

	commentsList.on('click', 'a.edit-comment', function(e) {
		var self         = $(this);
		var text         = self.siblings('.txt');
		var editForm     = self.siblings('form.edit-comment');
		var textarea     = editForm.find('textarea[name="body"]').focus();
		var unparsedText = textarea.val();

		if (editForm.is(':visible')) {
			editForm.slideUp('fast', function() {
				editForm.find('textarea[name="body"]').val(unparsedText);
			});

			text.slideDown('fast');

			editForm.off('submit');
		} else {
			text.slideUp('fast');

			editForm.slideDown('fast').on('submit', function(e) {
				var form = $(this);
				var data = new FormData(form[0]);

				var loader = form.siblings('.ajax-loader').show();

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
							unparsedText = response.unparsed;
						}

						editForm.find('textarea[name="body"]').val(unparsedText);
					});

					if (typeof response.status != 'undefined' && response.status == 'OK') {
						text.html(response.parsed);
					}

					text.slideDown('fast');
					loader.hide();
				});

				e.stopImmediatePropagation();
				return false;
			});
		}

		e.preventDefault();
	});

	commentsList.on('submit', 'form.remove-comment', function(e) {
		var form = $(this);
		var data = new FormData(form[0]);

		var loader = form.siblings('.ajax-loader').show();

		$.ajax({
			url: form.attr('action'),
			type: 'post',
			dataType: 'json',
			data: data,
			processData: false,
			contentType: false,
			success: function(response) {
				if (response.status == 'OK') {
					var parent = form.parent();

					var html = parent.html().match(/<h5>.*<\/h5>\s*<p class="ago">.*<\/p>/);
					html += '<div class="clear"></div><div class="txt"><em>Komentar je obrisan.</em></div>';

					parent.html(html);
				}
			}
		}).done(function(response) {
			loader.hide();
		});

		return false;
	});

	commentsList.on('click', 'li.more-comments a', function(e) {
		var self = $(this);

		var loader = self.find('.ajax-loader').show();
		var span   = self.find('span').hide();

		$.ajax({
			url: '/komentari/' + self.data('type') + '/' + self.data('id') + '/' + self.data('last-id'),
			dataType: 'json',
			success: function(response) {
				if (response.status == 'OK') {
					commentsList.append(response.comments);
				}
			}
		}).done(function(response) {
			self.parent().remove();
		});

		e.preventDefault();
	});

	commentsList.on('click', '.comment-reply', function(e) {
		var self          = $(this);
		var parentComment = self.parents('li.comment').siblings('li[data-parent="'+self.data('parent')+'"]');
		var replyForm     = parentComment.find('form');

		if (replyForm.is(':visible')) {
			replyForm.slideUp('fast').off('submit');
		} else {
			replyForm.slideDown('fast').on('submit', addComment);
		}

		e.preventDefault();
	});

	function addComment() {
		var form = $(this);
		var data = new FormData(form[0]);

		var loader = form.find('.ajax-loader').show();

		$.ajax({
			url: form.attr('action'),
			type: 'post',
			dataType: 'json',
			data: data,
			processData: false,
			contentType: false,
			success: function(response) {
				if (response.status == 'OK') {
					if (form.is('#add-comment')) {
						$('.comments .no-comments').slideUp('fast');
						$(response.comment).hide().prependTo(commentsList).slideDown('fast');
					} else {
						$(response.comment).hide().insertBefore(form.parent()).slideDown('fast');
						form.slideUp('fast').off('submit');
					}

					form.find('textarea[name=body]').val(null);
					form.find('.error').empty();
				} else if (typeof response.errors != 'undefined') {
					$.each(response.errors, function(name, message) {
						form.find('[name=' + name + ']').siblings('.error').text(message);
					});
				}
			}
		}).done(function(response) {
			loader.hide();
		});

		return false;
	}

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

	$(document).ajaxComplete(function(event, xhr, options) {
		var response = (typeof xhr.responseJSON == 'undefined') ? {} : xhr.responseJSON;

		if (typeof response.STATUS != 'undefined' && response.STATUS == 'REDIRECT') {
			window.location = response.URI;
		}
	});
});