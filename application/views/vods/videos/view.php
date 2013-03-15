<?php echo $video->name; ?>
<iframe src="http://www.youtube.com/embed/<?php echo $video->vid; ?>?origin=<?php echo URL::base(); ?>" frameborder="0"/>
<?php echo HTML::anchor('igraci/'.$video->user->accountid, $video->user->username); ?>
<?php echo HTML::parse_bbcode($video->description); ?>

<div class="comments">
	<h1 class="heading colr">Komentari</h1>
	
	<?php if (!Steam::logged_in()): ?>
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
							<p class="ago"><?php echo $comment->created_at; ?></p>
							<p class="txt"><?php echo HTML::parse_bbcode($comment->body); ?></p>
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
					<?php echo Form::hidden('object_id', $video->id); ?>
					<?php echo Form::hidden('object_type', 'Video'); ?>
					<?php echo Form::hidden('csrf', Security::token()); ?>
					<?php echo Form::submit(NULL, 'Pošalji'); ?>
				</li>
			</ul>
		<?php echo Form::close(); ?>
	</div>
<?php endif ?>