<h1><?php echo $article->title; ?></h1>

<p>
	<?php echo $article->content; ?>
</p>

<p>
	<em><?php echo HTML::anchor($article->url, $article->source); ?></em>, <?php echo date(Kohana::$config->load('site')->get('date_format'), strtotime($article->created_at)); ?>
</p>