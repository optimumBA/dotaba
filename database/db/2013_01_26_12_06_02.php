<?php

class Migration_2013_01_26_12_06_02 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec("ALTER TABLE `dotaba_matches`
			DROP `winner`,
			ADD `winner_id` int(11) NOT NULL AFTER `date`;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec("ALTER TABLE `dotaba_matches`
			DROP `winner`,
			ADD `winner_id` int(11) NOT NULL AFTER `date`;"
		);
	}

}

?>