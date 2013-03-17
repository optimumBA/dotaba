<p>Username: <?php echo $user->username; ?></p>
<p>Ime: <?php echo $user->name; ?></p>
<p>Država: <?php echo $user->location; ?></p>
<p>URL: <?php echo HTML::anchor($user->profileurl); ?></p>
<p>Registrovan/a: <?php echo Date::formatted_time($user->created_at); ?></p>
<p>Klan: <?php echo ($user->clan_id) ? HTML::anchor('liga/klanovi/'.$user->clan->id.'-'.URL::title($user->clan->name, '-', TRUE), $user->clan->name) : ''; ?></p>
<?php if ($user->featured_hero_id): ?>
	<p>
		Omiljeni heroj: <?php echo HTML::image(Media_Remote_Hero::get($user->featured_hero->id, $user->featured_hero->image), array('alt' => $user->featured_hero->name)); ?>>
	</p>
<?php endif ?>

<?php echo HTML::image(Media_Remote_Avatar::get($user->id, $user->avatar), array('alt' => $user->username)); ?>

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
				<td><?php echo Date::formatted_time($match->date); ?></td>
			</tr>
		<?php endforeach ?>
	</table>
</p>

<?php echo View::factory('comments', array('comments' => $comments, 'object_id' => $user->id, 'object_type' => 'User')); ?>