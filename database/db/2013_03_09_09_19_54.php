<?php

class Migration_2013_03_09_09_19_54 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_slots`
				CHANGE `player_slot` `player_slot` int(1);

			CREATE TABLE IF NOT EXISTS `dotaba_picksbans` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`match_id` int(11) NOT NULL,
				`is_pick` boolean NOT NULL,
				`hero_id` int(11) NOT NULL,
				`team` int(1) NOT NULL,
				`order` int(2) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"DROP TABLE `dotaba_picksbans`;

			ALTER TABLE `dotaba_slots`
				CHANGE `player_slot` `player_slot` int(3);"
		);
	}

}

?>