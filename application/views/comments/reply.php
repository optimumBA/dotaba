<li class="leveltwo" data-parent="<?php echo $comment->id; ?>">
	<?php echo Form::open('komentari/dodaj', array('class' => 'hidden')); ?>
		<ul>
			<li>
				<?php echo Form::textarea('body', '', array('placeholder' => 'Odgovori')); ?>
				<div class="error"></div>
			</li>
			<li>
				<?php echo Form::hidden('object_id', $comment->object_id); ?>
				<?php echo Form::hidden('object_type', $comment->object_type); ?>
				<?php echo Form::hidden('parent_id', $comment->id); ?>
				<?php echo Form::hidden('csrf', Security::token()); ?>
				<?php echo Form::submit(NULL, 'Pošalji'); ?>
				<?php echo HTML::image('assets/images/ajax-loader.gif', array('alt' => 'AJAX loader', 'class' => 'hidden ajax-loader')); ?>
			</li>
		</ul>
	<?php echo Form::close(); ?>
</li>