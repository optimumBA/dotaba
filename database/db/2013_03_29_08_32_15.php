<?php

class Migration_2013_03_29_08_32_15 extends MpmMigration
{

	public function up(PDO &$pdo)
	{
		$pdo->exec(
			"INSERT INTO  `dotaba_roles_users`
				(`role_id`, `user_id`)
			VALUES
				(1, 1),
				(1, 2);

			ALTER TABLE `dotaba_announcements`
				ADD INDEX (`match_id`),
				ADD INDEX (`stream_id`);

			ALTER TABLE `dotaba_applications`
				ADD INDEX (`clan_id`),
				ADD INDEX (`user_id`);

			ALTER TABLE `dotaba_bans`
				ADD INDEX (`user_id`),
				ADD INDEX (`expires_at`);

			ALTER TABLE `dotaba_clans`
				ADD INDEX (`lord_id`);

			ALTER TABLE `dotaba_comments`
				ADD INDEX (`object_id`),
				ADD INDEX (`object_type`);

			ALTER TABLE `dotaba_matches`
				ADD INDEX (`type_id`),
				ADD INDEX (`tournament_id`),
				ADD INDEX (`radiant_clan_id`),
				ADD INDEX (`dire_clan_id`),
				ADD INDEX (`radiant_win`),
				ADD INDEX (`processed`);

			ALTER TABLE `dotaba_modes`
				ADD INDEX (`name`);

			ALTER TABLE `dotaba_participations`
				ADD INDEX (`clan_id`),
				ADD INDEX (`tournament_id`),
				ADD INDEX (`is_approved`);

			ALTER TABLE `dotaba_participations_users`
				ADD INDEX (`participation_id`),
				ADD INDEX (`user_id`);

			ALTER TABLE `dotaba_picksbans`
				ADD INDEX (`match_id`),
				ADD INDEX (`order`);

			ALTER TABLE `dotaba_posts`
				ADD INDEX (`topic_id`);

			ALTER TABLE `dotaba_requests`
				ADD INDEX (`user_id`),
				ADD INDEX (`giver_id`),
				ADD INDEX (`processed`),
				ADD INDEX (`removed`);

			ALTER TABLE `dotaba_roles_users`
				ADD INDEX (`role_id`),
				ADD INDEX (`user_id`);

			ALTER TABLE `dotaba_slots`
				ADD INDEX (`match_id`),
				ADD INDEX (`user_id`),
				ADD INDEX (`player_slot`);

			ALTER TABLE `dotaba_streams`
				ADD INDEX (`user_id`);

			ALTER TABLE `dotaba_topics`
				ADD INDEX (`is_hidden`),
				ADD INDEX (`is_sticky`),
				ADD INDEX (`updated_at`);

			ALTER TABLE `dotaba_tournaments`
				ADD INDEX (`winner_id`);

			ALTER TABLE `dotaba_types`
				ADD INDEX (`name`),
				ADD INDEX (`lobby_type`);

			ALTER TABLE `dotaba_users`
				ADD INDEX (`steamid`),
				ADD INDEX (`accountid`),
				ADD INDEX (`clan_id`);"
		);
	}

	public function down(PDO &$pdo)
	{
		$pdo->exec(
			"TRUNCATE TABLE `dotaba_roles_users`;

			ALTER TABLE `dotaba_announcements`
				DROP INDEX `match_id`,
				DROP INDEX `stream_id`;

			ALTER TABLE `dotaba_applications`
				DROP INDEX `clan_id`,
				DROP INDEX `user_id`;

			ALTER TABLE `dotaba_bans`
				DROP INDEX `user_id`,
				DROP INDEX `expires_at`;

			ALTER TABLE `dotaba_clans`
				DROP INDEX `lord_id`;

			ALTER TABLE `dotaba_comments`
				DROP INDEX `object_id`,
				DROP INDEX `object_type`;

			ALTER TABLE `dotaba_matches`
				DROP INDEX `type_id`,
				DROP INDEX `tournament_id`,
				DROP INDEX `radiant_clan_id`,
				DROP INDEX `dire_clan_id`,
				DROP INDEX `radiant_win`,
				DROP INDEX `processed`;

			ALTER TABLE `dotaba_modes`
				DROP INDEX `name`;

			ALTER TABLE `dotaba_participations`
				DROP INDEX `clan_id`,
				DROP INDEX `tournament_id`,
				DROP INDEX `is_approved`;

			ALTER TABLE `dotaba_participations_users`
				DROP INDEX `participation_id`,
				DROP INDEX `user_id`;

			ALTER TABLE `dotaba_picksbans`
				DROP INDEX `match_id`,
				DROP INDEX `order`;

			ALTER TABLE `dotaba_posts`
				DROP INDEX `topic_id`;

			ALTER TABLE `dotaba_requests`
				DROP INDEX `user_id`,
				DROP INDEX `giver_id`,
				DROP INDEX `processed`,
				DROP INDEX `removed`;

			ALTER TABLE `dotaba_roles_users`
				DROP INDEX `role_id`,
				DROP INDEX `user_id`;

			ALTER TABLE `dotaba_slots`
				DROP INDEX `match_id`,
				DROP INDEX `user_id`,
				DROP INDEX `player_slot`;

			ALTER TABLE `dotaba_streams`
				DROP INDEX `user_id`;

			ALTER TABLE `dotaba_topics`
				DROP INDEX `is_hidden`,
				DROP INDEX `is_sticky`,
				DROP INDEX `updated_at`;

			ALTER TABLE `dotaba_tournaments`
				DROP INDEX `winner_id`;

			ALTER TABLE `dotaba_types`
				DROP INDEX `name`,
				DROP INDEX `lobby_type`;

			ALTER TABLE `dotaba_users`
				DROP INDEX `steamid`,
				DROP INDEX `accountid`,
				DROP INDEX `clan_id`;"
		);
	}

}

?>