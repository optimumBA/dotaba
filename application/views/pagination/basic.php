<div class="paging">
		<ul>

	<?php if ($first_page !== FALSE): ?>
    	<li><a href="<?php echo HTML::chars($page->url($first_page)) ?>"><?php echo __('Prva') ?></a></li>
    <?php else: ?>
    	<li><a href="#"><?php echo __('Prva') ?></a></li>
    <?php endif ?>

	<?php if ($previous_page !== FALSE): ?>
		<li><a href="<?php echo HTML::chars($page->url($previous_page)) ?>" rel="prev"><?php echo __('Prethodna') ?></a></li>
	<?php else: ?>
		<li><a href="#"><?php echo __('Prethodna') ?></a></li>
	<?php endif ?>

	<?php for ($i = 1; $i <= $total_pages; $i++): ?>

		<?php if ($i == $current_page): ?>
			<li><a href="#" class="active"><?php echo $i ?></a></li>
		<?php else: ?>
			<li><a href="<?php echo HTML::chars($page->url($i)) ?>"><?php echo $i ?></a></li>
		<?php endif ?>

	<?php endfor ?>

	<?php if ($next_page !== FALSE): ?>
		<li><a href="<?php echo HTML::chars($page->url($next_page)) ?>" rel="next"><?php echo __('Sljedeća') ?></a></li>
	<?php else: ?>
		<li><a href="#"><?php echo __('Sljedeća') ?></a></li>
	<?php endif ?>
    
    	<?php if ($last_page !== FALSE): ?>
    	<li><a href="<?php echo HTML::chars($page->url($last_page)) ?>"><?php echo __('Zadnja') ?></a></li>
    <?php else: ?>
    	<li><a href="#"><?php echo __('Zadnja') ?></a></li>
    <?php endif ?>
    
    
		</ul>
</div>
<!-- .pagination -->