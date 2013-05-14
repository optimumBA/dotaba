<?php

class Migration_2013_05_14_09_36_26 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec("DROP TABLE `dotaba_participations_users`;");
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"CREATE TABLE IF NOT EXISTS `dotaba_participations_users` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`participation_id` int(11) NOT NULL,
				`user_id` int(11) NOT NULL,
				PRIMARY KEY (`id`),
				KEY `participation_id` (`participation_id`),
				KEY `user_id` (`user_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;"
		);
	}

}

?>