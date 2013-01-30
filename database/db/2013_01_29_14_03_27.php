<?php

class Migration_2013_01_29_14_03_27 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_users`
			ADD `accountid` int(11) UNSIGNED NOT NULL AFTER `steamid`;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_users`
			DROP `accountid`;"
		);
	}

}

?>