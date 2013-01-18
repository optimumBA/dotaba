<?php

class Migration_2013_01_18_12_14_55 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec("CREATE TABLE IF NOT EXISTS `dotaba_users` (
						`id` int(11) NOT NULL AUTO_INCREMENT,
						`steamid` bigint(20) NOT NULL,
						`username` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
						`name` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
						`location` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
						`profileurl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
						`avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
						`created_at` datetime NOT NULL,
						PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;");
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec("DROP TABLE `dotaba_users`");
	}

}

?>