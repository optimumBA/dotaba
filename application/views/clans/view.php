<p>Naziv: <?php echo $clan->name; ?></p>
<p>Tag: <?php echo $clan->tag; ?></p>
<p>Napravljen: <?php echo date('d M Y', strtotime($clan->created_at)); ?></p>
<?php if (isset($clan->updated_at)): ?>
	<p>Izmijenjen: <?php echo date('d M Y', strtotime($clan->updated_at)) ?></p>
<?php endif ?>

<p>
	Članovi:
	<ul>
		<?php foreach ($users as $user): ?>
			<li><?php echo HTML::anchor('igraci/'.$user->username, $user->username); ?></li>
		<?php endforeach ?>
	</ul>
</p>