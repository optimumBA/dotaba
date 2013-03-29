<?php
/**
 * This file houses the MpmInitialSchema class.
 *
 * This file may be deleted if you do not wish to use the build command or build on init features.
 *
 * @package    mysql_php_migrations
 * @subpackage Classes
 * @license    http://www.opensource.org/licenses/bsd-license.php  The New BSD License
 * @link       http://code.google.com/p/mysql-php-migrations/
 */

/**
 * The MpmInitialSchema class is used to build an initial database structure.
 *
 * @package    mysql_php_migrations
 * @subpackage Classes
 */
class MpmInitialSchema extends MpmSchema
{

	public function __construct()
	{
		parent::__construct();

		/* If you build your initial schema having already executed a number of migrations,
		* you should set the initial migration timestamp.
		*
		* The initial migration timestamp will be set to active and this migration and all
		* previous will be ignored when the build command is used.
		*
		* EX:
		*
		* $this->initialMigrationTimestamp = '2009-08-01 15:23:44';
		*/
		$this->initialMigrationTimestamp = '2013-03-29 08:32:15';
	}

	public function build()
	{
		/* Add the queries needed to build the initial structure of your database.
		*
		* EX:
		*
		* $this->dbObj->exec('CREATE TABLE `testing` ( `id` INT(11) AUTO_INCREMENT NOT NULL, `vals` INT(11) NOT NULL, PRIMARY KEY ( `id` ))');
		*/
		$this->dbObj->exec(
			"CREATE TABLE IF NOT EXISTS `dotaba_announcements` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`match_id` int(11) NOT NULL,
				`stream_id` int(11) NOT NULL,
				PRIMARY KEY (`id`),
				KEY `match_id` (`match_id`),
				KEY `stream_id` (`stream_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

			CREATE TABLE IF NOT EXISTS `dotaba_applications` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`clan_id` int(11) NOT NULL,
				`user_id` int(11) NOT NULL,
				PRIMARY KEY (`id`),
				KEY `clan_id` (`clan_id`),
				KEY `user_id` (`user_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

			CREATE TABLE IF NOT EXISTS `dotaba_bans` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`user_id` int(11) NOT NULL,
				`reason` text COLLATE utf8_unicode_ci,
				`executioner_id` int(11) NOT NULL,
				`created_at` datetime NOT NULL,
				`updated_at` datetime DEFAULT NULL,
				`expires_at` datetime NOT NULL,
				PRIMARY KEY (`id`),
				KEY `user_id` (`user_id`),
				KEY `expires_at` (`expires_at`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

			CREATE TABLE IF NOT EXISTS `dotaba_clans` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				`tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				`lord_id` int(11) NOT NULL,
				`open` tinyint(1) NOT NULL,
				`created_at` datetime NOT NULL,
				`updated_at` datetime DEFAULT NULL,
				PRIMARY KEY (`id`),
				KEY `lord_id` (`lord_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

			CREATE TABLE IF NOT EXISTS `dotaba_comments` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`body` text COLLATE utf8_unicode_ci NOT NULL,
				`object_id` int(11) NOT NULL,
				`object_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				`user_id` int(11) NOT NULL,
				`removed` tinyint(1) DEFAULT '0',
				`created_at` datetime NOT NULL,
				`updated_at` datetime DEFAULT NULL,
				PRIMARY KEY (`id`),
				KEY `object_id` (`object_id`),
				KEY `object_type` (`object_type`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

			CREATE TABLE IF NOT EXISTS `dotaba_heroes` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				`localized_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				`image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				`status` tinyint(1) DEFAULT '0',
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

			CREATE TABLE IF NOT EXISTS `dotaba_items` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				`localized_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				`image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

			CREATE TABLE IF NOT EXISTS `dotaba_matches` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`mid` int(11) DEFAULT NULL,
				`type_id` int(11) DEFAULT NULL,
				`tournament_id` int(11) DEFAULT NULL,
				`radiant_clan_id` int(11) DEFAULT NULL,
				`dire_clan_id` int(11) DEFAULT NULL,
				`mode_id` int(11) DEFAULT NULL,
				`cluster` int(11) DEFAULT NULL,
				`radiant_win` tinyint(1) DEFAULT NULL,
				`tower_status_radiant` int(11) DEFAULT NULL,
				`tower_status_dire` int(11) DEFAULT NULL,
				`barracks_status_radiant` int(11) DEFAULT NULL,
				`barracks_status_dire` int(11) DEFAULT NULL,
				`human_players` int(11) DEFAULT NULL,
				`duration` int(11) DEFAULT NULL,
				`first_blood_time` int(11) DEFAULT NULL,
				`date` datetime DEFAULT NULL,
				`created_at` datetime NOT NULL,
				`updated_at` datetime DEFAULT NULL,
				`processed` tinyint(1) DEFAULT '0',
				PRIMARY KEY (`id`),
				KEY `type_id` (`type_id`),
				KEY `tournament_id` (`tournament_id`),
				KEY `radiant_clan_id` (`radiant_clan_id`),
				KEY `dire_clan_id` (`dire_clan_id`),
				KEY `radiant_win` (`radiant_win`),
				KEY `processed` (`processed`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

			CREATE TABLE IF NOT EXISTS `dotaba_modes` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
				PRIMARY KEY (`id`),
				KEY `name` (`name`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

			INSERT INTO `dotaba_modes` (`id`, `name`) VALUES
				(6, '?? INTRO/DEATH ??'),
				(1, 'All Pick'),
				(5, 'All Random'),
				(2, 'Captains Mode'),
				(9, 'Greeviling'),
				(12, 'Least Played'),
				(11, 'Mid Only'),
				(13, 'New Player Pool'),
				(3, 'Random Draft'),
				(8, 'Reverse Captains Mode'),
				(4, 'Single Draft'),
				(7, 'The Diretide'),
				(10, 'Tutorial');

			CREATE TABLE IF NOT EXISTS `dotaba_news` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				`content` text COLLATE utf8_unicode_ci NOT NULL,
				`user_id` int(11) NOT NULL,
				`source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				`url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				`created_at` datetime NOT NULL,
				`updated_at` datetime DEFAULT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

			CREATE TABLE IF NOT EXISTS `dotaba_participations` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`clan_id` int(11) NOT NULL,
				`tournament_id` int(11) NOT NULL,
				`is_approved` tinyint(1) NOT NULL,
				`created_at` datetime NOT NULL,
				`updated_at` datetime DEFAULT NULL,
				PRIMARY KEY (`id`),
				KEY `clan_id` (`clan_id`),
				KEY `tournament_id` (`tournament_id`),
				KEY `is_approved` (`is_approved`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

			CREATE TABLE IF NOT EXISTS `dotaba_participations_users` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`participation_id` int(11) NOT NULL,
				`user_id` int(11) NOT NULL,
				PRIMARY KEY (`id`),
				KEY `participation_id` (`participation_id`),
				KEY `user_id` (`user_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

			CREATE TABLE IF NOT EXISTS `dotaba_picksbans` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`match_id` int(11) NOT NULL,
				`is_pick` tinyint(1) NOT NULL,
				`hero_id` int(11) NOT NULL,
				`team` int(1) NOT NULL,
				`order` int(2) NOT NULL,
				PRIMARY KEY (`id`),
				KEY `match_id` (`match_id`),
				KEY `order` (`order`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

			CREATE TABLE IF NOT EXISTS `dotaba_posts` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`content` text COLLATE utf8_unicode_ci NOT NULL,
				`topic_id` int(11) DEFAULT NULL,
				`user_id` int(11) NOT NULL,
				`created_at` datetime NOT NULL,
				`updated_at` datetime DEFAULT NULL,
				PRIMARY KEY (`id`),
				KEY `topic_id` (`topic_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

			CREATE TABLE IF NOT EXISTS `dotaba_requests` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`user_id` int(11) DEFAULT NULL,
				`giver_id` int(11) DEFAULT NULL,
				`processed` tinyint(1) DEFAULT '0',
				`removed` tinyint(1) DEFAULT '0',
				`created_at` datetime NOT NULL,
				`updated_at` datetime DEFAULT NULL,
				PRIMARY KEY (`id`),
				KEY `user_id` (`user_id`),
				KEY `giver_id` (`giver_id`),
				KEY `processed` (`processed`),
				KEY `removed` (`removed`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

			CREATE TABLE IF NOT EXISTS `dotaba_roles` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
				`description` text COLLATE utf8_unicode_ci,
				`created_at` datetime NOT NULL,
				`updated_at` datetime DEFAULT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

			INSERT INTO `dotaba_roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
				(1, 'Administrator/ica', NULL, '2013-03-29 14:53:58', NULL),
				(2, 'Novinar/ka', NULL, '2013-03-29 14:53:58', NULL);

			CREATE TABLE IF NOT EXISTS `dotaba_roles_users` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`role_id` int(11) NOT NULL,
				`user_id` int(11) NOT NULL,
				PRIMARY KEY (`id`),
				KEY `role_id` (`role_id`),
				KEY `user_id` (`user_id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

			INSERT INTO `dotaba_roles_users` (`id`, `role_id`, `user_id`) VALUES
				(1, 1, 1),
				(2, 1, 2);

			CREATE TABLE IF NOT EXISTS `dotaba_sessions` (
				`session_id` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
				`last_active` int(10) unsigned NOT NULL,
				`contents` text COLLATE utf8_unicode_ci NOT NULL,
				PRIMARY KEY (`session_id`),
				KEY `last_active` (`last_active`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

			CREATE TABLE IF NOT EXISTS `dotaba_slots` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`match_id` int(11) NOT NULL,
				`user_id` int(11) NOT NULL,
				`hero_id` int(11) NOT NULL,
				`player_slot` int(1) DEFAULT NULL,
				`item_0_id` int(11) DEFAULT NULL,
				`item_1_id` int(11) DEFAULT NULL,
				`item_2_id` int(11) DEFAULT NULL,
				`item_3_id` int(11) DEFAULT NULL,
				`item_4_id` int(11) DEFAULT NULL,
				`item_5_id` int(11) DEFAULT NULL,
				`kills` int(11) NOT NULL,
				`deaths` int(11) NOT NULL,
				`assists` int(11) NOT NULL,
				`leaver_status` tinyint(1) NOT NULL,
				`gold` int(11) NOT NULL,
				`last_hits` int(11) NOT NULL,
				`denies` int(11) NOT NULL,
				`gold_per_min` int(11) NOT NULL,
				`xp_per_min` int(11) NOT NULL,
				`gold_spent` int(11) NOT NULL,
				`hero_damage` int(11) NOT NULL,
				`tower_damage` int(11) NOT NULL,
				`hero_healing` int(11) NOT NULL,
				`level` int(11) NOT NULL,
				PRIMARY KEY (`id`),
				KEY `match_id` (`match_id`),
				KEY `user_id` (`user_id`),
				KEY `player_slot` (`player_slot`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

			CREATE TABLE IF NOT EXISTS `dotaba_streams` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`channel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				`description` text COLLATE utf8_unicode_ci,
				`user_id` int(11) NOT NULL,
				`online` tinyint(1) DEFAULT '0',
				`viewers` int(11) DEFAULT '0',
				`created_at` datetime NOT NULL,
				`updated_at` datetime DEFAULT NULL,
				PRIMARY KEY (`id`),
				KEY `user_id` (`user_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

			CREATE TABLE IF NOT EXISTS `dotaba_topics` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				`user_id` int(11) NOT NULL,
				`main_post_id` int(11) NOT NULL,
				`is_locked` tinyint(1) DEFAULT '0',
				`is_hidden` tinyint(1) DEFAULT '0',
				`is_sticky` tinyint(1) DEFAULT '0',
				`posts_count` int(11) DEFAULT '1',
				`views_count` int(11) DEFAULT '0',
				`created_at` datetime NOT NULL,
				`updated_at` datetime DEFAULT NULL,
				PRIMARY KEY (`id`),
				KEY `is_hidden` (`is_hidden`),
				KEY `is_sticky` (`is_sticky`),
				KEY `updated_at` (`updated_at`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

			CREATE TABLE IF NOT EXISTS `dotaba_tournaments` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				`description` text COLLATE utf8_unicode_ci,
				`user_id` int(11) NOT NULL,
				`mode_id` int(11) NOT NULL,
				`num_clans` int(11) NOT NULL,
				`is_auto_approvable` tinyint(1) NOT NULL,
				`is_started` tinyint(1) DEFAULT '0',
				`winner_id` int(11) DEFAULT NULL,
				`created_at` datetime NOT NULL,
				`updated_at` datetime DEFAULT NULL,
				`finished_at` datetime DEFAULT NULL,
				PRIMARY KEY (`id`),
				KEY `winner_id` (`winner_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

			CREATE TABLE IF NOT EXISTS `dotaba_types` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				`lobby_type` int(11) DEFAULT NULL,
				PRIMARY KEY (`id`),
				KEY `name` (`name`),
				KEY `lobby_type` (`lobby_type`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

			INSERT INTO `dotaba_types` (`id`, `name`, `lobby_type`) VALUES
				(1, 'Clan war', NULL),
				(2, 'Mix', NULL),
				(3, 'Turnir', NULL),
				(4, 'Public matchmaking', 0);

			CREATE TABLE IF NOT EXISTS `dotaba_users` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`steamid` bigint(20) NOT NULL,
				`accountid` int(11) unsigned NOT NULL,
				`clan_id` int(11) DEFAULT NULL,
				`username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				`name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
				`location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
				`profileurl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				`avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				`status` int(1) NOT NULL,
				`featured_hero_id` int(11) DEFAULT NULL,
				`wins` int(11) DEFAULT '0',
				`losses` int(11) DEFAULT '0',
				`created_at` datetime NOT NULL,
				PRIMARY KEY (`id`),
				KEY `steamid` (`steamid`),
				KEY `accountid` (`accountid`),
				KEY `clan_id` (`clan_id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

			INSERT INTO `dotaba_users` (`id`, `steamid`, `accountid`, `clan_id`, `username`, `name`, `location`, `profileurl`, `avatar`, `status`, `featured_hero_id`, `wins`, `losses`, `created_at`) VALUES
				(1, 76561198002272594, 42006866, NULL, 'GriFoN', 'Almir', 'BA', 'http://steamcommunity.com/id/GriFoN92/', 'http://media.steampowered.com/steamcommunity/public/images/avatars/e2/e24cca7c7cc33047149f8d8c39e2a807639e0d85_full.jpg', 0, NULL, 0, 0, '2013-02-21 20:56:51'),
				(2, 76561198072492915, 112227187, NULL, 'Bakcheia', 'Amar', 'BA', 'http://steamcommunity.com/id/s1xr/', 'http://media.steampowered.com/steamcommunity/public/images/avatars/da/dacdacd146582e2bad49defad8224f280730f2d0_full.jpg', 1, NULL, 0, 0, '2013-02-27 18:03:51');

			CREATE TABLE IF NOT EXISTS `dotaba_videos` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`vid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				`description` text COLLATE utf8_unicode_ci,
				`user_id` int(11) NOT NULL,
				`created_at` datetime NOT NULL,
				`updated_at` datetime DEFAULT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;"
		);
	}

}

?>