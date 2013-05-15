<?php if ($count = count($changes['added'])): ?>
	<p>
		<?php if ($count === 1): ?>
			Dodan je novi item:
		<?php else: ?>
			Dodani su novi itemi:
		<?php endif ?>
		<table border="1">
			<tr>
				<th>Remote ID</th>
				<th>Ključ</th>
				<th>Naziv</th>
			</tr>
			<?php foreach ($changes['added'] as $item): ?>
				<tr>
					<td><?php echo $item->id; ?></td>
					<td><?php echo $item->name; ?></td>
					<td><?php echo $item->localized_name; ?></td>
				</tr>
			<?php endforeach ?>
		</table>
	</p>
<?php endif ?>

<?php if ($count = count($changes['altered'])): ?>
	<p>
		<?php if ($count === 1): ?>
			Izmjenjen je postojeći item:
		<?php else: ?>
			Izmjenjeni su postojeći itemi:
		<?php endif ?>
		<table border="1">
			<tr>
				<th>ID</th>
				<th>Ključ</th>
				<th>Naziv</th>
				<th>Remote ID</th>
				<th>Novi remote ID</th>
			</tr>
			<?php foreach ($changes['altered'] as $item): ?>
				<tr>
					<td><?php echo $item['local']->id; ?></td>
					<td><?php echo $item['local']->name; ?></td>
					<td><?php echo $item['local']->localized_name; ?></td>
					<td><?php echo $item['local']->remote_id; ?></td>
					<td><?php echo $item['remote']->id; ?></td>
				</tr>
			<?php endforeach ?>
		</table>
	</p>
<?php endif ?>