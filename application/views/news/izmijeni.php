<!-- Header End -->
    <div class="clear"></div>
    <!-- Banner Start -->
    <div id="sub-banner">
    	<div class="in">
        	<a href="#"><img src="/media/news/subbanner.jpg" alt="Dota 2 Balkan vijesti" /></a>
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
                	<div class="blog">
                    	<h1 class="heading colr">Objavi vijesti</h1>
<?php echo Form::open(NULL, array('enctype' => 'multipart/form-data')); ?>
	<?php echo Form::label('title', 'Naslov:'); ?>
	<?php echo Form::input('title', Arr::path($values, 'title')); ?>
	<?php echo Arr::path($errors, 'title'); ?>

	<?php echo Form::label('content', 'Tekst:'); ?>
	<?php echo Form::textarea('content', Arr::path($values, 'content')); ?>
	<?php echo Arr::path($errors, 'content'); ?>

	<?php echo Form::label('source', 'Izvor:'); ?>
	<?php echo Form::input('source', Arr::path($values, 'source')); ?>
	<?php echo Arr::path($errors, 'source'); ?>

	<?php echo Form::label('url', 'URL izvora:'); ?>
	<?php echo Form::input('url', Arr::path($values, 'url')); ?>
	<?php echo Arr::path($errors, 'url'); ?>

	<?php echo Form::label('default', 'Slika:'); ?>
	<?php echo Form::file('default'); ?>
	<?php echo Arr::path($errors, 'default'); ?>

	<?php echo Form::hidden('csrf', Security::token()); ?>
	<?php echo Form::submit(NULL, 'Izmijeni'); ?>
<?php echo Form::close(); ?>
</div>
                </div>
            
                
                <!-- Column One End -->
              
                
                <!-- Column One Start -->
                <div class="col1 hidemobile">
                	
                   
                	<div class="widget aktivni-eventi">
                    	<h1 class="heading colr">Info</h1>
                        <div class="thumb">
                        	<img class="frame" src="/assets/images/index-banner.png" alt="Dota 2 Balkan Vijesti" />
                        </div>
                        <div class="desc">
                        	<h4><a class="white">Pregled vijesti</a></h4>
                            <p>
                            	Dota 2 Balkan novinari vam omogućavaju brzi pregled vijesti Dota 2 svijeta, Dota 2 update-a, svjetskih turnira i Dota 2 Balkan turnira. <br />Ukoliko želite postati Dota 2 Balkan novinar, kontaktirajte nas na podrska@dota.ba sa naslovom predmeta aplikacije.
                            </p>
                        </div>
                    </div>
                    
                    
            
                   
                </div>
                <!-- Column One End -->
            </div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Content Section End -->
    <div class="clear"></div>