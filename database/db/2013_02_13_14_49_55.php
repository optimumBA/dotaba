<?php

class Migration_2013_02_13_14_49_55 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec("ALTER TABLE `dotaba_matches` ADD `type_id` int(11) NULL AFTER `winner_id`;");
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec("ALTER TABLE `dotaba_matches` DROP `type_id`");
	}

}

?>