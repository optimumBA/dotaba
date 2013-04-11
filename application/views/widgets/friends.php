<div class="widget">
	<h1 class="heading colr">Lista prijatelja</h1>
	<ul class="teamlist">
		<?php foreach ($users as $user): ?>
			<li>
				<div class="avatar">
					<?php echo HTML::anchor('igraci/'.$user->accountid, HTML::image(Media_Remote_Avatar::get($user->id, $user->avatar), array('alt' => $user->username, 'width' => 60, 'height' => 60, 'class' => 'status-'.$user->status)), array('class' => 'thumb')); ?>
				</div>
				<div class="desc">
					<h4><?php echo HTML::anchor('igraci/'.$user->accountid, $user->username, array('class' => 'white')); ?></h4>
					<p>Registrovan/a: <?php echo Date::formatted_time($user->created_at); ?></p>
					<p class="txt">Win rate: <span class="stats-precent"><?php echo ($user->wins || $user->losses || $user->abandons) ? $user->wins / ($user->wins + $user->losses + $user->abandons) * 100 : 0; ?>%</span></p>
				</div>
			</li>
		<?php endforeach ?>
	</ul>
</div>