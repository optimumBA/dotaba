
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title><?php echo $title; ?></title>
		<link href='http://fonts.googleapis.com/css?family=Tauri' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css' />
		<link href="/assets/stylesheets/timeline/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
		<link href="/assets/stylesheets/timeline/style.css" rel="stylesheet" type="text/css" />
		<script src="/assets/javascript/jquery.min.js"></script>
		<script src="/assets/javascript/timeline/jquery.mCustomScrollbar.concat.min.js"></script>
		<script src="/assets/javascript/timeline/jquery.countdown.js"></script>
		<script src="/assets/javascript/timeline/jquery.mousewheel.min.js"></script>
		<script src="/assets/javascript/timeline/jquery.form.js"></script>
		<script src="/assets/javascript/timeline/jquery.waitforimages.js"></script>
		<script src="/assets/javascript/timeline/custom.js"></script>
	</head>
	<body>
		<div id="fb-root"></div>
		<div class="pane"></div>
		<h1><?php echo $title; ?></h1>
		<div id="counter" data-timestamp="<?php echo strtotime($date)*1000; ?>"></div>
		<div id="social">
			<a href="https://www.facebook.com/DotA.Balkan"><img src="/assets/images/timeline/1362808205_picons06.png" width="24" height="24" alt="facebook"/></a>
			<a href="https://twitter.com/dota2_balkan"><img src="/assets/images/timeline/1362808200_picons05.png" width="24" height="24" alt="twitter"/></a>
			<a href="https://plus.google.com/115884907979434946269"><img src="/assets/images/timeline/1362808690_picons09.png" width="24" height="24" alt="google+"/></a>
		</div>
		<div class="slider">
			<div class="overlay">
				<div class="overlay-image"></div>
				<div class="panel">
					<ul class="timeline">
						<li class="completed" style="width:90%">90% gotovo</li>

						<li class="start" id="first">
							<div class="content">
								<h2>O stranici</h2>
								<p>
									Dota 2 Balkan je community sajt za igru Dota 2. Na ovom sajtu možete gledati prijenose uživo, raspravljati o svojim omiljenim herojima, taktikama i sl.
Kao naš stari projekat DotA Balkan zajednice još od početka 2011 godine, se nije realizovao kao po planiranom, te nešto sredinom 2012 je otvorena, nova i osvježena stranica, koja prezentuje prenose aktivnih mečeva i turnira, ljetni DOTA 2 Giveaway by Frost. Dok danas bilježi rekordne posjete korisnika širom svijeta.
Nešto više od 3 mjeseca zabilježeno je preko 1300 korisnika, dok 12.35% aktivnik i 20% novoregistriranih.

U toku realizacija stranice samo za Dota 2 igru.
								</p>
								<h4>Osnivači</h4>
								<ul class="testimonial">
									<li>
										<div>
											<img src="http://media.steampowered.com/steamcommunity/public/images/avatars/e2/e24cca7c7cc33047149f8d8c39e2a807639e0d85_full.jpg" width="115" height="115" alt="Grifon">
										</div>
										<span>Grifon</span>
									</li>
									<li>
										<div>
											<img src="http://media.steampowered.com/steamcommunity/public/images/avatars/d7/d72a78d27a6eae3c7e990ace5fa208e39da3195b_full.jpg" width="115" height="115" alt="Bakcheia">
										</div>
										<span>Bakcheia</span>
									</li>
								</ul>
							</div>
							<div class="rel">
								<span class="arrow"></span>
								<span class="date"><a href="#" class="currentlink">Početak</a><a href="#" class="nextli">Sljedeće</a><a href="#last">Kraj</a></span>
							</div>
						</li>

						<li style="left:40%; width:374px">
							<div class="content">
								<div class="face-icon">
									<img src="/assets/images/timeline/1362877624_picons06.png" width="64" height="64" alt="facebook">
								</div>
								<div class="full-outer">
									<div class="face-outer">
										<div class="overflow-face">
											<div class="fb-like-box" data-href="http://www.facebook.com/DotA.Balkan" data-width="300" data-height="300" data-show-faces="true" data-stream="false" data-header="false"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="rel">
								<span class="arrow"></span>
								<span class="date"><a href="#" class="prevlink">Prethodno</a><a href="#" class="nextli">Sljedeće</a></span>
							</div>
						</li>

						
                      <li style="left:55%;">
					<div class="content" style="width:340px;">
					<h2>Dota 2 Balkan Logo</h2>
					<div class="outer">
						<div class="inner">
							<a href="/assets/images/timeline/community-logo.jpg" class="borderless"><span class="viewport"></span><img src="https://fbcdn-sphotos-d-a.akamaihd.net/hphotos-ak-ash4/740332_466723390050770_1244247613_o.jpg" width="300" height="auto" alt="design"></a>
						</div>
					</div>
				</div>
				<div class="rel">
					<span class="arrow"></span>
					<span class="date"><a href="#" class="prevlink">Prethodno</a><a href="#" class="currentlink">14. januar 2013.</a><a href="#" class="nextli">Sljedeće</a></span>
				</div>
				</li>
                        
                        
                        <li style="width:500px; left:90%" id="fourth">
                <div class="content">
				<h2>Testiranje</h2>
				<div class="fhold">
					<div class="half">
						<p>
							U fazi smo testiranja sljedećih sistema stranice
						</p>
						<ul class="features">
							<li>Liga</li>
							<li>Turniri</li>
							<li>Forum</li>
							<li>Korisnički profili</li>
						</ul>
					</div>
					<div class="half">
						<p>
							Faza testiranja traje do 6.4.2013., gdje ćemo u tom roku provjeriti napomenute sisteme kako bi Vama omogućili lakši i sigurni pristup.
                            <br />
                            Trenutno niste u mogućnosti da se prijavite na stranicu. Ukoliko ste registrovani na Beta kanal, imate pristup stranici bez najave.
                            
                         	Nadamo se ranijem otvaranju stranice, Dota 2 Balkan Community :)
						</p>
					</div>
				</div>
                </div>
				<div class="rel">
					<span class="arrow"></span>
					<span class="date"><a href="#" class="prevlink">Prethodna</a><a href="#" class="currentlink">27. mart 2013</a><a href="#" class="nextli">Sljedeće</a></span>
				</div>

						<li id="last">
							<div class="content">
								<h2>Launch</h2>
							</div>
							<div class="rel">
								<span class="arrow"></span>
								<span class="date"><a href="#start">Početak</a><a href="#" class="currentlink">6. april</a></span>
							</div>
						</li>
					</ul>

					<div class="todo" style="width:10%;">
						<div class="rel">
							<div class="border"></div>
							<div class="progress">
								<div class="hold">
									<div class="pattern"></div>
									<div class="bar">
										<div class="lighten"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="todo-overlay" style="width:25%;"></div>

					<div class="progress">
						<div class="hold">
							<div class="pattern"></div>
							<div class="bar">
								<div class="lighten"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="loading"></div>
		<script>
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "http://connect.facebook.net/en_US/all.js#xfbml=1";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
	</body>
</html>