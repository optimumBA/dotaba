<?php

class Migration_2013_03_22_11_05_41 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_topics`
				ADD `main_post_id` int(11) NOT NULL AFTER `user_id`,
				CHANGE `is_special` `is_hidden` boolean NULL DEFAULT FALSE,
				CHANGE `posts_count` `posts_count` int(11) NULL DEFAULT 1;

			ALTER TABLE `dotaba_posts`
				DROP `is_removed`,
				CHANGE `body` `content` text NOT NULL,
				CHANGE `topic_id` `topic_id` int(11) NULL;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_posts`
				ADD `is_removed` boolean NULL DEFAULT FALSE,
				CHANGE `content` `body` varchar(255) NOT NULL,
				CHANGE `topic_id` `topic_id` int(11) NOT NULL;

			ALTER TABLE `dotaba_topics`
				DROP `main_post_id`,
				CHANGE `is_hidden` `is_special` boolean NULL DEFAULT FALSE,
				CHANGE `posts_count` `posts_count` int(11) NULL DEFAULT 0;"
		);
	}

}

?>