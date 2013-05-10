<!-- Banner Start -->
    <div id="sub-banner">
    	<div class="in">
        	<a href="#"><img src="/assets/images/banner-profile.jpg" alt="Dota 2 Balkan Igrači" /></a>
        </div>
    </div>
    <!-- Banner End -->
    <!-- Album Shades Start -->
    <div id="album-shelves">
    	<h1 class="heading colr">Pregled prijava igrača</h1>
    	<div class="inner">
        	<!-- Columns Section Start -->
            <ul class="album-list">
            
<?php if (count($applications) > 0): ?>
	
		<?php foreach ($applications as $application): ?>
			<li>
				
                <?php echo HTML::anchor('igraci/'.$application->user->accountid, HTML::image(Media_Remote_Avatar::get($application->user->id, $application->user->avatar), array('alt' => $application->user->username, 'width' => 184, 'height' => 184, 'class' => 'steam-avatar status-'.$application->user->status)), array('class' => 'thumb')); ?>
                
			
				<h3 class="colr"><?php echo HTML::anchor('igraci/'.$application->user->accountid, $application->user->username); ?></h3>
				
				<br /><br /><br />
				<?php echo HTML::anchor('#', 'Odobri', array('class' => 'form_submit bigbutton', 'data-form' => 'odobri')); ?>
                <br />
				<?php echo HTML::anchor('#', 'Odbij', array('class' => 'form_submit bigbutton', 'data-form' => 'odbij')); ?>
				<?php echo Form::open('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE).'/prijave/'.$application->id.'/odobri', array('class' => 'hidden odobri')); ?>
					<?php echo Form::hidden('csrf', Security::token()); ?>
				<?php echo Form::close(); ?>
				<?php echo Form::open('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE).'/prijave/'.$application->id.'/odbij', array('class' => 'hidden odbij')); ?>
					<?php echo Form::hidden('csrf', Security::token()); ?>
				<?php echo Form::close(); ?>
			</li>
		<?php endforeach ?>
	
<?php else: ?>
	<div class="alert alert-info">Trenutno nema prijava.</div>
<?php endif ?><div class="clear"></div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Album Shades End -->
    <div class="clear"></div>