<?php echo $stream->user->username.'ov/in stream'; ?>
<object type="application/x-shockwave-flash" height="378" width="620" id="live_embed_player_flash" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel=<?php echo $stream->channel; ?>" bgcolor="#000000">
	<param name="allowFullScreen" value="true" />
	<param name="allowScriptAccess" value="always" />
	<param name="allowNetworking" value="all" />
	<param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" />
	<param name="flashvars" value="hostname=www.twitch.tv&channel=<?php echo $stream->channel; ?>&auto_play=true&start_volume=25" />
</object>

<iframe frameborder="0" scrolling="no" id="chat_embed" src="http://twitch.tv/chat/embed?channel=<?php echo $stream->channel; ?>&popout_chat=true" height="500" width="350"></iframe>

<?php echo HTML::anchor('igraci/'.$stream->user->accountid, $stream->user->username); ?>
<?php echo HTML::parse_bbcode($stream->description); ?>

<?php echo View::factory('comments', array('comments' => $comments, 'object_id' => $stream->id, 'object_type' => 'Stream')); ?>