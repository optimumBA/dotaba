<?php

class Migration_2013_02_28_16_48_11 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"INSERT INTO `dotaba_users` (`steamid`, `accountid`, `clan_id`, `username`, `name`, `location`, `profileurl`, `avatar`, `status`, `created_at`)
			VALUES (76561198072492915, 112227187, NULL, 'Bakcheia', 'Amar', 'BA', 'http://steamcommunity.com/id/s1xr/', 'http://media.steampowered.com/steamcommunity/public/images/avatars/da/dacdacd146582e2bad49defad8224f280730f2d0_full.jpg', 1, '2013-02-27 18:03:51');"
		);
	}

}

?>