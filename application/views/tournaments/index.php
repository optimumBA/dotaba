<!-- Header End -->
    <div class="clear"></div>
    <!-- Banner Start -->
    <div id="sub-banner">
    	<div class="in">
        	<a href="#"><img src="/assets/images/banner-profile.jpg" alt="Dota 2 Balkan Liga" /></a>
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
                    	<h1 class="heading colr">Turniri</h1>



<?php if (count($tournaments) > 0): ?>
	<?php foreach ($tournaments as $tournament): ?>
	
	
	
	<!-- Post Start -->
                        <div class="post">
                        	<div class="thumb">
                            <a href="/liga/turniri/<?=$tournament->id.'-'.URL::title($tournament->name, '-', TRUE);?>"><img src="<?=Media_Local_Tournament::get($tournament->id);?>" alt="<?php echo $tournament->name;?>" width="680px" /></a>
                            </div>
                            <div class="desc">
                            	<div class="date">
                                    <h1><?php echo date('d', strtotime($tournament->created_at));?></h1>
                                    <h1><?php echo date('M', strtotime($tournament->created_at));?></h1>

                                </div>
                                <div class="desc-sec">
                                	<h3><a href="/turniri/liga/<?=$tournament->id.'-'.URL::title($tournament->name, '-', TRUE);?>"></a></h3>
                                    <div class="post-opts">
                                    	<p>Organizator <a href="/igraci/<?=$tournament->user->accountid;?>"><?=$tournament->user->username;?></a></p>
                                         <p><img class="status-s-<?=$tournament->user->status;?>" src="<?=Media_Remote_Avatar::get($tournament->user->id, $tournament->user->avatar);?>" width="16px" height="16px" align="absmiddle" /></p>
                                        <p>Organizovan <?php echo Date::formatted_time($tournament->created_at); ?></p>
                                        <p>Završen 
										<?php echo ($tournament->finished_at == NULL) ? '<span class="white">Ne</span>' : Date::formatted_time($tournament->created_at) ?>
										</p>

                                       
                                    </div>
                                    <p>
                                        <?=Text::limit_words(strip_tags(HTML::parse_bbcode($tournament->description)), 40);?>
                                    </p>
                                    <a href="/liga/turniri/<?=$tournament->id.'-'.URL::title($tournament->name, '-', TRUE);?>" class="readmore">Nastavi čitati</a>
                                </div>
                            </div>
                        </div>
                        <!-- Post End -->
	
	
	
	<?php endforeach; ?>
<?php else: ?>
	Trenutno nema turnira.
<?php endif ?>

 <?php echo $pagination; ?>

   
                    </div>
                </div>
            
                
                <!-- Column One End -->
              
                
                <!-- Column One Start -->
                <div class="col1 hidemobile">
                	
                   
                	
                </div>
                <!-- Column One End -->
            </div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Content Section End -->
    <div class="clear"></div>