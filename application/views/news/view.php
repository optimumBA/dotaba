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
                                    <p><img class="" src="<?=$article->user->avatar;?>" width="16px" height="16px" align="absmiddle" /></p>
                                    <p><?php echo $article->created_at/*Date::formatted_time($article->created_at, $user->date_format, $user->timezone)*/; ?></p>
                                    <p>Izvor <a href="<?=$article->url;?>"><?=$article->source;?></a></p>
                                    <p><?php echo count($comments) ?> komentara</p>
                                   
                                </div>
                                <p>
                                	<?=$article->content;?>
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
                            <?php if (count($comments)): ?>
                                <ul>
                                    <?php foreach ($comments as $comment): ?>
                                        <li><?php echo $comment->body; ?></li>
                                    <?php endforeach ?>
                                </ul>
                            <?php else: ?>
                                <div class="alert alert-info">Trenutno nema komentara za ovu vijest.</div>
                            <?php endif; ?>
                        </div>
                        <!-- Comments End -->
                        <!-- Leave a Reply Start -->
                        <div class="leavereply">
                            <h1 class="heading colr">Dodaj komentar</h1>
                            <form class="forms">
                            <ul>
                                <li>
                                    <input name="" value="Enter Name"
                                    onfocus="if(this.value=='Enter Name') {this.value='';}"
                                    onblur="if(this.value=='') {this.value='Enter Name';}" type="text" />
                                </li>
                                <li>
                                    <input name="" value="Enter Email"
                                    onfocus="if(this.value=='Enter Email') {this.value='';}"
                                    onblur="if(this.value=='') {this.value='Enter Email';}" type="text" />
                                </li>
                                <li>
                                    <input name="" value="Enter Company Name"
                                    onfocus="if(this.value=='Enter Company Name') {this.value='';}"
                                    onblur="if(this.value=='') {this.value='Enter Company Name';}" type="text" />
                                </li>
                                <li>
                                    <textarea rows="" cols=""
                                    onfocus="if(this.value=='Enter Massage') {this.value='';}"
                                    onblur="if(this.value=='') {this.value='Enter Massage';}" />Enter Massage</textarea>
                                </li>
                                <li>
                                    <button>Submit Comment</button>
                                </li>
                            </ul>
                            </form>
                        </div>
                        <!-- Leave a Reply End -->
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