<?php

class Migration_2013_03_06_13_55_20 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_users`
				ADD `featured_hero_id` int(11) NULL AFTER `status`;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_users`
				DROP `featured_hero_id`;"
		);
	}

}

?>