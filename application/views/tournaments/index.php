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

<?php if (count($tournaments) > 0): ?>
	<?php foreach ($tournaments as $tournament): ?>


<!-- Stream Start -->
                        <div class="gig-post">
                        	<div class="upper-sec">
                                <div class="date">
                                    <h1><?php echo date('d', strtotime($tournament->created_at));?></h1>
                                    <h1><?php echo date('M', strtotime($tournament->created_at));?></h1>
                                </div>
                                <div class="desc">
                                    <?php echo HTML::image(Media_Local_Tournament::get($tournament->id), array('alt' => $tournament->name, 'width' => 104)); ?>
                                    <div class="txt-sec">
                                        <h3><?php echo $tournament->name ?></h3>
                                       
                                        
                                        <p class="">Organizator: <?php echo HTML::anchor('igraci/'.$tournament->user->accountid, $tournament->user->username); ?>
</p>
                                        
                                        <div class="clear"></div>
                                        <p class="txt">
                                              
                                        </p>
                                        <a href="<?php echo 'igraci/'.$tournament->user->accountid;?>" class="readmore">Pogledaj</a>
                                    </div>
                                </div>
                            </div>
                      
                        </div>
                        <!-- Stream Post End -->

<?php endforeach ?>
<?php else: ?>
	Trenutno nema turnira.
<?php endif ?>





		
			<?php echo HTML::image(Media_Local_Tournament::get($tournament->id), array('alt' => $tournament->name)); ?><br />
			Naziv: <?php echo $tournament->name ?><br />
			Organizator: <?php echo HTML::anchor('igraci/'.$tournament->user->accountid, $tournament->user->username); ?>
	
	


<?php echo $pagination; ?>


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