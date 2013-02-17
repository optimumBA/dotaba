<?php

class Migration_2013_02_17_16_17_09 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"CREATE TABLE IF NOT EXISTS `dotaba_roles` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` int(11) NOT NULL,
				`description` text NULL,
				`created_at` datetime NOT NULL,
				`updated_at` datetime NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

			CREATE TABLE IF NOT EXISTS `dotaba_roles_users` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`role_id` int(11) NOT NULL,
				`user_id` int(11) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"DROP TABLE `dotaba_roles_users`;

			DROP TABLE `dotaba_roles`;"
		);
	}

}

?>