<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->


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

<link rel="stylesheet" type="text/css" href="/assets/stylesheets/color.css" title="styles2" media="screen" />

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
                    <a href="/" class="logo"><img src="/assets/images/logo.png" alt="" /></a>
                </div>
                <!-- Logo End -->
                <div class="eleven columns right">
                    <!-- Top Links Start -->
                    <ul class="top-links">
                        <li>
                            <h4 class="colr">Pretraga</h4>
                            <div id="search-box"><span class="js-search-action"></span>
                                <form id="searchbox" class="navbar-search" action="/pretraga">
                                <input name="q" placeholder="Unesite pojam za pretragu" type="text" class="bar input-medium search-query" />
                                <button>Traži</button>
                                </form>
								<script type="text/javascript">
$(".js-search-action").on("click", function() {
$("form.navbar-search").submit();
});

</script>
                            </div>
                        </li>
                        
                            <?php if(!Steam::logged_in()):?>
                           <li> <a href="/provjera" class="colr"><div class="SteamSITSSmall"></div></a></li>
							<?php else:?>
                            <li><img class="steam-avatar-small offline-status" src="<?=Steam::userinfo('avatar');?>" title="<?=Steam::userinfo('username');?>-ov avatar"> <a href="#profil" class="offline-status"><?=Steam::userinfo('username');?></a></li>
                           
                            <li><a href="/odjava" class="colr">Odjava</a>
							<?php endif;?>
                           
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
                           

                            <li><a href="/vods">VOD's</a>
                            	<ul>
                                	<li><a href="/vods/snimci">Snimci</a></li>
                                    <li><a href="/vods/stream">Stream-ovi</a></li>
                                    <li><a href="/vods/galerija">Galerija</a></li>
                                </ul>
                            </li>
                            <li><a href="/liga">Liga</a>            
                            	<ul>
                                	<li><a href="/liga/turniri">Turniri</a></li>
                                   	<li><a href="/liga/mecevi">Mečevi</a></li>
                                    <li><a href="/liga/timovi">Timovi</a></li>
                                    <li><a href="/liga/igraci">Igrači</a></li>
                                   	<li><a href="/liga/statistike">Statistike</a></li>
                                </ul>
                            </li>
                            <li><a href="/#addMenu=Store&t=BETA&a=closed">Store</a>
                            <li><a href="/guides">Vodiči</a>
                            	<ul>
                  				 	<li><a href="/guides/heroji">Heroji</a></li>
                                   	<li><a href="/guides/itemi">Item-i</a></li>
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
   
    <?php foreach ($messages as $message): ?>
        <div class="<?php echo $message['type']; ?>"><?php echo $message['value']; ?></div>
    <?php endforeach ?>
	
	 

    <!-- Notification box -->
  
    <!-- Notification box End-->
	  
    
    
 <?php echo $layout;?>
 

 
 
    <!-- Footer Start -->
    <div id="footer">
    	<div class="inner">
        	<!-- // Go to Top // -->
        	<a href="#top" class="gotop">&nbsp;</a>
        	<!-- Footer Left Start -->
            <div class="ft-left">
            	<h4><a href="#" class="colr">Brzi pregled</a></h4>
                <ul class="links"> 
                    <li><a href="/site/webteam">Tim</a></li>
                    <li><a href="/advertisments">Oglašavanje</a></li>
                    <li><a href="/site/api">API</a></li>
                    <li><a href="/site/privacy">Privacy</a></li>
                    <li><a href="/site/terms">Terms</a></li>
                    <li><a href="/changelog?setVrID=latest&order=VrID">Changelog</a></li>
          
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
<?php if (Kohana::$environment === Kohana::DEVELOPMENT): ?>
	<?php echo View::factory('profiler/stats') ?>
<?php endif ?>
</body>


</html>