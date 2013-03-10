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