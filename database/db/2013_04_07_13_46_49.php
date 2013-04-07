<?php

class Migration_2013_04_07_13_46_49 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_requests` ADD `email` varchar(255) NOT NULL AFTER `user_id`;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_requests` DROP `email`;"
		);
	}

}

?>