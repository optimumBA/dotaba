<!-- Header End -->
    <div class="clear"></div>
  
<!-- Content Section Start -->
    <div id="content-sec">
    	<div class="inner">
        	<!-- Columns Section Start -->
            <div class="columns-sec twocol">
            	<!-- Column Three Start -->
                <div class="col3">
                	<div class="blog">
                    	<h1 class="heading colr">Pregled meča</h1>
                        
                         <div class="matchlist">

  
    <table>
	
    <tr>
		<td>Radiant</td>
        <td>Dire</td>
     </tr>
        
        <tr>
        <td><h2><?php echo HTML::anchor('liga/klanovi/'.$match->radiant_clan->id.'-'.URL::title($match->radiant_clan->name, '-', TRUE), '<span class="radiant-team">'.$match->radiant_clan->name.'</span>'); ?> </h2></td>
        <td><h2>
<?php echo HTML::anchor('liga/klanovi/'.$match->dire_clan->id.'-'.URL::title($match->dire_clan->name, '-', TRUE), '<span class="dire-team">'.$match->dire_clan->name.'</span>'); ?></h2></td>
        </tr>
        
        </table>
        
  
<ul>
	<?php foreach ($streams as $stream): ?>
		<li>
			<?php echo HTML::anchor('igraci/'.$stream->user->accountid.'/stream', $stream->user->username.'ov/in stream'); ?>
			<?php if ($stream->user_id == User::instance()->id): ?>
				<?php echo HTML::anchor('#', 'Otkaži stremanje', array('class' => 'form_submit', 'data-form' => 'otkazi_streamanje')); ?>
				<?php echo Form::open('liga/mecevi/'.$match->id.'/otkazi_streamanje', array('class' => 'hidden otkazi_streamanje')); ?>
					<?php echo Form::hidden('csrf', Security::token()); ?>
				<?php echo Form::close(); ?>
			<?php endif ?>
		</li>
	<?php endforeach ?>
</ul>

<?php if ($can_stream): ?>
	<?php echo HTML::anchor('#', 'Najavi stremanje', array('class' => 'form_submit', 'data-form' => 'najavi_streamanje')); ?>
	<?php echo Form::open('liga/mecevi/'.$match->id.'/najavi_streamanje', array('class' => 'hidden najavi_streamanje')); ?>
		<?php echo Form::hidden('csrf', Security::token()); ?>
	<?php echo Form::close(); ?>
<?php endif ?>





                    </div>
                </div>
                
                <br />
                <div class="clear"></div>
                
<?php echo View::factory('comments', array('comments' => $comments, 'object_id' => $match->id, 'object_type' => 'Match')); ?>
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