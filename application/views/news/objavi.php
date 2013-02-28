<?php echo Form::open(NULL, array('enctype' => 'multipart/form-data')); ?>
	<?php echo Form::label('title', 'Naslov:'); ?>
	<?php echo Form::input('title', Arr::path($values, 'title')); ?>
	<?php echo Arr::path($errors, 'title'); ?>

	<?php echo Form::label('content', 'Tekst:'); ?>
	<?php echo Form::textarea('content', Arr::path($values, 'content')); ?>
	<?php echo Arr::path($errors, 'content'); ?>

	<?php echo Form::label('source', 'Izvor:'); ?>
	<?php echo Form::input('source', Arr::path($values, 'source')); ?>
	<?php echo Arr::path($errors, 'source'); ?>

	<?php echo Form::label('url', 'URL izvora:'); ?>
	<?php echo Form::input('url', Arr::path($values, 'url')); ?>
	<?php echo Arr::path($errors, 'url'); ?>

	<?php echo Form::label('default', 'Slika:'); ?>
	<?php echo Form::file('default'); ?>
	<?php echo Arr::path($errors, 'default'); ?>

	<?php echo Form::hidden('csrf', Security::token()); ?>
	<?php echo Form::submit(NULL, 'Objavi'); ?>
<?php echo Form::close(); ?>