<?php

class Migration_2013_01_20_08_18_49 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec("ALTER TABLE `dotaba_users`
			DROP `location`,
			ADD `location` varchar(2) DEFAULT NULL AFTER `name`,
			DROP `avatar`,
			ADD `avatar` varchar(255) NOT NULL AFTER `profileurl`,
			ADD `status` int(1) NOT NULL AFTER `avatar`;");
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec("ALTER TABLE `dotaba_users`
			DROP `location`,
			ADD `location` varchar(75) DEFAULT NULL AFTER `name`,,
			DROP `avatar`,
			ADD `avatar` varchar(255) DEFAULT NULL AFTER `profileurl`,
			DROP `status`;");
	}

}

?>