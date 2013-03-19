<?php

class Migration_2013_03_19_11_28_10 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"CREATE TABLE IF NOT EXISTS `dotaba_requests` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`user_id` int(11) NULL,
				`giver_id` int(11) NULL,
				`processed` boolean NULL DEFAULT FALSE,
				`removed` boolean NULL DEFAULT FALSE,
				`created_at` datetime NOT NULL,
				`updated_at` datetime NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"DROP TABLE `dotaba_requests`;"
		);
	}

}

?>