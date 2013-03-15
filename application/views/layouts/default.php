 <!-- Header End -->
    <div class="clear"></div>
    <!-- Banner Start -->
    <div id="banner">
    	<div class="banner-in">
        	<div class="slider-wrapper theme-default">
            	<div id="slider" class="nivoSlider">
                	<a href="#"><img src="/assets/images/banner1.jpg" title="#banner1" alt="" /></a>
                    <a href="#"><img src="/assets/images/banner2.jpg" title="#banner2" alt="" /></a>
                    <a href="#"><img src="/assets/images/banner3.jpg" title="#banner3" alt="" /></a>
                    <a href="#"><img src="/assets/images/banner4.jpg" title="#banner4" alt="" /></a>
                </div>
                <!-- Banner Caption Start -->
                <div id="banner1" class="nivo-html-caption">
                	<h1><a href="blog-detail.html">ROCK TOUR 2012</a></h1>
                    <p>
                    	Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tellus orci, semper et ornare dictum, varius ut tellus. In consectetur, velit vel interdum fringilla, felis justo scelerisq
urna, ut scelerisque enim elit id est. Sed felis libero, malesuada ut vestibulum aliquam, feugiat ut augue.Sed felis libero, malesuada ut vestibulum aliquam, feugiat ut.
                    </p>
                    <a href="blog-detail.html" class="banner-more"><span class="backcolr">Read More</span><span class="corner">&nbsp;</span></a>
                </div>
                <!-- Banner Caption End -->
                <!-- Banner Caption Start -->
                <div id="banner2" class="nivo-html-caption">
                	<h1><a href="blog-detail.html">ROCK TOUR 2012</a></h1>
                    <p>
                    	Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tellus orci, semper et ornare dictum, varius ut tellus. In consectetur, velit vel interdum fringilla, felis justo scelerisq
urna, ut scelerisque enim elit id est. Sed felis libero, malesuada ut vestibulum aliquam, feugiat ut augue.Sed felis libero, malesuada ut vestibulum aliquam, feugiat ut.
                    </p>
                    <a href="blog-detail.html" class="banner-more"><span class="backcolr">Read More</span><span class="corner">&nbsp;</span></a>
                </div>
                <!-- Banner Caption End -->
                <!-- Banner Caption Start -->
                <div id="banner3" class="nivo-html-caption">
                	<h1><a href="blog-detail.html">ROCK TOUR 2012</a></h1>
                    <p>
                    	Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tellus orci, semper et ornare dictum, varius ut tellus. In consectetur, velit vel interdum fringilla, felis justo scelerisq
urna, ut scelerisque enim elit id est. Sed felis libero, malesuada ut vestibulum aliquam, feugiat ut augue.Sed felis libero, malesuada ut vestibulum aliquam, feugiat ut.
                    </p>
                    <a href="blog-detail.html" class="banner-more"><span class="backcolr">Read More</span><span class="corner">&nbsp;</span></a>
                </div>
                <!-- Banner Caption End -->
                <!-- Banner Caption Start -->
                <div id="banner4" class="nivo-html-caption">
                	<h1><a href="blog-detail.html">ROCK TOUR 2012</a></h1>
                    <p>
                    	Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tellus orci, semper et ornare dictum, varius ut tellus. In consectetur, velit vel interdum fringilla, felis justo scelerisq
urna, ut scelerisque enim elit id est. Sed felis libero, malesuada ut vestibulum aliquam, feugiat ut augue.Sed felis libero, malesuada ut vestibulum aliquam, feugiat ut.
                    </p>
                    <a href="blog-detail.html" class="banner-more"><span class="backcolr">Read More</span><span class="corner">&nbsp;</span></a>
                </div>
                <!-- Banner Caption End -->
            </div>
        </div>
    </div>
    <!-- Banner End -->
    <!-- Content Section Start -->
    <div id="content-sec">
    	<div class="inner">

            <!-- Columns Section Start -->
            <div class="columns-sec shade">
            	<div class="threecol">
            	<!-- Column One Start -->
                <div class="col1">

                    <!-- Upcoming Events Start -->
                	<div class="widget upcoming-eve">
                    	<h1 class="heading colr">Nadolazeći mečevi</h1>
                        <div class="current-eve">
                        	<h5><a href="#" class="colr">Tim 1 vs Tim 2</a></h5>
                        	<div id="defaultCountdown"></div>
                        </div>
                        <ul>
                        	<li>
                            	<div class="date">
                                	<span>SEP</span>
                                    <h1>08</h1>
                                </div>
                                <div class="desc">
                                	<div class="left">
                                    	<h4><a href="#">Tim 1 vs Tim 2</a></h4>
                                        <p>Ime turnira</p>
                                    </div>
                                    <a href="#" class="buttonone right">GLEDAJ</a>
                                </div>
                            </li>
                            <li>
                            	<div class="date">
                                	<span>SEP</span>
                                    <h1>30</h1>
                                </div>
                                <div class="desc">
                                	<div class="left">
                                    	<h4><a href="#">Tim 1 vs Tim 2</a></h4>
                                        <p>Ime turnira</p>
                                    </div>
                                    <a href="#" class="buttonone right">GLEDAJ</a>
                                </div>
                            </li>
                            <li>
                            	<div class="date">
                                	<span>SEP</span>
                                    <h1>28</h1>
                                </div>
                                <div class="desc">
                                	<div class="left">
                                    	<h4><a href="#">Tim 1 vs Tim 2</a></h4>
                                        <p>Ime turnira</p>
                                    </div>
                                    <a href="#" class="buttonone right">GLEDAJ</a>
                                </div>
                            </li>
                        </ul>
                        <a href="#" class="viewfullcal">POGLEDAJ SVE</a>
                    </div>
                    <!-- Upcoming Events End -->
                  
                </div>
                <!-- Column One End -->
                <!-- Column Two Start -->
                <div class="col2">

                    <!-- Latest Videos Start -->
                	<div class="latest-videos">
                    	<h1 class="heading colr">Posljednji snimci</h1>
                       <?php $videos = ORM::factory('video')->order_by('created_at', 'DESC')->limit(2)->find_all(); 
					   foreach($videos as $video) {
					   echo' <div class="desc">
                        	<h4><a href="/vods/snimci/'.$video->id.'-'.URL::title($video->name, '-', TRUE).'" class="white">'.$video->name.'</a></h4>
                            <p>
                                '.Text::limit_words(strip_tags(HTML::parse_bbcode($video->description)), 10).'
                            </p>

                        </div>
                        <div class="video">
                        	<iframe height="231" src="http://www.youtube.com/embed/'.$video->vid.'" frameborder="0" allowfullscreen></iframe>
                        </div>
                       ';}
                   ?>
                   <a href="/vods/snimci" class="buttonone">Pogledaj sve snimke</a>
                    </div>
                    <!-- Latest Videos End -->

                    <!-- Latest News Start -->
                    <div class="latest-news noback">
                    	<h1 class="heading colr">Posljednje novosti</h1>
                        <ul class="news-list">
                        	
							<?php $news = ORM::factory('news')->order_by('created_at', 'DESC')->limit(2)->find_all(); 
									foreach($news as $article) 
									{
										echo '
									<li>
                            			<div class="thumb">
                                			<a href="/novosti/'.$article->id.'-'.URL::title($article->title, '-', TRUE).'">
                                    			<img src="/assets/images/img8.jpg" alt="" />
                                        		<span>Pogledaj</span>
                                    		</a>
                                		</div>
                                		<div class="desc">
                                				<h4><a href="/novosti/'.$article->id.'-'.URL::title($article->title, '-', TRUE).'" class="white">'.$article->title.'</a></h4>
                                                <p class="post-opts">'.Date::formatted_time($article->created_at).' / <a href="#">4 comments</a></p>
                                                <p class="txt">'.Text::limit_words(strip_tags(HTML::parse_bbcode($article->content)), 40).'</p>
                               			</div>
                            		</li>';
									
									}
							?>

                            
                        </ul>
                        <a href="news.html" class="buttonone">Pogledaj sve novosti</a>
                    </div>
                    <!-- Latest News End -->

                </div>
                <!-- Column Two End -->
                <!-- Column One Start -->
                <div class="col1 hidemobile">
                	<!-- Top Sellers Start -->
                	<div class="widget top-seller noback">
                    	<h1 class="heading colr">Aktivni event</h1>
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
                    <!-- Top Sellers End -->




                    <!-- Facebook Start -->
                    <div class="widget facebook">
                       <div class="fb-like-box" data-href="https://www.facebook.com/DotA.Balkan" data-width="234" data-height="325" data-show-faces="true" data-colorscheme="dark" data-stream="false" data-header="false" border-color="#151515"></div>
                    </div>
                    <!-- Facebook End -->

                </div>
                <!-- Column One End -->
                </div>
            </div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Content Section End -->
    <div class="clear"></div>