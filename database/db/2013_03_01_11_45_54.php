<?php

class Migration_2013_03_01_11_45_54 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_matches`
				CHANGE `radiant_clan` `radiant_clan_id` int(11),
				CHANGE `dire_clan` `dire_clan_id` int(11);

			ALTER TABLE `dotaba_slots`
				CHANGE `item_0` `item_0_id` int(11),
				CHANGE `item_1` `item_1_id` int(11),
				CHANGE `item_2` `item_2_id` int(11),
				CHANGE `item_3` `item_3_id` int(11),
				CHANGE `item_4` `item_4_id` int(11),
				CHANGE `item_5` `item_5_id` int(11);"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"ALTER TABLE `dotaba_matches`
				CHANGE `radiant_clan_id` `radiant_clan` int(11),
				CHANGE `dire_clan_id` `dire_clan` int(11);

			ALTER TABLE `dotaba_slots`
				CHANGE `item_0_id` `item_0` int(11),
				CHANGE `item_1_id` `item_1` int(11),
				CHANGE `item_2_id` `item_2` int(11),
				CHANGE `item_3_id` `item_3` int(11),
				CHANGE `item_4_id` `item_4` int(11),
				CHANGE `item_5_id` `item_5` int(11);"
		);
	}

}

?>