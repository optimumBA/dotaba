<h1><?php echo $article->title; ?></h1>

<p>
	<?php echo $article->content; ?>
</p>

<p>
	<em><?php echo HTML::anchor($article->url, $article->source); ?></em>, <?php echo Date::formatted_time($article->created_at); ?>
</p>