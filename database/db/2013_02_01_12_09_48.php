<?php

class Migration_2013_02_01_12_09_48 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_heroes`
			DROP `name`,
			ADD `name` varchar(255) NOT NULL AFTER `id`,
			ADD `localized_name` varchar(255) NOT NULL AFTER `name`;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_heroes`
			DROP `name`,
			DROP `localized_name`,
			ADD `name` varchar(75) COLLATE utf8_unicode_ci NOT NULL;"
		);
	}

}

?>