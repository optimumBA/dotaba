<div class="clear"></div>
    <!-- Banner Start -->
 
    <!-- Banner End -->
    <!-- Content Section Start -->
    <div id="content-sec">
    	<div class="inner">
        	<!-- Columns Section Start -->
            <div class="columns-sec twocol">
            	<!-- Column Three Start -->
                <div class="col3">
                	<div class="gigs">
                    	<h1 class="heading colr">Forum</h1>

 						


<?php if (count($topics)): ?>
	
		<?php foreach ($topics as $topic): ?>
		
			
            
            <!-- Thread Start -->	<?php if ($topic->is_sticky): ?>
				<div class="thread">
                        	<a hclass="button">Ljepljive teme</a>
                        </div>
			<?php endif ?>
			<?php if ($topic->is_locked): ?>
				<div class="thread">
                        	<a hclass="button">Zaključane teme</a>
                        </div>
			<?php endif ?>
                        <div class="gig-post">
                        	<div class="upper-sec">
                                <div class="date">
                                    <h1><?php echo date('d', strtotime($topic->created_at));?></h1>
                                    <h1><?php echo date('M', strtotime($topic->created_at));?></h1>
                                </div>
                                <div class="desc">
                                    
                                    <a href="/igraci/<?=$topic->user->accountid;?>" class="thumb"><img class="status-<?=$topic->user->status;?>" src="<?=Media_Remote_Avatar::get($topic->user->id, $topic->user->avatar);?>" alt="<?php echo $topic->user->username;?>-ov/in avatar" width="104px" /></a>
                                    <div class="txt-sec">
                                        <h3><?php echo HTML::anchor('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE), $topic->name); ?></h3>
                                       
                                        
                                        
                                        <p class="time"><?php if ($last_posts[$topic->id]->loaded()): ?>
				Zadnji post napisao/la <?php echo HTML::anchor('igraci/'.$last_posts[$topic->id]->user->accountid, $last_posts[$topic->id]->user->username); ?>
				<?php echo Date::formatted_time($last_posts[$topic->id]->created_at) ?>
			<?php endif ?>   </p>
                                   
                                        
                                        
                                        <div class="clear"></div>
                                        <p class="txt">
                                         
                                        </p>
                                        
                                    </div>
                                </div>
                            </div>
                      
                        </div>
                        <!-- Thread Post End -->
            
            
            
            
            
            
			
			
		<?php endforeach ?>
	
<?php else: ?>
	Nema tema.
<?php endif ?>

<?php echo $pagination; ?>



  </div>
                </div>
                <!-- Column One End -->
                <!-- Column One Start -->
                <div class="col1 hidemobile">
<?php if (User::instance()->logged_in()): ?>
	

                    <!-- Dodaj stream Start -->
                	<div class="widget dodajstream">
                    	<h1 class="heading colr">Opcije</h1>
                        <div class="desc">
                        	<h4><?php echo HTML::anchor('teme/napravi', 'Napravi temu'); ?></h4>
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




