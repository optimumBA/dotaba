<?php

class Migration_2013_03_18_13_38_50 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_matches`
				CHANGE `mid` `mid` int(11) NULL;

			ALTER TABLE `dotaba_tournaments`
				ADD `mode_id` int(11) NOT NULL AFTER `user_id`;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_matches`
				CHANGE `mid` `mid` int(11) NOT NULL;

			ALTER TABLE `dotaba_tournaments`
				DROP `mode_id`;"
		);
	}

}

?>