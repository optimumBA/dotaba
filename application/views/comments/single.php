<li class="comment<?php echo ($comment->parent_id) ? ' leveltwo' : ''; ?>">
	<a name="komentar_<?php echo $comment->id; ?>"></a>
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
			<?php if (User::instance()->can('create', 'Comments')): ?>
				<?php echo HTML::anchor('#', 'odgovori', array('class' => 'comment-reply', 'data-parent' => ($comment->parent_id) ? $comment->parent_id : $comment->id)); ?>
			<?php endif ?>
			<?php if (User::instance()->can('edit', $comment)): ?>
				<?php echo HTML::anchor('#', 'izmijeni', array('class' => 'edit-comment izmijeni')); ?>
			<?php endif ?>
			<?php if (User::instance()->can('delete', $comment)): ?>
				<?php echo HTML::anchor('#', 'obriši', array('class' => 'form_submit obrisi', 'data-form' => 'remove-comment')); ?>
				<?php echo Form::open('komentari/'.$comment->id.'/obrisi', array('class' => 'hidden remove-comment')); ?>
					<?php echo Form::hidden('csrf', Security::token()); ?>
				<?php echo Form::close(); ?>
			<?php endif ?>
			<div class="clear"></div>
			<?php if (User::instance()->can('edit', $comment)): ?>
				<?php echo HTML::image('assets/images/ajax-loader.gif', array('alt' => 'AJAX loader', 'class' => 'hidden ajax-loader')); ?>
				<?php echo Form::open('komentari/'.$comment->id.'/izmijeni', array('class' => 'hidden edit-comment')); ?>
					<?php echo Form::textarea('body', $comment->body); ?>
					<?php echo Form::hidden('csrf', Security::token()); ?>
					<?php echo Form::submit(NULL, 'Pošalji'); ?>
				<?php echo Form::close(); ?>
			<?php endif ?>
			<div class="clear"></div>
			<div class="txt"><?php echo HTML::parse_bbcode($comment->body); ?></div>
			<div class="clear"></div>
		<?php endif ?>
	</div>
</li>