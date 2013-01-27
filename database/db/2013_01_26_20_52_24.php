<?php

class Migration_2013_01_26_20_52_24 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"CREATE TABLE IF NOT EXISTS `dotaba_matches_teams_users_items` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`match_team_user_id` int(11) NOT NULL,
				`item_id` int(11) NOT NULL,
				`slot` int(11) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec("DROP TABLE `dotaba_matches_teams_users_items`;");
	}

}

?>