<div class="widget upcoming-eve">
	<h1 class="heading colr">Nadolazeći mečevi</h1>
	<?php if (count($matches) > 0): ?>
		<div class="current-eve">
			<h5><?php echo HTML::anchor('liga/mecevi/'.$matches[0]->id ,'<span class="radiant-team">'.$matches[0]->radiant_clan->name.'</span> vs <span class="dire-team">'.$matches[0]->dire_clan->name.'</span>', array('class' => 'colr')); ?></h5>
			<div id="countdown-match" data-date="<?php echo strtotime($matches[0]->date)*1000; ?>"></div>
		</div>
		<ul>
			<?php for ($i = 1; $i < count($matches); $i++): ?>
				<li>
					<div class="date">
						<span><?php echo strtoupper(Date::formatted_time($matches[$i]->date, 'M')); ?></span>
						<h1><?php echo Date::formatted_time($matches[$i]->date, 'j'); ?></h1>
					</div>
					<div class="desc">
						<div class="left">
							<h6>
								<?php echo HTML::anchor('liga/mecevi/'.$matches[$i]->id, '<span class="radiant-team">'.$matches[$i]->radiant_clan->name.'</span> vs <span class="dire-team">'.$matches[$i]->dire_clan->name.'</span>'); ?>
							</h6>
							<p><h6 class="colr"><?php echo HTML::anchor($matches[$i]->tournament->id.'-'.URL::title($matches[$i]->tournament->name, '-', TRUE), $matches[$i]->tournament->name); ?></h6></p>
						</div>
					</div>
				</li>
			<?php endfor ?>
		</ul>
	<?php else: ?>
		Trenutno nema najavljenih mečeva.
	<?php endif ?>
	<a href="/liga/mecevi" class="viewfullcal">POGLEDAJ SVE</a>
</div>