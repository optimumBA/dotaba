
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
						<li class="completed" style="width:90%">90% gotov</li>

						<li class="start" id="first">
							<div class="content">
								<h2>Website Started</h2>
								<p>
									Donec vitae purus eget augue iaculis fermentum. Sed adipiscing nunc sed tellus rutrum nec sagittis orci lobortis. Pellentesque eu lectus vel enim sodales malesuada ut ac odio. Cras ut dapibus lectus. Aenean adipiscing accumsan auctor. Quisque venenatis quam eu libero scelerisque consectetur in ut neque. Fusce pellentesque gravida arcu et rhoncus. Donec in elit justo, ac sagittis nulla. Maecenas metus leo, sollicitudin ut placerat vel, pellentesque in sem.
								</p>
								<h4>Founders</h4>
								<ul class="testimonial">
									<li>
										<div>
											<img src="/assets/images/timeline/testimonial.jpg" width="115" height="115" alt="test">
										</div>
										<span>Exampe Person</span>
									</li>
									<li>
										<div>
											<img src="/assets/images/timeline/testimonial2.jpg" width="115" height="115" alt="test">
										</div>
										<span>Richard Selby</span>
									</li>
									<li>
										<div>
											<img src="/assets/images/timeline/testimonial3.jpg" width="115" height="115" alt="test">
										</div>
										<span>Baron Bryant</span>
									</li>
								</ul>
							</div>
							<div class="rel">
								<span class="arrow"></span>
								<span class="date"><a href="#" class="currentlink">početak</a><a href="#" class="nextli">sljedeće</a><a href="#last">kraj</a></span>
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
								<span class="date"><a href="#" class="prevlink">prethodno</a><a href="#" class="nextli">sljedeće</a></span>
							</div>
						</li>

						<li style="width:200px; left:89%">
							<div class="content">
								<h2>Testiranje</h2>
							</div>
							<div class="rel">
								<span class="arrow"></span>
								<span class="date"><a href="#" class="prevlink">prethodno</a><a href="#" class="nextli">sljedeće</a></span>
							</div>
						</li>

						<li id="last">
							<div class="content">
								<h2>Launch</h2>
							</div>
							<div class="rel">
								<span class="arrow"></span>
								<span class="date"><a href="#start">početak</a><a href="#" class="currentlink">6. april</a></span>
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