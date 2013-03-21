<?php echo HTML::image(Media_Local_Clan::get($match->radiant_clan->id)); ?>
<?php echo HTML::image(Media_Local_Clan::get($match->dire_clan->id)); ?>
<?php echo HTML::anchor('liga/klanovi/'.$match->radiant_clan->id.'-'.URL::title($match->radiant_clan->name, '-', TRUE)); ?> 
protiv 
<?php echo HTML::anchor('liga/klanovi/'.$match->dire_clan->id.'-'.URL::title($match->dire_clan->name, '-', TRUE)); ?>

Streamovi:
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

<?php echo View::factory('comments', array('comments' => $comments, 'object_id' => $match->id, 'object_type' => 'Match')); ?>