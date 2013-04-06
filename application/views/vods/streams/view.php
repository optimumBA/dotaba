<div class="clear"></div>
    <!-- Banner Start -->
    <div id="sub-banner">
    	<div class="in">
                	 	<a href="#"><img src="/assets/images/vods-banner.jpg" alt="<?php echo $stream->user->username.'ov/in stream'; ?>
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
                    	<h1 class="heading colr"><?php echo $stream->user->username.' stream'; ?>
</h1>
                        <!-- Post Detail Start -->
                        <div class="post-detail">
                            <div class="desc">
                                
                               
                                <div class="clear"></div>
                            
                             	                               <object type="application/x-shockwave-flash" height="378" width="620" id="live_embed_player_flash" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel=<?php echo $stream->channel; ?>" bgcolor="#000000">
	<param name="allowFullScreen" value="true" />
	<param name="allowScriptAccess" value="always" />
	<param name="allowNetworking" value="all" />
	<param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" />
	<param name="flashvars" value="hostname=www.twitch.tv&channel=<?php echo $stream->channel; ?>&auto_play=true&start_volume=25" />
</object>

<iframe frameborder="0" scrolling="no" id="chat_embed" src="http://twitch.tv/chat/embed?channel=<?php echo $stream->channel; ?>&popout_chat=true" height="400" width="620"></iframe>
                                
                                
                                
                                <p>
                                    
									
<?php echo HTML::parse_bbcode($stream->description); ?>
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
                        
<?php echo View::factory('comments', array('comments' => $comments, 'object_id' => $stream->id, 'object_type' => 'Stream')); ?>                    </div>
               
                </div>
                <!-- Column One End -->
                <!-- Column One Start -->
                
                <div class="col1 hidemobile">
                		<div class="widget">
                    	<h1 class="heading colr">Streamer</h1>
                        <div class="thumb">
                        	<img class="status-<?=$stream->user->status;?>" src="<?=Media_Remote_Avatar::get($stream->user->id, $stream->user->avatar);?>" alt="<?php echo $stream->user->username;?>" />
                        </div>
                        <div class="desc">
                        	<h4><?php echo HTML::anchor('igraci/'.$stream->user->accountid.'', $stream->user->username); ?></a></h4>
                            <p>
                            	<?php echo count($comments);?> komentara
                            </p>
                        </div>
                    </div>
                  
                   
                   <?php if(User::instance()->logged_in() AND (User::instance()->has_role('Administrator/ica') OR User::instance()->id == $stream->user_id)):?>
                  <div class="widget opcije">
                    	<h1 class="heading colr">Opcije</h1>
                        <div class="desc">
                        	<h4><?php echo HTML::anchor('igraci/'.$stream->user->accountid.'/stream/izmijeni', 'Izmijeni stream'); ?></h4>
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