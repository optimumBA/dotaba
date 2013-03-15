<p>Username: <?php echo $user->username; ?></p>
<p>Ime: <?php echo $user->name; ?></p>
<p>Država: <?php echo $user->location; ?></p>
<p>URL: <?php echo HTML::anchor($user->profileurl); ?></p>
<p>Registrovan/a: <?php echo date('d M Y H:i:s', strtotime($user->created_at)); ?></p>
<p>Klan: <?php echo ($user->clan_id) ? HTML::anchor('liga/klanovi/'.$user->clan->id.'-'.URL::title($user->clan->name, '-', TRUE), $user->clan->name) : ''; ?></p>
<?php if ($user->featured_hero_id): ?>
	<p>
		Omiljeni heroj: <?php echo HTML::image(Media_Remote_Hero::get($user->featured_hero->id, $user->featured_hero->image), array('alt' => $user->featured_hero->name)); ?>>
	</p>
<?php endif ?>

<?php echo HTML::image(Media_Remote_Avatar::get($user->id, $user->avatar), array('alt' => $user->username)); ?>

<p>
	Mečevi:
	<table>
		<tr>
			<th>ID</th>
			<th>tip</th>
			<th>mod</th>
			<th>turnir</th>
			<th>Radiant</th>
			<th>Dire</th>
			<th>vrijeme odigravanja</th>
		</tr>
		<?php foreach ($matches as $match): ?>
			<tr>
				<td><?php echo HTML::anchor('liga/mecevi/'.$match->id, $match->id); ?></td>
				<td><?php echo $match->type->name; ?></td>
				<td><?php echo $match->mode->name; ?></td>
				<td><?php echo ($match->tournament_id) ? HTML::anchor('liga/turniri/'.$match->tournament->id.'-'.URL::title($match->tournament->name, '-', TRUE), $match->tournament->name) : NULL; ?></td>
				<td><?php echo ($match->radiant_clan_id) ? HTML::anchor('liga/klanovi/'.$match->radiant_clan->id.'-'.URL::title($match->radiant_clan->name), $match->radiant_clan->name) : NULL; ?></td>
				<td><?php echo ($match->dire_clan_id) ? HTML::anchor('liga/klanovi/'.$match->dire_clan->id.'-'.URL::title($match->dire_clan->name), $match->dire_clan->name) : NULL; ?></td>
				<td><?php echo date('d M Y H:i:s', strtotime($match->date)); ?></td>
			</tr>
		<?php endforeach ?>
	</table>
</p>

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
					<?php echo Form::hidden('object_id', $user->id); ?>
					<?php echo Form::hidden('object_type', 'User'); ?>
					<?php echo Form::hidden('csrf', Security::token()); ?>
					<?php echo Form::submit(NULL, 'Pošalji'); ?>
				</li>
			</ul>
		<?php echo Form::close(); ?>
	</div>
<?php endif ?>