<div class="clear"></div>
    <!-- Banner Start -->
    <div id="sub-banner">
    	<div class="in">
        	<a href="#"><img src="/assets/images/UI/Steam_banner.png" alt="" /></a>
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
                    	<h1 class="heading colr">Steam autentifikacija</h1>
                        <!-- Contact Us Start -->
                        <div class="contact-page">
                        	  
                              <?php if(!User::instance()->logged_in()):?>
                              <div class="alert alert-info">Da bi se autentifikovali na stranicu i dobili željene podatke, potrebno je kliknuti na duge Steam autentifikacije, koja će vas nakon toga preusmjeriti na službenu stranicu Steam-a.</div>
                              <div class="alert alert-info">Klikom na dugme prijave se slažete sa našim pravima i uvijetima, te pravilima privatnosti.</div>
                              
                              <div class="alert alert-notice">Ukoliko je korisnički račun blokiran (banovan), prijava nije moguća.</div>
                              <?php else:?>
                              <div class="alert alert-error">
                              Trenutno si prijavljen/a kao <?php echo HTML::image(Media_Remote_Avatar::get(User::instance()->id, User::instance()->avatar), array('alt' => User::instance()->username, 'class' => 'status-avatar-align steam-avatar status-s-'.User::instance()->status.'', 'width' => 16)); ?> <span class="status-<?php echo User::instance()->status;?>"><?php echo User::instance()->username;?></span>.                         <div class="clear"></div>

                              Da bi se ponovo prijavio/la sa drugim računom, moraš odjaviti sa trenutnog. <a class="steamloginBttn-wlcmsg  steamLoginText-wlcmsg embossed-link" href="/odjava#steamLogout">Odjavi se?</a>
                              </div>
                              <?php endif;?>
                            <div class="cont-sec">
                               
                                
                            </div>
                            <?php if(!User::instance()->logged_in()):?>
                            <div class="inquiry">
                            	<h1 class="heading colr">Potvrda</h1>
                             
                           <a href="/prijava" class="steamloginBttn-check  steamLoginText-check embossed-link">Potvrdi prijavu putem Steam-a</a>
                            
                            </div>
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
                    	<h1 class="heading colr">Info</h1>
                        <p class="bold">
                            SSL autentifikacija preko Steam-a
                         
                        </p>
                        <p>
                        	SSL<br />
                            Domena: dota.ba<br />
                            OpenID<br />
                            WebAPI<br />
                        </p>
                        
                        <p>
                        	<span class="colr">Podrška</span><br />
                            
							podrska@dota.ba<br />
                        </p>
                        
                         <p>
                        	<span class="colr"><a href="/pravila">Pravila</a></span>
                            
						
                        </p>
                         <p>
                        	<span class="colr"><a href="/uslovi">Uslovi</a></span>
                            
							
                        </p>
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