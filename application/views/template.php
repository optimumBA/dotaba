<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<!-- Downloaded from www.scriptgates.com - go for more! -->
<head>
<meta charset="utf-8">
<title><?php echo $title; ?></title>
<meta name="description" content="">
<meta name="author" content="">
<!--// Mobile Metas //-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--// Stylesheets //-->
<link rel="stylesheet" href="/assets/stylesheets/style.css" />
<link rel="stylesheet" href="/assets/stylesheets/base.css" />
<link rel="stylesheet" href="/assets/stylesheets/skeleton.css" />
<link rel="stylesheet" href="/assets/stylesheets/layout.css" />
<link rel="stylesheet" href="/assets/stylesheets/player.css" />
<link rel="stylesheet" href="/assets/stylesheets/fancybox.css" />

<link rel="stylesheet" type="text/css" href="/assets/stylesheets/color.css" title="styles7" media="screen" />

<link rel="alternate stylesheet" type="text/css" href="/assets/stylesheets/blue.css" title="styles2" media="screen" />

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--// Favicons //-->
<link rel="shortcut icon" href="/assets//assets/images/favicon.ico" />
<link rel="rockit-touch-icon" href="/assets//assets/images/rockit-touch-icon.html" />
<link rel="rockit-touch-icon" sizes="72x72" href="/assets//assets/images/rockit-touch-icon-72x72.html" />
<link rel="rockit-touch-icon" sizes="114x114" href="/assets//assets/images/rockit-touch-icon-114x114.html" />
<!--// Javascript //-->
<script type="text/javascript" src="/assets/javascript/jquery.min.js"></script>
<script type="text/javascript" src="/assets/javascript/styleswitch.js"></script>
<script type="text/javascript" src="/assets/javascript/animatedcollapse.js"></script>
<script type="text/javascript" src="/assets/javascript/ddsmoothmenu.js"></script>
<script type="text/javascript" src="/assets/javascript/jquery.nivo.slider.js"></script>
<script type="text/javascript" src="/assets/javascript/scrolltopcontrol.js"></script>
<script type="text/javascript" src="/assets/javascript/jquery.countdown.js"></script>
<script type="text/javascript" src="/assets/javascript/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="/assets/javascript/jplayer.playlist.min.js"></script>
<script type="text/javascript" src="/assets/javascript/player.js"></script>
<script type="text/javascript" src="/assets/javascript/jquery-ui.min.js"></script>
<script type="text/javascript" src="/assets/javascript/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="/assets/javascript/jquery.mCustomScrollbar.js"></script>

</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/bs_BA/all.js#xfbml=1&appId=335610739861235";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<!-- Outer Wrapper Start -->
<div id="outer-wrapper">
	<!-- Header Start -->
	<div id="header">
    	<div class="inner">
        	<!-- Container Start -->
            <div class="container">
                <!-- Logo Start -->
                <div class="five columns left">
                    <a href="index.html" class="logo"><img src="/assets/images/logo.png" alt="" /></a>
                </div>
                <!-- Logo End -->
                <div class="eleven columns right">
                    <!-- Top Links Start -->
                    <ul class="top-links">
                        <li>
                            <h4 class="colr">Pretraga</h4>
                            <div id="search-box">
                                <input name="" value="Unesite pojam za pretragu"
                                onfocus="if(this.value=='Enter any keyword') {this.value='';}"
                                onblur="if(this.value=='') {this.value='Enter any keyword';}" type="text" class="bar" />
                                <button>Traži</button>
                            </div>
                        </li>
                        <li>
                            <a href="javascript:animatedcollapse.toggle('login-box')" class="colr">Prijava</a>
                            <div id="login-box">
                                <h4 class="white backcolr">User Login <a href="javascript:animatedcollapse.hide('login-box')" class="closeit">&nbsp;</a></h4>
                                <ul>
                                    <li>
                                        <input name="" value="yourname@email.com"
                                        onfocus="if(this.value=='yourname@email.com') {this.value='';}"
                                        onblur="if(this.value=='') {this.value='yourname@email.com';}"   type="text" class="bar" />
                                    </li>
                                    <li>
                                        <input name="" value="password"
                                        onfocus="if(this.value=='password') {this.value='';}"
                                        onblur="if(this.value=='') {this.value='password';}"   type="password" class="bar" />
                                    </li>
                                    <li>
                                        <input type="checkbox" class="left" />
                                        <p>Remember me</p>
                                        <a href="#" class="right">Forget Password?</a>
                                    </li>
                                    <li>
                                        <button class="backcolrhover">Login</button>
                                    </li>
                                </ul>
                                <div class="clear"></div>
                            </div>
                        </li>
                    </ul>
                    <!-- Top Links End -->
                </div>
                <!-- Navigation Start -->
                <div class="navigation">
                	<div id="smoothmenu1" class="ddsmoothmenu">
                    	<ul id="nav">
                        	<li class="<?php if(Request::current()->controller() == 'Pages') echo 'current-menu-item'; ?>"><a href="/">Početna</a></li>
                            <li class="<?php if(Request::current()->controller() == 'News') echo 'current-menu-item'; ?>"><a href="/novosti">Novosti</a></li>
                            

                            <li><a href="#">VOD's</a>
                            	<ul>
                                	<li><a href="#">Snimci</a></li>
                                    <li><a href="#">Stream-ovi</a></li>
                                    <li><a href="#">Galerija</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Liga</a>            
                            	<ul>
                                	<li><a href="#">Turniri</a></li>
                                   	<li><a href="#">Mečevi</a></li>
                                    <li><a href="#">Timovi</a></li>
                                    <li><a href="#">Igrači</a></li>
                                   	<li><a href="#">Statistike</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Store</a>
                            <li><a href="#">Vodiči</a>
                            	<ul>
                  				 	<li><a href="#">Heroji</a></li>
                                   	<li><a href="#">Item-i</a></li>
                                </ul>
                            </li>
                           
                        </ul>
                        <div class="clear"></div>
                    </div>
                </div>
                <!-- Navigation End -->
                <div class="clear"></div>
            </div>
            <!-- Container End -->
        </div>
    </div>
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
                	<?php if(Request::current()->controller() == 'Pages'):?>
                    <!-- Latest Videos Start -->
                	<div class="latest-videos">
                    	<h1 class="heading colr">Posljednji snimci</h1>
                        <div class="video">
                        	<iframe height="231" src="http://www.youtube.com/embed/_LmAcfO9lyg" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <div class="desc">
                        	<h4><a href="blog-detail.html" class="white">Smile Dip (Dave Barnes)</a></h4>
                            <p>
                            	Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tellus orci, semper et ornare dictum, varius ut tellus.
                            </p>
                            <a href="blog-detail.html" class="buttonone">Pogledaj sve snimke</a>
                        </div>
                    </div>
                    <!-- Latest Videos End -->
                
                    <!-- Latest News Start -->
                    <div class="latest-news noback">
                    	<h1 class="heading colr">Posljednje novosti</h1>
                        <ul class="news-list">
                        	<li>
                            	<div class="thumb">
                                	<a href="blog-detail.html">
                                    	<img src="/assets/images/img8.jpg" alt="" />
                                        <span>VEIW</span>
                                    </a>
                                </div>
                                <div class="desc">
                                	<h4><a href="blog-detail.html" class="white">Smile Dip (Dave Barnes)</a></h4>
                                    <p class="post-opts">08 HOurs ago / <a href="#">4 comments</a></p>
                                    <p class="txt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tellus orci, semper et ornare dictum, varius ut tellus.</p>
                                </div>
                            </li>
                            <li>
                            	<div class="thumb">
                                	<a href="blog-detail.html">
                                    	<img src="/assets/images/img9.jpg" alt="" />
                                        <span>VEIW</span>
                                    </a>
                                </div>
                                <div class="desc">
                                	<h4><a href="blog-detail.html" class="white">Smile Dip (Dave Barnes)</a></h4>
                                    <div class="post-opts">
                                    	<p>08 HOurs ago / <a href="#">4 comments</a></p>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tellus orci, semper et ornare dictum, varius ut tellus.</p>
                                </div>
                            </li>
                        </ul>
                        <a href="news.html" class="buttonone">Pogledaj sve novosti</a>
                    </div>
                    <!-- Latest News End -->
                       <?php endif;?>
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
                   <?php if(Request::current()->controller() == 'Pages'):?>
                    <!-- Facebook Start -->
                    <div class="widget facebook">
                       <div class="fb-like-box" data-href="https://www.facebook.com/DotA.Balkan" data-width="234" data-height="325" data-show-faces="true" data-colorscheme="dark" data-stream="false" data-header="false" border-color="#151515"></div>
                    </div>
                    <!-- Facebook End -->
              	   <?php endif;?>
                </div>
                <!-- Column One End -->
                </div>
            </div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Content Section End -->
    <div class="clear"></div>
    <!-- Footer Start -->
    <div id="footer">
    	<div class="inner">
        	<!-- // Go to Top // -->
        	<a href="#top" class="gotop">&nbsp;</a>
        	<!-- Footer Left Start -->
            <div class="ft-left">
            	<h4><a href="#" class="colr">Brzi pregled</a></h4>
                <ul class="links">
                	<li><a href="#">Početna</a></li>
                    <li><a href="#">Tim</a></li>
                    <li><a href="#">Oglašavanje</a></li>
                    <li><a href="#">Changelog</a></li>
          
                </ul>
                <ul class="social">
                	<li><a href="https://www.facebook.com/DotA.Balkan" class="so-fb">&nbsp;</a></li>
                
                </ul>
            </div>
            <!-- Footer Left End -->
            <!-- Footer Right Start -->
            <div class="ft-right">
            	<div class="contact-us">
                    <h4 class="colr">Kontaktirajte nas</h4>
                    <p>Podrška, pitanje, prijedlog i kritike</p>
                    <h4 class="white">podrska@dota.ba<br />www.dota.ba</h4>
                </div>
            </div>
            <!-- Footer Left End -->
            <!-- Copyrights Start -->
            <div class="copyrights">
            	 © Sva prava pridržana <a href="#">Dota 2 Balkan</a> <?php echo date('Y'); ?> &nbsp;&nbsp;      <small>Verzija stranice: 1.0.0 BETA</small>
            </div>
            <!-- Copyrights End -->
            <div class="clear"></div>
        </div>
    </div>
    <!-- Footer End -->
    <div class="clear"></div>
</div>
<!-- Outer Wrapper End -->
</body>


</html>