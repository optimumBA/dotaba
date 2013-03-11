<?php echo Form::open(NULL, array('enctype' => 'multipart/form-data')); ?>
	<?php echo Form::label('name', 'Naziv:'); ?>
	<?php echo Form::input('name', Arr::path($values, 'name')); ?>
	<?php echo Arr::path($errors, 'name'); ?>

	<?php echo Form::label('tag', 'Tag:'); ?>
	<?php echo Form::input('tag', Arr::path($values, 'tag')); ?>
	<?php echo Arr::path($errors, 'tag'); ?>

	<?php echo Form::label('open', 'Omogućene prijave:'); ?>
	<?php echo Form::checkbox('open', 1, (bool) Arr::path($values, 'open')); ?>
	<?php echo Arr::path($errors, 'open'); ?>

	<?php echo Form::label('lord_id', 'Lord:'); ?>
	<?php echo Form::select('lord_id', $users, Arr::path($values, 'lord_id')); ?>
	<?php echo Arr::path($errors, 'lord_id'); ?>

	<?php echo Form::label('default', 'Logo:'); ?>
	<?php echo Form::file('default'); ?>
	<?php echo Arr::path($errors, 'default'); ?>

	<?php echo Form::hidden('csrf', Security::token()); ?>
	<?php echo Form::submit(NULL, 'Izmijeni'); ?>
<?php echo Form::close(); ?>