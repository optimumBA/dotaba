<?php

class Migration_2013_09_09_18_37_26 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"CREATE TABLE dotaba_acos (
				id int(11) NOT NULL AUTO_INCREMENT,
				model varchar(255) DEFAULT NULL,
				foreign_key int(11) DEFAULT NULL,
				alias varchar(255) DEFAULT NULL,
				lft int(11) DEFAULT NULL,
				rgt int(11) DEFAULT NULL,
				PRIMARY KEY (id)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

			CREATE TABLE dotaba_aros (
				id int(11) NOT NULL AUTO_INCREMENT,
				model varchar(255) DEFAULT NULL,
				foreign_key int(11) DEFAULT NULL,
				alias varchar(255) DEFAULT NULL,
				lft int(11) DEFAULT NULL,
				rgt int(11) DEFAULT NULL,
				PRIMARY KEY (id)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

			CREATE TABLE dotaba_acos_aros (
				id int(11) NOT NULL AUTO_INCREMENT,
				aco_id int(11) NOT NULL,
				aro_id int(11) NOT NULL,
				_create char(2) NOT NULL DEFAULT 0,
				_read char(2) NOT NULL DEFAULT 0,
				_update char(2) NOT NULL DEFAULT 0,
				_delete char(2) NOT NULL DEFAULT 0,
				PRIMARY KEY (id),
				UNIQUE KEY `ACO_ARO_KEY` (`aco_id`,`aro_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"DROP TABLE `dotaba_acos`;

			DROP TABLE `dotaba_aros`;

			DROP TABLE `dotaba_acos_aros`;"
		);
	}

}

?>