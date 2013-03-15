<div class="clear"></div>
    <!-- Banner Start -->
    <div id="sub-banner">
    	<div class="in">
        	<a href="#"><img src="/assets/images/sub-banner2.jpg" alt="" /></a>
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
                    	<h1 class="heading colr">Vods galerija</h1>
                        <div class="month">
                        	<a href="/vods/snimci" class="button">Snimci</a>
                        </div>
                 
					    <?php if (count($videos) > 0): ?>
	<?php foreach ($videos as $video): ?>  
					  
                        <!-- VOD Post Start -->
                        <div class="gig-post">
                        	<div class="upper-sec">
                                <div class="date">
                                    <h1><?php echo Date::formatted_time($video->created_at); ?></h1>
                                    <h1><?php echo Date::formatted_time($video->created_at); ?></h1>
                                </div>
                                <div class="desc">
                                    <a href="/vods/snimci/<?=$video->id.'-'.URL::title($video->name, '-', TRUE);?>" class="thumb"><img src="http://i.ytimg.com/vi/<?=$video->vid;?>/1.jpg" alt="" /></a>
                                    <div class="txt-sec">
                                        <h3><a href="blog-detail.html"><?=$video->name;?></a></h3>
                                        <p class="time"><?php echo Date::formatted_time($video->created_at); ?></p>
                                        <p class="location">YouTube</p>
                                        <div class="clear"></div>
                                        <p class="txt">
                                            <?=Text::limit_words(strip_tags(HTML::parse_bbcode($video->description)), 10);?>
                                        </p>
                                        <a href="/vods/snimci/<?=$video->id.'-'.URL::title($video->name, '-', TRUE);?>" class="readmore">Pogledaj</a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <!-- VOD Post End -->
                                  <?php endforeach ?>
<?php else: ?>
	Trenutno nema videa.
<?php endif ?> 
                 
                 <div class="month">
                        	<a href="/vods/steam" class="button">Stream-ovi</a>
                        </div>
                      <div class="gig-post">Nema stream-ova.</div>
                      
                        <div class="month">
                        	<a href="/vods/galerija" class="button">Galerija</a>
                        </div>
                    <div class="gig-post">  Nema slika.</div>
                    </div>
                </div>
                <!-- Column One End -->
                <!-- Column One Start -->
                <div class="col1 hidemobile">
                	
                    
                    
                	<div class="widget top-seller">
                    	<h1 class="heading colr">Advertisments</h1>
                        <div class="thumb">
                        	<a href="album-detail.html"><img src="/assets/images/advert1.jpg" alt="" /></a>
                        </div>
                        <div class="desc">
                        	<h4><a href="album-detail.html" class="white">Smile Dip (Dave Barnes)</a></h4>
                            <p>
                            	Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tellus orci, semper et ornare dictum, varius ut tellus.
                            </p>
                        </div>
                    </div>
                    
                    
                   
                   
                </div>
                <!-- Column One End -->
            </div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Content Section End -->
    <div class="clear"></div>