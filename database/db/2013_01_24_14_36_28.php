<?php

class Migration_2013_01_24_14_36_28 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"CREATE TABLE IF NOT EXISTS `dotaba_heroes` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(75) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB AUTO_INCREMENT=1;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec("DROP TABLE `dotaba_heroes`;");
	}

}

?>