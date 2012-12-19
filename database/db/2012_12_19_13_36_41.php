<?php

class Migration_2012_12_19_13_36_41 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec("CREATE TABLE IF NOT EXISTS `dotaba_news` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`gid` bigint(20) NOT NULL,
				`title_en` varchar(255) NOT NULL,
				`content_en` text NOT NULL,
				`title_bs` varchar(255) NULL,
				`content_bs` text NULL,
				`source` varchar(255) NOT NULL,
				`url` varchar(255) NOT NULL,
				`created_at` datetime NOT NULL,
				`likes` int(11) DEFAULT '0',
				PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;");
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec("DROP TABLE `dotaba_news`");
	}

}

?>