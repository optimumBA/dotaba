<p>Naziv: <?php echo $tournament->name; ?></p>
<p>Opis: <?php echo HTML::parse_bbcode($tournament->description); ?></p>
<p>Môd: <?php echo $tournament->mode->name; ?></p>
<p>Potreban broj klanova: <?php echo $tournament->num_clans; ?></p>
<p>Počeo: <?php echo ($tournament->is_started) ? 'da' : 'ne'; ?></p>
<?php if ($tournament->winner_id): ?>
	<p>Pobjednici: <?php echo HTML::anchor('liga/klanovi/'.$tournament->winner->id.'-'.URL::title($tournament->winner->name, '-', TRUE), $tournament->winner->name); ?></p>
<?php endif ?>
<p>Napravljen: <?php echo Date::formatted_time($tournament->created_at); ?></p>
<?php if ($tournament->updated_at): ?>
	<p>Izmijenjen: <?php echo Date::formatted_time($tournament->updated_at); ?></p>
<?php endif ?>
<?php if ($tournament->finished_at): ?>
	<p>Završen: <?php echo Date::formatted_time($tournament->finished_at); ?></p>
<?php endif ?>
<p><?php echo HTML::image(Media_Local_Tournament::get($tournament->id), array('alt' => $tournament->name)); ?></p>
<?php if (User::instance()->id == $tournament->user_id): ?>
	<?php if ( ! $tournament->is_started AND $count == $tournament->num_clans): ?>
		<?php echo HTML::anchor('#', 'Započni turnir', array('class' => 'form_submit', 'data-form' => 'start')); ?>
		<?php echo Form::open('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE).'/start', array('class' => 'hidden start')); ?>
			<?php echo Form::hidden('csrf', Security::token()); ?>
		<?php echo Form::close(); ?>
	<?php endif ?>
	<?php echo HTML::anchor('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE).'/izmijeni', 'Izmijeni'); ?>
<?php endif ?>
<?php if ($can_apply): ?>
	<?php echo HTML::anchor('#', 'Prijava klana', array('class' => 'form_submit', 'data-form' => 'prijavi')); ?>
	<?php echo Form::open('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE).'/prijavi', array('class' => 'hidden prijavi')); ?>
		<?php echo Form::hidden('csrf', Security::token()); ?>
	<?php echo Form::close(); ?>
<?php endif ?>
<p>
	Klanovi:
	<ul>
		<?php foreach ($clans as $clan): ?>
			<li>
				<?php echo HTML::image(Media_Local_Clan::get($clan->id), array('alt' => $clan->name)); ?>
				<?php echo HTML::anchor('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE), $clan->name); ?>
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
				<td><?php echo ($match->radiant_clan_id) ? HTML::anchor('liga/klanovi/'.$match->radiant_clan->id.'-'.URL::title($match->radiant_clan->name, '-', TRUE), $match->radiant_clan->name) : NULL; ?></td>
				<td><?php echo ($match->dire_clan_id) ? HTML::anchor('liga/klanovi/'.$match->dire_clan->id.'-'.URL::title($match->dire_clan->name, '-', TRUE), $match->dire_clan->name) : NULL; ?></td>
				<td><?php echo ($match->date) ? Date::formatted_time($match->date) : '-'; ?></td>
			</tr>
		<?php endforeach ?>
	</table>
</p>

<?php echo View::factory('comments', array('comments' => $comments, 'object_id' => $tournament->id, 'object_type' => 'Tournament')); ?>