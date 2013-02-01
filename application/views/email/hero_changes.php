<?php if ($count = count($changes['added'])): ?>
	<p>
		<?php if ($count === 1): ?>
			Dodan je novi heroj:
		<?php else: ?>
			Dodani su novi heroji:
		<?php endif ?>
		<table border="1">
			<tr>
				<th>ID</th>
				<th>Ključ</th>
				<th>Naziv</th>
			</tr>
			<?php foreach ($changes['added'] as $hero): ?>
				<tr>
					<td><?php echo $hero->id; ?></td>
					<td><?php echo $hero->name; ?></td>
					<td><?php echo $hero->localized_name; ?></td>
				</tr>
			<?php endforeach ?>
		</table>
	</p>
<?php endif ?>

<?php if ($count = count($changes['altered'])): ?>
	<p>
		<?php if ($count === 1): ?>
			Izmjenjen je postojeći heroj:
		<?php else: ?>
			Izmijenjeni su postojeći heroji:
		<?php endif ?>
		<table border="1">
			<tr>
				<th>ID</th>
				<th>Ključ</th>
				<th>Novi ključ</th>
				<th>Naziv</th>
				<th>Novi naziv</th>
			</tr>
			<?php foreach ($changes['altered'] as $hero): ?>
				<tr>
					<td><?php echo $hero['local']->id; ?></td>
					<td><?php echo $hero['local']->name; ?></td>
					<td><?php echo $hero['remote']->name; ?></td>
					<td><?php echo $hero['local']->localized_name; ?></td>
					<td><?php echo $hero['remote']->localized_name; ?></td>
				</tr>
			<?php endforeach ?>
		</table>
	</p>
<?php endif ?>