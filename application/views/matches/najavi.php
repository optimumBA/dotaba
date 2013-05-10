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
                    	<h1 class="heading colr">Najavi meč</h1>

<?php echo Form::open(); ?>
	<?php echo Form::label('radiant_clan_id', 'Radiant:'); ?>
	<?php echo Form::select('radiant_clan_id', $clans, Arr::path($values, 'radiant_clan_id')); ?>
	<?php echo Arr::path($errors, 'radiant_clan_id'); ?>

	<?php echo Form::label('dire_clan_id', 'Dire:'); ?>
	<?php echo Form::select('dire_clan_id', $clans, Arr::path($values, 'dire_clan_id')); ?>
	<?php echo Arr::path($errors, 'dire_clan_id'); ?>

	<?php echo Form::label('date', 'Vrijeme odigravanja:'); ?>
	<?php echo Form::input('date', Arr::path($values, 'date'), array('class' => 'datetime')); ?>
	<?php echo Arr::path($errors, 'date'); ?>

	<?php echo Form::hidden('csrf', Security::token()); ?>
	<?php echo Form::submit(NULL, 'Najavi'); ?>
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