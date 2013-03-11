<?php

class Migration_2013_03_11_10_38_47 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_clans`
				ADD `open` boolean NOT NULL AFTER `lord_id`;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_clans`
				DROP `open`;"
		);
	}

}

?>