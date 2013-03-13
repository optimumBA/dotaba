<?php if (count($applications) > 0): ?>
	<ul>
		<?php foreach ($applications as $application): ?>
			<li>
				<?php echo HTML::image(Media_Remote_Avatar::get($application->user->id, $application->user->avatar), array('alt' => $application->user->username)); ?>
				<?php echo HTML::anchor('igraci/'.$application->user->accountid, $application->user->username); ?>
				<?php echo HTML::anchor('#', 'Odobri', array('class' => 'form_submit', 'data-form' => 'odobri')); ?>
				<?php echo HTML::anchor('#', 'Odbij', array('class' => 'form_submit', 'data-form' => 'odbij')); ?>
				<?php echo Form::open('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE).'/prijave/'.$application->id.'/odobri', array('class' => 'hidden odobri')); ?>
					<?php echo Form::hidden('csrf', Security::token()); ?>
				<?php echo Form::close(); ?>
				<?php echo Form::open('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE).'/prijave/'.$application->id.'/odbij', array('class' => 'hidden odbij')); ?>
					<?php echo Form::hidden('csrf', Security::token()); ?>
				<?php echo Form::close(); ?>
			</li>
		<?php endforeach ?>
	</ul>
<?php else: ?>
	Trenutno nema prijava.
<?php endif ?>