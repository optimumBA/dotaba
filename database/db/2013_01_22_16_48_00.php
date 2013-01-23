<?php

class Migration_2013_01_22_16_48_00 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec("CREATE TABLE IF NOT EXISTS `dotaba_teams` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(10) NOT NULL,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB AUTO_INCREMENT=1 ;

		INSERT INTO  `dotaba`.`dotaba_teams` (
			`id` ,
			`name`
		)
			VALUES (
			NULL ,  'Radiant'
		);

		INSERT INTO  `dotaba`.`dotaba_teams` (
			`id` ,
			`name`
		)
			VALUES (
			NULL ,  'Dire'
		);");
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec("DROP TABLE `dotaba_teams` ;");
	}

}

?>