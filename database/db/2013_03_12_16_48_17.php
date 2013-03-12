<?php

class Migration_2013_03_12_16_48_17 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"CREATE TABLE IF NOT EXISTS `dotaba_comments` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`body` text NOT NULL,
				`object_id` int(11) NOT NULL,
				`object_type` varchar(255) NOT NULL,
				`user_id` int(11) NOT NULL,
				`created_at` datetime NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"DROP TABLE `dotaba_comments`;"
		);
	}

}

?>