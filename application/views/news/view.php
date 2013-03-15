<div class="clear"></div>
    <!-- Banner Start -->
    <div id="sub-banner">
    	<div class="in">
        	<a href="#"><img src="images/sub-banner4.jpg" alt="" /></a>
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
                    	<h1 class="heading colr"><?php echo $article->title;?></h1>
                        <!-- Post Detail Start -->
                        <div class="post-detail">
                        	<div class="thumb">
                            	<img src="<?=Media_Local_News::get($article->id);?>" alt="" />
                            </div>
                            <div class="desc">
                                <div class="post-opts">
                                	<p>Objavio <a href="/igraci/<?=$article->user->accountid;?>"> <?=$article->user->username;?></a></p>
                                    <p><img class="" src="<?=Media_Remote_Avatar::get($article->user->id, $article->user->avatar);?>" width="16px" height="16px" align="absmiddle" /></p>
                                    <p><?php echo Date::formatted_time($article->created_at); ?></p>
                                    <p>Izvor <a href="<?=$article->url;?>"><?=$article->source;?></a></p>
                                    <p><?php echo count($comments) ?> komentara</p>
                                   
                                </div>
                                <p>
                                    <?=HTML::parse_bbcode($article->content);?>
                                </p>
                                <div class="clear"></div>
                              
                             
                               
                                <div class="post-share">
                                	<ul>
                                    <div class="fb-like" data-href="http://dota.ba/novosti/&lt;?=$article-&gt;id.&#039;-&#039;.URL::title($article-&gt;title);?&gt;" data-send="false" data-width="450" data-show-faces="false" data-colorscheme="dark"></div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <!-- Post Detail End -->
                        
     <!-- Comments Start -->
      <div class="comments">
          <h1 class="heading colr">Komentari</h1>
		  
		  		 <?php if (!Steam::logged_in()): ?>
                 <div class="alert alert-error">Moraš biti prijavljen/a kako bi ostavio/la komentar. Prijavi se <a href="/provjera">ovdje</a></div>
				 <?php endif; ?>
                 <div class="clear"></div>
                 
				 <?php if (count($comments)): ?>
                       <ul>
                        <?php foreach ($comments as $comment): ?>
                            <li>
                                <div class="avatar">
			<?php echo HTML::image(Media_Remote_Avatar::get($comment->user->id, $comment->user->avatar), array('alt' => $comment->user->username, 'width' => 60, 'height' => 60)); ?></div>
                 
				 					<div class="desc">
				 		 			<h5><?php echo HTML::anchor('igraci/'.$comment->user->accountid, $comment->user->username); ?></h5>
                                    <p class="ago"> <?php echo Date::formatted_time($comment->created_at); ?></p>
                                    <p class="txt"><?php echo HTML::parse_bbcode($comment->body); ?> </p>
                                    <div class="clear"></div>    
                                   
                                   
                                  </div>
                               </li>
                                           
                                        
                                    <?php endforeach ?>
                                </ul>
                            <?php else: ?>
                                <div class="alert alert-info">Trenutno nema komentara.</div>
                                
                            <?php endif; ?>
                        </div>
                        <!-- Comments End -->
						<?php if (Steam::logged_in()): ?>
                            <!-- Leave a Reply Start -->
                            <div class="leavereply">
                                <h1 class="heading colr">Dodaj komentar</h1>
                                <?php echo Form::open('komentari/dodaj', array('class' => 'forms')); ?>
                                    <ul>
                                        <li>
                                            <?php echo Form::textarea('body', '', array('placeholder' => 'Tekst')); ?>
                                        </li>
                                        <li>
                                            <?php echo Form::hidden('object_id', $article->id); ?>
                                            <?php echo Form::hidden('object_type', 'News'); ?>
                                            <?php echo Form::hidden('csrf', Security::token()); ?>
                                            <?php echo Form::submit(NULL, 'Pošalji'); ?>
                                        </li>
                                    </ul>
                                <?php echo Form::close(); ?>
                            </div>
                            <!-- Leave a Reply End -->
                        <?php endif ?>
                    </div>
               
                </div>
                <!-- Column One End -->
                <!-- Column One Start -->
                <div class="col1 hidemobile">
                	<!-- Top Sellers Start -->
                	<div class="widget top-seller">
                    	<h1 class="heading colr">Top Seller</h1>
                        <div class="thumb">
                        	<a href="album-detail.html"><img src="images/advert1.jpg" alt="" /></a>
                        </div>
                        <div class="desc">
                        	<h4><a href="album-detail.html" class="white">Smile Dip (Dave Barnes)</a></h4>
                            <p>
                            	Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tellus orci, semper et ornare dictum, varius ut tellus.
                            </p>
                        </div>
                    </div>
                    <!-- Top Sellers End -->
                    <!-- Recent Posts Start -->
                    <div class="widget ourteam">
                    	<h1 class="heading colr">Our Team</h1>
                        <ul class="teamlist">
                        	<li>
                            	<a href="#" class="thumb"><img src="images/img10.jpg" alt="" /></a>
                                <div class="desc">
                                	<h4><a href="#" class="white">Rick Jhon Wilson</a></h4>
                                    <p>Friday, July 06 2012</p>
                                    <p class="txt">Lorem ipsum dolor sit amet, tetur adipiscing elit...<a href="#">Read More</a></p>
                                </div>
                            </li>
                            <li>
                            	<a href="#" class="thumb"><img src="images/img11.jpg" alt="" /></a>
                                <div class="desc">
                                	<h4><a href="#" class="white">Rick Jhon Wilson</a></h4>
                                    <p>Friday, July 06 2012</p>
                                    <p class="txt">Lorem ipsum dolor sit amet, tetur adipiscing elit...<a href="#">Read More</a></p>
                                </div>
                            </li>
                            <li>
                            	<a href="#" class="thumb"><img src="images/img12.jpg" alt="" /></a>
                                <div class="desc">
                                	<h4><a href="#" class="white">Rick Jhon Wilson</a></h4>
                                    <p>Friday, July 06 2012</p>
                                    <p class="txt">Lorem ipsum dolor sit amet, tetur adipiscing elit...<a href="#">Read More</a></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- Recent Posts End -->
                    <!-- Facebook Start -->
                    <div class="widget facebook">
                      <div class="fb-like-box" data-href="https://www.facebook.com/DotA.Balkan" data-width="234" data-height="325" data-show-faces="true" data-colorscheme="dark" data-stream="false" data-header="false" border-color="#151515"></div>
                    </div>
                    <!-- Facebook End -->
                    <!-- Advertisment Start -->
                    <div class="widget advert">
                        <a href="#"><img src="images/advert2.jpg" alt="" /></a>
                        <span>Nema reklame. <a href="/advertisments">Želite reklamu?</a></span>
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