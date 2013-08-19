<div class="onlinekorisnici">
     <ul>
			<li><h2 class="colr">Online korisnici:</h2> <h6 class="white">Ukupno <?php echo count($users);?> korisnika online</h6></li>
					<li>
						<?php foreach ($users as $user): ?>

						
                        <?php if($user->id == 1 OR $user->id == 2 OR $user->id == 3):?>
                        
                       <img src="/assets/images/d2ba.png" width="24px" height="auto" title="Dota 2 Balkan Staff" /> <a href="/igraci/<?=$user->accountid;?>"><font color="#EB4B47"><?=$user->username;?></font></a>,
                        
                        <?php elseif($user->id == 14):?>
                        
                        
                       <img src="/assets/images/d2ba.png" width="24px" height="auto" title="Dota 2 Balkan Staff" /> <a href="/igraci/<?=$user->accountid;?>"><font color="#D32DC4"><?=$user->username;?></font></a>,
                        
                         <?php elseif($user->id == 42):?>
                        
                        
                       <img src="/assets/images/d2ba.png" width="24px" height="auto" title="Dota 2 Balkan Staff" /> <a href="/igraci/<?=$user->accountid;?>"><font color="#8847EC"><?=$user->username;?></font></a>,
                        
                        <?php elseif($user->accountid == 40290023):?>
                        
                        
                       <img src="/assets/images/d2feed.png" width="48px" height="auto" title="Dota2Feed Staff" /> <a href="/igraci/<?=$user->accountid;?>"><font color="orange"><?=$user->username;?></font></a>,
                        
                        

						<?php else:?>
					
                     	<a href="/igraci/<?=$user->accountid;?>"><?=$user->username;?></a>,
                        <?php endif;?>
						
						<?php endforeach ?>
                    </li>
                    
            <li><h4 class="colr">Legenda:</h4> <font color="#EB4B47">Administrator/ica</font>, <font color="#8847EC">Organizator/ica turnira</font>, <font color="#D32DC4">Novinar/ka</font>, <font color="orange">Dota 2 Feed Staff</font>,</li>
	</ul>
</div>




