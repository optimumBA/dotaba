<?php

class Migration_2013_03_09_07_25_19 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_users`
				CHANGE `username` `username` varchar(255),
				CHANGE `name` `name` varchar(255),
				CHANGE `location` `location` varchar(255);

			ALTER TABLE `dotaba_modes`
				CHANGE `name` `name` varchar(255);

			INSERT INTO `dotaba_modes`
				(`name`)
			VALUES
				('All Pick'),
				('Captains Mode'),
				('Random Draft'),
				('Single Draft'),
				('All Random'),
				('?? INTRO/DEATH ??'),
				('The Diretide'),
				('Reverse Captains Mode'),
				('Greeviling'),
				('Tutorial'),
				('Mid Only'),
				('Least Played'),
				('New Player Pool');"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"TRUNCATE TABLE `dotaba_modes`;

			ALTER TABLE `dotaba_modes`
				CHANGE `name` `name` varchar(75);

			ALTER TABLE `dotaba_users`
				CHANGE `username` `username` varchar(75),
				CHANGE `name` `name` varchar(75),
				CHANGE `location` `location` varchar(2);"
		);
	}

}

?>