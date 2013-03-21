<?php

class Migration_2013_03_21_11_12_04 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"CREATE TABLE IF NOT EXISTS `dotaba_streams` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`channel` varchar(255) NOT NULL,
				`description` text NULL,
				`user_id` int(11) NOT NULL,
				`online` boolean NULL DEFAULT FALSE,
				`viewers` int(11) NULL DEFAULT 0,
				`created_at` datetime NOT NULL,
				`updated_at` datetime NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

			CREATE TABLE IF NOT EXISTS `dotaba_matches_streams` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`match_id` int(11) NOT NULL,
				`stream_id` int(11) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"DROP TABLE `dotaba_matches_streams`;

			DROP TABLE `dotaba_streams`;"
		);
	}

}

?>