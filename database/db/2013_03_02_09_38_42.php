<?php

class Migration_2013_03_02_09_38_42 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_roles`
				CHANGE `name` `name` varchar(255);

			INSERT INTO `dotaba_roles` (`id`, `name`, `created_at`) VALUES (NULL, 'Administrator/ica', NOW());

			INSERT INTO `dotaba_roles` (`id`, `name`, `created_at`) VALUES (NULL, 'Novinar/ka', NOW());"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"TRUNCATE TABLE `dotaba_roles`;

			ALTER TABLE `dotaba_roles`
				CHANGE `name` `name` int(11);"
		);
	}

}

?>