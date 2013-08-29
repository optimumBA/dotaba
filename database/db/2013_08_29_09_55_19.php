<?php

class Migration_2013_08_29_09_55_19 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec("DROP TABLE `dotaba_requests`;");
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"CREATE TABLE IF NOT EXISTS `dotaba_requests` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`user_id` int(11) DEFAULT NULL,
				`email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				`giver_id` int(11) DEFAULT NULL,
				`processed` tinyint(1) DEFAULT '0',
				`created_at` datetime NOT NULL,
				`updated_at` datetime DEFAULT NULL,
				PRIMARY KEY (`id`),
				KEY `user_id` (`user_id`),
				KEY `giver_id` (`giver_id`),
				KEY `processed` (`processed`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;"
		);
	}

}

?>