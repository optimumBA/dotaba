<?php if (User::instance()->logged_in()): ?>
	<?php echo HTML::anchor('teme/napravi', 'Napravi temu'); ?>
<?php endif ?>

<?php if (count($topics)): ?>
	<ul>
		<?php foreach ($topics as $topic): ?>
			<?php if ($topic->is_sticky): ?>
				zalijepljena
			<?php endif ?>
			<?php if ($topic->is_locked): ?>
				zaključana
			<?php endif ?>
			<?php echo HTML::anchor('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE), $topic->name); ?>
			<?php if ($last_posts[$topic->id]->loaded()): ?>
				Zadnji post napisao/la <?php echo HTML::anchor('igraci/'.$last_posts[$topic->id]->user->accountid, $last_posts[$topic->id]->user->username); ?>
				<?php echo Date::formatted_time($last_posts[$topic->id]->created_at) ?>
			<?php endif ?>
		<?php endforeach ?>
	</ul>
<?php else: ?>
	Nema tema.
<?php endif ?>

<?php echo $pagination; ?>