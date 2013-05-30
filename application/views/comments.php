<div class="comments">
	<h1 class="heading colr">Komentari</h1>

	<?php if ( ! User::instance()->logged_in()): ?>
		<div class="alert alert-error">Moraš biti prijavljen/a kako bi ostavio/la komentar. Prijavi se <a href="/provjera">ovdje</a></div>
	<?php endif; ?>

	<div class="clear"></div>

	<?php if (count($comments)): ?>
		<ul>
			<?php foreach ($comments as $comment): ?>
				<li>
					<div class="avatar">
						<?php echo HTML::image(Media_Remote_Avatar::get($comment->user->id, $comment->user->avatar), array('alt' => $comment->user->username, 'width' => 60, 'height' => 60, 'class' => 'status-'.$comment->user->status.'')); ?>
					</div>
					<div class="desc">
						<h5><?php echo HTML::anchor('igraci/'.$comment->user->accountid, $comment->user->username); ?></h5>
						<p class="ago"><?php echo Date::formatted_time($comment->created_at); ?></p>
						<?php if ($comment->removed): ?>
							<div class="clear"></div>
							<div class="txt"><em>Komentar je obrisan.</em></div>
						<?php else: ?>
							<?php if (User::instance()->id == $comment->user_id OR User::instance()->has_role('Administrator/ica')): ?>
								<?php echo HTML::anchor('#', 'izmijeni', array('class' => 'edit_comment izmijeni')); ?>
								<?php echo HTML::anchor('#', 'obriši', array('class' => 'form_submit obrisi', 'data-form' => 'delete')); ?>
								<?php echo Form::open('komentari/'.$comment->id.'/obrisi', array('class' => 'hidden delete')); ?>
									<?php echo Form::hidden('csrf', Security::token()); ?>
								<?php echo Form::close(); ?>
								<div class="clear"></div>
								<?php echo Form::open('komentari/'.$comment->id.'/izmijeni', array('class' => 'hidden edit')); ?>
									<?php echo Form::textarea('body', $comment->body); ?>
									<?php echo Form::hidden('csrf', Security::token()); ?>
									<?php echo Form::submit(NULL, 'Pošalji'); ?>
									<?php echo HTML::image('assets/images/ajax-loader.gif', array('alt' => 'AJAX loader', 'class' => 'hidden ajax-loader')); ?>
								<?php echo Form::close(); ?>
							<?php else: ?>
								<div class="clear"></div>
							<?php endif ?>
							<div class="clear"></div>
							<div class="txt"><?php echo HTML::parse_bbcode($comment->body); ?></div>
							<div class="clear"></div>
						<?php endif ?>
					</div>
				</li>
			<?php endforeach ?>
		</ul>
	<?php else: ?>
		<div class="alert alert-info">Trenutno nema komentara.</div>
	<?php endif; ?>
</div>
<?php if (User::instance()->logged_in()): ?>
	<div class="leavereply-avatar">
						<?php echo HTML::image(Media_Remote_Avatar::get(User::instance()->id, User::instance()->avatar), array('alt' => User::instance()->username, 'width' => 60, 'height' => 60, 'class' => 'status-'.User::instance()->status.'', 'title' => User::instance()->username)); ?>
                        </div>
    <div class="leavereply">
		<h1 class="heading colr">Dodaj komentar</h1>
		
		<?php echo Form::open('komentari/dodaj', array('class' => 'forms')); ?>
			<ul>
				<li>
					<?php echo Form::textarea('body', '', array('placeholder' => 'Dodaj komentar')); ?>
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