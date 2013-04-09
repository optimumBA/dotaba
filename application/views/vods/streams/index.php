   <div class="clear"></div>
    <!-- Banner Start -->
    <div id="sub-banner">
    	<div class="in">
        	<a href="#"><img src="/assets/images/vods-banner.jpg" alt="Dota 2 Balkan Vods" /></a>
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
                    	<h1 class="heading colr">Stream-ovi</h1>
                       
                        <?php if (count($streams) > 0): ?>

		<?php foreach ($streams as $stream): ?>
				
				 <!-- Stream Start -->
                        <div class="gig-post">
                        	<div class="upper-sec">
                                <div class="date">
                                    <h1><?php echo date('d', strtotime($stream->created_at));?></h1>
                                    <h1><?php echo date('M', strtotime($stream->created_at));?></h1>
                                </div>
                                <div class="desc">
                                    <a href="<?php echo '/igraci/'.$stream->user->accountid.'/stream';?>" class="thumb"><img class="status-<?=$stream->user->status;?>" src="<?=Media_Remote_Avatar::get($stream->user->id, $stream->user->avatar);?>" alt="<?php echo $stream->user->username;?>-ov/in Stream" width="104px" /></a>
                                    <div class="txt-sec">
                                        <h3><?php echo HTML::anchor('igraci/'.$stream->user->accountid.'/stream', $stream->user->username.' stream'); ?></h3>
                                       
                                        
                                        
                                        <p class="viewers">Gledalaca <?php echo $stream->viewers;?></p>
                                        <p class="location"><?php echo ($stream->online) ? '<a class="online">Online</a>' : '<a class="offline">Offline</a>'?></p>
                                        
                                        
                                        <div class="clear"></div>
                                        <p class="txt">
                                              <?=Text::limit_words(strip_tags(HTML::parse_bbcode($stream->description)), 40);?>
                                        </p>
                                        <?php echo HTML::anchor('igraci/'.$stream->user->accountid.'/stream', 'Pogledaj', array('class' => 'readmore')); ?>
                                    </div>
                                </div>
                            </div>
                      
                        </div>
                        <!-- Stream Post End -->
				
				
		<?php endforeach ?>

<?php else: ?>
	Trenutno nema streamova.
<?php endif ?>
                        
                       
                    
                      
                    
                       
                        
                    </div>
                </div>
                <!-- Column One End -->
                <!-- Column One Start -->
                <div class="col1 hidemobile">
                	<?php if (User::instance()->logged_in() AND ! User::instance()->stream->loaded()): ?>
	

                    <!-- Dodaj stream Start -->
                	<div class="widget dodajstream">
                    	<h1 class="heading colr">Opcije</h1>
                        <div class="desc">
                        	<h4><?php echo HTML::anchor('igraci/'.User::instance()->accountid.'/stream/dodaj', 'Dodaj Stream'); ?></h4>
                        </div>
                    </div>
                   
                    <!-- Dodaj stream End -->
                  <?php endif ?>
                   
                </div>
                <!-- Column One End -->
            </div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Content Section End -->
    <div class="clear"></div>
    