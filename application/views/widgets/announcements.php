<div class="widget upcoming-eve">
	<h1 class="heading colr">Nadolazeći mečevi</h1>
	<?php if (count($announcements) > 0): ?>
		<div class="current-eve">
			<h5><a href="#" class="colr">
				<?php echo $announcements[0]->match->radiant_clan->name; ?> vs <?php echo $announcements[0]->match->dire_clan->name; ?>
			</a></h5>
			<div id="countdown-match" data-date="<?php echo Date::formatted_time($announcements[0]->match->date, 'D, d M y H:i:s').' +0100'; ?>"></div>
		</div>
		<ul>
			<?php for ($i = 1; $i < count($announcements); $i++): ?>
				<li>
					<div class="date">
						<span><?php echo strtoupper(Date::formatted_time($announcements[$i]->match->date, 'M')); ?></span>
						<h1><?php echo Date::formatted_time($announcements[$i]->match->date, 'j'); ?></h1>
					</div>
					<div class="desc">
						<div class="left">
							<h4>
								<?php echo HTML::anchor('liga/mecevi/'.$announcements[$i]->match->id, $announcements[$i]->match->radiant_clan->name.' vs '.$announcements[$i]->match->dire_clan->name); ?>
							</h4>
							<p><?php echo HTML::anchor($announcements[$i]->match->tournament->id.'-'.URL::title($announcements[$i]->match->tournament->name, '-', TRUE), $announcements[$i]->match->tournament->name); ?></p>
						</div>
						<?php echo HTML::anchor('igraci/'.$announcements[$i]->stream->user->accountid.'/stream', 'GLEDAJ', array('class' => 'buttonone right')); ?>
					</div>
				</li>
			<?php endfor ?>
		</ul>
	<?php else: ?>
		Trenutno nema najavljenih mečeva.
	<?php endif ?>
	<a href="/vods/streamovi" class="viewfullcal">POGLEDAJ SVE</a>
</div>