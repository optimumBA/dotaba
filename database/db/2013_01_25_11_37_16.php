<?php

class Migration_2013_01_25_11_37_16 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"CREATE TABLE IF NOT EXISTS `dotaba_matches` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`mid` int(11) NOT NULL,
				`mode_id` int(11) NOT NULL,
				`duration` int(11) NOT NULL,
				`region_id` int(11) NOT NULL,
				`date` datetime NOT NULL,
				`winner` int(11) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB AUTO_INCREMENT=1;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec("DROP TABLE `dotaba_matches`;");
	}

}

?>