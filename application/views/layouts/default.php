 <!-- Header End -->
    <div class="clear"></div>
    <!-- Banner Start -->
    <div id="banner">
    	<div class="banner-in">
        	<div class="slider-wrapper theme-default">
            	<div id="slider" class="nivoSlider">
                	<a href="#"><img src="/assets/images/championsleaguebanner.jpg" title="#banner3" alt="Dota 2 Balkan Champions League" /></a>
                    <a href="#"><img src="/assets/images/banner1.jpg" title="#banner1" alt="" /></a>
                    <a href="#"><img src="/assets/images/TI3.jpg" title="#banner2" alt="" /></a>
                  
                </div>
                <!-- Banner Caption Start -->
                <div id="banner1" class="nivo-html-caption">
                	<h1><a href="/novosti/1-launch">Otvorenje</a></h1>
                    <p>
                        Nakon dužeg vremena, uspješno smo otvorili zajednicu za Dota 2 igrače gdje možete pronaći vijesti, informacije o <em>updateima</em>, statistike, turnire i mnogo toga.
                    </p>
                    <a href="/novosti/1-launch" class="banner-more"><span class="backcolr">Pročitaj više</span><span class="corner">&nbsp;</span></a>
                </div>
                 <div id="banner2" class="nivo-html-caption">
                	<h1><a href="/novosti/14-the-international">The International 3</a></h1>
                    <p>
                        The International se vraća ponovno u Seattle.
                    </p>
                    <a href="/novosti/14-the-international" class="banner-more"><span class="backcolr">Pročitaj više</span><span class="corner">&nbsp;</span></a>
                </div>
                 <div id="banner3" class="nivo-html-caption">
                	<h1><a href="/novosti/1-launch">Champions League</a></h1>
                    <p>
                        Uskoro na Dota 2 Balkan. Champions League turnir okuplja ekipe širom Balkana. Više informacija o prijavama, broju učesnika i nagradama u sljedećim danima.
                    </p>
                    
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

                    <?php echo Request::factory('widgets/matches')->execute(); ?>
                   
                    <div class="widget advert">
                       <a target="_new" href="http://dota2feed.com/?sid=<?=Session::instance()->id();?>&token=<?=sha1(Session::instance()->id());?>&refname=Dota2Balkan&ref=PartnerLogo&open.ns=true"><img width="250px" src="/assets/images/d2feedpartner.png" /></a>
                       <span>Dota 2 Feed - Partnerski sajt</span>
                    </div>
                  
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
                	

					<div class="widget">
                    
                  
                       
                      <a class="getDotaLink" href="/thebetaisover"></a>
                    
                    
                    </div>
                    
                   
                   
                    <div class="widget giveaway">
               	
                <div class="widget">
                    	<h1 class="heading colr">The International 3</h1>
                        <div class="thumb">
                        	<a href="http://www.dota2.com/international"><img src="/assets/images/ti3prize.png" alt="The International 3" /></a>
                        </div>
                        <div class="desc">
                        	<h4><a href="http://www.dota2.com/international/compendium/" class="white">The International 3 Compendium</a></h4>
                            <p>
                           <center><h6 class="colr"><a style="font-size: 1.5em" id="prizeVal"></a></h6></center>
                               
                            </p>
                        </div>
                    </div>
                    <script language="javascript">
    function populatePrizePool( dataJSON )
    {
        if ( dataJSON['dollars'] ) {
            jQuery('#prizeVal').html( '$' + addCommas( dataJSON['dollars'] ) );
        }
    }

    function addCommas(nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) 
        {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
    jQuery(document).ready(
        function()
        {
            var baseURL = ( location.protocol == 'https:' ) ? 'https://www.dota2.com/' : 'http://www.dota2.com/';
            URL = baseURL + 'jsfeed/intlprizepool';
            jQuery.ajax(
                {
                    type:'GET',
                    cache:true,
                    url: URL,
                    dataType:'jsonp',
                    jsonpCallback:'populatePrizePool'
                }
            );
        }
    );
  </script>
                    
                    
                    
                  
                  
                    <!-- Facebook Start -->
                    <div class="widget facebook">
                       <div class="fb-like-box" data-href="https://www.facebook.com/DotA.Balkan" data-width="234" data-height="325" data-show-faces="true" data-colorscheme="dark" data-stream="false" data-header="false" border-color="#151515"></div>
                    </div>
                    
                    <div class="widget facebook">
                       <?php echo Request::factory('widgets/newusers')->execute(); ?>
                    </div>
                    <!-- Facebook End -->
                    
                    
                    </div>
                </div>
                <!-- Column One End -->
                </div>
            </div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Content Section End -->
    <div class="clear"></div>