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
                    	<h1 class="heading colr">Organiziraj turnir</h1>
<?php echo Form::open(NULL, array('enctype' => 'multipart/form-data')); ?>
	<?php echo Form::label('name', 'Naziv:'); ?>
	<?php echo Form::input('name', Arr::path($values, 'name')); ?>
	<?php echo Arr::path($errors, 'name'); ?>

	<?php echo Form::label('description', 'Opis:'); ?>
	<?php echo Form::textarea('description', Arr::path($values, 'description')); ?>
	<?php echo Arr::path($errors, 'description'); ?>

	<div class="alert alert-info">Tipovi turnira daju vrijednost turniru. Što je veći tip, turnir je vrijedniji (nagrade i sl.).<br />
    Dozvoljeni tipovi: <font color="#B0C3D9">Common</font>, <font color="#5e98d9">Uncommon</font>, <font color="#4b69ff">Rare</font>, <font color="#8847ff">Mythical</font>, <font color="#D32CC5">Legendary</font>, <font color="#EB4437">Ancient</font>, <font color="#e4ae39">Immortal</font>.</div>
	<?php echo Form::label('rarity', 'Tip turnira:'); ?>
	<?php echo Form::select('rarity', $colors, Arr::path($values, 'name')); ?>
	<?php echo Arr::path($errors, 'rarity'); ?>
	
	<?php echo Form::label('default', 'Slika:'); ?>
	<?php echo Form::file('default'); ?>
	<?php echo Arr::path($errors, 'default'); ?>

	<?php echo Form::label('mode_id', 'Môd:'); ?>
	<?php echo Form::select('mode_id', $modes, Arr::path($values, 'mode_id')); ?>
	<?php echo Arr::path($errors, 'mode_id'); ?>

	<?php echo Form::label('num_clans', 'Broj klanova:'); ?>
	<?php echo Form::select('num_clans', array_combine(range(8, 32), range(8, 32)), Arr::path($values, 'num_clans')); ?>
	<?php echo Arr::path($errors, 'num_clans'); ?>

	<?php echo Form::label('is_auto_approvable', 'Automatsko odobravanje prijava:'); ?>
	<?php echo Form::checkbox('is_auto_approvable', 1, (bool) Arr::path($values, 'is_auto_approvable', 1)); ?>
	<?php echo Arr::path($errors, 'is_auto_approvable'); ?>

	<?php echo Form::hidden('csrf', Security::token()); ?>
	<?php echo Form::submit(NULL, 'Organiziraj'); ?>
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