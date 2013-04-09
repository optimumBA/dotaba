<!-- Banner Start -->
    <div id="sub-banner">
    	<div class="in">
        	<a href="#"><img src="/assets/images/banner-profile.jpg" alt="Dota 2 Balkan Igrači" /></a>
        </div>
    </div>
    <!-- Banner End -->
    <!-- Album Shades Start -->
    <div id="album-shelves">
    	<h1 class="heading colr">Pregled igrača</h1>
    	<div class="inner">
        	<!-- Columns Section Start -->
            <ul class="album-list">



<?php if (count($users) > 0): ?>

	<?php foreach ($users as $user):?>
        
    
            	<li>
                	
                    <?php echo HTML::anchor('igraci/'.$user->accountid.'', 
											HTML::image(
											Media_Remote_Avatar::get($user->id, $user->avatar), array('alt' => $user->username, 'class' => 'status-'.$user->status)
											),
											array('class' => 'thumb')							);?>
                    
                    
                    <h3><?php echo HTML::anchor('igraci/'.$user->accountid.'', $user->username, array('class' => 'colr'));?></h3>
                    <p>
                   	Registrovan: <?=$user->created_at;?><br />
                    Pobjede / Porazi / Napuštanja: <span class="stats-wins"><?=$user->wins;?></span> / <span class="stats-losses"><?=$user->losses;?></span> / <span class="stats-abandons"><?=$user->abandons;?></span><br />
                    Lokacija: <?=$user->location;?>
                    </p>
                    <?php echo HTML::anchor('igraci/'.$user->accountid.'', 'Pogledaj profil', array('class' => 'bigbutton'));?>
                   
                </li>
             
           
			
    <?php endforeach; ?>

 </ul>
            


<?php else: ?>
<div class="alert alert-info">Nema registrovanih igrača.</div>
<?php endif;?>
			
            
<?php echo $pagination;?><div class="clear"></div>
            <!-- Columns Section End -->
        </div>
    </div>
    <!-- Album Shades End -->
    <div class="clear"></div>