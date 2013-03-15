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
			<td><?php echo Date::formatted_time($match->date); ?></td>
		</tr>
	<?php endforeach ?>
</table>