<?php

class Migration_2013_01_13_15_34_38 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec("ALTER TABLE `dotaba_news`
			DROP `title_en`,
			DROP `content_en`,
			DROP `title_bs`,
			DROP `content_bs`,
			ADD `title` varchar(255) NOT NULL AFTER `gid`,
			ADD `content` text NOT NULL AFTER `title`,
			ADD `published` BOOLEAN NULL DEFAULT FALSE AFTER `created_at`;");
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec("ALTER TABLE `dotaba_news`
			DROP `title`,
			DROP `content`,
			DROP `published`,
			ADD `title_en` varchar(255) NOT NULL AFTER `gid`,
			ADD `content_en` text NOT NULL AFTER `title_en`,
			ADD `title_bs` varchar(255) NULL AFTER `content_en`,
			ADD `content_bs` text NULL AFTER `title_bs`;");
	}

}

?>