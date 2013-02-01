<?php

class Migration_2013_02_01_21_06_33 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_heroes`
			ADD `image` varchar(255) NOT NULL AFTER `localized_name`,
			ADD `status` boolean NULL DEFAULT FALSE AFTER `image`;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_heroes`
			DROP `image`,
			DROP `status`;"
		);
	}

}

?>