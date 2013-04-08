<div class="clear"></div>
<div id="sub-banner">
	<div class="in">
		<a href="#"><img src="/assets/images/banner-profile.jpg" alt="Dota 2 Balkan Forum" /></a>
	</div>
</div>
<div id="album-shelves">
	<h1 class="heading colr">Giveaway</h1>
	<div class="inner">
		<h3 class="white">
			Pozivnica poslano: <?php echo $count; ?><br />
			<?php if ($max->loaded()): ?>
				Najviše poslao/la <?php echo HTML::anchor('igraci/'.$max->giver->accountid, $max->giver->username); ?> (<?php echo $max->count; ?>)
			<?php endif ?>
		</h3>
		<?php if ($request->loaded()): ?>
			<?php if ($request->processed): ?>
				Već si slao/la zahtjev.
			<?php elseif ($request->giver_id): ?>
				Korisnik/ca <?php echo HTML::anchor('igraci/'.$request->giver->accountid, $request->giver->username); ?> je odgovorio/la na zahtjev. 
				Ukoliko si primio/la pozivnicu, klikni na sljedeći link da obrišeš zahtjev:
				<?php echo HTML::anchor('#', 'završi', array('class' => 'form_submit button', 'data-form' => 'zavrsi')); ?>
				<?php echo Form::open('pozivnice/'.$request->id.'/zavrsi', array('class' => 'hidden zavrsi')); ?>
					<?php echo Form::hidden('csrf', Security::token()); ?>
				<?php echo Form::close(); ?>
			<?php else: ?>
				Niko se još nije prijavio da ti pošalje pozivnicu. Ako već imaš DOTA2, obriši zahtjev.
				<?php echo HTML::anchor('#', 'obriši', array('class' => 'form_submit button', 'data-form' => 'obrisi')); ?>
				<?php echo Form::open('pozivnice/obrisi', array('class' => 'hidden obrisi')); ?>
					<?php echo Form::hidden('csrf', Security::token()); ?>
				<?php echo Form::close(); ?>
			<?php endif ?>
		<?php else: ?>
			Ako još uvijek nemaš DOTA2, možeš tražiti pozivnicu klikom na sljedeći link: 
			<?php echo HTML::anchor('#', 'traži', array('class' => 'form_prompt_submit button', 'data-form' => 'trazi')); ?>
			<?php echo Form::open('pozivnice/trazi', array('class' => 'hidden trazi', 'data-query' => 'Email adresa:', 'data-key' => 'email')); ?>
				<?php echo Form::hidden('email'); ?>
				<?php echo Form::hidden('csrf', Security::token()); ?>
			<?php echo Form::close(); ?>
		<?php endif ?>
		<div class="clear"></div>
		<?php if (count($requests)): ?>
			<h3 class="white">Zahtjevi za pozivnicu</h3>
			Da neko ne bi dobio više od jedne pozivnice, prvo ovdje pokažite da ćete je poslati, a zatim je pošaljite preko Steama.
			<ul class="album-list">
				<?php foreach ($requests as $r): ?>
					<li>
						<?php echo HTML::anchor('/igraci/'.$r->user->accountid, HTML::image(Media_Remote_Avatar::get($r->user->id, $r->user->avatar), array('alt' => $r->user->username)), array('class' => 'thumb')); ?>
						<h3 class="colr"><?php echo $r->user->username; ?></h3>
						<?php if ($r->user_id != User::instance()->id AND ( ! $request->loaded() OR $request->processed)): ?>
							<?php echo HTML::anchor('#', 'pošalji', array('class' => 'form_submit bigbutton', 'data-form' => 'posalji')); ?>
							<?php echo Form::open('pozivnice/'.$r->id.'/posalji', array('class' => 'hidden posalji')); ?>
								<?php echo Form::hidden('csrf', Security::token()); ?>
							<?php echo Form::close(); ?>
						<?php endif ?>
					</li>
				<?php endforeach ?>
			</ul>
			<div class="clear"></div>
		<?php endif ?>
		<?php if (count($giveaways)): ?>
			<h3 class="white">Korisnici kojima trebaš poslati pozivnicu</h3>
			<ul class="album-list">
				<?php foreach ($giveaways as $giveaway): ?>
					<li>
						<?php echo HTML::anchor('/igraci/'.$giveaway->user->accountid, HTML::image(Media_Remote_Avatar::get($giveaway->user->id, $giveaway->user->avatar), array('alt' => $giveaway->user->username)), array('class' => 'thumb')); ?>
						<h3 class="colr"><?php echo $giveaway->user->username; ?></h3>
						<p><?php echo $giveaway->email; ?></p>
						<?php echo HTML::anchor('#', 'otkaži', array('class' => 'form_submit bigbutton', 'data-form' => 'otkazi')); ?>
						<?php echo Form::open('pozivnice/'.$giveaway->id.'/otkazi', array('class' => 'hidden otkazi')); ?>
							<?php echo Form::hidden('csrf', Security::token()); ?>
						<?php echo Form::close(); ?>
					</li>
				<?php endforeach ?>
			</ul>
			<div class="clear"></div>
		<?php endif ?>
	</div>
</div>