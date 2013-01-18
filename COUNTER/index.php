<?php
session_start();



$s = $_REQUEST['s'];
if(!isset($s)) { header('Location: index.php?s='.sha1(session_id()).'&utf8=✓'); } else { if($s == '') { session_destroy($s); } else { session_start($s); } }
session_set_cookie_params((time()+$_SITE['session_length']));

$s = session_name();
setcookie("DotaBa", $value, time()+3600, "#", "dota.ba", 1);


?>

<!DOCTYPE html>

<html class="no-js" lang="en">

	<head>
	
		<meta charset="utf-8">
		
		<title>Dota 2 Balkan Community</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lobster">
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Cabin+Sketch:bold">
		<link rel="stylesheet" href="resources/css/reset.css">
		<link rel="stylesheet" href="resources/css/style.css">
		 <link rel='stylesheet' type='text/css' href='jscomms/style_light.css'/>	
		<!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
		<script src="resources/js/modernizr.js"></script>
		
	</head>
	
	<body>
	
		<header>
			<div id="header-title"></div>
		</header>
			
		<div id="main">
			<section id="main-content" class="clearfix">
				<div class="main-content-image-wrap">
					<div class="main-content-image-tape"></div>
					<div class="main-content-image-frame"></div>
					<div class="main-content-image"><img src="resources/img/BALKANB.jpg" alt="" /></div>
				</div>
				<div class="main-content-text">
					<div>
						<h2>Stranica je u fazi izrade</h2>
						<p>
				
                          Kao i što je najavljeno, novi projekat umjesto starog sajta, sada se okrećemo samo Dota 2 gamingu.
                          Dota 2 community će našim korisnicima omogućiti uvid u svoje Dota 2 statistike kao mečeve, level, inventory i slično. Veliki broj mogućnosti sajta kao Featured hero, tutorijali i vodići za heroje i iteme, Dota 2 vijesti i mnogo toga.
							<p>Dota 2 Balkan</p>
						</p>
					</div>
				</div>
			</section>
			<section id="progressbar">
				
			</section>
			<section id="countdown">
				<div id="countdown-title" class="seperator"><div></div></div>
				<div id="countdown-numbers" class="clearfix">
					<ul>
						<li>
							<strong>00</strong>
							<small>Dana</small>
						</li>
						<li>
							<strong>00</strong>
							<small>Sati</small>
						</li>
						<li>
							<strong>00</strong>
							<small>Minuta</small>
						</li>
						<li>
							<strong>00</strong>
							<small>Sekundi</small>
						</li>
					</ul>
				</div>
				<div class="seperator"></div>
			</section>
			<section id="notify">
				
				
			</section>
		</div>
			
		<footer>
			<section id="social-links">
				<ul>
					
					<li><a href="https://www.facebook.com/DotA.Balkan"><img src="resources/img/social/facebook.png" alt="Facebook" /></a></li>
                    <li><a href="http://steamcommunity.com/groups/DOTA_Balkan"><img src="resources/img/social/steam.png" alt="Steam" /></a></li>
				
				</ul>
			</section>
		</footer>
		
		
		<!-- JavaScript at the bottom for fast page loading -->
		
		<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if necessary -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script>window.jQuery || document.write("<script src='resources/js/jquery.js'>\x3C/script>")</script>
		
		<script src="resources/js/plugins.js"></script>
		<script src="resources/js/script.js"></script>
	
	</body>
	
</html>