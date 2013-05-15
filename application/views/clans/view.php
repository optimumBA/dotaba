<div class="clear"></div>
    <!-- Banner Start -->
    <div id="sub-banner">
    	<div class="in">
        	<a href="#"><img src="/assets/images/banner-profile.jpg" alt="Korisničke statistike - Dota 2" /></a>
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
                	<div class="album-detail">
						<h1 class="heading colr"><?php echo $clan->name; ?> (<?php echo $clan->tag; ?>)</h1>

						
                        <div class="album-detail-sec">
                        	<div class="thumb">

							<?php echo HTML::image(Media_Local_Clan::get($clan->id), array('alt' => $clan->name)); ?>

 							</div>
                        <div class="desc">
							<p class="release">Napravljen: <?php echo Date::formatted_time($clan->created_at); ?></p>
                           <?php if ($can_apply): ?>
                            
								<?php echo HTML::anchor('#', 'Podnesi prijavu', array('class' => 'form_submit buttonone', 'data-form' => 'prijava')); ?>
								<?php echo Form::open('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE).'/prijava', array('class' => 'hidden prijava')); ?>
								<?php echo Form::hidden('csrf', Security::token()); ?>
								<?php echo Form::close(); ?>
    						
							<?php endif ?>


							 </div>
                        </div>
                        <div class="clear"></div>


						 <div class="album-track-list">
                        	        <h1 class="heading colr">Lista članova</h1>
                                    
                                    <div class="matchlist">
                						
                                        <table>
                    							<tr>
                        							<td width="20px">Avatar</td>
                                                    <td>Korisnik<br /></td>
                        							<td width="250px">Opcije</td>
                                                </tr>
                                                
                                               
                                               
                                                <?php foreach ($users as $user): ?>
				
                <tr>
               <td width="20px">
				<?php echo HTML::image(Media_Remote_Avatar::get($user->id, $user->avatar), array('alt' => $user->username, 'class' => 'steam-avatar status-s-'.$user->status.'', 'width' => 48)); ?>
                </td>
                
                <td><h4><?php echo HTML::anchor('igraci/'.$user->accountid, $user->username, array('class' => 'white')); ?></h4></td>
				<td>
				<?php if (User::instance()->id == $clan->lord_id AND User::instance()->id != $user->id): ?>
				
                <?php echo HTML::anchor('#', 'Izbaci', array('class' => 'form_submit buttonone', 'data-form' => 'izbaci')); ?>
				
				<?php echo Form::open('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE).'/igraci/'.$user->id.'/izbaci', array('class' => 'hidden izbaci')); ?>
						<?php echo Form::hidden('csrf', Security::token()); ?>
						<?php echo Form::close(); ?>
				
                <?php elseif(User::instance()->id == $clan->lord_id):?>
                <div class="alert alert-info">Vi ste Lord klana.</div>
                <?php endif ?>
                </td>
			</tr>
		<?php endforeach ?>
                                           
           
                                      
                                      </table>
                                   </div>

								<div class="clear"></div>
                                
                                
                                </div>
                                
                                <div class="clear"></div>
                       
                    
                    
                    
                    
                    <div class="album-track-list">
                        	        <h1 class="heading colr">Mečevi</h1>
                                    
                                    <div class="matchlist">
                						
                                    
                                    
                                    
                                    <table>
		<tr>
			<td>ID</td>
			<td>Tip</td>
			<td>Mod</td>
			<td>Turnir</td>
			<td>Radiant</td>
			<td>Dire</td>
			<td>Vrijeme odigravanja</th>
		</tr>
		<?php foreach ($matches as $match): ?>
			<tr>
				<td><h6><?php echo HTML::anchor('liga/mecevi/'.$match->id, $match->id); ?></h6></td>
				<td><h6 class="colr"><?php echo $match->type->name; ?></h6></td>
				<td><h6 class="white"><?php echo $match->mode->name; ?></h6></td>
				<td><h6><?php echo ($match->tournament_id) ? HTML::anchor('liga/turniri/'.$match->tournament->id.'-'.URL::title($match->tournament->name, '-', TRUE), $match->tournament->name) : NULL; ?></h6></td>
				<td><h6><?php echo ($match->radiant_clan_id) ? HTML::anchor('liga/klanovi/'.$match->radiant_clan->id.'-'.URL::title($match->radiant_clan->name, '-', TRUE), '<span class="radiant-team">'.$match->radiant_clan->name.'</a>') : NULL; ?></h6></td>
				<td><h6><?php echo ($match->dire_clan_id) ? HTML::anchor('liga/klanovi/'.$match->dire_clan->id.'-'.URL::title($match->dire_clan->name, '-', TRUE), '<span class="dire-team">'.$match->dire_clan->name.'</a>') : NULL; ?></h6></td>
				<td><h6 class="white"><?php echo date('d M Y H:i:s', strtotime($match->date)); ?></h6></td>
			</tr>
		<?php endforeach ?>
	</table>
                                    
                                    
            
                       
                                    
                                    </div>

								<div class="clear"></div>
                                
                                
                      </div>
                                
                      <div class="clear"></div>
                    
                    
                    
                    
                    
                    
                    
                    <?php echo View::factory('comments', array('comments' => $comments, 'object_id' => $clan->id, 'object_type' => 'Clan')); ?>
                    
                    
                    
                    
                    </div>
                </div>
                <!-- Column One End -->
                <!-- Column One Start -->
                <div class="col1 hidemobile">
                    <!-- Featured Hero Start -->
                   <?php if(User::instance()->id == $clan->lord_id):?>
                    <div class="widget opcije">
                        
                       <h1 class="heading colr">Opcije</h1>
                       <div class="desc">
					   	<h4><?php echo HTML::anchor('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name).'/izmijeni', 'Izmijeni klan'); ?></h4>
						 <h6 class="colr"><?php echo HTML::anchor('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name).'/prijave', 'Pogledaj prijave'); ?></h6>
						<?php if (isset($clan->updated_at)): ?>
						<h6 class="white">Zadnji put izmijenjen: <?php echo Date::formatted_time($clan->updated_at); ?></h6>
                       	<?php endif ?>
                        
                        </div>

                    </div>
<?php endif;?>                    
                </div>
                <!-- Column One End -->
            </div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Content Section End -->
    <div class="clear"></div>


