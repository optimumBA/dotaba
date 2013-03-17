<?php

class Migration_2013_03_17_10_01_34 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_comments`
				ADD `updated_at` datetime NULL AFTER `created_at`;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_comments`
				DROP `updated_at`;"
		);
	}

}

?>