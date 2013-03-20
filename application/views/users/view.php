<div class="clear"></div>
    <!-- Banner Start -->
    <div id="sub-banner">
    	<div class="in">
        	<a href="#"><img src="/assets/images/sub-banner3.jpg" alt="" /></a>
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
                            	<?php echo HTML::image(Media_Remote_Avatar::get($user->id, $user->avatar), array('alt' => $user->username, 'class' => 'steam-avatar offline-status')); ?>
                            </div>
                            <div class="desc">
                                <p class="release">Registrovan/a: <?php echo Date::formatted_time($user->created_at); ?></p>
                                <p>Ime: <?php echo $user->name; ?></p>
                                <p>Država: <?php echo $user->location; ?></p>
								<p>Klan: <?php echo ($user->clan_id) ? HTML::anchor('liga/klanovi/'.$user->clan->id.'-'.URL::title($user->clan->name, '-', TRUE), $user->clan->name) : ''; ?></p>
<?php if ($user->featured_hero_id): ?>
								<p><a class="buttonone" href="<?php echo $user->profileurl;?>" target="_blank">Steam profil</a></p>
                                <p>
		Omiljeni heroj: <?php echo HTML::image(Media_Remote_Hero::get($user->featured_hero->id, $user->featured_hero->image), array('alt' => $user->featured_hero->name)); ?>>
								</p>
                                
                              
<?php endif ?>

   
                            </div>
                        </div>
                        <div class="clear"></div>
                        <!-- Album Detail End -->
                        <!-- Album List Start -->
                        <div class="album-track-list">
                        	<h2 class="heading colr">Posljedni mečevi</h2>
                            <div class="tracklist">
                           
                                <ul>
                                	
                           <?php foreach ($matches as $match): ?>
                                    <li class="play">
                                    	<div class="cp-container cp_container_1">
                                            <ul class="cp-controls">
                                                <li><a style="display: block;" href="#" class="cp-play" tabindex="1">&nbsp;</a></li>
                                                <li><a href="#" class="cp-pause" style="display: none;" tabindex="1">&nbsp;</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="title">
                                    	<p><?php echo HTML::anchor('liga/mecevi/'.$match->id, $match->id); ?></p>
                                        <span><?php echo $match->type->name; ?></span>
                                        <span><?php echo $match->mode->name; ?></span>
                                        <span><?php echo ($match->tournament_id) ? HTML::anchor('liga/turniri/'.$match->tournament->id.'-'.URL::title($match->tournament->name, '-', TRUE), $match->tournament->name) : NULL; ?></span>
                                        <span><?php echo ($match->radiant_clan_id) ? HTML::anchor('liga/klanovi/'.$match->radiant_clan->id.'-'.URL::title($match->radiant_clan->name), $match->radiant_clan->name) : NULL; ?></span>
                                        <span><?php echo ($match->dire_clan_id) ? HTML::anchor('liga/klanovi/'.$match->dire_clan->id.'-'.URL::title($match->dire_clan->name), $match->dire_clan->name) : NULL; ?></span>
                                    </li>
                                    <li class="time"><?php echo Date::formatted_time($match->date); ?></li>
                                    <li>
                                    	<a href="#" class="download"><span>aaa</span></a>
                                        <a href="#" class="download">bbb</a>
                                    </li>
                                  <?php endforeach ?> 
                                </ul>
                            
                        
                                
                                <ul>
    
                                    </li>
                                
                                
                                </ul>
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
                    <!-- Facebook Start -->
                    <div class="widget facebook">
                        <a href="#"><img src="images/facebook.jpg" alt="" /></a>
                    </div>
                    <!-- Facebook End -->
                    <!-- Advertisment Start -->
                    <div class="widget advert">
                        <a href="#"><img src="/assets/images/advert2.jpg" alt="" /></a>
                        <span>Advertising</span>
                    </div>
                    <!-- Advertisment End -->
                </div>
                <!-- Column One End -->
            </div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Content Section End -->
    <div class="clear"></div>