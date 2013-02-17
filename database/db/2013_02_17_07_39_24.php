<?php

class Migration_2013_02_17_07_39_24 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"CREATE TABLE IF NOT EXISTS `dotaba_tournaments` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(255) NOT NULL,
				`description` text NULL,
				`user_id` int(11) NOT NULL,
				`created_at` datetime NOT NULL,
				`updated_at` datetime NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

			ALTER TABLE `dotaba_matches` ADD `tournament_id` int(11) NULL AFTER `type_id`;

			CREATE TABLE IF NOT EXISTS `dotaba_clans_tournaments` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`clan_id` int(11) NOT NULL,
				`tournament_id` int(11) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"DROP TABLE `dotaba_tournaments`;

			ALTER TABLE `dotaba_matches` DROP `tournament_id`;

			DROP TABLE `dotaba_clans_tournaments`;"
		);
	}

}

?>