<?php

class Migration_2013_02_02_12_29_48 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_items`
			DROP `name`,
			ADD `name` varchar(255) NOT NULL AFTER `id`,
			ADD `localized_name` varchar(255) NOT NULL AFTER `name`,
			ADD `image` varchar(255) NOT NULL AFTER `localized_name`;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_items`
			DROP `name`,
			DROP `localized_name`,
			DROP `image`,
			ADD `name` varchar(75) COLLATE utf8_unicode_ci NOT NULL;"
		);
	}

}

?>