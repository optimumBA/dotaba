<?php

class Migration_2013_02_21_20_09_57 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"INSERT INTO `dotaba_users` (`steamid`, `accountid`, `clan_id`, `username`, `name`, `location`, `profileurl`, `avatar`, `status`, `created_at`)
			VALUES (76561198002272594, 42006866, NULL, 'GriFoN', 'Almir', 'BA', 'http://steamcommunity.com/id/GriFoN92/', 'http://media.steampowered.com/steamcommunity/public/images/avatars/e2/e24cca7c7cc33047149f8d8c39e2a807639e0d85_full.jpg', 0, '2013-02-21 20:56:51');"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec("TRUNCATE TABLE `dotaba_users`;");
	}

}

?>