<?php if (count($streams) > 0): ?>
	<ul>
		<?php foreach ($streams as $stream): ?>
			<li>
				<?php echo HTML::anchor('igraci/'.$stream->user->accountid.'/stream', $stream->user->username.'ov/in stream'); ?>
			</li>
		<?php endforeach ?>
	</ul>
<?php else: ?>
	Trenutno nema streamova.
<?php endif ?>

<?php if (User::instance()->logged_in() AND ! User::instance()->stream->loaded()): ?>
	<?php echo HTML::anchor('igraci/'.User::instance()->accountid.'/stream/dodaj', 'Dodaj'); ?>
<?php endif ?>