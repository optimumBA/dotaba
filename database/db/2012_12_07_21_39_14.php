<?php

class Migration_2012_12_07_21_39_14 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec("CREATE TABLE `dotaba_sessions` (
				`session_id` VARCHAR(24) NOT NULL,
				`last_active` INT UNSIGNED NOT NULL,
				`contents` TEXT NOT NULL,
				PRIMARY KEY (`session_id`),
				INDEX (`last_active`)
			) ENGINE = MYISAM;");
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec("DROP TABLE `dotaba_sessions`");
	}

}

?>