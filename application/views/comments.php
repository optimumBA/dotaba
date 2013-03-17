<div class="comments">
	<h1 class="heading colr">Komentari</h1>

	<?php if ( ! Steam::logged_in()): ?>
		<div class="alert alert-error">Moraš biti prijavljen/a kako bi ostavio/la komentar. Prijavi se <a href="/provjera">ovdje</a></div>
	<?php endif; ?>

	<div class="clear"></div>

	<?php if (count($comments)): ?>
		<ul>
			<?php foreach ($comments as $comment): ?>
				<li>
					<div class="avatar">
						<?php echo HTML::image(Media_Remote_Avatar::get($comment->user->id, $comment->user->avatar), array('alt' => $comment->user->username, 'width' => 60, 'height' => 60)); ?>
					</div>
					<div class="desc">
						<h5><?php echo HTML::anchor('igraci/'.$comment->user->accountid, $comment->user->username); ?></h5>
						<p class="ago"><?php echo Date::formatted_time($comment->created_at); ?></p>
						<?php if (Steam::userinfo('id') == $comment->user_id): ?>
							<?php echo HTML::anchor('#', 'izmijeni', array('class' => 'edit_comment')); ?>
							<?php echo HTML::anchor('#', 'obriši', array('class' => 'form_submit', 'data-form' => 'delete')); ?>
							<?php echo Form::open('komentari/'.$comment->id.'/obrisi', array('class' => 'hidden delete')); ?>
								<?php echo Form::hidden('csrf', Security::token()); ?>
							<?php echo Form::close(); ?>
							<?php echo Form::open('komentari/'.$comment->id.'/izmijeni', array('class' => 'hidden edit')); ?>
								<?php echo Form::textarea('body', $comment->body); ?>
								<?php echo Form::hidden('csrf', Security::token()); ?>
								<?php echo Form::submit(NULL, 'Pošalji'); ?>
								<?php echo HTML::image('assets/images/ajax-loader.gif', array('alt' => 'AJAX loader', 'class' => 'hidden ajax-loader')); ?>
							<?php echo Form::close(); ?>
						<?php endif ?>
						<div class="txt"><?php echo HTML::parse_bbcode($comment->body); ?></div>
						<div class="clear"></div>
					</div>
				</li>
			<?php endforeach ?>
		</ul>
	<?php else: ?>
		<div class="alert alert-info">Trenutno nema komentara.</div>
	<?php endif; ?>
</div>
<?php if (Steam::logged_in()): ?>
	<div class="leavereply">
		<h1 class="heading colr">Dodaj komentar</h1>
		<?php echo Form::open('komentari/dodaj', array('class' => 'forms')); ?>
			<ul>
				<li>
					<?php echo Form::textarea('body', '', array('placeholder' => 'Tekst')); ?>
				</li>
				<li>
					<?php echo Form::hidden('object_id', $object_id); ?>
					<?php echo Form::hidden('object_type', $object_type); ?>
					<?php echo Form::hidden('csrf', Security::token()); ?>
					<?php echo Form::submit(NULL, 'Pošalji'); ?>
				</li>
			</ul>
		<?php echo Form::close(); ?>
	</div>
<?php endif ?>