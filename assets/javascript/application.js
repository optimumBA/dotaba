jQuery(function($) {
	$('a[class="form_submit"]').on('click', function(e) {
		var self = $(this);

		if (confirm('Jesi li siguran/na?')) {
			self.siblings('form.hidden.'+self.data('form')).submit();
		}

		e.preventDefault();
	});
});