<pre><?php print_r($errors); ?></pre>
<?php echo Form::open(NULL, array('enctype' => 'multipart/form-data')); ?>
	<?php echo Form::label('name', 'Naziv:'); ?>
	<?php echo Form::input('name', Arr::path($values, 'name')); ?>
	<?php echo Arr::path($errors, 'name'); ?>

	<?php echo Form::label('description', 'Opis:'); ?>
	<?php echo Form::textarea('description', Arr::path($values, 'description')); ?>
	<?php echo Arr::path($errors, 'description'); ?>

	<?php echo Form::label('default', 'Slika:'); ?>
	<?php echo Form::file('default'); ?>
	<?php echo Arr::path($errors, 'default'); ?>

	<?php if (isset($modes)): ?>
		<?php echo Form::label('mode_id', 'Môd:'); ?>
		<?php echo Form::select('mode_id', $modes, Arr::path($values, 'mode_id')); ?>
		<?php echo Arr::path($errors, 'mode_id'); ?>
	<?php endif ?>

	<?php if (isset($clans)): ?>
		<?php echo Form::label('winner_id', 'Pobjednici:'); ?>
		<?php echo Form::select('winner_id', Arr::unshift($clans, NULL, NULL), Arr::path($values, 'winner_id')); ?>
		<?php echo Arr::path($errors, 'winner_id'); ?>
	<?php endif ?>

	<?php echo Form::hidden('csrf', Security::token()); ?>
	<?php echo Form::submit(NULL, 'Izmijeni'); ?>
<?php echo Form::close(); ?>