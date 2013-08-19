<div class="clear"></div>
    <!-- Banner Start -->
    <div id="sub-banner">
    	<div class="in">
        	<a href="#"><img src="/assets/images/thebetaisover.png" alt="The Beta is Over" /></a>
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
                	<div class="contact">
                    	<h1 class="heading colr">Beta je završena - Preuzmi Dota 2</h1>
                        <!-- Contact Us Start -->
                        <div class="contact-page">
                        	  
                             <div class="alert alert-info">Dota 2 igra je izašla iz faze Beta, te je sada dostupna svim igračima širom svijeta.</div>
                             <div class="clear"></div>
                             
                             <div class="alert alert-note">
 							<h5 class="white">Dota 2 Valve objava</h5>
                              <div class="clear"></div>Valve je objavio da je Dota 2 Free to Play igra, dostupna svim igračima.<br />
                              Svi novi igrači će proči registracijsku formu kako bi dobili besplatnu igru tako što će Valve svakim danom dodavati određeni broj igrača. Rezultat tome je, kako navode iz Valve korporacije, je da ne bi došlo do prevelikog load-a servera.</div>
                             <div class="clear"></div>
                             
                             <?php if(!User::instance()->logged_in()):?>
                             <div class="alert alert-error">
 							<h5 class="white">Preuzmi Dota 2 besplatno</h5>
                              <div class="clear"></div>Moraš biti prijavljen na stranicu kako bi mogao preuzeti besplatno Dota 2 igru. Ukoliko si već registrovan korisnik stranice, <a class="link" href="/prijava">prijavi se</a>. Ako si novi korisnik, potrebno je izvršiti <a class="link" href="/provjera">registraciju</a>.</div>
                             <div class="clear"></div>
                             <?php else:?>
                              <div class="alert alert-info">
 							<h5 class="white">Preuzmi Dota 2 besplatno</h5>
                              <div class="clear"></div>Prijavljen si kao <a class="link"><?=User::instance()->username;?></a>. Sada možeš <a class="link" href="steam://install/570">preuzeti</a> Dota 2, ili ako već imaš igru, možeš je <a class="link" href="steam://run/570">pokrenuti</a> preko stranice.</div>
                             <div class="clear"></div>
                             <?php endif;?>
                             
                        </div>
                        <div class="clear"></div>
                        <!-- Post Detail End -->
                    </div>
                </div>
                <!-- Column One End -->
                <!-- Column One Start -->
                <div class="col1 hidemobile">
                	<!-- Text Widget Start -->
                	<div class="widget text-widget">
                    	<h1 class="colr heading">Dodatne informacije</h1>
                        <a class="getDotaLink" href="http://store.steampowered.com/app/570/?ref=Dota2Balkan"></a>
                    </div>
                    <!-- Text Widget End -->
                    
                </div>
                <!-- Column One End -->
            </div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Content Section End -->
    <div class="clear"></div>