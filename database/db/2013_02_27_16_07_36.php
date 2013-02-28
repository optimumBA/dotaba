<?php

class Migration_2013_02_27_16_07_36 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_news`
				DROP `gid`,
				DROP `published`,
				DROP `likes`,
				ADD `user_id` int(11) NOT NULL AFTER `content`,
				ADD `updated_at` datetime NULL AFTER `created_at`;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_news`
				DROP `updated_at`,
				DROP `user_id`,
				ADD `gid` bigint(20) NOT NULL AFTER `id`,
				ADD `published` BOOLEAN NULL DEFAULT FALSE AFTER `created_at`,
				ADD `likes` int(11) DEFAULT '0' AFTER `published`;"
		);
	}

}

?>