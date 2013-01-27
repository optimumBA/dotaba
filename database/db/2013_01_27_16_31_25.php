<?php

class Migration_2013_01_27_16_31_25 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec("DROP TABLE `dotaba_regions`;");
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"CREATE TABLE IF NOT EXISTS `dotaba_regions` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(75) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB AUTO_INCREMENT=1;"
		);
	}

}

?>