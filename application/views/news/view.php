<div class="clear"></div>
    <!-- Banner Start -->
    <div id="sub-banner">
    	<div class="in">
        	<a href="#"><img src="/assets/images/subbanner.jpg" alt="Dota 2 vijest - <?php echo $article->title;?>" /></a>
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
                                    <p><img class="status-s-<?=$article->user->status;?>" src="<?=Media_Remote_Avatar::get($article->user->id, $article->user->avatar);?>" width="16px" height="16px" align="absmiddle" /></p>
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
                        
     <?php echo View::factory('comments', array('comments' => $comments, 'object_id' => $article->id, 'object_type' => 'News')); ?>
                    </div>
               
                </div>
                <!-- Column One End -->
                <!-- Column One Start -->
                <div class="col1 hidemobile">
                	
                  <?php if(User::instance()->logged_in() AND (User::instance()->has_role('Administrator/ica') OR User::instance()->has_role('Novinar/ka'))):?>
                  <div class="widget opcije">
                    	<h1 class="heading colr">Opcije</h1>
                        <div class="desc">
                        	<h4><?php echo HTML::anchor('novosti/'.$article->id.'-'.URL::title($article->title).'/izmijeni', 'Izmijeni vijesti'); ?></h4>
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