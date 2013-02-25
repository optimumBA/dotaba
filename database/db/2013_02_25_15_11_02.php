<?php

class Migration_2013_02_25_15_11_02 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_news` ENGINE = INNODB;

			ALTER TABLE `dotaba_sessions` ENGINE = INNODB;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_news` ENGINE = MYISAM;

			ALTER TABLE `dotaba_sessions` ENGINE = MYISAM;"
		);
	}

}

?>