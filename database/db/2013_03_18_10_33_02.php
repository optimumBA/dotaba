<?php

class Migration_2013_03_18_10_33_02 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"RENAME TABLE `dotaba_clans_tournaments` TO `dotaba_participations`;

			ALTER TABLE `dotaba_participations`
				ADD `is_approved` boolean NOT NULL AFTER `tournament_id`,
				ADD `created_at` datetime NOT NULL AFTER `is_approved`,
				ADD `updated_at` datetime NULL AFTER `created_at`;

			ALTER TABLE `dotaba_tournaments`
				ADD `num_clans` int(11) NOT NULL AFTER `user_id`,
				ADD `is_auto_approvable` boolean NOT NULL AFTER `num_clans`,
				ADD `is_started` boolean NULL DEFAULT FALSE AFTER `is_auto_approvable`,
				ADD `winner_id` int(11) NULL AFTER `is_started`,
				ADD `finished_at` datetime NULL AFTER `updated_at`;

			CREATE TABLE IF NOT EXISTS `dotaba_participations_users` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`participation_id` int(11) NOT NULL,
				`user_id` int(11) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"DROP TABLE `dotaba_participations_users`;

			ALTER TABLE `dotaba_tournaments`
				DROP `num_clans`,
				DROP `is_auto_approvable`,
				DROP `is_started`,
				DROP `winner_id`,
				DROP `finished_at`;

			ALTER TABLE `dotaba_participations`
				DROP `is_approved`,
				DROP `created_at`,
				DROP `updated_at`;

			RENAME TABLE `dotaba_participations` TO `dotaba_clans_tournaments`;"
		);
	}

}

?>