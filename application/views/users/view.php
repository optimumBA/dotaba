
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
                                <p>Država: <?php echo $user->location; ?></p>
								<p>Klan: <?php echo ($user->clan_id) ? HTML::anchor('liga/klanovi/'.$user->clan->id.'-'.URL::title($user->clan->name, '-', TRUE), $user->clan->name) : ''; ?></p>
                                <p><a class="buttonone" href="<?php echo $user->profileurl; ?>" target="_blank">Steam profil</a></p>
                                <?php if ($user->wins || $user->losses || $user->abandons): ?>
                                    <p>
                                        Win rate u zadnjih mjesec dana: <?php echo $user->wins / ($user->wins + $user->losses + $user->abandons) * 100 ?>% 
                                        (pobjeda: <?php echo $user->wins; ?>, poraza: <?php echo $user->losses; ?>, izlazaka: <?php echo $user->abandons; ?>).
                                    </p>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <!-- Album Detail End -->
                      
                    
            
	
                      
                        <!-- Album List Start -->
                        <div class="album-track-list">
                        	        <h1 class="heading colr">Matchmaking</h1>
                                    <div class="alert alert-info">Pregled mečeva odigranih u zadnjih mjesec dana (od <?php echo Date::formatted_time('-1 month'); ?>).</div>
                                    <?php if (User::instance()->id == $user->id AND ! $user->wins AND ! $user->losses AND ! $user->abandons): ?>
                                        <div class="alert alert-notice">
                                            Da bi vidio/jela svoju statistiku, moraš uključiti opciju dijeljenja informacija o mečevima unutar igre 
                                            (<em>Settings</em> -> <em>Game</em> -> <em>General</em>, zatim pored "Share Match History" klikni na "On").
                                        </div>
                                    <?php endif ?>
                          
                                    <div class="matchlist">
                <table >
                    <tr>
                        <td>
                            Heroj
                        </td>
                        <td >
                            Meč ID
                        </td>
                        <td>
                           K/D/A
                        </td>
                        
                       
                        
                        <td>
                            Vrijeme
                        </td>
                    </tr>
                   <?php foreach ($slots as $slot): ?>
                  
                    <tr>
                        <td >
							<?php echo HTML::anchor('liga/mecevi/'.$slot->match->id, HTML::image(Media_Remote_Hero::get($slot->hero->id, $slot->hero->image, 'small'), array('alt' => $slot->hero->localized_name, 'title' => $slot->hero->localized_name, 'class' => 'frame'))); ?> <?php echo $slot->hero->localized_name;?>
                        </td>
                        <td>
                             <?php echo $slot->match->mode->name; ?> | <?php echo ($slot->match->radiant_win) ? '<a class="radiant-team">Radiant</a>' : '<a class="dire-team">Dire</a>'; ?>
<div class="clear"></div> <?php echo $slot->match->mid; ?> 
                        </td>
                        <td>
                         <a class="kills"><?php echo $slot->kills;?></a> / <a class="deaths"><?php echo $slot->deaths;?></a> / <a class="assists"><?php echo $slot->assists;?></a>
                        </td>
                        
                        <td>
                           <?php echo Date::formatted_time($slot->match->date); ?>
                        </td>
                    </tr>
                   
                      <?php endforeach ?> 
                   
                </table>
            </div>
                            <div class="clear"></div>
                            
                            
                            
                            
                            
                        </div>
                        <!-- Album List End -->
                        <!-- Comments Start -->
                      <?php echo View::factory('comments', array('comments' => $comments, 'object_id' => $user->id, 'object_type' => 'User')); ?>
                        <div class="clear"></div>
                        <!-- Comments End -->
                       
                    </div>
                </div>
                <!-- Column One End -->
                <!-- Column One Start -->
                <div class="col1 hidemobile">
                	<!-- Top Sellers Start -->
                	<div class="widget top-seller">
                    	<h1 class="heading colr">Lista korisnika/ca</h1>
                        <div class="thumb">
                        	<a href="/igraci/"><img src="/assets/images/advert1.jpg" alt="" /></a>
                        </div>
                        <div class="desc">
                        	<h4><a href="/igraci/" class="white">Trenutni profil <?php echo $user->username; ?></a></h4>
                            <p>
                            	Pogledaj ostale profile
                            </p>
                        </div>
                    </div>
                    <!-- Top Sellers End -->
                    <!-- Recent Posts Start -->
                    <div class="widget ourteam">
                    	<h1 class="heading colr">Prijatelji/ce</h1>
                        <ul class="teamlist">
                        	<li>
                            	
                                    <p>Korisnik <?php echo $user->username; ?> nema prijatelja/ca</p>
                                   
                            </li>
       
                        </ul>
                    </div>
                    <!-- Recent Posts End -->
                    
                    <!-- Featured Hero Start -->
                    <?php if ($user->featured_hero_id): ?>
                    <div class="widget fhero">
                       <img src="/assets/images/advert2.jpg" alt="" /><?php echo HTML::image(Media_Remote_Hero::get($user->featured_hero->id, $user->featured_hero->image), array('alt' => $user->featured_hero->localized_name, 'title' => $user->featured_hero->localized_name, 'class' => 'frame')); ?>
                        <span>Omiljeni heroj: <?php echo $user->featured_hero->localized_name;?></span>
                    </div>
                    <?php endif;?>
                    <!-- Featured Hero End -->
                    
                </div>
                <!-- Column One End -->
            </div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Content Section End -->
    <div class="clear"></div>