<!-- Header End -->
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
                	<div class="blog">
                    	<h1 class="heading colr">Pregled novosti</h1>



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
                                         <p><img class="" src="<?=$article->user->avatar;?>" width="16px" height="16px" align="absmiddle" /></p>
                                        <p><?php echo $article->created_at/*Date::formatted_time($article->created_at, $user->date_format, $user->timezone)*/; ?></p>
                                        <p><a href="#">{NULL} komentara</a></p>
                                    </div>
                                    <p>
                                    	<?=Text::limit_words(strip_tags($article->content), 40);?>
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
                	<!-- Top Sellers Start -->
                	<div class="widget aktivni-eventi">
                    	<h1 class="heading colr">Aktivni event</h1>
                        <div class="thumb">
                        	<a href="album-detail.html"><img src="/media/images/advert1.jpg" alt="" /></a>
                        </div>
                        <div class="desc">
                        	<h4><a href="album-detail.html" class="white">Smile Dip (Dave Barnes)</a></h4>
                            <p>
                            	Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tellus orci, semper et ornare dictum, varius ut tellus.
                            </p>
                        </div>
                    </div>
                    <!-- Top Sellers End -->
                    
                    <!-- Other Albums Start -->
                    <div class="widget vijesti-izdvojeno">
                    	<h1 class="heading colr">Izdvojeno</h1>
                        <ul>
                        	<li>
                            	<a href="/novosti/izdvojeno/" class="thumb"><img src="/media/images/img8.jpg" alt="" /></a>
                                <div class="desc">
                                	<h4><a href="/novosti/izdvojeno/" class="white">Smile Dip LOVE</a></h4>
                                    <p class="date">Release: 7/3/2012</p>
                                    <p>Artist: Chris Brown (R&amp;B/Vocals)</p>
                                    <a href="/novosti/izdvojeno/" class="pogledaj">Pogledaj</a>
                                </div>
                            </li>
                           
                           
                        </ul>
                        <a href="/novosti/izdvojeno" class="buttonone">Pogledaj sve</a>
                    </div>
                    <!-- Other Albums End -->
                   
                </div>
                <!-- Column One End -->
            </div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Content Section End -->
    <div class="clear"></div>