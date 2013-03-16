<?php

class Migration_2013_03_16_10_14_07 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_matches`
				ADD `processed` boolean NULL DEFAULT FALSE AFTER `updated_at`;

			ALTER TABLE `dotaba_users`
				CHANGE `username` `username` varchar(255) NOT NULL,
				ADD `wins` int(11) NULL DEFAULT 0 AFTER `featured_hero_id`,
				ADD `losses` int(11) NULL DEFAULT 0 AFTER `wins`;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_matches`
				DROP `processed`;

			ALTER TABLE `dotaba_users`
				CHANGE `username` `username` varchar(255) NULL,
				DROP `wins`,
				DROP `losses`;"
		);
	}

}

?>