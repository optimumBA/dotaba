<?php defined('SYSPATH') or die('No direct script access.');

class Model_Hero extends Model_Database {

	public static $table_name = 'heroes';

	public static function populate($remote_heroes, $update)
	{
		$db = Database::instance();

		$db->begin();

		$changes['added']   = array();
		$changes['altered'] = array();

		foreach ($remote_heroes as $remote_hero)
		{
			$hero = self::find($remote_hero->id);

			$image = 'http://media.steampowered.com/apps/dota2/images/heroes/'.substr($remote_hero->name, 14).'_full.png';

			if ($hero === FALSE)
			{
				$changes['added'][] = $remote_hero;

				Model_Hero::insert(array(
					'id'             => $remote_hero->id,
					'name'           => $remote_hero->name,
					'localized_name' => $remote_hero->localized_name,
					'image'          => $image,
				));

				Media_Hero::cache($remote_hero->id, $image);
			}
			else
			{
				foreach ($hero as $key => $value)
				{
					if ($remote_hero->{$key} != $value)
					{
						$changes['altered'][] = array('remote' => $remote_hero, 'local' => $hero);

						if ($update == TRUE)
						{
							Model_Hero::update($remote_hero->id, array(
								'name'           => $remote_hero->name,
								'localized_name' => $remote_hero->localized_name,
								'image'          => $image,
							));
						}

						break;
					}
				}
			}
		}

		if (empty($changes['altered']) OR $update == TRUE)
		{
			$db->commit();
		}

		if (empty($changes['added']) AND empty($changes['altered']))
		{
			$changes = FALSE;
		}

		return $changes;
	}

}