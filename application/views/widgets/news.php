<div class="latest-news noback">
	<h1 class="heading colr">Posljednje novosti</h1>

	<ul class="news-list">
		<?php foreach ($news as $article): ?>
			<li>
				<div class="thumb">
					<a href="/novosti/<?php echo $article->id.'-'.URL::title($article->title, '-', TRUE); ?>">
						<?php echo HTML::image(Media_Local_News::get($article->id), array('alt' => $article->title)); ?>
						<span>Pogledaj</span>
					</a>
				</div>
				<div class="desc">
					<h4><?php echo HTML::anchor('/novosti/'.$article->id.'-'.URL::title($article->title, '-', TRUE)); ?></h4>
					<p class="post-opts"><?php echo Date::formatted_time($article->created_at); ?></p>
					<p class="txt"><?php echo Text::limit_words(strip_tags(HTML::parse_bbcode($article->content)), 40); ?></p>
				</div>
			</li>
		<?php endforeach ?>
	</ul>

	<a href="/novosti" class="buttonone">Pogledaj sve novosti</a>
</div>