<?php

class Migration_2013_01_26_11_43_25 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec("ALTER TABLE `dotaba_modes`
			DROP `name`,
			ADD `name` varchar(75) NOT NULL AFTER `id`;
			ALTER TABLE `dotaba_regions`
			DROP `name`,
			ADD `name` varchar(75) NOT NULL AFTER `id`;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec("ALTER TABLE `dotaba_modes`
			DROP `name`,
			ADD `name` int(11) NOT NULL AFTER `id`;
			ALTER TABLE `dotaba_regions`
			DROP `name`,
			ADD `name` int(11) NOT NULL AFTER `id`;"
		);
	}

}

?>