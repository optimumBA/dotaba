<!-- Header End -->
    <div class="clear"></div>
    <!-- Banner Start -->
    <div id="sub-banner">
    	<div class="in">
        	<a href="#"><img src="/assets/images/subbanner.jpg" alt="Dota 2 Balkan vijesti" /></a>
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
                    	<h1 class="heading colr">Pregled vijesti</h1>



<?php if (count($news) > 0): ?>
	<?php foreach ($news as $article): ?>
	
	
	
	<!-- Post Start -->
                        <div class="post">
                        	<div class="thumb">
                            	<a href="/novosti/<?=$article->id.'-'.URL::title($article->title, '-', TRUE);?>"><img src="<?=Media_Local_News::get($article->id);?>" alt="<?php echo $article->title;?>" /></a>
                            </div>
                            <div class="desc">
                            	<div class="date">
                                    <h1><?php echo date('d', strtotime($article->created_at));?></h1>
                                    <h1><?php echo date('M', strtotime($article->created_at));?></h1>

                                </div>
                                <div class="desc-sec">
                                	<h3><a href="/novosti/<?=$article->id.'-'.URL::title($article->title, '-', TRUE);?>"><?php echo $article->title; ?></a></h3>
                                    <div class="post-opts">
                                    	<p>Objavio <a href="/igraci/<?=$article->user->accountid;?>"><?=$article->user->username;?></a></p>
                                         <p><img class="status-s-<?=$article->user->status;?>" src="<?=Media_Remote_Avatar::get($article->user->id, $article->user->avatar);?>" width="16px" height="16px" align="absmiddle" /></p>
                                        <p><?php echo Date::formatted_time($article->created_at); ?></p>
                                       
                                    </div>
                                    <p>
                                        <?=Text::limit_words(strip_tags(HTML::parse_bbcode($article->content)), 40);?>
                                    </p>
                                    <a href="/novosti/<?=$article->id.'-'.URL::title($article->title, '-', TRUE);?>" class="readmore">Nastavi čitati</a>
                                </div>
                            </div>
                        </div>
                        <!-- Post End -->
	
	
	
	<?php endforeach; ?>
<?php else: ?>
	Trenutno nema novosti.
<?php endif ?>

 <?php echo $pagination; ?>

   
                    </div>
                </div>
            
                
                <!-- Column One End -->
              
                
                <!-- Column One Start -->
                <div class="col1 hidemobile">
                	
                   
                	<div class="widget aktivni-eventi">
                    	<h1 class="heading colr">Info</h1>
                        <div class="thumb">
                        	<img class="frame" src="/assets/images/index-banner.png" alt="Dota 2 Balkan Vijesti" />
                        </div>
                        <div class="desc">
                        	<h4><a class="white">Pregled vijesti</a></h4>
                            <p>
                            	Dota 2 Balkan novinari vam omogućavaju brzi pregled vijesti Dota 2 svijeta, Dota 2 update-a, svjetskih turnira i Dota 2 Balkan turnira. <br />Ukoliko želite postati Dota 2 Balkan novinar, kontaktirajte nas na podrska@dota.ba sa naslovom predmeta aplikacije.
                            </p>
                        </div>
                    </div>
                    
                    
            <?php if (User::instance()->logged_in() AND (User::instance()->has_role('Administrator/ka') OR User::instance()->has_role('Novinar/ka'))): ?>
	

                   
                	<div class="widget opcije">
                    	<h1 class="heading colr">Opcije</h1>
                        <div class="desc">
                        	<h4><?php echo HTML::anchor('novosti/objavi', 'Objavi vijesti'); ?></h4>
                        </div>
                    </div>
                   
              
                  <?php endif ?>
                   
                </div>
                <!-- Column One End -->
            </div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Content Section End -->
    <div class="clear"></div>