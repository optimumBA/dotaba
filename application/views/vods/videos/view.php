<?php echo $video->name; ?>
<iframe src="http://www.youtube.com/embed/<?php echo $video->vid; ?>?origin=<?php echo URL::base(); ?>" frameborder="0"/>
<?php echo HTML::anchor('igraci/'.$video->user->accountid, $video->user->username); ?>
<?php echo $video->description; ?>