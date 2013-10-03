<?php if (User::instance()->can('create', 'Comments')): ?>
	<div class="leavereply-avatar">
		<?php echo HTML::image(Media_Remote_Avatar::get(User::instance()->id, User::instance()->avatar), array('alt' => User::instance()->username, 'width' => 60, 'height' => 60, 'class' => 'status-'.User::instance()->status.'', 'title' => User::instance()->username)); ?>
	</div>

	<div class="leavereply">
		<h1 class="heading colr">Dodaj komentar</h1>

		<?php echo Form::open('komentari/dodaj', array('id' => 'add-comment', 'class' => 'forms')); ?>
			<ul>
				<li>
					<?php echo Form::textarea('body', '', array('placeholder' => 'Dodaj komentar')); ?>
					<div class="error"></div>
				</li>
				<li>
					<?php echo Form::hidden('object_id', $object_id); ?>
					<?php echo Form::hidden('object_type', $object_type); ?>
					<?php echo Form::hidden('csrf', Security::token()); ?>
					<?php echo Form::submit(NULL, 'Pošalji'); ?>
					<?php echo HTML::image('assets/images/ajax-loader.gif', array('alt' => 'AJAX loader', 'class' => 'hidden ajax-loader')); ?>
				</li>
			</ul>
		<?php echo Form::close(); ?>
	</div>
<?php endif ?>

<div class="comments">
	<h1 class="heading colr">Komentari</h1>

	<?php if ( ! User::instance()->logged_in()): ?>
		<div class="alert alert-error">Moraš biti prijavljen/a kako bi ostavio/la komentar. Prijavi se <a href="/provjera">ovdje</a></div>
	<?php endif; ?>

	<div class="clear"></div>

	<ul>
		<?php echo View::factory('comments/list', array('comments' => $comments, 'object_type' => $object_type, 'object_id' => $object_id)); ?>
	</ul>

	<?php if ( ! count($comments['parents'])): ?>
		<div class="alert alert-info no-comments">Trenutno nema komentara.</div>
	<?php endif ?>
</div>