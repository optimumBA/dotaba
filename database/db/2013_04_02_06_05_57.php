<?php

class Migration_2013_04_02_06_05_57 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_users` ADD `abandons` int(11) NULL DEFAULT 0 AFTER `losses`;

			ALTER TABLE `dotaba_matches` DROP `processed`;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_users` DROP `abandons`;

			ALTER TABLE `dotaba_matches` ADD `processed` boolean NULL DEFAULT 0 AFTER `updated_at`;"
		);
	}

}

?>