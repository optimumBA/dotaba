<?php echo Form::open(); ?>
	<?php echo Form::label('name', 'Naslov:'); ?>
	<?php echo Form::input('name', Arr::path($values, 'name')); ?>
	<?php echo Arr::path($errors, 'name'); ?>

	<?php echo Form::label('vid', 'YouTube ID:'); ?>
	<?php echo Form::input('vid', Arr::path($values, 'vid')); ?>
	<?php echo Arr::path($errors, 'vid'); ?>

	<?php echo Form::label('description', 'Opis:'); ?>
	<?php echo Form::textarea('description', Arr::path($values, 'description')); ?>
	<?php echo Arr::path($errors, 'description'); ?>

	<?php echo Form::hidden('csrf', Security::token()); ?>
	<?php echo Form::submit(NULL, 'Dodaj'); ?>
<?php echo Form::close(); ?>