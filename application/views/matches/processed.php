 <div class="clear"></div>
    <!-- Banner Start -->
   
    <!-- Banner End -->
<!-- Content Section Start -->
    <div id="content-sec">
    	<div class="inner">
        	<!-- Columns Section Start -->
            <div class="columns-sec twocol">
            	<!-- Column Three Start -->
                <div class="col3">
                	<div class="blog">
                    	<h1 class="heading colr">Pregled meča</h1>
<center><h1 class="white">Pobjednik je <?php echo ($match->radiant_win) ? '<span class="radiant-team">Radiant</span>' : '<span class="dire-team">Dire</span>'; ?></h1></center>

<?php foreach (array('radiant', 'dire') as $team): ?>
	<?php echo ucfirst($team); ?>
	                                    <div class="matchlist">

    <table>
		<tr>
			<td>Igrač</td>
			<td>Hero</td>
			<td>Level</td>
			<td>K/D/A</td>
			<td>Gold</td>
			<td>Last Hits</td>
			<td>Denies</td>
			<td>XPM</td>
			<td>GPM</td>
			<td>Hero damage</td>
			<td>Tower damage</td>
			<td>Hero healing</td>
			<td>Inventory</td>
		</tr>
		<?php for ($i = (int) ($team == 'dire') * 5; $i < ((int) ($team == 'dire') + 1) * 5; $i++): ?>
			<tr>
				<?php if (isset($slots[$i])): ?>
					<td>
						<?php echo HTML::image(Media_Remote_Avatar::get($slots[$i]->user->id, $slots[$i]->user->avatar), array('alt' => $slots[$i]->user->username, 'width' => 32, 'class' => 'steam-avatar status-s-'.$slots[$i]->user->status)); ?>
						<?php echo HTML::anchor('igraci/'.$slots[$i]->user->accountid, $slots[$i]->user->username); ?>
					</td>
					<td>
						<?php echo HTML::image(Media_Remote_Hero::get($slots[$i]->hero->id, $slots[$i]->hero->image), array('alt' => $slots[$i]->hero->localized_name, 'class' => 'frame', 'width' => 64)); ?>
						<?php echo $slots[$i]->hero->localized_name; ?>
					</td>
					<td><?php echo $slots[$i]->level; ?></td>
					<td><span class="kills"><?php echo $slots[$i]->kills; ?></span> / <span class="deaths"><?php echo $slots[$i]->deaths; ?></span> / <span class="assists"><?php echo $slots[$i]->assists; ?></span></td>
					
					
					<td><?php echo $slots[$i]->gold; ?></td>
					<td><?php echo $slots[$i]->last_hits; ?></td>
					<td><?php echo $slots[$i]->denies; ?></td>
					<td><?php echo $slots[$i]->xp_per_min; ?></td>
					<td><?php echo $slots[$i]->gold_per_min; ?></td>
					<td><?php echo $slots[$i]->hero_damage; ?></td>
					<td><?php echo $slots[$i]->tower_damage; ?></td>
					<td><?php echo $slots[$i]->hero_healing; ?></td>
					<td>
						<?php for ($j = 0; $j < 6; $j++): ?>
							<?php if ($slots[$i]->{'item_'.$j.'_id'}): ?>
								<?php echo HTML::image(Media_Remote_Item::get($slots[$i]->{'item_'.$j}->id, $slots[$i]->{'item_'.$j}->image), array('alt' => $slots[$i]->{'item_'.$j}->localized_name, 'class' => 'frame', 'width' => 24, 'title' => $slots[$i]->{'item_'.$j}->localized_name)); ?>
							<?php else: ?>
								Prazan slot
							<?php endif ?>
						<?php endfor ?>
					</td>
				<?php else: ?>
					<td>Anoniman igrač</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>

				<?php endif ?>
			</tr>
		<?php endfor ?>
	</table>
    </div>
<?php endforeach ?>

<?php if (count($picksbans) > 0): ?>
	<ul>
		<?php foreach ($picksbans as $pickban): ?>
			<li>
				<?php echo ($pickban->is_pick) ? 'pick' : 'ban'; ?>
				<?php echo ($pickban->team == 0) ? 'Radiant' : 'Dire'; ?>
				<?php echo HTML::image(Media_Remote_Hero::get($pickban->hero->id, $pickban->hero->image), array('alt' => $pickban->hero->localized_name)); ?>
			</li>
		<?php endforeach ?>
	</ul>
<?php endif ?>
<div class="clear"></div>

</div>
 <div class="clear"></div>            <?php echo View::factory('comments', array('comments' => $comments, 'object_id' => $match->id, 'object_type' => 'Match')); ?>   </div>
            
                
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