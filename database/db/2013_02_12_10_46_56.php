<?php

class Migration_2013_02_12_10_46_56 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec("ALTER TABLE `dotaba_matches_teams` ADD `clan_id` int(11) NULL AFTER `team_id`;");
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec("ALTER TABLE `dotaba_matches_teams` DROP `clan_id`");
	}

}

?>