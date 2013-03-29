<div class="latest-videos">
	<h1 class="heading colr">Posljednji snimci</h1>

	<?php foreach ($videos as $video): ?>
		<div class="desc">
			<h4><?php echo HTML::anchor('/vods/snimci/'.$video->id.'-'.URL::title($video->name, '-', TRUE), $video->name, array('class' => 'white')); ?></h4>
			<p><?php echo Text::limit_words(strip_tags(HTML::parse_bbcode($video->description)), 10); ?></p>
		</div>
		<div class="video">
			<iframe height="231" src="http://www.youtube.com/embed/<?php echo $video->vid; ?>" frameborder="0" allowfullscreen></iframe>
		</div>
	<?php endforeach ?>

	<a href="/vods/snimci" class="buttonone">Pogledaj sve snimke</a>
</div>