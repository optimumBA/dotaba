<?php

class Migration_2013_03_18_07_52_26 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_comments`
				ADD `removed` boolean NULL DEFAULT FALSE AFTER `user_id`;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_comments`
				DROP `removed`;"
		);
	}

}

?>