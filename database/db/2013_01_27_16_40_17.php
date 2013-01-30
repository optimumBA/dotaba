<?php

class Migration_2013_01_27_16_40_17 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_matches`
			DROP `mode_id`,
			DROP `duration`,
			DROP `region_id`,
			DROP `date`,
			DROP `winner_id`,
			ADD `winner_id` int(11) NULL AFTER `mid`,
			ADD `mode_id` int(11) NULL AFTER `winner_id`,
			ADD `duration` int(11) NULL AFTER `mode_id`,
			ADD `first_blood_time` int(11) NULL AFTER `duration`,
			ADD `date` datetime NULL AFTER `first_blood_time`;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_matches`
			DROP `mode_id`,
			DROP `duration`,
			DROP `date`,
			DROP `winner_id`,
			DROP `first_blood_time`,
			ADD `mode_id` int(11) NOT NULL AFTER `mid`,
			ADD `duration` int(11) NOT NULL AFTER `mode_id`,
			ADD `region_id` int(11) NOT NULL AFTER `duration`,
			ADD `date` datetime NOT NULL AFTER `region_id`,
			ADD `winner_id` int(11) NOT NULL AFTER `date`;"
		);
	}

}

?>