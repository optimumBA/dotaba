<?php if (count($news) > 0): ?>
	<?php foreach ($news as $article): ?>
		<article>
			<header>
				<h2><?php echo $article->title; ?></h2>
			</header>
			<time datetime="<?php echo $article->created_at; ?>" pubdate>
				<?php echo $article->created_at/*Date::formatted_time($article->created_at, $user->date_format, $user->timezone)*/; ?>
			</time>
			<p><?=Text::limit_words(strip_tags($article->content), 40);?></p>
		</article>
	<?php endforeach ?>
<?php else: ?>
	Trenutno nema novosti.
<?php endif; ?>

<?php /*echo $pagination;*/ ?>