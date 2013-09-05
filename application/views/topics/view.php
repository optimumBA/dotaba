<div class="clear"></div>
    <!-- Banner Start -->
    <div id="sub-banner">
    	<div class="in">
        	<a href="#"><img src="/assets/images/banner-profile.jpg" alt="Dota 2 tema - <?php echo $topic->name;?>" /></a>
        </div>
    </div>
    <!-- Banner End -->
    <!-- Content Section Start -->
    <div id="content-sec">
    	<div class="inner">
        	<!-- Columns Section Start -->
            <div class="columns-sec twocol">
            	<!-- Column Three Start -->
                <div class="col3">
                	<div class="blog">
                    	
                      
                        
     
     
     
     
     
     <div class="comments">
                            
                            
                            
                            <h1 class="heading colr">Odgovori na temu "<?php echo $topic->name;?>"</h1>
                  

	<?php if ( ! User::instance()->logged_in()): ?>
		<div class="alert alert-error">Moraš biti prijavljen/a kako bi ostavio/la komentar. <a class="steamloginBttn-barTop  steamLoginText-wlcmsg embossed-link" href="/provjera#steamLogin">Prijavi se putem Steam-a</a></div>
	<?php endif; ?>
              <?php if ($topic->is_locked): ?>
	<h4><a class="white">Tema je zaključana.</a></h4>
    <div class="clear"></div>
<?php endif ?>
                            <ul>
                               <?php foreach ($posts as $post): ?>
                               
                                <li>
                                    <div class="avatar">
                            <?php echo HTML::image(Media_Remote_Avatar::get($post->user->id, $post->user->avatar), array('alt' => $post->user->username, 'width' => 60, 'height' => 60, 'class' => 'status-'.$post->user->status.'')); ?>
                            </div>
                                    <div class="desc">
                                        <h5><?php echo HTML::anchor('igraci/'.$post->user->accountid, $post->user->username); ?></h5>
      									<p class="ago"><?php echo Date::formatted_time($post->created_at); ?></p>                                        
            							<div class="clear"></div>    

                                       <?php if ($post->updated_at): ?>
										<p class="tm">Zadnja izmjena u <?php echo Date::formatted_time($post->updated_at); ?></p>
										<?php endif ?>
                                        
										<?php if ($post->id != $topic->main_post_id AND ($post->user_id == User::instance()->id OR User::instance()->has_role('Administrator/ica'))): ?>
			<?php echo HTML::anchor('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE).'/postovi/'.$post->id.'/izmijeni', 'Izmijeni', array('class' => 'izmijeni')); ?>
		<?php endif ?>
                                        <?php if ($post->id != $topic->main_post_id AND User::instance()->has_role('Administrator/ica')): ?>
			<?php echo HTML::anchor('#', 'Obriši', array('class' => 'form_submit obrisi', 'data-form' => 'obrisi')); ?>
			<?php echo Form::open('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE).'/postovi/'.$post->id.'/obrisi', array('class' => 'hidden obrisi')); ?>
				<?php echo Form::hidden('csrf', Security::token()); ?>
			<?php echo Form::close(); ?>
		<?php endif ?>
                                      
                                        
                                        <div class="clear"></div> 
                                        <p class="txt">
                                        	<?php echo HTML::parse_bbcode($post->content); ?>
                                        </p>
                                        <div class="clear"></div>    
                                    </div>
                                </li>
                               
                               <?php endforeach;?>
                               
                            </ul>
                            
                            
                        </div>
     <div class="clear"></div>
     <?php if ( ! User::instance()->logged_in()): ?>
		<div class="alert alert-error">Moraš biti prijavljen/a kako bi ostavio/la komentar. <a class="steamloginBttn-barTop  steamLoginText-wlcmsg embossed-link" href="/provjera#steamLogin">Prijavi se putem Steam-a</a></div>
	<?php endif; ?>
     
    <?php echo $pagination; ?>
     
                    </div>
               
                </div>
                <!-- Column One End -->
                <!-- Column One Start -->
                <div class="col1 hidemobile">
                	
                 
	
				<?php if(User::instance()->logged_in()):?>
                  <div class="widget opcije">
                    	<h1 class="heading colr">Opcije</h1>
                        <div class="desc">
                        
						<?php if ($topic->is_locked == FALSE OR User::instance()->has_role('Administrator/ica')): ?>
                        <h4><?php echo HTML::anchor('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE).'/postovi/napravi', 'Napravi post'); ?></h4>
                       	<?php endif ?>
                        
                        <?php if (User::instance()->id == $topic->user_id AND $topic->is_locked == FALSE OR User::instance()->has_role('Administrator/ica')): ?>
						<h4><?php echo HTML::anchor('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE).'/izmijeni', 'Izmijeni'); ?></h4>
                    	<?php endif ?>

					<?php if (User::instance()->has_role('Administrator/ica')): ?>
                        <h4>
							<?php echo HTML::anchor('#', ($topic->is_locked) ? 'Otključaj' : 'Zaključaj', array('class' => 'form_submit', 'data-form' => 'lock')); ?>
                            <?php echo Form::open('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE).'/lock', array('class' => 'hidden lock')); ?>
	                            <?php echo Form::hidden('csrf', Security::token()); ?>
    	                    <?php echo Form::close(); ?>
                        </h4>
                    
                       <h4>
					   <?php echo HTML::anchor('#', ($topic->is_sticky) ? 'Odlijepi s vrha' : 'Zalijepi za vrh', array('class' => 'form_submit', 'data-form' => 'sticky')); ?>
                       <?php echo Form::open('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE).'/sticky', array('class' => 'hidden sticky')); ?>
                            <?php echo Form::hidden('csrf', Security::token()); ?>
                        <?php echo Form::close(); ?>
                       </h4>
                        
                    
                       <h4>
					   <?php echo HTML::anchor('#', 'Obriši', array('class' => 'form_submit', 'data-form' => 'obrisi')); ?>
                       <?php echo Form::open('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE).'/obrisi', array('class' => 'hidden obrisi')); ?>
                            <?php echo Form::hidden('csrf', Security::token()); ?>
                        <?php echo Form::close(); ?>
                    	<?php endif ?>
                       </h4>
                        
                       
                        </div>
                    </div>
                 <?php endif?>
                   
                   
                </div>
                <!-- Column One End -->
            </div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Content Section End -->
    <div class="clear"></div>