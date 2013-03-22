<?php

class Migration_2013_03_22_10_10_20 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"CREATE TABLE IF NOT EXISTS `dotaba_topics` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(255) NOT NULL,
				`user_id` int(11) NOT NULL,
				`is_locked` boolean NULL DEFAULT FALSE,
				`is_special` boolean NULL DEFAULT FALSE,
				`is_sticky` boolean NULL DEFAULT FALSE,
				`posts_count` int(11) NULL DEFAULT 0,
				`views_count` int(11) NULL DEFAULT 0,
				`created_at` datetime NOT NULL,
				`updated_at` datetime NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

			CREATE TABLE IF NOT EXISTS `dotaba_posts` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`body` varchar(255) NOT NULL,
				`topic_id` int(11) NOT NULL,
				`user_id` int(11) NOT NULL,
				`is_removed` boolean NULL DEFAULT FALSE,
				`created_at` datetime NOT NULL,
				`updated_at` datetime NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"DROP TABLE `dotaba_topics`;

			DROP TABLE `dotaba_posts`;"
		);
	}

}

?>