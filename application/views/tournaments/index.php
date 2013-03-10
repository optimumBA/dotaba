<?php if (count($tournaments) > 0): ?>
	<?php foreach ($tournaments as $tournament): ?>
		<p>
			<?php echo HTML::image(Media_Local_Tournament::get($tournament->id), array('alt' => $tournament->name)); ?><br />
			Naziv: <?php echo $tournament->name ?><br />
			Organizator: <?php echo HTML::anchor('igraci/'.$tournament->user->accountid, $tournament->user->username); ?>
		</p>
	<?php endforeach ?>
<?php else: ?>
	Trenutno nema turnira.
<?php endif ?>

<?php echo $pagination; ?>