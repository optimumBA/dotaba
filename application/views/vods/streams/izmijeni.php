<?php echo Form::open(); ?>
	<?php echo Form::label('channel', 'Twitch kanal:'); ?>
	<?php echo Form::input('channel', Arr::path($values, 'channel')); ?>
	<?php echo Arr::path($errors, 'channel'); ?>

	<?php echo Form::label('description', 'Opis:'); ?>
	<?php echo Form::textarea('description', Arr::path($values, 'description')); ?>
	<?php echo Arr::path($errors, 'description'); ?>

	<?php echo Form::hidden('csrf', Security::token()); ?>
	<?php echo Form::submit(NULL, 'Izmijeni'); ?>
<?php echo Form::close(); ?>