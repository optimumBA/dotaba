<p>Naziv: <?php echo $tournament->name; ?></p>
<p>Opis: <?php echo $tournament->description; ?></p>
<p>Napravljen: <?php echo date('d M Y', strtotime($tournament->created_at)); ?></p>
<?php if (isset($clan->updated_at)): ?>
	<p>Izmijenjen: <?php echo date('d M Y', strtotime($tournament->updated_at)) ?></p>
<?php endif ?>
<p><?php echo HTML::image(Media_Local_Tournament::get($tournament->id), array('alt' => $tournament->name)); ?></p>
<p>
	Klanovi:
	<ul>
		<?php foreach ($clans as $clan): ?>
			<li>
				<?php echo HTML::image(Media_Local_Clan::get($clan->id), array('alt' => $clan->name)); ?>
				<?php echo HTML::anchor('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name), $clan->name); ?>
			</li>
		<?php endforeach ?>
	</ul>
</p>

<p>
	Mečevi:
	<table>
		<tr>
			<th>ID</th>
			<th>Radiant</th>
			<th>Dire</th>
			<th>vrijeme odigravanja</th>
		</tr>
		<?php foreach ($matches as $match): ?>
			<tr>
				<td><?php echo HTML::anchor('liga/mecevi/'.$match->id, $match->id); ?></td>
				<td><?php echo ($match->radiant_clan_id) ? HTML::anchor('liga/klanovi/'.$match->radiant_clan->id.'-'.URL::title($match->radiant_clan->name), $match->radiant_clan->name) : NULL; ?></td>
				<td><?php echo ($match->dire_clan_id) ? HTML::anchor('liga/klanovi/'.$match->dire_clan->id.'-'.URL::title($match->dire_clan->name), $match->dire_clan->name) : NULL; ?></td>
				<td><?php echo date('d M Y H:i:s', strtotime($match->date)); ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</p>