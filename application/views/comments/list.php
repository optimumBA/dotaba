<?php foreach ($comments['parents'] as $parent): ?>
	<?php echo View::factory('comments/single', array('comment' => $parent)); ?>

	<?php if (isset($comments['children'][$parent->id])): ?>
		<?php foreach ($comments['children'][$parent->id] as $child): ?>
			<?php echo View::factory('comments/single', array('comment' => $child)); ?>
		<?php endforeach ?>
	<?php endif ?>

	<?php echo View::factory('comments/reply', array('comment' => $parent)); ?>
<?php endforeach ?>

<?php if ($comments['more']): ?>
	<li class="more-comments center">
		<a href="#" class="button" data-type="<?php echo $object_type; ?>" data-id="<?php echo $object_id; ?>" data-last-id="<?php echo $comments['last_id']; ?>">
			<?php echo HTML::image('assets/images/ajax-loader.gif', array('alt' => 'AJAX loader', 'class' => 'hidden ajax-loader')); ?>
			<span>Klikni za učitavanje još komentara</span>
		</a>
	</li>
<?php endif ?>