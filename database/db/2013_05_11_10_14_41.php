<?php

class Migration_2013_05_11_10_14_41 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_tournaments`
				DROP `user_id`;

			INSERT INTO `dotaba_roles` (`name`, `created_at`) VALUES ('Organizator/ica turnira', NOW());"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_tournaments`
				ADD `user_id` int(11) NOT NULL AFTER `description`;

			DELETE FROM `dotaba_roles` WHERE `name` = 'Organizator/ica turnira';"
		);
	}

}

?>