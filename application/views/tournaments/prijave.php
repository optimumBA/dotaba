<!-- Banner Start -->
    <div id="sub-banner">
    	<div class="in">
        	<a href="#"><img src="/assets/images/banner-profile.jpg" alt="Dota 2 Balkan Igrači" /></a>
        </div>
    </div>
    <!-- Banner End -->
    <!-- Album Shades Start -->
    <div id="album-shelves">
    	<h1 class="heading colr">Pregled prijavljenih klanova</h1>
    	<div class="inner">
        	<!-- Columns Section Start -->
            <ul class="album-list">
            
            			

<?php if (count($participations) > 0): ?>

		<?php foreach ($participations as $participation): ?>
			<li>
				
				<?php echo HTML::anchor('liga/klanovi/'.$participation->clan->id.'-'.URL::title($participation->clan->name, '-', TRUE), HTML::image(Media_Local_Clan::get($participation->clan->id), array('alt' => $participation->clan->name, 'width' => 184, 'height' => 184)), array('class' => 'thumb')); ?>
				
                
                <h3><?php echo HTML::anchor('liga/klanovi/'.$participation->clan->id.'-'.URL::title($participation->clan->name), $participation->clan->name, array('class' => 'colr'));?></h3>
				
                <p>
                <?php echo HTML::anchor('igraci/'.$participation->clan->lord->accountid.'', HTML::image(Media_Remote_Avatar::get($participation->clan->lord->id, $participation->clan->lord->avatar), array('width' => 48, 'class' => 'steam-status status-s-'.$participation->clan->lord->status))); ?>
             	<h6>Lord: <?php echo HTML::anchor('igraci/'.$participation->clan->lord->accountid.'', $participation->clan->lord->username);?></h6>
				
				
				
			</p>
				
				
				<?php if ($participation->is_approved == FALSE AND $count < $tournament->num_clans): ?>
					<?php echo HTML::anchor('#', 'Odobri', array('class' => 'form_submit bigbutton', 'data-form' => 'odobri')); ?>
					<?php echo Form::open('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE).'/prijave/'.$participation->id.'/odobri', array('class' => 'hidden odobri')); ?>
						<?php echo Form::hidden('csrf', Security::token()); ?>
					<?php echo Form::close(); ?>
				<?php elseif ($participation->is_approved): ?>
					<?php echo HTML::anchor('#', 'Odbij', array('class' => 'form_submit bigbutton', 'data-form' => 'odbij')); ?>
					<?php echo Form::open('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE).'/prijave/'.$participation->id.'/odbij', array('class' => 'hidden odbij')); ?>
						<?php echo Form::hidden('csrf', Security::token()); ?>
					<?php echo Form::close(); ?>
				<?php endif ?>
			</li>
		<?php endforeach ?>
	
<?php else: ?>
	<div class="alert alert-info">Trenutno nema prijava.</div>

<?php endif ?>
<div class="clear"></div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Album Shades End -->
    <div class="clear"></div>