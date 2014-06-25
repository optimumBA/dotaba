<?php

class Migration_2013_08_26_19_44_50 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_comments`
				ADD `parent_id` int(11) NULL AFTER `object_type`;"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_comments`
				DROP `parent_id`;"
		);
	}

}

?>