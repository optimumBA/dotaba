<div class="clear"></div>
    <!-- Banner Start -->
    <div id="sub-banner">
    	<div class="in">
        	<a href="#"><img src="/assets/images/banner-profile.jpg" alt="Dota 2 turnir - <?php echo $tournament->name; ?>" /></a>
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
                    	<h1 class="heading colr"><?php echo $tournament->name; ?></h1>
                        <!-- Post Detail Start -->
                        <div class="post-detail">
                        	<div class="thumb">
                            	<?php echo HTML::image(Media_Local_Tournament::get($tournament->id), array('alt' => $tournament->name, 'width' => 680)); ?>
                            </div>
                            <div class="desc">
                                <div class="post-opts">
                                   	<p>Počeo: <?php echo ($tournament->is_started) ? 'Da' : 'Ne'; ?></p>
                                    <p><?php echo Date::formatted_time($tournament->created_at); ?></p>
                                    <p>Potreban broj klanova: <?php echo $tournament->num_clans; ?></p>
                                    <p>Môd: <?php echo $tournament->mode->name; ?></p>
                                    <?php if ($tournament->finished_at): ?><p>Završen: <?php echo Date::formatted_time($tournament->finished_at); ?></p><?php endif ?>
                                    <p><?php echo count($comments) ?> komentara</p>
                                   
                                </div>
                                <p>
                                    <?php echo HTML::parse_bbcode($tournament->description); ?>
                                </p>
                               	<div class="clear"></div>
                                <hr />
                                 
                                  
                                <?php if (User::instance()->has_role('Organizator/ica turnira')): ?>
									<?php if ( ! $tournament->is_started AND $count == $tournament->num_clans): ?>
									<?php echo HTML::anchor('#', 'Započni turnir', array('class' => 'form_submit', 'data-form' => 'start')); ?>
                               <?php echo Form::open('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE).'/start', array('class' => 'hidden start')); ?>
                                    <?php echo Form::hidden('csrf', Security::token()); ?>
                                    <?php echo Form::close(); ?>
								<?php endif ?>
	
								<?php echo HTML::anchor('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE).'/izmijeni', 'Izmijeni', array('class' => 'bigbutton')); ?>
								<?php endif ?>
                                
                                <?php if ($can_apply): ?>
                                    <?php echo HTML::anchor('#', 'Prijava klana', array('class' => 'form_submit bigbutton', 'data-form' => 'prijavi')); ?>
                                    <?php echo Form::open('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name, '-', TRUE).'/prijavi', array('class' => 'hidden prijavi')); ?>
                                        <?php echo Form::hidden('csrf', Security::token()); ?>
                                    <?php echo Form::close(); ?>
                                <?php endif ?>
								
                                <div class="clear"></div>
                                <hr />
          
                           

  <div class="clear"></div>
  
  
  <p>
								<h4 class="colr">Mečevi</h4>
	  							<br />
     								<div class="matchlist">

    									<table>
											<tr>
												<td>ID</td>
                                                <td>Radiant</td>
                                                <td>Dire</td>
                                                <td>Vrijeme odigravanja</td>
											</tr>
											
											<?php foreach ($matches as $match): ?>
											<tr>
												<td><h6><?php echo HTML::anchor('liga/mecevi/'.$match->id, $match->id); ?></h6></td>
												
      											 <td><h6><?php echo ($match->radiant_clan_id) ? HTML::anchor('liga/klanovi/'.$match->radiant_clan->id.'-'.URL::title($match->radiant_clan->name, '-', TRUE), '<span class="radiant-team">'.$match->radiant_clan->name.'</a>') : NULL; ?>
                                                </h6>
                                                </td>
												<td><h6><?php echo ($match->dire_clan_id) ? HTML::anchor('liga/klanovi/'.$match->dire_clan->id.'-'.URL::title($match->dire_clan->name, '-', TRUE), '<span class="dire-team">'.$match->dire_clan->name.'</a>') : NULL; ?>
                                               </h6> </td>
												<td><h6 class="white"><?php echo ($match->date) ? Date::formatted_time($match->date) : '-'; ?></h6></td>
											</tr>
											<?php endforeach ?>
										</table>
  						  			</div>
								</p>
                     			<div class="clear"></div>
                                <hr />
                             
                             
                             
                             
                               
                                <div class="post-share">
                                	<ul>
                                    
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <!-- Post Detail End -->
                        
     <?php echo View::factory('comments', array('comments' => $comments, 'object_id' => $tournament->id, 'object_type' => 'Tournament')); ?>
                    </div>
               
                </div>
                <!-- Column One End -->
                <!-- Column One Start -->
                <div class="col1 hidemobile">
                	
                  <?php if(User::instance()->logged_in() AND User::instance()->has_role('Organizator/ica turnira')):?>
                  <div class="widget opcije">
                    	<h1 class="heading colr">Opcije</h1>
                        <div class="desc">
                        	<h4><?php echo HTML::anchor('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name).'/izmijeni', 'Izmijeni turnir'); ?></h4>
                            <?php if ($tournament->updated_at): ?>
							<h6 class="white">Zadnji put izmijenjen: <?php echo Date::formatted_time($tournament->updated_at); ?></h6>
							<?php endif ?>
                            
                          
                           
                          
							<p class="white"><?php echo HTML::anchor('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name).'/prijave', 'Pogledaj prijave timova'); ?>
                           </p>
                           
                        </div>
                    </div>
                    <?php endif;?>
                  
				  <?php if ($tournament->winner_id): ?>
                   <div class="widget">
                    	<h1 class="heading colr">Pobjednik</h1>
                        <div class="thumb">
                        	<?php echo HTML::image(Media_Local_Clan::get($tournament->winner->id), array('alt' => $tournament->winner->name, 'width' => 209, 'class' => 'frame')); ?>
                        </div>
                        <div class="desc">
                        	<h4><?php echo HTML::anchor('liga/klanovi/'.$tournament->winner->id.'-'.URL::title($tournament->winner->name, '-', TRUE), $tournament->winner->name); ?></h4>
                          	
                        </div>
                    </div>
				   <?php endif ?>
				   
				 
                                    
					<div class="widget ourteam noback">
                    	<h1 class="heading colr">Prijavljeni timovi (<?php echo count($clans);?>)</h1>
                        <ul class="teamlist">
                        	<?php foreach ($clans as $clan): ?>
                            <li>
                            <?php echo HTML::anchor('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE), HTML::image(Media_Local_Clan::get($clan->id), array('alt' => $clan->name, 'width' => 60, 'height' => 60, 'class' => 'frame')), array('class' => 'thumb')); ?>	
                                
                               
                                <div class="desc">
                                	<h4><?php echo HTML::anchor('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE), $clan->name, array('class' => 'white')); ?></h4>
                                    <p>Lord: <?php echo $clan->lord->username;?></p>
                                    <p class="txt">Klan je prijavljen na turnir.</p>
                                </div>
                            </li>
                         <?php endforeach ?>
                        </ul>
                    </div>
					
                   


                   
				  
                   
                </div>
                <!-- Column One End -->
            </div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Content Section End -->
    <div class="clear"></div>