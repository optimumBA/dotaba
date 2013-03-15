<?php echo ($match->radiant_win) ? 'Radiant' : 'Dire'; ?>

<?php foreach (array('radiant', 'dire') as $team): ?>
	<?php echo ucfirst($team); ?>
	<table>
		<tr>
			<th>igrač</th>
			<th>heroj</th>
			<th>level</th>
			<th>K</th>
			<th>D</th>
			<th>A</th>
			<th>gold</th>
			<th>LH</th>
			<th>DN</th>
			<th>XPM</th>
			<th>GPM</th>
			<th>hero damage</th>
			<th>tower damage</th>
			<th>hero healing</th>
			<th>inventory</th>
		</tr>
		<?php foreach ($match->{$team.'_slots'} as $slot): ?>
			<tr>
				<td>
					<?php echo HTML::image(Media_Remote_Avatar::get($slot->user->id, $slot->user->avatar), array('alt' => $slot->user->username)); ?>
					<?php echo HTML::anchor('igraci/'.$slot->user->accountid, $slot->user->username); ?>
				</td>
				<td>
					<?php echo HTML::image(Media_Remote_Hero::get($slot->hero->id, $slot->hero->image), array('alt' => $slot->hero->localized_name)); ?>
					<?php echo $slot->hero->localized_name; ?>
				</td>
				<td><?php echo $slot->level; ?></td>
				<td><?php echo $slot->kills; ?></td>
				<td><?php echo $slot->deaths; ?></td>
				<td><?php echo $slot->assists; ?></td>
				<td><?php echo $slot->gold; ?></td>
				<td><?php echo $slot->last_hits; ?></td>
				<td><?php echo $slot->denies; ?></td>
				<td><?php echo $slot->xp_per_min; ?></td>
				<td><?php echo $slot->gold_per_min; ?></td>
				<td><?php echo $slot->hero_damage; ?></td>
				<td><?php echo $slot->tower_damage; ?></td>
				<td><?php echo $slot->hero_healing; ?></td>
				<td>
					<?php for ($i = 0; $i < 6; $i++): ?>
						<?php echo HTML::image(Media_Remote_Item::get($slot->{'item_'.$i}->id, $slot->{'item_'.$i}->image), array('alt' => $slot->{'item_'.$i}->localized_name)); ?>
					<?php endfor ?>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
	<p>Tornjevi: <?php echo $match->{'tower_status_'.$team}; ?></p>
	<p>Barake: <?php echo $match->{'barracks_status_'.$team}; ?></p>
<?php endforeach ?>

<?php if (count($match->picksbans) > 0): ?>
	<ul>
		<?php foreach ($match->picksbans as $pickban): ?>
			<li>
				<?php echo ($pickban->is_pick) ? 'pick' : 'ban'; ?>
				<?php echo ($pick->ban == 0) ? 'Radiant' : 'Dire'; ?>
				<?php echo HTML::image(Media_Remote_Hero::get($pickban->hero->id, $pickban->hero->image), array('alt' => $pickban->hero->localized_name)); ?>
			</li>
		<?php endforeach ?>
	</ul>
<?php endif ?>

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
					<?php echo Form::hidden('object_id', $match->id); ?>
					<?php echo Form::hidden('object_type', 'Match'); ?>
					<?php echo Form::hidden('csrf', Security::token()); ?>
					<?php echo Form::submit(NULL, 'Pošalji'); ?>
				</li>
			</ul>
		<?php echo Form::close(); ?>
	</div>
<?php endif ?>