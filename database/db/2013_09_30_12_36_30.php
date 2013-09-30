<?php

class Migration_2013_09_30_12_36_30 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_tournaments`
				ADD `rarity` varchar(11) AFTER `description`;

			ALTER TABLE `dotaba_topics`
				ADD `devclass` varchar(32) NULL AFTER `is_sticky`;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"CREATE TABLE IF NOT EXISTS `dotaba_colors` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(25) NOT NULL,
				`hex` varchar(25) NOT NULL,
				PRIMARY KEY (`id`),
				KEY `name` (`name`),
				KEY `hex` (`hex`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;"
		);
	}

}

?>