<div class="onlinekorisnici">
     <ul>
			<li><h2 class="colr">Online korisnici:</h2> <h6 class="white">Ukupno <?php echo count($users);?> korisnika online</h6></li>
					<li>
						<?php foreach ($users as $user): ?>

						<a href="/igraci/<?=$user->accountid;?>" class="status-<?=$user->status;?>"><?=$user->username;?></a>,
				
					
						<?php endforeach ?>
                    </li>
                    
            <li><h4 class="colr">Legenda:</h4> <span class="status-2">In-Game</span>, <span class="status-1">Online</span></li>
	</ul>
</div>




