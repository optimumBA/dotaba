<p>Naziv: <?php echo $clan->name; ?></p>
<p>Tag: <?php echo $clan->tag; ?></p>
<p>Napravljen: <?php echo date('d M Y', strtotime($clan->created_at)); ?></p>
<?php if (isset($clan->updated_at)): ?>
	<p>Izmijenjen: <?php echo date('d M Y', strtotime($clan->updated_at)) ?></p>
<?php endif ?>
<p><?php echo HTML::image(Media_Local_Clan::get($clan->id), array('alt' => $clan->name)); ?></p>
<p>
	Članovi:
	<ul>
		<?php foreach ($users as $user): ?>
			<li>
				<?php echo HTML::anchor('igraci/'.$user->accountid, $user->username); ?>
				<?php if (Steam::userinfo('id') == $clan->lord_id AND Steam::userinfo('id') != $user->id): ?>
					<?php echo HTML::anchor('#', 'Izbaci', array('class' => 'form_submit', 'data-form' => 'izbaci')); ?>
					<?php echo Form::open('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE).'/igraci/'.$user->id.'/izbaci', array('class' => 'hidden izbaci')); ?>
						<?php echo Form::hidden('csrf', Security::token()); ?>
					<?php echo Form::close(); ?>
				<?php endif ?>
			</li>
		<?php endforeach ?>
	</ul>
</p>

<?php if ($can_apply): ?>
	<?php echo HTML::anchor('#', 'Podnesi prijavu', array('class' => 'form_submit', 'data-form' => 'prijava')); ?>
	<?php echo Form::open('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE).'/prijava', array('class' => 'hidden prijava')); ?>
		<?php echo Form::hidden('csrf', Security::token()); ?>
	<?php echo Form::close(); ?>
<?php endif ?>

<p>
	Mečevi:
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
				<td><?php echo date('d M Y H:i:s', strtotime($match->date)); ?></td>
			</tr>
		<?php endforeach ?>
	</table>
</p>