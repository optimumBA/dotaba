<?php

class Migration_2013_01_26_20_02_16 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"CREATE TABLE IF NOT EXISTS `dotaba_matches_teams_users` (
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
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec("DROP TABLE `dotaba_matches_teams_users`;");
	}

}

?>