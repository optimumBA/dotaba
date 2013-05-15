<?php

class Migration_2013_05_15_15_02_37 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_matches`
				ADD `stream_id` int(11) NULL AFTER `tournament_id`;

			DROP TABLE `dotaba_announcements`;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_matches`
				DROP `stream_id`;

			CREATE TABLE IF NOT EXISTS `dotaba_announcements` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`match_id` int(11) NOT NULL,
				`stream_id` int(11) NOT NULL,
				PRIMARY KEY (`id`),
				KEY `match_id` (`match_id`),
				KEY `stream_id` (`stream_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;"
		);
	}

}

?>