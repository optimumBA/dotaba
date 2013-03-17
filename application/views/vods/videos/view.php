<?php echo $video->name; ?>
<iframe src="http://www.youtube.com/embed/<?php echo $video->vid; ?>?origin=<?php echo URL::base(); ?>" frameborder="0"/>
<?php echo HTML::anchor('igraci/'.$video->user->accountid, $video->user->username); ?>
<?php echo HTML::parse_bbcode($video->description); ?>

<?php echo View::factory('comments', array('comments' => $comments, 'object_id' => $video->id, 'object_type' => 'Video')); ?>