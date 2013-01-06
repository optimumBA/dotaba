<?php if (count($news) > 0): ?>
	<?php foreach ($news as $article): ?>
		<article>
			<header>
				<h2><?php echo $news->title_en; ?></h2>
			</header>
			<time datetime="<?php echo $news->created_at; ?>" pubdate>
				<?php echo Date::formatted_time($news->created_at, $user->date_format, $user->timezone); ?>
			</time>
			<p><?=Text::limit_words(strip_tags($news->content_en), 40);?></p>
		</article>
	<?php endforeach ?>
<?php else: ?>
	Trenutno nema novosti.
<?php endif; ?>

<?php /*echo $pagination;*/ ?>