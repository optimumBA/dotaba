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
                    	<h1 class="heading colr">Izmijeni turnir</h1>
<?php echo Form::open(NULL, array('enctype' => 'multipart/form-data')); ?>
	<?php echo Form::label('name', 'Naziv:'); ?>
	<?php echo Form::input('name', Arr::path($values, 'name')); ?>
	<?php echo Arr::path($errors, 'name'); ?>

	<?php echo Form::label('description', 'Opis:'); ?>
	<?php echo Form::textarea('description', Arr::path($values, 'description')); ?>
	<?php echo Arr::path($errors, 'description'); ?>

	<?php echo Form::label('default', 'Slika:'); ?>
	<?php echo Form::file('default'); ?>
	<?php echo Arr::path($errors, 'default'); ?>

	<?php if (isset($modes)): ?>
		<?php echo Form::label('mode_id', 'Môd:'); ?>
		<?php echo Form::select('mode_id', $modes, Arr::path($values, 'mode_id')); ?>
		<?php echo Arr::path($errors, 'mode_id'); ?>
	<?php endif ?>

	<?php if (isset($clans)): ?>
		<?php echo Form::label('winner_id', 'Pobjednici:'); ?>
		<?php echo Form::select('winner_id', Arr::unshift($clans, NULL, NULL), Arr::path($values, 'winner_id')); ?>
		<?php echo Arr::path($errors, 'winner_id'); ?>
	<?php endif ?>

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