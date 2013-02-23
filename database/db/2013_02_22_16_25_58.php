<?php

class Migration_2013_02_22_16_25_58 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"DROP TABLE `dotaba_teams`;

			DROP TABLE `dotaba_matches_teams`;

			DROP TABLE `dotaba_matches_teams_users`;

			DROP TABLE `dotaba_matches_teams_users_items`;

			ALTER TABLE `dotaba_matches`
				DROP `winner_id`,
				ADD `radiant_clan` int(11) NULL AFTER `tournament_id`,
				ADD `dire_clan` int(11) NULL AFTER `radiant_clan`,
				ADD `cluster` int(11) NULL AFTER `mode_id`,
				ADD `radiant_win` tinyint(1) NULL AFTER `cluster`,
				ADD `tower_status_radiant` int(11) NULL AFTER `radiant_win`,
				ADD `tower_status_dire` int(11) NULL AFTER `tower_status_radiant`,
				ADD `barracks_status_radiant` int(11) NULL AFTER `tower_status_dire`,
				ADD `barracks_status_dire` int(11) NULL AFTER `barracks_status_radiant`,
				ADD `human_players` int(11) NULL AFTER `barracks_status_dire`,
				ADD `created_at` datetime NOT NULL AFTER `date`,
				ADD `updated_at` datetime NULL AFTER `created_at`;

			CREATE TABLE IF NOT EXISTS `dotaba_slots` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`match_id` int(11) NOT NULL,
				`user_id` int(11) NOT NULL,
				`hero_id` int(11) NOT NULL,
				`player_slot` int(3) NOT NULL,
				`item_0` int(11) NOT NULL,
				`item_1` int(11) NOT NULL,
				`item_2` int(11) NOT NULL,
				`item_3` int(11) NOT NULL,
				`item_4` int(11) NOT NULL,
				`item_5` int(11) NOT NULL,
				`kills` int(11) NOT NULL,
				`deaths` int(11) NOT NULL,
				`assists` int(11) NOT NULL,
				`leaver_status` tinyint(1) NOT NULL,
				`gold` int(11) NOT NULL,
				`last_hits` int(11) NOT NULL,
				`denies` int(11) NOT NULL,
				`gold_per_min` int(11) NOT NULL,
				`xp_per_min` int(11) NOT NULL,
				`gold_spent` int(11) NOT NULL,
				`hero_damage` int(11) NOT NULL,
				`tower_damage` int(11) NOT NULL,
				`hero_healing` int(11) NOT NULL,
				`level` int(11) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"CREATE TABLE IF NOT EXISTS `dotaba_teams` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(10) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

			INSERT INTO `dotaba_teams` (`id`, `name`) VALUES
			(1, 'Radiant'),
			(2, 'Dire');

			CREATE TABLE IF NOT EXISTS `dotaba_matches_teams` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`match_id` int(11) NOT NULL,
				`team_id` int(11) NOT NULL,
				`clan_id` int(11) DEFAULT NULL,
				`tower_status` int(11) NOT NULL,
				`barracks_status` int(11) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

			CREATE TABLE IF NOT EXISTS `dotaba_matches_teams_users` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`match_team_id` int(11) NOT NULL,
				`user_id` int(11) NOT NULL,
				`player_slot` int(11) NOT NULL,
				`hero_id` int(11) NOT NULL,
				`kills` int(11) NOT NULL,
				`deaths` int(11) NOT NULL,
				`assists` int(11) NOT NULL,
				`leaver_status` tinyint(1) NOT NULL,
				`gold` int(11) NOT NULL,
				`last_hits` int(11) NOT NULL,
				`denies` int(11) NOT NULL,
				`gold_per_min` int(11) NOT NULL,
				`xp_per_min` int(11) NOT NULL,
				`gold_spent` int(11) NOT NULL,
				`hero_damage` int(11) NOT NULL,
				`tower_damage` int(11) NOT NULL,
				`hero_healing` int(11) NOT NULL,
				`level` int(11) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

			CREATE TABLE IF NOT EXISTS `dotaba_matches_teams_users_items` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`match_team_user_id` int(11) NOT NULL,
				`item_id` int(11) NOT NULL,
				`slot` int(11) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

			ALTER TABLE `dotaba_matches`
				ADD `winner_id` int(11) DEFAULT NULL AFTER `mid`,
				DROP `cluster`,
				DROP `radiant_win`,
				DROP `tower_status_radiant`,
				DROP `tower_status_dire`,
				DROP `barracks_status_radiant`,
				DROP `barracks_status_dire`,
				DROP `human_players`,
				DROP `created_at`,
				DROP `updated_at`;

			DROP TABLE `dotaba_slots`;"
		);
	}

}

?>