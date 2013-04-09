<?php

class Migration_2013_04_09_13_46_57 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec("ALTER TABLE `dotaba_heroes` ADD INDEX (`localized_name`);");
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec("ALTER TABLE `dotaba_heroes` DROP INDEX `localized_name`;");
	}

}

?>