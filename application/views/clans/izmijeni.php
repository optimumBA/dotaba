<?php echo Form::open(); ?>
	<?php echo Form::label('name', 'Naziv:'); ?>
	<?php echo Form::input('name', Arr::path($values, 'name')); ?>
	<?php echo Arr::path($errors, 'name'); ?>

	<?php echo Form::label('tag', 'Tag:'); ?>
	<?php echo Form::input('tag', Arr::path($values, 'tag')); ?>
	<?php echo Arr::path($errors, 'tag'); ?>

	<?php echo Form::label('lord_id', 'Lord:'); ?>
	<?php echo Form::select('lord_id', $users, Arr::path($values, 'lord_id')); ?>
	<?php echo Arr::path($errors, 'lord_id'); ?>

	<?php echo Form::submit(NULL, 'Izmijeni'); ?>
<?php echo Form::close(); ?>