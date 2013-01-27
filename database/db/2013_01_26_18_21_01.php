<?php

class Migration_2013_01_26_18_21_01 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"CREATE TABLE IF NOT EXISTS `dotaba_matches_teams` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`match_id` int(11) NOT NULL,
				`team_id` int(11) NOT NULL,
				`tower_status` int(11) NOT NULL,
				`barracks_status` int(11) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec("DROP TABLE `dotaba_matches_teams`;");
	}

}

?>