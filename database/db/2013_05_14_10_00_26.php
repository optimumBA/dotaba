<?php

class Migration_2013_05_14_10_00_26 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_heroes`
				DROP `status`,
				ADD `remote_id` int(11) NOT NULL AFTER `image`,
				ADD INDEX (`name`),
				ADD INDEX (`remote_id`);

			ALTER TABLE `dotaba_items`
				ADD `remote_id` int(11) NOT NULL AFTER `image`,
				ADD INDEX (`name`),
				ADD INDEX (`remote_id`);"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_heroes`
				ADD `status` boolean DEFAULT 0 AFTER `image`,
				DROP `remote_id`,
				DROP INDEX `name`,
				DROP INDEX `remote_id`;

			ALTER TABLE `dotaba_items`
				DROP INDEX `name`,
				DROP INDEX `remote_id`,
				DROP `remote_id`;"
		);
	}

}

?>