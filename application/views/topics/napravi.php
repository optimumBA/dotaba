<?php echo Form::open(); ?>
	<?php echo Form::label('name', 'Naziv:'); ?>
	<?php echo Form::input('name', Arr::path($values, 'name')); ?>
	<?php echo Arr::path($errors, 'name'); ?>

	<?php echo Form::label('content', 'Tekst:'); ?>
	<?php echo Form::textarea('content', Arr::path($values, 'content')); ?>
	<?php echo Arr::path($errors, 'content'); ?>

	<?php if (User::instance()->has_role('Administrator/ica')): ?>
		<?php echo Form::label('is_hidden', 'Skrivena:'); ?>
		<?php echo Form::checkbox('is_hidden', 1, (bool) Arr::path($values, 'is_hidden', 1)); ?>
		<?php echo Arr::path($errors, 'is_hidden'); ?>
	<?php endif ?>

	<?php echo Form::hidden('csrf', Security::token()); ?>
	<?php echo Form::submit(NULL, 'Napravi'); ?>
<?php echo Form::close(); ?>