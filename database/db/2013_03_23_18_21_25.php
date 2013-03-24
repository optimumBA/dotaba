<?php

class Migration_2013_03_23_18_21_25 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec("RENAME TABLE `dotaba_matches_streams` TO `dotaba_announcements`;");
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec("RENAME TABLE `dotaba_announcements` TO `dotaba_matches_streams`;");
	}

}

?>