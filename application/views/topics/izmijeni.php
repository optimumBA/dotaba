 <div class="clear"></div>
    <!-- Banner Start -->
   
    <!-- Banner End -->
<!-- Content Section Start -->
    <div id="content-sec">
    	<div class="inner">
        	<!-- Columns Section Start -->
            <div class="columns-sec twocol">
            	<!-- Column Three Start -->
                <div class="col3">
                	<div class="blog">
                    	<h1 class="heading colr">Izmijeni temu</h1>
<?php echo Form::open(); ?>
	<?php echo Form::label('name', 'Naziv:'); ?>
	<?php echo Form::input('name', Arr::path($values, 'name')); ?>
	<?php echo Arr::path($errors, 'name'); ?>

	<?php echo Form::label('content', 'Tekst:'); ?>
	<?php echo Form::textarea('content', Arr::path($values, 'content')); ?>
	<?php echo Arr::path($errors, 'content'); ?>

	<?php echo Form::hidden('csrf', Security::token()); ?>
	<?php echo Form::submit(NULL, 'Izmijeni'); ?>
<?php echo Form::close(); ?>
</div>
                </div>
            
                
                <!-- Column One End -->
              
                
                <!-- Column One Start -->
                <div class="col1 hidemobile">
                	
        
                   
                </div>
                <!-- Column One End -->
            </div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Content Section End -->
    <div class="clear"></div>