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
                    	<h1 class="heading colr">Izmijeni meč</h1>
<?php echo Form::open(); ?>
	<?php echo Form::label('radiant_win', 'Pobjednici:'); ?>
	<?php echo Form::select('radiant_win', $clans, Arr::path($values, 'radiant_win')); ?>
	<?php echo Arr::path($errors, 'radiant_win'); ?>

	<?php echo Form::label('duration', 'Trajanje meča (u sekundama):'); ?>
	<?php echo Form::input('duration', Arr::path($values, 'duration', 0)); ?>
	<?php echo Arr::path($errors, 'duration'); ?>

	<?php echo Form::label('first_blood_time', 'Vrijeme first blooda (u sekundama):'); ?>
	<?php echo Form::input('first_blood_time', Arr::path($values, 'first_blood_time', 0)); ?>
	<?php echo Arr::path($errors, 'first_blood_time'); ?>

	<?php for ($i = 0; $i < 10; $i++): ?>
		<?php echo ($i + 1).'. slot'; ?>
		<div class="slot">
			<?php echo Form::label('slots['.$i.'][user_id]', 'Igrač:'); ?>
			<?php echo Form::select('slots['.$i.'][user_id]', $users, Arr::path($values, 'slots.'.$i.'.user_id')); ?>
			<?php echo Arr::path($errors, 'slots.'.$i.'.user_id'); ?>

			<?php echo Form::label('slots['.$i.'][hero_id]', 'Heroj:'); ?>
			<?php echo Form::select('slots['.$i.'][hero_id]', $heroes, Arr::path($values, 'slots.'.$i.'.hero_id')); ?>
			<?php echo Arr::path($errors, 'slots.'.$i.'.hero_id]'); ?>

			<?php for ($j = 0; $j < 6; $j++): ?>
				<?php echo Form::label('slots['.$i.'][item_'.$j.'_id]', 'Item '.($j+1).':'); ?>
				<?php echo Form::select('slots['.$i.'][item_'.$j.'_id]', $items, Arr::path($values, 'slots.'.$i.'.item_'.$j.'_id')); ?>
				<?php echo Arr::path($errors, 'slots.'.$i.'.item_'.$j.'_id'); ?>
			<?php endfor ?>

			<?php echo Form::label('slots['.$i.'][kills]', 'kills:'); ?>
			<?php echo Form::input('slots['.$i.'][kills]', Arr::path($values, 'slots.'.$i.'.kills', 0)); ?>
			<?php echo Arr::path($errors, 'slots.'.$i.'.kills'); ?>

			<?php echo Form::label('slots['.$i.'][deaths]', 'deaths:'); ?>
			<?php echo Form::input('slots['.$i.'][deaths]', Arr::path($values, 'slots.'.$i.'.deaths', 0)); ?>
			<?php echo Arr::path($errors, 'slots.'.$i.'.deaths'); ?>

			<?php echo Form::label('slots['.$i.'][assists]', 'assists:'); ?>
			<?php echo Form::input('slots['.$i.'][assists]', Arr::path($values, 'slots.'.$i.'.assists', 0)); ?>
			<?php echo Arr::path($errors, 'slots.'.$i.'.assists'); ?>

			<?php echo Form::label('slots['.$i.'][leaver_status]', 'Izašao/la:'); ?>
			<?php echo Form::select('slots['.$i.'][leaver_status]', $leaver_statuses, Arr::path($values, 'slots.'.$i.'.leaver_status')); ?>
			<?php echo Arr::path($errors, 'slots.'.$i.'.leaver_status]'); ?>

			<?php echo Form::label('slots['.$i.'][gold]', 'gold:'); ?>
			<?php echo Form::input('slots['.$i.'][gold]', Arr::path($values, 'slots.'.$i.'.gold', 0)); ?>
			<?php echo Arr::path($errors, 'slots.'.$i.'.gold'); ?>

			<?php echo Form::label('slots['.$i.'][last_hits]', 'last_hits:'); ?>
			<?php echo Form::input('slots['.$i.'][last_hits]', Arr::path($values, 'slots.'.$i.'.last_hits', 0)); ?>
			<?php echo Arr::path($errors, 'slots.'.$i.'.last_hits'); ?>

			<?php echo Form::label('slots['.$i.'][denies]', 'denies:'); ?>
			<?php echo Form::input('slots['.$i.'][denies]', Arr::path($values, 'slots.'.$i.'.denies', 0)); ?>
			<?php echo Arr::path($errors, 'slots.'.$i.'.denies'); ?>

			<?php echo Form::label('slots['.$i.'][gold_per_min]', 'gold_per_min:'); ?>
			<?php echo Form::input('slots['.$i.'][gold_per_min]', Arr::path($values, 'slots.'.$i.'.gold_per_min', 0)); ?>
			<?php echo Arr::path($errors, 'slots.'.$i.'.gold_per_min'); ?>

			<?php echo Form::label('slots['.$i.'][xp_per_min]', 'xp_per_min:'); ?>
			<?php echo Form::input('slots['.$i.'][xp_per_min]', Arr::path($values, 'slots.'.$i.'.xp_per_min', 0)); ?>
			<?php echo Arr::path($errors, 'slots.'.$i.'.xp_per_min'); ?>

			<?php echo Form::label('slots['.$i.'][gold_spent]', 'gold_spent:'); ?>
			<?php echo Form::input('slots['.$i.'][gold_spent]', Arr::path($values, 'slots.'.$i.'.gold_spent', 0)); ?>
			<?php echo Arr::path($errors, 'slots.'.$i.'.gold_spent'); ?>

			<?php echo Form::label('slots['.$i.'][hero_damage]', 'hero_damage:'); ?>
			<?php echo Form::input('slots['.$i.'][hero_damage]', Arr::path($values, 'slots.'.$i.'.hero_damage', 0)); ?>
			<?php echo Arr::path($errors, 'slots.'.$i.'.hero_damage'); ?>

			<?php echo Form::label('slots['.$i.'][tower_damage]', 'tower_damage:'); ?>
			<?php echo Form::input('slots['.$i.'][tower_damage]', Arr::path($values, 'slots.'.$i.'.tower_damage', 0)); ?>
			<?php echo Arr::path($errors, 'slots.'.$i.'.tower_damage'); ?>

			<?php echo Form::label('slots['.$i.'][hero_healing]', 'hero_healing:'); ?>
			<?php echo Form::input('slots['.$i.'][hero_healing]', Arr::path($values, 'slots.'.$i.'.hero_healing', 0)); ?>
			<?php echo Arr::path($errors, 'slots.'.$i.'.hero_healing'); ?>

			<?php echo Form::label('slots['.$i.'][level]', 'Level:'); ?>
			<?php echo Form::select('slots['.$i.'][level]', $levels, Arr::path($values, 'slots.'.$i.'.level')); ?>
			<?php echo Arr::path($errors, 'slots.'.$i.'.level]'); ?>

			<?php echo Form::hidden('slots['.$i.'][player_slot]', $i); ?>
		</div>
	<?php endfor ?>

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