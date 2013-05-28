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
                	<div class="matchdetails">
                    	<h1 class="heading colr">Pregled meča</h1>
<center><h1 class="white">Pobjednik je <?php echo ($match->radiant_win) ? '<span class="radiant-team">Radiant</span>' : '<span class="dire-team">Dire</span>'; ?></h1></center>

<?php foreach (array('radiant', 'dire') as $team): ?>
	<?php echo ucfirst($team); ?>
	                                    <div class="matchlist">

    <table>
		<tr>
			<td width="20px">Avatar</td>
           	<td width="150px">Igrač</td>
			<td width="200px">Heroj</td>
			<td>Level</td>
			<td>K</td>
            <td>D</td>
            <td>A</td>
			<td>Gold</td>
			<td>LH</td>
			<td>DN</td>
			<td>XPM</td>
			<td>GPM</td>
			<td width="250px">Inventory</td>
		</tr>
		<?php for ($i = (int) ($team == 'dire') * 5; $i < ((int) ($team == 'dire') + 1) * 5; $i++): ?>
			<tr>
				<?php if (isset($slots[$i])): ?>
					<td width="20px"><?php echo HTML::image(Media_Remote_Avatar::get($slots[$i]->user->id, $slots[$i]->user->avatar), array('alt' => $slots[$i]->user->username, 'width' => 24, 'class' => 'steam-avatar status-s-'.$slots[$i]->user->status)); ?></td>
                    
                    
                    <td width="150px">
						
						<h6><?php echo HTML::anchor('igraci/'.$slots[$i]->user->accountid, '<span class="'.$team.'-team">'.$slots[$i]->user->username.'</span>'); ?></h6>
					</td>
					
                    
                    <td width="200px">
						<h6 class="colr"><?php echo HTML::image(Media_Remote_Hero::get($slots[$i]->hero->id, $slots[$i]->hero->image), array('alt' => $slots[$i]->hero->localized_name, 'class' => 'frame-item', 'height' => 24)); ?>
						<?php echo $slots[$i]->hero->localized_name; ?></h6>
					</td>
					
                    
                    <td><h6 class="white"><?php echo $slots[$i]->level; ?></h6></td>
					
                    
                    
					<td><h6 class="kills"><?php echo $slots[$i]->kills; ?></h6></h6></td>
                    <td><h6 class="deaths"><?php echo $slots[$i]->deaths; ?></h6></td>
                    <td><h6 class="assists"><?php echo $slots[$i]->assists; ?></h6></td>
					
					<td><h6 class="gold"><?php echo $slots[$i]->gold; ?></h6></td>
					<td><h6 class="white"><?php echo $slots[$i]->last_hits; ?></h6></td>
					<td><h6 class="white"><?php echo $slots[$i]->denies; ?></h6></td>
					<td><h6 class="colr"><?php echo $slots[$i]->xp_per_min; ?></h6></td>
					<td><h6 class="gold"><?php echo $slots[$i]->gold_per_min; ?></h6></td>
					<td>
						<?php for ($j = 0; $j < 6; $j++): ?>
							<?php if ($slots[$i]->{'item_'.$j.'_id'}): ?>
								<?php echo HTML::image(Media_Remote_Item::get($slots[$i]->{'item_'.$j}->id, $slots[$i]->{'item_'.$j}->image), array('alt' => $slots[$i]->{'item_'.$j}->localized_name, 'class' => 'frame-item', 'height' => 24, 'title' => $slots[$i]->{'item_'.$j}->localized_name)); ?>
							<?php else: ?>
								
                                
							<?php endif ?>
						<?php endfor ?>
					</td>
				<?php else: ?>
					<td><img src="/media/avatars/default_full.jpg" width="24px" class="status-s-0" /></td>
                    <td><a href="/pravila"><h6 class="<?php echo $team;?>-team">Anoniman igrač</h6></a></td>
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