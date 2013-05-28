<div class="widget">
	<h1 class="heading colr">Najnoviji korisnici</h1>
	<ul class="teamlist">
		<?php foreach ($users as $user): ?>
			<li>
				<div class="avatar">
					<?php echo HTML::anchor('igraci/'.$user->accountid, HTML::image(Media_Remote_Avatar::get($user->id, $user->avatar), array('alt' => $user->username, 'width' => 30, 'height' => 30, 'class' => 'status-s-'.$user->status)), array('class' => 'thumb')); ?>
				</div>
				<div class="desc">
					<h6><?php echo HTML::anchor('igraci/'.$user->accountid, $user->username, array('class' => 'white')); ?></h6>
					
					
				</div>
			</li>
		<?php endforeach ?>
	</ul>
</div>
<h4 class="white">Ukupno korisnika: <?php echo count($total);?></h6>





