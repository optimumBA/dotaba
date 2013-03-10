<?php

class Migration_2013_03_09_18_57_05 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"CREATE TABLE IF NOT EXISTS `dotaba_applications` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`clan_id` int(11) NOT NULL,
				`user_id` int(11) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"DROP TABLE `dotaba_applications`;"
		);
	}

}

?>