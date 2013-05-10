<div class="clear"></div>
    <!-- Banner Start -->
 <div id="sub-banner">
    	<div class="in">
        	<a href="#"><img src="/assets/images/banner-profile.jpg" alt="Dota 2 Forum" /></a>
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
                	<div class="gigs">
                    	<h1 class="heading colr">Timovi</h1>
                        
                        
                        <?php foreach ($clans as $clan): ?>
        
                <!-- Thread Start -->	
                        <div class="gig-post">
                        	<div class="upper-sec">
                                <div class="date">
                                    <h1><?php echo date('d', strtotime($clan->created_at));?></h1>
                                    <h1><?php echo date('M', strtotime($clan->created_at));?></h1>
                                </div>
                                <div class="desc">
                                    
                                    <?php echo HTML::anchor('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE), HTML::image(Media_Local_Clan::get($clan->id), array('alt' => $clan->name, 'width' => 104, 'height' => 104, 'class' => 'frame'))); ?>
                                    <div class="txt-sec">
                                        <h3><?php echo HTML::anchor('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name, '-', TRUE), $clan->name); ?> (<?php echo $clan->tag; ?>)</h3>
                                       
                                        
                                        
                                      
                                   
                                        <p class="who"></p>
                                        <p class="by">Lord: <?php echo HTML::anchor('igraci/'.$clan->lord->accountid, $clan->lord->username); ?></p>
				<p class="time"><?php echo Date::formatted_time($clan->created_at); ?></p>
			
            							
                                        
                                        <div class="clear"></div>
                                        <p class="txt">
										
										
										
                                        </p>
                                         
                                       
                                    </div>
                                </div>
                            </div>
                      
                        </div>
                        <!-- Thread Post End -->
            
            	<?php endforeach ?>
            
            
            
            
			


<?php echo $pagination; ?>



  </div>
                </div>
                <!-- Column One End -->
                <!-- Column One Start -->
                <div class="col1 hidemobile">
			<?php if(User::instance()->logged_in()):?>
            
            	<?php if (User::instance()->clan_id): ?>
               
                       
					   <!-- Klan opcije Start -->
                		<div class="widget">
                    	<h1 class="heading colr">Moj tim</h1>
                        <div class="thumb">
                        	<?php echo HTML::image(Media_Local_Clan::get(User::instance()->clan_id), array('alt' => User::instance()->clan->name, 'class' => 'frame', 'width' => 209, 'height' => 209));?>
                          
                        </div>
                        
                        <div class="desc">
                        

                            <h4><?php echo HTML::anchor('liga/klanovi/'.User::instance()->clan->id.'-'.URL::title(User::instance()->clan->name), 'Pogledaj profil tima'); ?></h4>
						
                        </div>
                    </div>
           			<!-- Klan opcije End -->
					 

            <?php else:?>
            
             <!-- Dodaj klan Start -->
                	<div class="widget opcije">
                    	<h1 class="heading colr">Opcije</h1>
                        <div class="desc">
                        

                            <h4><?php echo HTML::anchor('liga/klanovi/napravi', 'Napravi klan'); ?></h4>
						
                        </div>
                    </div>
           			<!-- Dodaj klan End -->
<?php endif;?>
            
            <?php endif;?>
                </div>
                <!-- Column One End -->
            </div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Content Section End -->
    <div class="clear"></div>