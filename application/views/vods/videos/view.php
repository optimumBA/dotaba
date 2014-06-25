<div class="clear"></div>
    <!-- Banner Start -->
    <div id="sub-banner">
    	<div class="in">
                	 	<a href="#"><img src="/assets/images/vods-banner.jpg" alt="<?php echo $video->name; ?>
" /></a>

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
                    	<h1 class="heading colr"><?php echo $video->name; ?>
</h1>
                        <!-- Post Detail Start -->
                        <div class="post-detail">
                            <div class="desc">
                                <div class="post-opts">
                                	<p>Objavio  <?php echo HTML::anchor('igraci/'.$video->user->accountid, $video->user->username); ?>
</p> 								<p><img class="status-s-<?=$video->user->status;?>" src="<?=Media_Remote_Avatar::get($video->user->id, $video->user->avatar);?>" width="16px" height="16px" align="absmiddle" /></p>
                                    <p><?php echo $comments_count; ?> komentara</p>
                                </div>
                               
                                <div class="clear"></div>
                            
                             	                                <object width="560" height="315"><param name="movie" value="http://www.youtube.com/v/<?php echo $video->vid; ?>?version=3&amp;hl=hr_HR"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/<?php echo $video->vid; ?>?version=3&amp;hl=hr_HR" type="application/x-shockwave-flash" width="560" height="315" allowscriptaccess="always" allowfullscreen="true"></embed></object>

                                
                                
                                
                                <p>
                                    
									
									<?=HTML::parse_bbcode($video->description); ?>
                                </p>
                               
                                <div class="post-share">
                                	<ul>
                                    <div class="fb-like" data-href="http://dota.ba/novosti/&lt;?=$article-&gt;id.&#039;-&#039;.URL::title($article-&gt;title);?&gt;" data-send="false" data-width="450" data-show-faces="false" data-colorscheme="dark"></div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <!-- Post Detail End -->
                        
                        <?php echo Request::factory('komentari/Video/'.$video->id)->execute(); ?>
                    </div>
               
                </div>
                <!-- Column One End -->
                <!-- Column One Start -->
                <div class="col1 hidemobile">
                	<?php if (User::instance()->can('update', $video)):?>
                  <div class="widget opcije">
                    	<h1 class="heading colr">Opcije</h1>
                        <div class="desc">
                        	<h4><?php echo HTML::anchor('vods/snimci/'.$video->id.'-'.URL::title($video->name).'/izmijeni', 'Izmijeni snimak'); ?></h4>
                        </div>
                    </div>
                    <?php endif;?>
                   
                   
                </div>
                <!-- Column One End -->
            </div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Content Section End -->
    <div class="clear"></div>