<?php echo Form::open(NULL, array('enctype' => 'multipart/form-data')); ?>
	<?php echo Form::label('name', 'Naziv:'); ?>
	<?php echo Form::input('name', Arr::path($values, 'name')); ?>
	<?php echo Arr::path($errors, 'name'); ?>

	<?php echo Form::label('tag', 'Tag:'); ?>
	<?php echo Form::input('tag', Arr::path($values, 'tag')); ?>
	<?php echo Arr::path($errors, 'tag'); ?>

	<?php echo Form::label('default', 'Logo:'); ?>
	<?php echo Form::file('default'); ?>
	<?php echo Arr::path($errors, 'default'); ?>

	<?php echo Form::hidden('csrf', Security::token()); ?>
	<?php echo Form::submit(NULL, 'Napravi'); ?>
<?php echo Form::close(); ?>