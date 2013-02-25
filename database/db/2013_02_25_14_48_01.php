<?php

class Migration_2013_02_25_14_48_01 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_types` ADD `lobby_type` int(11) NULL AFTER `name`;

			INSERT INTO `dotaba_types` (`id`, `name`, `lobby_type`) VALUES (NULL, 'Public matchmaking', 0);"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"DELETE FROM `dotaba_types` WHERE `name` = 'Public matchmaking';

			ALTER TABLE `dotaba_types` DROP `lobby_type`;"
		);
	}

}

?>