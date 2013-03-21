<?php if (count($participations) > 0): ?>
	<ul>
		<?php foreach ($participations as $participation): ?>
			<li>
				<?php echo HTML::image(Media_Local_Clan::get($participation->clan->id), array('alt' => $participation->clan->name)); ?>
				<?php echo HTML::anchor('liga/klanovi/'.$participation->clan->id.'-'.URL::title($clan->name, '-', TRUE), $participation->clan->name); ?>
				<?php if ($participation->is_approved == FALSE AND $count < $tournament->num_clans): ?>
					<?php echo HTML::anchor('#', 'Odobri', array('class' => 'form_submit', 'data-form' => 'odobri')); ?>
					<?php echo Form::open('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE).'/prijave/'.$participation->id.'/odobri', array('class' => 'hidden odobri')); ?>
						<?php echo Form::hidden('csrf', Security::token()); ?>
					<?php echo Form::close(); ?>
				<?php elseif ($participation->is_approved): ?>
					<?php echo HTML::anchor('#', 'Odbij', array('class' => 'form_submit', 'data-form' => 'odbij')); ?>
					<?php echo Form::open('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE).'/prijave/'.$participation->id.'/odbij', array('class' => 'hidden odbij')); ?>
						<?php echo Form::hidden('csrf', Security::token()); ?>
					<?php echo Form::close(); ?>
				<?php endif ?>
			</li>
		<?php endforeach ?>
	</ul>
<?php else: ?>
	Trenutno nema prijava.
<?php endif ?>