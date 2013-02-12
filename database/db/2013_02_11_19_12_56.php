<?php

class Migration_2013_02_11_19_12_56 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec("ALTER TABLE `dotaba_users` ADD `clan_id` int(11) NULL AFTER `accountid`;");
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec("ALTER TABLE `dotaba_users` DROP `clan_id`");
	}

}

?>