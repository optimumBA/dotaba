Pozivnica poslano: <?php echo $count; ?>.<br />
<?php if ($max->loaded()): ?>
	Najviše poslao/la <?php echo HTML::anchor('igraci/'.$max->giver->accountid, $max->giver->username); ?> (<?php echo $max->count; ?>).
<?php endif ?>

<div class="request">
	<?php if ($request->loaded()): ?>
		<?php if ($request->removed OR $request->processed): ?>
			Već si slao/la zahtjev.
		<?php elseif ($request->giver_id): ?>
			Korisnik/ca <?php echo HTML::anchor('igraci/'.$request->giver->accountid, $request->giver->username); ?> je odgovorio/la na zahtjev. 
			Ukoliko si primio/la pozivnicu, klikni na sljedeći link da obrišeš zahtjev:
			<?php echo HTML::anchor('#', 'završi', array('class' => 'form_submit', 'data-form' => 'zavrsi')); ?>
			<?php echo Form::open('pozivnice/'.$request->id.'/zavrsi', array('class' => 'hidden zavrsi')); ?>
				<?php echo Form::hidden('csrf', Security::token()); ?>
			<?php echo Form::close(); ?>
		<?php else: ?>
			Niko se još nije prijavio da ti pošalje pozivnicu. Ako već imaš DOTA2, obriši zahtjev.
			<?php echo HTML::anchor('#', 'obriši', array('class' => 'form_submit', 'data-form' => 'obrisi')); ?>
			<?php echo Form::open('pozivnice/'.$request->id.'/obrisi', array('class' => 'hidden obrisi')); ?>
				<?php echo Form::hidden('csrf', Security::token()); ?>
			<?php echo Form::close(); ?>
		<?php endif ?>
	<?php else: ?>
		Ako još uvijek nemaš DOTA2, možeš tražiti pozivnicu klikom na sljedeći link: 
		<?php echo HTML::anchor('#', 'traži', array('class' => 'form_submit', 'data-form' => 'trazi')); ?>
		<?php echo Form::open('pozivnice/trazi', array('class' => 'hidden trazi')); ?>
			<?php echo Form::hidden('csrf', Security::token()); ?>
		<?php echo Form::close(); ?>
	<?php endif ?>
</div>

<div class="requests">
	Da neko ne bi dobio više od jedne pozivnice, prvo ovdje pokažite da ćete je poslati, a zatim je pošaljite preko Steama.

	<?php if (count($requests) > 0): ?>
		<ul>
			<?php foreach ($requests as $request): ?>
				<li>
					<?php echo HTML::anchor('igraci/'.$request->user->accountid, $request->user->username); ?>
					<?php if ($request->user_id != User::instance()->id AND ( ! $request->loaded() OR $request->removed OR $request->processed)): ?>
						<?php echo HTML::anchor('#', 'pošalji', array('class' => 'form_submit', 'data-form' => 'posalji')); ?>
						<?php echo Form::open('pozivnice/'.$request->id.'/posalji', array('class' => 'hidden posalji')); ?>
							<?php echo Form::hidden('csrf', Security::token()); ?>
						<?php echo Form::close(); ?>
					<?php endif ?>
				</li>
			<?php endforeach ?>
		</ul>
	<?php else: ?>
		Trenutno niko ne traži pozivnicu.
	<?php endif ?>
</div>

<div class="giveaways">
	<?php if (count($giveaways) > 0): ?>
		Korisnici kojima trebaš poslati pozivnicu:
		<ul>
			<?php foreach ($giveaways as $giveaway): ?>
				<li>
					<?php echo HTML::anchor('igraci/'.$giveaway->user->accountid, $giveaway->user->username); ?>
					<?php echo HTML::anchor('#', 'otkaži', array('class' => 'form_submit', 'data-form' => 'otkazi')); ?>
					<?php echo Form::open('pozivnice/'.$giveaway->id.'/otkazi', array('class' => 'hidden otkazi')); ?>
						<?php echo Form::hidden('csrf', Security::token()); ?>
					<?php echo Form::close(); ?>
				</li>
			<?php endforeach ?>
		</ul>
	<?php endif ?>
</div>