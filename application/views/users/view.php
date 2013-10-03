
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
                    	<h1 class="heading colr"><?php echo $user->username; ?></h1>
                        <!-- Album Detail Start -->
                        <div class="album-detail-sec">
                        	<div class="thumb">
                            	<?php echo HTML::image(Media_Remote_Avatar::get($user->id, $user->avatar), array('alt' => $user->username, 'class' => 'steam-avatar status-'.$user->status.'')); ?>
                            </div>
                            <div class="desc">
                                <p class="release">Registrovan/a: <?php echo Date::formatted_time($user->created_at); ?></p>
                                <p>Ime: <?php echo $user->name; ?></p>
                                <p>Država: <?php echo HTML::image('/assets/images/flags/'.strtolower($user->location).'.png', array('title' => $user->location, 'alt' => $user->location)); ?></p>
                                <p><a class="buttonone" href="<?php echo $user->profileurl; ?>" target="_blank">Steam profil</a></p>
                                <p>
                                    Win rate u zadnjih mjesec dana: <span class="stats-precent"><?php echo ($user->wins || $user->losses || $user->abandons) ? $user->wins / ($user->wins + $user->losses + $user->abandons) * 100 : 0; ?>%</span> 
                                    <div class="clear"></div>
                                    (pobjeda: <span class="stats-wins"><?php echo $user->wins; ?></span>, poraza: <span class="stats-losses"><?php echo $user->losses; ?></span>, izlazaka: <span class="stats-abandons"><?php echo $user->abandons; ?></span>).
                                </p>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <!-- Album Detail End -->
 
                      
                        <!-- Album List Start -->
                        <div class="album-track-list">
                        	        <h1 class="heading colr">Matchmaking</h1>
                                    <div class="alert alert-info">Pregled mečeva odigranih u zadnjih mjesec dana (od <?php echo Date::formatted_time('-1 month', 'j.n.Y.'); ?>).</div>
                                    <?php if (User::instance()->id == $user->id AND ! $user->wins AND ! $user->losses AND ! $user->abandons): ?>
                                        <div class="alert alert-notice">
                                            Da bi vidio/jela svoju statistiku, moraš uključiti opciju dijeljenja informacija o mečevima unutar igre 
                                            (<em>Settings</em> -> <em>Game</em> -> <em>General</em>, zatim pored "Share Match History" klikni na "On").
                                        </div>
                                    <?php endif ?>
                          
                                    <div class="matchlist">
                <table >
                    <tr>
                        <td>Heroj<br /><small><span class="stats-won">Pobjeda</span> | <span class="stats-lost">Poraz</span></small></td>
                        <td>Ime heroja<br /><small><span class="radiant-team">The Radiant</span> | <span class="dire-team">The Dire</span></small></td>
                        <td>Tip</td>
                        <td>Meč ID</td>
                        <td>K</td>
                        <td>D</td>
                        <td>A</td>
                        
                       
                        <td></
                        <td>
                            Vrijeme
                        </td>
                    </tr>
                   <?php foreach ($slots as $slot): ?>
                  
                    <tr>
                        <td width="85px">
							<?php echo HTML::anchor('liga/mecevi/'.$slot->match->id, HTML::image(Media_Remote_Hero::get($slot->hero->id, $slot->hero->image, 'small'), array('alt' => $slot->hero->localized_name, 'title' => $slot->hero->localized_name, 'class' => ((int) ($slot->player_slot / 5) == $slot->match->radiant_win) ? 'stats-lost' : 'stats-won'))); ?>&nbsp; &nbsp;
							
							
							
                            
                            
                        </td>
                       
                       <td width="125px"><a href="/liga/mecevi/<?php echo $slot->match->id;?>"><h6 class="<?php echo ($slot->match->radiant_win) ? 'radiant' : 'dire'; ?>-team"><?php echo $slot->hero->localized_name;?></h6></a></td>
                       
                       	<td><h6 class="colr"><?php echo $slot->match->mode->name; ?></h6></td>
                        <td width="50px"><h6 class="white"><?php echo $slot->match->mid; ?></h6></td>
                        <td><h6 class="kills"><?php echo $slot->kills;?></h6></td>
                        <td><h6 class="deaths"><?php echo $slot->deaths;?></h6></td>
                        <td><h6 class="assists"><?php echo $slot->assists;?></h6></td>
						<td><h6 class="white"><?php echo Date::formatted_time($slot->match->date); ?></h6></td>
                    </tr>
                   
                      <?php endforeach ?> 
                   
                </table>
            </div>
                            <div class="clear"></div>
                            
                            
                            
                            
                            
                        </div>
                        <!-- Album List End -->
                        <!-- Comments Start -->
                      <?php echo Request::factory('komentari/User/'.$user->id)->execute(); ?>
                        <div class="clear"></div>
                        <!-- Comments End -->
                       
                    </div>
                </div>
                <!-- Column One End -->
                <!-- Column One Start -->
                <div class="col1 hidemobile">
                    <!-- Featured Hero Start -->
                    <?php if ($user->featured_hero_id): ?>
                    <div class="widget fhero">
                        <?php echo HTML::image(Media_Remote_Hero::get($user->featured_hero->id, $user->featured_hero->image), array('alt' => $user->featured_hero->localized_name, 'title' => $user->featured_hero->localized_name, 'class' => 'frame')); ?>
                        <span>Omiljeni heroj: <?php echo $user->featured_hero->localized_name;?></span>
                    </div>
                    <?php endif;?>
                    <?php if (User::instance()->can('update', $user)): ?>
                        <?php echo Form::open('igraci/'.$user->accountid.'/izmijeni'); ?>
                            <?php echo Form::label('featured_hero_id', 'Omiljeni heroj:'); ?>
                            <?php echo Form::select('featured_hero_id', $heroes, $user->featured_hero_id); ?>
                            <?php echo Form::hidden('csrf', Security::token()); ?>
                            <?php echo Form::submit(NULL, 'Izmijeni'); ?>
                        <?php echo Form::close(); ?>
                    <?php endif ?>
                    <!-- Featured Hero End -->
                 
                    <?php if($user->clan_id):?>
                    <div class="widget fhero">
                          <div class="desc"><h2 class="colr">Tim</h2></div>
						  <?php echo HTML::anchor('liga/klanovi/'.$user->clan->id.'-'.URL::title($user->clan->name), HTML::image(Media_Local_Clan::get($user->clan->id), array('alt' => $user->clan->name, 'class' => 'frame')));?>
                          <span><h4 class="white"><?php echo $user->clan->name;?></h4></span>
                         </div>
                     <?php endif;?>
                
					
					<?php echo Request::factory('widgets/users')->execute(); ?>
                    <?php echo Request::factory('widgets/friends/'.$user->id)->execute(); ?>
                		 
                
                
                </div>
                <!-- Column One End -->
            </div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Content Section End -->
    <div class="clear"></div>