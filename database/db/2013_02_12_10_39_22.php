<?php

class Migration_2013_02_12_10_39_22 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"CREATE TABLE IF NOT EXISTS `dotaba_types` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(255) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

			INSERT INTO  `dotaba`.`dotaba_types` (`id`, `name`) VALUES (NULL, 'Clan war');

			INSERT INTO  `dotaba`.`dotaba_types` (`id`, `name`) VALUES (NULL, 'Mix');

			INSERT INTO  `dotaba`.`dotaba_types` (`id`, `name`) VALUES (NULL, 'Turnir');"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec("DROP TABLE `dotaba_types`;");
	}

}

?>