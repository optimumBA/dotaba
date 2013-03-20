<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="bs"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="bs"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="bs"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="bs"> <!--<![endif]-->


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

<link rel="stylesheet" type="text/css" href="/assets/stylesheets/color.css" title="styles2" media="screen" />

<link rel="alternate stylesheet" type="text/css" href="/assets/stylesheets/blue.css" title="styles2" media="screen" />

<link rel="stylesheet" type="text/css" href="/assets/stylesheets/jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/assets/stylesheets/jquery-ui-timepicker-addon.css" />
<link rel="stylesheet" type="text/css" href="/assets/stylesheets/application.css" />

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--// Favicons //-->
<link rel="shortcut icon" href="/assets/images/favicon.ico" />
<!--<link rel="rockit-touch-icon" href="/assets/images/rockit-touch-icon.html" />
<link rel="rockit-touch-icon" sizes="72x72" href="/assets/images/rockit-touch-icon-72x72.html" />
<link rel="rockit-touch-icon" sizes="114x114" href="/assets/images/rockit-touch-icon-114x114.html" />-->
<!--// Javascript //-->
<script type="text/javascript" src="/assets/javascript/jquery.min.js"></script>
<script type="text/javascript" src="/assets/javascript/ddsmoothmenu.js"></script>
<script type="text/javascript" src="/assets/javascript/jquery.nivo.slider.js"></script>
<script type="text/javascript" src="/assets/javascript/scrolltopcontrol.js"></script>
<script type="text/javascript" src="/assets/javascript/jquery.countdown.js"></script>
<script type="text/javascript" src="/assets/javascript/jquery-ui.min.js"></script>
<script type="text/javascript" src="/assets/javascript/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="/assets/javascript/application.js"></script>

<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', '<?php echo Kohana::$config->load("site")->get("ga_account"); ?>']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
</script>
</head>
<body>

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
                                <input name="q" value="Unesite pojam za pretragu" 
                                				onfocus="if(this.value=='Unesite pojam za pretragu') {this.value='';}"
                                 				onblur="if(this.value=='') {this.value='Unesite pojam za pretragu';}" 
                                                type="text" 
                                                class="bar input-medium search-query" />
                                <button>Traži</button>
                                </form>
                            </div>
                        </li>
                        
                            <?php if( ! User::instance()->logged_in()):?>
                           <li> <a href="/provjera" class="colr"><div class="SteamSITSSmall"></div></a></li>
							<?php else:?>
                            <li><img class="steam-avatar-small offline-status" src="<?=User::instance()->avatar;?>" title="<?=User::instance()->username;?>-ov avatar" /> <a href="/igraci/<?=User::instance()->accountid;?>" class="offline-status"><?=User::instance()->username;?></a></li>
                           
                            <li><a href="/odjava" class="colr">Odjava</a>
							<?php endif ?>
                           
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
                            <li><a href="/vods/snimci">Snimci</a></li>
                            <li><a href="/liga">Liga</a>
                            	<ul>
                                	<li><a href="/liga/turniri">Turniri</a></li>
                                   	<li><a href="/liga/mecevi">Mečevi</a></li>
                                    <li><a href="/liga/klanovi">Timovi</a></li>
                                    <li><a href="/liga/igraci">Igrači</a></li>
                                </ul>
                            </li>
                            <li><a href="/teme">Forum</a></li>
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
   
    
	
	 
<div class="clear"></div>
    <!-- Notification box -->
  	<?php if( ! User::instance()->logged_in()):?>
    <div class="alert-top alert-info">Dobrodošli na <a class="link">Dota 2 Balkan Community</a>. Ukoliko je ovo Vaša prva posjeta, pročitajte <a class="link" href="/site/help">uputstvo za korištenje</a> stranice. Ako ste već korisnik ove stranice, molimo da se <a class="link" href="/provjera?mod=Prijava">prijavite</a>, kako bi imali sve mogućnosti stranice. U slučaju da nemate korisnički račun, možete se <a class="link" href="/provjera?mod=Registracija">registrovati</a>.</div>
 	<?php endif;?>
 
  <?php foreach ($messages as $message): ?>
        <div class="alert-top alert-<?php echo $message['type']; ?>"><?php echo $message['value']; ?></div>
    <?php endforeach ?>
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
                    <li><a href="/pravila">Pravila</a></li>
                    <li><a href="/uvjeti">Uvjeti</a></li>
                </ul>
                <ul class="social">
                	<li><a href="https://www.facebook.com/DotA.Balkan" class="so-fb">&nbsp;</a></li>
                    <li><a href="https://twitter.com/dota2_balkan" class="so-twitter">&nbsp;</a></li>
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
                © Sva prava pridržana <a href="/">Dota 2 Balkan</a> <?php echo date('Y'); ?> &nbsp;&nbsp;      <small>Verzija stranice: 1.0.0 BETA</small>
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