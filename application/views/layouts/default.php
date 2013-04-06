 <!-- Header End -->
    <div class="clear"></div>
    <!-- Banner Start -->
    <div id="banner">
    	<div class="banner-in">
        	<div class="slider-wrapper theme-default">
            	<div id="slider" class="nivoSlider">
                	<a href="#"><img src="/assets/images/banner1.jpg" title="#banner1" alt="" /></a>
                    <a href="#"><img src="/assets/images/banner2.jpg" title="#banner2" alt="" /></a>
                  
                </div>
                <!-- Banner Caption Start -->
                <div id="banner1" class="nivo-html-caption">
                	<h1><a href="http://dota.ba/novosti/1-launch">Otvorenje</a></h1>
                    <p>
                    	Nakon dužeg vremena, uspješno smo otvorili zajednicu za Dota 2 igrače gdje možete pronaći vijesti, ifnromacije o update-ima, statistike, turnire i mnogo toga.
                    </p>
                    <a href="http://dota.ba/novosti/1-launch" class="banner-more"><span class="backcolr">Pročitaj više</span><span class="corner">&nbsp;</span></a>
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

                    <?php echo Request::factory('widgets/announcements')->execute(); ?>
                  
                </div>
                <!-- Column One End -->
                <!-- Column Two Start -->
                <div class="col2">
                    <?php echo Request::factory('widgets/videos')->execute(); ?>

                    <?php echo Request::factory('widgets/news')->execute(); ?>
                </div>
                <!-- Column Two End -->
                <!-- Column One Start -->
                <div class="col1 hidemobile">
                	




                    <!-- Facebook Start -->
                    <div class="widget facebook">
                       <div class="fb-like-box" data-href="https://www.facebook.com/DotA.Balkan" data-width="234" data-height="325" data-show-faces="true" data-colorscheme="dark" data-stream="false" data-header="false" border-color="#151515"></div>
                    </div>
                    <!-- Facebook End -->

                </div>
                <!-- Column One End -->
                </div>
            </div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Content Section End -->
    <div class="clear"></div>