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
		<?php for ($i = (int) ($team == 'dire') * 5; $i < ((int) ($team == 'dire') + 1) * 5; $i++): ?>
			<tr>
				<?php if (isset($slots[$i])): ?>
					<td>
						<?php echo HTML::image(Media_Remote_Avatar::get($slots[$i]->user->id, $slots[$i]->user->avatar), array('alt' => $slots[$i]->user->username)); ?>
						<?php echo HTML::anchor('igraci/'.$slots[$i]->user->accountid, $slots[$i]->user->username); ?>
					</td>
					<td>
						<?php echo HTML::image(Media_Remote_Hero::get($slots[$i]->hero->id, $slots[$i]->hero->image), array('alt' => $slots[$i]->hero->localized_name)); ?>
						<?php echo $slots[$i]->hero->localized_name; ?>
					</td>
					<td><?php echo $slots[$i]->level; ?></td>
					<td><?php echo $slots[$i]->kills; ?></td>
					<td><?php echo $slots[$i]->deaths; ?></td>
					<td><?php echo $slots[$i]->assists; ?></td>
					<td><?php echo $slots[$i]->gold; ?></td>
					<td><?php echo $slots[$i]->last_hits; ?></td>
					<td><?php echo $slots[$i]->denies; ?></td>
					<td><?php echo $slots[$i]->xp_per_min; ?></td>
					<td><?php echo $slots[$i]->gold_per_min; ?></td>
					<td><?php echo $slots[$i]->hero_damage; ?></td>
					<td><?php echo $slots[$i]->tower_damage; ?></td>
					<td><?php echo $slots[$i]->hero_healing; ?></td>
					<td>
						<?php for ($j = 0; $j < 6; $j++): ?>
							<?php if ($slots[$i]->{'item_'.$j.'_id'}): ?>
								<?php echo HTML::image(Media_Remote_Item::get($slots[$i]->{'item_'.$j}->id, $slots[$i]->{'item_'.$j}->image), array('alt' => $slots[$i]->{'item_'.$j}->localized_name)); ?>
							<?php else: ?>
								prazan slot
							<?php endif ?>
						<?php endfor ?>
					</td>
				<?php else: ?>
					<td>prazan slot</td>
				<?php endif ?>
			</tr>
		<?php endfor ?>
	</table>
<?php endforeach ?>

<?php if (count($picksbans) > 0): ?>
	<ul>
		<?php foreach ($picksbans as $pickban): ?>
			<li>
				<?php echo ($pickban->is_pick) ? 'pick' : 'ban'; ?>
				<?php echo ($pick->ban == 0) ? 'Radiant' : 'Dire'; ?>
				<?php echo HTML::image(Media_Remote_Hero::get($pickban->hero->id, $pickban->hero->image), array('alt' => $pickban->hero->localized_name)); ?>
			</li>
		<?php endforeach ?>
	</ul>
<?php endif ?>

<?php echo View::factory('comments', array('comments' => $comments, 'object_id' => $match->id, 'object_type' => 'Match')); ?>