<?php echo Form::open(); ?>
	<?php echo Form::label('content', 'Tekst:'); ?>
	<?php echo Form::textarea('content', Arr::path($values, 'content')); ?>
	<?php echo Arr::path($errors, 'content'); ?>

	<?php echo Form::hidden('csrf', Security::token()); ?>
	<?php echo Form::submit(NULL, 'Napravi'); ?>
<?php echo Form::close(); ?>