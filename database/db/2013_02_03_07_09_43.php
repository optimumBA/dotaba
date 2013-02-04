<?php

class Migration_2013_02_03_07_09_43 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"CREATE TABLE IF NOT EXISTS `dotaba_videos` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`vid` varchar(255) NOT NULL,
				`name` varchar(255) NOT NULL,
				`description` text NULL,
				`user_id` int(11) NOT NULL,
				`created_at` datetime NOT NULL,
				`updated_at` datetime NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec("DROP TABLE `dotaba_videos`;");
	}

}

?>