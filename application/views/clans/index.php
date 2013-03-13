<table>
	<tr>
		<th>ID</th>
		<th>logo</th>
		<th>naziv</th>
		<th>tag</th>
		<th>lord</th>
		<th>napravljen</th>
		<th>izmijenjen</th>
	</tr>
	<?php foreach ($clans as $clan): ?>
		<tr>
			<td><?php echo $clan->id; ?></td>
			<td><?php echo HTML::image(Media_Local_Clan::get($clan->id), array('alt' => $clan->name)); ?></td>
			<td><?php echo HTML::anchor('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE), $clan->name); ?></td>
			<td><?php echo $clan->tag; ?></td>
			<td><?php echo HTML::anchor('igraci/'.$clan->lord->accountid, $clan->lord->username); ?></td>
			<td><?php echo date('d M Y', strtotime($clan->created_at)); ?></td>
			<td><?php echo (isset($clan->updated_at)) ? date('d M Y', strtotime($clan->updated_at)) : '-'; ?></td>
		</tr>
	<?php endforeach ?>
</table>