<div class="paging">
	<ul>
		<?php if ($first_page !== FALSE): ?>
			<li><a href="<?php echo HTML::chars($page->url($first_page)); ?>">Prva</a></li>
		<?php elseif ($first_page == TRUE): ?>
			<li><a href="#prva">Prva</a></li>
		<?php endif ?>

		<?php if ($previous_page !== FALSE): ?>
			<li><a href="<?php echo HTML::chars($page->url($previous_page)); ?>" rel="prev">Prethodna</a></li>
		<?php elseif ($previous_page == TRUE): ?>
			<li><a href="#prethodna">Prethodna</a></li>
		<?php endif ?>

		<?php for ($i = 1; $i <= $total_pages; $i++): ?>
			<?php if ($i == $current_page): ?>
				<li><a href="#" class="active"><?php echo $i; ?></a></li>
			<?php else: ?>
				<li><a href="<?php echo HTML::chars($page->url($i)); ?>"><?php echo $i; ?></a></li>
			<?php endif ?>
		<?php endfor ?>

		<?php if ($next_page !== FALSE): ?>
			<li><a href="<?php echo HTML::chars($page->url($next_page)); ?>" rel="next">Sljedeća</a></li>
		<?php elseif($next_page == TRUE): ?>
			<li><a href="#sljedeca">Sljedeća</a></li>
		<?php endif ?>

		<?php if ($last_page !== FALSE): ?>
			<li><a href="<?php echo HTML::chars($page->url($last_page)); ?>">Zadnja</a></li>
		<?php elseif ($last_page == TRUE): ?>
			<li><a href="#zadnja">Zadnja</a></li>
		<?php endif ?>
	</ul>
</div><!-- .pagination -->