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
        
  
<?php if ($match->stream->loaded()): ?>
    <?php echo HTML::anchor('igraci/'.$match->stream->user->accountid.'/stream', HTML::image(Media_Remote_Avatar::get($match->stream->user->id, $match->stream->user->avatar), array('alt' => $match->stream->user->username.'ov/in stream', 'width' => '104px'), array('class' => 'thumb'))); ?>
    <div class="txt-sec">
        <h3><?php echo HTML::anchor('igraci/'.$match->stream->user->accountid.'/stream', $match->stream->user->username.' stream'); ?></h3>
        <p class="viewers">Gledalaca <?php echo $match->stream->viewers;?></p>
        <p class="location"><?php echo ($match->stream->online) ? '<a class="online">Online</a>' : '<a class="offline">Offline</a>'?></p>
        <div class="clear"></div>
        <?php echo HTML::anchor('igraci/'.$match->stream->user->accountid.'/stream', 'Pogledaj', array('class' => 'readmore')); ?>
    </div>
    <?php if ($match->stream->user_id == User::instance()->id): ?>
        <?php echo HTML::anchor('#', 'Otkaži streamanje', array('class' => 'form_submit button', 'data-form' => 'otkazi_streamanje')); ?>
        <?php echo Form::open('liga/mecevi/'.$match->id.'/otkazi_streamanje', array('class' => 'hidden otkazi_streamanje')); ?>
            <?php echo Form::hidden('csrf', Security::token()); ?>
        <?php echo Form::close(); ?>
    <?php endif ?>
<?php elseif (User::instance()->logged_in() AND User::instance()->stream->loaded()): ?>
    <?php echo HTML::anchor('#', 'Najavi streamanje', array('class' => 'form_submit button', 'data-form' => 'najavi_streamanje')); ?>
    <?php echo Form::open('liga/mecevi/'.$match->id.'/najavi_streamanje', array('class' => 'hidden najavi_streamanje')); ?>
        <?php echo Form::hidden('csrf', Security::token()); ?>
    <?php echo Form::close(); ?>
<?php endif ?>

<?php if (User::instance()->has_role('Organizator/ica turnira')): ?>
	<?php echo HTML::anchor('liga/mecevi/'.$match->id.'/izmijeni', 'Unesi rezultate meča'); ?>

	<?php echo Form::open('liga/mecevi/'.$match->id.'/izmijeni_vrijeme'); ?>
		<?php echo Form::label('date', 'Vrijeme odigravanja (formata YYYY-mm-dd HH:mm:ss, primjer: 2013-05-15 03:20:00):'); ?>
		<?php echo Form::input('date', $match->date); ?>

		<?php echo Form::hidden('csrf', Security::token()); ?>
		<?php echo Form::submit(NULL, 'Izmijeni vrijeme odigravanja'); ?>
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