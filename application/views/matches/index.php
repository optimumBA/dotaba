<div class="clear"></div>
    <!-- Banner Start -->
 <div id="sub-banner">
    	<div class="in">
        	<a href="#"><img src="/assets/images/banner-profile.jpg" alt="Dota 2 Forum" /></a>
        </div>
    </div>
    <!-- Banner End -->
    <!-- Content Section Start -->
    <div id="content-sec">
    	<div class="inner">
        	<!-- Columns Section Start -->
            <div class="columns-sec twocol">
            	<!-- Column tdree Start -->
                <div class="col3">
                	<div class="gigs">
                    	<h1 class="heading colr">Pregled mečeva</h1>
 <div class="matchlist">
<table>
	<tr>
		<td>ID</td>
		<td>Tip</td>
		<td>Mod</td>
		<td>Turnir</td>
		<td>Radiant</td>
		<td>Dire</td>
		<td>Vrijeme odigravanja</td>
	</tr>
	<?php foreach ($matches as $match): ?>
		<tr>
			<td><h6><?php echo HTML::anchor('liga/mecevi/'.$match->id, $match->id); ?></h6></td>
			<td><h6 class="colr"><?php echo $match->type->name; ?></h6></td>
			<td><h6 class="colr"><?php echo $match->mode->name; ?></h6></td>
			<td><h6 class="white"><?php echo ($match->tournament_id) ? HTML::anchor('liga/turniri/'.$match->tournament->id.'-'.URL::title($match->tournament->name, '-', TRUE), $match->tournament->name) : NULL; ?></h6></td>
			<td><h6><?php echo ($match->radiant_clan_id) ? HTML::anchor('liga/klanovi/'.$match->radiant_clan->id.'-'.URL::title($match->radiant_clan->name, '-', TRUE), '<span class="radiant-team">'.$match->radiant_clan->name.'</span>') : NULL; ?></h6></td>
			<td><h6><?php echo ($match->dire_clan_id) ? HTML::anchor('liga/klanovi/'.$match->dire_clan->id.'-'.URL::title($match->dire_clan->name, '-', TRUE), '<span class="dire-team">'.$match->dire_clan->name.'</span>') : NULL; ?></h6></td>
			<td><h6 class="white"><?php echo Date::formatted_time($match->date); ?></h6></td>
		</tr>
	<?php endforeach ?>
</table>
</div>

</div>
                </div>
                <!-- Column One End -->
                <!-- Column One Start -->
                <div class="col1 hidemobile">

                   
                </div>
                <!-- Column One End -->
            </div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Content Section End -->
    <div class="clear"></div>