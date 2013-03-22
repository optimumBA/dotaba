<?php if (User::instance()->logged_in() AND ($topic->is_locked == FALSE OR User::instance()->has_role('Administrator/ica'))): ?>
	<?php echo HTML::anchor('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE).'/postovi/napravi', 'Napravi post'); ?>
<?php endif ?>

<?php if ($topic->is_locked): ?>
	Tema je zaključana.
<?php endif ?>

<?php if (User::instance()->id == $topic->user_id AND $topic->is_locked == FALSE OR User::instance()->has_role('Administrator/ica')): ?>
	<?php echo HTML::anchor('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE).'/izmijeni', 'Izmijeni'); ?>
<?php endif ?>

<?php if (User::instance()->has_role('Administrator/ica')): ?>
	<?php echo HTML::anchor('#', ($topic->is_locked) ? 'Otključaj' : 'Zaključaj', array('class' => 'form_submit', 'data-form' => 'lock')); ?>
	<?php echo Form::open('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE).'/lock', array('class' => 'hidden lock')); ?>
		<?php echo Form::hidden('csrf', Security::token()); ?>
	<?php echo Form::close(); ?>

	<?php echo HTML::anchor('#', ($topic->is_sticky) ? 'Odlijepi s vrha' : 'Zalijepi za vrh', array('class' => 'form_submit', 'data-form' => 'sticky')); ?>
	<?php echo Form::open('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE).'/sticky', array('class' => 'hidden sticky')); ?>
		<?php echo Form::hidden('csrf', Security::token()); ?>
	<?php echo Form::close(); ?>

	<?php echo HTML::anchor('#', 'Obrisi', array('class' => 'form_submit', 'data-form' => 'obrisi')); ?>
	<?php echo Form::open('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE).'/obrisi', array('class' => 'hidden obrisi')); ?>
		<?php echo Form::hidden('csrf', Security::token()); ?>
	<?php echo Form::close(); ?>
<?php endif ?>

<ul>
	<?php foreach ($posts as $post): ?>
		<?php echo Date::formatted_time($post->created_at); ?>
		<?php if ($post->id != $topic->main_post_id AND ($post->user_id == User::instance()->id OR User::instance()->has_role('Administrator/ica'))): ?>
			<?php echo HTML::anchor('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE).'/postovi/'.$post->id.'/izmijeni', 'Izmijeni'); ?>
		<?php endif ?>
		<?php if ($post->id != $topic->main_post_id AND User::instance()->has_role('Administrator/ica')): ?>
			<?php echo HTML::anchor('#', 'Obrisi', array('class' => 'form_submit', 'data-form' => 'obrisi')); ?>
			<?php echo Form::open('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE).'/postovi/'.$post->id.'/obrisi', array('class' => 'hidden obrisi')); ?>
				<?php echo Form::hidden('csrf', Security::token()); ?>
			<?php echo Form::close(); ?>
		<?php endif ?>
		<?php echo HTML::anchor('igraci/'.$post->user->accountid, $post->user->username); ?>
		<?php echo HTML::image(Media_Remote_Avatar::get($post->user->id, $post->user->avatar), array('alt' => $post->user->username)); ?>
		<?php echo HTML::parse_bbcode($post->content); ?>
		<?php if ($post->updated_at): ?>
			Zadnja izmjena: <?php echo Date::formatted_time($post->updated_at); ?>
		<?php endif ?>
	<?php endforeach ?>
</ul>

<?php echo $pagination; ?>