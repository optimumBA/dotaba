<?php

class Migration_2013_04_08_05_59_44 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_requests` DROP `removed`;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_requests` ADD `removed` boolean DEFALT FALSE;"
		);
	}

}

?>